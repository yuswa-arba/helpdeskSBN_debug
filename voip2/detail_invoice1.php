<?php

include ("../config/configuration_user.php");


if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
    
$sql_cust = mysql_query("SELECT `tbCustomer`.* FROM `tbCustomer`
			     WHERE `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_cust = mysql_fetch_array($sql_cust);
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Detail Invoice");
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
          <td width="30%" valign="top"><span class="inv2">From</span><br>
            <span class="inv3">GlobalXtreme Malang</span><br>
            <span class="inv2">Ruko Istana Dinoyo E4-E5<br>
            Jl. MT Haryono 1A, Malang<br>
            Phone: (0341) 573 222<br>
          Email: info@globalxtreme.net </span></td>
          <td width="34%" valign="top">            <span class="inv2">To</span><br>
            <span class="inv3">'.$row_cust['cNama'].'</span><br>
            <span class="inv2">'.$row_cust['cAlamat1'].'<br>
            '.$row_cust['cKota'].'<br>
            Phone: '.$row_cust['ctelp'].'<br>
          Email: '.$row_cust['cEmail'].' </span></td>
          <td width="36%" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="28%" valign="top" class="inv3">Invoice <br>
                Date <br>
                Order ID<br>
                Payment Due<br>
                Account</td>
              <td width="72%" class="inv2">#007612<br>
                2/10/2014<br>
                4F3S8J<br>
                2/22/2014<br>
                968-34567</td>
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
      <table width="100%" height="500x" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="7%" height="28" bgcolor="#DADADA" class="inv3">&nbsp;Code</td>
          <td width="29%" bgcolor="#DADADA" class="inv3">&nbsp;Product</td>
          <td width="8%" bgcolor="#DADADA" class="inv3">&nbsp;Qty</td>
          <td width="33%" bgcolor="#DADADA" class="inv3">&nbsp;Description          </td>
          <td width="23%" bgcolor="#DADADA" class="inv3">&nbsp;Price</td>
        </tr>
        
        <tr>
          <td height="30" valign="bottom" class="inv2">&nbsp;VM101</td>
          <td valign="bottom" class="inv2">&nbsp;VoIP Abonnement </td>
          <td valign="bottom" class="inv2">&nbsp;1</td>
          <td valign="bottom" class="inv2">&nbsp;Periode Agustus 2014</td>
          <td valign="bottom" class="inv2">&nbsp;Rp. 60.000</td>
        </tr>
      </table>      
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
                <td width="67%" bgcolor="#DADADA">&nbsp;Rp.60.000</td>
              </tr>
              <tr>
                <td height="25" class="inv3">&nbsp;Discount</td>
                <td>&nbsp;0</td>
              </tr>
              <tr>
                <td height="25" bgcolor="#DADADA" class="inv3">&nbsp;Total</td>
                <td bgcolor="#DADADA">&nbsp;<span class="inv3">Rp. 60.000</span></td>
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
include('../pdf/mpdf.php');

$mpdf=new mPDF('c','A4','','',5,5,5,5,0,0); 

$mpdf->mirrorMargins = 0;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)

$mpdf->SetDisplayMode('fullpage','two');

// LOAD a stylesheet
/*$stylesheet = file_get_contents('http://192.168.182.10/software/beta/css/bootstrap.min.css');

$mpdf->WriteHTML($stylesheet4,1);*/
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
//==============================================================
//==============================================================
}
    } else{
	header("location: ".URL."logout.php");
    }

?>