<html>
	<head>
		<title>Gamebook | Registration</title>
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
				$email = mysqli_real_escape_string($link,$_POST['email']);
				$password = mysqli_real_escape_string($link,$_POST['password']);
				$name = mysqli_real_escape_string($link,$_POST['name']);
				$gender = mysqli_real_escape_string($link,$_POST['gender']);
				$day = mysqli_real_escape_string($link,$_POST['day']);
				$month = mysqli_real_escape_string($link,$_POST['month']);
				$year = mysqli_real_escape_string($link,$_POST['year']);
				$date = $year."-".$month."-".$day;

				$sql = "select * from user_accounts where username='$username'";
				$result = mysqli_query($link, $sql);

				if(mysqli_num_rows($result) == 0)
				{
					$sql = "select * from user_accounts where email='$email'";
					$result = mysqli_query($link, $sql);
					
					if(mysqli_num_rows($result) == 0)
					{
						$sql = "insert into user_accounts set
								username = '$username',
								email = '$email', 
								password = '$password',
								name = '$name',
								gender = '$gender',
								DOB = '$date'";
						mysqli_query($link, $sql);
						echo "Registration Successful on ".date("D, d M Y.")."<br> Please Login to access the site!";
						echo "<meta http-equiv='refresh' content='5;url=LoginForm.html'>";
					}
					else
					{
						echo "Registration Unsuccessful on ".date("D, d M Y.")."<br> Email Address already in use!";
						echo "<meta http-equiv='refresh' content='10;url=RegistrationForm.php'>";
					}
				}
				else
				{
					echo "Registration Unsuccessful on ".date("D, d M Y.")."<br> Username already in use!";
					echo "<meta http-equiv='refresh' content='10;url=RegistrationForm.php'>";
				}
				unset($_POST);
				mysqli_close($link);
			?>
		</div>
	</body>
</html>