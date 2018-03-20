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
		$sql_aktivasi = mysql_query("SELECT * FROM `gx_aktivasi` where `user_id` = '".$userid."' LIMIT 0,1;", $conn);
		$row_aktivasi = mysql_num_rows($sql_aktivasi);
		
		//update tgl 28 september 2017
		if($row_aktivasi == 1)
		{
			//insert log aktivasi
			$uuid = get_uuid('gx_log_aktivasi');
			$uuid_detail = get_uuid('gx_log_aktivasi_detail');
			//echo $uuid;
			mysql_query("INSERT INTO `gx_log_aktivasi` (`id_log_aktivasi`, `uuid_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
						`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
						VALUES ('', '".$uuid."', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
						NOW(), 'STEP 3 - (AKTIVASI)',
						'".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');", $conn);
			
		
			//select data olt customer
			$result_onu_test = mysql_query("SELECT * FROM `v_onu_test` where `id_timpasang` = '".$id_timpasang."' LIMIT 0,1;", $conn);
			$row_onu_test = mysql_fetch_array($result_onu_test);
			
			//select data olt customer
			$result_olt_customer = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
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
	$ip_vlan_baru = mysql_query("SELECT * FROM `gx_master_ipvm` WHERE `userid_ip` = '".$userid."' AND `flag_ip` = 'aktif' AND `level` = '0' LIMIT 0,1;", $conn);
	$data_ip_vlan_baru = mysql_fetch_array($ip_vlan_baru);
	
	$ip_baru = long2ip($data_ip_vlan_baru["ip_address"]);
	
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
		
		$ip_vm_default = $data_ip_vm["ipaddress_ipvm"].'/'.$data_ip_vm["subnet_ipvm"];
		foreach($ARRAY as $value)
		{
			
			if($value["address"] == $ip_vm_default)
			{
				$id_ipaddress = $value[".id"];
				
				
				//5.disable ip address
				$api_vm->write('/ip/address/remove', false);
				$api_vm->write("=.id=$id_ipaddress");
				$READ = $api_vm->read(false);
				$output_disable = $api_vm->parseResponse($READ);
				//$output_disable = 'ok';
			}
		  
		}
		
		if(count($output_dial) >= 1)
		{
			if($output_dial[4]["received"] == "0")
			{
			  $status_aktivasi = '<h3 class="box-title warning">Aktifasi Selesai, Tapi Internet Masih belum bisa.</h3>';
			}
			else
			{
			  $status_aktivasi = '<h3 class="box-title success">Aktifasi Sukses dan Internet Normal.</h3>';
			}
		}
	   
		
		
	}
	else
	{
		$output_hostname = "Tidak Bisa Login ke Mesin VM";
		$output_pppoe = "Tidak Bisa Login ke Mesin VM";
		$output_enable = "Tidak Bisa Login ke Mesin VM";
		$output_dial = "Tidak Bisa Login ke Mesin VM";
		$output_disable = "Tidak Bisa Login ke Mesin VM";
		$status_aktivasi = '<h3 class="box-title danger">Aktivasi Gagal.</h3>';
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
												<div class="box box-solid box-info">
													<div class="box-header">
														<h3 class="box-title">Aktivasi</h3>
													</div>
													<div class="box-body">
														<h4>Data Customer</h4>
														Kode Customer : '.$data_customer["cKode"].'<br>
														Nama Customer : '.$data_customer["cNama"].'<br>
														UserID : '.$data_customer["cUserID"].'<br>
														Tipe Koneksi : '.$data_customer["cKdPaket"].'<br><br><br>
														
														'.$status_aktivasi.'
													</div>
												</div>
												
											</div>
										</div>
									';
									
				mysql_query("INSERT INTO `gx_chat_aktivasi` (`id_chat_aktivasi`, `idspk_aktivasi`, `idpengirim_aktivasi`, `idpenerima_aktivasi`, `pesan_aktivasi`, `date_aktivasi`)
						VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 3, aktivasi ok', NOW());", $conn);
		
			
				mysql_query("INSERT INTO `gx_log_aktivasi_detail` (`id_detail`, `idlog_aktivasi`, `step_aktivasi`,
						`feedback_aktivasi`, `date_add`, `user_add`, `from_ip`)
						VALUES ('', '".$uuid."', '3.1. Hostname', '".mysql_real_escape_string($output_hostname)."',
						NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
						('', '".$uuid."', '3.2. Config PPPOE', '".mysql_real_escape_string($output_pppoe)."',
						NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
						('', '".$uuid."', '3.3. Enable PPPOE', '',
						NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
						('', '".$uuid."', '3.4. Dial', '',
						NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."'),
						('', '".$uuid."', '4. Status Aktivasi', '".mysql_real_escape_string($status_aktivasi)."',
						NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
			
			}
			else
			{
				$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
			}
		}
		else
		{
			$content .= "<pre>Aktivasi belum dicreate admin, hubungi admin</pre>";
		}
	}
}


echo $content;