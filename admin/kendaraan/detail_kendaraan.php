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
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 

//String Data View
    //Judul Form
    $judul_form = "Detail Kendaraan";
    
    
    //Judul Table
    $judul_table = "Detail Kendaraan";
    
    
    //id web
    $title_header = 'Detail Kendaraan';
    $submenu_header = 'detail_kendaraan';
    
    
if($loggedin["group"] == 'admin'){
    
    $namafolder = "../upload/kendaraan/"; //folder tempat menyimpan file

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Kendaraan");
    global $conn;
    
    //SELECT `id`, `kode_kendaraan`, `kode_cabang`, `cabang`, `tanggal`, `no_kendaraan`, `nopol_kendaraan`, `nama_kendaraan`, `warna`, `merk`, `jenis_kendaraan`, `tahun_kendaraan`, `kode_gps`, `no_bpkb`, `upload_bpkb`, `stnk`, `upload_stnk`, `tanggal_jt_stnk`, `pajak_kendaraan`, `tanggal_perpanjangan_stnk`, `kir`, `upload_kir`, `tanggal_kir`, `kode_asuransi`, `nama_asuransi`, `nominal_asuransi`, `upload_asuransi`, `tanggal_jt_asuransi`, `penanggung_jawab`, `setting_reminder`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kendaraan_master` WHERE 1
    
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_kendaraan_master` WHERE `kode_kendaraan`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
	
	
	$kode_cabang = $data_d['kode_cabang'];
	$cabang = $data_d['cabang'];
	$tanggal = $data_d['tanggal'];
	$no_kendaraan = $data_d['no_kendaraan'];
	$nopol_kendaraan = $data_d['nopol_kendaraan'];
	$nama_kendaraan = $data_d['nama_kendaraan'];
	$warna = $data_d['warna'];
	$merk = $data_d['merk'];
	$jenis_kendaraan = $data_d['jenis_kendaraan'];
	$tahun_kendaraan = $data_d['tahun_kendaraan'];
	$kode_gps = $data_d['kode_gps'];
	$no_bpkb = $data_d['no_bpkb'];
	$upload_bpkb = $data_d['upload_bpkb'];
	$stnk = $data_d['stnk'];
	$upload_stnk = $data_d['upload_stnk'];
	$tanggal_jt_stnk = $data_d['tanggal_jt_stnk'];
	$pajak_kendaraan = $data_d['pajak_kendaraan'];
	$tanggal_perpanjangan_stnk = $data_d['tanggal_perpanjangan_stnk'];
	$kir = $data_d['kir'];
	$upload_kir = $data_d['upload_kir'];
	$tanggal_kir = $data_d['tanggal_kir'];
	$kode_asuransi = $data_d['kode_asuransi'];
	$nama_asuransi = $data_d['nama_asuransi'];
	$nominal_asuransi = $data_d['nominal_asuransi'];
	$upload_asuransi = $data_d['upload_asuransi'];
	$tanggal_jt_asuransi = $data_d['tanggal_jt_asuransi'];
	$penanggung_jawab = $data_d['penanggung_jawab'];
	$setting_reminder = $data_d['setting_reminder'];
	$status = $data_d['status'];
	$date_add = $data_d['date_add'];
	$date_upd = $data_d['date_upd'];
	$user_add = $data_d['user_add'];
	$user_upd = $data_d['user_upd'];
	
$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		     

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$judul_table.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Cabang</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_cabang.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-9">
						'.$cabang.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nopol Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$nopol_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Warna</label>
					    </div>
					    <div class="col-xs-9">
						'.$warna.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Merk</label>
					    </div>
					    <div class="col-xs-9">
						'.$merk.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jenis Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$jenis_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tahun Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$tahun_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode GPS</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_gps.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No BPKB</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_bpkb.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Foto BPKB</label>
					    </div>
					    <div class="col-xs-9">
						<img src="'.$namafolder.$upload_bpkb.'" width="100px">
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>STNK</label>
					    </div>
					    <div class="col-xs-9">
						'.$stnk.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Foto STNK</label>
					    </div>
					    <div class="col-xs-9">
						<img src="'.$namafolder.$upload_stnk.'" width="100px">
					    </div>
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal JT STNK</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal_jt_stnk.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pajak Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$pajak_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Perpanjangan STNK</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal_perpanjangan_stnk.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>KIR</label>
					    </div>
					    <div class="col-xs-9">
						'.$kir.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Foto KIR</label>
					    </div>
					    <div class="col-xs-9">
						<img src="'.$namafolder.$upload_kir.'" width="100px">
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal KIR</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal_kir.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Asuransi</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_asuransi.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Asuransi</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_asuransi.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nominal Asuransi</label>
					    </div>
					    <div class="col-xs-9">
						'.$nominal_asuransi.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Foto Asuransi</label>
					    </div>
					    <div class="col-xs-9">
					    <img src="'.$namafolder.$upload_asuransi.'" width="100px">
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal JT Asuransi</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal_jt_asuransi.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Penanggung Jawab</label>
					    </div>
					    <div class="col-xs-9">
						'.$penanggung_jawab.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setting Reminder</label>
					    </div>
					    <div class="col-xs-9">
						'.$setting_reminder.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Date Add</label>
					    </div>
					    <div class="col-xs-9">
						'.$date_add.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Date Update</label>
					    </div>
					    <div class="col-xs-9">
						'.$date_upd.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User Add</label>
					    </div>
					    <div class="col-xs-9">
						'.$user_add.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User Update</label>
					    </div>
					    <div class="col-xs-9">
						'.$user_upd.'
					    </div>
					    
                                        </div>
				    </div>



</div>
            </div>
	   
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>