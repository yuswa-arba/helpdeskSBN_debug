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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	
    
if(isset($_POST["send"]))
{
    $kode_invoice		= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $title				= isset($_POST['title']) ? mysql_real_escape_string(trim($_POST['title'])) : '';
    $customer_number	= isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
    $nama_customer 		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $email_customer 		= isset($_POST['email_customer']) ? mysql_real_escape_string(trim($_POST['email_customer'])) : '';
    $note				= isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
    
    $periode_tagihan 	= isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
	
	$id_invoice	= isset($_POST['id_invoice']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_invoice']))) : "";
	
	$query_invoice 	= "SELECT `gx_invoice`.* , `tbCustomer`.*, `gx_paket2`.`nama_paket`
			   FROM `gx_invoice`, `tbCustomer`, `gx_paket2`
			   WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
			   AND `gx_invoice`.`customer_number` = `tbCustomer`.`cKode`
			   AND `gx_invoice`.`id_invoice` ='".$id_invoice."' LIMIT 0,1;";
	 $sql_invoice	= mysql_query($query_invoice, $conn);
	 $row_invoice	= mysql_fetch_array($sql_invoice);
	
$from		= "helpdesk@globalxtreme.net";


$mail   = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
$mail->SMTPDebug  = 1; // set mailer to use SMTP
$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond

//$mail->Host = "smtp.dps.globalxtreme.net";        // specify main and backup server
$mail->Host = "202.58.203.26";
$mail->Port       = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication

   
try
{
	 $mail->SetFrom( $from, 'Helpdesk GlobalXtreme');
	 $data_email = explode(';', $email_customer);
	foreach ($data_email as $emails)
	{
		//foreach (explode(';', "lutfi@globalxtreme.net; handaru@globalxtreme.net; dwi@globalxtreme.net") as $emails) {
		
		
		$mail->AddAddress(trim("$emails"), trim($nama_customer));
	}
	 //$mail->AddAddress("dwi@globalxtreme.net");
	 $mail->SetFrom( $from, 'Helpdesk GlobalXtreme');
	 //$mail->AddCC("$email_cc");
	 //$mail->AddBCC("$email_bcc");
	 
	 $pdf = generate_pdf(trim($kode_invoice));
	 
	 $nama_file = trim($row_invoice["customer_number"])."_".trim($row_invoice["periode_tagihan"]);
	 $nama_file = trim($nama_file).'.pdf';
	 $mail->AddAttachment("$nama_file");
	 
	 $mail->Subject  = $title;
	 $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	 $mail->MsgHTML($note);
	 
	 $mail->Send();
	 echo "<script language='JavaScript'>
	alert('Email Dikirim');
	window.location.href='form_email.php';
	</script>";
   
} catch (phpmailerException $e) {
	 echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
	 echo $e->getMessage(); //Boring error messages from anything else!
}


    
	
    
    
}


    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_email" id="form_email" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Invoice</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" readonly="" class="form-control" required="" name="kode_invoice" value="'.(isset($_GET['id']) ? $row_invoice["kode_invoice"] : '').'"
							onclick="return valideopenerform(\'data_invoice.php?r=form_email&f=invoice\',\'invoice\');">
							<input type="hidden" class="form-control" name="id_invoice" id="id_invoice" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Title</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="title" id="title" value="'.(isset($_GET['id']) ? $row_invoice["title"] : '').'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Customer Number</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" required="" name="customer_number" id="customer_number" value="'.(isset($_GET['id']) ? $row_invoice["customer_number"] : '').'">
						
					    </div>

					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" required="" name="nama_customer" id="nama_customer" value="'.(isset($_GET['id']) ? $row_invoice["nama_customer"] : '').'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Periode Tagihan</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" required="" name="periode_tagihan" id="periode_tagihan" value="'.(isset($_GET['id']) ? $row_invoice["periode_tagihan"] : '').'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Email</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" required="" name="email_customer" id="email_customer" value="">
					    </div>
                    </div>
					</div>
					
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Isi Pesan</label>
					    </div>
					    <div class="col-xs-9">
						<textarea class="form-control" name="note" style="resize:none;">'.(isset($_GET['id']) ? $row_invoice["note"] : "").'</textarea>
					    </div>
                    </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Prepared By </label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" readonly="" required="" name="prepared_by" id="prepared_by" value="'.(isset($_GET['id']) ? $row_invoice["prepared_by"] : $loggedin["username"]).'">
						
					    </div>
					<div>
					</div>
					    
                                        </div>
					</div>
					
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="send" class="btn btn-primary">Kirim Email</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Kirim Email Invoice';
    $submenu	= "invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>