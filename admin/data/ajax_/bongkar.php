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

function pingAddress($ip)
{
    $pingresult = exec("/bin/ping -c 3 $ip", $outcome, $status);
    if (0 == $status) {
        $status = "alive";
    } else {
        $status = "dead";
    }
    //echo "The IP address, $ip, is  ".$status;
    return $status;
}

//var_dump($_REQUEST);


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
	$ip_vlan   		= isset($_REQUEST['ip_vlan']) ? mysql_real_escape_string(trim($_REQUEST['ip_vlan'])) : '';
	$ip_inet   		= isset($_REQUEST['ip_inet']) ? mysql_real_escape_string(trim($_REQUEST['ip_inet'])) : '';
	
	
	if($userid != "")
	{
		
		//insert log aktivasi
		$uuid = get_uuid('gx_log_bongkar');
		$uuid_detail = get_uuid('gx_log_bongkar_detail');
		//echo $uuid;
		mysql_query("INSERT INTO `gx_log_bongkar` (`id_log_bongkar`, `uuid_log_bongkar`, `userid_bongkar`, `vlan_bongkar`, `idolt_bongkar`,
					`pon_bongkar`, `ponid_bongkar`, `macaddress_bongkar`, `log`, `step`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
                    NOW(), 'BONGKAR',
					'".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		
	
		//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		
		$result_customer = mysql_query("SELECT * FROM `tbCustomer` where `cUserID` = '".$userid."' LIMIT 0,1;", $conn);
		$row_customer = mysql_fetch_array($result_customer);
			
		$result_switch_port = mysql_query("SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_switch_port = mysql_fetch_array($result_switch_port);
        
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		
		if($count_olt_customer == 1)
		{
			//select script from database	
			$unreg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'bongkar_unreg_onu';", $conn);
			$data_unreg_onu = mysql_fetch_array($unreg_onu);
			
			
			
#-----------------------------
#	1. Reset VM
#-----------------------------


//select script from database	
$vlan_mac = mysql_query("SELECT * FROM `gx_data_vlan` WHERE `userid_vlan` = '".$userid."' AND `flag_vlan` = 'aktif' AND `level` = '0' LIMIT 0,1;", $conn);
$data_vlan_mac = mysql_fetch_array($vlan_mac);

$customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$userid."' LIMIT 0,1;", $conn);
$data_customer = mysql_fetch_array($customer);

//get data ip vlan, service name, subnet ip pool vlan
//echo "SELECT * FROM `v_master_ip` where `userid_ip` = '".$userid."' LIMIT 0,1;";
$result_servicename = mysql_query("SELECT * FROM `v_master_ip` where `userid_ip` = '".$userid."' LIMIT 0,1;", $conn);
$row_servicename = mysql_fetch_array($result_servicename);
//echo "<pre>";
//print_r($row_servicename);
//echo "</pre>";

//script dhcp lease print
$dhcp_print = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'dhcp_lease_print' LIMIT 0,1;", $conn);
$data_dhcp_print = mysql_fetch_array($dhcp_print);

//script add alias ip vlan
$add_ip_vlan = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'add_ip_vlan' LIMIT 0,1;", $conn);
$data_add_ip_vlan = mysql_fetch_array($add_ip_vlan);

//get data default IP VM Master
$ip_vm = mysql_query("SELECT * FROM `gx_inet_ipvm` LIMIT 0,1;", $conn);
$data_ip_vm = mysql_fetch_array($ip_vm);

$api_vm = new RouterosAPI();
$api_vm->debug = false;


//step2
if ($api_vm->connect(trim($ip_vlan), $data_ip_vm['username_ipvm'], $data_ip_vm['password_ipvm']))
{
    //1. get id pppoe-client
    $api_vm->write('/interface/pppoe-client/print');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    $id_pppoe_client = $ARRAY[0][".id"];
	
	//print_r($ARRAY);
	
	//print_r($output_hostname);
    //config pppoe-client
    
	//2.Set user pass
	$api_vm->write('/interface/pppoe-client/set', false);
    $api_vm->write('=.id='.$id_pppoe_client, false);
    $api_vm->write('=user=global', false);
    $api_vm->write('=password=global');
    $READ = $api_vm->read(false);
    $output_pppoe = $api_vm->parseResponse($READ);
	//print_r($output_pppoe);
	
	
	
	
    //3. disable pppoe-client
    $api_vm->write('/interface/pppoe-client/disable', false);
    $api_vm->write('=.id='.$id_pppoe_client);
    $READ = $api_vm->read(false);
    $output_pppoe2 = $api_vm->parseResponse($READ);
    //print_r($output_pppoe2);
	
    $api_vm->write('/interface/pppoe-client/print');
    $READ = $api_vm->read(false);
    $output_pppoe3 = $api_vm->parseResponse($READ);
    //print_r($output_pppoe3);
	
	//hostname
    $api_vm->write('/system/identity/set', false);
    $api_vm->write('=name=globalxtreme');
    $READ = $api_vm->read(false);
    //$ARRAY = $api_vm->parseResponse($READ);
    $api_vm->write('/system/identity/print');
    $READ = $api_vm->read(false);
    $output_hostname = $api_vm->parseResponse($READ);
    $output_hostname = $output_hostname[0]['name'];
	
	$status_bongkar = $output_hostname.'\n';
	//$status_bongkar .= $output_pppoe;
	
	
}
else
{
    $output_hostname = "Tidak Bisa Login ke Mesin VM";
    $output_pppoe = "Tidak Bisa Login ke Mesin VM";
    $status_bongkar = '<h3 class="box-title danger">Aktivasi Gagal.</h3>';
}


			

#-----------------------------
#	2. Power Off
#-----------------------------
$result_esx_vlan = mysql_query("SELECT * FROM `gx_data_vlan` where `userid_vlan` = '".$userid."' AND `flag_vlan` = 'aktif' LIMIT 0,1;", $conn);
$row_server_esx_vlan	= mysql_fetch_array($result_esx_vlan);

$id_server_esx  = $row_server_esx_vlan['id_esx'];


$result_esx = mysql_query("SELECT * FROM `gx_inet_esx` where `id_server` = '".$id_server_esx."' LIMIT 0,1;", $conn);
$row_server_esx	= mysql_fetch_array($result_esx);


//select script from database	
$vlan_esx 		= mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'bongkar_show_vlan_esx' LIMIT 0,1;", $conn);
$data_vlan_esx 	= mysql_fetch_array($vlan_esx);

$power_off_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'bongkar_power_off_vm' LIMIT 0,1;", $conn);
$data_power_off_vm = mysql_fetch_array($power_off_vm);

//select script from database	
$status_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_vm' LIMIT 0,1;", $conn);
$data_status_vm = mysql_fetch_array($status_vm);

$replace_esx = array(
	'[userid]' => $userid,
	'[ip_address]' => trim($row_server_esx["ip_address"]), 
	'[username]' => trim($row_server_esx["username"]), 
	'[password]' => trim($row_server_esx["password"]),
	'[vlan]' => $vlan
);

$script_show_vlan_esx	= strReplaceAssoc($replace_esx,$data_vlan_esx["script"]);
$script_power_off 		= strReplaceAssoc($replace_esx,$data_power_off_vm["script"]);


$funreg = fopen('/usr/script/bongkar/show_vlan_'.$userid.'.exp', 'w+');
fwrite($funreg, $script_show_vlan_esx);
fclose($funreg);
//chmod("/usr/script/bongkar/show_vlan_'.$userid.'.exp",0755);

$fh = fopen('/usr/script/bongkar/power_off_vm_'.$userid.'.exp', 'w+');
fwrite($fh, $script_power_off);
fclose($fh);
//chmod("/usr/script/bongkar/power_off_vm.exp",0755);



$output_show_vlan_esx = shell_exec('expect /usr/script/bongkar/show_vlan_'.$userid.'.exp');

$logFile = '/usr/script/bongkar/show-vlan-esx.txt';
$lines = file($logFile);
$line_data =  count ($lines) -2;

$id_esx = $lines[$line_data];
$id_esx = trim(substr($id_esx, 0, 6));

$replace_power = array(
	'[id_esx]' => trim($id_esx)
);

$script_power_off 		= strReplaceAssoc($replace_power, $script_power_off);

$replace_vm = array(
	'[userid]'	=> $userid,
	'[ip_address]' => trim($row_server_esx["ip_address"]), 
	'[username]' => trim($row_server_esx["username"]), 
	'[password]' => trim($row_server_esx["password"]),
	'[id_esx]' => trim($id_esx)
);
$script_status_vm		= strReplaceAssoc($replace_vm,$data_status_vm["script"]);

$fh = fopen('/usr/script/bongkar/power_off_vm_'.$userid.'.exp', 'w+');
fwrite($fh, $script_power_off);
fclose($fh);
//chmod("/usr/script/bongkar/power_vm.exp",0755);

$fstatusvm = fopen('/usr/script/bongkar/status_vm_'.$userid.'.exp', 'w+');
fwrite($fstatusvm, $script_status_vm);
fclose($fstatusvm);
//chmod("/usr/script/bongkar/status_vm.exp",0755);

$ping_ipvlan = pingAddress($data_ip_vm['ipaddress_ipvm']);

//if($ping_ipvlan == "dead")
//{

$output_power_off_vm = shell_exec('expect /usr/script/bongkar/power_off_vm_'.$userid.'.exp');
sleep(10);
$output_status_vm = shell_exec('expect /usr/script/bongkar/status_vm_'.$userid.'.exp');
//sleep(10);
//}

#-----------------------------
#	3.Unreg ONU
#-----------------------------
//select script from database	
$unreg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'bongkar_unreg_onu';", $conn);
$data_unreg_onu = mysql_fetch_array($unreg_onu);
//script cek status onu
$status_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_onu';", $conn);
$data_status_onu = mysql_fetch_array($status_onu);


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
$replaceStatus = array(
	'[userid]' => trim($userid), 
	'[ip_address]' => trim($row_olt_customer["ip_address"]), 
	'[username]' => trim($row_olt_customer["username"]), 
	'[password]' => trim($row_olt_customer["password"]),
	'[pon]' => trim($pon),
	'[id]' => trim($pon_id)
); 
$script_status_onu 		= strReplaceAssoc($replaceStatus,$data_status_onu["script"]);
$script_unreg_onu 		= strReplaceAssoc($replace,$data_unreg_onu["script"]);

$funreg = fopen('/usr/script/bongkar/unreg_onu_'.$userid.'.exp', 'w+');
fwrite($funreg, $script_unreg_onu);
fclose($funreg);
//chmod("/usr/script/olt/unreg_onu_'.$userid.'.exp",0755);

$output_unreg = shell_exec('expect /usr/script/olt/unreg_onu_'.$userid.'.exp');


#-----------------------------
#	4. Remove VLAN OLT,
#	Switch, Helpdesk
#-----------------------------

#-----------------------------
#	4.1 Remove VLAN OLT
#-----------------------------
$output_remove = "";
$output_remove_switch = "";

$show_vlan = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_olt';", $conn);
$data_show_vlan = mysql_fetch_array($show_vlan);

$script_show_vlan 		= strReplaceAssoc($replace,$data_show_vlan["script"]);
			
			
	$flan2 = fopen('/usr/script/bongkar/show_vlan_olt_'.$userid.'.exp', 'w+');
	fwrite($flan2, $script_show_vlan);
	fclose($flan2);
	//chmod("/usr/script/bongkar/show_vlan_olt.exp",0755);
	
	
	$output_show = shell_exec('expect /usr/script/bongkar/show_vlan_olt_'.$userid.'.exp');
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
		
		$flan3 = fopen('/usr/script/bongkar/remove_vlan_olt2_'.$userid.'.exp', 'w+');
		fwrite($flan3, $script_remove_vlan_olt2);
		fclose($flan3);
		chmod("/usr/script/bongkar/remove_vlan_olt2_".$userid.".exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				$output_remove = shell_exec('expect /usr/script/bongkar/remove_vlan_olt2_'.$userid.'.exp');
				//sleep(30);

			}

#-----------------------------
#	4.2 Remove VLAN Switch
#-----------------------------
/*$result_data_vlan = mysql_query("SELECT * FROM `gx_data_vlan` where `userid_vlan` = '".$userid."' AND `level` = '0' LIMIT 0,1;", $conn);
$row_data_vlan = mysql_fetch_array($result_data_vlan);

$show_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_switch';", $conn);
$data_show_vlan_switch = mysql_fetch_array($show_vlan_switch);

$result_switch_olt = mysql_query("SELECT * FROM `v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_olt` = '".$id_olt."' LIMIT 0,1;", $conn);
$row_switch_olt = mysql_fetch_array($result_switch_olt);

$result_switch_esx = mysql_query("SELECT * FROM `v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_esx` = '".$row_data_vlan["id_esx"]."' LIMIT 0,1;", $conn);
$row_switch_esx = mysql_fetch_array($result_switch_esx);

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

$script_show_vlan_switch 		= strReplaceAssoc($replaceSwitch,$data_show_vlan_switch["script"]);
			//$script_remove_vlan_olt = strReplaceAssoc($replace,$data_remove_vlan_olt["script"]);
			
			
			$fileswitch = fopen('/usr/script/bongkar/show_vlan_switch_'.$userid.'.exp', 'w+');
			fwrite($fileswitch, $script_show_vlan_switch);
			fclose($fileswitch);
			//chmod("/usr/script/bongkar/show_vlan_switch.exp",0755);
			
			$output_show_switch = shell_exec('expect /usr/script/bongkar/show_vlan_switch_'.$userid.'.exp');
			
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
		
		$flan3_switch = fopen('/usr/script/bongkar/remove_vlan_'.$userid.'.exp', 'w+');
		fwrite($flan3_switch, $script_remove_vlan_olt2);
		fclose($flan3_switch);
		//chmod("/usr/script/switch/remove_vlan.exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				//tes 18 okto
				$output_remove_switch = shell_exec('expect /usr/script/bongkar/remove_vlan_'.$userid.'.exp');
				
				//sleep(30);

			}
*/
#-----------------------------
#	4.3 Remove VLAN Helpdesk
#-----------------------------
$olt_customer = mysql_query("SELECT * FROM `gx_inet_olt_customer` WHERE `userid` = '".$userid."' LIMIT 0,1;", $conn);
$data_olt_customer = mysql_fetch_array($olt_customer);

$remove_vlan_helpdesk = mysql_query("UPDATE `gx_data_vlan` SET `userid_vlan`='', `mac_address`='',
								`user_upd`='".$loggedin["username"]."', `date_upd`=NOW()
								WHERE (`vlan`='".$vlan."');", $conn);
$remove_vlan_helpdesk = 'ok';

$remove_olt_customer = mysql_query("UPDATE `gx_inet_olt_customer` SET `userid`='' WHERE (`id_olt_customer`='".$data_olt_customer["id_olt_customer"]."');", $conn);
$remove_olt_customer = 'ok';
#-----------------------------
#	5.Remove IP Pool
#-----------------------------

$remove_ip_pool = mysql_query("UPDATE `gx_master_ip` SET `keterangan_ip`='bongkar', `userid_ip`='',
							  `date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
							  WHERE (`ip_address`='".ip2long($ip_inet)."');", $conn);
$remove_ip_pool = 'ok';

#----------------------------
#	6.Remove ip vlan
#----------------------------

//$remove_ip_vlan = mysql_query("UPDATE `gx_master_ip` SET `keterangan_ip`='bongkar', `userid_ip`='',
//							  `date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
//							  WHERE (`ip_address`='".ip2long($ip_inet)."');", $conn);
//$remove_ip_vlan = 'ok';

	$content .= '<h3 class="box-title">Keterangan</h3>
                                    <hr>
                                
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">1. Reset Data VM</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$status_bongkar.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">2. Power Off VM</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_power_off_vm.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">3. Unreg ONU</h3>
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
													<h3 class="box-title">4.1. Remove VLAN OLT</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$remove_vlan_olt.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">4.2. Remove VLAN Switch</h3>
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
													<h3 class="box-title">4.3. Remove VLAN Helpdesk</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$remove_vlan_helpdesk.'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">5. Remove IP Pool</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$remove_ip_pool.'</pre>
												</div>
											</div>
										</div>
									</div>
								';
								
		
			mysql_query("INSERT INTO `gx_log_bongkar_detail` (`id_detail`, `idlog_bongkar`, `step_bongkar`,
					`feedback_bongkar`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '1. Reset Data VM', '".mysql_real_escape_string($status_bongkar)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2. Power Off VM', '".mysql_real_escape_string($output_power_off_vm)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '3. Unreg ONU', '".$output_unreg."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '4.1. Remove VLAN OLT', '".$remove_vlan_olt."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					
					('', '".$uuid."', '4.2. Remove VLAN Helpdesk', '".$remove_vlan_helpdesk."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '5. Remove IP Pool', '".mysql_real_escape_string($remove_ip_pool)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		//('', '".$uuid."', '4.2. Remove VLAN Switch', '".$remove_vlan."',
		//			NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}
}

echo $content;