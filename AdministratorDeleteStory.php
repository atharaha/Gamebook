<html>
	<head>
		<title>Gamebook | Administrator Delete Story</title>
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

				$username = $_SESSION['username'];
				
				$sql = "select * from user_accounts where username='$username' and administrator='Y'";
				$result = mysqli_query($link, $sql);
				
				if(isset($_SESSION['sign_in']) && $_SESSION['sign_in'] == True && mysqli_num_rows($result) == 1)
				{
					$title = mysqli_real_escape_string($link,$_GET['title']);
					$author = mysqli_real_escape_string($link,$_GET['author']);

					$sql = "delete from stories where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);

					if($result)
					{
						$sql = "delete from pages where title='$title' and author='$author'";
						$result = mysqli_query($link, $sql);
						
						if($result)
						{
							echo "Story Deletion Successful on ".date("D, d M Y.");
							echo "<meta http-equiv='refresh' content='5;url=Administrator.php'>";
						}
						else
						{
							echo "Story Deletion Unsuccessful on ".date("D, d M Y.");
							echo "<meta http-equiv='refresh' content='10;url=Administrator.php'>";
						}
					}
					else
					{
						echo "Story Deletion Unsuccessful on ".date("D, d M Y.");
						echo "<meta http-equiv='refresh' content='10;url=Administrator.php'>";
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