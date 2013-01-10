/**
 * @author Josh
 */
function Service(id, name) {
	this.name = name;
	this.id = id;
}

function Services() {
	this.services = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/services.php", function(data){
			if (undefined === data.succ) {
				$("#services").html("");
			    $.each(data, function(i, service){
			      services.services[i] = new Service(service.id, service.service);
			      $("#services").append('<tr><td>' + (i+1) + '</td><td>' + service.service +
			      					 '</td><td class="action"><a href="javascript:deleteService(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.remove = function(event) {
		var url = "api/services.php?do=delete&id=" + services.services[event.data.index].id;
		$.getJSON(url, function(data){
			if (data.succ == true) {
				services.load();
			} else {
				showWarnningBlock("#serviceWarning", "删除服务: " + services.services[event.data.index].name + "失败!");
			}
		});
	}
}

var services = new Services();

var deleteService = function(index) {
	showAlertDlg("请注意", "确认删除菜品 : " + services.services[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, services.remove);
}

$(document).ready(
	function(){
		services.init();
	}
)