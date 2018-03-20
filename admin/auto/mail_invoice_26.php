<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("/var/www/sbn/beta/config/configuration_admin.php");
//include ("/var/www/software/beta/config/configuration_voip_bpn.php");
include '/var/www/sbn/beta/admin/helpdesk/mailer/class.phpmailer.php';
require_once("/var/www/sbn/beta/admin/auto/mail_generate.php");

global $conn;



$tgl_tagihan    = date("Y-m-26");
$bln_tagihan    = date("Y-m-01", strtotime("+1 month"));
$periode_tagihan = NamaBulan(date("n", strtotime($bln_tagihan)))." ".date("Y", strtotime($bln_tagihan));
//GENERATE INVOICE
$query_invoice	= "SELECT * FROM `gx_invoice`
				WHERE `level` = '0'
				
				AND `title` LIKE '%INVOICE ".$periode_tagihan."%'
				AND `tanggal_tagihan` LIKE '%".date("Y-m-d", strtotime($tgl_tagihan))."%';";
//echo $query_invoice;
//$query_invoice	= "SELECT * FROM `gx_invoice`
//				WHERE `title` = 'INVOICE Mei 2017';";
				
$sql_invoice	= mysql_query($query_invoice, $conn);

while($row_invoice = mysql_fetch_array($sql_invoice))
{
	
	//$pdf = generate_pdf($row_invoice["kode_invoice"]);
	$query_customer	= "SELECT * FROM `v_customer_aktivasi`
	WHERE `cKode` = '".$row_invoice["customer_number"]."' LIMIT 0,1;";
	
	$sql_customer	= mysql_query($query_customer, $conn);
	$row_customer	= mysql_fetch_array($sql_customer);
	
	if($row_customer["cEmail"] != ""
	   AND $row_customer["kode_aktivasi"] != ""
	   AND $row_customer["kode_off"] == NULL 
	   AND $row_customer["kode_inactive"] == "")
	{
	
		$mail   = new PHPMailer(); // defaults to using php "mail()"
		$mail->IsSMTP();
		$mail->SMTPDebug  = 1; // set mailer to use SMTP
		$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond
		
		//smtp.dps.globalxtreme.net
		$mail->Host = "202.58.203.26";        // specify main and backup server
		$mail->Port       = 2505; 
		$mail->SMTPAuth = false;    // turn on or off SMTP authentication
		
		$from = "noreply@streambroadbandnetworks.net";
		$message = invoice_mail($row_customer["cNama"], $row_invoice["periode_tagihan"]);
		
		try {
		
			$mail->SetFrom( $from, 'Helpdesk SBN');
			// $mail->AddAddress('tutnik@globalxtreme.net');
			// $mail->AddAddress('cindie-admin@globalxtreme.net');
			// $mail->AddAddress('dwi@globalxtreme.net');
			$data_email = explode(';', $row_customer["cEmail"]);
			foreach ($data_email as $emails)
			{
				$mail->AddAddress(trim("$emails"), trim($row_customer["cNama"]));
			}
			$mail->SetFrom( $from, 'Helpdesk SBN');
			
			
			//admin invoice SBN
			//cso balikpapan tgl 2 oktober 2017
			//$mail->AddBCC('cso.balikpapan@globalxtreme.net');
			
			$mail->AddBCC('tutnik@globalxtreme.net');
			$mail->AddBCC('cindie-admin@globalxtreme.net');
			
			$mail->AddAttachment("/var/www/sbn/beta/admin/auto/invoice/sbn_".$row_invoice["kode_invoice"].".pdf");
			
			$mail->Subject  = $row_invoice["note"];
			$mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML($message);
			
			$mail->Send();
		
		
		} catch (phpmailerException $e) {
		   echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
		   echo $e->getMessage(); //Boring error messages from anything else!
		}
		
		//insert log email invoice
		
		$query_email_invoice	= "INSERT INTO `gx_invoice_email` (`id_email_invoice`, `kode_customer`, `nama_customer`, `email_invoice`, `file_invoice`, `date`)
		VALUES (NULL, '".$row_customer["cKode"]."', '".$row_customer["cNama"]."', '".$row_customer["cEmail"]."', '/sbn/beta/admin/auto/invoice/sbn_".$row_invoice["kode_invoice"].".pdf', NOW());";
		
		mysql_query($query_email_invoice, $conn);
	}
	
}
/* crontab script
 * 
 * 10 6 1 * * php -f /var/www/sbn/beta/admin/auto/mail_invoice.php >> /var/log/crontab_mail_invoice_sbn.log 2>&1
 *
 */
