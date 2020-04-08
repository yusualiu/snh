<?php include_once'lib/header.php';
require_once 'functions/alert.php';
?>
<h3>Reset Password </h3>
<p>Provide the new password for your account : [email]</p>
<?php 
  if(!isset($_SESSION['loggedin']) && !isset($_GET['token']) && !isset($_SESSION['token'])){
    $_SESSION['error'] = 'You are not authorised to view this page';
    header('Location:login.php');
  }

?>

<form action="processreset.php" method="POST">

  <p><?php error();message();?></p>


<P>
    <label for="">Email</label><br/>
    <input 
    <?php
      if(isset($_SESSION['email'])){
        echo "value=".$_SESSION['email'];
      }

    ?>
    type="email" name="email" placeholder="Email" />
  </P>
  <P>
    <label for="">Enter New Password</label><br/>
    <input type="password" name="password" placeholder="Password" />
  </P>
  <?php 
    if(!isset($_SESSION['loggedin'])){?>
  <P>
    
    <input 
    <?php
      if(isset($_SESSION['token'])){
        echo "value=".$_SESSION['token'];
      }else{
        echo "value=".$_GET['token'];
      }

    ?>
    
    type="hidden" name="token"  />
  </P>
    <?php }?>
  <p>
  <button type="submit">Reset Password</button>
  </p>
 
</form>
<?php include_once'lib/footer.php'?>