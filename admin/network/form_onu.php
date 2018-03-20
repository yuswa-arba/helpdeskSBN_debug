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
    $userid_onu	= isset($_POST['userid_onu']) ? mysql_real_escape_string(trim($_POST['userid_onu'])) : '';
    $sn_onu   	= isset($_POST['sn_onu']) ? mysql_real_escape_string(trim($_POST['sn_onu'])) : '';
    $mac_onu	= isset($_POST['mac_onu']) ? mysql_real_escape_string(trim($_POST['mac_onu'])) : '';
    $status_onu	= isset($_POST['status_onu']) ? mysql_real_escape_string(trim($_POST['status_onu'])) : '';
	
    if($userid_onu != ""){
	//insert into gx_bts
	$sql_insert = "INSERT INTO `gx_master_onu` (`id_onu`, `userid_onu`, `sn_onu`, `mac_onu`, `status_onu`,
	`dateadd_onu`, `dateupd_onu`, `useradd_onu`, `userupd_onu`, `level_onu`)
	VALUES (NULL, '".($userid_onu)."', '".$sn_onu."', '".$mac_onu."', '".$status_onu."', 
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	//echo $sql_insert_staff;
	mysql_query($sql_insert, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='master_onu.php';
	    </script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_onu	 			= isset($_POST['id_onu']) ? mysql_real_escape_string(trim($_POST['id_onu'])) : '';
    $userid_onu	       	= isset($_POST['userid_onu']) ? mysql_real_escape_string(trim($_POST['userid_onu'])) : '';
    $sn_onu   	= isset($_POST['sn_onu']) ? mysql_real_escape_string(trim($_POST['sn_onu'])) : '';
    $mac_onu			= isset($_POST['mac_onu']) ? mysql_real_escape_string(trim($_POST['mac_onu'])) : '';
    $status_onu			= isset($_POST['status_onu']) ? mysql_real_escape_string(trim($_POST['status_onu'])) : '';
	    
    if($id_onu != ""){
		//insert into gx_bts
		$sql_update = "UPDATE `gx_master_onu` SET `userid_onu` = '".$userid_onu."', `sn_onu` = '".$sn_onu."',
		`mac_onu` = '".$mac_onu."', `status_onu` = '".$status_onu."',
				`userupd_onu` = '".$loggedin["username"]."', `dateupd_onu` = NOW()
				WHERE `id_onu` = '".$id_onu."';";
		//echo $sql_update_staff;
		mysql_query($sql_update, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='master_onu.php';
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
    $query_data	= "SELECT * FROM `gx_master_onu` WHERE `id_onu`='".$id_data."' LIMIT 0,1;";
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
                                    <h3 class="box-title">Form Master ONU</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>USER ID</label>
					    </div>
					    <div class="col-xs-8">
						
						  <input type="text" class="form-control" name="userid_onu" value="'.(isset($_GET['id']) ? ($row_data["userid_onu"]) : "").'">
						
						
						<input type="hidden" name="id_onu" value="'.(isset($_GET['id']) ? $row_data["id_onu"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>MAC ADDRESS ONU</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="mac_onu" max-length="100" value="'.(isset($_GET['id']) ? $row_data["mac_onu"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>SN ONU</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="sn_onu" max-length="100" value="'.(isset($_GET['id']) ? $row_data["sn_onu"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-4">
						
						<select class="form-control"name="status_onu">
							<option value="1" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "1")) ? 'selected=""' : "").'>Terpasang</option>
							<option value="2" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "2")) ? 'selected=""' : "").'>Belum bongkar</option>
							<option value="3" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "3")) ? 'selected=""' : "").'>Sudah Bongkar</option>
							<option value="4" '.((isset($_GET['id']) AND ($row_data['status_onu'] == "4")) ? 'selected=""' : "").'>Sudah Tes</option>
						</select>
						
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

    $title	= 'Form ONU';
    $submenu	= "master_onu";
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