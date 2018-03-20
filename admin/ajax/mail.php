<?php
/**
  * Author: Ted Hayes
  * Based on code by: Ernest Wojciuk
  * Web Site: www.liminastudio.com
*/
include ("../../config/configuration_admin.php");
include_once("class.emailtodb.php");

enableLog("", "ajax", "ajax", "Download Email to db");
     
ini_set ('error_reporting', E_ALL^~E_NOTICE^~E_DEPRECATED);

global $conn;
/*
$cfg["db_host"] = '192.168.1.97';
$cfg["db_user"] = 'email';
$cfg["db_pass"] = 'b4ckupw3b';
$cfg["db_name"] = 'email';

$mysql_pconnect = mysql_pconnect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
if(!$mysql_pconnect){echo "Connection Failed"; exit; }
$db = mysql_select_db($cfg["db_name"], $mysql_pconnect);
if(!$db){echo"DB Select Failed"; exit;}
*/
echo "Connected to database.<br>";

$edb = new EMAIL_TO_DB();
//$edb->connect('pop.gmail.com:995', '/pop/ssl', 'gx.help@gmail.com', 'backupweb123');
//$edb->connect('imap.gmail.com:993', '/imap/ssl/novalidate-cert', 'gx.help@gmail.com', 'backupweb123');
$edb->connect('imap.gmail.com:993', '/imap/ssl/novalidate-cert', 'helpdesk@globalxtreme.net', 'dwi123456789');

echo "Connected to IMAP server, starting update.<br>";
$edb->db_update();
echo "Finished, closing connection.";
$edb->close();

?>