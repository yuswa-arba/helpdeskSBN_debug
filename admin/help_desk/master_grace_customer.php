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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Grace Customer"); // for create log in newfunction2.php

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
                                <a href="form_grace_customer.php" class="btn bg-maroon btn-flat margin">Create New</a>
                            </div>
                        </div>
			        </div>
		        </div>
		        
                <div class="row">
                    <div class="col-xs-12">            
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">List Data</h3>                                    
                            </div><!-- /.box-header -->
                            
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="3%">No.</th>
                                            <th>Kode Grace</th>
                                            <th>Tanggal Grace</th>
                                            <th>Tanggal Blokir</th>
                                            <th>Cabang</th>
                                            <th>Nama Customer</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $sql_data = mysql_query("SELECT * FROM `gx_helpdesk_grace` WHERE `level` =  '0' ORDER BY `id_grace_customer` DESC LIMIT $start, $perhalaman;", $conn);
        $sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_helpdesk_grace` WHERE `level` =  '0';", $conn));

        $hal = "?";
        $no = $start + 1;

        while ($row_data = mysql_fetch_array($sql_data)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $row_data["kode_grace"] . '</td>
                    <td>' . date("d-m-Y", strtotime($row_data["tanggal"])) . '</td>
                    <td>' . date("d-m-Y", strtotime($row_data["blokir_tanggal"])) . '</td>
                    <td>' . $row_data["nama_cabang"] . '</td>
                    <td>' . $row_data["nama_customer"] . '</td>
                    <td>
                        <a href="detail_grace_customer.php?id=' . $row_data["id_grace_customer"] . '"><span class="label label-info">Detail</span></a>
                        <a href="form_grace_customer.php?id=' . $row_data["id_grace_customer"] . '"><span class="label label-info">Edit</span></a>
                    </td>
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
                                ' . (halaman($sql_total_data, $perhalaman, 1, $hal)) . '
                            </div>
                            <br style="clear:both;">
                        </div>
                    </div>
                </div>
            </section>';

        $plugins = '<link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = 'Master Grace Customer';
        $submenu = "grace_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;

    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>