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
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form Server Switch");

$messages = '';


if(isset($_POST["save"]))
{
    $command    = isset($_POST['command']) ? mysql_real_escape_string(trim($_POST['command'])) : '';
    $desc_cmd   = isset($_POST['desc_cmd']) ? mysql_real_escape_string(trim($_POST['desc_cmd'])) : '';
    $nama_cmd   = isset($_POST['nama_cmd']) ? mysql_real_escape_string(trim($_POST['nama_cmd'])) : '';
    
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `gx_inet_command_switch` (`id_cmd`, `nama_cmd`, `command`, `desc_cmd`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$nama_cmd."', '".$command."', '".$desc_cmd."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_command_switch.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_cmd     = isset($_POST['id_cmd']) ? mysql_real_escape_string(trim($_POST['id_cmd'])) : '';
    $command    = isset($_POST['command']) ? mysql_real_escape_string(trim($_POST['command'])) : '';
    $desc_cmd   = isset($_POST['desc_cmd']) ? mysql_real_escape_string(trim($_POST['desc_cmd'])) : '';
    $nama_cmd   = isset($_POST['nama_cmd']) ? mysql_real_escape_string(trim($_POST['nama_cmd'])) : '';
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `gx_inet_command_switch` SET `command` = '".$command."', `desc_cmd` = '".$desc_cmd."',
                `nama_cmd` = '".$nama_cmd."', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_cmd` = '".$id_cmd."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_command_switch.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_cmd  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_command = mysql_query("SELECT * FROM `gx_inet_command_switch` WHERE `id_cmd` = '".$id_cmd."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_command = mysql_fetch_array($sql_command);
    
}

    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Command Switch</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Nama Command</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="nama_cmd" value="'.(isset($_GET["id"]) ? $row_command["nama_cmd"] : "").'">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Command</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="command" value="'.(isset($_GET["id"]) ? $row_command["command"] : "").'">
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_cmd" value="'.$row_command["id_cmd"].'">' : '').'
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="desc_cmd" value="'.(isset($_GET["id"]) ? $row_command["desc_cmd"] : "").'">
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

    $title	= 'Form Command Switch';
    $submenu	= "inet_command";
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