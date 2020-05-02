<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<div class="container">

  <div class="row">
      <div class="col"></div>
      <div class="col">
      
          <h2>Make payment here</h2>
          <form action="processpayment.php" method="POST">

          <p>
            <label for="">Patient Full Name</label>
            <input value="<?php echo $_SESSION['fullname'];?>" type="text" name="ptfullname" placeholder="Patient Name" required />
          </p>
          <p>
          <label for="">Patient Email</label>
          <input value="<?php echo $_SESSION['email'];?>" type="email" name="ptemail" placeholder="Patient Email" required />
        </p>
          <p>
              <label for="">Makepayment</label>
              <input type="text" name="amount" placeholder="Amount" required />
            </p>
            <p><button type="submit" name="pay">Pay</button></p>
          </form>
          <a href="patient.php">back</a>
      </div>
      
      <div class="col"></div>
    
  </div>

</div>
<?php include_once'lib/footer.php'?>