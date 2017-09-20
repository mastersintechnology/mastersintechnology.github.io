<html>
	<title>Subscribe to MIT</title>
	<head>
		<h1>Subscribe</h1>
		<link rel="stylesheet" href="/css/mainstyles.css">
		<script src="/js/jquery.js"></script>
		<script type="text/javascript">
			function newSubscription(){
				var form = document.getElementById("subForm");
				var e = 'no', t = 'no', g = 'no', em = form.elements['email'].value;
				if (form.elements['events'].checked){
					e = 'yes';
					//alert("events!");
				}
				if (form.elements['tips'].checked){
					t = 'yes';
					//alert("tips!");
				}
				if (form.elements['updates'].checked){
					g = 'yes';
					//alert("updates!");
				}
				//alert("ajax");
				$.ajax({
					url: "/global/subMgr.php",
					type: "POST",
					data: {
						action:'sub',
						events:e,
						tips:t,
						general:g,
						email:em
					}
				});
				//alert("done?");
				form.reset();
				alert("Subscription request sent");
			}
			
			function cancelSubscription(){
				var form = document.getElementById("unsubForm");
				var em = form.elements['email2'].value;
				$.ajax({
					url: "/global/subMgr.php",
					type: "POST",
					data: {
						action:'unsub',
						email:em
					}
				});
				form.reset();
				alert("Subscription cancellation request sent");
			}
		</script>
	</head>
	<body>
		<?php include $_SERVER['DOCUMENT_ROOT']."/global/navbar.php"; ?>
		<p>
			<h2>Subscribe to MIT</h2>
			To subscribe to MIT, tick the boxes next to the topics you wish to be notified about and enter your email address. Then click 'Subscribe'.
			<form id="subForm">
				<input type="checkbox" name="events"><label for="events">Upcoming events</label><br>
				<input type="checkbox" name="tips"><label for="tips">Tech Tip of the Week</label><br>
				<input type="checkbox" name="updates"><label for="updates">General updates</label><br>
				Email address: <input type="text" name="email"><br>
				<button onClick="newSubscription()" type="button">Subscribe</button>
			</form>
		</p>
		<p>
			<h2>Unsubscribe from MIT</h2>
			To unsubscribe, enter the email address with which you subscribed and click 'Unsubscribe'.
			<form id="unsubForm">
				Email address: <input type="text" name="email2"><br>
				<button onClick="cancelSubscription()" type="button">Unsubscribe</button>
			</form>
		</p>
		<p>
			<h2>Modifying your subscription settings</h2>
			If you wish to change which topics you are notified about, follow the same steps as the subscription process, checking the boxes for the topics you wish to be notified about. It is not necessary to indicate which topics you are cancelling, as we will not email you regarding something you have not ticked.
		</p>
		<p>
			<h2>Notice</h2>
			After any action regarding your subscription, MIT will do its best to email you to confirm the action within 2 school days. This is to prevent other people from interfering with your subscription or from subscribing using your email address without your permission.<br><br>
			We apologize in advance for any delays in the arrival of communications from MIT, as we may be busy with exams or other school work.
		</p>
	</body>
</html>
