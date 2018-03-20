<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 * Last edited: dwi tgl 1 desember 2016
 * 
 */
include ("../../../config/configuration_admin.php");
include '../../../config/telnet/routeros_api.class.php';

redirectToHTTPS();

global $conn;
$loggedin = logged_inAdmin();

$content	= '';

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
	
	if($userid != "")
	{
		//insert log aktivasi
		$uuid = get_uuid('gx_log_aktivasi');
		$uuid_detail = get_uuid('gx_log_aktivasi_detail');
		//echo $uuid;
		mysql_query("INSERT INTO `gx_log_aktivasi` (`id_log_aktivasi`, `uuid_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
					`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
					VALUES ('', '".$uuid."', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
                    NOW(), 'STEP 1 CONFIG ONU TEST DAN CEK POWER ONU',
					'".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');", $conn);
		
		//select data olt customer
		$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
		$row_onu_test = mysql_fetch_array($result_onu_test);
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		//get data default IP VM Master
		$ip_vm = mysql_query("SELECT * FROM `gx_inet_ipvm` LIMIT 0,1;", $conn);
		$data_ip_vm = mysql_fetch_array($ip_vm);
		
		
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
			
			$fh = fopen('/usr/script/onu/reg_onu_'.$userid.'.exp', 'w+');
			fwrite($fh, $script_reg_onu);
			fclose($fh);
			//chmod("/usr/script/onu/reg_onu_'.$userid.'.exp",0755);
			
			$flan1 = fopen('/usr/script/onu/power_onu_'.$userid.'.exp', 'w+');
			fwrite($flan1, $script_power_onu);
			fclose($flan1);
			chmod("/usr/script/onu/power_onu_".$userid.".exp",0755);
			
			
			$output_reg = shell_exec('expect /usr/script/onu/reg_onu_'.$userid.'.exp');
			sleep(70);
			$output_power = shell_exec('expect /usr/script/onu/power_onu_'.$userid.'.exp');
			//sleep(30);
			
			$logFile = '/usr/script/onu/power-test_'.$userid.'.txt';
			$lines = file($logFile); // Get each line of the file and store it as an array
			$line_data =  count ($lines) - 2;
			
			$output_power = $lines[$line_data];
			$power = substr($lines[$line_data], 21);
			
			if(trim($power) <= $data_ip_vm['batas_atas_power'] AND trim($power) >=  $data_ip_vm['batas_bawah_power'])
			{
				$button = '
							<div class="form-group">
								<div class="row">
									<div class="col-xs-4">
										&nbsp;
									</div>
									<div class="col-xs-8">
										
										<button type="button" id="config_onu" name="config_onu" class="btn btn-warning">Step 2 (CONFIG ONU + POWER ON VM)</button>
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
													<button type="button" id="cekpower" name="cekpower" class="btn btn-success">Cek Power ONU</button>
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
			
			mysql_query ("INSERT INTO `gx_chat_aktivasi` (`id_chat_aktivasi`, `idspk_aktivasi`, `idpengirim_aktivasi`, `idpenerima_aktivasi`, `pesan_aktivasi`, `date_aktivasi`)
					VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 1 ok', NOW());", $conn);
	
			mysql_query ("INSERT INTO `gx_log_aktivasi_detail` (`id_detail`, `idlog_aktivasi`, `step_aktivasi`,
					`feedback_aktivasi`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '1.1. Reg ONU TEST', '".mysql_real_escape_string($output_reg)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
					('', '".$uuid."', '1.2. Power ONU TEST', '".mysql_real_escape_string($output_power)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		
		}
		else
		{
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
		
	}
}

echo $content;
