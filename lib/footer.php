<p>
  <a href="index.php">Home</a>
  <?php 
  if(!isset($_SESSION['loggedin'])){
  ?>
    <a href="login.php">Login</a>
  <a href="register.php">Register</a>
  <a href="forgot.php">Forgot Password</a>
  <?php }else{ ?>
    <a href="logout.php">Logout</a>
    <a href="reset.php">Reset Password</a>
  <?php }?>
  

</p>
  
<!--footer-->
<div class="footer-w3l">
				<p>&copy; 2018 Space Register Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
			<!--//footer-->
			
		</div>
	</div>
	<!-- //Main Content -->

</body>
</html>