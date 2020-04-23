
<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
?>

<div class="container">
    <div class="row col-6">
        <h3>Login</h3>
    </div>
    <div class="row col-6">
    <p><?php printAlert();?></p>			

        <form action="processlogin.php" method="POST">

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

        <button class="btn btn-sm btn-primary" type="submit">login</button>
        <p>
                <a href="forgot.php">Forgot Password</a><br />
                <a href="register.php">Don't have an account? Register</a>
            </p>
        </form>
        </div>
</div>
		
<?php include_once('lib/footer.php'); ?>


