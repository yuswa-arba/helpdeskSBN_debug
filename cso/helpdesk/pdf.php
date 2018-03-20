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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;

enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Detail Invoice");

$id_invoice     = isset($_GET['id']) ? $_GET['id'] : "";
$customer_number= isset($_GET['c']) ? $_GET['c'] : "";
$type		= isset($_GET['type']) ? $_GET['type'] : "";

//data customer
$sql_customer = "SELECT `gx_cabang`.*, `tbCustomer`.* FROM `tbCustomer`, `gx_cabang`, `gxLogin`
                WHERE `gxLogin`.`id_cabang` = `gx_cabang`.`id_cabang`
                AND `gxLogin`.`customer_number` = `tbCustomer`.`cKode`
		AND `gxLogin`.`customer_number` = '".$customer_number."';";
//echo $sql_invoice;
$query_customer  = mysql_query($sql_customer, $conn);
$row_customer    = mysql_fetch_array($query_customer);

//data invoice
$conn_soft = Config::getInstanceSoft();
$sql_invoice = $conn_soft->prepare("SELECT TOP 1 * FROM [4RBSSQL].[dbo].[Bills], [4RBSSQL].[dbo].[Users]
					     WHERE [Bills].[UserIndex] = [Users].[UserIndex]
					     AND [Bills].[BillIndex] = '".$id_invoice."'");

$sql_invoice->execute();
$row_invoice = $sql_invoice->fetch();

$html = '<style type="text/css">
<!--
html{font-size:11px !important;}
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
        <td width="25%"></td>
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
          <span class="inv3">'.$row_customer["nama_cabang"].'</span><br>
          <span class="inv2">'.$row_customer["alamat_cabang"].'<br>
                Phone: '.$row_customer["telp_cabang"].'<br/>
                Email: '.$row_customer["email_cabang"].'
          </span></td>
          <td width="34%" valign="top">            <span class="inv2">To</span><br>
            <span class="inv3">'.$row_customer['cNama'].'</span><br>
            <span class="inv2">'.$row_customer['cAlamat1'].'<br>
            '.$row_customer['cKota'].'<br>
            Phone: '.$row_customer['ctelp'].'<br>
          Email: '.$row_customer['cEmail'].' </span></td>
          <td width="36%" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="28%" valign="top" class="inv3">Invoice Number<br>
                Date <br>
                Payment Due<br>
                Account</td>
              <td width="72%" class="inv2">
                <b>#'.$row_invoice["BillIndex"].'</b><br/>
		<b>'.date("d-m-Y", strtotime($row_invoice["CreateDate"])).'</b><br/>
		<b></b><br/>
		<b>'.$row_customer["cKode"].'</b>
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
          <td width="35%" bgcolor="#DADADA" class="inv3">&nbsp;Product</td>
          <td width="35%" bgcolor="#DADADA" class="inv3">&nbsp;Description</td>
          <td width="20%" bgcolor="#DADADA" class="inv3">&nbsp;Price</td>
        </tr>';

    $conn_soft2 = Config::getInstanceSoft();
     
    $sql_detail_invoice = $conn_soft2->prepare("SELECT * FROM [4RBSSQL].[dbo].[BillsSections]
					    WHERE [BillsSections].[BillIndex] = '".$id_invoice."'");
    
    $sql_detail_invoice->execute();
    //$row_billing_transaksi = $sql_billing_transaksi->fetch();
    $row_detail_invoice = $sql_detail_invoice->fetchAll(PDO::FETCH_ASSOC);
    $no = 1;
    $total = 0;

foreach ($row_detail_invoice as $rows)
{
    
    
    $html .='<tr>
	<td width="10%" height="30" valign="bottom" class="inv2">'.$no.'.</td>
	<td width="35%" valign="bottom" class="inv2">'.typeBillSoft($rows["Type"]).'</td>
	<td width="35%" valign="bottom" class="inv2">'.$rows["Remark"].'</td>
	<td width="20%" valign="bottom" class="inv2">'.AngkaSoft($rows["Charge"]).'</td>
	
	      </tr>';
    //<td>'.number_format(round($total,2), 2).'</td>
    $total = $total + $rows["Charge"];
    $no++;
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
                  <p>&nbsp;</p></td>
                </tr>
              
            </table>
          </td>
          <td width="20%">
            <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="33%" height="25" bgcolor="#DADADA" class="inv3">&nbsp;Subtotal</td>
                <td width="67%" bgcolor="#DADADA">&nbsp;<span class="inv3">'.AngkaSoft($total).'</span></td>
              </tr>
              
              <tr>
                <td height="25" bgcolor="#DADADA" class="inv3">&nbsp;Total</td>
                <td bgcolor="#DADADA">&nbsp;<span class="inv3">'.AngkaSoft($total).'</span></td>
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
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>