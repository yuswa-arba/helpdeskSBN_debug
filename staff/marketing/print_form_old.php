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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["username"], "Print Formulir");
    global $conn;
    
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    
require_once ('../../js/fpdf/fpdf.php');
require_once('../../js/fpdi/fpdi.php');
$sql_cetak_formulir = mysql_query("SELECT * FROM `gx_cetak_formulir` WHERE `level` = '0' AND `id_cetak_formulir` = '".$id_data."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_cetak_formulir = mysql_fetch_array($sql_cetak_formulir);
$kode       = $row_cetak_formulir["kode_cetak_formulir"];
$sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '".$row_cetak_formulir["id_formulir"]."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
$row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);
$date = date("d/m/Y");
$file   = "../admin/".$row_masterformulir_detail["lokasi_file"]."".$row_masterformulir_detail["nama_file"];
$hal    = $row_masterformulir_detail["jumlah_halaman"] + 1;
// initiate FPDI
$pdf = new FPDI();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile("../$file");
$tplidx = $pdf->ImportPage(1);
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(160, 10);
$pdf->Write(0, "$kode");

$pdf->SetFont('Helvetica');
$pdf->SetFontSize('8');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(155, 15);
$pdf->Write(1, "$loggedin[username] $date ");

for ($i = 1; $i < $hal; $i++) { 
    $tplidx = $pdf->ImportPage($i);
    
    $pdf->useTemplate($tplidx);
    $pdf->AddPage();

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(160, 10);
$pdf->Write(0, "$kode");

$pdf->SetFont('Helvetica');
$pdf->SetFontSize('8');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(155, 15);
$pdf->Write(1, "$loggedin[username] $date ");
}

$pdf->Output();

}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>
