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
		
		$logFile = '/var/www/software/beta/admin/data/olt/aktivasi/show-vlan.txt';
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
				echo $pon."<br>";
				//print_r($str_value);
				if($pon[0] == "G" )
				{
$remove_script .= 'expect "#"
send "interface g0/3\r"
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
		
		$replace2 = array(
			'[userid]' => 'mukidi',
			'[ip_address]' => '172.17.8.212', 
			'[username]' => 'admin', 
			'[password]' => 'admin',
			'[pon]' => '',
			'[pon_id]' => '',
			'[vlanid]' => '1234',
			'[mac]' => '',
			
		);
		
		$script_remove_vlan_olt2 = strReplaceAssoc($replace2,$script_remove_vlan_olt1);
		
		
		
		$flan3 = fopen('olt/aktivasi/remove_vlan_olt2.exp', 'w');
		fwrite($flan3, $script_remove_vlan_olt2);
		fclose($flan3);
		chmod("/var/www/software/beta/admin/data/olt/aktivasi/remove_vlan_olt2.exp",0755);
		//
		//expect "#"
		//send "interface ePON [pon]\r"
		//expect "#"
		//send "switchport trunk vlan-allowed remove [vlanid]\r"
		//expect "#"
		//send "interface g0/3\r"
		//expect "#"
		//send "switchport trunk vlan-allowed remove [vlanid]\r"
		//
		//$script_remove_vlan_olt = strReplaceAssoc($replace,$data_remove_vlan_olt["script"]);
		//
		//
		//$flan3 = fopen('olt/aktivasi/remove_vlan_olt_new.exp', 'w');
		//fwrite($flan3, $script_remove_vlan_olt);
		//fclose($flan3);
		//chmod("/var/www/software/beta/admin/data/olt/aktivasi/remove_vlan_olt_new.exp",0755);
		
	
	}
}
else
{
	header('location: '.URL_ADMIN.'logout.php');
}

?>