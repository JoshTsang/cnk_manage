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
      .testing {
            position: fixed;
            top: 45%;
            left: 45%;
            z-index: 1050;
            padding-top:10px;
            padding-left:20px;
            width: 100px;
            background-color: white;
            border: 1px solid #999;
            border: 1px solid rgba(0, 0, 0, 0.3);
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
            outline: none;
            -webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding-box;
            background-clip: padding-box;
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
    <div class="testing hide" id="testing" role="dialog">
        <div >
            <p>
                <img style="width:15px;height:15px;" src="img/loading_circle.gif"> 测试中...
            </p>
        </div>
    </div>
    <div class="modal hide fade" id="addPrinter" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建打印机</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="name">名称</label>
                <div class="controls">
                  <input type="text" id="name" placeholder="名称">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="ipAddr">IP地址</label>
                <div class="controls">
                  <input type="text" id="ipAddr" placeholder="IP地址">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="type">类型</label>
                <div class="controls">
                  <select id="type">
                      <option>58打印机</option>
                      <option>80打印机</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="title">抬头</label>
                <div class="controls">
                  <select id="title">
                      <option>顾客联</option>
                      <option>存根联</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="receipt">内容</label>
                <div class="controls">
                  <select id="receipt">
                      <option>收银</option>
                      <option>统计</option>
                      <option>厨打</option>
                  </select>
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
    <li class="active"><a href="#tab1" data-toggle="tab">打印机</a></li>
    <li><a href="#tab2" data-toggle="tab">店铺信息</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">更多<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="javascript:OnTestClick()">测试</a></li>
        </ul>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <div class="action-bar">
            <div class="pull-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addPrinter"><i class="icon-plus"></i> 新建</button>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="3%">#</td><td width="19%">名称</td><td width="20%">IP地址</td><td width="17%">打印机类型</td><td width="15%">打印联抬头</td><td width="14%">打印内容</td><td width="12%">操作</td>
            </thead>
            <tbody id="printers">
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="tab2">
        <div class="action-bar">
            <div class="pull-right">
                <a class="btn btn-primary" href="#"><i class="icon-ok-sign"></i> 保存</a>
            </div>
        </div>
        <form class="form-horizontal well">
              <div class="control-group">
                <label class="control-label" for="shopname">名称</label>
                <div class="controls">
                  <input type="text" id="shopname" placeholder="店铺名称" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="shopAddr">地址</label>
                <div class="controls">
                  <input type="text" id="shopAddr" placeholder="店铺地址">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="shopTel">电话</label>
                <div class="controls">
                  <input type="text" id="shopTel" placeholder="店铺电话">
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
    <script type="text/javascript" src="js/printers.js"></script>
  </body>
</html>