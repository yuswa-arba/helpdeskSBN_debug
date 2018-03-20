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
include ("config/configuration.php");

if ($loggedin = logged_in())
{ // Check if they are logged in
    $id = mysql_query("SELECT * FROM `gxLogin` WHERE `id_user` = '" . $loggedin['id_user'] ."'");
    // Check if the username and password are correct.
    $jam = date("H") ;
    $waktu = date("Y-m-d ") . ($jam - 1) . date(":i:s") ;
    if (mysql_num_rows($id))
    {
	$uid = mysql_fetch_array($id) ;
	$sql = mysql_query("UPDATE `gxLogin` SET `user_active` = 'no', `lockout_time` = NOW() WHERE `id_user` = '" . $uid['id_user'] . "';") ;
    }
    
    $update = mysql_query("UPDATE `gxSessions` SET `logged` = '1', `waktu`= NOW() WHERE `id` = '" . $loggedin['session_id'] . "';") ;
    // Update the current session to log the person out.
    //echo "UPDATE `gxSessions` SET `logged` = '1', `waktu`= NOW() WHERE `id` = '" . $loggedin['session_id'] . "';";
    
    if ($update)
    {
	if ($sql)
	{
		setcookie('GXSOFTWARE', "", time()+3600);
		session_destroy();
		enableLog($loggedin['customer_number'],$loggedin['username'], "","Logout Success.");
		// If it successfully logged the person out then show success message.
		header("location: index.php");
		
	} else {
		// If an error occured show error message.
		setcookie('GXSOFTWARE', "", time()+3600);
		session_destroy();
		enableLog($loggedin['customer_number'],$loggedin['username'], "","Logout Error1.");
		
		header("location: index.php");
	}
    } else {
	// If an error occured show error message.
	setcookie('GXSOFTWARE', "", time()+3600);
	session_destroy();
	enableLog($loggedin['customer_number'],$loggedin['username'], "","Logout Error2.");
	
	header("location: index.php");
    }
}
else {
	setcookie('GXSOFTWARE', "", time()+3600);
	session_destroy();
	enableLog($loggedin['customer_number'],$loggedin['username'], "","Logout Error3.");
	
	header("location: index.php");
}