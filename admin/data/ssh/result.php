<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");
include '../../../config/telnet/routeros_api.class.php';

redirectToHTTPS();

global $conn;


$loggedin = logged_inAdmin();
if(isset($_REQUEST["userid"]))
{
	$userid         = isset($_REQUEST['userid']) ? mysql_real_escape_string(trim($_REQUEST['userid'])) : '';
	$vlan		    = isset($_REQUEST['vlan']) ? mysql_real_escape_string(trim($_REQUEST['vlan'])) : '';
	$id_olt		    = isset($_REQUEST['id_olt']) ? mysql_real_escape_string(trim($_REQUEST['id_olt'])) : '';
	$pon		    = isset($_REQUEST['pon']) ? mysql_real_escape_string(trim($_REQUEST['pon'])) : '';
	$pon_id		    = isset($_REQUEST['id']) ? mysql_real_escape_string(trim($_REQUEST['id'])) : '';
	$mac_address    = isset($_REQUEST['mac_address']) ? mysql_real_escape_string(trim($_REQUEST['mac_address'])) : '';
	$id_timpasang   = isset($_REQUEST['id_timpasang']) ? mysql_real_escape_string(trim($_REQUEST['id_timpasang'])) : '';
	
    $tv		    = isset($_REQUEST['tv']) ? mysql_real_escape_string(trim($_REQUEST['tv'])) : '';
    $voip	    = isset($_REQUEST['voip']) ? mysql_real_escape_string(trim($_REQUEST['voip'])) : '';
	
	if($userid != "")
	{
		//insert log aktivasi
//		mysql_query("INSERT INTO `software`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
//					`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
//					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
//                    NOW(), 'STEP 1 CONFIG ONU TEST DAN CEK POWER ONU', '".$loggedin["username"]."',
//					'".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');", $conn);
		echo "INSERT INTO `software`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
				`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
				VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
                NOW(), 'STEP 1 CONFIG ONU TEST DAN CEK POWER ONU', '".$loggedin["username"]."',
				'".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');";
	}
}