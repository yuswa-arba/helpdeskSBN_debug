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
   
    $id    = isset($_GET['id']) ? (int)$_GET['id'] : "";
    
$html = '<style>@page {
     margin: 20px 10px;
     padding:10px;
    }</style><div style="width:900px;">';

    $sql_data = mysql_query("SELECT * FROM `gx_cetak_barcode`
			       WHERE `id_cetak` = '".$id."' LIMIT 0,1;", $conn);
    $row_data = mysql_fetch_array($sql_data);
    
    for($data=1; $data<=$row_data["qty"]; $data++){
	$no_sebelumnya = $row_data["no_sebelumnya"] + $data;
        $barcode = URL_ADMIN.'administrasi/barcodegen/barcode.php?text='.strtoupper($row_data["barcode"]).date("ymd", strtotime($row_data["date_add"])).sprintf("%05d", $no_sebelumnya);
        
        $html .='<div style="float:left; margin-left:10px;border:1px solid #000;padding:10px;width:210px;"><img style="border:0;" src="'.$barcode.'" alt="barcode" /></div>';
        if($data % 3){
            $html .='';
        }else{
            $html .='<br style="clear:both;">';
        }
    }
$html .= '</div>';
//echo $html;

//Virtual Account
//'.trim($row_customer["nameVirtual"])trim($row_customer["accountVirtual"])trim($row_customer["namaBank"]).'

//==============================================================
//==============================================================
//==============================================================

include_once("../../pdf/mpdf.php");
$mpdf=new mPDF('s');
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetTitle("Barcode");

$mpdf->WriteHTML($html); // Separate Paragraphs defined by font

$mpdf->Output();
exit;


//==============================================================
//==============================================================
//==============================================================


//}
?>