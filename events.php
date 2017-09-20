<html>
	<title>Events</title>
	<head>
		<h1>Events</h1>
		<link rel="stylesheet" href="/css/mainstyles.css">
	</head>
	<body>
		<?php include $_SERVER['DOCUMENT_ROOT']."/global/navbar.php"; ?>
		<p>
			<h2>Upcoming events</h2>
			<?php include $_SERVER['DOCUMENT_ROOT']."/events/meta/getupcoming.php"; ?>
		</p>
		<p>
			<h2>Past events</h2>
			<?php include $_SERVER['DOCUMENT_ROOT']."/events/meta/past.php"; ?>
		</p>
		<p>
			<h2>Subscribe</h2>
			Click <a href="/subscribe.php">here</a> to subscribe to MIT.
		</p>
	</body>
</html>
