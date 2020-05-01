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
              <label for="">Makepayment</label>
              <input type="text" name="amount" placeholder="Amount" required />
            </p>
            <p><button type="submit">Pay</button></p>
          </form>
      </div>
      
      <div class="col"></div>
    
  </div>

</div>
<?php include_once'lib/footer.php'?>