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

   if (isset($_POST['update_qty_btn'])) {
      $update_qty_id = $_POST['update_qty_id'];
      $update_value = $_POST['update_qty'];

      $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_qty_id'") or die('query failed');
      if ($update_query) {
         header('location:cart.php');
      }
   }


   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      
      mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');

      header('location:cart.php');
   }

   if(isset($_GET['delete_all'])){
      
      mysqli_query($conn, "DELETE FROM `cart` WHERE $user_id = '$user_id'") or die('query failed');

      header('location:cart.php');
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
         <h1>Cart</h1>
      </div>
      <div class="title2">
         <a href="home.php">Home / </a><span>Cart</span>
      </div>

      <section class="wishlist">
         <h1 class="title">My Cart</h1>

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
            <div class="cart-container">
               <?php 
                  $grand_total = 0;
                  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die ('query failed');
                  if (mysqli_num_rows($select_cart) > 0) {
                     while($fetch_cart = mysqli_fetch_assoc ($select_cart)){
               ?>
               <div class="box">
                  <img src="image/<?php echo trim($fetch_cart['image']);?>" class="img">
                  <div class="name"><?php echo $fetch_cart['name'] ;?></div>
                  <div class="price">Php <?php echo $fetch_cart['price'] ;?></div>

                 <!--  <div class="icon">
                     <a href="view_product.php?pid=<?php echo $fetch_cart['id'];?>" class="bi bi-eye-fill"></a>

                     <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" class="bi bi-trash" onclick="return confirm('Do you want to delete this product from your cart?')"></a>
                     <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                  </div> -->

                  <form method="post">
                  <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                  <div class="qty">
                     <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                     <input type="submit" name="update_qty_btn" value="update">
                     <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" class="bi bi-trash" onclick="return confirm('Do you want to delete this product from your cart?')"></a>
                  </div>
               </form>

               <div class="total-amt">
                  Total Amount: <span><?php echo $total_amt = ($fetch_cart['price']*$fetch_cart['quantity']); ?></span>
               </div>
            </div>

               <?php
                     $grand_total += $total_amt;
                     }
                  }else{
                     echo '<p class="empty">no products added yet!</p>';
                  }
               ?>

   </section>
   <div class="dlt">
      <a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all items in your cart?')">Delete All</a>
   </div>
   
   <div class="wishlist_total">
               <p>Total amount payable: <span>Php <?php echo $grand_total;  ?></span> </p>
               <a href="shop.php" class="btn">Continue Shopping</a>
               <a href="checkout.php" class="btn">Proceed to checkout</a>
         </div>

      <?php include 'components/footer.php'; ?>
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script src="script.js"></script>
   <?php include 'components/alert.php'; ?>

</body>
</html>