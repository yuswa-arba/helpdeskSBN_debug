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
    $userid_vlan    = isset($_POST['userid_vlan']) ? mysql_real_escape_string(trim($_POST['userid_vlan'])) : '';
    $vlan    		= isset($_POST['vlan']) ? mysql_real_escape_string(trim($_POST['vlan'])) : '';
	$mac_address	= isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
	$flag_vlan 		= isset($_POST['flag_vlan']) ? mysql_real_escape_string(trim($_POST['flag_vlan'])) : '';
	$id_esx 		= isset($_POST['id_esx']) ? mysql_real_escape_string(trim($_POST['id_esx'])) : '';
	
   
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `db_sbn`.`gx_data_vlan` (`id_vlan`, `userid_vlan`, `vlan`, `mac_address`, `flag_vlan`, `id_esx`,
	`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$userid_vlan."', '".$vlan."', '".$mac_address."', '".$flag_vlan."', '".$id_esx."',
            '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
   //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_vlan.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_vlan      	= isset($_POST['id_vlan']) ? mysql_real_escape_string(trim($_POST['id_vlan'])) : '';
    $userid_vlan    = isset($_POST['userid_vlan']) ? mysql_real_escape_string(trim($_POST['userid_vlan'])) : '';
    $vlan    		= isset($_POST['vlan']) ? mysql_real_escape_string(trim($_POST['vlan'])) : '';
	$mac_address	= isset($_POST['mac_address']) ? mysql_real_escape_string(trim($_POST['mac_address'])) : '';
	$flag_vlan 		= isset($_POST['flag_vlan']) ? mysql_real_escape_string(trim($_POST['flag_vlan'])) : '';
	$id_esx 		= isset($_POST['id_esx']) ? mysql_real_escape_string(trim($_POST['id_esx'])) : '';
	
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `db_sbn`.`gx_data_vlan` SET `userid_vlan`='".$userid_vlan."', `vlan`='".$vlan."',
				`mac_address`='".$mac_address."',  `flag_vlan`='".$flag_vlan."', `id_esx`='".$id_esx."',
                `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_vlan` = '".$id_vlan."';";
				
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_vlan.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_server  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_server = mysql_query("SELECT * FROM `gx_data_vlan` WHERE `id_vlan` = '".$id_server."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_server = mysql_fetch_array($sql_server);
    
}


    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Data VLAN</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_vlan" value="'.$row_server["id_vlan"].'">' : '').'
                                            
										<div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>User ID</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" maxlength="32" name="userid_vlan" value="'.(isset($_GET["id"]) ? $row_server["userid_vlan"] : "").'">
											</div>
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>VLAN</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="vlan" maxlength="10" value="'.(isset($_GET["id"]) ? $row_server["vlan"] : "").'">
											</div>
                                        </div>
                                        </div>
                                        <div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>Mac Address</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="mac_address" maxlength="32" value="'.(isset($_GET["id"]) ? ($row_server["mac_address"]) : "").'">
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>ESX Server</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <select name="id_esx" class="form-control">';
												 
												$sql_listgroup = mysql_query("SELECT * FROM `software`.`gx_inet_esx`;", $conn);
												while($row_listgroup = mysql_fetch_array($sql_listgroup))
												{
													$content .='<option value="'.$row_listgroup["id_server"].'" '.((isset($_GET["id"]) AND ($row_listgroup["id_server"] == $row_server["id_esx"])) ? 'selected=""': "").'>'.$row_listgroup["nama_server"].'</option>';
												}
												
$content .='
												</select>
											</div>
                                        </div>
                                        </div>
										
										<div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>Status</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control"name="flag_vlan">
													<option value="aktif" '.((isset($_GET['id']) AND ($row_server['flag_vlan'] == "aktif")) ? 'selected=""' : "").'>Aktif</option>
													<option value="nonaktif" '.((isset($_GET['id']) AND ($row_server['flag_vlan'] == "nonaktif")) ? 'selected=""' : "").'>Inactive</option>
													<option value="blokir" '.((isset($_GET['id']) AND ($row_server['flag_vlan'] == "blokir")) ? 'selected=""' : "").'>Blokir</option>
												</select>
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

    $title	= 'Form Data VLAN';
    $submenu	= "inet_data_vlan";
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