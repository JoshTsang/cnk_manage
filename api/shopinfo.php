<?php
   require '../data/define.inc';
    define('SHOP_INFO', '../conf/shopInfo.conf');
    
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = 'get';
    }
    
    $ret = "{\"succ\":\"false\"}";
    if ($do == 'set') {
        
    } else {
        if (file_exists(SHOP_INFO)) {
            $ret = file_get_contents(SHOP_INFO);
        } else {
            $shopInfo = array('name' => "菜脑壳电子点菜系统", 
                          'addr' => "",
                          'tel' => "");
            $ret = json_encode($shopInfo);
        }
    } 
    
    echo $ret;
?>