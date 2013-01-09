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
			      users.users[i] = new User(user.id, user.name, user.permissionPad, user.permissionFG, user.permissionBG);
			      $("#users").append('<tr><td>' + i + '</td><td>' + user.name + "</td><td>" + user.permissionPad + "</td><td>" +
			      					 user.permissionFG + "</td><td>" + user.permissionBG +
			      					 '</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var users = new Users()
$(document).ready(
	function(){
		users.init();
	}
)