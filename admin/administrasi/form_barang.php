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
            $id_cabang = "";
            $kode_barang = isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
            $nama_barang = isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
            $satuan1 = isset($_POST['satuan1']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan1']))) : "";
            $isi = isset($_POST['isi']) ? mysql_real_escape_string(strip_tags(trim($_POST['isi']))) : "";
            $satuan2 = isset($_POST['satuan2']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan2']))) : "";
            $barcode = isset($_POST['barcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['barcode']))) : "";
            $reorder_stok = isset($_POST['reorder_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['reorder_stok']))) : "";
            $minimum_stok = isset($_POST['minimum_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['minimum_stok']))) : "";
            $kategori = isset($_POST['kategori']) ? mysql_real_escape_string(strip_tags(trim($_POST['kategori']))) : "";
            $acc_biaya = isset($_POST['acc_biaya']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_biaya']))) : "";
            $acc_free = isset($_POST['acc_free']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_free']))) : "";
            $acc_inventaris = isset($_POST['acc_inventaris']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_inventaris']))) : "";

            if (($kode_barang != NULL) AND ($nama_barang != NULL)) {
                $gambar = "";
                //upload foto
                $target_dir = "../upload/barang/";
                // Random number for both file, will be added after image name
                $RandomNumber = rand(0, 9999999999);

                $uploadOk = 1;
                $nama_file_gambar = str_replace(' ', '-', strtolower($_FILES['gambar']['name']));
                $ImageName_gambar = pathinfo($nama_file_gambar, PATHINFO_FILENAME);
                $imageFileType_gambar = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                $NewImageName_gambar = $ImageName_gambar . '-' . $RandomNumber . '.' . $imageFileType_gambar;
                $target_file_gambar = $target_dir . $NewImageName_gambar;

                // Check if image file is a actual image or fake image
                if (($_FILES["gambar"]["tmp_name"] != "")) {
                    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                } else {
                    $uploadOk = 0;
                }
                // Check if file already exists
                if ((file_exists($target_file_gambar))) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if (($_FILES["gambar"]["size"] > 1000000)) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType_gambar != "jpg" && $imageFileType_gambar != "png" && $imageFileType_gambar != "jpeg"
                    && $imageFileType_gambar != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file_gambar)) {

                        $gambar = $NewImageName_gambar;
                    } else {
                        $gambar = "";
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

                $insert_data = "INSERT INTO `gx_barang` (`id_barang`, `id_cabang`, `kode_barang`, `nama_barang`, `satuan1`,
                    `isi`, `satuan2`, `barcode`, `reorder_stok`, `minimum_stok`, `gambar`,
                    `kategori`, `acc_biaya`, `acc_free`, `acc_inventaris`,
                    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
                    VALUES (NULL, '" . $id_cabang . "', '" . $kode_barang . "', '" . $nama_barang . "', '" . $satuan1 . "',
                    '" . $isi . "', '" . $satuan2 . "', '" . $barcode . "', '" . $reorder_stok . "',
                    '" . $minimum_stok . "', '" . $gambar . "', '" . $kategori . "', '" . $acc_biaya . "',
                    '" . $acc_free . "', '" . $acc_inventaris . "',
                    NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "','0')";
                mysql_query($insert_data, $conn) or die ("<script language='JavaScript'>
                                                             alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                             window.history.go(-1);
                                                          </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data = " . mysql_real_escape_string($insert_data) . "."); // for create log in newfunction2.php
            }
            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'master_barang.php';
                  </script>";
        } elseif (isset($_POST["update"])) {

            $id_barang = isset($_POST['id_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_barang']))) : "";
            $id_cabang = "";
            $kode_barang = isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
            $nama_barang = isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
            $satuan1 = isset($_POST['satuan1']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan1']))) : "";
            $isi = isset($_POST['isi']) ? mysql_real_escape_string(strip_tags(trim($_POST['isi']))) : "";
            $satuan2 = isset($_POST['satuan2']) ? mysql_real_escape_string(strip_tags(trim($_POST['satuan2']))) : "";
            $barcode = isset($_POST['barcode']) ? mysql_real_escape_string(strip_tags(trim($_POST['barcode']))) : "";
            $reorder_stok = isset($_POST['reorder_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['reorder_stok']))) : "";
            $minimum_stok = isset($_POST['minimum_stok']) ? mysql_real_escape_string(strip_tags(trim($_POST['minimum_stok']))) : "";
            $kategori = isset($_POST['kategori']) ? mysql_real_escape_string(strip_tags(trim($_POST['kategori']))) : "";
            $acc_biaya = isset($_POST['acc_biaya']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_biaya']))) : "";
            $acc_free = isset($_POST['acc_free']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_free']))) : "";
            $acc_inventaris = isset($_POST['acc_inventaris']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_inventaris']))) : "";

            if (($id_barang != NULL)) {
                $gambar = "";
                $sql_gambar = "";

                if (($_FILES["gambar"]["tmp_name"] != "")) {

                    //upload foto
                    $target_dir = "../upload/barang/";
                    // Random number for both file, will be added after image name
                    $RandomNumber = rand(0, 9999999999);

                    $uploadOk = 1;
                    $nama_file_gambar = str_replace(' ', '-', strtolower($_FILES['gambar']['name']));
                    $ImageName_gambar = pathinfo($nama_file_gambar, PATHINFO_FILENAME);
                    $imageFileType_gambar = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                    $NewImageName_gambar = $ImageName_gambar . '-' . $RandomNumber . '.' . $imageFileType_gambar;
                    $target_file_gambar = $target_dir . $NewImageName_gambar;

                    // Check if image file is a actual image or fake image
                    if (($_FILES["gambar"]["tmp_name"] != "")) {
                        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
                        if ($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    } else {
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if ((file_exists($target_file_gambar))) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if (($_FILES["gambar"]["size"] > 1000000)) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if ($imageFileType_gambar != "jpg" && $imageFileType_gambar != "png" && $imageFileType_gambar != "jpeg"
                        && $imageFileType_gambar != "gif"
                    ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file_gambar)) {

                            $gambar = $NewImageName_gambar;
                            $sql_gambar = "`gambar`='" . $gambar . "',";
                        } else {
                            $gambar = "";
                            $sql_gambar = "";
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }

                //echo $sql_gambar;

                $update_data = "UPDATE `gx_barang` SET " . $sql_gambar . " `id_cabang`='" . $id_cabang . "', `kode_barang`='" . $kode_barang . "',
                    `nama_barang`='" . $nama_barang . "', `satuan1`='" . $satuan1 . "', `isi`='" . $isi . "', `satuan2`='" . $satuan2 . "',
                    `barcode`='" . $barcode . "', `reorder_stok`='" . $reorder_stok . "', `minimum_stok`='" . $minimum_stok . "', 
                    `kategori`='" . $kategori . "', `acc_biaya`='" . $acc_biaya . "', `acc_free`='" . $acc_free . "', `acc_inventaris`='" . $acc_inventaris . "',
                    `date_upd`=NOW(), `user_upd`='" . $loggedin["username"] . "' WHERE `id_barang`='" . $id_barang . "'";
                mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = " . mysql_real_escape_string($update_data) . "."); // for create log in newfunction2.php
            }
            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'master_barang.php';
                  </script>";
        }

        if (isset($_GET['id'])) {
            $id_data = isset($_GET['id']) ? (int)$_GET['id'] : "";
            $sql_data = "SELECT * FROM `gx_barang` WHERE `id_barang` = '" . $id_data . "';";
            $query_data = mysql_query($sql_data, $conn);
            $row_data = mysql_fetch_array($query_data);

            $sql_data_cabang = "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $row_data["id_cabang"] . "';";
            $query_data_cabang = mysql_query($sql_data_cabang, $conn);
            $row_data_cabang = mysql_fetch_array($query_data_cabang);

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form barang id=$id_data"); // for create log in newfunction2.php
        } else {
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form barang"); // for create log in newfunction2.php
        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Barang</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form role="form" name="form_barang"  method="POST" action="" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Kode Barang</label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input type="text"  class="form-control" id="kode_barang" name="kode_barang" value="' . (isset($_GET["id"]) ? $row_data['kode_barang'] : "") . '">
                                                <input type="hidden" name="id_barang" value="' . (isset($_GET["id"]) ? $row_data['id_barang'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" required="" name="nama_barang" value="' . (isset($_GET["id"]) ? $row_data['nama_barang'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Satuan</label>
                                            </div>
                                            <div class="col-xs-3">
                                                1 &nbsp;&nbsp;<input type="text" size="20" readonly="" id="satuan1" name="satuan1" value="' . (isset($_GET["id"]) ? $row_data['satuan1'] : "") . '"
                                                onclick="return valideopenerform(\'data_satuan.php?r=form_barang&f=satuan1\',\'barang\');">
                                            </div>
                                            <div class="col-xs-3">
                                                = &nbsp;&nbsp;<input type="text" size="20" id="isi" name="isi" value="' . (isset($_GET["id"]) ? $row_data['isi'] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" id="satuan2" size="20" name="satuan2" value="' . (isset($_GET["id"]) ? $row_data['satuan2'] : "") . '"
                                                onclick="return valideopenerform(\'data_satuan.php?r=form_barang&f=satuan2\',\'barang\');">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Barcode</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" maxlength="3" class="form-control" name="barcode" value="' . (isset($_GET["id"]) ? $row_data['barcode'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Reorder Stok</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="reorder_stok" value="' . (isset($_GET["id"]) ? $row_data['reorder_stok'] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Minimum Stok</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="minimum_stok" value="' . (isset($_GET["id"]) ? $row_data['minimum_stok'] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Gambar</label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input type="file" class="form-control" name="gambar" value="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Kategori</label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input class="required" type="radio" name="kategori" value="inventaris" style="float:left;" ' . ((isset($_GET["id"]) && $row_data["kategori"] == "inventaris") ? "checked" : "") . '>&nbsp;<label>Inventaris</label>&nbsp;
                                                <input class="required" type="radio" name="kategori" value="biaya" style="float:left;" ' . ((isset($_GET["id"]) && $row_data["kategori"] == "biaya") ? "checked" : "") . '>&nbsp;<label>Biaya</label>&nbsp;
                                                <input class="required" type="radio" name="kategori" value="free" style="float:left;" ' . ((isset($_GET["id"]) && $row_data["kategori"] == "free") ? "checked" : "") . '>&nbsp;<label>Free</label>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">  
                                            <div class="col-xs-3">
                                                <label>ACC Biaya</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="acc_biaya" value="' . (isset($_GET["id"]) ? $row_data['acc_biaya'] : "") . '" readonly=""
                                                onclick="return valideopenerform(\'data_acc.php?r=form_barang&f=biaya\',\'biaya\');">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>ACC Inventaris</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="acc_inventaris" value="' . (isset($_GET["id"]) ? $row_data['acc_inventaris'] : "") . '" readonly=""
                                                onclick="return valideopenerform(\'data_acc.php?r=form_barang&f=inventaris\',\'inventaris\');">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>ACC Free</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="acc_free" value="' . (isset($_GET["id"]) ? $row_data['acc_free'] : "") . '" readonly=""
                                                onclick="return valideopenerform(\'data_acc.php?r=form_barang&f=free\',\'free\');">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Created By:</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET["id"]) ? $row_data['user_add'] : $loggedin["username"]) . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>last Updated By:</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET["id"]) ? $row_data['user_upd'] . ' ( ' . $row_data['date_upd'] . ' )' : "") . '
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                
                                <div class="box-footer">
                                    <input type="submit" name="' . (isset($_GET["id"]) ? "update" : "save") . '" value="Save" class="btn btn-primary">
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>

            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form Barang';
        $submenu = "master_barang";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>