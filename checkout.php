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

	if (isset($_POST['order-btn'])) {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$number = mysqli_real_escape_string($conn, $_POST['number']);
		$method = mysqli_real_escape_string($conn, $_POST['method']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$placed_on = date('d-M-Y');
		$cart_total = 0;
		$cart_product[]='';

		$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
		   if(mysqli_num_rows($cart_query) > 0){
		      while($cart_item = mysqli_fetch_assoc($cart_query)){
		         $cart_product[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
		         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
		         $cart_total += $sub_total;
		      }
		   }

		$total_products = implode(', ', $cart_product);
		// $order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
		$order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE name = '$name' AND email = '$email' AND number = '$number' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');


   		if($cart_total == 0){

   		}else{
	      if(mysqli_num_rows($order_query) > 0){
	       
	      }else{

			// mysqli_query($conn, "INSERT INTO `order` (`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`) VALUES ('$user_id', '$name', '$email', '$number', '$method', '$address', '$total_products', '$cart_total', '$placed_on')");
	      	mysqli_query($conn, "INSERT INTO `order` (`user_id`, `name`, `email`, `number`, `method`, `address`, `total_products`, `total_price`, `placed_on`) VALUES ('$user_id', '$name', '$email', '$number', '$method', '$address', '$total_products', '$cart_total', '$placed_on')");
			mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");
			$message[]='order placed succesfully!';
			header('location:checkout.php');
		}

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
			<h1>Checkout</h1>
		</div>
		<div class="title2">
			<a href="home.php">Home / </a><span>Checkout</span>
		</div>
		<div class="checkout-form">
			<h1 class="title">Payment Process</h1>
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
         <div class="display-order">
         	<div class="box-container">
	         	<?php
	         	$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
	         	$total = 0;
	         	$grand_total = 0;

	         	if(mysqli_num_rows($select_cart) > 0){
	         		while($fetch_cart = mysqli_fetch_assoc($select_cart)){
	         			$total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
	         			$grand_total = $total += $total_price;
	         	
	         	 ?>
	         	
	         	 	<div class="box">
	         	 		<img src="image/<?php echo trim($fetch_cart['image']); ?>">
	         	 		<span><?= $fetch_cart['name'];?>(<?= $fetch_cart['quantity']; ?>)</span>
	         	 	</div>
	         	
	         	 <?php 
			         	}
			         }
	         	?>
	         </div>
	         <span class="grand-total">Total Amount Payable: Php <?= $grand_total;  ?></span>
	     </div>
	     <?php
				$edit_query = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
				if(mysqli_num_rows($edit_query) > 0 ){
					while($fetch_edit = mysqli_fetch_assoc($edit_query)){

			?>
         <form method="post">
         	<div class="input-field">
         		<label>Your name</label>
         		<input type="text" name="name" value="<?php echo $fetch_edit['name'];?>" placeholder="enter your name">
         	</div>

         	<div class="input-field">
         		<label>Your email</label>
         		<input type="text" name="email" value="<?php echo $fetch_edit['email'];?>" placeholder="enter your email">
         	</div>

         	<div class="input-field">
         		<label>Your number</label>
         		<input type="number" name="number" value="<?php echo $fetch_edit['number'];?>" placeholder="enter your number">
         	</div>

         	<div class="input-field">
         		<label>Address</label>
         		<input type="text" name="address" value="<?php echo $fetch_edit['address'];?>" placeholder="enter your address">
         	</div>

         	<div class="input-field">
         		<label>Select payment method</label>
         		<select name="method">
         			<option selected disabled>Select Payment Method</option>
         			<option value="cash on delivery">cash on delivery</option>
         			<option value="credit card">credit card</option>
         			<option value="gcash">gcash</option>
         			<option value="paypal">paypal</option>

         		</select>
         	</div>

         	<input type="submit" name="order-btn" class="btn" value="order now">
         </form>
         <?php
								
					}
				}	
			?>
		</div>
		<?php include 'components/footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include 'components/alert.php'; ?>

</body>
</html>