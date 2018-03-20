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

$content	= '';


//////////////////////////
//						//
// DHCP LEASE 			//
//						//
//////////////////////////

if(isset($_REQUEST["chat"]))
{
	$id_spk     = isset($_REQUEST['idspk_aktivasi']) ? mysql_real_escape_string(trim($_REQUEST['idspk_aktivasi'])) : '';
	$chat       = isset($_REQUEST['chat']) ? mysql_real_escape_string(trim($_REQUEST['chat'])) : '';
	$id_teknisi	= isset($_REQUEST['idteknisi']) ? mysql_real_escape_string(trim($_REQUEST['idteknisi'])) : '';
	
	if($chat != "" AND $id_spk != "" AND $id_teknisi != "")
	{
		mysql_query("INSERT INTO `gx_chat_aktivasi` (`id_chat_aktivasi`, `idspk_aktivasi`, `idpengirim_aktivasi`, `idpenerima_aktivasi`, `pesan_aktivasi`, `date_aktivasi`)
		VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', '".$chat."', NOW());", $conn);
		echo "ok";
	}	

}