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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Newsletter");
    global $conn;
    global $conn_voip;

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
    global $conn;
    global $conn_voip;
    
    $stats_content ='<h4>'.((isset($_GET["b"]) && isset($_GET["t"])) ? 'Bulan '.date("F", mktime(0, 0, 0, (int)$_GET["b"], 10)).' Tahun '.(int)$_GET["t"] : '').'</h4>
                
                <form action="" method="get">
  Sort by
<select name="sort" onchange="location.href=\'stats.php\'+options[selectedIndex].value;">
	<option value="">- Select -</option>
	<option value="">This Week</option>
	<option value="?b='.date("m").'&t='.date("Y").'">This Month</option>
        
</select>
</form>
                <div class="block">
                    <div id="chart1">';
                    
//echo $data_graph1;color: {['#FC0101','#012AFC','#04B625','#FFCC00','#3D96AE']},

//Statistik Complaint
/*$stat_complaint = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%';"));
$stat_ticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Problem';"));
$stat_nonticket = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `complaint_type` = 'Request';"));
$stat_prospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'prospek';"));
$stat_nonprospek = mysql_num_rows(mysql_query("SELECT * FROM `gx_complaint` WHERE `log_time` LIKE '%".date("Y-m-")."%' AND `status_prospek` = 'nonprospek';"));
$stat_spktech = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'teknisi';"));
$stat_spkmkt = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk` WHERE `date_add` LIKE '%".date("Y-m-")."%' AND `type_spk` = 'marketing';"));
*/

//Array for userID Complaint
$replaceWord = array("/", '\/', ";", ",");

/*
 		
if(isset($_GET['id_newsletter'])){
 
$data_newsletter_forward = mysql_fetch_array(mysql_query("SELECT * FROM `newsletter` WHERE `id_newsletter`='$_GET[id_newsletter]'"));

$content .= '       <form action="" method="post" enctype="multipart/form-data" id="theform">
                        <table width="100%" align="center">
                        <tr><td>Subjek</td><td align="right"><input id="subjek" type="text" name="subjek" placeholder="subjek" style="width:95%;" value="'.$data_newsletter_forward['subject'].'"></td></tr>
                        <tr><td>Message</td><td>&nbsp;</td></tr>
			<tr><td colspan="3"><textarea id="editor1" name="message" rows="10" cols="80">'.$data_newsletter_forward['message'].'</textarea></td></tr>
                        <tr><td colspan="3" align="right"><input type="submit" value="Send" name="send" onclick="return confirm(\'Apakah pesan ini telah benar, dan siap anda kirim?\');" style="margin:5px 0px;">
			<p id="error">Please check your form.</p></td></tr>
                        </table>
                    </form>';
}
else{
$content .= '       <form action="" method="post" enctype="multipart/form-data" id="theform">
                        <table width="100%" align="center">
                        <tr><td>Subjek</td><td align="right"><input id="subjek" type="text" name="subjek" placeholder="subjek" style="width:95%;"></td></tr>
                        <tr><td>Message</td><td>&nbsp;</td></tr>
			<tr><td colspan="3"><textarea name="message" id="elm1" rows="15" cols="80" style="width: 100%" class="tinymce"></textarea></td></tr>
                        <tr><td colspan="3" align="right"><input type="submit" value="Send" name="send" onclick="return confirm(\'Apakah pesan ini telah benar, dan siap anda kirim?\');" style="margin:5px 0px;">
			<p id="error">Please check your form.</p></td></tr>
                        </table>
                    </form>
';
}

 */
$stats_content .='

<div id="graphDashboard" style="min-width:100%; height: 380px; margin: 0 auto;"></div>
                    
                    
                    </div>
                </div>';
            
    $content ='<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Newsletter
                        <small>Advanced form element</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">Editors</li>
                    </ol>
                </section>
		
		
                <!-- Main content -->
                <section class="content">
                

<a href="newsletter.php" class="btn btn-primary btn-sm btn-flat">Add Newsletter</a>
                <a href="list_newsletter.php" class="btn btn-primary btn-sm  btn-flat">List Newsletter</a>
		
		';



if(isset($_GET['id_newsletter'])){
 
$data_newsletter_forward = mysql_fetch_array(mysql_query("SELECT * FROM `newsletter` WHERE `id_newsletter`='$_GET[id_newsletter]'"));

$content .= '       <div class=\'row\'>
                        <div class=\'col-md-12\'>
		            <div class=\'box box-info\'>
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

$query_callhistory = "SELECT t1.starttime, t1.src, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0
                    AND `starttime`
		    ORDER BY `starttime` DESC
		    LIMIT 0,5";

$sql_callhistory = mysql_query($query_callhistory, $conn_voip);

$no = 1;
while ($row_callhistory = mysql_fetch_array($sql_callhistory)){
    
$content .='';
//<td>'.Rupiah((int)$row_callhistory["sessionbill"]).'</td>
$no++;
}
$content .='';

/*
 *<!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
*/
$plugins = '
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
         <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>        
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
    $submenu	= "dashboard";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ../logout.php");
    }

?>