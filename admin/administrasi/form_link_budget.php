<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include("../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;

        $query_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' ORDER BY `id_cabang` ASC LIMIT 1;", $conn);
        $row_cabang = mysql_fetch_array($query_cabang);

        $sql_last_link = mysql_fetch_array(mysql_query("SELECT * FROM `gx_link_budget` ORDER BY `id_link_budget` DESC", $conn));
        $last_data = $sql_last_link["id_link_budget"] + 1;
        $tanggal = date("d");
        $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_link_budget"] . '' . $tanggal . '' . sprintf("%04d", $last_data);

        //Create 'cart' if it doesn't already exist
        if (!isset($_SESSION['LB'])) {
            $_SESSION['LB'] = array();
        }
        if (!isset($_SESSION['id_cabang'])) {
            $_SESSION['id_cabang'] = "";
        }
        if (!isset($_SESSION['nama_cabang'])) {
            $_SESSION['nama_cabang'] = "";
        }
        if (!isset($_SESSION['no_lb'])) {
            $_SESSION['no_lb'] = $kode_cabang;
        }
        if (!isset($_SESSION['ckode'])) {
            $_SESSION['ckode'] = "";
        }
        if (!isset($_SESSION['kode_prospek'])) {
            $_SESSION['kode_prospek'] = "";
        }
        if (!isset($_SESSION['nama'])) {
            $_SESSION['nama'] = "";
        }
        if (!isset($_SESSION['long'])) {
            $_SESSION['long'] = "";
        }
        if (!isset($_SESSION['lat'])) {
            $_SESSION['lat'] = "";
        }
        if (!isset($_SESSION['tiang'])) {
            $_SESSION['tiang'] = "";
        }
        if (!isset($_SESSION['pb'])) {
            $_SESSION['pb'] = "";
        }
        if (!isset($_SESSION['olt'])) {
            $_SESSION['olt'] = "";
        }
        if (!isset($_SESSION['epon'])) {
            $_SESSION['epon'] = "";
        }
        if (!isset($_SESSION['epon_id'])) {
            $_SESSION['epon_id'] = "";
        }
        if (!isset($_SESSION['vlan'])) {
            $_SESSION['vlan'] = "";
        }

        if (isset($_GET['act'])) {
            // untuk mengambil nilai/string yang ada pada url
            $act = isset($_GET['act']) ? mysql_real_escape_string(strip_tags(trim($_GET['act']))) : "";

            if ($act == "new") {

                session_unset();

                if (!isset($_SESSION['LB'])) {
                    $_SESSION['LB'] = array();
                }
                if (!isset($_SESSION['id_cabang'])) {
                    $_SESSION['id_cabang'] = "";
                }
                if (!isset($_SESSION['nama_cabang'])) {
                    $_SESSION['nama_cabang'] = "";
                }
                if (!isset($_SESSION['no_lb'])) {
                    $_SESSION['no_lb'] = $kode_cabang;
                }
                if (!isset($_SESSION['ckode'])) {
                    $_SESSION['ckode'] = "";
                }
                if (!isset($_SESSION['kode_prospek'])) {
                    $_SESSION['kode_prospek'] = "";
                }
                if (!isset($_SESSION['nama'])) {
                    $_SESSION['nama'] = "";
                }
                if (!isset($_SESSION['long'])) {
                    $_SESSION['long'] = "";
                }
                if (!isset($_SESSION['lat'])) {
                    $_SESSION['lat'] = "";
                }
                if (!isset($_SESSION['tiang'])) {
                    $_SESSION['tiang'] = "";
                }
                if (!isset($_SESSION['pb'])) {
                    $_SESSION['pb'] = "";
                }
                if (!isset($_SESSION['olt'])) {
                    $_SESSION['olt'] = "";
                }
                if (!isset($_SESSION['epon'])) {
                    $_SESSION['epon'] = "";
                }
                if (!isset($_SESSION['epon_id'])) {
                    $_SESSION['epon_id'] = "";
                }
                if (!isset($_SESSION['vlan'])) {
                    $_SESSION['vlan'] = "";
                }

            }
            header('Location: form_link_budget.php'); // berubah url, ditambah .php
        }

        if (isset($_GET['remove'])) {
            //Remove the item from the cart
            unset($_SESSION['LB'][$_GET['remove']]);
            //Clear the URL variables
            header('Location: form_link_budget.php'); // berubah url, ditambah .php
        }

        //Add an item only if we have the threee required pices of information: name, price, qty
        if (isset($_POST['save_alat'])) {

            $id_cabang = isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
            $nama_cabang = isset($_POST['nama_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_cabang']))) : "";
            $link = isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : "";
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
            $kode_cust = isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
            $kode_prospek = isset($_POST['kode_prospek']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_prospek']))) : "";
            $nama_cust = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
            $longitude = isset($_POST['longitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['longitude']))) : "";
            $latitude = isset($_POST['latitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['latitude']))) : "";
            $no_tiang = isset($_POST['no_tiang']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_tiang']))) : "";
            $power_budget = isset($_POST['power_budget']) ? mysql_real_escape_string(strip_tags(trim($_POST['power_budget']))) : "";


            $kode_barang = isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
            $nama_barang = isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
            $qty_barang = isset($_POST['qty']) ? mysql_real_escape_string(strip_tags(trim($_POST['qty']))) : "0";
            $price_barang = isset($_POST['price']) ? mysql_real_escape_string(strip_tags(trim($_POST['price']))) : "0";
            $serial_number = isset($_POST['serial_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['serial_number']))) : "";

            if ($kode_barang != "" AND $qty_barang != "" AND $serial_number != "") {
                //Adding an Item
                //Store it in a Array
                $itemProduk = array(
                    'id' => $kode_barang,
                    'nama' => $nama_barang,
                    'qty' => $qty_barang,
                    'h' => $price_barang,
                    'sn' => $serial_number
                );

                //Add this item to the shopping cart
                $_SESSION['LB'][] = $itemProduk;
            }

            $_SESSION['id_cabang'] = $id_cabang;
            $_SESSION['nama_cabang'] = $nama_cabang;
            $_SESSION['no_lb'] = $link;
            $_SESSION['ckode'] = $kode_cust;
            $_SESSION['kode_prospek'] = $kode_prospek;
            $_SESSION['nama'] = $nama_cust;
            $_SESSION['long'] = $longitude;
            $_SESSION['lat'] = $latitude;
            $_SESSION['tiang'] = $no_tiang;
            $_SESSION['pb'] = $power_budget;

            //Clear the URL variables
            header('Location: form_link_budget.php'); // berubah url, ditambah .php
        }

        if (isset($_GET['id']) AND isset($_GET['edit'])) {
            $act = isset($_GET['edit']) ? mysql_real_escape_string(strip_tags(trim($_GET['edit']))) : "";
            $id_data = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : "";

            $sql_data = "SELECT * FROM `gx_link_budget` WHERE `id_link_budget` = '" . $id_data . "';";
            $query_data = mysql_query($sql_data, $conn);
            $row_data = mysql_fetch_array($query_data);

            $sql_data_detail = "SELECT `kode_barang` as `id`, `nama_barang` as `nama`, `qty` as `qty`, `price` as `h`, `serial_number` as `sn`
			    FROM `gx_link_budget_detail` WHERE `no_linkbudget` = '" . $row_data["no_linkbudget"] . "';";
            $query_data_detail = mysql_query($sql_data_detail, $conn);
            $total_data_detail = mysql_num_rows($query_data_detail);

            if ($act == "t") {

                if ($total_data_detail >= 1) {
                    //$itemProduk = array();
                    $no = 0;
                    while ($row_data_detail = mysql_fetch_array($query_data_detail)) {
                        //Adding an Item
                        //Store it in a Array
                        $_SESSION['LB'][] = $row_data_detail;
                    }
                }

            }

        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-10">
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li role="presentation" class="active"><a href="#tab1" aria-controls="customer" role="tab" data-toggle="tab">Pelanggan Lama</a></li>
                            <li role="presentation"><a href="#tab2" aria-controls="troubleticket" role="tab" data-toggle="tab">Pelanggan Baru</a></li>
                        </ul>
                        
			            <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Form Link Budget</h3>
                                    </div><!-- /.box-header -->
                                    
                                    <!-- form start -->
                                    <form role="form" id="myForm1" name="myForm1" method="POST" action="">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Cabang</label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="' . (isset($_GET['id']) ? $row_data["id_cabang"] : $loggedin["cabang"]) . '" >
                                                        <input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="' . get_nama_cabang($loggedin['cabang']) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>No. Link Budget</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" id="link" name="link" required="" readonly="" value="' . (isset($_GET["id"]) ? $row_data['no_linkbudget'] : $_SESSION["no_lb"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>Tanggal</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" id="tanggal" name="tanggal" readonly="" required="" value="' . (isset($_GET["id"]) ? $row_data['tanggal'] : date("Y-m-d")) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Kode Customer</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" placeholder="Pilih Customer" class="form-control" readonly="" required="" name="kode_customer" value="' . (isset($_GET["id"]) ? $row_data['kode_cust'] : $_SESSION["ckode"]) . '" 
                                                        onclick="return valideopenerform(\'data_custlink.php?r=myForm1\',\'cust\');">
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
                                                        <input type="text" class="form-control" name="longitude" id="longitude" value="' . (isset($_GET["id"]) ? $row_data['longitude'] : $_SESSION["long"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>Latitude</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" id="latitude" name="latitude" value="' . (isset($_GET["id"]) ? $row_data['latitude'] : $_SESSION["lat"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>No. Tiang Terdekat</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="no_tiang" value="' . (isset($_GET["id"]) ? $row_data['tiang_terdekat'] : $_SESSION["tiang"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>Name Created</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" readonly="" name="name_created" value="' . (isset($_GET["id"]) ? $row_data['user_created'] : $loggedin["username"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>OLT</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="hidden" class="form-control" name="id_olt" value="">
                                                        <input type="text" placeholder="Pilih OLT"  readonly="" class="form-control" name="olt" value="' . (isset($_GET["id"]) ? $row_data['olt'] : $_SESSION["olt"]) . '"
                                                        onclick="return valideopenerform(\'data_olt.php?r=myForm1&f=olt\',\'olt\');">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>VLAN</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="vlan" value="' . (isset($_GET["id"]) ? $row_data['vlan'] : $_SESSION["vlan"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>EPON</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="epon" value="' . (isset($_GET["id"]) ? $row_data['epon'] : $_SESSION["epon"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>EPON number</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="epon_id" value="' . (isset($_GET["id"]) ? $row_data['epon_id'] : $_SESSION["epon_id"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Power Budget</label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <textarea class="form-control" name="power_budget" cols="10" rows="6" style="resize:none;">' . (isset($_GET["id"]) ? $row_data['power_budget'] : $_SESSION["pb"]) . '</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Alat yang dibutuhkan</label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <table border="0" style="width:100%">
                                                            <tr>
                                                                <td>Nama Barang</td>
                                                                <td>
                                                                    <input type="text" class="form-control" readonly="" id="nama_barang" name="nama_barang" value=""
                                                                    onclick="return valideopenerform(\'data_barang.php?r=myForm1&f=linkbudget\',\'linkbudget\');">
                                                                    <input type="hidden" class="form-control" readonly="" id="kode_barang" name="kode_barang" value="">
                                                                </td>
                                                                <td>Qty</td>
                                                                <td><input type="text" class="form-control" id="qty" name="qty" value=""></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Serial Number</td>
                                                                <td><input type="text" class="form-control" id="serial_number" name="serial_number" value=""></td>
                                                                <td>&nbsp;</td>
                                                                <td><button type="submit" name="save_alat" value="Save" class="btn btn-primary">Submit</button></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label></label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <table id="formulir" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Barang</th>
                                                                    <th>Qty</th>
                                                                    <th>Serial Number</th>
                                                                    <th>#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';

        $total = 0;
        $no = 1;

        //session alat yg terpasang
        foreach ($_SESSION['LB'] as $itemNumber => $item) {

            $id_barang = $item['id'];
            $nama_barang = $item['nama'];
            $qty = $item['qty'];
            $serial_number = $item['sn'];
            $harga = $item['h'];


            $content .= '
                <tr valign="top" id="item' . $itemNumber . '">    
					<td>' . $no . '</td>
					<td>' . $nama_barang . '</td>
					<td>' . $qty . '</td>
					<td>' . $serial_number . '</td>
					<td><a href="?remove=' . $itemNumber . '"><img src="' . URL_ADMIN . 'img/x.png" alt="Remove"></a></td>
			    </tr>';

            $total = $total + ($harga * $qty);
            $no++;

        }

        $content .= '
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Created By</label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        ' . (isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]) . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Latest Update By </label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        ' . (isset($_GET['id']) ? $row_data["user_upd"] . " " . $row_data["date_upd"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
					                    </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="' . (isset($_GET["id"]) ? "update" : "save") . '" value="Save" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
			                </div>
                            <div role="tabpanel" class="tab-pane" id="tab2">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Form Link Budget</h3>
                                    </div><!-- /.box-header -->
                                    
                                    <!-- form start -->
                                    <form role="form" id="myForm2" name="myForm2" method="POST" action="">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Cabang</label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="' . (isset($_GET['id']) ? $row_data["id_cabang"] : $loggedin["cabang"]) . '" >
                                                        <input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="' . get_nama_cabang($loggedin['cabang']) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>No. Link Budget</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" id="link" name="link" required="" readonly="" value="' . (isset($_GET["id"]) ? $row_data['no_linkbudget'] : $_SESSION["no_lb"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>Tanggal</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" id="tanggal" name="tanggal" readonly="" required="" value="' . (isset($_GET["id"]) ? $row_data['tanggal'] : date("Y-m-d")) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Kode Prospek</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" placeholder="Pilih Kode Prospek" readonly="" required="" name="kode_prospek" value="' . (isset($_GET["id"]) ? $row_data['kode_prospek'] : $_SESSION["kode_prospek"]) . '" onclick="return valideopenerform(\'data_prospek.php?r=myForm2&f=linkbudget\',\'cust\');">
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
                                                        <input type="text" class="form-control" name="longitude" id="longitude" value="' . (isset($_GET["id"]) ? $row_data['longitude'] : $_SESSION["long"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>Latitude</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" id="latitude" name="latitude" value="' . (isset($_GET["id"]) ? $row_data['latitude'] : $_SESSION["lat"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>No. Tiang Terdekat</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="no_tiang" value="' . (isset($_GET["id"]) ? $row_data['tiang_terdekat'] : $_SESSION["tiang"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>Name Created</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" readonly="" name="name_created" value="' . (isset($_GET["id"]) ? $row_data['user_created'] : $loggedin["username"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>OLT</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="hidden" class="form-control" name="id_olt" value="">
                                                        <input type="text" placeholder="Pilih OLT" readonly="" class="form-control" name="olt" value="' . (isset($_GET["id"]) ? $row_data['olt'] : $_SESSION["olt"]) . '"
                                                        onclick="return valideopenerform(\'data_olt.php?r=myForm2&f=olt\',\'olt\');">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>VLAN</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="vlan" value="' . (isset($_GET["id"]) ? $row_data['vlan'] : $_SESSION["vlan"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>EPON</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="epon" value="' . (isset($_GET["id"]) ? $row_data['epon'] : $_SESSION["epon"]) . '">
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label>EPON number</label>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="text" class="form-control" name="epon_id" value="' . (isset($_GET["id"]) ? $row_data['epon_id'] : $_SESSION["epon_id"]) . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Power Budget</label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <textarea class="form-control" name="power_budget" cols="10" rows="6" style="resize:none;">' . (isset($_GET["id"]) ? $row_data['power_budget'] : $_SESSION["pb"]) . '</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label>Alat yang dibutuhkan</label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <table border="0" style="width:100%">
                                                            <tr>
                                                                <td>Nama Barang</td>
                                                                <td>
                                                                    <input type="text" class="form-control" readonly="" id="nama_barang" name="nama_barang" value=""
                                                                    onclick="return valideopenerform(\'data_barang.php?r=myForm2&f=linkbudget\',\'linkbudget\');">
                                                                    <input type="hidden" class="form-control" readonly="" id="kode_barang" name="kode_barang" value="">
                                                                </td>
                                                                <td>Qty</td>
                                                                <td><input type="text" class="form-control" id="qty" name="qty" value=""></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Serial Number</td>
                                                                <td><input type="text" class="form-control" id="serial_number" name="serial_number" value=""></td>
                                                                <td>&nbsp;</td>
                                                                <td><button type="submit" name="save_alat" value="Save" class="btn btn-primary">Submit</button></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-2">
                                                        <label></label>
                                                    </div>
                                                    <div class="col-xs-10">
                                                        <table id="formulir" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Barang</th>
                                                                    <th>Qty</th>
                                                                    <th>Serial Number</th>
                                                                    <th>#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';

        $total = 0;
        $no = 1;
        //session alat yg terpasang
        //print_r($_SESSION[LB]);
        foreach ($_SESSION['LB'] as $itemNumber => $item) {

            $id_barang = $item['id'];
            $nama_barang = $item['nama'];
            $qty = $item['qty'];
            $serial_number = $item['sn'];
            $harga = $item['h'];

            $content .= '
                <tr valign="top" id="item' . $itemNumber . '">    
                    <td>' . $no . '</td>
                    <td>' . $nama_barang . '</td>
                    <td>' . $qty . '</td>
                    <td>' . $serial_number . '</td>
                    <!--<td>' . number_format($harga, 2, ',', '.') . '</td>
                    <td>' . number_format(($qty * $harga), 2, ',', '.') . '</td>-->
                    <td><a href="?remove=' . $itemNumber . '"><img src="' . URL_ADMIN . 'img/x.png" alt="Remove"></a></td>
                </tr>';

            $total = $total + ($harga * $qty);
            $no++;

        }

        $content .= '
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Created By</label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        ' . (isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]) . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Latest Update By </label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        ' . (isset($_GET['id']) ? $row_data["user_upd"] . " " . $row_data["date_upd"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="' . (isset($_GET["id"]) ? "update" : "save") . '" value="Save" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.content -->';

        // mengambil nilai character yang ada pada url untu digunakan sebagai seleksi perintah
        $save = isset($_POST["save"]) ? $_POST["save"] : "";
        $update = isset($_POST["update"]) ? $_POST["update"] : "";

        if ($save == "Save") {

            $id_cabang = isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";

            $link = isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : "";
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
            $kode_cust = isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
            $kode_prospek = isset($_POST['kode_prospek']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_prospek']))) : "";
            $nama_cust = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
            $longitude = isset($_POST['longitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['longitude']))) : "";
            $latitude = isset($_POST['latitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['latitude']))) : "";
            $no_tiang = isset($_POST['no_tiang']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_tiang']))) : "";
            $name_created = isset($_POST['name_created']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_created']))) : "";
            $power_budget = isset($_POST['power_budget']) ? $_POST['power_budget'] : "";
            $total = isset($_POST['total']) ? mysql_real_escape_string(strip_tags(trim($_POST['total']))) : "";

            $olt = isset($_POST['olt']) ? mysql_real_escape_string(strip_tags(trim($_POST['olt']))) : "";
            $vlan = isset($_POST['vlan']) ? mysql_real_escape_string(strip_tags(trim($_POST['vlan']))) : "";
            $epon = isset($_POST['epon']) ? mysql_real_escape_string(strip_tags(trim($_POST['epon']))) : "";
            $epon_id = isset($_POST['epon_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['epon_id']))) : "";


            if ($link != "") {
                $insert_link_budget = "INSERT INTO `gx_link_budget`(`id_link_budget`, `id_cabang`, `no_linkbudget`, `tanggal`, `kode_cust`, `nama_cust`,
					`latitude`, `longitude`, `tiang_terdekat`, `user_created`, `power_budget`,
					`olt`, `vlan`, `epon`, `epon_id`,
					`kode_prospek`, `total`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					VALUES (NULL, '" . $id_cabang . "', '" . $link . "', '" . $tanggal . "', '" . $kode_cust . "', '" . $nama_cust . "',
					'" . $latitude . "', '" . $longitude . "', '" . $no_tiang . "', '" . $name_created . "', '" . $power_budget . "',
					'" . $olt . "', '" . $vlan . "', '" . $epon . "', '" . $epon_id . "',
					'" . $kode_prospek . "', '" . $total . "', NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($insert_link_budget, $conn) or die ("<script language='JavaScript'>
                                                                   alert('LBMaaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                   window.history.go(-1);
                                                                 </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert link_budget = $insert_link_budget"); // for create log in newfunction2.php

                foreach ($_SESSION['LB'] as $itemNumber => $item) {

                    $id_barang = mysql_real_escape_string($item['id']);
                    $nama_barang = mysql_real_escape_string($item['nama']);
                    $qty = mysql_real_escape_string($item['qty']);
                    $serial_number = mysql_real_escape_string($item['sn']);
                    $harga = mysql_real_escape_string($item['h']);


                    $insert_link_budget_detail = "INSERT INTO `gx_link_budget_detail` (`id_detail`, `no_linkbudget`,
                        `kode_barang`, `nama_barang`, `qty`, `price`, `serial_number`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                        VALUES (NULL, '" . $link . "', '" . $id_barang . "', '" . $nama_barang . "', '" . $qty . "', '" . $harga . "',
                        '" . $serial_number . "', NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                    mysql_query($insert_link_budget_detail, $conn) or die ("<script language='JavaScript'>
                                                                                alert('LDMaaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                                window.history.go(-1);
                                                                            </script>");
                    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert link_budget detail = $insert_link_budget_detail"); // for create log in newfunction2.php
                }

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan!');
                        location.href = 'link_budget.php';
                      </script>";
            }
        } elseif ($update == "Save") {

            $id_cabang = isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
            $id_link_budget = isset($_POST['id_link_budget']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_link_budget']))) : "";
            $link = isset($_POST['link']) ? mysql_real_escape_string(strip_tags(trim($_POST['link']))) : "";
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
            $kode_cust = isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
            $kode_prospek = isset($_POST['kode_prospek']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_prospek']))) : "";
            $nama_cust = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
            $longitude = isset($_POST['longitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['longitude']))) : "";
            $latitude = isset($_POST['latitude']) ? mysql_real_escape_string(strip_tags(trim($_POST['latitude']))) : "";
            $no_tiang = isset($_POST['no_tiang']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_tiang']))) : "";
            $name_created = isset($_POST['name_created']) ? mysql_real_escape_string(strip_tags(trim($_POST['name_created']))) : "";
            $power_budget = isset($_POST['power_budget']) ? $_POST['power_budget'] : "";
            $list_alat = isset($_POST['list_alat']) ? $_POST['list_alat'] : "";
            $total = isset($_POST['total']) ? mysql_real_escape_string(strip_tags(trim($_POST['total']))) : "";


            $olt = isset($_POST['olt']) ? mysql_real_escape_string(strip_tags(trim($_POST['olt']))) : "";
            $vlan = isset($_POST['vlan']) ? mysql_real_escape_string(strip_tags(trim($_POST['vlan']))) : "";
            $epon = isset($_POST['epon']) ? mysql_real_escape_string(strip_tags(trim($_POST['epon']))) : "";
            $epon_id = isset($_POST['epon_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['epon_id']))) : "";


            if ($link != "" AND $id_link_budget) {
                $update_link_budget = "UPDATE `gx_link_budget` SET `kode_cust`='$kode_cust', `id_cabang`='$id_cabang',
					`nama_cust`='$nama_cust',`latitude`='$latitude',
					`longitude`='$longitude',`tiang_terdekat`='$no_tiang',`power_budget`='$power_budget',
					`list_alat`='$list_alat',`total`='$total', 
					`kode_prospek`='$kode_prospek',
					`vlan`='$vlan', `olt`='$olt', `epon`='$epon', `epon_id`='$epon_id',
					`date_upd`=NOW(),`user_upd`='$loggedin[username]' WHERE `id_budget`='$_GET[id]'";
                mysql_query($update_link_budget, $conn) or die ("<script language='JavaScript'>
                                                                   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                                   window.history.go(-1);
                                                                 </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit link_budget = $update_link_budget"); // for create log in newfunction2.php

                foreach ($_SESSION['LB'] as $itemNumber => $item) {

                    $id_barang = mysql_real_escape_string($item['id']);
                    $nama_barang = mysql_real_escape_string($item['nama']);
                    $qty = mysql_real_escape_string($item['qty']);
                    $serial_number = mysql_real_escape_string($item['sn']);
                    $harga = mysql_real_escape_string($item['h']);


                    $insert_link_budget_detail = "INSERT INTO `gx_link_budget_detail` (`id_detail`, `no_linkbudget`,
                        `kode_barang`, `nama_barang`, `qty`, `price`, `serial_number`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                        VALUES (NULL, '" . $link . "', '" . $id_barang . "', '" . $nama_barang . "', '" . $qty . "', '" . $harga . "',
                        '" . $serial_number . "', NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                    mysql_query($insert_link_budget_detail, $conn) or die ("<script language='JavaScript'>
                                                                               alert('LDMaaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                               window.history.go(-1);
                                                                             </script>");

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert link_budget detail = $insert_link_budget_detail"); // for create log in newfunction2.php
                }

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan!');
                        location.href = 'link_budget.php';
                      </script>";
            }
        }
        $plugins = '';

        $title = 'Form Link Budget';
        $submenu = "link_budget";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>