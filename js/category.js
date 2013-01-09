/**
 * @author Josh
 */
function Category(id, name, index) {
	this.name = name;
	this.id = id;
	this.index = index;
}

function Categories() {
	this.categories = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/categories.php", function(data){
			if (undefined === data.succ) {
				$("#categories").html("");
			    $.each(data, function(i, category){
			      categories.categories[i] = new Category(category.id, category.name, category.index);
			      $("#categories").append('<tr><td>' + category.index + '</td><td>' + category.name +
			      					 '</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

function CategoryPrint(cid, name, printerNames, printerIds) {
	this.name = name;
	this.cid = cid;
	this.printerNames = printerNames;
	this.printerIds = printerIds;
}

function CategoryPrintList() {
	this.categoryPrint = new Array();
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/categoryPrint.php", function(data){
			if (undefined === data.succ) {
				$("#categoryPrint").html("");
			    $.each(data, function(i, categoryPrint){
			      categoryPrintList.categoryPrint[i] = new CategoryPrint(categoryPrint.id, categoryPrint.name,
			      									 categoryPrint.printerNames, categoryPrint.printerIds);
			      $("#categoryPrint").append('<tr><td>' + (i+1) + '</td><td>' + categoryPrint.name + '</td><td>' + categoryPrint.printerNames +
			      					 '</td><td class="action"><a href="#">[修改] </a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var categories = new Categories();
var categoryPrintList = new CategoryPrintList();
$(document).ready(
	function(){
		categories.init();
		categoryPrintList.init();
	}
)