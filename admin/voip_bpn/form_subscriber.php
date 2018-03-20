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
    $id_cc_card      		= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $id_subscription_fee	= isset($_POST['id_subscription_fee']) ? mysql_real_escape_string(trim($_POST['id_subscription_fee'])) : '';
    $startdate		= isset($_POST['startdate']) ? mysql_real_escape_string(trim($_POST['startdate'])) : '';
    $stopdate		= isset($_POST['stopdate']) ? mysql_real_escape_string(trim($_POST['stopdate'])) : '';
    $product_name	= isset($_POST['product_name']) ? mysql_real_escape_string(trim($_POST['product_name'])) : '';
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_card_subscription` (`id`, `id_cc_card`, `id_subscription_fee`,
    `startdate`, `stopdate`, `product_id`, `product_name`, `paid_status`, `last_run`, `next_billing_date`, `limit_pay_date`)
    VALUES (NULL, '".$id_cc_card."', '".$id_subscription_fee."', '".$startdate."', '".$stopdate."', NULL, '".$product_name."',
    '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');";
    
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW SUBSCRIBER CREATED', 'User added a new record in database', 'id_subscription_fee =  ".$id_subscription_fee."| startdate =  ".$startdate."| stopdate =  ".$stopdate."| product_name =  ".$product_name."| Web Software GX (".$loggedin["username"].")',
    'cc_card_subscription', 'form_subscriber.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    echo mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/subscriber.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_cc_card      		= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $id_subscription_fee	= isset($_POST['id_subscription_fee']) ? mysql_real_escape_string(trim($_POST['id_subscription_fee'])) : '';
    $startdate		= isset($_POST['startdate']) ? mysql_real_escape_string(trim($_POST['startdate'])) : '';
    $stopdate		= isset($_POST['stopdate']) ? mysql_real_escape_string(trim($_POST['stopdate'])) : '';
    $product_name	= isset($_POST['product_name']) ? mysql_real_escape_string(trim($_POST['product_name'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_card_subscription` SET `id_cc_card`='".$id_cc_card."',
    `id_subscription_fee`='".$id_subscription_fee."', `product_name`='".$product_name."',
    `startdate`='".$startdate."', `stopdate`='".$stopdate."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A SUBSCRIBER UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'id_cc_card = ".$id_cc_card." |id_subscription_fee = ".$id_subscription_fee." | product_name=".$product_name." | startdate =  ".$startdate."| stopdate =  ".$stopdate." | Web Software GX (".$loggedin["username"].")',
    'cc_card_subscription', 'form_subscriber.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/subscriber.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_card_subscription	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_card_subscription 	= "SELECT * FROM `cc_card_subscription` WHERE `id` ='".$id_card_subscription."' LIMIT 0,1;";
    $sql_card_subscription	= mysql_query($query_card_subscription, $conn_voip);
    $row_card_subscription	= mysql_fetch_array($sql_card_subscription);

}

    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Subscriber</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_subscriber" id="form_subscriber" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ACCOUNT ID</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" readonly="" name="id_cc_card" id="id_cc_card" value="'.(isset($_GET['id']) ? $row_card_subscription["id_cc_card"] : '').'">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_card_subscription["id"] : '').'" readonly="">
						
					    </div>
					    <div class="col-xs-4">
						
						<a href="'.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_subscriber" class="btn bg-olive btn-flat margin pull-right" onclick="return valideopenerform(\''.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_subscriber\',\'subscription\');">Select</a>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ID SUBSCRIPTION SERVICE</label>
					    </div>
					    <div class="col-xs-8">
						<select name="id_subscription_fee" class="form-control">
						    <option value="-1" '.(isset($_GET['id']) ? '' : 'selected=""').'>NOT DEFINED</option>';

$sql_subscription = mysql_query("SELECT * FROM `cc_subscription_service`", $conn_voip);
//echo $row_card_subscription["id_subscription_fee"];

while($row_subscription = mysql_fetch_array($sql_subscription))
{
    $content .='<option value="'.$row_subscription["id"].'" '.((isset($_GET['id']) AND $row_card_subscription["id_subscription_fee"] == $row_subscription["id"]) ? 'selected=""' : "").'>'.$row_subscription["label"].'</option>';
}

$content .='						</select>
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Start Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="startdate" value="'.(isset($_GET['id']) ? $row_card_subscription["startdate"] : date("Y-m-d H:i:s")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Start Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="stopdate" value="'.(isset($_GET['id']) ? $row_card_subscription["stopdate"] : date("Y", strtotime('+13 years')) ."-01-01 00:00:00").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Product Label</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="product_name" value="'.(isset($_GET['id']) ? $row_card_subscription["product_name"] : "").'">
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