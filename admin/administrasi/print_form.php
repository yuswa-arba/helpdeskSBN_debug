<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Print Formulir");
    global $conn;
    
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    
require_once('../../js/fpdf/fpdf.php');
require_once('../../js/fpdi/fpdi.php');
$sql_cetak_formulir = mysql_query("SELECT * FROM `gx_cetak_formulir` WHERE `level` = '0' AND `id_cetak_formulir` = '".$id_data."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_cetak_formulir = mysql_fetch_array($sql_cetak_formulir);
$kode       = $row_cetak_formulir["kode_cetak_formulir"];
$sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '".$row_cetak_formulir["id_formulir"]."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);

$file   = $row_masterformulir_detail["lokasi_file"]."".$row_masterformulir_detail["nama_file"];
$hal    = $row_masterformulir_detail["jumlah_halaman"] + 1;
// initiate FPDI
$pdf = new FPDI();
// add a page
//$pdf->AddPage();
// set the source file
$pdf->setSourceFile("../$file");
//$tplidx = $pdf->ImportPage(1);
//$pdf->SetFont('Helvetica');
////merah
////$pdf->SetTextColor(255, 0, 0);
//$pdf->SetTextColor(0, 0, 0);
//$pdf->SetXY(165, 10);
//$pdf->Write(0, "$kode");
for ($i = 1; $i < $hal; $i++)
{
	$pdf->AddPage();
    $tplidx = $pdf->ImportPage($i);
    
    $pdf->useTemplate($tplidx);
    

	// now write some text above the imported page
	$pdf->SetFont('Helvetica');
	//$pdf->SetTextColor(255, 0, 0);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetXY(165, 10);
	$pdf->Write(0, "$kode");
	
		$pdf->SetXY(80, 265);    // set the cursor at Y position 5
		$pdf->SetFont('Helvetica', 'B', 7);  // set the font
		$pdf->Cell(0,0,'Printed by: '. $row_cetak_formulir["user_add"]);
		
		$pdf->SetXY(80, 269);    // set the cursor at Y position 5
		$pdf->SetFont('Helvetica', 'B', 7);  // set the font
		$pdf->Cell(0,0,'Date: '. date("d F Y H:i:s") );
		
		$pdf->SetXY(80, 273);    // set the cursor at Y position 5
		$pdf->SetFont('Helvetica', 'B', 7);  // set the font
		$pdf->Cell(0,0,"$i/".$row_masterformulir_detail["jumlah_halaman"]." halaman ke $i");
	
}

$pdf->Output($kode.'.pdf', 'I');

}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>
