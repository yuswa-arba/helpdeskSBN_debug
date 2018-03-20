<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("../../config/configuration_admin.php");
require_once ("../../config/phpmailer/PHPMailerAutoload.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
	
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open list Survey");
    
    global $conn;
    
	if(isset($_GET['id']))
    {
        $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
        $sql_data   = mysql_query("SELECT `gx_brosur_detail`.* FROM `gx_brosur`, `gx_brosur_detail`
                        WHERE `gx_brosur`.`id_brosur` = `gx_brosur_detail`.`id_brosur`
                        AND `gx_brosur`.`id_brosur` = '".$id_data."';",$conn);
        $row_data   = mysql_fetch_array($sql_data);
        $brosur = URL_ADMIN.$row_data["lokasi_file"].$row_data["nama_file"];
    }
    
    
function send_brosur($from, $to, $subject, $body, $attach)
{	
    
    $mail           = new PHPMailer(); // defaults to using php "mail()"
    $mail->IsSMTP();
    //$mail->SMTPDebug  = 1; // set mailer to use SMTP
    $mail->Timeout  = 120;     // set longer timeout for latency or servers that take a while to respond
    
    $mail->Host     = "202.58.203.26";        // specify main and backup server
    $mail->Port     = 2505; 
    $mail->SMTPAuth = false;    // turn on or off SMTP authentication
    
    
    $mail->SetFrom( "$from", 'GlobalXtreme Helpdesk');
    $mail->AddAddress("$to");
    $mail->SetFrom( "$from", 'GlobalXtreme Helpdesk');
    
    $mail->Subject  = $subject;
    $mail->AltBody  = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->MsgHTML($body);
    $mail->AddAttachment($attach);
    
    //$mail->IsHTML(true); // send as HTML
    $mail->Send();
    return "";
}
    
$send 		= isset($_POST['send_brosur']) ? $_POST["send_brosur"] : "";

if($send == "Send"){
    $id_marketing 	= isset($_POST['id_marketing']) ? mysql_real_escape_string(strip_tags(trim($_POST["id_marketing"]))) : '';
    $id_brosur 	    = isset($_POST['id_brosur']) ? mysql_real_escape_string(strip_tags(trim($_POST["id_brosur"]))) : '';
    $brosur 	    = isset($_POST['brosur']) ? mysql_real_escape_string(strip_tags(trim($_POST["brosur"]))) : '';
    $email_sender   = isset($_POST['email_sender']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_sender"]))) : '';
    $email_to      = isset($_POST['email_to']) ? mysql_real_escape_string(strip_tags(trim($_POST["email_to"]))) : '';
    
    $subject	= isset($_POST['subject']) ? mysql_real_escape_string(strip_tags(trim($_POST["subject"]))) : '';
    $message 	= isset($_POST['message']) ? $_POST["message"] : '';
         
         


$emailAttachment = '../../admin/upload/brosur/'.$brosur;

$count_email = count(explode(';', $email_to));
//$count_email = count(explode(';', "lutfi@globalxtreme.net; handaru@globalxtreme.net; dwi@globalxtreme.net"));

if($count_email > 1){
    foreach (explode(';', $email_to) as $emails)
    {
      
      send_brosur($email_sender, trim("$emails"), $subject, $message, $emailAttachment);
    }
}
elseif($count_email == 1)
{
    send_brosur($email_sender, $email_to, $subject, $message, $emailAttachment);
}

            
    $sql = "INSERT INTO `gx_send_brosur` (`id_send_brosur`, `id_marketing`, `email_sender`, `email_to`, `subject`, `body`, `id_brosur`, `date_add`)
    VALUES (NULL, '".$id_marketing."', '".$email_sender."', '".$email_to."', '".$subject."', '".$message."', '".$id_brosur."', NOW());";
    //echo $sql;
    mysql_query($sql, $conn) or die("<script language='JavaScript'>
				    alert('Maaf Data tidak bisa disimpan ke dalam Database, Ada kesalahan!');
				    window.history.go(-1);
			      </script>");
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Compose Email = $sql");
    echo "<script language='JavaScript'>
         alert('Email Anda Telah Terkirim');
         location.href = 'brosur.php';
      </script>";
   
}   
    $content ='<section class="content-header">
                    <h1>
                        Compose Email
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="master_customer">Send Brosur</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Send Brosur</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
                                    <form action="" method="post" name="form_brosur" >
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Email From</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="hidden" class="form-control" id="id_marketing" name="id_marketing" required="" readonly="" value="'.($loggedin["id_employee"]).'">
                                                <input type="hidden" class="form-control" id="id_brosur" name="id_brosur" required="" readonly="" value="'.(isset($_GET["id"]) ? $id_data : "").'">
                                                <input type="text" class="form-control" id="email_sender" name="email_sender" required="" readonly="" value="'. $loggedin["email"].'">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>To</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" id="email_to" name="email_to" required="" value="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Subject</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" id="subject" name="subject" required="" value="Brosur GlobalXtreme">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Messages</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <textarea name="message" rows="10" cols="80" id="editor1" cols="70" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Brosur</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="'.(isset($_GET["id"]) ? $brosur : "").'" target="_blank">
                                                    <img src="'.(isset($_GET["id"]) ? $brosur : "").'" style="width:200px;">
                                                </a>
                                                <input type="hidden" class="form-control" id="brosur" name="brosur" value="'.(isset($_GET["id"]) ? ($row_data["nama_file"]) : "").'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                
                                            </div>
                                            <div class="col-xs-3">
                                                
                                                <input style="font-size : 100%" type="submit" class="btn btn-primary" name="send_brosur" data-icon="v" value="Send">
                                            </div>
                                        </div>
                                    </div>
            
            
            
                                    
                            
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
            
    $title	= 'Send Brosur';
    $submenu	= "brosur";
    
    $plugins	= '<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}

    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>