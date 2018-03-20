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
	
require_once ('../../../js/tcpdf/tcpdf.php');
//require_once ('../../../js/fpdf/fpdf.php');
require_once('../../../js/fpdi/fpdi.php');

$query_data1	= "SELECT * FROM `gx_proposal` WHERE `id_proposal`='$id_data' AND `level` = '0' LIMIT 0,1;";
$sql_data1		= mysql_query($query_data1, $conn);
$row_data1		= mysql_fetch_array($sql_data1);
$nama_marketing= $loggedin["username"];
$date = date("d F Y");

$txt	= 'Prepared for, espicially:';
$pdf = new FPDI(); //FPDI extends TCPDF
//$pdf->AddPage();
$pages = $pdf->setSourceFile( '../img/blank_small.pdf' );
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
    
	if($i == 2)
        {
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->SetXY(10,25, PDF_MARGIN_LEFT);
            //$pdf->Cell(12);
            //$pdf->MultiCell(50, 5, $row_data1['nama_paket1'], 1, '', 0, 1, '', '', true);
            
        $tbl = <<<EOF
$row_data1[pdf_content]
EOF;

$pdf->writeHTML($tbl, true, false, false, false, '');

        }
	
}


$pdf->Output( 'Proposal_GX.pdf', 'I' );

}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>