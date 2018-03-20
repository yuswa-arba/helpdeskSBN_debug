<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */
include ("../../config/configuration_admin.php");
include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Channel Provider");
    global $conn;
	$conn_ott   = DB_TV();
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '
                <!-- Main content -->
				<section class="content">
					

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					
					<th>Channel Name</th>
					
					<th>Reference price</th>
					<th>Provider</th>
					
                  </tr>
                </thead>
                <tbody>';
//select data


	$id				= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $sql_data		= mysql_query("SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC;", $conn));
	//echo "SELECT * FROM `gx_tv_channel_provider` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;";
   
	$hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
		
		$sql_data_tv	= mysqli_query($conn_ott, "SELECT * FROM `ott`.`ott_livechannel` WHERE `channelId` = '".$row_data["id_channel"]."';");
		//echo "SELECT * FROM `ott_livechannel` WHERE `channelId` = '".$row_data["id_channel"]."';";
		$row_data_tv	= mysqli_fetch_array($sql_data_tv);
		$content .='<tr>
				<td>'.$no.'.</td>
				
				<td><a href="detail_channel.php?id='.$row_data["id_provider"].'&cid='.$row_data_tv["channelId"].'">'.$row_data_tv["channelName"].'</a></td>
				
				<td>'.$row_data_tv["referencePrice"].'</td>
				<td>'.$row_data_tv["provider"].'</td>
				</td>
			</tr>';
		$no++;
    }
	

$content .='</tbody>
</table>
</div>

			<div class="box-footer">
				<div class="box-tools pull-right">
				'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
				</div>
				<br style="clear:both;">
			</div>
       </div>
	</div>
</div>
</section>
';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Channel Provider';
    $submenu	= "channel_provider";
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