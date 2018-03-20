<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");
require_once '../../helpdesk/mailer/class.phpmailer.php';
require_once 'generate_pdf.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
	 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Send Mail Surat ");
    global $conn;

	$id_invoice	= isset($_GET['id_invoice']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_invoice']))) : "";
	
	$query_invoice 	= "SELECT `gx_invoice`.* , `tbCustomer`.*, `gx_paket2`.`nama_paket`
			   FROM `gx_invoice`, `tbCustomer`, `gx_paket2`
			   WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
			   AND `gx_invoice`.`customer_number` = `tbCustomer`.`cKode`
			   AND `gx_invoice`.`id_invoice` ='".$id_invoice."' LIMIT 0,1;";
	 $sql_invoice	= mysql_query($query_invoice, $conn);
	 $row_invoice	= mysql_fetch_array($sql_invoice);
	
$from		= "helpdesk@globalxtreme.net";
$message = 'ini isi email tes';

$mail   = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
$mail->SMTPDebug  = 2; // set mailer to use SMTP
$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond

//$mail->Host = "smtp.dps.globalxtreme.net";        // specify main and backup server
$mail->Host = "202.58.203.26";
$mail->Port       = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication

   
try
{
	 $mail->SetFrom( $from, 'Helpdesk GlobalXtreme');
	 
	 $mail->AddAddress("dwi@globalxtreme.net");
	 $mail->SetFrom( $from, 'Helpdesk GlobalXtreme');
	 //$mail->AddCC("$email_cc");
	 //$mail->AddBCC("$email_bcc");
	 
	 $pdf = generate_pdf(trim($id_invoice));
	 
	 $nama_file = trim($row_invoice["customer_number"])."_".trim($row_invoice["periode_tagihan"]);
	 $nama_file = trim($nama_file).'.pdf';
	 $mail->AddAttachment("$nama_file");
	 
	 $mail->Subject  = "Test Email";
	 $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	 $mail->MsgHTML($message);
	 
	 $mail->Send();
	 echo "send";
   
} catch (phpmailerException $e) {
	 echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
	 echo $e->getMessage(); //Boring error messages from anything else!
}
   
}
   
	 } else{
		  header("location: ".URL_ADMIN."logout.php");
	 }

?>