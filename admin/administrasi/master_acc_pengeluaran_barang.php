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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Acc Pengeluaran Barang");
    global $conn;
    
if(isset($_GET["id"]) & isset($_GET["action"]))
{
    $id_accpengeluaranbarang		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $action			= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($id_accpengeluaranbarang != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `gx_acc_pengeluaran_barang` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'   WHERE (`id_acc_pengeluaran_barang`='".$id_accpengeluaranbarang."');";
	
	//echo $sql_update_lock;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: master_acc_pengeluaran_barang.php");

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
				    <a href="form_acc_pengeluaran_barang.php" class="btn bg-maroon btn-flat margin">Create New</a>
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
			<th>Kode ACC Pengeluaran Barang</th>
			<th>tanggal</th>
			<th>Cabang</th>
			<th>Nama Pemohon</th>
			<th>Divisi</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_acc_pengeluaran_barang` WHERE `level` =  '0' ORDER BY `id_acc_pengeluaran_barang` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_acc_pengeluaran_barang` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_acc_pengeluaran"].'</td>
			<td>'.$row_data["tanggal"].'</td>
			<td>'.$row_data["nama_cabang"].'</td>
			<td>'.$row_data["nama_pemohon"].'</td>
			<td>'.$row_data["nama_divisi"].'</td>
			<td>'.(($row_data["status"] == "1") ? '
					<a href="detail_acc_pengeluaran_barang?c='.$row_data["kode_acc_pengeluaran"].'"><span class="label label-info">Detail</span></a>'
			       :
				   '<a href="form_acc_pengeluaran_detail?c='.$row_data["kode_acc_pengeluaran"].'"><span class="label label-info">Detail</span></a>
					<a href="form_acc_pengeluaran_barang?id='.$row_data["id_acc_pengeluaran_barang"].'"><span class="label label-info">Edit</span></a>
					<a href="?id='.$row_data["id_acc_pengeluaran_barang"].'&action=lock"><span class="label label-info">Lock</span></a>
			    ').'
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
		<br style="clear:both;">
	     </div>
       </div>
	   </section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Acc Pengeluaran barang';
    $submenu	= "master_Acc_pengeluaran_barang";
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