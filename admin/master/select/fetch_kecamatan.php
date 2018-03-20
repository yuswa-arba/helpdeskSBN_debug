<?php
include ("../../../config/configuration_admin.php");
global $conn;
if(isset($_REQUEST['id']))
{
    
    $id             = isset($_REQUEST['id']) ? mysql_real_escape_string(strip_tags(trim($_REQUEST['id']))) : '';
    //echo "SELECT DISTINCT(kecamatan) FROM `gx_master_kota` WHERE kabupaten = '".$id."';";
    $data_kelurahan = mysql_query("SELECT DISTINCT(`kecamatan`) FROM `gx_master_kota` WHERE `kabupaten` = '".$id."';", $conn);
    //echo '<option value="">Pilih Kecamatan</option>';
    while($row_kelurahan = mysql_fetch_array($data_kelurahan))
    {
        echo '<option value="'.$row_kelurahan["kecamatan"].'">'.$row_kelurahan["kecamatan"].'</option>';
    }
}
?>