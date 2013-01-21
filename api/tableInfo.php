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
        if (isset($_POST['table'])) {
            $table = json_decode($_POST['table']);
            if (@$table->id > 0) {
                $ret = $db->updateTable($table);
            } else {
                $ret = $db->addTable($table);
            }
        } else {
            $ret = $db->getError("param:table?");
        }
    } else if ($do == 'sort') {
        if (isset($_POST['table'])) {
            $table = json_decode($_POST['table']);
            $ret = $db->updateTableIndex($table);
        } else {
            $ret = $db->getError("param:table?");
        }
    } else if ($do == 'delete') {
      if (isset($_GET['id'])) {
          $ret = $db->deleteTable($_GET['id']);
      } else {
          $ret = $db->getError("param:id?");
      }
    } else {
        $ret = $db->getTableInfo();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }
?>