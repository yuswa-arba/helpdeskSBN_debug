<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include("../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;

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
                            <div class="box-body">
                                <a href="form_bank.php" class="btn bg-maroon btn-flat margin">Add bank</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12"                   
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">List Bank</h3>                                    
                            </div><!-- /.box-header -->
                            
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="3%">No.</th>
                                            <th width="8%">Kode Bank</th>
                                            <th width="10%">Nama</th>
                                            <th width="8%">No. Rekening</th>
                                            <th width="10%">No. Acc</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $sql_bank = mysql_query("SELECT `id_bank`, `kode_bank`, `nama`, `no_rek`, `no_acc`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_bank` WHERE `level` =  '0'
			ORDER BY  `date_add` DESC LIMIT $start, $perhalaman;", $conn);
        $sql_total_bank = mysql_num_rows(mysql_query("SELECT `id_bank`, `kode_bank`, `nama`, `no_rek`, `no_acc`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_bank` WHERE `level` =  '0'
			ORDER BY  `date_add` DESC;", $conn));

        $hal = "?";
        $no = 1;

        while ($r_bank = mysql_fetch_array($sql_bank)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $r_bank["kode_bank"] . '</td>
                    <td>' . $r_bank["nama"] . '</td>
                    <td>' . $r_bank["no_rek"] . '</td>
                    <td>' . $r_bank["no_acc"] . '</td>
                    <td><a href="detail_bank.php?id_bank=' . $r_bank["id_bank"] . '" onclick="return valideopenerform(\'detail_bank.php?id_bank=' . $r_bank["id_bank"] . '\',\'bank\');">Details</a>  || <a href="form_bank.php?id_bank=' . $r_bank["id_bank"] . '">edit</a></td>
                </tr>';
            $no++;
        }

        $content .= '
                                    </tbody>
                                </table>
                            </div>
                            <br />
                        </div>
                        <div class="box-footer">
                            <div class="box-tools pull-right">
                                ' . (halaman($sql_total_bank, $perhalaman, 1, $hal)) . '
                            </div>
                            <br style="clear:both;">
                        </div>
                    </div>
                </div>
	        </section>';

        $plugins = '
            <link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />
            <!-- DATA TABLES -->
            <link href="' . URL . 'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
            <script src="' . URL . 'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
            <script type="text/javascript">
                $(function() {
                    $("#example1").dataTable();
                   "bPaginate": true,
                   "bLengthChange": false,
                   "bFilter": false,
                   "bSort": false,
                   "bInfo": true,
                   "bAutoWidth": false
                });
            </script>';

        $title = 'Master Bank';
        $submenu = "master_bank";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;

    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>