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
			      $("#users").append('<tr><td>' + i + '</td><td>' + user.name + "</td><td>" + user.permissionPad + "</td><td>" +
			      					 user.permissionFG + "</td><td>" + user.permissionBG +
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
}

var users = new Users();

var deleteUser = function(index) {
	showAlertDlg("请注意", "确认删除用户 : " + users.users[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, users.remove);
}

$(document).ready(
	function(){
		users.init();
	}
)