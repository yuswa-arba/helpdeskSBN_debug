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
    global $conn_voip;
    
    
 //echo date("Y-m-d H:i:s");
    $id_mailbox	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    
    $sql_email = mysql_query("SELECT `ID`, `EmailFrom`, `EmailFromP`, `EmailTo`, `DateE`, `DateDb`, `DateRead`, `DateRe`, `Subject`, `Message`, `Message_html`,`id_kategori`, `customer_number`, `userid`, `id_complaint`
			 FROM `gx_email`
			 WHERE `ID` = '".$id_mailbox."'
			 LIMIT 0,1;",$conn);

    $email = mysql_fetch_array($sql_email);
    
    $sql_customer = mysql_query("SELECT * FROM `tbCustomer`
			 WHERE `cKode` = '$email[customer_number]'
			 LIMIT 0,1;",$conn);
    $dcustomer = mysql_fetch_array($sql_customer);
    
    
    
    $sql_parent = mysql_query("SELECT * FROM `gx_email_kategori` ORDER BY `id_kategori` DESC;",$conn);
    $content ='<section class="content-header">
                    <h1>
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
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">Detail Mail</h2>
                                </div>
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                </div><!-- /.box-header -->
        
          <table id="LBL_PROJECT_INFORMATION" class="form" cellspacing="0" style="margin-bottom: 0;">
	    <tbody>
	    <tr>
		<td width="12.5%" scope="col">
		    Name:
		</td>
		<td width="37.5%">
		    <span class="sugar_field" id="name">'.$email["EmailFromP"].'</span>
		</td>
		
	    </tr>
	    <tr>
		<td width="12.5%" scope="col">
		    Email:
		</td>
		<td width="37.5%">
		    '.$email["EmailFrom"].'
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
	    <tr valign="top">
		<td width="12.5%" scope="col">
		    Body:
		</td>
		<td width="37.5%" colspan="3">
		    '.(($email["Message_html"] == "" ) ? '<textarea rows="10" readonly="" cols="70" style="resize: none;width:100%;">'.($email["Message"]).'</textarea>' : $email["Message_html"] ).'
		</td>
	    </tr>
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    
	    <tr>
		<td colspan="2">
		    &nbsp;
		</td>
	    </tr>
	    </tbody>
	</table>
	
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

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