<?php
include ("../../config/configuration_admin.php");
//harus selalu gunakan variabel term saat memakai autocomplete,
//jika variable term tidak bisa, gunakan variabel q
$term = trim(strip_tags($_GET['term']));
 
$qstring = "SELECT DISTINCT `kabupaten` FROM `gx_master_kota` WHERE `kabupaten` LIKE '".$term."%'";
//query database untuk mengecek tabel Country 
$result = mysql_query($qstring);
 
while ($row = mysql_fetch_array($result))
{
    $row['value']=htmlentities(stripslashes($row['kabupaten']));
//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>