<?php 
include_once'lib/header.php';
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>


<!-- Main Content -->
<div class="main">
		<div class="main-w3l">
    <h1 class="logo-w3">Patient</h1>
			
			<div class="w3layouts-main">
      <h3>Dashboard</h3>
<p>Welcome  <?php echo $_SESSION['fullname'];?> You are loggedin as a <?php echo $_SESSION['role'];?> and your registration date is <?php echo $_SESSION['createdTime'];?> and your last login time is <?php echo $_SESSION['lastLogin'];?>  </p>
			</div>
			<!-- //main -->













<?php include_once'lib/footer.php'?>
