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
   
    $id_penawaran	        = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
    $sql_penawaran	= mysql_query("SELECT * FROM `gx_penawaran` WHERE  `gx_penawaran`.`id_penawaran` = '$id_penawaran'", $conn);
    $row_penawaran        = mysql_fetch_array($sql_penawaran);

$html = '<div style="top:0;margin-bottom:20px;">
<table width="860" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#333333">

  <tr>
    <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="271" ><img src="../../img/logo_pdf.png" width="271" height="51"></td>
        <td width="529" align="left">
            <b>Customer Service GlobalXtreme</b> <br />
            Call Center : 0341-736811 <br />
            SMS Gateway : 085 637 329 48 <br />
            Email : customer.service@globalxtreme.net <br />
            Instant Payment : https://globalxtreme.net/new/payment/ <br />
            <a href="www.globalxtreme.net">www.globalxtreme.net</a>
        </td>
      </tr>
      <tr>
        
        <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="168" height="5" valign="top">Cabang</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top">'.$row_penawaran["nama_cabang"].'</td>
            <td width="180" height="5" valign="top">Tanggal</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top">'.$row_penawaran["tanggal"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">No Penawaran</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["kode_penawaran"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Nama Pelanggan</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["nama_customer"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Nama Perusahaan</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["nama_perusahaan"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Alamat</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["alamat"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Kota</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["kota"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Contact Person</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["contact_person"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Telp</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["no_telp"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">HP</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["no_hp1"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Email</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["email"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Perihal</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><strong>Penawaran</strong></td>
          </tr>
          <tr>
            <td height="5" valign="top">Masa Berlaku</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["jangka_waktu_penawaran"].' Hari</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">
										<table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td><b>Barang<b></td>
					    </tr>
					    <tr>
						<td>
					    <table width="100%" cellspacing="10" border="1" cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th width="1%">
								  No.
							      </th>
								   <th width="15%">
								  Kode
							      </th>
							      <th width="15%">
								  Keterangan
							      </th>
							      <th width="25%">
								  Quantity
							      </th>
							      <th width="20%">
								  Price
							      </th>
								  <th width="20%">
								  Amount
							      </th>
								 ';
if(isset($_GET["id"]))
{
    $kode_penawaran			 = $row_penawaran["kode_penawaran"];
    $query_penawaran_item	 = "SELECT * FROM `gx_penawaran_detail` WHERE `kode_penawaran` ='".$kode_penawaran."' AND `level` = '0';";
    $sql_penawaran_item	     = mysql_query($query_penawaran_item, $conn);
    $id_detail_penawaran 	 = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_penawaran_detail  = "SELECT * FROM `gx_penawaran_detail` WHERE `kode_penawaran` ='".$kode_penawaran."' AND `level` = '0' AND `id_penawaran_detail` = '".$id_detail_penawaran."' LIMIT 0,1;";
    //echo $query_penawaran_item;
	$sql_penawaran_detail   = mysql_query($query_penawaran_detail, $conn);
    $row_penawaran_detail 	= mysql_fetch_array($sql_penawaran_detail);
    $no = 1;
	$total_amount = 0;
    while($row_penawaran_item = mysql_fetch_array($sql_penawaran_item))
    {
    
	$html .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_penawaran_item["kode"].'</td>
	<td>'.$row_penawaran_item["keterangan"].'</td>
	<td align="right">'.$row_penawaran_item["quantity"].'</td>
	<td align="right">'.number_format($row_penawaran_item["price"], 2, ',', '.').'</td>
	<td align="right">'.number_format($row_penawaran_item["amount"], 2, ',', '.').'</td>
	</tr>
	';
	$no++;
	$total_amount = $total_amount + $row_penawaran_item["amount"];
	}
}else{
	
    $total_price = 0;
    $html .='<tr><td colspan="6">&nbsp;</td></tr>';
}

	

$html .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td align="right" colspan="4">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
									'.number_format($total_amount, 2, ',', '.').'
							    </td>
								
							   
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
                        <tr>
        
        <td width="700" colspan="2"> <br /><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
         
          <tr>
            <td height="5" valign="top">Jasa</td>
            <td valign="top">:</td>
            <td valign="top">'.$row_penawaran["jasa"].'</td>
          </tr>
          <tr>
            <td width="168" height="5" valign="top">Nama Paket</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top">'.$row_penawaran["nama_paket"].'</td>
            <td width="180" height="5" valign="top">Setup Fee</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top">'.$row_penawaran["setup_fee"].'</td>
          </tr>
          <tr>
            <td width="168" height="5" valign="top">Abonement</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top">'.$row_penawaran["abonemen"].'</td>
            <td width="180" height="5" valign="top">monthly Fee</td>
            <td width="10" valign="top">:</td>
            <td width="275" valign="top">'.$row_penawaran["monthly_fee"].'</td>
          </tr>
          <tr>
            <td height="5" valign="top">Keterangan</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">'.$row_penawaran["keterangan"].'</td>
          </tr>
        </table></td>
      </tr>
					</tbody></table>
					</td>
      </tr>
      <tr>
        <td height="29" colspan="2"><div align="center"><font></font></div></td>
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

//echo $html;
//==============================================================
//==============================================================
//==============================================================


//}
?>