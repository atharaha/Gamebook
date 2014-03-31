<html>
	<head>
		<title>Gamebook | Create Story</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script type = "text/javascript">
			function validateForm()
			{
				var title = document.forms["create"]["title"].value;
				var description = document.forms["create"]["description"].value;
				if (title==null || title=="")
				{
					alert("Please enter a Title for your Story!");
					return false;
				}
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
					$author = $_SESSION['username'];
			?>
			<h2>Create Story</h2> 
			<h4>Username : <?php echo $author ?></h4> 
			<p>To create a story, please fill in the online form below. All fields are required.</p>    
			<form name="create" action="CreateStory.php" onsubmit="return validateForm()" method="post">
				<fieldset>
					<legend>Details Required</legend>
					<table>
						<tr>
							<td width="40%">Title :</td>
							<td width="50%"><input type="text" size="30" name="title" maxlength="50" /></td>
						</tr>
						<tr>
							<td width="40%">Description :</td>  
							<td width="50%"><textarea rows="25" cols="70" name="description" maxlength="2000"></textarea></td>  
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