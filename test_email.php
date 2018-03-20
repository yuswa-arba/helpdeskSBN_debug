<?php
include ("config/configuration.php");
//global $conn;

$mail           = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
//$mail->SMTPDebug  = 2; // set mailer to use SMTP
$mail->Timeout  = 120;     // set longer timeout for latency or servers that take a while to respond

$mail->Host     = "202.58.203.26";        // specify main and backup server
$mail->Port     = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication


$mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');
$mail->AddAddress("dwi@globalxtreme.net", "dwi");
$mail->SetFrom( "noreply@globalxtreme.net", 'GlobalXtreme Helpdesk');


$mail->Subject  = "Tes cmtp bali";
$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML('<div style="margin: 10px 0px;">
			   Hello, This email has been sent to you so you can reset your login account password<br>
			   Please click the link below to complete the password reset process. This link will expire in 2 hours.<br><br>
			   
			   https://172.16.79.194/software/beta/newpass.php?userid=balialik&amp;cust_number=GNB-B000001&amp;token=274062a84459a843f735780721a2e4ca<br><br>
			   
			   If you dont request for reset password, please delete this email.<br><br>
			   
			   ________________<br>
			   GlobalXtreme Helpdesk<br>
			   http://globalxtreme.net/<br>
			   ________________<br>
			   </div>');

$mail->Send();