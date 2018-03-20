<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    
    $nama_gps   = isset($_POST['nama_gps']) ? mysql_real_escape_string(trim($_POST['nama_gps'])) : '';
    $imei_gps  	= isset($_POST['imei_gps']) ? mysql_real_escape_string(trim($_POST['imei_gps'])) : '';
    $no_sim	= isset($_POST['sim_gps']) ? mysql_real_escape_string(trim($_POST['sim_gps'])) : '';
    $sms_center = isset($_POST['sms_center']) ? mysql_real_escape_string(trim($_POST['sms_center'])) : '';
    $sos_1	= isset($_POST['sos_1']) ? mysql_real_escape_string(trim($_POST['sos_1'])) : '';
    $sos_2	= isset($_POST['sos_2']) ? mysql_real_escape_string(trim($_POST['sos_2'])) : '';
    $sos_3	= isset($_POST['sos_3']) ? mysql_real_escape_string(trim($_POST['sos_3'])) : '';
    $id_kendaraan	= isset($_POST['id_kendaraan']) ? mysql_real_escape_string(trim($_POST['id_kendaraan'])) : '';
    $id_employee	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';

    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_gps_device` (`id_gps`, `id_kendaraan`, `id_employee`, `no_sim`,
                    `nama_gps`, `sms_center`, `sos_1`, `sos_2`, `sos_3`, `imei`,
		    `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$id_kendaraan."', '".$id_employee."', '".$no_sim."', '".$nama_gps."',
		    '".$sms_center."', '".$sos_1."', '".$sos_2."', '".$sos_3."', '".$imei_gps."',
                    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."/master/master_gps.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    
    $id_gps 	= isset($_POST['id_gps']) ? mysql_real_escape_string(trim($_POST['id_gps'])) : '';
    $nama_gps   = isset($_POST['nama_gps']) ? mysql_real_escape_string(trim($_POST['nama_gps'])) : '';
    $imei_gps  	= isset($_POST['imei_gps']) ? mysql_real_escape_string(trim($_POST['imei_gps'])) : '';
    $no_sim	= isset($_POST['sim_gps']) ? mysql_real_escape_string(trim($_POST['sim_gps'])) : '';
    $sms_center = isset($_POST['sms_center']) ? mysql_real_escape_string(trim($_POST['sms_center'])) : '';
    $sos_1	= isset($_POST['sos_1']) ? mysql_real_escape_string(trim($_POST['sos_1'])) : '';
    $sos_2	= isset($_POST['sos_2']) ? mysql_real_escape_string(trim($_POST['sos_2'])) : '';
    $sos_3	= isset($_POST['sos_3']) ? mysql_real_escape_string(trim($_POST['sos_3'])) : '';
    $id_kendaraan	= isset($_POST['id_kendaraan']) ? mysql_real_escape_string(trim($_POST['id_kendaraan'])) : '';
    $id_employee	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';


    $sql_update = "UPDATE `gx_gps_device` SET `level` = '1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
                    WHERE `id_gps` = '".$id_gps."';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	//insert into gxCabang
    $sql_insert = "INSERT INTO `gx_gps_device` (`id_gps`, `id_kendaraan`, `id_employee`, `no_sim`,
                    `nama_gps`, `sms_center`, `sos_1`, `sos_2`, `sos_3`, `imei`,
		    `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
		    VALUES (NULL, '".$id_kendaraan."', '".$id_employee."', '".$no_sim."', '".$nama_gps."',
		    '".$sms_center."', '".$sos_1."', '".$sos_2."', '".$sos_3."', '".$imei_gps."',
                    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master/master_gps.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_gps	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_gps	= "SELECT `gx_gps_device`.*, `gx_pegawai`.`nama`, `gx_kendaraan`.`nama_kendaraan`
			 FROM `gx_gps_device`, `gx_pegawai`, `gx_kendaraan`
			 WHERE `gx_gps_device`.`id_employee` = `gx_pegawai`.`id_employee`
			 AND `gx_gps_device`.`id_kendaraan` = `gx_kendaraan`.`id_kendaraan`
			 AND `gx_gps_device`.`id_gps`='$id_gps'
			 AND `gx_gps_device`.`level` = '0' LIMIT 0,1;";
    $sql_gps	= mysql_query($query_gps, $conn);
    $row_gps	= mysql_fetch_array($sql_gps);
    
}
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form GPS</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="" id="form_gps" name="form_gps">
                                    <div class="box-body">
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nama GPS</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="nama_gps" value="'.(isset($_GET['id']) ? $row_gps["nama_gps"] : "").'">
						    '.(isset($_GET['id']) ? '<input type="hidden" name="id_gps" value="'.$id_gps.'">' : "").'
						</div>
					    </div>
                                        </div>
                                        <div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>IMEI GPS</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="imei_gps" value="'.(isset($_GET['id']) ? $row_gps["imei"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nomer SIM GPS</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="sim_gps" value="'.(isset($_GET['id']) ? $row_gps["no_sim"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>SMS Center</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="sms_center" value="'.(isset($_GET['id']) ? $row_gps["sms_center"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nomer SOS 1</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="sos_1" value="'.(isset($_GET['id']) ? $row_gps["sos_1"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nomer SOS 2</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="sos_2" value="'.(isset($_GET['id']) ? $row_gps["sos_2"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Nomer SOS 3</label>
						</div>
						<div class="col-xs-8">
						    <input type="text" class="form-control" name="sos_3" value="'.(isset($_GET['id']) ? $row_gps["sos_3"] : "").'">
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Kendaraan</label>
						</div>
						<div class="col-xs-8">
						    <input type="hidden" name="id_kendaraan" value="'.(isset($_GET['id']) ? $row_gps["id_kendaraan"] : "").'">
						    <input type="text" name="nama_kendaraan" value="'.(isset($_GET['id']) ? $row_gps["nama_kendaraan"] : "").'">
						    <a href="'.URL_ADMIN.'select.php?tipe=kendaraan&r=form_gps" class="btn btn-sm bg-navy btn-flat margin"
						onclick="return valideopenerform(\''.URL_ADMIN.'select.php?tipe=kendaraan&r=form_gps\',\'kendaraan\');">Select</a>
						</div>
					    </div>
                                        </div>
					<div class="form-group">
					    <div class="row">
						<div class="col-xs-4">
						    <label>Karyawan</label>
						</div>
						<div class="col-xs-8">
						    <input type="hidden" name="id_employee" value="'.(isset($_GET['id']) ? $row_gps["id_employee"] : "").'">
						    <input type="text" name="nama_employee" value="'.(isset($_GET['id']) ? $row_gps["nama"] : "").'">
						    <a href="'.URL_ADMIN.'select.php?tipe=pegawai&r=form_gps" class="btn btn-sm bg-navy btn-flat margin"
						onclick="return valideopenerform(\''.URL_ADMIN.'select.php?tipe=pegawai&r=form_gps\',\'pegawai\');">Select</a>
						</div>
					    </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form GPS';
    $submenu	= "master_gps";
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