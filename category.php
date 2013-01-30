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
    <link href="css/jquery-ui.min.css" rel="stylesheet" />
    <?php $elements->css();?>
    <style type="text/css">
      body {
        padding-top: 60px;
        height: 100%;
      }
      
      #sortable {
        list-style-type: none;
        margin: auto;
        padding: 0;
        width: 100%;
      }
      
      #sortable li {
         margin: 3px 3px 3px 0;
         padding: 7px;
         float: left;
         /*width: 90px;*/
         font-size: 2em;
         color: #FFFFFF;
         text-align: center;
         vertical-align: middle;
         border: 1px;
         border-color:#002A80;
         background-color: #0D7BD5;
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
        <?php $elements->warningBlock("addCategoryWarning"); ?>
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
        <button id="addCategoryBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
      </div>
    </div>
    <div class="modal hide fade" id="addUnit" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建单位</h3>
      </div>
      <div class="modal-body">
        <?php $elements->warningBlock("addUnitWarning"); ?>
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
        <button id="addUnitBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
      </div>
    </div>
    <div class="modal hide fade" id="sortCategory" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>分类排序</h3>
      </div>
      <div class="modal-body">
        <?php $elements->warningBlock("sortCategoryWarning"); ?>
        <ul id="sortable">
          
        </ul>
      </div>
      <div class="modal-footer">
        <span class="alert alert-info">拖拽分类排序</span>
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button id="categorySortBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
      </div>
    </div>
    <div class="modal hide fade" id="categoryPrintDlg" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>分类打印</h3>
      </div>
      <div class="modal-body">
          <?php $elements->warningBlock("categoryPrintWarning"); ?>
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="printer">选择打印机: </label>
                <div class="controls">
                    <select class="span2" id="printer">
                        <?php $elements->printerOption(); ?>
                    </select>
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <a id="categoryPrintBtn" class="btn btn-primary">确定</a>
      </div>
    </div>
    <div class="container-fluid">
        
      <div class="row-fluid container-custome">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">菜品分类</a></li>
    <li><a href="#tab2" data-toggle="tab">分类打印</a></li>
    <li><a href="#tab3" data-toggle="tab">单位设置</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <div class="action-bar">
            <div class="pull-right">
                <button id="showAddCategoryDlg" class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCategory"><i class="icon-plus"></i> 新建</button>
                <button id="showSortDlg" class="btn btn-primary" type="button" data-toggle="modal" data-target="#sortCategory"><i class="icon-arrow-down"></i> 排序</button>
            </div>
        </div>
        <?php $elements->warningBlock("categoryWarning"); ?>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="80%">分类名称</td><td width="15%">操作</td>
            </thead>
            <tbody id="categories">
                
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="tab2">
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="35%">分类</td><td width="50%">打印机</td><td width="10%">操作</td>
            </thead>
            <tbody id="categoryPrint">
                
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="tab3">
        <div class="action-bar">
            <div class="pull-right">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addUnit"><i class="icon-plus"></i> 新建</button>
            </div>
        </div>
        <?php $elements->warningBlock("unitWarning"); ?>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="85%">单位</td><td width="10%">操作</td>
            </thead>
            <tbody id="units">
                
            </tbody>
        </table>
    </div>
  </div>
</div>
        
      </div>
    </div><!--/row-->
    </div><!--/.fluid-container-->
    <?php include "footer.inc"; ?>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/category.js"></script>
    <script type="text/javascript" src="js/units.js"></script>
    <script>
      $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
      });
    </script>
  </body>
</html>