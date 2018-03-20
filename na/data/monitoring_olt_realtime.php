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

    global $conn;
enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List Inactive OLT Customer");
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">Monitoring Inactive OLT</h3>
                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <form action="" method="post" name="form_search">
									
									
									<div class="form-group">
									<div class="row">
										<div class="col-xs-2">
											<label>Kategori</label>
										</div>
										<div class="col-xs-2">
											<input name="kategori" type="radio" value="1" checked="checked">Per Cabang
											
										</div>
										<div class="col-xs-2">
											<input name="kategori" id="kategori" type="radio" value="2" >Per OLT
										</div>
										
									</div>
									</div>

				    <div class="form-group" id="olt" style="display:none">

				    <div class="row">
					<div class="col-xs-2">
					    <label>Server OLT</label>
					</div>
					<div class="col-xs-4">
					    <select name="id_olt" class="form-control">';

$sql_olt = mysql_query("SELECT * FROM `gx_inet_listolt` WHERE `level` = '0';", $conn);
while($row_olt = mysql_fetch_array($sql_olt))
{
	$content .='<option value="'.$row_olt["id_server"].'">'.$row_olt["nama_server"].'</option>';
}
						
						
$content .='
						</select>
					</div>
					
				    </div>
				    </div>
					
					<div class="form-group" id="cabang">

				    <div class="row">
					<div class="col-xs-2">
					    <label>Cabang</label>
					</div>
					<div class="col-xs-4">
					    <select name="id_cabang" class="form-control">';

$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$loggedin["cabang"]."' AND `level` = '0';", $conn);
while($row_cabang = mysql_fetch_array($sql_cabang))
{
	$content .='<option value="'.$row_cabang["id_cabang"].'">'.$row_cabang["nama_cabang"].'</option>';
}
						
						
$content .='
						</select>
					</div>
					
				    </div>
				    </div>
					
					
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
	';
	
