<?php
include'components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}

	?>

<style type="text/css">
	<?php include'style.css'; ?>
</style>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
	
	<title>MMSU MERCH</title>
</head>
<body>
	<?php include 'components/header.php'; ?>

	<div class="main">
		<div class="banner">
			<h1>Product Detail</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>Shop</span>
		</div>

		<section class="view_product">
			<h1 class="title">Shop our best seller!</h1>

			<?php
				if(isset($message)){
					foreach($message as $message){
						echo '
							<div class="message">
								<span>'.$message.'</span>
								<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
							</div>

						';
					}
				}
			?>
				<?php 
					if (isset($_GET['pid'])) {
						$pid = $_GET['pid'];
						$select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');

						if(mysqli_num_rows($select_products) > 0){
							while($fetch_products = mysqli_fetch_assoc($select_products)){


				?>
				<form method="post">
					<img src="image/<?php echo $fetch_products['image']; ?>">
					<div class="detail">
						<div class="price"><?php echo $fetch_products['price'] ;?></div>
						<div class="name"><?php echo $fetch_products['name'] ;?></div>
						<div class="detail"><?php echo $fetch_products['product_detail'] ;?></div>
						<input type="hidden" name="product_id" value=" <?php echo $fetch_products['id']; ?>">
						<input type="hidden" name="product_name" value=" <?php echo $fetch_products['name']; ?>">
						<input type="hidden" name="product_price" value=" <?php echo $fetch_products['price']; ?>">
						<input type="hidden" name="product_image" value=" <?php echo $fetch_products['image']; ?>">
						
						<div class="flex">
							<a href="view_product.php?pid=<?php echo $fetch_products['pid']; ?>" class="btn">buy now</a>
							<button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
							<input type="number" name="product_quantity" value="1" min="1" class="quantity">
							<button type="submit" name="add_to_cart" class="bi bi-cart"></button>
						</div>
					</div>

				</form>

				<?php
							}
						}
					}
						
				?>

	
	</section>

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>