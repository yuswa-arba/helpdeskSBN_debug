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
$table_main = "gx_setting_gaji_karyawan";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id_setting_gaji_karyawan` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_setting_gaji_karyawan` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_setting_gaji_karyawan";
    $redirect_action_lock = "setting_gaji.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Setting Gaji";
    $judul_table = "detail setting gaji";
    
    //id web
    $title_header = 'Detail Setting Gaji';
    $submenu_header = 'detail_setting_gaji';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Setting Gaji");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['C']) ? mysql_real_escape_string(trim($_GET['C'])) : '';
    $sql_d = "SELECT * FROM `gx_setting_gaji_karyawan` WHERE  `id_setting_gaji_karyawan`='$id_d' ORDER BY `id_setting_gaji_karyawan` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
	//$				= $data_d[''];
	//SELECT `id`, `id_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
	
	$kode				= $data_d['kode'];
	$nama				= $data_d['nama'];
	$level_setting			= $data_d['level_setting'];
	$gaji_pokok			= $data_d['gaji_pokok'];
	$tunjangan_jabatan		= $data_d['tunjangan_jabatan'];
	$dana_pensiun			= $data_d['dana_pensiun'];
	$jamsostek			= $data_d['jamsostek'];
	$insentif_hadir			= $data_d['insentif_hadir'];
	$total_gaji			= $data_d['total_gaji'];
	$total_gaji_diterima		= $data_d['total_gaji_diterima'];
	$koperasi			= $data_d['koperasi'];
	
	
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
	$level				= $data_d['level'];
	$user_add			= $data_d['user_add'];
	$user_update			= $data_d['user_upd'];


  

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>'.$judul_form.'</h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		     

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <!--<h3 class="box-title">'.$judul_table.'</h3>-->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label><h4><b>'.$judul_table.'</b></h4></label>
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>KODE</label>
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
						<label>Level Setting</label>
					    </div>
					    <div class="col-xs-9">
						'.$level_setting.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Gaji Pokok</label>
					    </div>
					    <div class="col-xs-9">
						'.$gaji_pokok.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tunjangan Jabatan</label>
					    </div>
					    <div class="col-xs-9">
						'.$tunjangan_jabatan.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Dana Pensiun</label>
					    </div>
					    <div class="col-xs-9">
						'.$dana_pensiun.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jamsostek</label>
					    </div>
					    <div class="col-xs-9">
						'.$jamsostek.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Insentif Hadir</label>
					    </div>
					    <div class="col-xs-9">
						'.$insentif_hadir.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Gaji</label>
					    </div>
					    <div class="col-xs-9">
						'.$total_gaji.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Gaji Diterima</label>
					    </div>
					    <div class="col-xs-9">
						'.$total_gaji_diterima.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Koperasi</label>
					    </div>
					    <div class="col-xs-9">
						'.$koperasi.'
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