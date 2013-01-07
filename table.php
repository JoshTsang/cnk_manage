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
    <div class="modal hide fade" id="addTable" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建桌台</h3>
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
              <div class="control-group">
                <label class="control-label" for="inputEmail">序号</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="序号">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">楼层</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="楼层">
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <a href="#" class="btn btn-primary">确定</a>
      </div>
    </div>
    <div class="modal hide fade" id="sortTable" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>桌台排序</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="inputEmail">序号</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="序号">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">更后序号</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="更后序号">
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
      			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addTable"><i class="icon-plus"></i> 新建</button>
      			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#sortTable"><i class="icon-plus"></i> 排序</button>
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
