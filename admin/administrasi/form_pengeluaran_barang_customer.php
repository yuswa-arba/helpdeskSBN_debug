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

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $kode_pengeluaran					= isset($_POST['kode_pengeluaran']) ? mysql_real_escape_string(trim($_POST['kode_pengeluaran'])) : '';
    $kode_acc_permintaan				= isset($_POST['kode_acc_permintaan']) ? mysql_real_escape_string(trim($_POST['kode_acc_permintaan'])) : '';
    $nama_pemohon					= isset($_POST['nama_pemohon']) ? mysql_real_escape_string(trim($_POST['nama_pemohon'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $divisi						= isset($_POST['divisi']) ? mysql_real_escape_string(trim($_POST['divisi'])) : '';
    $nama_acc						= isset($_POST['nama_acc']) ? mysql_real_escape_string(trim($_POST['nama_acc'])) : '';
    $kode_barang					= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang					= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number					= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    $quantity						= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $lemari						= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
    $check_list						= isset($_POST['check_list']) ? mysql_real_escape_string(trim($_POST['check_list'])) : '';
    $no_link_budget					= isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
    $nama_teknisi					= isset($_POST['nama_teknisi']) ? mysql_real_escape_string(trim($_POST['nama_teknisi'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    
    
    if($kode_pengeluaran != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_pengeluaran_barang`(`id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES (NULL,'$kode_pengeluaran','$kode_acc_permintaan','$nama_pemohon','$nama_cabang','$divisi','$nama_acc','$kode_barang', '$nama_barang', '$serial_number', '$quantity', '$lemari', '$check_list', '$no_link_budget', '$nama_teknisi', '$kode_customer', '$nama_customer', '$tanggal', '$status', NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0')";
    
    //echo $sql_insert."<br>";

    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='form_pengeluaran_detail_customer.php?c=$kode_pengeluaran';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $kode_pengeluaran					= isset($_POST['kode_pengeluaran']) ? mysql_real_escape_string(trim($_POST['kode_pengeluaran'])) : '';
    $kode_acc_permintaan				= isset($_POST['kode_acc_permintaan']) ? mysql_real_escape_string(trim($_POST['kode_acc_permintaan'])) : '';
    $nama_pemohon					= isset($_POST['nama_pemohon']) ? mysql_real_escape_string(trim($_POST['nama_pemohon'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $divisi						= isset($_POST['divisi']) ? mysql_real_escape_string(trim($_POST['divisi'])) : '';
    $nama_acc						= isset($_POST['nama_acc']) ? mysql_real_escape_string(trim($_POST['nama_acc'])) : '';
    $kode_barang					= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $serial_number					= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    $quantity						= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $lemari						= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
    $check_list						= isset($_POST['check_list']) ? mysql_real_escape_string(trim($_POST['check_list'])) : '';
    $no_link_budget					= isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
    $nama_teknisi					= isset($_POST['nama_teknisi']) ? mysql_real_escape_string(trim($_POST['nama_teknisi'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    
    
    
    if($kode_pengeluaran != ""){
	   /* "UPDATE `gx_pengeluaran_barang` SET `id_pengeluaran_barang`=[value-1],`kode_pengeluaran`=[value-2],`kode_acc_permintaaan`=[value-3],
	`nama_pemohon`=[value-4],`nama_cabang`=[value-5],`divisi`=[value-6],`nama_acc`=[value-7],`kode_barang`=[value-8],`nama_barang`=[value-9],
	`serial_number`=[value-10],`quantitiy`=[value-11],`lemari`=[value-12],`check_list`=[value-13],`no_link_budget`=[value-14],`nama_teknisi`=[value-15],
	`kode_customer`=[value-16],`nama_customer`=[value-17],`tanggal`=[value-18],`status`=[value-19],`user_add`=[value-20],`user_upd`=[value-21],
	`date_add`=[value-22],`date_upd`=[value-23],`level`=[value-24] WHERE 1"; */
	
	//Update into cc_subscription_service
	$sql_update = "UPDATE `gx_pengeluaran_barang`	SET `divisi`='".$divisi."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_pengeluaran`='".$kode_pengeluaran."';";
	
	
	//echo $sql_update;
	echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
       
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='master_pembelian';
	    </script>";
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["id"]))
{
    $id_pengeluaran_barang	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_pengeluaran_barang 	= "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";
    $sql_pengeluaran_barang	= mysql_query($query_pengeluaran_barang, $conn);
    $row_pengeluaran_barang	= mysql_fetch_array($sql_pengeluaran_barang);

}

    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Permintaan Pengeluaran Barang</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_pengeluaran_barang" id="form_pengeluaran_barang" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">';
				    $content.=' <div class="col-xs-2">
						<label>No. Pengeluaran Stock</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_pengeluaran" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_pengeluaran"] : "").'"
						onclick="return valideopenerform(\'data_pengeluaran.php?r=form_pengeluaran_barang&f=pengeluaran_barang\',\'pengeluaran\');">
						<input type="hidden" readonly="" class="form-control" required="" name="id_pengeluaran_barang" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["no_pengeluaran"] : "").'">
						
					    </div>';
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Link Budget</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="id_linkbudget" id="id_linkbudget" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_permintaan_barang"] : '').'"
						onclick="return valideopenerform(\'data_linkbudget.php?r=form_pengeluaran_barang_customer\',\'pengeluaran\');" >
						<input type="hidden" class="form-control" name="id_linkbudget" >
					    </div>

					    <div class="col-xs-2">
						<label>Nama Teknisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" readonly="" required="" name="nama_teknisi" id="nama_teknisi" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["nama_teknisi"] : $loggedin["username"]).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control"  required="" name="kode_divisi" id="kode_divisi" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_divisi"] : '').'"  onclick="return valideopenerform(\'data_cust.php?r=form_pengeluaran_barang&f=pengeluaran\',\'customer\');">
						<input type="text" readonly="" class="form-control"  required="" name="kode_customer" id="kode_customer" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_customer"] : '').'"  onclick="return valideopenerform(\'data_cust.php?r=form_pengeluaran_barang&f=pengeluaran\',\'customer\');">
					    </div>
					    
					    
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="nama_customer" id="nama_customer" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["nama_customer"] : '').'"  onclick="return valideopenerform(\'data_customer.php?r=form_pengeluaran_barang2&f=pengeluaran\',\'nama_customer\');">
					    </div>

                    </div>
					</div>

					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= 'Form Permintaan Pengeluaran Barang';
    $submenu	= "Penjualan";
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