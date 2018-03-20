<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Cetak Brosur");
    global $conn;
   
    if(isset($_GET['id']))
    {
	$id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
	$sql_data = mysql_query("SELECT `gx_brosur_detail`.* FROM `gx_brosur`, `gx_brosur_detail`
				WHERE `gx_brosur`.`id_brosur` = `gx_brosur_detail`.`id_brosur`
				AND `gx_brosur`.`id_brosur` = '".$id_data."';",$conn);
	$row_data = mysql_fetch_array($sql_data);
	
	header("location: ".URL_ADMIN.$row_data["lokasi_file"].$row_data["nama_file"]);
    }
    
$plugins = '';

    $title	= 'View Brosur';
    $submenu	= "brosur";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>