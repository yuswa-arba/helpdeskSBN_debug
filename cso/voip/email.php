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
include ("../../config/configuration_admin.php");


redirectToHTTPS();

$email = 'dwi@globalxtreme.net';
$filename = 'callhistory_'.$src.'.pdf';

$mail           = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
$mail->SMTPDebug  = 2; // set mailer to use SMTP
$mail->Timeout  = 120;     // set longer timeout for latency or servers that take a while to respond

$mail->Host     = "202.58.203.26";        // specify main and backup server
$mail->Port     = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication


$mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');
$mail->AddAddress("$email", $email);
$mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');


$mail->Subject  = 'Call history VOIP';
$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML('tes html');
//$mail->AddStringAttachment($attachdata, $filename);

$mail->Send();