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

        global $conn; // untuk konek ke database

        if (isset($_POST["save"])) {
            $kode_spk_pasang = isset($_POST['kode_spk_pasang']) ? mysql_real_escape_string(trim($_POST['kode_spk_pasang'])) : '';
            $kode_spk_aktivasi = isset($_POST['kode_spk_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_spk_aktivasi'])) : '';
            $kode_barang = isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
            $nama_barang = isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
            $no_linkbudget = isset($_POST['no_linkbudget']) ? mysql_real_escape_string(trim($_POST['no_linkbudget'])) : '';
            $qty = isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
            $serial_number = isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
            $return_url = isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';

            if ($kode_barang != "") {
                //insert into cc_subscription_service
                $sql_insert = "INSERT INTO `gx_alat_pasang` (`id_alat_pasang`, `no_linkbudget`, `kode_spk_pasang`,`kode_spk_aktivasi`,
                    `kode_barang`, `nama_barang`, `qty`, `serial_number`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '" . $no_linkbudget . "', '" . $kode_spk_pasang . "', '" . $kode_spk_aktivasi . "', '" . $kode_barang . "',
                    '" . $nama_barang . "', '" . $qty . "', '" . $serial_number . "', 
                    '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(), '0');";
                echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                                alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                window.history.go(-1);
                                                              </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='" . $return_url . "';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        } elseif (isset($_POST["update"])) {
            $id = isset($_POST['id_alat_pasang']) ? mysql_real_escape_string(trim($_POST['id_alat_pasang'])) : '';
            $kode_spk_pasang = isset($_POST['kode_spk_pasang']) ? mysql_real_escape_string(trim($_POST['kode_spk_pasang'])) : '';
            $kode_spk_aktivasi = isset($_POST['kode_spk_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_spk_aktivasi'])) : '';
            $kode_barang = isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
            $nama_barang = isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
            $no_linkbudget = isset($_POST['no_linkbudget']) ? mysql_real_escape_string(trim($_POST['no_linkbudget'])) : '';
            $qty = isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
            $serial_number = isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
            $return_url = isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';

            if ($id != "" AND $kode_barang != "") {

                //Update into cc_subscription_service
                $sql_update = "UPDATE `gx_alat_pasang` SET `kode_barang`='" . $kode_barang . "',
                    `nama_barang`='" . $nama_barang . "', `qty`='" . $qty . "', `serial_number`='" . $serial_number . "',
                    `date_upd` = NOW(), `user_upd` = '" . $loggedin["username"] . "'
                    WHERE `id_alat_pasang`='" . $id . "';";
                echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
                                                                alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                window.history.go(-1);
                                                              </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update);

                echo "<script language='JavaScript'>
                        alert('Data telah diupdate.');
                        window.location.href='" . $return_url . "';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }
        $return_url = "";
        if (isset($_GET["id"])) {
            $id_linkbudget = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";
            $kode_spk_pasang = isset($_GET['spk']) ? mysql_real_escape_string(strip_tags(trim($_GET['spk']))) : "";
            $kode_spk_aktivasi = isset($_GET['aktivasi']) ? mysql_real_escape_string(strip_tags(trim($_GET['aktivasi']))) : "";

            $sql_data = "SELECT * FROM `gx_link_budget` WHERE `no_linkbudget` = '" . $id_linkbudget . "';";
            $query_data = mysql_query($sql_data, $conn);
            $row_data = mysql_fetch_array($query_data);

            if (isset($_GET['spk'])) {
                $return_url = 'master_jawaban_spk_pasang_baru';
            } elseif (isset($_GET['aktivasi'])) {
                $return_url = 'master_jawab_spk_aktivasi_baru';
            }

        }

        if (isset($_GET["alat"])) {
            $id_alat = isset($_GET['alat']) ? mysql_real_escape_string(strip_tags(trim($_GET['alat']))) : "";

            $sql_alat = "SELECT * FROM `gx_alat_pasang` WHERE `id_alat_pasang` = '" . $id_alat . "';";
            $query_alat = mysql_query($sql_alat, $conn);
            $row_alat_pasang = mysql_fetch_array($query_alat);

        }
        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
			        <section class="col-lg-9"> 
                        <div class="box box-solid box-info">
                            <div class="box-header">
                                <h3 class="box-title">Data Update Alat</h3>
                            </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>No. Link Budget</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" id="no_linkbudget" name="no_linkbudget" required="" readonly="" value="' . (isset($_GET["id"]) ? $row_data['no_linkbudget'] : $_SESSION["no_lb"]) . '">
                                            </div>
                                         </div>
                                    </div>';

        if (isset($_GET['spk'])) {
            $content .= '
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>No. Jawab SPK</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" id="kode_spk_pasang" name="kode_spk_pasang" required="" readonly="" value="' . (isset($_GET["spk"]) ? $kode_spk_pasang : $_SESSION["kode_spk"]) . '">
                                            </div>
                                        </div>
                                    </div>';
        } elseif (isset($_GET['aktivasi'])) {
            $content .= '
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>No. Jawab SPK</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" id="kode_spk_aktivasi" name="kode_spk_aktivasi" required="" readonly="" value="' . (isset($_GET["aktivasi"]) ? $kode_spk_aktivasi : $_SESSION["kode_spk"]) . '">
                                            </div>
                                        </div>
                                    </div>';
        }

        $content .= '
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Kode Customer</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" readonly="" required="" name="kode_customer" value="' . (isset($_GET["id"]) ? $row_data['kode_cust'] : $_SESSION["ckode"]) . '">
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Nama Customer</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" id="nama" name="nama" readonly="" required="" value="' . (isset($_GET["id"]) ? $row_data['nama_cust'] : $_SESSION["nama"]) . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Longitude</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" readonly name="longitude" id="longitude" value="' . (isset($_GET["id"]) ? $row_data['longitude'] : $_SESSION["long"]) . '">
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Latitude</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" readonly id="latitude" name="latitude" value="' . (isset($_GET["id"]) ? $row_data['latitude'] : $_SESSION["lat"]) . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No. Tiang Terdekat</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" readonly name="no_tiang" value="' . (isset($_GET["id"]) ? $row_data['tiang_terdekat'] : $_SESSION["tiang"]) . '">
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Name Created</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" readonly="" name="name_created" value="' . (isset($_GET["id"]) ? $row_data['user_created'] : $loggedin["username"]) . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <table style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <th width="10%">No.</th>
                                                                <th width="17%">Kode</th>
                                                                <th width="35%">Nama</th>
                                                                <th align="right" width="17%">QTY</th>
                                                                <th align="right" width="17%">SN</th>
                                                                <th width="10%">#</th>
                                                            </tr>';
        if (isset($_GET["id"])) {
            if (isset($_GET['spk'])) {
                $sql_spk = "AND `kode_spk_pasang` = '" . $kode_spk_pasang . "'";
            } elseif (isset($_GET['aktivasi'])) {
                $sql_spk = "AND `kode_spk_aktivasi` = '" . $kode_spk_aktivasi . "'";
            }

            $sql_data_alat = "SELECT * FROM `gx_alat_pasang` WHERE `no_linkbudget` = '" . $id_linkbudget . "' $sql_spk;";
            $query_data_alat = mysql_query($sql_data_alat, $conn);
            $no = 1;
            while ($row_alat = mysql_fetch_array($query_data_alat)) {
                if (isset($_GET['spk'])) {
                    $url_spk = 'update_alat.php?id=' . $row_alat["no_linkbudget"] . '&spk=' . $row_alat["kode_spk_pasang"] . '&alat=' . $row_alat["id_alat_pasang"];
                } elseif (isset($_GET['aktivasi'])) {
                    $url_spk = 'update_alat.php?id=' . $row_alat["no_linkbudget"] . '&aktivasi=' . $row_alat["kode_spk_aktivasi"] . '&alat=' . $row_alat["id_alat_pasang"];
                }

                $content .= '
                    <tr>
                        <td>' . $no . '.</td>
                        <td>' . $row_alat["kode_barang"] . '</td>
                        <td>' . $row_alat["nama_barang"] . '</td>
                        <td>' . $row_alat["qty"] . '</td>
                        <td>' . $row_alat["serial_number"] . '</td>
                        <td><a href="' . $url_spk . '"><span class="label label-info">Edit</span></a></td>
                    </tr>';
                $no++;

            }
        } else {


            $content .= '<tr><td colspan="7">&nbsp;</td></tr>';
        }

        $content .= '							    
					                                    </tbody>
					                                </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </section>
                            
                            <section class="col-lg-9"> 
                                <div class="box box-solid box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Form Update Alat</h3>
                                    </div><!-- /.box-header -->
                                    
                                    <!-- form start -->
                                    <form action="" role="form" name="form_alat_pasang" id="form_alat_pasang" method="post" enctype="multipart/form-data">
				                        <input type="hidden" class="form-control" readonly="" name="return_url" value="' . $return_url . '">
                                        <input type="hidden" class="form-control" readonly="" name="id_alat_pasang" value="' . (isset($_GET['alat']) ? $row_alat_pasang["id_alat_pasang"] : "") . '">
                                        <input type="hidden" class="form-control" readonly="" name="no_linkbudget" value="' . (isset($_GET['id']) ? $id_linkbudget : "") . '">
                                        <input type="hidden" class="form-control" readonly="" name="kode_spk_pasang" value="' . (isset($_GET['spk']) ? $kode_spk_pasang : "") . '">
                                        <input type="hidden" class="form-control" readonly="" name="kode_spk_aktivasi" value="' . (isset($_GET['aktivasi']) ? $kode_spk_aktivasi : "") . '">
				                        
				                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Kode Barang</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" readonly="" id="kode_barang" name="kode_barang" value="' . (isset($_GET['alat']) ? $row_alat_pasang["kode_barang"] : "") . '"
                                                        onclick="return valideopenerform(\'data_barang.php?r=form_alat_pasang&f=update_alat\',\'updatealat\');">
                                                    </div>
                                                </div>
                                            </div>
					
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Nama Barang</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" readonly="" id="nama_barang" name="nama_barang" value="' . (isset($_GET['alat']) ? $row_alat_pasang["nama_barang"] : "") . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>QTY</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" required="" name="qty" id="qty" value="' . (isset($_GET['alat']) ? $row_alat_pasang["qty"] : "") . '">
                                                    </div>
                                                </div>
                                            </div>
                                                                
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Serial Number</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" required="" name="serial_number" id="serial_number" value="' . (isset($_GET['alat']) ? $row_alat_pasang["serial_number"] : "") . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Created By</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        ' . (isset($_GET['alat']) ? $row_alat_pasang["user_add"] : $loggedin["username"]) . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Lates Update By </label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        ' . (isset($_GET['alat']) ? $row_alat_pasang["user_upd"] . " " . $row_alat_pasang["date_upd"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        
                                        <div class="box-footer">
                                            <button type="submit" value="Submit" ' . (isset($_GET['alat']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </section>
			            </div>
                    </section><!-- /.content -->';

        $plugins = '
            <script src="' . URL . 'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
            <script>
                $(\'[id=harga]\').priceFormat({
                    prefix: "",
                    thousandsSeparator: ",",
                    centsLimit: 0
                });
            </script>';

        $title = 'Update Alat';
        $submenu = "";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>