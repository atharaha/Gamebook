<html>
	<head>
		<title>Gamebook | Account Update</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<?php
			session_start();
			
			date_default_timezone_set('Asia/Singapore');
		?>
		<script type = "text/javascript">
			function validateForm()
			{
				var email = document.forms["update"]["email"].value;
				var password = document.forms["update"]["password"].value;
				var password2 = document.forms["update"]["password2"].value;
				var name = document.forms["update"]["name"].value;
				var genderm = document.getElementById("male").checked;
				var genderf = document.getElementById("female").checked;
				var day = document.forms["update"]["day"].value;
				var month = document.forms["update"]["month"].value;
				var year = document.forms["update"]["year"].value;
				if (email==null || email=="")
				{
					alert("Please enter your Email Address!");
					return false;
				}
				if (password==null || password=="" || password.length < 6)
				{
					alert("Please enter your Password which has a Length between 6-20 Characters!");
					return false;
				}
				if (password2!=password)
				{
					alert("Please Re-Enter your Password!");
					return false;
				}
				if (name==null || name=="")
				{
					alert("Please enter your Name!");
					return false;
				}
				if (genderm==false && genderf==false)
				{
					alert("Please enter your Gender!");
					return false;
				}
				if (year > <?php echo Date(Y); ?> || (year == <?php echo Date(Y); ?> && month > <?php echo Date(m); ?>) || (year == <?php echo Date(Y); ?> && month == <?php echo Date(m); ?> && day > <?php echo Date(d); ?>) || ((month == 4 || month == 6 || month == 9 || month == 11) && day > 30) || (year % 4 == 0 && month == 2 && day > 29) || (year % 4 != 0 && month == 2 && day > 28))
				{
					alert("Please enter your Date of Birth!");
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div>
			<?php
				
				if(isset($_SESSION['sign_in']) && $_SESSION['sign_in'] == True)
				{
					$server_username = 'root';
					$server_password = '1002';
					$server_host = 'localhost';
					$server_database = 'gamebook';

					$link = mysqli_connect($server_host, $server_username, $server_password, $server_database);
					
					$username = $_SESSION['username'];
					
					$sql = "select * from user_accounts where username='$username'";
					$result = mysqli_query($link, $sql);
					
					$row = mysqli_fetch_array($result);
					$entry[]= array('email'=>$row['email'], 'name'=>$row['name'], 'gender'=>$row['gender'], 'DOB'=>$row['DOB']);
					
					$email = $entry[0]['email'];
					$name = $entry[0]['name'];
					$gender = $entry[0]['gender'];
					$date = $entry[0]['DOB'];
					list($year, $month, $day) = explode("-",$date);
			?>
			<h2>Update Account Details</h2> 
			<p>To update your account details, please fill in the online form below. All fields are required.</p>    
			<form name="update" action="AccountUpdate.php" onsubmit="return validateForm()" method="post">
				<fieldset>
					<legend>Login Requirements</legend>
					<table>
						<tr>
							<td width="40%">Username :</td>
							<td width="50%"><?php echo $username; ?></td>
						</tr>
						<tr>
							<td width="40%">Email :</td>  
							<td width="50%"><input type="email" size="30" name="email" value="<?php echo $email; ?>" maxlength="100" /></td>  
						</tr>
						<tr>
							<td width="40%">Old / New Password :</td>
							<td width="50%"><input type="password" name="password" size="30" maxlength="20" /></td>
						</tr>
						<tr>
							<td width="40%">Re-Enter Password :</td>
							<td width="50%"><input type="password" name="password2" size="30" maxlength="20" /></td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
					<legend>Personal Particulars</legend>
					<table>
						<tr>
							<td width="40%">Name :</td>
							<td width="50%"><input type="text" size="30" name="name" value="<?php echo $name; ?>" maxlength="100" /></td>
						</tr>
						<tr>
							<td width="40%">Gender :</td>
							<td width="50%">
								<input type="radio" name="gender" <?php if($gender == "Male") { echo 'checked="checked"'; } ?> id="male" value="Male"/> Male
								<input type="radio" name="gender" <?php if($gender == "Female") { echo 'checked="checked"'; } ?> id="female" value="Female"/> Female
							</td>
						</tr>
						<tr>
							<td width="40%">Date Of Birth :</td>
							<td width="50%">
								<select name="day" id="day">
									<?php
										$d = 1;
										while($d <= 31)
										{
											echo '<option ';
											if($d == $day)
											{
												echo 'selected="selected" ';
											}
											echo 'value="'.$d.'">'.$d.'</option>';
											$d++;
										}
									?>
								</select>
								<select name="month" id="month" />
									<?php
										$m = 1;
										$M = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
										while($m <= 12)
										{
											echo '<option ';
											if($m == $month)
											{
												echo 'selected="selected" ';
											}
											echo 'value="'.$m.'">'.$M[$m - 1].'</option>';
											$m++;
										}
									?>
								</select>
								<select name="year" id="year" />
									<?php
										$y = Date(Y);
										$end = $y - 150;
										while($y >= $end)
										{
											echo '<option ';
											if($y == $year)
											{
												echo 'selected="selected" ';
											}
											echo 'value="'.$y.'">'.$y.'</option>';
											$y--;
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