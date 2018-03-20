<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
if(isset($_GET['form'])){
    if($_GET['form'] == 'paket'){
$id_paket        = isset($_GET['id_paket']) ? $_GET['id_paket'] : '0';
$level           = '1';
$data_edit_paket = mysql_fetch_array(mysql_query("SELECT * FROM `gxPaket` WHERE `id_paket`='$id_paket'", $conn));
mysql_query("UPDATE `gxPaket` SET `level`='$level' WHERE `id_paket` = '$id_paket'", $conn);
header('location:master_paket.php');
    }elseif($_GET['form'] == 'cabang'){    
$id_cabang        = isset($_GET['id_cabang']) ? $_GET['id_cabang'] : '0';
$level           = '1';
mysql_query("UPDATE `gxCabang` SET `level`='$level' WHERE `id_cabang`='$id_cabang'", $conn);
header('location:master_cabang.php');
    }    
}else{}    
    
}
    } else{
	header("location: logout.php");
    }

?>