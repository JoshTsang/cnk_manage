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
        
    } else if ($do == 'delete') {
      if (isset($_GET['id'])) {
          $ret = $db->deleteDish($_GET['id']);
      } else {
          $ret = $db->getError("param:id?");
      }
    } else {
        if (isset($_GET['cid'])) {
            $ret = $db->getDishes($_GET['cid']);
        } else {
            $ret = $db->getError("param:cid?");
        }
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>