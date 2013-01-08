<?php
    require '../data/define.inc';
    require '../data/db.php';
    
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'get';
    }
    
    $db = new DB();
    if ($do == 'set') {
        
    } else {
        $ret = $db->getUserInfo();
        if ($ret) {
            echo $ret;
        } else {
            echo $db->getError();
        }
    }
?>