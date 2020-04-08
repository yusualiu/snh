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