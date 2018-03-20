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
				                <div class="box-header"></div><!-- /.box-header -->';

        $sql_linkbudget = "SELECT * FROM `gx_inet_listolt`";

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

        while ($row_linkbudget = mysql_fetch_array($query_linkbudget)) {
            $content .= '
                <tr>
                    <td>' . $no . '</td>
                    <td>' . $row_linkbudget["nama_server"] . '</td>
                    <td>' . $row_linkbudget["ip_address"] . '</td>
                    <td>' . $row_linkbudget["desc_server"] . '</td>
                    <td>
                      <a href="" onclick="validepopupform2(\'' . $row_linkbudget["id_server"] . '\',\'' . $row_linkbudget["nama_server"] . '\')">Select</a>
                    </td>
                </tr>';
            $no++;
        }

        $content .= '
                  
                                    </tbody>
                                </table>
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
            </script>
            
            <script type="text/javascript">
              
                function validepopupform2(id_link_budget_func, no_linkbudget_func){
                    window.opener.document.' . $return_form . '.id_olt.value=id_link_budget_func;
                    window.opener.document.' . $return_form . '.olt.value=no_linkbudget_func;
                    
                    self.close();
                }
            </script>';

        $title = 'Data OLT';
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