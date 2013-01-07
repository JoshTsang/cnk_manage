<?php
    require "element.cls";
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
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="inputEmail">名称</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="名称">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <a href="#" class="btn btn-primary">确定</a>
      </div>
    </div>
    
    <div class="container-fluid">
      <div class="row-fluid container-custome">
        <div class="action-bar">
            <div class="pull-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addFlavor"><i class="icon-plus"></i> 新建</button>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="80%">口味</td><td width="15%">操作</td>
            </thead>
            <tbody>
                <tr><td>1</td><td>酸</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>2</td><td>甜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>3</td><td>苦</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>4</td><td>辣</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>5</td><td>微辣</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>6</td><td>很辣</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            </tbody>
        </table>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
    <?php include "footer.inc"; ?>
  </body>
</html>