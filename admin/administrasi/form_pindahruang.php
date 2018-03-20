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

if(isset($_POST["save"]))
{
    $kode_cabang	= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_cabang']))) : "";
    $kode_pindah	= isset($_POST['kode_pindah']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pindah']))) : "";
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
    $kode_ruang_awal	= isset($_POST['kode_ruang_awal']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_ruang_awal']))) : "";
    $nama_ruang_awal	= isset($_POST['nama_ruang_awal']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ruang_awal']))) : "";
    $kode_ruang_baru	= isset($_POST['kode_ruang_akhir']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_ruang_akhir']))) : "";
    $nama_ruang_baru	= isset($_POST['nama_ruang_akhir']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ruang_akhir']))) : "";
    
    
    if(($kode_pindah != NULL))
    {
	
	
	$insert_data	="INSERT INTO `gx_pindahruang` (`id_pindah`, `kode_pindah`, `kode_cabang`,
	`nama_cabang`, `tanggal`, `kode_ruang_awal`, `nama_ruang_awal`, `kode_ruang_baru`, `nama_ruang_baru`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_pindah."', '".$kode_cabang."', '".$nama_cabang."', '".$tanggal."',
	'".$kode_ruang_awal."', '".$nama_ruang_awal."', '".$kode_ruang_baru."', '".$nama_ruang_baru."',
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."','0')";
	//echo $insert_bank;
	mysql_query($insert_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data = ".mysql_real_escape_string($insert_data).".");
    }
    
    header ("location: form_pindahruang_detail.php?c=".$kode_pindah);
    
}elseif(isset($_POST["update"]))
{
    
//    $id_barang		= isset($_POST['id_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_barang']))) : "";
//    $id_cabang		= "";
//    //$id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
//    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
//    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
//    $satuan1		= isset($_POST['satuan1']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan1']))) : "";
//    $isi		= isset($_POST['isi']) ? mysql_real_escape_string(strip_tags(trim($_POST['isi']))) : "";
//    $satuan2		= isset($_POST['satuan2']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan2']))) : "";
//    $barcode		= isset($_POST['barcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['barcode']))) : "";
//    $reorder_stok	= isset($_POST['reorder_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['reorder_stok']))) : "";
//    $minimum_stok	= isset($_POST['minimum_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['minimum_stok']))) : "";
//    //$gambar		= isset($_POST['gambar']) ? mysql_real_escape_string(strip_tags(trim($_POST['gambar']))) : "";
//    $kategori		= isset($_POST['kategori']) ? mysql_real_escape_string(strip_tags(trim($_POST['kategori']))) : "";
//    $acc_biaya		= isset($_POST['acc_biaya']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_biaya']))) : "";
//    $acc_free		= isset($_POST['acc_free']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_free']))) : "";
//    $acc_inventaris	= isset($_POST['acc_inventaris']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_inventaris']))) : "";
//    
//    if(($id_barang != NULL))
//    {
//	
//	//echo $sql_gambar;
//	
//	$update_data   	= "UPDATE `gx_barang` SET ".$sql_gambar." `id_cabang`='".$id_cabang."', `kode_barang`='".$kode_barang."',
//	`nama_barang`='".$nama_barang."', `satuan1`='".$satuan1."', `isi`='".$isi."', `satuan2`='".$satuan2."',
//	`barcode`='".$barcode."', `reorder_stok`='".$reorder_stok."', `minimum_stok`='".$minimum_stok."', 
//	`kategori`='".$kategori."', `acc_biaya`='".$acc_biaya."', `acc_free`='".$acc_free."', `acc_inventaris`='".$acc_inventaris."',
//	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_barang`='".$id_barang."'";
//	
//	//echo $insert_bank;
//	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
//						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
//						   window.history.go(-1);
//					       </script>");
//	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
//    }
//    echo "<script language='JavaScript'>
//	    alert('Data telah disimpan!');
//	    location.href = 'master_barang.php';
//    </script>";
}

if(isset($_GET['id'])){
    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_pindahruang` WHERE `id_pindah` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    
    $sql_data_cabang	= "SELECT * FROM `gx_cabang` WHERE `kode_cabang` = '".$row_data["kode_cabang"]."';";
    $query_data_cabang	= mysql_query($sql_data_cabang, $conn);
    $row_data_cabang	= mysql_fetch_array($query_data_cabang);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form pindah ruang id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form pindah ruang");
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Pindah Ruang</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_pindah"  method="POST" action="" enctype="multipart/form-data">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  name="nama_cabang" id="nama_cabang" value="'.(isset($_GET["id"]) ? $row_data_cabang['nama_cabang'] :"").'"
						 onclick="return valideopenerform(\'data_cabang.php?r=form_pindah&f=pindah_ruang\',\'pindah\');" placeholder="Search Cabang">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" id="id_cabang" value="'.(isset($_GET["id"]) ? $row_data_cabang['id_cabang'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="tanggal" value="'.(isset($_GET["id"]) ? $row_data['tanggal'] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Pindah Ruang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" id="kode_pindah" name="kode_pindah" value="'.(isset($_GET["id"]) ? $row_data['kode_pindah'] :"").'">
						<input type="hidden" name="id_pindah" value="'.(isset($_GET["id"]) ? $row_data['id_pindah'] :"").'">
						
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    <div class="col-xs-3">
						<label>Ruang Awal</label>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="kode_ruang_awal" name="kode_ruang_awal"
						onclick="return valideopenerform(\'data_ruang.php?r=form_pindah&f=ruangawal\',\'ruang\');" placeholder="Search Ruang"
						value="'.(isset($_GET["id"]) ? $row_data['kode_ruang_awal'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<label>Nama Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="nama_ruang_awal" name="nama_ruang_awal"
						value="'.(isset($_GET["id"]) ? $row_data['nama_ruang_awal'] :"").'" placeholder="Nama Ruang">
					    </div>
					    
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">    
					    <div class="col-xs-3">
						<label>Pindah Ke Ruang</label>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="kode_ruang_baru" name="kode_ruang_akhir"
						onclick="return valideopenerform(\'data_ruang.php?r=form_pindah&f=ruangakhir\',\'ruang\');"
						value="'.(isset($_GET["id"]) ? $row_data['kode_ruang_baru'] :"").'" placeholder="Search Ruang">
					    </div>
					    <div class="col-xs-3">
						<label>Nama Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="nama_ruang_baru" placeholder="Nama Ruang"
						name="nama_ruang_akhir" value="'.(isset($_GET["id"]) ? $row_data['nama_ruang_baru'] :"").'">
					    </div>
					    
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id"]) ? "update" : "save") .'" value="Submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    
$plugins = '';

    $title	= 'Form Pindah Ruang';
    $submenu	= "pindah_ruang";
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