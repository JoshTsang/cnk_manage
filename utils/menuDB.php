<!DOCTYPE html>
<html lang="en">
  <?php 
    require 'common.php';
    headerInfo(); ?>

  <body>

    <?php navBar(1); ?>

    <div class="container-fluid">

        <div class="row-fluid">
             <div class="tabbable"> <!-- Only required for left/right tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">菜</a></li>
                <li><a href="#tab2" data-toggle="tab">菜-分类</a></li>
                <li><a href="#tab3" data-toggle="tab">厨打</a></li>
                <li><a href="#tab4" data-toggle="tab">分类</a></li>
                <li><a href="#tab5" data-toggle="tab">单位</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php showTable("../../db/dish.db3", "dishInfo"); ?>
                </div>
                <div class="tab-pane" id="tab2">
                    <?php showTable("../../db/dish.db3", "dishCategory"); ?>
                </div>
                <div class="tab-pane" id="tab3">
                    <?php showTable("../../db/dish.db3", "sortPrint"); ?>
                </div>
                <div class="tab-pane" id="tab4">
                    <?php showTable("../../db/dish.db3", "category"); ?>
                </div>
                <div class="tab-pane" id="tab5">
                    <?php showTable("../../db/dish.db3", "unit"); ?>
                </div>
              </div>
            </div>
        </div>
    </div><!--/.fluid-container-->

    <?php include "footer.inc"; ?>
  </body>
</html>
