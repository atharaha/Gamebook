<html>
	<head>
		<title>Gamebook | Create Page</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script type = "text/javascript">
			function validateForm()
			{
				var passage = document.forms["create"]["passage"].value;
				if (passage==null || passage=="")
				{
					alert("Please enter the Passage for this Page!");
					return false;
				}
			}
			function checkone()
			{
				if(document.forms["create"]["choiceonecheck"].checked == false)
				{
					document.getElementById('choiceoneid').disabled = true;
					document.forms["create"]["choiceonetext"].disabled = true;
				}
				else
				{
					document.getElementById('choiceoneid').disabled = false;
					document.forms["create"]["choiceonetext"].disabled = false;
				}
			}
			function checktwo()
			{
				if(document.forms["create"]["choicetwocheck"].checked == false)
				{
					document.getElementById('choicetwoid').disabled = true;
					document.forms["create"]["choicetwotext"].disabled = true;
				}
				else
				{
					document.getElementById('choicetwoid').disabled = false;
					document.forms["create"]["choicetwotext"].disabled = false;
				}
			}
			function checkthree()
			{
				if(document.forms["create"]["choicethreecheck"].checked == false)
				{
					document.getElementById('choicethreeid').disabled = true;
					document.forms["create"]["choicethreetext"].disabled = true;
				}
				else
				{
					document.getElementById('choicethreeid').disabled = false;
					document.forms["create"]["choicethreetext"].disabled = false;
				}
			}
			function checkfour()
			{
				if(document.forms["create"]["choicefourcheck"].checked == false)
				{
					document.getElementById('choicefourid').disabled = true;
					document.forms["create"]["choicefourtext"].disabled = true;
				}
				else
				{
					document.getElementById('choicefourid').disabled = false;
					document.forms["create"]["choicefourtext"].disabled = false;
				}
			}
			function checkfive()
			{
				if(document.forms["create"]["choicefivecheck"].checked == false)
				{
					document.getElementById('choicefiveid').disabled = true;
					document.forms["create"]["choicefivetext"].disabled = true;
				}
				else
				{
					document.getElementById('choicefiveid').disabled = false;
					document.forms["create"]["choicefivetext"].disabled = false;
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
					date_default_timezone_set('Asia/Singapore');
					
					$server_username = 'root';
					$server_password = '1002';
					$server_host = 'localhost';
					$server_database = 'gamebook';

					$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);

					$title = mysqli_real_escape_string($link,$_GET['title']);
					$author = $_SESSION['username'];
					
					$sql = "select id from pages where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
					
			?>
			<h2>Create Page</h2> 
			<h4>Username : <?php echo $author ?></h4> 
			<h4>Title : <?php echo $title; ?></h4> 
			<p>To create a page, please fill in the online form below. The Passage is required, Choices are Optional.</p>    
			<form name="create" action="CreatePage.php?title=<?php echo $title; ?>" onsubmit="return validateForm()" method="post">
				<fieldset>
					<legend>Details Required</legend>
					<table>
						<tr>
							<td width="40%">Passage :</td>
							<td width="50%"><textarea rows="25" cols="70" name="passage" maxlength="20000"></textarea></td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Choice 1</legend>
					<table>
						<tr>
							<td width="40%">Use :</td>
							<td width="50%"><input type="checkbox" name="choiceonecheck" value="YES" onchange="checkone()"></td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%"><textarea rows="5" cols="70" name="choiceonetext" maxlength="200" disabled></textarea></td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<select name="choiceoneid" id="choiceoneid" disabled>
								<?php
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
									}
								?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Choice 2</legend>
					<table>
						<tr>
							<td width="40%">Use :</td>
							<td width="50%"><input type="checkbox" name="choicetwocheck" value="YES" onchange="checktwo()"></td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%"><textarea rows="5" cols="70" name="choicetwotext" maxlength="200" disabled></textarea></td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<select name="choicetwoid" id="choicetwoid" disabled>
								<?php
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
									}
								?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Choice 3</legend>
					<table>
						<tr>
							<td width="40%">Use :</td>
							<td width="50%"><input type="checkbox" name="choicethreecheck" value="YES" onchange="checkthree()"></td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%"><textarea rows="5" cols="70" name="choicethreetext" maxlength="200" disabled></textarea></td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<select name="choicethreeid" id="choicethreeid" disabled>
								<?php
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
									}
								?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Choice 4</legend>
					<table>
						<tr>
							<td width="40%">Use :</td>
							<td width="50%"><input type="checkbox" name="choicefourcheck" value="YES" onchange="checkfour()"></td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%"><textarea rows="5" cols="70" name="choicefourtext" maxlength="200" disabled></textarea></td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<select name="choicefourid" id="choicefourid" disabled>
								<?php
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
									}
								?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Choice 5</legend>
					<table>
						<tr>
							<td width="40%">Use :</td>
							<td width="50%"><input type="checkbox" name="choicefivecheck" value="YES" onchange="checkfive()"></td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%"><textarea rows="5" cols="70" name="choicefivetext" maxlength="200" disabled></textarea></td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<select name="choicefiveid" id="choicefiveid" disabled>
								<?php
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
									}
								?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<p align="center"><input type="submit" value="Submit" /></p>
			</form>
			<?php
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