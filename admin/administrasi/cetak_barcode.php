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
   
    //$id_cabang	= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
    $barcode		= isset($_POST['barcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['barcode']))) : "";
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
    $no_sebelumnya	= isset($_POST['no_sebelumnya']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_sebelumnya']))) : "";
    $qty		= isset($_POST['qty']) ? mysql_real_escape_string(strip_tags(trim($_POST['qty']))) : "";
    $no_terakhir	= isset($_POST['no_terakhir']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_terakhir']))) : "";

    if(($kode_barang != "") AND ($nama_barang != ""))
    {
	
	$insert_data	= "INSERT INTO `gx_cetak_barcode` (`id_cetak`, `tanggal`, `kode_barang`,
	`nama_barang`, `barcode`, `no_sebelumnya`, `qty`, `no_terakhir`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$tanggal."', '".$kode_barang."', '".$nama_barang."', '".$barcode."',
	'".$no_sebelumnya."', '".$qty."', '".$no_terakhir."',
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."','0')";
	//echo $insert_data;
	
	$query_insert = mysql_query($insert_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	 
	 //$id = mysql_insert_id();
	 
	 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data = ".mysql_real_escape_string($insert_data).".");
    }
$array_id = mysql_fetch_assoc(mysql_query("SELECT `id_cetak` FROM `gx_cetak_barcode` WHERE `level`='0' ORDER BY `id_cetak` DESC LIMIT 1", $conn));   
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'form_detail_qrcode.php?id=".$array_id['id_cetak']."';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    /*$id_barang		= isset($_POST['id_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_barang']))) : "";
    $id_cabang		= "";
    //$id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
    $satuan1		= isset($_POST['satuan1']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan1']))) : "";
    $isi		= isset($_POST['isi']) ? mysql_real_escape_string(strip_tags(trim($_POST['isi']))) : "";
    $satuan2		= isset($_POST['satuan2']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan2']))) : "";
    $barcode		= isset($_POST['barcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['barcode']))) : "";
    $reorder_stok	= isset($_POST['reorder_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['reorder_stok']))) : "";
    $minimum_stok	= isset($_POST['minimum_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['minimum_stok']))) : "";
    //$gambar		= isset($_POST['gambar']) ? mysql_real_escape_string(strip_tags(trim($_POST['gambar']))) : "";
    $kategori		= isset($_POST['kategori']) ? mysql_real_escape_string(strip_tags(trim($_POST['kategori']))) : "";
    $acc_biaya		= isset($_POST['acc_biaya']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_biaya']))) : "";
    $acc_free		= isset($_POST['acc_free']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_free']))) : "";
    $acc_inventaris	= isset($_POST['acc_inventaris']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_inventaris']))) : "";
    
    if(($id_barang != NULL))
    {
	$update_data   	= "UPDATE `gx_barang` SET ".$sql_gambar." `id_cabang`='".$id_cabang."', `kode_barang`='".$kode_barang."',
	`nama_barang`='".$nama_barang."', `satuan1`='".$satuan1."', `isi`='".$isi."', `satuan2`='".$satuan2."',
	`barcode`='".$barcode."', `reorder_stok`='".$reorder_stok."', `minimum_stok`='".$minimum_stok."', 
	`kategori`='".$kategori."', `acc_biaya`='".$acc_biaya."', `acc_free`='".$acc_free."', `acc_inventaris`='".$acc_inventaris."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_barang`='".$id_barang."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_barang.php';
    </script>";*/
}

if(isset($_GET['id'])){
    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_barang` WHERE `id_barang` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    
    $sql_data_cabang	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$row_data["id_cabang"]."';";
    $query_data_cabang	= mysql_query($sql_data_cabang, $conn);
    $row_data_cabang	= mysql_fetch_array($query_data_cabang);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update cetak barcode id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "open cetak barcode");
}
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Cetak Barcode</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="cetak_barcode"  method="POST" action="" enctype="multipart/form-data">
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control"  name="tanggal" id="tanggal" value="'.(isset($_GET["id"]) ? $row_data["tanggal"] : date("Y-m-d")).'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control"  name="nama_cabang" id="nama_cabang" value="'.(isset($_GET["id"]) ? $row_data_cabang['nama_cabang'] :"").'" onclick="return valideopenerform(\'data_cabang.php?r=cetak_barcode&f=cetak\',\'cetakbarcode\');">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" id="id_cabang" value="'.(isset($_GET["id"]) ? $row_data_cabang['id_cabang'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" id="kode_barang" name="kode_barang" value="'.(isset($_GET["id"]) ? $row_data['kode_barang'] :"").'"
						onclick="return valideopenerform(\'data_barang.php?r=cetak_barcode&f=cetak\',\'cetakbarcode\');">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="nama_barang" value="'.(isset($_GET["id"]) ? $row_data['nama_barang'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Barcode Barang</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="barcode" value="'.(isset($_GET["id"]) ? $row_data["barcode"] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>No Sebelumnya</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_sebelumnya" value="'.(isset($_GET["id"]) ? $row_data["no_sebelumnya"] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Qty</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="qty" value="'.(isset($_GET["id"]) ? $row_data["qty"] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>No Terakhir</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_terakhir" value="'.(isset($_GET["id"]) ? $row_data["no_terakhir"] :"").'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Created By:</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['user_add'] : $loggedin["username"]).'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>last Updated By:</label>
					    </div>
					    <div class="col-xs-9">
						'.(isset($_GET["id"]) ? $row_data['user_upd'].' ( '.$row_data['date_upd'].' )' : "").'
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
	    
$plugins = '';

    $title	= 'Cetak Barcode';
    $submenu	= "cetak_barcode";
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