<html>
	<head>
		<title>Gamebook | Home</title>
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

			$id = mysqli_real_escape_string($link,$_GET['id']);
			$sql = "select * from pages where id='$id';";
			$result = mysqli_query($link, $sql);
			if (mysqli_num_rows($result) == 0)
			  {
				echo 'Sorry! This page has yet to be created, please come back once the page is released!';
			   }
			else
			{
				$end = True;
				$row = mysqli_fetch_array($result);
				$entry[]= array('title'=>$row['title'], 'author'=>$row['author'], 'passage'=>$row['passage'], 
								'choiceoneid'=>$row['choiceoneid'], 'choiceonetext'=>$row['choiceonetext'], 
								'choicetwoid'=>$row['choicetwoid'], 'choicetwotext'=>$row['choicetwotext'],
								'choicethreeid'=>$row['choicethreeid'], 'choicethreetext'=>$row['choicethreetext'],
								'choicefourid'=>$row['choicefourid'], 'choicefourtext'=>$row['choicefourtext'],
								'choicefiveid'=>$row['choicefiveid'], 'choicefivetext'=>$row['choicefivetext']);
				echo '<h2><u>'.$entry[0]['title'].'</u></h2>';
				echo '<h3>By '.$entry[0]['author'].'</h3><hr>';
				echo '<br><pre>'.$entry[0]['passage'].'</pre><br><hr>';
				if(isset($entry[0]['choiceoneid']) && $entry[0]['choiceoneid'] != '0')
				{
					$end = False;
					echo '<br><a href="Viewer.php?id='.$entry[0]['choiceoneid'].'">1. '.$entry[0]['choiceonetext'].'</a><br>';
				}
				if(isset($entry[0]['choicetwoid']) && $entry[0]['choicetwoid'] != '0')
				{
					$end = False;
					echo '<br><a href="Viewer.php?id='.$entry[0]['choicetwoid'].'">2. '.$entry[0]['choicetwotext'].'</a><br>';
				}
				if(isset($entry[0]['choicethreeid']) && $entry[0]['choicethreeid'] != '0')
				{
					$end = False;
					echo '<br><a href="Viewer.php?id='.$entry[0]['choicethreeid'].'">3. '.$entry[0]['choicethreetext'].'</a><br>';
				}
				if(isset($entry[0]['choicefourid']) && $entry[0]['choicefourid'] != '0')
				{
					$end = False;
					echo '<br><a href="Viewer.php?id='.$entry[0]['choicefourid'].'">4. '.$entry[0]['choicefourtext'].'</a><br>';
				}
				if(isset($entry[0]['choicefiveid']) && $entry[0]['choicefiveid'] != '0')
				{
					$end = False;
					echo '<br><a href="Viewer.php?id='.$entry[0]['choicefiveid'].'">5. '.$entry[0]['choicefivetext'].'</a><br>';
				}
				if($end != False)
				{
					echo '<br><h1 align="center">The End!</h1>';
				}
			}
			mysqli_close($link); 
		?>
		</div>
	</body>
</html>