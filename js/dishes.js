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
			if (undefined === data.err_code) {
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

function Dish(id, name, ename, shortcut, price, unitName, unitId, description, printer, index, discount) {
	this.id = id;
	this.name = name;
	this.ename = ename;
	this.shortcut = shortcut;
    this.price = price;
    this.unitName = unitName;
    this.unitId = unitId;
    this.description = description;
    this.printer = printer;
    this.index = index;
    this.discount = discount;
}

function Dishes() {
	this.dishes = new Array();
	this.categoryId = 0;
	
	this.load = function(cid) {
		dishes.categoryId = cid;
		var url = "api/dishes.php?cid=" + cid;
		$.getJSON(url, function(data){
			if (undefined === data.err_code) {
				$("#dishes").html("");
			    $.each(data, function(i, dish){
			      dishes.dishes[i] = new Dish(dish.id, dish.name, dish.ename,
			      						 dish.shortcut, dish.price, dish.unitName,
			      						 dish.unitId, dish.description, dish.sortPrintName,
			      						 dish.index, dish.discount);
			      $("#dishes").append('<tr><td>' + dish.index + '</td><td>' + dish.name +  '</td><td>' + dish.ename + '</td><td>' + 
			      					 dish.price +  '</td><td>' + dish.shortcut + '</td><td>' + dish.unitName + '</td><td>' + 
			      					 dish.description + '</td><td>' + dish.sortPrintName + 
			      					 '</td><td class="action"><a href="javascript:updateDish(' + i + ')">[修改] </a> ' +
			      					 '<a href="javascript:deleteDish(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.refresh = function() {
		this.load(dishes.categoryId);
	}
	
	this.remove = function(event) {
		var url = "api/dishes.php?do=delete&id=" + dishes.dishes[event.data.index].id + "&cid=" + dishes.categoryId;
		$.getJSON(url, function(data){
			if (data.err_code == 0) {
				dishes.refresh();
			} else {
				showWarnningBlock("#dishWarning", "删除菜品: " + dishes.dishes[event.data.index].name + "失败!");
			}
		});
	}
	
	this.nameDuplicateCheck = function() {
		var name = $("#dname").val();
		if (isNull(name)) {
			console.log("null");
			return;
		}
		
		var dish = new Object();
		dish.name = name;
		var categories = "";
		$.post("api/dishes.php?do=query", {dish:$.toJSON(dish)}, function(data){
			if (data.category.length > 0) {
				$.each(data.category, function(i, category) {
					categories += category + ',';
				});
				
				showInfoBlock("#nameInfo", "该菜名已在" + categories.substr(0, categories.length-1) + "中,修改会同时对他们起作用！");
			}
		}, "json");
	}
	
	this.add = function(index) {
		var name = $("#dname").val();
		var price = $("#price").val();
		if (isNull(name)) {
			showWarnningBlock("#addDishWarning", "菜名不能为空!");
			return;
		}
		
		if (!isNumber(price)) {
			showWarnningBlock("#addDishWarning", "价格只能为数字!");
			return;
		}
		
		var dish = new Object();
		dish.name = name;
		dish.price = price;
		dish.unit = $("#unit").val();
		dish.printer = $("#printer").val();
		dish.category = dishes.categoryId;
		
		if (!isNull($("#ename").val())) {
			dish.ename = $("#ename").val();
		}
		
		if (!isNull($("#price2").val())) {
			if (!isNumber(price)) {
				showWarnningBlock("#addDishWarning", "价格2只能为数字!");
				return;
			} else {
				dish.price2 = $("#price2").val();
			}
		}
		
		if (!isNull($("#price3").val())) {
			if (!isNumber(price)) {
				showWarnningBlock("#addDishWarning", "价格3只能为数字!");
				return;
			} else {
				dish.price3 = $("#price3").val();
			}
		}
		
		if (!isNull($("#shortcut").val())) {
			dish.shortcut = $("#shortcut").val();
		}
		
		if (!isNull($("#discount").val())) {
			if (!isNumber(price)) {
				showWarnningBlock("#addDishWarning", "折扣只能为数字!");
				return;
			} else {
				dish.discount = $("#discount").val();
			}
		}
		
		if (!isNull($("#description").val())) {
			dish.description = $("#description").val();
		}
		
		if (!isNaN(index)) {
			dish.id = dishes.dishes[index].id;
		}
		
		if ($("#dishIMG").val() != '') {
			uploadImg(dish);
		} else {
			dishes.submit(dish);
		}
		
	}
	
	this.update = function(event) {
		dishes.add(event.data.index);
	}
	
	this.submit = function(dish) {
		$("#addDishBtn").button("loading");
		$.post("api/dishes.php?do=set", {dish:$.toJSON(dish)}, function(data){
			if (0 == data.err_code) {
				dishes.refresh();
				$("#addDish").modal("hide");
			} else {
				showWarnningBlock("#addDishWarning", "提交失败!");
			}
			$("#addDishBtn").button("reset");
		}, "json");
	}
}

var categories = new Categories();
var dishes = new Dishes();

var initAddDishDlg = function() {
	$("#addDishBtn").button("reset");
	$("#addDishWarning").html("");
	$.each($('form'), function(i, form) {
		form.reset();
	});
	
	$('#dname').change(dishes.nameDuplicateCheck);
	$("#addDishBtn").unbind("click");
	$("#addDishBtn").click(dishes.add);
}

var initUpdateDishDlg = function(index) {
	$("#addDishBtn").button("reset");
	$("#addDishWarning").html("");
	$.each($('form'), function(i, form) {
		form.reset();
	});
	$("#dname").val(dishes.dishes[index].name);
	$("#ename").val(dishes.dishes[index].ename);
	$("#price").val(dishes.dishes[index].price);
	$("#price2").val("");
	$("#price3").val("");
	$("#shortcut").val(dishes.dishes[index].shortcut);
	$("#discount").val(dishes.dishes[index].discount);
	$("#description").val(dishes.dishes[index].description);
	$("#unit").val(dishes.dishes[index].unitId);
	$("#printer").val(dishes.dishes[index].printer);
	
	$("#addDishBtn").unbind("click");
	$("#addDishBtn").click({index:index}, dishes.update);
}

var updateDish = function(index) {
	initUpdateDishDlg(index);
	$('#addDish').modal("show");
}
var deleteDish = function(index) {
	showAlertDlg("请注意", "确认删除菜品 : " + dishes.dishes[index].name + ' ?');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, dishes.remove);
}

var uploadImg = function(dish) {
	$("#addDishBtn").button("上传图片...");
     var data = new FormData();
      $.each($('#dishIMG')[0].files, function(i, file) {
          data.append('img', file);
      });
     $.ajax({
         url:'api/upload_img.php',
         type:'POST',
         data:data,
         cache: false,
         contentType: false,
         processData: false, 
         dataType: "json",
         success:function(data){
         	if (data.err_code == 0) {
	         	dish.img = data.img;
	         	dishes.submit(dish);
         	} else {
         		showWarnningBlock("#addDishWarning", "上传图片失败!");
         		$("#addDishBtn").button("recet");
         	}
         },
         error: function() {
         	showWarnningBlock("#addDishWarning", "上传图片失败!");
       		$("#addDishBtn").button("recet");
         }
     });
}

var categoryOnClick = function(index) {
	categories.OnClick(index);
}

$(document).ready(
	function(){
		categories.init();
		showWarnningBlock("#addDishWarning", "提交失败!");
		$("#showAddDishDlg").click(initAddDishDlg);
	}
)