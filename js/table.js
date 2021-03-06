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
			if (undefined === data.err_code) {
				$("#tables").html("");
			    $.each(data, function(i, table){
			      tables.tables[i] = new Table(table.id, table.name, table.index, table.floor, table.area, table.category);
			      $("#tables").append('<tr><td>' + table.index + '</td><td>' + table.name + '</td><td>' + table.floor +
			      					  '</td><td class="action"><a href="javascript:updateTable(' + i + ')">[修改] </a> ' +
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
			if (data.err_code == 0) {
				tables.load();
			} else {
				showWarnningBlock("#tableWarning", "删除桌台: " + tables.tables[event.data.index].name + "失败!");	
			}
		});
	}
	
	this.add = function(id) {
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
		
		if (!isNaN(id)) {
			table.id = id;
		}
		$("#addTableBtn").button("loading");
		var url = "api/tableInfo.php?do=set";
		$.post(url, {table:$.toJSON(table)}, function(data){
			if (data.err_code == 0) {
				tables.load();
				$("#addTable").modal("hide");
			} else {
				showWarnningBlock("#addTableWarning", "提交失败!");
			}
			$("#addTableBtn").button("reset");
		}, "json");
	}
	
	this.update = function(event) {
		tables.add(tables.tables[event.data.index].id);
	}
	
	this.sort = function() {
		var tableSort = new Array();
		var sortedIDs = $("#sortable" ).sortable("toArray");
		$.each(sortedIDs, function(i, item) {
			tableSort.push(new Table(item, 0, i + 1, 0, 0, 0));
		});
		$("#tableSortBtn").button("loading");
		$.post("api/tableInfo.php?do=sort", {table:$.toJSON(tableSort)}, function(data){
			if (0 == data.err_code) {
				tables.load();
				$("#sortTable").modal("hide");
			} else {
				showWarnningBlock("#sortTableWarning", "提交失败!");
			}
			$("#tableSortBtn").button("reset");
		}, "json");
	}
}

var tables = new Tables();
var deleteTable = function(index) {
	showAlertDlg("请注意", "确认删除桌台:" + tables.tables[index].name + '?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, tables.remove);
}

var updateTable = function(index) {
	$("#addTableBtn").button("reset");
	$("#addTableWarning").html("");
	$("#tableName").val(tables.tables[index].name);
	$("#tableIndex").val(tables.tables[index].index);
	$("#tableFloor").val(tables.tables[index].floor);
	$("#addTable").modal("show");
	$("#addTable h3").html("修改桌台");
	$("#addTableBtn").unbind("click");
	$("#addTableBtn").click({index:index}, tables.update);
}

var initAddService = function() {
	$("#addTableBtn").button("reset");
	$("#addTableWarning").html("");
	$("#tableName").val("");
	$("#tableIndex").val("");
	$("#tableFloor").val("");
	$("#addTableBtn").unbind("click");
	$("#addTableBtn").click(tables.add);
	$("#addTable h3").html("新建桌台");
}

var initTableSortDlg = function() {
	var tableLi = new String();
	$("#sortTableWarning").html("");
	$.each(tables.tables, function(i, table){
		tableLi += '<li id="' + table.id + '" class="ui-state-default">' + table.name + '</li>';
	});
	$("#sortable").html(tableLi);
}

$(document).ready(
	function(){
		tables.init();
		$("#showAddDlg").click(initAddService);
		$("#addTableBtn").unbind("click");
		$("#showSortDlg").bind('click', initTableSortDlg);
		$("#tableSortBtn").bind('click', tables.sort);
	}
)