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
	<title>MMSU MERCH</title>
</head>
<body>
	<?php include 'components/header.php'; ?>

	<div class="main">
		<section class="home-section">
			<div class="slider">
				<div class="slider__slider slide1">
					<div class="overlay"></div>
					<div class="slide-details">
						<!-- <h1> MMSU MERCHANDISE</h1> -->
						<!-- <p> mariano marcos state university college of arts ans sciences and halskjdie q=wd w</p> -->
						<a href="shop.php" class="btn">Shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-------slide end----->
				<div class="slider__slider slide2">
					<div class="overlay"></div>
					<div class="slide-details">
						<!-- <h1>THE LONG WAIT IS OVER, MAROONS!</h1> -->
						<!-- <p>Presenting to you, the official College of Engineering Merch! And it's now open for reservations!</p> -->
						<a href="shop.php" class="btn">Shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-------slide end----->
				<div class="slider__slider slide3">
					<div class="overlay"></div>
					<div class="slide-details">
						<!-- <h1> MMSU MERCHANDISE</h1> -->
						<!-- <p> mariano marcos state university college of arts ans sciences and halskjdie q=wd w</p> -->
						<a href="shop.php" class="btn">Shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-------slide end----->
				<div class="slider__slider slide4">
					<div class="overlay"></div>
					<div class="slide-details">
						<!-- <h1> MMSU MERCHANDISE</h1> -->
						<!-- <p> mariano marcos state university college of arts ans sciences and halskjdie q=wd w</p> -->
						<a href="shop.php" class="btn">Shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-------slide end----->
				<div class="slider__slider slide5">
					<div class="overlay"></div>
					<div class="slide-details">
						<!-- <h1> ECOSOC Merch is finally out!</h1> -->
						<!-- <p> Show your pride for ECONOMICS through their merchandise. For only Php180.00 to  Php230.00, you can now have their economics tees and tote bags.</p> -->
						<a href="shop.php" class="btn">Shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-------slide end----->
				<div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
				<div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
			</div>
		</section>
		<!-------home end slider------>
		<section class="thumb">
			<div class="box-container">
				<div class="box">
					<img src="image/COE.png">
					<h3>COE</h3>
					<p><b>College of Engineering</b></p>
					<!--<i class="bx bxs-chevron-right"></i>-->
				</div>
				<div class="box">
					<img src="image/CAS.png">
					<h3>CAS</h3>
					<p><b>College of Arts & Sciences</b></p>
					<!--<i class="bx bxs-chevron-right"></i>-->
				</div>
				<div class="box">
					<img src="image/CTE.jpg">
					<h3>CTE</h3>
					<p><b>College of Teacher Education</b></p>
					<!--<i class="bx bxs-chevron-right"></i>-->
				</div>
				<div class="box">
					<img src="image/CBEA.png">
					<h3>CBEA</h3>
					<p><b>College of Business, Economics, and Accountancy</b></p>
					<!--<i class="bx bxs-chevron-right"></i>-->
				</div>
				<div class="box">
					<img src="image/CSIS.png">
					<h3>CCIS</h3>
					<p><b>Department of Computing and Information Sciences</b></p>
					<!--<i class="bx bxs-chevron-right"></i>-->
				</div>
			</div>
			
		</section>
		<section class="container">
			<div class="box-container">
				<div class="box">
					<img src="image/newAll.png">
					<!--<span>MMSU Merch</span>-->
				</div>
				<!-- <div class="box">
					<img src="image/mmsu1.png">
				</div> -->
			</div>
		</section>
		<section class="shop">
			<div class="title">
				<img src="image/logo2.png" width="100" height="50">
				<h1> Trending Products</h1>
			</div>
			<!-- <div class="row">
				<img src="image/wear.png">
				<div class="row-detail">
					<img src="image/mmsu5.png">
					<div class="top-footer">
						<h1>mariano marcos state university merch</h1>
					</div>
				</div>
			</div> -->
			<div class="box-container">
				<div class="box">
					<img src="image/choeshirt.png">
					<a href="shop.php" class="btn"> shop now</a>
				</div>
				<div class="box">
					<img src="image/cbea(7).jpg">
					<a href="shop.php" class="btn"> shop now</a>
				</div>
				<div class="box">
					<img src="image/cte(2).png">
					<a href="shop.php" class="btn"> shop now</a>
				</div>
				<div class="box">
					<img src="image/ccis(6).jpg">
					<a href="shop.php" class="btn"> shop now</a>
				</div>
				<div class="box">
					<img src="image/cas(5).jpg">
					<a href="shop.php" class="btn"> shop now</a>
				</div>
			</div>
		</section>
		<section class="shop-category">
			<div class="box-container">
				<div class="box">
					<!-- <img src="image/jacket.jpg"> -->
					<div class="detail">
						<span>BEST SELLER</span>
						<h1>Extra 10% off</h1>
						<a href="shop.php" class="btn">Shop now</a>
					</div>
				</div>
			</div>
		</section>
		<section class="services">
			<div class="box-container">
				<div class="box">
					<img src="image/webstores.png">
					<div class="detail">
						<h3>WEBSTORES</h3>
						<p>Quick and easy online store set up to fit your style.</p>
					</div>
				</div>
				<div class="box">
					<img src="image/quality.png">
					<div class="detail">
						<h3>GREAT QUALITY</h3>
						<p>Our team and trusted merchandise partners high quality and affordable products!</p>
					</div>
				</div>
				<div class="box">
					<img src="image/ship.png">
					<div class="detail">
						<h3>FREE SHIPPING</h3>
						<p>We offer free and coordinate return shipments!</p>
					</div>
				</div>
				<div class="box">
					<img src="image/fulfillment.png">
					<div class="detail">
						<h3>FULFILLMENT</h3>
						<p>We always keep your products organized and ready to ship with efficiency and care.</p>
					</div>
				</div>
				<div class="box">
					<img src="image/support.png">
					<div class="detail">
						<h3>SUPPORT</h3>
						<p>Customer support is very important to us. We're here to help!</p>
					</div>
				</div>
			</div>
		</section>
		<!-- <section class="brand">
			<div class="box-container">
				<div class="box">
					<img src="image/CAS.png">
				</div>
				<div class="box">
					<img src="image/COE.png">
				</div>
				<div class="box">
					<img src="image/CBEA.png">
				</div>
				<div class="box">
					<img src="image/CTE.jpg">
				</div>
				<div class="box">
					<img src="image/CSIS.png">
				</div>
			</div>
		</section> -->
		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>