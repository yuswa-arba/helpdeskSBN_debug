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
    $min_power	= isset($_POST['min_power']) ? mysql_real_escape_string(trim($_POST['min_power'])) : '';
	$max_power	= isset($_POST['max_power']) ? mysql_real_escape_string(trim($_POST['max_power'])) : '';
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `db_sbn`.`gx_setting_poweronu` SET `min_power`='".$min_power."',
	`max_power`='".$max_power."', `date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
	WHERE (`id_setting_power`='1');";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/setting_poweronu.php';
	</script>";
	
}


$sql_server = mysql_query("SELECT * FROM `gx_setting_poweronu` WHERE `id_setting_power` = '1' LIMIT 0,1;", $conn);
$row_server = mysql_fetch_array($sql_server);


    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Setting Power ONU</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        
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
										

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
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

    $title	= 'Form IP VM';
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