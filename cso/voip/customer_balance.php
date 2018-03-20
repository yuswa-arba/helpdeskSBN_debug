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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Technician");
   
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open List Customer Voip");
    global $conn;
    global $conn_voip;
    
	
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
    $content ='<section class="content-header">
                    <h1>
                        Customer Balance
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="list_customer">Customer Balance</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				<div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Search</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table">
									<form action="" method="post" name="form_search">
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Nama Customer</label>
										</div>
										<div class="col-xs-4">
											<input class="form-control" type="text" name="nama" placeholder="Nama Customer">
										</div>
										
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											<label>Nomer Telepon/VOIP</label>
										</div>
										<div class="col-xs-4">
											<input class="form-control" type="text" required="" name="nomer" placeholder="Nomer Telepon/VOIP">
										</div>
										
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
										<div class="col-xs-2">
											
										</div>
										<div class="col-xs-4">
											<input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
										</div>
										<div class="col-xs-2">
											
										</div>
										<div class="col-xs-4">
											
										</div>
										</div>
										</div>
						</form>
						</div>
										</div>
										</div>
										</div>';
										
if(isset($_POST["search"]))
{

$nama     	= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
$nomer     	= isset($_POST['nomer']) ? mysql_real_escape_string(trim($_POST['nomer'])) : '';

$sql_nama	= ($nama != "") ? "AND (`firstname` LIKE '%".$nama."%' OR `lastname` LIKE '%".$nama."%')" : "";
$sql_nomer	= ($nomer != "") ? "AND `useralias` = '".$nomer."'" : "";

$sql_masterCustomer = mysql_query("SELECT * FROM `cc_card` WHERE `id_group` = '2' AND `useralias` <> '3003444'  $sql_nama $sql_nomer ORDER BY `id` ASC LIMIT $start, $perhalaman;",$conn_voip);
$sql_total = mysql_num_rows(mysql_query("SELECT * FROM `cc_card` WHERE `id_group` = '2' AND `useralias` <> '3003444' $sql_nama $sql_nomer  ORDER BY `id` ASC ;", $conn_voip));
$hal = "?";

if($nama !="" OR $nomer != "")
{
$content .='
										
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
                                                <th>Group</th>
                                                <th>Credit</th>
						
						<th>Invoice</th>
						<th>Payment</th>
						<th>To Pay</th>
						<th>Status</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					





$no = $start + 1;
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
			<td>'.$row_getgroup["name"].'</td>
		    <td>'.number_format($row_masterCustomer["credit"], 2, ',', '.').' IDR</td>
		    
		    <td>'.number_format($row_invoice["total"], 2, ',', '.').'</td>
		    <td>'.number_format($row_payment["payment"], 2, ',', '.').'</td>
		    <td>'.number_format(($row_payment["payment"] - $row_invoice["total"]), 2, ',', '.').'</td>
		    <td>'.$status.'</td>
		    <td align="center"><a href="call_history?id='.$row_masterCustomer["id"].'">Detail</a></td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($sql_total, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								 </div>
                            </div><!-- /.box -->
                        </div>
                    </div>';
					
}
else
{
 $content .='<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
								<div class="box-header">
									 <h3 class="box-title">Customer Balance</h3>
                                </div>
								<div class="box-body">
									 <p>Data Tidak Ditemukan...</p>
								</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
								';
}
					
}

$content .='</section><!-- /.content -->';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
	
    ';

    $title	= 'Customers Balance';
    $submenu	= "customer_balance";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>