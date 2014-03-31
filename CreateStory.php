<html>
	<head>
		<title>Gamebook | Create Story</title>
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

					$title = mysqli_real_escape_string($link,$_POST['title']);
					$author = $_SESSION['username'];
					$description = mysqli_real_escape_string($link,$_POST['description']);

					$sql = "select * from stories where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);

					if(mysqli_num_rows($result) == 0)
					{
						$sql = "insert into pages set title='$title', author='$author'";
						$result = mysqli_query($link, $sql);
						
						$sql = "select id from pages where title='$title' and author='$author'";
						$result = mysqli_query($link, $sql);
						
						$row = mysqli_fetch_array($result);
						$entry[]= array('id'=>$row['id']);
						
						$firstpageid = $entry[0]['id'];
						
						$sql = "insert into stories set title='$title', 
								author='$author', 
								description='$description', 
								firstpageid='$firstpageid'";
						$result = mysqli_query($link, $sql);
						
						echo "Story Creation Successful on ".date("D, d M Y.")."<br> You may begin editing your story now!";
						echo "<meta http-equiv='refresh' content='5;url=EditStoryForm.php?title=".$title."'>";
					}
					else
					{
						echo "Story Creation Unsuccessful on ".date("D, d M Y.")."<br> You have already created a story with this title!";
						echo "<meta http-equiv='refresh' content='10;url=CreateStoryForm.php'>";
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