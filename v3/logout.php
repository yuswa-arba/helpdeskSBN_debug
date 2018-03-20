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
include ("../config/configuration.php");

if ($loggedin = logged_in())
{ // Check if they are logged in
    $id = mysql_query("SELECT * FROM `users` WHERE `user_index` = '" . $loggedin['user_index'] ."'");
    // Check if the username and password are correct.
    $jam = date("H") ;
    $waktu = date("Y-m-d ") . ($jam - 1) . date(":i:s") ;
    if (mysql_num_rows($id))
    {
	$uid = mysql_fetch_array($id) ;
	$sql = mysql_query("UPDATE `users` SET `user_active` = 'no', `lockout_time` = '$waktu' WHERE `user_index` = '" . $uid['user_index'] . "' ") ;
    }
    
    $update = mysql_query("UPDATE `sessions` SET `logged` = '1', `waktu`= '$waktu' WHERE `id` = '" . $loggedin['session_id'] . "'") ;
    // Update the current session to log the person out.
    
    if ($update){
	if ($sql){
		// If it successfully logged the person out then show success message.
		header("location: index.php");
	} else {
		// If an error occured show error message.
		header("location: index.php");
	}
    } else {
	// If an error occured show error message.
	header("location: index.php");
    }
}
else {
	header("location: index.php");
}