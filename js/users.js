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
			      					 '</td><td class="action"><a href="javascript:updateUser(' + i + ')">[修改] </a> ' +
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
	
	this.add = function(id) {
		var name = $("#uname").val();
		var passwd = $("#passwd").val();
		var pwdConfirm = $("#pwdConfirm").val();
		if (isNull(name)) {
			showWarnningBlock("#addUserWarning", "用户名不能为空!");
			return;
		}
		
		if ($("#pwd").is(":visible")) {
			if (isNull(passwd) || isNull(pwdConfirm)) {
				showWarnningBlock("#addUserWarning", "密码不能为空!");
				return;
			}
			if (passwd != pwdConfirm) {
				showWarnningBlock("#addUserWarning", "2次输入密码不同!");
				return;
			}
		}
		
		var user = new Object();
		if (!isNaN(id)) {
			user.id = id;
		}
		$("#addUserBtn").button("loading");
		user.name = name;
		if ($("#pwd").is(":visible")) {
			user.passwd = passwd;
		}
		if ($("#permission").html() <= 1) {
			user.permissionPad = $("#permissionPad").val();
			user.permissionFG = $("#permissionFG").val();
			user.permissionBG = $("#permissionBG").val();
		}
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
	
	this.update = function(event) {
		users.add(users.users[event.data.index].id);
	}
}

var users = new Users();

var deleteUser = function(index) {
	if ($("#permission").html() > 1) {
		$("#addUser").modal("hide");
		showNotPermittedDlg();
		return ;
	}
	console.log($("#username").html());
	if (users.users[index].name == $("#username").html()) {
		showAlertDlg("请注意", "不能删除当前登陆用户!");
		$("#alertPositiveBtn").unbind('click');
		$("#alertPositiveBtn").click(dissmissPermitionDlg);
		return ;
	}
	showAlertDlg("请注意", "确认删除用户 : " + users.users[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, users.remove);
}

var updateUser = function(index) {
	if (users.users[index].name != $("#username").html()) {
		if ($("#permission").html() > 1) {
			$("#addUser").modal("hide");
			showNotPermittedDlg();
			return ;
		}
	}
	$("addUserBtn").button("reset");
	$("#uname").val(users.users[index].name);
	if (users.users[index].name != $("#username").html()) {
		console.log(users.users[index].name + ":" + $("#username").html());
		$("#pwd").hide();
	} else {
		$("#pwd").show();
	}
	
	$("#passwd").val("");
	$("#pwdConfirm").val("");
	$("#permissionPad").val(users.users[index].permissionPad);
	$("#permissionFG").val(users.users[index].permissionFG);
	$("#permissionBG").val(users.users[index].permissionBG);
	if ($("#permission").html() > 1) {
		$("#permissionSelection").hide();
	} else {
		$("#permissionSelection").show();
	}
	$("#addUserBtn").unbind("click");
	$("#addUserBtn").click({index:index}, users.update);
	
	$("#addUser h3").html("修改用户");
	$("#addUser").modal("show");
}

var showNotPermittedDlg = function() {
	showAlertDlg("请注意", "权限不够!");
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click(dissmissPermitionDlg);
}

var dissmissPermitionDlg = function () {
	$("#addUser").modal("hide");
}

var initAddUserDlg = function() {
	if ($("#permission").html() > 1) {
		showNotPermittedDlg();
		return ;
	}
	$("addUserBtn").button("reset");
	$("#addUser h3").html("新建用户");
	$("#uname").val("");
	$("#passwd").val("");
	$("#pwdConfirm").val("");
	$("#permissionPad").val("");
	$("#permissionFG").val("");
	$("#permissionBG").val("");
	$("#addUserBtn").unbind("click");
	$("#addUserBtn").click(users.add);
	$("#addUser").modal("show");
}

$(document).ready(
	function(){
		users.init();
		$("#showAddUserDlg").bind("click", initAddUserDlg);
	}
)