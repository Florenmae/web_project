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
			<h1> About us</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>about</span>
		</div>
		<!-- <div class="about-category">
			<div class="box">
				<img src="image/choeshirt.png">
				<div class="detail">
					<span>MMSU MECH</span>
					<h1>COE SHIRT</h1>
					<a href="shop.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="image/choeshirt.png">
				<div class="detail">
					<span>MMSU MECH</span>
					<h1>MCOE SHIRT</h1>
					<a href="shop.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="image/choeshirt.png">
				<div class="detail">
					<span>MMSU MECH</span>
					<h1>COE SHIRT</h1>
					<a href="shop.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="image/mmsu.jpg">
				<div class="detail">
					<span>MMSU MECH</span>
					<h1>COE SHIRT</h1>
					<a href="shop.php" class="btn">shop now</a>
				</div>
			</div>
		</div> -->
		<section class="services">
			<div class="title">
				<img src="image/logo2.png" class="logo">
				<h1>Why choose us</h1>
			</div>
			<div class="box-container">
				<div class="box">
					<img src="image/cheap.png">
					<div class="detail">
						<h3>CHEAP AND AFFORDABLE</h3>
						<p>Our products are cheap and affordable so everyone can enjoy our quality services.</p>
					</div>
				</div>
				<div class="box">
					<img src="image/hq.png">
					<div class="detail">
						<h3>BEST QUALITY</h3>
						<p>We offer only the finest quality at various price points.  We do not sell throw away items!</p>
					</div>
				</div>
				<div class="box">
					<img src="image/deliver.png">
					<div class="detail">
						<h3>TIMELY SHIPPING</h3>
						<p>Our shipping service will deliver your products right on time. We also do rush shipping for emergencies.</p>
					</div>
				</div>
				<div class="box">
					<img src="image/team4.png">
					<div class="detail">
						<h3>DEDICATED PERSONNEL</h3>
						<p>Our team aims to provide full customer satisfaction. We are ready to help our customers at anytime.</p>
					</div>
				</div>
				<!-- <div class="box">
					<img src="image/support.png">
					<div class="detail">
						<h3>SUPPORT</h3>
						<p>Customer support is very important to us. We're here to help!</p>
					</div>
				</div> -->
			</div>
		</section>
		<div class="team">
			<div class="title">
				<h1>Our Workable Team</h1>
			</div>
			<div class="row">
				<div class="box">
					<div class="img-box">
						<img src="image/logo2.png" width="280" height="150">
					</div>
					<div class="detail">
						<span>BSCS 2A</span>
						<h4>POWERPUFF GIRLS  Floren Mae Magulod</h4>
						<div class="icons">
							<i class="bi bi-facebook"></i>
							<i class="bi bi-messenger"></i>
							<i class="bi bi-instagram"></i>
							<i class="bi bi-twitter"></i>
						</div>
					</div>
				</div>

				<div class="box">
					<div class="img-box">
						<img src="image/logo2.png" width="280" height="150">
					</div>
					<div class="detail">
						<span>BSCS 2A</span>
						<h4>POWERPUFF GIRLS  Eleina Bumanglag</h4>
						<div class="icons">
							<i class="bi bi-facebook"></i>
							<i class="bi bi-messenger"></i>
							<i class="bi bi-instagram"></i>
							<i class="bi bi-twitter"></i>
						</div>
					</div>
				</div>

				<div class="box">
					<div class="img-box">
						<img src="image/logo2.png" width="280" height="150">
					</div>
					<div class="detail">
						<span>BSCS 2A</span>
						<h4>POWERPUFF GIRLS  Jennica Lucero</h4>
						<div class="icons">
							<i class="bi bi-facebook"></i>
							<i class="bi bi-messenger"></i>
							<i class="bi bi-instagram"></i>
							<i class="bi bi-twitter"></i>
						</div>
					</div>
				</div>

				<div class="box">
					<div class="img-box">
						<img src="image/logo2.png" width="280" height="150">
					</div>
					<div class="detail">
						<span>BSCS 2A</span>
						<h4>POWERPUFF GIRLS  Shelzy Bareng</h4>
						<div class="icons">
							<i class="bi bi-facebook"></i>
							<i class="bi bi-messenger"></i>
							<i class="bi bi-instagram"></i>
							<i class="bi bi-twitter"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php include 'components/footer.php'; ?>
	</div>
		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js">
	</script>
	<?php include 'components/alert.php'; ?>

</body>
</html>