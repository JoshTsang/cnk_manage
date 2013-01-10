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
	this.load = false;
	
	this.init = function() {
		this.load();
	}
	
	this.load = function() {
		$.getJSON("api/shopinfo.php", function(data){
			if (undefined === data.succ) {
				shopInfo.name = data.name;
				shopInfo.addr = data.addr;
				shopInfo.tel = data.tel;
				shopInfo.load = true;
				shopInfo.show();
			} else {
				//TODO err handle
			}
		});
	}
	
	this.show = function() {
		if (this.load) {
			if (this.name !== undefined && this.name != "") {
				$("#shopname").attr("value", this.name);
			}
			if (this.addr !== undefined && this.addr != "") {
				$("#shopAddr").attr("value", this.name);
			}
			if (this.tel !== undefined && this.tel != "") {
				$("#shopTel").attr("value", this.name);
			}
		}
	}
	
	this.remove = function(index) {
		
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
			      					 '</td><td class="action"><a href="#">[修改] </a> <a href="#"> [删除]</a></td></tr>"');
			    });
			} else {
				//TODO err handle
			}
		});
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

$(document).ready(
	function(){
		printers.init();
		shopInfo.init();
	}
)