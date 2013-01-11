<?php
    require "element.php";
    $elements = new element();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>菜脑壳后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <?php $elements->css();?>
    <style type="text/css">
      body {
        padding-top: 60px;
        height: 100%;
      }
    </style>

    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php $elements->navBar("Username", 4); ?>
    <div class="modal hide fade" id="addFlavor" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建口味</h3>
      </div>
      <div class="modal-body">
        <?php $elements->warningBlock("addFlavorWarning"); ?>
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="name">名称</label>
                <div class="controls">
                  <input type="text" id="name" placeholder="名称">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button id="addFlavorBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
      </div>
    </div>
    
    <div class="container-fluid">
      <div class="row-fluid container-custome">
        <div class="action-bar">
            <div class="pull-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addFlavor"><i class="icon-plus"></i> 新建</button>
            </div>
        </div>
        <?php $elements->warningBlock("flavorWarning"); ?>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="80%">口味</td><td width="15%">操作</td>
            </thead>
            <tbody id="flavors">
            </tbody>
        </table>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
    <?php include "footer.inc"; ?>
    <script type="text/javascript" src="js/flavor.js"></script>
  </body>
</html>
