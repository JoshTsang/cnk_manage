/**
 * @author Josh
 */
function Table(id, name, index, floor, area, category) {
	this.name = name;
	this.id = id;
	this.index = index;
	this.area = area;
	this.floor = floor;	
	this.category = category;
}

function Tables() {
	this.tables = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/tableInfo.php", function(data){
			if (undefined === data.succ) {
				$("#tables").html("");
			    $.each(data, function(i, table){
			      tables.tables[i] = new Table(table.id, table.name, table.index, table.floor, table.area, table.category);
			      $("#tables").append('<tr><td>' + table.index + '</td><td>' + table.name + '</td><td>' + table.floor +
			      					  '</td><td class="action"><a href="#">[修改] </a> ' +
			      					  '<a href="javascript:deleteTable(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.remove = function(event) {
		var url = "api/tableInfo.php?do=delete&id=" + tables.tables[event.data.index].id;
		$.getJSON(url, function(data){
			if (data.succ == true) {
				tables.load();
			} else {
				showWarnningBlock("#tableWarning", "删除桌台: " + tables.tables[event.data.index].name + "失败!");	
			}
		});
	}
	
	this.add = function() {
		var name = $("#tableName").val();
		var index = $("#tableIndex").val();;
		var floor = $("#tableFloor").val();;
		if (isNull(name)) {
			showWarnningBlock("#addTableWarning", "桌名不能为空!");
			return;
		} 
		
		var table = new Object();
		table.name = name;
		if (!isNull(index)) {
			table.index = index;
		}
		
		if (!isNull(floor)) {
			table.floor = floor;
		}
		$("#addTableBtn").button("loading");
		var url = "api/tableInfo.php?do=set";
		$.post(url, {table:$.toJSON(table)}, function(data){
			if (data.succ == true) {
				tables.load();
				$("#addTable").modal("hide");
			} else {
				showWarnningBlock("#addTableWarning", "提交失败!");
			}
			$("#addTableBtn").button("reset");
		}, "json");
	}
}

var tables = new Tables();
var deleteTable = function(index) {
	showAlertDlg("请注意", "确认删除桌台:" + tables.tables[index].name + '?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, tables.remove);
}

var initAddService = function() {
	$("#addTableBtn").button("reset");
	$("#addTableWarning").hide();
	$("#tableName").val("");
	$("#tableIndex").val("");
	$("#tableFloor").val("");
}

$(document).ready(
	function(){
		tables.init();
		$("#addTable").bind("show", initAddService);
		$("#addTableBtn").unbind("click");
		$("#addTableBtn").click(tables.add);
	}
)