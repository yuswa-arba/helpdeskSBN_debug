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
include '../../config/telnet/routeros_api.class.php';


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
                                    
									<form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Kode Customer</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly=""  placeholder="Pilih Kode Customer" class="form-control" name="kode_customer" value="'.(isset($_POST["kode_customer"]) ? $_POST['kode_customer'] : "").'"
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Userid</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly=""  placeholder="Pilih Data Customer" class="form-control" name="userid" value="'.(isset($_POST["userid"]) ? $_POST['userid'] : "").'"
												onclick="return valideopenerform(\'data_customer.php?r=myForm&f=aktivasi\',\'aktivasi\');">
												
                                            </div>
                                        </div>
                                        </div>
										
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>OLT Server</h5>
                                            </div>
                                            <div class="col-xs-6">
												<input type="hidden" readonly="" class="form-control" name="id_olt" value="'.(isset($_POST["id_olt"]) ? $_POST['id_olt'] : "").'" >
												<input type="text" readonly="" placeholder="Nama OLT" class="form-control" name="nama_olt" value="'.(isset($_POST["nama_olt"]) ? $_POST['nama_olt'] : "").'" >
                                                
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>PON</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" readonly="" placeholder="PON" class="form-control" name="pon" maxlength="2" value="'.(isset($_POST["pon"]) ? $_POST['pon'] : "").'" >
													
												</div>
												
												<div class="col-xs-3">
													<input type="text" readonly="" placeholder="PON ID" class="form-control" name="id" maxlength="2" value="'.(isset($_POST["id"]) ? $_POST['id'] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>VLAN</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" readonly="" placeholder="VLAN" class="form-control" name="vlan" value="'.(isset($_POST["vlan"]) ? $_POST['vlan'] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC ADDRESS ONU</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" readonly="" placeholder="MAC Address" class="form-control" name="mac_address" min-length="14" value="'.(isset($_POST["mac_address"]) ? $_POST['mac_address'] : "").'">
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
                                        </div>
										
										<hr>';
