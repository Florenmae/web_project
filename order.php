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

	if (isset($_POST['submit-btn'])) {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$number = mysqli_real_escape_string($conn, $_POST['number']);
		$message = mysqli_real_escape_string($conn, $_POST['message']);

		$select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email='$email' AND number= '$number' AND message = '$message'") or die('query failed');

		if (mysqli_num_rows($select_message) > 0) {
			echo 'message sent';
		}else{
			mysqli_query($conn, "INSERT INTO `message`(`user_id`, `name`, `email`, `number`, `message`) VALUES('$user_id', '$name', '$email', '$number', '$message')") or die('query failed');
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
	<title>MMSU MERCH</title>
</head>
<body>
	<?php include 'components/header.php'; ?>

	<div class="main">
		<div class="banner">
			<h1>Track My Orders</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>Orders</span>
		</div>

		<div class="order-container">
			<div class="box-container">
				<?php 
				$select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id = '$user_id'") or die('query failed');
				if(mysqli_num_rows($select_orders)> 0){
					while($fetch_orders = mysqli_fetch_assoc($select_orders)){
				?>
				<div class="box">
					<p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?> </span></p>
					<p>name: <span><?php echo $fetch_orders['name']; ?> </span></p>
					<p>number: <span><?php echo $fetch_orders['number']; ?> </span></p>
					<p>email: <span><?php echo $fetch_orders['email']; ?> </span></p>
					<p>address: <span><?php echo $fetch_orders['address']; ?> </span></p>
					<p>payment method: <span><?php echo $fetch_orders['method']; ?> </span></p>
					<p>your order: <span><?php echo $fetch_orders['total_products']; ?> </span></p>
					<p>total price: <span><?php echo $fetch_orders['total_price']; ?> </span></p>
					<p>Payment status: <span><?php echo $fetch_orders['payment_status']; ?> </span></p>
				</div>
				<?php
						}
					}else{
							echo '
							<div class="empty">
								<p>No orders placed yet!</p>
							</div>
							';
					}
				?>
			</div>
		</div>

		

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>