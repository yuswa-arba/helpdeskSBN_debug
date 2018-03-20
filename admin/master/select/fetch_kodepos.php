<?php
include ("../../../config/configuration_admin.php");
global $conn;
if(isset($_REQUEST['id']))
{
    
    $id     = isset($_REQUEST['id']) ? mysql_real_escape_string(strip_tags(trim($_REQUEST['id']))) : '';
    
    $data_kelurahan = mysql_query("SELECT `kodepos` FROM `gx_master_kota` WHERE `kelurahan` = '".$id."';", $conn);
    //echo '<option value="">Pilih Kodepos</option>';
    while($row_kelurahan = mysql_fetch_array($data_kelurahan))
    {
        echo '<option value="'.$row_kelurahan["kodepos"].'">'.$row_kelurahan["kodepos"].'</option>';
    }
}
    
?>