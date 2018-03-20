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
define("DATABASE_LOCATION", "localhost"); // 172.16.79.193
define("DATABASE_USERNAME", "root"); // sbn_admin
define("DATABASE_PASSWORD", ""); // b4ckupw3b
define("DATABASE_NAME", "db_sbn");
define("URL", "/sbn/beta/");
define("URL_ADMIN", "/sbn/beta/admin/");
define("URL_CSO", "/sbn/beta/cso/");
define("URL_STAFF", "/sbn/beta/staff/");

define("URL_IMG_TV", "/tvmedia/");


/*
define("DATABASE_LOCATION_HELPDESK", "172.16.79.193");
define("DATABASE_USERNAME_HELPDESK", "helpdesk");
define("DATABASE_PASSWORD_HELPDESK", "b4ckupw3b");
define("DATABASE_NAME_HELPDESK", "helpdesk_new");
*/
/** CONNECT TO DATABASE **/
	// If we cant connect to the database server with the username and password provided. Stop and show error.
	// Once connected If we can not select the database name provided then stop and show error.
$conn = mysql_connect(DATABASE_LOCATION,DATABASE_USERNAME,DATABASE_PASSWORD);
if (!$conn) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME,$conn) or die ("Could Not Open Database");

//$conn_voip ="";
/*
 *
 * nonaktif sementara karena lemot tgl 11/6/2015 by dwi
 *
 */

/*
$conn_voip_cdr = mysql_connect(DATABASE_LOCATION_VOIP_CDR,DATABASE_USERNAME_VOIP_CDR,DATABASE_PASSWORD_VOIP_CDR);
if (!$conn_voip_cdr) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME_VOIP_CDR,$conn_voip_cdr) or die ("Could Not Open Database");
*/
/*
$conn_helpdesk = mysql_connect(DATABASE_LOCATION_HELPDESK,DATABASE_USERNAME_HELPDESK,DATABASE_PASSWORD_HELPDESK);
if (!$conn_helpdesk) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME_HELPDESK,$conn_helpdesk) or die ("Could Not Open Database");
*/
/** filename : config.php  */
class Config {

    private static $instance_soft = NULL;
    private static $dsn_soft      = "dblib:host=172.17.120.33:1433;dbname=RBS-ISP;";
    private static $db_user_soft  = "iwedhost2";
    private static $db_pass_soft  = "mejatulung";
    
    private function __construct() {
     
    }
    private function __clone() {
     
    }
    
    public static function getInstanceSoft()
    {
     
        if (!self::$instance_soft)
        {
            self::$instance_soft = new PDO(self::$dsn_soft, self::$db_user_soft, self::$db_pass_soft);
            self::$instance_soft-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        return self::$instance_soft;
    }
}
  
date_default_timezone_set('Asia/Jakarta');

/** INCLUDE FUNCTIONS **/
// The functions page included a lot of important functions which are required to use this usersystem.
// So to save having to type it out on every page we will just include it in the configuration file which is also included on every page.

include("functions_2016.php");
include("sessions.php");
include("admin/template_2016.php"); //admin software theme

include("admin/template_modul.php"); //modul theme
include("admin/func_admin.php"); //function untuk admin
include("mail_template.php"); //mail notif template