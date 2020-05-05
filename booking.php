<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<div class="container">


<div class="row">
<div class="col-sm"></div>
 
<div class="col-sm my-4">
  <h2>Book appointment</h2>
<form action="processbooking.php" method="POST">

<?php printAlert();?>


  <p>
    <label for="">Patient Full Name</label>
    <input value="<?php echo $_SESSION['fullname'];?>" type="text" class="form-control" name="ptfullname" placeholder="Patient Name" required />
  </p>
  

  <p>
    <label for="">Patient Email</label>
    <input value="<?php echo $_SESSION['email'];?>" type="email" class="form-control" name="ptemail" placeholder="Patient Email" required />
  </p>
  
  <p>
    <label for="">Date of Appointment</label>
    <input  type="date" class="form-control" name="appointdate" placeholder="Date" required />
  </p>
  <p>
    <label for="">Time of Appointment</label>
    <input  type="time" class="form-control" name="appointtime" placeholder="Time" required />
  </p>
  <p>
    <label for="">Nature of Appointment</label>
    <input  type="text" class="form-control" name="appointnature" placeholder="Nature of apointment" required />
  </p>

  <p>
    <label for="">Initial Complaint</label>
    <textarea class="form-control" rows="4" cols="50" name="complaint" required></textarea>
  </p>


  <p>
    <label for="">Appointment Department</label>
    <input
    <?php
      if(isset($_SESSION['appointdepartment'])){
        echo "value=".$_SESSION['appointdepartment'];
      }
    ?>
     type="text" class="form-control" name="appointdepartment" placeholder="Department" required />
  </p>
  <p class="text-center"><button type="submit" class="btn btn-success">Book</button></p>
</form>

  </div>
  <div class="col-sm"></div>
  
</div>
<a href="patient.php" class="btn btn-bg btn-outline-secondary">back</a>
</div>
<?php include_once'lib/footer.php'?>