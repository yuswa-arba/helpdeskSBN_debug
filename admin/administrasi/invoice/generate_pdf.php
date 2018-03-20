<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
function generate_pdf($id_invoice="")
{
	
	$id_invoice	= ($id_invoice == "") ? "" : (int)($id_invoice);
    global $conn;



		//$id_invoice		= isset($_GET['id']) ? (int)$_GET['id'] : '';
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
		
	$html_tidy = '<!DOCTYPE html>
	<html>
	<head>
		<title>INVOICE</title>
	</head>
	<body>
		<hr>
		<br><br>&nbsp;
		<table>
			<tbody>
				<tr>
					<td>
						No Pelanggan / <em>Customer Number</em>
					</td>
					<td>: '.$row_invoice["customer_number"].'</td>
					<td>Periode Tagihan / <em>Bill Period</em></td>
					<td>: '.$row_invoice["periode_tagihan"].'</td>
				</tr>
				<tr>
					<td>
						Nama Pelanggan / <em>Customer Name</em>
					</td>
					<td>: '.$row_invoice["nama_customer"].'</td>
					<td>Tanggal Tagihan / <em>Date of Bill</em></td>
					<td>: '.date("d-m-Y", strtotime($row_invoice["tanggal_tagihan"])).'</td>
				</tr>
				<tr>
					<td>
						No Tagihan / <em>Invoice Number</em>
					</td>
					<td>: '.$row_invoice["kode_invoice"].'</td>
					<td>Tanggal Jatuh Tempo / <em>Due Date</em></td>
					<td>: '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).'</td>
				</tr>
				<tr>
					<td>
						NPWP / <em>Tax Id Number</em>
					</td>
					<td>: '.$row_invoice["npwp"].'</td>
					<td>Virtual Account Number</td>
					<td>: '.$row_invoice["no_virtual_account_bca"].'</td>
				</tr>
				<tr>
					<td>
						No Faktur Pajak / <em>Tax Invoice Number</em>
					</td>
					<td>: '.$row_invoice["no_faktur_pajak"].'</td>
					<td>Nama <span>Virtual Account</span> <span class="style2">/ Virtual Account Name</span></td>
					<td>: '.$row_invoice["nama_virtual"].'</td>
				</tr>
				<tr>
					<td>
						Nama Paket / <em>Package Name</em>
					</td>
					<td>: '.$row_invoice["nama_paket"].'</td>
					<td>Kontrak / <em>Contract</em></td>
					<td>: '.$row_invoice["kontrak_awal"].' s/d '.$row_invoice["kontrak_akhir"].'</td>
				</tr>
				<tr>
					<td>
						<em>Proforma Invoice Number</em>
					</td>
					<td>: -</td>
					<td>Total Tagihan / <em>Total Amount Due</em></td>
					<td>:</td>
				</tr>
				<tr>
					<td>
						Keterangan <em>/ Note</em>
					</td>
					<td>: '.$row_invoice["note"].'</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<br><br><br>
		<table>
			<tbody>
				<tr>
					<td colspan="3" style="background-color:#003399;color:#fff;">
						<div>RINGKASAN TAGIHAN BULAN '.$row_invoice["periode_tagihan"].' / <em>INVOICE SUMMARY</em></div>
					</td>
					<td style="background-color:#003399;color:#fff;">
						<div>BIAYA / <em>CHARGE</em></div>
					</td>
					<td rowspan="8"></td>
				</tr>';
			
	$query_invoice_item	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_invoice["kode_invoice"]."';";
	$sql_invoice_item	= mysql_query($query_invoice_item, $conn);
		
	$no = 1;
	$total_price = 0;
	$total_vat = 0;
	$total_price_vat = 0;
	
	while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
	{
	
		$html_tidy .='<tr style="vertical-align: top;">
		<td>'.$no.'.</td>
		<td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
		<td>'.$row_invoice_item["desc"].'</td>
		<td>'.Rupiah($row_invoice_item["harga"]).'</td>
		</tr>';
		$no++;
		$total_price = $total_price + $row_invoice_item["harga"];
		
	}
	
	$ppn = (10/100) * $total_price;
	
	$html_tidy .='
				<tr>
					<td colspan="3" style="background-color:#003399;color:#fff; vertical-align:center;">
						<div>PPN <em>/ TAX</em></div>
					</td>
					<td style="background-color:#003399;color:#fff; vertical-align:center;">
						<div>
							'.Rupiah($ppn).'
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="background-color:#003399;color:#fff; vertical-align:center;">
						<div>TOTAL TAGIHAN SEKARANG <em>/ TOTAL CURRENT BALANCE</em></div>
					</td>
					<td style="background-color:#003399;color:#fff; vertical-align:center;">
						<div>
							'.Rupiah($ppn + $total_price).'
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					<br><br>
						Tagihan Sebelumnya/ <em>Previous Balance</em>
					</td>
					<td class="style2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						Invoice
					</td>
					<td class="BoldContent"></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3">
						Pembayaran <em>/ Payments</em>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
						<p><span><br>
						<span>Cash BCM</span></span><br></p>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<p>TOTAL TAGIHAN / <em>TOTAL AMOUNT DUE</em></p>
					</td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tbody>
				<tr>
					<td style="text-align:center;">
						<p>Terima Kasih Atas Pembayaran Anda <em>/ Thank You for Your Payment</em></p>
						<p>Prepared by : '.$row_invoice["prepared_by"].'<br>
						Printed by : '.(($row_invoice["printed_by"] != "") ? $row_invoice["printed_by"] : $loggedin["username"]).' ( '.$_SERVER['REMOTE_ADDR'].' )<br>
						Printing Date : '.date("d F Y H:i:s").'</p>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
	</html>';
	//echo $html;
	
	require_once ('../../../js/tcpdf/tcpdf.php');
	//require_once ('../../../js/fpdf/fpdf.php');
	require_once('../../../js/fpdi/fpdi.php');
	
	$pdf = new FPDI(); //FPDI extends TCPDF
	//$pdf->AddPage();
	$pages = $pdf->setSourceFile( 'inv.pdf' );
	
	$pdf->setPrintHeader(false);
	$pdf->AddPage();
	$page = $pdf->ImportPage(1);
	$pdf->useTemplate( $page, 0, 0 );
	
	//echo $page_satu;
	$pdf->SetFont('Helvetica', '', 8);
	$pdf->SetXY(10,25, PDF_MARGIN_LEFT);
	
	
	$pdf->writeHTML($html_tidy);
	
	
	//$pdf->Output( 'Invoice_SBN.pdf', 'I' );

ob_clean();

	$nama_file = trim($row_invoice["customer_number"])."_".trim($row_invoice["periode_tagihan"]);
	$pdf->Output("$nama_file.pdf", "F");
	
	
}


?>