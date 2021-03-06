<html>
	<head>
		<title>Gamebook | Registration</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<?php
			date_default_timezone_set('Asia/Singapore');
		?>
		<script type = "text/javascript">
			function validateForm()
			{
				var username = document.forms["register"]["username"].value;
				var email = document.forms["register"]["email"].value;
				var password = document.forms["register"]["password"].value;
				var password2 = document.forms["register"]["password2"].value;
				var name = document.forms["register"]["name"].value;
				var genderm = document.getElementById("male").checked;
				var genderf = document.getElementById("female").checked;
				var day = document.forms["register"]["day"].value;
				var month = document.forms["register"]["month"].value;
				var year = document.forms["register"]["year"].value;
				if (username==null || username=="" || username.length < 4)
				{
					alert("Please enter a Username which has a Length between 4-20 Characters!");
					return false;
				}
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
			<h2>Register</h2> 
			<p>To register with us, please fill in the online form below. All fields are required.</p>    
			<form name="register" action="Registration.php" onsubmit="return validateForm()" method="post">
				<fieldset>
					<legend>Login Requirements</legend>
					<table>
						<tr>
							<td width="40%">Username :</td>
							<td width="50%"><input type="text" size="30" name="username" maxlength="20" /></td>
						</tr>
						<tr>
							<td width="40%">Email :</td>  
							<td width="50%"><input type="email" size="30" name="email" maxlength="100" /></td>  
						</tr>
						<tr>
							<td width="40%">Password :</td>
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
							<td width="50%"><input type="text" size="30" name="name" maxlength="100" /></td>
						</tr>
						<tr>
							<td width="40%">Gender :</td>
							<td width="50%">
								<input type="radio" name="gender" id="male" value="Male"/> Male
								<input type="radio" name="gender" id="female" value="Female"/> Female
							</td>
						</tr>
						<tr>
							<td width="40%">Date Of Birth :</td>
							<td width="50%">
								<select name="day" id="day">
									<script type="text/javascript">
										var selectDate = document.getElementById("day");
										var i = 1;
										while(i <= 31)
										{
											selectDate.options[selectDate.options.length] = new Option(i, i);
											i = i+1;
										}
									</script>
								</select>
								<select name="month" id="month" />
									<option selected="selected" value="1">Jan</option>
									<option value="2">Feb</option>
									<option value="3">Mar</option>
									<option value="4">Apr</option>
									<option value="5">May</option>
									<option value="6">Jun</option>
									<option value="7">Jul</option>
									<option value="8">Aug</option>
									<option value="9">Sept</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
								<select name="year" id="year" />
									<script type="text/javascript">
										var selectYear = document.getElementById("year");
										var year = <?php echo Date(Y); ?>;
										var end = year - 150;
										while(year >= end)
										{
											selectYear.options[selectYear.options.length] = new Option(year, year);
											year = year - 1;
										}
									</script>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<p align="center"><input type="submit" value="Submit" /></p>
			</form>
		</div>
	</body>
</html>