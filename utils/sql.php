<!DOCTYPE html>
<html lang="en">
  <?php 
    require 'common.php';
    headerInfo(); ?>

  <body>

    <?php navBar(5); ?>

    <div class="container-fluid">
        <form name="input" action="javascript:execSQL();" method="get">
            <select type="text" name="db" id="db" style="width: 10%"/>
                <option value="menu">menu</option>
                <option value="user">user</option>
            </select>
            <input id="sql" name="sql" type="text" style="width: 75%"></input> 
            <input class="btn" type="submit" value="Submit" />
        </form>
        <div class="row-fluid" id="content_data">
        </div>
    </div><!--/.fluid-container-->

    <?php include "footer.inc"; ?>
    <script src="../js/db_utils.js"></script>
  </body>
</html>
