<?php
	include 'components/connection.php';
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
		
		mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');

		header('location:admin_message.php');
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
	<div class="main">
		<section class="message-container">
			<h1 class="title">Unread messages</h1>
			<div class="box-container">
				<?php 
					$select_message = mysqli_query($conn, "SELECT * FROM `message` ") or die('query failed');
					if (mysqli_num_rows($select_message) > 0) {
						while($fetch_message = mysqli_fetch_assoc($select_message)){

				?>
				<div class="box">
					<p>User id: <span><?php echo $fetch_message['id']; ?> </span></p>
					<p>Name: <span><?php echo $fetch_message['name']; ?> </span></p>
					<p>Email: <span><?php echo $fetch_message['email']; ?> </span></p>
					<p><?php echo$fetch_message['message'] ?></p>
					<a href="admin_message.php?delete=<?php echo $fetch_message['id'];?>" class="delete" onclick="return confirm('delete this message');">Delete</a>
				</div>
				<?php
						}
					}else{
							echo '
							<div class="empty">
								<p>No products added yet!</p>
							</div>
							';
					}
				?>
			</div>
		</section>
	</div>
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>