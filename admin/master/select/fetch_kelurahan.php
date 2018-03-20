<?php
include ("../../../config/configuration_admin.php");
global $conn;
if(isset($_REQUEST['id']))
{
    
    $id             = isset($_REQUEST['id']) ? mysql_real_escape_string(strip_tags(trim($_REQUEST['id']))) : '';
   
    $data_kelurahan = mysql_query("SELECT `kelurahan` FROM `gx_master_kota` WHERE `kecamatan` = '".$id."';", $conn);
    //echo '<option value="">Pilih Kelurahan</option>';
    while($row_kelurahan = mysql_fetch_array($data_kelurahan))
    {
        echo '<option value="'.$row_kelurahan["kelurahan"].'">'.$row_kelurahan["kelurahan"].'</option>';
    }
}
    
?>