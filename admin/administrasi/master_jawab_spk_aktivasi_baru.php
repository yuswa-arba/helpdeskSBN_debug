<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 21 February 2015
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include("../../config/configuration_admin.php");

redirectToHTTPS();

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn_helpdesk;
        global $conn;

        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        $ttl = "";

        $ttl .= (isset($_GET['type']) && $_GET['type'] == "complaint") ? "master Jawaban SPK aktivasi" : "";
        $content = '
            <!-- Main content -->
            <section class="content">
		        <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <a href="form_jawab_spk_aktivasi_baru.php" class="btn bg-maroon btn-flat margin">Add Jawab SPK Aktivasi Baru</a>
                            </div>
                        </div>
                    </div>
                </div>

		        <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">' . $ttl . '</h3>                                    
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">';

        $type = isset($_GET['type']) ? $_GET['type'] : '';

        $content .= '
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>	
                                            <th>no</th>
                                            <th>Tanggal</th>
                                            <th>No. Jawab SPK</th>
                                            <th>Nama Customer</th>
                                            <th>Cabang</th>
                                            <th>Paket Koneksi</th>
                                            <th>Pekerjaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $sql_jawaban_spk_aktivasi_baru = mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` 
            WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND  `level` =  '0' ORDER BY  `date_add` DESC LIMIT $start, $perhalaman;", $conn);

        $sql_total_jawaban_spk_aktivasi_baru = mysql_num_rows(mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` 
            WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND  `level` =  '0' ORDER BY  `date_add` DESC;", $conn));

        $hal = "?";
        $no = 1;

        while ($r_jawaban_spk_aktivasi_baru = mysql_fetch_array($sql_jawaban_spk_aktivasi_baru)) {
            $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $r_jawaban_spk_aktivasi_baru['id_cabang'] . "' LIMIT 1;", $conn);
            $row_cabang = mysql_fetch_array($sql_cabang);

            $content .= '
            <tr>
                <td>' . $no . '.</td>
                <td>' . date("d-m-Y", strtotime($r_jawaban_spk_aktivasi_baru['tanggal'])) . '</td>
                <td>' . $r_jawaban_spk_aktivasi_baru['kode_jawab_aktivasi'] . '</td>
                <td>' . $r_jawaban_spk_aktivasi_baru['nama_customer'] . '</td>
                <td>' . $row_cabang['nama_cabang'] . '</td>
                <td>' . $r_jawaban_spk_aktivasi_baru['paket_koneksi'] . '</td>
                <td>' . $r_jawaban_spk_aktivasi_baru['pekerjaan'] . '</td>
                <td>
                    <a href="detail_jawab_spk_aktivasi_baru.php?id=' . $r_jawaban_spk_aktivasi_baru["id_jawab_spkaktivasi"] . '" onclick="return valideopenerform(\'detail_jawab_spk_aktivasi_baru.php?id=' . $r_jawaban_spk_aktivasi_baru["id_jawab_spkaktivasi"] . '\',\'detail\');">Details</a>
                    || <a href="form_jawab_spk_aktivasi_baru.php?id=' . $r_jawaban_spk_aktivasi_baru["id_jawab_spkaktivasi"] . '">edit</a> ||
                    <a href="update_alat.php?id=' . $r_jawaban_spk_aktivasi_baru["id_linkbudget"] . '&spk=' . $r_jawaban_spk_aktivasi_baru["kode_jawab_aktivasi"] . '">Update Alat</a>
                </td>
			</tr>';

            $no++;
        }

        $content .= '
                                            </tbody>
                                        </table>
                                    </div>';

        $submenu = "master_jawaban_spk_aktivasi_baru";


        $content .= '
                                    <br />
                                </div>
                            <div class="box-footer">
                        <div class="box-tools pull-right">
                            ' . (halaman($sql_total_jawaban_spk_aktivasi_baru, $perhalaman, 1, $hal)) . '
                        </div>
                        <br style="clear:both;">
                    </div>
                </div>
            </section>';

    } else {
        $content = '<!-- Main content -->
            <section class="content">
                <div class="box round first">
                    <h2> Sorry, You don\'t have permission to access this Page</h2>
                    <div class="block"></div> 
                </div>
	        </section>';

        $submenu = "master_dashboard";
    }

    $plugins = '
	    <link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable({
               "bPaginate": true,
               "bLengthChange": false,
               "bFilter": false,
               "bSort": false,
               "bInfo": true,
               "bAutoWidth": false
            });
        </script>';

    $title = 'Master SPK Aktivasi Baru';
    $user = ucfirst($loggedin["username"]);
    $group = $loggedin['group'];

    $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

    echo $template;
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>