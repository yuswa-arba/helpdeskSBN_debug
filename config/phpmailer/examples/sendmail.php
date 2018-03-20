<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - sendmail test</title>
</head>
<body>
<?php
require '../PHPMailerAutoload.php';
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

$mail->SMTPDebug  = 2; // set mailer to use SMTP
$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond

//smtp.dps.globalxtreme.net
$mail->Host     = "202.58.203.26";        // specify main and backup server
$mail->Port     = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication


try {
  $mail->AddReplyTo('noreply@streambroadbandnetworks.net', 'Stream Broadband Network');
  $mail->AddAddress('dwi@globalxtreme.net', 'Dwi');
  $mail->AddAddress('tutnik@globalxtreme.net');
  $mail->AddAddress('cindie-admin@globalxtreme.net');
  
  $mail->SetFrom('noreply@streambroadbandnetworks.net', 'Stream Broadband Network');
  $mail->AddReplyTo('noreply@streambroadbandnetworks.net', 'Stream Broadband Network');
  $mail->Subject = 'Test Email Helpdesk SBN';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML('<p>Tes email dari Server helpdesk SBN</p>');
  $mail->Send();
  echo "Message Sent OK<p></p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
    
?>
</body>
</html>
