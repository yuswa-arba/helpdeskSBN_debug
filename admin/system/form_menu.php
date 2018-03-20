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

        if (isset($_POST["save"])) {
            $nama_menu = isset($_POST['menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['menu']))) : '';
            $alias = isset($_POST['alias']) ? mysql_real_escape_string(strip_tags(trim($_POST['alias']))) : '';
            $id_parent = isset($_POST['id_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_parent']))) : '0';
            $file = isset($_POST['file']) ? mysql_real_escape_string(strip_tags(trim($_POST['file']))) : '';

            if ($alias != "") {
                //insert into gxCabang
                $sql_insert = "INSERT INTO `software`.`gx_menu` (`id_menu`, `id_parent`, `alias`, `menu`, `file`, `level`)
		            VALUES (NULL, '" . $id_parent . "', '" . $alias . "', '" . strtolower($nama_menu) . "', '" . $file . "', '0');";
                mysql_query($sql_insert, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='list_menu.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        } elseif (isset($_POST["update"])) {
            $id_menu = isset($_POST['id_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_menu']))) : '';
            $nama_menu = isset($_POST['menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['menu']))) : '';
            $alias = isset($_POST['alias']) ? mysql_real_escape_string(strip_tags(trim($_POST['alias']))) : '';
            $id_parent = isset($_POST['id_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_parent']))) : '0';
            $file = isset($_POST['file']) ? mysql_real_escape_string(strip_tags(trim($_POST['file']))) : '';


            if ($nama_menu != "" AND $id_menu != "") {
                $sql_update = "UPDATE `software`.`gx_menu` SET `id_parent`='" . $id_parent . "', `alias`='" . $alias . "',
		            `menu`='" . strtolower($nama_menu) . "', `file`='" . $file . "' WHERE (`id_menu`='" . $id_menu . "');";
                mysql_query($sql_update, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update);

                echo "<script language='JavaScript'>
                        alert('Data telah diupdate.');
                        window.location.href='list_menu.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        if (isset($_GET["id"])) {
            $id_menu = isset($_GET['id']) ? (int)$_GET['id'] : ''; // mengambil nilai yang id yang ada pada url

            $query_menu = "SELECT * FROM `gx_menu` WHERE `id_menu`='" . $id_menu . "' LIMIT 0,1;";
            $sql_menu = mysql_query($query_menu, $conn);
            $row_menu = mysql_fetch_array($sql_menu);
        }

        //

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Menu</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Nama Menu</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="alias" value="' . (isset($_GET['id']) ? $row_menu["alias"] : "") . '">
                                                ' . (isset($_GET['id']) ? '<input type="hidden" name="id_menu" value="' . $id_menu . '">' : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Alias</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="menu" value="' . (isset($_GET['id']) ? $row_menu["menu"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>File</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" name="file" value="' . (isset($_GET['id']) ? $row_menu["file"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Parent</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <select class="form-control" name="id_parent">';

        $selected_all = isset($_GET["id"]) ? $row_menu["id_parent"] : "";
        $selected_all = ($selected_all == '0') ? ' selected=""' : "";

        $content .= '<option value="0" ' . $selected_all . '>No Parent</option>';

        $sql_parent = mysql_query("SELECT * FROM `gx_menu` WHERE `id_parent` = '0' AND `level` = '0' ORDER BY `id_menu` ASC", $conn);
        while ($row_parent = mysql_fetch_array($sql_parent)) {
            $selected = isset($_GET["id"]) ? $row_menu["id_parent"] : "";
            $selected = ($selected == $row_parent["id_menu"]) ? ' selected=""' : "";

            $content .= '<option value="' . $row_parent["id_menu"] . '" ' . $selected . '>' . $row_parent["alias"] . '</option>';
        }

        $content .= '
                                                </select>
					                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Parent</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <select class="form-control" name="id_group">
                                                    <option value="">Pilih Group</option>';

        $get_menu = isset($_GET['id']) ? $row_menu['id_menu'] : "";

        $slct_role = mysql_fetch_array(mysql_query("SELECT `id_group` FROM `gx_user_group_role` WHERE `id_menu` = '$get_menu'"));
        $slct_group = mysql_query("SELECT * FROM `gx_user_group`");

        while ($row_group = mysql_fetch_array($slct_group)) {

            $select_group = isset($_GET['id']) ? $slct_role['id_group'] : "";
            $select_group = ($select_group == $row_group['id_group']) ? 'selected=""' : "";

            $content .= '<option value="'. $row_group["id_group"] .'" '. $select_group .'>'. $row_group["group_desc"] .'</option>';
        }

        $content .= '
                                                </select>
					                        </div>
                                        </div>
                                    </div>
					            </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                </div>
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