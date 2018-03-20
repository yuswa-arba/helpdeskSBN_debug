<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
/*include ("../../config/configuration_admin.php");

if(isset($_POST["userid"]))
{
	$userid      = isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$vlan		 = isset($_POST['vlan']) ? mysql_real_escape_string(trim($_POST['vlan'])) : '';
	$id_olt		 = isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
	$pon		 = isset($_POST['pon']) ? mysql_real_escape_string(trim($_POST['pon'])) : '';
	$pon_id			 = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$mac_address = isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
	$id_timpasang = isset($_POST['id_timpasang']) ? mysql_real_escape_string(trim($_POST['id_timpasang'])) : '';
	
	
	if($userid != "")
	{
	
		//insert log aktivasi
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW());", $conn);
		
		
		//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		
		if($count_olt_customer == 1)
		{
			
			//select script from database	
			$reg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'reg_onu';", $conn);
			$data_reg_onu = mysql_fetch_array($reg_onu);
			
			$power_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'power_onu';", $conn);
			$data_power_onu = mysql_fetch_array($power_onu);
			
			/////////////////////
			//
			// ONU TEST SCRIPT
			//
			///////////////////
			$replace = array(
				'[userid]' => $userid,
				'[ip_address]' => trim($row_olt_customer["ip_address"]), 
				'[username]' => trim($row_olt_customer["username"]), 
				'[password]' => trim($row_olt_customer["password"]),
				'[uplink]' => trim($row_olt_customer["uplink_port"]),
				'[pon]' => $pon,
				'[pon_id]' => $pon_id,
				'[vlanid]' => $vlan,
				'[mac]' => $row_onu_test['macaddress']
			);
			$script_reg_onu 		= strReplaceAssoc($replace,$data_reg_onu["script"]);
			$script_power_onu 		= strReplaceAssoc($replace,$data_power_onu["script"]);
			
			$fh = fopen('/usr/script/onu/reg_onu.exp', 'w');
			fwrite($fh, $script_reg_onu);
			fclose($fh);
			chmod("/usr/script/onu/reg_onu.exp",0755);
			
			$flan1 = fopen('/usr/script/onu/power_onu.exp', 'w');
			fwrite($flan1, $script_power_onu);
			fclose($flan1);
			chmod("/usr/script/onu/power_onu.exp",0755);
			
			
			$output_reg = shell_exec('expect /usr/script/onu/reg_onu.exp');
			sleep(60);
			$output_power = shell_exec('expect /usr/script/onu/power_onu.exp');
			//sleep(30);
			
			$logFile = '/usr/script/onu/power-test.txt';
			$lines = file($logFile); // Get each line of the file and store it as an array
			$line_data =  count ($lines) - 2;
			
			$output_power = substr($lines[$line_data], 21);
			
			
			//sleep(30);
			/////////////////////
			//
			// END ONU TEST SCRIPT
			//
			///////////////////
			
			$content = '<div class="row">
					<div class="col-xs-12 col-lg-12">
					    
			<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Keterangan</h3>
                                    
                                </div>
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-4">
											<label>Reg ONU</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_reg.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Power ONU</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_power.'</pre>
										</div>
									</div>
									
                                </div><!-- /.box-body -->
                            </div>
						</div>
					</div>';
		}
		else
		{
			$content = "<pre>UserID $userid tidak ditemukan.</pre>";
		}
		
		echo $content;
	}
}
*/
$output_show_vlan_esx = shell_exec('expect /usr/script/esx/show_vlan_esx.exp');
//echo $output_show_vlan_esx;
$logFile = '/usr/script/esx/show-vlan-esx.txt';
//echo $logFile;
$lines = file($logFile); // Get each line of the file and store it as an array
$line_data =  count ($lines) -2;
$remove_script = '';

$id_esx = $lines[$line_data];
$id_esx = trim(substr($id_esx, 0, 6));

echo $id_esx;
//$output_show = shell_exec('expect /usr/script/olt/show_vlan_olt.exp');
//
//echo nl2br ($output_show);
/*
use ssh\Net\SFTP;

$sftp = new SFTP('www.example.com');

if (!$sftp->login('username', 'password')) {
	throw new Exception('Login failed');
}

$server = "172.17.9.51";
$username = "root";
$password = "globalesx";
$command = "vim-cmd vmsvc/getallvms |grep vlan2606";

$ssh = new Net_SSH2($server);
if (!$ssh->login($username, $password)) {
    exit('Login Failed');
}

echo $ssh->exec($command);*/