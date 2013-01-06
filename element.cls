<?php
    class element {
        public function navBar($username, $active) {
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
            echo $username;
            echo ', <a href="#" class="navbar-link"> 退出</a>
                            </p>';
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
        }

        public function css() {
            echo '<link href="css/bootstrap.css" rel="stylesheet">
                  <link href="css/manage.css" rel="stylesheet">';
        }
    }
?>