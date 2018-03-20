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
$table_main = "gx_rekap_absensi";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id_rekap_absensi` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_rekap_absensi` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_rekap_absensi";
    $redirect_action_lock = "rekap_absensi.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Rekap Absensi";
    $judul_table = "detail rekap absensi";
    
    //id web
    $title_header = 'Detail Rekap Absensi';
    $submenu_header = 'detail_rekap_absensi';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Rekap Absensi");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['C']) ? mysql_real_escape_string(trim($_GET['C'])) : '';
    $sql_d = "SELECT * FROM `gx_rekap_absensi` WHERE `id_rekap`='$id_d' ORDER BY `id_rekap` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
	//$				= $data_d[''];
	//SELECT `id_rekap`, `bulan`, `kode`, `nama`, `tanggal`, `check_in`, `check_out`, `ket`, `menit_terlambat`, `menit_pulang_awal`, `jam_lembur`, `keterangan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_rekap_absensi` WHERE 1
	
	$bulan				= $data_d['bulan'];
	$kode				= $data_d['kode'];
	$nama				= $data_d['nama'];
	$tanggal			= $data_d['tanggal'];
	$check_in			= $data_d['check_in'];
	$check_out			= $data_d['check_out'];
	$ket				= $data_d['ket'];
	$menit_terlambat		= $data_d['menit_terlambat'];
	$menit_pulang_awal		= $data_d['menit_pulang_awal'];
	$jam_lembur			= $data_d['jam_lembur'];
	$keterangan			= $data_d['keterangan'];
	$status				= $data_d['status'];
	
	
	$date_add			= $data_d['date_add'];
	$date_upd			= $data_d['date_upd'];
	$level				= $data_d['level'];
	$user_add			= $data_d['user_add'];
	$user_upd			= $data_d['user_upd'];


  

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
                                    <!--<h3 class="box-title">'.$judul_table.'</h3>                                    -->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label><h4><b></b></h4></label>
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bulan</label>
					    </div>
					    <div class="col-xs-9">
						'.$bulan.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama.'
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
						<label>Check In </label>
					    </div>
					    <div class="col-xs-9">
						'.$check_in.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Check Out</label>
					    </div>
					    <div class="col-xs-9">
						'.$check_out.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Ket</label>
					    </div>
					    <div class="col-xs-9">
						'.$ket.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Menit Terlambat</label>
					    </div>
					    <div class="col-xs-9">
						'.$menit_terlambat.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Menit Pulang Awal</label>
					    </div>
					    <div class="col-xs-9">
						'.$menit_pulang_awal.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jam Lembur</label>
					    </div>
					    <div class="col-xs-9">
						'.$jam_lembur.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-9">
						'.$keterangan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Status</label>
					    </div>
					    <div class="col-xs-9">
						'.$status.'
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