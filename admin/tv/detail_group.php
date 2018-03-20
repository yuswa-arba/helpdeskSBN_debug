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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Provider");
    global $conn;
    $conn_tv   = DB_TV();
	
	if(isset($_POST["hapus"]))
    {
        $id_channel_provider = array();
        $id_channel_provider = isset($_POST["id_channel_provider"]) ? $_POST["id_channel_provider"] : $id_channel_provider;
        
        foreach($id_channel_provider as $key => $value)
        {
            $sql_update = mysql_query("UPDATE `gx_tv_provider_group` SET `level` = '1', `date_upd` = NOW() WHERE `id_channel_provider` = '".$value."';", $conn) or die (mysql_error());
        }
        header("location:master_provider.php");
    }
	
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_channel.php?id='.$_GET["id"].'" class="btn bg-maroon btn-flat margin">Add Channel</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
<form method ="POST" action="">
 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Nama Channel</th>
			<th>#</th>
                  </tr>
                </thead>
                <tbody>';
//select data
	$id				= $_GET["id"];
    $sql_data		= mysql_query("SELECT * FROM `gx_tv_provider_group` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_tv_provider_group` WHERE `level` = '0' AND `id_provider` = '".$id."' ORDER BY `date_add` DESC;", $conn));
	
   
	$hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
    $sql_data_tv	= mysqli_query($conn_tv, "SELECT * FROM `ott_livechannel` WHERE `channelId` = '".$row_data["id_channel"]."';");
	//echo "SELECT * FROM `ott_livechannel` WHERE `channelId` = '".$row_data["id_channel"]."';";
	$row_data_tv	= mysqli_fetch_array($sql_data_tv);
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data_tv["channelName"].'</td>
			<td><input type="checkbox" name="id_channel_provider[]" value="'.$row_data["id_channel_provider"].'"></td>
			</td>
		</tr>';
	$no++;
    }

$content .='</tbody>

</table>

</div>
<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
        <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
        </form>
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Detail Provider';
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