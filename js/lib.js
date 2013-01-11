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

