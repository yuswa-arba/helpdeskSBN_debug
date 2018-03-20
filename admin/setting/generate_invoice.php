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
if($loggedin = logged_inAdmin())
{ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Seting Generate Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
						<div class="row">
							<div class="col-xs-3">
								<label>Tanggal Generate tiap bulan</label>
							</div>
							<div class="col-xs-2">
								<select class="form-control" name="date">';
								
								for($date=1; $date<=31; $date++)
								{
									$content .= '<option value="'.$date.'">'.$date.'</option>';
								}

$content .='								
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-xs-3">
								<label>Jam Generate</label>
							</div>
							<div class="col-xs-2">
								<select class="form-control" name="time">';
								
								for($time=1; $time<=24; $time++)
								{
									$content .= '<option value="'.$time.'">'.$time.'</option>';
								}

$content .='								
								</select>
							</div>
						</div>
					</div>
					
					
									</div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input class="btn bg-olive btn-flat" value="Save" name="update" type="submit">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
<!-- datepicker -->
<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
    $(function() {
	$("[id=datepicker]").datepicker({format: "dd/mm/yyyy"});
	
    });
</script>

';

if(isset($_POST["update"]))
{
	
    $id			= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$date		= isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
	$time		= isset($_POST['time']) ? mysql_real_escape_string(trim($_POST['time'])) : '';
	
	if($date != "" AND $time != "")
	{
		//insert into gx_bagian
		$sql_update = "UPDATE `software`.`gx_setting_generate` SET `date` = '".$perusahaan."', `time` = '".$counter_1."',
		`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
		WHERE (`id`='1');";
		//echo $sql_update;
		//echo $sql_update_staff;
		mysql_query($sql_update, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	}
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='setting_perusahaan.php';
	</script>";
	
}


    $title	= 'Setting Generate Invoice';
    $submenu	= "setting_generate_invoice";
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