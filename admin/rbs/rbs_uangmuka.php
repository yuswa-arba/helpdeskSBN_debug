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
										<th>#</th>										
										<th>UserID</th>
										<th>Uangmuka</th>
										<th>UserBalance RBS</th>
										<th>UserBalance Helpdesk</th>
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
  ORDER BY dbo.Users.UserID ASC;");
//  AND dbo.Users.UserIndex = '6418'
$sql_data->execute();

$no = 1;
while ($row_data = $sql_data->fetch())
{
	$sql_helpdesk = mysql_query("SELECT * FROM `view_data_compare`
WHERE `view_data_compare`.`cUserID` = '".$row_data["UserID"]."' LIMIT 0,1;", $conn);
	$row_helpdesk = mysql_fetch_array($sql_helpdesk);
	
	$sql_customer = mysql_query("SELECT * FROM `v_customer_aktivasi`
WHERE `v_customer_aktivasi`.`cUserID` = '".$row_data["UserID"]."' LIMIT 0,1;", $conn);
	$row_customer = mysql_fetch_array($sql_customer);
	
	$total_payment_helpdesk = $row_helpdesk['total_kas'] + $row_helpdesk['total_bank'];
	$color = "bg-success";
	
	$color_rbs = "bg-danger";
	//echo ($row_data["total_invoice"] + $row_data["total_payment"]) ."<br>";
	//$color_diff = ($row_data["UserPaymentBalance"] == $row_helpdesk['gx_saldo']) ? "bg-success" : "bg-danger";
	
	if($row_customer["cKode"] != "" AND
		$row_customer["kode_inactive"] == NULL AND $row_customer["kode_off"] == NULL AND
		$row_customer["kode_aktivasi"] != NULL)
	{
		$total_tagihan = (int)$row_customer['total_tagihan'] + $row_customer['total_ppn'];
		$uangmuka = $row_data["UserPaymentBalance"] + $total_tagihan;
		
	}
	else
	{
		$uangmuka = 0;
		
	}
	
	if($uangmuka > 1)
	{
		$color_diff = "bg-danger";
	}
	else
	{
		$color_diff = "bg-success";
	}
	
	$sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
		WHERE `title` = 'INVOICE Oktober 2017'
		AND `customer_number` = '".$row_customer["cKode"]."' LIMIT 1;", $conn);
	
	while($row_invoice  = mysql_fetch_array($sql_invoice))
	{
		if($uangmuka > 1)
		{
			$sql_update_um = "UPDATE `gx_invoice` SET `uangmuka` = '".$uangmuka."'
			WHERE (`id_invoice` = '".$row_invoice["id_invoice"]."');";
			echo $sql_update_um."<br>";
			//mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");
		}
	}
$content .= '<tr>
			<td class="'.$color_diff.'">'.$row_data["UserIndex"].'</td>
			
			<td class="'.$color_diff.'"><a href="rbs_soft_compare_detail.php?u='.$row_data["UserID"].'">'.$row_data["UserID"].'</a></td>
			<td class="'.$color.'">'.number_format($uangmuka, 0, ",",".").'</td>
			<td class="'.$color_rbs.'">'.number_format($row_data["UserPaymentBalance"], 0, ",",".").'</td>
			
			<td class="'.$color.'">'.number_format($row_helpdesk['gx_saldo'], 0, ",",".").'</td>
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