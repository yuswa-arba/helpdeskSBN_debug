<?php
ini_set('display_errors',0);
include ("../../config/configuration_admin.php");


//ambil parameter
$getkecamatan = $_GET['gkecamatan'];
 
if($getkecamatan == ''){
      exit;
}else{
     $sql = "SELECT DISTINCT `kelurahan` FROM `gx_master_kota` WHERE `kecamatan` = '$getkecamatan' ORDER BY `kecamatan` ASC;";
     $getnamakelurahan = mysql_query($sql,$conn) or die ('Query Gagal');
     while($data = mysql_fetch_array($getnamakelurahan)){
          echo '<option value="'.$data['kelurahan'].'">'.$data['kelurahan'].'</option>';
     }
     exit;    
}
?>