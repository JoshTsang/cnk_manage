/**
 * @author Josh
 */
function Flavors() {
	this.flavors = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("../orderPad/getFlavor.php", function(data){
			if (undefined === data.succ) {
				$("#flavors").html("");
			    $.each(data, function(i, flavor){
			      flavors.flavors[i] = flavor;
			      $("#flavors").append('<tr><td>' + (i+1) + '</td><td>' + flavor +
			      					 '</td><td class="action"><a href="javascript:deleteFlavor(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.remove = function(event) {
		var flavor = flavors.flavors[event.data.index];
		var flavorsNew = new Array();
		$.each(flavors.flavors, function(i, flavor) {
			if (i != event.data.index) {
				flavorsNew.push(flavor);
			}
		});
		flavors.flavors = flavorsNew;
		$.post("../orderPad/setting/saveFlavor.php", "config=" + JSON.stringify(flavors.flavors), function(data){
			if (data == "") {
				flavors.load();
			} else {
				showWarnningBlock("#flavorWarning", "删除口味: " + users.users[event.data.index].name + "失败!");
			}
		});
	}
}

var flavors = new Flavors();

var deleteFlavor = function(index) {
	showAlertDlg("请注意", "确认删除口味 : " + flavors.flavors[index] + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, flavors.remove);
}

$(document).ready(
	function(){
		flavors.init();
	}
)
