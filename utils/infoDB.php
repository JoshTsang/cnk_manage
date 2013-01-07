<!DOCTYPE html>
<html lang="en">
  <?php 
    require 'common.php';
    headerInfo(); ?>

  <body>

    <?php navBar(3); ?>

    <div class="container-fluid">

        <div class="row-fluid">
             <div class="tabbable"> <!-- Only required for left/right tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Services</a></li>
                <li><a href="#tab2" data-toggle="tab">Tables</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php showTable("../../db/temporary/orderInfo.db3", "serviceList"); ?>
                </div>
                <div class="tab-pane" id="tab2">
                    <?php showTable("../../db/temporary/orderInfo.db3", "tableInfo"); ?>
                </div>
              </div>
            </div>
        </div>
    </div><!--/.fluid-container-->

    <?php include "footer.inc"; ?>
  </body>
</html>
