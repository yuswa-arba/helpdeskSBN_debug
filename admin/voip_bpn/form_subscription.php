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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $label      = isset($_POST['label']) ? mysql_real_escape_string(trim($_POST['label'])) : '';
    $fee	= isset($_POST['fee']) ? mysql_real_escape_string(trim($_POST['fee'])) : '';
    $status	= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $startdate	= isset($_POST['startdate']) ? mysql_real_escape_string(trim($_POST['startdate'])) : '';
    $stopdate	= isset($_POST['stopdate']) ? mysql_real_escape_string(trim($_POST['stopdate'])) : '';
    $emailreport= isset($_POST['emailreport']) ? mysql_real_escape_string(trim($_POST['emailreport'])) : '';
    
    
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_subscription_service` (`id`, `label`, `fee`, `status`, `numberofrun`,
    `datecreate`, `datelastrun`, `emailreport`, `totalcredit`, `totalcardperform`, `startdate`, `stopdate`)
    VALUES (NULL, '".$label."', '".$fee."', '".$status."', '0', NOW(), '',
    '".$emailreport."', '0', '0', '".$startdate."', '".$stopdate."');";

    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW SUBSCRIPTION SERVICE CREATED', 'User added a new record in database',
    'label = ".$label."| fee =  ".$fee."| status =  ".$status."| startdate =  ".$startdate."| stopdate =  ".$stopdate." | Web Software GX (".$loggedin["username"].")',
    'cc_subscription_service', 'form_subscription.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    echo mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/subscription.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id_subscription']) ? mysql_real_escape_string(trim($_POST['id_subscription'])) : '';
    $label      = isset($_POST['label']) ? mysql_real_escape_string(trim($_POST['label'])) : '';
    $fee	= isset($_POST['fee']) ? mysql_real_escape_string(trim($_POST['fee'])) : '';
    $status	= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $startdate	= isset($_POST['startdate']) ? mysql_real_escape_string(trim($_POST['startdate'])) : '';
    $stopdate	= isset($_POST['stopdate']) ? mysql_real_escape_string(trim($_POST['stopdate'])) : '';
    $emailreport= isset($_POST['emailreport']) ? mysql_real_escape_string(trim($_POST['emailreport'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_subscription_service` SET `label`='".$label."', `fee`='".$fee."',
    `status`='".$status."', `emailreport`='".$emailreport."', `startdate`='".$startdate."', `stopdate`='".$stopdate."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A SUBSCRIPTION SERVICE UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'label = ".$label."| fee =  ".$fee."| status =  ".$status."| startdate =  ".$startdate."| stopdate =  ".$stopdate." | Web Software GX (".$loggedin["username"].")',
    'cc_subscription_service', 'form_subscription.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/subscription.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_subscription		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_subscription 	= "SELECT * FROM `cc_subscription_service` WHERE `id` ='".$id_subscription."' LIMIT 0,1;";
    $sql_subscription		= mysql_query($query_subscription, $conn_voip);
    $row_subscription		= mysql_fetch_array($sql_subscription);

}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Subscription Service</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="label" value="'.(isset($_GET['id']) ? $row_subscription["label"] : '').'">
						<input type="hidden" name="id_subscription" value="'.(isset($_GET['id']) ? $row_subscription["id"] : '').'" readonly="">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Fee</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="fee" value="'.(isset($_GET['id']) ? $row_subscription["fee"] : '').'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						<select name="status" class="form-control">
						    <option value="1" '.((isset($_GET["id"] )&& ($row_subscription["status"] == "1")) ? 'selected=""' : "").'>Active</option>
						    <option value="0" '.((isset($_GET["id"] )&& ($row_subscription["status"] == "0")) ? 'selected=""' : "").'>Inactive</option>
						</select>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Start Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="startdate" value="'.(isset($_GET['id']) ? $row_subscription["startdate"] : date("Y-m-d H:i:s")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Start Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="stopdate" value="'.(isset($_GET['id']) ? $row_subscription["stopdate"] : date("Y", strtotime('+13 years')) ."-01-01 00:00:00").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email to Send Report</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="emailreport" value="'.(isset($_GET['id']) ? $row_subscription["emailreport"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Subscription Service';
    $submenu	= "master_subscription";
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