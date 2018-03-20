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
                                                <input type="text" required="" class="form-control" name="userid" value="">
												
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
	$selected = isset($_GET["id"]) ? $row_data["id_olt"] : "";
	$selected = ($selected == $row_olt["id_server"]) ? ' selected=""' : "";
	
	$content .= '<option value="'.$row_olt["id_server"].'">'.$row_olt["nama_server"].'</option>';
	
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
													<input type="text" required="" class="form-control" name="pon" maxlength="6" value="">
												</div>
												<div class="col-xs-3">
													<h5>ID</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" required="" class="form-control" name="id" maxlength="4" value="">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>VLAN</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" required="" class="form-control" name="vlan" value="">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC ADDRESS</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" required="" class="form-control" name="mac_address" min-length="14" value="">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													&nbsp;
												</div>
												<div class="col-xs-3">
													<button type="submit" name="aktifasi" class="btn btn-primary">Aktifasi</button>
												</div>
												
											</div>
                                        </div>
                                </form>
								
<hr>';
	
if(isset($_POST["aktifasi"]))
{
	$userid      = isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$vlan		 = isset($_POST['vlan']) ? mysql_real_escape_string(trim($_POST['vlan'])) : '';
	$id_olt		 = isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
	$pon		 = isset($_POST['pon']) ? mysql_real_escape_string(trim($_POST['pon'])) : '';
	$pon_id			 = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$mac_address = isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
	
	if($userid != "")
	{
	
		//insert log aktivasi
		mysql_query("INSERT INTO `db_sbn`.`gx_log_aktivasi` (`id_log_aktivasi`, `userid_aktivasi`, `vlan_aktivasi`, `idolt_aktivasi`, `pon_aktivasi`, `ponid_aktivasi`, `macaddress_aktivasi`, `log`)
					VALUES ('', '".$userid."', '".$vlan."', '".$id_olt."', '".$pon."', '".$pon_id."', '".$mac_address."', NOW());", $conn);
		
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `gx_inet_listolt` where id_server = '".$id_olt."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		if($count_olt_customer == 1)
		{
			
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
			$script_create_vlan_olt = strReplaceAssoc($replace,$data_create_vlan_olt["script"]);
			
			$script_reg_onu 		= strReplaceAssoc($replace,$data_reg_onu["script"]);
			$script_config_onu 		= strReplaceAssoc($replace,$data_config_onu["script"]);
			$script_show_vlan 		= strReplaceAssoc($replace,$data_show_vlan["script"]);
			//$script_remove_vlan_olt = strReplaceAssoc($replace,$data_remove_vlan_olt["script"]);
			
			$fh = fopen('olt/aktivasi/reg_onu.exp', 'w');
			fwrite($fh, $script_reg_onu);
			fclose($fh);
			chmod("/var/www/software/beta/admin/data/olt/aktivasi/reg_onu.exp",0755);
			
			$flan1 = fopen('olt/aktivasi/config_onu.exp', 'w');
			fwrite($flan1, $script_config_onu);
			fclose($flan1);
			chmod("/var/www/software/beta/admin/data/olt/aktivasi/config_onu.exp",0755);
			
			$flan2 = fopen('olt/aktivasi/show_vlan_olt.exp', 'w');
			fwrite($flan2, $script_show_vlan);
			fclose($flan2);
			chmod("/var/www/software/beta/admin/data/olt/aktivasi/show_vlan_olt.exp",0755);
			
			//$flan3 = fopen('olt/aktivasi/remove_vlan_olt.exp', 'w');
			//fwrite($flan3, $script_remove_vlan_olt);
			//fclose($flan3);
			//chmod("/var/www/software/beta/admin/data/olt/aktivasi/remove_vlan_olt.exp",0755);
			
			$flan4 = fopen('olt/aktivasi/create_vlan_olt.exp', 'w');
			fwrite($flan4, $script_create_vlan_olt);
			fclose($flan4);
			chmod("/var/www/software/beta/admin/data/olt/aktivasi/create_vlan_olt.exp",0755);
			
			
			$old_path = getcwd();
			chdir('/var/www/software/beta/admin/data/olt/aktivasi/');
			$output_reg = shell_exec('expect reg_onu.exp');
			sleep(60);
			$output_config = shell_exec('expect config_onu.exp');
			//sleep(30);
			$output_show = shell_exec('expect show_vlan_olt.exp');
			//sleep(30);
			
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
				//echo $pon."<br>";
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
		
		$script_remove_vlan_olt2 = strReplaceAssoc($replace,$script_remove_vlan_olt1);
		
		$flan3 = fopen('/var/www/software/beta/admin/data/olt/aktivasi/remove_vlan_olt2.exp', 'w');
		fwrite($flan3, $script_remove_vlan_olt2);
		fclose($flan3);
		chmod("/var/www/software/beta/admin/data/olt/aktivasi/remove_vlan_olt2.exp",0755);
			
			if($remove_script != "")
			{
				//echo $remove_script;
				$output_remove = shell_exec('expect remove_vlan_olt2.exp');
				
				//sleep(30);

			}
			$output_create = shell_exec('expect create_vlan_olt.exp');
			//sleep(30);
			
			
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