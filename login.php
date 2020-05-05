
<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
?>

<div class="container">


<div class="row">
<div class="col-sm"></div>

    <div class="col-sm mt-5 my-5">
   <h3>Sign in</h3>
<form action="processlogin.php" method="POST">
<p><?php printAlert();?></p>
 <P>
   <label for="">Email</label>
          <input 
          <?php
            if(isset($_SESSION['email'])){
              echo "value=".$_SESSION['email'];
            }
          ?>
          type="email" class="form-control" name="email" placeholder="Email"  />
</P>
   <P>
          <label for="">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password"  />
   </P>  

    <p><button class="btn btn-sm btn-primary" type="submit">login</button></p>
    <p>
     <a href="forgot.php">Forgot Password</a><br />
     <a href="register.php">Don't have an account? Register</a>
     </p>
        </form>   


    
    </div>
    <div class="col-sm"></div>
</div>
  

  
  
</div>
		
<?php include_once('lib/footer.php'); ?>


