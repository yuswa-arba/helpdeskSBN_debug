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
    /*
    $sql_d = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_off_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_off_connection` ";
    */
    $sql_d = "SELECT `id`, `kode_spk_maintance`, `tanggal`, `kode_cabang`, `cabang`, `user_id`, `kode_customer`, `nama_customer`, `no_inactive`, `no_off_connection`, `telp`, `kode_teknisi`, `teknisi`, `alamat`, `pekerjaan`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_spk_maintance` WHERE `kode_spk_maintance`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    $date = $data_d['tanggal'];
    $maintenance_number = 'MTN-'.rand(0000000,9999999); //$data_d['']
    $customer_number = $data_d['kode_customer'];
    $technicians = $data_d['teknisi'];
    $user_id = $data_d['user_id'];
    $customer_name = $data_d['nama_customer'];
    $connection_type = '-';
    $phone_number = $data_d['telp'];
    $address = $data_d['alamat'];
    $complaint = '';
    $solution = '';
    $status = '';
    
    $nama_marketing = '';
    $nama_teknisi = '';
    $nama_customer = '';
    
   
   
   
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
            <td width="168" height="5" valign="top">Date</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$date.'</strong></td>
            <td width="180" height="5" valign="top">Maintenance Number</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top"><strong>'.$maintenance_number.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Customer Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$customer_number.'</strong></td>
            <td height="5" valign="top">Technicians</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$technicians.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">User ID</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$user_id.'</strong></td>
            <td height="5" valign="top">Customer Name</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$customer_name.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Connection Type</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$connection_type.'</strong></td>
            <td height="5" valign="top">Phone Number</td>
            <td valign="top">:</td>
            <td valign="top"><strong>'.$phone_number.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Address</td>
            <td valign="top">:</td>
            <td valign="top" colspan="4"><strong>'.$address.'</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Complaint</td>
            <td valign="top">:</td>
            <td valign="top" colspan="4"><strong>'.$complaint.'</strong></td>
        </tr>
          <tr>
            <td height="5" valign="top">Solution</td>
            <td valign="top">:</td>
            <td valign="top" colspan="4"><strong>'.$solution.'</strong></td>
        </tr>
          <tr>
            <td height="5" valign="top">Status</td>
            <td valign="top">:</td>
            <td valign="top" colspan="4"><strong>'.$status.'</strong></td>
        </tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr><td colspan="6"><br/></td></tr>
          <tr><td colspan="6"><br/></td></tr>
         
            <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <!--          <tr>
            <td valign="top" colspan="6">
            <table width="100%"><tr><td width="33.3%">Ordered By</td>
            <td width="33.3%">Technicians</td>
            <td width="33.3%">Customer</td></tr></table>
            </td>
          </tr>-->
          
          <tr>
            <td valign="top" colspan="2">Ordered By</td>
            <td valign="top" colspan="1">Technicians</td>
            <td valign="top" colspan="1">Customer</td>
            <td valign="top" colspan="2">&nbsp;</td>
            
          </tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
          <tr><td colspan="6">&nbsp;</td></tr>
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