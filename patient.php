<?php 
include_once'lib/header.php';
require_once 'functions/alert.php';
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<h3>Dashboard</h3>
<p>Welcome  <?php echo $_SESSION['fullname'];?> You are loggedin as a <?php echo $_SESSION['role'];?> and your registration date is <?php echo $_SESSION['createdTime'];?> and your last login time is <?php echo $_SESSION['lastLogin'];?>  </p>
<p>You can book appointment with a medical staff or make payment of bill</p>
<h2>Make payment here</h2>
<form action="processpayment.php" method="POST">
<p>
    <label for="">Makepayment</label>
    <input type="text" name="amount" placeholder="Amount" required />
  </p>
  <p><button type="submit">Pay</button></p>
</form>

<h2>Book appointment here</h2>
<form action="processbooking.php" method="POST">
<?php dashboardMessage();?>


  <p>
    <label for="">Patient Full Name</label>
    <input value="<?php echo $_SESSION['fullname'];?>" type="text" name="ptfullname" placeholder="Patient Name" required />
  </p>
  

  <p>
    <label for="">Patient Email</label>
    <input value="<?php echo $_SESSION['email'];?>" type="email" name="ptemail" placeholder="Patient Email" required />
  </p>
  
  <p>
    <label for="">Date of Appointment</label>
    <input  type="date" name="appointdate" placeholder="Date" required />
  </p>
  <p>
    <label for="">Time of Appointment</label>
    <input  type="time" name="appointtime" placeholder="Time" required />
  </p>
  <p>
    <label for="">Nature of Appointment</label>
    <input  type="text" name="appointnature" placeholder="Nature of apointment" required />
  </p>

  <p>
    <label for="">Initial Complaint</label>
    <textarea rows="4" cols="50" name="complaint" required></textarea>
  </p>


  <p>
    <label for="">Appointment Department</label>
    <input
    <?php
      if(isset($_SESSION['appointdepartment'])){
        echo "value=".$_SESSION['appointdepartment'];
      }
    ?>
     type="text" name="appointdepartment" placeholder="Department" required />
  </p>
  <p><button type="submit">Book</button></p>
</form>
<?php include_once'lib/footer.php'?>