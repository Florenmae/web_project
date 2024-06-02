<?php
	include'components/connection.php';
	session_start();
	$admin_id = $_SESSION['admin_name'];

	if(!isset($admin_id)){
		header('location:login.php');
	}

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:login.php');
	}


	//DELETE PRODUCT FROM DB
	if(isset($_GET['delete'])){
		$delete_id = $_GET['delete'];
		
		mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
		$message[] = 'user removed succesfully';
		header('location:admin_user.php');
	}

?>

<style type="text/css">
	<?php 
		include 'style.css';
	?>
</style>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-------box icon links---->
	<!----<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">---->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>admin panel</title>
</head>
<body>

	<?php include 'admin_header.php'; ?>
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

	
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>