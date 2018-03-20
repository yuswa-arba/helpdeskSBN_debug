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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
// Check if they are logged in
 
//SQL 
$table_main = "gx_spk_maintance";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_spk_maintance` WHERE `level`='0'";

//INSERT


//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_spk_maintance";
    $redirect_action_lock = "master_spk_maintance.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail SPK Maintance";
    $judul_table = "detail spk Maintance";
    
    //id web
    $title_header = 'Detail SPK Maintance';
    $submenu_header = 'detail_spk_maintance';
    
    

    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail SPK Maintance");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_spk_maintance` WHERE `kode_spk_maintance`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    

    $kode_spk_maintance					= isset($data_d['kode_spk_bongkar']) ? mysql_real_escape_string(trim($data_d['kode_spk_bongkar'])) : '';
    $tanggal						= isset($data_d['tanggal']) ? mysql_real_escape_string(trim($data_d['tanggal'])) : '';
    $kode_cabang					= isset($data_d['kode_cabang']) ? mysql_real_escape_string(trim($data_d['kode_cabang'])) : '';
    $cabang						= isset($data_d['cabang']) ? mysql_real_escape_string(trim($data_d['cabang'])) : '';
    
    $user_id						= isset($data_d['user_id']) ? mysql_real_escape_string(trim($data_d['user_id'])) : '';
    $kode_customer					= isset($data_d['kode_customer']) ? mysql_real_escape_string(trim($data_d['kode_customer'])) : '';
    $nama_customer					= isset($data_d['nama_customer']) ? mysql_real_escape_string(trim($data_d['nama_customer'])) : '';
    $no_inactive					= isset($data_d['no_inactive']) ? mysql_real_escape_string(trim($data_d['no_inactive'])) : '';
    $no_off_connection					= isset($data_d['no_off_connection']) ? mysql_real_escape_string(trim($data_d['no_off_connection'])) : '';
    $telp						= isset($data_d['telp']) ? mysql_real_escape_string(trim($data_d['telp'])) : '';
    $kode_teknisi					= isset($data_d['kode_teknisi']) ? mysql_real_escape_string(trim($data_d['kode_teknisi'])) : '';
    
    $teknisi						= isset($data_d['teknisi']) ? mysql_real_escape_string(trim($data_d['teknisi'])) : '';
    $alamat						= isset($data_d['alamat']) ? mysql_real_escape_string(trim($data_d['alamat'])) : '';
    $pekerjaan						= isset($data_d['pekerjaan']) ? mysql_real_escape_string(trim($data_d['pekerjaan'])) : '';
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
						<label>Kode SPK Bongkar</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_spk_maintance.'
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
						<label>No Inactive</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_inactive.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Off Connection</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_off_connection.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Telpon</label>
					    </div>
					    <div class="col-xs-9">
						'.$telp.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Teknisi</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_teknisi.'
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
    

    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>