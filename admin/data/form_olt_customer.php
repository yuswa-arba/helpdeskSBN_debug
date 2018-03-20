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

$messages = '';


if(isset($_POST["save"]))
{
    $user_cabang		= isset($_POST['user_cabang']) ? mysql_real_escape_string(trim($_POST['user_cabang'])) : '';
	$userid				= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$id_olt				= isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
	$interface_uplink	= isset($_POST['interface_uplink']) ? mysql_real_escape_string(trim($_POST['interface_uplink'])) : '';
    $mac_address		= isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
    $pon   				= isset($_POST['pon']) ? mysql_real_escape_string(trim($_POST['pon'])) : '';
    $id   				= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$spliter_tray_port	= isset($_POST['spliter_tray_port']) ? mysql_real_escape_string(trim($_POST['spliter_tray_port'])) : '';
	$otb01_tray_port	= isset($_POST['otb01_tray_port']) ? mysql_real_escape_string(trim($_POST['otb01_tray_port'])) : '';
	$otb02_tray_port   	= isset($_POST['otb02_tray_port']) ? mysql_real_escape_string(trim($_POST['otb02_tray_port'])) : '';
	$tube    			= isset($_POST['tube']) ? mysql_real_escape_string(trim($_POST['tube'])) : '';
	$core   			= isset($_POST['core']) ? mysql_real_escape_string(trim($_POST['core'])) : '';
	$dome1    			= isset($_POST['dome1']) ? mysql_real_escape_string(trim($_POST['dome1'])) : '';
	$dome1_port   		= isset($_POST['dome1_port']) ? mysql_real_escape_string(trim($_POST['dome1_port'])) : '';
	$dome2   			= isset($_POST['dome2']) ? mysql_real_escape_string(trim($_POST['dome2'])) : '';
	$dome2_port   		= isset($_POST['dome2_port']) ? mysql_real_escape_string(trim($_POST['dome2_port'])) : '';
	$dome3   			= isset($_POST['dome3']) ? mysql_real_escape_string(trim($_POST['dome3'])) : '';
	$dome3_port   		= isset($_POST['dome3_port']) ? mysql_real_escape_string(trim($_POST['dome3_port'])) : '';
	$dome4   			= isset($_POST['dome4']) ? mysql_real_escape_string(trim($_POST['dome4'])) : '';
	$dome4_port   		= isset($_POST['dome4_port']) ? mysql_real_escape_string(trim($_POST['dome4_port'])) : '';
    
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `software`.`gx_inet_olt_customer` (`id_olt_customer`, `id_olt`, `interface_uplink`, `pon`, `id`, `userid`, `spliter_tray_port`,
	`otb01_tray_port`, `otb02_tray_port`, `tube`, `core`, `dome1`, `dome1_port`, `dome2`, `dome2_port`, `dome3`, `dome3_port`, `dome4`, `dome4_port`, `mac_address`)
	VALUES (NULL, '".$id_olt."', '".$interface_uplink."', '".$pon."', '".$id."', '".$userid."', '".$spliter_tray_port."', '".$otb01_tray_port."', '".$otb02_tray_port."',
	'".$tube."', '".$core."', '".$dome1."', '".$dome1_port."', '".$dome2."', '".$dome2_port."', '".$dome3."', '".$dome3_port."', '".$dome4."', '".$dome4_port."', '".$mac_address."');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	$query_onu	= "SELECT * FROM `software`.`gx_master_onu` WHERE `userid_onu`='".$userid."' LIMIT 0,1;";
    $sql_onu	= mysql_query($query_onu, $conn);
    $row_onu	= mysql_num_rows($sql_onu);
	
	if($row_onu == "1")
	{
		$sql_update = "UPDATE `software`.`gx_master_onu` SET `mac_onu` = '".$mac_address."', `status_onu` = '1',
				`userupd_onu` = '".$loggedin["username"]."', `dateupd_onu` = NOW()
				WHERE `userid_onu` = '".$userid."';";
		//echo $sql_update_staff;
		mysql_query($sql_update, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	}
	else
	{
		$sql_insert = "INSERT INTO `software`.`gx_master_onu` (`id_onu`, `userid_onu`, `sn_onu`, `mac_onu`, `status_onu`,
		`dateadd_onu`, `dateupd_onu`, `useradd_onu`, `userupd_onu`, `level_onu`)
		VALUES (NULL, '".($userid)."', '', '".$mac_address."', '1', 
				NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
		//echo $sql_insert_staff;
		mysql_query($sql_insert, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	}
	
	if($user_cabang == "sbn")
	{
		$sql_mac = "UPDATE `db_sbn`.`tbCustomer` SET `cMacAdd` = '".$mac_address."',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `cUserID` = '".$userid."';";
		//echo $sql_update_staff;
		mysql_query($sql_mac, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_mac);
	}
	elseif($user_cabang == "gx")
	{
		$sql_mac = "UPDATE `software`.`tbCustomer` SET `cMacAdd` = '".$mac_address."',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `cUserID` = '".$userid."';";
		//echo $sql_update_staff;
		mysql_query($sql_mac, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_mac);
	}
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/detail_olt.php?id=".$id_olt."';
	</script>";
    
}
elseif(isset($_POST["update"]))
{
	$user_cabang		= isset($_POST['user_cabang']) ? mysql_real_escape_string(trim($_POST['user_cabang'])) : '';
    $id_olt_customer    = isset($_POST['id_olt_customer']) ? mysql_real_escape_string(trim($_POST['id_olt_customer'])) : '';
    $userid				= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$interface_uplink	= isset($_POST['interface_uplink']) ? mysql_real_escape_string(trim($_POST['interface_uplink'])) : '';
	$id_olt				= isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
    $mac_address		= isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
    $pon   				= isset($_POST['pon']) ? mysql_real_escape_string(trim($_POST['pon'])) : '';
    $id   				= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$spliter_tray_port	= isset($_POST['spliter_tray_port']) ? mysql_real_escape_string(trim($_POST['spliter_tray_port'])) : '';
	$otb01_tray_port	= isset($_POST['otb01_tray_port']) ? mysql_real_escape_string(trim($_POST['otb01_tray_port'])) : '';
	$otb02_tray_port   	= isset($_POST['otb02_tray_port']) ? mysql_real_escape_string(trim($_POST['otb02_tray_port'])) : '';
	$tube    			= isset($_POST['tube']) ? mysql_real_escape_string(trim($_POST['tube'])) : '';
	$core   			= isset($_POST['core']) ? mysql_real_escape_string(trim($_POST['core'])) : '';
	$dome1    			= isset($_POST['dome1']) ? mysql_real_escape_string(trim($_POST['dome1'])) : '';
	$dome1_port   		= isset($_POST['dome1_port']) ? mysql_real_escape_string(trim($_POST['dome1_port'])) : '';
	$dome2   			= isset($_POST['dome2']) ? mysql_real_escape_string(trim($_POST['dome2'])) : '';
	$dome2_port   		= isset($_POST['dome2_port']) ? mysql_real_escape_string(trim($_POST['dome2_port'])) : '';
	$dome3   			= isset($_POST['dome3']) ? mysql_real_escape_string(trim($_POST['dome3'])) : '';
	$dome3_port   		= isset($_POST['dome3_port']) ? mysql_real_escape_string(trim($_POST['dome3_port'])) : '';
	$dome4   			= isset($_POST['dome4']) ? mysql_real_escape_string(trim($_POST['dome4'])) : '';
	$dome4_port   		= isset($_POST['dome4_port']) ? mysql_real_escape_string(trim($_POST['dome4_port'])) : '';
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `software`.`gx_inet_olt_customer` SET `id_olt`='".$id_olt."', `pon`='".$pon."', `id`='".$id."', `interface_uplink`='".$interface_uplink."',
	`userid`='".$userid."', `spliter_tray_port`='".$spliter_tray_port."', `otb01_tray_port`='".$otb01_tray_port."', `otb02_tray_port`='".$otb02_tray_port."',
	`tube`='".$tube."', `core`='".$core."', `dome1`='".$dome1."', `dome1_port`='".$dome1_port."', `dome2`='".$dome2."',
	`mac_address`='".$mac_address."', `dome2_port`='".$dome2_port."', `dome3`='".$dome3."', `dome3_port`='".$dome3_port."', `dome4`='".$dome4."', `dome4_port`='".$dome4_port."'
	WHERE (`id_olt_customer`='".$id_olt_customer."');";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
	if($userid != "" AND $mac_address != "")
	{
		$query_onu	= "SELECT * FROM `software`.`gx_master_onu` WHERE `userid_onu`='".$userid."' LIMIT 0,1;";
		$sql_onu	= mysql_query($query_onu, $conn);
		$row_onu	= mysql_num_rows($sql_onu);
	
		if($row_onu == "1")
		{
			$sql_update = "UPDATE `software`.`gx_master_onu` SET `mac_onu` = '".$mac_address."', `status_onu` = '1',
					`userupd_onu` = '".$loggedin["username"]."', `dateupd_onu` = NOW()
					WHERE `userid_onu` = '".$userid."';";
			//echo $sql_update_staff;
			mysql_query($sql_update, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
		}
		else
		{
			$sql_insert = "INSERT INTO `software`.`gx_master_onu` (`id_onu`, `userid_onu`, `sn_onu`, `mac_onu`, `status_onu`,
			`dateadd_onu`, `dateupd_onu`, `useradd_onu`, `userupd_onu`, `level_onu`)
			VALUES (NULL, '".($userid)."', '', '".$mac_address."', '1', 
					NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."','0');";
			//echo $sql_insert_staff;
			mysql_query($sql_insert, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
		}
		
		if($user_cabang == "sbn")
		{
			$sql_mac = "UPDATE `db_sbn`.`tbCustomer` SET `cMacAdd` = '".$mac_address."',
					`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
					WHERE `cUserID` = '".$userid."';";
			//echo $sql_update_staff;
			mysql_query($sql_mac, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_mac);
		}
		elseif($user_cabang == "gx")
		{
			$sql_mac = "UPDATE `software`.`tbCustomer` SET `cMacAdd` = '".$mac_address."',
					`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
					WHERE `cUserID` = '".$userid."';";
			//echo $sql_update_staff;
			mysql_query($sql_mac, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_mac);
		}
	}
	

	echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/detail_olt.php?id=".$id_olt."';
	</script>";
	
}



if(isset($_GET["id"]))
{
    $id_data     = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_data = mysql_query("SELECT * FROM `software`.`gx_inet_olt_customer` WHERE `id_olt_customer` = '".$id_data."' LIMIT 0,1;", $conn);
    $row_data = mysql_fetch_array($sql_data);
    //echo "SELECT * FROM `gx_inet_olt_customer` WHERE `id_olt_customer` = '".$id_data."' AND `level` = '0' LIMIT 0,1;";
}

    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form OLT Customer</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>CABANG</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <select class="form-control" name="user_cabang">
												<option value="gx">GlobalXtreme</option>
												<option value="sbn">SBN</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>
										
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Userid</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="userid" value="'.(isset($_GET["id"]) ? $row_data["userid"] : "").'">
												<input type="hidden" class="form-control" name="id_olt_customer" value="'.(isset($_GET["id"]) ? $row_data["id_olt_customer"] : "").'">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>OLT Server</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <select class="form-control" name="id_olt">';
												
$sql_olt = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` WHERE `level` = '0' ORDER BY `id_server` ASC", $conn);
while($row_olt = mysql_fetch_array($sql_olt)){
	$selected = isset($_GET["id"]) ? $row_data["id_olt"] : "";
	$selected = ($selected == $row_olt["id_server"]) ? ' selected=""' : "";
	
	$content .= '<option value="'.$row_olt["id_server"].'" '.$selected.'>'.$row_olt["nama_server"].'</option>';
	
}
						
						
						$content .= '
                                            </select>
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>Interface Uplink</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="interface_uplink" maxlength="6" value="'.(isset($_GET["id"]) ? $row_data["interface_uplink"] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>MAC Address</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="mac_address" maxlength="32" value="'.(isset($_GET["id"]) ? $row_data["mac_address"] : "").'">
												</div>
												
											</div>
                                        </div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>PON</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="pon" maxlength="6" value="'.(isset($_GET["id"]) ? $row_data["pon"] : "").'">
												</div>
												<div class="col-xs-3">
													<h5>ID</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="id" maxlength="4" value="'.(isset($_GET["id"]) ? $row_data["id"] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>Splitter Tray Port</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" class="form-control" name="spliter_tray_port" maxlength="20" value="'.(isset($_GET["id"]) ? $row_data["spliter_tray_port"] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>OTB01 Tray Port</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" class="form-control" name="otb01_tray_port" maxlength="20" value="'.(isset($_GET["id"]) ? $row_data["otb01_tray_port"] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>OTB02 Tray Port</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" class="form-control" name="otb02_tray_port" maxlength="20" value="'.(isset($_GET["id"]) ? $row_data["otb02_tray_port"] : "").'">
												</div>
												
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>TUBE</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="tube" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["tube"] : "").'">
												</div>
												<div class="col-xs-3">
													<h5>CORE</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="core" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["core"] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>DOME 1</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome1" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome1"] : "").'">
												</div>
												<div class="col-xs-3">
													<h5>PORT</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome1_port" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome1_port"] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>DOME 2</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome2" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome2"] : "").'">
												</div>
												<div class="col-xs-3">
													<h5>PORT</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome2_port" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome2_port"] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>DOME 3</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome3" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome3"] : "").'">
												</div>
												<div class="col-xs-3">
													<h5>PORT</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome3_port" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome3_port"] : "").'">
												</div>
											</div>
                                        </div>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>DOME 4</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome4" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome4"] : "").'">
												</div>
												<div class="col-xs-3">
													<h5>PORT</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="dome4_port" maxlength="100" value="'.(isset($_GET["id"]) ? $row_data["dome4_port"] : "").'">
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

        </script>
    ';

    $title	= 'Form OLT Customer';
    $submenu	= "inet_olt_customer";
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