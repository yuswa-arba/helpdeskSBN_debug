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
 

//String Data View
    //Judul Form
    $judul_form = "Detail Pemakaian Kendaraan";
    
    
    //Judul Table
    $judul_table = "Detail Pemakaian Kendaraan";
    
    
    //id web
    $title_header = 'Detail Pemakaian Kendaraan';
    $submenu_header = 'detail_pemakaian_kendaraan';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Pemakaian Kendaraan");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_kendaraan_pemakaian` WHERE `kode_kendaraan`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
	$kode_kendaraan			= $data_d['kode_kendaraan'];
	$tanggal			= $data_d['tanggal'];
	$no_pol				= $data_d['no_pol'];
	$nama_kendaraan			= $data_d['nama_kendaraan'];
	$merk				= $data_d['merk'];
	$jenis_kendaraan		= $data_d['jenis_kendaraan'];
	$pemakai			= $data_d['pemakai'];
	$pemakai_2			= $data_d['pemakai_2'];
	$km_awal			= $data_d['km_awal'];
	$km_akhir			= $data_d['km_akhir'];
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
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
						<label>Kode Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Tanggal</label>
					    </div>
					    <div class="col-xs-9">
						'.$tanggal.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Pol</label>
					    </div>
					    <div class="col-xs-9">
						'.$no_pol.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Merk</label>
					    </div>
					    <div class="col-xs-9">
						'.$merk.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Jenis Kendaraan</label>
					    </div>
					    <div class="col-xs-9">
						'.$jenis_kendaraan.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pemakai</label>
					    </div>
					    <div class="col-xs-9">
						'.$pemakai.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pemakai 2</label>
					    </div>
					    <div class="col-xs-9">
						'.$pemakai_2.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Km Awal</label>
					    </div>
					    <div class="col-xs-9">
						'.$km_awal.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Km Akhir</label>
					    </div>
					    <div class="col-xs-9">
						'.$km_akhir.'
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
						'.$date_update.'
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
						'.$user_update.'
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