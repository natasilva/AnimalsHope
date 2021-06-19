<?php

  session_start();
  session_unset();
  session_destroy();
  if(isset($_COOKIE["user_login"])){  
    setcookie ("user_login");  
  }
  if(isset($_COOKIE["user_password"])){  
    setcookie ("user_password");  
 }
  header("Location: ../templates/home.php");
?>