<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Update: 5 March 2018
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;

        if (isset($_POST["save"])) {
            $id_menu = isset($_POST['id_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_menu']))) : '';
            $access_in = isset($_POST['access_in']) ? mysql_real_escape_string(strip_tags(trim($_POST['access_in']))) : '';

            if ($id_menu != "") {
                //insert into gxCabang
                $sql_insert = "INSERT INTO `gx_user_group_role` (`id_role`, `id_group`, `id_menu`)
		            VALUES (NULL, '" . $access_in . "', '" . $id_menu . "');";
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

        }  elseif (isset($_POST["update"])) {
            $id_role = isset($_GET["id_role"]) ? $_GET["id_role"] : "";
            $id_menu = isset($_POST['id_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_menu']))) : '';
            $id_parent = isset($_POST['id_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_parent']))) : '0';
            $alias = isset($_POST['alias']) ? mysql_real_escape_string(strip_tags(trim($_POST['alias']))) : '';
            $nama_menu = isset($_POST['nama_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_menu']))) : '';
            $fa_icon = isset($_POST['fa_icon']) ? mysql_real_escape_string(strip_tags(trim($_POST['fa_icon']))) : '';
            $file = isset($_POST['file']) ? mysql_real_escape_string(strip_tags(trim($_POST['file']))) : '';
            $link = isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : '';
            $is_parent = isset($_POST['is_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['is_parent']))) : '';
            $access_in = isset($_POST['access_in']) ? mysql_real_escape_string(strip_tags(trim($_POST['access_in']))) : '';

            if ($id_menu != "") {
                $sql_update_menu = "UPDATE `gx_menu` SET `id_parent`='" . $id_parent . "', `alias`='" . $alias . "',
		            `menu`='" . strtolower($nama_menu) . "', `icon`='" . $fa_icon . "', `file`='" . $file . "', 
		            `link`='" . $link . "', `order_number`='0', `is_parent`='" . $is_parent . "', `group`='0', `level`='0' WHERE (`id_menu`='" . $id_menu . "');";
                mysql_query($sql_update_menu, $conn) or die (mysql_error());

                $sql_update_role = "UPDATE `gx_user_group_role` SET `id_group` = '". $access_in ."' WHERE (`id_role` = '". $id_role ."')";
                mysql_query($sql_update_role, $conn) or die(mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_menu);

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

        if (isset($_GET["id_role"])) {
            $id_role = isset($_GET['id_role']) ? (int)$_GET['id_role'] : ''; // mengambil nilai yang id yang ada pada url

            $query_menu = "SELECT * FROM `v_menu` WHERE `id_role`='" . $id_role . "' LIMIT 0,1;";
            $sql_menu = mysql_query($query_menu, $conn);
            $row_menu = mysql_fetch_array($sql_menu);

            $disabled = "";
        } else {
            $query_menu = "SELECT * FROM `gx_menu` ORDER BY `id_menu` DESC LIMIT 1;";
            $sql_menu = mysql_query($query_menu, $conn);
            $row_menu = mysql_fetch_array($sql_menu);

            $disabled = "disabled";
        }

        //

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Menu</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    <input type="hidden" name="id_menu" value="' . $row_menu["id_menu"] . '">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Menu</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="nama_menu" value="' . $row_menu["menu"] . '"
                                                placeholder="ex: dashboard" ' . $disabled . '>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Parent</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" name="id_parent" ' . $disabled . '>';

        $selected_all = isset($_GET["id_menu"]) ? $row_menu["id_parent"] : "";
        $selected_all = ($selected_all == '0') ? ' selected=""' : "";

        $content .= '<option value="0" ' . $selected_all . '>No Parent</option>';

        $sql_parent = mysql_query("SELECT * FROM `gx_menu` WHERE `id_parent` = '0' AND `level` = '0' ORDER BY `id_menu` ASC", $conn);
        while ($row_parent = mysql_fetch_array($sql_parent)) {
            $selected = $row_menu["id_parent"];
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
                                            <div class="col-md-2">
                                                <label>Alias</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="alias" value="' . $row_menu["alias"] . '"
                                                    placeholder="ex: Dashboard" ' . $disabled . '>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>fa-icon</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="fa_icon" value="' . $row_menu["icon"] . '"
                                                    placeholder="ex: fa fa-dashboard" ' . $disabled . '>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>File</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="file" value="' . $row_menu["file"] . '"
                                                    placeholder="ex: home/dashboard.php" ' . $disabled . '>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Link</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="link" value="' . $row_menu["link"] . '"
                                                    placeholder="ex: home/dashboard" ' . $disabled . '>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Is Parent?</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="is_parent" class="form-control" ' . $disabled . '>';

        // untuk select induk secara otomatis
        for ($get_parent = 1; $get_parent >= 0; $get_parent--) {
            $text_parent = ($get_parent == 1) ? "yes" : "no";
            $selected_parent = $row_menu['is_parent'];
            $selected_parent = ($selected_parent == $get_parent) ? "selected" : "";

            $content .= '<option value="' . $get_parent . '"' . $selected_parent . '>' . $text_parent . '</option>';
        }

        $content .= '
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Access In?</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="access_in" class="form-control">
                                                    <option value="0">Pilih mau akses di mana</option>';

        // untuk mengambil id_group yang ada pada table gx_user_group_role
        $id_role = isset($_GET['id_role']) ? "WHERE `id_role` = '$_GET[id_role]'" : "";
        $sql_role = mysql_fetch_array(mysql_query("SELECT * FROM `gx_user_group_role` $id_role"));

        // untuk mengambil id_group yang ada pada table gx_user_group
        $id_group = isset($_GET['id_role']) ? "WHERE `id_group` = '$sql_role[id_group]'" : "";
        $slc_group = mysql_fetch_array(mysql_query("SELECT * FROM `gx_user_group` $id_group"));

        $sql_group = mysql_query("SELECT * FROM `gx_user_group`");

        while ($row_group = mysql_fetch_array($sql_group)) {
            // untuk melakukan select otomatis jika id_role pada url tidak kosong
            $selected_group = isset($_GET['id_role']) ? $slc_group['id_group'] : "";
            $selected_group = $selected_group == $row_group["id_group"] ? "selected" : "";

            $content .= '<option value="' . $row_group["id_group"] . '"'. $selected_group .'>' . $row_group["group_desc"] . ' ('. $row_group["group_nama"] .')</option>';
        }

        $content .= '
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                        </div>
                                    </div>
					            </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <a ' . (isset($_GET['id_menu']) ? 'href="list_menu.php"' : 'href="form_menu.php"') . ' class="btn btn-default">Back</a> &nbsp;
                                    <button type="submit" ' . (isset($_GET['id_menu']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form Group';
        $submenu = "Form";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>