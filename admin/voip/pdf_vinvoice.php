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
include ("../../config/configuration_voip_bali.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;

enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Detail Invoice");

if(isset($_GET["id"]))
{
    $id_invoice		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_invoice 	= "SELECT `cc_invoice`.* , `cc_card`.`firstname`, `cc_card`.`lastname`, `cc_card`.`username`,
			`cc_card`.`useralias`
			FROM `cc_invoice`, `cc_card`
			WHERE `cc_invoice`.`id_card` = `cc_card`.`id`
			AND `cc_invoice`.`id` ='".$id_invoice."' LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn_voip);
    $row_invoice	= mysql_fetch_array($sql_invoice);
    
    
//data customer
$sql_cust = mysql_query("SELECT `gx_cabang`.`nama_cabang`, `gx_cabang`.`alamat_cabang`, `gx_cabang`.`telp_cabang`, `gx_cabang`.`email_cabang`,
			`tbCustomer`.`cNama`, `tbCustomer`.`cAlamat1`, `tbCustomer`.`ctelp`, `tbCustomer`.`cEmail`, `tbCustomer`.`cKota`
			FROM `tbCustomer`, `gx_cabang`, `gx_voip_customer`
			WHERE `tbCustomer`.`id_cabang` = `gx_cabang`.`id_cabang`
			AND `tbCustomer`.`cKode` = `gx_voip_customer`.`customer_number`
			AND `gx_voip_customer`.`voip_number` = '".$row_invoice["useralias"]."';", $conn);
$row_cust = mysql_fetch_array($sql_cust);

$html = '<style type="text/css">
<!--
.inv1 {
	font-family: Verdana;
	font-size: x-small;
	font-weight: bold;
	color: #666666;
}
.inv2 {
	font-family: Verdana;
	font-size: small;
}
.inv3 {
	font-family: Verdana;
	font-weight: bold;
	font-size: small;
}
-->
</style>


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="75%"><img src="'.URL.'pdf/logo-inv.png" height="45"></td>
        <td width="25%"><table width="248" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="119"><span class="inv1">powered by IPHONE</span> </td>
              <td width="119"><div align="left"><img src="'.URL.'pdf/logo-indosat.png"></div></td>
              <td width="10">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td background="bg-line.png"  >&nbsp;</td>
        </tr>
      </table>      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" valign="top">
          <span class="inv2">From</span><br>
          <span class="inv3">'.$row_cust["nama_cabang"].'</span><br>
          <span class="inv2">'.$row_cust["alamat_cabang"].'<br>
                Phone: '.$row_cust["telp_cabang"].'<br/>
                Email: '.$row_cust["email_cabang"].'
          </span></td>
          <td width="34%" valign="top">            <span class="inv2">To</span><br>
            <span class="inv3">'.$row_cust['cNama'].'</span><br>
            <span class="inv2">'.$row_cust['cAlamat1'].'<br>
            '.$row_cust['cKota'].'<br>
            Phone: '.$row_cust['ctelp'].'<br>
          Email: '.$row_cust['cEmail'].' </span></td>
          <td width="36%" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="28%" valign="top" class="inv3">Invoice Number<br>
                Date <br>
                Payment Due<br>
                Account</td>
              <td width="72%" class="inv2">
                '.$row_invoice["reference"].'<br>
		'.date("d-m-Y", strtotime($row_invoice["date"])).'<br>
                '.date("d-m-Y", strtotime($row_invoice["date"])).'<br>
                '.$row_invoice["firstname"].' '.$row_invoice["lastname"].'('.$row_invoice["username"].')<br>
              </td>
            </tr>
          </table></td>
        </tr>
      </table>      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
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

$query_invoice_item	= "SELECT * FROM `cc_invoice_item` WHERE `id_invoice` ='".$id_invoice."';";
$sql_invoice_item	= mysql_query($query_invoice_item, $conn_voip);

$no = 1;
$total_price = 0;
$total_vat = 0;
$total_price_vat = 0;

while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
{

    $html .='<tr>
    <td>'.$no.'.</td>
    <td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
    <td>'.$row_invoice_item["description"].'</td>
    <td>'.$row_invoice_item["price"].'</td>
    </tr>';
    $no++;
    $total_price = $total_price + $row_invoice_item["price"];
    $total_vat = $total_vat + $row_invoice_item["VAT"];
    $total_price_vat = $total_price_vat + ($row_invoice_item["price"] + $row_invoice_item["VAT"]);
    
}

$html .='</table>      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="80%">
            <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="500px" height="25" bgcolor="#DADADA" class="inv3">&nbsp;Note</td>
                </tr>
              <tr>
                <td  width="500px" height="60" bgcolor="#CCCCCC" class="inv3">
                  <p>'.$row_invoice["description"].'</p></td>
                </tr>
              
            </table>
          </td>
          <td width="20%">
            <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="33%" height="25" bgcolor="#DADADA" class="inv3">&nbsp;Subtotal</td>
                <td width="67%" bgcolor="#DADADA">'.Rupiah($total_price).'</td>
              </tr>
              <tr>
                <td height="25" class="inv3">&nbsp;Tax (10%)</td>
                <td>&nbsp;'.Rupiah($total_vat).'</td>
              </tr>
              <tr>
                <td height="25" bgcolor="#DADADA" class="inv3">&nbsp;Total</td>
                <td bgcolor="#DADADA">&nbsp;<span class="inv3">'.Rupiah($total_price_vat).'</span></td>
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
    <td width="281" align="right"><font style="font-size:13px;">Prepared By :</font></td>
    <td width="202" align="left"><font style="font-size:13px; padding-left:15px"></font></td>
    <td rowspan="2"><font style="font-size:13px;">Tanggal Cetak: '.date("d F Y H:i:s").'<br />
    Printed: </font></td>
  </tr>
  <tr>
    <td align="right" valign="top"><font style="font-size:13px;">Printed By :</font></td>
    <td align="left" valign="top"><font style="font-size:13px; padding-left:15px">( '.$_SERVER['REMOTE_ADDR'].' )</font></td>

  </tr>
</table>
</div>';
//==============================================================
//==============================================================
//==============================================================
include('../../pdf/mpdf.php');

$mpdf=new mPDF('c','A4','','',5,5,5,5,0,0); 

$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage','two');

// LOAD a stylesheet
/*$stylesheet = file_get_contents('http://192.168.182.10/software/beta/css/bootstrap.min.css');

$mpdf->WriteHTML($stylesheet4,1);*/
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
}
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>