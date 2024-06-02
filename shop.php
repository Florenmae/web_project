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

	//ADD PRODUCT TO WISHLIST
	if (isset($_POST['add_to_wishlist'])) {
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_image = $_POST['product_image'];

		$wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

		$cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

		if(mysqli_num_rows($wishlist_number) > 0 ){
			$message[] = 'product already exist in wishlist';
		}else if(mysqli_num_rows($cart_num) > 0){
			$message[] = 'product already exist in cart';
		}else{
			mysqli_query($conn, "INSERT INTO `wishlist` (`user_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')");
			$message[] = 'product successfully added in your wishlist';
		}
	}

	//ADD PRODUCT TO CART
	if (isset($_POST['add_to_cart'])) {
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_image = $_POST['product_image'];
		$product_quantity = $_POST['product_quantity'];

		$wishlist_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

		$cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

		if(mysqli_num_rows($cart_num) > 0){
			$message[] = 'product already exist in cart';
		}else{
			mysqli_query($conn, "INSERT INTO `cart` (`user_id`, `pid`, `name`, `price`, `image`, `quantity`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity')");
			$message[] = 'product successfully added in your cart';	
		}
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
	<script src="https://cdn.tailwindcss.com"></script>
	<title>MMSU MERCH</title>
</head>
<body>
	<?php include 'components/header.php'; ?>

	<div class="main">
		<div class="banner">
			<h1>SHOP</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>Our Shop</span>
		</div>

		<section class="products">
			<h1 class="title">Shop our best seller</h1>

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
					$select_products = mysqli_query($conn, "SELECT * FROM `products`") or die ('query failed');
					if (mysqli_num_rows($select_products) > 0) {
						while($fetch_products = mysqli_fetch_assoc ($select_products)){
				?>
				<form method="post" class="box">
					<img src="image/<?php echo $fetch_products['image']; ?>" class="img">
					<h3 class="name"><?php echo $fetch_products['name'] ;?></h3>
					<div class="price">Php<?php echo $fetch_products['price'] ;?></div>
					
					<input type="hidden" name="product_id" value=" <?php echo $fetch_products['id']; ?>">
					<input type="hidden" name="product_name" value=" <?php echo $fetch_products['name']; ?>">
					<input type="hidden" name="product_price" value=" <?php echo $fetch_products['price']; ?>">
					<input type="number" name="product_quantity" value="1" required min="1" value="1" max="99" maxlength="2" class="qty">
					<input type="hidden" name="product_image" value=" <?php echo $fetch_products['image']; ?>">
					<input type="hidden" name="product_id" value=" <?php echo $fetch_products['id']; ?>">

					<div class="button">
						<!-- <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="bi bi-eye-fill"></a> -->
						<button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
						<button type="submit" name="add_to_cart" class="bi bi-cart"></button>
						<!-- <a href="checkout.php?get_id=<?php echo $fetch_products['price']; ?>" class="btn">buy now</a> -->
					</div>
					<div class="flex2">
						<!-- <p class="price" name="product_price" value=" <?php echo $fetch_products['price']; ?>"></p>
						<input type="number" name="qty" value=" <?php echo $fetch_products['price']; ?>" required min="1" value="1" max="99" maxlength="2" class="qty"> -->
						<!-- <a href="cart.php?pid=<?php echo $fetch_products['id']; ?>" type="submit" name="add_to_cart" class="btn">buy now</a> -->

						<!-- <button type="submit" name="add_to_cart" class="btn"> buy now</button> -->
						<a href="checkout.php?pid=<?php echo $fetch_products['id']; ?>" class="btn" type="submit" name="add_to_cart">buy now</a>


					</div>

				</form>

				<?php
						}
					}else{
						echo '<p class="empty">no products added yet!</p>';
					}
				?>
			</div>
	
	</section>

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>