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
			      					 '</td><td class="action"><a href="#"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var flavors = new Flavors()
$(document).ready(
	function(){
		flavors.init();
	}
)
