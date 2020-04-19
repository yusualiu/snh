<?php

function is_user_logged_in(){
  if($_SESSION['loggedin'] && !empty($_SESSION['loggedin'])){
    return true;
  }
  return false;
}

function is_token_set(){

  return is_token_set_in_get() || is_token_set_in_session();

}

function is_token_set_in_session(){

  return  isset($_SESSION['token']);

}

function is_token_set_in_get(){

  return isset($_GET['token']); 

}

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function generateToken(){
  $token = ""; 

  $alphabets = ['a','b','c','d','e','f','g','h','A','B','C','D','E','F','G','H'];

  for($i = 0 ; $i < 26 ; $i++){

    $index = mt_rand(0,count($alphabets)-1);
    $token .= $alphabets[$index];
  }

  return $token;
}


function redirectUrl($url = ''){

  header("Location: " . $url);

}


function sendEmail(
  $subject = "", 
  $message = "",
  $email = ""
  ){
  
  $headers = "From: no-reply@snh.org" . "\r\n" .
  "CC: aliuiyusuf@snh.org";

  $try = mail($email,$subject,$message,$headers);

  if($try){
      
      set_alert('message',"Password reset has been sent to your email: " . $email);        
      redirect_to("login.php");

  }else{
      
      set_alert('error',"Something went wrong, we could not send password reset to :" . $email);             
      redirect_to("forgot.php");
  }

}