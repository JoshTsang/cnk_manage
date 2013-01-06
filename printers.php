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
    <?php $elements->navBar("Username", 6);?>

    <div class="container-fluid">
        
      <div class="row-fluid container-custome">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">打印机</a></li>
    <li><a href="#tab2" data-toggle="tab">店铺信息</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">更多<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">测试</a></li>
        </ul>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <div class="action-bar">
            <div class="pull-right">
                <a class="btn btn-primary" href="#"><i class="icon-plus"></i> 新建</a>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="3%">#</td><td width="19%">名称</td><td width="20%">IP地址</td><td width="17%">打印机类型</td><td width="15%">打印联抬头</td><td width="14%">打印内容</td><td width="12%">操作</td>
            </thead>
            <tbody>
                <tr><td>1<td>打印机1</td><td>192.168.0.10</td><td>80打印机</td><td>存根联</td><td>收银</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>2<td>打印机2</td><td>192.168.0.11</td><td>80打印机</td><td>存根联</td><td>统计</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>3<td>打印机3</td><td>192.168.0.12</td><td>80打印机</td><td>存根联</td><td>厨打</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
                <tr><td>4<td>打印机4</td><td>192.168.0.13</td><td>80打印机</td><td>存根联</td><td>点菜</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="tab2">
        <div class="action-bar">
            <div class="pull-right">
                <a class="btn btn-primary" href="#">保存</a>
            </div>
        </div>
        <form class="form-horizontal well">
              <div class="control-group">
                <label class="control-label" for="inputEmail">名称</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="店铺名称">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">地址</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="店铺地址">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="inputEmail">电话</label>
                <div class="controls">
                  <input type="text" id="inputEmail" placeholder="店铺电话">
                </div>
              </div>
        </form>
    </div>
  </div>
</div>
        
      </div>
    </div><!--/row-->
    </div><!--/.fluid-container-->
    
    <?php include "footer.inc"; ?>
  </body>
</html>