<?php
define("DATABASE_LOCATION", "192.168.1.97");
define("DATABASE_USERNAME", "webserver_admin");
define("DATABASE_PASSWORD", "b4ckupw3b");
define("DATABASE_NAME", "software");
$conn = mysql_connect(DATABASE_LOCATION, DATABASE_USERNAME, DATABASE_PASSWORD) or die("not connected");
mysql_select_db(DATABASE_NAME, $conn);

//mysql_query();
print_r(mysql_fetch_array(mysql_query("select NOW()")));



?>