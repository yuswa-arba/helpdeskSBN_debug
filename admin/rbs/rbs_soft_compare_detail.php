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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Group RBS");
    global $conn;
    
    $userid		= isset($_GET['u']) ? mysql_real_escape_string(strip_tags(trim($_GET['u']))) : "";
    $from_date	= '01-01-2017';
    $to_date	= date("d-m-Y");
    
    $sql_customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` LIKE '%".$userid."%' LIMIT 0,1;", $conn);
	//echo "SELECT * FROM `tbCustomer` WHERE `cUserID` LIKE '%".$userid."%' LIMIT 0,1;";
    $row_customer = mysql_fetch_array($sql_customer);
    

$start = $current = strtotime($from_date);
$end = strtotime($to_date);
$balance = 0;
$credit  = 0;
$debet   = 0;
$html_data	= "";
while ($current <= $end)
{
    $sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
			       WHERE `customer_number` = '".$row_customer["cKode"]."'
				   AND `level` = '0'
			       AND `tanggal_tagihan` = '".date("Y-m-d", $current)."';", $conn);
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_invoice = mysql_fetch_array($sql_invoice)){
	    
	    $balance = ($balance + ($credit - $row_invoice["grandtotal"]));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y", $current).'</td>
		<td>'.$row_invoice["title"].'</td>
		<td>'.$row_invoice["kode_invoice"].'</td>
		<td></td>
		<td>'.number_format($row_invoice["grandtotal"], 0, '.', ',').'</td>
		<td></td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
	
	$sql_bankmasuk = mysql_query("SELECT * FROM `gx_bank_masuk`
			       WHERE `id_customer` = '".$row_customer["cKode"]."'
				   AND `level` = '0'
			       AND `tgl_transaction` = '".date("Y-m-d", $current)."';", $conn);
    
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_bankmasuk = mysql_fetch_array($sql_bankmasuk)){
	    $sql_bank_detail = mysql_query("SELECT SUM(`nominal`) AS `total` FROM `gx_bm_detail`
					      WHERE `id_bankmasuk` = '".$row_bankmasuk["id_bankmasuk"]."';", $conn);
	    $row_bank_detail = mysql_fetch_array($sql_bank_detail);
	    $balance = ($balance + ($row_bank_detail["total"] - $debet));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y", $current).'</td>
		<td>'.$row_bankmasuk["remarks"].'</td>
		<td></td>
		<td>'.$row_bankmasuk["transaction_id"].'</td>
		<td></td>
		<td>'.number_format($row_bank_detail["total"], 0, '.', ',').'</td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
		$sql_kasmasuk = mysql_query("SELECT * FROM `gx_kas_masuk`
			       WHERE `id_customer` = '".$row_customer["cKode"]."'
				   AND `level` = '0'
			       AND `tgl_transaction` = '".date("Y-m-d", $current)."';", $conn);
    
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_kasmasuk = mysql_fetch_array($sql_kasmasuk)){
	    $sql_kas_detail = mysql_query("SELECT SUM(`nominal`) AS `total` FROM `gx_km_detail`
					      WHERE `id_kasmasuk` = '".$row_kasmasuk["id_kasmasuk"]."';", $conn);
	    $row_kas_detail = mysql_fetch_array($sql_kas_detail);
	    $balance = ($balance + ($row_kas_detail["total"] - $debet));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y", $current).'</td>
		<td>'.$row_kasmasuk["remarks"].'</td>
		<td></td>
		<td>'.$row_kasmasuk["transaction_id"].'</td>
		<td></td>
		<td>'.number_format($row_kas_detail["total"], 0, '.', ',').'</td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
	
    $current = strtotime('+1 days', $current);
}


$start_rbs = $current_rbs = strtotime($from_date);
$end_rbs = strtotime($to_date);

$html_data_rbs	= '';
$balance_rbs 	= 0;
$credit_rbs  	= 0;
$debet_rbs   	= 0;

while ($current_rbs <= $end_rbs)
{
	$conn_soft = Config::getInstanceSoft();
	
	$sql_payment_rbs = $conn_soft->prepare("SELECT * FROM dbo.BillingTransactions, dbo.Payments
			WHERE dbo.BillingTransactions.Reference = dbo.Payments.PaymentNumber
			AND dbo.BillingTransactions.TransType = '2'
			AND dbo.BillingTransactions.CreateDate BETWEEN '".date("Y-m-d 00:00:00.000", $current_rbs)."' AND '".date("Y-m-d 23:59:00.000", $current_rbs)."'
			AND dbo.BillingTransactions.UserIndex = '".$row_customer["iuserIndex"]."';");
			
	//echo "SELECT * FROM dbo.BillingTransactions, dbo.Payments
	//		WHERE dbo.BillingTransactions.Reference = dbo.Payments.PaymentNumber
	//		AND dbo.BillingTransactions.TransType = '2'
	//		AND dbo.BillingTransactions.CreateDate LIKE '%".date("Y-m-d", $current_rbs)."%'
	//		AND dbo.BillingTransactions.UserIndex = '".$row_customer["iuserIndex"]."';";
	
	$sql_payment_rbs->execute();
	
	$no = 1;
	while ($row_payment_rbs = $sql_payment_rbs->fetch())
	{
		$balance_rbs = ($balance_rbs + ($row_payment_rbs["Amount"] - $debet_rbs));
		$html_data_rbs .='<tr align="left">
		<td>'.$row_payment_rbs["BillingTransactionIndex"].'</td>
			<td>'.date("d F Y", strtotime($row_payment_rbs["CreateDate"])).'</td>
			
			<td>'.$row_payment_rbs["Remark"].'</td>
			<td>'.$row_payment_rbs["Reference"].'</td>
			<td></td>
			<td></td>
			<td>'.$row_payment_rbs["Amount"].'</td>
			
			<td>'.number_format($balance_rbs, 0, '.', ',').'</td>
			</tr>';
	}
	
	$sql_invoice_rbs = $conn_soft->prepare("SELECT * FROM dbo.BillingTransactions, dbo.Bills
			WHERE dbo.BillingTransactions.Reference = dbo.Bills.BillIndex
			AND dbo.BillingTransactions.TransType = '1'
			AND dbo.BillingTransactions.CreateDate BETWEEN '".date("Y-m-d 00:00:00.000", $current_rbs)."' AND '".date("Y-m-d 23:59:00.000", $current_rbs)."'
			AND dbo.BillingTransactions.UserIndex = '".$row_customer["iuserIndex"]."';");
			
	$sql_invoice_rbs->execute();
	
	$no = 1;
	while ($row_invoice_rbs = $sql_invoice_rbs->fetch())
	{
		$balance_rbs = ($balance_rbs - ($credit_rbs - $row_invoice_rbs["Total"]));
		$html_data_rbs .='<tr align="left">
			<td>'.$row_invoice_rbs["BillingTransactionIndex"].'</td>
			<td>'.date("d F Y", strtotime($row_invoice_rbs["CreateDate"])).'</td>
			<td>Invoice</td>
			<td>'.$row_invoice_rbs["Reference"].'</td>
			<td></td>
			
			<td>'.$row_invoice_rbs["Total"].'</td>
			<td></td>
			<td>'.number_format($balance_rbs, 0, '.', ',').'</td>
			</tr>';
	}
	
	$current_rbs = strtotime('+1 days', $current_rbs);
	
}
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
						<div class="box-header">
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body table-responsive">
						<h4>DATA HELPDESK</h4>
                            <table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="100">Date</th>
										<th width="200">Description</th>
										<th width="100">Reference No</th>
										<th width="100">transaction No</th>
										<th width="100">Debit</th>
										<th width="100">Credit</th>
										<th width="100">Balance</th>
									</tr>
								</thead>
								<tbody>';
$content .= $html_data;
$content .= '
                                            
                                        </tbody>
                                    </table>
						<h4>DATA RBS</h4>
                            <table class="table table-bordered table-striped">
								<thead>
									<tr>
									<th width="100">Transaction No</th>
										<th width="100">Date</th>
										<th width="200">Description</th>
										<th width="100">Reference No</th>
										<th width="100">transaction No</th>
										<th width="100">Debit</th>
										<th width="100">Credit</th>
										<th width="100">Balance</th>
									</tr>
								</thead>
								<tbody>';
$content .= $html_data_rbs;
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#listdata\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false,
					"iDisplayLength": 50
                });
            });
        </script>
    ';

    $title	= 'Groups RBS';
    $submenu	= "group_rbs";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>