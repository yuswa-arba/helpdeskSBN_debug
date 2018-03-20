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

        enableLog("", $loggedin["username"], $loggedin["username"], "Open List Menu"); // for create log in config/newsfunctions2.php

        global $conn;

        //paging
        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        if (isset($_POST["hapus"])) {
            $id_menu = array();
            $id_menu = isset($_POST["id_menu"]) ? $_POST["id_menu"] : $id_menu;

            foreach ($id_menu as $key => $value) {
                $query = "UPDATE `gx_menu` SET `level` = '1' WHERE `id_menu` = '" . $value . "';";
                $sql_update = mysql_query($query, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $query); // for create log in config/newsfunctions2.php
            }
            header('location: list_menu.php');
        }

        if (isset($_POST['search'])) {
            $nama_menu = isset($_POST["nama_menu"]) ? trim(strip_tags($_POST["nama_menu"])) : "";
            $group_menu = isset($_POST["group_menu"]) ? trim(strip_tags($_POST["group_menu"])) : "";
            $alias = isset($_POST["alias"]) ? trim(strip_tags($_POST["alias"])) : "";
            $nama_url = isset($_POST["nama_url"]) ? trim(strip_tags($_POST["nama_url"])) : "";

            $sql_nama_menu = ($nama_menu != "") ? " AND `menu` LIKE '%$nama_menu%' " : "";
            $sql_group_menu = ($group_menu != "") ? "AND `id_parent` LIKE '%$group_menu%' " : "";
            $sql_alias = ($alias != "") ? "AND `alias` LIKE '%$alias%' " : "";
            $sql_nama_url = ($nama_url != "") ? "AND `file` LIKE '%$nama_url%' " : "";

            $sql_menu = mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0'
                $sql_nama_menu
                $sql_group_menu
                $sql_alias
                $sql_nama_url
                ORDER BY `id_menu` ASC LIMIT $start, $perhalaman;", $conn);

            $count_menu = mysql_num_rows(mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0'
                $sql_nama_menu
                $sql_group_menu
                $sql_alias
                $sql_nama_url
                ORDER BY `id_menu` ASC;", $conn));
        } else {
            $sql_menu = mysql_query("SELECT * FROM `v_menu` WHERE `level` = '0' ORDER BY `id_menu` ASC LIMIT $start, $perhalaman;", $conn);

            $count_menu = mysql_num_rows(mysql_query("SELECT * FROM `gx_menu` WHERE `level` = '0' ORDER BY `id_menu` ASC;", $conn));
        }

        $sql_group = mysql_query("SELECT * FROM `gx_menu` WHERE `id_parent` = '0' AND `level` = '0' ORDER BY `id_menu` ASC", $conn);

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <form action="" method="post" name="form_search">
				                <div class="box-header">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Nama Menu :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="nama_menu" type="text" placeholder="Nama Group">
                                            </div>
                                            
                                            <div class="col-xs-2">
                                                <label>Alias :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" name="alias" placeholder="Alias">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Group Menu :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select class="form-control" name="group_menu">
                                                    <option value="">Select Group Menu</option>';

        while ($row_group = mysql_fetch_array($sql_group)) {
            $content .= '<option value="' . $row_group["id_menu"] . '">' . $row_group["alias"] . '</option>';
        }

        $content .= '
                                                </select>
                                            </div>
                                            
                                            <div class="col-xs-2">
                                                <label>Nama Url :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="nama_url" type="text" placeholder="Nama Url">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-4">
                                                <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
                                            </div>
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            
			                <form action="" method="post" name="form_menu" id="form_menu">
				                <div class="box-header">
                                    <h3 class="box-title">List Menu</h3>
				                    <div class="box-tools pull-right">
                                        <a class="btn bg-olive btn-flat margin" href="form_menu.php">Add New</a>
                                        <button type="submit" name="hapus" class="btn bg-olive btn-flat margin">Hapus</button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						                        <th>#</th>
                                                <th>Nama Menu</th>
                                                <th>Alias</th>
                                                <th>File</th>
                                                <th>For Access</th>
                                                <th>Action</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
        $hal = "?";
        $no = $start + 1;
        while ($row_menu = mysql_fetch_array($sql_menu)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $row_menu["alias"] . '</td>
                    <td>' . $row_menu["menu"] . '</td>
                    <td>' . $row_menu["file"] . '</td>
                    <td>' . $row_menu["group_nama"] . '</td>
                    <td align="center">
                    <a href="form_group_role.php?id_menu=' . $row_menu['id_menu'] . '&id_role=' . $row_menu['id_role'] . '"><span class="label label-info">Edit</span></a> |
                    <a href="" onclick="return valideopenerform(\'detail_menu.php?id=' . $row_menu["id_role"] . '\',\'cabang\');"><span class="label label-info">Details</span></a></td>
                    <td><input type="checkbox" name="id_menu[]" value="' . $row_menu["id_menu"] . '"></td>
                </tr>';

            $no++;
        }
        $content .= '    
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
							    <div class="box-footer">
                                    <div class="box-tools pull-right">
                                        ' . (halaman($count_menu, $perhalaman, 1, $hal)) . '
                                    </div>
							        <br style="clear:both;">
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '<link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = 'Mater Menu';
        $submenu = "menu";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>