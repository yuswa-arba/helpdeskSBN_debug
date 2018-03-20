<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: https://172.16.79.194/software/beta/admin/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for https://172.16.79.194/software/beta/admin/data/form_aktivasi_3play
 *
 *Backup Tanggal 2 des 2016
 *
 */
include ("../../../config/configuration_admin.php");
include '../../../config/telnet/routeros_api.class.php';

redirectToHTTPS();

global $conn;
$loggedin = logged_inAdmin();

$content	= '';

function pingAddress($ip) {
    $pingresult = exec("/bin/ping -c 3 $ip", $outcome, $status);
    if (0 == $status) {
        $status = "alive";
    } else {
        $status = "dead";
    }
    //echo "The IP address, $ip, is  ".$status;
    return $status;
}

if(isset($_REQUEST["userid"]))
{
	$id_spk         = isset($_REQUEST['id_spkaktivasi']) ? mysql_real_escape_string(trim($_REQUEST['id_spkaktivasi'])) : '';
	$kode_spk       = isset($_REQUEST['kode_spkaktivasi']) ? mysql_real_escape_string(trim($_REQUEST['kode_spkaktivasi'])) : '';
	$id_teknisi     = isset($_REQUEST['id_teknisi']) ? mysql_real_escape_string(trim($_REQUEST['id_teknisi'])) : '';
	
	$userid         = isset($_REQUEST['userid']) ? mysql_real_escape_string(trim($_REQUEST['userid'])) : '';
	$vlan		    = isset($_REQUEST['vlan']) ? mysql_real_escape_string(trim($_REQUEST['vlan'])) : '';
	$id_olt		    = isset($_REQUEST['id_olt']) ? mysql_real_escape_string(trim($_REQUEST['id_olt'])) : '';
	$pon		    = isset($_REQUEST['pon']) ? mysql_real_escape_string(trim($_REQUEST['pon'])) : '';
	$pon_id		    = isset($_REQUEST['id']) ? mysql_real_escape_string(trim($_REQUEST['id'])) : '';
	$mac_address    = isset($_REQUEST['mac_address']) ? mysql_real_escape_string(trim($_REQUEST['mac_address'])) : '';
	$id_timpasang   = isset($_REQUEST['id_timpasang']) ? mysql_real_escape_string(trim($_REQUEST['id_timpasang'])) : '';
	
    $tv		    = isset($_REQUEST['tv']) ? mysql_real_escape_string(trim($_REQUEST['tv'])) : '';
    $voip	    = isset($_REQUEST['voip']) ? mysql_real_escape_string(trim($_REQUEST['voip'])) : '';
	
	$onu_tipe	= isset($_REQUEST['onu_tipe']) ? mysql_real_escape_string(trim($_REQUEST['onu_tipe'])) : '';
	
	if($userid != "")
	{
	
		//insert log aktivasi
		$uuid = get_uuid('gx_log_aktivasi');
		$uuid_detail = get_uuid('gx_log_aktivasi_detail');
		//echo $uuid;
		mysql_query("INSERT INTO `gx_log_aktivasi` (`id_log_aktivasi`, `uuid_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
					`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
					VALUES ('', '".$uuid."', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
                    NOW(), 'STEP 2 - (CONFIG ONU - CEK DHCP LEASE)',
					'".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');", $conn);

		//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		//echo "SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;";
		$result_switch_port = mysql_query("SELECT * FROM `software`.`gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_switch_port = mysql_fetch_array($result_switch_port);
        
        $result_data_vlan = mysql_query("SELECT * FROM `gx_data_vlan` where `userid_vlan` = '".$userid."' AND `level` = '0' LIMIT 0,1;", $conn);
		$row_data_vlan = mysql_fetch_array($result_data_vlan);
        
        
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		//get data default IP VM Master
		$ip_vm = mysql_query("SELECT * FROM `gx_inet_ipvm` LIMIT 0,1;", $conn);
		$data_ip_vm = mysql_fetch_array($ip_vm);
		
		if($count_olt_customer == 1)
		{
			//select script from database	
			$unreg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'unreg_onu';", $conn);
			$data_unreg_onu = mysql_fetch_array($unreg_onu);
			
			//script register onu
			$reg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'reg_onu';", $conn);
			$data_reg_onu = mysql_fetch_array($reg_onu);
			
			//script cek status onu
			$status_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_onu';", $conn);
			$data_status_onu = mysql_fetch_array($status_onu);
			
			if($onu_tipe == "lama")
			{
				//inet, tv, dan voip
				if($tv != "" AND $voip != "")
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_lama_tv_voip';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
				//inet, tv
				elseif($tv != "" AND $voip == "")
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_lama_tv';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
				//inet, voip
				elseif($tv == "" AND $voip != "")
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_lama_voip';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
				//inet only
				else
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_lama';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
			}
			elseif($onu_tipe == "baru")
			{
				//inet, tv, dan voip
				if($tv != "" AND $voip != "")
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_tv_voip';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
				//inet, tv
				elseif($tv != "" AND $voip == "")
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_tv';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
				//inet, voip
				elseif($tv == "" AND $voip != "")
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu_voip';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
				//inet only
				else
				{
					$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu';", $conn);
					$data_config_onu = mysql_fetch_array($config_onu);
				}
			}
			
			$show_vlan = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_olt';", $conn);
			$data_show_vlan = mysql_fetch_array($show_vlan);
			
			//$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt';", $conn);
			//$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
			$create_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_olt2';", $conn);
			$data_create_vlan_olt = mysql_fetch_array($create_vlan_olt);
			
			$output_remove = "";
			$output_remove_switch = "";
			
			
			//////////////////////
			//					//
			// OLT SCRIPT		//
			//					//
			//////////////////////
			$replace = array(
				'[userid]' => $userid,
				'[ip_address]' => trim($row_olt_customer["ip_address"]), 
				'[username]' => trim($row_olt_customer["username"]), 
				'[password]' => trim($row_olt_customer["password"]),
				'[pon]' => $pon,
				'[pon_id]' => $pon_id,
				'[vlanid]' => $vlan,
				'[mac]' => $mac_address
			);
			
			$replaceOnutest = array(
				'[userid]' => $userid,
				'[ip_address]' => trim($row_olt_customer["ip_address"]), 
				'[username]' => trim($row_olt_customer["username"]), 
				'[password]' => trim($row_olt_customer["password"]),
				'[pon]' => $pon,
				'[pon_id]' => $pon_id,
				'[vlanid]' => $vlan,
				'[mac]' => $row_onu_test['macaddress']
			);
			
			$replaceStatus = array(
				'[userid]' => trim($userid), 
				'[ip_address]' => trim($row_olt_customer["ip_address"]), 
				'[username]' => trim($row_olt_customer["username"]), 
				'[password]' => trim($row_olt_customer["password"]),
				'[pon]' => trim($pon),
				'[id]' => trim($pon_id)
			); 
			$script_unreg_onu 		= strReplaceAssoc($replaceOnutest,$data_unreg_onu["script"]);
			$script_reg_onu 		= strReplaceAssoc($replace,$data_reg_onu["script"]);
			
			$script_status_onu 		= strReplaceAssoc($replaceStatus,$data_status_onu["script"]);
			
			
            
            $funreg = fopen('/usr/script/olt/unreg_onu_'.$userid.'.exp', 'w+');
			fwrite($funreg, $script_unreg_onu);
			fclose($funreg);
			chmod("/usr/script/olt/unreg_onu_".$userid.".exp",0755);
			
			$fh = fopen('/usr/script/olt/reg_onu_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_reg_onu);
			fclose($fh);
			chmod("/usr/script/olt/reg_onu_".$userid.".exp",0755);
			
			$fstatus = fopen('/usr/script/olt/status_onu_'.$userid.'.exp', 'w+');
			fwrite($fstatus, $script_status_onu);
			fclose($fstatus);
			chmod("/usr/script/olt/status_onu_".$userid.".exp",0755);
			
			
			
			
			$output_unreg = shell_exec('expect /usr/script/olt/unreg_onu_'.$userid.'.exp');
			
			$output_reg = shell_exec('expect /usr/script/olt/reg_onu_'.$userid.'.exp');
			sleep(70);
			
			$output_status_onu = shell_exec('expect /usr/script/olt/status_onu_'.$userid.'.exp');
			$status_onu = '-';
			$output_inactive = '-';
			
			if (strpos($output_status_onu, 'has bound 1 active ONUs') !== false) {
				$status_onu = 'active';
			}elseif (strpos($output_status_onu, 'has bound 1 inactive ONUs') !== false) {
				
				if (strpos($output_status_onu, 'power-off') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'power-off';
				}elseif (strpos($output_status_onu, 'wire-down') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'wire-down';
				}elseif (strpos($output_status_onu, 'power off') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'power off';
				}elseif (strpos($output_status_onu, 'wire down') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'wire down';
				}elseif (strpos($output_status_onu, 'unknow+') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'unknown';
				}elseif (strpos($output_status_onu, 'unknown') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'unknown';
				}elseif (strpos($output_status_onu, 'lost') !== false) {
					$status_onu = 'inactive';
					$output_inactive = 'lost';
				}else{
					$status_onu = 'inactive';
				}
				
			}
			
			
			//cek status onu
			if($status_onu == "active")
			{
				
				
            
//uplink1 olt
$uplink1 = array('[uplink1]' => '');
$uplink2 = array('[uplink2]' => '');
$uplink3 = array('[uplink3]' => '');
$uplink4 = array('[uplink4]' => '');
$uplink5 = array('[uplink5]' => '');
$uplink6 = array('[uplink6]' => '');

if($row_olt_customer["uplink_port1"] != "")
{
    $uplink1 = array(
        '[uplink1]' => 'send "interface '.$row_olt_customer["uplink_port1"].'\r"
expect "#"
send "switchport trunk vlan-allowed add [vlanid]\r"
expect "#"
');

}

//uplink2 olt           
if($row_olt_customer["uplink_port2"] != "")
{
    $uplink2 = array(
        '[uplink2]' => 'send "interface '.$row_olt_customer["uplink_port2"].'\r"
expect "#"
send "switchport trunk vlan-allowed add [vlanid]\r"
expect "#"
');

}
            
//uplink3 olt           
if($row_olt_customer["uplink_port3"] != "")
{
    $uplink3 = array(
        '[uplink3]' => 'send "interface '.$row_olt_customer["uplink_port3"].'\r"
expect "#"
send "switchport trunk vlan-allowed add [vlanid]\r"
expect "#"
');

}

//uplink3 olt           
if($row_olt_customer["uplink_port4"] != "")
{
    $uplink4 = array(
        '[uplink4]' => 'send "interface '.$row_olt_customer["uplink_port4"].'\r"
expect "#"
send "switchport trunk vlan-allowed add [vlanid]\r"
expect "#"
');

}

//uplink3 olt           
if($row_olt_customer["uplink_port5"] != "")
{
    $uplink5 = array(
        '[uplink5]' => 'send "interface '.$row_olt_customer["uplink_port5"].'\r"
expect "#"
send "switchport trunk vlan-allowed add [vlanid]\r"
expect "#"
');

}

//uplink6 olt           
if($row_olt_customer["uplink_port6"] != "")
{
    $uplink6 = array(
        '[uplink6]' => 'send "interface '.$row_olt_customer["uplink_port6"].'\r"
expect "#"
send "switchport trunk vlan-allowed add [vlanid]\r"
expect "#"
');
}


$replace_uplink = array_merge($uplink1, $uplink2, $uplink3, $uplink4, $uplink5, $uplink6);

            //replace add multiple uplink
            $script_create_vlan_olt = strReplaceAssoc($replace_uplink,$data_create_vlan_olt["script"]);
			
            
            //replace data olt
            $script_create_vlan_olt = strReplaceAssoc($replace, $script_create_vlan_olt);
			
			
			$script_config_onu 		= strReplaceAssoc($replace,$data_config_onu["script"]);
			$script_show_vlan 		= strReplaceAssoc($replace,$data_show_vlan["script"]);
			
			
			$flan1 = fopen('/usr/script/olt/config_onu_'.$userid.'.exp', 'w+');
			fwrite($flan1, $script_config_onu);
			fclose($flan1);
			chmod("/usr/script/olt/config_onu_".$userid.".exp",0755);
			
			$flan2 = fopen('/usr/script/olt/show_vlan_olt_'.$userid.'.exp', 'w+');
			fwrite($flan2, $script_show_vlan);
			fclose($flan2);
			chmod("/usr/script/olt/show_vlan_olt_".$userid.".exp",0755);
			
			//$flan3 = fopen('olt/remove_vlan_olt_'.$userid.'.exp', 'w+');
			//fwrite($flan3, $script_remove_vlan_olt);
			//fclose($flan3);
			//chmod("/usr/script/olt/remove_vlan_olt_".$userid.".exp",0755);
			
			$flan4 = fopen('/usr/script/olt/create_vlan_olt_new_'.$userid.'.exp', 'w+');
			fwrite($flan4, $script_create_vlan_olt);
			fclose($flan4);
			chmod("/usr/script/olt/create_vlan_olt_new_".$userid.".exp",0755);
			
			
			$output_config = shell_exec('expect /usr/script/olt/config_onu_'.$userid.'.exp');
			//sleep(10);
			$output_show = shell_exec('expect /usr/script/olt/show_vlan_olt_'.$userid.'.exp');
			//sleep(10);
			
		$logFile = '/usr/script/olt/show_vlan_'.$userid.'.txt';
		//echo $logFile;
		$lines = file($logFile); // Get each line of the file and store it as an array
		$line_data =  count ($lines);
		$remove_script = '';
        
		$no_interface = 1;
		foreach($lines as $value)
		{
			if (strpos($value, 'Tagged') !== false)
			{
				//echo $value."<br>";
				
				$str_value = explode(" ", $value);
				
				$pon = $str_value[0];
				//echo $pon."<br>";
				//print_r($str_value);
				if($pon[0] == "G" )
				{
$remove_script .= 'expect "#"
send "interface '.$pon.'\r"
expect "#"
send "switchport trunk vlan-allowed remove [vlanid]\r"
';
				}
				elseif($pon[0] == "E" )
				{
$remove_script .= 'expect "#"
send "interface ePON '.substr($pon, 1).'\r"
expect "#"
send "switchport trunk vlan-allowed remove [vlanid]\r"
';
				}
				
				
			}
		}

	
		$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt2';", $conn);
		$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
		$replace1 = array(
			'[remove_script]' => $remove_script
		);
		$script_remove_vlan_olt1 = strReplaceAssoc($replace1,$data_remove_vlan_olt["script"]);
		
		$script_remove_vlan_olt2 = strReplaceAssoc($replace,$script_remove_vlan_olt1);
		
		$flan3 = fopen('/usr/script/olt/remove_vlan_olt2_'.$userid.'.exp', 'w+');
		fwrite($flan3, $script_remove_vlan_olt2);
		fclose($flan3);
		chmod("/usr/script/olt/remove_vlan_olt2_".$userid.".exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				$output_remove = shell_exec('expect /usr/script/olt/remove_vlan_olt2_'.$userid.'.exp');
				//sleep(30);

			}
			$output_create = shell_exec('expect /usr/script/olt/create_vlan_olt_new_'.$userid.'.exp');
			
			//sleep(30);
			//////////////////////
			//					//
			// ENDOLT SCRIPT	//
			//					//
			//////////////////////
			
			
			/////////////////////
			//
			// SWITCH SCRIPT
			//
			///////////////////
			
			$result_switch_olt = mysql_query("SELECT * FROM `software`.`v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_olt` = '".$id_olt."' LIMIT 0,1;", $conn);
			$row_switch_olt = mysql_fetch_array($result_switch_olt);
			//echo "SELECT * FROM `gx_inet_listswitch` where id_server = '".$row_switch_port["idswitch_port"]."' LIMIT 0,1;";
		
            $result_switch_esx = mysql_query("SELECT * FROM `software`.`v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_esx` = '".$row_data_vlan["id_esx"]."' LIMIT 0,1;", $conn);
			$row_switch_esx = mysql_fetch_array($result_switch_esx);
            
            
            
			$show_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_switch';", $conn);
			$data_show_vlan_switch = mysql_fetch_array($show_vlan_switch);
			
			//$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt';", $conn);
			//$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
			$create_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_switch';", $conn);
			$data_create_vlan_switch = mysql_fetch_array($create_vlan_switch);
			
			$replaceSwitch = array(
				'[userid]' => $userid,
				'[ip_address]' => trim($row_switch_olt["ip_address"]), 
				'[username]' => trim($row_switch_olt["username"]), 
				'[password]' => trim($row_switch_olt["password"]),
				'[downlink]' => trim($row_switch_olt["interface_port"]),
				'[uplink]' => trim($row_switch_esx["interface_port"]),
				'[pon]' => $pon,
				'[pon_id]' => $pon_id,
				'[vlanid]' => $vlan,
				'[mac]' => $mac_address
			);
			$script_create_vlan_switch = strReplaceAssoc($replaceSwitch,$data_create_vlan_switch["script"]);
			
			$script_reg_onu 		= strReplaceAssoc($replaceSwitch,$data_reg_onu["script"]);
			$script_config_onu 		= strReplaceAssoc($replaceSwitch,$data_config_onu["script"]);
			$script_show_vlan_switch 		= strReplaceAssoc($replaceSwitch,$data_show_vlan_switch["script"]);
			//$script_remove_vlan_olt = strReplaceAssoc($replace,$data_remove_vlan_olt["script"]);
			
			
			$fileswitch = fopen('/usr/script/switch/show_vlan_'.$userid.'.exp', 'w+');
			fwrite($fileswitch, $script_show_vlan_switch);
			fclose($fileswitch);
			chmod("/usr/script/switch/show_vlan_".$userid.".exp",0755);
			
            
			$flan4_switch = fopen('/usr/script/switch/create_vlan_new_'.$userid.'.exp', 'w+');
			fwrite($flan4_switch, $script_create_vlan_switch);
			fclose($flan4_switch);
			chmod("/usr/script/switch/create_vlan_new_".$userid.".exp",0755);
			
			
			$output_show_switch = shell_exec('expect /usr/script/switch/show_vlan_'.$userid.'.exp');
			//$output_show_switch = "";
			//sleep(30);
			
		$logFile = '/usr/script/switch/show-vlan_'.$userid.'.txt';
		//echo $logFile;
		$lines = file($logFile); // Get each line of the file and store it as an array
		$line_data =  count ($lines);
		$remove_script = '';
		
		foreach($lines as $value)
		{
			if (strpos($value, 'Tagged') !== false)
			{
				//echo $value."<br>";
				
				$str_value = explode(" ", $value);
				
				$pon = $str_value[0];
                
$remove_script .= 'expect "#"
send "interface '.trim($pon).'\r"
expect "#"
send "switchport trunk vlan-allowed remove [vlanid]\r"
';

				
			}
		}
		
		$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt2';", $conn);
		$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
		$replace1 = array(
			'[remove_script]' => $remove_script
		);
		$script_remove_vlan_olt1 = strReplaceAssoc($replace1,$data_remove_vlan_olt["script"]);
		
		$script_remove_vlan_olt2 = strReplaceAssoc($replaceSwitch,$script_remove_vlan_olt1);
		
		$flan3_switch = fopen('/usr/script/switch/remove_vlan_'.$userid.'.exp', 'w+');
		fwrite($flan3_switch, $script_remove_vlan_olt2);
		fclose($flan3_switch);
		chmod("/usr/script/switch/remove_vlan_".$userid.".exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				//tes 18 okto
				$output_remove_switch = shell_exec('expect /usr/script/switch/remove_vlan_'.$userid.'.exp');
				
				//sleep(30);

			}
			//tes 18okto
			$output_create_switch = shell_exec('expect /usr/script/switch/create_vlan_new_'.$userid.'.exp');
			//sleep(30);
			
			$content_switch = '';
			$output_create_switch2 = '';
           
			
			//START SCRIPT SWTICH 2
			if($row_switch_olt["idparent_server"] != 0)
			{
				$result_switch2 = mysql_query("SELECT * FROM `software`.`gx_inet_listswitch` where `id_server` = '".$row_switch_olt["idparent_server"]."' LIMIT 0,1;", $conn);
				$row_switch2 = mysql_fetch_array($result_switch2);
			
				
				$create_vlan_switch = mysql_query("SELECT * FROM `software`.`gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_switch2_new+';", $conn);
				$data_create_vlan_switch = mysql_fetch_array($create_vlan_switch);
				
				$replaceSwitch2 = array(
					'[userid]' => $userid,
					'[ip_address]' => trim($row_switch2["ip_address"]), 
					'[username]' => trim($row_switch2["username"]), 
					'[password]' => trim($row_switch2["password"]),
					'[pon]' => $pon,
					'[pon_id]' => $pon_id,
					'[vlanid]' => $vlan,
					'[mac]' => $mac_address
				);
				$script_create_vlan_switch = strReplaceAssoc($replaceSwitch2,$data_create_vlan_switch["script"]);
				
				
				$flan4_switch = fopen('/usr/script/switch2/create_vlan2_'.$userid.'.exp', 'w+');
				fwrite($flan4_switch, $script_create_vlan_switch);
				fclose($flan4_switch);
				chmod("/usr/script/switch2/create_vlan2_".$userid.".exp",0755);
				
				
				
					$output_create_switch2 = shell_exec('expect /usr/script/switch2/create_vlan2_'.$userid.'.exp');
					
					
					$content_switch = '
									
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Create SWITCH</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_create_switch2.'</pre>
												</div>
											</div>
										</div>
									</div>';
				
			}
            
                
			
			//END SCRIPT SWTICH 2
			
			//////////////////////////
			//						//
			// END SWITCH SCRIPT	//
			//						//
			//////////////////////////
			
			//////////////////////////
			//						//
			// ESX SCRIPT			//
			//						//
			//////////////////////////
			
            $result_esx_vlan = mysql_query("SELECT * FROM `gx_data_vlan` where `userid_vlan` = '".$userid."' AND `flag_vlan` = 'aktif' LIMIT 0,1;", $conn);
			$row_server_esx_vlan	= mysql_fetch_array($result_esx_vlan);
            
            $id_server_esx  = $row_server_esx_vlan['id_esx'];
		
            
			$result_esx = mysql_query("SELECT * FROM `software`.`gx_inet_esx` where `id_server` = '".$id_server_esx."' LIMIT 0,1;", $conn);
			$row_server_esx	= mysql_fetch_array($result_esx);
		
		
			//select script from database	
			$vlan_esx 		= mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_esx' LIMIT 0,1;", $conn);
			$data_vlan_esx 	= mysql_fetch_array($vlan_esx);
			
			//select script from database	
			$power_on_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'power_on_vm' LIMIT 0,1;", $conn);
			$data_power_on_vm = mysql_fetch_array($power_on_vm);
			
			$power_off_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'power_off_vm' LIMIT 0,1;", $conn);
			$data_power_off_vm = mysql_fetch_array($power_off_vm);
			
			//select script from database	
			$status_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_vm' LIMIT 0,1;", $conn);
			$data_status_vm = mysql_fetch_array($status_vm);
			
			$replace_esx = array(
				'[userid]' => trim($userid),
				'[ip_address]' => trim($row_server_esx["ip_address"]), 
				'[username]' => trim($row_server_esx["username"]), 
				'[password]' => trim($row_server_esx["password"]),
				
				'[vlan]' => $vlan
			);
			
			$script_show_vlan_esx	= strReplaceAssoc($replace_esx,$data_vlan_esx["script"]);
			$script_power_on 		= strReplaceAssoc($replace_esx,$data_power_on_vm["script"]);
			$script_power_off 		= strReplaceAssoc($replace_esx,$data_power_off_vm["script"]);
			
			
			$funreg = fopen('/usr/script/esx/show_vlan_'.$userid.'.exp', 'w+');
			fwrite($funreg, $script_show_vlan_esx);
			fclose($funreg);
			chmod("/usr/script/esx/show_vlan_".$userid.".exp",0755);
			
			$fh = fopen('/usr/script/esx/power_vm_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_power_on);
			fclose($fh);
			chmod("/usr/script/esx/power_vm_".$userid.".exp",0755);
			
			$fh = fopen('/usr/script/esx/power_off_vm_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_power_off);
			fclose($fh);
			chmod("/usr/script/esx/power_off_vm_".$userid.".exp",0755);
			
			
			
			$output_show_vlan_esx = shell_exec('expect /usr/script/esx/show_vlan_'.$userid.'.exp');
			
			$logFile = '/usr/script/esx/show-vlan-esx_'.$userid.'.txt';
			$lines = file($logFile);
			$line_data =  count ($lines) -2;
			
			$id_esx = $lines[$line_data];
			$id_esx = trim(substr($id_esx, 0, 6));
			
			$replace_power = array(
				'[id_esx]' => trim($id_esx)
			);
			
			$script_power_on 		= strReplaceAssoc($replace_power, $script_power_on);
			$script_power_off 		= strReplaceAssoc($replace_power, $script_power_off);
			
			$replace_vm = array(
				'[userid]' => trim($userid),
				'[ip_address]' => trim($row_server_esx["ip_address"]), 
				'[username]' => trim($row_server_esx["username"]), 
				'[password]' => trim($row_server_esx["password"]),
				'[id_esx]' => trim($id_esx)
			);
			$script_status_vm		= strReplaceAssoc($replace_vm,$data_status_vm["script"]);
			
			$fh = fopen('/usr/script/esx/power_vm_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_power_on);
			fclose($fh);
			chmod("/usr/script/esx/power_vm_".$userid.".exp",0755);
            
            $fh = fopen('/usr/script/esx/power_off_vm_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_power_on);
			fclose($fh);
			chmod("/usr/script/esx/power_vm_".$userid.".exp",0755);
			
			$fstatusvm = fopen('/usr/script/esx/status_vm_'.$userid.'.exp', 'w+');
			fwrite($fstatusvm, $script_status_vm);
			fclose($fstatusvm);
			chmod("/usr/script/esx/status_vm_".$userid.".exp",0755);
			
			$ping_ipvlan = pingAddress($data_ip_vm['ipaddress_ipvm']);
			
			if($ping_ipvlan == "dead")
			{
				$output_status_ping = 'ok';
				
			
			$output_power_on_vm = shell_exec('expect /usr/script/esx/power_vm_'.$userid.'.exp');
			sleep(30);
			$output_status_vm = shell_exec('expect /usr/script/esx/status_vm_'.$userid.'.exp');
			sleep(10);
			
			//////////////////////////
			//						//
			// END ESX SCRIPT		//
			//						//
			//////////////////////////
			
			//////////////////////////
			//						//
			// DHCP LEASE 			//
			//						//
			//////////////////////////

//change ip
$ip_vlan_baru = mysql_query("SELECT * FROM `gx_master_ipvm` WHERE ((`userid_ip` IS NULL) OR (`userid_ip` = '')) AND ((`flag_ip` IS NULL) OR (`flag_ip`='')) AND `level` = '0' ORDER BY `ip_address` ASC LIMIT 0,1;", $conn);
$data_ip_vlan_baru = mysql_fetch_array($ip_vlan_baru);

$ip_baru = long2ip($data_ip_vlan_baru["ip_address"]);

//update userid ke ip vlan
mysql_query("UPDATE `gx_master_ipvm` SET `keterangan_ip`='aktif', `flag_ip`='aktif', `userid_ip`='".$userid."',
			`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
			WHERE (`id_ip`='".$data_ip_vlan_baru["id_ip"]."');");



//select script from database	
$vlan_mac = mysql_query("SELECT * FROM `gx_data_vlan` WHERE `userid_vlan` = '".$userid."' AND `flag_vlan` = 'aktif' LIMIT 0,1;", $conn);
$data_vlan_mac = mysql_fetch_array($vlan_mac);

$customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$userid."' LIMIT 0,1;", $conn);
$data_customer = mysql_fetch_array($customer);

//get data ip vlan, service name, subnet ip pool vlan
$result_servicename = mysql_query("SELECT * FROM `v_master_ip` where `ip_address` = '".ip2long($data_customer['user_ip'])."' LIMIT 0,1;", $conn);
$row_servicename = mysql_fetch_array($result_servicename);

//script dhcp lease print
$dhcp_print = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'dhcp_lease_print' LIMIT 0,1;", $conn);
$data_dhcp_print = mysql_fetch_array($dhcp_print);

//script add alias ip vlan
$add_ip_vlan = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'add_ip_vlan' LIMIT 0,1;", $conn);
$data_add_ip_vlan = mysql_fetch_array($add_ip_vlan);

$api_vm = new RouterosAPI();
$api_vm->debug = false;

//step2
if ($api_vm->connect($data_ip_vm['ipaddress_ipvm'], $data_ip_vm['username_ipvm'], $data_ip_vm['password_ipvm']))
{
    //dhcp lease
    $api_vm->write($data_dhcp_print["script"]);
    $READ = $api_vm->read(false);
    $ARRAY_DHCP = $api_vm->parseResponse($READ);
    
    //echo "<pre>";
    //print_r($ARRAY);
    //echo "</pre>";
    
    $output_status_dhcp = '<table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Data</th>
                  <th>Value</th>
                </tr>';
                
              
    $no = 1;
    if(count($ARRAY_DHCP) >= 1)
    {
        foreach($ARRAY_DHCP[0] as $key => $value)
        {
			if($key == "address" OR $key == "mac-address" OR $key == "host-name"){
                $output_status_dhcp .= '<tr>
                              <td>'.$no.'.</td>
                              <td>'.$key.'</td>
                              <td>'.$value.'</td>
                            </tr>';
                $no++;
            }
            
        }
        
    }
    $output_status_dhcp .= '</tbody></table>';
   
    //$api_vm->write($script_ip_vlan);
    $api_vm->write('/ip/address/add', false);
    $api_vm->write('=address='.$ip_baru.'/'.$row_servicename['subnet_ip'], false);
    $api_vm->write('=interface='.$data_ip_vm['interface_ipvm']);
    
    $READ = $api_vm->read(false);
    $output_ip_vlan = $api_vm->parseResponse($READ);
    $output_ip_vlan = 'IP Address VLAN : '. $ip_baru;
    
}
else
{
    $output_status_dhcp = "Tidak Bisa Login ke Mesin VM";
    $output_ip_vlan = "Tidak Bisa Login ke Mesin VM";
}

			}
			else
			{
				$output_status_ping = 'Maaf, IP Address VLAN Default Conflict';
				
				$output_power_on_vm = "Gagal";
				$output_status_vm	= "Gagal";
				$output_status_dhcp = "Tidak Bisa Login ke Mesin VM";
				$output_ip_vlan 	= "Tidak Bisa Login ke Mesin VM";
			
			}


			//////////////////////////
			//						//
			// END DHCP LEASE 		//
			//						//
			//////////////////////////
			
			//$output = shell_exec("olt/script_'.$userid.'.exp");
			$content .= '<h3 class="box-title">Keterangan</h3>
						<hr>
                                
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Unreg ONU TEST</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_unreg.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Reg ONU</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_reg.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Config ONU</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_config.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Show VLAN OLT</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_show.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Remove VLAN OLT</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_remove.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Create VLAN</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_create.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Show VLAN SWITCH</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_show_switch.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Remove VLAN SWITCH</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_remove_switch.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Create VLAN SWITCH</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_create_switch.'</pre>
												</div>
											</div>
										</div>
									</div>
									<h4>Swith 2</h4>
									'.$content_switch.'
									
									<h4>ESX Server</h4>
									<div class="row">
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Show VLAN ESX</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_show_vlan_esx.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Status Ping IP VLAN Default</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.($output_status_ping).'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Power ON VM</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_power_on_vm.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Status VM</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_status_vm.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="row">
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Status DHCP Lease</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.($output_status_dhcp).'</pre>
												</div>
											</div>
										</div>
									</div>
                                    
                                    <div class="row">
										<div class="col-xs-10">											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">IP VLAN</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.($output_ip_vlan).'</pre>
												</div>
											</div>
										</div>
									</div>
									
									
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												
											</div>
											<div class="col-xs-8">
												<button type="button" id="cek_dhcp" name="cek_dhcp" class="btn btn-warning">Step 2 (CEK DHCP LEASE)</button>
											
												'.((count($ARRAY_DHCP) < 1) ? '' : '<button type="button" id="aktifasi" name="aktifasi" class="btn btn-danger">Step 3 (AKTIFASI)</button>').'
											</div>
											
										</div>
									</div>
								';
								
				mysql_query("INSERT INTO `gx_chat_aktivasi` (`id_chat_aktivasi`, `idspk_aktivasi`, `idpengirim_aktivasi`, `idpenerima_aktivasi`, `pesan_aktivasi`, `date_aktivasi`)
					VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 2, ok', NOW());", $conn);
				
				mysql_query("INSERT INTO `gx_log_aktivasi_detail` (`id_detail`, `idlog_aktivasi`, `step_aktivasi`,
					`feedback_aktivasi`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '2.1. Unreg ONU TEST', '".mysql_real_escape_string($output_unreg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.2. Reg ONU Customer', '".mysql_real_escape_string($output_reg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.3. Config ONU Customer', '".mysql_real_escape_string($output_config)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.4. Show VLAN OLT', '".mysql_real_escape_string($output_show)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.5. Remove VLAN OLT', '".mysql_real_escape_string($output_remove)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					
					('', '".$uuid."', '2.6. Create VLAN OLT', '".mysql_real_escape_string($output_create)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.7. Show VLAN SWITCH', '".mysql_real_escape_string($output_show_switch)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.8. Remove VLAN SWITCH', '".mysql_real_escape_string($output_remove_switch)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.9. Create SWITCH', '".mysql_real_escape_string($output_create_switch)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					
					('', '".$uuid."', '2.10. Create SWITCH 2', '".mysql_real_escape_string($output_create_switch2)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.11. Show VLAN ESX', '".mysql_real_escape_string($output_show_vlan_esx)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.12. Status PING IP VLAN Default', '".mysql_real_escape_string($output_status_ping)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.13. Power ON VM', '".mysql_real_escape_string($output_power_on_vm)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.14. Status VM', '".mysql_real_escape_string($output_status_vm)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.15. Status DHCP Lease', '".mysql_real_escape_string($output_status_dhcp)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.16. IP VLAN', '".mysql_real_escape_string($output_ip_vlan)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		
						
			}
			//status onu hang/inactive
			else
			{
				$file_status_onu = '/usr/script/txt/'.$userid.'.txt';
				$lines = file($file_status_onu); // Get each line of the file and store it as an array
				//print_r($lines);
	
				foreach($lines as $key)
				{
					
					//$content .= "<tr>";
					$first_string = (explode(" ",$key));
					
					if (stripos($first_string[0], 'EPON') !== false)
					{
						$IntfName	= substr($key, 0, 10);
						$mac_addr	= substr($key, 11, 14);
						$status		= substr($key, 26, 15);
						$LastRegTime		= trim(substr($key, 42, 19));
						$LastDeregTime		= trim(substr($key, 62, 19));
						$LastDeregReason	= substr($key, 82, 17);
						$Abserttime			= substr($key, 100, 12);
						
						//$LastRegTime		= ($LastRegTime != "N/A") ? str_replace(".","-", substr($LastRegTime, 0, 10)) : "N/A";
						//$LastDeregTime		= ($LastDeregTime != "N/A") ? str_replace(".","-", substr($LastDeregTime, 0, 10)) : "N/A";
						
						$IntfName	= (explode(":",$IntfName));
						$pon		= trim(substr($IntfName[0], 4));
						$id_pon		= trim($IntfName[1]);
						
					}
				}
				
				$content .= '<h3 class="box-title">Keterangan</h3>
						<hr>
                                
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Unreg ONU TEST</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_unreg.'</pre>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Reg ONU</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_reg.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Status ONU</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_status_onu.'</pre>
													
													<pre>Status : '.$status.' </pre>
													
												</div>
											</div>
										</div>
									</div>
									
									
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												
											</div>
											<div class="col-xs-8">
												<button type="button" id="config_onu" name="config_onu" class="btn btn-warning">Step 2 (CONFIG ONU + POWER ON VM)</button>
											</div>
											
										</div>
									</div>
								';
				mysql_query("INSERT INTO `gx_chat_aktivasi` (`id_chat_aktivasi`, `idspk_aktivasi`, `idpengirim_aktivasi`, `idpenerima_aktivasi`, `pesan_aktivasi`, `date_aktivasi`)
					VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 2, onu hang/rusak', NOW());", $conn);

				mysql_query("INSERT INTO `gx_log_aktivasi_detail` (`id_detail`, `idlog_aktivasi`, `step_aktivasi`,
					`feedback_aktivasi`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '2.1. Unreg ONU TEST', '".mysql_real_escape_string($output_unreg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.2. Reg ONU Customer', '".mysql_real_escape_string($output_reg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.3. Status ONU Customer', '".mysql_real_escape_string($output_status_onu)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
						
			}
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}

}

echo $content;