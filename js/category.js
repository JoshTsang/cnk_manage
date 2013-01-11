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
			      					 '</td><td class="action"><a href="#">[修改] </a> ' +
			      					 '<a href="javascript:deleteCategory(' + i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.add = function() {
		var cname = $("#cname").val();
		if (isNull(cname)) {
			showWarnningBlock("#addCategoryWarning", "类别不能为空!");
			return;
		}
		
		//TODO duplited category
		$("#addCategoryBtn").button("loading");
		var category = {id:0, name:cname};
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

var deleteCategory = function(index) {
	showAlertDlg("请注意", "确认删除单位 : " + categories.categories[index].name +
		 '?<br/><br/><span style="color:#FF0000">注意：删除分类将同时删除该分类下所有菜品</span>');
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({"index":index}, categories.remove);
}

var initAddCategoryDlg = function() {
	$("#addCategoryBtn").button("reset");
	$("#addCategoryWarning").hide();
	$("#cname").val("");
}

var categories = new Categories();
var categoryPrintList = new CategoryPrintList();
$(document).ready(
	function(){
		categories.init();
		categoryPrintList.init();
		$("#addCategoryBtn").click(categories.add);
		$("#addCategory").bind("show", initAddCategoryDlg);
	}
)