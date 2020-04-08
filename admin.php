<?php 
include_once'lib/header.php';
require_once('functions/alert.php');
require_once('functions/user.php');

if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<h3>Dashboard</h3>
<p>Welcome  <?php echo $_SESSION['fullname'];?> You are loggedin as a <?php echo $_SESSION['role'];?>,your registration date is <?php echo $_SESSION['createdTime'];?> and your last login time is <?php echo $_SESSION['lastLogin'];?>  </p>
<p>Add User below</p>
<form action="processregister.php" method="POST">
<?php error();message();?>
  <P>
    <label for="">First Name</label>
    <input 
    <?php
      if(isset($_SESSION['first_name'])){
        echo "value=".$_SESSION['first_name'];
      }
    ?> 
     type="text" name="first_name" placeholder="First Name" pattern="[a-zA-Z][a-zA-Z ]{2,}" required/>
  </P>
  <P>
    <label for="">Last Name</label>
    <input 
    <?php
      if(isset($_SESSION['last_name'])){
        echo "value=".$_SESSION['last_name'];
      }
    ?>
    type="text" name="last_name" placeholder="Last Name" pattern="[a-zA-Z][a-zA-Z ]{2,}" required />
  </P>
  <P>
    <label for="">Email</label>
    
    <input 
    <?php
      if(isset($_SESSION['email'])){
        echo "value=".$_SESSION['email'];
      }
    ?>
    type="email" name="email" placeholder="Email" required/>
  </P>
  <P>
    <label for="">Password</label>
    <input type="password" name="password" placeholder="Password" required />
  </P>
  <p>
  <label for="">Gender</label>
    <select name="gender" required >
    
      <option value="">Select One</option>
      <option 
      <?php
      if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
        echo "selected";
      }
      ?>
      >Male</option>
      <option
      <?php
      if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
        echo "selected";
      }
    ?>
       >Female</option>
    </select>
  </p>
  
  <p>
  <label for="">Designation</label>
    <select name="designation" required>
      <option value="">Select One</option>
      <option 
      <?php
      if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team(MT)'){
        echo "selected";
      }
    ?>
      >Medical Team(MT)</option>
      <option 
      <?php
      if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patients'){
        echo "selected";
      }
    ?>
      >Patients</option>
      <option 
      <?php
      if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Super Admin(MD)'){
        echo "selected";
      }
    ?>
      >Super Admin(MD)</option>
    </select>
  </p>

  <p>
    <label for="">Department</label>
    <input
    <?php
      if(isset($_SESSION['department'])){
        echo "value=".$_SESSION['department'];
      }
    ?>
     type="text" name="department" placeholder="Department" required />
  </p>
  <button type="submit">Add User</button>
</form>
<?php include_once'lib/footer.php'?>