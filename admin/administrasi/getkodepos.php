<?php
ini_set('display_errors',0);
include ("../../config/configuration_admin.php");


//ambil parameter
$getkelurahan = $_GET['gkelurahan'];
 
if($getkelurahan == ''){
      exit;
}else{
     $sql = "SELECT DISTINCT `kodepos` FROM `gx_master_kota` WHERE `kelurahan` = '$getkelurahan' ORDER BY `kodepos` ASC;";
     $getkodepos = mysql_query($sql,$conn) or die ('Query Gagal');
     while($data = mysql_fetch_array($getkodepos)){
          echo '<option value="'.$data['kodepos'].'">'.$data['kodepos'].'</option>';
     }
     exit;    
}
?>