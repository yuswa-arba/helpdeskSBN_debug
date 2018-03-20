<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
ob_start();
include ("../config/configuration_admin.php");

if ($loggedin = logged_inCSO())
{ // Check if they are logged in
    $id = mysql_query("SELECT * FROM `gxLogin_admin` WHERE `id_employee` = '" . $loggedin['id_employee'] ."'");
    // Check if the username and password are correct.
    $jam = date("H") ;
    $waktu = date("Y-m-d ") . ($jam - 1) . date(":i:s") ;
    if (mysql_num_rows($id))
    {
		$uid = mysql_fetch_array($id) ;
		$sql = mysql_query("UPDATE `gxLogin_admin` SET `user_active` = 'no', `lockout_time` = '$waktu' WHERE `id_employee` = '" . $uid['id_employee'] . "' ") ;
    }
    
    $update = mysql_query("UPDATE `gxSessions_admin` SET `logged` = '1', `waktu`= '$waktu' WHERE `id` = '" . $loggedin['session_id'] . "'") ;
    // Update the current session to log the person out.
    
    if ($update)
    {
	if ($sql)
	{
		setcookie('GXSOFTWARE', "", time()+3600);
		session_destroy();
		// If it successfully logged the person out then show success message.
		header('location: '.URL_CSO.'index.php');
		
	} else {
		// If an error occured show error message.
		setcookie('GXSOFTWARE', "", time()+3600);
		session_destroy();
		
		header('location: '.URL_CSO.'index.php');
	}
    } else {
	// If an error occured show error message.
	setcookie('GXSOFTWARE', "", time()+3600);
	session_destroy();
	
	header('location: '.URL_CSO.'index.php');
    }
}
else {
	setcookie('GXSOFTWARE', "", time()+3600);
	session_destroy();
	
	header('location: '.URL_CSO.'index.php');
}