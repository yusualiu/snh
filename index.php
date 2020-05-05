<?php  include_once('lib/header.php');  require_once('functions/alert.php'); ?>
    <p>
        <?php  printAlert(); ?>
    </p>
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center jumbotron ">
        <h1 class="display-4"> Welcome to SNG : Hospital Booking System</h1>
        <p class="font-weight-bold">This is a specialist hospital which allows booking from anywhere in the world</p>
        <p class="lead">Come as you are, it is completely free!</p>
        <p>
            <a class="btn btn-bg btn-outline-secondary" href="login.php">Login</a>
            <a class="btn btn-bg btn-outline-primary" href="register.php">Register</a>            
        </p>
    </div>
    <!-- <div class="jumbotron"></div> -->

<?php include_once('lib/footer.php'); ?>
