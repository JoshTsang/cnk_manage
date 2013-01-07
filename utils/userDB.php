<!DOCTYPE html>
<html lang="en">
  <?php 
    require 'common.php';
    headerInfo(); ?>

  <body>

    <?php navBar(2); ?>

    <div class="container-fluid">

        <div class="row-fluid">
             <div class="tabbable"> <!-- Only required for left/right tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">UserInfo</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <?php showTable("../../db/user.db3", "userInfo"); ?>
                </div>
              </div>
            </div>
        </div>
    </div><!--/.fluid-container-->

    <?php include "footer.inc"; ?>
  </body>
</html>
