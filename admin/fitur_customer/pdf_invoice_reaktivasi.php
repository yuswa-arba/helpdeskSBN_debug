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
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_invoice_reaktivasi_customer` WHERE `kode_invoice`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    

   $nama_pelanggan			= $data_d['nama_pelanggan'];
   $kode_customer			= $data_d['kode_customer'];
   $periode_tagihan			= $data_d['periode_tagihan'];
   $tanggal_tagihan			= $data_d['tanggal_tagihan'];
   $kode_invoice			= $data_d['kode_invoice'];
   $tanggal_jatuh_tempo			= $data_d['tanggal_jatuh_tempo'];
   $npwp			        = $data_d['npwp'];
   $no_virtual_account_bca		= $data_d['no_virtual_account_bca'];
   $nama_virtual_account		= $data_d['nama_virtual_account'];
   $no_faktur_pajak			= $data_d['no_faktur_pajak'];
   $note			        = $data_d['note'];
   $reaktivasi_invoice			= $data_d['reaktivasi_invoice'];
   $total_invoice			= $data_d['total_invoice'];
   $ppn_invoice			        = $data_d['ppn_invoice'];
   $grand_total_invoice			= $data_d['grand_total_invoice'];
   $uang_muka_invoice			= $data_d['uang_muka_invoice'];
   $sisa_invoice			= $data_d['sisa_invoice'];
   $prepared_by			        = $data_d['prepared_by'];
   $printed_by			        = $data_d['printed_by'];
   
   $date_add			        = $data_d['date_add'];
   $date_upd			        = $data_d['date_upd'];
   $user_add			        = $data_d['user_add'];
   $user_upd			        = $data_d['user_upd'];
	
    

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
            Instant Payment : https://globalxtreme.net/new/payment/ <br>
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
            <td valign="top"><strong>'.$kode_invoice.'</strong></td>
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
            <td valign="top"><strong>Invoice Reactivasi</strong></td>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top"><strong>&nbsp;</strong></td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr><td colspan="6"><br/></td></tr>
          
          <tr>
            <td valign="top">Reactivasi</td>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$reaktivasi_invoice.'</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Total</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$total_invoice.'</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">PPN 10%</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$ppn_invoice.'</td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Grand Total</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$grand_total_invoice.'</td>
            <td valign="top"><div style="font-color:green;"><!--'.$keterangan_grand_total_invoice.'--></div></td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Uang Muka</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$uang_muka_invoice.'</td>
            <td valign="top"><div style="font-color:green;"><!--'.$keterangan_uang_muka_invoice.'--></div></td>
          </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr>
            <td height="5" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">Sisa</td>
            <td height="5" valign="top">Rp.</td>
            <td valign="top">'.$sisa_invoice.'</td>
            <td valign="top"><div style="font-color:green;">'.$keterangan_sisa_invoice.'</div></td>
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