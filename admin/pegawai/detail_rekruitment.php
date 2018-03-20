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
 
//SQL 
$table_main = "gx_rekruitment";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_rekruitment` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_rekruitment";
    $redirect_action_lock = "rekruitment.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Rekruitment";
    $judul_table = "detail Rekruitment";
    
    //id web
    $title_header = 'Detail Rekruitment';
    $submenu_header = 'rekruitment';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Rekruitment");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_rekruitment` WHERE `id_rekruitment`='$id_d' ORDER BY `id_rekruitment` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
	//$				= $data_d[''];
	//SELECT `id`, `id_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
	$no_rekruitment			= $data_d['no_rekruitment'];
	$nama_calon_pegawai		= $data_d['nama_calon_pegawai'];
	$alamat				= $data_d['alamat'];
	$no_telp			= $data_d['no_telp'];
	$bagian_yang_diinginkan		= $data_d['bagian_yang_diinginkan'];
	$informasi_lamaran		= $data_d['informasi_lamaran'];
	$pendidikan_terakhir		= $data_d['pendidikan_terakhir'];
	$nama_sekolah_terakhir		= $data_d['nama_sekolah_terakhir'];
	$jurusan			= $data_d['jurusan'];
	$tahun_lulus			= $data_d['tahun_lulus'];
	$nilai_ipk			= $data_d['nilai_ipk'];
	$pengalaman_kerja		= $data_d['pengalaman_kerja'];
	$nama_perusahaan		= $data_d['nama_perusahaan'];
	$jabatan			= $data_d['jabatan'];
	$lama				= $data_d['lama'];
	$gaji_yang_diinginkan		= $data_d['gaji_yang_diinginkan'];
	$motivasi_kerja			= $data_d['motivasi_kerja'];
	
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
	$user_add			= $data_d['user_add'];
	$user_update			= $data_d['user_upd'];


  

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
						<label>No Rekruitment</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_rekruitment.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Calon Pegawai</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_calon_pegawai.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
						'.$alamat.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Telp</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_telp.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bagian yang diinginkan</label>
					    </div>
					    <div class="col-xs-9">
						'.$bagian_yang_diinginkan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Informasi Lamaran</label>
					    </div>
					    <div class="col-xs-9">
						'.$informasi_lamaran.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pendidikan Terakhir</label>
					    </div>
					    <div class="col-xs-9">
						'.$pendidikan_terakhir.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Sekolah Terakhir</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_sekolah_terakhir.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jurusan</label>
					    </div>
					    <div class="col-xs-9">
						'.$jurusan.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tahun Lulus</label>
					    </div>
					    <div class="col-xs-9">
						'.$tahun_lulus.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nilai IPK</label>
					    </div>
					    <div class="col-xs-9">
						'.$nilai_ipk.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pengalaman Kerja</label>
					    </div>
					    <div class="col-xs-9">
						'.$pengalaman_kerja.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-1"></div>
					    <div class="col-xs-2">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_perusahaan.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-1"></div>
					    <div class="col-xs-2">
						<label>Jabatan</label>
					    </div>
					    <div class="col-xs-9">
						'.$jabatan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-1"></div>
					    <div class="col-xs-2">
						<label>Lama</label>
					    </div>
					    <div class="col-xs-9">
						'.$lama.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Gaji yang diinginkan</label>
					    </div>
					    <div class="col-xs-9">
						'.$gaji_yang_diinginkan.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Motivasi Kerja</label>
					    </div>
					    <div class="col-xs-9">
						'.$motivasi_kerja.'
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
						'.$user_update.'
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
						'.$date_update.'
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