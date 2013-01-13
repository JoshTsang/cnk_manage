<?php
   session_start();
   $_SESSION['logedin'] = FALSE;
   $url="login.php";
   header("Location: $url"); 
?>