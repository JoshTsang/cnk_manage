/**
 * @author Josh
 */
function Printer(name, ip, type, title, usefor, id) {
	this.name = name;
	this.ip = ip;
	this.type = type;
	this.title = title;
	this.usefor = usefor;	
	this.id = id;
}

function ShopInfo() {
	this.name;
	this.addr;
	this.tel;
	this.loaded = false;
	
	this.init = function() {
		$("#saveShopInfo").click(shopInfo.save);
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/shopinfo.php", function(data){
			if (undefined === data.succ) {
				shopInfo.name = data.name;
				shopInfo.addr = data.addr;
				shopInfo.tel = data.tel;
				shopInfo.loaded = true;
				shopInfo.show();
			} else {
				//TODO err handle
			}
			$.get("../orderPad/setting/getShopName.php",function(data,status){
			    if (status == "success") {
			    	shopInfo.name = data;
			    	shopInfo.show();
			    } else {
			    	//TODO handle err
			    }
			});
			
		});
	}
	
	this.show = function() {
		if (this.loaded) {
			if (this.name !== undefined && this.name != "") {
				$("#shopname").attr("value", this.name);
			}
			if (this.addr !== undefined && this.addr != "") {
				$("#shopAddr").attr("value", this.addr);
			}
			if (this.tel !== undefined && this.tel != "") {
				$("#shopTel").attr("value", this.tel);
			}
		}
	}
	
	this.save = function() {
		var name = $("#shopname").val();
		if (isNull(name)) {
			showWarnningBlock("#saveShopInfoWarning", "店铺名称不能为空!");
			return;
		}
		
		var shop = new Object();
		shop.name = name;
		
		$("#saveShopInfo").button("loading");
		if (!isNull($("#shopAddr").val)) {
			shop.addr = $("#shopAddr").val();
		}
		
		if (!isNull($("#shopTel").val)) {
			shop.tel = $("#shopTel").val();
		}
		$.post("api/shopinfo.php?do=set", {shopinfo:$.toJSON(shop)}, function(data){
			if (true == data.succ) {
				shopInfo.load();
			} else {
				showWarnningBlock("#saveShopInfoWarning", "保存失败!");
			}
			$("#saveShopInfo").button("reset");
		}, "json");
		$.get("../orderPad/setting/setShopName.php?shopname="+shop.name,function(data,status){
			    if (status == "success") {
			    	
			    } else {
			    	//TODO handle err
			    }
			});
	}
	
}

