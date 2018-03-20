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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Inactive"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // for create log in newfunction2.php

        $content = '
            <section class="content-header">
                <h1>
                    Data Off Connection
                </h1>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
			                <div class="box-header">
                                <h2 class="box-title">Data Off Connection</h2>
                            </div>
                            
                            <div class="box-body table-responsive">
                                <div class="box-header"></div><!-- /.box-header -->
                                
                                <form action="" method="post" name="form_search" id="form_search">
                                    <table class="form" width="80%">
                                        <tr>
                                            <td><label>Kode Off Connection</label></td>
                                            <td>
                                              <input class="form-control" name="kode_off_connection" placeholder="Kode Off Connection" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Kode Customer</label></td>
                                            <td>
                                              <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Nama Customer</label></td>
                                            <td>
                                              <input class="form-control" name="name" placeholder="kode_inactive" type="text" value="">
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
            $kode_off_connection = isset($_POST['kode_off_connection']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_off_connection']))) : "";
            $kode_customer = isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";


            $sql_kode_customer = ($kode_customer != "") ? "AND `kode_customer` LIKE '%" . $kode_customer . "%'" : "";
            $sql_nama_customer = ($nama_customer != "") ? "AND `nama_customer` LIKE '%" . $nama_customer . "%'" : "";

            $sql_off_connection_exe = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_off_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_off_connection` WHERE
                `kode_off_connection` LIKE '%" . $kode_off_connection . "%'
                " . $sql_kode_customer . "
                " . $sql_nama_customer . "
                AND `level`='0' AND `status`='0' ORDER BY `id` ASC LIMIT 0,10";
        } else {
            $sql_off_connection_exe = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_off_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_off_connection` WHERE `level`='0' ORDER BY `id` ASC LIMIT 0,10";
        }
        $content .= '
            <table class="table table-bordered table-striped" id="customer">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Off Connection</th>
                        <th>Kode Customer</th>
                        <th>Nama Customer</th>
                        <th>Status Inactive</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';


        $query = mysql_query($sql_off_connection_exe, $conn);
        $no = 1;
        if (isset($_GET["f"])) {
            if ($_GET["f"] == "data_spk_bongkar") {
                while ($row = mysql_fetch_array($query)) {
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row["kode_off_connection"] . '</td>
                            <td>' . $row["kode_customer"] . '</td>
                            <td>' . $row["nama_customer"] . '</td>
                            <td>' . $row["status_inactive"] . '</td>
                            <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row["kode_off_connection"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            }
            if ($_GET["f"] == "data_spk_maintance") {
                while ($row = mysql_fetch_array($query)) {
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row["kode_off_connection"] . '</td>
                            <td>' . $row["kode_customer"] . '</td>
                            <td>' . $row["nama_customer"] . '</td>
                            <td>' . $row["status_inactive"] . '</td>
                            <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row["kode_off_connection"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            }
        } else {
            while ($row_customer = mysql_fetch_array($query_customer)) {
                $content .= '
                    <tr>
                        <td>' . $no . '</td>
                        <td>' . $row_customer["cKode"] . '</td>
                        <td>' . $row_customer["cUserID"] . '</td>
                        <td>' . $row_customer["cNama"] . '</td>
                        <td>' . $row_customer["cAlamat1"] . '</td>
                        <td>
                          <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($row_customer["cAlamat1"]) . '\',\'' . mysql_real_escape_string($row_customer["cNamaPers"]) . '\',\'' . mysql_real_escape_string($row_customer["cKota"]) . '\',\'' . mysql_real_escape_string($row_customer["cfax"]) . '\',\'' . mysql_real_escape_string($row_customer["ctelp"]) . '\',\'' . mysql_real_escape_string($row_customer["cEmail"]) . '\',\'' . mysql_real_escape_string($row_customer["cPaket"]) . '\',\'' . mysql_real_escape_string($row_customer["cNoHp1"]) . '\',\'' . mysql_real_escape_string($row_customer["cNoHp2"]) . '\',\'' . mysql_real_escape_string($row_customer["cContact"]) . '\')">Select</a>
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
            if ($_GET["f"] == "data_spk_bongkar") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(koc){
                            window.opener.document.' . $return_form . '.no_off_connection.value=koc;
                            self.close();
                        }
                    </script>';
            }
            if ($_GET["f"] == "data_spk_maintance") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(koc){
                            window.opener.document.' . $return_form . '.no_off_connection.value=koc;
                            self.close();
                        }
                    </script>';
            }
        } else {
            $plugins .= '
                <script type="text/javascript">
                    function validepopupform2(uid, custNumber, nama, alamat, namaperusahaan, kota, fax, ctelp, cemail, con_type, hp1, hp2, contact){
                        window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
                        window.opener.document.' . $return_form . '.nama_customer.value=nama;
                        window.opener.document.' . $return_form . '.nama_perusahaan.value=namaperusahaan;
                        window.opener.document.' . $return_form . '.alamat.value=alamat;
                        window.opener.document.' . $return_form . '.kota.value=kota;
                        window.opener.document.' . $return_form . '.notelp.value=ctelp;
                        window.opener.document.' . $return_form . '.hp1.value=hp1;
                        window.opener.document.' . $return_form . '.hp2.value=hp2;
                        window.opener.document.' . $return_form . '.contact.value=contact;
                        window.opener.document.' . $return_form . '.email.value=cemail;
                        self.close();
                    }
                </script>';
        }

        $title = 'Data Off Connection';
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