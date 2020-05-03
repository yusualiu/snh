<?php
session_start();
require_once 'functions/user.php';
// Collect user data
// verifying the data, validation
$errorCount = 0;


$first_name = clean_input($_POST['first_name']) != "" ? clean_input($_POST['first_name']) : $errorCount++;
$last_name = clean_input($_POST['last_name']) != "" ? clean_input($_POST['last_name']) : $errorCount++;
$email = clean_input($_POST['email']) != "" ? clean_input($_POST['email']) : $errorCount++;    
$password = clean_input($_POST['password']) != "" ? clean_input($_POST['password']) : $errorCount++;
$gender = clean_input($_POST['gender']) != "" ? clean_input($_POST['gender']) : $errorCount++;
$designation = clean_input($_POST['designation']) != "" ? clean_input($_POST['designation']) : $errorCount++;
$department = clean_input($_POST['department']) != "" ? clean_input($_POST['department']) : $errorCount++;

// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;


if($errorCount > 0){
  // redirect to register and display error
  if($errorCount > 1){
    $s = 's';
  }else{
    $s = '';
  }
  $_SESSION['error'] = 'You have '.$errorCount.' error'.$s.' in your form submission';
 
  redirectUrl('register.php');
  
}else{
  //save unique data tofolder

  $allUsers = scandir("db/users/");
  $countUsers = count($allUsers);
  $userId = $countUsers-1;// counting including hidden files
 
  // saving the data into the database(folder)
  
  $user_object = [
    'id'=> $userId,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'password'=> password_hash($password,PASSWORD_DEFAULT),
    'email' => $email,
    'gender' =>$gender,
    'designation' =>$designation,
    'department'=> $department,
    'createdTime'=> date("Y-m-d h:i:s"),
    'lastLogin'=> ""
  ];

  // ****Look into the folder and check if file already exist 

  for ($counter=0; $counter < $countUsers; $counter++) { 
    $currentUser = $allUsers[$counter];
    if($currentUser == $email.".json"){
      $_SESSION['error'] = 'Registration Failed, user already exist!';
      redirectUrl('register.php');
      exit();
      
    }
  }
  //save object at created time to folder
  
  
  file_put_contents('db/users/'.$email.'.json',json_encode($user_object));
  if(isset($_SESSION['role']) && $_SESSION['role']=="Super Admin(MD)"){
    $_SESSION['message'] = 'Registration Successfull,User '.$first_name.' can now login!';
  }else{
    $_SESSION['message'] = 'Registration Successfull, you can now login!'.$first_name;
  }
   
  redirectUrl('login.php');  
  
}




