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
    $kode_divisi					= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi					= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $nama_acc						= isset($_POST['nama_acc']) ? mysql_real_escape_string(trim($_POST['nama_acc'])) : '';
    $kode_barang					= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang					= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number					= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    $quantity						= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $kode_lemari					= isset($_POST['kode_lemari']) ? mysql_real_escape_string(trim($_POST['kode_lemari'])) : '';
    $nama_lemari					= isset($_POST['nama_lemari']) ? mysql_real_escape_string(trim($_POST['nama_lemari'])) : '';
    $check_list						= isset($_POST['check_list']) ? mysql_real_escape_string(trim($_POST['check_list'])) : '';
    $no_link_budget					= isset($_POST['no_link_budget']) ? mysql_real_escape_string(trim($_POST['no_link_budget'])) : '';
    $nama_teknisi					= isset($_POST['nama_teknisi']) ? mysql_real_escape_string(trim($_POST['nama_teknisi'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : date("Y-m-d");
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '0';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '0';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '0';
    
    if($kode_pengeluaran != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_pengeluaran_barang`(`id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaan`, `nama_pemohon`, `nama_cabang`, `kode_divisi`, `nama_divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `kode_lemari`, `nama_lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES (NULL,'$kode_pengeluaran','$kode_acc_permintaan','$nama_pemohon','$nama_cabang','$kode_divisi','$nama_divisi','$nama_acc','$kode_barang','$nama_barang','$serial_number','$quantity','$kode_lemari','$nama_lemari', '$check_list', '$no_link_budget', '$nama_teknisi', '$kode_customer', '$nama_customer', '$tanggal', '$status', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0')";
    
    /*INSERT INTO `gx_pengeluaran_barang`(`id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES (NULL,'$kode_pengeluaran','$kode_acc_permintaan','$nama_pemohon','$nama_cabang','$nama_divisi','$nama_acc','$kode_barang', '$nama_barang', '$serial_number', '$quantity', '$lemari', '$check_list', '$no_link_budget', '$nama_teknisi', '$kode_customer', '$nama_customer', '$tanggal', '$status', NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0')*/
    
    /*INSERT INTO `gx_pengeluaran_barang`(`id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaan`, `nama_pemohon`, `nama_cabang`, `kode_divisi`, `nama_divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES (NULL,'$kode_pengeluaran','$kode_acc_permintaan','$nama_pemohon','$nama_cabang','$kode_divisi','$nama_divisi','$nama_acc','$kode_barang','$nama_barang','$serial_number','$quantity','$lemari', '$check_list', '$no_link_budget', '$nama_teknisi', '$kode_customer', '$nama_customer', '$tanggal', '$status', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0')*/
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='form_pengeluaran_detail.php?c=$kode_pengeluaran&id=$id_insert';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_pengeluaran_barang				= isset($_POST['id_pengeluaran_barang']) ? mysql_real_escape_string(trim($_POST['id_pengeluaran_barang'])) : '';
    $kode_pengeluaran					= isset($_POST['kode_pengeluaran']) ? mysql_real_escape_string(trim($_POST['kode_pengeluaran'])) : '';
    $kode_acc_permintaan				= isset($_POST['kode_acc_permintaan']) ? mysql_real_escape_string(trim($_POST['kode_acc_permintaan'])) : '';
    $nama_pemohon					= isset($_POST['nama_pemohon']) ? mysql_real_escape_string(trim($_POST['nama_pemohon'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $kode_divisi					= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi					= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $nama_acc						= isset($_POST['nama_acc']) ? mysql_real_escape_string(trim($_POST['nama_acc'])) : '';
    $kode_barang					= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $serial_number					= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    $quantity						= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $lemari						= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
    $check_list						= isset($_POST['check_list']) ? mysql_real_escape_string(trim($_POST['check_list'])) : '';
    $no_link_budget					= isset($_POST['no_link_budget']) ? mysql_real_escape_string(trim($_POST['no_link_budget'])) : '';
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
	/*$sql_update = "UPDATE `gx_pengeluaran_barang`	SET `divisi`='".$divisi."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_pengeluaran`='".$kode_pengeluaran."';";*/
	
	//UPDATE INTO GX PENGELUARAN
	$sql_update = "UPDATE `gx_pengeluaran_barang` SET `kode_pengeluaran`='".$kode_pengeluaran."',
	`kode_acc_permintaan`='".$kode_acc_permintaan."',`nama_pemohon`='".$nama_pemohon."',`nama_cabang`='".$nama_cabang."',
	`kode_divisi`='".$kode_divisi."',`nama_divisi`='".$nama_divisi."',`nama_acc`='".$nama_acc."',`kode_lemari`='".$kode_lemari."',
	`nama_lemari`='".$nama_lemari."',`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	WHERE `id_pengeluaran_barang`='".$id_pengeluaran_barang."'";
	
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='master_pengeluaran_barang';
	    </script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["id"]))
{
    $id_pengeluaran_barang	= isset($_GET['id']) ? $_GET['id'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query_pengeluaran_barang 	= "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaan`, `nama_pemohon`, `nama_cabang`, `kode_divisi`, `nama_divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE  `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1"; 
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
                                    <h3 class="box-title">Data Pengeluaran Barang</h3>
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
						<input type="text" readonly="" class="form-control" required="" name="kode_pengeluaran" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["kode_pengeluaran"] : "").'" onclick="return valideopenerform(\'data_pengeluaran.php?r=form_pengeluaran_barang&f=pengeluaran_barang\',\'pengeluaran\');">
						<input type="hidden" readonly="" class="form-control" required="" name="id_pengeluaran_barang" value="'.(isset($_GET['id']) ? $_GET["id"] : "").'">
						
					    </div>';
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No ACC Permintaan Barang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_acc_permintaan" id="kode_acc_permintaan" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["kode_acc_permintaan"] : '').'" onclick="return valideopenerform(\'data_acc_permintaan_barang.php?r=form_pengeluaran_barang&f=acc_pengeluaran\',\'acc_pengeluaran\');">
						<input type="hidden" name="kode_cabang">
						<input type="hidden" name="nama_cabang">
					    </div>

					    <div class="col-xs-2">
						<label>Nama Pemohon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" readonly="" required="" name="nama_pemohon" id="nama_pemohon" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["nama_pemohon"] : $loggedin["username"]).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control"  required="" name="kode_divisi" id="kode_divisi" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["kode_divisi"] : '').'">
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["nama_divisi"] : '').'">
					    </div>
					    
					    
					    <div class="col-xs-2">
						<label>Nama ACC</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="nama_acc" id="nama_acc" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["nama_acc"] : '').'"  >
					    </div>
					</div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Lemari</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control"  required="" name="kode_lemari" id="kode_lemari" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["kode_lemari"] : '').'">
						<input type="text" readonly="" class="form-control"  required="" name="nama_lemari" id="nama_lemari" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["nama_lemari"] : '').'" onclick="return valideopenerform(\'data_lemari.php?r=form_pengeluaran_barang&f=lemari\',\'lemari\');">
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