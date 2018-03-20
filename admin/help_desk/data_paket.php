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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data paket"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // menambil nilai/string yang ada pada url

        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
        $hari_ini = date("d");

        $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini;
        $total_hari_pengurangan = $jumlah_hari - $sum_aktivasi_sd_akhirbulan;

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Paket</h2>
                            </div>
                            
                            <div class="box-body table-responsive">
                                <div class="box-header"></div><!-- /.box-header -->
        
                                <form action="" method="post" name="form_search" id="form_search">
                                    <table class="form" width="80%">
                                        <tr>
                                            <td><label>ID Paket</label></td>
                                            <td>
                                              <input class="form-control" name="id_paket" placeholder="ID Paket" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Nama Paket</label></td>
                                            <td>
                                              <input class="form-control" name="nama_paket" placeholder="Nama Paket" type="text" value="">
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
            $id_paket = isset($_POST['id_paket']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_paket']))) : "";
            $nama_paket = isset($_POST['nama_paket']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_paket']))) : "";

            $sql_nama_paket = ($nama_paket != "") ? "AND `nama_paket` LIKE '" . $nama_paket . "%'" : "";

            $sql_paket = "SELECT * FROM `gx_paket2`
                WHERE `id_paket` LIKE '" . $id_paket . "%'
                $sql_nama_paket
                ORDER BY `id_paket` ASC LIMIT 0,10;";

            $content .= '
                <table class="table table-bordered table-striped" id="paket">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID Paket</th>
                            <th>Nama Paket</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';


            $query_paket = mysql_query($sql_paket, $conn);
            $no = 1;
            if (isset($_GET["f"])) {
                if ($_GET["f"] == "updown_connection") {
                    while ($row_paket = mysql_fetch_array($query_paket)) {
                        $tagihanperhari = $row_paket["monthly_fee"] / $jumlah_hari;
                        $total_tagihan = $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
                        $ppn = 10 / 100 * $total_tagihan;
                        $totalppn = $total_tagihan + $ppn;
                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_paket["id_paket"] . '</td>
                                <td>' . $row_paket["nama_paket"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_paket["kode_paket"]) . '\',\'' . mysql_real_escape_string($row_paket["nama_paket"]) . '\',\'' . number_format($row_paket["monthly_fee"], 2) . '\',\'' . number_format($tagihanperhari, 2) . '\',\'' . $sum_aktivasi_sd_akhirbulan . '\',\'' . number_format($total_tagihan, 2) . '\',\'' . number_format($ppn, 2) . '\',\'' . number_format($totalppn, 2) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                } elseif ($_GET["f"] == "konversi") {
                    while ($row_paket = mysql_fetch_array($query_paket)) {
                        $tagihanperhari = $row_paket["monthly_fee"] / $jumlah_hari;
                        $total_tagihan = $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
                        $ppn = 10 / 100 * $total_tagihan;
                        $totalppn = $total_tagihan + $ppn;
                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_paket["id_paket"] . '</td>
                                <td>' . $row_paket["nama_paket"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_paket["kode_paket"]) . '\',\'' . mysql_real_escape_string($row_paket["nama_paket"]) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                }
            } else {
            }

            $content .= '
                                        </tbody>
                                    </table>';
        }

        $content .= '
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
                    $(\'#paket\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>';
        if (isset($_GET["f"])) {
            if ($_GET["f"] == "updown_connection") {
                $plugins .= '
                    <script type="text/javascript">
                    	function validepopupform2(id_paket_func, nama_paket_func, monthly_func, daily_func, aktivasi_func, total_func, ppn, totalppn){
                    		window.opener.document.' . $return_form . '.kode_paket_baru.value=id_paket_func;
                    		window.opener.document.' . $return_form . '.nama_paket_baru.value=nama_paket_func;
                    		window.opener.document.' . $return_form . '.monthly_baru.value=monthly_func;
                    		window.opener.document.' . $return_form . '.daily_baru.value=daily_func;
                    		window.opener.document.' . $return_form . '.hari_aktivasi_baru.value=aktivasi_func;
                    		window.opener.document.' . $return_form . '.total_baru.value=total_func;
                    		window.opener.document.' . $return_form . '.ppn_baru.value=ppn;
                    		window.opener.document.' . $return_form . '.totalppn_baru.value=totalppn;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "konversi") {
                $plugins .= '
                    <script type="text/javascript">
                    	function validepopupform2(id_paket_func, nama_paket_func, monthly_func, daily_func, aktivasi_func, total_func, ppn, totalppn){
                    		window.opener.document.' . $return_form . '.kode_paket_baru.value=id_paket_func;
                    		window.opener.document.' . $return_form . '.nama_paket_baru.value=nama_paket_func;
                            self.close();
                        }
                    </script>';
            }
        } else {

        }

        $title = 'Data paket';
        $submenu = "helpdesk";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>