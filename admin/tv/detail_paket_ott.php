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


if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `ott_product` WHERE `proID`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysqli_query($conn_ott ,$query_data);
    $row_data	= mysqli_fetch_array($sql_data);
    
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
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
					<th width="15%"></th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysqli_query($conn_ott ,"SELECT * FROM `ott_movie`;");
    $nom = 1;

    while($row_data = mysqli_fetch_array($sql_data))
    {
		$id_service		= isset($_GET['id']) ? (int)$_GET['id'] : '';
		$query_service	= "SELECT * FROM `ott_productservice` WHERE `type`='1' AND `proID`='".$id_data."' AND `movieId`='".$row_data["movieId"]."' LIMIT 0,1;";
		$sql_service	= mysqli_query($conn_ott ,$query_service);
		$numrow_service	= mysqli_num_rows($sql_service);
		
		if($numrow_service == 1)
		{
			$select = 'checked=""';
			$content .='<tr>
				<td>'.$nom.'.</td>
				<td>'.$row_data["movieName"].'</td>
				<td><input class="movie" type="checkbox" '.$select.' name="id_movie[]" value="'.$row_data["movieId"].'"></td>
			</tr>';
		}
		else
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
					<th width="15%"></th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_datac		= mysqli_query($conn_ott ,"SELECT * FROM `ott_livechannel`;");
    $noc = 1;

    while($row_datac = mysqli_fetch_array($sql_datac))
    {
		$id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
		$query_service2	= "SELECT * FROM `ott_productservice` WHERE `type`='2' AND `proID`='".$id_data."' AND `movieId`='".$row_datac["channelId"]."' LIMIT 0,1;";
		
		$sql_service2	= mysqli_query($conn_ott ,$query_service2);
		$numrow_service2	= mysqli_num_rows($sql_service2);
		
		if($numrow_service2 == 1)
		{
				$select = 'checked=""';
				$content .= '<tr>
				<td>'.$noc.'.</td>
				<td>'.$row_datac["channelName"].'</td>
				<td><input class="channel" '.$select.' type="checkbox" name="id_channel[]" value="'.$row_datac["channelId"].'"></td>
			</tr>';
		}
		else
		{
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

    $title	= 'Master Paket';
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