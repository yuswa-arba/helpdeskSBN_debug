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
    enableLog("", $loggedin["username"], $loggedin["username"], "Print Surat");
    global $conn;
    
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    
require_once('../administrasi/fpdf/fpdf.php');
require_once('../administrasi/fpdi/fpdi.php');
$sql_cetak_surat = mysql_query("SELECT * FROM `gx_cetak_surat` WHERE `level` = '0' AND `id_cetak_surat` = '".$id_data."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_cetak_surat = mysql_fetch_array($sql_cetak_surat);
$kode       = $row_cetak_surat["kode_cetak_surat"];
$sql_mastersurat_detail = mysql_query("SELECT * FROM `gx_surat_detail` WHERE `level` = '0' AND `kode_surat` = '".$row_cetak_surat["id_surat"]."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_mastersurat_detail = mysql_fetch_array($sql_mastersurat_detail);

$file   = $row_mastersurat_detail["lokasi_file"]."".$row_mastersurat_detail["nama_file"];
$hal    = $row_mastersurat_detail["jumlah_halaman"] + 1;
// initiate FPDI
$pdf = new FPDI();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile("../$file");
$tplidx = $pdf->ImportPage(1);
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(165, 10);
$pdf->Write(0, "$kode");
for ($i = 1; $i < $hal; $i++) { 
    $tplidx = $pdf->ImportPage($i);
    
    $pdf->useTemplate($tplidx);
    $pdf->AddPage();

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(165, 10);
$pdf->Write(0, "$kode");
}

$pdf->Output();

}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>
