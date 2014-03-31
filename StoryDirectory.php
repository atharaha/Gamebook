<html>
	<head>
		<title>Gamebook | Story Directory</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
	<body>
		<div>
			<h2>Story Directory</h2> 
			<?php
				session_start();

				$server_username = 'root';
				$server_password = '1002';
				$server_host = 'localhost';
				$server_database = 'gamebook';

				$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);

				$sql = "select title, author, description, firstpageid from stories;";
				$result = mysqli_query($link, $sql);
				
				if (mysqli_num_rows($result) == 0)
				{
					echo 'There are currently no stories avaliable to read!';
				}
				else
				{
			?>
			<p>Please select the Story that you wish to read.</p>    
			<table border="1" style="text-align:center;">
				<tr>
					<th width="8%">Index</th>
					<th width="15%">Title</th>
					<th width="15%">Author</th>
					<th width="*">Description</th>
					<th width="10%">Read</th>
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
						echo '<td width="15%"><a href="Viewer.php?id='.$entry['firstpageid'].'">Read</a></td></tr>'; 
						$index++;		
					}		
				}
				mysqli_close($link); 
			?>
		</div>
	</body>
</html>