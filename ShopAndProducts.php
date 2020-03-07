<?php
	include('config/db_connect.php');

	//if(isset($_GET['id'])){
		//$id = mysqli_real_escape_string($conn, $_GET['id']);

		$sql = "SELECT s.Shop_Name, pc.PC_Type, p.Product_Name FROM ";
    	$sql = $sql."shop AS s, product_category AS pc, products AS p, shop_category_product AS scp WHERE ";
    	$sql = $sql."s.Shop_id = scp.Shop_id AND pc.PC_id = scp.PC_id AND p.Product_id = scp.Product_id";
    	//print_r($sql);
		$results = mysqli_query($conn,$sql);

		$shopping = mysqli_fetch_assoc($results);

		mysqli_free_result($results);
		mysqli_close($conn);
		//print_r($shopping);
	//}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Shopping Page</title>
</head>
<body>
<?php include('templates/header.php'); ?>
	<div class="container center grey-text">
		<?php if($shopping): ?>
			<h4><?php echo htmlspecialchars($shopping['Shop_Name']); ?></h4>
			<p>Category <?php echo htmlspecialchars($shopping['PC_Type']); ?></p>
			<h5>Products: </h5>
			<p><?php echo htmlspecialchars($shopping['Product_Name']); ?></p>
			<!-- Delete Form -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $shopping['id'] ?>">
			<!--	<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0"> -->
			</form>	
		<?php else: ?>
				<h5> Shops are Empty </h5>
		<?php endif; ?>
	</div>
<?php include('templates/footer.php'); ?>
</body>
</html>