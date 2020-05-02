<?php  include_once('lib/header.php');  require_once('functions/alert.php'); ?>
<p>
        <?php  printAlert(); ?>
    </p>
<?php
if(!empty($_GET['txid'] && !empty($_GET['amount']))){
  $_GET = filter_var_array($_GET,FILTER_SANITIZE_STRING);
  $transactionId = $_GET['txid'];
  $transactionAmount = $_GET['amount'];
  ?>
 <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    
    <h1 class="display-4">Thank you for booking with SNG : Hospital Booking System</h1>
        <p class="lead">Your Transaction ID is <?php echo $transactionId;?></p>
        <p class="lead">The total amount paid is  <?php echo $transactionAmount;?></p>
        <p class="lead">Please check your email for more information</p>
    <a href="payment.php">back</a>

    </div>
  <?php

}
?>
<?php include_once('lib/footer.php'); ?>