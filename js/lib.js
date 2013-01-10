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
