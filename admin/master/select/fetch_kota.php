<?php
include ("../../../config/configuration_admin.php");
global $conn;
if(isset($_REQUEST['id']))
{
    
    $id             = isset($_REQUEST['id']) ? mysql_real_escape_string(strip_tags(trim($_REQUEST['id']))) : '';
    //echo "SELECT DISTINCT(kecamatan) FROM `gx_master_kota` WHERE kabupaten = '".$id."';";
    
    if($id == "Jawa Timur") {$additional_sql = " AND `kabupaten` = 'Malang'"; }
    elseif($id == "Bali") {$additional_sql = ""; }
    elseif($id == "Kalimantan Timur") {$additional_sql = " AND (`kabupaten` = 'Samarinda' OR `kabupaten` = 'Balikpapan')"; }
    elseif($id == "Sulawesi Utara") {$additional_sql = " AND `kabupaten` = 'Manado'"; }
    
    $data_kelurahan = mysql_query("SELECT DISTINCT(`kabupaten`) FROM `gx_master_kota` WHERE `propinsi` = '".$id."' $additional_sql;", $conn);
    //echo '<option value="">Pilih Kota</option>';
    while($row_kelurahan = mysql_fetch_array($data_kelurahan))
    {
        echo '<option value="'.$row_kelurahan["kabupaten"].'">'.$row_kelurahan["kabupaten"].'</option>';
    }
}
?>