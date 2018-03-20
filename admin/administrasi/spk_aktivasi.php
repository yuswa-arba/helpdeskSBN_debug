<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../config/configuration_admin.php");

redirectToHTTPS();

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        enableLog("", $loggedin["username"], $loggedin["username"], "Open SPK Aktivasi");

        global $conn;
        global $conn_voip;

        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
			                <div class="box-body table-responsive">
			                    <div class="box-header">
                                    <h3 class="box-title">List SPK Aktivasi</h3>
				                    <a href="form_spk_aktivasi_baru.php" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                <table id="persetujuan" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
						                    <th>#</th>
                                            <th>No. SPK Aktivasi</th>
                                            <th>No. SPK Pasang</th>
											<th>Tanggal</th>
                                            <th>Nama Cust</th>
                                            <th>Alamat</th>
						                    <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $sql_spk_aktivasi = mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `level` = '0' ORDER BY `id_spkaktivasi` DESC LIMIT $start,$perhalaman;", $conn);
        $sql_total_spk_aktivasi = mysql_num_rows(mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `level` = '0' ORDER BY `id_spkaktivasi` DESC;", $conn));
        $hal = "?";
        $no = 1;
        while ($row_spk_aktivasi = mysql_fetch_array($sql_spk_aktivasi)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $row_spk_aktivasi['kode_spkaktivasi'] . '</td>
                    <td>' . $row_spk_aktivasi['kode_spkpasang'] . '</td>
                    <td>' . date("d-m-Y", strtotime($row_spk_aktivasi['tanggal'])) . '</td>
                    <td>' . $row_spk_aktivasi['nama_customer'] . '</td>
                    <td>' . $row_spk_aktivasi['alamat'] . '</td>
                    <td align="center">
                    <a href="spk_aktivasi_pdf.php?id_spk=' . $row_spk_aktivasi['id_spkaktivasi'] . '" target="_blank"><span class="label label-success">View PDF</span></a>
                    <a href="form_spk_aktivasi_baru.php?id=' . $row_spk_aktivasi['id_spkaktivasi'] . '"><span class="label label-info">Edit</span></a>
                    </td>
                </tr>';

            $no++;
        }

        $content .= '
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="box-tools pull-right">
                                ' . (halaman($sql_total_spk_aktivasi, $perhalaman, 1, $hal)) . '
                                </div>
                                <br style="clear:both;">
                            </div>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '
            <link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />
            <!-- DataTable -->
            <link href="' . URL . 'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
            <!-- DATA TABES SCRIPT -->
            <script src="' . URL . 'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $(\'#customer\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>
            
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="' . URL . 'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    
            <!-- AdminLTE for demo purposes -->
            <script src="' . URL . 'js/AdminLTE/demo.js" type="text/javascript"></script>';

        $title = 'Master SPK aktivasi';
        $submenu = "spk_aktivasi";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>