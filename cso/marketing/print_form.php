<?php
// Include the main TCPDF library (search for installation path).
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Print Formulir");
    global $conn;
    
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
	
require_once ('../../js/tcpdf/examples/tcpdf_include.php');
require_once ('../../js/fpdf/fpdf.php');
require_once('../../js/fpdi/fpdi.php');

$sql_cetak_formulir = mysql_query("SELECT * FROM `gx_cetak_formulir` WHERE `level` = '0' AND `id_cetak_formulir` = '".$id_data."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_cetak_formulir = mysql_fetch_array($sql_cetak_formulir);
$kode       = $row_cetak_formulir["kode_cetak_formulir"];
$sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '".$row_cetak_formulir["id_formulir"]."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);
$date = date("d/m/Y h:i");
$file   = "../admin/".$row_masterformulir_detail["lokasi_file"]."".$row_masterformulir_detail["nama_file"];
$hal    = $row_masterformulir_detail["jumlah_halaman"] + 1;

$pdf = new FPDI(); //FPDI extends TCPDF
//$pdf->AddPage();
$pages = $pdf->setSourceFile( "../$file" );
//$page = $pdf->ImportPage(1);
//$pdf->useTemplate( $page, 0, 0 );
//
//$pdf->SetFont('freesans', 'B', 12);
//$pdf->SetTextColor(0);
//$pdf->SetXY(5, PDF_MARGIN_RIGHT);
////$pdf->Cell(0, 30, 'TCPDF and FPDI');
//$pdf->Cell(150);
//$pdf->Cell(0,10, 'SCF-010101010101010');

for ($i = 1; $i < $hal; $i++)
{
    
    $pdf->AddPage();
    $page = $pdf->ImportPage($i);
    $pdf->useTemplate( $page, 0, 0 );
    
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->SetTextColor(0);
    $pdf->SetXY(3, PDF_MARGIN_RIGHT);
    //$pdf->Cell(0, 30, 'TCPDF and FPDI');
    $pdf->Cell(165);
    $pdf->Cell(1,5, " $kode");
	
	$pdf->SetFont('Helvetica', 'B', 8);
	
    $pdf->SetXY(3, PDF_MARGIN_RIGHT);
	$pdf->Cell(160);
    $pdf->Cell(1,13, "$loggedin[username] $date ");
}


$pdf->Output( ''.$kode.'.pdf', 'I' );

}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>