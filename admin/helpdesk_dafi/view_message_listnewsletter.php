<?php
$hosted = "localhost";
$usernm = "root";
$passwd = "b4ckupw3b";
$dbnm = "helpdesk_new";
$connect = mysql_connect($hosted,$usernm,$passwd) or die ("koneksi gagal");
mysql_select_db($dbnm, $connect) or die ("database tidak diketahui");


$sql_view = mysql_fetch_array(mysql_query("SELECT `message` FROM `newsletter` WHERE `id_newsletter`='$_GET[id_newsletter]'"));
echo $sql_view['message'];
?>