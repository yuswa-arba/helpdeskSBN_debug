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
$sql_data = mysql_query("SELECT * FROM `gx_setting_sms_notif` WHERE `id_setting_sms_notif` = '1';",$conn);
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
								<label>Mengirim SMS untuk wired down/power off onu</label>
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-xs-3">
								<label>Nomer HP 1</label>
							</div>
							<div class="col-xs-3">
								<input type="text" class="form-control" name="sms_1" value="'.$row_data["sms_1"].'">
							</div>
							<div class="col-xs-3">
								<label>Nomer HP 2</label>
							</div>
							<div class="col-xs-3">
								<input type="text" class="form-control" name="sms_2" value="'.$row_data["sms_2"].'">
							</div>
						</div>

					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-3">
								<label>Nomer HP 3</label>
							</div>
							<div class="col-xs-3">
								<input type="text" class="form-control" name="sms_3" value="'.$row_data["sms_3"].'">
							</div>
							<div class="col-xs-3">
								<label>Nomer HP 4</label>
							</div>
							<div class="col-xs-3">
								<input type="text" class="form-control" name="sms_4" value="'.$row_data["sms_4"].'">
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
	
    $sms_1	= isset($_POST['sms_1']) ? mysql_real_escape_string(trim($_POST['sms_1'])) : '';
	$sms_2	= isset($_POST['sms_2']) ? mysql_real_escape_string(trim($_POST['sms_2'])) : '';
	$sms_3	= isset($_POST['sms_3']) ? mysql_real_escape_string(trim($_POST['sms_3'])) : '';
	$sms_4	= isset($_POST['sms_4']) ? mysql_real_escape_string(trim($_POST['sms_4'])) : '';
	
    //insert into gx_setting_generate_inv
    $sql_update = "
	UPDATE `gx_setting_sms_notif` SET
	`sms_1`='".$sms_1."', `sms_2`='".$sms_2."', `sms_3`='".$sms_3."', `sms_4`='".$sms_4."',
	`user_upd`='".$loggedin["username"]."', `date_upd`=NOW() WHERE (`id_setting_sms_notif`='1');";
	
	//echo $sql_update;
    //echo $sql_update_staff;
    mysql_query($sql_update, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
		alert('Data telah diupdate.');
		window.location.href='sms_notifikasi.php';
	</script>";
	
}


    $title	= 'Setting SMS Notifikasi';
    $submenu	= "sms_notifikasi";
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