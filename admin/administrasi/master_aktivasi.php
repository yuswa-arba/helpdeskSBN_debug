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

        enableLog("", $loggedin["username"], $loggedin["username"], "Open Aktivasi"); // for create log in newfunction2.php

        global $conn;
        global $conn_voip;

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
                                                <label>Kode Aktivasi :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="kode_aktivasi" type="text" placeholder="Kode Aktivasi">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Customer Number :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" name="id_customer" placeholder="Customer Number">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>User ID :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" type="text" name="userid" placeholder="User ID">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Nama Customer :</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input class="form-control" name="nama_customer" type="text" placeholder="Nama Customer">
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
									<h3 class="box-title">List Aktivasi Baru</h3>
									<a href="form_aktivasi_prorate.php" class="btn bg-olive btn-flat margin pull-right">Add</a>
								</div><!-- /.box-header -->
								
                                <table id="persetujuan" class="table table-bordered table-striped" style="white-space:nowrap;">
                                    <thead>
                                        <tr>
						                    <th>#</th>
                                            <th>Tanggal</th>
											<th>No. Aktivasi</th>
                                            <th>Nama</th>
											<th>UserID</th>
                                            <th>Alamat</th>
						                    <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        if (isset($_POST["search"])) {
            $userid = isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
            $id_customer = isset($_POST["id_customer"]) ? trim(strip_tags($_POST["id_customer"])) : "";
            $nama_customer = isset($_POST["nama_customer"]) ? trim(strip_tags($_POST["nama_customer"])) : "";
            $kode_aktivasi = isset($_POST["kode_aktivasi"]) ? trim(strip_tags($_POST["kode_aktivasi"])) : "";

            $sql_userid = ($userid != "") ? "AND `cUserID` LIKE '%$userid%'" : "";
            $sql_cust_number = ($id_customer != "") ? "AND `id_customer` LIKE '%$id_customer%'" : "";
            $sql_nama_customer = ($nama_customer != "") ? "AND `nama_customer` LIKE '%$nama_customer%'" : "";
            $sql_kode_aktivasi = ($kode_aktivasi != "") ? "AND `kode_aktivasi` LIKE '" . $kode_aktivasi . "'" : "";

            $sql_aktivasi = mysql_query("SELECT `gx_aktivasi`.*, `tbCustomer`.`cUserID` FROM `gx_aktivasi`, `tbCustomer`
				WHERE `gx_aktivasi`.`id_customer`=`tbCustomer`.`cKode`
				AND `gx_aktivasi`.`id_cabang` = '" . $loggedin['cabang'] . "'
				AND `gx_aktivasi`.`level` = '0'
				$sql_userid
				$sql_cust_number
				$sql_nama_customer
				$sql_kode_aktivasi
				ORDER BY `gx_aktivasi`.`id_aktivasi` DESC LIMIT $start,$perhalaman;", $conn);

            $sql_total_aktivasi = mysql_num_rows(mysql_query("SELECT `gx_aktivasi`.*, `tbCustomer`.`cUserID` FROM `gx_aktivasi`, `tbCustomer`
				WHERE `gx_aktivasi`.`id_customer`=`tbCustomer`.`cKode`
				AND `gx_aktivasi`.`id_cabang` = '" . $loggedin['cabang'] . "'
				AND `gx_aktivasi`.`level` = '0'
				$sql_userid
				$sql_cust_number
				$sql_nama_customer
				$sql_kode_aktivasi
				 ORDER BY `gx_aktivasi`.`id_aktivasi` DESC;", $conn));
            $hal = "?u=$userid&id=$id_customer&n=$nama_customer&k=$kode_aktivasi&";
        } else {

            $sql_aktivasi = mysql_query("SELECT `gx_aktivasi`.*, `tbCustomer`.`cUserID` FROM `gx_aktivasi`, `tbCustomer`
				WHERE `gx_aktivasi`.`id_customer`=`tbCustomer`.`cKode`
				AND `gx_aktivasi`.`id_cabang` = '" . $loggedin['cabang'] . "'
				AND `gx_aktivasi`.`level` = '0'
				ORDER BY `gx_aktivasi`.`id_aktivasi` DESC LIMIT $start,$perhalaman;", $conn);

            $sql_total_aktivasi = mysql_num_rows(mysql_query("SELECT `gx_aktivasi`.*, `tbCustomer`.`cUserID` FROM `gx_aktivasi`, `tbCustomer`
				WHERE `gx_aktivasi`.`id_customer`=`tbCustomer`.`cKode`
				AND `gx_aktivasi`.`id_cabang` = '" . $loggedin['cabang'] . "'
				AND `gx_aktivasi`.`level` = '0'
				ORDER BY `gx_aktivasi`.`id_aktivasi` DESC;", $conn));
            $hal = "?";
        }
        if (isset($_GET["u"])) {
            $userid = isset($_GET["u"]) ? trim(strip_tags($_GET["u"])) : "";
            $id_customer = isset($_GET["id"]) ? trim(strip_tags($_GET["id"])) : "";
            $nama_customer = isset($_GET["n"]) ? trim(strip_tags($_GET["n"])) : "";
            $kode_aktivasi = isset($_GET["k"]) ? trim(strip_tags($_GET["k"])) : "";

            $sql_userid = ($userid != "") ? "AND `cUserID` LIKE '%$userid%'" : "";
            $sql_cust_number = ($id_customer != "") ? "AND `id_customer` LIKE '%$id_customer%'" : "";
            $sql_nama_customer = ($nama_customer != "") ? "AND `nama_customer` LIKE '%$nama_customer%'" : "";
            $sql_kode_aktivasi = ($kode_aktivasi != "") ? "AND `kode_aktivasi` LIKE '" . $kode_aktivasi . "'" : "";


            $sql_aktivasi = mysql_query("SELECT `gx_aktivasi`.*, `tbCustomer`.`cUserID` FROM `gx_aktivasi`, `tbCustomer`
				WHERE `gx_aktivasi`.`id_customer`=`tbCustomer`.`cKode`
				AND `gx_aktivasi`.`id_cabang` = '" . $loggedin['cabang'] . "'
				AND `gx_aktivasi`.`level` = '0'
				$sql_userid
				$sql_cust_number
				$sql_nama_customer
				$sql_kode_aktivasi
				ORDER BY `gx_aktivasi`.`id_aktivasi` DESC LIMIT $start,$perhalaman;", $conn);

            $sql_total_aktivasi = mysql_num_rows(mysql_query("SELECT `gx_aktivasi`.*, `tbCustomer`.`cUserID` FROM `gx_aktivasi`, `tbCustomer`
				WHERE `gx_aktivasi`.`id_customer`=`tbCustomer`.`cKode`
				AND `gx_aktivasi`.`id_cabang` = '" . $loggedin['cabang'] . "'
				AND `gx_aktivasi`.`level` = '0'
				$sql_userid
				$sql_cust_number
				$sql_nama_customer
				$sql_kode_aktivasi
				 ORDER BY `gx_aktivasi`.`id_aktivasi` DESC;", $conn));
            $hal = "?u=$userid&id=$id_customer&n=$nama_customer&k=$kode_aktivasi&";
        }

        $no = 1;
        while ($row_aktivasi = mysql_fetch_array($sql_aktivasi)) {
            $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' AND `id_cabang` = '$row_aktivasi[id_cabang]';", $conn);
            $row_cabang = mysql_fetch_array($sql_cabang);

            $sql_invoice = mysql_query("SELECT * FROM `gx_invoice` WHERE `level` = '0' AND `kode_aktivasi` = '" . $row_aktivasi["kode_aktivasi"] . "' LIMIT 0,1;", $conn);
            $row_invoice = mysql_fetch_array($sql_invoice);

            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . date("d-m-Y", strtotime($row_aktivasi['tanggal'])) . '</td>
                    <td>' . $row_aktivasi['kode_aktivasi'] . '</td>
                    <td>' . $row_aktivasi['nama_customer'] . '</td>
                    <td>' . $row_aktivasi['cUserID'] . '</td>
                    <td>' . $row_aktivasi['alamat'] . '</td>
                    <td align="center">
                    <a href="form_invoice_detail.php?c=' . $row_invoice['kode_invoice'] . '"><span class="label label-info">View Invoice</span></a>
                    <a href="form_aktivasi_prorate.php?id=' . $row_aktivasi['id_aktivasi'] . '"><span class="label label-info">Edit</span></a>
                    </td>
                </tr>';

            $no++;
        }

        $content .= ' 
                                    </tbody>
                                </table> 
				            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="box-tools pull-right">
                                    ' . (halaman($sql_total_aktivasi, $perhalaman, 1, $hal)) . '
                                </div>
                                <br style="clear:both;">
                            </div>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '
            <link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />
            <!-- DataTable -->
            <link href="' . URL . 'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
            <!-- DATA TABES SCRIPT -->
            <script src="' . URL . 'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $(\'#customer\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>
    
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="' . URL . 'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    
            <!-- AdminLTE for demo purposes -->
            <script src="' . URL . 'js/AdminLTE/demo.js" type="text/javascript"></script>';

        $title = 'Master aktivasi';
        $submenu = "master_aktivasi";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>