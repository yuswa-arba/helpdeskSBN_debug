<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");
require_once '../helpdesk/mailer/class.phpmailer.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Send Mail Surat ");
    global $conn;
    global $conn_voip;
 if(isset($_GET["id"])){
	 $id_email 	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
	 $sql_email   	= mysql_fetch_array(mysql_query("select * FROM `gx_send_mail_surat` WHERE `id_send_mail` = '$id_email' ORDER BY `id_send_email` DESC LIMIT 1", $conn));
	 //echo ''.$id_email.' hhhfhfhh'; 
 }
 
$send 		= isset($_POST['send_mail']) ? $_POST["send_mail"] : "";

if($send == "Send"){
		 $kode_cabang = isset($_POST['kode_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST["kode_cabang"]))) : "";
		 $nama_cabang = isset($_POST['nama_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST["nama_cabang"]))) : "";
         $email_to 	= isset($_POST['email_to']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_to"]))) : '';
         $email_cc 	= isset($_POST['email_cc']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_cc"]))) : '';
         $email_bcc	= isset($_POST['email_bcc']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_bcc"]))) : '';
         $kode_send_mail 	= isset($_POST['kode_send_mail']) ? mysql_real_escape_string(strip_tags(trim($_POST["kode_send_mail"]))) : '';
         $keperluan	= isset($_POST['keperluan']) ? mysql_real_escape_string(strip_tags(trim($_POST["keperluan"]))) : '';
		 $tanggal	= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST["tanggal"]))) : '';
         $message 	= isset($_POST['message']) ? $_POST["message"] : '';
         $from		= "kharis@globalxtreme.net";
$mail   = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
$mail->SMTPDebug  = 1; // set mailer to use SMTP
$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond

$mail->Host = "smtp.dps.globalxtreme.net";        // specify main and backup server
$mail->Port       = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication

   
try {

   
   
   $mail->SetFrom( $from, 'GlobalXtreme Mail');
   
   $mail->AddAddress($email_to);
   $mail->SetFrom( $from, 'GlobalXtreme Mail');
   $mail->AddCC("$email_cc");
   //$mail->AddBCC("$email_bcc");
  
   
   $mail->Subject  = $keperluan;
   $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
   $mail->MsgHTML($message);

   $mail->Send();
   
   
   } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
   } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
   }
   
            
    $sql = "INSERT INTO `gx_send_mail_surat`(`id_send_mail`,`kode_cabang`,`nama_cabang`, `tanggal`,
		   `kode_send_mail`, `keperluan`, `email_to`, `email_cc`, `email_bcc`,
		   `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                     VALUES('','".$kode_cabang."','".$nama_cabang."','".$tanggal."',
						    '".$kode_send_mail."','".$keperluan."', '".$email_to."', '".$email_cc."', '".$email_bcc."',
							'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(),'0');";
   //echo $sql;
    /*mysql_query($sql, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!x');
				    window.history.go(-1);
			      </script>");
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Compose Email = $sql");*/
   echo "<script language='JavaScript'>
         alert('Email Anda Telah Terkirim');
         location.href = 'master_send_mail.php';
      </script>";
   
}   
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Send Mail Surat</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				<form role="form" name="myForm" method="POST" action="" >
				<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=mail_surat\',\'cabang\');"  placeholder="cabang">
											</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												  <label>Kode Send Mail</label>
											</div>
											<div class="col-xs-3">
												  <input type="text" readonly="" class="form-control" required id="kode_send_mail" name="kode_send_mail" value="'.(isset($_GET['id']) ? $row_mastersurat["kode_send_mail"] : "").'">
											</div>
										</div>
										</div>
				
				<div class="box-header">
                                </div><!-- /.box-header -->
                                    <form action="" method="post" name="form_nonprospek" >
										<table class="form" width="100%">
										 <tr>
										<td>
										  <label>Subject</label>
										</td>
										<td>
										  <input class="form-control " name="keperluan" id="keperluan" placeholder="Subject" type="text" value="'.(isset($_GET["id"]) ? $sql_email['keperluan'] :"") .'">
										</td>
										  </tr>
										  <tr>
										<td>
										  <label>TO</label>
										</td>
										<td>
										  <input class="form-control " name="email_to" id="email_to" placeholder="Email To" type="text" value="'.(isset($_GET["id"]) ? $sql_email['EmailFrom'] :"") .'">
										</td>
										  </tr>
										  
										  <tr>
										<td>
										  <label>CC</label>
										</td>
										<td>
										  <input class="form-control " name="email_cc" id="email_cc" placeholder="CC" type="text" value="'.(isset($_GET["id"]) ? $sql_email['email_cc'] :"") .'">
										</td>
										  </tr>
										  <tr>
										<td>
										  <label>BCC</label>
										</td>
										<td>
										  <input class="form-control " name="email_bcc" id="email_bcc" placeholder="BCC" type="text" value="'.(isset($_GET["id"]) ? $sql_email['email_bcc'] :"") .'">
										</td>
										  </tr>
										  <tr style="vertical-align: middle;">
										<td style="vertical-align: middle;">
										  <label>Message</label>
										</td>
										<td>
										<div class="box-body pad">
										  <textarea name="message" rows="10" cols="80" id="editor1" cols="70" style="resize: none;"> '.(isset($_GET["id"]) ? $sql_email['Message'] :"").'</blockquote> </textarea>
										</div>
										</td>
										  </tr>
										</table>
		    <div class="actions" align="right">
	
		      <div class="button-well">
	
			<input style="font-size : 100%" type="submit" class="btn btn-primary" name="send_mail" data-icon="v" value="Send">
	
		      </div>
	
	
	
		    </div>
		    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#mailbox\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
    ';

    $title	= 'Surat Email';
    $submenu	= "send_mail";
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