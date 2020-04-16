<?php include_once'lib/header.php';
require_once 'functions/alert.php';

?>









        <h2><span>Forgot Password</span></h2>
        <p>Provide the email address associated with your account</p>      
        <form action="processforgot.php" method="POST">
<p><?php error();message();?></p>
<P>
    <label for="">Email</label><br/>
    <input 
    <?php
      if(isset($_SESSION['email'])){
        echo "value=".$_SESSION['email'];
      }
    ?>
    type="email" name="email" placeholder="Email" required/>
  </P>
  <button type="submit">Send Reset Code</button>
</form>
       
		
      


<?php include_once'lib/footer.php'?>