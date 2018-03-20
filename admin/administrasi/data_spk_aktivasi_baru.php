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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data SPK Aktivasi Baru"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // untuk mengambil nilai/string yang ada pada url

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data SPK Aktivasi Baru</h2>
                            </div>
                            
				            <div class="box-body table-responsive">
				                <div class="box-header"></div><!-- /.box-header -->
                                    <form action="" method="post" name="form_search" id="form_search">
                                        <table class="form" width="80%">
                                            <tr>
                                                <td><label>Nama Customer</label></td>
                                                <td>
                                                  <input class="form-control" name="nama_customer" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>UserID</label></td>
                                                <td>
                                                  <input class="form-control" name="user_id" type="text" value="">
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
            $user_id = isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";


            $sql_nama = ($nama_customer != "") ? "AND `nama_customer` LIKE '%" . $nama_customer . "%'" : "";
            $sql_uid = ($user_id != "") ? "AND `user_id` LIKE '%" . $user_id . "%'" : "";

            $sql_spk_aktivasi_baru = "SELECT * FROM `gx_spk_aktivasi`
                WHERE `id_cabang` = '" . $loggedin['cabang'] . "'
                AND  `level` = '0'
                $sql_nama
                $sql_uid
                ORDER BY `id_spkaktivasi` DESC LIMIT 0,10;";
        } else {
            $sql_spk_aktivasi_baru = "SELECT * FROM `gx_spk_aktivasi` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND  `level` = '0' ORDER BY `id_spkaktivasi` DESC ;";
        }

        $content .= '
            <table class="table table-bordered table-striped" id="customer">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode SPK</th>
                        <th>Tanggal</th>
                        <th>Kode Customer</th>
                        <th>UserID</th>
                        <th>Link Budget</th>
                        <th>Teknisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';


        $query_spk_aktivasi_baru = mysql_query($sql_spk_aktivasi_baru, $conn);
        $no = 1;
        if (isset($_GET["f"])) {
            if ($_GET["f"] == "aktivasi") {
                $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
                $hari_ini = date("d");

                $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini + 1;
                $total_hari_pengurangan = $jumlah_hari - $sum_aktivasi_sd_akhirbulan;

                while ($row_spk_aktivasi_baru = mysql_fetch_array($query_spk_aktivasi_baru)) {
                    $row_spk_aktivasi_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$row_spk_aktivasi_baru[id_teknisi]'", $conn));
                    $row_spk_aktivasi_baru_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$row_spk_aktivasi_baru[id_marketing]'", $conn));

                    $row_linkbudget = mysql_fetch_array(mysql_query("SELECT `id_link_budget` FROM `gx_link_budget` WHERE `no_linkbudget`='$row_spk_aktivasi_baru[id_linkbudget]'", $conn));

                    $row_paket = mysql_fetch_array(mysql_query("SELECT * FROM `gx_paket2` WHERE `kode_paket` = '" . $row_spk_aktivasi_baru["paket_koneksi"] . "' ORDER BY `id_paket` DESC LIMIT 0,10;", $conn));
                    $tagihanperhari = $row_paket["monthly_fee"] / $jumlah_hari;
                    $total_tagihan = $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
                    $ppn = 10 / 100 * $row_paket["monthly_fee"];
                    $totalppn = $row_paket["monthly_fee"] + $ppn;

                    $tanggal = date("d");

                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_spk_aktivasi_baru["kode_spkaktivasi"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["tanggal"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["id_customer"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["nama_customer"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["id_linkbudget"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["nama_teknisi"] . '</td>
                        <td>';

                    if ($row_spk_aktivasi_baru["id_linkbudget"] != "") {
                        $content .= '<a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_customer"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_customer"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["paket_koneksi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_koneksi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["user_id"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["telpon"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["alamat"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_teknisi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_teknisi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_marketing"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_marketing"]) . '\',';
                        $content .= '\'' . number_format($row_paket["monthly_fee"], 0) . '\',';
                        $content .= '\'' . number_format($row_paket["monthly_fee"], 0) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_linkbudget"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_linkbudget["id_link_budget"]) . '\')">Select</a>';
                    } else {
                        $content .= 'Select';
                    }
                    $content .= '
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "aktivasi_prorate") {
                $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
                $hari_ini = date("d");

                $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini + 1;
                $total_hari_pengurangan = $jumlah_hari - $sum_aktivasi_sd_akhirbulan;

                while ($row_spk_aktivasi_baru = mysql_fetch_array($query_spk_aktivasi_baru)) {
                    $row_spk_aktivasi_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$row_spk_aktivasi_baru[id_teknisi]'", $conn));
                    $row_spk_aktivasi_baru_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$row_spk_aktivasi_baru[id_marketing]'", $conn));

                    $row_linkbudget = mysql_fetch_array(mysql_query("SELECT `id_link_budget` FROM `gx_link_budget` WHERE `no_linkbudget`='$row_spk_aktivasi_baru[id_linkbudget]'", $conn));

                    $row_paket = mysql_fetch_array(mysql_query("SELECT * FROM `gx_paket2` WHERE `kode_paket` = '" . $row_spk_aktivasi_baru["paket_koneksi"] . "' ORDER BY `id_paket` DESC LIMIT 0,10;", $conn));
                    $tagihanperhari = ($row_paket["monthly_fee"] + $row_paket["abonemen_video"]) / $jumlah_hari;
                    $total_tagihan = $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
                    $ppn = 10 / 100 * $total_tagihan;
                    $totalppn = $total_tagihan + $ppn;

                    $tanggal = date("d");

                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_spk_aktivasi_baru["kode_spkaktivasi"] . '</td>
                            <td>' . date("d-m-Y", strtotime($row_spk_aktivasi_baru["tanggal"])) . '</td>
                            <td>' . $row_spk_aktivasi_baru["id_customer"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["user_id"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["id_linkbudget"] . '</td>
                            <td>' . $row_spk_aktivasi_baru["nama_teknisi"] . '</td>
                            <td>';
                    if ($row_spk_aktivasi_baru["id_linkbudget"] != "") {
                        $content .= '<a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_customer"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_customer"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["paket_koneksi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_koneksi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["user_id"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["telpon"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["alamat"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_teknisi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_teknisi"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_marketing"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_marketing"]) . '\',';


                        $content .= '\'' . number_format($row_paket["monthly_fee"], 0) . '\',';
                        $content .= '\'' . number_format($tagihanperhari, 0) . '\',';
                        $content .= '\'' . $sum_aktivasi_sd_akhirbulan . '\',';
                        $content .= '\'' . number_format($total_tagihan, 0) . '\',';
                        $content .= '\'' . number_format($ppn, 0) . '\',';
                        $content .= '\'' . number_format($totalppn, 0) . '\',';

                        $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_linkbudget"]) . '\',';
                        $content .= '\'' . mysql_real_escape_string($row_linkbudget["id_link_budget"]) . '\')">Select</a>';
                    } else {
                        $content .= 'Select';
                    }
                    $content .= '
                            </td>
                        </tr>';

                    $no++;
                }
            }

        } else {
            while ($row_spk_aktivasi_baru = mysql_fetch_array($query_spk_aktivasi_baru)) {
                $row_spk_aktivasi_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_spk_aktivasi_baru[id_teknisi]'", $conn));
                $row_spk_aktivasi_baru_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_spk_aktivasi_baru[id_marketing]'", $conn));

                $tanggal = date("d");

                $content .= '
                    <tr>
                        <td>' . $no . '</td>
                        <td>' . $row_spk_aktivasi_baru["kode_spkaktivasi"] . '</td>
                        <td>' . $row_spk_aktivasi_baru["tanggal"] . '</td>
                        <td>' . $row_spk_aktivasi_baru["id_customer"] . '</td>			
                        <td>' . $row_spk_aktivasi_baru["nama_customer"] . '</td>
                        <td>' . $row_spk_aktivasi_baru["id_linkbudget"] . '</td>
                        <td>' . $row_spk_aktivasi_baru["nama_teknisi"] . '</td>
                        <td>';
                if ($row_spk_aktivasi_baru["id_linkbudget"] != "") {
                    $content .= '<a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_spk_aktivasi_baru["kode_spkaktivasi"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_customer"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_customer"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["id_linkbudget"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["paket_koneksi"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_koneksi"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["user_id"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["telpon"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["alamat"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_teknisi"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["nama_marketing"]) . '\',';
                    $content .= '\'' . mysql_real_escape_string($row_spk_aktivasi_baru["pekerjaan"]) . '\')">Select</a>';
                } else {
                    $content .= 'Select';
                }
                $content .= '
                        </td>
                    </tr>';

                $no++;
            }
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
        if (isset($_GET["f"])) {
            if ($_GET["f"] == "aktivasi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(cidcustomer,cnamacustomer,cpaketkoneksi,cnamakoneksi,cuserid,ctelpon,calamat,cidteknisi,cnamateknisi,cidmarketing,cnamamarketing, monthly_func, total_func, no_linkbudget_func, id_link_budget_func){
                            window.opener.document.' . $return_form . '.id_customer.value=cidcustomer;
                            window.opener.document.' . $return_form . '.nama_customer.value=cnamacustomer;
                            window.opener.document.' . $return_form . '.paket_koneksi.value=cpaketkoneksi;
                            window.opener.document.' . $return_form . '.nama_koneksi.value=cnamakoneksi;
                            window.opener.document.' . $return_form . '.user_id.value=cuserid;
                            window.opener.document.' . $return_form . '.telpon.value=ctelpon;
                            window.opener.document.' . $return_form . '.alamat.value=calamat;
                            window.opener.document.' . $return_form . '.monthly.value=monthly_func;
                          
                            window.opener.document.' . $return_form . '.acc_total.value=total_func;
                            window.opener.document.' . $return_form . '.id_teknisi.value=cidteknisi;
                            window.opener.document.' . $return_form . '.nama_teknisi.value=cnamateknisi;
                            window.opener.document.' . $return_form . '.id_employee.value=cidmarketing;
                            window.opener.document.' . $return_form . '.nama_marketing.value=cnamamarketing;
                            window.opener.document.' . $return_form . '.id_linkbudget.value=no_linkbudget_func;
                            window.opener.document.getElementById(\'linkk\').href  =\'detail_link_budget.php?id=\'+id_link_budget_func;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "aktivasi_prorate") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(cidcustomer,cnamacustomer,cpaketkoneksi,cnamakoneksi,cuserid,ctelpon,calamat,cidteknisi,cnamateknisi,cidmarketing,cnamamarketing, monthly_func, daily_func, hari_func, total_func, ppn_func, totalppn_func, no_linkbudget_func, id_link_budget_func){
                            window.opener.document.' . $return_form . '.id_customer.value=cidcustomer;
                            window.opener.document.' . $return_form . '.nama_customer.value=cnamacustomer;
                            window.opener.document.' . $return_form . '.paket_koneksi.value=cpaketkoneksi;
                            window.opener.document.' . $return_form . '.nama_koneksi.value=cnamakoneksi;
                            window.opener.document.' . $return_form . '.user_id.value=cuserid;
                            window.opener.document.' . $return_form . '.telpon.value=ctelpon;
                            window.opener.document.' . $return_form . '.alamat.value=calamat;
                            window.opener.document.' . $return_form . '.monthly.value=monthly_func;
                            window.opener.document.' . $return_form . '.daily.value=daily_func;
                            window.opener.document.' . $return_form . '.hari_aktivasi.value=hari_func;
                            window.opener.document.' . $return_form . '.total.value=total_func;
                            window.opener.document.' . $return_form . '.ppn.value=ppn_func;
                            window.opener.document.' . $return_form . '.totalppn.value=totalppn_func;
                            window.opener.document.' . $return_form . '.acc_monthly.value=monthly_func;
                            window.opener.document.' . $return_form . '.acc_daily.value=daily_func;
                            window.opener.document.' . $return_form . '.acc_hari_aktivasi.value=hari_func;
                            window.opener.document.' . $return_form . '.acc_total.value=total_func;
                            window.opener.document.' . $return_form . '.acc_ppn.value=ppn_func;
                            window.opener.document.' . $return_form . '.acc_totalppn.value=totalppn_func;
                            window.opener.document.' . $return_form . '.id_teknisi.value=cidteknisi;
                            window.opener.document.' . $return_form . '.nama_teknisi.value=cnamateknisi;
                            window.opener.document.' . $return_form . '.id_employee.value=cidmarketing;
                            window.opener.document.' . $return_form . '.nama_marketing.value=cnamamarketing;
                            window.opener.document.' . $return_form . '.id_linkbudget.value=no_linkbudget_func;
                            window.opener.document.getElementById(\'linkk\').href  =\'detail_link_budget.php?id=\'+id_link_budget_func;
                            self.close();
                        }
                    </script>';
            }
        } else {
            $plugins .= '
                <script type="text/javascript">
                    function validepopupform2(v_kode_spk, v_id_customer, v_nama_customer, v_id_linkbudget, v_paket_koneksi, v_nama_koneksi, v_user_id, v_telpon, v_alamat, v_teknisi_cNama, v_marketing_cNama, v_pekerjaan){
                        window.opener.document.' . $return_form . '.kode_spk.value=v_kode_spk;
                        window.opener.document.' . $return_form . '.kode_customer.value=v_id_customer;
                        window.opener.document.' . $return_form . '.nama_customer.value=v_nama_customer;
                        window.opener.document.' . $return_form . '.no_link_budget.value=v_id_linkbudget;
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
                </script>';
        }

        $title = 'Data Aktivasi';
        $submenu = "Aktivasi";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>