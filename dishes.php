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
      
      .controls-custome {
          display: inline-block;
          margin-left: 12px;
          width: 180px;
      }
      
      .control-label-custome {
          float: left;
          width: 45px;
          padding-top: 5px;
          text-align: right;
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
    <div class="modal hide fade" id="sortDishes" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>菜品排序</h3>
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
    <div class="modal hide fade" id="addDish" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建菜品</h3>
      </div>
      <div class="modal-body">
          <div style="width: 500px">
              <div style="width: 250px; float:left">
                  <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">名称</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="inputEmail" placeholder="名称">
                            <span style="color: #FF0000">*</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">价格</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="inputEmail" placeholder="价格">
                            <span style="color: #FF0000">*</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">价格2</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="inputEmail" placeholder="价格2">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome">便捷码</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" placeholder="便捷码">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">分单</label>
                        <div class="controls-custome">
                            <select class="span2">
                                <option>热菜</option>
                                <option>凉菜</option>
                            </select>
                        </div>
                    </div>
                    </form>
              </div>
              <div style="width: 250px; float:right">
                  <form class="form-horizontal">
                  <div class="control-group">
                        <label class="control-label-custome">英文名</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="inputEmail" placeholder="英文名">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">单位</label>
                        <div class="controls-custome">
                            <select class="span2">
                                <option>斤</option>
                                <option>两</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">价格3</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="inputEmail" placeholder="价格3">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail-custome">折扣</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="inputEmail" placeholder="折扣">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="inputEmail">图片</label>
                        <div class="controls-custome">
                            <button class="btn">选择文件</button>
                        </div>
                    </div>
            </form>
              </div>
          </div>
            <form class="form-horizontal">
                <label class="control-label-custome" for="description">描述</label>
                <div class="controls-custome">
                    <input style="width: 410px" type="text" id="description" placeholder="描述">
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
          			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addDish"><i class="icon-plus"></i> 新建</button>
          			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#sortDishes"><i class="icon-plus"></i> 排序</button>
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