<html>
	<head>
		<title>Gamebook | Password Reset</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
			<?php

				date_default_timezone_set('Asia/Singapore');
				$server_username = 'root';
				$server_password = '1002';
				$server_host = 'localhost';
				$server_database = 'gamebook';

				$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);

				$username = mysqli_real_escape_string($link,$_POST['username']);
				$password = mysqli_real_escape_string($link,$_POST['password']);
				$day = mysqli_real_escape_string($link,$_POST['day']);
				$month = mysqli_real_escape_string($link,$_POST['month']);
				$year = mysqli_real_escape_string($link,$_POST['year']);
				$date = $year."-".$month."-".$day;

				$sql = "select * from user_accounts where username='$username' and DOB='$date'";
				$result = mysqli_query($link, $sql);

				if(mysqli_num_rows($result) == 1)
				{
					$sql = "update user_accounts set password='$password' where username='$username'";
					mysqli_query($link, $sql);
					echo "Password Reset Successful on ".date("D, d M Y.")."<br> Please Login to access the site!";
					echo "<meta http-equiv='refresh' content='5;url=LoginForm.html'>";
				}
				else
				{
					echo "Password Reset Unsuccessful on ".date("D, d M Y.");
					echo "<meta http-equiv='refresh' content='10;url=PasswordResetForm.php'>";
				}
				unset($_POST);
				mysqli_close($link);
			?>
		</div>
	</body>
</html>