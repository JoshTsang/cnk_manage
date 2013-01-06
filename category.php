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
    <?php $elements->navBar("Username", 2);?>

    <div class="container-fluid">
        
      <div class="row-fluid container-custome">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">菜品分类</a></li>
    <li><a href="#tab2" data-toggle="tab">单位设置</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <div class="action-bar">
            <div class="pull-right">
                <a class="btn btn-primary" href="#"><i class="icon-plus"></i> 新建</a>
                <a class="btn btn-primary" href="#"><i class="icon-arrow-down"></i> 排序</a>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td>#</td><td>分类名称</td><td>操作</td>
            </thead>
            <tbody>
                <tr><td>1</td><td>特色菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>2</td><td>凉菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>3</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>4</td><td>汤</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>5</td><td>甜点</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>6</td><td>酒水</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="tab2">
        <div class="action-bar">
            <div class="pull-right">
                <a class="btn btn-primary" href="#"><i class="icon-plus"></i> 新建</a>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="85%">单位</td><td width="10%">操作</td>
            </thead>
            <tbody>
                <tr><td>1</td><td>份</td><td class="action"><a href="#">[删除]</a></td></tr>
                <tr><td>2</td><td>斤</td><td class="action"><a href="#">[删除]</a></td></tr>
                <tr><td>3</td><td>列</td><td class="action"><a href="#">[删除]</a></td></tr>
                <tr><td>4</td><td>人</td><td class="action"><a href="#">[删除]</a></td></tr>
                <tr><td>5</td><td>半斤</td><td class="action"><a href="#">[删除]</a></td></tr>
            </tbody>
        </table>
    </div>
  </div>
</div>
        
      </div>
    </div><!--/row-->
    </div><!--/.fluid-container-->
    
    <?php include "footer.inc"; ?>
  </body>
</html>