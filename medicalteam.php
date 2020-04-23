<?php 
include_once('lib/header.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>


      <h3>Dashboard</h3>
<p>Welcome  <?php echo $_SESSION['fullname'];?> You are loggedin as a <?php echo $_SESSION['role'];?> and your registration date is <?php echo $_SESSION['createdTime'];?> and your last login time is <?php echo $_SESSION['lastLogin'];?>  </p>
<h1>The Departmental Patient Appointments </h1>

<?php	



//fetch all the records  that matches staff department

$staffDepartment =  $_SESSION['department'];
$bookings = scandir("db/bookings/");
$countBookers = count($bookings);
  

$patientData = [];
for ($counter=1; $counter < $countBookers; $counter++) { 
  if(file_exists('db/bookings/'.$staffDepartment.'.json')){
     //open or read json data
    $bookingStrings= file_get_contents('db/bookings/'.$staffDepartment.'.json'); 
    $data = json_decode($bookingStrings, true);
    $patientData[] = $data;
    break;
  
  }else{
   
    $patientData[] = 'Booking is Pending at the moment';
  
  }

}
// check if staff department is booked
if($patientData[0] !='Booking is Pending at the moment' ){


?>

 <table>
        <tr>
          <th>S/No</th>
          
          <th>Patient Email</th>
          <th>Appointment Date</th>
          <th>Appointment Time </th>
          <th>Nature of Appointment</th>
          <th>Initial Complaint</th>
          <th>Departmental Appointment</th>
          <th>Last Booked Date</th>
        </tr>
<?php
// Process departmental appointments
foreach ($patientData as $key => $value) {
  foreach($value as $bookings){
   
    ?>
   
        <tr>
          <td><?php echo $counter++;?></td>
          <td><?php echo $bookings['patientEmail'];?></td>
          <td><?php echo $bookings['appointmentDate'];?></td>
          <td><?php echo $bookings['appointmentTime'];?></td>
          <td><?php echo $bookings['natureOfAppointment'];?></td>
          <td><?php echo $bookings['complaint'];?></td>
          <td><?php echo $bookings['appointmemtDepartment'];?></td>
          <td><?php echo $bookings['lastBookedDate'];?></td>
          
          
        </tr>
        
     
  <?php
  }
  
  
}
?>
   </table>
<?php
}else{
   // show pending if no record is found	
  echo $patientData[0];

}
?>

<?php include_once'lib/footer.php'?>
