<?php

include_once('lib/header.php');
require_once('functions/alert.php');

?>

<div class="container">
  <div class="row">
<div class="col-sm"></div>
<div class="col-sm  mt-5 my-5"> 
        <h3>Forgot Password</h3>
  
    
    <p>Provide the email address associated with your account</p>
    <p><?php printAlert();?></p>	

        
              
        <form action="processforgot.php" method="POST">

<P>
    <label for="">Email</label><br/>
    <input 
    <?php
      if(isset($_SESSION['email'])){
        echo "value=".$_SESSION['email'];
      }
    ?>
    type="email" class="form-control" name="email" placeholder="Email"/>
  </P>
  <p>
  <button class="btn btn-sm btn-primary"  type="submit">Send Reset Code</button>
  </p>
</form>
</div>
<div class="col-sm"></div>
</div>
       
		
</div>     


<?php include_once'lib/footer.php'?>