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
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form OLT Server");

$messages = '';


if(isset($_POST["save"]))
{
    $nama_server    = isset($_POST['nama_server']) ? mysql_real_escape_string(trim($_POST['nama_server'])) : '';
    $desc_server    = isset($_POST['desc_server']) ? mysql_real_escape_string(trim($_POST['desc_server'])) : '';
    $ip_address	    = isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
    
	$uplink_port1	= isset($_POST['uplink_port1']) ? mysql_real_escape_string(trim($_POST['uplink_port1'])) : '';
	$uplink_port2	= isset($_POST['uplink_port2']) ? mysql_real_escape_string(trim($_POST['uplink_port2'])) : '';
	$uplink_port3	= isset($_POST['uplink_port3']) ? mysql_real_escape_string(trim($_POST['uplink_port3'])) : '';
	$uplink_port4	= isset($_POST['uplink_port4']) ? mysql_real_escape_string(trim($_POST['uplink_port4'])) : '';
	$uplink_port5	= isset($_POST['uplink_port5']) ? mysql_real_escape_string(trim($_POST['uplink_port5'])) : '';
	$uplink_port6	= isset($_POST['uplink_port6']) ? mysql_real_escape_string(trim($_POST['uplink_port6'])) : '';
	
	$username	    = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
	$password	    = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $group	    	= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$version_server = isset($_POST['version_server']) ? mysql_real_escape_string(trim($_POST['version_server'])) : '';
    
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `software`.`gx_inet_listolt` (`id_server`, `nama_server`, `desc_server`, `ip_address`,
					`version_server`, `username`, `password`, `group_server`, `uplink_port1`, `uplink_port2`,
					`uplink_port3`, `uplink_port4`, `uplink_port5`, `uplink_port6`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$nama_server."', '".$desc_server."', '".$ip_address."', '".$version_server."',
					'".$username."', '".$password."', '".$group."', '".$uplink_port1."', '".$uplink_port2."',
					'".$uplink_port3."', '".$uplink_port4."', '".$uplink_port5."', '".$uplink_port6."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
	$sql_server = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` ORDER BY `id_server` DESC LIMIT 0,1;", $conn);
    $row_server = mysql_fetch_array($sql_server);
	
	$a = array('0/1', '0/2', '0/3', '0/4');
	foreach($a as $pon)
	{
		for($b=1;$b<=64;$b++)
		{
			//insert into gx_inet_grouptime
			$sql_insert_cust = "INSERT INTO `db_sbn`.`gx_inet_olt_customer` (`id_olt_customer`, `id_olt`, `pon`, `id`, `userid`, `spliter_tray_port`,
			`otb01_tray_port`, `otb02_tray_port`, `tube`, `core`, `dome1`, `dome1_port`, `dome2`, `dome2_port`, `dome3`, `dome3_port`, `dome4`, `dome4_port`)
			VALUES (NULL, '".$row_server["id_server"]."', '".$pon."', '".$b."', '', '', '', '',	'', '', '', '', '', '', '', '', '', '');";
			//echo $sql_insert;
			mysql_query($sql_insert_cust, $conn) or die (mysql_error());
		}
	}
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_server_olt.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_server      = isset($_POST['id_server']) ? mysql_real_escape_string(trim($_POST['id_server'])) : '';
    $nama_server    = isset($_POST['nama_server']) ? mysql_real_escape_string(trim($_POST['nama_server'])) : '';
    $desc_server    = isset($_POST['desc_server']) ? mysql_real_escape_string(trim($_POST['desc_server'])) : '';
    $ip_address	    = isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
	
	$uplink_port1	= isset($_POST['uplink_port1']) ? mysql_real_escape_string(trim($_POST['uplink_port1'])) : '';
	$uplink_port2	= isset($_POST['uplink_port2']) ? mysql_real_escape_string(trim($_POST['uplink_port2'])) : '';
	$uplink_port3	= isset($_POST['uplink_port3']) ? mysql_real_escape_string(trim($_POST['uplink_port3'])) : '';
	$uplink_port4	= isset($_POST['uplink_port4']) ? mysql_real_escape_string(trim($_POST['uplink_port4'])) : '';
	$uplink_port5	= isset($_POST['uplink_port5']) ? mysql_real_escape_string(trim($_POST['uplink_port5'])) : '';
	$uplink_port6	= isset($_POST['uplink_port6']) ? mysql_real_escape_string(trim($_POST['uplink_port6'])) : '';
	
	$username	    = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
	$password	    = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $group	    	= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$version_server = isset($_POST['version_server']) ? mysql_real_escape_string(trim($_POST['version_server'])) : '';
    
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `software`.`gx_inet_listolt` SET `nama_server` = '".$nama_server."', `desc_server` = '".$desc_server."',
                `ip_address` = '".$ip_address."', `version_server` = '".$version_server."',  `uplink_port1` = '".$uplink_port1."',
				`uplink_port2` = '".$uplink_port2."', `uplink_port3` = '".$uplink_port3."', `uplink_port4` = '".$uplink_port4."',
				`uplink_port5` = '".$uplink_port5."', `uplink_port6` = '".$uplink_port6."', 
				`username` = '".$username."',  `password` = '".$password."', `group_server` = '".$group."',
                `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_server` = '".$id_server."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_server_olt.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_server  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_server = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` WHERE `id_server` = '".$id_server."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_server = mysql_fetch_array($sql_server);
    
}

$uplink_port1 = (isset($_GET["id"]) ? ($row_server["uplink_port1"]) : "");
$uplink_port2 = (isset($_GET["id"]) ? ($row_server["uplink_port2"]) : "");
$uplink_port3 = (isset($_GET["id"]) ? ($row_server["uplink_port3"]) : "");
$uplink_port4 = (isset($_GET["id"]) ? ($row_server["uplink_port4"]) : "");
$uplink_port5 = (isset($_GET["id"]) ? ($row_server["uplink_port5"]) : "");
$uplink_port6 = (isset($_GET["id"]) ? ($row_server["uplink_port6"]) : "");

    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form OLT Server</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Nama Server</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" maxlength="32" name="nama_server" value="'.(isset($_GET["id"]) ? $row_server["nama_server"] : "").'">
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_server" value="'.$row_server["id_server"].'">' : '').'
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Group</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <select name="group" class="form-control">';
												
												$sql_listgroup = mysql_query("SELECT * FROM `gx_inet_listgroup`;", $conn);
												while($row_listgroup = mysql_fetch_array($sql_listgroup))
												{
													$content .='<option value="'.$row_listgroup["id_inet_listgroup"].'" '.((isset($_GET["id"]) AND ($row_listgroup["id_inet_listgroup"] == $row_server["group_server"])) ? 'selected=""': "").'>'.$row_listgroup["nama_inet_listgroup"].'</option>';
												}
												
$content .='</select>
											</div>
                                        </div>
                                        </div>
                                        <div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>IP Address</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="ip_address" data-inputmask="\'alias\': \'ip\'" data-mask="" value="'.(isset($_GET["id"]) ? ($row_server["ip_address"]) : "").'">
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
											<div class="row">
                                            <div class="col-xs-2 text-center">
												<input type="checkbox" class="minimal uplink1" '.($uplink_port1 != "" ? 'checked=""' : "").'>
                                                <h5>Interface Uplink 1</h5>
												<input type="text" '.($uplink_port1 != "" ? '' : 'disabled=""').' maxlength="32" class="form-control uplink1_input" name="uplink_port1" value="'.(isset($_GET["id"]) ? ($row_server["uplink_port1"]) : "").'">
                                            </div>
                                            <div class="col-xs-2">
												<input type="checkbox" class="minimal uplink2" '.($uplink_port2 != "" ? 'checked=""' : "").'>
                                                <h5>Interface Uplink 2</h5>
												<input type="text" '.($uplink_port2 != "" ? '' : 'disabled=""').' maxlength="32" class="form-control uplink2_input" name="uplink_port2" value="'.(isset($_GET["id"]) ? ($row_server["uplink_port2"]) : "").'">
                                            </div>
											<div class="col-xs-2">
												<input type="checkbox" class="minimal uplink3" '.($uplink_port3 != "" ? 'checked=""' : "").'>
                                                <h5>Interface Uplink 3</h5>
												<input type="text" '.($uplink_port3 != "" ? '' : 'disabled=""').' maxlength="32" class="form-control uplink3_input" name="uplink_port3" value="'.(isset($_GET["id"]) ? ($row_server["uplink_port3"]) : "").'">
                                            </div>
											<div class="col-xs-2">
												<input type="checkbox" class="minimal uplink4" '.($uplink_port4 != "" ? 'checked=""' : "").'>
                                                <h5>Interface Uplink 4</h5>
												<input type="text" '.($uplink_port4 != "" ? '' : 'disabled=""').' maxlength="32" class="form-control uplink4_input" name="uplink_port4" value="'.(isset($_GET["id"]) ? ($row_server["uplink_port4"]) : "").'">
                                            </div>
											<div class="col-xs-2">
												<input type="checkbox" class="minimal uplink5" '.($uplink_port5 != "" ? 'checked=""' : "").'>
                                                <h5>Interface Uplink 5</h5>
												<input type="text" '.($uplink_port5 != "" ? '' : 'disabled=""').' maxlength="32" class="form-control uplink5_input" name="uplink_port5" value="'.(isset($_GET["id"]) ? ($row_server["uplink_port5"]) : "").'">
                                            </div>
											<div class="col-xs-2">
												<input type="checkbox" class="minimal uplink6" '.($uplink_port6 != "" ? 'checked=""' : "").'>
                                                <h5>Interface Uplink 6</h5>
												<input type="text" '.($uplink_port6 != "" ? '' : 'disabled=""').' maxlength="32" class="form-control uplink6_input" name="uplink_port6" value="'.(isset($_GET["id"]) ? ($row_server["uplink_port6"]) : "").'">
                                            </div>
                                        </div>
                                        </div>
										
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Username</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="username" maxlength="32" value="'.(isset($_GET["id"]) ? $row_server["username"] : "").'">
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Password</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="password" maxlength="32" value="'.(isset($_GET["id"]) ? $row_server["password"] : "").'">
                                            </div>
                                        </div>
                                    </div>
					<div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="desc_server" maxlength="255" value="'.(isset($_GET["id"]) ? $row_server["desc_server"] : "").'">
                                            </div>
                                        </div>
                                        </div>
									<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Versi Mikrotik</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="version_server" maxlength="100" value="'.(isset($_GET["id"]) ? $row_server["version_server"] : "").'">
                                            </div>
                                        </div>
                                    </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET["id"]) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script type="text/javascript">
        $(function() {
                $("[data-mask]").inputmask();
            });
			$(\'.uplink1\').on(\'ifChecked\', function(event){
				$(\'.uplink1_input\').removeAttr(\'disabled\');
			});
			
			$(\'.uplink1\').on(\'ifUnchecked\', function(event){
				$(\'.uplink1_input\').attr(\'disabled\',\'disabled\');   
			});
			
			$(\'.uplink2\').on(\'ifChecked\', function(event){
				$(\'.uplink2_input\').removeAttr(\'disabled\');
			});
			
			$(\'.uplink2\').on(\'ifUnchecked\', function(event){
				$(\'.uplink2_input\').attr(\'disabled\',\'disabled\');   
			});
			
			$(\'.uplink3\').on(\'ifChecked\', function(event){
				$(\'.uplink3_input\').removeAttr(\'disabled\');
			});
			
			$(\'.uplink3\').on(\'ifUnchecked\', function(event){
				$(\'.uplink3_input\').attr(\'disabled\',\'disabled\');   
			});
			
			$(\'.uplink4\').on(\'ifChecked\', function(event){
				$(\'.uplink4_input\').removeAttr(\'disabled\');
			});
			
			$(\'.uplink4\').on(\'ifUnchecked\', function(event){
				$(\'.uplink4_input\').attr(\'disabled\',\'disabled\');   
			});
			
			$(\'.uplink5\').on(\'ifChecked\', function(event){
				$(\'.uplink5_input\').removeAttr(\'disabled\');
			});
			
			$(\'.uplink6\').on(\'ifUnchecked\', function(event){
				$(\'.uplink6_input\').attr(\'disabled\',\'disabled\');   
			});

        </script>
    ';

    $title	= 'Form OLT Server';
    $submenu	= "inet_server_ras";
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