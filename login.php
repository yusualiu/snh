
<?php 
include_once'lib/header.php';
require_once 'functions/alert.php';
?>


			

        <h2><span>Login</span></h2>
        <p><?php error();message();?></p>
        <form action="processlogin.php" method="POST">

        <P>
          <label for="">Email</label>
          <input 
          <?php
            if(isset($_SESSION['email'])){
              echo "value=".$_SESSION['email'];
            }
          ?>
          type="email" name="email" placeholder="Email" required />
        </P>
        <P>
          <label for="">Password</label>
          <input type="password" name="password" placeholder="Password" required />
        </P>  

        <button type="submit">login</button>
        </form>
		
<?php include_once'lib/footer.php'?>


