<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<div class="container">

  <div class="row">
  <div class="col-sm"></div>
      <div class="col-sm my-4">
      
          <h2>Make payment</h2>
          <form action="processpayment.php" method="POST">

          <p>
            <label for="">Patient Full Name</label><br>
            <input value="<?php echo $_SESSION['fullname'];?>" type="text" class="form-control" name="ptfullname" placeholder="Patient Name" required />
          </p>
          <p>
          <label for="">Patient Email</label><br>
          <input value="<?php echo $_SESSION['email'];?>" type="email" class="form-control" name="ptemail" placeholder="Patient Email" required />
        </p>
          <p>
              <label for="">Makepayment</label><br>
              <input type="text" class="form-control" name="amount" placeholder="Amount" required />
            </p>
            <p ><button type="submit" class="btn btn-success" name="pay">Pay</button></p>
            
          </form>
          
      </div>
      
  <div class="col-sm"></div>
    
  </div>
  <a href="patient.php" class="btn btn-bg btn-outline-secondary">back</a>
</div>
<?php include_once'lib/footer.php'?>