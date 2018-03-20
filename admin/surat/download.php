<?php
include ("../../config/configuration_admin.php");
$query_data_item	= "SELECT * FROM `gx_surat_detail` WHERE `kode_surat` ='".$_GET['c']."' AND `level` = '0';";
$sql_data_item	 	= mysql_query($query_data_item, $conn);
while($row_data_item = mysql_fetch_assoc($sql_data_item)){
    $filedata = $row_data_item['nama_file'];
    $filename = $row_data_item['nama_file'];
}

header('Content-type: ' . $filetype);
header('Content-length: ' . $filesize);
header("Content-Transfer-Encoding: binarynn");
header("Pragma: no-cache");
header("Expires: 0");
header('Content-Disposition: attachment; filename="'.$filename.'"');
echo $filedata;
//exit();


?>