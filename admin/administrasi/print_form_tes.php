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
    
require_once('../../js/tcpdf/tcpdf.php');
require_once('../../js/fpdi/fpdi.php');
$sql_cetak_formulir = mysql_query("SELECT * FROM `gx_cetak_formulir` WHERE `level` = '0' AND `id_cetak_formulir` = '".$id_data."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_cetak_formulir = mysql_fetch_array($sql_cetak_formulir);
$kode       = $row_cetak_formulir["kode_cetak_formulir"];
$sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '".$row_cetak_formulir["id_formulir"]."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);

$file   = $row_masterformulir_detail["lokasi_file"]."".$row_masterformulir_detail["nama_file"];
$hal    = $row_masterformulir_detail["jumlah_halaman"] +1;
// initiate FPDI
$pdf = new FPDI();
// add a page
//$pdf->AddPage();
// set the source file
$pdf->setSourceFile("../$file");
//$tplidx = $pdf->ImportPage(1);
//
//$pdf->useTemplate( $tplidx, 0, 0 );
//$pdf->SetFont('Helvetica');
////merah
////$pdf->SetTextColor(255, 0, 0);
//$pdf->SetTextColor(0, 0, 0);
//$pdf->Cell(150);
//// Title
//$pdf->Cell(40,10,$kode);

for ($i = 1; $i < $hal; $i++)
{
	$pdf->AddPage();
    $tplidx = $pdf->ImportPage($i);

    $pdf->useTemplate($tplidx);
	

	// now write some text above the imported page
	$pdf->SetFont('Helvetica', 'B', 14);
	//$pdf->SetTextColor(255, 0, 0);
	$pdf->SetTextColor(0, 0, 0);
	// Move to the right
    $pdf->Cell(150);
    // Title
    $pdf->Cell(20,10,$kode);
	//$pdf->SetXY(150, 10);
	//$pdf->Cell(30,10,$kode); //membuat sebuah cell dengan panjang 40 dan tinggi 10

	//$pdf->Write(0, "$kode");
	if($i == ($hal - 1))
	{
		$pdf->SetXY(100, 265);    // set the cursor at Y position 5
		$pdf->SetFont('Helvetica', 'I', 7);  // set the font
		$pdf->Cell(0,0,'Printed by: '. $sql_masterformulir_detail["user_add"]);
		
		$pdf->SetXY(100, 270);    // set the cursor at Y position 5
		$pdf->SetFont('Helvetica', 'I', 7);  // set the font
		$pdf->Cell(0,0,'Date: '. date("d F Y") );
	}
}

$pdf->Output($kode.'.pdf', 'I');

}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>
