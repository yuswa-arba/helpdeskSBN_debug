<?php
include ("../../../config/configuration_admin.php");
include '../../../config/telnet/routeros_api.class.php';


$id_timpasang = '1';
$id_olt = '5';
$userid = '01_demo.bali';
global $conn;

//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		//echo "SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;";
		$result_switch_port = mysql_query("SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_switch_port = mysql_fetch_array($result_switch_port);
        
        $result_data_vlan = mysql_query("SELECT * FROM `gx_data_vlan` where `userid_vlan` = '".$userid."' LIMIT 0,1;", $conn);
		$row_data_vlan = mysql_fetch_array($result_data_vlan);
		
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		
		
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
				
				'[pon]' => '0/1',
				'[pon_id]' => '1',
				'[vlanid]' => '2606',
				'[mac]' => 'f0f1.f00f.f991'
			);
			
			$replaceOnutest = array(
				'[userid]' => $userid,
				'[ip_address]' => trim($row_olt_customer["ip_address"]), 
				'[username]' => trim($row_olt_customer["username"]), 
				'[password]' => trim($row_olt_customer["password"]),
				
				'[pon]' => '0/1',
				'[pon_id]' => '1',
				'[vlanid]' => '2606',
				'[mac]' => 'f0f1.f00f.f991'
			);
			
            
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
            
            echo "<pre>";
			print_r ($replace_uplink);
            echo "</pre>";
            
            //replace add multiple uplink
            $script_create_vlan_olt = strReplaceAssoc($replace_uplink,$data_create_vlan_olt["script"]);
			
            
            //replace data olt
            $script_create_vlan_olt = strReplaceAssoc($replace, $script_create_vlan_olt);
			
            echo "<pre>";
			print_r($script_create_vlan_olt);
            echo "</pre>";
            
            $funreg = fopen('/usr/script/olt/create_vlan_new.exp', 'w');
			fwrite($funreg, $script_create_vlan_olt);
			fclose($funreg);
			chmod("/usr/script/olt/create_vlan_new.exp",0755);
            
            
            
            $result_switch_olt = mysql_query("SELECT * FROM `v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_olt` = '".$id_olt."' LIMIT 0,1;", $conn);
			$row_switch_olt = mysql_fetch_array($result_switch_olt);
			//echo "SELECT * FROM `gx_inet_listswitch` where id_server = '".$row_switch_port["idswitch_port"]."' LIMIT 0,1;";
		
            $result_switch_esx = mysql_query("SELECT * FROM `v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_esx` = '".$row_data_vlan["id_esx"]."' LIMIT 0,1;", $conn);
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
				'[pon]' => '0/1',
				'[pon_id]' => '1',
				'[vlanid]' => '2606',
				'[mac]' => 'f0f1.f00f.f991'
			);
			$script_create_vlan_switch = strReplaceAssoc($replaceSwitch,$data_create_vlan_switch["script"]);
			echo "SELECT * FROM `v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_esx` = '".$row_data_vlan["id_esx"]."' LIMIT 0,1;";
			echo "uplink: ".$row_switch_esx["interface_port"];
			
			echo "<pre>";
			print_r($script_create_vlan_switch);
            echo "</pre>";
            
			$flan4_switch = fopen('/usr/script/switch/create_vlan_new.exp', 'w');
			fwrite($flan4_switch, $script_create_vlan_switch);
			fclose($flan4_switch);
			chmod("/usr/script/switch/create_vlan_new.exp",0755);
			