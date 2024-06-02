<?php
   include 'components/connection.php';

   session_start();

   if (isset($_POST['submit-btn'])) {
      $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $name = mysqli_real_escape_string($conn, $filter_name);

      $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $email = mysqli_real_escape_string($conn, $filter_email);

      $filter_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
      $address = mysqli_real_escape_string($conn, $filter_address);

      $filter_number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
      $number = mysqli_real_escape_string($conn, $filter_number);

      $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      $password = mysqli_real_escape_string($conn, $filter_password);

      $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
      $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

      $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

      if (mysqli_num_rows($select_user) > 0) {
         $message[] = 'user already exist';
      }else{
         if($password != $cpassword){
            $message[] = 'wrong password';
         }else{
            mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`, `address` , `number`) VALUES ('$name', '$email', '$password', '$address', '$number')") or die('query failed');
            $message[] = 'registered succesfully';
            header('location:login.php');
         }
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-------box icon links---->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link rel="stylesheet" type="text/css" href="style.css">
   <title>Registration Page</title>
</head>
<body>
   <div class="main-container">
      <section class="form-container">
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
         <div class="title">
            <img src="image/logo2.png" width="170" height="95">
            <h1>Register now</h1>
            <p>Bachelor of Science in COmputer Science -- Final Project in Website Developement --- Powered by Powerpuff Girls</p>
         </div>
         <form action="" method="post">
            <div class="input-field">
               <p>Your name<sup>*</sup></p>
               <input type="text" name="name" required placeholder="enter your name" maxlength="50">
            </div>
            <div class="input-field">
               <p>Your email<sup>*</sup></p>
               <input type="email" name="email" required placeholder="enter your email" maxlength="50">
            </div>
            <div class="input-field">
               <p>Your address<sup>*</sup></p>
               <input type="address" name="address" required placeholder="enter your address" maxlength="50">
            </div>
            <div class="input-field">
               <p>Your number<sup>*</sup></p>
               <input type="address" name="number" required placeholder="enter your number" maxlength="50">
            </div>
            <div class="input-field">
               <p>Your password<sup>*</sup></p>
               <input type="password" name="password" required placeholder="enter your password" maxlength="50">
            </div>
            <div class="input-field">
               <p>Confirm password<sup>*</sup></p>
               <input type="password" name="cpassword" required placeholder="confirm your password" maxlength="50">
            </div>
            <input type="submit" name="submit-btn" value="register now" class="btn">
            <p>Already have an account? <a href="login.php">Login now</a></p>
         </form>
      </section>
   </div>

</body>
</html>