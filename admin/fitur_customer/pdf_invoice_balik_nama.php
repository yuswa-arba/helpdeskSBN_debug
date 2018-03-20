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
   
    $id	                        = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $c                          = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : "";
    /*SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_balik_nama`, `kode_customer`, `nama_lama`, `nama_baru`, `fiber_optic`, `wireless`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_balik_nama` WHERE 1*/
    $sql                        = mysql_query("SELECT * FROM `gx_invoice_balik_nama` WHERE  `kode_invoice`='".$c."' AND `level`='0' ORDER BY `id` DESC LIMIT 0,1", $conn);
    $data_array                 = mysql_fetch_array($sql);
    
    
    /*
    $pisah_tanggal_jam = explode(" ",$row_spk['date_add']);
    $pisah_tanggal = explode("-",$pisah_tanggal_jam[0]);
    $str_pisah_tanggal = array($pisah_tanggal['2'],$pisah_tanggal['1'],$pisah_tanggal['0']);
    $tanggal = implode("/",$str_pisah_tanggal);
    */
    
    $nama_pelanggan = $data_array['nama_pelanggan'];
    $kode_customer = $data_array['kode_customer'];
    $periode_tagihan = $data_array['periode_tagihan'];
    $tanggal_tagihan = $data_array['tanggal_tagihan'];
    $no_invoice = $data_array['kode_invoice'];
    $tanggal_jatuh_tempo = $data_array['tanggal_jatuh_tempo'];
    $npwp = $data_array['npwp'];
    $no_virtual_account_bca = $data_array['no_virtual_account_bca'];
    $no_faktur_pajak = $data_array['no_faktur_pajak'];
    $nama_virtual_account = $data_array['nama_virtual_account'];
    $change_name = $data_array['invoice_change_name'];
    $total = $data_array['invoice_total'];
    $ppn = $data_array['invoice_ppn'];
    $grand_total = $data_array['invoice_grand_total'];
    $uang_muka = $data_array['invoice_uang_muka'];
    $sisa = $data_array['invoice_sisa'];
    $prepared_by = 'Admin globalxtreme.net'; // $data_array['user_upd']
    $printed_by = 'Admin globalxtreme.net'; //$data_array['user_upd']
    
    

$html = '<div style="top:0;margin-bottom:20px;">
<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">

  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="450" ><img src="http://globalxtreme.net/malang/images/yootheme/logo.png" width="221" height="51"></td>
        <td width="450" align="left">
            <b> Customer Service GlobalXtreme </b><br>
            Call Center : 0361-736811 <br>
            SMS Gateway : 085 637 329 48 <br>
            Email : customer.service@globalxtreme.net <br>
            Instant Payment : https://globalxtreme.net/payment/ <br>
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
            <td height="5" valign="top">Nama Virtual Account</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$nama_virtual_account.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Note</td>
            <td valign="top">:</td>
            <td valign="top"><strong>Invoice Change Name</strong></td>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top"><strong>&nbsp;</strong></td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr><td colspan="6"><br/></td></tr>
          
          <tr>
            <td valign="top">Change Name</td>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$change_name.'</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Total</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$total.'</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">PPN 10%</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$ppn.'</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Grand Total</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$grand_total.'</td>
            <td valign="top"><div style="font-color:green;">'.$keterangan_grand_total.'</div></td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Uang Muka</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$uang_muka.'</td>
            <td valign="top"><div style="font-color:green;">'.$keterangan_uang_muka.'</div></td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Sisa</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$sisa.'</td>
            <td valign="top"><div style="font-color:green;">'.$keterangan_sisa.'</div></td>
          </tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top" align="center">Prepared by : </td>
            <td valign="top">'.$prepared_by.'</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top" align="center">Printed by : </td>
            <td valign="top">'.$printed_by.'</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top" align="center" colspan="2">Thank you for your Business</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
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