<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

//SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang`
//INSERT INTO `gx_pengeluaran_barang`(`id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24])
//UPDATE `gx_pengeluaran_barang` SET `id_pengeluaran_barang`=[value-1],`kode_pengeluaran`=[value-2],`kode_acc_permintaaan`=[value-3],`nama_pemohon`=[value-4],`nama_cabang`=[value-5],`divisi`=[value-6],`nama_acc`=[value-7],`kode_barang`=[value-8],`nama_barang`=[value-9],`serial_number`=[value-10],`quantitiy`=[value-11],`lemari`=[value-12],`check_list`=[value-13],`no_link_budget`=[value-14],`nama_teknisi`=[value-15],`kode_customer`=[value-16],`nama_customer`=[value-17],`tanggal`=[value-18],`status`=[value-19],`user_add`=[value-20],`user_upd`=[value-21],`date_add`=[value-22],`date_upd`=[value-23],`level`=[value-24] WHERE 1
//DELETE FROM `gx_pengeluaran_barang` WHERE 1

include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Acc Pengeluaran Barang");
    global $conn;
    
if(isset($_GET["id"]) & isset($_GET["action"]))
{
    $id_pengeluaranbarang		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $action				= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($id_pengeluaranbarang != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `gx_pengeluaran_barang` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'   WHERE (`id_pengeluaran_barang`='".$id_pengeluaranbarang."');";
	
	//echo $sql_update_lock;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: master_pengeluaran_barang.php");

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
				    <a href="form_pengeluaran_barang.php" class="btn bg-maroon btn-flat margin">Create New in ACC</a>
				    <a href="form_pengeluaran_barang_customer.php" class="btn bg-maroon btn-flat margin">Create New in Customer</a>
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
			<th>No. Pengeluaran Stock</th>
			<th>Tanggal</th>
			<th>No. ACC Permintaan Barang</th>
			<th>Nama Pemohon</th>
			<th>Divisi</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_pengeluaran_barang` WHERE `level` =  '0' ORDER BY `id_pengeluaran_barang` DESC LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_pengeluaran_barang` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_pengeluaran"].'</td>
			<td>'.$row_data["tanggal"].'</td>
			<td>'.$row_data["kode_acc_permintaan"].'</td>
			<td>'.$row_data["nama_pemohon"].'</td>
			<td>'.$row_data["nama_divisi"].'</td>
			<td>'.(($row_data["status"] == "1") ? '
					<a href="detail_pengeluaran_barang?c='.$row_data["kode_pengeluaran"].'"><span class="label label-info">Detail</span></a>'
			       :
				   '<a href="form_pengeluaran_detail?c='.$row_data["kode_pengeluaran"].'"><span class="label label-info">Detail</span></a>
					<a href="form_pengeluaran_barang?id='.$row_data["id_pengeluaran_barang"].'"><span class="label label-info">Edit</span></a>
					<a href="?id='.$row_data["id_pengeluaran_barang"].'&action=lock"><span class="label label-info">Lock</span></a>
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