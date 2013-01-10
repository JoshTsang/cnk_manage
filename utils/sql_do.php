<?php
    require '../data/define.inc';
    
    if(!isset($_POST['sql']) || !isset($_GET['db'])) {
        die("sql?");
    }
    $sql = $_POST['sql'];
    $dbName = $_GET['db'];
    
	if ($dbName == "menu") {
		$dbName = MENU_DB;
	} else if($dbName == "user"){
		$dbName = USER_DB;
	} else {
		die("err");
	}
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>

<?php	
	$db = new SQLite3($dbName);
    $results = $db->query($sql) or die("query failed, sql:".$sql.",db:".$dbName);
    $num_columns = $results->numColumns();
    for ($i=0; $i<$num_columns; $i++) {
        echo "<th>".$results->columnName($i)."</th>";
    }
    echo "</thead></tr><tbody id=\"printList\">";
    
    while($row = $results->fetchArray()) {
        echo "<tr>";
        for ($i=0; $i<$num_columns; $i++) {
            echo "<td>".$row[$i]."</td>";
        }
        echo "</tr>";
    }
    $db->close();
?>

	</tbody>
</table>