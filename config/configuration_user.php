<?php
/*
 * Project Name: Globalxtreme Web Intranet Template
 * Project URI: https://192.168.182.10/intra
 * Author: GlobalXtreme.net
 * Version: 1.0  | 26 maret 2014
 * Email: dafi@xtremewebsolution.net
 * Project for Web Intra & Helpdesk
 * Last edited: Dafi
 * Desc: 
 * 
 */

/** DATABASE CONNECTION INFORMATION **/
	// The information below is here to provide for the database connection at the bottom of this configuration file.
	// We are using defines. I will be covering a tutorial on at www.pk-tuts.co.uk soon.
define("DATABASE_LOCATION", "172.16.79.193");
define("DATABASE_USERNAME", "sbn");
define("DATABASE_PASSWORD", "b4ckupw3b");
define("DATABASE_NAME", "db_sbn");
define("URL", "/sbn/beta/");
define("URL_movies", "/webtv/");

/** CONNECT TO DATABASE **/
	// If we cant connect to the database server with the username and password provided. Stop and show error.
	// Once connected If we can not select the database name provided then stop and show error.
$conn = mysql_connect(DATABASE_LOCATION,DATABASE_USERNAME,DATABASE_PASSWORD);
if (!$conn) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME,$conn) or die ("Could Not Open Database");


/** filename : config.php  */
class Config {
 
private static $instance = NULL;
private static $dsn      = "mysql:host=172.16.79.193;dbname=software;";
private static $db_user  = DATABASE_USERNAME;
private static $db_pass  = DATABASE_PASSWORD;

private static $instance_soft = NULL;
private static $dsn_soft      = "dblib:host=172.17.120.33:1433;dbname=RBS-ISP;";
private static $db_user_soft  = "iwedhost2";
private static $db_pass_soft  = "mejatulung";

private function __construct() {
 
}
private function __clone() {
 
}
public static function getInstance()
{
 
if (!self::$instance)
{
self::$instance = new PDO(self::$dsn, self::$db_user, self::$db_pass);
self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
return self::$instance;
}

public static function getInstanceSoft()
{
 
if (!self::$instance_soft)
{
self::$instance_soft = new PDO(self::$dsn_soft, self::$db_user_soft, self::$db_pass_soft);
self::$instance_soft-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
return self::$instance_soft;
}
}

date_default_timezone_set('Asia/Jakarta');

/** INCLUDE FUNCTIONS **/
	// The functions page included a lot of important functions which are required to use this usersystem.
	// So to save having to type it out on every page we will just include it in the configuration file which is also included on every page.
include("newfunctions.php");
include("sessions.php");
include("template_v1.php"); //software theme
include("mail_template.php"); //mail notif template

include("admin/func_admin.php"); //function untuk admin