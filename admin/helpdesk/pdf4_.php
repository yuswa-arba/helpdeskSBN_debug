<?php
/*
 * Theme Name: Intranet SBN ver. 3.0
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

enableLog("", $loggedin["username"], "$loggedin[id_employee]", "Open PDF SPK");

	$id_spk	= isset($_GET['id_spk']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_spk']))) : "";
    $sql_spk	= mysql_query("SELECT *
				      FROM `gx_helpdesk_spk`
                                      WHERE `gx_helpdesk_spk`.`id_spk` = '".$id_spk."' LIMIT 0,1;", $conn);
    
    $sql_jawabspk	= mysql_query("SELECT `gx_helpdesk_jawabspk`.*
				      FROM `gx_helpdesk_jawabspk`
                                      WHERE `gx_helpdesk_jawabspk`.`id_spk` = '$id_spk';", $conn);
    
    $row_spk    = mysql_fetch_array($sql_spk);
	//echo"<pre>";
	//print_r($row_spk["address"]);
	//echo"</pre>";
	//exit;
    $row_jawabspk	= mysql_fetch_array($sql_jawabspk);
    $sql_employee	= mysql_query("SELECT * FROM `gx_pegawai`
                                      WHERE `gx_pegawai`.`id_employee` = '".$row_spk["id_teknisi"]."';", $conn);
    
    $row_employee	= mysql_fetch_array($sql_employee);
    $sql_cust	= mysql_query("SELECT * FROM `tbCustomer`
                            WHERE `tbCustomer`.`cKode` = '".$row_spk["cust_number"]."';", $conn);
    $row_cust	= mysql_fetch_array($sql_cust);
    $pisah_tanggal_jam = explode(" ",$row_spk['date_add']);
    $pisah_tanggal = explode("-",$pisah_tanggal_jam[0]);
    $str_pisah_tanggal=array($pisah_tanggal['2'],$pisah_tanggal['1'],$pisah_tanggal['0']);
    $tanggal = implode("/",$str_pisah_tanggal);

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

<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">



  <tr>

    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td height="10" colspan="2">&nbsp;</td>

      </tr>

      <tr>

        <td width="221" height="110" valign="top"><img src="../../img/gx-1111000.png"></td>

        <td width="579"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td width="168" height="5" valign="top">SPK Number</td>

            <td width="10" valign="top">:</td>

            <td width="375" valign="top"><strong>'.$row_spk['spk_number'].'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Date</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$tanggal.'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Maintenance By</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_employee['nama'].'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Customer Name</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_spk['name'].'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Phone Number</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_cust['cNoHp1'].'</strong></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td colspan="2"><table width="800" align="center" cellpadding="0" cellspacing="0" style="padding-left: 50px;padding-top: 20px;">

          <tr>

            <td width="150" valign="top">Customer Address</td>

            <td width="10" valign="top">:</td>

            <td width="638" valign="top"><strong>'.$row_spk['address'].'</strong></td>

          </tr>

          <tr>

            <td valign="top">Connection Type</td>

            <td valign="top">:</td>

            <td valign="top">'.$row_cust['cPaket'].'</td>

          </tr>

          <tr>

            <td valign="top">Complaint</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_spk['problem'].'</strong></td>

          </tr>

          <tr>

            <td valign="top">Solution</td>

            <td valign="top">:</td>

            <td valign="top"></td>

          </tr>

          <tr>

            <td valign="top" colspan=""3>&nbsp;</td>            

          </tr>

          <tr>

            <td valign="top" colspan=""3>&nbsp;</td>            

          </tr>

          <tr>

            <td valign="top">Status</td>

            <td valign="top">:</td>

            <td valign="top"></td>

          </tr>

          <tr>

            <td valign="top" colspan=""3>&nbsp;</td>            

          </tr>

        </table></td>

      </tr>

      <tr>

        <td height="29" colspan="2"><div align="center"><font>My Signature certifies that work has been completed and that I will not hold SBN responsible for any damage or loss</font></div></td>

      </tr>

      <tr>

        <td colspan="2"><table width="800" align="center" cellpadding="15px" cellspacing="0" >

          <tr>

            <td width="217px" align="center" height="100px" valign="top"><h5>Ordered By</h5></td>

            <td width="217px" align="center" height="100px" valign="top"><h5>Technician</h5></td>

            <td width="217px" align="center" height="100px" valign="top"><h5>Client</h5></td>

          </tr>

          <tr>

            <td></td>

            <td align="center"><h5>'.$row_employee['nama'].'</h5></td>

            <td align="center"><h5>'.$row_spk['name'].'</h5></td>

          </tr>

        </table></td>

      </tr>

    </table></td>

  </tr>

</table>

<br />

<hr>

<br />

<br />

<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">



  <tr>

    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td height="10" colspan="2">&nbsp;</td>

      </tr>

      <tr>

        <td width="221" height="110" valign="top"><img src="../../img/gx-1111000.png"></td>

        <td width="579"><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td width="168" height="5" valign="top">SPK Number</td>

            <td width="10" valign="top">:</td>

            <td width="375" valign="top"><strong>'.$row_spk['spk_number'].'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Date</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$tanggal.'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Maintenance By</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_employee['nama'].'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Customer Name</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_spk['name'].'</strong></td>

          </tr>

          <tr>

            <td height="5" valign="top">Phone Number</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_cust['cNoHp1'].'</strong></td>

          </tr>


        </table></td>

      </tr>

      <tr>

        <td colspan="2"><table width="800" align="center" cellpadding="0" cellspacing="0" style="padding-left: 50px;padding-top: 20px;">

          <tr>

            <td width="150" valign="top">Customer Address</td>

            <td width="10" valign="top">:</td>

            <td width="638" valign="top"><strong>'.$row_spk['address'].'</strong></td>

          </tr>

          <tr>

            <td valign="top">Connection Type</td>

            <td valign="top">:</td>

            <td valign="top">'.$row_cust['cPaket'].'</td>

          </tr>

          <tr>

            <td valign="top">Complaint</td>

            <td valign="top">:</td>

            <td valign="top"><strong>'.$row_spk['problem'].'</strong></td>

          </tr>

          <tr>

            <td valign="top">Solution</td>

            <td valign="top">:</td>

            <td valign="top"></td>

          </tr>

          <tr>

            <td valign="top" colspan=""3>&nbsp;</td>            

          </tr>

          <tr>

            <td valign="top" colspan=""3>&nbsp;</td>            

          </tr>

          <tr>

            <td valign="top">Status</td>

            <td valign="top">:</td>

            <td valign="top"></td>

          </tr>

          <tr>

            <td valign="top" colspan=""3>&nbsp;</td>            

          </tr>

        </table></td>

      </tr>

      <tr>

        <td height="29" colspan="2"><div align="center"><font>My Signature certifies that work has been completed and that I will not hold SBN responsible for any damage or loss</font></div></td>

      </tr>

      <tr>

        <td colspan="2"><table width="800" align="center" cellpadding="15px" cellspacing="0" >

          <tr>

            <td width="217px" align="center" height="100px" valign="top"><h5>Ordered By</h5></td>

            <td width="217px" align="center" height="100px" valign="top"><h5>Technician</h5></td>

            <td width="217px" align="center" height="100px" valign="top"><h5>Client</h5></td>

          </tr>

          <tr>

            <td></td>

            <td align="center"><h5>'.$row_employee['nama'].'</h5></td>

            <td align="center"><h5>'.$row_spk['name'].'</h5></td>

          </tr>

        </table></td>

      </tr>

    </table></td>

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
//echo $html;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>