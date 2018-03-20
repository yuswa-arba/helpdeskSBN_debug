<?php
$tgl_tagihan = "2015-08-01";
$tgl_grace = date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan. "+2 days"));
echo $tgl_grace."<br>";

$tgl_next = date("Y-m-01 00:00:00.000", strtotime($tgl_tagihan. "+1 month"));
echo $tgl_next;
//$tgl_grace = date("Y-m-d)
?>