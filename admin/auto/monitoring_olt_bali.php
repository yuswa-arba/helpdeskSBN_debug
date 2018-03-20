#!/usr/bin/php5
<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("/var/www/software/beta/config/configuration_admin.php");

global $conn;

	$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '6' AND `level` = '0';", $conn);
	//$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE  `level` = '0';", $conn);
	
	$result = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'list_inactive_onu';", $conn);
	$row = mysql_fetch_array($result);
	
	$content_wd = "";
	$content_off = "";
	$content_status = "";
	
	//per cabang
	while ($row_cabang = mysql_fetch_array($sql_cabang))
	{
		$sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listolt`
								  WHERE `id_cabang` = '".$row_cabang["id_cabang"]."' AND `level` = '0';", $conn);
		$total_server_ras = mysql_num_rows($sql_server_ras);
		
		//echo $total_server_ras;
		$script ='';
		$noa = 1;
		
		While($row_olt = mysql_fetch_array($sql_server_ras))
		{		
			
			$replace = array(
				'[olt]' => trim($row_olt["nama_server"]), 
				'[ip_address]' => trim($row_olt["ip_address"]), 
				'[username]' => trim($row_olt["username"]), 
				'[password]' => trim($row_olt["password"])
				
			);
			$script = strReplaceAssoc($replace,$row["script"]);
			
			$fh = fopen('/var/www/software/beta/admin/auto/olt/list_inactive'.$noa.'.exp', 'w');
			fwrite($fh, $script);
			fclose($fh);
			chmod("/var/www/software/beta/admin/auto/olt/list_inactive$noa.exp",0755);
			
			$old_path = getcwd();
			chdir('/var/www/software/beta/admin/auto/olt/');
			$output = shell_exec('./list_inactive'.$noa.'.exp');
			
			
			
			
			$logFile = '/usr/script/txt/'.$row_olt["nama_server"].'.txt';
			//echo $logFile;
			$lines = file($logFile); // Get each line of the file and store it as an array
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
					
					$sql_olt_customer = mysql_query("SELECT * FROM `v_olt_customer`
										WHERE `id_olt` = '".$row_olt["id_server"]."'
										AND `pon` = '".$pon."'
										AND `id` = '".$id_pon."'
										LIMIT 0,1;", $conn);
					
					$row_olt_customer	= mysql_fetch_array($sql_olt_customer);
					
					$sql_insert = "INSERT INTO `software`.`gx_inet_monitoring_olt` (`id_`, `olt`, `pon`, `pon_id`, `userid`, `mac_address`, `status`,
					`lastregtime`, `lastderegtime`, `lastderegreason`, `abserttime`, `date_add`, `user_add`)
					VALUES (NULL, '".$row_olt["id_server"]."', '".$pon."', '".$id_pon."', '".$row_olt_customer["userid"]."',
					'".trim($mac_addr)."', '".trim($status)."', '".trim($LastRegTime)."', '".trim($LastDeregTime)."', '".trim($LastDeregReason)."',
					'".trim($Abserttime)."', NOW(), 'auto_cronjob');";
					
					//print $sql_insert."<br>";
					mysql_query($sql_insert, $conn);
						//
						//$content_status .= "<tr><td>".$no_status.".</td>";
						//$content_status .= "<td>".$row_olt_customer["nama_server"]."</td>";
						//$content_status .= "<td>".$row_olt_customer["userid"]."</td>";
						//$content_status .= "<td>".strtoupper(trim($mac_addr))."</td>";
						//$content_status .= "<td>".trim($status)."</td>";
						////$content .= "<td>".date("d-m-Y", strtotime($LastRegTime))."</td>";
						////$content .= "<td>".date("d-m-Y", strtotime($LastDeregTime))."</td>";
						//$content_status .= "<td>".trim($LastRegTime)."</td>";
						//$content_status .= "<td>".trim($LastDeregTime)."</td>";
						//$content_status .= "<td>".trim($LastDeregReason)."</td>";
						//$content_status .= "<td>".trim($Abserttime)."</td></tr>";
						
					
					
				}
				
				
				
			}
		
		$noa++;
		
		}
	}
