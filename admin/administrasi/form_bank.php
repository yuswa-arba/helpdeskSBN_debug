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

        if (isset($_GET['id_bank'])) {

            // untuk mengambil nilai/string yang ada pada url
            $get_id = isset($_GET['id_bank']) ? (int)$_GET['id_bank'] : "";
            $data_bank = mysql_fetch_array(mysql_query("SELECT * FROM `gx_bank` WHERE `id_bank` = '" . $get_id . "';", $conn));
        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form bank</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form action="" role="form" name="form_bank" id="form_bank" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Kode bank</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <input type="text"  class="form-control" required="" name="kode_bank" value="' . (isset($_GET["id_bank"]) ? $data_bank['kode_bank'] : "") . '">
                                                <input type="hidden" name="id_bank" value="' . (isset($_GET["id_bank"]) ? $data_bank['id_bank'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row"> 
                                            <div class="col-xs-2">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" required="" name="nama" value="' . (isset($_GET["id_bank"]) ? $data_bank['nama'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No. Rekening</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <input type="text" required="" class="form-control"  name="no_rek" value="' . (isset($_GET["id_bank"]) ? $data_bank['no_rek'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No. ACC</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="no_acc" value="' . (isset($_GET["id_bank"]) ? $data_bank['no_acc'] : "") . '"
                                                onclick="return valideopenerform(\'data_acc.php?r=form_bank&f=no_acc\',\'no_acc\');">
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="nama_acc" value="' . (isset($_GET["id_bank"]) ? $data_bank['nama_acc'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>MU</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <select required="" name="mu" class="form-control">';

        $sql_data_mu = mysql_query("SELECT * FROM `gx_matauang` WHERE `level` =  '0' ORDER BY `nama_matauang` ASC;", $conn);
        while ($row_data = mysql_fetch_array($sql_data_mu)) {
            $content .= '<option value="' . $row_data["kode_matauang"] . '" ' . (isset($_GET['id_bank']) ? ($data_bank['mu'] == $row_data["kode_matauang"] ? "selected" : "") : "") . '>' . $row_data["nama_matauang"] . '</option>';
        }

        $content .= '
                                                </select>
                                            </div>
                                        </div>
                                    </div>
				
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Rate</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <input type="text" required="" class="form-control" name="rate" value="' . (isset($_GET["id_bank"]) ? $data_bank['rate'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <input type="submit" name="' . (isset($_GET["id_bank"]) ? "update" : "save") . '" value="Save" class="btn btn-primary">
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->
            ';
        $save = isset($_POST["save"]) ? $_POST["save"] : "";
        $update = isset($_POST["update"]) ? $_POST["update"] : "";

        if ($save == "Save") {

            $kode_bank = isset($_POST['kode_bank']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_bank']))) : "";
            $nama = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
            $no_rek = isset($_POST['no_rek']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_rek']))) : "";
            $no_acc = isset($_POST['no_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_acc']))) : "";
            $nama_acc = isset($_POST['nama_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_acc']))) : "";
            $mu = isset($_POST['mu']) ? mysql_real_escape_string(strip_tags(trim($_POST['mu']))) : "";
            $rate = isset($_POST['rate']) ? mysql_real_escape_string(strip_tags(trim($_POST['rate']))) : "";

            $insert_bank = "INSERT INTO `gx_bank`(`id_bank`, `kode_bank`, `nama`, `no_rek`, `no_acc`, `nama_acc`,
                `mu`, `rate`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
                VALUES (NULL, '" . $kode_bank . "', '" . $nama . "', '" . $no_rek . "', '" . $no_acc . "', '" . $nama_acc . "', '" . $mu . "', '" . $rate . "',
                NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "','0')";
            mysql_query($insert_bank, $conn) or die ("<script language='JavaScript'>
					       alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
					       window.history.go(-1);
					   </script>");

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert bank = $insert_bank"); // for create log in newfunction2.php

            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'master_bank';
                  </script>";
        } elseif ($update == "Save") {

            $id_bank = isset($_POST['id_bank']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_bank']))) : "";
            $kode_bank = isset($_POST['kode_bank']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_bank']))) : "";
            $nama = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
            $no_rek = isset($_POST['no_rek']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_rek']))) : "";
            $no_acc = isset($_POST['no_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_acc']))) : "";
            $nama_acc = isset($_POST['nama_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_acc']))) : "";
            $mu = isset($_POST['mu']) ? mysql_real_escape_string(strip_tags(trim($_POST['mu']))) : "";
            $rate = isset($_POST['rate']) ? mysql_real_escape_string(strip_tags(trim($_POST['rate']))) : "";


            $insert_bank = "UPDATE `gx_bank` SET `kode_bank`='" . $kode_bank . "',
                `nama`='" . $nama . "', `no_rek`='" . $no_rek . "', `no_acc`='" . $no_acc . "',  `nama_acc`='" . $nama_acc . "', `mu`='" . $mu . "',`rate`='" . $rate . "',
                `date_upd`=NOW(), `user_upd`='" . $loggedin["username"] . "' WHERE `id_bank`='" . $_GET["id_bank"] . "'";
            mysql_query($insert_bank, $conn) or die ("<script language='JavaScript'>
                                                         alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                         window.history.go(-1);
                                                      </script>");

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit bank = $insert_bank"); // for create log in newfunction2.php

            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'master_bank.php';
                  </script>";
        }

        $plugins = '';

        $title = 'Form Bank';
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