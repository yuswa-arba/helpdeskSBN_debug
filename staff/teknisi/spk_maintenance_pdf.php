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

    global $conn;
   
    $id_maintenance	        = isset($_GET['c']) ? $_GET['c'] : "";
    $sql_spk_maintenance	= mysql_query("SELECT * FROM `gx_spk_maintance` WHERE `kode_spk_maintance` = '$id_maintenance'", $conn);
    $row_spk        = mysql_fetch_array($sql_spk_maintenance);
    $sql_customer	= mysql_query("SELECT * FROM `tbCustomer`  WHERE `cKode` = '".$row_spk["kode_customer"]."'", $conn);
    $row_customer        = mysql_fetch_array($sql_customer);
    
$html = '<div style="top:0;margin-bottom:20px;">
<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">

  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="221" ><img src="../../pdf/logo-inv.png" width="221" height="51"></td>
        <td width="579" align="center">
            <b>SURAT PERINTAH KERJA <br />
            MAINTENANCE</b>
        
        </td>
      </tr>
      <tr>
        
        <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="168" height="5" valign="top">Date</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.date("d-m-Y", strtotime($row_spk["tanggal"])).'</strong></td>
            <td width="180" height="5" valign="top">Maintenance Number</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$row_spk["kode_spk_maintance"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Customer Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["kode_customer"].'</strong></td>
            <td height="5" valign="top">Technician</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["teknisi"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">User ID</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["user_id"].'</strong></td>
            <td height="5" valign="top">Customer Name</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["nama_customer"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Connection Type</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_customer["tipe_koneksi"].'</strong></td>
            <td height="5" valign="top">Phone Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_customer["ctelp"].'</strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="800" align="center" cellpadding="0" cellspacing="0" style="padding-left: 50px;padding-top: 20px;">
         <tr>
            <td width="150" valign="top">Address</td>
            <td width="10" valign="top">:</td>
            <td width="638" valign="top"><strong>'.$row_customer["cAlamat1"].'</strong></td>
          </tr>
          <tr>
            <td valign="top">Complaint</td>
            <td valign="top">:</td>
            <td valign="top"><strong> Maintenance </strong></td>
          </tr>
          <tr>
            <td valign="top">Solution</td>
            <td valign="top">:</td>
            <td valign="top"><strong></strong></td>
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
            <td valign="top"><strong></strong></td>
          </tr>
          <tr>
            <td valign="top" colspan=""3>&nbsp;</td>            
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="29" colspan="2"><div align="center"><font>My Signature certifies that work has been completed and that I will not hold Globalxtreme responsible for any damage or loss</font></div></td>
      </tr>
      <tr>
        <td colspan="2"><table width="800" align="center" cellpadding="15px" cellspacing="0" >
          <tr>
            <td width="217px" align="center" height="100px" valign="top"><h5>Ordered By</h5></td>
            <td width="217px" align="center" height="100px" valign="top"><h5>Technician</h5></td>
            <td width="217px" align="center" height="100px" valign="top"><h5>Client</h5></td>
          </tr>
          <tr>
            <td align="center"><h5>'.$row_spk["user_add"].'</h5></td>
            <td align="center"><h5>'.$row_spk["teknisi"].'</h5></td>
            <td align="center"><h5>'.$row_spk["nama_customer"].'</h5></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<hr>
<br />
<br /><table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">

  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="221" ><img src="../../pdf/logo-inv.png" width="221" height="51"></td>
        <td width="579" align="center">
            <b>SURAT PERINTAH KERJA <br />
            MAINTENANCE</b>
        
        </td>
      </tr>
      <tr>
        
        <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="168" height="5" valign="top">Date</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.date("d-m-Y", strtotime($row_spk["tanggal"])).'</strong></td>
            <td width="180" height="5" valign="top">Maintenance Number</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$row_spk["kode_spk_maintance"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Customer Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["kode_customer"].'</strong></td>
            <td height="5" valign="top">Technician</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["teknisi"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">User ID</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["user_id"].'</strong></td>
            <td height="5" valign="top">Customer Name</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["nama_customer"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Connection Type</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_customer["tipe_koneksi"].'</strong></td>
            <td height="5" valign="top">Phone Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_customer["ctelp"].'</strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="800" align="center" cellpadding="0" cellspacing="0" style="padding-left: 50px;padding-top: 20px;">
         <tr>
            <td width="150" valign="top">Address</td>
            <td width="10" valign="top">:</td>
            <td width="638" valign="top"><strong>'.$row_customer["cAlamat1"].'</strong></td>
          </tr>
          <tr>
            <td valign="top">Complaint</td>
            <td valign="top">:</td>
            <td valign="top"><strong> Maintenance </strong></td>
          </tr>
          <tr>
            <td valign="top">Solution</td>
            <td valign="top">:</td>
            <td valign="top"><strong></strong></td>
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
            <td valign="top"><strong></strong></td>
          </tr>
          <tr>
            <td valign="top" colspan=""3>&nbsp;</td>            
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="29" colspan="2"><div align="center"><font>My Signature certifies that work has been completed and that I will not hold Globalxtreme responsible for any damage or loss</font></div></td>
      </tr>
      <tr>
        <td colspan="2"><table width="800" align="center" cellpadding="15px" cellspacing="0" >
          <tr>
            <td width="217px" align="center" height="100px" valign="top"><h5>Ordered By</h5></td>
            <td width="217px" align="center" height="100px" valign="top"><h5>Technician</h5></td>
            <td width="217px" align="center" height="100px" valign="top"><h5>Client</h5></td>
          </tr>
          <tr>
            <td align="center"><h5>'.$row_spk["user_add"].'</h5></td>
            <td align="center"><h5>'.$row_spk["teknisi"].'</h5></td>
            <td align="center"><h5>'.$row_spk["nama_customer"].'</h5></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>


</div>';

//echo $html;

//Virtual Account
//'.trim($row_customer["nameVirtual"])trim($row_customer["accountVirtual"])trim($row_customer["namaBank"]).'

//==============================================================
//==============================================================
//==============================================================

include_once("../../pdf/mpdf.php");
$mpdf=new mPDF('s');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle($invoice_number);
//$mpdf->AddPage('L','','','','',10,10,20,20,10,10);
$mpdf->WriteHTML($html); // Separate Paragraphs defined by font
$nama_file = trim($cust_number)."_".trim($invoice_number);
//$mpdf->Output("invoice/$nama_file.pdf", "F"); SAve File
$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================


//}
?>