//STEP 1 CONFIG ONU TEST DAN CEK POWER ONU
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
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
					`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW(), 'STEP 1 CONFIG ONU TEST DAN CEK POWER ONU');", $conn);
		
		
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
			sleep(70);
			$output_power = shell_exec('expect /usr/script/onu/power_onu.exp');
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
													<button type="submit" name="config_onu" class="btn btn-primary">Config ONU + Power ON VM (Step 2)</button>
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
			
			$content .= '<h3 class="box-title">Keterangan</h3>
                                    <hr>
                                
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
													<h3 class="box-title">Power ONU</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_power.'</pre>
												</div>
											</div>
											
										</div>
									</div>
									'.$button.'
								';
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
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`,
					`idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW(), 'CEK POWER ONUTEST');", $conn);
		
		
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
			$output_power = shell_exec('expect /usr/script/onu/power_onu.exp');
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
													<button type="submit" name="config_onu" class="btn btn-primary">Config ONU + Power ON VM (Step 2)</button>
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
			
			$content .= '<h3 class="box-title">Keterangan</h3><hr>
                                    
                                    <div class="row">
										<div class="col-xs-10">
											
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Power ONU</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.$output_power.'</pre>
												</div>
											</div>
										</div>
									</div>
                                    
									'.$button.'
									
                                ';
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
												<div class="col-xs-6">
													<button type="submit" name="step1" class="btn btn-success">Register Onu Test</button>
                                                    <button type="submit" name="cekpower" class="btn btn-success">Cek Power ONU</button>
												
													<button type="submit" name="config_onu" class="btn btn-warning">Step 2 (CONFIG ONU + POWER ON VM)</button>
                                                    <button type="submit" name="cek_dhcp" class="btn btn-warning">Step 2 (CEK DHCP LEASE)</button>
												
													<button type="submit" name="aktifasi" class="btn btn-danger">Step 3 (AKTIFASI)</button>
												</div>
												
											</div>
                                        </div>';
}


//STEP 2 (CONFIG ONU - CEK DHCP LEASE)
if(isset($_POST["config_onu"]))
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
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`,
					`idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW(), 'STEP 2 (CONFIG ONU - CEK DHCP LEASE)');", $conn);
		
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
			
			
			$output_unreg = shell_exec('expect /usr/script/olt/unreg_onu.exp');
			
			$output_reg = shell_exec('expect /usr/script/olt/reg_onu.exp');
			sleep(70);
			$output_config = shell_exec('expect /usr/script/olt/config_onu.exp');
			//sleep(10);
			$output_show = shell_exec('expect /usr/script/olt/show_vlan_olt.exp');
			//sleep(10);
			
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
				$output_remove = shell_exec('expect /usr/script/olt/remove_vlan_olt2.exp');
				//sleep(30);

			}
			$output_create = shell_exec('expect /usr/script/olt/create_vlan_olt.exp');
			
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
			
			$result_switch = mysql_query("SELECT * FROM `v_switch_port` where `id_switch` = '".$row_switch_port["idswitch_port"]."' AND `id_olt` = '".$id_olt."' LIMIT 0,1;", $conn);
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
			
			
			$output_show_switch = shell_exec('expect /usr/script/switch/show_vlan.exp');
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
				if(($pon[0] != "G0/1") OR ($pon[0] != "G0/4") OR ($pon[0] != "P1") )
                //if($pon[0] != "G0/41" AND $pon[0] != "G0/42" AND $pon[0] != "P1" )
				{
$remove_script .= 'expect "#"
send "interface '.$pon.'\r"
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
				$output_remove_switch = shell_exec('expect /usr/script/switch/remove_vlan.exp');
				
				//sleep(30);

			}
			//tes 18okto
			$output_create_switch = shell_exec('expect /usr/script/switch/create_vlan.exp');
			//sleep(30);
			
			//START SCRIPT SWTICH 2
			if($row_switch["idparent_server"] != 0)
			{
				$result_switch2 = mysql_query("SELECT * FROM `gx_inet_listswitch` where `id_server` = '".$row_switch["idparent_server"]."' LIMIT 0,1;", $conn);
				$row_switch2 = mysql_fetch_array($result_switch2);
			
				
				$create_vlan_switch = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'create_vlan_switch2_new';", $conn);
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
				
				
				$flan4_switch = fopen('/usr/script/switch2/create_vlan2.exp', 'w');
				fwrite($flan4_switch, $script_create_vlan_switch);
				fclose($flan4_switch);
				chmod("/usr/script/switch2/create_vlan2.exp",0755);
				
				
				
					$output_create_switch2 = shell_exec('expect /usr/script/switch2/create_vlan2.exp');
					
					
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
		
            
			$result_esx = mysql_query("SELECT * FROM `gx_inet_esx` where `id_server` = '".$id_server_esx."' LIMIT 0,1;", $conn);
			$row_server_esx	= mysql_fetch_array($result_esx);
		
		
			//select script from database	
			$vlan_esx 		= mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'show_vlan_esx' LIMIT 0,1;", $conn);
			$data_vlan_esx 	= mysql_fetch_array($vlan_esx);
			
			//select script from database	
			$power_on_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'power_on_vm' LIMIT 0,1;", $conn);
			$data_power_on_vm = mysql_fetch_array($power_on_vm);
			
			$power_off_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'power_off_vm' LIMIT 0,1;", $conn);
			$data_power_off_vm = mysql_fetch_array($power_on_vm);
			
			//select script from database	
			$status_vm = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_vm' LIMIT 0,1;", $conn);
			$data_status_vm = mysql_fetch_array($status_vm);
			
			$replace_esx = array(
				'[ip_address]' => trim($row_server_esx["ip_address"]), 
				'[username]' => trim($row_server_esx["username"]), 
				'[password]' => trim($row_server_esx["password"]),
				'[vlan]' => $vlan
			);
			
			$script_show_vlan_esx	= strReplaceAssoc($replace_esx,$data_vlan_esx["script"]);
			$script_power_on 		= strReplaceAssoc($replace_esx,$data_power_on_vm["script"]);
			$script_power_off 		= strReplaceAssoc($replace_esx,$data_power_off_vm["script"]);
			
			
			$funreg = fopen('/usr/script/esx/show_vlan.exp', 'w');
			fwrite($funreg, $script_show_vlan_esx);
			fclose($funreg);
			chmod("/usr/script/esx/show_vlan.exp",0755);
			
			$fh = fopen('/usr/script/esx/power_vm.exp', 'w');
			fwrite($fh, $script_power_on);
			fclose($fh);
			chmod("/usr/script/esx/power_vm.exp",0755);
			
			$fh = fopen('/usr/script/esx/power_off_vm.exp', 'w');
			fwrite($fh, $script_power_off);
			fclose($fh);
			chmod("/usr/script/esx/power_off_vm.exp",0755);
			
			
			
			$output_show_vlan_esx = shell_exec('expect /usr/script/esx/show_vlan.exp');
			
			$logFile = '/usr/script/esx/show-vlan-esx.txt';
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
				'[ip_address]' => trim($row_server_esx["ip_address"]), 
				'[username]' => trim($row_server_esx["username"]), 
				'[password]' => trim($row_server_esx["password"]),
				'[id_esx]' => trim($id_esx)
			);
			$script_status_vm		= strReplaceAssoc($replace_vm,$data_status_vm["script"]);
			
			$fh = fopen('/usr/script/esx/power_vm.exp', 'w');
			fwrite($fh, $script_power_on);
			fclose($fh);
			chmod("/usr/script/esx/power_vm.exp",0755);
            
            $fh = fopen('/usr/script/esx/power_off_vm.exp', 'w');
			fwrite($fh, $script_power_on);
			fclose($fh);
			chmod("/usr/script/esx/power_vm.exp",0755);
			
			$fstatusvm = fopen('/usr/script/esx/status_vm.exp', 'w');
			fwrite($fstatusvm, $script_status_vm);
			fclose($fstatusvm);
			chmod("/usr/script/esx/status_vm.exp",0755);
			
			$output_power_on_vm = shell_exec('expect /usr/script/esx/power_vm.exp');
			sleep(30);
			$output_status_vm = shell_exec('expect /usr/script/esx/status_vm.exp');
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
$ip_vlan_baru = mysql_query("SELECT * FROM `gx_master_ipvm` WHERE ((`userid_ip` IS NULL) OR (`userid_ip` = '')) AND `level` = '0' ORDER BY `ip_address` ASC LIMIT 0,1;", $conn);
$data_ip_vlan_baru = mysql_fetch_array($ip_vlan_baru);

$ip_baru = long2ip($data_ip_vlan_baru["ip_address"]);

//update userid ke ip vlan
mysql_query("UPDATE `db_sbn`.`gx_master_ipvm` SET `keterangan_ip`='aktif', `flag_ip`='aktif', `userid_ip`='".$userid."',
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

//get data default IP VM Master
$ip_vm = mysql_query("SELECT * FROM `gx_inet_ipvm` LIMIT 0,1;", $conn);
$data_ip_vm = mysql_fetch_array($ip_vm);

$api_vm = new RouterosAPI();
$api_vm->debug = false;

//step2
if ($api_vm->connect($data_ip_vm['ipaddress_ipvm'], $data_ip_vm['username_ipvm'], $data_ip_vm['password_ipvm']))
{
    //dhcp lease
    $api_vm->write($data_dhcp_print["script"]);
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
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
    foreach($ARRAY[0] as $key => $value)
    {
        $output_status_dhcp .= '<tr>
                      <td>'.$no.'.</td>
                      <td>'.$key.'</td>
                      <td>'.$value.'</td>
                    </tr>';
        $no++;
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



			

			//////////////////////////
			//						//
			// END DHCP LEASE 		//
			//						//
			//////////////////////////
			
			//$output = shell_exec("olt/script.exp");
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
													<h3 class="box-title">Create SWITCH</h3>
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
												<button type="submit" name="cek_dhcp" class="btn btn-warning">CEK DHCP LEASE</button>
											
												<button type="submit" name="aktifasi" class="btn btn-danger">Aktifasi (Step 3)</button>
											</div>
											
										</div>
									</div>
								';
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}
}
elseif(isset($_POST["cek_dhcp"]))
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
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`,
					`idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW(), 'STEP 2 (CEK DHCP LEASE)');", $conn);
		
		
		//////////////////////////
		//						//
		// DHCP LEASE 			//
		//						//
		//////////////////////////



$customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cUserID` = '".$userid."' LIMIT 0,1;", $conn);
$data_customer = mysql_fetch_array($customer);

