/**
 * @author Josh
 */
var login = function() {
	var name = $("#username").val();
	var passwd = $("#passwd").val();
	if (isNull(name)) {
		showWarnningBlock("#loginErr", "用户名不能为空!");
		return;
	}
	
	if (isNull(passwd)) {
		showWarnningBlock("#loginErr", "密码不能为空!");
		return;
	}
	
	var user = new Object();
	
	user.name = name;
	user.passwd = hex_md5(passwd);
	
	$("#login").html('<img style="width:25px;height:25px;" src="img/loading_circle.gif">');
	$.post("api/login.php", {user:$.toJSON(user)}, function(data){
		if (true == data.succ) {
			relocate();
		} else {
			showWarnningBlock("#loginErr", "用户名密码错误!");
			$("#login").html('登 陆');
		}
	}, "json");
}

var OnLoginClick = function() {
	login();
}

var relocate = function() {
	window.location.href="table.php"
}

$(document).ready(
	function(){
		$("#login").click(OnLoginClick);
		$(document).keypress(function(){  
		    if (event.keyCode == 13) {  
		        login();
		        return false ;  
		    }
		});
	}
)