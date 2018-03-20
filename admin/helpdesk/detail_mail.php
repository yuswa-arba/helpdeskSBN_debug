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
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Mail");
    global $conn;
    
 //echo date("Y-m-d H:i:s");
    $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT `ID`, `EmailFrom`, `EmailFromP`, `EmailTo`, `DateE`, `DateDb`, `DateRead`, `DateRe`, `Subject`, `Message`, `Message_html`,`id_kategori`, `customer_number`, `userid`, `id_complaint`
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    
    $sql_email_reply = mysql_query("SELECT *
			 FROM `gx_email_reply`
			 WHERE `id_email` = '".$id_mailbox."';",$conn);
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` WHERE `id_kategori` = '".$email["id_kategori"]."' LIMIT 0,1;",$conn);
    $content ='<section class="content-header">
                    <h1 class="page-header">
                        Detail Mail
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="detail_mail">Detail Mail</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-solid">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Mail</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="box-group" id="accordion">
                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                        ';
				     while($email_reply = mysql_fetch_array($sql_email_reply)){
				      $content .= '<div class="panel box box-primary">
							      <div class="box-header">
								  <h4 class="box-title">
								      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									  '.$email_reply["subject"].'
								      </a>
								  </h4>
							      </div>
							      <div id="collapseOne" class="panel-collapse collapse">
								  <div class="box-body">
								      <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$email_reply["name"].' ('.$email_reply["email_from"].')</span>
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email_reply["date_add"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Subject:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email_reply["subject"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Body:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email_reply["message"].'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	   
	    <tr>
		<td width="12.5%" scope="col">
		    Attachment:
		</td>
		<td width="37.5%" colspan="3">
		   ';
		   $sql_email_reply_attach = mysql_query("SELECT *
			 FROM `gx_email_attach`
			 WHERE `IDEmail` = '".$email_reply["id_email"]."';",$conn);
		   while($email_reply_attach = mysql_fetch_array($sql_email_reply_attach)){
		    $content .= '<a href="'.str_replace("/var/www/software/", "https://172.16.79.194/software/", $email_reply_attach["Filename"] ).'" target="_blank">
			    '.$email_reply_attach["FileNameOrg"].'</a><br>';
		    
			
		   }
		$content .= '
		</td>
	    </tr>
	    
	    
	    
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    </tbody>
	</table>
								      
								  </div>
							      </div>
							  </div>';
				      
					  
				     }
				  $content .= '
                                        <div class="panel box box-danger">
                                            <div class="box-header">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                        '.$email["Subject"].'
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="box-body">
                                                    <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$email["EmailFromP"].' ('.$email["EmailFrom"].')</span>
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Date:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["DateE"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Subject:
		</td>
		<td width="37.5%" colspan="3">
		    '.$email["Subject"].'
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Body:
		</td>
		<td width="37.5%" colspan="3">
		    '.(($email["Message_html"] != "") ? $email["Message_html"] : nl2br($email["Message"]) ).'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Kategori:
		</td>
		<td width="37.5%" colspan="3">
		   ';
		   $row_parent = mysql_fetch_array($sql_parent);
			
		$content .= ''.$row_parent["nama_kategori"].' 
		</td>
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Attachment:
		</td>
		<td width="37.5%" colspan="3">
		   ';
		   $sql_email_attach = mysql_query("SELECT *
			 FROM `gx_email_attach`
			 WHERE `IDEmail` = '".$id_mailbox."';",$conn);
		   while($email_attach = mysql_fetch_array($sql_email_attach)){
		    $content .= '<a href="'.str_replace("/var/www/software/", "https://172.16.79.194/software/", $email_attach["Filename"] ).'" target="_blank">
			    '.$email_attach["FileNameOrg"].'</a><br>';
		    
			
		   }
		$content .= '
		</td>
	    </tr>
	    
	    
	    
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    </tbody>
	</table>
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

$plugins = '

    
    ';

    $title	= 'Form Mailbox';
    $submenu	= "Mailbox";
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