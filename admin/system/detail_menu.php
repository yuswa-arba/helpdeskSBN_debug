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

        global $conn;

        // query akan diproses jika id != null pada url
        if (isset($_GET["id"])) {

            $id_menu = isset($_GET['id']) ? (int)$_GET['id'] : ''; // for create log in newfunctions2.php

            $query_menu = "SELECT * FROM `gx_menu` WHERE `id_menu`='" . $id_menu . "' LIMIT 0,1;";
            $sql_menu = mysql_query($query_menu, $conn);
            $row_menu = mysql_fetch_array($sql_menu);
        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Menu</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Nama Menu</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" readonly="" name="alias" value="' . (isset($_GET['id']) ? $row_menu["alias"] : "") . '">
                                                ' . (isset($_GET['id']) ? '<input type="hidden" name="id_menu" value="' . $id_menu . '">' : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Alias</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" readonly="" name="menu" value="' . (isset($_GET['id']) ? $row_menu["menu"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>File</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" readonly="" name="file" value="' . (isset($_GET['id']) ? $row_menu["file"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form Cabang';
        $submenu = "cabang";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>