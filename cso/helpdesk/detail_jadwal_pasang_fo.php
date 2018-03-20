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
$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.

redirectToHTTPS();
if($loggedin = logged_inCSO()){
// Check if they are logged in
 
//SQL 
$table_main = "gx_cso_jadwal_pasang_fo";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `kode_jadwal_pasang_fo` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_jadwal_pasang_fo` WHERE `level`= '0'";

//INSERT


//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_cso_jadwal_pasang_fo";
    $redirect_action_lock = "master_jadwal_pasang_fo.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Jadwal Pasang FO";
    $judul_table = "";
    
    //id web
    $title_header = 'Detail Jadwal Pasang FO';
    $submenu_header = 'detail_jadwal_pasang_fo';
    
    
if($loggedin["group"] == 'cso'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Jadwal Pasang FO");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_cso_jadwal_pasang_fo` WHERE `kode_jadwal_pasang_fo`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    
    $kode_jadwal_pasang_fo = $data_d['kode_jadwal_pasang_fo'];
    $user_id = $data_d['user_id'];
    $nama = $data_d['nama'];
    $alamat = $data_d['alamat'];
    $tanggal = $data_d['tanggal'];
    $time_slot = $data_d['time_slot'];
    $teknisi = $data_d['teknisi'];
    $status = $data_d['status'];
    $pekerjaan = $data_d['pekerjaan'];
    $keterangan = $data_d['keterangan'];
    
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
						<label>Kode Jadwal Pasang FO</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_jadwal_pasang_fo.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-9">
						'.$user_id.'
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
						<label>Time Slot</label>
					    </div>
					    <div class="col-xs-9">
						'.$time_slot.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi</label>
					    </div>
					    <div class="col-xs-9">
						'.$teknisi.'
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
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-9">
						'.$pekerjaan.'
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
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>