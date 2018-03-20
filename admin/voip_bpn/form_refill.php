<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"],"Open Form Log Refill");

    global $conn_voip;
       
if(isset($_POST["save"]))
{
    $id_cc_card      	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $date		= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $credit		= isset($_POST['credit']) ? mysql_real_escape_string(trim($_POST['credit'])) : '';
    $refill_type	= isset($_POST['refill_type']) ? mysql_real_escape_string(trim($_POST['refill_type'])) : '';
    $description	= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $added_invoice	= isset($_POST['added_invoice']) ? mysql_real_escape_string(trim($_POST['added_invoice'])) : '';
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_logrefill` (`id`, `date`, `credit`, `card_id`, `description`,
    `refill_type`, `added_invoice`, `agent_id`)
    VALUES (NULL, '".$date."', '".$credit."', '".$id_cc_card."', '".$description."', '".$refill_type."', '".$added_invoice."', NULL);";
    
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW REFILL CREATED', 'User added a new record in database',
    'date =  ".$date."| credit =  ".$credit."| description =  ".$description."| card_id =  ".$id_cc_card."| refill_type =  ".$refill_type."|  added_invoice =  ".$added_invoice."| Web Software GX (".$loggedin["username"].")',
    'cc_logrefill', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    if($added_invoice == 1)
    {
	$sql_invoice = mysql_query("SELECT COUNT(*) as `total` FROM `cc_invoice` WHERE `date` LIKE '%".date("Y")."-%';", $conn_voip);
	$row_invoice = mysql_fetch_array($sql_invoice);
	
	$total = $row_invoice["total"] + 1;
	$reference = date("Ymd").sprintf("%04d", $total);

	//insert into cc_invoice
	$sql_insert_invoice = "INSERT INTO `mya2billing`.`cc_invoice` (`id`, `reference`, `id_card`, `date`, `paid_status`,
	`status`, `title`, `description`)
	VALUES (NULL, '".$reference."', '".$id_cc_card."', '".$date."', '0', '0', 'REFILL', 'Invoice for refill');";
	
	$sql_insert_log_invoice = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
	'reference =  ".$reference."| id_card =  ".$id_cc_card."| date =  ".$date."| paid_status =  0| status =  0|  title =  REFILL| description = Invoice for refill| Web Software GX (".$loggedin["username"].")',
	'cc_invoice', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	//echo $insert."<br>";
    
	mysql_query($sql_insert_invoice, $conn_voip) or die (mysql_error());
	mysql_query($sql_insert_log_invoice, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log_invoice);
	
	//insert invoice item
	$sql_invoice_last = mysql_query("SELECT * FROM `cc_invoice` WHERE `reference` LIKE '%".$reference."%';", $conn_voip);
	$row_invoice_last = mysql_fetch_array($sql_invoice_last);
	
	$id_invoice_last = $row_invoice_last["id"];

	//insert into cc_invoice_item
	$sql_insert_invoice_item = "INSERT INTO `mya2billing`.`cc_invoice_item` (`id`, `id_invoice`, `date`,
	`price`, `VAT`, `description`, `id_ext`, `type_ext`)
	VALUES (NULL, '".$id_invoice_last."', '".$date."', '".$credit."', '0', 'Refill', NULL, NULL);";
	
	$sql_insert_log_invoice_item = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
	'id_invoice =  ".$id_invoice_last."| price =  ".$credit."| date =  ".$date."| vat =  0| description =  Refill| Web Software GX (".$loggedin["username"].")',
	'cc_invoice_item', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	//echo $insert."<br>";
    
	mysql_query($sql_insert_invoice_item, $conn_voip) or die (mysql_error());
	mysql_query($sql_insert_log_invoice_item, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log_invoice_item);
    }
    
    //add customer credit
    //Update cc_card mya2billing
	$sql_card	= mysql_query("SELECT `credit`, `id` FROM `cc_card` WHERE `id` = '".$id_cc_card."' LIMIT 0,1;",$conn_voip);
	$row_card	= mysql_fetch_array($sql_card);
	$total_credit	= $row_card["credit"] + $credit;
	
	$sql_update_card = "UPDATE `cc_card` SET `credit` = '".$total_credit."'  WHERE `cc_card`.`id` = '".$id_cc_card."'";
	mysql_query($sql_update_card, $conn_voip) or die ("Data error");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "$sql_update_card");
	
	
	$sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
	`description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '3', 'A CREDIT UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id_cc_card." ',
	'id = ".$id_cc_card." |credit=".$credit." |Web Software GX (".$loggedin["username"].")',
	'cc_card', 'form_refill.php',
	'".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/log_refill.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_cc_card      	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $date		= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $credit		= isset($_POST['credit']) ? mysql_real_escape_string(trim($_POST['credit'])) : '';
    $refill_type	= isset($_POST['refill_type']) ? mysql_real_escape_string(trim($_POST['refill_type'])) : '';
    $description	= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $added_invoice	= isset($_POST['added_invoice']) ? mysql_real_escape_string(trim($_POST['added_invoice'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_logrefill` SET `date`='".$date."', `credit`='".$credit."',
    `card_id`='".$id_cc_card."', `description`='".$description."', `refill_type`='".$refill_type."',
    `added_invoice`='".$added_invoice."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A REFILL UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'card_id = ".$id_cc_card." |date = ".$date." | credit=".$credit." | refill_type =  ".$refill_type."| description =  ".$description." | added_invoice =  ".$added_invoice." |Web Software GX (".$loggedin["username"].")',
    'cc_logrefill', 'form_refill.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

    
   /* if($added_invoice == 1)
    {
	$sql_invoice = mysql_query("SELECT COUNT(*) as `total` FROM `cc_invoice` WHERE `date` LIKE '%".date("Y")."-%';", $conn_voip);
	$row_invoice = mysql_fetch_array($sql_invoice);
	
	$total = $row_invoice["total"] + 1;
	$reference = date("Y").sprintf("%08d", $total);

	//insert into cc_invoice
	$sql_insert_invoice = "INSERT INTO `mya2billing`.`cc_invoice` (`id`, `reference`, `id_card`, `date`, `paid_status`,
	`status`, `title`, `description`)
	VALUES (NULL, '".$reference."', '".$id_cc_card."', '".$date."', '0', '0', 'REFILL', 'Invoice for refill');";
	
	$sql_insert_log_invoice = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
	'reference =  ".$reference."| id_card =  ".$id_cc_card."| date =  ".$date."| paid_status =  ".$paid_status."| status =  ".$status."|  title =  REFILL| description = Invoice for refill| Web Software GX (".$loggedin["username"].")',
	'cc_invoice', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	//echo $insert."<br>";
    
	echo mysql_query($sql_insert_log_invoice, $conn_voip) or die (mysql_error());
	echo mysql_query($sql_insert_log_invoice, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log_invoice);
	
	//insert invoice item
	$sql_invoice_last = mysql_query("SELECT * FROM `cc_invoice` WHERE `refill` LIKE '%".$reference."%';", $conn_voip);
	$row_invoice_last = mysql_fetch_array($sql_invoice_last);
	
	$id_invoice_last = $row_invoice_last["id"];

	//insert into cc_invoice_item
	$sql_insert_invoice_item = "INSERT INTO `mya2billing`.`cc_invoice_item` (`id`, `id_invoice`, `date`,
	`price`, `VAT`, `description`, `id_ext`, `type_ext`)
	VALUES (NULL, '".$id_invoice_last."', '".$date."', '".$credit."', '0', 'Refill', NULL, NULL);";
	
	$sql_insert_log_invoice_item = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
	'id_invoice =  ".$id_invoice_last."| price =  ".$credit."| date =  ".$date."| vat =  0| description =  Refill| Web Software GX (".$loggedin["username"].")',
	'cc_invoice_item', 'form_refill.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	//echo $insert."<br>";
    
	echo mysql_query($sql_insert_log_invoice_item, $conn_voip) or die (mysql_error());
	echo mysql_query($sql_insert_log_invoice_item, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log_invoice_item);
    }
    
   */
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/log_refill.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_refill	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_refill 	= "SELECT * FROM `cc_logrefill` WHERE `id`='".$id_refill."' LIMIT 0,1;";
    $sql_refill		= mysql_query($query_refill, $conn_voip);
    $row_refill		= mysql_fetch_array($sql_refill);

}
    
    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Refill</h3>
                                </div><!-- /.box-header -->
                                <form action="" role="form" name="form_refill" id="form_refill" method="post" enctype="multipart/form-data">
				    
				<div class="box-body">
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-4">
					    <label>ID CUSTOMER</label>
					</div>
					<div class="col-xs-4">
					    <input type="text" class="form-control" required="" readonly="" name="id_cc_card" id="id_cc_card" value="'.(isset($_GET['id']) ? $row_refill["card_id"] : '').'">
					    <input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_refill["id"] : '').'" readonly="">
					    
					</div>
					<div class="col-xs-4">
					    
					    <a href="'.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_refill" class="btn bg-olive btn-flat margin pull-right" onclick="return valideopenerform(\''.URL_ADMIN.'voip_bpn/data_subscription.php?r=form_refill\',\'refill\');">Select</a>
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-4">
					    <label>Date</label>
					</div>
					<div class="col-xs-4">
					    <input type="text" class="form-control" required="" readonly="" name="date" id="date" value="'.(isset($_GET['id']) ? $row_refill["date"] : date("Y-m-d H:i:s")).'">
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-4">
					    <label>Amount</label>
					</div>
					<div class="col-xs-4">
					    <input type="text" class="form-control" required="" name="credit" id="credit" value="'.(isset($_GET['id']) ? $row_refill["credit"] : '0').'">
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-4">
					    <label>Description</label>
					</div>
					<div class="col-xs-4">
					    <textarea name="description" cols="50" rows="4" style="resize:none;">'.(isset($_GET['id']) ? $row_refill["description"] : '').'</textarea>
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-4">
					    <label>Refill Type</label>
					</div>
					<div class="col-xs-4">
					    <select name="refill_type">
						<option value="0"'.((isset($_GET['id']) AND $row_refill["refill_type"] == "0" ) ? 'selected=""' : '').'>AMOUNT</option>
						<option value="1"'.((isset($_GET['id']) AND $row_refill["refill_type"] == "1" ) ? 'selected=""' : '').'>CORRECTION</option>
						<option value="2"'.((isset($_GET['id']) AND $row_refill["refill_type"] == "2" ) ? 'selected=""' : '').'>EXTRA FEE</option>
						<option value="3"'.((isset($_GET['id']) AND $row_refill["refill_type"] == "3" ) ? 'selected=""' : '').'>AGENT REFUND</option>
					    </select>
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-4">
					    <label>CREATE ASSOCIATE INVOICE</label>
					</div>
					<div class="col-xs-4">
					    Yes  <input type="radio" name="added_invoice" value="1"'.((isset($_GET['id']) AND $row_refill["added_invoice"] == "1" ) ? 'checked=""' : '').'> -
					    No <input type="radio" name="added_invoice" value="0"'.((isset($_GET['id']) AND $row_refill["added_invoice"] == "0" ) ? 'checked=""' : '').'>
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

                </section><!-- /.content -->';	  				

$plugins = '';

    $title	= 'Form Refill';
    $submenu	= "refill";
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