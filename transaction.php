<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
if(!isset($_SESSION['loggedin'])){
  header('Location: login.php');
}
?>
<div class="container">


<!-- This is for the Patients -->
<?php if($_SESSION['role']=='Patients'){ ?>


  <div class="row">
  
  <div class="col"></div>
  <div class="col">
  <h3 class="text-center">Your Transaction History</h3>
<?php 
//  fetch all the records
$allTransactions = scandir("db/transactions/");
$countTransactions = count($allTransactions);
$transactionsno = $countTransactions-1;
$patientData = [];
  $email = $_SESSION['email'];
//  fetch all the records  that matches patient transactions
for ($counter=1; $counter < $countTransactions; $counter++) { 
  if(file_exists('db/transactions/'.$email.'.json')){
     //open or read json data
    $transactions= file_get_contents('db/transactions/'.$email.'.json'); 
    $data = json_decode($transactions, true);
    $patientData[] = $data;
    break;
  
  }else{
   
    $patientData[] = 'Transaction is Pending at the moment';
  
  }

}
if($patientData[0] !='Transaction is Pending at the moment' ){


  ?>
  
   <table>
          <tr>
            <th>S/No</th>
            
            <th>Transaction ID </th>
            <th>Transaction REF </th>
            <th>Amount Paid </th>
            <th>Currency </th>
            <th>Payment Method</th>
            <th>Patient Name</th>
            <th>Patient Email</th>
            <th>Transaction Date</th>
            
          </tr>
  <?php
  // Process patient transactions
  foreach ($patientData as $key => $value) {
    foreach($value as $transactions){
     
      ?>
     
          <tr>
            <td><?php echo $counter++;?></td>
            <td><?php echo $transactions['transactionid'];?></td>
            <td><?php echo $transactions['transactionref'];?></td>
            <td><?php echo $transactions['chargeamount'];?></td>
            <td><?php echo $transactions['chargecurrency'];?></td>
            <td><?php echo $transactions['paymenttype'];?></td>
            <td><?php echo $transactions['custname'];?></td>
            <td><?php echo $transactions['custemail'];?></td>
            <td><?php echo $transactions['transactiondate'];?></td>         
            
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
 
    </div>

    <a href="patient.php">back</a>
 
    <div class="col"></div>
    </div>
    <?php };?>
 
   


<!-- This is for the Medical staff -->
<?php if($_SESSION['role']=='Medical Team(MT)'){?>
<div class="row">
  <div class="col"></div>
  <div class="col">
  <h3 class="text-center">Patients Payment History</h3>
  
 <?php 
 // fetch all rocord in bookings folder based on staff department
 // fetch content of each file in a folder
 $staffDepartment = $_SESSION['department'];
 $patientData = [];
 $files = array_diff(scandir("db/bookings/"), array('.', '..'));
 for($counter=0;$counter < count($files) ;$counter++){
  if(file_exists('db/bookings/'.$staffDepartment.'.json')){
    //open or read json data
    $bookingStrings= file_get_contents('db/bookings/'.$staffDepartment.'.json'); 
    $data = json_decode($bookingStrings, true);
    
    $patientData[] = $data;
    break;
  }

 }

$payments= [];

 foreach ($patientData as $key => $value) {
  foreach($value as $bookings){
    $email = $bookings['patientEmail'];
    // fetch transaction based on the patient email
    
    $allTransactions = scandir("db/transactions/");
    $countTransactions = count($allTransactions);
    $transactionsno = $countTransactions-1;
    
    
    //  fetch all the records  that matches patient transactions
    for ($counter=1; $counter < $countTransactions; $counter++) { 
      if(file_exists('db/transactions/'.$email.'.json')){
        //open or read json data
       
        $transactions= file_get_contents('db/transactions/'.$email.'.json'); 
        $data = json_decode($transactions, true);
        $payments[] = $data;
        break;
      
      }

    }
  }

}
if($payments){
  ?>
  
   <table>
          <tr>
            <th>S/No</th>
            
            <th>Transaction ID </th>
            <th>Transaction REF </th>
            <th>Amount Paid </th>
            <th>Currency </th>
            <th>Payment Method</th>
            <th>Patient Name</th>
            <th>Patient Email</th>
            <th>Transaction Date</th>
            
          </tr>
  <?php
  // Process patient transactions
  foreach ($payments as $key => $value) {
    foreach($value as $transactions){
     
      ?>
     
          <tr>
            <td><?php echo $counter++;?></td>
            <td><?php echo $transactions['transactionid'];?></td>
            <td><?php echo $transactions['transactionref'];?></td>
            <td><?php echo $transactions['chargeamount'];?></td>
            <td><?php echo $transactions['chargecurrency'];?></td>
            <td><?php echo $transactions['paymenttype'];?></td>
            <td><?php echo $transactions['custname'];?></td>
            <td><?php echo $transactions['custemail'];?></td>
            <td><?php echo $transactions['transactiondate'];?></td>         
            
          </tr>
          
       
    <?php
    }
    
    
  }
  ?>
     </table>
  <?php
  }else{
     // show pending if no record is found	
    
    echo 'There are no pending Transactions';
  
  }
  ?>
 
 
  
  </div>
  <a href="medicalteam.php">back</a>
  <div class="col"></div>
  </div>
<?php };?>



<!-- This is for the Admin -->

<?php if($_SESSION['role']=='Super Admin(MD)'){?>
  <div class="row">
  
    <div class="col"></div>
    <div class="col">
    <h3 class="text-center">All Transactions History</h3>
  <?php
    $allTransactions = array_diff(scandir("db/transactions/"), array('.', '..'));
    $transactions= [];// container for all transactions
  if($allTransactions){
    foreach($allTransactions as $transaction){
      $transactionString = file_get_contents("db/transactions/".$transaction); 
      $transactionObject = json_decode($transactionString,true);
      $transactions[] = $transactionObject;    
    }
?>
<table>
  <tr>
  <th>S/No</th>
            
      <th>Transaction ID </th>
      <th>Transaction REF </th>
      <th>Amount Paid </th>
      <th>Currency </th>
      <th>Payment Method</th>
      <th>Patient Name</th>
      <th>Patient Email</th>
      <th>Transaction Date</th>
  </tr>
  <?php 
for($counter=1;$counter< count($transactions);$counter++){


foreach($transactions as $key){
  foreach($key as $transaction){?>
   
    <tr>
    <td><?php echo $counter++;?></td>
    <td><?php echo $transaction['transactionid'];?></td>
    <td><?php echo $transaction['transactionref'];?></td>
    <td><?php echo $transaction['chargeamount'];?></td>
    <td><?php echo $transaction['chargecurrency'];?></td>
    <td><?php echo $transaction['paymenttype'];?></td>
    <td><?php echo $transaction['custname'];?></td>
    <td><?php echo $transaction['custemail'];?></td>
    <td><?php echo $transaction['transactiondate'];?></td>         
    
  </tr>
   
 <?php }
 
  
}
}
  ?>


  </table>


  

  <?php   
  }else{
    echo 'No Pending Transactions';
  }
  ?>
  
    
    </div>
    <a href="admin.php">back</a>
    <div class="col"></div>
  </div>
<?php };?>


</div>
<?php include_once('lib/footer.php')?>