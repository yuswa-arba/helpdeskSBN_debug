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
$pages = $pdf->setSourceFile( '../img/blank_small2.pdf' );
//$page = $pdf->ImportPage(1);
//$pdf->useTemplate( $page, 0, 0 );
//
//$pdf->SetFont('freesans', 'B', 12);
//$pdf->SetTextColor(0);
//$pdf->SetXY(5, PDF_MARGIN_RIGHT);
////$pdf->Cell(0, 30, 'TCPDF and FPDI');
//$pdf->Cell(150);
//$pdf->Cell(0,10, 'SCF-010101010101010');

//echo count($row_data1["pdf_content"]);

$tbl = <<<EOF
$row_data1[pdf_content]
EOF;


$str = $row_data1["pdf_content"];
        $lines_arr = explode('</p>', $str);
        $num_newlines = count($lines_arr) -1;
        
        $page_one = '';
        $page_two = '';
        
        
        if($num_newlines <= '27')
        {
            
            foreach($lines_arr as $lines)
            {
                $page_one .= $lines.'</p>';
            }
        }
        elseif($num_newlines > '27')
        {
           
            for($i=0;$i<=26;$i++)
            {
                $page_one .= $lines_arr[$i].'</p>';
            }
            
            for($i=27;$i<=$num_newlines;$i++)
            {
                $page_two .= $lines_arr[$i].'</p>';
            }
        }
        
				
$page_satu = <<<EOF
$page_one
EOF;

$page_dua = <<<EOF
$page_two
EOF;

for ($i = 1; $i < 9; $i++)
{
    
    $pdf->AddPage();
    $page = $pdf->ImportPage($i);
    $pdf->useTemplate( $page, 0, 0 );
    
    //$pdf->SetFont('freesans', 'B', 12);
    //$pdf->SetTextColor(0);
    if($i == 1)
    {
		
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor(0);
    $pdf->SetXY(0,5, PDF_MARGIN_RIGHT);
    //$pdf->Cell(0, 30, 'TCPDF and FPDI');
    $pdf->Cell(160);
    $pdf->Cell(1,5, "Proposal No : $row_data1[kode_proposal]");
	
	$pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetXY(0,5, PDF_MARGIN_RIGHT);
	$pdf->Cell(160);
    $pdf->Cell(1,15, "Date : $date ");
	
	$pdf->SetFont('Helvetica', 'I', 10);
	$pdf->SetXY(0,185, PDF_MARGIN_LEFT);
	$pdf->Cell(12);
	
	//$pdf->SetFont('Helvetica', '', 11);
	//$pdf->SetXY(0,30, PDF_MARGIN_RIGHT);
	//$pdf->Cell(140);
	//$pdf->Cell(1, 5, "Phone : ".$row_data1['no_telp']);
	//
	//$pdf->SetFont('Helvetica', '', 11);
	//$pdf->SetXY(0,30, PDF_MARGIN_RIGHT);
	//$pdf->Cell(140);
	//$pdf->Cell(1, 15, "Email : ".$row_data1['email']);
	
	//$pdf->MultiCell(150, 5, $txt, 0, '', 0, 1, '', '', true);
	if($row_data1['nama_perusahaan'] != "")
	{
		$name = $row_data1['nama_perusahaan'];
	}
	else
	{
		$name = $row_data1['nama_customer'];
	}
	$pdf->SetFont('Helvetica', 'B', 14);
	$pdf->SetXY(0,30, PDF_MARGIN_RIGHT);
	$pdf->Cell(124);
	$pdf->MultiCell(160, 8, $name, 0, '', 0, 1, '', '', true);
	
	//$pdf->SetFont('Helvetica', '', 11);
	//$pdf->SetXY(0,40, PDF_MARGIN_RIGHT);
	//$pdf->Cell(120);
	//$pdf->MultiCell(150, 5, "nama : ".$row_data1['nama_customer'], 0, '', 0, 1, '', '', true);
	
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->SetXY(0,40, PDF_MARGIN_RIGHT);
	$pdf->Cell(124);
	$pdf->MultiCell(160, 5, $row_data1['alamat'], 0, '', 0, 1, '', '', true);
	
	$pdf->SetFont('Helvetica', 'I', 10);
	$pdf->SetXY(0,185, PDF_MARGIN_RIGHT);
	$pdf->Cell(130);
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
        
		
		
    }
	 
	if($i == 6 )
	{
		//echo $page_satu;
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetXY(10,25, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
		//$pdf->MultiCell(50, 5, $row_data1['nama_paket1'], 1, '', 0, 1, '', '', true);
		$pdf->writeHTML($page_satu, true, false, false, false, '');
		
	}
		if($i == 7 )
	{
		//echo $page_satu;
		$pdf->SetFont('Helvetica', '', 11);
		$pdf->SetXY(10,25, PDF_MARGIN_LEFT);
		$pdf->Cell(12);
		//$pdf->MultiCell(50, 5, $row_data1['nama_paket1'], 1, '', 0, 1, '', '', true);
		$pdf->writeHTML($page_dua, true, false, false, false, '');
		
	}
}

ob_end_clean();
$pdf->Output( 'Proposal_GX.pdf', 'I' );

}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>