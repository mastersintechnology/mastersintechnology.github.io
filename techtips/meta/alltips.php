<html>
	<title>MIT Tech Tips</title>
	<head>
		<link rel="stylesheet" href="/css/mainstyles.css">
		<h1>All Tech Tips Released by MIT</h1>
		<script type="text/javascript">
			function requestTip(){
				var form = document.getElementById("request");
				var year = form['year'].value;
				var week = form['week'].value;
				window.location = '#' + year + '-' + week;
				form.reset();
			}
		</script>
	</head>
	<body>
		Go to a specific tip:<br>
		<form id="request">
			Year: <input type="text" name="year"><br>
			Week: <input type="text" name="week"><br>
			<button onClick="requestTip()" type="button">Go to Tip</button>
		</form><br><br>
		<?php
			include $_SERVER['DOCUMENT_ROOT']."/global/navbar.php";
			$yrNow = date("Y");
			$wkNow = date("W");
			for ($yr = $yrNow; $yr >= 2017; $yr--){
				for ($wk = ($yr == $yrNow ? $wkNow : 53); $wk >= 1; $wk--){
					$path = $_SERVER['DOCUMENT_ROOT']."/techtips/$yr/$wk/techtip.php";
					if (file_exists($path)){
						echo "<a name=\"$yr-$wk\"><b>Tech Tip of Week $wk, $yr</b></a>";
						include $path;
					}	
				}
			}
		?>
	</body>
</html>