<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

//SELECT `id`, `kode_realisasi_link_budget_maintance`, `tanggal`, `kode_cabang`, `cabang`, `no_link_budget_maintance`, `spk_maintance`, `kode_customer`, `nama_customer`, `latitude`, `longtidute`, `tiang_terdekat`, `nama_created`, `fiber_optic`, `wireless`, `type_connection`, `power_budget`, `kode_alat_dibutuhkan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_realisasi_link_budget_maintance` WHERE 1

include ("../../config/configuration_admin.php");
$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.

redirectToHTTPS();
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "gx_realisasi_link_budget_maintance";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_realisasi_link_budget_maintance` WHERE `level`='0'";

//INSERT


//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_realisasi_link_budget_maintance";
    $redirect_action_lock = "master_realisasi_link_budget_maintance.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Realisasi Link Budget Maintance";
    $judul_table = "detail realisasi link budget maintance";
    
    //id web
    $title_header = 'Detail Realisasi Link Budget Maintance';
    $submenu_header = 'detail_realisasi_link_budget_maintance';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Realisasi Link Budget Maintance");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_realisasi_link_budget_maintance` WHERE `kode_realisasi_link_budget_maintance`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    

    $kode_realisasi_link_budget_maintance			= isset($data_d['kode_realisasi_link_budget_maintance']) ? mysql_real_escape_string(trim($data_d['kode_realisasi_link_budget_maintance'])) : '';
    $tanggal							= isset($data_d['tanggal']) ? mysql_real_escape_string(trim($data_d['tanggal'])) : '';
    $kode_cabang						= isset($data_d['kode_cabang']) ? mysql_real_escape_string(trim($data_d['kode_cabang'])) : '';
    $cabang							= isset($data_d['cabang']) ? mysql_real_escape_string(trim($data_d['cabang'])) : '';
    $no_link_budget_maintance					= isset($data_d['no_link_budget_maintance']) ? mysql_real_escape_string(trim($data_d['no_link_budget_maintance'])) : '';
    $spk_maintance						= isset($data_d['spk_maintance']) ? mysql_real_escape_string(trim($data_d['spk_maintance'])) : '';
    $kode_customer						= isset($data_d['kode_customer']) ? mysql_real_escape_string(trim($data_d['kode_customer'])) : '';
    $nama_customer						= isset($data_d['nama_customer']) ? mysql_real_escape_string(trim($data_d['nama_customer'])) : '';
    $latitude							= isset($data_d['latitude']) ? mysql_real_escape_string(trim($data_d['latitude'])) : '';
    $longtidute							= isset($data_d['longtidute']) ? mysql_real_escape_string(trim($data_d['longtidute'])) : '';
    $tiang_terdekat						= isset($data_d['tiang_terdekat']) ? mysql_real_escape_string(trim($data_d['tiang_terdekat'])) : '';
    $nama_created						= isset($data_d['nama_created']) ? mysql_real_escape_string(trim($data_d['nama_created'])) : '';
    $type_connection						= isset($data_d['type_connection']) ? mysql_real_escape_string(trim($data_d['type_connection'])) : '';
    $power_budget						= isset($data_d['power_budget']) ? mysql_real_escape_string(trim($data_d['power_budget'])) : '';
    $kode_alat_dibutuhkan					= isset($data_d['kode_alat_dibutuhkan']) ? mysql_real_escape_string(trim($data_d['kode_alat_dibutuhkan'])) : '';
    $date_add							= isset($data_d['date_add']) ? mysql_real_escape_string(trim($data_d['date_add'])) : '';
    $date_upd							= isset($data_d['date_upd']) ? mysql_real_escape_string(trim($data_d['date_upd'])) : '';
    $user_add							= isset($data_d['user_add']) ? mysql_real_escape_string(trim($data_d['user_add'])) : '';
    $user_upd							= isset($data_d['user_upd']) ? mysql_real_escape_string(trim($data_d['user_upd'])) : '';
    



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
						<label>Kode Realisasi Link Budget Maintance</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_realisasi_link_budget_maintance.'
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
						<label>kode_cabang</label>
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
						<label></label>
					    </div>
					    <div class="col-xs-9">
						'.$spk_maintance.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_customer.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_customer.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-9">
						'.$latitude.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longtidute</label>
					    </div>
					    <div class="col-xs-9">
						'.$longtidute.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tiang Terdekat</label>
					    </div>
					    <div class="col-xs-9">
						'.$tiang_terdekat.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Created</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_created.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Type Connection</label>
					    </div>
					    <div class="col-xs-9">
						'.$type_connection.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Power Budget</label>
					    </div>
					    <div class="col-xs-9">
						'.$power_budget.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Alat yang dibutuhkan</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_alat_dibutuhkan.'
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
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang dibutuhkan</label>
					    </div>
					    <div class="col-xs-12">';
			$sql_select_alat = "SELECT `id`, `kode_realisasi_link_budget_maintance_alat`, `kode_realisasi_link_budget_maintance`, `tanggal`, `kode_barang`, `nama_barang`, `quantity`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_realisasi_link_budget_maintance_alat` WHERE `kode_realisasi_link_budget_maintance`='".$kode_realisasi_link_budget_maintance."'";
			$query_select_alat = mysql_query($sql_select_alat, $conn);
			
			$content .= '<table class="table table-hover">
						    <thead>
							<tr><th>No</th><th>Kode Barang</th><th>Nama Barang</th><th>Quantity</th><th>Serial Number</th><th>Action</th></tr>
						    </thead>
						    <tbody>';
			while($row_alat = mysql_fetch_array($query_select_alat)){
			    $content .= '<tr><td>'.$row_alat['kode_barang'].'</td><td>'.$row_alat['nama_barang'].'</td><td>'.$row_alat['quantity'].'</td><td>'.$row_alat['serial_number'].'</td><tr>';    
			}
			$content .= '</tbody></table>';
			
			
					    $content .= '
					    </div>
					    
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Foto Alat</label>
					    </div>
					    <div class="col-xs-12">
					    ';
			$sql_select_image = "SELECT * FROM `gx_realisasi_link_budget_maintance_image` WHERE `kode_realisasi_link_budget_maintance`='".(isset($_GET['c']) ? $_GET['c'] : '')."'";
			$query_select_image = mysql_query($sql_select_image, $conn);
					    while($row_image = mysql_fetch_array($query_select_image)){
						$content .= '<img src="../upload/realisasi_link_budget_maintance/'.$row_image['foto_alat'].'" width="100px"> ';    
					    }
					    $content .= '
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