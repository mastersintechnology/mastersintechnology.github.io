<html>
	<title>Masters In Technology</title>
	<head>
		<h1>Masters In Technology</h1>
		<link rel="stylesheet" href="/css/mainstyles.css">
	</head>
	<body>
		<?php include $_SERVER['DOCUMENT_ROOT']."/global/navbar.php"; ?>
		<p>
			<b>Upcoming events</b>
			<?php include $_SERVER['DOCUMENT_ROOT']."/events/meta/getupcoming.php"; ?>
		</p>
		<hr>
		<p>
			<?php 
				$wkNum = date("W");
				$yr = date("Y");
				echo "<b>Tech Tip of Week $wkNum, $yr</b>";
				if ((include $_SERVER['DOCUMENT_ROOT']."/techtips/$yr/$wkNum/techtip.php") == FALSE){
					include $_SERVER['DOCUMENT_ROOT']."/techtips/meta/notechtip.php";
				}
			?>
		</p>
	</body>
</html>
