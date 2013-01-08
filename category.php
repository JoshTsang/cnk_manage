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
    <div class="modal hide fade" id="addCategory" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建分类</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="cname">名称</label>
                <div class="controls">
                  <input type="text" id="cname" placeholder="名称">
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
    <div class="modal hide fade" id="addUnit" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建单位</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="unitName">名称</label>
                <div class="controls">
                  <input type="text" id="unitName" placeholder="名称">
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
    <div class="modal hide fade" id="sortCategory" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>分类排序</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="cIndexOrig">序号</label>
                <div class="controls">
                  <input type="text" id="cIndexOrig" placeholder="序号">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="cIndexNew">更后序号</label>
                <div class="controls">
                  <input type="text" id="cIndexNew" placeholder="更后序号">
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
        <div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">菜品分类</a></li>
    <li><a href="#tab2" data-toggle="tab">单位设置</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <div class="action-bar">
            <div class="pull-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCategory"><i class="icon-plus"></i> 新建</button>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#sortCategory"><i class="icon-arrow-down"></i> 排序</button>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="80%">分类名称</td><td width="15%">操作</td>
            </thead>
            <tbody id="categories">
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
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addUnit"><i class="icon-plus"></i> 新建</button>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="85%">单位</td><td width="10%">操作</td>
            </thead>
            <tbody id="units">
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