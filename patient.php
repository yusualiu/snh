<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<div class="container">
<p>
        <?php  printAlert(); ?>
    </p>
  <div class="row">
    <div class="col"></div>
    <div class="col">
    <h3 class="text-center">Dashboard</h3>
  <p>Welcome  <?php echo $_SESSION['fullname'];?> You are loggedin as a <?php echo $_SESSION['role'];?> and your registration date is <?php echo $_SESSION['createdTime'];?> and your last login time is <?php echo $_SESSION['lastLogin'];?>  </p><p>You can <a href="booking.php">book</a>  appointment with a medical staff or make <a href="payment.php">payment</a> of bill</p>
  <p>Click <a href="transaction.php">here</a> to view your transaction history</p>

    </div>
    
    <div class="col"></div>
  </div>


</div>
<?php include_once'lib/footer.php'?>