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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Periksa Pembelian");
    global $conn;
    
if(isset($_GET["id"]) && isset($_GET["action"]))
{
    $id_setujubeli		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $action			= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($id_setujubeli != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `gx_setuju_pembelian` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'   WHERE (`id_setuju_pembelian`='".$id_setujubeli."');";
	
	//echo $sql_update_lock;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: master_setuju_pembelian.php");

}

    
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
				<div class="box-body">
				    <a href="form_setuju_pembelian.php" class="btn bg-maroon btn-flat margin">Create New</a>
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
			<th>Kode Periksa Beli</th>
			<th>Kode Permintaan Beli</th>
			<th>tanggal</th>
			<th>Divisi</th>
			<th>Remarks</th>
			<th>Status</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_setuju_pembelian` WHERE `level` =  '0' ORDER BY `id_setuju_pembelian` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_setuju_pembelian` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_setuju_pembelian"].'</td>
			<td>'.$row_data["kode_permintaan_pembelian"].'</td>
			<td>'.$row_data["tanggal"].'</td>
			<td>'.$row_data["nama_divisi"].'</td>
			<td>'.$row_data["remarks_setujubeli"].'</td>
			<td>'.(($row_data["status"] == "1") ? '<span class="label label-danger">Close</span>' : '<span class="label label-success">Open</span>').'</td>
			<td>'.(($row_data["status"] == "1") ? '<a href="detail_setuju_pembelian?c='.$row_data["kode_setuju_pembelian"].'"><span class="label label-info">Detail</span></a>'
			       : '<a href="form_setujubeli_detail?c='.$row_data["kode_setuju_pembelian"].'"><span class="label label-info">Detail</span></a>
			    <a href="form_setuju_pembelian?id='.$row_data["id_setuju_pembelian"].'"><span class="label label-info">Edit</span></a>
			    <a href="?id='.$row_data["id_setuju_pembelian"].'&action=lock"><span class="label label-info">Lock</span></a>
			    ').'
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
</section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Periksa Pembelian';
    $submenu	= "master_setujubeli";
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