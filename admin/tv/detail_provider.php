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
//include ("../../config/configuration_tv.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Provider");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
	 
	$id				= isset($_GET['id']) ? (int)$_GET['id'] : '';
	$row_data_provider		= mysql_fetch_array(mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_provider` = '".$id."' AND `level` = '0' ORDER BY `date_add` DESC LIMIT 0,1;", $conn));
	$sql_data		= mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_parent` = '".$id."' AND `level` = '0' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_parent` = '".$id."' AND `level` = '0' ORDER BY `date_add` DESC;", $conn));
	$hal		= "?";
	$no = $start + 1;

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data '.$row_data_provider["nama"].'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Nama Provider</th>
			<th>Alamat</th>
			<th>Email</th>
			<th>No Telp</th>
			<th>Keterangan</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data
	

    while($row_data = mysql_fetch_array($sql_data))
    {

	$content .='<tr>
			<td>'.$no.'.</td>
			<td><a href="detail_channel.php?id='.$row_data["id_provider"].'">'.$row_data["nama"].'</a></td>
			<td>'.$row_data["alamat"].'</td>
			<td>'.$row_data["email"].'</td>
			<td>'.$row_data["no_telp"].'</td>
			<td>'.$row_data["keterangan"].'</td>
            <td>
			<a href="form_provider.php?id='.$row_data["id_provider"].'"><span class="label label-info">Update</span></a>
			</td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
            
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>
	   </section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Provider';
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