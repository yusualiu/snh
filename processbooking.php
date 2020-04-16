<?php
session_start();
require_once 'functions/user.php';

$errorCount = 0;

//sanitize input data and update error count
$fullname = clean_input($_POST['ptfullname']) != "" ? clean_input($_POST['ptfullname']) : $errorCount++;

$ptemail = clean_input($_POST['ptemail']) != "" ? clean_input($_POST['ptemail']) : $errorCount++;   
$appointmentDate = clean_input($_POST['appointdate']) != "" ? clean_input($_POST['appointdate']) : $errorCount++;   
$appointmentTime = clean_input($_POST['appointtime']) != "" ? clean_input($_POST['appointtime']) : $errorCount++;   
$natureOfAppointment = clean_input($_POST['appointnature']) != "" ? clean_input($_POST['appointnature']) : $errorCount++; 
$complaint = clean_input($_POST['complaint']) != "" ? clean_input($_POST['complaint']) : $errorCount++; 
$staffDepartment = clean_input($_POST['appointdepartment']) != "" ? clean_input($_POST['appointdepartment']) : $errorCount++;

//create sessions for patient record
$_SESSION['ptfullname'] = $fullname;
$_SESSION['ptemail'] = $ptemail;
$_SESSION['appointdate'] = $appointmentDate;
$_SESSION['appointtime'] = $appointmentTime;
$_SESSION['appointnature'] = $natureOfAppointment;
$_SESSION['complaint'] = $complaint;
$_SESSION['appointdepartment'] = $staffDepartment;

if($errorCount > 0){
  // redirect to patient and display error
  if($errorCount > 1){
    $s = 's';
  }else{
    $s = '';
  }
  $_SESSION['error'] = 'You have '.$errorCount.' error'.$s.' in your form submission';
  header('Location:patient.php');
  
}else{
  //Book patient
  

  $bookings = scandir("db/bookings/");
  $countBookers = count($bookings);
  $bookId = $countBookers-1;// counting including hidden files

  $bookingObject = [
    'id'=> $bookId,
    'patientEmail' => $ptemail,
    'appointmentDate' => $appointmentDate,
    'appointmentTime' => $appointmentTime,
    'natureOfAppointment' => $natureOfAppointment,
    'complaint' => $complaint,
    'appointmemtDepartment' => $staffDepartment,    
    'lastBookedDate' => date("F Y h:i:s A")    
  ];
    
    
    //loop throuh folder to check if file exists
    for ($counter=0; $counter < $countBookers; $counter++) { 
      if(file_exists('db/bookings/'.$staffDepartment.'.json')){
        //open or read json data
        $bookingStrings= file_get_contents('db/bookings/'.$staffDepartment.'.json'); 

        $data = json_decode($bookingStrings, true);
        unset($bookingStrings);//prevent memory leaks for large json.
         //insert record to file here
        $data[] = $bookingObject;
       
         //convert file to json and save the file         
        file_put_contents('db/bookings/'.$staffDepartment.'.json',json_encode($data));
        unset($data);//release memory
        $_SESSION['message'] = 'You have been Booked Successfully for this department again';   
        header('Location: patient.php');
        die();
        
      }

    }      
   //save unique data tofolder and book based on department
    
    $data[] = $bookingObject;
    file_put_contents('db/bookings/'.$staffDepartment.'.json',json_encode($data));
    $_SESSION['message'] = 'You have been Booked Successfully as firsttime';         
    header('Location: patient.php');
    
    
    
  
  
  
  
  
}


