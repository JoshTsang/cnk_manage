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
          $ret = $db->deleteCategory($_GET['id']);
      } else {
          $ret = $db->getError("param:id?");
      }
    } else {
        $ret = $db->getCategories();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>