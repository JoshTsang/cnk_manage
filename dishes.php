<?php
	require "element.php";
    require "data/db.php";
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
      
      #categories li{
          font-size: 18px;
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
                <label class="control-label" for="index">序号</label>
                <div class="controls">
                  <input type="text" id="index" placeholder="序号">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="indexNew">更后序号</label>
                <div class="controls">
                  <input type="text" id="indexNew" placeholder="更后序号">
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
      <div class="modal-body" style="overflow-y:visible;">
          <?php $elements->warningBlock("addDishWarning"); ?>
          <?php $elements->alert("nameInfo"); ?>
          <table style="width: 480px">
              <tr><td>
                  <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label-custome" for="dname">名称</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="dname" placeholder="名称">
                            <span style="color: #FF0000">*</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="price">价格</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="price" placeholder="价格">
                            <span style="color: #FF0000">*</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="price2">价格2</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="price2" placeholder="价格2">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="shortcut">便捷码</label>
                        <div class="controls-custome">
                            <input id="shortcut" class="span2" type="text" placeholder="便捷码">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="printer">分单</label>
                        <div class="controls-custome">
                            <select class="span2" id="printer">
                                <?php $elements->printerOption(); ?>
                            </select>
                        </div>
                    </div>
                    </form>
              </td>
              <td>
                  <form class="form-horizontal">
                  <div class="control-group">
                        <label class="control-label-custome" for="ename">英文名</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="ename" placeholder="英文名">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="unit">单位</label>
                        <div class="controls-custome" >
                            <select id="unit" class="span2">
                                <?php $elements->unitOption(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="price3">价格3</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="price3" placeholder="价格3">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="discount">折扣</label>
                        <div class="controls-custome">
                            <input class="span2" type="text" id="discount" placeholder="折扣">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label-custome" for="dishImg">图片</label>
                        <div class="controls-custome" >
                            <input id="dishIMG" type="file" id="dishImg"></button>
                        </div>
                    </div>
            </form>
              </tr>
              
          </table>
          <form class="form-horizontal" style="width: 500px;position: bottom">
                <label class="control-label-custome" for="description">描述</label>
                <div class="controls-custome">
                    <input style="width: 410px" type="text" id="description" placeholder="描述">
                </div>
          </form>
            
        </div>
	    <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
            <button id="addDishBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
        </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid container-custome">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list" id="categories">
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
          	<div class="action-bar">
          		<div class="pull-right">
          			<button id="showAddDishDlg" class="btn btn-primary" type="button" data-toggle="modal" data-target="#addDish"><i class="icon-plus"></i> 新建</button>
          			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#sortDishes"><i class="icon-arrow-down"></i> 排序</button>
          		</div>
          	</div>
          	<?php $elements->warningBlock("dishWarning"); ?>
            <table class="table table-striped table-bordered">
            	<thead>
            		<td width="3%">#</td><td width="15%">名称</td><td width="15%">英文名</td><td width="7%">价格</td><td width="7%">便捷码</td><td width="7%">单位</td><td width="25%">描述</td><td width="9%">分单</td><td width="12%">操作</td>
            	</thead>
            	<tbody id="dishes">
            	</tbody>
            </table>
        </div>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
	<?php include "footer.inc"; ?>
    <script type="text/javascript" src="js/dishes.js"></script>
  </body>
</html>