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
	this.active = 0;
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/categories.php", function(data){
			if (undefined === data.succ) {
				$("#categories").html("");
			    $.each(data, function(i, category){
			      categories.categories[i] = new Category(category.id, category.name, category.index);
			      categories.updateView(); 
			    });
			    if (categories.categories[0].id !== undefined) {
				    dishes.load(categories.categories[0].id);
			    }
			} else {
				//TODO err handle
			}
		});
	}
	
	this.updateView = function() {
		$("#categories").html("");
		var li;
		$.each(this.categories, function(i, category){
			if (i == categories.active) {
				li = '<li class="active">';
			} else {
				li = '<li>';
			}
			li += '<a href="javascript:categoryOnClick(' + i + ')">' + category.name + '</a></li>';
			$("#categories").append(li);
	    });
	}
	
	this.OnClick = function(index) {
		this.active = index;
		dishes.load(this.categories[index].id);
		this.updateView();
	}
}

function Dish(id, name, ename, shortcut, price, unitName, description, printer, index) {
	this.id = id;
	this.name = name;
	this.ename = ename;
	this.shortcut = shortcut;
    this.price = price;
    this.unitName = unitName;
    this.description = description;
    this.printer = printer;
    this.index = index;
}

function Dishes() {
	this.dishes = new Array();
	this.categoryId = 0;
	
	this.load = function(cid) {
		categoryId = cid;
		var url = "api/dishes.php?cid=" + cid;
		$.getJSON(url, function(data){
			if (undefined === data.succ) {
				$("#dishes").html("");
			    $.each(data, function(i, dish){
			      dishes.dishes[i] = new Dish(dish.id, dish.name, dish.ename,
			      						 dish.shortcut, dish.price, dish.unitName, dish.description, dish.sortPrintName, dish.index);
			      $("#dishes").append('<tr><td>' + dish.index + '</td><td>' + dish.name +  '</td><td>' + dish.ename + '</td><td>' + 
			      					 dish.price +  '</td><td>' + dish.shortcut + '</td><td>' + dish.unitName + '</td><td>' + 
			      					 dish.description + '</td><td>' + dish.sortPrintName + 
			      					 '</td><td class="action"><a href="#">[修改] </a> ' +
			      					 '<a href="javascript:deleteDish(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.refresh = function() {
		this.load(categoryId);
	}
	
	this.remove = function(event) {
		var url = "api/dishes.php?do=delete&id=" + dishes.dishes[event.data.index].id;
		$.getJSON(url, function(data){
			if (data.succ == true) {
				dishes.refresh();
			} else {
				showWarnningBlock("#dishWarning", "删除菜品: " + dishes.dishes[event.data.index].name + "失败!");
			}
		});
	}
}

var categories = new Categories();
var dishes = new Dishes();

var deleteDish = function(index) {
	showAlertDlg("请注意", "确认删除菜品 : " + dishes.dishes[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, dishes.remove);
}

var categoryOnClick = function(index) {
	categories.OnClick(index);
}

$(document).ready(
	function(){
		categories.init();
	}
)