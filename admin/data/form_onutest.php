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
    $userid				= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$id_olt				= isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
	$interface_uplink	= isset($_POST['interface_uplink']) ? mysql_real_escape_string(trim($_POST['interface_uplink'])) : '';
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
    $sql_insert = "INSERT INTO `db_sbn`.`gx_inet_olt_customer` (`id_olt_customer`, `id_olt`, `interface_uplink`, `pon`, `id`, `userid`, `spliter_tray_port`,
	`otb01_tray_port`, `otb02_tray_port`, `tube`, `core`, `dome1`, `dome1_port`, `dome2`, `dome2_port`, `dome3`, `dome3_port`, `dome4`, `dome4_port`)
	VALUES (NULL, '".$id_olt."', '".$interface_uplink."', '".$pon."', '".$id."', '".$userid."', '".$spliter_tray_port."', '".$otb01_tray_port."', '".$otb02_tray_port."',
	'".$tube."', '".$core."', '".$dome1."', '".$dome1_port."', '".$dome2."', '".$dome2_port."', '".$dome3."', '".$dome3_port."', '".$dome4."', '".$dome4_port."');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_olt_customer.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_olt_customer    = isset($_POST['id_olt_customer']) ? mysql_real_escape_string(trim($_POST['id_olt_customer'])) : '';
    $userid				= isset($_POST['userid']) ? mysql_real_escape_string(trim($_POST['userid'])) : '';
	$interface_uplink	= isset($_POST['interface_uplink']) ? mysql_real_escape_string(trim($_POST['interface_uplink'])) : '';
	$id_olt				= isset($_POST['id_olt']) ? mysql_real_escape_string(trim($_POST['id_olt'])) : '';
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
    $sql_update = "UPDATE `db_sbn`.`gx_inet_olt_customer` SET `id_olt`='".$id_olt."', `pon`='".$pon."', `id`='".$id."', `interface_uplink`='".$interface_uplink."',
	`userid`='".$userid."', `spliter_tray_port`='".$spliter_tray_port."', `otb01_tray_port`='".$otb01_tray_port."', `otb02_tray_port`='".$otb02_tray_port."',
	`tube`='".$tube."', `core`='".$core."', `dome1`='".$dome1."', `dome1_port`='".$dome1_port."', `dome2`='".$dome2."',
	`dome2_port`='".$dome2_port."', `dome3`='".$dome3."', `dome3_port`='".$dome3_port."', `dome4`='".$dome4."', `dome4_port`='".$dome4_port."'
	WHERE (`id_olt_customer`='".$id_olt_customer."');";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_olt_customer.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_data     = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_data = mysql_query("SELECT * FROM `gx_timpasang` WHERE `id_timpasang` = '".$id_data."' LIMIT 0,1;", $conn);
    $row_data = mysql_fetch_array($sql_data);
    //echo "SELECT * FROM `gx_inet_olt_customer` WHERE `id_olt_customer` = '".$id_data."' AND `level` = '0' LIMIT 0,1;";
}

    $content =' <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Tim Pasang</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="" name="form_pasang">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Nama Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="nama_timpasang" value="'.(isset($_GET["id"]) ? $row_data["nama_timpasang"] : "").'">
												<input type="hidden" class="form-control" name="id_timpasang" value="'.(isset($_GET["id"]) ? $row_data["id_timpasang"] : "").'">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Leader Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control"  required="" name="idpegawai_timpasang" id="idpegawai_timpasang"
												placeholder="Kode Pegawai" value="'.(isset($_GET['id']) ? $row_data["idpegawai_timpasang"] : '').'"
												onclick="return valideopenerform(\'data_pegawai.php?r=form_pasang&f=data_pegawai\',\'data_pegawai\');">
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <h5>Leader Tim Pasang</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly class="form-control" name="namapegawai_timpasang" value="'.(isset($_GET["id"]) ? $row_data["namapegawai_timpasang"] : "").'">
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

    $title	= 'Form Tim Pasang';
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