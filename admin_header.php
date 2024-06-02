
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-------box icon links---->
	<!----<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">---->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>admin header</title>

</head>
<body>
		<header class="header">
			<div class="flex">
				<a href="admin_panel.php" class="logo"><img src="image/logo2.png" width="150" height="65"></a>
				<nav class="navbar">
					<a href="admin_panel.php">Home</a>
					<a href="admin_product.php">Products</a>
					<a href="admin_order.php">orders</a>
					<a href="admin_user.php">users</a>
					<a href="admin_message.php">messages</a>
				</nav>

				<div class="icons">
					<i class="bi bi-person" id="user-btn"></i>
					<i class="bx bxs-list" id="menu-btn"></i>
				</div>
				<div class="user-box">
					<p>Username: <span><?php echo $_SESSION['admin_name'];?></span></p>
					<p>Email: <span><?php echo $_SESSION['admin_email'];?> </span></p>

					<form method="post">
						<button type="submit" name="logout" class="logout-btn">Log out</button>
					</form>
				</div>
			</div>
		</header>
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>