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
//include ("config/configuration_ott.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		$conn_ott   = DB_TV();

	
if(isset($_POST["save"]))
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
/*elseif(isset($_POST["update"]))
{
    $id_data	 	= isset($_POST['id_data']) ? mysql_real_escape_string(trim($_POST['id_data'])) : '';
    $kode_data       	= isset($_POST['kode_data']) ? mysql_real_escape_string(trim($_POST['kode_data'])) : '';
    $nama_data       	= isset($_POST['nama_data']) ? mysql_real_escape_string(trim($_POST['nama_data'])) : '';
    $area       	= isset($_POST['area']) ? mysql_real_escape_string(trim($_POST['area'])) : '';
    $coverage       	= isset($_POST['coverage']) ? mysql_real_escape_string(trim($_POST['coverage'])) : '';
    
    if($id_data != ""){
		//insert into gx_data
		$sql_update_data = "UPDATE `gx_data` SET `level` = '1',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `id_data` = '".$id_data."';";
		//echo $sql_update_staff;
		mysql_query($sql_update_data, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_data);
		
		//insert into gx_data
		$sql_insert_data = "INSERT INTO `gx_data` (`id_data`, `kode_data`, `nama_data`, `area`, `coverage`,
				`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				VALUES (NULL, '".$kode_data."', '".$nama_data."', '".$area."', '".$coverage."',
				'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert_staff;
		mysql_query($sql_insert_data, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_data);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='paket.php';
			</script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
}*/

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `ott_product` WHERE `proID`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysqli_query($conn_ott, $query_data);
    $row_data	= mysqli_fetch_array($sql_data);
    
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
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  name="proId" value="'.(isset($_GET['id']) ? $row_data["proID"] : "").'">
						
							'.(isset($_GET['id']) ? $row_data["proName"] : "").'
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga</label>
					    </div>
					    <div class="col-xs-4">
							'.(isset($_GET['id']) ? $row_data["price"] : "").'
						</div>
					</div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Product Type</label>
					    </div>
					    <div class="col-xs-4">
							'.(isset($_GET['id']) ? $row_data["proType"] : "").'
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Order Type</label>
					    </div>
					    <div class="col-xs-4">
							'.(isset($_GET['id']) ? $row_data["orderType"] : "").'
							</select>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Deskripsi</label>
					    </div>
					    <div class="col-xs-8">
							'.(isset($_GET['id']) ? $row_data["description"] : "").'
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
						<label>List Paket</label>
					    </div>
					    <div class="col-xs-6">
							
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
						<label>List VOD</label>
					    </div>
					    <div class="col-xs-6">
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
					<th>Nama Movie</th>
					<th width="15%"><input type="checkbox" id="select_movie"></th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysqli_query($conn_ott, "SELECT * FROM `ott_movie`;");
    $nom = 1;

    while($row_data = mysqli_fetch_array($sql_data))
    {
		$id_service		= isset($_GET['id']) ? (int)$_GET['id'] : '';
		$query_service	= "SELECT * FROM `ott_productservice` WHERE `type`='1' AND `proID`='".$id_data."' AND `movieId`='".$row_data["movieId"]."' LIMIT 0,1;";
		$sql_service	= mysqli_query($conn_ott, $query_service);
		$numrow_service	= mysqli_num_rows($sql_service);
		
		if($numrow_service == 1)
		{
			$select = 'checked=""';
			$content .='<tr>
				<td>'.$nom.'.</td>
				<td>'.$row_data["movieName"].'</td>
				<td><input class="movie" type="checkbox" '.$select.' name="id_movie[]" value="'.$row_data["movieId"].'"></td>
			</tr>';
		}else
		{
			$content .= '<tr>
						<td>'.$nom.'.</td>
						<td>'.$row_data["movieName"].'</td>
						<td><input class="movie" type="checkbox" name="id_movie[]" value="'.$row_data["movieId"].'"></td>
					</tr>';
		}
		$nom++;
    }

$content .='</tbody>
</table>
					    </div>
					    <div class="col-xs-6">
						<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Nama Channel</th>
					<th width="15%"><input type="checkbox" id="select_channel"></th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_datac		= mysqli_query($conn_ott, "SELECT * FROM `ott_livechannel`;");
    $noc = 1;

    while($row_datac = mysqli_fetch_array($sql_datac))
    {
		$id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
		$query_service2	= "SELECT * FROM `ott_productservice` WHERE `type`='2' AND `proID`='".$id_data."' AND `movieId`='".$row_data["movieId"]."' LIMIT 0,1;";
		$sql_service2	= mysqli_query($conn_ott, $query_service2);
		$numrow_service2	= mysqli_num_rows($sql_service2);
		
		if($numrow_service2 == 1)
		{
				$content .= '<tr>
				<td>'.$noc.'.</td>
				<td>'.$row_datac["channelName"].'</td>
				<td><input class="channel" '.$select.' type="checkbox" name="id_channel[]" value="'.$row_datac["channelId"].'"></td>
			</tr>';
		}else{
			$content .= '<tr>
				<td>'.$noc.'.</td>
				<td>'.$row_datac["channelName"].'</td>
				<td><input class="channel" type="checkbox" name="id_channel[]" value="'.$row_datac["channelId"].'"></td>
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
$(\'input#select_movie\').on(\'ifChecked\', function(event){
	$("input.movie").iCheck("check");
});
$(\'input#select_movie\').on(\'ifUnchecked\', function(event){
	$("input.movie").iCheck("uncheck");
});
</script>
';

    $title	= 'Form Paket';
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