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
   
require_once '../../admin/helpdesk/mailer/class.phpmailer.php';
require_once '../../admin/helpdesk/mailer/class.smtp.php';

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
     enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Reply Email ");
    global $conn;
    
 
$id_email 	= isset($_GET['id_email']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_email']))) : "";

$sql_email   	= mysql_fetch_array(mysql_query("select * FROM `gx_email` WHERE `ID` = '$id_email' ORDER BY `ID` DESC LIMIT 1", $conn));
//echo ''.$id_email.' hhhfhfhh'; 
$sql_email_setting   	= mysql_fetch_array(mysql_query("select * FROM `gx_email_setting` WHERE `level` = '0' LIMIT 0,1", $conn));
	
$send 		= isset($_POST['send']) ? $_POST["send"] : "";

if($send == "Send"){
         
	$id_complaint 	= isset($_POST['id_complaint']) ? mysql_real_escape_string(strip_tags(trim($_POST["id_complaint"]))) : '';
	$id_email 	= isset($_POST['id_email']) ? mysql_real_escape_string(strip_tags(trim($_POST["id_email"]))) : '';
	$email_from 	= isset($_POST['email_from']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_from"]))) : '';
	$status_email 	= isset($_POST['status_email']) ? mysql_real_escape_string(strip_tags(trim($_POST["status_email"]))) : '';
	
	$email_to 	= isset($_POST['email_to']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_to"]))) : '';
	$email_name 	= isset($_POST['email_name']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_name"]))) : '';
        $subject	= isset($_POST['subject']) ? mysql_real_escape_string(strip_tags(trim($_POST["subject"]))) : '';
        $message 	= isset($_POST['message']) ? $_POST["message"] : '';
	$footer 	= 'Best Regards,<br><br>

'.$loggedin["username"].'<br>
'.$loggedin["group"].'<br><br>
 

Helpdesk GlobalXtreme<br>
Jl. Raya Kerobokan 388x Br. Semer<br>
Kuta, Bali (80361) Indonesia<br>
telp.(0361) 7809613 / 7809616<br>
fax. (0361) 736833<br>
SMS Gateway 085 637 329 48<br>
http://www.globalxtreme.net<br><br>

Customer Feedback | How am I doing?<br>
Please let my supervisor know: mangnik@globalxtreme.net<br>';
	$message_html	= $message .'<br>'. $footer;
	
	$subject_reply = '['.$id_complaint.'] : '.$subject;
	 
    $from		= $email_from;
	$email_bcc	= $sql_email_setting["bcc_email"];
	$email_cc	= $sql_email_setting["cc_email"];
	 
$mail   = new PHPMailer(); // defaults to using php "mail()"
$mail->IsSMTP();
//$mail->SMTPDebug  = 1; // set mailer to use SMTP
$mail->Timeout = 120;     // set longer timeout for latency or servers that take a while to respond

$mail->Host = "smtp.dps.globalxtreme.net";        // specify main and backup server
$mail->Port       = 2505; 
$mail->SMTPAuth = false;    // turn on or off SMTP authentication

   
try {
   
   $mail->SetFrom( $from, 'GlobalXtreme Helpdesk');
   
   $mail->AddAddress($email_to, $email_name);
   $mail->SetFrom( $from, 'GlobalXtreme Helpdesk');
   $mail->AddCC($email_cc);
   $mail->AddBCC($email_bcc);
   //$mail->AddBCC("pm@globalxtreme.net");
  
   
   $mail->Subject  = $subject_reply;
   $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
   $mail->MsgHTML($message_html);

   $mail->Send();
   
   
   } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
   } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
   }
   
	$sql_update_status= "UPDATE `gx_email` SET `status_email`='".$status_email."' WHERE (`ID`='".$id_email."');";
	mysql_query($sql_update_status, $conn);

    $sql_insert = "INSERT INTO `gx_email_reply`(`id_email_reply`, `id_email`, `email_to`, `name`, `email_from`, `email_bcc`,
	    `subject`, `message`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	    VALUES(NULL, '".$id_email."', '".$email_to."', '".$email_name."', '".$from."', '".$email_bcc."',
	    '$subject_reply', '$message', '".$loggedin["username"]."', '".$loggedin["username"]."',  NOW(), NOW(), '0')";
	    //echo $sql_insert;
   
    mysql_query($sql_insert, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Reply Email = $sql_insert");
    echo "<script language='JavaScript'>
         alert('Email Anda Telah Terkirim');
         location.href = 'mailbox.php';
      </script>";
   
}   
    
 //echo date("Y-m-d H:i:s");
    $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT `ID`, `EmailFrom`, `EmailFromP`, `EmailTo`, `DateE`, `DateDb`, `DateRead`, `DateRe`, `Subject`, `Message`, `Message_html`,`id_kategori`, `id_complaint`, `status_email`
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` WHERE `level` = '1';",$conn);
    $content ='<section class="content-header">
                    <h1>
                        Form Reply
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Mailbox</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				    <form action="" method="post" name="form_reply">
				    <input type="hidden" name="id_email" value="'.$email["ID"].'" />
				    <input type="hidden" name="id_complaint" value="'.$email["id_complaint"].'" />
				    <input type="hidden" name="email_to" value="'.$email["EmailFrom"].'" />
				    <input type="hidden" name="email_name" value="'.$email["EmailFromP"].'" />
				    
          <table style="width:95%;">
	    <tbody>
	    <tr>
		<td style="width:30%;">
		    <label>ID</label>
		</td>
		<td style="width:70%;">
		    ['.$email["id_complaint"].']
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Email From</label>
		</td>
		<td>
		    <span>'.$email["EmailFromP"].'</span> ('.$email["EmailFrom"].')
		</td>
		
	    </tr>
	    <tr>
		<td>
		    <label>Tanggal</label>
		</td>
		<td>
		    '.$email["DateE"].'
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Subject</label>
		</td>
		<td>
		    '.$email["Subject"].'
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Body</label>
		</td>
		<td>
		    '.$email["Message_html"].'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    <tr>
		<td>
		    <label>Kategori</label>
		</td>
		<td>
		    ';
		    if($email["id_kategori"] == "0"){
			    $content .='No Kategori';
			}
		    while($row_parent = mysql_fetch_array($sql_parent)){
			
			$content .=($row_parent["id_kategori"]== $email["id_kategori"]) ? $row_parent["nama_kategori"] :"";
			
		    }
			
		    $content .='
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Email From</label>
		</td>
		<td>
		    <div class="">
			<input type="text" name="email_from" value="'.$sql_email_setting["reply_from"].'" readonly="" class="form-control">
		    </div>
		</td>
	    </tr>
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Subject</label>
		</td>
		<td>
		    <div class="">
			<input type="text" name="subject" value="RE: '.$email["Subject"].'" class="form-control">
		    </div>
		</td>
	    </tr>
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Message</label>
		</td>
		<td>
		    <div class="box-body pad">
			<textarea name="message" rows="10" id="editor1" cols="70" style="resize: none;">Dear '.$email["EmailFromP"].', </textarea>
		    </div>
		</td>
	    </tr>
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Footer</label>
		</td>
		<td>
		    <div class="box-body pad">
			<textarea name="footer" rows="6" cols="50" id="editor2" style="resize: none;" style="resize: none;">Best Regards,<br><br>

'.$loggedin["username"].'<br>
'.$loggedin["group"].'<br><br>
 

Helpdesk GlobalXtreme<br>
Jl. Raya Kerobokan 388x Br. Semer<br>
Kuta, Bali (80361) Indonesia<br>
telp.(0361) 7809613 / 7809616<br>
fax. (0361) 736833<br>
SMS Gateway 085 637 329 48<br>
http://www.globalxtreme.net<br><br>

Customer Feedback | How am I doing?<br>
Please let my supervisor know: mangnik@globalxtreme.net</textarea>
		    </div>
		</td>
	    </tr>
	    <tr style="vertical-align: middle;">
		<td style="vertical-align: middle;">
		    <label>Status</label>
		</td>
		<td>
		    <div class="">
			<select name="status_email">
				<option value="0" '.(($email["status_email"] == 0) ? 'selected=""' : "").'>Open</option>
				<option value="1" '.(($email["status_email"] == 1) ? 'selected=""' : "").'>Closed</option>
				<option value="2" '.(($email["status_email"] == 2) ? 'selected=""' : "").'>Re-Open</option>
			</select>
		    </div>
		</td>
	    </tr>
	    </tbody>
	</table>
	<div class="actions">
	    <div class="button-well">
		<input type="submit" class="button button-primary" data-icon="v" name="send" value="Send">
	    </div>
	</div>
	
	</form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                
		CKEDITOR.replace(\'editor2\', {readOnly:true});
                
            });
        </script>';

    $title	= 'Form Reply';
    $submenu	= "mailbox";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>