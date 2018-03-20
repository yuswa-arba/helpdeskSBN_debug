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
    
    global $conn;

enableLog("", $loggedin["username"], $loggedin["username"], "Open Detail Invoice");

if(isset($_GET["id"]))
{
    $id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_invoice 	= "SELECT `gx_invoice`.* , `tbCustomer`.*, `gx_paket2`.`nama_paket`
			FROM `gx_invoice`, `tbCustomer`, `gx_paket2`
			WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
			AND `gx_invoice`.`customer_number` = `tbCustomer`.`cKode`
			AND `gx_invoice`.`id_invoice` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
	$sql_cabang		= mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` ='".$row_invoice["id_cabang"]."' LIMIT 0,1;", $conn);
	$row_cabang		= mysql_fetch_array($sql_cabang);
	
    $query_invoice_config	= "SELECT * FROM `gx_invoice_config` WHERE `id_invoice_config` ='1' LIMIT 0,1;";
    $sql_invoice_config		= mysql_query($query_invoice_config, $conn);
    $row_invoice_config		= mysql_fetch_array($sql_invoice_config);
    
$html_tidy = <<<EOF
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]--><!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8">
<![endif]--><!--[if IE 8]> <html class="no-js lt-ie9">
<![endif]--><!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
	<title>SBN Invoice</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1" name="viewport">
	<meta content="SBN Invoice" name="description">
	
	<link href="../../img/favicon.ico" rel="apple-touch-icon" sizes="180x180">
	<link href="../../img/favicon.ico" rel="icon" sizes="32x32" type="image/png">
	<link href="../../img/favicon.ico" rel="icon" sizes="16x16" type="image/png">
	
	<link href="../../img/favicon.ico" rel="mask-icon">
	<meta content="#ffffff" name="theme-color">
	<link href="../../css/pdf_invoice/kuitansi.css" rel="stylesheet">
	<link href="../../css/pdf_invoice/invoice.css" rel="stylesheet">
	<!--[if IE]>
	
	<![endif]-->
	<!--[if lt IE 9]>
	
	<![endif]-->
	<style>
	div.page{overflow:hidden;page-break-before:always}
	

	</style>
</head>
<body>
	<div class="main">
		<div class="kuitansi">
			<div class="inv">
				<div class="inv__header">
					
					<div class="inv__header__title">
						Kuitansi Pembayaran
					</div>
					<div class="inv__head">
						<div class="inv__head--left">
							<div class="inv__head__title">
								Ditagihkan kepada
							</div>
							<div class="inv__to__name">
								Dwi Wardiansah - 085790937791<br>
								dwiwar1709@gmail.com
							</div>
							<div class="inv__head__title">
								Barang dikirim ke
							</div>
							<div class="inv__to__address">
								Ruko istana dinoyo E5 Jl. Mt haryono 1A Malang<br>
								Lowokwaru, Kota Malang<br>
								Jawa Timur - 65144
							</div>
						</div>
						<div class="inv__head--right">
							<div class="inv__head__col">
								<div class="inv__head__title">
									Tanggal Transaksi
								</div>
								<div class="inv__head__context">
									02 February 2017, 09:09
								</div>
							</div>
							<div class="inv__head__col">
								<div class="inv__head__title">
									Kode Transaksi
								</div>
								<div class="inv__head__context">
									1909094649
								</div>
							</div>
							<div class="inv__head__col">
								<div class="inv__head__title">
									Status Pembayaran
								</div>
								<div class="inv__head__context">
									Lunas
								</div>
							</div>
						</div>
					</div>
					<div class="inv__body">
						<div class="inv__sender">
							<table>
								<thead>
									<tr>
										<th width="20"></th>
										<th align="left" class="inv__warehouse"><span>Dikirim oleh Jakmall</span> <span class="inv__kode__pesanan">Kode Pesanan <b>23406861888</b></span></th>
										<th align="right" width="120">Qty x Harga</th>
										<th align="right" width="120">Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td valign="top">1.</td>
										<td width="200">
											<div class="inv__item__name">
												Apple EarPods Earphones for iPhone 5/5s/SE/6/6+/iPod
											</div>
											<div class="inv__item__aside">
												<span>Kelvin Online Shop</span> <span>50gr</span> <span>Putih</span>
											</div>
										</td>
										<td align="right">1 x Rp 88.500</td>
										<td align="right">Rp 88.500</td>
									</tr>
									<tr>
										<td valign="top">2.</td>
										<td width="200">
											<div class="inv__item__name">
												Apple MagSafe Original AC Power Extension Cord EU Plug (Volex Original)
											</div>
											<div class="inv__item__aside">
												<span>Kelvin Online Shop</span> <span>200gr</span> <span>Putih</span>
											</div>
										</td>
										<td align="right">1 x Rp 45.200</td>
										<td align="right">Rp 45.200</td>
									</tr>
								</tbody>
							</table>
							<table class="inv__summary">
								<tfoot>
									<tr>
										<td align="right" colspan="3">Ongkos Kirim Jne REG (1 x Rp 22.000)</td>
										<td align="right">Rp 22.000</td>
									</tr>
								</tfoot>
							</table>
						</div>
						<table class="inv__summary">
							<tfoot>
								<tr class="inv__font--big">
									<td align="right" colspan="3">Total Belanja</td>
									<td align="right">Rp 155.700</td>
								</tr>
								<tr>
									<td align="right" colspan="3">Kode Unik</td>
									<td align="right">Rp 141</td>
								</tr>
								<tr>
									<td align="right" colspan="3">Bank Transfer</td>
									<td align="right">(155.841)</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<ul class="inv__footnote">
						<li>Kuitansi ini hanya sah apabila status pembayaran diatas dinyatakan lunas.</li>
						<li>Kuitansi ini hanya berlaku sebagai bukti pembayaran atas transaksi yang dilakukan oleh pembeli kepada penjual barang, bukan sebagai nota pembelian.</li>
						<li>PT. Jakmall Digital Niaga hanya bertindak sebagai perantara pembayaran antara pembeli dan penjual.</li>
					</ul>
				</div>
			</div>
		</div>
		
	</div>
	
</body>
</html>
EOF;
//echo $html_tidy;


include('../../pdf/mpdf.php');

$mpdf=new mPDF('c','A4','','',5,5,25,25,0,0); 
//$mpdf = new mPDF();
$mpdf->SetHTMLHeader();
$mpdf->SetImportUse();

// Add First page
$mpdf->SetDocTemplate('inv.pdf',true);

// Do not add page until doc template set, as it is inserted at the start of each page


$mpdf->AddPage();

$mpdf->WriteHTML($html_tidy);

$mpdf->Output();

exit;


}
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>