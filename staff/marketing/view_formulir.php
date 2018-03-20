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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Formulir");
    global $conn;
    
    
     if(isset($_GET['id']))
    {
	$id_data	= isset($_GET['id']) ? (int)$_GET['id'] : "";
	$sql_data = mysql_query("SELECT `gx_formulir_detail`.* FROM `gx_formulir`, `gx_formulir_detail`
				WHERE `gx_formulir`.`id_formulir` = `gx_formulir_detail`.`id_formulir` AND `gx_formulir_detail`.`level` = '0'
				AND `gx_formulir`.`id_formulir` = '".$id_data."';",$conn);
	$row_data = mysql_fetch_array($sql_data);
	
	header("location: ".URL_ADMIN.$row_data["lokasi_file"].$row_data["nama_file"]);
    }
    
$plugins = '';

    $title	= 'View Formulir';
    $submenu	= "formulir";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
	$template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
	
}
	}else{
	header("location: ".URL_STAFF."logout.php");
    }

?>