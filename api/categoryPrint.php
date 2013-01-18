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
        if (isset($_POST['categoryPrint'])) {
            $obj = json_decode($_POST['categoryPrint']);
            $ret = $db->updateCategoryPrint($obj);
        } else {
            $ret = $db->getError("categoryPrint?");
        }
    } else {
        $ret = $db->getCategoryPrint();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>