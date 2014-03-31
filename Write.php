<html>
	<head>
		<title>Gamebook | Write Stories</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
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
					
					echo '<h2>Stories Written</h2>';
					echo '<h4>Username : '.$username.'</h4>';

					$sql = "select title, description, firstpageid from stories where author='$username'";
					$result = mysqli_query($link, $sql);
					
					if (mysqli_num_rows($result) == 0)
					{
						echo 'You have yet to create a story!';
					}
					else
					{
						echo '<p>Listed below are all the stories you have written. You may choose to either edit, delete or create a story.</p>';
			?>
			<table border="1" style="text-align:center;">
			<tr>
				<th width="8%">Index</th>
				<th width="15%">Title</th>
				<th width="*">Description</th>
				<th width="10%">Edit</th>
				<th width="10%">Delete</th>
			</tr>
			<?php
						$index = 1;
						while ($row = mysqli_fetch_array($result))
							{
								$entries[]= array('title'=>$row['title'], 'description'=>$row['description'], 'firstpageid'=>$row['firstpageid']);
							}
						foreach ($entries as $entry)
						{
							echo '<tr><td width="8%">'.$index.'</td>';
							echo '<td width="15%">'.$entry['title'].'</td>'; 
							echo '<td width="*">'.$entry['description'].'</td>';
							echo '<td width="10%"><a href="EditStoryForm.php?title='.$entry['title'].'">Edit</a></td>'; 
							echo '<td width="10%"><a href="DeleteStory.php?title='.$entry['title'].'">Delete</a></td></tr>'; 
							$index++;
						}
						echo '</table>';	
					}
					mysqli_close($link);	
					echo '<h4 align="center"><a href="CreateStoryForm.php">Create a New Story!</a></h4>'; 
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