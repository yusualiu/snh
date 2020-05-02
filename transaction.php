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
    <h3 class="text-center">Your Transaction History</h3>
 <?php
 $email = $_SESSION['email'];
 $name = $_SESSION['fullname'];
//  fetch all the records  that matches patient transactions
$allTransactions = scandir("db/transactions/");
$countTransactions = count($allTransactions);
$transactionsno = $countTransactions-1;
$patientData = [];
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
            <th>Payment Method</th>
            <th>Patient Name</th>
            <th>Patient Email</th>
            <th>Transaction Date</th>
            
          </tr>
  <?php
  // Process departmental appointments
  foreach ($patientData as $key => $value) {
    foreach($value as $transactions){
     
      ?>
     
          <tr>
            <td><?php echo $counter++;?></td>
            <td><?php echo $transactions['transactionid'];?></td>
            <td><?php echo $transactions['transactionref'];?></td>
            <td><?php echo $transactions['chargeamount'];?></td>
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


</div>
<?php include_once'lib/footer.php'?>