//get data ip inet, service name, subnet ip pool vlan
$result_servicename = mysql_query("SELECT * FROM `v_master_ip` where `ip_address` = '".ip2long($data_customer['user_ip'])."' LIMIT 0,1;", $conn);
$row_servicename = mysql_fetch_array($result_servicename);

//script dhcp lease print
$dhcp_print = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'dhcp_lease_print' LIMIT 0,1;", $conn);
$data_dhcp_print = mysql_fetch_array($dhcp_print);

//script add alias ip vlan
$add_ip_vlan = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'add_ip_vlan' LIMIT 0,1;", $conn);
$data_add_ip_vlan = mysql_fetch_array($add_ip_vlan);

//get data default IP VM Master
$ip_vm = mysql_query("SELECT * FROM `gx_inet_ipvm` LIMIT 0,1;", $conn);
$data_ip_vm = mysql_fetch_array($ip_vm);


//koneksi ke VM
$api_vm = new RouterosAPI();
//$api_vm->debug = true;

//step2
if ($api_vm->connect($data_ip_vm['ipaddress_ipvm'], $data_ip_vm['username_ipvm'], $data_ip_vm['password_ipvm']))
{
    //dhcp lease
    $api_vm->write($data_dhcp_print["script"]);
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
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
    foreach($ARRAY[0] as $key => $value)
    {
        $output_status_dhcp .= '<tr>
                      <td>'.$no.'.</td>
                      <td>'.$key.'</td>
                      <td>'.$value.'</td>
                    </tr>';
        $no++;
    }
    $output_status_dhcp .= '</tbody></table>';
    
    $api_vm->write('/ip/address/print');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
    $output_ip_pppoe = '<table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>IP</th>
                  <th>Network</th>
                  <th>Interface</th>
                </tr>';
                
    foreach($ARRAY as $value)
    {
        $output_ip_pppoe .='<tr>
            <td>'.$no.'</td>
            <td>'.$value['address'].'</td>
            <td>'.$value['network'].'</td>
            <td>'.$value['interface'].'</td>
        </tr>';
        $no++;
    }
    
    $output_ip_pppoe .= '</tbody></table>';
}
else
{
    $output_koneksi = "Tidak Bisa Login ke Mesin VM";
}

			//////////////////////////
			//						//
			// END DHCP LEASE 		//
			//						//
			//////////////////////////
			
			//$output = shell_exec("olt/script.exp");
			$content .= '<h3 class="box-title">Keterangan</h3>
						<hr>
                                
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
                                            
                                            <div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">IP Address List</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.($output_ip_pppoe).'</pre>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												
											</div>
											<div class="col-xs-8">
												<button type="submit" name="cek_dhcp" class="btn btn-warning">CEK DHCP LEASE</button>
											
												<button type="submit" name="aktifasi" class="btn btn-danger">Aktifasi (Step 3)</button>
											</div>
											
										</div>
									</div>
								';
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	
}







