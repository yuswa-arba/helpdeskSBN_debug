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
$table_main = "gx_master_kenaikan_gaji";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_master_kenaikan_gaji` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_master_kenaikan_gaji";
    $redirect_action_lock = "master_kenaikan_gaji.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Kenaikan Gaji";
    $judul_table = "detail Kenaikan Gaji";
    
    //id web
    $title_header = 'Detail Kenaikan Gaji';
    $submenu_header = 'detail_kenaikan_gaji';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Kenaikan Gaji");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_master_kenaikan_gaji` WHERE `id_kenaikan_gaji`='$id_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
	//$				= $data_d[''];
	//SELECT `id`, `id_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
	$no_kenaikan_gaji		= $data_d['no_kenaikan_gaji'];
	$kode				= $data_d['kode'];
	$tanggal			= $data_d['tanggal'];
	$nama				= $data_d['nama'];
	$kenaikan_ke			= $data_d['kenaikan_ke'];
	$level_gaji			= $data_d['level_gaji'];
	$selisih			= $data_d['selisih'];
	$gaji_pokok_lama		= $data_d['gaji_pokok_lama'];
	$gaji_pokok_naik		= $data_d['gaji_pokok_naik'];
	$tunjangan_jabatan_lama		= $data_d['tunjangan_jabatan_lama'];
	$tunjangan_jabatan_naik		= $data_d['tunjangan_jabatan_naik'];
	$dana_pensiun_lama		= $data_d['dana_pensiun_lama'];
	$dana_pensiun_naik		= $data_d['dana_pensiun_naik'];
	$jamsostek_lama			= $data_d['jamsostek_lama'];
	$jamsostek_naik			= $data_d['jamsostek_naik'];
	$insentif_hadir_lama		= $data_d['insentif_hadir_lama'];
	$insentif_hadir_naik		= $data_d['insentif_hadir_naik'];
	$total_gaji_lama		= $data_d['total_gaji_lama'];
	$total_gaji_naik		= $data_d['total_gaji_naik'];
	
	$remarks			= $data_d['remarks'];
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
	$level				= $data_d['level'];
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
						<label>No Kenaikan Gaji</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_kenaikan_gaji.'
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
						<label>Kenaikan Ke</label>
					    </div>
					    <div class="col-xs-9">
						'.$kenaikan_ke.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Level Gaji</label>
					    </div>
					    <div class="col-xs-9">
						'.$level_gaji.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Selisih</label>
					    </div>
					    <div class="col-xs-9">
						'.$selisih.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Gaji Pokok</label>
					    </div>
					    <div class="col-xs-9">
						'.$gaji_pokok_lama.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tunjangan Jabatan</label>
					    </div>
					    <div class="col-xs-9">
						'.$tunjangan_jabatan_lama.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Dana Pensiun</label>
					    </div>
					    <div class="col-xs-9">
						'.$dana_pensiun_lama.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jamsostek</label>
					    </div>
					    <div class="col-xs-9">
						'.$jamsostek_lama.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Insentif Hadir</label>
					    </div>
					    <div class="col-xs-9">
						'.$insentif_hadir_lama.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Gaji</label>
					    </div>
					    <div class="col-xs-9">
						'.$total_gaji_lama.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Gaji Pokok</label>
					    </div>
					    <div class="col-xs-9">
						'.$gaji_pokok_naik.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tunjangan Jabatan</label>
					    </div>
					    <div class="col-xs-9">
						'.$tunjangan_jabatan_naik.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Dana Pensiun</label>
					    </div>
					    <div class="col-xs-9">
						'.$dana_pensiun_naik.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jamsostek</label>
					    </div>
					    <div class="col-xs-9">
						'.$jamsostek_naik.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Insentif Hadir</label>
					    </div>
					    <div class="col-xs-9">
						'.$insentif_hadir_naik.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Gaji</label>
					    </div>
					    <div class="col-xs-9">
						'.$total_gaji_naik.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
					    </div>
					    <div class="col-xs-9">
						'.$remarks.'
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