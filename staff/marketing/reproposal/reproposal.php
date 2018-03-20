<?php

// Include the main TCPDF library (search for installation path).
include ("../../../config/configuration_admin.php");
redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["username"], "proposal");
    global $conn;
    
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
	
require_once ('../../../js/tcpdf/examples/tcpdf_include.php');
require_once ('../../../js/fpdf/fpdf.php');
require_once('../../../js/fpdi/fpdi.php');

$query_data1	= "SELECT * FROM `gx_reproposal` WHERE `id_reproposal`='$id_data';";
$sql_data1		= mysql_query($query_data1, $conn);
$row_data1		= mysql_fetch_array($sql_data1);
$query_data2	= "SELECT * FROM `gx_proposal` WHERE `id_proposal`='$row_data1[id_proposal]';";
$sql_data2		= mysql_query($query_data2, $conn);
$row_data2		= mysql_fetch_array($sql_data2);


$hit_print		= $row_data1["print_pdf"] + 1;
$sql_update 	= "UPDATE `gx_reproposal` SET `print_pdf` = '$hit_print' WHERE `id_reproposal` = '$id_data';";        
    
mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");

$nama_marketing= $loggedin["username"];
$date = date("d F Y");

$txt	= 'Prepared for, espicially:';
$pdf = new FPDI(); //FPDI extends TCPDF
//$pdf->AddPage();
$pages = $pdf->setSourceFile( '../img/proposal3pdf' );
//$page = $pdf->ImportPage(1);
//$pdf->useTemplate( $page, 0, 0 );
//
//$pdf->SetFont('freesans', 'B', 12);
//$pdf->SetTextColor(0);
//$pdf->SetXY(5, PDF_MARGIN_RIGHT);
////$pdf->Cell(0, 30, 'TCPDF and FPDI');
//$pdf->Cell(150);
//$pdf->Cell(0,10, 'SCF-010101010101010');

for ($i = 1; $i < 7; $i++)
{
    
    $pdf->AddPage();
    $page = $pdf->ImportPage($i);
    $pdf->useTemplate( $page, 0, 0 );
    
    //$pdf->SetFont('freesans', 'B', 12);
    //$pdf->SetTextColor(0);
    if($i == 1)
    {
		
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->SetTextColor(0);
    $pdf->SetXY(0,25, PDF_MARGIN_RIGHT);
    //$pdf->Cell(0, 30, 'TCPDF and FPDI');
    $pdf->Cell(130);
    $pdf->Cell(1,5, "Proposal No : $row_data1[kode_reproposal] / Copy ke $hit_print");
	
	$pdf->SetFont('Helvetica', 'B', 8);
	
    $pdf->SetXY(0,25, PDF_MARGIN_RIGHT);
	$pdf->Cell(130);
    $pdf->Cell(1,13, "Date : $date ");
	
	$pdf->SetFont('Helvetica', 'I', 10);
	$pdf->SetXY(0,185, PDF_MARGIN_LEFT);
	$pdf->Cell(12);
    //$pdf->Cell(1,265, "Prepared for, espicially:");
        
        //$pdf->SetFont('Helvetica', '', 8);
        //
        //$pdf->SetXY(3, PDF_MARGIN_RIGHT);
        //$pdf->Cell(160);
        //$pdf->Cell(1,13, "Tanggal: ".date("d F Y"));
        //$pdf->SetFont('freesans', '', 12);
        //$pdf->SetTextColor(0);
        
        //$pdf->SetXY(5, PDF_MARGIN_RIGHT);
        ////$pdf->Cell(0, 30, 'TCPDF and FPDI');
        //$pdf->Cell(170);
        //$pdf->Cell(0,23, 'SCF-01010101', '1');
        
        //$pdf->MultiCell(55, 5, '[LEFT] SCF-01010101', 1, 'L', 1, 0, '', '', true);
        //$pdf->MultiCell(180, 53, 'SCF01010101', 0, 'R', 0, 1, '', '', true);
        //$pdf->MultiCell(55, 5, '[CENTER] SCF01010101', 0, 'C', 0, 0, '', '', true);
        //$pdf->MultiCell(55, 5, '[JUSTIFY] '.$txt."\n", 1, 'J', 1, 2, '' ,'', true);
        $pdf->MultiCell(150, 5, $txt, 0, '', 0, 1, '', '', true);
		if($row_data1['nama_perusahaan'] != ""){
			$name = $row_data1['nama_perusahaan'];
		}else{
			$name = $row_data1['nama_customer'];
		}
		$pdf->SetFont('Helvetica', 'B', 19);
		$pdf->SetXY(0,190, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
        $pdf->MultiCell(150, 8, $name, 0, '', 0, 1, '', '', true);
		
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetXY(0,200, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
        $pdf->MultiCell(150, 5, "nama : ".$row_data1['nama_customer'], 0, '', 0, 1, '', '', true);
		
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetXY(0,205, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
        $pdf->MultiCell(150, 5, "Address : ".$row_data2['alamat'], 0, '', 0, 1, '', '', true);
		
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetXY(0,210, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
        $pdf->MultiCell(150, 5, "Phone : ".$row_data2['no_telp'], 0, '', 0, 1, '', '', true);
		
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetXY(0,215, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
        $pdf->MultiCell(150, 5, "Email : ".$row_data2['email'], 0, '', 0, 1, '', '', true);
    }if($i == 5)
    {
		
		$pdf->SetFont('Helvetica', 'I', 11);
		$pdf->SetXY(140,271, PDF_MARGIN_RIGHT);
		$pdf->Cell(12);
        $pdf->MultiCell(150, 5, $nama_marketing, 0, '', 0, 1, '', '', true);
	
	
    }
}


$pdf->Output( 'Proposal_GX.pdf', 'I' );

}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>