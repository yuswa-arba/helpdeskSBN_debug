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
*{
	font-family: Arial;
}
.inv1 {
	font-family: Arial;
	font-size: x-small;
	font-weight: bold;
	color: #666666;
}
.inv2 {
	font-family: Arial;
	font-size: small;
}
.inv3 {
	font-family: Arial;
	font-weight: bold;
	font-size: small;
}
-->
</style>


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:solid; border-bottom-color:#000">
      <tr>
        <td width="75%"><img src="../../pdf/logo-inv.png" height="70"></td>
        <td width="25%">
	<table width="248" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2"><b>'.$row_cabang["nama_cabang"].'</b></td>
	    </tr>
	    <tr>
              <td>Alamat</td>
              <td>'.$row_cabang["alamat_cabang"].'</td>
            </tr>
	    <tr>
              <td>Kota</td>
              <td>'.$row_cabang["kota_cabang"].'</td>
            </tr>
		<tr>
              <td>Kode Pos</td>
              <td>'.$row_cabang["kode_pos"].'</td>
            </tr>
	    <tr>
              <td>No Telpon</td>
              <td>'.$row_cabang["telp_cabang"].'</td>
            </tr>
		<tr>
              <td>No FAX</td>
              <td>'.$row_cabang["fax_cabang"].'</td>
            </tr>
		<tr>
              <td>Website</td>
              <td>'.$row_cabang["web_cabang"].'</td>
            </tr>
		<tr>
              <td>Email</td>
              <td>'.$row_cabang["email_cso"].'</td>
            </tr>
	    
          </table></td>
        </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>      
      <table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="50%">
		    Nama Pelanggan
		  </td>
		  <td width="50%">
		    '.$row_invoice["nama_customer"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    Kode Customer
		  </td>
		  <td width="50%">
		    '.$row_invoice["customer_number"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    No Invoice
		  </td>
		  <td width="50%">
		    '.$row_invoice["kode_invoice"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    NPWP
		  </td>
		  <td width="50%">
		    '.$row_invoice["npwp"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    No Faktur Pajak
		  </td>
		  <td width="50%">
		    '.$row_invoice["no_faktur_pajak"].'
		  </td>
		</tr>
	    <tr>
		  <td width="50%">
		    Nama Paket
		  </td>
		  <td width="50%">
		    '.$row_invoice["nama_paket"].'
		  </td>
		</tr>
		
		<tr>
		  <td width="50%">
		    Note
		  </td>
		  <td width="50%">
		    '.$row_invoice["note"].'
		  </td>
		</tr>
	      </table>
	  </td>
          <td width="50%" valign="top">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="50%">
		    Periode Tagihan
		  </td>
		  <td width="50%">
		    '.$row_invoice["periode_tagihan"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    Tanggal Tagihan
		  </td>
		  <td width="50%">
		    '.date("d-m-Y", strtotime($row_invoice["tanggal_tagihan"])).'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    Tanggal Jatuh Tempo
		  </td>
		  <td width="50%">
		    '.date("d-m-Y", strtotime($row_invoice["tanggal_jatuh_tempo"])).'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    No Virtual Account BCA
		  </td>
		  <td width="50%">
		    '.$row_invoice["no_virtual_account_bca"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    Nama Virtual
		  </td>
		  <td width="50%">
		    '.$row_invoice["nama_virtual"].'
		  </td>
		</tr>
		<tr>
		  <td width="50%">
		    Kontrak
		  </td>
		  <td width="50%">
		    '.$row_invoice["kontrak_awal"].' s/d '.$row_invoice["kontrak_akhir"].'
		  </td>
		</tr>
	      </table>
	  </td>
        </tr>
      </table>      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>      
      <table width="900" height="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="10%" height="28" bgcolor="#DADADA" class="inv3">&nbsp;No.</td>
          <td width="35%" bgcolor="#DADADA" class="inv3">&nbsp;Date</td>
          <td width="35%" bgcolor="#DADADA" class="inv3">&nbsp;Description</td>
          <td width="20%" bgcolor="#DADADA" class="inv3">&nbsp;Price</td>
        </tr>';

$query_invoice_item	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$row_invoice["kode_invoice"]."';";
$sql_invoice_item	= mysql_query($query_invoice_item, $conn);
    
$no = 1;
$total_price = 0;
$total_vat = 0;
$total_price_vat = 0;

while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
{

    $html .='<tr>
    <td>'.$no.'.</td>
    <td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
    <td>'.$row_invoice_item["desc"].'</td>
    <td>'.Rupiah($row_invoice_item["harga"]).'</td>
    </tr>';
    $no++;
    $total_price = $total_price + $row_invoice_item["harga"];
    
}

$html .='</table>      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="60%">&nbsp;
            <!--<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="500px" height="25" bgcolor="#DADADA" class="inv3">&nbsp;</td>
                </tr>
              <tr>
                <td  width="500px" height="60" bgcolor="#CCCCCC" class="inv3">
                  <p></p></td>
                </tr>
              
            </table>-->
          </td>
          <td width="40%">
            <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="33%" height="25" bgcolor="#DADADA" class="inv3">&nbsp;Subtotal</td>
                <td width="67%" bgcolor="#DADADA" style="text-align:right;">'.Rupiah($total_price).'</td>
              </tr>
              <tr>
                <td height="25" class="inv3">&nbsp;PPN 10%</td>
                <td width="67%" bgcolor="#DADADA" style="text-align:right;"></td>
              </tr>
              <tr>
                <td height="25" bgcolor="#DADADA" class="inv3">&nbsp;Grand Total</td>
                <td bgcolor="#DADADA"  style="text-align:right;">&nbsp;'.Rupiah($total_price + ($total_price/10)).'</td>
              </tr>
	      <tr>
                <td height="25" bgcolor="#DADADA" class="inv3">&nbsp;Uang Muka</td>
                <td bgcolor="#DADADA"  style="text-align:right;">&nbsp;<span class="inv3">-</span></td>
              </tr>
	      <tr>
                <td height="25" bgcolor="#DADADA" class="inv3">&nbsp;Sisa</td>
                <td bgcolor="#DADADA" style="text-align:right;">&nbsp;'.Rupiah($total_price + ($total_price/10)).'</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      </td>
  </tr>
</table>
<div style="position: fixed;bottom:0;">
<table width="900" border="0" cellspacing="0" style="border-bottom:solid; border-bottom-color:#000">
  <tr>
    <td height="22" align="center">
    <font style="font-size:13px;">Payment Due On Delivery Of This Invoice</font>
    </td>
  </tr>
</table>

<table width="900" border="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center"><font style="font-size:13px;">Thank you for your bussiness</font></td>
    
  </tr>
  <tr>
    <td width="281" align="right"><font style="font-size:13px;">Prepared By : </font></td>
    <td width="202" align="left"><font style="font-size:13px; padding-left:15px">'.$row_invoice["prepared_by"].'</font></td>
    <td rowspan="2"><font style="font-size:13px;">Tanggal Cetak: '.date("d F Y H:i:s").'<br />
    Printed: 1</font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><font style="font-size:13px;">Printed By :</font></td>
    <td align="left" valign="top"><font style="font-size:13px; padding-left:15px">'.(($row_invoice["printed_by"] != "") ? $row_invoice["printed_by"] : $loggedin["username"]).'
    ( '.$_SERVER['REMOTE_ADDR'].' )</font></td>

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