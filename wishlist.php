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

	//ADD PRODUCT TO CART
	if (isset($_POST['add_to_cart'])) {
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_image = $_POST['product_image'];
		$product_quantity = 1;

		$wishlist_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

		$cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

		if(mysqli_num_rows($cart_num) > 0){
			$message[] = 'product already exist in cart';
		}else{
			mysqli_query($conn, "INSERT INTO `cart` (`user_id`, `pid`, `name`, `price`, `image`, `quantity`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity')");
			$message[] = 'product successfully added in your cart';
		}
	}

	if(isset($_GET['delete'])){
		$delete_id = $_GET['delete'];
		
		mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');

		header('location:wishlist.php');
	}

	if(isset($_GET['delete_all'])){
		
		mysqli_query($conn, "DELETE FROM `wishlist` WHERE $user_id = '$user_id'") or die('query failed');

		header('location:wishlist.php');
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
			<h1>Wishlist</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>Wishlist</span>
		</div>

		<section class="wishlist">
			<h1 class="title">Wishlist</h1>

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
				<div class="box-container">
					<?php 
						$grand_total = 0;
						$select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die ('query failed');
						if (mysqli_num_rows($select_wishlist) > 0) {
							while($fetch_wishlist = mysqli_fetch_assoc ($select_wishlist)){
					?>
					<form method="post" class="box">
						<img src="image/<?php echo trim($fetch_wishlist['image']);?>">
						<h3 class="name"><?php echo $fetch_wishlist['name'] ;?></h3>
						<div class="price">Php<?php echo $fetch_wishlist['price'] ;?></div>
						
						<input type="hidden" name="product_id" value=" <?php echo $fetch_wishlist['id']; ?>">
						<input type="hidden" name="product_name" value=" <?php echo $fetch_wishlist['name']; ?>">
						<input type="hidden" name="product_price" value=" <?php echo $fetch_wishlist['price']; ?>">
						<input type="number" name="product_quantity" value="1" required min="1">
						<input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">

						<div class="icon">
							<!-- <a href="view_product.php?pid=<?php echo $fetch_wishlist['id'];?>" class="bi bi-eye-fill"></a> -->

							<a href="wishlist.php?delete=<?php echo $fetch_wishlist['id'];?>" class="bi bi-trash" onclick="return confirm('Do you want to delete this product from your wishlist?')"></a>

							<button type="submit" name="add_to_cart" class="bi bi-cart"></button>

						</div>

					</form>

					<?php
							$grand_total += $fetch_wishlist['price'];
							}
						}else{
							echo '<p class="empty">no products added yet!</p>';
						}
					?>
			</div>

			<div class="wishlist_total">
				<p>Total amount payable: <span>Php <?php echo $grand_total;  ?></span> </p>
				<a href="shop.php" class="btn">Continue Shopping</a>
				<a href="wishlist.php?delete_all" class="btn <?php echo ($grand_total)?'':'disabled' ?>" onclick="return confirm('do you want to delete all items in your wishlist?')">Delete All</a>
			</div>

	
	</section>

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>