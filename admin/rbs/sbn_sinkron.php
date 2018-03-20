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
    
    
    
    //paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
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
                            <table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th rowspan="3">#</th>
										
										<th rowspan="3">UserID</th>
										<th colspan="3">RBS</th>
										<th colspan="5">Helpdesk</th>
									</tr>
									<tr>
										<th rowspan="2">UserBalance</th>
										<th rowspan="2">Invoice</th>
										<th rowspan="2">Payment</th>
										
										<th rowspan="2">UserBalance</th>
										<th rowspan="2">Invoice</th>
										<th colspan="3">Payment</th>
									</tr>
									<tr>
										
										<th>Kas</th>
										<th>Bank</th>
										<th>Total</th>
										
									</tr>
								</thead>
								<tbody>';
								
$conn_soft = Config::getInstanceSoft();
$userIndex = isset($_GET["id"]) ? (int)$_GET["id"] : "";
$UserID = isset($_GET["u"]) ? $_GET["u"] : "";
$sql_userindex = isset($_GET["id"]) ? " AND dbo.Users.UserIndex = '".$userIndex."' " : "";
$sql_userid = isset($_GET["u"]) ? " AND dbo.Users.UserID LIKE '%".$UserID."%' " : "";

$sql_data = $conn_soft->prepare("SELECT dbo.Users.UserIndex, dbo.Users.UserID, dbo.Users.UserIP, dbo.AccountTypes.AccountName, dbo.Users.GroupName, dbo.Users.UserPaymentBalance,
								dbo.Users.GracePeriodExpiration , dbo.Users.UserActive, dbo.Users.UserExpiryDate,
								(
		SELECT
			TOP 1 SUM (
				dbo.BillingTransactions.Total
			) AS total
		FROM
			dbo.BillingTransactions
		WHERE
			dbo.BillingTransactions.UserIndex = dbo.Users.UserIndex
		AND dbo.BillingTransactions.TransType = '1'
		GROUP BY
			dbo.BillingTransactions.UserIndex,
			dbo.BillingTransactions.TransType
	) AS total_invoice, 
	(
		SELECT
			TOP 1 SUM (
				dbo.BillingTransactions.Total
			) AS total
		FROM
			dbo.BillingTransactions
		WHERE
			dbo.BillingTransactions.UserIndex = dbo.Users.UserIndex
		AND dbo.BillingTransactions.TransType = '2'
		GROUP BY
			dbo.BillingTransactions.UserIndex,
			dbo.BillingTransactions.TransType
	) AS total_payment
  FROM dbo.Users, dbo.AccountTypes
  WHERE dbo.Users.AccountIndex = dbo.AccountTypes.AccountIndex
  AND dbo.Users.UserActive = '1'
$sql_userindex
$sql_userid
  ORDER BY dbo.Users.UserIndex DESC;");
//  AND dbo.Users.UserIndex = '6418'
$sql_data->execute();

$no = 1;
while ($row_data = $sql_data->fetch())
{
	$sql_helpdesk = mysql_query("SELECT
tbCustomer.idCustomer,
tbCustomer.cNama,
tbCustomer.cKode,
tbCustomer.cUserID,
tbCustomer.gx_saldo,
(SELECT SUM(total) FROM v_invoice_sbn WHERE v_invoice_sbn.customer_number = tbCustomer.cKode) AS total_invoice,
(SELECT SUM(total_detail) FROM v_kasmasuk_sbn WHERE v_kasmasuk_sbn.id_customer = tbCustomer.cKode) AS total_kas,
(SELECT SUM(total_detail) FROM v_bankmasuk_sbn WHERE v_bankmasuk_sbn.id_customer = tbCustomer.cKode) AS total_bank
FROM
tbCustomer
WHERE tbCustomer.cUserID = '".$row_data["UserID"]."' LIMIT 0,1;", $conn);
	$row_helpdesk = mysql_fetch_array($sql_helpdesk);
	
	$total_payment_helpdesk = $row_helpdesk['total_kas'] + $row_helpdesk['total_bank'];
	
$content .= '<tr>
			<td>'.$no.'</td>
			
			<td>'.$row_data["UserID"].'</td>
			<td class="bg-danger">'.number_format($row_data["UserPaymentBalance"], 0, ",",".").'</td>
			<td class="bg-danger">'.number_format($row_data["total_invoice"], 0, ",",".").'</td>
			<td class="bg-danger">'.number_format($row_data["total_payment"], 0, ",",".").'</td>
			<td class="bg-warning">'.number_format($row_helpdesk['gx_saldo'], 0, ",",".").'</td>
			<td class="bg-warning">'.number_format($row_helpdesk['total_invoice'], 0, ",",".").'</td>
			<td class="bg-warning">'.number_format($row_helpdesk['total_kas'], 0, ",",".").'</td>
			<td class="bg-warning">'.number_format($row_helpdesk['total_bank'], 0, ",",".").'</td>
			<td class="bg-warning">'.number_format($total_payment_helpdesk, 0, ",",".").'</td>
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