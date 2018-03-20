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
$table_main = "gx_list_barang_customer";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_list_barang_customer` WHERE `level` =  '0'";

//INSERT 

//UPDATE

//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail List Barang Customer";
    $judul_table = "detail list barang customer";
    
    //id web
    $title_header = 'Detail List Barang Customer';
    $submenu_header = 'detail_list_barang_customer';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail List Barang Customer");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_list_barang_customer` WHERE `kode_list_barang_customer`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    /*`id`, `kode_list_barang_customer`, `kode_cabang`, `cabang`, `kode_customer`, `nama_customer`, `uid`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` */
    	
	$user_upd 			= $data_d['user_upd'];
	$user_add 			= $data_d['user_add'];
	$date_upd 			= $data_d['date_upd'];
	$date_add 			= $data_d['date_add'];
	$status 			= $data_d['status'];
	$kode_list_barang_customer	= $data_d['kode_list_barang_customer'];
	$kode_cabang			= $data_d['kode_cabang'];
	$cabang				= $data_d['cabang'];
	$kode_customer			= $data_d['kode_customer'];
	$nama_customer			= $data_d['nama_customer'];
	$uid				= $data_d['uid'];
	
  

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
						<label>Kode List Barang Customer</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_list_barang_customer.'
					    </div>    
                                        </div>
				    </div>


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
						<label>User ID</label>
					    </div>
					    <div class="col-xs-9">
						'.$uid.'
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
						<table class="table table-hover">
						    <thead>
							<tr><th>Tanggal</th><th>Kode Barang</th><th>Nama Barang</th><th>Qty</th><th>Serial Number</th></tr>
						    </thead>
						    <tbody>';
						    $c = isset($_GET['c']) ? $_GET['c'] : '';
						    $l = isset($_GET['l']) ? $_GET['l'] : '';
						    /*$sql_2 = "SELECT `id`, `kode_barang`, `kode_list_alat`, `kode_barang`, `nama_barang`, `qty`, `no_seri_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_jawaban_spk_bongkar_list_alat` WHERE `kode_jawaban_spk_bongkar`='".$c."'";*/
						    $sql_2 = "SELECT * FROM `gx_list_barang_customer_detail` WHERE `kode_list_barang_customer`='".$c."' AND `level`='0'";
						    $query_2 = mysql_query($sql_2, $conn);
						
							if(isset($c)){
							    while($row_2 = mysql_fetch_array($query_2)){	
								$content .= '<tr><td>'.$row_2['tanggal'].'</td><td>'.$row_2['kode_barang'].'</td><td>'.$row_2['nama_barang'].'</td><td>'.$row_2['qty'].'</td><td>'.$row_2['serial_number'].'</td></tr>';
							    } 
							}
						
						    $content .= '</tbody>';
						    
						    
						    
						
						$content .= '</table>    
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