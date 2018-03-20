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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open STB User");
    global $conn;
    $conn_ott   = DB_TV();
	
    $perhalaman = 50;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
$id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_uploadepg.php?id='.$id_data.'" class="btn bg-maroon btn-flat margin">Upload TXT</a>
					
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-3">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Channel</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <ul>';
//select data

    $sql_data		= mysqli_query($conn_ott ,"SELECT * FROM `ott_livechannel`;");
   
    while($row_data = mysqli_fetch_array($sql_data))
    {
	$content .='<li><a href="channel_epg.php?id='.$row_data["channelId"].'">'.$row_data["channelName"].'</a></li>';
	
    }

$content .='</ul>
</div>

	    
       </div>
	</div>
	
                        <div class="col-xs-9">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Channel</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
									<form action="" role="form" name="form_product" id="form_product" method="post" enctype="multipart/form-data">
									<div class="box-tools pull-right">
										<button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
									</div>
									<br style="clear:both;"><br>

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Date</th>
					<th>Time</th>
					<th>Program</th>
					<th width="15%">Action</th>
					<th width="5%"><input type="checkbox" id="checkAll"></th>
                  </tr>
                </thead>
                <tbody>';
//select data
if(isset($_GET["id"]))
{
	
    $sql_data		= mysqli_query($conn_ott ,"SELECT * FROM `ott_epg` WHERE `channelId` = '".$id_data."' LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott ,"SELECT * FROM `ott_epg` WHERE `channelId` = '".$id_data."';"));
    $hal		= "?id=$id_data&";
    $no = $start + 1;
//echo $sql_total_data;
    while($row_data = mysqli_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["programDate"].'</td>
			<td>'.$row_data["playTime"].'</td>
			<td>'.$row_data["pcontent"].'</td>
			
			<td><a href="detail_epg.php?id='.$row_data["epgId"].'" onclick="return valideopenerform(\'detail_epg.php?id='.$row_data["epgId"].'\',\'epg\');">Details</a>  ||
			<a href="form_epg.php?id='.$row_data["epgId"].'">edit</a></td>
			<td><input type="checkbox" name="epgId[]" id="epgId" value="'.$row_data["epgId"].'"></td>
		</tr>';
	$no++;
    }
}

$content .='</tbody>
</table>
</form>
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

if(isset($_POST["hapus"]))
{
	$id_channel = array();
	$id_channel = isset($_POST["epgId"]) ? $_POST["epgId"] : $id_channel;
	
	foreach($id_channel as $key => $value)
	{
		$sql_delete = "DELETE FROM `ott_epg` WHERE `epgId`= '".$value."';";
		//echo $sql_insert_staff;
		mysqli_query($conn_ott, $sql_delete) or die (mysqli_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_delete);
	}
	header('location: '.URL_OTT.'tv/channel_epg.php');
}


$plugins = '<script language="javascript">
//ispay
$(\'input#checkAll\').on(\'ifChecked\', function(event){
	$(\'input#epgId\').iCheck(\'check\');
});
$(\'input#checkAll\').on(\'ifUnchecked\', function(event){
	$(\'input#epgId\').iCheck(\'uncheck\');
});
</script>
<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Channel EPG';
    $submenu	= "channel_epg";
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