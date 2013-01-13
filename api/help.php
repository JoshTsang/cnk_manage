<?php
   require '../permission.php';
   
   if (!isset($_POST['what'])) {
       $ret = "{\"succ\":false}";
   } else {
       $obj['succ'] = TRUE;
       switch (strtolower($_POST['what'])) {
           case 'permissionpad':
               $obj['title'] = "Pad权限";
               $permisson = new Permission();
               $obj['content'] = $permisson->permissionHelp('pad');
               break;
           case 'permissionfg':
               $obj['title'] = "前台权限";
               $permisson = new Permission();
               $obj['content'] = $permisson->permissionHelp('fg');
               break;
           case 'permissionbg':
               $obj['title'] = "后台权限";
               $permisson = new Permission();
               $obj['content'] = $permisson->permissionHelp('bg');
               break;
           default:
               $obj['succ'] = FALSE;
       }
       $ret = json_encode($obj);
   }
   
   echo $ret;
?>