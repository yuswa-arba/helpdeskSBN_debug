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
global $conn_voip;

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open Form group");

//DATA Internet
$conn_soft = Config::getInstanceSoft();
$messages = '';


if(isset($_POST["save"]))
{
    
    $grouptime_nama     = isset($_POST['grouptime_nama']) ? mysql_real_escape_string(trim($_POST['grouptime_nama'])) : '';
    $grouptime_desc     = isset($_POST['grouptime_desc']) ? mysql_real_escape_string(trim($_POST['grouptime_desc'])) : '';
    $grouptime_part	= isset($_POST['grouptime_part']) ? mysql_real_escape_string(trim($_POST['grouptime_part'])) : '';
    
    //insert into gx_inet_grouptime
    $sql_insert = "INSERT INTO `gx_inet_grouptime` (`id_grouptime`, `grouptime_nama`, `grouptime_desc`, `grouptime_part`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$grouptime_nama."', '".$grouptime_desc."', '".$grouptime_part."', '".$loggedin["username"]."',
                    '".$loggedin["username"]."', NOW(), NOW(), '0');";
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    $start = array();
    $start = isset($_POST["start_time"]) ? $_POST["start_time"] : $start;
    $end = array();
    $end = isset($_POST["end_time"]) ? $_POST["end_time"] : $end;
    $bw = array();
    $bw = isset($_POST["bw"]) ? $_POST["bw"] : $bw;
    
    //select last data
    $sql_select = mysql_query("SELECT `id_grouptime` FROM `gx_inet_grouptime`
                              WHERE `grouptime_nama` = '".$grouptime_nama."'
                              AND `grouptime_desc` = '".$grouptime_desc."'
                              AND `grouptime_part` = '".$grouptime_part."'
                              AND `level` = '0' LIMIT 0,1;", $conn) or die(mysql_error());
    $row_select = mysql_fetch_array($sql_select);
    
    //insert into gx_inet_time
    for ($i = 0; $i < $grouptime_part; $i++)
    {
        $insert_time = "INSERT INTO `gx_inet_time` (`id`, `id_grouptime`, `start`, `end`, `bw`, `level`)
                    VALUES (NULL, '".$row_select["id_grouptime"]."', '".$start[$i]."', '".$end[$i]."', '".$bw[$i]."', '0');";
        mysql_query($insert_time, $conn) or die (mysql_error());
    }
    /*$messages = '<div class="alert alert-info  alert-dismissable">
                    <i class="fa fa-info"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Info!</b> '.$messages_insert.'
                </div>';*/
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."data/list_group.php';
	</script>";
        
}elseif(isset($_POST["update"]))
{
    $id_grouptime       = isset($_POST['id_grouptime']) ? mysql_real_escape_string(trim($_POST['id_grouptime'])) : '';
    $grouptime_nama     = isset($_POST['grouptime_nama']) ? mysql_real_escape_string(trim($_POST['grouptime_nama'])) : '';
    $grouptime_desc     = isset($_POST['grouptime_desc']) ? mysql_real_escape_string(trim($_POST['grouptime_desc'])) : '';
    $grouptime_part	= isset($_POST['grouptime_part']) ? mysql_real_escape_string(trim($_POST['grouptime_part'])) : '';
    
    $start = array();
    $start = isset($_POST["start_time"]) ? $_POST["start_time"] : $start;
    $end = array();
    $end = isset($_POST["end_time"]) ? $_POST["end_time"] : $end;
    $bw = array();
    $bw = isset($_POST["bw"]) ? $_POST["bw"] : $bw;
    
    
    //update gx_inet_grouptime
    $sql_update = "UPDATE `gx_inet_grouptime` SET `grouptime_nama` = '".$grouptime_nama."', `grouptime_desc` = '".$grouptime_desc."',
                `grouptime_part` = '".$grouptime_part."', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                WHERE `id_grouptime` = '".$id_grouptime."';";
                
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    if(count($start) > 1){
        //update last data from id
        $sql_update_time = "UPDATE `gx_inet_time` SET `level` = '1' WHERE `id_grouptime` = '".$id_grouptime."';";
        mysql_query($sql_update_time, $conn) or die (mysql_error());
        
        //select last data
        $sql_select = mysql_query("SELECT `id_grouptime` FROM `gx_inet_grouptime`
                              WHERE `grouptime_nama` = '".$grouptime_nama."'
                              AND `grouptime_desc` = '".$grouptime_desc."'
                              AND `grouptime_part` = '".$grouptime_part."'
                              AND `level` = '0' LIMIT 0,1;", $conn) or die(mysql_error());
        $row_select = mysql_fetch_array($sql_select);
    
        //insert into gx_inet_time
        for ($i = 0; $i < $grouptime_part; $i++)
        {
            $insert_time = "INSERT INTO `gx_inet_time` (`id`, `id_grouptime`, `start`, `end`, `bw`, `level`)
                    VALUES (NULL, '".$row_select["id_grouptime"]."', '".$start[$i]."', '".$end[$i]."', '".$bw[$i]."', '0');";
            mysql_query($insert_time, $conn) or die (mysql_error());
        }
    }
   
    
    /*$messages = '<div class="alert alert-info  alert-dismissable">
                    <i class="fa fa-info"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Info!</b> '.$messages_update.'
                </div>';*/
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."data/list_group.php';
	</script>";
}


if(isset($_GET["id"]))
{
    $id_grouptime = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_grouptime = mysql_query("SELECT * FROM `gx_inet_grouptime` WHERE `id_grouptime` = '".$id_grouptime."' LIMIT 0,1;", $conn);
    $row_grouptime = mysql_fetch_array($sql_grouptime);
    
}

    $content ='<section class="content-header">
                    <h1>
                        Form GroupTime
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form GroupTime</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    '.$messages.'
                                    <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Nama Group</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" name="grouptime_nama" value="'.(isset($_GET["id"]) ? $row_grouptime["grouptime_nama"] : "").'">
                                                '.(isset($_GET["id"]) ? '<input type="hidden" class="form-control" name="id_grouptime" value="'.$row_grouptime["id_grouptime"].'">' : '').'
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
					<div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi Group</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <textarea class="form-control" name="grouptime_desc">'.(isset($_GET["id"]) ? $row_grouptime["grouptime_desc"] : "").'</textarea>
                                            </div>
                                        </div>
                                        </div>
					<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Time Part</h5>
                                            </div>
                                            <div class="col-xs-3">
                                                <select name="grouptime_part" id="grouptime_part" class="form-control">';
for($part=1; $part<=10; $part++){
    $selected = isset($_GET["id"]) ? $row_grouptime["grouptime_part"] : "";
    $selected = ($selected == $part) ? ' selected=""' : "";
    $content .='<option value="'.$part.'"'.$selected.'>'.$part.'</option>';
}

$content .='                                    </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div id="show_time">';
/*if(isset($_GET["id"]))
{
    for($i=1; $i<=$row_grouptime["grouptime_part"]; $i++)
    {
        $content .='<div class="form-group">
        <div class="row">
            <div class="col-xs-2">
                <h5>'.$i.'. Start</h5>
            </div>
            <div class="col-xs-2">
                <select name="start_time[]" class="form-control">';
        
            for($start_time=1; $start_time<=$row_time["start"]; $start_time++)
            {
                $content .='<option value="'.$start_time.'">'.$start_time.'</option>';
            }
        
        $content.='</select>
            </div>
            <div class="col-xs-2">
                <h5>End</h5>
            </div>
            <div class="col-xs-2">
                <select name="end_time[]" class="form-control">';
        
            for($end_time=1; $end_time<=$row_time["end"]; $end_time++)
            {
                $content .='<option value="'.$end_time.'">'.$end_time.'</option>';
            }
        
        $content.='</select>
            </div>
            <div class="col-xs-2">
                <h5>B/w</h5>
            </div>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="bw[]" value="">
            </div>
        </div></div>';
    }
}*/
$content .='</div>
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
<script language="javascript">
$(\'#grouptime_part\').on(\'change\', function() {
  //alert( this.value );
  text ="";
  for (i =1; i <= this.value; i++)
  {
    text += \'<div class="form-group"><div class="row"><div class="col-xs-2"><h5>\'+ i +\'. Start</h5></div><div class="col-xs-2"><select name="start_time[]" class="form-control">\';
    for (startTime =1; startTime <= 24; startTime++)
    {
        text += \'<option value="\'+ startTime +\'">\'+ startTime +\'</option>\';
    }
    text += \'</select> WIB</div><div class="col-xs-2"><h5>End</h5></div><div class="col-xs-2"><select name="end_time[]" class="form-control">\';
    for (endTime =1; endTime <= 24; endTime++)
    {
        text += \'<option value="\'+ endTime +\'">\'+ endTime +\'</option>\';
    }
    text += \'</select> WIB</div><div class="col-xs-1"><h5>B/w</h5></div><div class="col-xs-3"><input type="text" class="form-control" name="bw[]" value=""></div></div></div>\';
}
$(\'#show_time\').html(text);
//document.getElementById("show_time").innerHTML = text;

});

</script>

    ';

    $title	= 'Form GroupTime';
    $submenu	= "inet_grouptime";
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