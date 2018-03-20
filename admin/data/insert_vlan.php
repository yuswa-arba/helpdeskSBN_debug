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
    
    global $conn;
    
	echo "INSERT INTO `db_sbn`.`gx_data_vlan` (`id_vlan`, `userid_vlan`, `vlan`, `mac_address`, `id_esx`, `username`, `password`, `flag_vlan`,
												   `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES ";
	
	for($i=1001; $i<=3000;$i++)
	{
		$data_vlan = mysql_fetch_array(mysql_query("SELECT * FROM `gx_data_vlan` WHERE `vlan` = '".$i."';", $conn));
		
		if($data_vlan["userid_vlan"] != "")
		{
			echo "(NULL, '".$data_vlan["userid_vlan"]."', '".$i."', NULL, '".$data_vlan["id_esx"]."', NULL, NULL, 'aktif', 'dwi', NULL, NOW(), NULL, '0'),<br>";
			//echo "INSERT ".$i." with userid<br>";
		}
		else
		{
			echo "(NULL, '', '".$i."', NULL, '', NULL, NULL, 'aktif', 'dwi', NULL, NOW(), NULL, '0'),<br>";
			
		}
		
		
		
	}
	
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>