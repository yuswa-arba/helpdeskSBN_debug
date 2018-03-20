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
function generate_pdf($po=""){
    
    global $conn;
    
    $po 	= ($po == "") ? "" : trim($po);
    //$po         = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : "";
    $query_data = "SELECT * FROM `gx_order_beli` WHERE `kode_order_beli` = '".$po."' AND `level` = '0' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
    $query_supplier = "SELECT * FROM `gx_supplier` WHERE `kode_supplier` = '".$row_data["kode_supplier"]."' LIMIT 0,1;";
    $sql_supplier   = mysql_query($query_supplier, $conn);
    $row_supplier   = mysql_fetch_array($sql_supplier);
    
    $query_shipping = "SELECT * FROM `gx_shipping` WHERE `kode_shipping` = '".$row_data["kode_shipping"]."' LIMIT 0,1;";
    $sql_shipping   = mysql_query($query_shipping, $conn);
    $row_shipping   = mysql_fetch_array($sql_shipping);
    
$html = '<div style="top:0;margin-bottom:20px;">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000">
  <tr><td>
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="300" ><img src="'.URL.'img/logo_pdf.png" width="300"></td>
            <td width="600" align="center"><b>PURCHASE ORDER</b></td>
            
        </tr>
    </table><hr>
  </td></tr>
  <tr><td width="900" colspan="2">
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>
        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>Nama Supplier</td>
            <td>'.$row_supplier["nama_supplier"].'</td>
          </tr>
          <tr>
            <td valign="top">Alamat</td>
            <td>'.$row_supplier["alamat"].'</td>
          </tr>
          <tr>
            <td>Kota</td>
            <td>'.$row_supplier["kota"].'</td>
          </tr>
          <tr>
            <td>Telp</td>
            <td>'.$row_supplier["no_telpon"].'</td>
          </tr>
          <tr>
            <td valign="top">Contact</td>
            <td>'.$row_supplier["contact_person"].'</td>
          </tr>
        </table></td>
        <td valign="top">
        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top">No Purchase Order</td>
            <td valign="top">'.$row_data["kode_order_beli"].'</td>
          </tr>
          <tr>
            <td valign="top">Date</td>
            <td valign="top">'.$row_data["tanggal"].'</td>
          </tr>
          <tr>
            <td>Term of Payment</td>
            <td>'.$row_data["term_payment"].'</td>
          </tr>
          <tr>
            <td>Term of Delivery</td>
            <td>'.$row_data["estimasi"].'</td>
          </tr>
        </table></td>
      </tr>
      </table>
    </td>
      </tr>
      
    </table>
    <div style="font-size:11px;">
<span>Shipping By: </span>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:11px;">
      <tr>
        <td>
        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="30%">Nama</td>
            <td width="70%">: '.$row_shipping["nama_shipping"].'</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>: '.$row_shipping["alamat"].'</td>
          </tr>
          <tr>
            <td>Kota</td>
            <td>: '.$row_shipping["kota"].'</td>
          </tr>
          <tr>
            <td>Telp</td>
            <td>: '.$row_shipping["no_telpon"].'</td>
          </tr>
        </table></td>
        <td> <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table><br>
    
    <span>Shipping Mark:</span>
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr>
            <td style="height:80px;">'.$row_data["shipping_remark"].'</td>
        </tr>
    </table>
</div>
    <table width="900" border="0" style="border:1px solid #000;font-size:10px;" cellpadding="0" cellspacing="0">
        <tr align="center">
            <td style="border-bottom:1px solid #000;">No</td>
            <td style="border-bottom:1px solid #000;">Description</td>
            <td style="border-bottom:1px solid #000;">Quantity</td>
            <td style="border-bottom:1px solid #000;">Unit</td>
            <td style="border-bottom:1px solid #000;">Price</td>
            <td style="border-bottom:1px solid #000;">Amount</td>
        </tr>';
$query_item	= "SELECT * FROM `gx_setuju_pembelian_detail` WHERE `kode_setuju_pembelian` ='".$row_data["kode_setuju_pembelian"]."';";
$sql_item	= mysql_query($query_item, $conn);

$no = 1;
$total_price = 0;

while($row_item = mysql_fetch_array($sql_item))
{
    $total	= ($row_item["qty"] * $row_item["harga"]);
    $html .='<tr>
    <td>'.$no.'</td>
    <td>'.$row_item["nama_barang"].'</td>
    <td>'.$row_item["qty"].'</td>
    <td>pcs</td>
    <td>'.number_format($row_item["harga"], 2, ',', '.').'</td>
    <td>'.number_format($total, 2, ',', '.').'</td>
    </tr>';
    $no++;
    $total_price = $total_price + $total;
    //<td><a href="form_periksabeli_detail?c='.$row_periksabeli_item["kode_periksa_pembelian"].'&id='.$row_periksabeli_item["id_periksa_pembelian_detail"].'"><span class="label label-info">Edit</span></a></td>
}

$html .='<tr>
            <td colspan="5" align="center">TOTAL</td>
            <td  align="left">'.number_format($total_price, 2, ',', '.').'</td>
        </tr>
        <tr>
            <td colspan="5" align="center">PPN 10%</td>
            <td  align="left">0</td>
        </tr>
        <tr>
            <td colspan="5" align="center">GRAND TOTAL</td>
            <td  align="left">'.number_format($total_price, 2, ',', '.').'</td>
        </tr>
        <tr>
            <td colspan="5" align="center">UANG MUKA</td>
            <td  align="left">0</td>
        </tr>
        <tr>
            <td colspan="5" align="center">SISA PEMBAYARAN</td>
            <td  align="left">'.number_format($total_price, 2, ',', '.').'</td>
        </tr>
    </table>
</div>

<div style="font-size:11px;">
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:11px;">
      <tr>
        <td><table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td>
        <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" style="text-align:center;">Authorized Signature</td>
            
          </tr>
          <tr>
            <td>&nbsp;</td>
            
          </tr>
          <tr>
            <td>&nbsp;</td>
            
          </tr>
          <tr>
            <td>&nbsp;</td>
            
          </tr>
          <tr>
            <td style="text-align:center;">PM</td>
            
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
$mpdf->SetTitle("Purchase Order");

$mpdf->WriteHTML($html); // Separate Paragraphs defined by font
$mpdf->Output('../upload/po/PO_'.$po.'.pdf','F');
//$mpdf->Output();

}
?>