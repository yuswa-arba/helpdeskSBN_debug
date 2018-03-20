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
$pages = $pdf->setSourceFile( 'form.pdf' );
//$page = $pdf->ImportPage(1);
//$pdf->useTemplate( $page, 0, 0 );
//
//$pdf->SetFont('freesans', 'B', 12);
//$pdf->SetTextColor(0);
//$pdf->SetXY(5, PDF_MARGIN_RIGHT);
////$pdf->Cell(0, 30, 'TCPDF and FPDI');
//$pdf->Cell(150);
//$pdf->Cell(0,10, 'SCF-010101010101010');

for ($i = 1; $i < 3; $i++)
{
    
    $pdf->AddPage();
    $page = $pdf->ImportPage($i);
    $pdf->useTemplate( $page, 0, 0 );
    
    $pdf->SetFont('freesans', 'B', 12);
    $pdf->SetTextColor(0);
    $pdf->SetXY(5, PDF_MARGIN_RIGHT);
    //$pdf->Cell(0, 30, 'TCPDF and FPDI');
    $pdf->Cell(150);
    $pdf->Cell(0,10, 'SCF-010101010101010');
    
    $tbl = <<<EOD
<table border="1" cellpadding="2" cellspacing="2" align="center">
 <tr nobr="true">
  <th colspan="3">NON-BREAKING ROWS</th>
 </tr>
 <tr nobr="true">
  <td>ROW 1<br />COLUMN 1</td>
  <td>ROW 1<br />COLUMN 2</td>
  <td>ROW 1<br />COLUMN 3</td>
 </tr>
 <tr nobr="true">
  <td>ROW 2<br />COLUMN 1</td>
  <td>ROW 2<br />COLUMN 2</td>
  <td>ROW 2<br />COLUMN 3</td>
 </tr>
 <tr nobr="true">
  <td>ROW 3<br />COLUMN 1</td>
  <td>ROW 3<br />COLUMN 2</td>
  <td>ROW 3<br />COLUMN 3</td>
 </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
}

//$pdf->Output( 'newTest.pdf', 'I' );
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



$var1 = 'asdasdasdsa';
$var2 = 'lkjhgfrdftygh';

$output = <<<EOF
This would be any text. to add your variables, you would $var1 and $var2.
Then on the last line of text, make sure you close the HEREDOC.
EOF;

//close your script
?>

<doctype html>
<html lang=en>
<head><title>Try Me</title></head>
<body>
<?php
//now print out to display
print($output);
?>
</body>
</html>