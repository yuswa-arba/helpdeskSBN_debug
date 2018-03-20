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



redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}

 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Newsletter");
    global $conn;

//send newsletter	
if(isset($_POST['send'])){
 mysql_query("INSERT INTO `newsletter` (`id_newsletter`,`subject`,`message`,`date_add`,`to`) VALUES('','$_POST[subjek]','$_POST[message]',NOW(),'1')");
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Send Newsletter = INSERT INTO `newsletter` (`id_newsletter`,`subject`,`message`,`date_add`,`to`) VALUES('','$_POST[subjek]','$_POST[message]',NOW(),'1')");
 require_once('mailer/class.phpmailer.php');
 $sql_query_klien = mysql_query("SELECT `email`,`nama` FROM `klien` ORDER BY `id_klien` ASC");
 
 $mail             = new PHPMailer();
 $mail->IsSMTP(); // telling the class to use SMTP
 $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
					    // 1 = errors and messages
					    // 2 = messages only
 $mail->SMTPAuth   = true;                  // enable SMTP authentication
 $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
 $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
 $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
 $mail->Username   = "hostingdafi13@gmail.com";  // GMAIL username
 $mail->Password   = "lakilaki5555";            // GMAIL password
 while($d_sql = mysql_fetch_array($sql_query_klien)){
     $mail->AddAddress($d_sql['email']);
 }
 $mail->SetFrom('noreply@newsletter-gx.com', 'Newsletter');
 $mail->Subject  = $_POST['subjek'];
 $mail->AltBody  = $_POST['subjek']; // optional, comment out and test
 $body = $_POST['message'] . '<br><a href="192.168.182.10/helpdesk/unsubscribe.php?email='.$d_sql['email'].'&auth='.md5($d_sql['nama']).'">Unsubscribe</a>';
 $mail->MsgHTML($body);
 $mail->Send();

}    

    $content ='<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Newsletter</h1>
                </section>

                <!-- Main content -->
                <section class="content">';



if(isset($_GET['id_newsletter'])){
 
$data_newsletter_forward = mysql_fetch_array(mysql_query("SELECT * FROM `newsletter` WHERE `id_newsletter`='$_GET[id_newsletter]'"));

$content .= '       <div class=\'row\'>
                        <div class=\'col-md-12\'>
                            <div class=\'box box-info\'>
			    <div class="box-header">
                                    <h3 class="box-title">Form Newsletter</h3>
				    <div class="box-tools pull-right">
					
					<div class="btn bg-olive btn-flat margin">
					    <a href="'.URL_CSO.'helpdesk/list_newsletter.php">List Newsletter</a>
					</div>
				    </div>
                                </div><!-- /.box-header -->
                                <div class=\'box-body pad\'>
                                    <form method="POST" action="" enctype="multipart/form-data">
                                    <table width="100%" align="center">
                                    <tr><td>Subjek</td><td align="right"><input id="subjek" type="text" name="subjek" placeholder="subjek" style="width:95%;" value="'.$data_newsletter_forward['subject'].'"></td></tr>
                                    <tr><td>Message</td><td>&nbsp;</td></tr>
                                    <tr><td colspan="3">
                                                    <textarea id="editor1" name="message" rows="10" cols="80">'.$data_newsletter_forward['message'].'</textarea>                        
                                    <tr><td colspan="3" align="right"><input type="submit" value="Send" name="send" onclick="return confirm(\'Apakah pesan ini telah benar, dan siap anda kirim?\');" style="margin:5px 0px;">
                                    <p id="error">Please check your form.</p></td></tr>
                                    </table>
                                    </form>
                                </div>
                            </div>
                       </div><!-- /.col-->
                    </div><!-- ./row -->
';
}
else{
$content .= '       <div class=\'row\'>
                        <div class=\'col-md-12\'>
                            <div class=\'box box-info\'>
			    <div class="box-header">
                                    <h3 class="box-title">Form Newsletter</h3>
				    <div class="box-tools pull-right">
					
					<div class="btn bg-olive btn-flat margin">
					    <a href="'.URL_CSO.'helpdesk/list_newsletter.php">List Newsletter</a>
					</div>
				    </div>
                                </div><!-- /.box-header -->
                                <div class=\'box-body pad\'>
                                    <form method="POST" action="" enctype="multipart/form-data">
                                    <table width="100%" align="center">
                                    <tr><td>Subjek</td><td align="right"><input id="subjek" type="text" name="subjek" placeholder="subjek" style="width:95%;" value=""></td></tr>
                                    <tr><td>Message</td><td>&nbsp;</td></tr>
                                    <tr><td colspan="3">
                                                    <textarea id="editor1" name="message" rows="10" cols="80"></textarea>                        
                                    <tr><td colspan="3" align="right"><input type="submit" value="Send" name="send" onclick="return confirm(\'Apakah pesan ini telah benar, dan siap anda kirim?\');" style="margin:5px 0px;">
                                    <p id="error">Please check your form.</p></td></tr>
                                    </table>
                                    </form>
                                </div>
                            </div>
                       </div><!-- /.col-->
                    </div><!-- ./row -->
';    
}    
$content .= ' 


                </section><!-- /.content -->';

$plugins = '
        <!-- CK Editor -->
        <script src="../../js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'editor1\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>';

    $title	= 'Home';
    $submenu	= "Newsletter";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>