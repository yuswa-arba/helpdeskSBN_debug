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

if(isset($_GET["act"]))
{
	if($_GET["act"] == "enable")
	{
		$sql_update = "UPDATE `sbn_setting` SET `status` = '1',
		`last_update` = NOW()
		WHERE `id_setting`='1';";
		mysql_query($sql_update, $conn);		
		enableLog("","dwi", "dwi", "$sql_update");
		
		copy('/var/www/sbn/beta/admin/auto/kuota/cek_kuota_sbn_ras_enable.php', '/var/www/sbn/beta/admin/auto/cek_kuota_sbn_ras.php');
	}
	elseif($_GET["act"] == "disable")
	{
		$sql_update = "UPDATE `sbn_setting` SET `status` = '0',
		`last_update` = NOW()
		WHERE `id_setting`='1';";
		mysql_query($sql_update, $conn);
		enableLog("","dwi", "dwi", "$sql_update");
		
		copy('/var/www/sbn/beta/admin/auto/kuota/cek_kuota_sbn_ras_disable.php', '/var/www/sbn/beta/admin/auto/cek_kuota_sbn_ras.php');
	}
	
	echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='form_setting_kuota.php';
	</script>";
}

$sql_setting	= mysql_query("SELECT * FROM `sbn_setting` WHERE `id_setting` = '1' LIMIT 1;", $conn);
$row_setting	= mysql_fetch_array($sql_setting);

    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Setting Kuota</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
									<h5>Status Cron LIMITER : '.(($row_setting["status"] == "1") ? '<a href="form_setting_kuota.php?act=disable" class="btn-sm btn-success">Enable</a>' : '<a href="form_setting_kuota.php?act=enable" class="btn-sm btn-danger">Disable</a>').'</h5>
                                    
                                    <form role="form" method="POST" action="">
                                    ';
												

$sql_setting_kuota		= mysql_query("SELECT * FROM `sbn_setting_kuota`;", $conn);

while($row_setting_kuota = mysql_fetch_array($sql_setting_kuota))
{
	$id_cron = $row_setting_kuota["id_cron"];
	$bw_cron = $row_setting_kuota["bw_cron"];
	$start_kuota_cron = $row_setting_kuota["start_kuota_cron"];
	$end_kuota_cron = $row_setting_kuota["end_kuota_cron"];
	
	$content .= '<div class="form-group">
					<div class="row">
						<div class="col-xs-4">
							<h5>Bandwidth</h5>
							<select class="form-control" name="bw_cron['.$id_cron.']">
								<option value="h.10" '.(($bw_cron == "h.10") ? "selected" : "").'>h.10</option>
								<option value="h.09" '.(($bw_cron == "h.09") ? "selected" : "").'>h.09</option>
								<option value="h.08" '.(($bw_cron == "h.08") ? "selected" : "").'>h.08</option>
								<option value="h.07" '.(($bw_cron == "h.07") ? "selected" : "").'>h.07</option>
								<option value="h.06" '.(($bw_cron == "h.06") ? "selected" : "").'>h.06</option>
								<option value="h.05" '.(($bw_cron == "h.05") ? "selected" : "").'>h.05</option>
								<option value="h.04" '.(($bw_cron == "h.04") ? "selected" : "").'>h.04</option>
								<option value="h.03" '.(($bw_cron == "h.03") ? "selected" : "").'>h.03</option>
								<option value="h.02" '.(($bw_cron == "h.02") ? "selected" : "").'>h.02</option>
								<option value="h.01" '.(($bw_cron == "h.01") ? "selected" : "").'>h.01</option>
							</select>
						</div>
						<div class="col-xs-3">
							<h5>Kuota Awal</h5>
							<input type="text" required="" class="form-control" name="start_kuota_cron['.$id_cron.']" maxlength="4" value="'.$start_kuota_cron.'" placeholder="dalam GB">
						</div>
						<div class="col-xs-3">
							<h5>Kuota Akhir</h5>
							<input type="text" required="" class="form-control" name="end_kuota_cron['.$id_cron.']" maxlength="4" value="'.$end_kuota_cron.'"  placeholder="dalam GB">
						</div>
					</div>
				</div>';
	
}
						
						
						$content .= '
										<div class="form-group">
											<div class="row">
												
												<div class="col-xs-3">
													<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
												</div>
												
											</div>
                                        </div>
                                </form>
								
<hr>';
	
if(isset($_POST["submit"]))
{
	$bw_cron      = isset($_POST['bw_cron']) ? ($_POST['bw_cron']) : '';
	$start_kuota_cron	 = isset($_POST['start_kuota_cron']) ? ($_POST['start_kuota_cron']) : '';
	$end_kuota_cron		 = isset($_POST['end_kuota_cron']) ? ($_POST['end_kuota_cron']) : '';
	
	//echo "<pre>";
	//print_r($bw_cron);
	//echo "<pre>";
	
	foreach($bw_cron as $key => $value):
		$sql_update = "UPDATE `sbn_setting_kuota` SET `bw_cron` = '".$value."',
		`start_kuota_cron` = '".$start_kuota_cron[$key]."',
		`end_kuota_cron` = '".$end_kuota_cron[$key]."'
		WHERE `id_cron`='".$key."';";
		mysql_query($sql_update, $conn);
		enableLog("","dwi", "dwi", "$sql_update");
	endforeach;
	
	 echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='form_setting_kuota.php';
	</script>";
	
}
	
	
$content .='	
								
									
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Setting Kuota';
    $submenu	= "setting_kuota";
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