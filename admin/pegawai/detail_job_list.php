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
$table_main = "gx_master_job_list";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id_job_list` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_master_job_list` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_master_job_list";
    $redirect_action_lock = "master_job_list.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Job List";
    $judul_table = "";
    
    //id web
    $title_header = 'Detail Job List';
    $submenu_header = 'detail_job_list';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Job List");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_master_job_list` WHERE `id_master_job_list`='$id_d' ORDER BY `id_master_job_list` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
	//$				= $data_d[''];
	//SELECT `id`, `id_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
	$divisi				= $data_d['divisi'];
	$level_master			= $data_d['level_master'];
	$rutin_harian_1			= $data_d['rutin_harian_1'];
	$rutin_harian_2			= $data_d['rutin_harian_2'];
	$rutin_harian_3			= $data_d['rutin_harian_3'];
	$rutin_harian_4			= $data_d['rutin_harian_4'];
	$rutin_harian_5			= $data_d['rutin_harian_5'];
	$hari_1				= $data_d['hari_1'];
	$hari_2				= $data_d['hari_2'];
	$hari_3				= $data_d['hari_3'];
	$hari_4				= $data_d['hari_4'];
	$hari_5				= $data_d['hari_5'];
	$rutin_tanggal_1		= $data_d['rutin_tanggal_1'];
	$rutin_tanggal_2		= $data_d['rutin_tanggal_2'];
	$rutin_tanggal_3		= $data_d['rutin_tanggal_3'];
	$rutin_tanggal_4		= $data_d['rutin_tanggal_4'];
	$rutin_tanggal_5		= $data_d['rutin_tanggal_5'];
	$tanggal_1			= $data_d['tanggal_1'];
	$tanggal_2			= $data_d['tanggal_2'];
	$tanggal_3			= $data_d['tanggal_3'];
	$tanggal_4			= $data_d['tanggal_4'];
	$tanggal_5			= $data_d['tanggal_5'];
	
	
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
	$user_add			= $data_d['user_add'];
	$user_update			= $data_d['user_upd'];


  

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> '.$judul_form.' </h1>
                    
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
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-9">
						'.$divisi.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Level</label>
					    </div>
					    <div class="col-xs-9">
						'.$level_master.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Harian 1</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_harian_1.'
					    </div>
					    <div class="col-xs-3">
						<label>Hari 1</label>
					    </div>
					    <div class="col-xs-3">
						'.$hari_1.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Harian 2</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_harian_2.'
					    </div>
					    <div class="col-xs-3">
						<label>Hari 2</label>
					    </div>
					    <div class="col-xs-3">
						'.$hari_2.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Harian 3</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_harian_3.'
					    </div>
					    <div class="col-xs-3">
						<label>Hari 3</label>
					    </div>
					    <div class="col-xs-3">
						'.$hari_3.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Harian 4</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_harian_4.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Hari 4</label>
					    </div>
					    <div class="col-xs-3">
						'.$hari_4.'
					    </div>
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Harian 5</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_harian_5.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Hari 5</label>
					    </div>
					    <div class="col-xs-3">
						'.$hari_5.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Tanggal 1</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_tanggal_1.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Tanggal 1</label>
					    </div>
					    <div class="col-xs-3">
						'.$tanggal_1.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Tanggal 2</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_tanggal_2.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Tanggal 2</label>
					    </div>
					    <div class="col-xs-3">
						'.$tanggal_2.'
					    </div>
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Tanggal 3</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_tanggal_3.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Tanggal 3</label>
					    </div>
					    <div class="col-xs-3">
						'.$tanggal_3.'
					    </div>
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Tanggal 4</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_tanggal_4.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Tanggal 4</label>
					    </div>
					    <div class="col-xs-3">
						'.$tanggal_4.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Rutin Tanggal 5</label>
					    </div>
					    <div class="col-xs-3">
						'.$rutin_tanggal_5.'
					    </div>
					    
					    <div class="col-xs-3">
						<label>Tanggal 5</label>
					    </div>
					    <div class="col-xs-3">
						'.$tanggal_5.'
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