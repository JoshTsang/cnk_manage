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
    <?php $elements->navBar("Username", 1); ?>

    <div class="container-fluid">
      <div class="row-fluid container-custome">
      	<div class="action-bar">
      		<div class="pull-right">
      			<a class="btn btn-primary" href="#"><i class="icon-plus"></i> 新建</a>
      		</div>
      	</div>
        <table class="table table-striped table-bordered">
        	<thead>
        		<td width="5%">#</td><td width="60%">桌号</td><td width="20%">所属区域/楼层</td><td width="15%">操作</td>
        	</thead>
        	<tbody>
        		<tr><td>1</td><td>1</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>2</td><td>2</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>3</td><td>3</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>4</td><td>4</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>5</td><td>5</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>6</td><td>6</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>7</td><td>7</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>8</td><td>8</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        		<tr><td>9</td><td>9</td><td>1</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
        	</tbody>
        </table>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
	<?php include "footer.inc"; ?>
  </body>
</html>
