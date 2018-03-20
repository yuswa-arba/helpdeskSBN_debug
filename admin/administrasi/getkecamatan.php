<?php
ini_set('display_errors',0);
include ("../../config/configuration_admin.php");


//ambil parameter
$getkota = $_GET['gkota'];
 
if($getkota == ''){
      exit;
}else{
     $sql = "SELECT DISTINCT `kecamatan` FROM `gx_master_kota` WHERE `kabupaten` = '$getkota' ORDER BY `kecamatan` ASC;";
     $getnamakecamatan = mysql_query($sql,$conn) or die ('Query Gagal');
     while($data = mysql_fetch_array($getnamakecamatan)){
          echo '<option value="'.$data['kecamatan'].'">'.$data['kecamatan'].'</option>';
     }
     exit;    
}
?>