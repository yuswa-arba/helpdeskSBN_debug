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
    if($loggedin["group"] == 'admin')
    {
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Log Version");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_log_version` WHERE `id_logversion`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Log Version</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Version</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="version" name="version" required="" value="'.(isset($_GET['id']) ? $row_data["version"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=rab\',\'cabang\');">
											</div>
											<div class="col-xs-3">
												<label>Release Date</label>
											</div>
											<div class="col-xs-3">
												<input type="text"  class="form-control" id="release_date" name="release_date" required="" value="'.(isset($_GET['id']) ? $row_data["release_date"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Team</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="team" name="team" required="" value="'.(isset($_GET['id']) ? $row_data["team"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Change Log</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="change_log" name="change_log" required="" value="'.(isset($_GET['id']) ? $row_data["change_log"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Announcement</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="announcement" name="announcement" required="" value="'.(isset($_GET['id']) ? $row_data["announcement"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>DB Version</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" class="form-control" id="db_version" name="db_version" required="" value="'.(isset($_GET['id']) ? $row_data["db_version"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

if(isset($_POST["save"]))
{
    //echo "save";
    $version	   	= isset($_POST['version']) ? mysql_real_escape_string(trim($_POST['version'])) : '';
	$release_date   = isset($_POST['release_date']) ? mysql_real_escape_string(trim($_POST['release_date'])) : '';
	$team 			= isset($_POST['team']) ? mysql_real_escape_string(trim($_POST['team'])) : '';
    $change_log		= isset($_POST['change_log']) ? mysql_real_escape_string(trim($_POST['change_log'])) : '';
	$announcement	= isset($_POST['announcement']) ? mysql_real_escape_string(trim($_POST['announcement'])) : '';
	$db_version	 	= isset($_POST['db_version']) ? mysql_real_escape_string(trim($_POST['db_version'])) : '';
	
	if($version != "" && $release_date != "" && $team != "" && $change_log != "" && $change_log != "$db_version"){
	$sql_insert = "INSERT INTO `gx_log_version` (`id_logversion`, `version`, `release_date`,
						  `team`, `change_log`, `announcement`, `db_version`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$version."', '".$release_date."',
						  '".$team."', '".$change_log."', '".$announcement."', '".$db_version."', 
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."log/log_version.php';
			</script>";
			
    }else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak boleh Kosong!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $version	   	= isset($_POST['version']) ? mysql_real_escape_string(trim($_POST['version'])) : '';
	$release_date   = isset($_POST['release_date']) ? mysql_real_escape_string(trim($_POST['release_date'])) : '';
	$team 			= isset($_POST['team']) ? mysql_real_escape_string(trim($_POST['team'])) : '';
    $change_log		= isset($_POST['change_log']) ? mysql_real_escape_string(trim($_POST['change_log'])) : '';
	$announcement	= isset($_POST['announcement']) ? mysql_real_escape_string(trim($_POST['announcement'])) : '';
	$db_version	 	= isset($_POST['db_version']) ? mysql_real_escape_string(trim($_POST['db_version'])) : '';
	
    $sql_update = "UPDATE `gx_log_version` SET `version` = '$version',
			`release_date` = '$release_date', `team` = '$team', `change_log` = '$change_log', `announcement` = '$announcement', `db_version` = '$db_version'
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_logversion` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."log/log_version.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		';

    $title	= 'Form LOG Version';
    $submenu	= "log_version";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>