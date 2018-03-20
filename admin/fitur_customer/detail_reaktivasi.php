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

redirectToHTTPS();

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    //SQL
    $table_main = "gx_reaktivasi_customer";
    $table_detail = "";

    //SELECT
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_reaktivasi_customer` WHERE `level` =  '0'";

    //UPDATE
    $table_update_lock = "gx_reaktivasi_customer";
    $redirect_action_lock = "master_reaktivasi.php";

    //String Data View
    //Judul Form
    $judul_form = "Detail Reaktivasi";
    $judul_table = "detail reaktivasi";

    //id web
    $title_header = 'Detail Reaktivasi';
    $submenu_header = 'detail_reaktivasi';


    if ($loggedin["group"] == 'admin') {

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Reaktivasi");

        global $conn;

        $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
        $c_d = isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
        $sql_d = "SELECT * FROM `gx_reaktivasi_customer` WHERE `kode_reaktivasi`='$c_d' ORDER BY `id` DESC LIMIT 0,1";
        $query_d = mysql_query($sql_d, $conn);
        $data_d = mysql_fetch_array($query_d);

        $kode_cabang = $data_d['kode_cabang'];
        $nama_cabang = $data_d['nama_cabang'];
        $kode_reaktivasi = $data_d['kode_reaktivasi'];
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
                                            <label>No Reaktivasi</label>
                                        </div>
                                        <div class="col-xs-9">
                                            ' . $kode_reaktivasi . '
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

        $sql_foto = "SELECT `foto_email` FROM `gx_reaktivasi_customer_image_email` WHERE `level`='0' AND `kode_reaktivasi`='" . $kode_reaktivasi . "'";
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

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;

    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>