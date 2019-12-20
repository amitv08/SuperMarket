<html>
<head>
	<style type="text/css">
			.error {
	    	color: #FF0000;
		}
	</style>
</head>
<body>
	<?php
	// define variables and initialize with empty values
	//$fnameErr = $emailErr = $genderErr = $usrnameErr = $passwordErr = $cpasswordErr = "";
	include('config/db_connect.php');
	$fname = $email = $gender = $usrname = $password = $cpassword = "";
	$errors = array('fname' => '', 'email' => '', 'gender' => '','usrname' => '', 'password' => '', 'cpassword' => '');
	$favFruit = array();

		if(isset($_POST['submit'])){ 

		    if (empty($_POST["fname"])) {
		        $errors['fname'] = "First Name can not be Empty";
		    }
		    else {
		        $fname = $_POST["fname"];
		        if(!preg_match('/^[a-zA-Z]+$/', $fname)){
					$errors['fname'] = 'First Name must be letters only';
				}
		    }

		    if (empty($_POST["email"])) {
		        $errors['email'] = "An email is required";
		    }
		    else {
		        $email = $_POST["email"];
		        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$errors['email'] = 'Email must be a valid email address';
				}
		    }

		    if (!isset($_POST["gender"])) {
		        $errors['gender'] = "You must select 1 option";
		    }
		    else {
		        $gender = $_POST["gender"];
		    }

		    if (empty($_POST["usrname"])) {
		        $errors['usrname'] = "User Name cann't be Empty";
		    }
		    else {
		        $usrname = $_POST["usrname"];
		        if(!preg_match('/^[\w-]+$/', $usrname)){
					$errors['usrname'] = 'User Name must be valid';
		        }
		    }

		    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) 
		    {
		    	$password = test_input($_POST["password"]);
		    	$cpassword = test_input($_POST["cpassword"]);
		    	if (strlen($_POST["password"]) <= '8') {
		        	$errors['password'] = "Your Password Must Contain At Least 8 Characters!";
		    	}
		    	elseif(!preg_match("#[0-9]+#",$password)) {
		        	$$errors['password'] = "Your Password Must Contain At Least 1 Number!";
		    	}
		    	elseif(!preg_match("#[A-Z]+#",$password)) {
		        	$errors['password'] = "Your Password Must Contain At Least 1 Capital Letter!";
		    	}
		    	elseif(!preg_match("#[a-z]+#",$password)) {
		        	$errors['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
		    	}
			}
			elseif(!empty($_POST["password"])) {
		    	$errors['cpassword'] = "Please Check You've Entered Or Confirmed Your Password!";
			} else {
		     	$errors['password'] = "Please enter password   ";
			}

			if(array_filter($errors)){
			// echo	
			} else {
				$fname = mysqli_real_escape_string($conn,$_POST['fname']);
				//$lname = mysqli_real_escape_string($conn,$_POST['lname']);
				//$bdate = mysqli_real_escape_string($conn,$_POST['bdate']);
				$email = mysqli_real_escape_string($conn,$_POST['email']);
				$gender = mysqli_real_escape_string($conn,$_POST['gender']);
				$usrname = mysqli_real_escape_string($conn,$_POST['usrname']);
				$password = mysqli_real_escape_string($conn,$_POST['password']);
				$sql = "INSERT INTO book_usrs (FirstName, Email, Gender, UserName, Passwd) VALUES ('$fname','$email','$gender','$usrname','$password')";
				echo $sql;
				if(mysqli_query($conn, $sql)){
					header('Location: index.php');
				} else {
					echo 'Query error: '.mysqli_error($conn);
				}	
			}
		}

	/*Each $_POST variable with be checked by the function*/
		function test_input($data) {
		     $data = trim($data);
		     $data = stripslashes($data);
		     $data = htmlspecialchars($data);
		     return $data;
		}
	?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table>
		<tr><td align="right">First Name*:</td>
			<td>
				<input type="" name="fname" value="<?php echo htmlspecialchars($fname);?>">
				<span class="error"><?php echo $errors['fname'];?></span> 
			</td>
		</tr>
		<tr><td align="right">Last Name:</td><td><input type="" name="lname"></td></tr>
		<tr><td align="right">Birth Date:</td><td><input type="" name="bdate"></td></tr>
		<tr><td align="right">Email*:</td>
			<td><input type="" name="email" value="<?php echo htmlspecialchars($email);?>">
				<span class="error"><?php echo $errors['email'];?></span>
			</td>
		</tr>
		<tr><td align="right">Gender*:</td>
			<td>
				Male <input type="radio" name="gender" value="M">
				Female <input type="radio" name="gender" value="F">
				Others <input type="radio" name="gender" value="O">
				<span class="error"><?php echo $errors['gender'];?></span>
			</td>
		</tr>
		<tr><td align="right">UserName*:</td>
			<td><input type="" name="usrname" value="<?php echo htmlspecialchars($usrname);?>">
				<span class="error"><?php echo $errors['usrname'];?></span> 
			</td>
		</tr>
		<tr><td align="right">Password* (8 characters minimum):</td>
			<td><input type="Password" minlength=8 name="password" value="<?php echo htmlspecialchars($password);?>">
				<span class="error"><?php echo $errors['password'];?></span> 
			</td>
		</tr>
		<tr><td align="right">Re-Enter Password:</td>
			<td><input type="Password" minlength=8 name="cpassword" value="<?php echo htmlspecialchars($cpassword);?>">
				<span class="error"><?php echo $errors['cpassword'];?></span> 
			</td>
		</tr>
		<tr><td><input type="submit" name="submit" value="Submit"></td>
			<td><input type="reset" name="cancel" value="Cancel"></td></tr>
	</table>
	</form>
</body>
</html>