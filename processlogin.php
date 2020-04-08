<?php 
session_start();
// Collect user data
// verifying the data, validation
$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

if($errorCount > 0){
  // redirect to register and display error
  if($errorCount > 1){
    $s = 's';
  }else{
    $s = '';
  }
  $_SESSION['error'] = 'You have '.$errorCount.' error'.$s.' in your form submission';
  header('Location:login.php');
  
}else{
  // check if email is found
  $allUsers = scandir("db/users/");
  $countUsers = count($allUsers);
  // ****Look into the folder and check if file already exist 

  for ($counter=0; $counter < $countUsers; $counter++) { 
    $currentUser = $allUsers[$counter];
    
    if($currentUser == $email.".json"){
      $userString = file_get_contents("db/users/".$currentUser); 
      $userObject = json_decode($userString);
      $passwordFromDb = $userObject->password;
      $passwordFromUser = password_verify($password,$passwordFromDb);
      
      if($passwordFromDb == $passwordFromUser){
        $_SESSION['loggedin'] = $userObject->id;
        $_SESSION['email'] = $userObject->email;
        $_SESSION['fullname'] = $userObject->first_name." ".$userObject->last_name;
        $_SESSION['role'] = $userObject->designation;
        $_SESSION['createdTime'] = $userObject->createdTime;

        // update user record in folder with lastloggedin 
        $userObject->lastLogin = date("F Y h:i:s A");
        unlink("db/users/".$currentUser);
       
        file_put_contents('db/users/'.$email.'.json',json_encode($userObject));
        $_SESSION['lastLogin']= $userObject->lastLogin;
        // User Access Level
        switch ($userObject->designation) {
          case "Super Admin(MD)":
            header('Location: admin.php');
              break;
          case "Medical Team(MT)":
            header('Location: medicalteam.php');
              break;              
          default:
            header('Location: patient.php');
      }
        
        // header('Location: dashboard.php');
        die();
      }
    }
  }
  $_SESSION['error'] = 'Invalid Email or Password';
  header('Location: login.php');
}