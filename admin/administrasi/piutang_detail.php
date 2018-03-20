<?php
/*
 * Project Name: Globalxtreme Web Payment Template
 * Project URI: https://globalxtreme.net/new/payment
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Agustus 2013
 * Email: dwi@globalxtreme.net
 * Project for Web Payment
 * Last edited: Dwi
 * Desc: 
 * 
 */
include ("../../config/configuration_admin.php");


redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
	
    global $conn;
   
    $customer_number    = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : "";
    $from_date    = isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
    $to_date      = isset($_GET['t']) ? mysql_real_escape_string(strip_tags(trim($_GET['t']))) : "";
    
    $sql_customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` LIKE '%".$customer_number."%' LIMIT 0,1;", $conn);
    $row_customer = mysql_fetch_array($sql_customer);
    

$start = $current = strtotime($from_date);
$end = strtotime($to_date);
$balance = 0;
$credit  = 0;
$debet   = 0;
$html_data	= "";

    $sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
			       WHERE `customer_number` = '".$customer_number."' AND `level` = '0';", $conn);
    
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_invoice = mysql_fetch_array($sql_invoice)){
	    $sql_invoice_detail = mysql_query("SELECT SUM(`harga`) AS `total` FROM `gx_invoice_detail`
					      WHERE `kode_invoice` = '".$row_invoice["kode_invoice"]."';", $conn);
	    $row_invoice_detail = mysql_fetch_array($sql_invoice_detail);
	    $balance = ($balance + ($credit - $row_invoice_detail["total"]));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y", strtotime($row_invoice["tanggal_tagihan"])).'</td>
		<td>'.$row_invoice["title"].'</td>
		<td>'.$row_invoice["kode_invoice"].'</td>
		<td></td>
		<td>'.number_format($row_invoice_detail["total"], 0, '.', ',').'</td>
		<td></td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
	
	$sql_bankmasuk = mysql_query("SELECT * FROM `gx_bank_masuk`
			       WHERE `id_customer` = '".$customer_number."' AND `level` = '0';", $conn);
    
    //$num_invoice = mysql_num_rows($sql_invoice);
	while($row_bankmasuk = mysql_fetch_array($sql_bankmasuk)){
	    $sql_bank_detail = mysql_query("SELECT SUM(`nominal`) AS `total` FROM `gx_bm_detail`
					      WHERE `id_bankmasuk` = '".$row_bankmasuk["id_bankmasuk"]."';", $conn);
	    $row_bank_detail = mysql_fetch_array($sql_bank_detail);
	    $balance = ($balance + ($row_bank_detail["total"] - $debet));
	    $html_data .='<tr align="left">
		<td>'.date("d F Y", strtotime($row_bankmasuk["tgl_transaction"])).'</td>
		<td>'.$row_bankmasuk["remarks"].'</td>
		<td></td>
		<td>'.$row_bankmasuk["transaction_id"].'</td>
		<td></td>
		<td>'.number_format($row_bank_detail["total"], 0, '.', ',').'</td>
		<td>'.number_format($balance, 0, '.', ',').'</td>
	    </tr>';
	}
    

    


$content = '<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
						<div class="box-header">
                            <h3 class="box-title">List Data</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body table-responsive">
                            <table id="listdata" class="table table-bordered table-striped">
								<thead>
        <tr align="center">
            <th width="100">Date</th>
            <th width="200">Description</th>
            <th width="100">Reference No</th>
            <th width="100">transaction No</th>
            <th width="100">Debit</th>
            <th width="100">Credit</th>
            <th width="100">Balance</th>
        </tr>
		</thead>
		<tbody>
	';
$content .= $html_data;
$content .='
        </tbody>
    </table>
	
								</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
  ';
	$title	= 'Detail Piutang';
	$submenu	= "group_rbs";
	$plugins	= '';
	$user	= ucfirst($loggedin["username"]);
	$group	= $loggedin['group'];
	$template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
	
	echo $template;

}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }
?>