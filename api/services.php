<?php
    require '../data/define.inc';
    require '../data/db.php';
    
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'get';
    }
    
    $db = new DB();
    $ret = FALSE;
    if ($do == 'set') {
        if (isset($_GET['name'])) {
            $ret = $db->addService($_GET['name']);
        } else {
            $ret = $db->getError("name?");
        }
    } else if($do == 'delete') {
        if (isset($_GET['id'])) {
            $ret = $db->deleteService($_GET['id']);
        } else {
            $ret = $db->getError("id?");
        }
    }else {
        $ret = $db->getServices();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>