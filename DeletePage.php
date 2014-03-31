<html>
	<head>
		<title>Gamebook | Delete Page</title>
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

					$id = mysqli_real_escape_string($link,$_GET['id']);
					$title = mysqli_real_escape_string($link,$_GET['title']);
					$author = $_SESSION['username'];
					
					$sql = "delete from pages where id='$id' and title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);

					if($result)
					{
						echo "Page Deletion Successful on ".date("D, d M Y.");
						echo "<meta http-equiv='refresh' content='5;url=EditStoryForm.php?title=".$title."'>";
					}
					else
					{
						echo "Page Deletion Unsuccessful on ".date("D, d M Y.");
						echo "<meta http-equiv='refresh' content='5;url=EditStoryForm.php?title=".$title."'>";
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