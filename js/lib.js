/**
 * @author Josh
 */
var showAlertDlg = function(title, msg) {
	$("#alertTitle").html(title);
	$("#alertMsg").html(msg);
	$("#alertDlg").modal("show");
}

var showWarnningBlock = function(id, msg) {
	$(id + " #warning").html(msg)
	$(id).show();
}

function isIP(strIP) {
	if (isNull(strIP)) {
		return false;
	}
	var re=/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/g //匹配IP地址的正则表达式
	if(re.test(strIP))
	{
		if(RegExp.$1 <256 && RegExp.$2<256 && RegExp.$3<256 && RegExp.$4<256 && RegExp.$4>0) {
			return true;
		}
	}

	return false;
}

function isValidPrinterName(name) {
	if (name.length > 6) {
		return false;
	}
	return true;
}

function isNull(value)
{
	if (value==null || $.trim(value)=="") {
		return true;
	} else {
		return false;
	}
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function help(what) {
	$.post("api/help.php", {what:what}, function(data){
			if (true == data.succ) {
				$("#help h3").html("帮助-" + data.title);
				$("#help .modal-body").html(data.content);
				$("#help").modal("show");
			} else {
				$("#help h3").html("出错了");
				$("#help .modal-body").html("没有找到相关帮助");
			}
		}, "json");
}
