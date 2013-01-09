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
			      					 '</td><td class="action"><a href="#"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var services = new Services()
$(document).ready(
	function(){
		services.init();
	}
)