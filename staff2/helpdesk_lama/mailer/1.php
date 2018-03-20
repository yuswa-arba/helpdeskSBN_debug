<?php
require_once('./class.phpmailer.php');

$mail             = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "muammarqathafi@gmail.com";  // GMAIL username
$mail->Password   = "lakilaki5555";            // GMAIL password

  $mail->AddAddress('muammarqathafi@gmail.com');
  $mail->SetFrom('noreply@dafi.com', 'Dafi');
  
  $mail->Subject  = "coba";
  $mail->AltBody  = "coba"; // optional, comment out and test
    $body = 900;

  $mail->MsgHTML($body);

  $mail->Send();

?>