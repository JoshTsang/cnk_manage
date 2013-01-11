<?php
    require '../data/define.inc';
    require '../data/db.php';
    require '../permission.php';
    
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'get';
    }
    
    $db = new DB();
    if ($do == 'set') {
        if(isset($_POST['user'])) {
            $user = json_decode($_POST['user']);
            if (@$user->id > 0) {
                $ret = $db->updateUserInfo($user);
            } else {
                $ret = $db->addUser($user);
            }
        } else {
            $ret = $db->getError("user?");
        }
    } else if ($do == 'delete') {
        if (isset($_GET['id'])) {
            $ret = $db->deleteUser($_GET['id']);
        } else {
            $ret = $db->getError("param?id");
        }
    } else {
        $ret = $db->getUserInfo();
    }
    
    if ($ret) {
        echo $ret;
    } else {
        echo $db->getError();
    }

?>