if(isset($_POST["search"])){
	$id_olt		= isset($_POST["id_olt"]) ? trim(strip_tags($_POST["id_olt"])) : "";
	$id_cabang	= isset($_POST["id_cabang"]) ? trim(strip_tags($_POST["id_cabang"])) : "";
	$kategori	= isset($_POST["kategori"]) ? trim(strip_tags($_POST["kategori"])) : "";
	
	
	$sql_cabang = mysql_query("SELECT * FROM `gx_cabang`
								  WHERE `id_cabang` = '$id_cabang' ;", $conn);
		
	$row_cabang = mysql_fetch_array($sql_cabang);
		
	
	
	$result = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'list_inactive_onu';", $conn);
	$row = mysql_fetch_array($result);
	
	$content_wd = "";
	$content_off = "";
	$content_status = "";
	
	//per cabang
	if($kategori == "1")
	{
		$sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listolt`
								  WHERE `id_cabang` = '$id_cabang' AND `level` = '0';", $conn);
		$total_server_ras = mysql_num_rows($sql_server_ras);
		
		//echo $total_server_ras;
		$noa = 1;
		$script ='';
		
		$no_wd = 1;
		$no_status = 1;
		$no_off = 1;
		
		While($row_olt = mysql_fetch_array($sql_server_ras))
		{
		
			
			$replace = array(
				'[olt]' => trim($row_olt["nama_server"]), 
				'[ip_address]' => trim($row_olt["ip_address"]), 
				'[username]' => trim($row_olt["username"]), 
				'[password]' => trim($row_olt["password"])
				
			);
			$script .= strReplaceAssoc($replace,$row["script"]);
			
			$fh = fopen('/var/www/software/beta/na/data/olt/list_inactive'.$noa.'.exp', 'w');
			fwrite($fh, $script);
			fclose($fh);
			chmod("/var/www/software/beta/na/data/olt/list_inactive$noa.exp",0755);
			
			$old_path = getcwd();
			chdir('/var/www/software/beta/na/data/olt/');
			$output = shell_exec('./list_inactive'.$noa.'.exp');
			
			
			
			$noa++;
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
					
					//echo trim($LastDeregReason)."<BR>";
					if(trim($LastDeregReason) == "wire-down")
					{
						$content_wd .= "<tr><td>".$no_wd.".</td>";
						$content_wd .= "<td>".$row_olt_customer["nama_server"]."</td>";
						$content_wd .= "<td>".$row_olt_customer["userid"]."</td>";
						$content_wd .= "<td>".strtoupper(trim($mac_addr))."</td>";
						$content_wd .= "<td>".trim($status)."</td>";
						//$content .= "<td>".date("d-m-Y", strtotime($LastRegTime))."</td>";
						//$content .= "<td>".date("d-m-Y", strtotime($LastDeregTime))."</td>";
						$content_wd .= "<td>".trim($LastRegTime)."</td>";
						$content_wd .= "<td>".trim($LastDeregTime)."</td>";
						//$content_wd .= "<td>".trim($LastDeregReason)."</td>";
						$content_wd .= "<td>".trim($Abserttime)."</td></tr>";
						$no_wd++;
						//echo $content_wd;
					}
					elseif(trim($LastDeregReason) == "power-off" || trim($LastDeregReason) == "power off")
					{
						$content_off .= "<tr><td>".$no_off.".</td>";
						$content_off .= "<td>".$row_olt_customer["nama_server"]."</td>";
						$content_off .= "<td>".$row_olt_customer["userid"]."</td>";
						$content_off .= "<td>".strtoupper(trim($mac_addr))."</td>";
						$content_off .= "<td>".trim($status)."</td>";
						//$content .= "<td>".date("d-m-Y", strtotime($LastRegTime))."</td>";
						//$content .= "<td>".date("d-m-Y", strtotime($LastDeregTime))."</td>";
						$content_off .= "<td>".trim($LastRegTime)."</td>";
						$content_off .= "<td>".trim($LastDeregTime)."</td>";
						//$content_off .= "<td>".trim($LastDeregReason)."</td>";
						$content_off .= "<td>".trim($Abserttime)."</td></tr>";
						$no_off++;
						//echo $content_off;
					}
					else
					{
						$content_status .= "<tr><td>".$no_status.".</td>";
						$content_status .= "<td>".$row_olt_customer["nama_server"]."</td>";
						$content_status .= "<td>".$row_olt_customer["userid"]."</td>";
						$content_status .= "<td>".strtoupper(trim($mac_addr))."</td>";
						$content_status .= "<td>".trim($status)."</td>";
						//$content .= "<td>".date("d-m-Y", strtotime($LastRegTime))."</td>";
						//$content .= "<td>".date("d-m-Y", strtotime($LastDeregTime))."</td>";
						$content_status .= "<td>".trim($LastRegTime)."</td>";
						$content_status .= "<td>".trim($LastDeregTime)."</td>";
						$content_status .= "<td>".trim($LastDeregReason)."</td>";
						$content_status .= "<td>".trim($Abserttime)."</td></tr>";
						$no_status++;
					}
					
				}
				
				$content .= "</tr>";
				
			}
		
		
		
		
		}
		
		$content .= '<h3>'.$row_cabang["nama_cabang"].'</h3>
		<h4>Status : Wired-Down</h4>
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>OLT</th>
			<th>UserID</th>
			<th>MAC Address</th>
			<th>Status</th>
			<th>LastRegTime</th>
			<th>LastDeregTime</th>
			
			<th>Abserttime</th>
		
		</tr>
		</thead>
		<tbody>';
		$content .= $content_wd;
		
		
		$content .= '
		</tbody>
		</table>
		<hr>
		
		<h4>Status : Power-Off</h4>
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>OLT</th>
			<th>UserID</th>
			<th>MAC Address</th>
			<th>Status</th>
			<th>LastRegTime</th>
			<th>LastDeregTime</th>
			
			<th>Abserttime</th>
		
		</tr>
		</thead>
		<tbody>';
		$content .= $content_off;
		
		
		$content .= '
		</tbody>
		</table>
		<hr>
		<h4>Status: Unknown</h4>
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>OLT</th>
			<th>UserID</th>
			<th>MAC Address</th>
			<th>Status</th>
			<th>LastRegTime</th>
			<th>LastDeregTime</th>
			<th>LastDeregReason</th>
			<th>Abserttime</th>
		
		</tr>
		</thead>
		<tbody>';
		$content .= $content_status;
		
		
		$content .= "
		</tbody>
		</table>
		";
	}
	//per olt
	elseif($kategori == "2")
	{
		
		
		$sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listolt`
								  WHERE `id_server` = '$id_olt'
								  AND `level` = '0'
								  LIMIT 0,1;", $conn);
	$row_olt = mysql_fetch_array($sql_server_ras);
	
	$result = mysql_query("SELECT * FROM `gx_inet_olt_script` WHERE `nama_script` = 'list_inactive_onu';", $conn);
	$row = mysql_fetch_array($result);
	$replace = array(
		'[olt]' => trim($row_olt["nama_server"]), 
		'[ip_address]' => trim($row_olt["ip_address"]), 
		'[username]' => trim($row_olt["username"]), 
		'[password]' => trim($row_olt["password"])
		
	); 
	$script = strReplaceAssoc($replace,$row["script"]);
	
	
	$fh = fopen('olt/list_inactive.exp', 'w');
	fwrite($fh, $script);
	fclose($fh);
	chmod("/var/www/software/beta/na/data/olt/list_inactive.exp",0755);
	
	$old_path = getcwd();
	chdir('/var/www/software/beta/na/data/olt/');
	$output = shell_exec('./list_inactive.exp');
	
	$logFile = '/usr/script/txt/'.$row_olt["nama_server"].'.txt';
	//echo $logFile;
	$lines = file($logFile); // Get each line of the file and store it as an array
	//print_r($lines);

	$content .= '<h3>'.$row_olt["nama_server"].'</h3>
		
		<table class="table table-hover table-border">
		<thead>
		<tr>
			<th>No.</th>
			<th>IntfName</th>
			<th>MAC Address</th>
			<th>Status</th>
			<th>LastRegTime</th>
			<th>LastDeregTime</th>
			<th>LastDeregReason</th>
			<th>Abserttime</th>
		
		</tr>
		</thead>
		<tbody>';
	
	foreach($lines as $key)
	{
		
		$content .= "<tr>";
		$first_string = (explode(" ",$key));
		if (stripos($first_string[0], 'EPON') !== false) {
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
			
			$sql_olt_customer = mysql_query("SELECT * FROM `gx_inet_olt_customer`
								WHERE `id_olt` = '".$id_olt."'
								AND `pon` = '".$pon."'
								AND `id` = '".$id_pon."'
								LIMIT 0,1;", $conn);
			$row_olt_customer	= mysql_fetch_array($sql_olt_customer);
			
			$content .= "<td>".$no.".</td>";
			$content .= "<td>".$row_olt_customer["userid"]."</td>";
			$content .= "<td>".strtoupper(trim($mac_addr))."</td>";
			$content .= "<td>".trim($status)."</td>";
			//$content .= "<td>".date("d-m-Y", strtotime($LastRegTime))."</td>";
			//$content .= "<td>".date("d-m-Y", strtotime($LastDeregTime))."</td>";
			$content .= "<td>".trim($LastRegTime)."</td>";
			$content .= "<td>".trim($LastDeregTime)."</td>";
			$content .= "<td>".trim($LastDeregReason)."</td>";
			$content .= "<td>".trim($Abserttime)."</td>";
			
			$no++;
		}
		
		$content .= "</tr>";
		
	}
	
		
	}
	
    $content .= "
		</tbody>
		</table>";
	//$content .='<pre>'.$output.'</pre>';
	
}
$content .='
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->
            ';

$plugins = '<script language="javascript">
//ispay
$(\'input#kategori\').on(\'ifChecked\', function(event){
	document.getElementById("olt").style.display = "";
	document.getElementById("cabang").style.display = "none";
});
$(\'input#kategori\').on(\'ifUnchecked\', function(event){
	document.getElementById("cabang").style.display = "";
	document.getElementById("olt").style.display = "none";
});
</script>
';

    $title	= 'List Inactive OLT';
    $submenu	= "inet_server_ras";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	
	$template	= global_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
		
	
} else{
	header('location: '.URL_ADMIN.'logout.php');
}

?>