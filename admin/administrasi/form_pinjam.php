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
require_once '../helpdesk/mailer/class.phpmailer.php';
require_once '../helpdesk/mailer/class.smtp.php';
require_once 'po_pdf.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    $kode_pinjam	= isset($_POST['kode_pinjam']) ? mysql_real_escape_string(trim($_POST['kode_pinjam'])) : '';
    $nama_pinjam	= isset($_POST['nama_staff']) ? mysql_real_escape_string(trim($_POST['nama_staff'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $gudang_pinjam	= isset($_POST['kode_gudang']) ? mysql_real_escape_string(trim($_POST['kode_gudang'])) : '';
    $nama_gudang	= isset($_POST['nama_gudang']) ? mysql_real_escape_string(trim($_POST['nama_gudang'])) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
	$id_staff		= isset($_POST['id_staff']) ? mysql_real_escape_string(trim($_POST['id_staff'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    
    
    if($kode_pinjam != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_pinjam_barang` (`id_pinjam`, `tanggal`, `kode_pinjam`,
	`nama_pinjam`, `gudang_pinjam`, `nama_gudang`, `keterangan`, `status`,
	`id_cabang`, `nama_cabang`, `id_staff`,
    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES (NULL, '".$tanggal."', '".$kode_pinjam."', '".$nama_pinjam."',
    '".$gudang_pinjam."', '".$nama_gudang."',  '".$keterangan."', '0',
	'".$id_cabang."', '".$nama_cabang."', '".$id_staff."',
    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";

    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
					    alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
					    window.history.go(-1);
					</script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"], "Insert data: ". $sql_insert);
    
    
    header("location: form_pinjam_detail.php?c=$kode_pinjam");
    /*echo "<script language='JavaScript'>
    alert('Data telah dikirim ke email ".$to."');
    window.location.href='form_pinjamdetail.php?c=".$kode_beli."';
    </script>";*/
    //echo 'Message has been sent.';
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
    
    
}


if(isset($_GET["id"]))
{
    $kode_beli		= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : '';
    $query_data 	= "SELECT * FROM `gx_pinjam_barang`
			    WHERE `kode_pinjam` = '".$kode_beli."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);

}

$sql_pinjam = mysql_fetch_array(mysql_query("SELECT * FROM `gx_pinjam_barang` ORDER BY `id_pinjam` DESC", $conn));
$last_data  = $sql_pinjam["id_pinjam"] + 1;
$tanggal    = date("ymd");
$kode_pinjam = 'PB'.$tanggal.''.sprintf("%04d", $last_data);


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Peminjaman Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="" role="form" name="form_pinjam" id="form_pinjam" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Peminjaman barang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_pinjam" value="'.(isset($_GET["id"]) ? $row_data["kode_pinjam"] : $kode_pinjam).'">
						<input type="hidden" readonly="" class="form-control" name="id_pinjam" value="'.(isset($_GET["id"]) ? $row_data["id_pinjam"] : "").'" >
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal"  value="'.(isset($_GET["id"]) ? $row_data["tanggal"] : date("Y-m-d")).'" >
					    </div>
					    
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["id"]) ? $row_data["nama_cabang"] : "").'"
						onclick="return valideopenerform(\'data_cabang.php?r=form_pinjam&f=pinjam\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET["id"]) ? $row_data["id_cabang"] : "").'" >
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Peminjam</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="nama_staff" value="'.(isset($_GET["id"]) ? $row_data["nama_pinjam"] : "").'"
						onclick="return valideopenerform(\'data_staff.php?r=form_pinjam&f=pinjam\',\'staff\');">
						<input type="hidden" readonly="" class="form-control" name="id_staff" value="'.(isset($_GET["id"]) ? $row_data["id_staff"] : "").'" >
					    
					    </div>
					    <div class="col-xs-3">
						<label>Gudang Peminjam</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_gudang" id="kode_gudang" value="'.(isset($_GET["id"]) ? $row_data["gudang_pinjam"] : "").'"
						onclick="return valideopenerform(\'data_gudang.php?r=form_pinjam&f=gudang\',\'gudang\');">
						<input type="hidden" class="form-control" readonly="" name="nama_gudang" id="nama_gudang" value="'.(isset($_GET["id"]) ? $row_data["nama_gudang"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-6">
						<textarea class="form-control" name="keterangan" style="resize:none;">'.(isset($_GET['id']) ? $row_data["keterangan"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   <div class="box-footer">
					<button type="submit" value="Submit" name="'.(isset($_GET['id']) ? "update" : "save").'" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Peminjaman Barang';
    $submenu	= "pinjam_barang";
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