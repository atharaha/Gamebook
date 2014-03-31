<html>
	<head>
		<title>Gamebook | Logout</Title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
		<?php
			date_default_timezone_set('Asia/Singapore');
			
			session_start();
			
			$username = $_SESSION['username'];
			
			session_destroy();
			
			echo "Logout Successful on ".date("D, d M Y.")."<br> Bye ".$username."!";
			echo "<meta http-equiv='refresh' content='5;url=StoryDirectory.php'>";
		?>
		</div>
	</body>
</html>