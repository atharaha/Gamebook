<html>
	<head>
		<title>Gamebook | Administrator</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
			<?php
				session_start();
				
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
					echo '<h2>Admin Page</h2>';

					$sql = "select title, author, description, firstpageid from stories";
					$result = mysqli_query($link, $sql);
					
					if (mysqli_num_rows($result) == 0)
					{
						echo 'No stories currently in database!';
					}
					else
					{
						echo '<p>Listed below are all the stories published on the website.</p>';
			?>
			<table border="1" style="text-align:center;">
			<tr>
				<th width="8%">Index</th>
				<th width="15%">Title</th>
				<th width="15%">Author</th>
				<th width="*">Description</th>
				<th width="10%">Read</th>
				<th width="10%">Delete</th>
			</tr>
			<?php
						$index = 1;
						while ($row = mysqli_fetch_array($result))
							{
								$entries[]= array('title'=>$row['title'], 'author'=>$row['author'], 'description'=>$row['description'], 'firstpageid'=>$row['firstpageid']);
							}
						foreach ($entries as $entry)
						{
							echo '<tr><td width="8%">'.$index.'</td>';
							echo '<td width="15%">'.$entry['title'].'</td>';
							echo '<td width="15%">'.$entry['author'].'</td>'; 
							echo '<td width="*">'.$entry['description'].'</td>';
							echo '<td width="10%"><a href="Viewer.php?id='.$entry['firstpageid'].'">Read</a></td>'; 
							echo '<td width="10%"><a href="AdministratorDeleteStory.php?title='.$entry['title'].'&author='.$entry['author'].'">Delete</a></td></tr>'; 
							$index++;
						}
						echo '</table>';
						mysqli_close($link);		
					}
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