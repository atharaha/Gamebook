<html>
	<head>
		<title>Gamebook | Login</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
			<?php

				session_start();

				date_default_timezone_set('Asia/Singapore');
				$server_username = 'root';
				$server_password = '1002';
				$server_host = 'localhost';
				$server_database = 'gamebook';

				$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);

				$username = mysqli_real_escape_string($link,$_POST['username']);
				$password = mysqli_real_escape_string($link,$_POST['password']);

				$sql = "select * from user_accounts where username='$username' and password='$password'";
				$result = mysqli_query($link, $sql);

				if(mysqli_num_rows($result) != 1)
				{
					echo "Login Unsuccessful on ".date("D, d M Y.")."<br> Invalid Username or Password!";
					echo "<meta http-equiv='refresh' content='10;url=LoginForm.html'>";
				}
				else
				{
					$_SESSION['username'] = $username;
					$_SESSION['sign_in'] = True;
					echo "Login Successful on ".date("D, d M Y.")."<br> Welcome ".$username."!";
					echo "<meta http-equiv='refresh' content='5;url=StoryDirectory.php'>";
				}
				unset($_POST);
				mysqli_close($link);
			?>
		</div>
	</body>
</html>
