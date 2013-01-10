<!DOCTYPE html>
<html lang="en">
  <?php 
    require 'common.php';
    headerInfo(); ?>

  <body>

    <?php navBar(6); ?>

    <div class="container-fluid">

        <div class="row-fluid">
            <?php
            //exec("ln -s /cainaoke/phphome/var/log/php_errors.log ");
            @$ret = file_get_contents("/cainaoke/phphome/var/log/php_errors.log");
            echo "<textarea id=\"shell\" style=\"width:98%;height:480px\">$ret</textarea>";
            // echo $ret;
            ?>
        </div>
    </div><!--/.fluid-container-->

    <?php include "footer.inc"; ?>
  </body>
</html>
