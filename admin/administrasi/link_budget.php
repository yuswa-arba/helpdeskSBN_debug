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

        enableLog("", $loggedin["username"], $loggedin["username"], "Open link_budget"); // for create log in newfunction2.php

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
		                    <div class="box-body table-responsive">
		 	                    <div class="box-header">
                                     <h3 class="box-title">List Link Budget</h3>
				                    <a href="form_link_budget.php?act=new" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                
                                <table id="formulir" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
						                    <th>#</th>
                                            <th>No. Link Budget</th>
						                    <th>Kode Prospek</th>
                                            <th>Kode Customer</th>
						                    <th>Nama</th>
                                            <th>Tanggal</th>
						                    <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $sql_master_linkbudget = mysql_query("SELECT * FROM `gx_link_budget` WHERE `gx_link_budget`.`id_cabang` = '" . $loggedin['cabang'] . "'
			AND  `level` = '0' ORDER BY `id_link_budget` DESC LIMIT $start,$perhalaman;", $conn);
        $sql_total_master_linkbudget = mysql_num_rows(mysql_query("SELECT * FROM `gx_link_budget` WHERE `gx_link_budget`.`id_cabang` = '" . $loggedin['cabang'] . "'
			AND `level` = '0' ORDER BY `id_link_budget` DESC;", $conn));
        $hal = "?";
        $no = 1;
        while ($row_master_link_budget = mysql_fetch_array($sql_master_linkbudget)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $row_master_link_budget['no_linkbudget'] . '</td>
                    <td>' . $row_master_link_budget['kode_prospek'] . '</td>
                    <td>' . $row_master_link_budget['kode_cust'] . '</td>
                    <td>' . $row_master_link_budget['nama_cust'] . '</td>
                    <td>' . $row_master_link_budget['tanggal'] . '</td>
                    
                    <td align="center">
                    <a href="" onclick="return valideopenerform(\'detail_link_budget.php?id=' . $row_master_link_budget["id_link_budget"] . '\',\'Detail Link Budget ' . $row_master_link_budget["id_link_budget"] . '\');"><span class="label label-info">Detail</span></a>
                    <a href="form_link_budget.php?id=' . $row_master_link_budget['id_link_budget'] . '&edit=t"><span class="label label-info">Edit</span></a>
                    </td>
                </tr>';
            $no++;
        }

        $content .= '     
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="box-tools pull-right">
                                    ' . (halaman($sql_total_master_linkbudget, $perhalaman, 1, $hal)) . '
                                </div>
                                <br style="clear:both;">
                            </div>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '
	    <link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = 'Master Link Budget';
        $submenu = "link_budget";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>