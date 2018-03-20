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

class PDF extends FPDI
{
    /**
     * "Remembers" the template id of the imported page
     */
    var $_tplIdx;

    /**
     * Draw an imported PDF logo on every page
     */
    function Header()
    {
        if (is_null($this->_tplIdx)) {
            $this->setSourceFile('form.pdf');
            $this->_tplIdx = $this->importPage(1);
        }
        $size = $this->useTemplate($this->_tplIdx, 130, 5, 60);

        $this->SetFont('freesans', 'B', 20);
        $this->SetTextColor(0);
        $this->SetXY(PDF_MARGIN_LEFT, 5);
        $this->Cell(0, $size['h'], 'TCPDF and FPDI');
    }

    function Footer()
    {
        // emtpy method body
    }
}

// initiate PDF
$pdf = new PDF();
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(true, 40);
$pdf->setFontSubsetting(false);

//// add a page
//$pdf->AddPage();
//
//// get external file content
//$utf8text = file_get_contents('data/utf8test.txt', true);
//
//$pdf->SetFont('freeserif', '', 12);
//// now write some text above the imported page
//$pdf->Write(5, $utf8text);

$pdf->Output();