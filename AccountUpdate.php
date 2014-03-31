<html>
	<head>
		<title>Gamebook | Account Update</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
			<?php
				session_start();
				
				if(isset($_SESSION['sign_in']) && $_SESSION['sign_in'] == True)
				{
					date_default_timezone_set('Asia/Singapore');
					
					$server_username = 'root';
					$server_password = '1002';
					$server_host = 'localhost';
					$server_database = 'gamebook';

					$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);

					$username = $_SESSION['username'];
					$email = mysqli_real_escape_string($link,$_POST['email']);
					$password = mysqli_real_escape_string($link,$_POST['password']);
					$name = mysqli_real_escape_string($link,$_POST['name']);
					$gender = mysqli_real_escape_string($link,$_POST['gender']);
					$day = mysqli_real_escape_string($link,$_POST['day']);
					$month = mysqli_real_escape_string($link,$_POST['month']);
					$year = mysqli_real_escape_string($link,$_POST['year']);
					$date = $year."-".$month."-".$day;

					$sql = "update user_accounts set email='$email', password='$password', name='$name', gender='$gender', DOB='$date' where username='$username'";
					mysqli_query($link, $sql);

					if($result)
					{
						echo "Account Update Successful on ".date("D, d M Y.")."<br> Please Login to access the site!";
						echo "<meta http-equiv='refresh' content='5;url=AccountUpdateForm.html'>";
					}
					else
					{
						echo "Account Update Unsuccessful on ".date("D, d M Y.");
						echo "<meta http-equiv='refresh' content='10;url=AccountUpdateForm.php'>";
					}
					unset($_POST);
					mysqli_close($link);
				}
				else
				{
					echo "Please Login!";
					echo "<meta http-equiv='refresh' content='10;url=LoginForm.html'>";
				}
			?>
		</div>
	</body>
</html>