<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include("../../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Invoice"); // for create log in newfunction2.php

        global $conn;

        if (isset($_GET["id"]) & isset($_GET["action"])) {

            // mengambil nilai/string yang ada pada url
            $id_invoice = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $action = isset($_GET['action']) ? $_GET['action'] : '';

            if (($id_invoice != "") AND ($action == "lock")) {

                $sql_update_lock = "UPDATE `gx_invoice` SET `status`='1' WHERE (`id_invoice`='" . $id_invoice . "');";
                mysql_query($sql_update_lock, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_lock); // for create log in newfunction2.php
            }

            if (($id_invoice != "") AND ($action == "hapus")) {

                $sql_update_lock = "UPDATE `gx_invoice` SET `level`='1' WHERE (`id_invoice`='" . $id_invoice . "');";
                mysql_query($sql_update_lock, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_lock); // for create log in newfunction2.php
            }
            header("location: master_invoice.php");

        }


        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        $content = '
            <!-- Main content -->
            <section class="content">
		        <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Search</h2>
                            </div>
				
                            <div class="box-body table-responsive">
                                <form action="" method="post" name="form_search">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Nama Customer :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="name" type="text" placeholder="Nama Customer">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>UserID :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="userid" type="text" placeholder="USERID">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Customer Number :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" name="cust_number" placeholder="Customer Number">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Kode Invoice :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" name="kode_invoice" placeholder="Kode Invoice">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Tanggal Invoice :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" name="tanggal_tagihan" readonly id="datepicker">
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
                                </form>
	                            <hr>
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>
                                    <a href="' . URL_ADMIN . 'administrasi/form_invoice.php" class="btn bg-olive btn-flat margin pull-right">Create New</a>
                                </div><!-- /.box-header -->
                                
                                <table id="example1" class="table table-bordered table-striped" style="white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th width="3%">No.</th>
                                            <th>Kode Invoice</th>
                                            <th>Tanggal</th>
                                            
                                            <th>Customer Number</th>
                                            <th>UserID</th>
                                            <th>Deskripsi</th>
                                            <th>Total Tagihan</th>
                                            <th>Total yg<br>harus dibayar</th>			
                                            <th>Uangmuka/<br>saldo</th>
                                            <th>Paid Status</th>
                                            
                                            <th>Posting</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        //select data
        if (isset($_GET["c"]) AND isset($_GET["n"]) AND isset($_GET["k"]) AND isset($_GET["t"])) {

            $cust_number = isset($_GET["c"]) ? trim(strip_tags($_GET["c"])) : "";
            $userid = isset($_GET["u"]) ? trim(strip_tags($_GET["u"])) : "";
            $name = isset($_GET["n"]) ? trim(strip_tags($_GET["n"])) : "";
            $kode_invoice = isset($_GET["k"]) ? trim(strip_tags($_GET["k"])) : "";
            $tanggal_tagihan = isset($_GET["t"]) ? trim(strip_tags($_GET["t"])) : "";


            $sql_cust_number = ($cust_number != "") ? "AND `customer_number` = '$cust_number'" : "";
            $sql_name = ($name != "") ? "AND `nama_customer` LIKE '%$name%'" : "";
            $sql_userid = ($userid != "") ? "AND `cUserID` = '$userid'" : "";
            $sql_kode = ($kode_invoice != "") ? "AND `kode_invoice` LIKE '%$kode_invoice%'" : "";
            $sql_tgl = ($tanggal_tagihan != "") ? "AND `tanggal_tagihan` LIKE '%" . date("Y-m-d", strtotime($tanggal_tagihan)) . "%'" : "";

            $sql_data = mysql_query("SELECT `gx_invoice`.*, `tbCustomer`.`cUserID` FROM `gx_invoice`, tbCustomer
								  WHERE `gx_invoice`.`customer_number`=`tbCustomer`.`cKode`
								  AND `gx_invoice`.`id_cabang` = '" . $loggedin['cabang'] . "'
								  AND `gx_invoice`.`level` =  '0' $sql_cust_number $sql_name $sql_kode $sql_tgl $sql_userid ORDER BY `gx_invoice`.`id_invoice` DESC LIMIT $start, $perhalaman;", $conn);
            $sql_total_data = mysql_num_rows(mysql_query("SELECT `gx_invoice`.*, `tbCustomer`.`cUserID` FROM `gx_invoice`, tbCustomer
								WHERE `gx_invoice`.`customer_number`=`tbCustomer`.`cKode`
								AND `gx_invoice`.`id_cabang` = '" . $loggedin['cabang'] . "' AND  `gx_invoice`.`level` =  '0' $sql_cust_number $sql_name $sql_kode $sql_tgl $sql_userid;", $conn));

            $hal = "?c=$cust_number&n=$name&u=$userid&";

        }

        if (isset($_POST["search"])) {

            $cust_number = isset($_POST["cust_number"]) ? trim(strip_tags($_POST["cust_number"])) : "";
            $userid = isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
            $name = isset($_POST["name"]) ? trim(strip_tags($_POST["name"])) : "";
            $kode_invoice = isset($_POST["kode_invoice"]) ? trim(strip_tags($_POST["kode_invoice"])) : "";
            $tanggal_tagihan = isset($_POST["tanggal_tagihan"]) ? trim(strip_tags($_POST["tanggal_tagihan"])) : "";

            $sql_cust_number = ($cust_number != "") ? "AND `customer_number` = '$cust_number'" : "";
            $sql_name = ($name != "") ? "AND `nama_customer` LIKE '%$name%'" : "";
            $sql_userid = ($userid != "") ? "AND `cUserID` = '$userid'" : "";
            $sql_kode = ($kode_invoice != "") ? "AND `kode_invoice` LIKE '%$kode_invoice%'" : "";
            $sql_tgl = ($tanggal_tagihan != "") ? "AND `tanggal_tagihan` LIKE '%" . date("Y-m-d", strtotime($tanggal_tagihan)) . "%'" : "";

            $sql_data = mysql_query("SELECT `gx_invoice`.*, `tbCustomer`.`cUserID` FROM `gx_invoice`, tbCustomer
                WHERE `gx_invoice`.`customer_number`=`tbCustomer`.`cKode`
                AND `gx_invoice`.`id_cabang` = '" . $loggedin['cabang'] . "'
                AND `gx_invoice`.`level` =  '0' $sql_cust_number $sql_name $sql_kode $sql_tgl $sql_userid ORDER BY `gx_invoice`.`id_invoice` DESC LIMIT $start, $perhalaman;", $conn);
            $sql_total_data = mysql_num_rows(mysql_query("SELECT `gx_invoice`.*, `tbCustomer`.`cUserID` FROM `gx_invoice`, tbCustomer
				WHERE `gx_invoice`.`customer_number`=`tbCustomer`.`cKode`
				AND `gx_invoice`.`id_cabang` = '" . $loggedin['cabang'] . "' AND  `gx_invoice`.`level` =  '0' $sql_cust_number $sql_name $sql_kode $sql_tgl $sql_userid;", $conn));

            $hal = "?c=$cust_number&n=$name&u=$userid&";

        } else {
            $sql_data = mysql_query("SELECT `gx_invoice`.*, `tbCustomer`.`cUserID` FROM `gx_invoice`, tbCustomer
				WHERE `gx_invoice`.`customer_number`=`tbCustomer`.`cKode`
				AND `gx_invoice`.`id_cabang` = '" . $loggedin['cabang'] . "' AND   `gx_invoice`.`level` =  '0' ORDER BY `gx_invoice`.`id_invoice` DESC LIMIT $start, $perhalaman;", $conn);
            $sql_total_data = mysql_num_rows(mysql_query("SELECT `gx_invoice`.*, `tbCustomer`.`cUserID` FROM `gx_invoice`, tbCustomer
				WHERE `gx_invoice`.`customer_number`=`tbCustomer`.`cKode`
				AND `gx_invoice`.`id_cabang` = '" . $loggedin['cabang'] . "' AND  `gx_invoice`.`level` =  '0';", $conn));
            $hal = "?";
        }

        $no = $start + 1;

        while ($row_data = mysql_fetch_array($sql_data)) {

            $sql_data_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` =  '" . $row_data["id_cabang"] . "' LIMIT 0,1;", $conn);
            $row_data_cabang = mysql_fetch_array($sql_data_cabang);

            $grand_total = (int)($row_data["total"] + $row_data["ppn"]) - $row_data["uangmuka"];
            $grand_total = ($grand_total < 1) ? '0' : $grand_total;

            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td><a href="detail_invoice.php?c=' . $row_data["kode_invoice"] . '" onclick="return valideopenerform(\'detail_invoice.php?c=' . $row_data["kode_invoice"] . '\',\'Detail Invoice ' . $row_data["kode_invoice"] . '\');">' . $row_data["kode_invoice"] . '</a></td>
                    <td>' . date("d-m-Y", strtotime($row_data["tanggal_tagihan"])) . '</td>
                    
                    <td>' . $row_data["customer_number"] . '</td>
                    <td>' . $row_data['cUserID'] . '</td>
                    <td>' . $row_data["title"] . '</td>
                    <td>' . number_format(($row_data["total"] + $row_data["ppn"]), 0, ',', '.') . '</td>
                    <td>' . number_format($grand_total, 0, ',', '.') . '</td>
                    <td>' . number_format($row_data["uangmuka"], 0, ',', '.') . '</td>
                    <td>' . StatusInvoice($row_data["paid_status"]) . '</td>
                    <td align="center">' . (($row_data["posting"] == "1") ? '<span class="label label-success">OK</span>' : '<span class="label label-danger">X</span>') . '
                    <td>' . (($row_data["status"] == "1") ? '
                        <a href="pdf_invoice.php?id=' . $row_data["id_invoice"] . '" target="_blank"><span class="label label-info">PDF</span></a>
                        ' : '<a href="form_invoice_detail.php?c=' . $row_data["kode_invoice"] . '"><span class="label label-info">Detail</span></a>
                        <a href="form_invoice.php?id=' . $row_data["id_invoice"] . '"><span class="label label-info">Edit</span></a>
                        <a href="?id=' . $row_data["id_invoice"] . '&action=lock"><span class="label label-info">Lock</span></a>
                        <a href="?id=' . $row_data["id_invoice"] . '&action=hapus"><span class="label label-danger">Hapus</span></a>
                        ') . '
                    </td>
                </tr>';
            $no++;
        }

        $content .= '
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <div class="box-footer">
                                <div class="box-tools pull-right">
                                    ' . (halaman($sql_total_data, $perhalaman, 1, $hal)) . '
                                </div>
                                <br style="clear:both;">
                            </div>
                        </div>
	                </section>';

        $plugins = '<link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = 'Master Invoice';
        $submenu = "master_invoice";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;

    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>