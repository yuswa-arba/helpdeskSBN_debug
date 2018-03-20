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
if($loggedin = logged_inCSO()){ // Check if they are logged in
    if($loggedin["group"] == 'cso'){
        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Mail");
        global $conn;
        
        $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT *
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    
    $sql_email_all = mysql_query("SELECT * FROM `gx_email`
			 WHERE `Subject` = 'Re: ".$email["Subject"]."'
                         
                         ORDER BY `DateE` ASC;",$conn);
    
    $sql_email_reply = mysql_query("SELECT *
			 FROM `gx_email_reply`
			 WHERE `id_email` = '".$id_mailbox."'
			 ORDER BY `date_add` DESC;;",$conn);
	
    $content ='<section class="content-header">
                    <h1 class="page-header">
                        View Email
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">'.$email["Subject"].'</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        
                                        ';
$noa = 1;
while($email_reply_db = mysql_fetch_array($sql_email_reply)){
    $content .= '<div class="panel box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$noa.'">
                                '.$email_reply_db["email_from"].'
                            </a>
                            
                        </h4>
                        <span class="pull-right margin">'.date("d M Y h:i:s", strtotime($email_reply_db["date_add"])).' | <a href="form_reply.php?id='.$email_reply_db['id_email'].'">Reply</a></span> 
                    </div>
                    <div id="collapse'.$noa.'" class="panel-collapse collapse">
                        <div class="box-body">
                            Email From: '.$email_reply_db["name"].' ('.$email_reply_db["email_from"].')<br><br>
                            
                            '.(($email_reply_db["message"] != "") ? $email_reply_db["message"] : "").'
                            
                            <br><br><br><br>
                            Attachment:<br><br>';
$sql_email_reply_attach = mysql_query("SELECT *
      FROM `gx_email_attach`
      WHERE `IDEmail` = '".$email_reply_db["id_email"]."';",$conn);
while($email_reply_attach = mysql_fetch_array($sql_email_reply_attach)){
    $content .= '<a href="'.str_replace("/var/www/software/", "https://172.16.79.194/software/", $email_reply_attach["Filename"] ).'" target="_blank">
            '.$email_reply_attach["FileNameOrg"].'</a><br>';
}
$content .= '
								  </div>
							      </div>
							  </div>';

$noa++;
				     }
					 
$no = 1;
while($email_reply = mysql_fetch_array($sql_email_all)){
    $content .= '<div class="panel box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$no.'">
                                '.$email_reply["EmailFromP"].'
                            </a>
                            
                        </h4>
                        <span class="pull-right margin">'.date("d M Y H:i:s", strtotime($email_reply["DateE"])).' | <a href="form_reply.php?id='.$email_reply['ID'].'">Reply</a></span> 
                    </div>
                    <div id="collapse'.$no.'" class="panel-collapse collapse">
                        <div class="box-body">
                            Email From: '.$email_reply["EmailFromP"].' ('.$email_reply["EmailFrom"].')<br><br>
                            
                            '.(($email_reply["Message_html"] != "") ? $email_reply["Message_html"] : nl2br($email_reply["Message"])).'
                            
                            <br><br><br><br>
                            Attachment:<br><br>';
$sql_email_reply_attach = mysql_query("SELECT *
      FROM `gx_email_attach`
      WHERE `IDEmail` = '".$email_reply["ID"]."';",$conn);
while($email_reply_attach = mysql_fetch_array($sql_email_reply_attach)){
    $content .= '<a href="'.str_replace("/var/www/software/", "https://172.16.79.194/software/", $email_reply_attach["Filename"] ).'" target="_blank">
            '.$email_reply_attach["FileNameOrg"].'</a><br>';
}
$content .= '
								  </div>
							      </div>
							  </div>';

$no++;
				     }
$content .= '
                                        <div class="panel box box-primary">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
                                                        '.$email["EmailFromP"].'
                                                    </a>
                                                    
                                                </h4>
                                                <span class="pull-right margin">'.date("d M Y H:i:s", strtotime($email["DateE"])).' | <a href="form_reply.php?id='.$email["ID"].'">Reply</a></span>
                                            </div>
                                            <div id="collapse0" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    Email From: '.$email["EmailFromP"].' ('.$email["EmailFrom"].')<br><br>
                                                    
                                                    '.(($email["Message_html"] != "") ? $email["Message_html"] : nl2br($email["Message"])).'
                                                    
                                                    <br><br><br><br>
                                                    Attachment:<br><br>';
$sql_email_reply_attach = mysql_query("SELECT *
      FROM `gx_email_attach`
      WHERE `IDEmail` = '".$email["ID"]."';",$conn);
while($email_reply_attach = mysql_fetch_array($sql_email_reply_attach)){
    $content .= '<a href="'.str_replace("/var/www/software/", "https://172.16.79.194/software/", $email_reply_attach["Filename"] ).'" target="_blank">
            '.$email_reply_attach["FileNameOrg"].'</a><br>';
}
$content .= '
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- END ACCORDION & CAROUSEL-->
                </section><!-- /.content -->
            ';

    $title	= 'View Email';
    $submenu	= "Mailbox";
    $plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    }
} else{
    header("location: ".URL_CSO."logout.php");
}