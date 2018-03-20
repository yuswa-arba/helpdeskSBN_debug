<?php
//============================================================+
// File name   : example_041.php
// Begin       : 2008-12-07
// Last Update : 2013-05-14
//
// Description : Example 041 for TCPDF class
//               Annotation - FileAttachment
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Annotation - FileAttachment
 * @author Nicola Asuni
 * @since 2008-12-07
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

require_once('../../fpdi/fpdi.php');

$pdf = new FPDI(); //FPDI extends TCPDF
//$pdf->AddPage();
$pages = $pdf->setSourceFile( '2.pdf' );
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
//$page = $pdf->ImportPage(1);
//$pdf->useTemplate( $page, 0, 0 );
//
//$pdf->SetFont('freesans', 'B', 12);
//$pdf->SetTextColor(0);
//$pdf->SetXY(5, PDF_MARGIN_RIGHT);
////$pdf->Cell(0, 30, 'TCPDF and FPDI');
//$pdf->Cell(150);
//$pdf->Cell(0,10, 'SCF-010101010101010');

for ($i = 1; $i < 6; $i++)
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
        $pdf->SetXY(0, PDF_MARGIN_RIGHT);
        $pdf->Cell(150);
        $pdf->Cell(1,5, "Proposal No: SCF01010101");
        
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
        //$pdf->MultiCell(55, 5, '[DEFAULT] '.$txt, 1, '', 0, 1, '', '', true);
    }
    
     if($i == 3)
        {
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->SetXY(10,190, PDF_MARGIN_LEFT);
            //$pdf->Cell(12);
            //$pdf->MultiCell(50, 5, $row_data1['nama_paket1'], 1, '', 0, 1, '', '', true);
            
        $tbl = <<<EOD
<table border="0" cellpadding="2" cellspacing="10" align="center" style="width:65%;font-size:14px;">
 
    <tr nobr="false">
        <td style="background-color:#000099;color:#fff;">ROW 1<br />COLUMN 1</td>
        <td style="background-color:#99b3ff;color:#000;">ROW 1<br />COLUMN 2</td>
    </tr>
    <tr nobr="false">
        <td style="background-color:#000099;color:#fff;">ROW 2<br />COLUMN 1</td>
        <td style="background-color:#99b3ff;color:#000;">ROW 2<br />COLUMN 2</td>
    </tr>
    <tr nobr="true">
        <td style="background-color:#000099;color:#fff;"><b>ROW 3COLUMN 1</b></td>
        <td style="background-color:#99b3ff;color:#000;">ROW 3COLUMN 2</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
        }
        
        
}


$pdf->Output( 'Proposal_GX.pdf', 'I' );
//echo substr('received power(DBm): -22.8', 21);
//$power = substr('received power(DBm): -22.8', 21);
//if($power >= -25)
//{
//    echo "sip";
//}
//else
//{
//    echo "not";
//}
?>