//STEP 3 (AKTIFASI)
if(isset($_POST["aktifasi"]))
{
	$userid         = isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$vlan		    = isset($_POST['vlan']) ? mysql_real_escape_string(trim($_POST['vlan'])) : '';
	$id_olt		    = isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
	$pon		    = isset($_POST['pon']) ? mysql_real_escape_string(trim($_POST['pon'])) : '';
	$pon_id         = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$mac_address    = isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
	$id_timpasang   = isset($_POST['id_timpasang']) ? mysql_real_escape_string(trim($_POST['id_timpasang'])) : '';
	
	
	if($userid != "")
	{
	
		//insert log aktivasi
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi3` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`,
					`idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW(), 'STEP 3 (AKTIVASI)');", $conn);
		
		
		//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		$result_customer = mysql_query("SELECT * FROM `tbCustomer` where `cUserID` = '".$userid."' LIMIT 0,1;", $conn);
		$row_customer = mysql_fetch_array($result_customer);
			
		
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		
		if($count_olt_customer == 1)
		{
			
			//////////////////////////
			//						//
			// CONFIG VM 			//
			//						//
			//////////////////////////


//change ip
$ip_vlan_baru = mysql_query("SELECT * FROM `gx_master_ipvm` WHERE `userid_ip` = '".$userid."' AND `flag_ip` = 'aktif' LIMIT 0,1;", $conn);
$data_ip_vlan_baru = mysql_fetch_array($ip_vlan_baru);

$ip_baru = long2ip($data_ip_vlan_baru["ip_address"]);

//select script from database	
$vlan_mac = mysql_query("SELECT * FROM `gx_data_vlan` WHERE `userid_vlan` = '".$userid."' AND `flag_vlan` = 'aktif' LIMIT 0,1;", $conn);
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
if ($api_vm->connect($ip_baru, $data_ip_vm['username_ipvm'], $data_ip_vm['password_ipvm']))
{
    //hostname
    $api_vm->write('/system/identity/set', false);
    $api_vm->write('=name='.$userid);
    $READ = $api_vm->read(false);
    //$ARRAY = $api_vm->parseResponse($READ);
    $api_vm->write('/system/identity/print');
    $READ = $api_vm->read(false);
    $output_hostname = $api_vm->parseResponse($READ);
    $output_hostname = $output_hostname[0]['name'];
    
    //config pppoe-client
    //1. get id pppoe-client
    $api_vm->write('/interface/pppoe-client/print');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    $id_pppoe_client = $ARRAY[0][".id"];
    
    //2. set pppoe-client
    $api_vm->write('/interface/pppoe-client/set', false);
    $api_vm->write('=.id='.$id_pppoe_client, false);
    $api_vm->write('=user='.$data_customer['cUserID'], false);
    $api_vm->write('=password='.$data_customer['cPassword'], false);
    $api_vm->write('=service-name='.$row_servicename["service_name"]);
    $READ = $api_vm->read(false);
    $output_pppoe = $api_vm->parseResponse($READ);
    
    $api_vm->write('/interface/pppoe-client/print');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
    $output_pppoe = '<table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Data</th>
                  <th>Value</th>
                </tr>';
                
              
    $no = 1;
    foreach($ARRAY[0] as $key => $value)
    {
        $output_pppoe .= '<tr>
                      <td>'.$no.'.</td>
                      <td>'.$key.'</td>
                      <td>'.$value.'</td>
                    </tr>';
        $no++;
    }
    $output_pppoe .= '</tbody></table>';
    
    //2.1 .enable pppoe
    //$api_vm->write('/interface/pppoe-client/print');
    $api_vm->write('/interface/pppoe-client/enable', false);
    $api_vm->write('=.id='.$id_pppoe_client);
    $READ = $api_vm->read(false);
    $output_enable = $api_vm->parseResponse($READ);
    
    //3.dial / ping 8.8.8.8
    //$api_vm->write('/interface/pppoe-client/print');
    $api_vm->write('/ping', false);
    $api_vm->write('=address=8.8.8.8', false);
    $api_vm->write('=count=5');
    $READ = $api_vm->read(false);
    $output_dial = $api_vm->parseResponse($READ);
    
    $output_ip_pppoe = '<table class="table table-striped">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>IP Address</th>
                    <th>Network</th>
                    <th>Interface</th>
                </tr>';
                
              
    $no = 1;
    /*
    foreach($ARRAY as $value)
    {
        $output_dial .= '<tr>
            <td>'.$no.'.</td>
            <td>'.$value["host"].'</td>
            <td>'.$value["size"].'</td>
            <td>'.$value["ttl"].'</td>
            <td>'.$value["time"].'</td>
            <td>'.$value["sent"].'</td>
            <td>'.$value["received"].'</td>
            <td>'.$value["packet-loss"].'</td>
            <td>'.$value["min-rtt"].'</td>
            <td>'.$value["avg-rtt"].'</td>
            <td>'.$value["max-rtt"].'</td>
        </tr>';
        $no++;
    }
    $output_dial .= '</tbody></table>';
    */
    
    //4. get id pppoe-client
    $api_vm->write('/ip/address/print');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
    
    foreach($ARRAY as $value)
    {
        $output_ip_pppoe .='<tr>
            <td>'.$no.'</td>
            <td>'.$value['address'].'</td>
            <td>'.$value['network'].'</td>
            <td>'.$value['interface'].'</td>
        </tr>';
        $no++;
    }
    
    $output_ip_pppoe .= '</tbody></table>';
    
    foreach($ARRAY as $value)
    {
        
        if($value["address"] == "192.168.5.2/30")
        {
            $id_ipaddress = $value[".id"];
            
            
            ////5.disable ip address
            //$api_vm->write('/ip/address/remove', false);
            //$api_vm->write("=.id=$id_ipaddress");
            //$READ = $api_vm->read(false);
            //$output_disable = $api_vm->parseResponse($READ);
            //$output_disable = 'ok';
        }
      
    }
    
    
    
   
    
    
}
else
{
    $output_hostname = "Tidak Bisa Login ke Mesin VM";
    $output_pppoe = "Tidak Bisa Login ke Mesin VM";
    $output_dial = "Tidak Bisa Login ke Mesin VM";
    $output_disable = "Tidak Bisa Login ke Mesin VM";
}

			//////////////////////////
			//						//
			// END CONFIG VM 		//
			//						//
			//////////////////////////
			
			$content .= '<h3 class="box-title">Keterangan</h3>
                                    <hr>
                                
									<div class="row">
										
										<div class="col-xs-10">
											<div class="box box-solid box-info collapsed-box">
												<div class="box-header">
													<h3 class="box-title">Aktivasi</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
                                                    <h4>Hostname</h4>
													<pre>'.print_r($output_hostname, true).'</pre>
                                                    
                                                    <h4>Config PPPOE</h4>
													<pre>'.print_r($output_pppoe, true).'</pre>
                                                    <h4>Enable Config PPPOE</h4>
													<pre>'.print_r($output_enable, true).'</pre>
                                                    
                                                    <h4>Dial</h4>
													<pre>'.print_r($output_dial, true).'</pre>
                                                    
                                                    <h4>IP Address PPPOE</h4>
													<pre>'.print_r($output_ip_pppoe, true).'</pre>
                                                    
                                                    <h4>Disable IP Master VLAN</h4>
													<pre>'.print_r($output_disable, true).'</pre>
												</div>
											</div>
											
										</div>
									</div>
									
									
									
									<h3 class="box-title">Proses Aktifasi Selesai</h3>
									
								';
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