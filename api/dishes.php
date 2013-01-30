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
        if(isset($_POST['dish'])) {
            $dish = json_decode($_POST['dish']);
            if (@$dish->id > 0) {
                $ret = $db->updateDish($dish);
            } else {
                $ret = $db->addDish($dish);
            }
        } else {
            $ret = $db->getError("dish?");
        }
    } else if ($do == 'delete') {
      if (isset($_GET['id']) && isset($_GET['cid'])) {
          $ret = $db->deleteDish($_GET['id'], $_GET['cid']);
      } else {
          $ret = $db->getError("param:id?");  
      }
    } else if ($do == 'query') {
        if(isset($_POST['dish'])) {
            $ret = $db->queryDish(json_decode($_POST['dish']));
        } else {
          $ret = $db->getError("param:dish?");  
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