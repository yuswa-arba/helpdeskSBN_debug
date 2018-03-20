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
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form Server RAS");

$messages = '';

/*
if(isset($_POST["save"]))
{
    $nama_server    = isset($_POST['nama_server']) ? mysql_real_escape_string(trim($_POST['nama_server'])) : '';
    $desc_server    = isset($_POST['desc_server']) ? mysql_real_escape_string(trim($_POST['desc_server'])) : '';
    $ip_address	    = isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
	$username	    = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
	$password	    = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $group	    = isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$version_server = isset($_POST['version_server']) ? mysql_real_escape_string(trim($_POST['version_server'])) : '';
	$downlink_port	    = isset($_POST['downlink_port']) ? mysql_real_escape_string(trim($_POST['downlink_port'])) : '';
	$uplink_port	    = isset($_POST['uplink_port']) ? mysql_real_escape_string(trim($_POST['uplink_port'])) : '';
        
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `gx_inet_listswitch` (`id_server`, `nama_server`, `desc_server`, `ip_address`,
					`version_server`, `username`, `password`, `group_server`,
					`uplink_port`, `downlink_port`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$nama_server."', '".$desc_server."', '".$ip_address."',
					'".$version_server."', '".$username."', '".$password."', '".$group."',
					'".$uplink_port."', '".$downlink_port."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_server_switch.php';
	</script>";
    
}else
*/if(isset($_POST["update"]))
{
    $id_port	    = isset($_POST['id_port']) ? mysql_real_escape_string(trim($_POST['id_port'])) : '';
    $idswitch_port  = isset($_POST['idswitch_port']) ? mysql_real_escape_string(trim($_POST['idswitch_port'])) : '';
    $idesx_port     = isset($_POST['idesx_port']) ? mysql_real_escape_string(trim($_POST['idesx_port'])) : '';
    $port_switch    = isset($_POST['port_switch']) ? mysql_real_escape_string(trim($_POST['port_switch'])) : '';
    $downlink_port	    = isset($_POST['downlink_port']) ? mysql_real_escape_string(trim($_POST['downlink_port'])) : '';
	$uplink_port	    = isset($_POST['uplink_port']) ? mysql_real_escape_string(trim($_POST['uplink_port'])) : '';
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `db_sbn`.`gx_esx_port` SET `idswitch_port`='".$idswitch_port."',
	`idesx_port`='".$idesx_port."', `downlink_port`='".$downlink_port."'
	WHERE (`id_port`='".$id_port."');";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_server_switch.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_server  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_server = mysql_query("SELECT * FROM `v_esx_port` WHERE `id_port` = '".$id_server."' LIMIT 0,1;", $conn);
    $row_server = mysql_fetch_array($sql_server);
    
}

    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form ESX Server</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_port" value="'.$row_server["id_port"].'">' : '').'
                                            
										<div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Switch Server</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <select name="idswitch_port" class="form-control">';
												
												$sql_listgroup = mysql_query("SELECT * FROM `gx_inet_listswitch` where `level`= '0';", $conn);
												while($row_listgroup = mysql_fetch_array($sql_listgroup))
												{
													$content .='<option value="'.$row_listgroup["id_server"].'" '.((isset($_GET["id"]) AND ($row_listgroup["id_server"] == $row_server["id_switch"])) ? 'selected=""': "").'>'.$row_listgroup["nama_server"].'</option>';
												}
												
$content .='</select>
											</div>
                                        </div>
                                        </div>
										
										<div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>ESX Server</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <select name="idesx_port" class="form-control">';
												
												$sql_listgroup = mysql_query("SELECT * FROM `gx_inet_esx` where `level`= '0';", $conn);
												while($row_listgroup = mysql_fetch_array($sql_listgroup))
												{
													$content .='<option value="'.$row_listgroup["id_server"].'" '.((isset($_GET["id"]) AND ($row_listgroup["id_server"] == $row_server["id_esx"])) ? 'selected=""': "").'>'.$row_listgroup["nama_server"].'</option>';
												}
												
$content .='</select>
											</div>
                                        </div>
                                        </div>
										
                                        <div class="form-group" hidden>
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Uplink</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="uplink_port" value="">
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Downlink</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="downlink_port" value="'.(isset($_GET["id"]) ? ($row_server["downlink_port"]) : "").'">
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

    $title	= 'Form ESX Server';
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