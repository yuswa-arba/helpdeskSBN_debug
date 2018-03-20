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

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form OLT Customer");


    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Aktivasi</h3>
									<hr>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Userid</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" required="" class="form-control" name="userid" value="'.(isset($_POST["userid"]) ? $_POST['userid'] : "").'">
												
                                            </div>
                                        </div>
                                        </div>
										
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>OLT Server</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <select class="form-control" name="id_olt">';
												
$sql_olt = mysql_query("SELECT * FROM `gx_inet_listolt` WHERE `level` = '0' ORDER BY `id_server` ASC", $conn);
while($row_olt = mysql_fetch_array($sql_olt)){
	$selected = (isset($_POST["id_olt"]) ? $_POST['id_olt'] : "");
	$selected = ($selected == $row_olt["id_server"]) ? ' selected=""' : "";
	
	$content .= '<option value="'.$row_olt["id_server"].'" '.$selected.'>'.$row_olt["nama_server"].'</option>';
	
}
						
						
						$content .= '
                                            </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>PON</h5>
												</div>
												<div class="col-xs-3">
													<select class="form-control" name="pon">
														<option value="0/1" '.(isset($_POST["pon"]) AND ($_POST["pon"] == "0/1") ? 'selected=""' : "").'>0/1</option>
														<option value="0/2" '.(isset($_POST["pon"]) AND ($_POST["pon"] == "0/2") ? 'selected=""' : "").'>0/2</option>
														<option value="0/3" '.(isset($_POST["pon"]) AND ($_POST["pon"] == "0/3") ? 'selected=""' : "").'>0/3</option>
														<option value="0/4" '.(isset($_POST["pon"]) AND ($_POST["pon"] == "0/4") ? 'selected=""' : "").'>0/4</option>
													</select>
												</div>
												<div class="col-xs-3">
													<h5>ID</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" required="" class="form-control" name="id" maxlength="2" value="'.(isset($_POST["id"]) ? $_POST['id'] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>VLAN</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" required="" class="form-control" name="vlan" value="'.(isset($_POST["vlan"]) ? $_POST['vlan'] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC ADDRESS</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" required="" class="form-control" name="mac_address" min-length="14" value="'.(isset($_POST["mac_address"]) ? $_POST['mac_address'] : "").'">
												</div>
												
											</div>
                                        </div>
										
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <select class="form-control" name="id_timpasang">';
												
$sql_olt = mysql_query("SELECT * FROM `gx_timpasang` WHERE `level` = '0' ORDER BY `id_timpasang` ASC", $conn);
while($row_olt = mysql_fetch_array($sql_olt)){
	$selected = isset($_POST["id_timpasang"]) ? $_POST["id_timpasang"] : "";
	$selected = ($selected == $row_olt["id_timpasang"]) ? ' selected=""' : "";
	
	$content .= '<option value="'.$row_olt["id_timpasang"].'" '.$selected.'>'.$row_olt["namapegawai_timpasang"].'</option>';
	
}
						
						
						$content .= '
                                            </select>
                                            </div>
                                        </div>
                                        </div>';

if(isset($_POST["step1"]))
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
			
			
			////$output_reg = shell_exec('expect /usr/script/onu/reg_onu.exp');
			////sleep(60);
			////$output_power = shell_exec('expect /usr/script/onu/power_onu.exp');
			//////sleep(30);
			
			$logFile = '/usr/script/onu/power-test.txt';
			$lines = file($logFile); // Get each line of the file and store it as an array
			$line_data =  count ($lines) - 2;
			
			$output_power = $lines[$line_data];
			$power = substr($lines[$line_data], 21);
			
			if(trim($power) <= -12 AND trim($power) >= -25)
			{
				$button = '<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													&nbsp;
												</div>
												<div class="col-xs-8">
													<button type="submit" name="aktifasi" class="btn btn-primary">Aktivasi</button>
												</div>
												
											</div>
                                        </div>';
			}
			else
			{
				$button = '<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													&nbsp;
												</div>
												<div class="col-xs-8">
													<button type="submit" name="cekpower" class="btn btn-primary">Cek Power</button>
												</div>
												
											</div>
                                        </div>';
			}
			
			
			//sleep(30);
			/////////////////////
			//
			// END ONU TEST SCRIPT
			//
			///////////////////
			
			$content .= '<hr><div class="row">
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
									'.$button.'
									
                                </div><!-- /.box-body -->
                            </div>
						</div>
					</div>';
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}
}
elseif(isset($_POST["cekpower"]))
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
			
			//$fh = fopen('/usr/script/onu/reg_onu.exp', 'w');
			//fwrite($fh, $script_reg_onu);
			//fclose($fh);
			//chmod("/usr/script/onu/reg_onu.exp",0755);
			
			$flan1 = fopen('/usr/script/onu/power_onu.exp', 'w');
			fwrite($flan1, $script_power_onu);
			fclose($flan1);
			chmod("/usr/script/onu/power_onu.exp",0755);
			
			
			//$output_reg = shell_exec('expect /usr/script/onu/reg_onu.exp');
			//sleep(60);
			////$output_power = shell_exec('expect /usr/script/onu/power_onu.exp');
			//sleep(30);
			
			$logFile = '/usr/script/onu/power-test.txt';
			$lines = file($logFile); // Get each line of the file and store it as an array
			$line_data =  count ($lines) - 2;
			
			$output_power = $lines[$line_data];
			$power = substr($lines[$line_data], 21);
			
			if(trim($power) <= -12 AND trim($power) >= -25)
			{
				$button = '<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													&nbsp;
												</div>
												<div class="col-xs-8">
													<button type="submit" name="aktifasi" class="btn btn-primary">Aktivasi</button>
												</div>
												
											</div>
                                        </div>';
			}
			else
			{
				$button = '<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													&nbsp;
												</div>
												<div class="col-xs-8">
													<button type="submit" name="cekpower" class="btn btn-primary">Cek Power</button>
												</div>
												
											</div>
                                        </div>';
			}
			
			
			//sleep(30);
			/////////////////////
			//
			// END ONU TEST SCRIPT
			//
			///////////////////
			
			$content .= '<hr><div class="row">
					<div class="col-xs-12 col-lg-12">
					    
			<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Keterangan</h3>
                                    
                                </div>
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-4">
											<label>Power ONU</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_power.'</pre>
										</div>
									</div>
									'.$button.'
									
                                </div><!-- /.box-body -->
                            </div>
						</div>
					</div>';
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}
}
else
{
	$content .='
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													&nbsp;
												</div>
												<div class="col-xs-3">
													<button type="submit" name="step1" class="btn btn-primary">Register Onu Test</button>
												</div>
												
											</div>
                                        </div>';
}

