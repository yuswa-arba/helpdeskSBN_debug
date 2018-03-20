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
    
if(isset($_GET["id"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_invoice 	= "SELECT `cc_invoice`.* , `cc_card`.`firstname`, `cc_card`.`lastname`, `cc_card`.`username`,
			`cc_card`.`useralias`
			FROM `cc_invoice`, `cc_card`
			WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
			AND `cc_invoice`.`id` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn_voip);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
    //invoice total
    $query_invoice_item	= "SELECT SUM(`price`) as `total_price`, SUM(`VAT`) as `total_vat`
    FROM `cc_invoice_item` WHERE `id_invoice` ='".$id_invoice."';";
    $sql_invoice_item	= mysql_query($query_invoice_item, $conn_voip);
    $row_invoice_item = mysql_fetch_array($sql_invoice_item);
    
    //payment total
    $query_payment	= "SELECT SUM(`payment`) as `total`
    FROM `cc_logpayment`, `cc_invoice_payment`
    WHERE `cc_logpayment`.`id` = `cc_invoice_payment`.`id_payment`
    AND `cc_invoice_payment`.`id_invoice` ='".$id_invoice."';";
    $sql_payment	= mysql_query($query_payment, $conn_voip);
    $row_payment	= mysql_fetch_array($sql_payment);
    
    
}

if(isset($_GET["id"]) & isset($_GET["delpayment"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $delpayment		= isset($_GET['delpayment']) ? (int)$_GET['delpayment'] : '';
    
    if(($id_invoice != NULL) AND ($delpayment != NULL)){
	$sql_delpayment = "DELETE FROM `mya2billing`.`cc_invoice_payment` WHERE (`id_invoice`='".$id_invoice."') AND (`id_payment`='".$delpayment."');";
	
	$sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
	`description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '3', 'A INVOICE PAYMENT DELETED', 'A RECORD IS DELETED, EDITION CALUSE USED IS  id_invoice=".$id_invoice." AND id_payment=".$delpayment."',
	'".mysql_real_escape_string($sql_delpayment)." | Web Software GX (".$loggedin["username"].")',
	'cc_invoice_payment', 'manage_payment.php',
	'".getenv("REMOTE_ADDR")."', NOW(), '0');";
	
	//echo $sql_update;
	mysql_query($sql_delpayment, $conn_voip) or die (mysql_error());
	mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_delpayment);
    }
    header("location: manage_payment.php?id=$id_invoice");

}

if(isset($_GET["id"]) & isset($_GET["addpayment"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $addpayment		= isset($_GET['addpayment']) ? (int)$_GET['addpayment'] : '';
    
    if(($id_invoice != NULL) AND ($addpayment != NULL)){
	$sql_addpayment = "INSERT INTO `mya2billing`.`cc_invoice_payment` (`id_invoice`, `id_payment`)
	VALUES ('".$id_invoice."', '".$addpayment."');";
	
	$sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
	`data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '2', 'NEW INVOICE PAYMENT CREATED', 'User added a new record in database',
	'id_invoice = ".$id_invoice."| id_payment =  ".$addpayment."| Web Software GX (".$loggedin["username"].")',
	'cc_invoice_payment', 'manage_payment.php', '".getenv("REMOTE_ADDR")."', NOW(), '0');";
	
	//echo $sql_update;
	mysql_query($sql_addpayment, $conn_voip) or die (mysql_error());
	mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_addpayment);
    }
    header("location: manage_payment.php?id=$id_invoice");

}

if(isset($_GET["id"]) & isset($_GET["status"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $status		= isset($_GET['status']) ? (int)$_GET['status'] : '';
    
    if(($id_invoice != NULL) AND ($status != NULL)){
	$sql_update = "UPDATE `mya2billing`.`cc_invoice` SET `paid_status`='".$status."' WHERE (`id`='".$id_invoice."');";
    
	$sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
	`description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
	VALUES (NULL, '1', '3', 'A PAYMENT STATUS UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=".$id_invoice."',
	'".mysql_real_escape_string($sql_update)." | Web Software GX (".$loggedin["username"].")',
	'cc_invoice_payment', 'manage_payment.php',
	'".getenv("REMOTE_ADDR")."', NOW(), '0');";
	
	//echo $sql_update;
	echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
	echo mysql_query($sql_update_log, $conn_voip) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
    }
    header("location: manage_payment.php?id=$id_invoice");
    
}
    

//MM_openBrWindow('A2B_invoice_view.php?popup_select=1&amp;id=42','','scrollbars=yes,resizable=yes,width=700,height=500')

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        
                                        <table style="width:100%;">
					<tbody>
					    <tr class="form_invoice_head">
						<td width="75%">INVOICE: <b>'.(isset($_GET['id']) ? $row_invoice["title"] : '').'</b></font></td>
						<td width="25%">REF: <font color="#EE6564"> '.(isset($_GET['id']) ? $row_invoice["reference"] : '').'</font></td>
					    </tr>
					    <tr>
						<td colspan="2" align="right">
							<a href="javascript:;" onclick="">
							Generate PDF</a>
						</td>
					    </tr>
					    <tr>
						<td colspan="2">TOTAL INVOICE EXCLUDE VAT&nbsp;:&nbsp;'.number_format($row_invoice_item["total_price"], 2, ',','.').' IDR</td>
					    </tr>
					    <tr>
						<td colspan="2">TOTAL VAT (0%)&nbsp;:&nbsp;'.number_format($row_invoice_item["total_vat"], 2, ',','.').' IDR</td>
					    </tr><tr>
					    <td colspan="2">TOTAL INVOICE INCLUDE VAT&nbsp;:&nbsp;'.number_format(($row_invoice_item["total_price"] + $row_invoice_item["total_vat"]), 2, ',','.').' IDR</td>
					    </tr>
					    <tr>
						<td colspan="2">TOTAL OF PAYMENTS ASSIGNED&nbsp;:&nbsp;'.number_format($row_payment["total"], 2, ',','.').' IDR</td>
					    </tr>
					    <tr>
						<td align="center" colspan="2">
						    <br>
						    <table>
							<tbody><tr>
							    <td align="center">PAYMENTS ASSIGNED</td>
							</tr>
							<tr>
							    <td><select id="payment" name="payment" size="5" style="width:250px;" class="form_input_select">';
							    
							    $query_payment_item	= "SELECT `cc_logpayment`.`id`, `cc_logpayment`.`date`, `cc_logpayment`.`payment`
							    FROM `cc_logpayment`, `cc_invoice_payment`
							    WHERE `cc_logpayment`.`id` = `cc_invoice_payment`.`id_payment`
							    AND `cc_invoice_payment`.`id_invoice` ='".$id_invoice."';";
							    $sql_payment_item	= mysql_query($query_payment_item, $conn_voip);
							    while($row_payment_item	= mysql_fetch_array($sql_payment_item))
							    {
								$content .='<option value="'.$row_payment_item["id"].'">'.date("d-m-Y", strtotime($row_payment_item["date"])).'&nbsp;:&nbsp;'.$row_payment_item["payment"].' IDR&nbsp;&nbsp;(id : '.$row_payment_item["id"].') </option>';
							    }
							    
							    $content .='
								
							    </select>
							    </td>
							</tr>
							<tr>
							    <td align="center">
								<a href="javascript:;" onclick="addpayment()"> Add Payment</a> |
								<a href="javascript:;" onclick="delpayment()"> Del Payment</a>
							    </td>
							</tr>
						    </tbody></table>
						</td>
					    </tr>
					    <tr>
						    <td colspan="2">
						    <br>
								     <font style="font-weight:bold;">PAID STATUS : </font> '.(($row_invoice["paid_status"] == "1") ? '<span class="label label-success">Paid</span>' : '<span class="label label-danger">Unpaid</span>').'
						     &nbsp;&nbsp;<input class="form_input_button" type="button" onclick="changeStatus();" value="CHANGE STATUS">
						    </td>
					    </tr>
					</tbody></table>						    
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script language="javascript">
<!-- Begin
var win= null;
function addpayment(selvalue){
	//test si win est encore ouvert et close ou refresh
    return valideopenerform(\'payment_invoice.php?popup_select=1&invoice='.$row_invoice["id"].'&card='.$row_invoice["id_card"].'\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=500\');
}
function delpayment(){
	//test si val is not null & numeric
	if($(\'#payment\').val()!=null){
		self.location.href= "manage_payment.php?id='.$row_invoice["id"].'&delpayment="+$(\'#payment\').val();
	}
}

function changeStatus(){
	'.(($row_invoice["paid_status"] == "1") ? 'self.location.href= "manage_payment.php?id='.$row_invoice["id"].'&status=0";' : 'self.location.href= "manage_payment.php?id='.$row_invoice["id"].'&status=1";').'
	
}
// End -->

</script>';

    $title	= 'Form Manage Payment';
    $submenu	= "manage_payment";
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