/**
 * @author Josh
 */
function Unit(id, name) {
	this.name = name;
	this.id = id;
}

function Units() {
	this.units = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/units.php", function(data){
			if (undefined === data.succ) {
				$("#units").html("");
			    $.each(data, function(i, unit){
			      units.units[i] = new Unit(unit.id, unit.name);
			      $("#units").append('<tr><td>' + (i+1) + '</td><td>' + unit.name +
			      					 '</td><td class="action"><a href="javascript:deleteUnit(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.remove = function(event) {
		var url = "api/units.php?do=delete&id=" + units.units[event.data.index].id;
		$.getJSON(url, function(data){
			if (data.succ == true) {
				units.load();
			} else {
				showWarnningBlock("#unitWarning", "删除单位: " + units.units[event.data.index].name + "失败!");
			}
		});
	}
}

var units = new Units();
var deleteUnit = function(index) {
	showAlertDlg("请注意", "确认删除单位 : " + units.units[index].name + '?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, units.remove);
}
$(document).ready(
	function(){
		units.init();
	}
)