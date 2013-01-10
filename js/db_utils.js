var xmlHttp;
var db = new CNK_DB();
var dbName;
var sql;

function createXMLHttpRequest() {
	if (window.ActiveXObject) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	} else if (window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}
}

function CNK_DB() {
	this.showDBdata = function(content) {
		document.getElementById("content_data").innerHTML = content;
	}
}

function loadDB(db, table) {
	console.log("loadDB:" + db + "&" + table);
	createXMLHttpRequest();
	xmlHttp.onreadystatechange = handleShowDB;
	xmlHttp.open("GET", "db_data.php?db=" + db + "&table=" +table);
	xmlHttp.setRequestHeader("cache-control","no-cache"); 
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(null);
}

function isValid(value)
{
		if (value==null || value=="") {
			return false;
		} else {
			return true;
		}
}

function execSQL() {
	sql = document.getElementById("sql").value;
	dbName = document.getElementById("db").value;
	if (!isValid(sql)) {
		alert("非法的sql语句");
		return false;
	}
	if (!isValid(dbName)) {
		alert("非法的dbName");
		return false;
	}
	createXMLHttpRequest();
	xmlHttp.onreadystatechange = handleShowDB;
	xmlHttp.open("POST", "sql_do.php?db=" + dbName);
	xmlHttp.setRequestHeader("cache-control","no-cache"); 
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send("sql=" + sql);
}

function handleShowDB() {
	if (xmlHttp.readyState == 4) {
		if (xmlHttp.status == 200) {
			db.showDBdata(xmlHttp.responseText);
		}
	}
}
