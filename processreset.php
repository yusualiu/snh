<?php

session_start();

$errorCount = 0;

if(!$_SESSION['loggedin']){
  $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
  $_SESSION['token'] = $token;
}

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
  header('Location:reset.php');
  
}else{
//Check if email exist in token folder
// Check if input token matches token in the registered email

  $allUsersToken = scandir("db/tokens/");
  $countUsersToken = count($allUsersToken);
   // ****Look into the folder and check if file already exist 

   for ($counter=0; $counter < $countUsersToken; $counter++) { 
    $currentTokenFile = $allUsersToken[$counter];
    if($currentTokenFile == $email.".json"){
      $tokenString = file_get_contents("db/tokens/".$currentTokenFile); 
      $tokenObject = json_decode($tokenString);
      $tokenFromDb = $tokenObject->token;
      if($_SESSION['loggedin']){
        $checkToken = true;
      }else{
        $checkToken = $tokenFromDb == $token;
      }
     
     if($checkToken){
        // Loop through users and update specific user record;
        $allUsers = scandir("db/users/");
        $countUsers = count($allUsers);
        // ****Look into the folder and check if file already exist 

        for ($counter=0; $counter < $countUsers; $counter++) { 
          $currentUser = $allUsers[$counter];
          
          if($currentUser == $email.".json"){
            $userString = file_get_contents("db/users/".$currentUser); 
            $userObject = json_decode($userString);
            $userObject->password = password_hash($password,PASSWORD_DEFAULT);
            unlink("db/users/".$currentUser);
            //save object to folders
            file_put_contents('db/users/'.$email.'.json',json_encode($userObject));
            $_SESSION['message'] = 'Password has been Updated Successfully!'.$first_name;
            /**Inform user about password update */
            $subject = "SNG HOSPITAL PASSWORD UPDATE SUCCESSFUL";
            $message = "Your password hasbeen updated successfully if you have not initiated this action please visit: localhost/snh to reset your password immediately. ";
            $headers = "From: no-reply@snh.org" . "\r\n" .
            "CC: aliuyusuf@snh.org";
            $try = mail($email,$subject,$message,$headers);
            header('Location: login.php');  
            die(); 
          }
        }
      
     }
      
     
      
    }
  }
  
  $_SESSION['error'] = 'Password reset Failed, Invalid or Expired token';
  header('Location: login.php');

}

