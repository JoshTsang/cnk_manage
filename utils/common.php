<?php
    function headerInfo() {
        echo '<head>
                <meta charset="utf-8">
                <title>调试工具</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="">
                <meta name="author" content="">
            
                <!-- Le styles -->
                <link href="../css/bootstrap.css" rel="stylesheet">
                <link href="../css/manage.css" rel="stylesheet">
                <style type="text/css">
                  body {
                    padding-top: 60px;
                    padding-bottom: 40px;
                  }
                </style>
                <link href="../css/bootstrap-responsive.css" rel="stylesheet">
            
                <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
                <!--[if lt IE 9]>
                  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <![endif]-->
            
              </head>';
    }

    function navBar($active) {
        echo '<div class="navbar navbar-inverse navbar-fixed-top">
                  <div class="navbar-inner">
                    <div class="container-fluid">
                      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </a>
                      <div class="nav-collapse collapse">';
        echo '<ul class="nav">';
        echo  '<li '.($active==1?'class="active"':"").'><a href="'.($active==1?'#':'menuDB.php').'">菜谱</a></li>';
        echo  '<li '.($active==2?'class="active"':"").'><a href="'.($active==2?'#':'userDB.php').'">用户</a></li>';
        echo  '<li '.($active==3?'class="active"':"").'><a href="'.($active==3?'#':'infoDB.php').'">信息</a></li>';
        echo  '<li '.($active==4?'class="active"':"").'><a href="'.($active==4?'#':'db.php').'">DB Structure</a></li>';
        echo  '<li '.($active==5?'class="active"':"").'><a href="'.($active==5?'#':'log.php').'">LOG</a></li>';
        echo  '<li '.($active==6?'class="active"':"").'><a href="'.($active==6?'#':'#').'">预留3</a></li>';
        echo  '<li '.($active==7?'class="active"':"").'><a href="'.($active==7?'#':'#').'">预留4</a></li>';
        echo '</ul>';
        
      echo '</div><!--/.nav-collapse -->
                </div>
              </div>
            </div>';
    }

    function showTable($db, $table) {
        echo '<table class="table table-striped table-bordered">
                <thead>
                    <tr>';
      
        $db = new SQLite3($db);
        $sql = "select * from $table";
        $reslut = $db->query($sql) or die("Error in query: <span style='color:red;'>$sql</span>");
        $num_columns = $reslut->numColumns();
        for ($i=0; $i<$num_columns; $i++) {
            echo "<th>[".$i."]".$reslut->columnName($i)."</th>";
        }
        echo "</thead></tr><tbody id=\"printList\">";
        
        while($row = $reslut->fetchArray()) {
            echo "<tr>";
            for ($i=0; $i<$num_columns; $i++) {
                echo "<td>".$row[$i]."</td>";
            }
            echo "</tr>";
        }
        $db->close();
    
        echo '</tbody>
                </table>';
        
    }
?>