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
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Channel Provider");
    global $conn;
	$conn_ott   = DB_TV();

	
if(isset($_POST["save"]))
{
    $id_provider       	= isset($_POST['id_provider']) ? mysql_real_escape_string(trim($_POST['id_provider'])) : '';
	
	if($id_provider !="")
	{
		//insert into gx_data
		$sql_update_data = "UPDATE `software`.`gx_tv_channel_provider` SET `user_upd`='".$loggedin["username"]."',
		`date_upd`=NOW(), `level`='1' WHERE (`id_provider`='".$id_provider."');";
		//echo $sql_insert_staff;
		mysql_query($sql_update_data, $conn) or die (mysql_error());
		
		$id_channel = array();
		$id_channel = isset($_POST["id_channel"]) ? $_POST["id_channel"] : $id_channel;
		
		foreach($id_channel as $key_channel => $value_channel)
		{
			//insert into gx_data
			$sql_insert_data = "INSERT INTO `software`.`gx_tv_channel_provider` (`id_channel_provider`, `id_provider`, `id_product`, `id_channel`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$id_provider."', NULL, '".$value_channel."', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
			//echo $sql_insert_staff;
			mysql_query($sql_insert_data, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
			
		}
		echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='master_provider.php';
				</script>";
	}
}
/*
elseif(isset($_POST["update"]))
{
    $proId       	= isset($_POST['proId']) ? mysql_real_escape_string(trim($_POST['proId'])) : '';
    $price       	= isset($_POST['price']) ? mysql_real_escape_string(trim($_POST['price'])) : '';
    $StartDate     	= isset($_POST['StartDate']) ? mysql_real_escape_string(trim($_POST['StartDate'])) : '';
    $endDate       	= isset($_POST['endDate']) ? mysql_real_escape_string(trim($_POST['endDate'])) : '';
    $proType       	= isset($_POST['proType']) ? mysql_real_escape_string(trim($_POST['proType'])) : '';
    $pid	       	= isset($_POST['pid']) ? mysql_real_escape_string(trim($_POST['pid'])) : '';
    $viewDate     	= isset($_POST['viewDate']) ? mysql_real_escape_string(trim($_POST['viewDate'])) : '';
    $unit       	= isset($_POST['unit']) ? mysql_real_escape_string(trim($_POST['unit'])) : '';
    $description   	= isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
    $orderType     	= isset($_POST['orderType']) ? mysql_real_escape_string(trim($_POST['orderType'])) : '';
	$createDate		= date("Y/m/d H:i:s");
	
	if($proId !="")
	{
		$id_movie = array();
		$id_movie = isset($_POST["id_movie"]) ? $_POST["id_movie"] : $id_movie;
		
		//insert into gx_data
		$sql_delete = "DELETE FROM `ott_productservice` WHERE `proId`= '".$proId."';";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott, $sql_delete) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_delete);
		
		foreach($id_movie as $key => $value)
		{
			//insert into gx_data
			$sql_insert_data = "INSERT INTO `ott_productservice` (`psId`, `proId`, `sid`, `type`, `movieId`)
			VALUES (NULL, '".$proId."', NULL, '1', '".$value."');";
			//echo $sql_insert_staff;
			mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
			
			//insert into gx_data
			$sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
			VALUES (NULL, '".$createDate."', 'Added a product service id  ".$proId."', 'OTTWEB (".$loggedin["username"].")', 'Paket');";
			//echo $sql_insert_staff;
			mysqli_query($conn_ott, $sql_insert_log) or die (mysqli_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log);
			
			
		}
		
		$id_channel = array();
		$id_channel = isset($_POST["id_channel"]) ? $_POST["id_channel"] : $id_channel;
		
		foreach($id_channel as $key_channel => $value_channel)
		{
			//insert into gx_data
			$sql_insert_data = "INSERT INTO `ott_productservice` (`psId`, `proId`, `sid`, `type`, `movieId`)
			VALUES (NULL, '".$proId."', NULL, '2', '".$value_channel."');";
			//echo $sql_insert_staff;
			mysqli_query($conn_ott, $sql_insert_data) or die (mysqli_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
			
			//insert into gx_data
			$sql_insert_log = "INSERT INTO `ott`.`ott_log` (`logID`, `createDate`, `logContext`, `userName`, `menuName`)
			VALUES (NULL, '".$createDate."', 'Added a product service id  ".$proId."', 'OTTWEB (".$loggedin["username"].")', 'Paket');";
			//echo $sql_insert_staff;
			mysqli_query($conn_ott, $sql_insert_log) or die (mysqli_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_log);
			
			
		}
		echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='paket.php';
				</script>";
	}
}
*/
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
                                    <h3 class="box-title">Form Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
								
                                    <div class="box-body">
									
									<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Provider</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  name="id_provider" value="'.(isset($_GET['id']) ? $row_data["id_provider"] : "").'">
						
							'.(isset($_GET['id']) ? $row_data["nama"] : "").'
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-4">
							'.(isset($_GET['id']) ? $row_data["alamat"] : "").'
						</div>
					</div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email</label>
					    </div>
					    <div class="col-xs-4">
							'.(isset($_GET['id']) ? $row_data["email"] : "").'
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No Telpon</label>
					    </div>
					    <div class="col-xs-4">
							'.(isset($_GET['id']) ? $row_data["no_telp"] : "").'
							</select>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
							'.(isset($_GET['id']) ? $row_data["keterangan"] : "").'
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Persentase Margin</label>
					    </div>
					    <div class="col-xs-8">
							'.(isset($_GET['id']) ? $row_data["persentase_margin"] : "").'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-8">
							<label>List Channel Live</label>
					    </div>
					</div>
					</div>

					<div class="row">
					    <div class="col-xs-6">
						<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Nama Channel</th>
					<th width="15%"><input type="checkbox" id="select_channel" class="minimal"></th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_datac		= mysqli_query($conn_ott, "SELECT * FROM `ott`.`ott_livechannel`;");
    $noc = 1;

    while($row_datac = mysqli_fetch_array($sql_datac))
    {
		$id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
		$query_service2	= "SELECT * FROM `gx_tv_channel_provider` WHERE `id_provider`='".$id_data."' AND `id_channel`='".$row_datac["channelId"]."' LIMIT 0,1;";
		//echo $query_service2;
		
		$sql_service2	= mysql_query($query_service2, $conn);
		$row_service2	= mysql_fetch_array($sql_service2);
		$numrow_service2	= mysql_num_rows($sql_service2);
		
		if($numrow_service2 == 1)
		{
				$content .= '<tr>
				<td>'.$noc.'.</td>
				<td>'.$row_datac["channelName"].'</td>
				<td><input class="channel minimal" checked="" type="checkbox" name="id_channel[]" value="'.$row_datac["channelId"].'"></td>
			</tr>';
		}else{
			$content .= '<tr>
				<td>'.$noc.'.</td>
				<td>'.$row_datac["channelName"].'</td>
				<td><input class="channel minimal" type="checkbox" name="id_channel[]" value="'.$row_datac["channelId"].'"></td>
			</tr>';
		}
		$noc++;
    }

$content .='</tbody>
</table>
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

$plugins = '
<script language="javascript">
$(\'input#select_channel\').on(\'ifChecked\', function(event){
	$("input.channel").iCheck("check");
});
$(\'input#select_channel\').on(\'ifUnchecked\', function(event){
	$("input.channel").iCheck("uncheck");
});

</script>
';

    $title	= 'Channel Provider';
    $submenu	= "master_paket";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
	
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }
	
?>