<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */


include("../../config/configuration_admin.php");
$target_path = "../upload/email/";     // Declaring Path for uploaded images.

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    //SQL
    $table_main = "gx_off_connection";
    $table_detail = "";

    //SELECT
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_off_connection` WHERE `level` =  '0'";

    //UPDATE
    $table_update_lock = "gx_off_connection";
    $redirect_action_lock = "master_off_connection.php";

    //String Data View
    $judul_form = "Detail Off Connection";
    $judul_table = "detail off connection";

    //id web
    $title_header = 'Detail Off Connection';
    $submenu_header = 'detail_off_connection';


    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Off Connection"); // for create log in newfunction2.php

        global $conn;

        // menambil nilai/string yang ada pada url
        $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
        $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';

        $sql_d = "SELECT * FROM `gx_off_connection` WHERE `kode_off_connection`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
        $query_d = mysql_query($sql_d, $conn);
        $data_d = mysql_fetch_array($query_d);

        $kode_cabang = $data_d['kode_cabang'];
        $nama_cabang = $data_d['nama_cabang'];
        $kode_off_connection = $data_d['kode_off_connection'];
        $kode_customer = $data_d['kode_customer'];
        $nama_customer = $data_d['nama_customer'];
        $user_id = $data_d['user_id'];
        $no_inactive = $data_d['no_inactive'];
        $status_inactive = $data_d['status_inactive'];
        $remarks = $data_d['remarks'];
        $kode_cso = $data_d['kode_cso'];
        $request = $data_d['request'];
        $foto_email = $data_d['foto_email'];
        $no_formulir = $data_d['no_formulir'];
        $tanggal = $data_d['tanggal'];
        $date_add = $data_d['date_add'];
        $date_update = $data_d['date_upd'];
        $level = $data_d['level'];
        $user_add = $data_d['user_add'];
        $user_update = $data_d['user_upd'];

        $content = '
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1> ' . $judul_form . '</h1>  
            </section>
            
            <!-- Main content -->
            <section class="content">
		        <div class="row">
                    <div class="col-xs-12">   
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">' . $judul_table . '</h3>                                    
                            </div><!-- /.box-header -->
                            
                            <div class="box-body table-responsive">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Kode Cabang</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $kode_cabang . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Nama Cabang</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $nama_cabang . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Tanggal</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $tanggal . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>No Off Connection</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $kode_off_connection . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Kode Customer</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $kode_customer . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Nama Customer</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $nama_customer . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>User ID</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $user_id . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>No Inactive</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $no_inactive . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Status Inactive</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $status_inactive . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Remarks</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $remarks . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Kode CSO</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $kode_cso . '
                                        </div>
                                     </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Request</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $request . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Foto Email</label>
                                        </div>
                                        <div class="col-xs-9">';

        $sql_foto = "SELECT `foto_email` FROM `gx_off_connection_image_email` WHERE `level`='0' AND `kode_off_connection`='" . $kode_off_connection . "'";
        $query_foto = mysql_query($sql_foto, $conn);
        while ($row_foto = mysql_fetch_array($query_foto)) {
            $content .= '<img src="' . $target_path . '' . $row_foto['foto_email'] . '" width="100px" style="margin:5px;">';
        }

        $content .= '					    
					                    </div>
					                </div>
				                </div>
				                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>No Formulir</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $no_formulir . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Date Add</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $date_add . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Date Update</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $date_update . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>User Add</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $user_add . '
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>User Update</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $user_update . '
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';

        $plugins = '<link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = $title_header;
        $submenu = $submenu_header;
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;

    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>