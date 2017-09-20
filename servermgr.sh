#!/bin/bash

#Written by Alessandro Vinciguerra
#	DCB Class of 2018

#requires execution permission to be run
#	chmod 777 servermgr.sh
#not to be confused with 'servermgr' which is the man page for this script

#Written by Alessandro Vinciguerra <alesvinciguerra@gmail.com>
#	DCB, Class of 2018

#Version 1.0
#Timestamp: April 17, 2017 - 15:30

#show command list
printOps(){
	echo 'Commands:'
	echo '	down - download the latest version of all files'
	echo '	up - upload changes to server'
	echo '	help - print this help message'
	echo '	done - exit'
}

download(){
	#downloads the latest version of all files on the server in the folder containing all the webpages
	#	by using rsync -u (--update), only files that have been modified will be downloaded
	#	by using rsync -v (--verbose), all files that are downloaded (or uploaded) will be printed so the
	#		user is informed of which files have been modified
	#	by using rsync -r (--recursive), all the contents of the folder are downloaded
	#	--exclude '*~' prevents files ending il a tilde (~) from being copied (because they're backups)
	#all the web server stuff is stored in /var/www/html
	rsync -cruv --exclude '*~' root@10.10.0.152:/var/www/html/ .
	#the $? variable contains the return value of the previous command, most commands return 0 if successful (e.g. rsync)
	err=$?
	if [[ $err -eq 0 ]]; then
		echo 'Download successful'
	else
		echo 'Download failed: rsync error code ${err}'
	fi
}

upload(){
	#creates a new variable called suf
	#	starts with the current date in YYYY-MM-DD format (alphabetic sorting = temporal sorting)
	#	then the username, so we know who modified the file
	#	then a tilde (~), marking the file as a backup and not the actual webpage
	#		(this will be useful when automating backups)
	suf=$(date "+%Y-%m-%d")$username'~'

	#upload the contents of the current folder to the web server
	#	--include only PHP and CSS files
	#	--exclude all other files (prevent them from being transferred)
	#	by using -b (--backup), older versions of files are kept
	#	--suffix=$suf appends the text contained in the $suf variable to the older versions of files
	#		this makes it easy to see who modified the files and when
	#	see the part where files are downloaded for an explanation of -r, -u, and -v
	#	the period (.) represents the current directory; servermgr.sh must be executed from the folder where
	#		you want to store your local copy of the website
	#note that this tool only transfers PHP and CSS files, so if any other files need to be transferred,
	#	do it manually or use the new update-by-FTP method
	rsync -bcruv --suffix=$suf --include '*.php' --include '*.css' --include '*.jpg' --include '*.png' --include '*/' --exclude '*' . root@10.10.0.152:/var/www/html
	err=$?
	if [[ $err -eq 0 ]]; then
		echo 'Upload successful'
		ssh root@10.10.0.152 /root/scripts/MIT/updateftp.sh
		echo 'Updated FTP directory'
	else
		echo 'Upload failed: rsync error code ${err}'
	fi
}

interactive=1
username=""
mode=""

while getopts "n:udi" opt; do
	case $opt in
		n) username=$OPTARG ;;
		u)
			if [[ $mode == "" ]]; then
				((interactive--))
			fi
			mode="up"
			;;
		d)
			if [[ $mode == "" ]]; then
				((interactive--))
			fi
			mode="down"
			;;
		i) ((interactive++)) ;;
		*)
			echo 'Invalid flag: ${opt}'
			exit 1 ;;
	esac
done

#get the user's name, if not already given
if [[ $username == "" ]]; then
	read -p "Please enter your name for logging purposes: " username
fi

if [[ $mode == "up" ]]; then
	upload
elif [[ $mode == "down" ]]; then
	download
fi

if [[ $interactive -lt 1 ]]; then
	exit
fi

#introduction to program
echo 'MIT Web Server Manager'
printOps

#main loop
while true; do
	#get user input
	read -p 'main> ' input
	if [[ $input == "help" ]]; then
		printOps
	elif [[ $input == "done" ]]; then
		#break out of main loop i.e. exit program
		break
	elif [[ $input == "down" ]]; then
		download
	elif [[ $input == "up" ]]; then
		upload
	fi
done
