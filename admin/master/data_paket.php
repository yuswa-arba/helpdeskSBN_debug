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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Paket"); // for create log in database

        global $conn;
        global $conn_voip;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // menambil nilai yang ada pada url

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
				                    <div class="box-header">
                                </div><!-- /.box-header -->
                                
                                <form action="" method="post" name="form_search" id="form_search">
                                    <table class="form" width="80%">
                                        <tr>
                                            <td><label>Kode Paket</label></td>
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

        /** =================================================
         * hanya akan menampilkan data yang dicari oleh admin
         * ================================================ */
        if (isset($_POST["save_search"])) {

            $id_paket = isset($_POST['id_paket']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_paket']))) : "";
            $nama_paket = isset($_POST['nama_paket']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_paket']))) : "";

            $sql_nama_paket = ($nama_paket != "") ? "AND `nama_paket` LIKE '%" . $nama_paket . "%'" : "";

            $sql_paket = "SELECT * FROM `gx_paket2`
                    WHERE `kode_paket` LIKE '%" . $id_paket . "%'
                    $sql_nama_paket
                    AND `level` = '0'
                    ORDER BY `id_paket` DESC LIMIT 0,10;";

        } else {
            $sql_paket = "SELECT * FROM `gx_paket2`
                    WHERE `level` = '0'
                    ORDER BY `id_paket` DESC LIMIT 0,10;";
        }

        $content .= '
                                    <table class="table table-bordered table-striped" id="paket">
                                        <thead>
                                          <tr>
                                            <th>No.</th>
                                            <th>Kode Paket</th>
                                            <th>Nama Paket</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>';


        $query_paket = mysql_query($sql_paket, $conn);


        $no = 1;

        while ($row_paket = mysql_fetch_array($query_paket)) {
            if (strpos($row_paket["nama_paket"], 'SOHO') !== false) {
                $tipeIP = 'public';
            } else {
                $tipeIP = 'private';
            }

            $sql_ip = mysql_query("SELECT `gx_master_ip`.*, gx_master_ip_pool.service_name
							FROM `gx_master_ip`, gx_master_ip_pool
							WHERE `gx_master_ip`.`id_ippool` = gx_master_ip_pool.`id_ip`
							AND `gx_master_ip`.`type_ip` = '" . $tipeIP . "' AND `gx_master_ip`.`userid_ip` = ''
							AND `gx_master_ip`.`flag_ip` = '' LIMIT 0,1;", $conn);

            $row_ip = mysql_fetch_array($sql_ip);

            $content .= '
                    <tr>
					 <td>' . $no . '</td>
					 <td>' . $row_paket["kode_paket"] . '</td>
					 <td>' . $row_paket["nama_paket"] . '</td>
					 <td>
                        <a href="" onclick="validepopupform2(\'' . $row_paket["id_paket"] . '\',';
                        $content .= '\'' . $row_paket["kode_paket"] . '\',';
                        $content .= '\'' . $row_paket["nama_paket"] . '\',';
                        $content .= '\'' . $row_paket["group_rbs"] . '\',';
                        $content .= '\'' . $row_ip["service_name"] . '\',';
                        $content .= '\'' . long2ip($row_ip["ip_address"]) . '\',';
                        $content .= '\'' . $tipeIP . '\',\'' . $row_paket["account_index"] . '\')">Select</a>
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
                function validepopupform2(id_paket_func, kode_paket_func, nama_paket_func, group, service, userIP, tipeIP, acc_index){
                    window.opener.document.' . $return_form . '.cKdPaket.value=kode_paket_func;
                    window.opener.document.' . $return_form . '.cPaket.value=nama_paket_func;
                    window.opener.document.' . $return_form . '.user_ip.value=userIP;
                    window.opener.document.' . $return_form . '.tipe_ip.value=tipeIP;
                    window.opener.document.' . $return_form . '.cGroupRBS.value=group;
                    window.opener.document.' . $return_form . '.service_name.value=service;
                    window.opener.document.' . $return_form . '.acc_type_rbs.value=acc_index;
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

        $title = 'Data Paket';
        $submenu = "master_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>