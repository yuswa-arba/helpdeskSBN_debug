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


if(isset($_POST["save"]))
{
    
	$idswitch_port  = isset($_POST['idswitch_port']) ? mysql_real_escape_string(trim($_POST['idswitch_port'])) : '';
    $idolt_port     = isset($_POST['idolt_port']) ? mysql_real_escape_string(trim($_POST['idolt_port'])) : '';
    $type_server    = isset($_POST['type_server']) ? mysql_real_escape_string(trim($_POST['type_server'])) : '';
	
	$idolt_port     = isset($_POST['idolt_port']) ? mysql_real_escape_string(trim($_POST['idolt_port'])) : '';
	$idesx_port     = isset($_POST['idesx_port']) ? mysql_real_escape_string(trim($_POST['idesx_port'])) : '';
    $interface_port = isset($_POST['interface_port']) ? mysql_real_escape_string(trim($_POST['interface_port'])) : '';
	
	if($type_server == "olt")
	{
		$sql_server = "'".$idolt_port."', '0',";
	}
	elseif($type_server == "esx")
	{
		$sql_server = "'0', '".$idesx_port."',";
	}
	else
	{
		$sql_server = "'0', '0',";
	}
	
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `software`.`gx_switch_port` (`id_port`, `idswitch_port`, `idolt_port`, `idesx_port`, `interface_port`, `level`)
	VALUES (NULL, '".$idswitch_port."', $sql_server  '".$interface_port."', '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_server_switch.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_port	    = isset($_POST['id_port']) ? mysql_real_escape_string(trim($_POST['id_port'])) : '';
    $idswitch_port  = isset($_POST['idswitch_port']) ? mysql_real_escape_string(trim($_POST['idswitch_port'])) : '';
    
	$type_server    = isset($_POST['type_server']) ? mysql_real_escape_string(trim($_POST['type_server'])) : '';
	
	$idolt_port     = isset($_POST['idolt_port']) ? mysql_real_escape_string(trim($_POST['idolt_port'])) : '';
	$idesx_port     = isset($_POST['idesx_port']) ? mysql_real_escape_string(trim($_POST['idesx_port'])) : '';
    $interface_port = isset($_POST['interface_port']) ? mysql_real_escape_string(trim($_POST['interface_port'])) : '';
	
	if($type_server == "olt")
	{
		$sql_server = "`idolt_port`='".$idolt_port."', `idesx_port`='0',";
	}
	elseif($type_server == "esx")
	{
		$sql_server = "`idolt_port`='0', `idesx_port`='".$idesx_port."',";
	}
	else
	{
		$sql_server = "`idolt_port`='0', `idesx_port`='0',";
	}
	
	
    //update gx_inet_grouptime
    $sql_update = "UPDATE `software`.`gx_switch_port` SET `idswitch_port`='".$idswitch_port."',
	  `interface_port`='".$interface_port."', $sql_server
	`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
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
    $sql_server = mysql_query("SELECT * FROM `software`.`v_switch_port` WHERE `id_port` = '".$id_server."' LIMIT 0,1;", $conn);
    $row_server = mysql_fetch_array($sql_server);
    
}


$id_olt = (isset($_GET["id"]) ? ($row_server["id_olt"]) : "");
$id_esx = (isset($_GET["id"]) ? ($row_server["id_esx"]) : "");

    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Switch Server</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_port" value="'.$row_server["id_port"].'">' : '').'
                                            
										<div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>Switch Server</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <select name="idswitch_port" class="form-control">';
												
												$sql_listgroup = mysql_query("SELECT * FROM `software`.`gx_inet_listswitch` where `level`= '0';", $conn);
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
											
                                            <div class="col-xs-6">

												<input type="checkbox" name="type_server" value="olt" class="minimal olt" '.($id_olt != NULL? 'checked=""' : "").'>
                                                <h5>OLT Server</h5>
                                                <select name="idolt_port" class="form-control olt_input" '.($id_olt != NULL ? '' : 'disabled=""').'>
												<option value="">-------</option>';
												
												$sql_listgroup = mysql_query("SELECT * FROM `software`.`gx_inet_listolt` where `level`= '0';", $conn);
												while($row_listgroup = mysql_fetch_array($sql_listgroup))
												{
													$content .='<option value="'.$row_listgroup["id_server"].'" '.((isset($_GET["id"]) AND ($row_listgroup["id_server"] == $row_server["id_olt"])) ? 'selected=""': "").'>'.$row_listgroup["nama_server"].'</option>';
												}
												
$content .='</select>
											</div>
											
											<div class="col-xs-6">

												<input type="checkbox" name="type_server" value="esx"  class="minimal esx" '.($id_esx != NULL ? 'checked=""' : "").'>
                                                <h5>ESX Server</h5>
                                                <select name="idesx_port" class="form-control esx_input" '.($id_esx != NULL ? '' : 'disabled=""').'>
												<option value="">-------</option>';
												
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
                                            <div class="col-xs-3">
                                                <h5>Uplink</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="uplink_port" value="">
                                            </div>
                                        </div>
                                        </div>
										<div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>Port Interface</h5>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="interface_port" value="'.(isset($_GET["id"]) ? ($row_server["interface_port"]) : "").'">
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
			
			$(\'.olt\').on(\'ifChecked\', function(event){
				$(\'.olt_input\').removeAttr(\'disabled\');
				$(\'.esx\').attr(\'disabled\',\'disabled\');
				
			});
			
			$(\'.olt\').on(\'ifUnchecked\', function(event){
				$(\'.olt_input\').attr(\'disabled\',\'disabled\');
				$(\'.esx\').removeAttr(\'disabled\');
			});
			
			$(\'.esx\').on(\'ifChecked\', function(event){
				$(\'.esx_input\').removeAttr(\'disabled\');
				$(\'.olt\').attr(\'disabled\',\'disabled\');
			});
			
			$(\'.esx\').on(\'ifUnchecked\', function(event){
				$(\'.esx_input\').attr(\'disabled\',\'disabled\');
				$(\'.olt\').removeAttr(\'disabled\');
			});

        </script>
    ';

    $title	= 'Form Switch Server';
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