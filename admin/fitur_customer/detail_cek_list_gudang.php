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
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_cek_list_gudang` WHERE `level` =  '0'";

//INSERT


//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_cek_list_gudang";
    $redirect_action_lock = "master_cek_list_gudang.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Cek List Gudang";
    $judul_table = "detail cek list gudang";
    
    //id web
    $title_header = 'Detail Cek List Gudang';
    $submenu_header = 'detail_cek_list_gudang';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Cek List Gudang");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_cek_list_gudang` WHERE `kode_penerimaan_barang`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    

    $kode_penerimaan_barang					= isset($data_d['kode_penerimaan_barang']) ? mysql_real_escape_string(trim($data_d['kode_penerimaan_barang'])) : '';
    $tanggal							= isset($data_d['tanggal']) ? mysql_real_escape_string(trim($data_d['tanggal'])) : '';
    $kode_cabang						= isset($data_d['kode_cabang']) ? mysql_real_escape_string(trim($data_d['kode_cabang'])) : '';
    $cabang							= isset($data_d['cabang']) ? mysql_real_escape_string(trim($data_d['cabang'])) : '';
    $spk_maintance						= isset($data_d['spk_maintance']) ? mysql_real_escape_string(trim($data_d['spk_maintance'])) : '';
    $kode_customer						= isset($data_d['kode_customer']) ? mysql_real_escape_string(trim($data_d['kode_customer'])) : '';
    $nama_customer						= isset($data_d['nama_customer']) ? mysql_real_escape_string(trim($data_d['nama_customer'])) : '';
    $latitude							= isset($data_d['latitude']) ? mysql_real_escape_string(trim($data_d['latitude'])) : '';
    $longtidute							= isset($data_d['longtidute']) ? mysql_real_escape_string(trim($data_d['longtidute'])) : '';
    $tiang_terdekat						= isset($data_d['tiang_terdekat']) ? mysql_real_escape_string(trim($data_d['tiang_terdekat'])) : '';
    $nama_created						= isset($data_d['nama_created']) ? mysql_real_escape_string(trim($data_d['nama_created'])) : '';
    $type_connection						= isset($data_d['type_connection']) ? mysql_real_escape_string(trim($data_d['type_connection'])) : '';
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
						<label>Kode Penerimaan Barang</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_penerimaan_barang.'
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
						<label>SPK Maintance</label>
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
					    <div class="col-xs-12">
						<label>Alat yang dibutuhkan</label>
					    </div>
					    <div class="col-xs-12">';
						
						$content .= '<table class="table table-hover">
						    <thead>
							<tr><th>No</th><th>Nama Barang</th><th>Quantity</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
								
							    $sql_alat_yang_dibutuhkan = "SELECT * FROM `gx_cek_list_gudang_alat` WHERE `kode_penerimaan_barang`='".(isset($_GET['c']) ? $_GET['c'] : '')."' AND `kategori_alat`='alat_yang_dibutuhkan' AND `level`='0'";
							    $query_alat_yang_dibutuhkan = mysql_query($sql_alat_yang_dibutuhkan, $conn);
							    while($row = mysql_fetch_array($query_alat_yang_dibutuhkan)){
								$content .= '<tr><td>'.$row['kode_barang'].'</td><td>'.$row['nama_barang'].'</td><td>'.$row['quantity'].'</td><td>'.$row['serial_number'].'</td></tr>';						
							    }
						$content .= '</tbody>';					
						$content .= '</table>';
						
						
					    $content .= '	
					    </div>
					</div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang terpasang</label>
					    </div>
					    <div class="col-xs-12">';
						
						$content .= '<table class="table table-hover">
						    <thead>
							<tr><th>No</th><th>Nama Barang</th><th>Quantity</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
								
							    $sql_alat_yang_terpasang = "SELECT * FROM `gx_cek_list_gudang_alat` WHERE `kode_penerimaan_barang`='".(isset($_GET['c']) ? $_GET['c'] : '')."' AND `kategori_alat`='alat_yang_terpasang' AND `level`='0'";
							    $query_alat_yang_terpasang = mysql_query($sql_alat_yang_terpasang, $conn);
							    while($row = mysql_fetch_array($query_alat_yang_terpasang)){
								$content .= '<tr><td>'.$row['kode_barang'].'</td><td>'.$row['nama_barang'].'</td><td>'.$row['quantity'].'</td><td>'.$row['serial_number'].'</td></tr>';						
							    }
						$content .= '</tbody>';					
						$content .= '</table>';
						
						
					    $content .= '	
					    </div>
					</div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang harus kembali</label>
					    </div>
					    <div class="col-xs-12">';
							
						$content .= '<table class="table table-hover">
						    <thead>
							<tr><th>No</th><th>Nama Barang</th><th>Quantity</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
						    
							    $sql_alat_yang_harus_kembali = "SELECT * FROM `gx_cek_list_gudang_alat` WHERE `kode_penerimaan_barang`='".(isset($_GET['c']) ? $_GET['c'] : '')."' AND `kategori_alat`='alat_yang_harus_kembali' AND `level`='0'";
							    $query_alat_yang_harus_kembali = mysql_query($sql_alat_yang_harus_kembali, $conn);
							    while($row = mysql_fetch_array($query_alat_yang_harus_kembali)){
								$content .= '<tr><td>'.$row['kode_barang'].'</td><td>'.$row['nama_barang'].'</td><td>'.$row['quantity'].'</td><td>'.$row['serial_number'].'</td></tr>';						
							    }
						$content .= '</tbody>';					
						$content .= '</table>';
						
					    $content .= '	
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