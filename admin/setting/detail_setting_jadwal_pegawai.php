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
$table_main = "gx_setting_jadwal_pegawai";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_setting_jadwal_pegawai` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_setting_jadwal_pegawai";
    $redirect_action_lock = "master_setting_jadwal_pegawai.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Setting Jadwal Pegawai";
    $judul_table = "detail setting jadwal pegawai";
    
    //id web
    $title_header = 'Detail Setting Jadwal Pegawai';
    $submenu_header = 'detail_setting_jadwal_pegawai';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Setting Jadwal Pegawai");
    global $conn;
    $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $sql_d = "SELECT * FROM `gx_setting_jadwal_pegawai` WHERE `kode_shift`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
    $kode_shift		 				= $data_d['kode_shift'];
    $nama_shift 					= $data_d['nama_shift'];
    $check_in		 				= $data_d['check_in'];
    $break		 				= $data_d['break'];
    $check_out		 				= $data_d['check_out'];
    $date_add						= $data_d['date_add'];
    $date_upd						= $data_d['date_upd'];
    $user_add						= $data_d['user_add'];
    $user_upd						= $data_d['user_upd'];

  

$content = '<!-- Content Header (Page header) -->
                

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
						<label>Kode Shift</label>
					    </div>
					    <div class="col-xs-9">
						'.$kode_shift.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Shift</label>
					    </div>
					    <div class="col-xs-9">
						'.$nama_shift.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Check In</label>
					    </div>
					    <div class="col-xs-9">
						'.$check_in.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Break</label>
					    </div>
					    <div class="col-xs-9">
						'.$break.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Check Out</label>
					    </div>
					    <div class="col-xs-9">
						'.$check_out.'
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