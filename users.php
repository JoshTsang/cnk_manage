<?php
    require "element.php";
    require 'permission.php';
    $elements = new element();
    $permission = new Permission();
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
    <?php $elements->navBar("Username", 7); ?>
    <div class="modal hide fade" id="addUser" role="dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>新建用户</h3>
      </div>
      <div class="modal-body">
        <?php $elements->warningBlock("addUserWarning"); ?>
        <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="uname">用户名</label>
                <div class="controls">
                  <input type="text" id="uname" placeholder="用户名">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div id="pwd">
              <div class="control-group">
                <label class="control-label" for="passwd">密码</label>
                <div class="controls">
                  <input type="password" id="passwd" placeholder="密码">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="pwdConfirm">确认密码</label>
                <div class="controls">
                  <input type="password" id="pwdConfirm" placeholder="确认密码">
                  <span style="color: #FF0000">*</span>
                </div>
              </div>
              </div>
              <div id="permissionSelection">
                <?php $permission->permissionSelectSection(); ?>
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button id="addUserBtn" class="btn btn-primary" data-loading-text="提交中...">确定</button>
      </div>
    </div>
    <div class="modal hide fade" id="help" role="dialog" style="width: 800px;left: 40%">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3></h3>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
    <div class="container-fluid">
      <div class="row-fluid container-custome">
        <div class="action-bar">
            <div class="pull-right">
                <button id="showAddUserDlg" class="btn btn-primary" type="button" data-toggle="modal"><i class="icon-plus"></i> 新建</button>
            </div>
        </div>
      	<?php $elements->warningBlock("userWarning"); ?>
        <table class="table table-striped table-bordered">
            <thead>
                <td width="5%">#</td><td width="20%">用户名</td>
                <td width="20%">PAD权限  &nbsp;&nbsp;<a href="javascript:help('permissionpad')"><i class="icon-question-sign"></i></a></td>
                <td width="20%">前台权限  &nbsp;&nbsp;<a href="javascript:help('permissionfg')"><i class="icon-question-sign"></i></a></td>
                <td width="20%">后台权限  &nbsp;&nbsp;<a href="javascript:help('permissionbg')"><i class="icon-question-sign"></i></a></td>
                <td width="15%">操作</td>
            </thead>
            <tbody id="users">
            </tbody>
        </table>
      </div><!--/row-->

    </div><!--/.fluid-container-->
    
    <?php include "footer.inc"; ?>
    <script type="text/javascript" src="js/users.js"></script>
  </body>
</html>
