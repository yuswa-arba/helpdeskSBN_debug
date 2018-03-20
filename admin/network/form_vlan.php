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
    
if(isset($_POST["save"]))
{
    $ip_vlan	       	= isset($_POST['ip_vlan']) ? mysql_real_escape_string(trim($_POST['ip_vlan'])) : '';
    $keterangan_vlan   	= isset($_POST['keterangan_vlan']) ? mysql_real_escape_string(trim($_POST['keterangan_vlan'])) : '';
    $userid_vlan		= isset($_POST['userid_vlan']) ? mysql_real_escape_string(trim($_POST['userid_vlan'])) : '';
    $flag_vlan			= isset($_POST['flag_vlan']) ? mysql_real_escape_string(trim($_POST['flag_vlan'])) : '';
    
    if($ip_vlan != ""){
	//insert into gx_bts
	$sql_insert = "INSERT INTO `gx_master_vlan` (`id_vlan`, `ip_vlan`, `keterangan_vlan`, `userid_vlan`, `flag_vlan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".ip2long($ip_vlan)."', '".$keterangan_vlan."', '".$userid_vlan."', '".$flag_vlan."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	//echo $sql_insert_staff;
	mysql_query($sql_insert, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='master_vlan.php';
	    </script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_vlan 			= isset($_POST['id_vlan']) ? mysql_real_escape_string(trim($_POST['id_vlan'])) : '';
    $ip_vlan	       	= isset($_POST['ip_vlan']) ? mysql_real_escape_string(trim($_POST['ip_vlan'])) : '';
    $keterangan_vlan   	= isset($_POST['keterangan_vlan']) ? mysql_real_escape_string(trim($_POST['keterangan_vlan'])) : '';
    $userid_vlan       	= isset($_POST['userid_vlan']) ? mysql_real_escape_string(trim($_POST['userid_vlan'])) : '';
    $flag_vlan		   	= isset($_POST['flag_vlan']) ? mysql_real_escape_string(trim($_POST['flag_vlan'])) : '';
    
    if($id_vlan != ""){
		//insert into gx_bts
		$sql_update = "UPDATE `gx_master_vlan` SET `level` = '1',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `id_vlan` = '".$id_vlan."';";
		//echo $sql_update_staff;
		mysql_query($sql_update, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
		
		$sql_insert = "INSERT INTO `gx_master_vlan` (`id_vlan`, `ip_vlan`, `keterangan_vlan`, `userid_vlan`, `flag_vlan`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES (NULL, '".ip2long($ip_vlan)."', '".$keterangan_vlan."', '".$userid_vlan."', '".$flag_vlan."',
				'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert;
		mysql_query($sql_insert, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='master_vlan.php';
			</script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
}

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data	= "SELECT * FROM `gx_master_vlan` WHERE `id_vlan`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
}
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form VLAN</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>IP VLAN</label>
					    </div>
					    <div class="col-xs-8">
						<div class="input-group">
						  <div class="input-group-addon">
						    <i class="fa fa-laptop"></i>
						  </div>
						  <input type="text" class="form-control" data-inputmask="\'alias\': \'ip\'" data-mask="" name="ip_vlan" value="'.(isset($_GET['id']) ? long2ip($row_data["ip_vlan"]) : "").'">
						
						</div>
						
						<input type="hidden" name="id_vlan" value="'.(isset($_GET['id']) ? $row_data["id_vlan"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>UserID</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="userid_vlan" max-length="100" value="'.(isset($_GET['id']) ? $row_data["userid_vlan"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="keterangan_vlan" max-length="100" value="'.(isset($_GET['id']) ? $row_data["keterangan_vlan"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Flag</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="flag_vlan" max-length="100" value="'.(isset($_GET['id']) ? $row_data["flag_vlan"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
<script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js"></script>
<script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script text="javascript">
$(function () {
	$("[data-mask]").inputmask();
});
</script>
';

    $title	= 'Form VLAN';
    $submenu	= "master_vlan";
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