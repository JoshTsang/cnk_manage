<?php
    require 'MDetect.php';
    define('V1', "../manageV1/index.php");
    define('V2', "login.php");
    
    $detect = new Mobile_Detect();
    if ($detect->cnkGrade() == "A") {
        $url = V2;
    } else {
        $url = V1;
    }

    header("Location: $url");
?>