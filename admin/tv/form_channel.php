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
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		$conn_ott   = DB_TV();
    
if(isset($_POST["save"]))
{
    $channelName   	= isset($_POST['channelName']) ? mysql_real_escape_string(trim($_POST['channelName'])) : '';
    $provider		= isset($_POST['provider']) ? mysql_real_escape_string(trim($_POST['provider'])) : '';
	$id_provider	= isset($_POST['id_provider']) ? mysql_real_escape_string(trim($_POST['id_provider'])) : '';
	
    if($channelName != "" AND $provider !=""){
		
		
			//insert into gx_data
			$sql_insert_data = "INSERT INTO `ott_livechannel` (`channelId`, `channelName`, `provider`)
			VALUES (NULL, '".$channelName."', '".$provider."');";
			//echo $sql_insert_data;
			mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
			
			//insert into gx_data
			$sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
			VALUES (NULL, '".$createDate."', 'Added a  ".$channelName."', 'OTTWEB (".$loggedin["username"].")', 'Master channel');";
			//echo $sql_insert_log;
			mysqli_query($conn_ott, $sql_insert_log) or die (mysqli_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log);
			
			
			//select last channel
			$query_lastdata = "SELECT * FROM `ott_livechannel` WHERE `channelName`='".$channelName."' AND `provider` = '".$provider."' LIMIT 0,1;";
			$sql_lastdata	= mysqli_query($conn_ott, $query_lastdata);
			$row_lastdata	= mysqli_fetch_array($sql_lastdata);
	
			//insert gx
			$query_insert_provider = "INSERT INTO `gx_tv_channel_provider` (`id_channel_provider`, `id_provider`, `id_product`, `id_channel`,
															 `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$id_provider."', NULL, '".$row_lastdata["channelId"]."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
			//echo $query_insert_provider;
			mysql_query($query_insert_provider, $conn);

		echo "<script language='JavaScript'>
			alert('Data telah disimpan.');
			window.location.href='detail_channel.php?id=$id_provider';
			</script>";
    }else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `gx_tv_provider` WHERE `id_provider`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Live Channel</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					
					<input type="hidden" name="id_provider" value="'.(isset($_GET['id']) ? $row_data["id_provider"] : "").'" id="id_provider">
					
					<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<label>Channel Name</label>
						</div>
						<div class="col-xs-6">
							<input name="channelName" required="" class="form-control" type="text" maxlength="50" id="channelName" value="">
						</div>
						
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<label>Provider</label>
						</div>
						<div class="col-xs-6">
							<input name="provider" required="" class="form-control" type="text" maxlength="100" id="provider" value="'.(isset($_GET['id']) ? $row_data["nama"] : "").'">
						</div>
						
					</div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Live Channel';
    $submenu	= "master_paket";
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