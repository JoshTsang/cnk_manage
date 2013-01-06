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
      .container-custome {
        max-width: 1000px;
      }
    </style>


    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php $elements->navBar("Username", 3); ?>

    <div class="container-fluid">
      <div class="row-fluid container-custome">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="active"><a href="#">分类1</a></li>
              <li><a href="#">分类2</a></li>
              <li><a href="#">分类3</a></li>
              <li><a href="#">分类4</a></li>
              <li><a href="#">分类5</a></li>
              <li><a href="#">分类6</a></li>
              <li><a href="#">分类7</a></li>
              <li><a href="#">分类8</a></li>
              <li><a href="#">分类9</a></li>
              <li><a href="#">分类10</a></li>
              <li><a href="#">分类11</a></li>
              <li><a href="#">分类12</a></li>
              <li><a href="#">分类13</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
          	<div class="action-bar">
          		<div class="pull-right">
          			<a class="btn btn-primary" href="#"><i class="icon-plus"></i> 新建</a>
          			<a class="btn btn-primary" href="#"><i class="icon-arrow-down"></i> 排序</a>
          		</div>
          	</div>
            <table class="table table-striped table-bordered">
            	<thead>
            		<td width="3%">#</td><td width="18%">名称</td><td width="19%">英文名</td><td width="7%">便捷码</td><td width="7%">单位</td><td width="25%">描述</td><td width="9%">分单</td><td width="12%">操作</td>
            	</thead>
            	<tbody>
            		<tr><td>1</td><td>菜1</td><td>Dish 1</td><td>001</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>2</td><td>菜2</td><td>Dish 2</td><td>002</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>3</td><td>菜3</td><td>Dish 3</td><td>003</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>4</td><td>菜4</td><td>Dish 4</td><td>004</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>5</td><td>菜5</td><td>Dish 5</td><td>005</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>6</td><td>菜6</td><td>Dish 6</td><td>006</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>7</td><td>菜7</td><td>Dish 7</td><td>007</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>8</td><td>菜8</td><td>Dish 8</td><td>008</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            		<tr><td>9</td><td>菜的名字要很长</td><td>Dish 9</td><td>009</td><td>份</td><td>菜</td><td>热菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            	</tbody>
            </table>
        </div>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
	<?php include "footer.inc"; ?>
  </body>
</html>