function Printers() {
	this.printers = new Array();
	
	this.init = function () {
		this.load();
	}
	
	this.getPrinterTypeStr = function(type) {
		var printerType;
		switch (type) {
			case 1:
			case "1":
				printerType = "58打印机";
				break;
			case 2:
			case "2":
				printerType = "80打印机";
				break;
			default:
				printerType = type;
				break;
		}
		return printerType;
	}
	
	this.getUseforStr = function(usefor) {
		var printerUsefor;
		switch(usefor) {
			case 101:
			case "101":
				printerUsefor = "统计";
				break;
			case 100:
			case "100":
				printerUsefor = "收银";
				break;
			case 102:
			case "102":
				printerUsefor = "厨打";
				break;
			case 103:
			case "103":
				printerUsefor = "点菜";
			break;
			case 104:
			case "104":
				printerUsefor = "点菜-无价格";
				break;
			case 200:
			case "200":
				printerUsefor = "停用";
				break;
			default:
				printerUsefor = usefor;
				break;
		}
		return printerUsefor;
	}
	
	this.load = function() {
		$.getJSON("../orderPad/setting/getPrinterSetting.php", function(data){
			if (undefined === data.succ) {
				$("#printers").html("");
			    $.each(data, function(i, printer){
			      printers.printers[i] = new Printer(printer.name, printer.ip, printer.type, printer.title, printer.usefor, printer.id);
			      $("#printers").append('<tr><td>' + (i+1) + '</td><td>' + printer.name +  '</td><td>' + printer.ip + '</td><td>' + 
			      					 printers.getPrinterTypeStr(printer.type) +  '</td><td>' + printer.title + '</td><td>' + 
			      					 printers.getUseforStr(printer.usefor) + 
			      					 '</td><td class="action"><a OnClick="javascript:showUpdateDlg(' +
			      					 i + ')">[修改] </a> <a OnClick="javascript:deletePrinter(' +
			      					 i + ')"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	
	this.add = function(index) {
		var name = $("#name").val();
		var ip = $("#ipAddr").val();
		var title = $("#title").val();
		var type =$("#type").val();
		var usefor = $("#receipt").val();
		
		if (isNull(name)) {
			showWarnningBlock("#addPrinterWarning", "打印机名不能为空");
			return false;
		}
		if (isNull(ip)) {
			showWarnningBlock("#addPrinterWarning", "IP地址不能为空");
			return false;
		}
		
		if (!isValidPrinterName(name)) {
			showWarnningBlock("#addPrinterWarning", "打印机名不合法");
			return false;
		}
		
		if (!isIP(ip)) {
			showWarnningBlock("#addPrinterWarning", "IP地址不合法");
			return false;
		}
		
		$("#addPrinterBtn").button("loading");
		var succ = function () {
			printers.load();
			$("#addPrinter").modal("hide");
		}
		
		var failed = function () {
			showWarnningBlock("#addPrinterWarning", "提交失败!");
		}
		
		if (!isNaN(index)) {
			printers.printers[index].name = name;
			printers.printers[index].ip = ip;
			printers.printers[index].type = type;
			printers.printers[index].title = title;
			printers.printers[index].usefor = usefor;
			printers.save(succ, failed);
		} else {
			var p = new Printer(name, ip, type, title, usefor, 0);
			printers.printers.push(p);
			printers.save(succ, failed);
		}
	}
	
	this.update = function(event) {
		printers.add(event.data.index);
	}
	
	this.remove = function(event) {
		var index = event.data.index;
		var printersNew = new Array();
		$.each(printers.printers, function(i, printer) {
			if (i != index) {
				printersNew.push(printer);
			}
		});
		printers.printers = printersNew;
		var succ = function () {
			printers.load();
		}
		
		var failed = function () {
			showAlertDlg("请注意", "删除打印机失败！");
			$("#alertPositiveBtn").unbind('click');
			$("#alertPositiveBtn").click(hideAlertDlg);
		}
		
		printers.save(succ, failed);
	}
	
	this.save = function(succ, failed) {
		var url="../orderPad/savePrinterSettings.php";
		$.post(url, {config:$.toJSON(printers.printers)}, function(data){
			if (data.length > 0) {
				succ();
			} else {
				failed();
			}
			$("#addPrinterBtn").button("reset");
		}, "json");
	}
}

var printers = new Printers();
var shopInfo = new ShopInfo();

var OnTestClick = function () {
	$("#testing").modal('show');	
	$.get("../orderPad/setting/testPrinter.php", function(data){
		$("#testing").modal('hide');
		console.log("data:" + data);
		if (data == "") {
			alert("测试通过!");
		} else {
			alert("测试未通过");
		}
	});
}

var initAddPrinterDlg = function() {
	$("#addPrinter h3").html("新建打印机");
	$("#addPrinterWarning").hide();
	$("#name").val("");
	$("#ipAddr").val("");
	$("#title").val("存根联");
	$("#type").val("2");
	$("#receipt").val("100");
	$("#addPrinterBtn").unbind("click");
	$("#addPrinterBtn").click(printers.add);
}

var initUpdatePrinterDlg = function(index) {
	$("#addPrinter h3").html("修改打印机");
	$("#addPrinterWarning").hide();
	$("#name").val(printers.printers[index].name);
	$("#ipAddr").val(printers.printers[index].ip);
	$("#title").val(printers.printers[index].title);
	$("#type").val(printers.printers[index].type);
	$("#receipt").val(printers.printers[index].usefor);
	$("#addPrinterBtn").unbind("click");
	$("#addPrinterBtn").click({index:index},printers.update);
}

var showUpdateDlg = function(index) {
	initUpdatePrinterDlg(index);
	$("#addPrinter").modal("show");
}

var deletePrinter = function(index) {
	showAlertDlg("请注意", "确认删除打印机 " + printers.printers[index].name + " ?");
	$("#alertPositiveBtn").unbind('click');
	$("#alertPositiveBtn").click({index:index}, printers.remove);
}

$(document).ready(
	function(){
		printers.init();
		shopInfo.init();
		$("#showAddPrinterDlg").click(initAddPrinterDlg);
	}
)