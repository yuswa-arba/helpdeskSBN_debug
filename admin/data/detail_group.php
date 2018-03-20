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

$messages = '';

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],"open detail group");


if(isset($_GET["id"]))
{
    $id_grouptime = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_grouptime = mysql_query("SELECT * FROM `gx_inet_grouptime` WHERE `id_grouptime` = '".$id_grouptime."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_grouptime = mysql_fetch_array($sql_grouptime);

//log
enableLog("",$loggedin["username"], $loggedin["id_employee"],'open detail group '.$row_grouptime["grouptime_nama"]);    
}

    $content ='<section class="content-header">
                    <h1>
                        Detail '.(isset($_GET["id"]) ? $row_grouptime["grouptime_nama"] : "").'
                    </h1>
                    
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Detail</h3>
                                    <div class="box-tools pull-right">
                                        <div class="label bg-aqua"><a href="form_group?id='.$row_grouptime["id_grouptime"].'">Update</a></div>
                                    </div>
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
                                                <span>'.(isset($_GET["id"]) ? $row_grouptime["grouptime_nama"] : "").'</span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Deskripsi Group</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <span>'.(isset($_GET["id"]) ? $row_grouptime["grouptime_desc"] : "").'</span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h5>Time Part</h5>
                                            </div>
                                            <div class="col-xs-7">
                                                <span>'.(isset($_GET["id"]) ? $row_grouptime["grouptime_part"] : "").'</span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h5>Dengan detail waktu</h5>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table table-hover table-border">
                                                    <thead>
                                                    <tr>
                                                        <th>no</th>
                                                        <th>start</th>
                                                        <th>end</th>
                                                        <th>Bandwidth</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>';

$sql_time = mysql_query("SELECT * FROM `gx_inet_time` WHERE `id_grouptime` = '".$id_grouptime."' AND `level` = '0';", $conn);
$no = 1;

while($row_time = mysql_fetch_array($sql_time))
{
    $content .='<tr>
        <td>'.$no.'.</td>
        <td>'.$row_time["start"].' WIB</td>
        <td>'.$row_time["end"].' WIB</td>
        <td>'.$row_time["bw"].'</td>
    </tr>';
    $no++;
}
    
$content .='</tbody></table>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    
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
    text += \'</select></div><div class="col-xs-2"><h5>End</h5></div><div class="col-xs-2"><select name="end_time[]" class="form-control">\';
    for (endTime =1; endTime <= 24; endTime++)
    {
        text += \'<option value="\'+ endTime +\'">\'+ endTime +\'</option>\';
    }
    text += \'</select></div><div class="col-xs-1"><h5>B/w</h5></div><div class="col-xs-3"><input type="text" class="form-control" name="bw[]" value=""></div></div></div>\';
}
$(\'#show_time\').html(text);
//document.getElementById("show_time").innerHTML = text;

});

</script>

    ';

    $title	= 'Detail GroupTime';
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