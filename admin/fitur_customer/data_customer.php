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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Cust"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // menambil nilai/string yang ada pada url

        $content = '
            <section class="content-header">
                <h1>
                    Data Customer
                </h1>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Customer</h2>
                            </div>
                            
                            <div class="box-body table-responsive">
                                <div class="box-header"></div><!-- /.box-header -->
                                    <form action="" method="post" name="form_search" id="form_search">
                                        <table class="form" width="80%">
                                            <tr>
                                                <td><label>Customer Number</label></td>
                                                <td>
                                                    <input class="form-control" name="customer_number" placeholder="Customer Number" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Name</label></td>
                                                <td>
                                                    <input class="form-control" name="name" placeholder="Name" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Address</label></td>
                                                <td>
                                                    <textarea name="address" rows="6" cols="40" style="resize: none;"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label>Phone</label></td>
                                                <td>
                                                    <input class="form-control" name="phone" placeholder="Phone" type="text" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
                                                </td>
                                            </tr>
                                        </table>';

        if (isset($_POST["save_search"])) {
            $user_id = isset($_POST['user_id']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_id']))) : "";
            $customer_number = isset($_POST['customer_number']) ? mysql_real_escape_string(strip_tags(trim($_POST['customer_number']))) : "";
            $name = isset($_POST['name']) ? mysql_real_escape_string(strip_tags(trim($_POST['name']))) : "";
            //$title	= isset($_POST['title']) ? mysql_real_escape_string(strip_tags(trim($_POST['title']))) : "";
            $address = isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
            $phone = isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
            $email = isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
            $nama_ibu = isset($_POST['nama_ibu']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ibu']))) : "";
            $tgl_lahir = isset($_POST['tgl_lahir']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl_lahir']))) : "";

            $sql_nama = ($name != "") ? "AND `cNama` LIKE '" . $name . "%'" : "";
            $sql_userid = ($user_id != "") ? "AND `cUserID` LIKE '%" . $user_id . "%'" : "";
            $sql_address = ($address != "") ? "AND `cAlamat1` LIKE '%" . $address . "%'" : "";
            $sql_phone = ($phone != "") ? "AND `ctelp` LIKE '%" . $phone . "%'" : "";
            $sql_namaibu = ($nama_ibu != "") ? "AND `cNamaIbu` LIKE '%" . $nama_ibu . "%'" : "";
            $sql_tgl_lahir = ($tgl_lahir != "") ? "AND `dTglLahir` LIKE '%" . $tgl_lahir . "%'" : "";

            $sql_customer = "SELECT * FROM `tbCustomer`
                WHERE `cKode` LIKE '" . $customer_number . "%'
                $sql_nama
                $sql_userid
                $sql_address
                $sql_phone
                ORDER BY `idCustomer` ASC LIMIT 0,10;";

            $content .= '
                <table class="table table-bordered table-striped" id="customer">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Customer Number</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            $query_customer = mysql_query($sql_customer, $conn);
            $no = 1;
            if (isset($_GET["f"])) {
                if ($_GET["f"] == "data_customer") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <!--<td>' . $row_customer["cNamaIbu"] . '</td>-->
                                 <!--<td>' . $row_customer["ctelp"] . '</td>
                                 <td>' . $row_customer["cNonAktiv"] . '</td>-->
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_customer_inactive") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <!--<td>' . $row_customer["cNamaIbu"] . '</td>-->
                                 <!--<td>' . $row_customer["ctelp"] . '</td>
                                 <td>' . $row_customer["cNonAktiv"] . '</td>-->
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_customer_reaktivasi") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <!--<td>' . $row_customer["cNamaIbu"] . '</td>-->
                                 <!--<td>' . $row_customer["ctelp"] . '</td>
                                 <td>' . $row_customer["cNonAktiv"] . '</td>-->
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }

                if ($_GET["f"] == "data_customer_reaktivasi_new") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_inactive = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE `kode_customer`='" . $row_customer['cKode'] . "' ORDER BY `id` DESC LIMIT 0,1";
                        $query_inactive = mysql_query($sql_inactive, $conn);
                        $num_rows = mysql_num_rows($query_inactive);
                        $data_array = mysql_fetch_array($query_inactive);
                        $no_inactive = $num_rows > 0 ? $data_array['kode_inactive'] : '-';
                        $status_inactive = $num_rows > 0 ? 'Sopan' : 'Tidak Sopan';

                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($no_inactive) . '\',\'' . mysql_real_escape_string($status_inactive) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_customer_off_connection") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_inactive = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE `kode_customer`='" . $row_customer['cKode'] . "' ORDER BY `id` DESC LIMIT 0,1";
                        $query_inactive = mysql_query($sql_inactive, $conn);
                        $num_rows = mysql_num_rows($query_inactive);
                        $data_array = mysql_fetch_array($query_inactive);
                        $no_inactive = $num_rows > 0 ? $data_array['kode_inactive'] : '-';
                        $status_inactive = $num_rows > 0 ? 'Sopan' : 'Tidak Sopan';

                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($no_inactive) . '\',\'' . mysql_real_escape_string($status_inactive) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_spk_bongkar") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_inactive = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE `kode_customer`='" . $row_customer['cKode'] . "' ORDER BY `id` DESC LIMIT 0,1";
                        $query_inactive = mysql_query($sql_inactive, $conn);
                        $num_rows = mysql_num_rows($query_inactive);
                        $data_array = mysql_fetch_array($query_inactive);
                        $no_inactive = $num_rows > 0 ? $data_array['kode_inactive'] : '-';
                        $status_inactive = $num_rows > 0 ? 'Sopan' : 'Tidak Sopan';
                        /*`idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`, `cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`, `cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`, `cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`, `cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`, `cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cKdProspek`, `cNoKTP`, `cLongi`, `cLati`, `cBulanan`, `cTahunan`, `kontrak_awal`, `kontrak_akhir`, `nama_npwp`, `alamat_npwp`, `no_npwp`, `id_acc_justifikasi`, `id_cabang`, `ip_ap`, `ip_wl`, `ip_bts`, `bts`, `acc_type_rbs`, `user_ip`, `ddns`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`*/
                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($no_inactive) . '\',\'' . mysql_real_escape_string($row_customer['ctelp']) . '\',\'' . mysql_real_escape_string($row_customer['cAlamat1']) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_list_barang_customer") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_inactive = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE `kode_customer`='" . $row_customer['cKode'] . "' ORDER BY `id` DESC LIMIT 0,1";
                        $query_inactive = mysql_query($sql_inactive, $conn);
                        $num_rows = mysql_num_rows($query_inactive);
                        $data_array = mysql_fetch_array($query_inactive);
                        $no_inactive = $num_rows > 0 ? $data_array['kode_inactive'] : '-';
                        $status_inactive = $num_rows > 0 ? 'Sopan' : 'Tidak Sopan';

                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_balik_nama") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_open_connection") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {

                        $data_array_inactive = mysql_fetch_array(mysql_query("SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE `kode_customer`='" . $row_customer['cKode'] . "'", $conn));
                        $no_inactive = $data_array_inactive['kode_inactive'];
                        $status_inactive = isset($data_array_inactive['kode_inactive']) ? 'Sopan' : 'Tidak Sopan';

                        $data_array_off_connection = mysql_fetch_array(mysql_query("SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_off_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_off_connection` WHERE `kode_customer`='" . $row_customer['cKode'] . "'", $conn));
                        $no_off_connection = $data_array_off_connection['kode_off_connection'];

                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($no_inactive) . '\',\'' . mysql_real_escape_string($status_inactive) . '\',\'' . mysql_real_escape_string($no_off_connection) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_spk_maintance") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $sql_inactive = "SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_inactive`, `kode_customer`, `nama_customer`, `user_id`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_inactive_customer` WHERE `kode_customer`='" . $row_customer['cKode'] . "' ORDER BY `id` DESC LIMIT 0,1";
                        $query_inactive = mysql_query($sql_inactive, $conn);
                        $num_rows = mysql_num_rows($query_inactive);
                        $data_array = mysql_fetch_array($query_inactive);
                        $no_inactive = $num_rows > 0 ? $data_array['kode_inactive'] : '-';
                        $status_inactive = $num_rows > 0 ? 'Sopan' : 'Tidak Sopan';
                        /*`idCustomer`, `cKode`, `cNama`, `cAlamat1`, `cAlamat2`, `cKota`, `cArea`, `cContact`, `ctelp`, `cfax`, `cKet`, `nBatas`, `cKodePl`, `cNoAcc`, `dTglDtgAkhir`, `nHrKunjung`, `cSales`, `nNext`, `cSubArea`, `cDaerah`, `nNo`, `cMasukJd`, `cCab`, `cIntern`, `cNamaPers`, `cEmail`, `cUserID`, `cPaket`, `nHargaPaket`, `cCustInternet`, `cKdPaket`, `cKdOT`, `cNamaOT`, `dTglMulai`, `dTglBerhenti`, `cNonAktiv`, `rowguid`, `cIncludePPN`, `cExcludePPN`, `cIncludePPH`, `cNamaKomisi`, `nKomisi`, `cUserFree`, `cKodeParent`, `cIP1`, `cIP2`, `cIP3`, `nterm`, `cMailIntern`, `cCustomInfo1`, `cCustomInfo2`, `cCustomInfo3`, `cCustomInfo4`, `cComments`, `dTglLahir`, `cMacAdd`, `cKdBTS`, `cNamaBTS`, `cNoRekVirtual`, `cStatus`, `cNamaIbu`, `cNoHp1`, `cNoHp2`, `cNoHp3`, `cBarcode`, `cPassword`, `cIpR1`, `cIpR2`, `cIpR3`, `cIpR4`, `cAccIndex`, `iuserIndex`, `cGroupRBS`, `cJenis`, `cBaru`, `dTglTagihan`, `cKdNAS`, `NASAttribute`, `iGenerate`, `cKonversi`, `cKontrak`, `cPPHPasal23`, `cPPHPasal23Gx`, `cKdProspek`, `cNoKTP`, `cLongi`, `cLati`, `cBulanan`, `cTahunan`, `kontrak_awal`, `kontrak_akhir`, `nama_npwp`, `alamat_npwp`, `no_npwp`, `id_acc_justifikasi`, `id_cabang`, `ip_ap`, `ip_wl`, `ip_bts`, `bts`, `acc_type_rbs`, `user_ip`, `ddns`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`*/
                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($no_inactive) . '\',\'' . mysql_real_escape_string($row_customer['ctelp']) . '\',\'' . mysql_real_escape_string($row_customer['cAlamat1']) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }

                if ($_GET["f"] == "data_invoice_balik_nama") {
                    while ($row_customer = mysql_fetch_array($query_customer)) {
                        $nama_npwp = $row_customer['nama_npwp'];
                        $alamat_npwp = $row_customer['alamat_npwp'];
                        $no_npwp = $row_customer['no_npwp'];

                        $va = $row_customer['cNoRekVirtual'];
                        $nama_va = $row_customer['cNama'];
                        $faktur = $row_customer['cIncludePPN'];

                        $content .= '
                            <tr>
                                 <td>' . $no . '</td>
                                 <td>' . $row_customer["cKode"] . '</td>
                                 <td>' . $row_customer["cUserID"] . '</td>
                                 <td>' . $row_customer["cNama"] . '</td>
                                 <td>' . $row_customer["cAlamat1"] . '</td>
                                 <td>
                                   <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($no_npwp) . '\'\'' . mysql_real_escape_string($va) . '\'\'' . mysql_real_escape_string($nama_va) . '\'\'' . mysql_real_escape_string($faktur) . '\')">Select</a>
                                 </td>
                            </tr>';
                        $no++;
                    }
                }
            } else {
                while ($row_customer = mysql_fetch_array($query_customer)) {
                    $content .= '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row_customer["cKode"] . '</td>
                            <td>' . $row_customer["cUserID"] . '</td>
                            <td>' . $row_customer["cNama"] . '</td>
                            <td>' . $row_customer["cAlamat1"] . '</td>
                            <td>
                              <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_customer["cUserID"]) . '\',\'' . mysql_real_escape_string($row_customer["cKode"]) . '\',\'' . mysql_real_escape_string($row_customer["cNama"]) . '\',\'' . mysql_real_escape_string($row_customer["cAlamat1"]) . '\',\'' . mysql_real_escape_string($row_customer["cNamaPers"]) . '\',\'' . mysql_real_escape_string($row_customer["cKota"]) . '\',\'' . mysql_real_escape_string($row_customer["cfax"]) . '\',\'' . mysql_real_escape_string($row_customer["ctelp"]) . '\',\'' . mysql_real_escape_string($row_customer["cEmail"]) . '\',\'' . mysql_real_escape_string($row_customer["cPaket"]) . '\',\'' . mysql_real_escape_string($row_customer["cNoHp1"]) . '\',\'' . mysql_real_escape_string($row_customer["cNoHp2"]) . '\',\'' . mysql_real_escape_string($row_customer["cContact"]) . '\')">Select</a>
                            </td>
                        </tr>';
                    $no++;
                }
            }

            $content .= '
                                        </tbody>
                                    </table>';
        }
        $content .= '
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
            if ($_GET["f"] == "data_customer") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid_, custNumber, nama){
   	                   	    window.opener.document.' . $return_form . '.uid.value=uid_;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    self.close();
   	                    }
                    </script>';
            }
            if ($_GET["f"] == "data_customer_inactive") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    self.close();
   	                    }
                    </script>';
            }

            if ($_GET["f"] == "data_customer_reaktivasi") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    self.close();
   	                    }
                    </script>';
            }

            if ($_GET["f"] == "data_customer_reaktivasi_new") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama, ni, si){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    window.opener.document.' . $return_form . '.no_inactive.value=ni;
   	                   	    window.opener.document.' . $return_form . '.status_inactive.value=si;
   	                   	    self.close();
   	                    }
                    </script>';
            }
            if ($_GET["f"] == "data_customer_off_connection") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama, ni, si){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    window.opener.document.' . $return_form . '.no_inactive.value=ni;
   	                   	    window.opener.document.' . $return_form . '.status_inactive.value=si;
   	                   	    self.close();
   	                    }
                    </script>';
            }
            if ($_GET["f"] == "data_spk_bongkar") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama, ni, tel, alm){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    window.opener.document.' . $return_form . '.no_inactive.value=ni;
   	                   	    window.opener.document.' . $return_form . '.telp.value=tel;
   	                   	    window.opener.document.' . $return_form . '.alamat.value=alm;
   	                   	    self.close();
   	                    }
                    </script>';
            }

            if ($_GET["f"] == "data_list_barang_customer") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    self.close();
   	                    }
                    </script>';
            }

            if ($_GET["f"] == "data_balik_nama") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_lama.value=nama;
   	                   	    self.close();
   	                    }
                    </script>';
            }

            if ($_GET["f"] == "data_open_connection") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama, ni, si, noc){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    window.opener.document.' . $return_form . '.no_inactive.value=ni;
   	                   	    window.opener.document.' . $return_form . '.status_inactive.value=si;
   	                   	    window.opener.document.' . $return_form . '.no_off_connection.value=noc;
   	                   	    self.close();
   	                    }
                    </script>';
            }
            if ($_GET["f"] == "data_spk_maintance") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid, custNumber, nama, ni, tel, alm){
   	                   	    window.opener.document.' . $return_form . '.user_id.value=uid;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    window.opener.document.' . $return_form . '.no_inactive.value=ni;
   	                   	    window.opener.document.' . $return_form . '.telp.value=tel;
   	                   	    window.opener.document.' . $return_form . '.alamat.value=alm;
   	                   	    self.close();
   	                    }
                    </script>';
            }
            if ($_GET["f"] == "data_invoice_balik_nama") {
                $plugins .= '
                    <script type="text/javascript">
   	                    function validepopupform2(uid_, custNumber, nama, no_npwp, va, nama_va, faktur){
   	                   	    window.opener.document.' . $return_form . '.uid.value=uid_;
   	                   	    window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
   	                   	    window.opener.document.' . $return_form . '.nama_customer.value=nama;
   	                   	    window.opener.document.' . $return_form . '.npwp.value=no_npwp;
   	                   	    window.opener.document.' . $return_form . '.no_virtual_account_bca.value=va;
   	                   	    window.opener.document.' . $return_form . '.nama_virtual_account.value=nama_va;
   	                   	    window.opener.document.' . $return_form . '.no_faktur_pajak.value=faktur;
   	                   	    self.close();
   	                    }
                    </script>';
            }
        } else {
            $plugins .= '
                <script type="text/javascript">
                    function validepopupform2(uid, custNumber, nama, alamat, namaperusahaan, kota, fax, ctelp, cemail, con_type, hp1, hp2, contact){
                        window.opener.document.' . $return_form . '.kode_customer.value=custNumber;
                        window.opener.document.' . $return_form . '.nama_customer.value=nama;
                        window.opener.document.' . $return_form . '.nama_perusahaan.value=namaperusahaan;
                        window.opener.document.' . $return_form . '.alamat.value=alamat;
                        window.opener.document.' . $return_form . '.kota.value=kota;
                        window.opener.document.' . $return_form . '.notelp.value=ctelp;
                        window.opener.document.' . $return_form . '.hp1.value=hp1;
                        window.opener.document.' . $return_form . '.hp2.value=hp2;
                        window.opener.document.' . $return_form . '.contact.value=contact;
                        window.opener.document.' . $return_form . '.email.value=cemail;
                        self.close();
                    }
                </script>';
        }

        $title = 'Data Customer';
        $submenu = "helpdesk";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>