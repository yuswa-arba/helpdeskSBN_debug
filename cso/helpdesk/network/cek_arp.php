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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
  enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Cek Data VM");
    global $conn;
    
    
  $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
							
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Cek User</h3>
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
										
												<input type="hidden" readonly="" class="form-control" name="id_olt" value="'.(isset($_POST["id_olt"]) ? $_POST['id_olt'] : "").'" >
												<input type="hidden" readonly="" placeholder="Nama OLT" class="form-control" name="nama_olt" value="'.(isset($_POST["nama_olt"]) ? $_POST['nama_olt'] : "").'" >
                                                <input type="hidden" readonly="" placeholder="PON" class="form-control" name="pon" maxlength="2" value="'.(isset($_POST["pon"]) ? $_POST['pon'] : "").'" >
												<input type="hidden" readonly="" placeholder="VLAN" class="form-control" name="vlan" value="'.(isset($_POST["vlan"]) ? $_POST['vlan'] : "").'">
												<input type="hidden" readonly="" placeholder="MAC Address" class="form-control" name="mac_address" min-length="14" value="'.(isset($_POST["mac_address"]) ? $_POST['mac_address'] : "").'">
												
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													&nbsp;
												</div>
												<div class="col-xs-6">
													<button type="submit" name="cek_arp" class="btn btn-success">IP Address List</button>
													<button type="submit" name="cek_dial" class="btn btn-info">Cek Dial</button>
												</div>
												
											</div>
                                        </div>
										
										</form>
										<hr>';
										
if(isset($_POST["cek_arp"]))
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
		mysql_query("INSERT INTO `gx_log_aktivasi3` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`,
					`idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
					NOW(), 'CSO cek ARP', '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		
		
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
    
    //1. cek arp
    $api_vm->write('/ip/arp/print');
	$READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
	//echo "<pre>";
	//print_r($ARRAY);
	//echo "</pre>";
	
	$output_arp = '<table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>IP Address</th>
                  
                </tr>';
                
    $no = 1;
	if(count($ARRAY) >= 1)
	{
	  
	  
	  foreach($ARRAY as $value)
	  {
		
		if (strpos($value['address'], '192.168') !== false)
		{
		  $output_arp .= '<tr>
						<td>'.$no.'.</td>
						<td>'.$value['address'].'</td>
					  </tr>';
		  $no++;
		}
	  }
	
	}
    $output_arp .= '</tbody></table>';
    
}
else
{
    $output_arp = "Tidak Bisa Login ke Mesin VM";
    
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
													<h3 class="box-title">IP Address List</h3>
													<div class="box-tools pull-right">
														
													</div>
												</div>
												<div class="box-body">
                                                    
													'.print_r($output_arp, true).'
                                                    
												</div>
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
elseif(isset($_POST["cek_dial"]))
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
		mysql_query("INSERT INTO `gx_log_aktivasi3` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`,
					`idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`, `step`, `user_add`, `from_ip`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."',
					NOW(), 'CSO cek dial', '".$loggedin["username"]."', '".$_SERVER["REMOTE_ADDR"]."');", $conn);
		
		
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
  
//	//1. get id pppoe-client
//    $api_vm->write('/interface/pppoe-client/print');
//    $READ = $api_vm->read(false);
//    $ARRAY = $api_vm->parseResponse($READ);
//    $id_pppoe_client = $ARRAY[0][".id"];
	
//    //1a.disable pppoe-client
//	$api_vm->write('/interface/pppoe-client/disable', false);
//    $api_vm->write('=.id='.$id_pppoe_client);
//    $READ = $api_vm->read(false);
//    $output_disable = $api_vm->parseResponse($READ);
//	
//	
//	//1b.enable pppoe-client
//	$api_vm->write('/interface/pppoe-client/enable', false);
//    $api_vm->write('=.id='.$id_pppoe_client);
//    $READ = $api_vm->read(false);
//    $output_enable = $api_vm->parseResponse($READ);
	
//	sleep(5);
	
    //3. cek arp
    $api_vm->write('/ping', false);
    $api_vm->write('=address=8.8.8.8', false);
    $api_vm->write('=count=5');
    $READ = $api_vm->read(false);
    $ARRAY = $api_vm->parseResponse($READ);
	
	//echo "<pre>";
	//print_r($ARRAY);
	//echo "</pre>";
	//
	$output_dial = '';
                
              
	if(count($ARRAY) >= 1)
	{

		  if($ARRAY[4]["received"] == "0")
		  {
			//$output_dial .= '<td>'.$value["status"].'</td>';
			$output_dial .= '<h3><span class="label bg-red">Tidak Bisa Dial, Hubungi NA Untuk detail info.</span></h3>';
		  }
		  else
		  {
			//$output_dial .= '<td>Reply from '.$value["host"].': bytes='.$value["size"].' time='.$value["time"].' TTL='.$value["ttl"].'</td>';
			$output_dial .= '<h3><span class="label  bg-green">re-Dial OK.</span></h3>';
		  }

	}
	
    
}
else
{
    $output_dial = '<h3><span class="label bg-red">Tidak Bisa Login ke Mesin VM</span></h3>';
    
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
													<h3 class="box-title">Cek Dial</h3>
													
												</div>
												<div class="box-body">
													 
													'.print_r($output_dial, true).'
                                                    
												</div>
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


	


$content .='	
								
							
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


    $title	= 'Cek User';
    $submenu	= "helpdesk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>