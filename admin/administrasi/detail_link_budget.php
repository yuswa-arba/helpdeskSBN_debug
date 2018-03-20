<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include("../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;

        /** ====================================================================
         * Mengambil data yang akan ditampilkan sesuai dengan id yang ada di url
         * =================================================================== */
        if (isset($_GET['id'])) {

            // menambil nilai/string yang ada pada url
            $act = isset($_GET['edit']) ? mysql_real_escape_string(strip_tags(trim($_GET['edit']))) : "";
            $id_data = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";

            $sql_data = "SELECT * FROM `gx_link_budget` WHERE `id_link_budget` = '" . $id_data . "';";
            $query_data = mysql_query($sql_data, $conn);
            $row_data = mysql_fetch_array($query_data);

            $sql_data_detail = "SELECT * FROM `gx_link_budget_detail` WHERE `no_linkbudget` = '" . $row_data["no_linkbudget"] . "';";
            $query_data_detail = mysql_query($sql_data_detail, $conn);
            $total_data_detail = mysql_num_rows($query_data_detail);

        }

        $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Data Link Budget</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No. Link Budget</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['no_linkbudget'] : "") . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Tanggal</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['tanggal'] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Kode Customer</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['kode_cust'] : "") . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>nama Customer</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['nama_cust'] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Longitude</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['longitude'] : "") . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Latitude</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['latitude'] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>OLT</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['olt'] : "") . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>VLAN</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['vlan'] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>EPON</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['epon'] : "") . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>EPON Number</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['epon_id'] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No. Tiang Terdekat</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['tiang_terdekat'] : "") . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Name Created</label>
                                            </div>
                                            <div class="col-xs-4">
                                                ' . (isset($_GET["id"]) ? $row_data['user_created'] . '(' . $row_data['date_add'] . ')' : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Power Budget</label>
                                            </div>
                                            <div class="col-xs-10">
                                                ' . (isset($_GET["id"]) ? $row_data['power_budget'] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label>Alat yang dibutuhkan</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table id="linkbudget" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>Qty</th>
                                                            <th>Serial Number</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

        $total = 0;
        $no = 1;

        while ($row_detail = mysql_fetch_array($query_data_detail)) {

            $content .= '
                <tr valign="top">    
					<td>' . $no . '</td>
					<td>' . $row_detail["nama_barang"] . '</td>
					<td>' . $row_detail["qty"] . '</td>
					<td>' . $row_detail["serial_number"] . '</td>
				</tr>';

            $no++;

        }

        $content .= '
                                                      </tbody>
                                                 </table>
					                        </div>
                                        </div>
					                </div>
					                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Created By</label>
                                            </div>
                                            <div class="col-xs-6">
                                                ' . (isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]) . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Latest Update By </label>
                                            </div>
                                            <div class="col-xs-6">
                                                ' . (isset($_GET['id']) ? $row_data["user_upd"] . " " . $row_data["date_upd"] : "") . '
                                            </div>                      
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

        $plugins = '';

        $title = 'Detail Link Budget';
        $submenu = "link_budget";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>