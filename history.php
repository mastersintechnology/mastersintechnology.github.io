<!DOCTYPE html>
<html>
	<title>History of MIT</title>
	<head>
		<h1>MIT over the Years</h1>
		<link rel="stylesheet" href="/css/mainstyles.css">
	</head>
	<body>
		<?php 
			include $_SERVER['DOCUMENT_ROOT']."/global/navbar.php";
			$yrNow = date("Y");
			$month = date("m");
			if ($month > 8){
				$next = $yrNow + 1;
				echo "<h2>$yrNow-$next</h2>";
				echo "<p>";
				include $_SERVER['DOCUMENT_ROOT']."/history/team$yrNow-$next.php";
				echo "</p>";
			}
			for ($yr = $yrNow - 1; $yr >= 2016; $yr--){
				$next = $yr + 1;
				echo "<h2>$yr-$next</h2>";
				echo "<p>";
				include $_SERVER['DOCUMENT_ROOT']."/history/team$yr-$next.php";
				echo "</p>";
			}
		?>
	</body>
</html>
