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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form pasang baru"); // for create log in newfunction2.php

        global $conn;

        if (isset($_GET['id_spk_pasang_baru'])) {
            // mengambil nilai yang ada pada url
            $get_id = isset($_GET['id_spk_pasang_baru']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_spk_pasang_baru']))) : "";
            $data_spk_pasang_baru = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_spkpasang` = '$get_id';", $conn));
        }

        $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' LIMIT 1;", $conn);
        $row_cabang = mysql_fetch_array($sql_cabang);

        $sql_spkpasang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_spk_pasang` ORDER BY `id_spkpasang` DESC", $conn));
        $last_data = $sql_spkpasang["id_spkpasang"] + 1;
        $tanggal = date("d");
        $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_spk_pasang"] . '' . $tanggal . '' . sprintf("%04d", $last_data);

        $content = '
		    <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body table-responsive">
                                <form action="" role="form" name="myForm"  method="POST" >
                                    <input type="hidden" readonly="" class="form-control" name="id_cabang" value="' . $loggedin['cabang'] . '">
                                    <input type="hidden" readonly="" class="form-control" name="namecabang" value="' . $row_cabang['nama_cabang'] . '">
                                    <input type="hidden" style="" name="id_spk_pasang_baru" value="' . (isset($_GET['id_spk_pasang_baru']) ? $_GET['id_spk_pasang_baru'] : "") . '" />
                                    <div >
                                        <fieldset>
                                            <legend>Data SPK Pasang Baru</legend>
                                            <div class="table-container table-form">
                                                <div class="box-body">
					                                <div class="form-group">
					                                    <div class="row">
					                                        <div class="col-xs-2">
                                                                <label>No. SPK Pasang Baru</label>
                                                            </div>
					                                        <div class="col-xs-4">
                                                                <input type="text" readonly="" class="form-control" style="" name="kode_spk" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['kode_spk'] : $kode_cabang) . '" />
                                                            </div>
					                                        <div class="col-xs-2">
                                                                <label>Tanggal</label>
                                                            </div>
					                                        <div class="col-xs-4">
                                                                <input class="form-control required" readonly="" name="tanggal" id="tanggal" placeholder="Tanggal" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['tanggal'] : date("Y-m-d")) . '" >
                                                            </div>
                                                        </div>
					                                </div>
					                                
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>Kode Customer</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="kode_customer" readonly="" id="kode_customer" placeholder="Kode Customer" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_customer'] : "") . '"
                                                                onclick="return valideopenerform(\'data_customer_spk_pasang.php?r=myForm\',\'cust\');">
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <label>Nama Customer</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" readonly="" name="nama_customer" placeholder="Nama Customer" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_customer'] : "") . '">
                                                                <input type="hidden" name="nama_perusahaan">
                                                                <input type="hidden" name="kota">
                                                                <input type="hidden" name="notelp">
                                                                <input type="hidden" name="hp1">
                                                                <input type="hidden" name="hp2">
                                                                <input type="hidden" name="contact">
                                                                <input type="hidden" name="email">
                                                                <input type="hidden" name="nama_cabang" readonly="" class="form-control"  value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_cabang'] : "") . '" placeholder="Nama Cabang">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>No. Link Budget</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="id_linkbudget" readonly="" placeholder="No Link Budget" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_linkbudget'] : "") . '"
                                                                onclick="return valideopenerform(\'data_linkbudget.php?r=myForm\',\'cust\');">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>Paket Koneksi</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="paket_koneksi"  readonly="" placeholder="Paket Koneksi" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['paket_koneksi'] : "") . '" >
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <label>Nama Koneksi</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="nama_koneksi"  readonly=""  placeholder="Nama Koneksi" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_koneksi'] : "") . '" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>User ID</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="user_id" readonly="" placeholder="User ID" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['user_id'] : "") . '">
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <label>Telpon</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" readonly="" name="telpon" placeholder="Telepon" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['telpon'] : "") . '">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>Alamat</label>
                                                            </div>
                                                            <div class="col-xs-10">
                                                                <input class="form-control" readonly="" name="alamat" placeholder="alamat" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['alamat'] : "") . '">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>Teknisi</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="id_teknisi" type="hidden" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_teknisi'] : "") . '">
                                                                <input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_teknisi'] : "") . '"
                                                                onclick="return valideopenerform(\'data_teknisi.php?r=myForm\',\'teknisi\');">
                                                            </div>
                                                            <div class="col-xs-2">
                                                                <label>Marketing</label>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <input class="form-control" name="id_employee" type="hidden" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['id_marketing'] : "") . '">
                                                                <input class="form-control" readonly="" name="nama_marketing" placeholder="Nama Marketing" type="text" value="' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['nama_marketing'] : "") . '"
                                                                onclick="return valideopenerform(\'data_marketing.php?r=myForm\',\'marketing\');">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2">
                                                                <label>Pekerjaan</label>
                                                            </div>
                                                            <div  class="col-xs-10">
                                                                <textarea name="pekerjaan" class="form-control" readonly="" placeholder="Pekerjaan" style="resize: none;">' . (isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['pekerjaan'] : "PASANG BARU") . '</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
					
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <label>Created By</label>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                ' . (isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru["user_add"] : $loggedin["username"]) . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <label>Latest Update By </label>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                ' . (isset($_GET['id_spk_pasang_baru']) ? $data_spk_pasang_baru["user_upd"] . " " . $data_spk_pasang_baru["date_upd"] : "") . '
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-xs-2"></div>
                                                            <div class="col-xs-4">
                                                                <input type="submit" class="btn btn-primary" data-icon="v" name="' . (isset($_GET["id_spk_pasang_baru"]) ? "update" : "save") . '" value="Save">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br />
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

            $kode_spk = isset($_POST["kode_spk"]) ? mysql_real_escape_string(trim(strip_tags($_POST["kode_spk"]))) : "";
            $tanggal = isset($_POST["tanggal"]) ? mysql_real_escape_string(trim(strip_tags($_POST["tanggal"]))) : "";
            $id_customer = isset($_POST["kode_customer"]) ? mysql_real_escape_string(trim(strip_tags($_POST["kode_customer"]))) : "";
            $nama_customer = isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_customer"]))) : "";
            $id_cabang = $loggedin['cabang'];
            $nama_cabang = isset($_POST["namecabang"]) ? mysql_real_escape_string(trim(strip_tags($_POST["namecabang"]))) : "";
            $id_linkbudget = isset($_POST["id_linkbudget"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_linkbudget"]))) : "";
            $paket_koneksi = isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["paket_koneksi"]))) : "";
            $nama_koneksi = isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_koneksi"]))) : "";
            $user_id = isset($_POST["user_id"]) ? mysql_real_escape_string(trim(strip_tags($_POST["user_id"]))) : "";
            $telpon = isset($_POST["telpon"]) ? mysql_real_escape_string(trim(strip_tags($_POST["telpon"]))) : "";
            $alamat = isset($_POST["alamat"]) ? mysql_real_escape_string(trim(strip_tags($_POST["alamat"]))) : "";
            $id_marketing = isset($_POST["id_employee"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_employee"]))) : "";
            $nama_marketing = isset($_POST["nama_marketing"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_marketing"]))) : "";
            $id_teknisi = isset($_POST["id_teknisi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_teknisi"]))) : "";
            $nama_teknisi = isset($_POST["nama_teknisi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_teknisi"]))) : "";
            $pekerjaan = isset($_POST["pekerjaan"]) ? mysql_real_escape_string(trim(strip_tags($_POST["pekerjaan"]))) : "";

            if ($id_linkbudget == "") {
                echo "<script language='JavaScript'>
                         alert('Data Linkbudget masih kosong');
                         location.href = 'form_spk_pasang_baru.php';
                      </script>";
            }

            if ($kode_spk != "" AND $id_linkbudget != "" AND $nama_marketing != "" AND $id_teknisi != "") {

                $insert_spk_pasang_baru = "INSERT INTO `gx_spk_pasang` (`id_spkpasang`, `kode_spk`,
                    `tanggal`, `id_customer`, `nama_customer`, `id_cabang`, `nama_cabang`, `id_linkbudget`, `paket_koneksi`,
                    `nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `nama_marketing`, `id_teknisi`,
                    `nama_teknisi`, `pekerjaan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
                    VALUES (NULL, '$kode_spk', '$tanggal', '$id_customer',
                    '$nama_customer', '$id_cabang', '$nama_cabang',
                    '$id_linkbudget', '$paket_koneksi', '$nama_koneksi',
                    '$user_id', '$telpon', '$alamat', '$id_marketing', '$nama_marketing',
                    '$id_teknisi', '$nama_teknisi', '$pekerjaan',
                    NOW(), NOW(),'$loggedin[username]', '$loggedin[username]', '0')";
                mysql_query($insert_spk_pasang_baru, $conn) or die ("<script language='JavaScript'>
                                                                        alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                                        window.history.go(-1);
                                                                      </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_spk_pasang_baru");

                //buat invoice setup fee tgl 20 januari 2017
                $sql_paket = mysql_query("SELECT * FROM `gx_paket2` WHERE `kode_paket` = '" . $paket_koneksi . "' AND `level` = '0' LIMIT 0,1;", $conn);
                $row_paket = mysql_fetch_array($sql_paket);

                $sql_cust = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '" . $id_customer . "' AND `level` = '0' LIMIT 0,1;", $conn);
                $row_cust = mysql_fetch_array($sql_cust);

                $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '1' AND `level` = '0' ORDER BY `id_cabang` ASC LIMIT 0,1;", $conn);
                $row_cabang = mysql_fetch_array($sql_cabang);

                $sql_invoice = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
                $last_data = $sql_invoice["id_invoice"] + 1;
                $tanggal = date("d");
                $kode_invoice = $row_cabang["kode_cabang"] . '-' . $row_cabang["invoice_code"] . '' . $tanggal . '' . sprintf("%04d", $last_data);
                //insert into invoice
                $ppn = (10 / 100) * $row_paket["setup_fee"];
                $grandtotal = $row_paket["setup_fee"] + $ppn;

                //RBS
                //BillingTransactions
                $sql_rbs_lastdata = "SELECT TOP 1 [dbo].[BillingTransactions].[BillingTransactionIndex] FROM [dbo].[BillingTransactions] ORDER BY [dbo].[BillingTransactions].[BillingTransactionIndex] DESC;";
                $query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
                $query_rbs_lastdata->execute();
                $row_rbs_lastdata = $query_rbs_lastdata->fetch();

                $BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;

                //Bills
                $sql_bill_lastdata = "SELECT TOP 1 [dbo].[Bills].[BillIndex] FROM [dbo].[Bills] ORDER BY [dbo].[Bills].[BillIndex] DESC;";
                $query_bill_lastdata = $conn_soft->prepare($sql_bill_lastdata);
                $query_bill_lastdata->execute();
                $row_bill_lastdata = $query_bill_lastdata->fetch();

                $BillIndex = $row_bill_lastdata["BillIndex"] + 1;

                //BillSection
                $sql_billsection_lastdata = "SELECT TOP 1 [dbo].[BillsSections].[BillSectionIndex] FROM [dbo].[BillsSections] ORDER BY [dbo].[BillsSections].[BillSectionIndex] DESC;";
                $query_billsection_lastdata = $conn_soft->prepare($sql_billsection_lastdata);
                $query_billsection_lastdata->execute();
                $row_billsection_lastdata = $query_billsection_lastdata->fetch();

                $BillSectionIndex = $row_billsection_lastdata["BillSectionIndex"] + 1;

                $sql_rbs_lastdata_user = "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
                    WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
                    AND [dbo].[Users].[UserActive] = '1'
                    AND [dbo].[Users].[UserIndex] = '" . $row_cust["iuserIndex"] . "';";
                $query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
                $query_rbs_lastdata_user->execute();
                $row_rbs_lastdata_user = $query_rbs_lastdata_user->fetch();

                $UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
                $AccountName = $row_rbs_lastdata_user["AccountName"];

                $uangmuka = (($row_cust["gx_saldo"] > 1) ? $row_cust["gx_saldo"] : 0);
                $paid_status = ($uangmuka >= $grandtotal) ? 1 : 0;


                $sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `id_cabang`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
					`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
					`no_virtual_account_bca`, `nama_virtual`, `prepared_by`,
					`total`, `ppn`, `grandtotal`, `reference`,
					`uangmuka`, `paid_status`, `posting`, `status`,
					`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					VALUES ('', '" . $id_cabang . "', '" . $kode_invoice . "', 'SETUP FEE', '" . $id_customer . "', '" . $nama_customer . "',
			        '" . $row_cust["no_npwp"] . "', '', 'Invoice setup fee (spk pasang)', '', '" . date("Y-m-d") . "', '" . date("Y-m-d", strtotime("+3 days")) . "',
					'" . $row_cust["cNoRekVirtual"] . "', '', '" . $loggedin["username"] . "',
					'" . $row_paket['setup_fee'] . "', '" . $ppn . "', '" . $grandtotal . "', '" . $BillIndex . "',
					'" . $uangmuka . "', '" . $paid_status . "', '1', '1',
					NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";

                $sql_insert_invoice_detail = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
					`harga`, `desc`, `date_add`,
					`date_upd`, `user_add`, `user_upd`, `level`)
				    VALUES ('', '" . $kode_invoice . "', '" . date("Y-m-d") . "',
					'" . $row_paket['setup_fee'] . "', 'Invoice setup fee (spk pasang)', NOW(),
					NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($sql_insert_invoice_detail, $conn) or die ("<script language='JavaScript'>
                                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                           window.history.go(-1);
                                                                        </script>");

                mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
                                                                    alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                    window.history.go(-1);
                                                                 </script>");

                //end of invoice
                if ($row_paket["setup_fee"] != "0") {
                    $ppn_rbs = (10 / 100) * $row_paket["setup_fee"];
                    $grandtotal_rbs = (int)$row_paket["setup_fee"] + $ppn_rbs;
                    $tgl_tagihan = date("Y-m-d");
                    $gx_saldo = $row_cust["gx_saldo"] - ($grandtotal_rbs);

                    $sql_update_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '" . $gx_saldo . "',
                        `user_upd` = '" . $loggedin["username"] . "', `date_upd` = NOW()
                        WHERE (`idCustomer` = '" . $row_cust["idCustomer"] . "');";
                    mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");

                    $sql = "
                        SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
                        INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
                        VALUES ('" . $BillingTransactionIndex . "', '" . date("Y-m-d H:i:s.000") . "', '1', '" . $row_cust["iuserIndex"] . "', '1', '" . $BillIndex . "', '-" . $grandtotal_rbs . "');
                        SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
                    $q = $conn_soft->prepare($sql);
                    $q->execute();

                    enableLog("", '".$loggedin["username"]."', '".$loggedin["username"]."', $sql);

                    $UserPaymentBalance_update = $UserPaymentBalance - ($grandtotal_rbs);
                    $nterm = (int)$row_cust["nterm"];
                    $tambahan_grace = ($nterm == "0") ? "2" : $nterm;

                    $sql_rbs_user_detail = "
						SET IDENTITY_INSERT [dbo].[Bills] ON
						INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
						VALUES ('" . $BillIndex . "', '1', '" . $row_cust["iuserIndex"] . "', '" . date("Y-m-01 00:00:00.000", strtotime($tgl_tagihan)) . "', '" . date("Y-m-t 23:59:59.000", strtotime($tgl_tagihan)) . "', '" . date("Y-m-d H:i:s.000") . "', '0', '0', '0', '0', '0');
						SET IDENTITY_INSERT [dbo].[Bills] OFF
						
						INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
						VALUES ('" . $BillIndex . "', '" . $BillSectionIndex . "', '1', '" . $grandtotal_rbs . "', '0', '0', '0', 'Activation For Dates " . date("d/m/Y", strtotime($tgl_tagihan)) . " - " . date("t/m/Y", strtotime($tgl_tagihan)) . " (" . $AccountName . ").');
						
						UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='" . $UserPaymentBalance_update . "'
						WHERE ([UserIndex]='" . $row_cust["iuserIndex"] . "');";
                    $query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
                    $query_rbs_user_detail->execute();

                    enableLog("", $loggedin["username"], $loggedin["username"], $sql_rbs_user_detail);
                }

                //END RBS
                echo "<script language='JavaScript'>
                         alert('Data telah disimpan!');
                         location.href = 'master_spk_pasang_baru.php';
                     </script>";
            } else {
                echo "<script language='JavaScript'>
                          alert('Maaf Data yg dimasukkan ada yg kurang..');
                          window.history.go(-1);
                      </script>";
            }
        }

        elseif ($update == "Save") {

            $id_spkpasang = isset($_POST["id_spk_pasang_baru"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_spk_pasang_baru"]))) : "";
            $kode_spk = isset($_POST["kode_spk"]) ? mysql_real_escape_string(trim(strip_tags($_POST["kode_spk"]))) : "";
            $tanggal = isset($_POST["tanggal"]) ? mysql_real_escape_string(trim(strip_tags($_POST["tanggal"]))) : "";
            $id_customer = isset($_POST["kode_customer"]) ? mysql_real_escape_string(trim(strip_tags($_POST["kode_customer"]))) : "";
            $nama_customer = isset($_POST["nama_customer"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_customer"]))) : "";
            $id_cabang = $loggedin['cabang'];
            $nama_cabang = isset($_POST["namecabang"]) ? mysql_real_escape_string(trim(strip_tags($_POST["namecabang"]))) : "";
            $id_linkbudget = isset($_POST["id_linkbudget"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_linkbudget"]))) : "";
            $paket_koneksi = isset($_POST["paket_koneksi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["paket_koneksi"]))) : "";
            $nama_koneksi = isset($_POST["nama_koneksi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_koneksi"]))) : "";
            $user_id = isset($_POST["user_id"]) ? mysql_real_escape_string(trim(strip_tags($_POST["user_id"]))) : "";
            $telpon = isset($_POST["telpon"]) ? mysql_real_escape_string(trim(strip_tags($_POST["telpon"]))) : "";
            $alamat = isset($_POST["alamat"]) ? mysql_real_escape_string(trim(strip_tags($_POST["alamat"]))) : "";
            $id_marketing = isset($_POST["id_employee"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_employee"]))) : "";
            $nama_marketing = isset($_POST["nama_marketing"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_marketing"]))) : "";
            $id_teknisi = isset($_POST["id_teknisi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["id_teknisi"]))) : "";
            $nama_teknisi = isset($_POST["nama_teknisi"]) ? mysql_real_escape_string(trim(strip_tags($_POST["nama_teknisi"]))) : "";
            $pekerjaan = isset($_POST["pekerjaan"]) ? mysql_real_escape_string(trim(strip_tags($_POST["pekerjaan"]))) : "";

            if ($id_spkpasang != "" AND $kode_spk != "") {

                $insert_spk_pasang_baru = "UPDATE `gx_spk_pasang` SET `kode_spk`='$kode_spk',
                    `id_customer`='$id_customer',`nama_customer`='$nama_customer',`id_cabang`='$id_cabang',`nama_cabang`='$nama_cabang',`id_linkbudget`='$id_linkbudget',
                    `paket_koneksi`='$paket_koneksi',`nama_koneksi`='$nama_koneksi',`user_id`='$user_id',`telpon`='$telpon',`alamat`='$alamat',`id_marketing`='$id_marketing',
                    `nama_marketing`='$nama_marketing',`id_teknisi`='$id_teknisi',`nama_teknisi`='$nama_teknisi',`pekerjaan`='$pekerjaan',
                    `user_upd`='$loggedin[username]',`date_upd`=NOW(),`level`='0' WHERE `id_spkpasang`='$id_spkpasang'";
                mysql_query($insert_spk_pasang_baru, $conn) or die ("<script language='JavaScript'>
                                                                       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                                       window.history.go(-1);
                                                                     </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_spk_pasang_baru");

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan!');
                        location.href = 'master_spk_pasang_baru.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        $plugins = '';

        $title = 'Form SPK Pasang Baru';
        $submenu = "master_form_spk_pasang_baru";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>