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

//VOIP Balikpapan
define("DATABASE_LOCATION_VOIP_BPN", "172.30.254.3");
define("DATABASE_USERNAME_VOIP_BPN", "dwi");
define("DATABASE_PASSWORD_VOIP_BPN", "rukodinoyo");
define("DATABASE_NAME_VOIP_BPN", "mya2billing");

//CDR Balikpapan 
define("DATABASE_LOCATION_VOIP_CDR", "172.30.254.3");
define("DATABASE_USERNAME_VOIP_CDR", "dwi");
define("DATABASE_PASSWORD_VOIP_CDR", "rukodinoyo");
define("DATABASE_NAME_VOIP_CDR", "asteriskcdrdb");

//voip bali
$conn_voip = mysql_connect(DATABASE_LOCATION_VOIP_BPN,DATABASE_USERNAME_VOIP_BPN,DATABASE_PASSWORD_VOIP_BPN);
if (!$conn_voip) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME_VOIP_BPN,$conn_voip) or die ("Could Not Open Database");

//voip bali
/*$conn_cdr = mysql_connect(DATABASE_LOCATION_VOIP_CDR,DATABASE_USERNAME_VOIP_CDR,DATABASE_PASSWORD_VOIP_CDR);
if (!$conn_cdr) die ("Could not connect MySQL Server With Username And Password");
mysql_select_db(DATABASE_NAME_VOIP_CDR,$conn_cdr) or die ("Could Not Open Database");*/