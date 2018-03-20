<?php 
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
if($loggedin["group"] == 'staff'){
    
    global $conn_helpdesk;
    global $conn;
$id_spk     = $_GET['id']; 
if($_GET["t"] == "ci"){
    $query = "UPDATE `gx_helpdesk_spk` SET `check_in` = NOW(),
                                `date_upd` = NOW(), `updated_by` = '$loggedin[username]'
                                WHERE `gx_helpdesk_spk`.`id_spk` = $id_spk;";
	
	//echo $query;
	
	mysql_query($query,$conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php?type=spktech';
            </script>";
}elseif($_GET["t"] == "co"){
    $query = "UPDATE `gx_helpdesk_spk` SET `check_out` = NOW(),
                                `date_upd` = NOW(), `updated_by` = '$loggedin[username]'
                                WHERE `gx_helpdesk_spk`.`id_spk` = $id_spk;";
	
	//echo $query;
	
	mysql_query($query,$conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'incoming.php?type=spktech';
            </script>";
}
            
}
}
?>