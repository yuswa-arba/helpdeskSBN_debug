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
$table_main = "gx_cek_list_barang_bongkar";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_cek_list_barang_bongkar` WHERE `level`='0'";

//INSERT


//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_cek_list_barang_bongkar";
    $redirect_action_lock = "master_cek_list_barang_bongkar.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Cek List Barang Bongkar";
    $judul_table = "detail cek list barang bongkar";
    
    //id web
    $title_header = 'Detail Cek List Barang Bongkar';
    $submenu_header = 'detail_cek_list_barang_bongkar';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Cek List Barang Bongkar");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_cek_list_barang_bongkar` WHERE `no_penerimaan_barang`='".$c_d."' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    

    $kode_cek_list_barang_bongkar			= isset($data_d['kode_cek_list_barang_bongkar']) ? mysql_real_escape_string(trim($data_d['kode_cek_list_barang_bongkar'])) : '';
    $no_penerimaan_barang				= isset($data_d['no_penerimaan_barang']) ? mysql_real_escape_string(trim($data_d['no_penerimaan_barang'])) : '';
    $tanggal						= isset($data_d['tanggal']) ? mysql_real_escape_string(trim($data_d['tanggal'])) : '';
    $kode_cabang					= isset($data_d['kode_cabang']) ? mysql_real_escape_string(trim($data_d['kode_cabang'])) : '';
    $cabang						= isset($data_d['cabang']) ? mysql_real_escape_string(trim($data_d['cabang'])) : '';
    
    $spk_bongkar					= isset($data_d['spk_bongkar']) ? mysql_real_escape_string(trim($data_d['spk_bongkar'])) : '';
    $kode_customer					= isset($data_d['kode_customer']) ? mysql_real_escape_string(trim($data_d['kode_customer'])) : '';
    $nama_customer					= isset($data_d['nama_customer']) ? mysql_real_escape_string(trim($data_d['nama_customer'])) : '';
    $latitude						= isset($data_d['latitude']) ? mysql_real_escape_string(trim($data_d['latitude'])) : '';
    $longidute						= isset($data_d['longidute']) ? mysql_real_escape_string(trim($data_d['longidute'])) : '';
    $tiang_terdekat					= isset($data_d['tiang_terdekat']) ? mysql_real_escape_string(trim($data_d['tiang_terdekat'])) : '';
    $nama_created					= isset($data_d['nama_created']) ? mysql_real_escape_string(trim($data_d['nama_created'])) : '';
    
    $fiber_optic					= isset($data_d['fiber_optic']) ? mysql_real_escape_string(trim($data_d['fiber_optic'])) : '';
    $wireless						= isset($data_d['wireless']) ? mysql_real_escape_string(trim($data_d['wireless'])) : '';
    $type_connection					= isset($data_d['type_connection']) ? mysql_real_escape_string(trim($data_d['type_connection'])) : '';
    $kode_alat_customer					= isset($data_d['kode_alat_customer']) ? mysql_real_escape_string(trim($data_d['kode_alat_customer'])) : '';
    $status						= isset($data_d['status']) ? mysql_real_escape_string(trim($data_d['status'])) : '';
    
    $alat_customer					= '
    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang ada di customer </label>
					    </div>
					    
					    <div class="col-xs-12">
						<table class="table table-hover">
						    <thead>
							<tr><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
						    
							$sql_1 = "SELECT distinct `kode_customer` FROM `tbCustomer`,`gx_cek_list_barang_bongkar` WHERE `tbCustomer`.`cKode`=`gx_cek_list_barang_bongkar`.`kode_customer` AND `gx_cek_list_barang_bongkar`.`no_penerimaan_barang`='".$c_d."' AND `gx_cek_list_barang_bongkar`.`level`='0'";
							$query_1 = mysql_query($sql_1, $conn);
						        
							while($row_1 = mysql_fetch_array($query_1)){
							    $sql_2 = "SELECT * FROM `gx_list_barang_customer`,`gx_list_barang_customer_detail` WHERE `gx_list_barang_customer`.`kode_list_barang_customer`=`gx_list_barang_customer_detail`.`kode_list_barang_customer` AND `gx_list_barang_customer`.`kode_customer`='".$row_1['kode_customer']."' AND `gx_list_barang_customer`.`level`='0'";
							    $query_2 = mysql_query($sql_2, $conn);
							    while($row_2 = mysql_fetch_array($query_2)){
								$alat_customer .= '<tr><td>'.$row_2['kode_barang'].'</td><td>'.$row_2['nama_barang'].'</td><td>'.$row_2['qty'].'</td><td>'.$row_2['serial_number'].'</td></tr>';
							    }
							}    
						
						    $alat_customer .= '
						    </tbody>';
						    
						    
						
						$alat_customer .= '</table>    
					    </div>
                                        </div>
					</div>';
    
    $alat_bongkar ='
    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang dibongkar</label>
					    </div>
					    
					    <div class="col-xs-12">
						<table class="table table-hover">
						    <thead>
							<tr><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
						    
							$sql_1 = "SELECT distinct `kode_customer` FROM `tbCustomer`,`gx_cek_list_barang_bongkar` WHERE `tbCustomer`.`cKode`=`gx_cek_list_barang_bongkar`.`kode_customer` AND `gx_cek_list_barang_bongkar`.`no_penerimaan_barang`='".$c_d."' AND `gx_cek_list_barang_bongkar`.`level`='0'";
							$query_1 = mysql_query($sql_1, $conn);
						    
							while($row_1 = mysql_fetch_array($query_1)){
							    $sql_2 = "SELECT * FROM `gx_list_barang_customer`,`gx_list_barang_customer_detail` WHERE `gx_list_barang_customer`.`kode_list_barang_customer`=`gx_list_barang_customer_detail`.`kode_list_barang_customer` AND `gx_list_barang_customer`.`kode_customer`='".$row_1['kode_customer']."' AND `gx_list_barang_customer`.`level`='0'";
							    $query_2 = mysql_query($sql_2, $conn);
							    while($row_2 = mysql_fetch_array($query_2)){	
								$data_cek = mysql_query("SELECT * FROM `gx_cek_list_barang_bongkar_detail` WHERE `kode_alat`='".$row_2['kode_barang']."'", $conn); 
								
								
								$alat_bongkar .= '<tr><td>'.$row_2['kode_barang'].'</td><td>'.$row_2['nama_barang'].'</td><td>'.$row_2['qty'].'</td><td>'.$row_2['serial_number'].'</td></tr>';
							    }
							}    
						
						    $alat_bongkar .= '
						    </tbody>';
						    						
						$alat_bongkar .= '</table>    
					    </div>
                                        </div>
					</div>';

    $alat_tersisa_customer = '					
    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang tersisa di customer</label>
					    </div>
					    
					    <div class="col-xs-12">
						<table class="table table-hover">
						    <thead>
							<tr><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
						    
							$sql_1 = "SELECT distinct `kode_customer` FROM `tbCustomer`,`gx_cek_list_barang_bongkar` WHERE `tbCustomer`.`cKode`=`gx_cek_list_barang_bongkar`.`kode_customer` AND `gx_cek_list_barang_bongkar`.`no_penerimaan_barang`='".$c_d."' AND `gx_cek_list_barang_bongkar`.`level`='0'";
							$query_1 = mysql_query($sql_1, $conn);
						    
							while($row_1 = mysql_fetch_array($query_1)){
							    $sql_2 = "SELECT * FROM `gx_list_barang_customer`,`gx_list_barang_customer_detail` WHERE `gx_list_barang_customer`.`kode_list_barang_customer`=`gx_list_barang_customer_detail`.`kode_list_barang_customer` AND `gx_list_barang_customer`.`kode_customer`='".$row_1['kode_customer']."' AND `gx_list_barang_customer`.`level`='0'";
							    $query_2 = mysql_query($sql_2, $conn);
							    while($row_2 = mysql_fetch_array($query_2)){	
								//$content .= '<tr><td>'.$row_2['kode_barang'].'</td><td>'.$row_2['nama_barang'].'</td><td>'.$row_2['qty'].'</td><td>'.$row_2['serial_number'].'</td></tr>';
								$data_cek_2 = mysql_query("SELECT * FROM `gx_cek_list_barang_bongkar_detail` WHERE `kode_alat`='".$row_2['kode_barang']."'", $conn); 
								
								if(mysql_num_rows($data_cek_2) > 0){
									$alat_tersisa_customer .= '';
								  }else{
									$alat_tersisa_customer .= '<tr><td>'.$row_2['kode_barang'].'</td><td>'.$row_2['nama_barang'].'</td><td>'.$row_2['qty'].'</td><td>'.$row_2['serial_number'].'</td></tr>';
								}
							    }
							}    
						
						    $alat_tersisa_customer .= '
						    </tbody>';
						    
						   						
						$alat_tersisa_customer .= '</table>    
					    </div>
                                        </div>
					</div>';    
    
    $date_add						= isset($data_d['date_add']) ? mysql_real_escape_string(trim($data_d['date_add'])) : '';
    $date_upd						= isset($data_d['date_upd']) ? mysql_real_escape_string(trim($data_d['date_upd'])) : '';
    $user_add						= isset($data_d['user_add']) ? mysql_real_escape_string(trim($data_d['user_add'])) : '';
    $user_upd						= isset($data_d['user_upd']) ? mysql_real_escape_string(trim($data_d['user_upd'])) : '';
    
    	




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
						<label>Kode Cek List Barang Bongkar</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_cek_list_barang_bongkar.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Penerimaan Barang</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_penerimaan_barang.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>tanggal</label>
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
						<label>SPK Bongkar</label>
					    </div>
					    <div class="col-xs-9">
						'.$spk_bongkar.'
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
						<label>Longidute</label>
					    </div>
					    <div class="col-xs-9">
						'.$longidute.'
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
						'.($type_connection == 'fiber_optic' ? 'Fiber Optic' : 'Wireless').'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alat Customer</label>
					    </div>
					    <div class="col-xs-9">-->
						'.$alat_customer.'
					    <!--</div>
					    
                                        </div>
				    </div>-->
				    
				    

				    <!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alat Bongkar</label>
					    </div>
					    <div class="col-xs-9">-->
						'.$alat_bongkar.'
					    <!--</div>
					    
                                        </div>
				    </div>-->
				    
				    

				    <!--<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alat Tersisa Customer</label>
					    </div>
					    <div class="col-xs-9">-->
						'.$alat_tersisa_customer.'
					    <!--</div>
					    
                                        </div>
				    </div>-->
				    
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