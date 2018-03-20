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
    $sql_update = "UPDATE `gx_inet_multiple_cmd` SET `nama_cmd` = '".$nama_cmd."', `desc_cmd` = '".$desc_cmd."',
                `type_cmd` = '".$type_cmd."', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_mcmd` = '".$id_mcmd."';";
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    //update level before
    //select last data
    $sql_updatedata = "SELECT `id_mdcmd` FROM `gx_inet_multiple_cmd_detail` WHERE `id_mcmd` = '".$id_mcmd."';";
    $query_updatedata = mysql_query($sql_lastdata, $conn);
    
    while($row_updatedata = mysql_fetch_array($query_updatedata))
    {
        $sql_update_detail = "UPDATE `gx_inet_multiple_cmd_detail` SET `level` = '1', `user_upd` = '".$loggedin["username"]."',
                    `date_upd` = NOW()
                    WHERE `id_mdcmd` = '".$row_updatedata["id_mdcmd"]."';";
        //echo $sql_update;
        mysql_query($sql_update_detail, $conn) or die (mysql_error());
        
        //log
        enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_detail);
    }
    
    //Insert new data detail
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
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
        }
        
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_multiple_cmd.php';
	</script>";
	
}


if(isset($_GET["id"]))
{
    $id_mcmd  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $type     = isset($_GET['type']) ? mysql_real_escape_string(strip_tags(trim($_GET['type']))) : 'ras';
    $sql_multiple = mysql_query("SELECT * FROM `gx_inet_multiple_cmd` WHERE `id_mcmd` = '".$id_mcmd."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_multiple = mysql_fetch_array($sql_multiple);
    
    $messages ='';
    
}
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
					    
$sql_typecmd = mysql_query("SELECT * FROM `gx_inet_type_cmd`;", $conn);
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
                                        
                                    <div id="form_ras" style="display:none;">
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
                                                <select multiple="multiple" id="cmd_ras" name="cmd_ras[]" style="width:100%;height:400px;">
                                                ';
					    
$sql_ras_all = mysql_query("SELECT * FROM `gx_inet_command`", $conn);
while($row_ras_all = mysql_fetch_array($sql_ras_all)){
    
    $content .= '<option value="'.$row_ras_all["id_cmd"].'">'.$row_ras_all["nama_cmd"].'</option>';
    
}
						
						
						$content .= '</select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="form_olt" style="display:none;">
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
                                                <table style="width:100%;">
                                                    <tr>
                                                        <td style="width:50%;">
                                                            <b>Enable</b><br/>
                                                           <select multiple="multiple" id="cmd_olt" name="cmd_olt[]" style="width:100%;height:400px;">';
					    
$sql_enable = mysql_query("SELECT `gx_inet_command`.* FROM `gx_inet_command`, `gx_inet_multiple_cmd`, `gx_inet_multiple_cmd_detail`
                           WHERE `gx_inet_multiple_cmd`.`id_mcmd` = `gx_inet_multiple_cmd_detail`.`id_mcmd`
                           AND `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command`.`id_cmd`
                           AND `gx_inet_multiple_cmd`.`id_mcmd` = '".(isset($_GET["id"]) ? $id_mcmd : "")."';", $conn);
while($row_enable = mysql_fetch_array($sql_enable)){
    
    $content .= '<option value="'.$row_typecmd["id_cmd"].'">'.$row_typecmd["command"].'</option>';
    
}
						
						
						$content .= '</select>
                                                    </td>
                                                    <td style="width:50px;text-align:center;vertical-align:middle;">
                                                        <input type="button" id="btnUpolt" value="Up"><br>
                                                        <input type="button" id="btnDownolt" value="Down"><br><br>
                                                        <input type="button" id="btnRightolt" value ="  >  "/>
                                                        <br/><input type="button" id="btnLeftolt" value ="  <  "/>
                                                        
                                                    </td>
                                                    <td style="width:50%;">
                                                        <b>Disable</b><br/>
                                                        <select multiple="multiple" id="cmd_olt_all" name="cmd_olt_all" style="width:100%;height:400px;">
                                                        <option value="2" selected>command1234</option>';
					    
$sql_olt_all = mysql_query("SELECT * FROM `gx_inet_command_olt`", $conn);
while($row_olt_all = mysql_fetch_array($sql_olt_all)){
    
    $content .= '<option value="'.$row_olt_all["id_cmd"].'">'.$row_olt_all["nama_cmd"].'</option>';
    
}
						
						
						$content .= '<option value="2" selected>command123</option></select>
                                                    </td>
                                                </tr>
                                                </table>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="form_switch" style="display:none;">
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
                                                <table style="width:100%;">
                                                    <tr>
                                                        <td style="width:50%;">
                                                            <b>Enable</b><br/>
                                                           <select multiple="multiple" id="cmd_switch" name="cmd_switch[]" style="width:100%;height:400px;">';
					    
$sql_enable = mysql_query("SELECT `gx_inet_command`.* FROM `gx_inet_command`, `gx_inet_multiple_cmd`, `gx_inet_multiple_cmd_detail`
                           WHERE `gx_inet_multiple_cmd`.`id_mcmd` = `gx_inet_multiple_cmd_detail`.`id_mcmd`
                           AND `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command`.`id_cmd`
                           AND `gx_inet_multiple_cmd`.`id_mcmd` = '".(isset($_GET["id"]) ? $id_mcmd : "")."';", $conn);
while($row_enable = mysql_fetch_array($sql_enable)){
    
    $content .= '<option value="'.$row_typecmd["id_cmd"].'">'.$row_typecmd["command"].'</option>';
    
}
						
						
						$content .= '</select>
                                                    </td>
                                                    <td style="width:50px;text-align:center;vertical-align:middle;">
                                                        <input type="button" id="btnUpswt" value="Up"><br>
                                                        <input type="button" id="btnDownswt" value="Down"><br><br>
                                                        <input type="button" id="btnRightswt" value ="  >  "/>
                                                        <br/><input type="button" id="btnLeftswt" value ="  <  "/>
                                                        
                                                    </td>
                                                    <td style="width:50%;">
                                                        <b>Disable</b><br/>
                                                        <select multiple="multiple" id="cmd_switch_all" name="cmd_switch_all" style="width:100%;height:400px;">';
					    
$sql_switch_all = mysql_query("SELECT * FROM `gx_inet_command_switch`", $conn);
while($row_switch_all = mysql_fetch_array($sql_switch_all)){
    
    $content .= '<option value="'.$row_switch_all["id_cmd"].'">'.$row_switch_all["nama_cmd"].'</option>';
    
}
						
						
						$content .= '</select>
                                                    </td>
                                                </tr>
                                                </table>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                
                                
                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';
/*
 *<table style="width:100%;">
                                                    <tr>
                                                        <td style="width:50%;">
                                                            <b>Enable</b><br/>
                                                           <select multiple="multiple" id="cmd_ras" name="cmd_ras[]" style="width:100%;height:400px;">';
					    
$sql_enable = mysql_query("SELECT `gx_inet_command`.* FROM `gx_inet_command`, `gx_inet_multiple_cmd`, `gx_inet_multiple_cmd_detail`
                           WHERE `gx_inet_multiple_cmd`.`id_mcmd` = `gx_inet_multiple_cmd_detail`.`id_mcmd`
                           AND `gx_inet_multiple_cmd_detail`.`id_cmd` = `gx_inet_command`.`id_cmd`
                           AND `gx_inet_multiple_cmd`.`id_mcmd` = '".(isset($_GET["id"]) ? $id_mcmd : "")."';", $conn);
while($row_enable = mysql_fetch_array($sql_enable)){
    
    $content .= '<option value="'.$row_typecmd["id_cmd"].'">'.$row_typecmd["command"].'</option>';
    
}
						
						
						$content .= '</select>
                                                    </td>
                                                    <td style="width:50px;text-align:center;vertical-align:middle;">
                                                        <input type="button" id="btnUpras" value="Up"><br>
                                                        <input type="button" id="btnDownras" value="Down"><br><br>
                                                        <input type="button" id="btnRightras" value ="  >  "/>
                                                        <br/><input type="button" id="btnLeftras" value ="  <  "/>
                                                        
                                                    </td>
                                                    <td style="width:50%;">
                                                        <b>Disable</b><br/>
                                                        <select multiple="multiple" id="cmd_ras_all" name="cmd_ras_all[]" style="width:100%;height:400px;">';
					    
$sql_ras_all = mysql_query("SELECT * FROM `gx_inet_command`", $conn);
while($row_ras_all = mysql_fetch_array($sql_ras_all)){
    
    $content .= '<option value="'.$row_ras_all["id_cmd"].'">'.$row_ras_all["nama_cmd"].'</option>';
    
}
						
						
						$content .= '</select>
                                                    </td>
                                                </tr>
                                                </table>*/
$plugins = '<link href="'.URL.'css/multiselect/multiselect.css" media="screen" rel="stylesheet" type="text/css">
<script src="'.URL.'js/multiselect/jquery.multi-select.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(\'#cmd_ras\').multiSelect({ keepOrder: true });
    $(\'#cmd_switch\').multiSelect({ keepOrder: true });
    $(\'#cmd_olt\').multiSelect({ keepOrder: true });
    
    //ras start
    $(\'#btnUpras\').click(function(){
        var $op = $(\'#cmd_ras option:selected\'),
            $this = $(this);
        if($op.length){
            ($this.val() == \'Up\') ? 
                $op.first().prev().before($op) : 
                $op.last().next().after($op);
        }
    });
    $(\'#btnDownras\').click(function(){
        var $op = $(\'#cmd_ras option:selected\'),
            $this = $(this);
        if($op.length){
            ($this.val() == \'Down\') ? 
                $op.last().next().after($op) : 
                $op.first().prev().before($op);
        }
    });
    
    $(\'#btnRightras\').click(function(e) {
        var selectedOpts = $(\'#cmd_ras option:selected\');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $(\'#cmd_ras_all\').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $(\'#btnLeftras\').click(function(e) {
        var selectedOpts = $(\'#cmd_ras_all option:selected\');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $(\'#cmd_ras\').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    //ras end
    
    //olt start
    $(\'#btnUpolt\').click(function(){
        var $op = $(\'#cmd_olt option:selected\'),
            $this = $(this);
        if($op.length){
            ($this.val() == \'Up\') ? 
                $op.first().prev().before($op) : 
                $op.last().next().after($op);
        }
    });
    $(\'#btnDownolt\').click(function(){
        var $op = $(\'#cmd_olt option:selected\'),
            $this = $(this);
        if($op.length){
            ($this.val() == \'Down\') ? 
                $op.last().next().after($op) : 
                $op.first().prev().before($op);
        }
    });
    
    $(\'#btnRightolt\').click(function(e) {
        var selectedOpts = $(\'#cmd_olt option:selected\');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $(\'#cmd_olt_all\').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $(\'#btnLeftolt\').click(function(e) {
        var selectedOpts = $(\'#cmd_olt_all option:selected\');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $(\'#cmd_olt\').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    //olt end
    
    //switch start
    $(\'#btnUpswt\').click(function(){
        var $op = $(\'#cmd_switch option:selected\'),
            $this = $(this);
        if($op.length){
            ($this.val() == \'Up\') ? 
                $op.first().prev().before($op) : 
                $op.last().next().after($op);
        }
    });
    $(\'#btnDownswt\').click(function(){
        var $op = $(\'#cmd_switch option:selected\'),
            $this = $(this);
        if($op.length){
            ($this.val() == \'Down\') ? 
                $op.last().next().after($op) : 
                $op.first().prev().before($op);
        }
    });
    
    $(\'#btnRightswt\').click(function(e) {
        var selectedOpts = $(\'#cmd_switch option:selected\');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $(\'#cmd_switch_all\').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $(\'#btnLeftswt\').click(function(e) {
        var selectedOpts = $(\'#cmd_switch_all option:selected\');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $(\'#cmd_switch\').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    //switch end
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