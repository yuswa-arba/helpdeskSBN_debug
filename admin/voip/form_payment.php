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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $id_cc_card	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $payment	= isset($_POST['payment']) ? mysql_real_escape_string(trim($_POST['payment'])) : '';
    $payment_type	= isset($_POST['payment_type']) ? mysql_real_escape_string(trim($_POST['payment_type'])) : '';
    $description= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    
    
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `mya2billing`.`cc_logpayment` (`id`, `date`, `payment`, `card_id`,
    `id_logrefill`, `description`, `added_refill`, `payment_type`, `added_commission`, `agent_id`)
    VALUES (NULL, '".$date."', '".$payment."', '".$id_cc_card."',
    NULL, '".$description."', '0', '".$payment_type."', '0', NULL);";
    
   
    $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '2', 'NEW PAYMENT CREATED', 'User added a new record in database',
    'card_id = ".$id_cc_card."| date =  ".$date."| payment =  ".$payment."| description =  ".$description."| added_refill =  0| added_commission =  0| payment_type =  ".$payment_type."| Web Software GX (".$loggedin["username"].")',
    'cc_logpayment', 'form_payment.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    //echo $insert."<br>";

    mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip/payment.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_cc_card	= isset($_POST['id_cc_card']) ? mysql_real_escape_string(trim($_POST['id_cc_card'])) : '';
    $date	= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
    $payment	= isset($_POST['payment']) ? mysql_real_escape_string(trim($_POST['payment'])) : '';
    $payment_type	= isset($_POST['payment_type']) ? mysql_real_escape_string(trim($_POST['payment_type'])) : '';
    $description= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `mya2billing`.`cc_logpayment` SET `date`='".$date."', `payment`='".$payment."',
    `card_id`='".$id_cc_card."', `description`='".$description."', `payment_type`='".$payment_type."'
    WHERE (`id`='".$id."');";
    
    $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
    `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
    VALUES (NULL, '1', '3', 'A PAYMENT UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id." ',
    'card_id = ".$id_cc_card."| date =  ".$date."| payment =  ".$payment."| description =  ".$description."| added_refill =  0| added_commission =  0| payment_type =  ".$payment_type."| Web Software GX (".$loggedin["username"].")',
    'cc_logpayment', 'form_payment.php',
    '".getenv("REMOTE_ADDR")."', NOW(), '0');";
    
    //echo $sql_update;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip/payment.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_payment	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_payment 	= "SELECT * FROM `cc_logpayment` WHERE `id` ='".$id_payment."' LIMIT 0,1;";
    $sql_payment	= mysql_query($query_payment, $conn_voip);
    $row_payment	= mysql_fetch_array($sql_payment);

}

    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Payment</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_payment" id="form_payment" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>ID Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" required="" name="id_cc_card" id="id_cc_card" value="'.(isset($_GET['id']) ? $row_payment["card_id"] : '').'">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_payment["id"] : '').'" readonly="">
						
						
					    </div>
					    <div class="col-xs-4">
						
						<a href="'.URL_ADMIN.'voip/data_subscription.php?r=form_payment" class="btn bg-olive btn-flat margin pull-right" onclick="return valideopenerform(\''.URL_ADMIN.'voip/data_subscription.php?r=form_payment\',\'payment\');">Select</a>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Payment Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="date" id="date" value="'.(isset($_GET['id']) ? $row_payment["date"] : date("Y-m-d H:i:s")).'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Payment Amount</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required=""  name="payment" value="'.(isset($_GET['id']) ? $row_payment["payment"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Description</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="description" style="resize:none;">'.(isset($_GET['id']) ? $row_payment["description"] : "").'</textarea>
					    </div>
					    
                                        </div>
					</div>
					<!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Payment Amount</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required=""  name="payment" value="'.(isset($_GET['id']) ? $row_payment["payment"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Payment Amount</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required=""  name="payment" value="'.(isset($_GET['id']) ? $row_payment["payment"] : "").'">
					    </div>
					    
                                        </div>
					</div>-->
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Payment Type</label>
					    </div>
					    <div class="col-xs-8">
						<select name="payment_type" class="form-control">
						    <option value="0" '.((isset($_GET['id']) AND $row_payment["payment"] == "0") ? 'selected=""' : "").'> AMOUNT</option>
						    <option value="1" '.((isset($_GET['id']) AND $row_payment["payment"] == "1") ? 'selected=""' : "").'> CORRECTION</option>
						    <option value="2" '.((isset($_GET['id']) AND $row_payment["payment"] == "2") ? 'selected=""' : "").'> EXTRA FEE</option>
						    <option value="3" '.((isset($_GET['id']) AND $row_payment["payment"] == "3") ? 'selected=""' : "").'> AGENT REFUND</option>
						</select>
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

    $title	= 'Form Payment';
    $submenu	= "voip_payment";
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