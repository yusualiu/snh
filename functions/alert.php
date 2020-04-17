<?php 

function printAlert(){
  //for printing message or error;
  $types = ['message','info','error'];
  $colors = ['green','blue','red'];
    
  for($i = 0; $i < count($types); $i++){
      
      if( isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]]) ) {
          
         echo "<span style='color:".$colors[$i].";'>".$_SESSION[$types[$i]]."</span>";
        
          session_destroy();
      }

  }

}

function dashboardMessage(){
  if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
    echo "<span style='color:green;'>".$_SESSION['message']."</span>";
    
    
  }
  if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
    echo "<span style='color:red;'>".$_SESSION['error']."</span>";
    
  }
}

