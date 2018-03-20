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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cabang"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // untuk mengambil nilai/string yang ada pada url

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data SPK Pasang Baru</h2>
                            </div>
				            <div class="box-body table-responsive">
				                <div class="box-header"></div><!-- /.box-header -->
				                
                                <form action="" method="post" name="form_search" id="form_search">
                                    <table class="form" width="80%">
                                        <tr>
                                            <td><label>No Link Budget</label></td>
                                            <td>
                                              <input class="form-control" name="no_link_budget" placeholder="Kode SPK" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Nama</label></td>
                                            <td>
                                              <input class="form-control" name="nama" placeholder="Name" type="text" value="">
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

            //mengambil nilai dari url
            $no_link_budget = isset($_POST['no_link_budget']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_link_budget']))) : "";
            $nama = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";

            $sql_nama = ($nama != "") ? "AND `nama_customer` LIKE '%" . $nama . "%'" : "";
            $sql_no_link_budget = ($no_link_budget != "") ? "AND `kode_spk` LIKE '%" . $no_link_budget . "%'" : "";

            $sql_spk_pasang_baru = "SELECT * FROM `gx_spk_pasang` WHERE `level` = '0' $sql_nama $sql_no_link_budget
                ORDER BY `date_add` DESC LIMIT 0,10;";
        } else {
            $sql_spk_pasang_baru = "SELECT * FROM `gx_spk_pasang` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' 
                AND `level` = '0' ORDER BY `date_add` DESC LIMIT 0,10;";
        }

        $content .= '
                                    <table class="table table-bordered table-striped" id="customer">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>No. SPK Pasang Baru</th>
                                                <th>Tanggal</th>
                                                <th>Kode Customer</th>
                                                <th>Nama Customer</th>
                                                <th>No. Link Budget</th>
                                                <th>Teknisi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';


        $query_spk_pasang_baru = mysql_query($sql_spk_pasang_baru, $conn);
        $no = 1;

        while ($row_spk_pasang_baru = mysql_fetch_array($query_spk_pasang_baru)) {

            $content .= '
                <tr>
                    <td>' . $no . '</td>
                    <td>' . $row_spk_pasang_baru["kode_spk"] . '</td>
                    <td>' . $row_spk_pasang_baru["tanggal"] . '</td>
                    <td>' . $row_spk_pasang_baru["id_customer"] . '</td>
                    <td>' . $row_spk_pasang_baru["nama_customer"] . '</td>
                    <td>' . $row_spk_pasang_baru["id_linkbudget"] . '</td>
                    <td>' . $row_spk_pasang_baru["nama_teknisi"] . '</td>
		            <td>
                        <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_spk_pasang_baru["kode_spk"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["id_customer"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["nama_customer"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["id_linkbudget"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["paket_koneksi"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["nama_koneksi"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["user_id"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["telpon"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["alamat"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["nama_teknisi"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["nama_marketing"]) . '\',';
                            $content .= '\'' . mysql_real_escape_string($row_spk_pasang_baru["pekerjaan"]) . '\')">Select
                        </a>
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
            <script type="text/javascript">
                function validepopupform2(v_kode_spk, v_id_customer, v_nama_customer, v_id_linkbudget, v_paket_koneksi, v_nama_koneksi, v_user_id, v_telpon, v_alamat, v_teknisi_cNama, v_marketing_cNama, v_pekerjaan){
                    window.opener.document.' . $return_form . '.kode_spk.value=v_kode_spk;
                    window.opener.document.' . $return_form . '.kode_customer.value=v_id_customer;
                    window.opener.document.' . $return_form . '.nama_customer.value=v_nama_customer;
                    window.opener.document.' . $return_form . '.id_linkbudget.value=v_id_linkbudget;
                    window.opener.document.' . $return_form . '.paket_koneksi.value=v_paket_koneksi;
                    window.opener.document.' . $return_form . '.nama_koneksi.value=v_nama_koneksi;
                    window.opener.document.' . $return_form . '.user_id.value=v_user_id;
                    window.opener.document.' . $return_form . '.telpon.value=v_telpon;
                    window.opener.document.' . $return_form . '.alamat.value=v_alamat;
                    window.opener.document.' . $return_form . '.nama_teknisi.value=v_teknisi_cNama;
                    window.opener.document.' . $return_form . '.nama_marketing.value=v_marketing_cNama;
                    window.opener.document.' . $return_form . '.pekerjaan.value=v_pekerjaan;
                    self.close();
                }
            </script>
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
            </script>';

        $title = 'Data SPK Pasang Baru';
        $submenu = "cabang";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>