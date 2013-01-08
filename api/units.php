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
        if(isset($_GET['unit'])) {
            $ret = $db->addUnit($_GET['unit']);
        } else {
            $ret = $db->getError("param?unit");
        }
    } else if ($do == 'delete') {
        if (isset($_GET['id'])) {
            $ret = $db->deleteUnit($_GET['id']);
        } else {
            $ret = $db->getError("param?id");
        }
    } else {
        $ret = $db->getUnits();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>