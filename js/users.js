/**
 * @author Josh
 */
function User(id, name, permissionPad, permissionFG, permissionBG) {
	this.name = name;
	this.id = id;
	this.permissionPad = permissionPad;
	this.permissionFG = permissionFG;
	this.permissionBG = permissionBG;
}

function Users() {
	this.users = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/userInfo.php", function(data){
			if (undefined === data.succ) {
				$("#users").html("");
			    $.each(data, function(i, user){
			      users.users[i] = new User(user.uid, user.name, user.permissionPad, user.permissionFG, user.permissionBG);
			      $("#users").append('<tr><td>' + i + '</td><td>' + user.name + "</td><td>" + user.permissionPadStr + "</td><td>" +
			      					 user.permissionFGStr + "</td><td>" + user.permissionBGStr +
			      					 '</td><td class="action"><a href="#">[修改] </a> ' +
			      					 '<a href="javascript:deleteUser(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.remove = function(event) {
		var url = "api/userInfo.php?do=delete&id=" + users.users[event.data.index].id;
		$.getJSON(url, function(data){
			if (data.succ == true) {
				users.load();
			} else {
				showWarnningBlock("#userWarning", "删除用户: " + users.users[event.data.index].name + "失败!");
			}
		});
	}
	
	this.add = function(event) {
		var name = $("#uname").val();
		var passwd = $("#passwd").val();
		var pwdConfirm = $("#pwdConfirm").val();
		if (isNull(name)) {
			showWarnningBlock("#addUserWarning", "用户名不能为空!");
			return;
		}
		
		if (isNull(passwd) || isNull(pwdConfirm)) {
			showWarnningBlock("#addUserWarning", "密码不能为空!");
			return;
		}
		
		if (passwd != pwdConfirm) {
			showWarnningBlock("#addUserWarning", "2次输入密码不同!");
			return;
		}
		
		$("#addUserBtn").button("loading");
		var user = {name: name, passwd: passwd, permissionPad: $("#permissionPad").val(),
					permissionFG: $("#permissionFG").val(),
					permissionBG: $("#permissionBG").val()};
		$.post("api/userInfo.php?do=set", {user:$.toJSON(user)}, function(data){
			if (true == data.succ) {
				users.load();
				$("#addUser").modal("hide");
			} else {
				showWarnningBlock("#addUserWarning", "提交失败!");
			}
			$("#addUserBtn").button("reset");
		}, "json");
	}
}

var users = new Users();

var deleteUser = function(index) {
	showAlertDlg("请注意", "确认删除用户 : " + users.users[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, users.remove);
}

var initAddUserDlg = function() {
	$("#uname").val("");
	$("#passwd").val("");
	$("#pwdConfirm").val("");
	$("#permissionPad").val("");
	$("#permissionFG").val("");
	$("#permissionBG").val("");
}

$(document).ready(
	function(){
		users.init();
		$("#addUser").bind("show", initAddUserDlg);
		$("#addUserBtn").click(users.add);
	}
)