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
$sql_data = mysql_query("SELECT * FROM `gx_setting_prioritas` WHERE `id_setting_prioritas` = '1';",$conn);
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
									<label>Prioritas 1</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nomer ACC" name="no_acc_p1" value="'.$row_data["no_acc_p1"].'">
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nama ACC" name="nama_acc_p1" value="'.$row_data["no_acc_p1"].'">
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
									<label>Prioritas 2</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nomer ACC" name="no_acc_p2" value="'.$row_data["no_acc_p2"].'">
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nama ACC" name="nama_acc_p2" value="'.$row_data["nama_acc_p2"].'">
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
									<label>Prioritas 3</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nomer ACC" name="no_acc_p3" value="'.$row_data["no_acc_p3"].'">
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nama ACC" name="nama_acc_p3" value="'.$row_data["nama_acc_p3"].'">
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
									<label>Diluar Prioritas</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nomer ACC" name="no_acc_luarp" value="'.$row_data["no_acc_luarp"].'">
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" placeholder="Nama ACC" name="nama_acc_luarp" value="'.$row_data["nama_acc_luarp"].'">
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
	
    $no_acc_luarp	= isset($_POST['no_acc_luarp']) ? mysql_real_escape_string(trim($_POST['no_acc_luarp'])) : '';
	$nama_acc_luarp	= isset($_POST['jam_generate_fo']) ? mysql_real_escape_string(trim($_POST['jam_generate_fo'])) : '';
	$no_acc_p1		= isset($_POST['no_acc_p1']) ? mysql_real_escape_string(trim($_POST['no_acc_p1'])) : '';
	$nama_acc_p1	= isset($_POST['nama_acc_p1']) ? mysql_real_escape_string(trim($_POST['nama_acc_p1'])) : '';
	$no_acc_p2		= isset($_POST['no_acc_p2']) ? mysql_real_escape_string(trim($_POST['no_acc_p2'])) : '';
	$nama_acc_p2	= isset($_POST['nama_acc_p2']) ? mysql_real_escape_string(trim($_POST['nama_acc_p2'])) : '';
	$no_acc_p3		= isset($_POST['no_acc_p3']) ? mysql_real_escape_string(trim($_POST['no_acc_p3'])) : '';
	$nama_acc_p3	= isset($_POST['nama_acc_p3']) ? mysql_real_escape_string(trim($_POST['nama_acc_p3'])) : '';
	
	
    //insert into gx_setting_generate_inv
    $sql_update = "
	UPDATE `software`.`gx_setting_prioritas` SET `no_acc_p1`='".$no_acc_p1."',
	`nama_acc_p1`='".$nama_acc_p1."', `no_acc_p2`='".$no_acc_p2."', `nama_acc_p2`='".$nama_acc_p2."', `no_acc_p3`='".$no_acc_p2."',
	`nama_acc_p3`='".$nama_acc_p3."', `no_acc_luarp`='".$no_acc_luarp."', `nama_acc_luarp`='".$nama_acc_luarp."',
	`user_upd`='".$loggedin["username"]."', `date_upd`=NOW() WHERE (`id_setting_prioritas`='1');";
	
	//echo $sql_update;
    //echo $sql_update_staff;
    mysql_query($sql_update, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='prioritas.php';
	</script>";
	
}


    $title	= 'Setting Prioritas';
    $submenu	= "setting_prioritas";
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