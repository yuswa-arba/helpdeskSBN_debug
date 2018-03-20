<?php

include('../../pdf/mpdf.php');

$mpdf = new mPDF();
$html= '<img src="https://172.16.79.194/software/beta/pdf/logo.jpg" height="70"><br>
<img src="./software/beta/pdf/logo.jpg" height="70"><br>
<img src="../../pdf/logo.jpg" height="70"><br>
<img src="http://172.16.79.194/software/beta/pdf/logo.jpg" height="70">';
$mpdf->WriteHTML($html);
$mpdf->debug = true; 
$output = $mpdf->Output(); 
exit;
