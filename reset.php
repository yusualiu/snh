<?php include_once'lib/header.php';
require_once 'functions/alert.php';
?>

<?php 
  if(!isset($_SESSION['loggedin']) && !isset($_GET['token']) && !isset($_SESSION['token'])){
    $_SESSION['error'] = 'You are not authorised to view this page';
    header('Location:login.php');
  }

?>


<!-- Main Content -->
<div class="main">
		<div class="main-w3l">
    <h1 class="logo-w3">Reset Password </h1>
    <p>Provide the new password for your account : [email]</p>
			
			<div class="w3layouts-main">
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
  type="email" name="email" placeholder="Email" required/>
</P>
<P>
  <label for="">Enter New Password</label><br/>
  <input type="password" name="password" placeholder="Password" required/>
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
			</div>
			<!-- //main -->

<?php include_once'lib/footer.php'?>
