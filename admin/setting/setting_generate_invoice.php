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
    if($loggedin["group"] == 'admin')
    {
        global $conn;
$sql_data = mysql_query("SELECT * FROM `gx_setting_generate_inv` WHERE `id_setting_generate_inv` = '1';",$conn);
$row_data = mysql_fetch_array($sql_data);

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Seting</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Tanggal Generate invoice bulanan FO</label>
								</div>
								<div class="col-xs-6">
									<select name="tgl_generate_fo" class="form-control">';
									
									for($tgl_fo=1;$tgl_fo<=31;$tgl_fo++)
									{
										$content .='<option value="'.$tgl_fo.'" '.(($row_data["tgl_generate_fo"] == $tgl_fo) ? 'selected=""' : "").'>'.$tgl_fo.'</option>';
									}
									
$content .='						</select>
								</div>
							</div>
					    </div>
						<div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Jam Generate invoice bulanan FO</label>
								</div>
								<div class="col-xs-6">
									<select name="jam_generate_fo" class="form-control">';
									
									for($jam_fo=1;$jam_fo<=23;$jam_fo++)
									{
										$content .='<option value="'.$jam_fo.'" '.(($row_data["jam_generate_fo"] == $jam_fo) ? 'selected=""' : "").'>'.$jam_fo.'</option>';
									}
									
$content .='						</select>
								</div>
							</div>
					    </div>
					    
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Tanggal Generate invoice bulanan WL</label>
								</div>
								<div class="col-xs-6">
									<select name="tgl_generate_wl" class="form-control">';
									
									for($tgl_wl=1;$tgl_wl<=31;$tgl_wl++)
									{
										$content .='<option value="'.$tgl_wl.'" '.(($row_data["tgl_generate_wl"] == $tgl_wl) ? 'selected=""' : "").'>'.$tgl_wl.'</option>';
									}
									
$content .='						</select>
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Jam Generate invoice bulanan WL</label>
								</div>
								<div class="col-xs-6">
									<select name="jam_generate_wl" class="form-control">';
									
									for($jam_wl=1;$jam_wl<=23;$jam_wl++)
									{
										$content .='<option value="'.$jam_wl.'" '.(($row_data["jam_generate_wl"] == $jam_wl) ? 'selected=""' : "").'>'.$jam_wl.'</option>';
									}
									
$content .='						</select>
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Send email otomatis invoice :</label>
								</div>
								
							</div>
					    </div>
					    
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>TO</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="email_to" value="'.$row_data["email_to"].'">
								</div>
							</div>
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>CC</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="email_cc" value="'.$row_data["email_cc"].'">
								</div>
							</div>
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>BCC</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="email_bcc" value="'.$row_data["email_bcc"].'">
								</div>
							</div>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Otomatis</label>
								</div>
								<div class="col-xs-6">
									<div class="radio">
										<label>
											<input type="radio" name="otomatis" id="otomatis" value="ya" '.(($row_data["otomatis"] == "ya") ? 'checked=""' : "").'>
											On
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="otomatis" id="otomatis" value="tidak" '.(($row_data["otomatis"] == "tidak") ? 'checked=""' : "").'>
											Off
										</label>
									</div>
								</div>
							</div>
					    </div>
					    
                    </div>
					</div>
					
					
					
									</div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input class="btn bg-olive btn-flat" value="Submit" name="update" type="submit">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
    $(function() {
	$("[id=datepicker]").datepicker({format: "dd/mm/yyyy"});
	
    });
</script>

';

if(isset($_POST["update"]))
{
	
    $tgl_generate_fo	= isset($_POST['tgl_generate_fo']) ? mysql_real_escape_string(trim($_POST['tgl_generate_fo'])) : '';
	$jam_generate_fo	= isset($_POST['jam_generate_fo']) ? mysql_real_escape_string(trim($_POST['jam_generate_fo'])) : '';
	$tgl_generate_wl	= isset($_POST['tgl_generate_wl']) ? mysql_real_escape_string(trim($_POST['tgl_generate_wl'])) : '';
	$jam_generate_wl	= isset($_POST['jam_generate_wl']) ? mysql_real_escape_string(trim($_POST['jam_generate_wl'])) : '';
	$email_to			= isset($_POST['email_to']) ? mysql_real_escape_string(trim($_POST['email_to'])) : '';
	$email_cc			= isset($_POST['email_cc']) ? mysql_real_escape_string(trim($_POST['email_cc'])) : '';
	$email_bcc			= isset($_POST['email_bcc']) ? mysql_real_escape_string(trim($_POST['email_bcc'])) : '';
	$otomatis			= isset($_POST['otomatis']) ? mysql_real_escape_string(trim($_POST['otomatis'])) : '';
	
    //insert into gx_setting_generate_inv
    $sql_update = "
	UPDATE `gx_setting_generate_inv` SET `id_setting_generate_inv`='1',
	`tgl_generate_fo`='".$tgl_generate_fo."', `tgl_generate_wl`='".$tgl_generate_wl."', `jam_generate_fo`='".$jam_generate_fo."',
	`jam_generate_wl`='".$jam_generate_wl."', `email_to`='".$email_to."', `email_cc`='".$email_cc."', `email_bcc`='".$email_bcc."',
	`otomatis`='".$otomatis."',  `user_upd`='".$loggedin["username"]."', `date_upd`=NOW() WHERE (`id_setting_generate_inv`='1');";
	
	//echo $sql_update;
    //echo $sql_update_staff;
    mysql_query($sql_update, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='setting_generate_invoice.php';
	</script>";
	
}


    $title	= 'Setting Generate Invoice';
    $submenu	= "setting_generate";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>