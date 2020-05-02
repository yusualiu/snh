<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<div class="container">


<div class="row">
  <div class="col"></div>
 
  <div class="col">
  <h2>Book appointment here</h2>
<form action="processbooking.php" method="POST">

<?php printAlert();?>


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
<a href="patient.php">back</a>
  </div>
  <div class="col"></div>
  
</div>

</div>
<?php include_once'lib/footer.php'?>