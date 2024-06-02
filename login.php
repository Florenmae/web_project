<?php
   include 'components/connection.php';

   session_start();

   if (isset($_POST['submit-btn'])) {
   
      $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $email = mysqli_real_escape_string($conn, $filter_email);

      $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
      $password = mysqli_real_escape_string($conn, $filter_password);

   
      $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

      if (mysqli_num_rows($select_user) > 0) {
         $row = mysqli_fetch_assoc($select_user);

         if($row['user_type']== 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_panel.php');
         }else if($row['user_type']== 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }else{
            $message[] = 'incorrect email or password';
         }
      }
   }
?>

<style type="text/css">
   <?php 
      include 'style.css';
   ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link rel="stylesheet" type="text/css" href="style.css">
   <title>login Page</title>
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
            <h1>Login now</h1>
            <p>Bachelor of Science in COmputer Science -- Final Project in Website Developement --- Powered by Powerpuff Girls</p>
         </div>
         <form action="" method="post">
            <div class="input-field">
               <p>Your email<sup>*</sup></p>
               <input type="email" name="email" required placeholder="enter your email" maxlength="50">
            </div>
            <div class="input-field">
               <p>Your password<sup>*</sup></p>
               <input type="password" name="password" required placeholder="enter your password" maxlength="50">
            </div>
            <input type="submit" name="submit-btn" value="login now" class="btn">
            <p>Do not have an account? <a href="register.php">register now</a></p>
         </form>
      </section>
   </div>

</body>
</html>