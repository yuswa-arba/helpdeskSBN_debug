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
define("DATABASE_USERNAME", "sbn_admin");
define("DATABASE_PASSWORD", "b4ckupw3b");
define("DATABASE_NAME", "db_sbn");
define("URL", "/sbn/beta/");
define("URL_ADMIN", "/sbn/beta/admin/");
define("URL_CSO", "/sbn/beta/cso/");
define("URL_HRD", "/sbn/beta/hrd/");


/** CONNECT TO DATABASE **/
	// If we cant connect to the database server with the username and password provided. Stop and show error.
	// Once connected If we can not select the database name provided then stop and show error.
$conn = mysql_connect(DATABASE_LOCATION,DATABASE_USERNAME,DATABASE_PASSWORD);
if (!$conn) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME,$conn) or die ("Could Not Open Database");


date_default_timezone_set('Asia/Jakarta');

/** INCLUDE FUNCTIONS **/
	// The functions page included a lot of important functions which are required to use this usersystem.
	// So to save having to type it out on every page we will just include it in the configuration file which is also included on every page.
//include("newfunctions.php");
require_once("phpmailer/PHPMailerAutoload.php");
include("newfunctions2.php");
include("sessions.php");
include("hrd/template.php"); 