$content .='
                                
								
';

if(isset($_POST["aktifasi"]))
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
		//echo "SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;";
		$result_switch_port = mysql_query("SELECT * FROM `gx_switch_port` where `idolt_port` = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_switch_port = mysql_fetch_array($result_switch_port);
		
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		
		if($count_olt_customer == 1)
		{
			//select script from database	
			$unreg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'unreg_onu';", $conn);
			$data_unreg_onu = mysql_fetch_array($unreg_onu);
			
			//select script from database	
			$reg_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'reg_onu';", $conn);
			$data_reg_onu = mysql_fetch_array($reg_onu);
			
			$config_onu = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'config_onu';", $conn);
			$data_config_onu = mysql_fetch_array($config_onu);
			
			$show_vlan = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_olt';", $conn);
			$data_show_vlan = mysql_fetch_array($show_vlan);
			
			//$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt';", $conn);
			//$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
			$create_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_olt';", $conn);
			$data_create_vlan_olt = mysql_fetch_array($create_vlan_olt);
			
			$output_remove = "";
			$output_remove_switch = "";
			
			
			/////////////////////
			//
			// OLT SCRIPT
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
				'[mac]' => $mac_address
			);
			
			$replaceOnutest = array(
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
			$script_create_vlan_olt = strReplaceAssoc($replace,$data_create_vlan_olt["script"]);
			
			$script_unreg_onu 		= strReplaceAssoc($replaceOnutest,$data_unreg_onu["script"]);
			$script_reg_onu 		= strReplaceAssoc($replace,$data_reg_onu["script"]);
			$script_config_onu 		= strReplaceAssoc($replace,$data_config_onu["script"]);
			$script_show_vlan 		= strReplaceAssoc($replace,$data_show_vlan["script"]);
			//$script_remove_vlan_olt = strReplaceAssoc($replace,$data_remove_vlan_olt["script"]);
			
			$funreg = fopen('/usr/script/olt/unreg_onu.exp', 'w');
			fwrite($funreg, $script_unreg_onu);
			fclose($funreg);
			chmod("/usr/script/olt/unreg_onu.exp",0755);
			
			$fh = fopen('/usr/script/olt/reg_onu.exp', 'w');
			fwrite($fh, $script_reg_onu);
			fclose($fh);
			chmod("/usr/script/olt/reg_onu.exp",0755);
			
			$flan1 = fopen('/usr/script/olt/config_onu.exp', 'w');
			fwrite($flan1, $script_config_onu);
			fclose($flan1);
			chmod("/usr/script/olt/config_onu.exp",0755);
			
			$flan2 = fopen('/usr/script/olt/show_vlan_olt.exp', 'w');
			fwrite($flan2, $script_show_vlan);
			fclose($flan2);
			chmod("/usr/script/olt/show_vlan_olt.exp",0755);
			
			//$flan3 = fopen('olt/remove_vlan_olt.exp', 'w');
			//fwrite($flan3, $script_remove_vlan_olt);
			//fclose($flan3);
			//chmod("/usr/script/olt/remove_vlan_olt.exp",0755);
			
			$flan4 = fopen('/usr/script/olt/create_vlan_olt.exp', 'w');
			fwrite($flan4, $script_create_vlan_olt);
			fclose($flan4);
			chmod("/usr/script/olt/create_vlan_olt.exp",0755);
			
			
			////$output_unreg = shell_exec('expect /usr/script/olt/unreg_onu.exp');
			
			////$output_reg = shell_exec('expect /usr/script/olt/reg_onu.exp');
			////sleep(40);
			////$output_config = shell_exec('expect /usr/script/olt/config_onu.exp');
			////sleep(10);
			////$output_show = shell_exec('expect /usr/script/olt/show_vlan_olt.exp');
			////sleep(10);
			////
		$logFile = '/usr/script/olt/show_vlan.txt';
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
				//echo $pon."<br>";
				//print_r($str_value);
				if($pon[0] == "G" )
				{
$remove_script .= 'expect "#"
send "interface [uplink]\r"
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
		
		$flan3 = fopen('/usr/script/olt/remove_vlan_olt2.exp', 'w');
		fwrite($flan3, $script_remove_vlan_olt2);
		fclose($flan3);
		chmod("/usr/script/olt/remove_vlan_olt2.exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				////$output_remove = shell_exec('expect /usr/script/olt/remove_vlan_olt2.exp');
				//sleep(30);

			}
			////$output_create = shell_exec('expect /usr/script/olt/create_vlan_olt.exp');
			
			//sleep(30);
			/////////////////////
			//
			// END OLT SCRIPT
			//
			///////////////////
			
			
			/////////////////////
			//
			// SWITCH SCRIPT
			//
			///////////////////
			
			$result_switch = mysql_query("SELECT * FROM `v_switch_port` where id_switch = '".$row_switch_port["idswitch_port"]."' LIMIT 0,1;", $conn);
			$row_switch = mysql_fetch_array($result_switch);
			//echo "SELECT * FROM `gx_inet_listswitch` where id_server = '".$row_switch_port["idswitch_port"]."' LIMIT 0,1;";
		
		
			$show_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_switch';", $conn);
			$data_show_vlan_switch = mysql_fetch_array($show_vlan_switch);
			
			//$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt';", $conn);
			//$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
			$create_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_switch';", $conn);
			$data_create_vlan_switch = mysql_fetch_array($create_vlan_switch);
			
			$replaceSwitch = array(
				'[userid]' => $userid,
				'[ip_address]' => trim($row_switch["ip_address"]), 
				'[username]' => trim($row_switch["username"]), 
				'[password]' => trim($row_switch["password"]),
				'[downlink]' => trim($row_switch["downlink_port"]),
				'[uplink]' => trim($row_switch["uplink_port"]),
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
			
			
			$fileswitch = fopen('/usr/script/switch/show_vlan.exp', 'w');
			fwrite($fileswitch, $script_show_vlan_switch);
			fclose($fileswitch);
			chmod("/usr/script/switch/show_vlan.exp",0755);
			
			//$flan3 = fopen('olt/remove_vlan_olt.exp', 'w');
			//fwrite($flan3, $script_remove_vlan_olt);
			//fclose($flan3);
			//chmod("/usr/script/olt/remove_vlan_olt.exp",0755);
			
			$flan4_switch = fopen('/usr/script/switch/create_vlan.exp', 'w');
			fwrite($flan4_switch, $script_create_vlan_switch);
			fclose($flan4_switch);
			chmod("/usr/script/switch/create_vlan.exp",0755);
			
			
			////$output_show_switch = shell_exec('expect /usr/script/switch/show_vlan.exp');
			//$output_show_switch = "";
			//sleep(30);
			
		$logFile = '/usr/script/switch/show-vlan.txt';
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
				//echo $pon."<br>";
				//print_r($str_value);
				if($pon[0] == "G" )
				{
$remove_script .= 'expect "#"
send "interface '.substr($pon, 1).'\r"
expect "#"
send "switchport trunk vlan-allowed remove [vlanid]\r"
';
				}
//				elseif($pon[0] == "E" )
//				{
//$remove_script .= 'expect "#"
//send "interface [downlink]\r"
//expect "#"
//send "switchport trunk vlan-allowed remove [vlanid]\r"
//';
//				}
				
				
			}
		}
		
		$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt2';", $conn);
		$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
			
		$replace1 = array(
			'[remove_script]' => $remove_script
		);
		$script_remove_vlan_olt1 = strReplaceAssoc($replace1,$data_remove_vlan_olt["script"]);
		
		$script_remove_vlan_olt2 = strReplaceAssoc($replaceSwitch,$script_remove_vlan_olt1);
		
		$flan3_switch = fopen('/usr/script/switch/remove_vlan.exp', 'w');
		fwrite($flan3_switch, $script_remove_vlan_olt2);
		fclose($flan3_switch);
		chmod("/usr/script/switch/remove_vlan.exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				//tes 18 okto
				////$output_remove_switch = shell_exec('expect /usr/script/switch/remove_vlan.exp');
				
				//sleep(30);

			}
			//tes 18okto
			////$output_create_switch = shell_exec('expect /usr/script/switch/create_vlan.exp');
			//sleep(30);
			if($row_switch["idparent_server"] > 0)
			{
				echo "SELECT * FROM `gx_inet_listswitch` where `id_server` = '".$row_switch["idparent_server"]."' LIMIT 0,1;";
				$result_switch2 = mysql_query("SELECT * FROM `gx_inet_listswitch` where `id_server` = '".$row_switch["idparent_server"]."' LIMIT 0,1;", $conn);
				$row_switch2 = mysql_fetch_array($result_switch2);
			
				
				$show_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_switch';", $conn);
				$data_show_vlan_switch = mysql_fetch_array($show_vlan_switch);
				
				//$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt';", $conn);
				//$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
				
				$create_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_switch';", $conn);
				$data_create_vlan_switch = mysql_fetch_array($create_vlan_switch);
				
				$replaceSwitch2 = array(
					'[userid]' => $userid,
					'[ip_address]' => trim($row_switch2["ip_address"]), 
					'[username]' => trim($row_switch2["username"]), 
					'[password]' => trim($row_switch2["password"]),
					'[downlink]' => trim($row_switch2["interface_downlink"]),
					'[uplink]' => trim($row_switch2["interface_uplink"]),
					'[pon]' => $pon,
					'[pon_id]' => $pon_id,
					'[vlanid]' => $vlan,
					'[mac]' => $mac_address
				);
				$script_create_vlan_switch = strReplaceAssoc($replaceSwitch2,$data_create_vlan_switch["script"]);
				
				$script_reg_onu 		= strReplaceAssoc($replaceSwitch2,$data_reg_onu["script"]);
				$script_config_onu 		= strReplaceAssoc($replaceSwitch2,$data_config_onu["script"]);
				$script_show_vlan_switch 		= strReplaceAssoc($replaceSwitch2,$data_show_vlan_switch["script"]);
				//$script_remove_vlan_olt = strReplaceAssoc($replace,$data_remove_vlan_olt["script"]);
				
				
				$fileswitch = fopen('/usr/script/switch2/show_vlan.exp', 'w');
				fwrite($fileswitch, $script_show_vlan_switch);
				fclose($fileswitch);
				chmod("/usr/script/switch2/show_vlan.exp",0755);
				
				//$flan3 = fopen('olt/remove_vlan_olt.exp', 'w');
				//fwrite($flan3, $script_remove_vlan_olt);
				//fclose($flan3);
				//chmod("/usr/script/olt/remove_vlan_olt.exp",0755);
				
				$flan4_switch = fopen('/usr/script/switch2/create_vlan.exp', 'w');
				fwrite($flan4_switch, $script_create_vlan_switch);
				fclose($flan4_switch);
				chmod("/usr/script/switch2/create_vlan.exp",0755);
				
				
				////$output_show_switch2 = shell_exec('expect /usr/script/switch2/show_vlan.exp');
				//$output_show_switch = "";
				//sleep(30);
				
				$logFile = '/usr/script/switch/show-vlan.txt';
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
						//echo $pon."<br>";
						//print_r($str_value);
						if($pon[0] == "G" )
						{
		$remove_script .= 'expect "#"
		send "interface [uplink]\r"
		expect "#"
		send "switchport trunk vlan-allowed remove [vlanid]\r"
		';
						}
		//				elseif($pon[0] == "E" )
		//				{
		//$remove_script .= 'expect "#"
		//send "interface [downlink]\r"
		//expect "#"
		//send "switchport trunk vlan-allowed remove [vlanid]\r"
		//';
		//				}
						
						
					}
				}
				
				$remove_vlan_olt = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'remove_vlan_olt2';", $conn);
				$data_remove_vlan_olt = mysql_fetch_array($remove_vlan_olt);
					
				$replace1 = array(
					'[remove_script]' => $remove_script
				);
				$script_remove_vlan_olt1 = strReplaceAssoc($replace1,$data_remove_vlan_olt["script"]);
				
				$script_remove_vlan_olt2 = strReplaceAssoc($replaceSwitch,$script_remove_vlan_olt1);
				
				$flan3_switch = fopen('/usr/script/switch2/remove_vlan.exp', 'w');
				fwrite($flan3_switch, $script_remove_vlan_olt2);
				fclose($flan3_switch);
				chmod("/usr/script/switch2/remove_vlan.exp",0755);
					
					$content_switch = '';
					if($remove_script != "")
					{
						//echo $remove_script;
						//tes 18 okto
						////$output_remove_switch2 = shell_exec('expect /usr/script/switch2/remove_vlan.exp');
						
						//sleep(30);
		
					}
					//tes 18okto
					////$output_create_switch2 = shell_exec('expect /usr/script/switch2/create_vlan.exp');
					
					
					$content_switch = '<div class="row">
										<div class="col-xs-4">
											<label>Show VLAN SWITCH</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_show_switch2.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Remove VLAN SWITCH</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_remove_switch2.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Create SWITCH</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_create_switch2.'</pre>
										</div>
									</div>';
				
			}
			
			
			//////////////////////////
			//						//
			// END SWITCH SCRIPT	//
			//						//
			//////////////////////////
			
			//$output = shell_exec("olt/script.exp");
			$content .= '<div class="row">
					<div class="col-xs-12 col-lg-12">
					    
			<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Keterangan</h3>
                                    
                                </div>
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-4">
											<label>Unreg ONU TEST</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_unreg.'</pre>
										</div>
									</div>
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
											<label>Config ONU</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_config.'</pre>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-4">
											<label>Show VLAN OLT</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_show.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Remove VLAN OLT</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_remove.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Create VLAN</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_create.'</pre>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-4">
											<label>Show VLAN SWITCH</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_show_switch.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Remove VLAN SWITCH</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_remove_switch.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Create SWITCH</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_create_switch.'</pre>
										</div>
									</div>
									<h5>Swith 2</h5>
									'.$content_switch.'
                                </div><!-- /.box-body -->
                            </div>
						</div>
					</div>';
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}
}
	
	

$content .='	
								</form>
									</div><!-- /.box-body -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        $(function() {
                $("[data-mask]").inputmask();
            });

        </script>
    ';

    $title	= 'Form Aktivasi';
    $submenu	= "inet_olt_customer";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>