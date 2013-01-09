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
        $ret = $db->getCategoryPrint();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>