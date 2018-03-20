<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
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
    
$html = '<style type="text/css">
<!--
.content {font-size: 14px;}
.invoice {
	color: #003366;
	font-weight: bold;
	font-size: large;
}
.Title {
	font-size: 16px;
	font-weight: bold;
	color: #FFFFFF;
}

.BoldContent {font-size: x-small; font-weight: bold; }
.BoldFoot {
	font-size: 14px;
	font-weight: bold;
	color: #003399;
}
.footer {
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<body style="background: url(\'../../assets/invoice/bg.png\') center no-repeat;">
<table style="width:100%;padding-top:50px;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td ><p ><span ><span class="content">No Pelanggan / <em>Customer Number</em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: '.$row_invoice["customer_number"].' </td>
          <td class="content" >Periode Tagihan / <em>Bill Period</em> </td>
          <td class="content" > : '.$row_invoice["periode_tagihan"].' </td>
        </tr>
        <tr>
          <td ><p ><span ><span class="content">Nama Pelanggan / <em>Customer Name</em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: '.$row_invoice["nama_customer"].' </td>
          <td class="content" >Tanggal Tagihan  / <em>Date of Bill</em> </td>
          <td class="content" > : '.date("d-m-Y", strtotime($row_invoice["tanggal_tagihan"])).' </td>
        </tr>
        <tr>
          <td ><p ><span ><span class="content">No Tagihan / <em>Invoice Number</em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: '.$row_invoice["kode_invoice"].' </td>
          <td class="content" >Tanggal Jatuh Tempo  / <em>Due Date </em> </td>
          <td class="content" > : '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).' </td>
        </tr>
        <tr>
          <td ><p ><span ><span class="content">NPWP / <em>Tax Id  Number</em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: '.$row_invoice["npwp"].' </td>
          <td class="content" >Virtual Account  Number</td>
          <td class="content" > : '.$row_invoice["no_virtual_account_bca"].' </td>
        </tr>
        <tr>
          <td ><p ><span ><span class="content">No Faktur Pajak / <em>Tax Invoice  Number</em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: '.$row_invoice["no_faktur_pajak"].' </td>
          <td class="content" >Nama <span class="content">Virtual Account</span><span class="style2"> / Virtual Account  Name </span></td>
          <td class="content" > : '.$row_invoice["nama_virtual"].' </td>
        </tr>
        <tr>
          <td ><p ><span ><span class="content">Nama Paket  / <em>Package Name </em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: '.$row_invoice["nama_paket"].' </td>
          <td class="content" >Kontrak / <em>Contract</em> </td>
          <td class="content" > : '.$row_invoice["kontrak_awal"].' s/d '.$row_invoice["kontrak_akhir"].' </td>
        </tr>
        <tr>
          <td ><p ><span ><span class="content"><em>Proforma Invoice Number</em></span> </span><br>
                    <br>
          </p></td>
          <td class="content" >: - </td>
          <td class="content" >Total Tagihan / <em>Total Amount Due </em> </td>
          <td class="content" > :  </td>
        </tr>
        <tr>
          <td width="182" height="80" valign="top"><p ><span class="content" >            Keterangan <em>/ Note </em>
          </span><br>
                    <br>
          </p></td>
          <td width="205" valign="top" class="content" >: '.$row_invoice["note"].' </td>
          <td width="254" class="content" >&nbsp;</td>
          <td width="169" class="content" >&nbsp;</td>
        </tr>
      </table>
      <table width="1000" border="0" align="center" cellpadding="0" cellspacing="5">
        <tr>
          <td colspan="3" bgcolor="#003399" ><p ><span class="Title" >RINGKASAN TAGIHAN BULAN JUNI /  <em>INVOICE SUMMARY </em></span><br>
          </p></td>
          <td width="215" bgcolor="#003399" class="Title">BIAYA / CHARGE </td>
          <td width="208" rowspan="8" class="content" style="border: 1px solid #000;" >
        </tr>';
        
$query_invoice_item	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_invoice["kode_invoice"]."';";
$sql_invoice_item	= mysql_query($query_invoice_item, $conn);
    
$no = 1;
$total_price = 0;
$total_vat = 0;
$total_price_vat = 0;

while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
{

    $html .='<tr style="vertical-align: top;">
    <td>'.$no.'.</td>
    <td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
    <td>'.$row_invoice_item["desc"].'</td>
    <td align="right">'.Rupiah($row_invoice_item["harga"]).'</td>
    </tr>';
    $no++;
    $total_price = $total_price + $row_invoice_item["harga"];
    
}

$ppn = (10/100) * $total_price;

$html .='
		<tr>
          <td colspan="3" bgcolor="#003399" ><p ><span class="Title">PPN<em> / TAX</em></span> <br>
          </p></td>
          <td bgcolor="#003399" class="Title" align="right" ><div >'.Rupiah($ppn).'</div></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#003399" ><p ><span class="Title">TOTAL TAGIHAN SEKARANG<em> / TOTAL CURRENT BALANCE</em></span> <br>
          </p></td>
          <td bgcolor="#003399" class="Title" align="right" ><div >'.Rupiah($ppn + $total_price).'</div></td>
        </tr>
        <tr>
          <td colspan="3" ><p ><span ><br>
                    <span class="content">Tagihan Sebelumnya</span>  </span><span class="content">/ <em>Previous Balance</em></span><em> </em><br>
                    <br>
                    <br>
          </p></td>
          <td class="style2" >&nbsp;</td>
        </tr>
        
		<tr>
          <td colspan="2"><p ><span ><br>
                    <span class="content">Invoice  <em></em></span> </span><br>
                    <br>
                    <br>
          </p></td>
          <td class="BoldContent" > </td>
          <td class="content" ><div align="right"></div></td>
        </tr>
        <tr>
          <td colspan="3" ><p ><span ><br>
                    <span class="content">Pembayaran <em>/ Payments </em></span></span><br>
                    <br>
                    <br>
          </p></td>
          <td class="content" ><div align="right"></div></td>
        </tr>
		
        <tr>
          <td colspan="2"><p ><span ><br>
                    <span class="content">Cash BCM  </span> </span><br>
                    <br>
                    <br>
          </p></td>
          <td class="content" ><span class="BoldContent"> </span></td>
          <td class="content" ><div align="right"></div></td>
        </tr>
        <tr>
          <td colspan="3" bgcolor="#003399" ><p ><span ><span class="Title">TOTAL TAGIHAN  / <em>TOTAL AMOUNT DUE </em></span><br>
          </span></p></td>
          <td bgcolor="#003399" class="Title" ><div align="right"></div></td>
        </tr>
        
      </table>      
      <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" style="text-align:center;">
		<tr>
          <td><p align="center" ><span class="content" >            <br>
                </span><span class="BoldFoot"><br>
              Terima Kasih Atas Pembayaran Anda <em>/ Thank You for Your Payment
              </em></span><br>
              <br>
          <br>
          </p></td>
        </tr>
        <tr>
          <td> <div style="text-align:center;">Prepared by : '.$row_invoice["prepared_by"].'<br>
            Printed by : '.(($row_invoice["printed_by"] != "") ? $row_invoice["printed_by"] : $loggedin["username"]).' ( '.$_SERVER['REMOTE_ADDR'].' )
                <br>
              Printing Date : '.date("d F Y H:i:s").'<br>
              <br>
              <br>
              <br>
          </div>
          </p></td>
        </tr>
      </table>
	  
    </td>
  </tr>
</table>
</body>
';
$footer = '<div style="margin:0 -50px;background-image: url(\'../../assets/invoice/footer.png\');text-align:center;">
      <table width="1000" height="117" border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr>
          <td height="111"  ><table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="410" >&nbsp;</td>
              <td width="490" ><div align="center" class="content">
                <div align="left"><br>
                  <br>
                  <span class="footer">Jl. Raya Kerobokan 388x Br. Semer, Kuta, Bali (80361) Indonesia<br>
P. (0361) 736811 | F. (0361) 736833 | E. info@globalxtreme.net </span><br>
                    <br>
                    <br>
                </div>
              </div>
                  </p></td>
            </tr>
          </table>		  </td>
        </tr>
      </table>
	  </div>';

//echo $html;
//'.Rupiah($total_price/10).'
//==============================================================
//==============================================================
//==============================================================
include('../../pdf/mpdf.php');

$mpdf=new mPDF('c','A4','','',5,5,5,5,0,0); 

$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage','two');
$mpdf->SetHTMLHeader('
	<table style="border-bottom:1px solid #000088; vertical-align: bottom; font-family: serif;  font-size:12pt; color: #000088;" width="100%">
		<tbody>
			<tr>
				<td width="50%"><b>INVOICE</b></td>
				
			</tr>
		</tbody>
	</table>
');
$mpdf->SetHTMLFooter($footer);
//$mpdf->showImageErrors = true;
// LOAD a stylesheet
//$stylesheet = file_get_contents('http://192.168.182.10/software/beta/css/bootstrap.min.css');

//$mpdf->WriteHTML($stylesheet4,1);
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;

}
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>