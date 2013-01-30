<?php
    define('MENU_DB', '../db/dish.db3');
    
    define('CATEGORIES', "category");
    define('UNITS', 'unit');
    define("DISHES", 'dishInfo');
    define("DISH_CATEGORY", "dishCategory");
    define("PRINTERS", 'sortPrint');
    class element {
        function __construct() {
            session_start();
            if (!$_SESSION['logedin']) {
                $url="login.php";
                header("Location: $url");
            } else if ((time()-$_SESSION['time']) > 1800) {
                $_SESSION['logedin'] = false;
                
                $url="login.php";
                header("Location: $url");
            }
            $_SESSION['time'] = time();
        }
        
        public function navBar($username, $active) {
            echo '<script type="text/javascript">"use strict";</script>';
        	echo '<script type="text/javascript" src="js/lib.js"></script>';
            echo '<div class="navbar navbar-inverse navbar-fixed-top">
                      <div class="navbar-inner">
                        <div class="container-fluid">
                          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </a>
                          <div class="brand brand-custome"><img src="img/logo.png" border="0" width="115px"/></div>
                          <div class="nav-collapse collapse"><p class="navbar-text pull-right">';
            echo '<span id="username">'.$this->getUserName().'</span>';
            echo ', <a href="logout.php" class="navbar-link"> 退出</a> | <a href="../manageV1/index.php" class="navbar-link">回旧版</a>
                            </p><span id="permission" class="hide">'.$this->getPermission().'</span>';
            echo '<ul class="nav">';
            echo  '<li '.($active==1?'class="active"':"").'><a href="'.($active==1?'#':'table.php').'">桌台</a></li>';
            echo  '<li '.($active==2?'class="active"':"").'><a href="'.($active==2?'#':'category.php').'">分类</a></li>';
            echo  '<li '.($active==3?'class="active"':"").'><a href="'.($active==3?'#':'dishes.php').'">菜品</a></li>';
            echo  '<li '.($active==4?'class="active"':"").'><a href="'.($active==4?'#':'flavor.php').'">口味</a></li>';
            echo  '<li '.($active==5?'class="active"':"").'><a href="'.($active==5?'#':'services.php').'">服务</a></li>';
            echo  '<li '.($active==6?'class="active"':"").'><a href="'.($active==6?'#':'printers.php').'">打印机</a></li>';
            echo  '<li '.($active==7?'class="active"':"").'><a href="'.($active==7?'#':'users.php').'">用户</a></li>';
            echo '</ul>';
            
          echo '</div><!--/.nav-collapse -->
                    </div>
                  </div>
                </div>';
           $this->alertDlg();
        }

        public function warningBlock($id) {
            $this->alert($id);
        }

        public function alert($id) {
            echo '<div id="'.$id.'">
                    </div>';
        }
        
        public function css() {
            echo '<link href="css/bootstrap.css" rel="stylesheet">
                  <link href="css/manage.css" rel="stylesheet">';
        }
        
        public function unitOption() {
            $db = new DB();
            $ret = $db->getUnits();
    
            if (!$ret) {
                echo "";
            } else {
                $units = json_decode($ret);
                $count = count($units);
                for ($i=0; $i<$count; $i++) {
                    echo "<option value=\"".$units[$i]->id."\">".$units[$i]->name."</option>";
                }
            }
        }
        
        public function printerOption() {
            $db = new DB();
            $ret = $db->getPrinters();
    
            if (!$ret) {
                echo "";
            } else {
                $printers = json_decode($ret);
                $count = count($printers);
                for ($i=0; $i<$count; $i++) {
                    echo "<option value=\"".$printers[$i]->id."\">".$printers[$i]->name."</option>";
                }
            }
        }
        
        private function getUserName() {
            return $_SESSION['user'];
        }
        
        private function getPermission() {
            return $_SESSION['permission'];
        }
        private function alertDlg() {
            echo '<div class="modal hide fade" id="alertDlg" role="dialog">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 id="alertTitle"></h3>
                       </div>
                      <div id="alertMsg" class="modal-body">
                        
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
                        <a id="alertPositiveBtn" href="#" class="btn btn-primary" data-dismiss="modal">确定</a>
                      </div>
                    </div>';
        }
    }
?>