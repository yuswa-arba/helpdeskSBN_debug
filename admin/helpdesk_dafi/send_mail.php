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
require_once 'mailer/class.phpmailer.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    global $conn_voip;
 
$id_email 	= isset($_GET['id_email']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_email']))) : "";

$sql_email   	= mysql_fetch_array(mysql_query("select * FROM `gx_email` WHERE `ID` = '$id_email' ORDER BY `ID` DESC LIMIT 1", $conn));
//echo ''.$id_email.' hhhfhfhh'; 
 	
$send 		= isset($_POST['compose_email']) ? $_POST["compose_email"] : "";

if($send == "Send"){
         $email_to 	= isset($_POST['email_to']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_to"]))) : '';
         $subject	= isset($_POST['subject']) ? mysql_real_escape_string(strip_tags(trim($_POST["subject"]))) : '';
         $message 	= isset($_POST['message']) ? $_POST["message"] : '';
         $from		= "dwi@globalxtreme.net";
$mail   = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
$mail->SMTPDebug  = 1; // set mailer to use SMTP
$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond

$mail->Host = "smtp.dps.globalxtreme.net";        // specify main and backup server
$mail->Port       = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication

   
try {

   
   
   $mail->SetFrom( $from, 'GlobalXtreme Helpdesk');
   
   $mail->AddAddress($email_to);
   $mail->SetFrom( $from, 'GlobalXtreme Helpdesk');
   //$mail->AddBCC("");
  
   
   $mail->Subject  = $subject;
   $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
   $mail->MsgHTML($message);

   $mail->Send();
   
   
   } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
   } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
   }
   
            
				
   echo "<script language='JavaScript'>
         alert('Email Anda Telah Terkirim');
         location.href = 'send_mail.php';
      </script>";
   
}   
    $content ='<section class="content-header">
                    <h1>
                        Compose Email
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_customer">Compose Email</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Compose Email</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
                                    <form action="" method="post" name="form_nonprospek" >
		    <table class="form" width="100%">
		      <tr>
			<td>
			  <label>TO</label>
			</td>
			<td>
			  <input class="form-control" name="id_email" placeholder="ID Email" type="hidden" value="'.(isset($_GET["id_email"]) ? $_GET["id_email"] :"") .'" readonly="">
			  <input class="form-control " name="email_to" id="email_to" placeholder="Email To" type="text" value="'.(isset($_GET["id_email"]) ? $sql_email['EmailFrom'] :"") .'">
			</td>
		      </tr>
		      <tr>
			<td>
			  <label>Subject</label>
			</td>
			<td>
			  <input class="form-control " name="subject" id="subject" placeholder="Subject" type="text" value="'.(isset($_GET["id_email"]) ? 'RE : '.$sql_email['Subject'] :"") .'">
			</td>
		      </tr>
		      <tr style="vertical-align: middle;">
			<td style="vertical-align: middle;">
			  <label>Message</label>
			</td>
			<td>
			<div class="box-body pad">
			  <textarea name="message" rows="10" cols="80" id="editor1" cols="70" style="resize: none;"> '.(isset($_GET["id_email"]) ? '<br /> <br /><blockquote> ---- '.$sql_email['EmailFromP'].'  wrote ---- <br /> <br />'.$sql_email['Message'] :"").'</blockquote> </textarea>
			</div>
			</td>
		      </tr>
		    </table>
		    <div class="actions" align="right">
	
		      <div class="button-well">
	
			<input style="font-size : 100%" type="submit" class="btn btn-primary" name="compose_email" data-icon="v" value="Send">
	
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

    $title	= 'Master Customer';
    $submenu	= "customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>