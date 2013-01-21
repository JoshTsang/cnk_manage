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
			      					 '</td><td class="action"><a href="javascript:updateCategory(' + i + ')">[修改] </a> ' +
			      					 '<a href="javascript:deleteCategory(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.add = function(index) {
		var cname = $("#cname").val();
		if (isNull(cname)) {
			showWarnningBlock("#addCategoryWarning", "类别不能为空!");
			return;
		}
		
		//TODO duplited category
		var category = new Object();
		$("#addCategoryBtn").button("loading");
		if (!isNaN(index)) {
			category.id = categories.categories[index].id;
			category.index = categories.categories[index].index;
		}
		category.name = cname;
		$.post("api/categories.php?do=set", {category:$.toJSON(category)}, function(data){
			if (true == data.succ) {
				categories.load();
				$("#addCategory").modal("hide");
			} else {
				showWarnningBlock("#addCategoryWarning", "提交失败!");
			}
			$("#addCategoryBtn").button("reset");
		}, "json");
	}
	
	this.remove = function(event) {
		var url = "api/categories.php?do=delete&id=" + categories.categories[event.data.index].id;
		$.getJSON(url, function(data){
			if (data.succ == true) {
				categories.load();
			} else {
				showWarnningBlock("#categoryWarning", "删除单位: " + categories.categories[event.data.index].name + "失败!");
			}
		});
	}
	
	this.sort = function() {
		var categorySort = new Array();
		var sortedIDs = $("#sortable" ).sortable("toArray");
		$.each(sortedIDs, function(i, item) {
			categorySort.push(new Category(item, 0, i+1));
		});
		$("#categorySortBtn").button("loading");
		$.post("api/categories.php?do=sort", {category:$.toJSON(categorySort)}, function(data){
			if (true == data.succ) {
				categories.load();
				$("#sortCategory").modal("hide");
			} else {
				showWarnningBlock("#sortCategoryWarning", "提交失败!");
			}
			$("#categorySortBtn").button("reset");
		}, "json");
	}
	
	this.update = function(event) {
		categories.add(event.data.index);
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
			      					 '</td><td class="action"><a href="javascript:updateCategoryPrint(' + i + ')">[修改] </a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.update = function(event) {
		var cp = new Object();
		cp.category = categoryPrintList.categoryPrint[event.data.index].cid;
		cp.printer = $("#printer").val();
		$.post("api/categoryPrint.php?do=set", {categoryPrint:$.toJSON(cp)}, function(data){
		if (true == data.succ) {
			categoryPrintList.load();
			$("#categoryPrintDlg").modal("hide");
		} else {
			showWarnningBlock("#categoryPrintWarning", "保存失败！");
		}
	}, "json");
	}
}

var deleteCategory = function(index) {
	showAlertDlg("请注意", "确认删除单位 : " + categories.categories[index].name +
		 '?<br/><br/><span style="color:#FF0000">注意：删除分类将同时删除该分类下所有菜品</span>');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, categories.remove);
}

var initAddCategoryDlg = function() {
	$("#addCategory h2").html("新建分类");
	$("#addCategoryBtn").button("reset");
	$("#addCategoryWarning").hide();
	$("#cname").val("");
	$("#addCategoryBtn").unbind("click");
	$("#addCategoryBtn").click(categories.add);
}

var initCategorySortDlg = function() {
	var categoryLi = new String();
	$("#sortCategoryWarning").alert("close");
	$.each(categories.categories, function(i, category){
		categoryLi += '<li id="' + category.id + '" class="ui-state-default">' + category.name + '</li>';
	});
	$("#sortable").html(categoryLi);
}

var updateCategory = function(index) {
	$("#addCategory h2").html("修改分类");
	$("#addCategoryBtn").button("reset");
	$("#addCategoryWarning").hide();
	$("#cname").val(categories.categories[index].name);
	$("#addCategory").modal("show");
	$("#addCategoryBtn").unbind("click");
	$("#addCategoryBtn").click({index:index}, categories.update);
}

var updateCategoryPrint = function(index) {
	$("#categoryPrintDlg").modal("show");
	$("#categoryPrintBtn").unbind("click");
	$("#categoryPrintBtn").click({index:index}, categoryPrintList.update);
}

var categories = new Categories();
var categoryPrintList = new CategoryPrintList();
$(document).ready(
	function(){
		categories.init();
		categoryPrintList.init();
		$("#showAddCategoryDlg").bind("click", initAddCategoryDlg);
		$("#showSortDlg").bind('click', initCategorySortDlg);
		$("#categorySortBtn").bind('click', categories.sort);
	}
)