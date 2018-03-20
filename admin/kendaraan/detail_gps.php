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
    $judul_form = "Detail GPS";
    
    
    //Judul Table
    $judul_table = "Detail GPS";
    
    
    //id web
    $title_header = 'Detail GPS';
    $submenu_header = 'detail_gps';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail GPS");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $sql_d = "SELECT * FROM `gx_kendaraan_gps` WHERE `kode_gps`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
	$kode_gps			= $data_d['kode_gps'];
	$nama_gps			= $data_d['nama_gps'];
	$imei_gps			= $data_d['imei_gps'];
	$nomer_sim_gps			= $data_d['nomer_sim_gps'];
	$operator_seluler		= $data_d['operator_seluler'];
	$sms_center			= $data_d['sms_center'];
	$nomer_sos_1			= $data_d['nomer_sos_1'];
	$nomer_sos_2			= $data_d['nomer_sos_2'];
	$nomer_sos_3			= $data_d['nomer_sos_3'];
	
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
						<label>Kode GPS</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_gps.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama GPS</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_gps.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>IMEI GPS</label>
					    </div>
					    <div class="col-xs-9">
						'.$imei_gps.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer SIM GPS</label>
					    </div>
					    <div class="col-xs-9">
						'.$nomer_sim_gps.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Operator Seluler</label>
					    </div>
					    <div class="col-xs-9">
						'.$operator_seluler.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>SMS Center</label>
					    </div>
					    <div class="col-xs-9">
						'.$sms_center.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer SOS 1</label>
					    </div>
					    <div class="col-xs-9">
						'.$nomer_sos_1.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer SOS 2</label>
					    </div>
					    <div class="col-xs-9">
						'.$nomer_sos_2.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer SOS 3</label>
					    </div>
					    <div class="col-xs-9">
						'.$nomer_sos_3.'
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