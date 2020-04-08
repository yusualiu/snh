<?php 
include_once'lib/header.php';
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<h3>Dashboard</h3>
<p>Welcome  <?php echo $_SESSION['fullname'];?> You are loggedin as a <?php echo $_SESSION['role'];?> and your registration date is <?php echo $_SESSION['createdTime'];?> and your last login time is <?php echo $_SESSION['lastLogin'];?>  </p>
<?php include_once'lib/footer.php'?>