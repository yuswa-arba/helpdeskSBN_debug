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
$table_main = "gx_notif";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id_notif` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_notif` WHERE `level`= '0'";

//INSERT


//UPDATE
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Notifikasi";
    $judul_table = "";
    
    //id web
    $title_header = 'Detail Notifikasi';
    $submenu_header = 'detail_notifikasi';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Notifikasi");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $sql_d = "SELECT * FROM `gx_notif` WHERE `id_notif`='$id_d' ORDER BY `id_notif` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    $tipe_notif = $data_d['tipe_notif'];
    $desc_en_notif = $data_d['desc_en_notif'];
    $desc_id_notif = $data_d['desc_id_notif'];
    


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
						<label>Tipe Notifikasi</label>
					    </div>
					    <div class="col-xs-9">
						'.$tipe_notif.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Deskripsi Inggris</label>
					    </div>
					    <div class="col-xs-9">
						'.$desc_en_notif.'
					    </div>
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Deskripsi Indonesia</label>
					    </div>
					    <div class="col-xs-9">
						'.$desc_id_notif.'
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