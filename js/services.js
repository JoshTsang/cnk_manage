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
			if (undefined === data.err_code) {
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
			if (data.err_code == 0) {
				services.load();
			} else {
				showWarnningBlock("#serviceWarning", "删除服务: " + services.services[event.data.index].name + "失败!");
			}
		});
	}
	
	this.add = function() {
		var name = $("#name").val();
		if (isNull(name)) {
			showWarnningBlock("#addServiceWarning", "服务名不能为空!");
			return;
		} 
		
		$("#addServiceBtn").button("loading");
		var url = "api/services.php?do=set&name=" + $("#name").val();
		$.getJSON(url, function(data){
			if (data.err_code == 0) {
				services.load();
				$("#addService").modal("hide");
			} else {
				showWarnningBlock("#addServiceWarning", "提交失败!");
			}
			$("#addServiceBtn").button("reset");
		});
	}
}

var services = new Services();

var deleteService = function(index) {
	showAlertDlg("请注意", "确认删除菜品 : " + services.services[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, services.remove);
}

var initAddService = function() {
	$("#addServiceBtn").button("reset");
	$("#addServiceWarning").html("");
	$("#name").val("");
}

$(document).ready(
	function(){
		services.init();
		$("#addServiceBtn").click(services.add);
		$("#addService").bind("show", initAddService);
	}
)