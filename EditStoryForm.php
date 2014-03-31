<html>
	<head>
		<title>Gamebook | Edit Story</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script type = "text/javascript">
			function validateForm()
			{
				var description = document.forms["edit"]["description"].value;
				if (description==null || description=="")
				{
					alert("Please enter a Description for your Story!");
					return false;
				}
			}
		</script>
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

					$title = mysqli_real_escape_string($link,$_GET['title']);
					$author = $_SESSION['username'];

					$sql = "select description, firstpageid from stories where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
					
					$row = mysqli_fetch_array($result);
					$entry[]= array('description'=>$row['description'], 'firstpageid'=>$row['firstpageid']);
						
					$description = $entry[0]['description'];
					$firstpageid = $entry[0]['firstpageid'];
			?>
			<h2>Edit Story</h2> 
			<h4>Username : <?php echo $author ?></h4> 
			<h4>Title : <?php echo $title; ?></h4> 
			<p>To edit your story's description, please fill in the online form below. All fields are required.</p>    
			<form name="edit" action="EditStory.php?title=<?php echo $title; ?>" onsubmit="return validateForm()" method="post">
				<fieldset>
					<legend>Details</legend>
					<table>
						<tr>
							<td width="40%">Title :</td>
							<td width="50%"><?php echo $title; ?></td>
						</tr>
						<tr>
							<td width="40%">Description :</td>  
							<td width="50%"><textarea rows="25" cols="70" name="description" maxlength="2000"><?php echo $description; ?></textarea></td>  
						</tr>
					</table>
				</fieldset>
				<p align="center"><input type="submit" value="Submit" /></p>
			</form>
			<hr>
			<p>Listed below are all the pages asscoiated with this story. You may choose to either edit, delete or create a page.</p>
			<?php
					$sql = "select * from pages where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
			?>
			<table border="1" style="text-align:center;">
			<tr>
				<th width="8%">Page No.</th>
				<th width="*%">Passage</th>
				<th width="20%">Choice Text</th>
				<th width="8%">Choice Page No.</th>
				<th width="10%">Edit</th>
				<th width="10%">Delete</th>
			</tr>
			<?php
					while ($row = mysqli_fetch_array($result))
					{
						$entries[]= array('id'=>$row['id'], 'passage'=>$row['passage'], 
										'choiceoneid'=>$row['choiceoneid'], 'choiceonetext'=>$row['choiceonetext'], 
										'choicetwoid'=>$row['choicetwoid'], 'choicetwotext'=>$row['choicetwotext'],
										'choicethreeid'=>$row['choicethreeid'], 'choicethreetext'=>$row['choicethreetext'],
										'choicefourid'=>$row['choicefourid'], 'choicefourtext'=>$row['choicefourtext'],
										'choicefiveid'=>$row['choicefiveid'], 'choicefivetext'=>$row['choicefivetext']);
					}
					foreach ($entries as $entry)
					{
						echo '<tr><td width="8%" rowspan="5">'.$entry['id'].'</td>';
						echo '<td width="*" rowspan="5">'.$entry['passage'].'</td>';
						if(isset($entry['choiceoneid']) && $entry['choiceoneid'] != '0')
						{
							echo '<td width="20%">'.$entry['choiceonetext'].'</td>';
							echo '<td width="8%">'.$entry['choiceoneid'].'</td>';
						}
						else
						{
							echo '<td width="20%">-</td>';
							echo '<td width="8%">-</td>';
						}
						echo '<td width="10%" rowspan="5"><a href="EditPageForm.php?title='.$title.'&id='.$entry['id'].'">Edit</a></td>';
						if($entry['id'] == $firstpageid)
						{
							echo '<td width="10%" rowspan="5">Your First Page cannot be Deleted.</td></tr>';
						}
						else
						{
							echo '<td width="10%" rowspan="5"><a href="DeletePage.php?title='.$title.'&id='.$entry['id'].'">Delete</a></td></tr>';
						}
						if(isset($entry['choicetwoid']) && $entry['choicetwoid'] != '0')
						{
							echo '<tr><td width="20%">'.$entry['choicetwotext'].'</td>';
							echo '<td width="8%">'.$entry['choicetwoid'].'</td></tr>';
						}
						else
						{
							echo '<td width="20%">-</td>';
							echo '<td width="8%">-</td></tr>';
						}
						if(isset($entry['choicethreeid']) && $entry['choicethreeid'] != '0')
						{
							echo '<tr><td width="20%">'.$entry['choicethreetext'].'</td>';
							echo '<td width="8%">'.$entry['choicethreeid'].'</td></tr>';
						}
						else
						{
							echo '<td width="20%">-</td>';
							echo '<td width="8%">-</td></tr>';
						}
						if(isset($entry['choicefourid']) && $entry['choicefourid'] != '0')
						{
							echo '<tr><td width="20%">'.$entry['choicefourtext'].'</td>';
							echo '<td width="8%">'.$entry['choicefourid'].'</td></tr>';
						}
						else
						{
							echo '<td width="20%">-</td>';
							echo '<td width="8%">-</td></tr>';
						}
						if(isset($entry['choicefiveid']) && $entry['choicefiveid'] != '0')
						{
							echo '<tr><td width="20%">'.$entry['choicefivetext'].'</td>';
							echo '<td width="8%">'.$entry['choicefiveid'].'</td></tr>';
						}
						else
						{
							echo '<td width="20%">-</td>';
							echo '<td width="8%">-</td></tr>';
						}
					}
					echo '</table><h4 align="center"><a href="CreatePageForm.php?title='.$title.'">Create a New Page!</a></h4>'; 
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