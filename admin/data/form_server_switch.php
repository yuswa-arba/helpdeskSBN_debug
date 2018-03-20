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
    $nama_server    = isset($_POST['nama_server']) ? mysql_real_escape_string(trim($_POST['nama_server'])) : '';
    $desc_server    = isset($_POST['desc_server']) ? mysql_real_escape_string(trim($_POST['desc_server'])) : '';
    $ip_address	    = isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
	$username	    = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
	$password	    = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
	$idparent_server	    = isset($_POST['idparent_server']) ? mysql_real_escape_string(trim($_POST['idparent_server'])) : '';
    $group	    	= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$version_server = isset($_POST['version_server']) ? mysql_real_escape_string(trim($_POST['version_server'])) : '';
    
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `software`.`gx_inet_listswitch` (`id_server`, `nama_server`, `desc_server`, `ip_address`,
					`version_server`, `username`, `password`, `group_server`, `idparent_server`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$nama_server."', '".$desc_server."', '".$ip_address."',
					'".$version_server."', '".$username."', '".$password."', '".$group."', '".$idparent_server."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
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
    $id_server      = isset($_POST['id_server']) ? mysql_real_escape_string(trim($_POST['id_server'])) : '';
    $nama_server    = isset($_POST['nama_server']) ? mysql_real_escape_string(trim($_POST['nama_server'])) : '';
    $desc_server    = isset($_POST['desc_server']) ? mysql_real_escape_string(trim($_POST['desc_server'])) : '';
    $ip_address	    = isset($_POST['ip_address']) ? mysql_real_escape_string(trim($_POST['ip_address'])) : '';
    $username	    = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
	$password	    = isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
	$idparent_server	    = isset($_POST['idparent_server']) ? mysql_real_escape_string(trim($_POST['idparent_server'])) : '';
    $group	    	= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$version_server = isset($_POST['version_server']) ? mysql_real_escape_string(trim($_POST['version_server'])) : '';
    
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `software`.`gx_inet_listswitch` SET `nama_server` = '".$nama_server."', `desc_server` = '".$desc_server."',
                `ip_address` = '".$ip_address."', `version_server` = '".$version_server."',
				`username` = '".$username."', `password` = '".$password."', `group_server` = '".$group."',
				`idparent_server` = '".$idparent_server."',
                `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_server` = '".$id_server."';";
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
    $sql_server = mysql_query("SELECT * FROM `software`.`gx_inet_listswitch` WHERE `id_server` = '".$id_server."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_server = mysql_fetch_array($sql_server);
    
}

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
                                                <h5>Switch Parent</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <select name="idparent_server" class="form-control">
													<option value="" selected="">No Group</option>';
												
												$sql_listgroup = mysql_query("SELECT * FROM `gx_inet_listswitch` where `idparent_server`='' AND `level` = '0';", $conn);
												while($row_listgroup = mysql_fetch_array($sql_listgroup))
												{
													$content .='<option value="'.$row_listgroup["id_server"].'" '.((isset($_GET["id"]) AND ($row_listgroup["id_server"] == $row_server["idparent_server"])) ? 'selected=""': "").'>'.$row_listgroup["nama_server"].'</option>';
												}
												
$content .='</select>
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
												
												$sql_listgroup = mysql_query("SELECT * FROM `gx_inet_listgroup`", $conn);
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
                                            <div class="col-xs-5">
                                                <h5>Username</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" maxlength="32" name="username" value="'.(isset($_GET["id"]) ? $row_server["username"] : "").'">
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Password</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" maxlength="32" name="password" value="'.(isset($_GET["id"]) ? $row_server["password"] : "").'">
                                            </div>
                                        </div>
                                    </div>
									
					<div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="desc_server" value="'.(isset($_GET["id"]) ? $row_server["desc_server"] : "").'">
                                            </div>
                                        </div>
                                        </div>
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Versi Mikrotik</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="version_server" value="'.(isset($_GET["id"]) ? $row_server["version_server"] : "").'">
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