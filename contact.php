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
			<h1>Contact us</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>contact us</span>
		</div>

		<!-- <section class="services">
			<div class="box-container">
				<div class="box">
					<img src="image/gift.png">
					<div class="detail">
						<h3>great quality</h3>
						<p>save 10% off every bundle order</p>
					</div>
				</div>
				<div class="box">
					<img src="image/shipping.png">
					<div class="detail">
						<h3>great quality</h3>
						<p>save 10% off every bundle order</p>
					</div>
				</div>
				<div class="box">
					<img src="image/gift.png">
					<div class="detail">
						<h3>great quality</h3>
						<p>save 10% off every bundle order</p>
					</div>
				</div>
				<div class="box">
					<img src="image/shipping.png">
					<div class="detail">
						<h3>great quality</h3>
						<p>save 10% off every bundle order</p>
					</div>
				</div>
			</div>
		</section> -->

		<div class="form-container">
			<form method="post">
				<div class="title">
					<img src="image/logo2.png" class="logo">
					<h1>Leave a message</h1>
				</div>
				<div class="input-field">
					<p>Your name<sup>*</sup></p>
					<input type="text" name="name">
				</div>
				<div class="input-field">
					<p>Your email <sup>*</sup></p>
					<input type="text" name="email">
				</div>
				<div class="input-field">
					<p>Your number <sup>*</sup></p>
					<input type="text" name="number">
				</div>
				<div class="input-field">
					<p>Your message <sup>*</sup></p>
					<textarea name="message"></textarea>
				</div>
				<button type="submit" name="submit-btn" class="btn"> send message</button>
			</form>
		</div>

		<div class="address">
				<div class="title">
					<img src="image/logo2.png" class="logo">
					<h1>Contact detail</h1>
					<p>Bachelor of Science in Computer Science --- Final Project </p>
				</div>
				<div class="box-container">
					<div class="box">
						<i class="bx bxs-map-pin"></i>
						<div>
							<h4>address</h4>
							<p>Quiling sur Batac City</p>
						</div>
					</div>
					<div class="box">
						<i class="bx bxs-phone-call"></i>
						<div>
							<h4>phone number</h4>
							<p>+63 906 091 8786</p>
						</div>
					</div>
					<div class="box">
						<i class="bx bxs-map-pin"></i>
						<div>
							<h4>email</h4>
							<p>magulodren@gmail.com</p>
						</div>
					</div>
				</div>
			</div>

		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>