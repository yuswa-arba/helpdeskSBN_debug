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

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				    <a href="form_provider.php" class="btn bg-maroon btn-flat margin">Create New</a>
					<a href="form_setting_provider.php" class="btn bg-maroon btn-flat margin">Setting Provider</a>
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

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Nama Provider</th>
					<th>Alamat</th>
					<th>Email</th>
					<th>No Telp</th>
					<th>Keterangan</th>
					<th>Sub Provider</th>
					<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_parent` = '0' AND `level` = '0' ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_parent` = '0' AND `level` = '0' ORDER BY `date_add` DESC;", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
		$sql_total_sub	= mysql_num_rows(mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_parent` = '".$row_data["id_provider"]."' AND `level` = '0' ORDER BY `date_add` DESC;", $conn));
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["nama"].'</td>
			<td>'.$row_data["alamat"].'</td>
			<td>'.$row_data["email"].'</td>
			<td>'.$row_data["no_telp"].'</td>
			<td>'.$row_data["keterangan"].'</td>
            <td>'.(($sql_total_sub == 0) ? '<span class="label label-info">'.$sql_total_sub.'</span>' : '<a href="detail_provider.php?id='.$row_data["id_provider"].'" title="'.$sql_total_sub.' SubProvider"><span class="label label-info">'.$sql_total_sub.'</span></a></td>') .'
			<td>'.(($sql_total_sub == 0) ? '<a href="channel_provider.php?id='.$row_data["id_provider"].'"><span class="label label-info">View Channel</span></a>' : '') .'
			
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