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

redirectToHTTPS();
if ($loggedin = logged_inAdmin()) { // Check if they are logged in
    if ($loggedin["group"] == 'admin') {
        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cabang");
        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Cabang</h2>
                            </div>
				
                            <div class="box-body table-responsive">
				                <div class="box-header"></div><!-- /.box-header -->
                                <form action="" method="post" name="form_search" id="form_search">';

        if (isset($_POST["save_search"])) {

        } else {
            $sql_cabang = "SELECT * FROM `gx_cabang` WHERE `level` = '0' ORDER BY `id_cabang` ASC LIMIT 0,10;";
        }
        $content .= '
            <table class="table table-bordered table-striped" id="customer">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Cabang</th>
                        <th>nama Cabang</th>
                        <th>Date Add</th>
                        <th>User Add</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';


        $query_cabang = mysql_query($sql_cabang, $conn);
        $no = 1;
        if (isset($_GET["f"])) {
            if ($_GET["f"] == "aktivasi") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_last_aktivasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_aktivasi` ORDER BY `id_aktivasi` DESC", $conn));
                    $last_data = $sql_last_aktivasi["id_aktivasi"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_spk_aktivasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                             <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';

                    $no++;
                }
            } elseif ($_GET["f"] == "survey") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_last_survey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_survey` ORDER BY `id_survey` DESC", $conn));
                    $last_data = $sql_last_survey["id_survey"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_spk_survey"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                          <td>' . $no . '</td>
                          <td>' . $row_cabang["kode_cabang"] . '</td>
                          <td>' . $row_cabang["nama_cabang"] . '</td>
                          <td>' . $row_cabang["date_add"] . '</td>
                          <td>' . $row_cabang["user_add"] . '</td>
                          <td>
                            <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                          </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "jawabsurvey") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_last_jawab = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` ORDER BY `id_jawab_spksurvey` DESC", $conn));
                    $last_data = $sql_last_jawab["id_jawab_spksurvey"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_jawab_survey"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                          <td>' . $no . '</td>
                          <td>' . $row_cabang["kode_cabang"] . '</td>
                          <td>' . $row_cabang["nama_cabang"] . '</td>
                          <td>' . $row_cabang["date_add"] . '</td>
                          <td>' . $row_cabang["user_add"] . '</td>
                          <td>
                            <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                          </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "ctrljustifikasi") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_controljust = mysql_fetch_array(mysql_query("SELECT * FROM `gx_control_justifikasi` ORDER BY `id_control_justifikasi` DESC", $conn));
                    $last_data = $sql_controljust["id_control_justifikasi"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_control_justifikasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                          <td>' . $no . '</td>
                          <td>' . $row_cabang["kode_cabang"] . '</td>
                          <td>' . $row_cabang["nama_cabang"] . '</td>
                          <td>' . $row_cabang["date_add"] . '</td>
                          <td>' . $row_cabang["user_add"] . '</td>
                          <td>
                            <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                          </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "persetujuanjustifikasi") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_perseetujuanjust = mysql_fetch_array(mysql_query("SELECT * FROM `gx_persetujuan_justifikasi` ORDER BY `id_persetujuan_justifikasi` DESC", $conn));
                    $last_data = $sql_perseetujuanjust["id_persetujuan_justifikasi"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_acc_justifikasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                          <td>' . $no . '</td>
                          <td>' . $row_cabang["kode_cabang"] . '</td>
                          <td>' . $row_cabang["nama_cabang"] . '</td>
                          <td>' . $row_cabang["date_add"] . '</td>
                          <td>' . $row_cabang["user_add"] . '</td>
                          <td>
                            <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                          </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "linkbudget") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_last_link = mysql_fetch_array(mysql_query("SELECT * FROM `gx_link_budget` ORDER BY `id_link_budget` DESC", $conn));
                    $last_data = $sql_last_link["id_link_budget"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_link_budget"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "permohonanjustifikasi") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_permohonanjustifikasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permohonan_justifikasi` ORDER BY `id_permohonan_justifikasi` DESC", $conn));
                    $last_data = $sql_permohonanjustifikasi["id_permohonan_justifikasi"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_justifikasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "spkpasangbaru") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_spkpasang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` ORDER BY `id_spkpasang` DESC", $conn));
                    $last_data = $sql_spkpasang["id_spkpasang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_spk_pasang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "jawabspkpasangbaru") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_jawab_spkpasang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkpasang` ORDER BY `id_jawab_spkpasang` DESC", $conn));
                    $last_data = $sql_jawab_spkpasang["id_jawab_spkpasang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_jawab_pasang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "jawabspkaktivasibaru") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_jawab_spkaktivasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` ORDER BY `id_jawab_spkaktivasi` DESC", $conn));
                    $last_data = $sql_jawab_spkaktivasi["id_jawab_spkaktivasi"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_jawab_aktivasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "formulir") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_formulir = mysql_fetch_array(mysql_query("SELECT * FROM `gx_formulir` ORDER BY `id_formulir` DESC", $conn));
                    $last_data = $sql_formulir["id_formulir"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_formulir"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "spkaktivasi") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_spk_aktivasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_aktivasi` ORDER BY `id_spkaktivasi` DESC", $conn));
                    $last_data = $sql_spk_aktivasi["id_spkaktivasi"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_spk_aktivasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                           <td>' . $no . '</td>
                           <td>' . $row_cabang["kode_cabang"] . '</td>
                           <td>' . $row_cabang["nama_cabang"] . '</td>
                           <td>' . $row_cabang["date_add"] . '</td>
                           <td>' . $row_cabang["user_add"] . '</td>
                           <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                           </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "invoice") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_invoice = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
                    $last_data = $sql_invoice["id_invoice"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["invoice_code"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "cetakformulir") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_cetak_formulir = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cetak_formulir` ORDER BY `id_cetak_formulir` DESC", $conn));
                    $last_data = $sql_cetak_formulir["id_cetak_formulir"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_cetak_formulir"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "barang") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_barang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_barang` ORDER BY `id_barang` DESC", $conn));
                    $last_data = $sql_barang["id_barang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_barang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "gudang") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_barang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_gudang` ORDER BY `id_gudang` DESC", $conn));
                    $last_data = $sql_barang["id_gudang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_gudang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "ruang") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_barang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_ruang` ORDER BY `id_ruang` DESC", $conn));
                    $last_data = $sql_barang["id_ruang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_ruang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "permintaan_pembelian") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_permintaan_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permintaan_pembelian` ORDER BY `id_permintaan_pembelian` DESC", $conn));
                    $last_data = $sql_permintaan_beli["id_permintaan_pembelian"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_mbeli"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "periksa_pembelian") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_periksa_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_periksa_pembelian` ORDER BY `id_periksa_pembelian` DESC", $conn));
                    $last_data = $sql_periksa_beli["id_periksa_pembelian"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_pbeli"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "setuju_pembelian") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_permintaan_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_setuju_pembelian` ORDER BY `id_setuju_pembelian` DESC", $conn));
                    $last_data = $sql_permintaan_beli["id_setuju_pembelian"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_sbeli"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "pindah_ruang") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_permintaan_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_pindahruang` ORDER BY `id_pindah` DESC", $conn));
                    $last_data = $sql_permintaan_beli["id_pindah"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_pindahruang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "order_beli") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_order_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_order_beli` ORDER BY `id_order_beli` DESC", $conn));
                    $last_data = $sql_order_beli["id_order_beli"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_po"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "beli") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_beli` ORDER BY `id_beli` DESC", $conn));
                    $last_data = $sql_beli["id_beli"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_beli"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "returbeli") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_returbeli` ORDER BY `id_returbeli` DESC", $conn));
                    $last_data = $sql_beli["id_returbeli"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_returbeli"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "cetak") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cetak_barcode` ORDER BY `id_cetak` DESC", $conn));
                    $last_data = $sql_beli["id_cetak"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_cetak"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "penjualan_barang") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_penjualan_barang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_penjualan_barang` ORDER BY `id_penjualan_barang` DESC", $conn));
                    $last_data = $sql_penjualan_barang["id_penjualan_barang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_penjualan_barang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }

            } elseif ($_GET["f"] == "permintaan_pengeluaran") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_penjualan_barang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_permintaan_pengeluaran_barang` ORDER BY `id_permintaan_pengeluaran_barang` DESC", $conn));
                    $last_data = $sql_penjualan_barang["id_permintaan_pengeluaran_barang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_permintaan_pengeluaran_barang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            } elseif ($_GET["f"] == "acc_pengeluaran") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $sql_penjualan_barang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_acc_pengeluaran_barang` ORDER BY `id_acc_pengeluaran_barang` DESC", $conn));
                    $last_data = $sql_penjualan_barang["id_acc_pengeluaran_barang"] + 1;
                    $tanggal = date("d");
                    $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_acc_pengeluaran_barang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }

            } elseif ($_GET["f"] == "pinjam" OR $_GET["f"] == "retur") {
                while ($row_cabang = mysql_fetch_array($query_cabang)) {
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_cabang["kode_cabang"] . '</td>
                            <td>' . $row_cabang["nama_cabang"] . '</td>
                            <td>' . $row_cabang["date_add"] . '</td>
                            <td>' . $row_cabang["user_add"] . '</td>
                            <td>
                                <a href="" onclick="validepopupform2( \'' . mysql_real_escape_string($row_cabang["id_cabang"]) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            }
        } else {
            while ($row_cabang = mysql_fetch_array($query_cabang)) {
                $sql_last_prospek = mysql_fetch_array(mysql_query("SELECT * FROM `gx_prospek` ORDER BY `id_prospek` DESC", $conn));
                $last_data = $sql_last_prospek["id_prospek"] + 1;
                $tanggal = date("d");
                $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_prospek"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                $content .= '
                    <tr>
                        <td>' . $no . '</td>
                        <td>' . $row_cabang["kode_cabang"] . '</td>
                        <td>' . $row_cabang["nama_cabang"] . '</td>
                        <td>' . $row_cabang["date_add"] . '</td>
                        <td>' . $row_cabang["user_add"] . '</td>
                        <td>
                            <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($kode_cabang) . '\', \'' . mysql_real_escape_string($row_cabang["nama_cabang"]) . '\')">Select</a>
                        </td>
                    </tr>';
                $no++;
            }
        }

        $content .= '
                  
                </tbody>
              </table>
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
  </section><!-- /.content -->';

        $plugins = '
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
            </script>';

        if (isset($_GET["f"])) {
            if ($_GET["f"] == "aktivasi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(noaktivasi, idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_aktivasi.value=noaktivasi;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "survey") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nosurvey,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.no_survey.value=nosurvey;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "gudang") {
                $plugins .= '
                    <script type="text/javascript">
                         function validepopupform2(nogudang,idcabang, namacabang){
                             window.opener.document.' . $return_form . '.kode_gudang.value=nogudang;
                             window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                             window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                             self.close();
                         }
                    </script>';
            } elseif ($_GET["f"] == "jawabsurvey") {
                $plugins .= '
                    <script type="text/javascript">
                      
                        function validepopupform2(nojawabsurvey,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.no_jawab.value=nojawabsurvey;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "ctrljustifikasi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(noctrljustifikasi,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.no_control_justifikasi.value=noctrljustifikasi;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "persetujuanjustifikasi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(persetujuanjustifikasi,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.no_persetujuan_justifikasi.value=persetujuanjustifikasi;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "linkbudget") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nolinkbudget,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.link.value=nolinkbudget;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "permohonanjustifikasi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(cpermohonanjustifikasi,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.no_justifikasi.value=cpermohonanjustifikasi;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "jawabspkpasangbaru") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodejawab,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_jawab_spk.value=kodejawab;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.namecabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "jawabspkaktivasibaru") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodejawabspkaktivasi,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_jawab_spkaktivasi.value=kodejawabspkaktivasi;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.namecabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "spkpasangbaru") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodespk,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_spk.value=kodespk;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.namecabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "formulir") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodeformulir,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_formulir.value=kodeformulir;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.namecabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "spkaktivasi") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodespkaktivasi,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_spkaktivasi.value=kodespkaktivasi;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.namecabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "invoice") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodeinvoice,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_invoice.value=kodeinvoice;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "cetakformulir") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(kodecetakformulir,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_cetak_formulir.value=kodecetakformulir;
                            window.opener.document.' . $return_form . '.cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "barang") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nobarang,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_barang.value=nobarang;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "ruang") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nor,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_ruang.value=nor;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "periksa_pembelian") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(noperiksabeli,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_periksa_pembelian.value=noperiksabeli;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "permintaan_pembelian") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nopermintaanbeli,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_permintaan_pembelian.value=nopermintaanbeli;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "setuju_pembelian") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nosetujubeli,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_setuju_pembelian.value=nosetujubeli;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "pindah_ruang") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nopindah,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_pindah.value=nopindah;
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "order_beli") {
                $plugins .= '
                     <script type="text/javascript">
                         function validepopupform2(nopindah,idcabang, namacabang){
                             window.opener.document.' . $return_form . '.kode_order_beli.value=nopindah;
                             window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                             window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                             self.close();
                         }
                     </script>';
            } elseif ($_GET["f"] == "returbeli") {
                $plugins .= '
                    <script type="text/javascript">
                       function validepopupform2(nobeli,idcabang, namacabang){
                           window.opener.document.' . $return_form . '.kode_returbeli.value=nobeli;
                           window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                           window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                           self.close();
                       }
                    </script>';
            } elseif ($_GET["f"] == "beli") {
                $plugins .= '
                    <script type="text/javascript">
                       function validepopupform2(nobeli,idcabang, namacabang){
                           window.opener.document.' . $return_form . '.kode_beli.value=nobeli;
                           window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                           window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                           self.close();
                       }
                    </script>';
            } elseif ($_GET["f"] == "cetak") {
                $plugins .= '
                    <script type="text/javascript">
                       function validepopupform2(nobeli,idcabang, namacabang){
                           window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                           window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                           self.close();
                       }
                    </script>';
            } elseif ($_GET["f"] == "penjualan_barang") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(nojual,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_penjualan.value=nojual;
                            window.opener.document.' . $return_form . '.kode_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "permintaan_pengeluaran") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(noPermintaanpengeluaran,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_permintaan_pengeluaran.value=noPermintaanpengeluaran;
                            window.opener.document.' . $return_form . '.kode_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "acc_pengeluaran") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(noaccpengeluaran,idcabang, namacabang){
                            window.opener.document.' . $return_form . '.kode_acc_pengeluaran.value=noaccpengeluaran;
                            window.opener.document.' . $return_form . '.kode_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            } elseif ($_GET["f"] == "pinjam" OR $_GET["f"] == "retur") {
                $plugins .= '
                    <script type="text/javascript">
                        function validepopupform2(idcabang, namacabang){
                            window.opener.document.' . $return_form . '.id_cabang.value=idcabang;
                            window.opener.document.' . $return_form . '.nama_cabang.value=namacabang;
                            self.close();
                        }
                    </script>';
            }
        } else {
            $plugins .= '
                <script type="text/javascript">
                    function validepopupform2(kodecabang, namacabang){
                        window.opener.document.' . $return_form . '.no_prospek.value=kodecabang;
                        window.opener.document.' . $return_form . '.cabang.value=namacabang;
                        self.close();
                    }
                </script>';
        }

        $title = 'Data Cabang';
        $submenu = "cabang";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>