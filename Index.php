<?php 

// MySQLi or PDO

include('config/db_connect.php');

	$sql = "SELECT scp.scp_id, s.Shop_Name, pc.PC_Type, p.Product_Name FROM ";
	$sql = $sql."shop AS s, product_category AS pc, products AS p, shop_category_product AS scp WHERE ";
	$sql = $sql."s.Shop_id = scp.Shop_id AND pc.PC_id = scp.PC_id AND p.Product_id = scp.Product_id and quantity > 0";
	$sql = $sql." order by s.Shop_Name, pc.PC_Type";

	// Make query to get data
	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'Error in query'.mysqli_error($conn);
	}

	// fetch result into array
	$shops = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free result from memory
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text"> Shoppers Stop! </h4>

	<div class="container">		
		<?php $last_shop_name = $last_cat_name = ""; ?>
		<table>
		<?php foreach ($shops as $shop): ?>				
			<tr>
				<td>
					<div class="card-content center">	
						<?php 
							if (strcmp($last_shop_name,$shop['Shop_Name']) != 0 ) {
								echo htmlspecialchars($shop['Shop_Name']); 
								$last_cat_name = "";
							}
						?>				
					</div>	
				</td>
				<td>
					<div class="card-content center">
						<?php if (strcmp($last_cat_name,$shop['PC_Type']) != 0 ) { 
								echo htmlspecialchars($shop['PC_Type']); 
							}
						?>	
					</div>
				</td>
				<td>
					<div class="card-content center">	
							<?php echo htmlspecialchars($shop['Product_Name']) ?>			
					</div>
				</td>	
				<td>
						<a class="brand-text" href="details.php?id=<?php echo $shop['scp_id'] ?>">More Info</a>
				</td>
			</tr>					
			<?php	$last_shop_name = $shop['Shop_Name']; 
					$last_cat_name = $shop['PC_Type'];
			endforeach; ?>
		</table>
	</div>

	<?php include('templates/footer.php'); ?>

</html>