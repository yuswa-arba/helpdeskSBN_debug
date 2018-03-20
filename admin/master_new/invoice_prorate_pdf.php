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
 */
include ("../../config/configuration_admin.php");

    global $conn;
   
    $id_invoice_prorate        = isset($_GET['id_invoice_prorate']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_invoice_prorate']))) : "";
    $sql_ip	= mysql_query("SELECT * FROM `gx_invoice_prorate`, `gx_paket2`, `tbCustomer`
			    WHERE `gx_invoice_prorate`.`id_paket`=`gx_paket2`.`id_paket` AND `gx_invoice_prorate`.`kode_customer`=`tbCustomer`.`idCustomer` AND `gx_invoice_prorate`.`level` = '0'
			    ORDER BY  `gx_invoice_prorate`.`date_add` DESC", $conn);
    
    
    $row_ip        = mysql_fetch_array($sql_ip);
    
    $pisah_tanggal_jam = explode(" ",$row_ip['tanggal_tagihan']);
    $pisah_tanggal = explode("-",$pisah_tanggal_jam[0]);
    $str_pisah_tanggal = array($pisah_tanggal['2'],$pisah_tanggal['1'],$pisah_tanggal['0']);
    $tanggal = implode("/",$str_pisah_tanggal);
    
    
/*
 SELECT `idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`, `cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`, `cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`, `cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`, `cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`, `cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cKdProspek`, `cNoKTP`, `cLongi`, `cLati`, `cBulanan`, `cTahunan`, `id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `tbCustomer` WHERE 1
*/
/*
 SELECT `id_paket`, `id_cabang`, `kode_paket`, `nama_paket`, `jenis_paket`, `periode_start`, `periode_end`, `internet_type`, `internet_paket`, `voip`, `video`, `setup_fee`, `abonemen_voip`, `abonemen_video`, `monthly_fee`, `monthly_for`, `maintenance_free`, `acc_piutang`, `acc_um`, `group_rbs`, `account_index`, `bandwith_usage`, `bw_upload`, `bw_download`, `backbone_1`, `backbone_2`, `backbone_3`, `sla_paket`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_paket2` WHERE 1
*/
/*
 SELECT `id_invoice_prorate`, `kode_invoice`, `kode_customer`, `nama_customer`, `id_paket`, `npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`, `tanggal_tagihan`, `tanggal_jatuh_tempo`, `no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `printed_by`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_invoice_prorate` WHERE 1
*/
    
    $nama_pelanggan         = $row_ip['nama_customer'];
    $periode_tagihan        = $row_ip['periode_tagihan'];
    $kode_customer          = $row_ip['kode_customer'];
    $tanggal_tagihan        = $tanggal;
    $no_faktur_pajak        = $row_ip['no_faktur_pajak'];
    $nama_virtual_bca       = $row_ip['nama_virtual_bca'];
    $no_virtual_account_bca = $row_ip['no_virtual_account_bca'];
    $no_invoice             = $row_ip['kode_invoice'];
    $npwp                   = $row_ip['npwp'];
    $tanggal_jatuh_tempo    = $row_ip['tanggal_jatuh_tempo'];
    $nama_virtual_bca       = $row_ip['nama_virtual_bca'];
    
    $new_connection_total   = $row_ip['setup_fee'] + $row_ip['abonemen_voip'] + $row_ip['abonemen_video'] + $row_ip['monthly_fee'];
       
    $new_connection         = $new_connection_total;
    $total                  = $new_connection;
    $ppn                    = $new_connection * 0.1;
    $grand_total            = $total + $ppn;
    $uang_muka              = $row_ip['uang_muka'];
    $sisa                   = $grand_total - $uang_muka;
    $prepared_by            = $row_ip['prepared_by'];
    $printed_by             = $row_ip['printed_by'];


$html = '<div style="top:0;margin-bottom:20px;">
<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">

  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="221" ><img src="http://globalxtreme.net/malang/images/yootheme/logo.png" width="221" height="51"><br />
        PT Internet Madju Abad Millenindo</td>
        <td width="579" align="center">
            <b>Customer Service GlobalXtreme</b><br />
            SMS Gateway : 085 637 329 48<br />
            Email : customer.service@globalxtreme.net<br />
            Instant Payment : https://globalxtreme.net/new/payment/<br />
            www.globalxtreme.net
            
            
            
            
        
        </td>
      </tr>
      <tr>
         <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="168" height="5" valign="top">Nama Pelanggan</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$nama_pelanggan.'</strong></td>
            <td width="180" height="5" valign="top">Periode Tagihan</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$periode_tagihan.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Kode Customer</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$kode_customer.'</strong></td>
            <td height="5" valign="top">Tanggal Tagihan</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$tanggal_tagihan.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">No Invoice</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$no_invoice.'</strong></td>
            <td height="5" valign="top">Tanggal Jatuh Tempo</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$tanggal_jatuh_tempo.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">NPWP</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$npwp.'</strong></td>
            <td height="5" valign="top">No Virtual Account BCA</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$no_virtual_account_bca.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">No Faktur Pajak</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$no_faktur_pajak.'</strong></td>
            <td height="5" valign="top">Nama Virtual BCA</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$nama_virtual_bca.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Note</td>
            <td valign="top">:</td>
            <td valign="top"><strong>Tagihan New Connection</strong></td>
            <td height="5" valign="top">No Virtual Account BCA</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$no_virtual_account_bca.'</strong></td>
          </tr>
          <tr width="100%">
            <td colspan="6" width="100%">
                <table width="100%">
                    <tr><td colspan="2">New Connection</td><td colspan="2">&nbsp;</td><td>Rp</td><td>'.$new_connection.'</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">Total</td><td>Rp</td><td>'.$total.'</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">PPN 10%</td><td>Rp</td><td>'.$ppn.'</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">Grand Total</td><td>Rp</td><td>'.$grand_total.'</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">Uang Muka</td><td>Rp</td><td>'.$uang_muka.'</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">Sisa</td><td>Rp</td><td>'.$sisa.'</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td colspan="2">&nbsp;</td><td colspan="2">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td colspan="2">Prepared by:</td><td colspan="2">&nbsp;</td><td>'.$prepared_by.'</td><td>&nbsp;</td></tr>
                    <tr><td colspan="2">Printed by:</td><td colspan="2">&nbsp;</td><td>'.$printed_by.'</td><td>&nbsp;</td></tr>
                </table>
            </td>
            
          </tr>
        </table></td>
      </tr>
      
      
    </table></td>
  </tr>
</table>
<br />

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