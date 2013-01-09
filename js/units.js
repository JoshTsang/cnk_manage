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
			      					 '</td><td class="action"><a href="#"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var units = new Units()
$(document).ready(
	function(){
		units.init();
	}
)