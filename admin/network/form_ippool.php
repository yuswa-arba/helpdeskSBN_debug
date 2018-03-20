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
    $ip_address	       	= isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
    $keterangan_ip   	= isset($_POST['keterangan_ip']) ? mysql_real_escape_string(trim($_POST['keterangan_ip'])) : '';
    $subnet_ip			= isset($_POST['subnet_ip']) ? mysql_real_escape_string(trim($_POST['subnet_ip'])) : '';
	$service_name		= isset($_POST['service_name']) ? mysql_real_escape_string(trim($_POST['service_name'])) : '';
    $flag_ip			= isset($_POST['flag_ip']) ? mysql_real_escape_string(trim($_POST['flag_ip'])) : '';
	$type_ip			= isset($_POST['type_ip']) ? mysql_real_escape_string(trim($_POST['type_ip'])) : '';
    
    if($ip_address != ""){
	//insert into gx_bts
	$sql_insert = "INSERT INTO `gx_master_ip_pool` (`id_ip`, `ip_address`, `subnet_ip`, `service_name`, `flag_ip`, `type_ip`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".ip2long($ip_address)."', '".$subnet_ip."', '".$service_name."', '".$flag_ip."', '".$type_ip."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	//echo $sql_insert_staff;
	mysql_query($sql_insert, $conn) or die (mysql_error());
	
	//
	$sql_lastdata		= mysql_query("SELECT `id_ip` FROM `gx_master_ip_pool` WHERE `ip_address`= '".ip2long($ip_address)."' AND `level` =  '0' ORDER BY `id_ip` DESC;", $conn);
	$row_lasdata		= mysql_fetch_array($sql_lastdata);
	
	//insert detail pool
	$ip_pool = getEachIpInRange ( $ip_address.'/'.$subnet_ip);
	foreach($ip_pool as $value)
	{
		
		//insert into gx_inet_grouptime
		$sql_insert_cust = "INSERT INTO `gx_master_ip` (`id_ip`, `id_ippool`, `ip_address`, `keterangan_ip`, `userid_ip`,
		`flag_ip`, `type_ip`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES (NULL, '".$row_lasdata['id_ip']."', '".ip2long($value)."',  '".$keterangan_ip."', '', '', '".$type_ip."',
		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert;
		mysql_query($sql_insert_cust, $conn) or die (mysql_error());
	
	}
	
	
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='master_ippool.php';
	    </script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_ip	 			= isset($_POST['id_ip']) ? mysql_real_escape_string(trim($_POST['id_ip'])) : '';
    $ip_address	       	= isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
    $keterangan_ip   	= isset($_POST['keterangan_ip']) ? mysql_real_escape_string(trim($_POST['keterangan_ip'])) : '';
    $subnet_ip			= isset($_POST['subnet_ip']) ? mysql_real_escape_string(trim($_POST['subnet_ip'])) : '';
	$service_name		= isset($_POST['service_name']) ? mysql_real_escape_string(trim($_POST['service_name'])) : '';
    $flag_ip			= isset($_POST['flag_ip']) ? mysql_real_escape_string(trim($_POST['flag_ip'])) : '';
	$type_ip			= isset($_POST['type_ip']) ? mysql_real_escape_string(trim($_POST['type_ip'])) : '';
    
    if($id_ip != ""){
		//insert into gx_bts
		$sql_update = "UPDATE `gx_master_ip_pool` SET `ip_address` = '".ip2long($ip_address)."',
				`subnet_ip` = '".$subnet_ip."', `service_name` = '".$service_name."', `flag_ip` = '".$flag_ip."', `type_ip` = '".$type_ip."',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `id_ip` = '".$id_ip."';";
		//echo $sql_update_staff;
		mysql_query($sql_update, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
		
		////insert into gx_bts
		//$sql_insert = "INSERT INTO `gx_master_ip_pool` (`id_ip`, `ip_address`, `subnet_ip`, `service_name`, `flag_ip`, `type_ip`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		//VALUES (NULL, '".ip2long($ip_address)."', '".$subnet_ip."', '".$service_name."', '".$flag_ip."', '".$type_ip."',
		//		'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		////echo $sql_insert_staff;
		//mysql_query($sql_insert, $conn) or die (mysql_error());
		//
		////log
		//enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='master_ippool.php';
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
    $query_data	= "SELECT * FROM `gx_master_ip_pool` WHERE `id_ip`='".$id_data."' LIMIT 0,1;";
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
                                    <h3 class="box-title">Form IP Address</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IP Address</label>
					    </div>
					    <div class="col-xs-3">
						<div class="input-group">
						  <div class="input-group-addon">
						    <i class="fa fa-laptop"></i>
						  </div>
						  <input type="text" class="form-control" data-inputmask="\'alias\': \'ip\'" data-mask="" name="ip_address" value="'.(isset($_GET['id']) ? long2ip($row_data["ip_address"]) : "").'">
						
						</div>
						
						<input type="hidden" name="id_ip" value="'.(isset($_GET['id']) ? $row_data["id_ip"] : "").'">
						
					    </div>
						<div class="col-xs-3">
							<select class="form-control" name="subnet_ip">
								<option value="24" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "24")) ? 'selected=""' : "").'>24</option>
								<option value="25" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "25")) ? 'selected=""' : "").'>25</option>
								<option value="26" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "26")) ? 'selected=""' : "").'>26</option>
								<option value="27" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "27")) ? 'selected=""' : "").'>27</option>
								<option value="28" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "28")) ? 'selected=""' : "").'>28</option>
								<option value="29" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "29")) ? 'selected=""' : "").'>29</option>
								<option value="30" '.((isset($_GET['id']) AND ($row_data['subnet_ip'] == "30")) ? 'selected=""' : "").'>30</option>
							</select>
						
						
						</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Service Name</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="service_name" max-length="100" value="'.(isset($_GET['id']) ? $row_data["service_name"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tipe</label>
					    </div>
					    <div class="col-xs-6">
						
						<select class="form-control"name="type_ip">
							<option value="public" '.((isset($_GET['id']) AND ($row_data['type_ip'] == "public")) ? 'selected=""' : "").'>IP Public</option>
							<option value="private" '.((isset($_GET['id']) AND ($row_data['type_ip'] == "private")) ? 'selected=""' : "").'>IP Private</option>
						</select>
						
					    </div>
                                        </div>
					</div>
                                        
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Flag</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="flag_ip" max-length="100" value="'.(isset($_GET['id']) ? $row_data["flag_ip"] : "").'">
						
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
    $submenu	= "master_ippool";
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