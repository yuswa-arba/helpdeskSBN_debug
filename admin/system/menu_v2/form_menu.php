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
            $id_parent = isset($_POST['id_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_parent']))) : '0';
            $alias = isset($_POST['alias']) ? mysql_real_escape_string(strip_tags(trim($_POST['alias']))) : '';
            $nama_menu = isset($_POST['nama_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_menu']))) : '';
            $fa_icon = isset($_POST['fa_icon']) ? mysql_real_escape_string(strip_tags(trim($_POST['fa_icon']))) : '';
            $file = isset($_POST['file']) ? mysql_real_escape_string(strip_tags(trim($_POST['file']))) : '';
            $link = isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : '';
            $is_parent = isset($_POST['is_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['is_parent']))) : '';

            if ($alias != "") {
                //insert into gxCabang
                $sql_insert = "INSERT INTO `gx_menu` (`id_menu`, `id_parent`, `alias`, `menu`, `icon`, `file`, 
                    `link`, `order_number`, `is_parent`, `group`, `level`)
		            VALUES (NULL, '" . $id_parent . "', '" . $alias . "', '" . strtolower($nama_menu) . "', 
		            '" . $fa_icon . "', '" . $file . "', '" . $link . "', '0', '" . $is_parent . "', '0', '0');";
                mysql_query($sql_insert, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                header("Location: form_group_role.php");
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        } elseif (isset($_POST["update"])) {
            $id_menu = isset($_POST['id_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_menu']))) : '';
            $id_parent = isset($_POST['id_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_parent']))) : '0';
            $alias = isset($_POST['alias']) ? mysql_real_escape_string(strip_tags(trim($_POST['alias']))) : '';
            $nama_menu = isset($_POST['nama_menu']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_menu']))) : '';
            $fa_icon = isset($_POST['fa_icon']) ? mysql_real_escape_string(strip_tags(trim($_POST['fa_icon']))) : '';
            $file = isset($_POST['file']) ? mysql_real_escape_string(strip_tags(trim($_POST['file']))) : '';
            $link = isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : '';
            $is_parent = isset($_POST['is_parent']) ? mysql_real_escape_string(strip_tags(trim($_POST['is_parent']))) : '';

            if ($nama_menu != "" AND $id_menu != "") {
                $sql_update = "UPDATE `gx_menu` SET `id_parent`='" . $id_parent . "', `alias`='" . $alias . "',
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
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Menu</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form role="form" method="POST" action="">
                                <div class="box-body">
                                    ' . (isset($_GET['id']) ? '<input type="hidden" name="id_menu" value="' . $id_menu . '">' : "") . '
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Nama Menu</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="nama_menu" value="' . (isset($_GET['id']) ? $row_menu["alias"] : "") . '"
                                                placeholder="ex: dashboard">
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Parent</label>
                                            </div>
                                            <div class="col-md-4">
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
                                            <div class="col-md-2">
                                                <label>Alias</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="alias" value="' . (isset($_GET['id']) ? $row_menu["menu"] : "") . '"
                                                    placeholder="ex: Dashboard">
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>fa-icon</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="fa_icon" value="' . (isset($_GET['id']) ? $row_menu["file"] : "") . '"
                                                    placeholder="ex: fa fa-dashboard">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>File</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="file" value="' . (isset($_GET['id']) ? $row_menu["menu"] : "") . '"
                                                    placeholder="ex: home/dashboard.php">
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <label>Link</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="link" value="' . (isset($_GET['id']) ? $row_menu["file"] : "") . '"
                                                    placeholder="ex: home/dashboard">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Is Parent?</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="is_parent" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
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
                                    <a href="list_menu.php" class="btn btn-default">Back</a> &nbsp;
                                    <button type="submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form Menu';
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