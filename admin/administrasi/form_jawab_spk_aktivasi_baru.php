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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Jawaban SPK Aktivasi"); // for create log in newfunction2.php

        global $conn;
        global $conn_voip;

        if (isset($_GET['id'])) {

            $get_id = isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : ""; // untuk mengambil nilai/string yang ada pada url

            $data_jawaban_spk_aktivasi_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` WHERE `id_jawab_spkaktivasi`='$get_id'", $conn));
            $data_jawaban_spk_aktivasi_baru_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$data_jawaban_spk_aktivasi_baru[id_teknisi]'", $conn));
            $data_jawaban_spk_aktivasi_baru_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$data_jawaban_spk_aktivasi_baru[id_marketing]'", $conn));
            $data_jawaban_spk_aktivasi_baru_teknisi2 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$data_jawaban_spk_aktivasi_baru[id_teknisi2]'", $conn));
            $data_jawaban_spk_aktivasi_baru_teknisi3 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$data_jawaban_spk_aktivasi_baru[id_teknisi3]'", $conn));
            $data_jawaban_spk_aktivasi_baru_teknisi4 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$data_jawaban_spk_aktivasi_baru[id_teknisi4]'", $conn));
            $data_jawaban_spk_aktivasi_baru_teknisi5 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$data_jawaban_spk_aktivasi_baru[id_teknisi5]'", $conn));
            $data_cabang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang`='$data_jawaban_spk_aktivasi_baru[id_cabang]'", $conn));
        }

        $query_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' ORDER BY `id_cabang` ASC LIMIT 1;", $conn);
        $row_cabang = mysql_fetch_array($query_cabang);
        $sql_jawab_spkaktivasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` ORDER BY `id_jawab_spkaktivasi` DESC", $conn));
        $last_data = $sql_jawab_spkaktivasi["id_jawab_spkaktivasi"] + 1;
        $tanggal = date("d");
        $kode_jawab_aktivasi = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_jawab_aktivasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);

        $content = '
		    <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
				                <form action="" role="form" name="myForm"  method="POST" >
			                        <div >
                                        <fieldset>
                                            <legend>Data Jawab SPK Aktivasi Baru</legend>
                                            
                                            <div class="table-container table-form">
                                                <div class="box-body">
                                                    <div class="col-xs-12">
                                          
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Cabang</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input type="hidden" class="form-control" name="id_jawab_spkaktivasi" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru["id_jawab_spkaktivasi"] : "") . '">
                                                                    <input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="' . (isset($_GET['id']) ? $row_customer["id_cabang"] : $loggedin["cabang"]) . '" >
                                                                    <input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="' . get_nama_cabang($loggedin['cabang']) . '">
                                                                
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>No. Jawab SPK Aktivasi</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input type="text" required="" name="kode_jawab_spkaktivasi" readonly="" class="form-control"  value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['kode_jawab_aktivasi'] : $kode_jawab_aktivasi) . '" placeholder="No. Jawab SPK Pasang Baru">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>No. SPK Aktivasi Baru</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" type="text" readonly="" name="kode_spk" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['kode_spkaktivasi'] : "") . '">
                                                                    <a href="data_spk_aktivasi_baru.php?r=myForm" onclick="return valideopenerform(\'data_spk_aktivasi_baru.php?r=myForm\',\'spk_aktivasi_baru\');">Search SPK Aktivasi Baru</a>
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Tanggal</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control required" required="" readonly="" name="tanggal" id="tanggal" placeholder="Tanggal" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['tanggal'] : date("Y-m-d")) . '" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Kode Customer</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_customer'] : "") . '" >
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Nama Customer</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="nama_customer" placeholder="Nama Customer" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['nama_customer'] : "") . '">
                                                                    <input type="hidden" name="nama_perusahaan">
                                                                    <input type="hidden" name="kota">
                                                                    <input type="hidden" name="notelp">
                                                                    <input type="hidden" name="hp1">
                                                                    <input type="hidden" name="hp2">
                                                                    <input type="hidden" name="contact">
                                                                    <input type="hidden" name="email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>No. Link Budget</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="no_link_budget" placeholder="No Link Budget" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_linkbudget'] : "") . '" >
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Paket Koneksi</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="paket_koneksi" placeholder="Paket Koneksi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['paket_koneksi'] : "") . '" >
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Nama Koneksi</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="nama_koneksi" placeholder="Nama Koneksi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['nama_koneksi'] : "") . '" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>User ID</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="user_id" readonly="" placeholder="User ID" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['user_id'] : "") . '">
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Telp</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" required="" name="telpon" placeholder="Telepon" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['telpon'] : "") . '">
                                                                </div>
                                                            </div>
                                                        </div>
                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                   <label>Alamat</label>
                                                                </div>
                                                                <div class="col-xs-10">
                                                                   <input class="form-control" required="" name="alamat" placeholder="alamat" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['alamat'] : "") . '">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Teknisi 1</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" readonly="" name="id_teknisi" type="hidden" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_teknisi'] : "") . '">
                                                                    <input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi['nama'] : "") . '">
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Marketing</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" readonly="" name="id_employee" type="hidden" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_marketing'] : "") . '">
                                                                    <input class="form-control" readonly="" name="nama_marketing" placeholder="Marketing" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_marketing['nama'] : "") . '">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Teknisi 2</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" readonly="" name="id_teknisi_2" type="hidden" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_teknisi2'] : "") . '">
                                                                    <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=2\',\'teknisi\');" name="nama_teknisi_2" placeholder="Nama Teknisi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi2['nama'] : "") . '">
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Teknisi 4</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" readonly="" name="id_teknisi_4" type="hidden" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_teknisi4'] : "") . '">
                                                                    <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=4\',\'teknisi4\');" name="nama_teknisi_4" placeholder="Nama Teknisi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi4['nama'] : "") . '">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Teknisi 3</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" readonly="" name="id_teknisi_3" type="hidden" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_teknisi3'] : "") . '">
                                                                    <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=3\',\'teknisi3\');" name="nama_teknisi_3" placeholder="Nama Teknisi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi3['nama'] : "") . '">
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <label>Teknisi 5</label>
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input class="form-control" readonly="" name="id_teknisi_5" type="hidden" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['id_teknisi5'] : "") . '">
                                                                    <input class="form-control" readonly="" onclick="valideopenerform(\'data_teknisi.php?r=myForm&t=5\',\'teknisi5\');" name="nama_teknisi_5" placeholder="Nama Teknisi" type="text" value="' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru_teknisi5['nama'] : "") . '">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Status</label>
                                                                </div>
                                                                <div class="col-xs-10">
                                                                    <table>
                                                                        <tr>
                                                                            <td>Cleared</td>
                                                                            <td>
                                                                                <input class="minimal" name="status" type="radio" value="cleared" ' . (isset($_GET['id']) ? ($data_jawaban_spk_aktivasi_baru['status'] == 'cleared' ? "checked" : "") : "") . '>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Uncleared</td>
                                                                            <td>
                                                                                <input class="minimal" name="status" type="radio" value="uncleared" ' . (isset($_GET['id']) ? ($data_jawaban_spk_aktivasi_baru['status'] == 'uncleared' ? "checked" : "") : "") . '>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                  <label>Perkerjaan</label>
                                                                </div>
                                                                <div  class="col-xs-10">
                                                                    <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;">' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['pekerjaan'] : "") . '</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2">
                                                                    <label>Solusi</label>
                                                                </div>
                                                                <div  class="col-xs-10">
                                                                    <textarea name="solusi" class="form-control" placeholder="Solusi" style="resize: none;">' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru['solusi'] : "") . '</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-3">
                                                                    <label>Created By</label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    ' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru["user_add"] : $loggedin["username"]) . '
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-3">
                                                                    <label>Latest Updated By </label>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    ' . (isset($_GET['id']) ? $data_jawaban_spk_aktivasi_baru["user_upd"] . " " . $data_jawaban_spk_aktivasi_baru["date_upd"] : "") . '
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-xs-2"></div>
                                                                <div class="col-xs-4">
                                                                    <input name="created_by" value="' . $loggedin["username"] . '" type="hidden">
                                                                    <input name="id_employee" value="' . $loggedin["id_employee"] . '" type="hidden">
                                                                    
                                                                    <a href="master_jawab_spk_aktivasi_baru.php" class="btn btn-default">Back</a> &nbsp;
                                                                    <input type="submit" class="btn btn-primary" data-icon="v" name="' . (isset($_GET['id']) ? "update" : "save") . '" value="Save">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>
                                            </fieldset>
                                        </div>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

        $save = isset($_POST["save"]) ? $_POST["save"] : "";
        $update = isset($_POST["update"]) ? $_POST["update"] : "";


        if ($save == "Save") {
            $kode_jawab_spk = isset($_POST["kode_jawab_spkaktivasi"]) ? mysql_real_escape_string(trim($_POST["kode_jawab_spkaktivasi"])) : '';
            $kode_spk = isset($_POST["kode_spk"]) ? mysql_real_escape_string(trim($_POST["kode_spk"])) : "";
            $tanggal = isset($_POST["tanggal"]) ? mysql_real_escape_string(trim($_POST["tanggal"])) : "";
            $id_customer = isset($_POST["kode_customer"]) ? mysql_real_escape_string(trim($_POST["kode_customer"])) : "";
            $nama_customer = isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim($_POST["nama_customer"])) : "";
            $id_cabang = isset($_POST["id_cabang"]) ? mysql_real_escape_string(trim($_POST["id_cabang"])) : "";
            $id_linkbudget = isset($_POST["no_link_budget"]) ? mysql_real_escape_string(trim($_POST["no_link_budget"])) : "";
            $paket_koneksi = isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim($_POST["paket_koneksi"])) : "";
            $nama_koneksi = isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim($_POST["nama_koneksi"])) : "";
            $user_id = isset($_POST["user_id"]) ? mysql_real_escape_string(trim($_POST["user_id"])) : "";
            $telpon = isset($_POST["telpon"]) ? mysql_real_escape_string(trim($_POST["telpon"])) : "";
            $alamat = isset($_POST["alamat"]) ? mysql_real_escape_string(trim($_POST["alamat"])) : "";
            $id_marketing = isset($_POST["id_employee"]) ? mysql_real_escape_string(trim($_POST["id_employee"])) : "";
            $id_teknisi = isset($_POST["id_teknisi"]) ? mysql_real_escape_string(trim($_POST["id_teknisi"])) : "";
            $id_teknisi2 = isset($_POST["id_teknisi2"]) ? mysql_real_escape_string(trim($_POST["id_teknisi2"])) : '';
            $id_teknisi3 = isset($_POST["id_teknisi3"]) ? mysql_real_escape_string(trim($_POST["id_teknisi3"])) : '';
            $id_teknisi4 = isset($_POST["id_teknisi4"]) ? mysql_real_escape_string(trim($_POST["id_teknisi4"])) : '';
            $id_teknisi5 = isset($_POST["id_teknisi5"]) ? mysql_real_escape_string(trim($_POST["id_teknisi5"])) : '';
            $pekerjaan = isset($_POST["pekerjaan"]) ? mysql_real_escape_string(trim($_POST["pekerjaan"])) : '';
            $status = isset($_POST["status"]) ? mysql_real_escape_string(trim($_POST["status"])) : '';
            $solusi = isset($_POST["solusi"]) ? trim($_POST["solusi"]) : '';
            $alat_terpasang = isset($_POST["alat_terpasang"]) ? trim($_POST["alat_terpasang"]) : '';

            /*$ = isset($_POST[""]) ? $_POST[""] : "";*/
            $sql_select = mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` WHERE `id_customer` = '" . $id_customer . "' LIMIT 1;", $conn);
            $total_select = mysql_num_rows($sql_select);

            if ($total_select == 0) {

                $insert_spk_aktivasi_baru = "INSERT INTO `gx_jawab_spkaktivasi`(`id_jawab_spkaktivasi`, `kode_jawab_aktivasi`, `kode_spkaktivasi`, `tanggal`, `id_customer`,
					`nama_customer`, `id_cabang`, `id_linkbudget`, `paket_koneksi`, `nama_koneksi`, `user_id`, `telpon`,
					`alamat`, `id_marketing`, `id_teknisi`, `id_teknisi2`, `id_teknisi3`, `id_teknisi4`, `id_teknisi5`, `pekerjaan`,
					`status`, `solusi`, `alat_terpasang`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					VALUES ('','$kode_jawab_spk', '$kode_spk', '$tanggal', '$id_customer',
					'$nama_customer', '$id_cabang', '$id_linkbudget', '$paket_koneksi', '$nama_koneksi', '$user_id', '$telpon',
					'$alamat', '$id_marketing', '$id_teknisi', '$id_teknisi2', '$id_teknisi3', '$id_teknisi4', '$id_teknisi5', '$pekerjaan',
					'$status', '$solusi', '$alat_terpasang', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0')";
                mysql_query($insert_spk_aktivasi_baru, $conn) or die ("<script language='JavaScript'>
                                                                          alert('Maaf Data tidak bisa diinput ke dalam Database, Ada kesalahan!');
                                                                          window.history.go(-1);
                                                                       </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_spk_aktivasi_baru");

                if ($id_linkbudget != "") {
                    $sql_linkbudget = mysql_query("SELECT * FROM `gx_link_budget_detail` WHERE `no_linkbudget` = '" . $id_linkbudget . "';", $conn);

                    while ($row_linkbudget = mysql_fetch_array($sql_linkbudget)) {
                        $sql_alat = "INSERT INTO `gx_alat_pasang` (`id_alat_pasang`, `no_linkbudget`, `kode_spk_aktivasi`, `kode_barang`,
                            `nama_barang`, `qty`, `price`, `serial_number`,
                            `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                            VALUES (NULL,  '" . $id_linkbudget . "', '" . $kode_jawab_spk . "', '" . $row_linkbudget["kode_barang"] . "',
                            '" . $row_linkbudget["nama_barang"] . "', '" . $row_linkbudget["qty"] . "', '" . $row_linkbudget["price"] . "',
                            '" . $row_linkbudget["serial_number"] . "', '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(),'0');";
                        mysql_query($sql_alat, $conn);
                    }
                }

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan!');
                        location.href = 'update_alat?id=" . $id_linkbudget . "&aktivasi=" . $kode_jawab_spk . "';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data Customer sudah ada.');
                        window.history.go(-1);
                      </script>";
            }
        } elseif ($update == "Save") {

            $kode_jawab_spk = isset($_POST["kode_jawab_spkaktivasi"]) ? mysql_real_escape_string(trim($_POST["kode_jawab_spkaktivasi"])) : '';
            $kode_spk = isset($_POST["kode_spk"]) ? mysql_real_escape_string(trim($_POST["kode_spk"])) : "";
            $tanggal = isset($_POST["tanggal"]) ? mysql_real_escape_string(trim($_POST["tanggal"])) : "";
            $id_customer = isset($_POST["kode_customer"]) ? mysql_real_escape_string(trim($_POST["kode_customer"])) : "";
            $nama_customer = isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim($_POST["nama_customer"])) : "";
            $id_cabang = isset($_POST["id_cabang"]) ? mysql_real_escape_string(trim($_POST["id_cabang"])) : "";
            $id_linkbudget = isset($_POST["no_link_budget"]) ? mysql_real_escape_string(trim($_POST["no_link_budget"])) : "";
            $paket_koneksi = isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim($_POST["paket_koneksi"])) : "";
            $nama_koneksi = isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim($_POST["nama_koneksi"])) : "";
            $user_id = isset($_POST["user_id"]) ? mysql_real_escape_string(trim($_POST["user_id"])) : "";
            $telpon = isset($_POST["telpon"]) ? mysql_real_escape_string(trim($_POST["telpon"])) : "";
            $alamat = isset($_POST["alamat"]) ? mysql_real_escape_string(trim($_POST["alamat"])) : "";
            $id_marketing = isset($_POST["id_employee"]) ? mysql_real_escape_string(trim($_POST["id_employee"])) : "";
            $id_teknisi = isset($_POST["id_teknisi"]) ? mysql_real_escape_string(trim($_POST["id_teknisi"])) : "";
            $id_teknisi2 = isset($_POST["id_teknisi2"]) ? mysql_real_escape_string(trim($_POST["id_teknisi2"])) : '';
            $id_teknisi3 = isset($_POST["id_teknisi3"]) ? mysql_real_escape_string(trim($_POST["id_teknisi3"])) : '';
            $id_teknisi4 = isset($_POST["id_teknisi4"]) ? mysql_real_escape_string(trim($_POST["id_teknisi4"])) : '';
            $id_teknisi5 = isset($_POST["id_teknisi5"]) ? mysql_real_escape_string(trim($_POST["id_teknisi5"])) : '';
            $pekerjaan = isset($_POST["pekerjaan"]) ? mysql_real_escape_string(trim($_POST["pekerjaan"])) : '';
            $status = isset($_POST["status"]) ? mysql_real_escape_string(trim($_POST["status"])) : '';
            $solusi = isset($_POST["solusi"]) ? trim($_POST["solusi"]) : '';
            $alat_terpasang = isset($_POST["alat_terpasang"]) ? trim($_POST["alat_terpasang"]) : '';


            $insert_spk_aktivasi_baru = "UPDATE `gx_jawab_spkaktivasi` SET `kode_jawab_aktivasi`='$kode_jawab_spk',`kode_spkaktivasi`='$kode_spk',`tanggal`='$tanggal',`id_customer`='$id_customer',`nama_customer`='$nama_customer',
                `id_cabang`='$id_cabang',`id_linkbudget`='$id_linkbudget',`paket_koneksi`='$paket_koneksi',`nama_koneksi`='$nama_koneksi',`user_id`='$user_id',`telpon`='$telpon',`alamat`='$alamat',
                `id_marketing`='$id_marketing',`id_teknisi`='$id_teknisi',`id_teknisi2`='$id_teknisi2',`id_teknisi3`='$id_teknisi3',`id_teknisi4`='$id_teknisi4',`id_teknisi5`='$id_teknisi5',`pekerjaan`='$pekerjaan',`status`='$status',
                `solusi`='$solusi',`alat_terpasang`='$alat_terpasang',`user_upd`='$loggedin[username]',`date_upd`=NOW(),`level`='0' WHERE `id_jawab_spkaktivasi`='$_GET[id]'";
            mysql_query($insert_spk_aktivasi_baru, $conn) or die ("<script language='JavaScript'>
                                                                       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                                       window.history.go(-1);
                                                                   </script>");

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_spk_aktivasi_baru");

            echo "<script language='JavaScript'>
                    alert('Data telah disimpan!');
                    location.href = 'master_jawab_spk_aktivasi_baru.php';
                  </script>";
        }

        $plugins = '';

        $title = 'Form SPK Aktivasi Baru';
        $submenu = "master_form_spk_Aktivasi_baru";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>