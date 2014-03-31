<html>
	<head>
		<title>Gamebook | Edit Story</title>
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

					$title = mysqli_real_escape_string($link,$_GET['title']);
					$author = $_SESSION['username'];
					$description = mysqli_real_escape_string($link,$_POST['description']);

					$sql = "update stories set description='$description' where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
					
					if($result)
					{	
						echo "Story Edit Successful on ".date("D, d M Y.");
						echo "<meta http-equiv='refresh' content='5;url=EditStoryForm.php?title=".$title."'>";
					}
					else
					{
						echo "Story Edit Unsuccessful on ".date("D, d M Y.")."<br> Story not found!";
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