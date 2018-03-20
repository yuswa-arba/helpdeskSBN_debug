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
	
	$mac_address_baru    = isset($_REQUEST['mac_address_baru']) ? mysql_real_escape_string(trim($_REQUEST['mac_address_baru'])) : '';
	$id_timpasang   = isset($_REQUEST['id_timpasang']) ? mysql_real_escape_string(trim($_REQUEST['id_timpasang'])) : '';
	
    $tv		    = isset($_REQUEST['tv']) ? mysql_real_escape_string(trim($_REQUEST['tv'])) : '';
    $voip	    = isset($_REQUEST['voip']) ? mysql_real_escape_string(trim($_REQUEST['voip'])) : '';
	
	$onu_tipe	= isset($_REQUEST['onu_tipe']) ? mysql_real_escape_string(trim($_REQUEST['onu_tipe'])) : '';
	
	if($userid != "")
	{
	
		//insert log aktivasi
		$uuid = get_uuid('gx_log_gantionu');
		$uuid_detail = get_uuid('gx_log_gantionu_detail');
		//echo $uuid;
		mysql_query("INSERT INTO `gx_log_gantionu` (`id_log_gantionu`, `uuid_log_gantionu`, `userid_gantionu`, `vlan_gantionu`, `idolt_gantionu`,
					`pon_gantionu`, `ponid_gantionu`, `macaddress_gantionu`, `macaddress_baru_gantionu`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
					VALUES ('', '".$uuid."', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', '".$mac_address_baru."',
                    NOW(), 'STEP 1 GANTI ONU MAC ADDRESS BARU',
					'".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');", $conn);

		//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		//echo "SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;";
		$result_switch_port = mysql_query("SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;", $conn);
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
				'[mac]' => $mac_address_baru
			);
			
			$replaceOnulama = array(
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
			$script_unreg_onu 		= strReplaceAssoc($replaceOnulama,$data_unreg_onu["script"]);
			$script_reg_onu 		= strReplaceAssoc($replace,$data_reg_onu["script"]);
			
			$script_status_onu 		= strReplaceAssoc($replaceStatus,$data_status_onu["script"]);
			
			
            
            $funreg = fopen('/usr/script/replace/unreg_onu_'.$userid.'.exp', 'w+');
			fwrite($funreg, $script_unreg_onu);
			fclose($funreg);
			chmod("/usr/script/replace/unreg_onu_".$userid.".exp",0755);
			
			$fh = fopen('/usr/script/replace/reg_onu_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_reg_onu);
			fclose($fh);
			chmod("/usr/script/replace/reg_onu_".$userid.".exp",0755);
			
			$fstatus = fopen('/usr/script/replace/status_onu_'.$userid.'.exp', 'w+');
			fwrite($fstatus, $script_status_onu);
			fclose($fstatus);
			chmod("/usr/script/replace/status_onu_".$userid.".exp",0755);
			
			
			
			
			$output_unreg = shell_exec('expect /usr/script/replace/unreg_onu_'.$userid.'.exp');
			
			$output_reg = shell_exec('expect /usr/script/replace/reg_onu_'.$userid.'.exp');
			sleep(70);
			
			$output_status_onu = shell_exec('expect /usr/script/replace/status_onu_'.$userid.'.exp');
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
			
			
			$flan1 = fopen('/usr/script/replace/config_onu_'.$userid.'.exp', 'w+');
			fwrite($flan1, $script_config_onu);
			fclose($flan1);
			chmod("/usr/script/replace/config_onu_".$userid.".exp",0755);
			
			
			
			$output_config = shell_exec('expect /usr/script/replace/config_onu_'.$userid.'.exp');
			//sleep(10);
			

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
									
									
								';
								
				//mysql_query("INSERT INTO `gx_chat_aktivasi` (`id_chat_aktivasi`, `idspk_aktivasi`, `idpengirim_aktivasi`, `idpenerima_aktivasi`, `pesan_aktivasi`, `date_aktivasi`)
				//	VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 2, ok', NOW());", $conn);
				mysql_query("UPDATE `tbCustomer` SET `cMacAdd`='".$mac_address_baru."',
							`user_upd`='".$loggedin["username"]."', `date_upd`=NOW() WHERE (`cUserID`='".$userid."');", $conn);

				mysql_query("INSERT INTO `gx_log_gantionu_detail` (`id_detail`, `idlog_gantionu`, `step_gantionu`,
					`feedback_gantionu`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '2.1. Unreg ONU LAMA', '".mysql_real_escape_string($output_unreg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.2. Reg ONU BARU Customer', '".mysql_real_escape_string($output_reg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '2.3. Config ONU BARU Customer', '".mysql_real_escape_string($output_config)."',
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
				//mysql_query("INSERT INTO `gx_chat_gantionu` (`id_chat_gantionu`, `idspk_gantionu`, `idpengirim_gantionu`, `idpenerima_gantionu`, `pesan_gantionu`, `date_gantionu`)
				//	VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 2, onu hang/rusak', NOW());", $conn);

				mysql_query("INSERT INTO `gx_log_gantionu_detail` (`id_detail`, `idlog_gantionu`, `step_gantionu`,
					`feedback_gantionu`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '2.1. Unreg ONU LAMA', '".mysql_real_escape_string($output_unreg)."',
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