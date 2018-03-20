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
    $ipaddress_ipvm	= isset($_POST['ipaddress_ipvm']) ? mysql_real_escape_string(trim($_POST['ipaddress_ipvm'])) : '';
	$username_ipvm	= isset($_POST['username_ipvm']) ? mysql_real_escape_string(trim($_POST['username_ipvm'])) : '';
	$password_ipvm	= isset($_POST['password_ipvm']) ? mysql_real_escape_string(trim($_POST['password_ipvm'])) : '';
	$interface_ipvm	= isset($_POST['interface_ipvm']) ? mysql_real_escape_string(trim($_POST['interface_ipvm'])) : '';
	$subnet_ipvm	= isset($_POST['subnet_ipvm']) ? mysql_real_escape_string(trim($_POST['subnet_ipvm'])) : '';
    
	
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `gx_inet_ipvm` SET `ipaddress_ipvm` = '".$ipaddress_ipvm."', `username_ipvm` = '".$username_ipvm."',
				`password_ipvm` = '".$password_ipvm."', `interface_ipvm` = '".$interface_ipvm."',  `subnet_ipvm` = '".$subnet_ipvm."'
                WHERE `id_ipvm` = '1';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/form_ipvm.php';
	</script>";
	
}
elseif(isset($_POST["save_power"]))
{
    $batas_atas_power	= isset($_POST['batas_atas_power']) ? mysql_real_escape_string(trim($_POST['batas_atas_power'])) : '';
	$batas_bawah_power	= isset($_POST['batas_bawah_power']) ? mysql_real_escape_string(trim($_POST['batas_bawah_power'])) : '';
	
	
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `gx_inet_ipvm` SET `batas_atas_power` = '".$batas_atas_power."', `batas_bawah_power` = '".$batas_bawah_power."'
                WHERE `id_ipvm` = '1';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/form_ipvm.php';
	</script>";
	
}



$sql_server = mysql_query("SELECT * FROM `gx_inet_ipvm` WHERE `id_ipvm` = '1' LIMIT 0,1;", $conn);
$row_server = mysql_fetch_array($sql_server);


    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-lg-6 col-md-9 col-xs-12">
                            
							<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_ipvm" data-toggle="tab">Setting IPVM</a></li>
                                    <li><a href="#tab_power" data-toggle="tab">Setting Power ONU</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_ipvm">
										<form role="form" method="POST" action="">
                                    
                                        
                                        <div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>IP Address</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="ipaddress_ipvm" data-inputmask="\'alias\': \'ip\'" data-mask="" value="'.$row_server["ipaddress_ipvm"].'">
                                            </div>
											<div class="col-xs-3">
                                                <input type="text" class="form-control" name="subnet_ipvm" value="'.$row_server["subnet_ipvm"].'">
                                            </div>
                                        </div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>Username</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" class="form-control" name="username_ipvm" maxlength="32" value="'.$row_server["username_ipvm"].'">
												</div>
											</div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>Password</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" class="form-control" name="password_ipvm" maxlength="32" value="'.$row_server["password_ipvm"].'">
												</div>
											</div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>Interface IP Address</h5>
												</div>
												<div class="col-xs-6">
													<input type="text" class="form-control" name="interface_ipvm" maxlength="32" value="'.$row_server["interface_ipvm"].'">
												</div>
											</div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													
												</div>
												<div class="col-xs-6">
													<button type="submit" name="save" class="btn btn-primary">Save</button>
												</div>
											</div>
                                        </div>
										

                                    
										</form>
									</div>
									
									<div class="tab-pane" id="tab_power">
										<form role="form" method="POST" action="">
                                    
                                        
                                        <div class="form-group">
										<div class="row">
                                            <div class="col-xs-3">
                                                <h5>Batas Atas</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="batas_atas_power" maxlength="10" value="'.$row_server["batas_atas_power"].'">
                                            </div>
											
                                        </div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													<h5>Batas Bawah</h5>
												</div>
												<div class="col-xs-3">
													<input type="text" class="form-control" name="batas_bawah_power" maxlength="10" value="'.$row_server["batas_bawah_power"].'">
												</div>
											</div>
                                        </div>
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-3">
													
												</div>
												<div class="col-xs-3">
													<button type="submit" name="save_power" class="btn btn-primary">Save</button>
												</div>
											</div>
                                        </div>
										
										</form>
									</div>
								</div>
							</div>
							

                                
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

    $title	= 'Setting Aktivasi';
    $submenu	= "inet_ipvm";
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