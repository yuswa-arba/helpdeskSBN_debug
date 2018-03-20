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

		//insert log aktivasi
		mysql_query("INSERT INTO `gx_log_aktivasi` (`id_log_aktivasi`, `uuid_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`,
					`pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`, `tv`, `voip`)
					VALUES ('', '".$uuid."', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
                    NOW(), 'STEP 2 - (CEK DHCP LEASE)',
					'".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."', '".$tv."', '".$voip."');", $conn);
		
		

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
    //echo "<pre>";
    //print_r($ARRAY_DHCP);
    //echo "</pre>";
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
    $no = 1;       
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
/*
 *
 <div class="box box-solid box-info collapsed-box" hidden>
												<div class="box-header">
													<h3 class="box-title">IP Address List</h3>
													<div class="box-tools pull-right">
														<button class="btn btn-sm btn-warning" data-widget="collapse"><i class="fa fa-plus"></i></button>
													</div>
												</div>
												<div class="box-body">
													<pre>'.($output_ip_pppoe).'</pre>
												</div>
											</div>*/
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
					VALUES ('', '".$id_spk."', '".$loggedin["id_employee"]."', '".$id_teknisi."', 'step 2, cek dhcp', NOW());", $conn);
	
		
		mysql_query("INSERT INTO `gx_log_aktivasi_detail` (`id_detail`, `idlog_aktivasi`, `step_aktivasi`,
					`feedback_aktivasi`, `date_add`, `user_add`, `from_ip`)
					VALUES ('', '".$uuid."', '2.1. Cek DHCP Lease', '".mysql_real_escape_string($output_status_dhcp)."',
					NOW(), '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		
		
                                
    }
    else
    {
        $content .= "<pre>UserID $userid tidak ditemukan.</pre>";
    }
	
}

echo $content;
