<?php
session_start();

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$_SESSION['email'] = $email;

if($errorCount > 0){
  // redirect to forgot and display error
  if($errorCount > 1){
    $s = 's';
  }else{
    $s = '';
  }
  $_SESSION['error'] = 'You have '.$errorCount.' error'.$s.' in your form submission';
  header('Location:forgot.php');
  
}else{
  $allUsers = scandir("db/users/");
  $countUsers = count($allUsers);
   // ****Look into the folder and check if file already exist 

   for ($counter=0; $counter < $countUsers; $counter++) { 
    $currentUser = $allUsers[$counter];
    if($currentUser == $email.".json"){
     // send email to the email found
      // Generating Token 

      $token = ""; 

      $alphabets = ['a','b','c','d','e','f','g','h','A','B','C','D','E','F','G','H'];
  
      for($i = 0 ; $i < 26 ; $i++){
  
        $index = mt_rand(0,count($alphabets)-1);
        $token .= $alphabets[$index];
      }

      $subject = "SNG HOSPITAL PASSWORD RESET LINK";
      $message = "A password reset has been initiated from your account, please visit: localhost/snh/reset.php?token=".$token." to reset your password. If you have not initiated this action kindly ignore this email.";
      $headers = "From: no-reply@snh.org" . "\r\n" .
      "CC: aliuyusuf@snh.org";
      //save token to folders
      file_put_contents('db/tokens/'.$email.'.json',json_encode(['token'=>$token]));
     

      $try = mail($email,$subject,$message,$headers);
      
      if($try){
        //Display success message
        $_SESSION['message'] = 'Please click the link sent to '.$email.' to reset your password';
        header('Location: login.php');

      }else{
        //Display error message
        $_SESSION['error'] = 'Something went wrong and we could not send the reset link to '.$email;
        header('Location: forgot.php');
      }

      die();
      
    }
  }
  
  $_SESSION['error'] = 'Email not found in our system ERR! '.$email;
  header('Location: forgot.php');
}