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

    if ($loggedin["group"] == 'admin') {

        global $conn;

        /** ============================================================
         * jika tombol update nama tombol yang diklik adalah tombol save
         * =========================================================== */
        if (isset($_POST["save"])) {
            $nama_bagian = isset($_POST['nama_bagian']) ? mysql_real_escape_string(trim($_POST['nama_bagian'])) : '';

            //insert into gx_bagian
            $sql_insert_bagian = "INSERT INTO `gx_bagian` (`id_bagian`, `nama_bagian`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '" . $nama_bagian . "',
                    '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(), '0');";
            mysql_query($sql_insert_bagian, $conn) or die (mysql_error());

            enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_bagian);// for create log

            echo "<script language='JavaScript'>
                    alert('Data telah disimpan');
                    window.location.href='" . URL_ADMIN . "master/bagian.php';
                  </script>";

        }

        /** ==============================================================
         * jika tombol update nama tombol yang diklik adalah tombol update
         * ============================================================= */
        elseif (isset($_POST["update"])) {

            $id_bagian = isset($_POST['id_bagian']) ? mysql_real_escape_string(trim($_POST['id_bagian'])) : '';
            $nama_bagian = isset($_POST['nama_bagian']) ? mysql_real_escape_string(trim($_POST['nama_bagian'])) : '';

            //insert into gx_bagian
            $sql_update_bagian = "UPDATE `gx_bagian` SET `level` = '1',
                        `user_upd` = '" . $loggedin["username"] . "', `date_upd` = NOW()
                        WHERE `id_bagian` = '" . $id_bagian . "';";
            mysql_query($sql_update_bagian, $conn) or die (mysql_error());

            enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_bagian);// for create log

            //insert into gx_bagian
            $sql_insert_bagian = "INSERT INTO `gx_bagian` (`id_bagian`, `nama_bagian`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '" . $nama_bagian . "',
                    '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(), '0');";
            mysql_query($sql_insert_bagian, $conn) or die (mysql_error());

            enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_bagian);// for create log

            echo "<script language='JavaScript'>
                    alert('Data telah diupdate.');
                    window.location.href='" . URL_ADMIN . "master/bagian.php';
                  </script>";

        }

        /** =======================================================
         * jika terdapat id pada url atau membuka form_bagian.php
         * melalui tombol edit maka akan mengeksekusi query dibawah
         * ====================================================== */
        if (isset($_GET["id"])) {

            $id_bagian = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_bagian = "SELECT * FROM `gx_bagian` WHERE `id_bagian`='" . $id_bagian . "' AND level = '0' LIMIT 0,1;";
            $sql_bagian = mysql_query($query_bagian, $conn);
            $row_bagian = mysql_fetch_array($sql_bagian);

        }

        $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Department</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Name Department</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input type="text" class="form-control" name="nama_bagian" value="' . (isset($_GET['id']) ? $row_bagian["nama_bagian"] : "") . '">
                                                    <input type="hidden" name="id_bagian" value="' . (isset($_GET['id']) ? $row_bagian["id_bagian"] : "") . '">
                                                </div>
                                            </div>
                                        </div>         
                                    </div><!-- /.box-body -->
				    
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form Department';
        $submenu = "master_dept";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);// mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>