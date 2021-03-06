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

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data marketing"); // for create log in newfunction2.php

        global $conn; // untuk konek ke database

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // untuk mengambil nilai/string yang ada pada url

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Teknisi</h2>
                            </div>
				            <div class="box-body table-responsive">
				                <div class="box-header"></div><!-- /.box-header -->
                                <form action="" method="post" name="form_search" id="form_search">
                                    <table class="form" >
                                        <tr>
                                            <td width="12.5%"><label>ID Teknisi*</label></td>
                                            <td width="37.5%">
                                              <input class="form-control" name="id_staff" placeholder="ID Marketing" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Name</label></td>
                                            <td>
                                              <input class="form-control" name="nama_staff" placeholder="Name" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                              <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
                                            </td>
                                        </tr>
                                    </table>';

        if (isset($_POST["save_search"])) {
            $user_id = isset($_POST['id_staff']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_staff']))) : "";
            $name = isset($_POST['nama_staff']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_staff']))) : "";

            $sql_nama = ($name != "") ? "AND `nama` LIKE '" . $name . "%'" : "";
            $sql_userid = ($user_id != " ") ? "AND `id_employee` LIKE '%" . $user_id . "%'" : "";

            $sql_employee = "SELECT * FROM `gx_pegawai`
                WHERE `id_employee` != '2'
                AND `level` = '0'
                $sql_nama
                $sql_userid
                ORDER BY `nama` ASC LIMIT 0,10;";
        } else {
            $sql_employee = "SELECT * FROM `gx_pegawai`
                WHERE `id_employee` != '2'
                AND `level` = '0'
                ORDER BY `nama` ASC LIMIT 0,10;";
        }

        $content .= '
                                    <table class="table table-bordered table-striped" id="tech">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Teknisi</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';


        $query_employee = mysql_query($sql_employee, $conn);
        $no = 1;

        while ($row_employee = mysql_fetch_array($query_employee)) {

            $content .= '
                <tr>
                    <td>' . $no . '.</td>
			        <td>' . $row_employee["kode_pegawai"] . '</td>
                    <td>' . $row_employee["nama"] . '</td>
                    <td><a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_employee["kode_pegawai"]) . '\',\'' . mysql_real_escape_string($row_employee["nama"]) . '\')">Select</a>
                    </td>
                </tr>';
            $no++;
        }

        $content .= '
                                        </tbody>
                                    </table>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '
            <!-- DataTable -->
            <link href="' . URL . 'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
            <!-- DATA TABES SCRIPT -->
            <script src="' . URL . 'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $(\'#tech\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>';

        if (isset($_GET["t"])) {

            if ($_GET["t"] == "2") {

                $plugins .= '
                    <script type=\'text/javascript\'>
                        function validepopupform2(uid,  nama){
                            window.opener.document.' . $return_form . '.id_teknisi_2.value=uid;
                            window.opener.document.' . $return_form . '.nama_teknisi_2.value=nama;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["t"] == "3") {
                $plugins .= '
                    <script type=\'text/javascript\'>
                        function validepopupform2(uid,  nama){
                            window.opener.document.' . $return_form . '.id_teknisi_3.value=uid;
                            window.opener.document.' . $return_form . '.nama_teknisi_3.value=nama;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["t"] == "4") {
                $plugins .= '
                    <script type=\'text/javascript\'>
                        function validepopupform2(uid,  nama){
                            window.opener.document.' . $return_form . '.id_teknisi_4.value=uid;
                            window.opener.document.' . $return_form . '.nama_teknisi_4.value=nama;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["t"] == "5") {
                $plugins .= '
                    <script type=\'text/javascript\'>
                        function validepopupform2(uid,  nama){
                            window.opener.document.' . $return_form . '.id_teknisi_5.value=uid;
                            window.opener.document.' . $return_form . '.nama_teknisi_5.value=nama;
                            self.close();
                        }
                    </script>';
            }
        } else {
            $plugins .= '
                <script type=\'text/javascript\'>
                    function validepopupform2(uid,  nama){
                        window.opener.document.' . $return_form . '.id_teknisi.value=uid;
                        window.opener.document.' . $return_form . '.nama_teknisi.value=nama;
                        self.close();
                    }
                </script>';
        }

        $title = 'Data teknisi';
        $submenu = "data_teknisi";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>