<html>
	<head>
		<title>Gamebook | Edit Page</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script type = "text/javascript">
			function validateForm()
			{
				var passage = document.forms["edit"]["passage"].value;
				if (passage==null || passage=="")
				{
					alert("Please enter the Passage for this Page!");
					return false;
				}
			}
			function checkone()
			{
				if(document.forms["edit"]["choiceonecheck"].checked == false)
				{
					document.getElementById('choiceoneid').disabled = true;
					document.forms["edit"]["choiceonetext"].disabled = true;
				}
				else
				{
					document.getElementById('choiceoneid').disabled = false;
					document.forms["edit"]["choiceonetext"].disabled = false;
				}
			}
			function checktwo()
			{
				if(document.forms["edit"]["choicetwocheck"].checked == false)
				{
					document.getElementById('choicetwoid').disabled = true;
					document.forms["edit"]["choicetwotext"].disabled = true;
				}
				else
				{
					document.getElementById('choicetwoid').disabled = false;
					document.forms["edit"]["choicetwotext"].disabled = false;
				}
			}
			function checkthree()
			{
				if(document.forms["edit"]["choicethreecheck"].checked == false)
				{
					document.getElementById('choicethreeid').disabled = true;
					document.forms["edit"]["choicethreetext"].disabled = true;
				}
				else
				{
					document.getElementById('choicethreeid').disabled = false;
					document.forms["edit"]["choicethreetext"].disabled = false;
				}
			}
			function checkfour()
			{
				if(document.forms["edit"]["choicefourcheck"].checked == false)
				{
					document.getElementById('choicefourid').disabled = true;
					document.forms["edit"]["choicefourtext"].disabled = true;
				}
				else
				{
					document.getElementById('choicefourid').disabled = false;
					document.forms["edit"]["choicefourtext"].disabled = false;
				}
			}
			function checkfive()
			{
				if(document.forms["edit"]["choicefivecheck"].checked == false)
				{
					document.getElementById('choicefiveid').disabled = true;
					document.forms["edit"]["choicefivetext"].disabled = true;
				}
				else
				{
					document.getElementById('choicefiveid').disabled = false;
					document.forms["edit"]["choicefivetext"].disabled = false;
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

					$id = mysqli_real_escape_string($link,$_GET['id']);
					$title = mysqli_real_escape_string($link,$_GET['title']);
					$author = $_SESSION['username'];
					
					$sql = "select * from pages where id='$id' and title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
						
					$row = mysqli_fetch_array($result);
					$entry[]= array('passage'=>$row['passage'], 
									'choiceoneid'=>$row['choiceoneid'], 'choiceonetext'=>$row['choiceonetext'], 
									'choicetwoid'=>$row['choicetwoid'], 'choicetwotext'=>$row['choicetwotext'],
									'choicethreeid'=>$row['choicethreeid'], 'choicethreetext'=>$row['choicethreetext'],
									'choicefourid'=>$row['choicefourid'], 'choicefourtext'=>$row['choicefourtext'],
									'choicefiveid'=>$row['choicefiveid'], 'choicefivetext'=>$row['choicefivetext']);
					
					$passage = $entry[0]['passage'];
					$choiceoneid = $entry[0]['choiceoneid'];
					$choiceonetext = $entry[0]['choiceonetext'];
					$choicetwoid = $entry[0]['choicetwoid'];
					$choicetwotext = $entry[0]['choicetwotext'];
					$choicethreeid = $entry[0]['choicethreeid'];
					$choicethreetext = $entry[0]['choicethreetext'];
					$choicefourid = $entry[0]['choicefourid'];
					$choicefourtext = $entry[0]['choicefourtext'];
					$choicefiveid = $entry[0]['choicefiveid'];
					$choicefivetext = $entry[0]['choicefivetext'];
					
					$sql = "select id from pages where title='$title' and author='$author'";
					$result = mysqli_query($link, $sql);
					
			?>
			<h2>Edit Page</h2> 
			<h4>Username : <?php echo $author ?></h4> 
			<h4>Title : <?php echo $title; ?></h4> 
			<h4>Page No. : <?php echo $id; ?></h4> 
			<p>To edit a page, please fill in the online form below. The Passage is required, Choices are Optional.</p>    
			<form name="edit" action="EditPage.php?title=<?php echo $title.'&id='.$id; ?>" onsubmit="return validateForm()" method="post">
				<fieldset>
					<legend>Details Required</legend>
					<table>
						<tr>
							<td width="40%">Passage :</td>
							<td width="50%"><textarea rows="25" cols="70" name="passage" maxlength="20000"><?php echo $passage; ?></textarea></td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Choice 1</legend>
					<table>
						<tr>
							<td width="40%">Use :</td>
							<td width="50%">
								<?php
									if(isset($choiceoneid) && $choiceoneid != '0')
									{
										echo '<input type="checkbox" name="choiceonecheck" value="YES" checked="yes" onchange="checkone()">';
									}
									else
									{
										echo '<input type="checkbox" name="choiceonecheck" value="YES" onchange="checkone()">';
									}
								?>
							</td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%">
								<?php
									if(isset($choiceoneid) && $choiceoneid != '0')
									{
										echo '<textarea rows="5" cols="70" name="choiceonetext" maxlength="200">'.$choiceonetext.'</textarea>';
									}
									else
									{
										echo '<textarea rows="5" cols="70" name="choiceonetext" maxlength="200" disabled></textarea>';
									}
								?>	
							</td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<?php
									if(isset($choiceoneid) && $choiceoneid != '0')
									{
										echo '<select name="choiceoneid" id="choiceoneid">';
									}
									else
									{
										echo '<select name="choiceoneid" id="choiceoneid" disabled>';
									}
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										if($choiceoneid == $entry['id'])
										{
											echo '<option selected="selected" value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
										else
										{
											echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
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
							<td width="50%">
								<?php
									if(isset($choicetwoid) && $choicetwoid != '0')
									{
										echo '<input type="checkbox" name="choicetwocheck" value="YES" checked="yes" onchange="checktwo()">';
									}
									else
									{
										echo '<input type="checkbox" name="choicetwocheck" value="YES" onchange="checktwo()">';
									}
								?>
							</td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%">
								<?php
									if(isset($choicetwoid) && $choicetwoid != '0')
									{
										echo '<textarea rows="5" cols="70" name="choicetwotext" maxlength="200">'.$choicetwotext.'</textarea>';
									}
									else
									{
										echo '<textarea rows="5" cols="70" name="choicetwotext" maxlength="200" disabled></textarea>';
									}
								?>	
							</td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<?php
									if(isset($choicetwoid) && $choicetwoid != '0')
									{
										echo '<select name="choicetwoid" id="choicetwoid">';
									}
									else
									{
										echo '<select name="choicetwoid" id="choicetwoid" disabled>';
									}
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										if($choicetwoid == $entry['id'])
										{
											echo '<option selected="selected" value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
										else
										{
											echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
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
							<td width="50%">
								<?php
									if(isset($choicethreeid) && $choicethreeid != '0')
									{
										echo '<input type="checkbox" name="choicethreecheck" value="YES" checked="yes" onchange="checkthree()">';
									}
									else
									{
										echo '<input type="checkbox" name="choicethreecheck" value="YES" onchange="checkthree()">';
									}
								?>
							</td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%">
								<?php
									if(isset($choicethreeid) && $choicethreeid != '0')
									{
										echo '<textarea rows="5" cols="70" name="choicethreetext" maxlength="200">'.$choicethreetext.'</textarea>';
									}
									else
									{
										echo '<textarea rows="5" cols="70" name="choicethreetext" maxlength="200" disabled></textarea>';
									}
								?>	
							</td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<?php
									if(isset($choicethreeid) && $choicethreeid != '0')
									{
										echo '<select name="choicethreeid" id="choicethreeid">';
									}
									else
									{
										echo '<select name="choicethreeid" id="choicethreeid" disabled>';
									}
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										if($choicethreeid == $entry['id'])
										{
											echo '<option selected="selected" value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
										else
										{
											echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
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
							<td width="50%">
								<?php
									if(isset($choicefourid) && $choicefourid != '0')
									{
										echo '<input type="checkbox" name="choicefourcheck" value="YES" checked="yes" onchange="checkfour()">';
									}
									else
									{
										echo '<input type="checkbox" name="choicefourcheck" value="YES" onchange="checkfour()">';
									}
								?>
							</td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%">
								<?php
									if(isset($choicefourid) && $choicefourid != '0')
									{
										echo '<textarea rows="5" cols="70" name="choicefourtext" maxlength="200">'.$choicefourtext.'</textarea>';
									}
									else
									{
										echo '<textarea rows="5" cols="70" name="choicefourtext" maxlength="200" disabled></textarea>';
									}
								?>	
							</td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<?php
									if(isset($choicefourid) && $choicefourid != '0')
									{
										echo '<select name="choicefourid" id="choicefourid">';
									}
									else
									{
										echo '<select name="choicefourid" id="choicefourid" disabled>';
									}
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										if($choicefourid == $entry['id'])
										{
											echo '<option selected="selected" value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
										else
										{
											echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
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
							<td width="50%">
								<?php
									if(isset($choicefiveid) && $choicefiveid != '0')
									{
										echo '<input type="checkbox" name="choicefivecheck" value="YES" checked="yes" onchange="checkfive()">';
									}
									else
									{
										echo '<input type="checkbox" name="choicefivecheck" value="YES" onchange="checkfive()">';
									}
								?>
							</td>
						</tr>
						<tr>
							<td width="40%">Text :</td>
							<td width="50%">
								<?php
									if(isset($choicefiveid) && $choicefiveid != '0')
									{
										echo '<textarea rows="5" cols="70" name="choicefivetext" maxlength="200">'.$choicefivetext.'</textarea>';
									}
									else
									{
										echo '<textarea rows="5" cols="70" name="choicefivetext" maxlength="200" disabled></textarea>';
									}
								?>	
							</td>
						</tr>
						<tr>
							<td width="40%">Page No. :</td>
							<td width="50%">
								<?php
									if(isset($choicefiveid) && $choicefiived != '0')
									{
										echo '<select name="choicefiveid" id="choicefiveid">';
									}
									else
									{
										echo '<select name="choicefiveid" id="choicefiveid" disabled>';
									}
									while ($row = mysqli_fetch_array($result))
									{
										$entries[]= array('id'=>$row['id']);
									}
									foreach ($entries as $entry)
									{
										if($choicefiveid == $entry['id'])
										{
											echo '<option selected="selected" value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
										else
										{
											echo '<option value="'.$entry['id'].'">'.$entry['id'].'</option>';
										}
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
				mysqli_close($link);
			?>
		</div>
	</body>
</html>