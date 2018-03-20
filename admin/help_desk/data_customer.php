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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Customer"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // menambil nilai/string yang ada pada url

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Customer</h2>
                            </div>
                            
                            <div class="box-body table-responsive">
				                <div class="box-header"></div><!-- /.box-header -->
                                    <form action="" method="post" name="form_search" id="form_search">
                                        <table class="form" width="80%">
                                            <tr>
                                                <td><label>User ID *</label></td>
                                                <td>
                                                    <input class="form-control" name="user_id" placeholder="User ID" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Customer Number</label></td>
                                                <td>
                                                    <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Name</label></td>
                                                <td>
                                                    <input class="form-control" name="name" placeholder="Name" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Address</label></td>
                                                <td>
                                                    <textarea name="address" rows="6" cols="40" style="resize: none;"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Phone</label></td>
                                                <td>
                                                    <input class="form-control" name="phone" placeholder="Phone" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Email</label></td>
                                                <td>
                                                    <input class="form-control" name="email" placeholder="Email" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>mother Name</label></td>
                                                <td>
                                                    <input class="form-control" name="nama_ibu" placeholder="Nama Ibu" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Date of Birth</label></td>
                                                <td>
                                                    <input class="form-control" name="tgl_lahir" placeholder="Tgl Lahir" type="text" value="">
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
            $customer_number = isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
            $name = isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
            //$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
            $address = isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
            $phone = isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
            $email = isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
            $nama_ibu = isset($_POST['nama_ibu']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ibu']))) : "";
            $tgl_lahir = isset($_POST['tgl_lahir']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_lahir']))) : "";


            $sql_nama = ($name != "") ? "AND `cNama` LIKE '" . $name . "%'" : "";
            $sql_userid = ($user_id != "") ? "AND `cUserID` LIKE '%" . $user_id . "%'" : "";
            $sql_address = ($address != "") ? "AND `cAlamat1` LIKE '%" . $address . "%'" : "";
            $sql_email = ($email != "") ? "AND `cEmail` LIKE '%" . $email . "%'" : "";
            $sql_phone = ($phone != "") ? "AND `ctelp` LIKE '%" . $phone . "%'" : "";
            $sql_namaibu = ($nama_ibu != "") ? "AND `cNamaIbu` LIKE '%" . $nama_ibu . "%'" : "";
            $sql_tgl_lahir = ($tgl_lahir != "") ? "AND `dTglLahir` LIKE '%" . $tgl_lahir . "%'" : "";

            $sql_customer = "SELECT * FROM `tbCustomer`
                WHERE `cKode` LIKE '" . $customer_number . "%'
                $sql_nama
                $sql_userid
                $sql_address
                $sql_email
                $sql_phone
                $sql_namaibu
                $sql_tgl_lahir
                ORDER BY `idCustomer` DESC LIMIT 0,10;";

            $content .= '
                <table class="table table-bordered table-striped" id="customer">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Customer Number</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            $query_customer = mysql_query($sql_customer, $conn);
            $no = 1;
            if (isset($_GET["f"])) {
                if ($_GET["f"] == "grace_customer") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_customer["cKode"] . '</td>
                                <td>' . $row_customer["cUserID"] . '</td>
                                <td>' . $row_customer["cNama"] . '</td>
                                <td>' . $row_customer["cAlamat1"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cKode"]) . '\', \'' . mysql_real_escape_string($row_customer["cNama"]) . '\', \'' . mysql_real_escape_string($row_customer["cUserID"]) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                } elseif ($_GET["f"] == "updown_connection") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_paket = "SELECT * FROM `gx_paket2` WHERE `kode_paket` = '" . $row_customer["cKdPaket"] . "' ORDER BY `id_paket` ASC LIMIT 0,1;";
                        $query_paket = mysql_query($sql_paket, $conn);
                        $row_paket = mysql_fetch_array($query_paket);

                        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
                        $hari_ini = date("d");

                        $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini; //baru
                        $total_hari_pengurangan = $jumlah_hari - $sum_aktivasi_sd_akhirbulan; //lama

                        $tagihanperhari = $row_paket["monthly_fee"] / $jumlah_hari;
                        $total_tagihan = $total_hari_pengurangan * $tagihanperhari;
                        $ppn = 10 / 100 * $total_tagihan;
                        $totalppn = $total_tagihan + $ppn;

                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_customer["cKode"] . '</td>
                                <td>' . $row_customer["cUserID"] . '</td>
                                <td>' . $row_customer["cNama"] . '</td>
                                <td>' . $row_customer["cAlamat1"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cKode"]) . '\', \'' . mysql_real_escape_string($row_customer["cNama"]) . '\', \'' . mysql_real_escape_string($row_customer["cUserID"]) . '\', \'' . mysql_real_escape_string($row_customer["cKdPaket"]) . '\', \'' . mysql_real_escape_string($row_customer["cPaket"]) . '\', \'' . mysql_real_escape_string($row_customer["cGroupRBS"]) . '\',\'' . number_format($row_paket["monthly_fee"], 2) . '\',\'' . number_format($tagihanperhari, 2) . '\',\'' . $total_hari_pengurangan . '\',\'' . number_format($total_tagihan, 2) . '\',\'' . number_format($ppn, 2) . '\',\'' . number_format($totalppn, 2) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                } elseif ($_GET["f"] == "konversi") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_paket = "SELECT * FROM `gx_paket2` WHERE `kode_paket` = '" . $row_customer["cKdPaket"] . "' ORDER BY `id_paket` ASC LIMIT 0,1;";
                        $query_paket = mysql_query($sql_paket, $conn);
                        $row_paket = mysql_fetch_array($query_paket);

                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_customer["cKode"] . '</td>
                                <td>' . $row_customer["cUserID"] . '</td>
                                <td>' . $row_customer["cNama"] . '</td>
                                <td>' . $row_customer["cAlamat1"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cKode"]) . '\', \'' . mysql_real_escape_string($row_customer["cNama"]) . '\', \'' . mysql_real_escape_string($row_customer["cUserID"]) . '\', \'' . mysql_real_escape_string($row_customer["cKdPaket"]) . '\', \'' . mysql_real_escape_string($row_customer["cPaket"]) . '\')">Select</a>
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
            if ($_GET["f"] == "grace_customer") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(customernumber, cnamacust, cuid){
                            window.opener.document.' . $return_form . '.kode_customer.value=customernumber;
                            window.opener.document.' . $return_form . '.nama_customer.value=cnamacust;
                            window.opener.document.' . $return_form . '.uid.value=cuid;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "updown_connection") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(customernumber, cnamacust, cuid, ckodepaketlama, cnamapaketlama,cgrouprbs,monthly_func,daily_func,aktivasi_func,total_func,ppn,totalppn){
                            window.opener.document.' . $return_form . '.kode_customer.value=customernumber;
                            window.opener.document.' . $return_form . '.nama_customer.value=cnamacust;
                            window.opener.document.' . $return_form . '.uid.value=cuid;
                            window.opener.document.' . $return_form . '.kode_paket_lama.value=ckodepaketlama;
                            window.opener.document.' . $return_form . '.nama_paket_lama.value=cnamapaketlama;
                            window.opener.document.' . $return_form . '.group_rbs.value=cgrouprbs;
                            window.opener.document.' . $return_form . '.monthly_lama.value=monthly_func;
                            window.opener.document.' . $return_form . '.daily_lama.value=daily_func;
                            window.opener.document.' . $return_form . '.hari_aktivasi_lama.value=aktivasi_func;
                            window.opener.document.' . $return_form . '.total_lama.value=total_func;
                            window.opener.document.' . $return_form . '.ppn_lama.value=ppn;
                            window.opener.document.' . $return_form . '.totalppn_lama.value=totalppn;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "konversi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(customernumber, cnamacust, cuid, ckodepaketlama, cnamapaketlama){
                            window.opener.document.' . $return_form . '.kode_customer.value=customernumber;
                            window.opener.document.' . $return_form . '.nama_customer.value=cnamacust;
                            window.opener.document.' . $return_form . '.uid.value=cuid;
                            window.opener.document.' . $return_form . '.kode_paket_lama.value=ckodepaketlama;
                            window.opener.document.' . $return_form . '.nama_paket_lama.value=cnamapaketlama;
                            self.close();
                        }
                    </script>';
            }
        } else {

        }

        $title = 'Data Customer';
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