<!DOCTYPE html>
<html lang="en">
  <?php 
    require 'common.php';
    headerInfo(); ?>

  <body>

    <?php navBar(4); ?>

    <div class="container-fluid">

        <div class="row-fluid">
             <div class="tabbable"> <!-- Only required for left/right tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Dish</a></li>
                <li><a href="#tab2" data-toggle="tab">User</a></li>
                <li><a href="#tab3" data-toggle="tab">Order</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php showTable("../../db/dish.db3", "sqlite_master"); ?>
                </div>
                <div class="tab-pane" id="tab2">
                    <?php showTable("../../db/user.db3", "sqlite_master"); ?>
                </div>
                <div class="tab-pane" id="tab3">
                    <?php showTable("../../db/temporary/orderInfo.db3", "sqlite_master"); ?>
                </div>
              </div>
            </div>
        </div>
    </div><!--/.fluid-container-->

    <?php include "footer.inc"; ?>
  </body>
</html>
