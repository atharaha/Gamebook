<?xml version="1.0"?>
<!doctype html PUBLIC "-//WC3//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Gamebook | Frame Top</title>
		<base target="frmain">
		<link rel="stylesheet" type="text/css" href="css/nav.css">
	</head>
	<body style="background-image:url('../images/gradient.jpg');">
		<p align="center"><font face="Algerian, Harlow Solid Italic, Britannic Bold" size="6"><b>Gamebook</b></font></p>
		<div id="nav-menu">
			<ul>
				<li><a href="Main.html">Home</a></li>
				<li><a href="StoryDirectory.php">Story Directory</a></li>
				<?php
					session_start();
					
					if(isset($_SESSION['sign_in']) && $_SESSION['sign_in'] == True)
					{
						$server_username = 'root';
						$server_password = '1002';
						$server_host = 'localhost';
						$server_database = 'gamebook';

						$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);
						
						$username = $_SESSION['username'];
						
						$sql = "select * from user_accounts where username='$username' and administrator='Y'";
						$result = mysqli_query($link, $sql);
						
						echo '<li style="float:right;"><a href="Logout.php">Logout</a></li>';
						echo '<li style="float:right;"><a href="Write.php">Write Stories</a></li>';
						
						if(mysqli_num_rows($result) == 1)
						{
							echo '<li style="float:right;"><a href="Administrator.php">Administrator</a></li>';
						}
					}
					else
					{
						echo '<li style="float:right;"><a href="RegistrationForm.php">Register</a></li>';
						echo '<li style="float:right;"><a href="LoginForm.html">Login</a></li>';
					}
				?>
			</ul>
		</div>
	</body>
</html>