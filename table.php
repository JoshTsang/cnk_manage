<?php
	require "element.php";
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
    <?php $elements->navBar("Username", 1); ?>
    <div class="modal hide fade" id="addTable" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3></h3>
      </div>
      <div class="modal-body">
        <?php $elements->warningBlock("addTableWarning"); ?>
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="tableName">名称</label>
                <div class="controls">
                  <input type="text" id="tableName" placeholder="名称">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="tableIndex">序号</label>
                <div class="controls">
                  <input type="text" id="tableIndex" placeholder="序号">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="tableFloor">楼层</label>
                <div class="controls">
                  <input type="text" id="tableFloor" placeholder="楼层">
                </div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button id="addTableBtn" class="btn btn-primary"  data-loading-text="提交中...">确定</button>
      </div>
    </div>
    <div class="modal hide fade" id="sortTable" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>排序</h3>
      </div>
      <div class="modal-body">
        <?php $elements->warningBlock("sortTableWarning"); ?>
        <ul id="sortable">
        </ul>
      </div>
      <div class="modal-footer">
        <span class="alert alert-info">拖拽桌台排序</span>
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button id="tableSortBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid container-custome">
      	<div class="action-bar">
      		<div class="pull-right">
      			<button id="showAddDlg" class="btn btn-primary" type="button" data-toggle="modal" data-target="#addTable"><i class="icon-plus"></i> 新建</button>
      			<button id="showSortDlg" class="btn btn-primary" type="button" data-toggle="modal" data-target="#sortTable"><i class="icon-arrow-down"></i> 排序</button>
      		</div>
      	</div>
      	<?php $elements->warningBlock("tableWarning"); ?>
        <table class="table table-striped table-bordered">
        	<thead>
        		<td width="5%">#</td><td width="60%">桌号</td><td width="20%">所属区域/楼层</td><td width="15%">操作</td>
        	</thead>
        	<tbody id="tables">
        	</tbody>
        </table>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
	<?php include "footer.inc"; ?>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/table.js"></script>
	<script>
      $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
      });
    </script>
  </body>
</html>
