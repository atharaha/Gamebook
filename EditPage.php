<html>
	<head>
		<title>Gamebook | Edit Page</title>
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
					$passage = mysqli_real_escape_string($link,$_POST['passage']);
					
					if($_POST['choiceonecheck'] == "YES")
					{
						$choiceonetext = mysqli_real_escape_string($link,$_POST['choiceonetext']);
						$choiceoneid = mysqli_real_escape_string($link,$_POST['choiceoneid']);
					}
					else
					{
						$choiceonetext = 'NULL';
						$choiceoneid = '0';
					}
					
					if($_POST['choicetwocheck'] == "YES")
					{
						$choicetwotext = mysqli_real_escape_string($link,$_POST['choicetwotext']);
						$choicetwoid = mysqli_real_escape_string($link,$_POST['choicetwoid']);
					}
					else
					{
						$choicetwotext = 'NULL';
						$choicetwoid = '0';
					}
					
					if($_POST['choicethreecheck'] == "YES")
					{
						$choicethreetext = mysqli_real_escape_string($link,$_POST['choicethreetext']);
						$choicethreeid = mysqli_real_escape_string($link,$_POST['choicethreeid']);
					}
					else
					{
						$choicethreetext = 'NULL';
						$choicethreeid = '0';
					}
					
					if($_POST['choicefourcheck'] == "YES")
					{
						$choicefourtext = mysqli_real_escape_string($link,$_POST['choicefourtext']);
						$choicefourid = mysqli_real_escape_string($link,$_POST['choicefourid']);
					}
					else
					{
						$choicefourtext = 'NULL';
						$choicefourid = '0';
					}
					
					if($_POST['choicefivecheck'] == "YES")
					{
						$choicefivetext = mysqli_real_escape_string($link,$_POST['choicefivetext']);
						$choicefiveid = mysqli_real_escape_string($link,$_POST['choicefiveid']);
					}
					else
					{
						$choicefivetext = 'NULL';
						$choicefiveid = '0';
					}

					$sql = "update pages set passage='$passage',
								choiceoneid='$choiceoneid',
								choiceonetext='$choiceonetext',
								choicetwoid='$choicetwoid',
								choicetwotext='$choicetwotext',
								choicethreeid='$choicethreeid',
								choicethreetext='$choicethreetext',
								choicefourid='$choicefourid',
								choicefourtext='$choicefourtext',
								choicefiveid='$choicefiveid',
								choicefivetext='$choicefivetext'
								where id='$id' and title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
					
					if($result)
					{		
						echo "Page Edit Successful on ".date("D, d M Y.");
						echo "<meta http-equiv='refresh' content='5;url=EditStoryForm.php?title=".$title."'>";
					}
					else
					{
						echo "Page Edit Unsuccessful on ".date("D, d M Y.")."<br> Page not found!";
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