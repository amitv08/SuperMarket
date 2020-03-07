<?php
	include('config/db_connect.php');
	$userexists = [];

	if(isset($_POST['uname'])){
		$usr = mysqli_real_escape_string($conn, $_POST['uname']);
		$passwd = mysqli_real_escape_string($conn, $_POST['psw']);

		$sql = "select * from Shopper where Shopper_Uname = '$usr' and Shopper_Passwd = '$passwd'";
		
		$results = mysqli_query($conn,$sql);

		$userexists = mysqli_fetch_assoc($results);

		mysqli_free_result($results);
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>
	<?php if($userexists): ?>
		Welcome <?php echo htmlspecialchars($userexists["Uname"]); ?>
		<h4><?php echo htmlspecialchars($userexists['FirstName']); ?></h4>
		<p>Created by <?php echo htmlspecialchars($userexists['Email']); ?></p>
		<p><?php echo date($userexists['Created']); ?></p>			
	<?php else: ?>		
		<form action="./index.php" method="post">
    			<img src="images/img_avatar_unisex.png" alt="Avatar" class="avatar">

		  	<div class="container">
		    	<label for="uname"><b>Username</b></label>
		    	<input type="text" placeholder="Enter Username" name="uname" required>

		    	<label for="psw"><b>Password</b></label>
		    	<input type="password" placeholder="Enter Password" name="psw" required>
		        
		    	<button type="submit">Login</button>
		    	<label> 
		    	   	<input type="checkbox" checked="checked" name="remember"> Remember me
		    	</label>
		  	</div>

		  	<div class="container" style="background-color:#f1f1f1">
		    	<button type="button" class="cancelbtn">Cancel</button>
		    	<span class="psw">Forgot <a href="#">password?</a></span>
		    	Create <a href="NewUser.php">  User </a>
		  	</div>
		</form>		
	<?php endif;?>
	<?php include('templates/footer.php'); ?>
</html>