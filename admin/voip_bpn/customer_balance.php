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
if($loggedin["group"] == 'admin'){
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Customer Voip");
    global $conn;
    global $conn_voip;
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				<div class="box-header">
				    <h3 class="box-title">Customer Balance</h3>
                                </div>

                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 110px">Card Number</th>
                                                <th style="width: 75px">Alias</th>
                                                <th>Name</th>
                                                
                                                <th>Credit</th>
						
						<th>Invoice</th>
						<th>Payment</th>
						<th>To Pay</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					


    $sql_masterCustomer = mysql_query("SELECT * FROM `cc_card` ORDER BY `id` ASC ;",$conn_voip);



$no = 1;
while ($row_masterCustomer = mysql_fetch_array($sql_masterCustomer))
{
    $sql_getgroup = mysql_query("SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."';",$conn_voip);
    $row_getgroup = mysql_fetch_array($sql_getgroup);
    $sql_gettariffplan = mysql_query("SELECT * FROM `cc_tariffgroup` WHERE `id` = '".$row_masterCustomer["tariff"]."';",$conn_voip);
    $row_gettariffplan = mysql_fetch_array($sql_gettariffplan);
    $status	= '';
    $status 	.= ($row_masterCustomer["status"] == "0") ? "CANCEL" : "";
    $status	.= ($row_masterCustomer["status"] == "1") ? "ACTIVATED" : "";
    $status	.= ($row_masterCustomer["status"] == "2") ? "NEW" : "";
    $status	.= ($row_masterCustomer["status"] == "3") ? "WAITING" : "";
    $status	.= ($row_masterCustomer["status"] == "4") ? "RESERV" : "";
    $status	.= ($row_masterCustomer["status"] == "5") ? "EXPIRED" : "";
    $status	.= ($row_masterCustomer["status"] == "6") ? "SUS-PAY" : "";
    $status	.= ($row_masterCustomer["status"] == "7") ? "SUS-LIT" : "";
    $status	.= ($row_masterCustomer["status"] == "8") ? "WAIT-PAY" : "";
    //echo "SELECT * FROM `cc_card_group` WHERE `id` = '".$row_masterCustomer["id_group"]."'";
    
    $sql_invoice = mysql_query("SELECT SUM(`price`) as `total`, SUM(`VAT`) as `total_vat`
			       FROM `cc_invoice_item`, `cc_invoice`
			       WHERE `cc_invoice_item`.`id_invoice` = `cc_invoice`.`id`
			       AND `cc_invoice`.`id_card` = '".$row_masterCustomer["id"]."';", $conn_voip);
    $row_invoice = mysql_fetch_array($sql_invoice);
    
    $sql_payment = mysql_query("SELECT SUM(`payment`) as `payment` FROM `cc_logpayment`
				  WHERE `cc_logpayment`.`card_id` = '".$row_masterCustomer["id"]."';", $conn_voip);
    $row_payment = mysql_fetch_array($sql_payment);
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterCustomer["username"].'</td>
		    <td>'.$row_masterCustomer["useralias"].'</td>
		    <td>'.$row_masterCustomer["firstname"].' '.$row_masterCustomer["lastname"].'</td>
		    <td>'.number_format($row_masterCustomer["credit"], 2, ',', '.').' IDR</td>
		    
		    <td>'.number_format($row_invoice["total"], 2, ',', '.').'</td>
		    <td>'.number_format($row_payment["payment"], 2, ',', '.').'</td>
		    <td>'.number_format(($row_payment["payment"] - $row_invoice["total"]), 2, ',', '.').'</td>
		    
		    <td align="center"></td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
	
    ';

    $title	= 'Customers Balance';
    $submenu	= "customer_balance";
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