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
   
    $id_spk_aktivasi_konversi	        = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $sql_spk_aktivasi_konversi	= mysql_query("SELECT * FROM `gx_spk_aktivasi_konversi` WHERE  `gx_spk_aktivasi_konversi`.`id_spk_aktivasi_konversi` = '$id_spk_aktivasi_konversi'", $conn);
    
    /*$sql_spk	= mysql_query("SELECT `id_spkpasang`, `kode_spk`, `tanggal`, `id_customer`, `nama_customer`, `id_cabang`, `nama_cabang`, `id_linkbudget`, `paket_koneksi`, `nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `nama_marketing`, `id_teknisi`, `nama_teknisi`, `pekerjaan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_spk_pasang` WHERE
     `gx_spk`.`id_trouble_ticket` = `gx_complaint`.`ticket_number`
                                      AND `gx_spk`.`id_teknisi` = `user_details`.`id_user`
                                      AND `gx_spk`.`id_spk` = '$id_spk';");*/
    $row_spk        = mysql_fetch_array($sql_spk_aktivasi_konversi);
    $sql_teknisi    = mysql_query("SELECT `gx_pegawai`.*
				      FROM `gx_pegawai`
                                      WHERE `gx_pegawai`.`id_employee` = '$row_spk[id_teknisi]';", $conn);
    $row_teknisi    = mysql_fetch_array($sql_teknisi);
    $sql_marketing    = mysql_query("SELECT `gx_pegawai`.*
				      FROM `gx_pegawai`
                                      WHERE `gx_pegawai`.`id_employee` = '$row_spk[id_marketing]';", $conn);
    $row_marketing    = mysql_fetch_array($sql_marketing);
    $pisah_tanggal_jam = explode(" ",$row_spk['date_add']);
    $pisah_tanggal = explode("-",$pisah_tanggal_jam[0]);
    $str_pisah_tanggal = array($pisah_tanggal['2'],$pisah_tanggal['1'],$pisah_tanggal['0']);
    $tanggal = implode("/",$str_pisah_tanggal);



$html = '<div style="top:0;margin-bottom:20px;">
<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">

  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="221" ><img src="http://globalxtreme.net/malang/images/yootheme/logo.png" width="221" height="51"></td>
        <td width="579" align="center">
            <b>SURAT PERINTAH KERJA <br />
            AKTIVASI KONVERSI</b>
        
        </td>
      </tr>
      <tr>
        
        <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="168" height="5" valign="top">Date</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$tanggal.'</strong></td>
            <td width="180" height="5" valign="top">Maintenance Number</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$row_spk["kode_spk_aktivasi_konversi"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Customer Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["kode_customer"].'</strong></td>
            <td height="5" valign="top">Technician</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_teknisi["nama"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">User ID</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["uid"].'</strong></td>
            <td height="5" valign="top">Customer Name</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["nama_customer"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Connection Type</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["nama_paket"].'</strong></td>
            <td height="5" valign="top">Phone Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["telp"].'</strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="800" align="center" cellpadding="0" cellspacing="0" style="padding-left: 50px;padding-top: 20px;">
         <tr>
            <td width="150" valign="top">Address</td>
            <td width="10" valign="top">:</td>
            <td width="638" valign="top"><strong>'.$row_spk["alamat"].'</strong></td>
          </tr>
          <tr>
            <td valign="top">Complaint</td>
            <td valign="top">:</td>
            <td valign="top"><strong> Aktivasi Konversi </strong></td>
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
            <td align="center"><h5>'.$row_marketing["nama"].'</h5></td>
            <td align="center"><h5>'.$row_teknisi["nama"].'</h5></td>
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
        <td width="221" ><img src="http://globalxtreme.net/malang/images/yootheme/logo.png" width="221" height="51"></td>
        <td width="579" align="center">
            <b>SURAT PERINTAH KERJA <br />
            AKTIVASI KONVERSI</b>
        
        </td>
      </tr>
      <tr>
        
        <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="168" height="5" valign="top">Date</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$tanggal.'</strong></td>
            <td width="180" height="5" valign="top">Maintenance Number</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$row_spk["kode_spk_aktivasi_konversi"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Customer Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["kode_customer"].'</strong></td>
            <td height="5" valign="top">Technician</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_teknisi["nama"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">User ID</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["uid"].'</strong></td>
            <td height="5" valign="top">Customer Name</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["nama_customer"].'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Connection Type</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["nama_paket"].'</strong></td>
            <td height="5" valign="top">Phone Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$row_spk["telp"].'</strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><table width="800" align="center" cellpadding="0" cellspacing="0" style="padding-left: 50px;padding-top: 20px;">
         <tr>
            <td width="150" valign="top">Address</td>
            <td width="10" valign="top">:</td>
            <td width="638" valign="top"><strong>'.$row_spk["alamat"].'</strong></td>
          </tr>
          <tr>
            <td valign="top">Complaint</td>
            <td valign="top">:</td>
            <td valign="top"><strong> Aktivasi Konversi </strong></td>
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
            <td align="center"><h5>'.$row_marketing["nama"].'</h5></td>
            <td align="center"><h5>'.$row_teknisi["nama"].'</h5></td>
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