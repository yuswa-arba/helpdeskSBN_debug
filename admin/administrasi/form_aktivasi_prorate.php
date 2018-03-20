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
//		$conn_soft = Config::getInstanceSoft();

        if (isset($_POST["save"])) {

            $kode_aktivasi = isset($_POST['kode_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi'])) : '';
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
            $id_customer = isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $id_cabang = isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
            $id_linkbudget = isset($_POST['id_linkbudget']) ? mysql_real_escape_string(trim($_POST['id_linkbudget'])) : '';
            $paket_koneksi = isset($_POST['paket_koneksi']) ? mysql_real_escape_string(trim($_POST['paket_koneksi'])) : '';
            $nama_koneksi = isset($_POST['nama_koneksi']) ? mysql_real_escape_string(trim($_POST['nama_koneksi'])) : '';
            $user_id = isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
            $telpon = isset($_POST['telpon']) ? mysql_real_escape_string(trim($_POST['telpon'])) : '';
            $alamat = isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
            $id_teknisi = isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
            $id_employee = isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
            $ip_customer = isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';

            $monthly = isset($_POST['acc_monthly']) ? str_replace(",", "", $_POST['acc_monthly']) : '0';
            $daily = isset($_POST['acc_daily']) ? str_replace(",", "", $_POST['acc_daily']) : '0';
            $hari_aktivasi = isset($_POST['acc_hari_aktivasi']) ? mysql_real_escape_string(trim($_POST['acc_hari_aktivasi'])) : '0';
            $total = isset($_POST['acc_total']) ? str_replace(",", "", $_POST['acc_total']) : '0';
            $ppn = isset($_POST['acc_ppn']) ? str_replace(",", "", $_POST['acc_ppn']) : '0';
            $totalppn = isset($_POST['acc_totalppn']) ? str_replace(",", "", $_POST['acc_totalppn']) : '0';
            $acc_admin = isset($_POST['acc_admin']) ? mysql_real_escape_string(trim($_POST['acc_admin'])) : '';

            $acc_monthly = ($monthly == "0") ? str_replace(",", "", $_POST['monthly']) : $monthly;
            $acc_daily = ($daily == "0") ? str_replace(",", "", $_POST['daily']) : $daily;
            $acc_hari_aktivasi = ($hari_aktivasi == "0") ? mysql_real_escape_string(trim($_POST['hari_aktivasi'])) : $hari_aktivasi;
            $acc_total = ($total == "0") ? str_replace(",", "", $_POST['total']) : $total;
            $acc_ppn = ($ppn == "0") ? str_replace(",", "", $_POST['ppn']) : $ppn;
            $acc_totalppn = ($totalppn == "0") ? str_replace(",", "", $_POST['totalppn']) : $totalppn;

            if ($kode_aktivasi != "" AND $id_linkbudget != "") {
                //insert data aktivasi
                $sql_insert = "INSERT INTO `gx_aktivasi` (`id_aktivasi`, `kode_aktivasi`, `tanggal`,
					`id_customer`, `nama_customer`, `id_cabang`, `id_linkbudget`, `paket_koneksi`,
					`nama_koneksi`, `user_id`, `telpon`, `alamat`, `id_marketing`, `id_teknisi`, `ip_customer`,
					`acc_monthly`, `acc_admin`, `acc_daily`, `acc_hari_aktivasi`,
					`acc_total`, `acc_ppn`, `acc_totalppn`,
					`date_add`, `date_upd`, `user_add`, `user_upd`, `level`) 
					VALUES ('', '" . $kode_aktivasi . "', '" . $tanggal . "',
					'" . $id_customer . "', '" . $nama_customer . "', '" . $id_cabang . "', '" . $id_linkbudget . "', '" . $paket_koneksi . "',
					'" . $nama_koneksi . "', '" . $user_id . "', '" . $telpon . "', '" . $alamat . "', '" . $id_employee . "', '" . $id_teknisi . "', '" . $ip_customer . "',
					'" . $acc_monthly . "', '" . $acc_admin . "', '" . $acc_daily . "', '" . $acc_hari_aktivasi . "',
					'" . $acc_total . "', '" . $acc_ppn . "', '" . $acc_totalppn . "', 
					NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan aktivasi!');
                                                           window.history.go(-1);
                                                         </script>");

                $sql_update = "UPDATE `tbCustomer` SET `cNonAktiv` = '0' WHERE `cKode` = '" . $id_customer . "';";
                mysql_query($sql_update, $conn);

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                //invoice
                $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' AND `id_cabang` = '" . $id_cabang . "' LIMIT 0,1;", $conn);
                $row_cabang = mysql_fetch_array($sql_cabang);

                $sql_customer = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '" . $id_customer . "' LIMIT 0,1;", $conn);
                $row_customer = mysql_fetch_array($sql_customer);

                $sql_paket = mysql_query("SELECT * FROM `gx_paket2` WHERE `kode_paket` = '" . $paket_koneksi . "' LIMIT 0,1;", $conn);
                $row_paket = mysql_fetch_array($sql_paket);

                $sql_invoice = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
                $last_data = $sql_invoice["id_invoice"] + 1;
                $tanggal = date("d");
                $kode_invoice = $row_cabang["kode_cabang"] . '-' . $row_cabang["invoice_code"] . '' . $tanggal . '' . sprintf("%04d", $last_data);

                //RBS
                $sql_rbs_lastdata = "SELECT TOP 1 [dbo].[BillingTransactions].[BillingTransactionIndex] FROM [dbo].[BillingTransactions] ORDER BY [dbo].[BillingTransactions].[BillingTransactionIndex] DESC;";
                $query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
                $query_rbs_lastdata->execute();
                $row_rbs_lastdata = $query_rbs_lastdata->fetch();

                $BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;

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
                    AND [dbo].[Users].[UserIndex] = '" . $row_customer["iuserIndex"] . "';";
                $query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
                $query_rbs_lastdata_user->execute();
                $row_rbs_lastdata_user = $query_rbs_lastdata_user->fetch();

                $UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
                $AccountName = $row_rbs_lastdata_user["AccountName"];
                $tgl_tagihan = date("Y-m-d");
                //END RBS

                //START GENERATE INPUT INVOICE RBS
                if ($acc_total != "0") {
                    $sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
                        INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
                        VALUES ('" . $BillingTransactionIndex . "', '" . date("Y-m-d H:i:s.000") . "', '1', '" . $row_customer["iuserIndex"] . "', '1', '" . $BillIndex . "', '-" . $acc_totalppn . "');
                        SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
                    $q = $conn_soft->prepare($sql);
                    $q->execute();
                    enableLog("", "auto", "auto", $sql);

                    $UserPaymentBalance_update = $UserPaymentBalance - $acc_totalppn;
                    $nterm = (int)$row_customer["nterm"];
                    $tambahan_grace = ($nterm == "0") ? "2" : $nterm;
                    $tgl_expirydate = ((date("d") < 26) ? date("Y-m-d", strtotime($tgl_tagihan . "+1 month")) : date("Y-m-d", strtotime($tgl_tagihan . "+2 month")));

                    $sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
                        INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
                        VALUES ('" . $BillIndex . "', '1', '" . $row_customer["iuserIndex"] . "', '" . date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan)) . "', '" . date("Y-m-d 23:59:59.000", strtotime($tgl_tagihan)) . "', '" . date("Y-m-d H:i:s.000") . "', '0', '0', '0', '0', '0');
                        SET IDENTITY_INSERT [dbo].[Bills] OFF
			            INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
                        VALUES ('" . $BillIndex . "', '" . $BillSectionIndex . "', '1', '" . $acc_totalppn . "', '0', '0', '0', 'Activation For Dates " . date("d/m/Y", strtotime($tgl_tagihan)) . " - " . date("d/m/Y", strtotime($tgl_tagihan)) . " (" . $AccountName . ").');
			            UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='" . $UserPaymentBalance_update . "', [GracePeriodExpiration] = '" . date("Y-m-d 00:00:00.000", strtotime($tgl_tagihan . "+$tambahan_grace days")) . "',
                        [UserExpiryDate] = '" . date("Y-m-01 00:00:00.000", strtotime($tgl_expirydate)) . "'
                        WHERE ([UserIndex]='" . $row_customer["iuserIndex"] . "');";
                    $query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
                    $query_rbs_user_detail->execute();

                    enableLog("", "auto", "auto", $sql_rbs_user_detail);

                    //END GENERATE RBS
                    $uangmuka = (($row_customer["gx_saldo"] > 1) ? $row_customer["gx_saldo"] : 0);
                    $paid_status = ($uangmuka >= $acc_totalppn) ? 1 : 0;

                    //insert data invoice
                    $sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `id_cabang`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
						`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
						`uangmuka`, `total`, `ppn`, `grandtotal`, `posting`, `paid_status`, `status`, `reference`,
						`no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `date_add`, `date_upd`,
						`user_add`, `user_upd`, `level`)
						VALUES ('', '" . $id_cabang . "', '" . $kode_aktivasi . "', '" . $kode_invoice . "', 'AKTIVASI BARU', '" . $id_customer . "', '" . $nama_customer . "',
						'" . $row_customer["no_npwp"] . "', '', 'AKTIVASI BARU', '', '" . date("Y-m-d") . "', '" . date("Y-m-d", strtotime("+3 days")) . "',
						'" . $uangmuka . "', '" . $acc_total . "', '" . $acc_ppn . "', '" . $acc_totalppn . "', '1', '" . $paid_status . "', '1', '" . $BillIndex . "',
						'" . $row_customer["cNoRekVirtual"] . "', '" . $row_customer["cNama"] . "', '" . $loggedin["username"] . "', NOW(), NOW(),
						'" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                    mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
								   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
								   window.history.go(-1);
								   </script>");

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_invoice);

                    //detiail invoice
                    $sql_insert_detail = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
						`harga`, `desc`, `date_add`,
						`date_upd`, `user_add`, `user_upd`, `level`)
						VALUES ('', '" . $kode_invoice . "', '" . date("Y-m-d H:i:s") . "',
						'" . $acc_total . "', 'AKTIVASI BARU', NOW(),
						NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                    mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
									   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
									   window.history.go(-1);
									   </script>");

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_detail);

                    $gx_saldo = $row_customer["gx_saldo"] - ($acc_totalppn);
                    $sql_update_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '" . $gx_saldo . "',
                        `user_upd` = 'auto_generate', `date_upd` = NOW()
                        WHERE (`idCustomer` = '" . $row_customer["idCustomer"] . "');";
                    mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");

                    enableLog("", "auto", "auto", "Update GX Saldo (tbCustomer)", $sql_update_saldo);
                }

                // INVOICE BULANAN
                $tanggal_invoice = strtotime(date("Y-m-d H:i:s"));
                $tanggal_generate = strtotime(date("Y-m-26 02:00:00"));
                $tanggal_akhirbulan = strtotime(date("Y-m-t 23:59:00"));

                if (($tanggal_invoice >= $tanggal_generate) AND ($tanggal_invoice <= $tanggal_akhirbulan)) {
                    // INVOICE BULANAN
                    //RBS
                    $sql_rbs_lastdata = "SELECT TOP 1 [dbo].[BillingTransactions].[BillingTransactionIndex] FROM [dbo].[BillingTransactions] ORDER BY [dbo].[BillingTransactions].[BillingTransactionIndex] DESC;";
                    $query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
                    $query_rbs_lastdata->execute();
                    $row_rbs_lastdata = $query_rbs_lastdata->fetch();

                    $BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;

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
                        AND [dbo].[Users].[UserIndex] = '" . $row_customer["iuserIndex"] . "';";
                    $query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
                    $query_rbs_lastdata_user->execute();
                    $row_rbs_lastdata_user = $query_rbs_lastdata_user->fetch();

                    $UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
                    $AccountName = $row_rbs_lastdata_user["AccountName"];
                    //RBS

                    $tgl_tagihan = date("Y-m-d");
                    $bln_tagihan = date("Y-m-d", strtotime("+1 month"));

                    $sql_invoice = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
                    $last_data = $sql_invoice["id_invoice"] + 1;
                    $tanggal = date("d");
                    $kode_invoice = $row_cabang["kode_cabang"] . '-' . $row_cabang["invoice_code"] . '' . $tanggal . '' . sprintf("%04d", $last_data);


                    $sql_customer = mysql_query("SELECT * FROM `v_customer_aktivasi`
						WHERE `cKode` = '" . $id_customer . "' AND `level` = '0' LIMIT 0,1;", $conn);
                    $row_customer = mysql_fetch_array($sql_customer);

                    $total_invoice = $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
                    $ppn = (10 / 100) * $total_invoice;
                    $monthly_fee = $total_invoice + $ppn;
                    $uangmuka = (($row_customer["gx_saldo"] > 1) ? $row_customer["gx_saldo"] : 0);
                    $paid_status = ($uangmuka >= $monthly_fee) ? 1 : 0;

                    $sql_insert_invoice = "INSERT INTO `gx_invoice`(`id_invoice`, `id_cabang`, `kode_aktivasi`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
						`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
						`no_virtual_account_bca`, `nama_virtual`, `reference`,  `status`,
						`uangmuka`, `total`, `ppn`, `grandtotal`,
						`paid_status`, `posting`,
						`prepared_by`, `date_add`, `date_upd`,
						`user_add`, `user_upd`, `level`)
						VALUES (NULL, '" . $row_customer["id_cabang"] . "', '', '" . $kode_invoice . "', 'INVOICE " . NamaBulan(date("n", strtotime($bln_tagihan))) . " " . date("Y", strtotime($bln_tagihan)) . "', '" . $row_customer["cKode"] . "', '" . $row_customer["cNama"] . "',
						'" . $row_customer["no_npwp"] . "', '', 'INVOICE " . NamaBulan(date("n", strtotime($bln_tagihan))) . " " . date("Y", strtotime($bln_tagihan)) . "',
						'" . NamaBulan(date("n", strtotime($bln_tagihan))) . " " . date("Y", strtotime($bln_tagihan)) . "', '" . date("Y-m-d", strtotime($tgl_tagihan)) . "',
						'" . date("Y-m-03", strtotime($bln_tagihan)) . "', 
						'" . $row_customer["cNoRekVirtual"] . "', '" . $row_customer["cNama"] . "', '" . $BillIndex . "', '1',
						'" . $uangmuka . "', '" . $total_invoice . "', '" . $ppn . "', '" . $monthly_fee . "',
						'" . $paid_status . "', '1',
						'auto', NOW(), NOW(),
						'auto', 'auto', '0');";
                    mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
                                                                       alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                       window.history.go(-1);
                                                                     </script>");

                    enableLog("", "auto", "auto", "Create Invoice", $sql_insert_invoice);

                    //detail invoice inet
                    $sql_detail_inet = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `date`,
						`harga`, `desc`, `date_add`,
						`date_upd`, `user_add`, `user_upd`, `level`)
						VALUES ('', '" . $kode_invoice . "', '" . date("Y-m-d H:i:s", strtotime($tgl_tagihan)) . "',
						'" . $total_invoice . "', 'INTERNET', NOW(),
						NOW(), 'auto', 'auto', '0');";
                    mysql_query($sql_detail_inet, $conn) or die ("<script language='JavaScript'>
                                                                    alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                    window.history.go(-1);
                                                                  </script>");

                    enableLog("", "auto", "auto", "Create Invoice (detail internet)", $sql_detail_inet);

                    $gx_saldo = $row_customer["gx_saldo"] - ($monthly_fee);
                    $sql_update_saldo = "UPDATE `tbCustomer` SET `gx_saldo` = '" . $gx_saldo . "',
                        `user_upd` = 'auto_generate', `date_upd` = NOW()
                        WHERE (`idCustomer` = '" . $row_customer["idCustomer"] . "');";
                    mysql_query($sql_update_saldo, $conn) or die ("Update GX Saldo error.");

                    enableLog("", "auto", "auto", "Update GX Saldo (tbCustomer)", $sql_update_saldo);
                    //END GENERATE
                    //GENERATE detail invoice
                    $sql_insert_detail = "INSERT INTO `gx_generate_detail` (`id_detail`, `id_generate`, `id_customer`, `kode_paket`)
			            VALUES (NULL, '" . $row_generate["id_generate"] . "', '" . $value . "', '" . $row_customer["cKdPaket"] . "');";
                    mysql_query($sql_insert_detail, $conn) or die (mysql_error());

                    enableLog("", "auto", "auto", "Create Report Generate Invoice (detail)", $sql_insert_detail);

                    //START GENERATE INPUT INVOICE RBS
                    if ($monthly_fee != "0") {
                        $total_invoice = $row_customer["monthly_fee"] + $row_customer["abonemen_voip"] + $row_customer["abonemen_video"];
                        $ppn = (10 / 100) * $total_invoice;
                        $monthly_fee = $total_invoice + $ppn;

                        $UserPaymentBalance_update = $UserPaymentBalance - ($monthly_fee);
                        $nterm = (int)$row_customer["nterm"];
                        $tambahan_grace = ($nterm == "0") ? "2" : $nterm;

                        $sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON
                            INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
                            VALUES ('" . $BillIndex . "', '1', '" . $row_customer["iuserIndex"] . "', '" . date("Y-m-01 00:00:00.000", strtotime($bln_tagihan)) . "', '" . date("Y-m-t 23:59:59.000", strtotime($bln_tagihan)) . "', '" . date("Y-m-d H:i:s.000") . "', '0', '0', '0', '0', '0');
                            SET IDENTITY_INSERT [dbo].[Bills] OFF
                            INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
                            VALUES ('" . $BillIndex . "', '" . $BillSectionIndex . "', '1', '" . $monthly_fee . "', '0', '0', '0', 'From activation For Dates " . date("01/m/Y", strtotime($bln_tagihan)) . " - " . date("t/m/Y", strtotime($bln_tagihan)) . " (" . $AccountName . ").');
                            UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='" . $UserPaymentBalance_update . "', [GracePeriodExpiration] = '" . date("Y-m-04 00:00:00.000", strtotime($bln_tagihan)) . "',
                            [UserExpiryDate] = '" . date("Y-m-01 00:00:00.000", strtotime($bln_tagihan . " +1 month")) . "'
                            WHERE ([UserIndex]='" . $row_customer["iuserIndex"] . "');";
                        $query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
                        $query_rbs_user_detail->execute();

                        enableLog("", "auto", "auto", $sql_rbs_user_detail);

                        $sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
                            INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
                            VALUES ('" . $BillingTransactionIndex . "', '" . date("Y-m-d H:i:s.000") . "', '1', '" . $row_customer["iuserIndex"] . "', '1', '" . $BillIndex . "', '-" . $monthly_fee . "');
                            SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
                        $q = $conn_soft->prepare($sql);
                        $q->execute();

                        enableLog("", "auto", "auto", $sql);
                    }
                    //INVOICE BULANAN
                }


                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='master_aktivasi.php';
                      </script>";

            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan invoice!');
                        window.history.go(-1);
                      </script>";
            }
        }

        if (isset($_GET["id"])) {
            $id_aktivasi = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_aktivasi = "SELECT * FROM `gx_aktivasi` WHERE `id_aktivasi`='$id_aktivasi' LIMIT 0,1;";
            $sql_spk_aktivasi = mysql_query($query_aktivasi, $conn);
            $row_aktivasi = mysql_fetch_array($sql_spk_aktivasi);

            $sql_teknisi = mysql_query("SELECT `gx_pegawai`.* FROM `gx_pegawai` WHERE `gx_pegawai`.`kode_pegawai` = '$row_aktivasi[id_teknisi]';", $conn);
            $row_teknisi = mysql_fetch_array($sql_teknisi);

            $sql_marketing = mysql_query("SELECT `gx_pegawai`.* FROM `gx_pegawai` WHERE `gx_pegawai`.`kode_pegawai` = '$row_aktivasi[id_marketing]';", $conn);
            $row_marketing = mysql_fetch_array($sql_marketing);

            $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `gx_cabang`.`id_cabang` = '$row_aktivasi[id_cabang]';", $conn);
            $row_cabang = mysql_fetch_array($sql_cabang);

            $sql_paket = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`id_paket` = '$row_aktivasi[paket_koneksi]';", $conn);
            $row_paket = mysql_fetch_array($sql_paket);

            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
            $hari_ini = date("d");

            $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini + 1;
            $tagihanperhari = $row_paket["monthly_fee"] / $jumlah_hari;
            $total_tagihan = $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
            $ppn = 10 / 100 * $total_tagihan;
            $totalppn = $total_tagihan + $ppn;
        }


        $query_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' ORDER BY `id_cabang` ASC LIMIT 1;", $conn);
        $row_cabang = mysql_fetch_array($query_cabang);
        $sql_last_aktivasi = mysql_fetch_array(mysql_query("SELECT * FROM `gx_aktivasi` ORDER BY `id_aktivasi` DESC", $conn));
        $last_data = $sql_last_aktivasi["id_aktivasi"] + 1;
        $tanggal = date("d");
        $kode_aktivasi = $row_cabang["kode_cabang"] . '-' . $row_cabang["kode_spk_aktivasi"] . '' . $tanggal . '' . sprintf("%04d", $last_data);

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Aktivasi Baru</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="POST" name="myForm" action="">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Cabang</label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="' . (isset($_GET['id']) ? $row_customer["id_cabang"] : $loggedin["cabang"]) . '" >
                                                <input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="' . get_nama_cabang($loggedin['cabang']) . '">
                                                <input type="hidden" class="form-control" name="id_aktivasi" value="' . (isset($_GET['id']) ? $row_aktivasi["id_aktivasi"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Nomer Aktivasi Baru</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" readonly=""  class="form-control" id="kode_aktivasi" name="kode_aktivasi" required="" value="' . (isset($_GET['id']) ? $row_aktivasi["kode_aktivasi"] : $kode_aktivasi) . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Tanggal</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" id="tanggal" name="tanggal" required="" value="' . (isset($_GET['id']) ? $row_aktivasi["tanggal"] : date("Y-m-d")) . '">
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Kode Customer</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly=""  class="form-control" placeholder="Search Customer"
                                                onclick="return valideopenerform(\'data_spk_aktivasi_baru.php?r=myForm&f=aktivasi_prorate\',\'spkaktivasi\');" name="id_customer" value="' . (isset($_GET['id']) ? $row_aktivasi["id_customer"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Nama Customer</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly=""  class="form-control"  name="nama_customer" value="' . (isset($_GET['id']) ? $row_aktivasi["nama_customer"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>No. link Budget</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control"  readonly="" name="id_linkbudget" value="' . (isset($_GET['id']) ? $row_aktivasi["id_linkbudget"] : "") . '">
                                                <a id="linkk" name="linkk" href="" style="color : #4571b5; cursor : pointer;" onclick="return valideopenerform(this);">Detail Link Budget</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Paket Koneksi</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="paket_koneksi" value="' . (isset($_GET['id']) ? $row_aktivasi["paket_koneksi"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Nama Paket</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control"  name="nama_koneksi" value="' . (isset($_GET['id']) ? $row_aktivasi["nama_koneksi"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>User ID</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="user_id" value="' . (isset($_GET['id']) ? $row_aktivasi["user_id"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Telp</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="telpon" value="' . (isset($_GET['id']) ? $row_aktivasi["telpon"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="alamat" value="' . (isset($_GET['id']) ? $row_aktivasi["alamat"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Teknisi</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" onclick="return valideopenerform(\'data_teknisi.php?r=myForm\',\'cust\');" readonly="" name="nama_teknisi" value="' . (isset($_GET['id']) ? $row_teknisi["nama"] : "") . '">
                                                <input type="hidden" readonly="" class="form-control" name="id_teknisi" value="' . (isset($_GET['id']) ? $row_aktivasi["id_teknisi"] : "") . '">
                                            </div>          
                                            <div class="col-xs-3">
                                                <label>Marketing</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" onclick="return valideopenerform(\'data_marketing.php?r=myForm\',\'cust\');" name="nama_marketing" value="' . (isset($_GET['id']) ? $row_marketing["nama"] : "") . '">
                                                <input type="hidden" class="form-control" readonly="" name="id_employee" value="' . (isset($_GET['id']) ? $row_aktivasi["id_marketing"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>IP Customer</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" name="ip_customer" value="' . (isset($_GET['id']) ? $row_aktivasi["ip_customer"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3" align="center">
                                                <label> </label>
                                            </div>
                                            <div class="col-xs-4" align="center">
                                                <label>PERHITUNGAN INVOICE</label>
                                            </div>
                                            <div class="col-xs-4" align="center">
                                                <label></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Monthly Fee</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" readonly="" class="form-control" name="monthly" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_monthly"] : "") . '">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" id="harga"  class="form-control" name="acc_monthly" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_monthly"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Tagihan Perhari</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" readonly="" class="form-control" name="daily" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_daily"] : "0") . '">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" id="harga" class="form-control" name="acc_daily" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_daily"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>jumlah Hari Aktivasi</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" readonly="" class="form-control" name="hari_aktivasi" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_hari_aktivasi"] : "0") . '">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" name="acc_hari_aktivasi" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_hari_aktivasi"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Total Tagihan Prorate</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" readonly="" class="form-control" name="total" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_total"] : "0") . '">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" id="harga" class="form-control" name="acc_total" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_total"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>PPN</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" readonly="" class="form-control" name="ppn" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_ppn"] : "0") . '">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" id="harga" class="form-control" name="acc_ppn" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_ppn"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Total Tagihan + PPN</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" readonly="" class="form-control" name="totalppn" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_totalppn"] : "0") . '">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" id="harga" class="form-control" name="acc_totalppn" value="' . (isset($_GET['id']) ? $row_aktivasi["acc_totalppn"] : "0") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Created By</label>
                                            </div>
                                            <div class="col-xs-6">
                                                ' . (isset($_GET['id']) ? $row_aktivasi["user_add"] : $loggedin["username"]) . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Lates Update By </label>
                                            </div>
                                            <div class="col-xs-6">
                                                ' . (isset($_GET['id']) ? $row_aktivasi["user_upd"] . " " . $row_aktivasi["date_upd"] : "") . '
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '<!-- datepicker -->
        <script src="' . URL . 'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="' . URL . 'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>';

        $title = 'Form Aktivasi Baru';
        $submenu = "aktivasi";
        //$plugins	= '';
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];
        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>