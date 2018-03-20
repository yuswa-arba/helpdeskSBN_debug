<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

 include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
	
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open list Survey");
    
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

    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>