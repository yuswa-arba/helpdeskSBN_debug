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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cust"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // untuk mengambil nilai/string yang ada pada url

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Link Budget</h2>
                            </div>
                            
				            <div class="box-body table-responsive">
				                <div class="box-header"></div><!-- /.box-header -->
                                    <form action="" method="post" name="form_search" id="form_search">
                                        <table class="form" width="80%">
                                            <tr>
                                                <td><label>No Link Budget</label></td>
                                                <td>
                                                    <input class="form-control" name="no_linkbudget" placeholder="No. Link Budget" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Kode Cust</label></td>
                                                <td>
                                                    <input class="form-control" name="kode_cust" placeholder="Kode Cust" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Nama Cust</label></td>
                                                <td>
                                                    <input class="form-control" name="nama_cust" placeholder="Nama Cust" type="text" value="">
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

            $no_linkbudget = isset($_POST['no_linkbudget']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_linkbudget']))) : "";
            $kode_cust = isset($_POST['kode_cust']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_cust']))) : "";
            $nama_cust = isset($_POST['nama_cust']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_cust']))) : "";


            $sql_kode_cust = ($kode_cust != "") ? "AND `kode_cust` LIKE '%" . $kode_cust . "%'" : "";
            $sql_nama_cust = ($nama_cust != "") ? "AND `nama_cust` LIKE '%" . $nama_cust . "%'" : "";

            $sql_linkbudget = "SELECT * FROM `gx_link_budget`
                WHERE `no_linkbudget` LIKE '" . $no_linkbudget . "%'
                $sql_kode_cust
                $sql_nama_cust
                ORDER BY `id_link_budget` ASC LIMIT 0,10;";

            $content .= '
                                        <table class="table table-bordered table-striped" id="linkbudget">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>No Link Budget</th>
                                                    <th>Kode Customer</th>
                                                    <th>Nama Customer</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

            $query_linkbudget = mysql_query($sql_linkbudget, $conn);
            $no = 1;
            if (isset($_GET["f"])) {
                if ($_GET["f"] == "ctrl_justifikasi") {
                    while ($row_linkbudget = mysql_fetch_array($query_linkbudget)) {
                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_linkbudget["no_linkbudget"] . '</td>
                                <td>' . $row_linkbudget["kode_cust"] . '</td>
                                <td>' . $row_linkbudget["nama_cust"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . $row_linkbudget["id_link_budget"] . '\', \'' . $row_linkbudget["no_linkbudget"] . '\')">Select</a>
                                </td>
                            </tr>';

                        $no++;
                    }
                }
            } else {
                while ($row_linkbudget = mysql_fetch_array($query_linkbudget)) {
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_linkbudget["no_linkbudget"] . '</td>
                            <td>' . $row_linkbudget["kode_cust"] . '</td>
                            <td>' . $row_linkbudget["nama_cust"] . '</td>
                    
                            <td>
                              <a href="" onclick="validepopupform2(\'' . $row_linkbudget["no_linkbudget"] . '\')">Select</a>
                            </td>
                        </tr>';

                    $no++;
                }
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
                    $(\'#linkbudget\').dataTable({
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

            if ($_GET["f"] == "ctrl_justifikasi") {

                $plugins .= '
                    <script type="text/javascript">
                	    function validepopupform2(id_link_budget_func, no_linkbudget_func){
                	  	    window.opener.document.' . $return_form . '.id_linkbudget.value=no_linkbudget_func;
                	  	    window.opener.document.getElementById(\'linkk\').href  =\'detail_link_budget.php?id=\'+id_link_budget_func;
                	  	    self.close();
                	    }
                    </script>';
            }
        } else {
            $plugins .= '
                <script type="text/javascript">
                    function validepopupform2(no_linkbudget_func){
                  	    window.opener.document.' . $return_form . '.id_linkbudget.value=no_linkbudget_func;
                  	    self.close();
                    }
                </script>';
        }

        $title = 'Data linkbudget';
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