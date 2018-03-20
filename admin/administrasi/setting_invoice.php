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
    if($loggedin["group"] == 'admin')
    {
	
        global $conn;
if(isset($_POST["update"]))
{
    
    $id_invoice_config	= isset($_POST['id_invoice_config']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_invoice_config']))) : "";
    $title		= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
    $call_center	= isset($_POST['call_center']) ? mysql_real_escape_string(strip_tags(trim($_POST['call_center']))) : "";
    $sms_gtw		= isset($_POST['sms_gtw']) ? mysql_real_escape_string(strip_tags(trim($_POST['sms_gtw']))) : "";
    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
    $instant_payment	= isset($_POST['instant_payment']) ? mysql_real_escape_string(strip_tags(trim($_POST['instant_payment']))) : "";
    $lain		= isset($_POST['lain']) ? mysql_real_escape_string(strip_tags(trim($_POST['lain']))) : "";
    $website		= isset($_POST['website']) ? mysql_real_escape_string(strip_tags(trim($_POST['website']))) : "";
    
    if(($id_invoice_config != ""))
    {
	$update_data   	= "UPDATE `gx_invoice_config` SET `title`='".$title."',
	`call_center`='".$call_center."', `sms_gtw`='".$sms_gtw."', `email`='".$email."',
	`instant_payment`='".$instant_payment."', `lain`='".$lain."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_invoice_config`='".$id_invoice_config."';";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'setting_invoice.php';
    </script>";
}


    $sql_data	= "SELECT * FROM `gx_invoice_config` WHERE `id_invoice_config` = '1';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form supplier id=1");
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Setting Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_supplier"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Title</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text"  class="form-control" required="" name="title" value="'.$row_data['title'].'">
						<input type="hidden" name="id_invoice_config" value="'.$row_data['id_invoice_config'].'">
						
					    </div>
					    
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Call Center</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="call_center" value="'.$row_data['call_center'].'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>SMS Gateway</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="sms_gtw" value="'.$row_data['sms_gtw'].'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Email</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="email" value="'.$row_data['email'].'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Instant Payment</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="instant_payment" value="'.$row_data['instant_payment'].'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lain-lain</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="lain" value="'.$row_data['lain'].'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Created By:</label>
					    </div>
					    <div class="col-xs-8">
						'.$row_data['user_add'].'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>last Updated By:</label>
					    </div>
					    <div class="col-xs-8">
						'. $row_data['user_upd'].' ( '.$row_data['date_upd'].' )
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="update" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Setting Invoice';
    $submenu	= "setting_invoice";
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