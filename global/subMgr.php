<?php
	if (isset($_POST['action'])){
		$date = date("Y-m-d, G:i:s");
		if ($_POST['action'] == "sub"){
			if (isset($_POST['events']) &&
				isset($_POST['tips']) &&
				isset($_POST['general']) &&
				isset($_POST['email'])
				){
				file_put_contents(
					"subscriptionlog.txt",
					"New subscription on " . $date . "\nEvents:" .
					$_POST['events'] . "\nTips:" . $_POST['tips'] . "\nGeneral updates:" . $_POST['general'] . "\n" . $_POST['email'] . "\n\n",
					FILE_APPEND
				);
			}
		} else if ($_POST['action'] == "unsub"){
			if (isset($_POST['email'])){
				file_put_contents(
					"subscriptionlog.txt",
					"Cancelled subscription on " . $date . "\n" . $_POST['email'] . "\n\n",
					FILE_APPEND
				);
			}
		}
	}
?>
