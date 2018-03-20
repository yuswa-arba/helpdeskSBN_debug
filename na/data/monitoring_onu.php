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
if($loggedin = logged_inGlobal()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Home");
    
		global $conn;


$content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Monitoring ONU Customer</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <form action="" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>User ID :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="userid" placeholder="User ID">
					</div>
					
				    </div>
				    </div>

				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>';
	
if(isset($_POST["search"]))
{
	$userid      = isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	
	if($userid != "")
	{
	
		
		
		//select data olt customer
		$result_olt_customer = mysql_query("SELECT * FROM `v_olt_customer` where userid = '".$userid."' AND `id_cabang` = '".$loggedin["cabang"]."' LIMIT 0,1;", $conn);
		$row_olt_customer = mysql_fetch_array($result_olt_customer);
		$count_olt_customer = mysql_num_rows($result_olt_customer);
		
		if($count_olt_customer == 1)
		{
			
			//select script from database	
			$result = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_onu';", $conn);
			$row = mysql_fetch_array($result);
			
			$result_lan1 = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_lan1';", $conn);
			$row_lan1 = mysql_fetch_array($result_lan1);
			$result_lan2 = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_lan2';", $conn);
			$row_lan2 = mysql_fetch_array($result_lan2);
			$result_lan3 = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_lan3';", $conn);
			$row_lan3 = mysql_fetch_array($result_lan3);
			$result_lan4 = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_lan4';", $conn);
			$row_lan4 = mysql_fetch_array($result_lan4);
			
			$result_power = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'status_power_onu';", $conn);
			$row_power = mysql_fetch_array($result_power);
			
			$replace = array(
				'[userid]' => trim($row_olt_customer["userid"]), 
				'[ip_address]' => trim($row_olt_customer["ip_address"]), 
				'[username]' => trim($row_olt_customer["username"]), 
				'[password]' => trim($row_olt_customer["password"]),
				'[pon]' => trim($row_olt_customer["pon"]),
				'[id]' => trim($row_olt_customer["id"]),
				'[port1]' => '1',
				'[port2]' => '2',
				'[port3]' => '3',
				'[port4]' => '4'
			); 
			$script = strReplaceAssoc($replace,$row["script"]);
			
			$script_lan1 = strReplaceAssoc($replace,$row_lan1["script"]);
			$script_lan2 = strReplaceAssoc($replace,$row_lan2["script"]);
			$script_lan3 = strReplaceAssoc($replace,$row_lan3["script"]);
			$script_lan4 = strReplaceAssoc($replace,$row_lan4["script"]);
			
			$script_power = strReplaceAssoc($replace,$row_power["script"]);
			
			$fh = fopen('olt/script.exp', 'w');
			fwrite($fh, $script);
			fclose($fh);
			chmod("/var/www/software/beta/na/data/olt/script.exp",0755);
			
			$flan1 = fopen('olt/script_lan1.exp', 'w');
			fwrite($flan1, $script_lan1);
			fclose($flan1);
			chmod("/var/www/software/beta/na/data/olt/script_lan1.exp",0755);
			$flan2 = fopen('olt/script_lan2.exp', 'w');
			fwrite($flan2, $script_lan2);
			fclose($flan2);
			chmod("/var/www/software/beta/na/data/olt/script_lan2.exp",0755);
			$flan3 = fopen('olt/script_lan3.exp', 'w');
			fwrite($flan3, $script_lan3);
			fclose($flan3);
			chmod("/var/www/software/beta/na/data/olt/script_lan3.exp",0755);
			$flan4 = fopen('olt/script_lan4.exp', 'w');
			fwrite($flan4, $script_lan4);
			fclose($flan4);
			chmod("/var/www/software/beta/na/data/olt/script_lan4.exp",0755);
			
			$fpower = fopen('olt/script_power.exp', 'w');
			fwrite($fpower, $script_power);
			fclose($fpower);
			chmod("/var/www/software/beta/na/data/olt/script_power.exp",0755);
			
			
			$old_path = getcwd();
			chdir('/var/www/software/beta/na/data/olt/');
			$output = shell_exec('./script.exp');
			$output_lan1 = shell_exec('./script_lan1.exp');
			$output_lan2 = shell_exec('./script_lan2.exp');
			$output_lan3 = shell_exec('./script_lan3.exp');
			$output_lan4 = shell_exec('./script_lan4.exp');
			
			$output_power = shell_exec('./script_power.exp');
			$output_inactive = '-';
			
			if (strpos($output, 'has bound 1 active ONUs') !== false) {
				$output = 'active';
			}elseif (strpos($output, 'has bound 1 inactive ONUs') !== false) {
				
				if (strpos($output, 'power-off') !== false) {
					$output = 'inactive';
					$output_inactive = 'power-off';
				}elseif (strpos($output, 'wire-down') !== false) {
					$output = 'inactive';
					$output_inactive = 'wire-down';
				}elseif (strpos($output, 'unknow') !== false) {
					$output = 'inactive';
					$output_inactive = 'unknown';
				}elseif (strpos($output, 'lost') !== false) {
					$output = 'inactive';
					$output_inactive = 'lost';
				}else{
					$output = 'inactive';
				}
				
			}
			
			if (strpos($output_lan1, 'Hardware state is Link-Up') !== false) {
				$output_lan1 = 'Hardware state is Link-Up';
			}elseif (strpos($output_lan1, 'Hardware state is Link-Down') !== false) {
				$output_lan1 = 'Hardware state is Link-Down';
			}else{ $output_lan1 = 'Hardware state is Link-Down'; }
			if (strpos($output_lan2, 'Hardware state is Link-Up') !== false) {
				$output_lan2 = 'Hardware state is Link-Up';
			}elseif (strpos($output_lan2, 'Hardware state is Link-Down') !== false) {
				$output_lan2 = 'Hardware state is Link-Down';
			}else{ $output_lan2 = 'Hardware state is Link-Down'; }
			if (strpos($output_lan3, 'Hardware state is Link-Up') !== false) {
				$output_lan3 = 'Hardware state is Link-Up';
			}elseif (strpos($output_lan3, 'Hardware state is Link-Down') !== false) {
				$output_lan3 = 'Hardware state is Link-Down';
			}else{ $output_lan3 = 'Hardware state is Link-Down'; }
			if (strpos($output_lan4, 'Hardware state is Link-Up') !== false) {
				$output_lan4 = 'Hardware state is Link-Up';
			}elseif (strpos($output_lan4, 'Hardware state is Link-Down') !== false) {
				$output_lan4 = 'Hardware state is Link-Down';
			}else{ $output_lan4 = 'Hardware state is Link-Down'; }
			
			
			$logFile = '/usr/script/txt/'.$userid.'power-onu.txt';
			//echo $logFile;
			$lines = file($logFile); // Get each line of the file and store it as an array
			$line_data =  count ($lines) - 2;
			if (strpos($lines[$line_data], 'received power(DBm)') !== false) {
				
				$output_power = $lines[$line_data];
			}else
			{
				$output_power = '-';
			}
			
			//$output = shell_exec("olt/script.exp");
			$content .= '<div class="row">
					<div class="col-xs-12 col-lg-8">
					    
			<div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Status ONU ('.$userid.')</h3>
                                    
                                </div>
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-4">
											<label>Status ONU</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Status Inactive</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_inactive.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Status LAN 1</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_lan1.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Status LAN 2</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_lan2.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Status LAN 3</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_lan3.'</pre>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-4">
											<label>Status LAN 4</label>
										</div>
										<div class="col-xs-8">
											<pre>'.$output_lan4.'</pre>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xs-4">
											<label>Status Power ONU</label>
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
			$content .= "<pre>UserID $userid tidak ditemukan.</pre>";
		}
	}
}
	
	
$content .='	
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

			
	$plugins = '';

    $title	= 'Monitoring ONU';
    $submenu	= "monitoring_onu";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= global_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
		
	
} else{
	header('location: '.URL_ADMIN.'logout.php');
}

?>