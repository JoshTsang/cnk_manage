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
}

var tables = new Tables();
var deleteTable = function(index) {
	showAlertDlg("请注意", "确认删除桌台:" + tables.tables[index].name + '?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, tables.remove);
}

$(document).ready(
	function(){
		tables.init();
	}
)