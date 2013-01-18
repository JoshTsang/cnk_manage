<?php
     define('IMG_PATH', '../../user_data/tmp/');
     
     if (!isset($_FILES['img'])) {
         $ret = array('succ' => false,
                       'err' => "img?");
     } else {
         $pathinfo = pathinfo($_FILES['img']['name']);
         $fileName = time().rand(0, 1000).".".$pathinfo['extension'];
         $pathinfo = pathinfo($_FILES['img']['tmp_name']);
         move_uploaded_file($_FILES['img']['tmp_name'], IMG_PATH.$fileName);
         $ret = array('succ' => TRUE, 
                      'img' => $fileName);
     }
     
     echo json_encode($ret);
?>