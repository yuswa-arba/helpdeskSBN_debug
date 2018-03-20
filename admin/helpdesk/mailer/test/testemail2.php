<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = false;                  // enable SMTP authentication
//	$mail->Port       = 25;                    // set the SMTP server port
//	$mail->Host       = "mail.yourdomain.com"; // SMTP server
//	$mail->Username   = "name@domain.com";     // SMTP server username
//	$mail->Password   = "password";            // SMTP server password
	$mail->Host 	  = "smtp.dps.globalxtreme.net";        // specify main and backup server
	$mail->Port       = 2505; 
//	$mail->SMTPAuth = false;    // turn on or off SMTP authentication

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("helpdesk@globalxtreme.net","Helpdesk");

	$mail->From       = "helpdesk@globalxtreme.net";
	$mail->FromName   = "Helpdesk";

	$to = "dwi@globalxtreme.net";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>