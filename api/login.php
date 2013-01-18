<?php
    require '../data/define.inc';
    require '../data/db.php';
    
    $db = new DB();
    if (!isset($_POST['user'])) {
       $ret = $db->getError('user?');
    } else {
        $user = json_decode($_POST['user']); 
        
        if(isset($user->name) && isset($user->passwd)) {
            session_start();
            $ret = $db->login($user->name, $user->passwd);
        } else {
            $ret = $db->getError("user name/pwd?");
        }
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>