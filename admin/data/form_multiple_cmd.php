<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu Form Multiple Command");
    
if(isset($_POST["save"]))
{
    $nama_cmd   = isset($_POST['nama_cmd']) ? mysql_real_escape_string(trim($_POST['nama_cmd'])) : '';
    $type_cmd   = isset($_POST['type_cmd']) ? mysql_real_escape_string(trim($_POST['type_cmd'])) : '';
    $desc_cmd   = isset($_POST['desc_cmd']) ? mysql_real_escape_string(trim($_POST['desc_cmd'])) : '';
    
    //insert into gx_inet_multiple_cmd
    $sql_insert = "INSERT INTO `gx_inet_multiple_cmd` (`id_mcmd`, `nama_cmd`, `desc_cmd`, `type_cmd`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$nama_cmd."', '".$desc_cmd."', '".$type_cmd."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    //select last data
    $sql_lastdata = "SELECT `id_mcmd` FROM `gx_inet_multiple_cmd`
                                                  WHERE `nama_cmd` = '".$nama_cmd."'
                                                  AND `desc_cmd` = '".$desc_cmd."'
                                                  AND `type_cmd` = '".$type_cmd."'
                                                  LIMIT 0,1;";
    $row_lastdata = mysql_fetch_array(mysql_query($sql_lastdata, $conn));
    
    $command = array();
    if($type_cmd == "ras")
    {
        $command = isset($_POST["cmd_ras"]) ? $_POST["cmd_ras"] : $command;
        
    }elseif($type_cmd == "olt")
    {
        $command = isset($_POST["cmd_olt"]) ? $_POST["cmd_olt"] : $command;
        
    }elseif($type_cmd == "switch")
    {
        $command = isset($_POST["cmd_switch"]) ? $_POST["cmd_switch"] : $command;
        
    }
    
        foreach($command as $key => $value)
        {
            //insert into gx_inet_multiple_cmd_detail
            $sql_insert_detail = "INSERT INTO `gx_inet_multiple_cmd_detail` (`id_mdcmd`, `id_mcmd`, `id_cmd`,
                            `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                            VALUES (NULL, '".$row_lastdata["id_mcmd"]."', '".$value."',
                            '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
            //echo $sql_insert_detail;
            mysql_query($sql_insert_detail, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_detail);
        }
    
    
    
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_multiple_cmd.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_mcmd     = isset($_POST['id_mcmd']) ? mysql_real_escape_string(trim($_POST['id_mcmd'])) : '';
    $nama_cmd   = isset($_POST['nama_cmd']) ? mysql_real_escape_string(trim($_POST['nama_cmd'])) : '';
    $type_cmd   = isset($_POST['type_cmd']) ? mysql_real_escape_string(trim($_POST['type_cmd'])) : '';
    $desc_cmd   = isset($_POST['desc_cmd']) ? mysql_real_escape_string(trim($_POST['desc_cmd'])) : '';
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `gx_inet_multiple_cmd` SET `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW(),
                    `level` = '1'
                    WHERE `id_mcmd` = '".$id_mcmd."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    //insert into gx_inet_multiple_cmd
    $sql_insert = "INSERT INTO `gx_inet_multiple_cmd` (`id_mcmd`, `nama_cmd`, `desc_cmd`, `type_cmd`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$nama_cmd."', '".$desc_cmd."', '".$type_cmd."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    //select last data
    $sql_lastdata = "SELECT `id_mcmd` FROM `gx_inet_multiple_cmd`
                                                  WHERE `nama_cmd` = '".$nama_cmd."'
                                                  AND `desc_cmd` = '".$desc_cmd."'
                                                  AND `type_cmd` = '".$type_cmd."'
                                                  LIMIT 0,1;";
    $row_lastdata = mysql_fetch_array(mysql_query($sql_lastdata, $conn));
    
    $command = array();
    if($type_cmd == "ras")
    {
        $command = isset($_POST["cmd_ras"]) ? $_POST["cmd_ras"] : $command;
        
    }elseif($type_cmd == "olt")
    {
        $command = isset($_POST["cmd_olt"]) ? $_POST["cmd_olt"] : $command;
        
    }elseif($type_cmd == "switch")
    {
        $command = isset($_POST["cmd_switch"]) ? $_POST["cmd_switch"] : $command;
        
    }
    
        foreach($command as $key => $value)
        {
            //insert into gx_inet_multiple_cmd_detail
            $sql_insert_detail = "INSERT INTO `gx_inet_multiple_cmd_detail` (`id_mdcmd`, `id_mcmd`, `id_cmd`,
                            `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                            VALUES (NULL, '".$row_lastdata["id_mcmd"]."', '".$value."',
                            '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
            //echo $sql_insert_detail;
            mysql_query($sql_insert_detail, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_detail);
        }
        
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_multiple_cmd.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_mcmd  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    
    $sql_multiple   = mysql_query("SELECT * FROM `gx_inet_multiple_cmd` WHERE `id_mcmd` = '".$id_mcmd."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_multiple   = mysql_fetch_array($sql_multiple);
    
    $messages ='';
    
}
$type           = (isset($_GET['id']) OR isset($_GET['type'])) ? $row_multiple["type_cmd"] : "";
$messages ='';
    $content ='<section class="content-header">
                    <h1>
                        Form Multiple Command
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Command</h3>
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
                                                <input type="text" class="form-control" name="nama_cmd" value="'.(isset($_GET["id"]) ? $row_multiple["nama_cmd"] : "").'">
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_mcmd" value="'.$row_multiple["id_mcmd"].'">' : '').'
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-5">
						<h5>Tipe Server</h5>
					    </div>
					    <div class="col-xs-7">
						<input id="ras" type="radio" name="type_cmd" value="ras" '.((isset($_GET["id"]) AND ($row_multiple["type_cmd"] == "ras")) ? 'checked=""' : "").'/> RAS
						<input id="olt" type="radio" name="type_cmd" value="olt" '.((isset($_GET["id"]) AND ($row_multiple["type_cmd"] == "olt")) ? 'checked=""' : "").'/> OLT
						<input id="switch" type="radio" name="type_cmd" value="switch" '.((isset($_GET["id"]) AND ($row_multiple["type_cmd"] == "switch")) ? 'checked=""' : "").'/> Switch
					    </div>
                                        </div>
					</div>
                                        <!--<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Type</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <select class="form-control" name="id_type">';
					    
$sql_typecmd = mysql_query("SELECT * FROM `gx_inet_type_cmd` WHERE `level` = '0';", $conn);
while($row_typecmd = mysql_fetch_array($sql_typecmd)){
    $selected = isset($_GET["id"]) ? $type : "";
    $selected = ($selected == $row_typecmd["id_type_cmd"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_typecmd["id_type_cmd"].'" '.$selected.'>'.$row_typecmd["type_cmd"].'</option>';
    
}
						
						
						$content .= '
                                            </select>
                                            </div>
                                        </div>
                                        </div>-->
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi command</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <textarea class="form-control" name="desc_cmd" style="resize:none;">'.(isset($_GET["id"]) ? $row_multiple["desc_cmd"] : "").'</textarea>
                                            </div>
                                        </div>
                                        </div>
                                        
                                    <div id="form_ras" '.(($type != "ras") ? 'style="display:none;"' : "").'>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h5>Command RAS</h5>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select multiple="multiple" id="cmd_ras" name="cmd_ras[]" style="width:100%;">
                                                
                                                ';

$sql_ras_all = mysql_query("SELECT * FROM `gx_inet_command` WHERE `level` = '0';", $conn);
while($row_ras_all = mysql_fetch_array($sql_ras_all)){
    
    if((isset($_GET["id"]) AND ($type == "ras")))
    {
        $sql_ras_selected   = mysql_query("SELECT `gx_inet_multiple_cmd_detail`.`id_cmd` FROM `gx_inet_multiple_cmd_detail`, `gx_inet_command`
                                        WHERE `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command`.`id_cmd`
                                        AND `gx_inet_multiple_cmd_detail`.`id_mcmd` = '".$row_multiple["id_mcmd"]."'
                                        AND `gx_inet_multiple_cmd_detail`.`id_cmd` = '".$row_ras_all["id_cmd"]."'
                                        ", $conn);
        $row_ras_selected   = mysql_fetch_array($sql_ras_selected);
    }

    $selected_ras = (isset($_GET["id"]) AND ($type == "ras")) ? $row_ras_selected["id_cmd"] : "";
    $selected_ras = ($selected_ras == $row_ras_all["id_cmd"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_ras_all["id_cmd"].'" '.$selected_ras.'>'.$row_ras_all["nama_cmd"].'</option>';
    
}
						
						
						$content .= '</select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="form_olt" '.(($type != "olt") ? 'style="display:none;"' : "").'>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h5>Command OLT</h5>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select multiple="multiple" id="cmd_olt" name="cmd_olt[]" style="width:100%;">
                                            ';
					    

$sql_olt_all = mysql_query("SELECT * FROM `gx_inet_command_olt` WHERE `level` = '0';", $conn);
while($row_olt_all = mysql_fetch_array($sql_olt_all)){
    if((isset($_GET["id"]) AND ($type == "olt")))
    {
        $sql_olt_selected   = mysql_query("SELECT `gx_inet_multiple_cmd_detail`.`id_cmd` FROM `gx_inet_multiple_cmd_detail`, `gx_inet_command_olt`
                                        WHERE `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command_olt`.`id_cmd`
                                        AND `gx_inet_multiple_cmd_detail`.`id_mcmd` = '".$row_multiple["id_mcmd"]."'
                                        AND `gx_inet_multiple_cmd_detail`.`id_cmd` = '".$row_olt_all["id_cmd"]."'
                                        ", $conn);
        $row_olt_selected   = mysql_fetch_array($sql_olt_selected);
    }
    
    $selected_olt = (isset($_GET["id"]) AND ($type == "olt")) ? $row_olt_selected["id_cmd"] : "";
    $selected_olt = ($selected_ras == $row_olt_all["id_cmd"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_olt_all["id_cmd"].'" '.$selected_olt.'>'.$row_olt_all["nama_cmd"].'</option>';
    
}
						
						
						$content .= '</select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="form_switch" '.(($type != "switch") ? 'style="display:none;"' : "").'>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h5>Command Switch</h5>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select multiple="multiple" id="cmd_switch" name="cmd_switch[]" style="width:100%;">
                                                
                                                ';
					    

$sql_switch_all = mysql_query("SELECT * FROM `gx_inet_command_switch` WHERE `level` = '0';", $conn);
while($row_switch_all = mysql_fetch_array($sql_switch_all)){
    if((isset($_GET["id"]) AND ($type == "switch")))
    {
        $sql_switch_selected   = mysql_query("SELECT `gx_inet_multiple_cmd_detail`.`id_cmd` FROM `gx_inet_multiple_cmd_detail`, `gx_inet_command_olt`
                                        WHERE `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command_olt`.`id_cmd`
                                        AND `gx_inet_multiple_cmd_detail`.`id_mcmd` = '".$row_multiple["id_mcmd"]."'
                                        AND `gx_inet_multiple_cmd_detail`.`id_cmd` = '".$row_switch_all["id_cmd"]."'
                                        ;", $conn);
        $row_switch_selected   = mysql_fetch_array($sql_switch_selected);
    }
    $selected_switch = (isset($_GET["id"]) AND ($type == "switch")) ? $row_olt_selected["id_cmd"] : "";
    $selected_switch = ($selected_switch == $row_switch_all["id_cmd"]) ? ' selected=""' : "";
    
    $content .= '<option value="'.$row_switch_all["id_cmd"].'" '.$selected_switch.'>'.$row_switch_all["nama_cmd"].'</option>';
    
}
						
						
				    $content .= '</select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                
                                
                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '<link href="'.URL.'css/multiselect/multiselect.css" media="screen" rel="stylesheet" type="text/css">
<script src="'.URL.'js/multiselect/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(\'#cmd_ras\').multiSelect({
        selectableHeader: "<div class=\'custom-header\'>List Data</div>",
        selectionHeader: "<div class=\'custom-header\'>Enable</div>",
        keepOrder: true
    });
    $(\'#cmd_switch\').multiSelect({
        selectableHeader: "<div class=\'custom-header\'>List Data</div>",
        selectionHeader: "<div class=\'custom-header\'>Enable</div>",
        keepOrder: true
    });
    $(\'#cmd_olt\').multiSelect({
        selectableHeader: "<div class=\'custom-header\'>List Data</div>",
        selectionHeader: "<div class=\'custom-header\'>Enable</div>",
        keepOrder: true
    });
    
});
</script>
<script type="text/javascript">
$(document).ready(function () {
    $(\'#ras\').on(\'ifChecked\', function(event){
        $(\'#form_olt\').hide(\'fast\');
        $(\'#form_switch\').hide(\'fast\');
        $(\'#form_ras\').show(\'fast\');
    });
    $(\'#olt\').on(\'ifChecked\', function(event){
        $(\'#form_switch\').hide(\'fast\');
        $(\'#form_ras\').hide(\'fast\');
        $(\'#form_olt\').show(\'fast\');
    });
    $(\'#switch\').on(\'ifChecked\', function(event){
        $(\'#form_ras\').hide(\'fast\');
        $(\'#form_olt\').hide(\'fast\');
        $(\'#form_switch\').show(\'fast\');
    });
});
</script>
';

    $title	= 'Form Multiple command';
    $submenu	= "inet_multiple";
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