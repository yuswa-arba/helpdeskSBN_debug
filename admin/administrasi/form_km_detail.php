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
include("../../config/configuration_tv.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;
        $conn_soft = Config::getInstanceSoft();//koneksi RBS
        $conn_ott = DB_TV();//koneksi tv

        function topup_voip()
        {
            include("../../config/configuration_admin.php");
            global $conn_voip;

            //insert into cc_subscription_service
            $sql_insert = "INSERT INTO `mya2billing`.`cc_logrefill` (`id`, `date`, `credit`, `card_id`, `description`,
                `refill_type`, `added_invoice`, `agent_id`)
                VALUES (NULL, '" . $date . "', '" . $credit . "', '" . $id_cc_card . "', '" . $description . "', '" . $refill_type . "', '" . $added_invoice . "', NULL);";
            mysql_query($sql_insert, $conn_voip) or die (mysql_error());

            $sql_insert_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
                `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
                VALUES (NULL, '1', '2', 'NEW REFILL CREATED', 'User added a new record in database',
                'date =  " . $date . "| credit =  " . $credit . "| description =  " . $description . "| card_id =  " . $id_cc_card . "| refill_type =  " . $refill_type . "|  added_invoice =  " . $added_invoice . "| Web Software GX (" . $loggedin["username"] . ")',
                'cc_logrefill', 'form_refill.php', '" . getenv("REMOTE_ADDR") . "', NOW(), '0');";
            mysql_query($sql_insert_log, $conn_voip) or die (mysql_error());

            enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert); // for create log in newfunction2.php

            if ($added_invoice == 1) {
                $sql_invoice = mysql_query("SELECT COUNT(*) as `total` FROM `cc_invoice` WHERE `date` LIKE '%" . date("Y") . "-%';", $conn_voip);
                $row_invoice = mysql_fetch_array($sql_invoice);

                $total = $row_invoice["total"] + 1;
                $reference = date("Ymd") . sprintf("%06d", $total);

                //insert into cc_invoice
                $sql_insert_invoice = "INSERT INTO `mya2billing`.`cc_invoice` (`id`, `reference`, `id_card`, `date`, `paid_status`,
                    `status`, `title`, `description`)
                    VALUES (NULL, '" . $reference . "', '" . $id_cc_card . "', '" . $date . "', '0', '0', 'REFILL', 'Invoice for refill');";
                mysql_query($sql_insert_invoice, $conn_voip) or die (mysql_error());

                $sql_insert_log_invoice = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
                    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
                    VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
                    'reference =  " . $reference . "| id_card =  " . $id_cc_card . "| date =  " . $date . "| paid_status =  0| status =  0|  title =  REFILL| description = Invoice for refill| Web Software GX (" . $loggedin["username"] . ")',
                    'cc_invoice', 'form_refill.php', '" . getenv("REMOTE_ADDR") . "', NOW(), '0');";
                mysql_query($sql_insert_log_invoice, $conn_voip) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_log_invoice); // for create log in newfunction2.php

                //insert invoice item
                $sql_invoice_last = mysql_query("SELECT * FROM `cc_invoice` WHERE `reference` LIKE '%" . $reference . "%';", $conn_voip);
                $row_invoice_last = mysql_fetch_array($sql_invoice_last);

                $id_invoice_last = $row_invoice_last["id"];

                //insert into cc_invoice_item
                $sql_insert_invoice_item = "INSERT INTO `mya2billing`.`cc_invoice_item` (`id`, `id_invoice`, `date`,
                    `price`, `VAT`, `description`, `id_ext`, `type_ext`)
                    VALUES (NULL, '" . $id_invoice_last . "', '" . $date . "', '" . $credit . "', '0', 'Refill', NULL, NULL);";
                mysql_query($sql_insert_invoice_item, $conn_voip) or die (mysql_error());

                $sql_insert_log_invoice_item = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`, `description`,
                    `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
                    VALUES (NULL, '1', '2', 'NEW INVOICE CREATED', 'User added a new record in database',
                    'id_invoice =  " . $id_invoice_last . "| price =  " . $credit . "| date =  " . $date . "| vat =  0| description =  Refill| Web Software GX (" . $loggedin["username"] . ")',
                    'cc_invoice_item', 'form_refill.php', '" . getenv("REMOTE_ADDR") . "', NOW(), '0');";
                mysql_query($sql_insert_log_invoice_item, $conn_voip) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert_log_invoice_item); // for create log in newfunction2.php
            }

            //add customer credit
            //Update cc_card mya2billing
            $sql_card = mysql_query("SELECT `credit`, `id` FROM `cc_card` WHERE `id` = '" . $id_cc_card . "' LIMIT 0,1;", $conn_voip);
            $row_card = mysql_fetch_array($sql_card);
            $total_credit = $row_card["credit"] + $credit;

            $sql_update_card = "UPDATE `cc_card` SET `credit` = '" . $total_credit . "'  WHERE `cc_card`.`id` = '" . $id_cc_card . "'";
            mysql_query($sql_update_card, $conn_voip) or die ("Data error");
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "$sql_update_card");


            $sql_update_log = "INSERT INTO `mya2billing`.`cc_system_log` (`id`, `iduser`, `loglevel`, `action`,
                `description`, `data`, `tablename`, `pagename`, `ipaddress`, `creationdate`, `agent`)
                VALUES (NULL, '1', '3', 'A CREDIT UPDATED', 'A RECORD IS UPDATED, EDITION CALUSE USED IS  id=" . $id_cc_card . " ',
                'id = " . $id_cc_card . " |credit=" . $credit . " |Web Software GX (" . $loggedin["username"] . ")',
                'cc_card', 'form_refill.php',
                '" . getenv("REMOTE_ADDR") . "', NOW(), '0');";
            mysql_query($sql_update_log, $conn_voip) or die ("Data error");

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "$sql_update_log"); // for create log in newfunction2.php
        }

        if (isset($_POST["save"])) {
            $kode_km = isset($_POST['kode_km']) ? mysql_real_escape_string(trim($_POST['kode_km'])) : '';
            $no_jual = isset($_POST['no_jual']) ? mysql_real_escape_string(trim($_POST['no_jual'])) : '';
            $no_acc = isset($_POST['no_acc']) ? mysql_real_escape_string(trim($_POST['no_acc'])) : '';
            $nominal = isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
            $keterangan = isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
            $return_url = isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';

            if ($kode_km != "") {
                //insert into cc_subscription_service
                $sql_insert = "INSERT INTO `gx_km_detail` (`id_km_detail`, `id_kasmasuk`,
                    `no_acc`, `no_jual`, `keterangan`, `nominal`,
                    `date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
                    VALUES (NULL, '" . $kode_km . "', '" . $no_acc . "', '" . $no_jual . "', '" . $keterangan . "', '" . $nominal . "',
                    NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                                alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                window.history.go(-1);
                                                              </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert); // for create log in newfunction2.php

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='" . URL_ADMIN . "administrasi/" . $return_url . "';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        } elseif (isset($_POST["update"])) {
            $id = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
            $kode_km = isset($_POST['kode_km']) ? mysql_real_escape_string(trim($_POST['kode_km'])) : '';
            $no_jual = isset($_POST['no_jual']) ? mysql_real_escape_string(trim($_POST['no_jual'])) : '';
            $no_acc = isset($_POST['no_acc']) ? mysql_real_escape_string(trim($_POST['no_acc'])) : '';
            $nominal = isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
            $keterangan = isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
            $return_url = isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';

            if ($id != "" AND $kode_km != "") {
                //Update into cc_subscription_service
                $sql_update = "UPDATE `gx_km_detail` SET `id_kasmasuk`='" . $kode_km . "', `no_acc`='" . $no_acc . "',
                    `no_jual`='" . $no_jual . "', `keterangan`='" . $keterangan . "', `nominal`='" . $nominal . "',
                    `date_upd` = NOW(), `user_upd` = '" . $loggedin["username"] . "'
                    WHERE (`id_km_detail`='" . $id . "');";
                echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
                                                                alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                window.history.go(-1);
                                                              </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update); // for create log in newfunction2.php

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

        if (isset($_POST["posting"])) {
            $id_customer = isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
            $transaction_id = isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';

            if ($id_customer != "" AND $transaction_id != "") {
                //detail_bankmasuk
                $query_bm = "SELECT SUM(`nominal`) AS `nominal`
                    FROM `gx_kas_masuk`, `gx_km_detail`
                    WHERE `gx_kas_masuk`.`id_kasmasuk` = `gx_km_detail`.`id_kasmasuk`
                    AND `gx_kas_masuk`.`transaction_id` ='" . $transaction_id . "' AND  `gx_kas_masuk`.`level` ='0';";
                $sql_bm = mysql_query($query_bm, $conn);

                //detail user
                $query_user = "SELECT `iuserIndex`, `cUserID`, `gx_saldo` FROM `tbCustomer` WHERE `cKode` ='" . $id_customer . "';";
                $sql_user = mysql_query($query_user, $conn);
                $row_user = mysql_fetch_array($sql_user);

                //Detail RBS
                $sql_rbs_lastdata = "SELECT TOP 1 [BillingTransactions].[BillingTransactionIndex] FROM [dbo].[BillingTransactions] ORDER BY [BillingTransactionIndex] DESC;";
                $query_rbs_lastdata = $conn_soft->prepare($sql_rbs_lastdata);
                $query_rbs_lastdata->execute();
                $row_rbs_lastdata = $query_rbs_lastdata->fetch();

                $BillingTransactionIndex = $row_rbs_lastdata["BillingTransactionIndex"] + 1;

                $sql_pay_lastdata = "SELECT TOP 1 [Payments].[PaymentNumber] FROM [dbo].[Payments] ORDER BY [PaymentNumber] DESC;";
                $query_pay_lastdata = $conn_soft->prepare($sql_pay_lastdata);
                $query_pay_lastdata->execute();
                $row_pay_lastdata = $query_pay_lastdata->fetch();

                $PaymentNumber = $row_pay_lastdata["PaymentNumber"] + 1;

                $sql_rbs_lastdata_user = "SELECT TOP 1 [Users].[UserPaymentBalance], [AccountTypes].[AccountName] FROM [dbo].[Users], [dbo].[AccountTypes]
                    WHERE [dbo].[Users].[AccountIndex] = [dbo].[AccountTypes].[AccountIndex]
                    AND [dbo].[Users].[UserIndex] = '" . $row_user["iuserIndex"] . "';";
                $query_rbs_lastdata_user = $conn_soft->prepare($sql_rbs_lastdata_user);
                $query_rbs_lastdata_user->execute();
                $row_rbs_lastdata_user = $query_rbs_lastdata_user->fetch();

                $UserPaymentBalance = $row_rbs_lastdata_user["UserPaymentBalance"];
                $AccountName = $row_rbs_lastdata_user["AccountName"];
                //End Detail RBS

                while ($row_bm = mysql_fetch_array($sql_bm)) {
                    $nominal = $row_bm["nominal"];

                    if ($nominal > 0) {
                        //topup saldo RBS
                        $sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON
                            INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
                            VALUES ('" . $BillingTransactionIndex . "', '" . date("Y-m-d H:i:s.000") . "', '1', '" . $row_user["iuserIndex"] . "', '2', '" . $PaymentNumber . "', '" . $nominal . "');
                            SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF";
                        $q = $conn_soft->prepare($sql);
                        $q->execute();


                        $UserPaymentBalance_update = $UserPaymentBalance + ($nominal);

                        $sql_rbs_user_detail = "
                            INSERT INTO [dbo].[Payments] ([PaymentNumber], [PaymentMethod], [CreateDate], [UserType], [UserIndex], [Amount], [Remark])
                            VALUES ('" . $PaymentNumber . "', '3', '" . date("Y-m-d H:i:s.000") . "', '1', '" . $row_user["iuserIndex"] . "', '" . $nominal . "', 'Bayar No " . $transaction_id . "    " . $row_invoice["kode_invoice"] . "  ');
				
                            UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='" . $UserPaymentBalance_update . "'
                            WHERE ([UserID]='" . $row_user["cUserID"] . "');";
                        $query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
                        $query_rbs_user_detail->execute();
                        //END RBS

                        //topup to dompet GX
                        $query_data = "SELECT * FROM `tbCustomer` WHERE `tbCustomer`.`cKode`='" . $id_customer . "' LIMIT 0,1;";
                        $sql_data = mysql_query($query_data, $conn);
                        $row_data = mysql_fetch_array($sql_data);
                        $total_balance = $row_data["gx_saldo"] + $nominal;

                        //insert into gx_saldo
                        $sql_update_data = "UPDATE `tbCustomer` SET `gx_saldo`='" . $total_balance . "'
					        WHERE (`cKode`='" . $id_customer . "');";
                        mysql_query($sql_update_data, $conn) or die (mysql_error());

                        enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_data);
                    }
                }

                $sql_update_lock = "UPDATE `gx_kas_masuk` SET `reference`='" . $BillingTransactionIndex . "', `posting`='1', `status`='1', `date_upd` = NOW(), `user_upd`= '" . $loggedin["username"] . "'
				    WHERE (`transaction_id`='" . $transaction_id . "');";
                mysql_query($sql_update_lock, $conn) or die (mysql_error());

                echo "<script language='JavaScript'>
                        alert('Transaksi Sukses..');
                        window.location.href='master_kasmasuk.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Transaksi Gagal..');
                        window.location.href='master_kasmasuk.php';
                      </script>";
            }
        }

        $return_url = "";
        if (isset($_GET["km"])) {
            $kode_data = isset($_GET['km']) ? mysql_real_escape_string(strip_tags(trim($_GET['km']))) : '';
            $query_data = "SELECT * FROM `gx_kas_masuk` WHERE `transaction_id` = '" . $kode_data . "' LIMIT 0,1;";
            $sql_data = mysql_query($query_data, $conn);
            $row_data = mysql_fetch_array($sql_data);

            $return_url = 'form_km_detail.php?km=' . $kode_data;
        }

        $content = '

            <!-- Main content -->
            <section class="content">
                <div class="row">
			        <section class="col-lg-9"> 
                        <div class="box box-solid box-info">
                            <div class="box-header">
                                <h3 class="box-title">Data Kas Masuk</h3>
                            </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form action="" role="form" name="form_bm" id="form_bm" method="post" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <input type="hidden" name="id_customer" value="' . (isset($_GET['km']) ? $row_data["id_customer"] : "") . '" readonly="">
                                            <input type="hidden" name="transaction_id" value="' . (isset($_GET['km']) ? $row_data["transaction_id"] : "") . '" readonly="">
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Nomer Transaksi</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . (isset($_GET['km']) ? $row_data["transaction_id"] : "") . '
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label>Tanggal</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . (isset($_GET['km']) ? $row_data["tgl_transaction"] : date("Y-m-d")) . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Kode Customer</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . (isset($_GET['km']) ? $row_data["id_customer"] : "") . '
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <label>Nama Customer</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . (isset($_GET['km']) ? $row_data["nama"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Acc Cash</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . (isset($_GET['km']) ? $row_data["acc_cash"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>MU</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . ((isset($_GET['km'])) ? $row_data["mu"] : "") . '
                                                    </div>      
                                                    <div class="col-xs-3">
                                                        <label>Rate</label>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        ' . (isset($_GET['km']) ? $row_data["rate"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Remarks</label>
                                                    </div>
                                                    <div class="col-xs-9">
                                                        ' . (isset($_GET['km']) ? $row_data["remarks"] : "") . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Created By</label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        ' . (isset($_GET['km']) ? $row_data["user_add"] : $loggedin["username"]) . '
                                                    </div>     
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <label>Latest Updated By </label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        ' . (isset($_GET['km']) ? $row_data["user_upd"] . " on " . $row_data["date_upd"] : "") . '
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
                                                                        <th>No.</th>
                                                                        <th>ACC</th>
                                                                        <th>No Jual</th>
                                                                        <th>Keterangan</th>
                                                                        <th>Nominal</th>
                                                                        <th>#</th>
                                                                    </tr>';
        if (isset($_GET["km"])) {
            $id_kasmasuk = $row_data["id_kasmasuk"];
            $query_item = "SELECT * FROM `gx_km_detail` WHERE `id_kasmasuk` ='" . $id_kasmasuk . "';";
            $sql_item = mysql_query($query_item, $conn);

            $id_km_detail = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_detail = "SELECT * FROM `gx_km_detail` WHERE `id_kasmasuk` ='" . $id_kasmasuk . "' AND `id_km_detail` = '" . $id_km_detail . "' LIMIT 0,1;";
            $sql_detail = mysql_query($query_detail, $conn);
            $row_detail = mysql_fetch_array($sql_detail);

            $no = 1;
            $total = 0;

            while ($row_item = mysql_fetch_array($sql_item)) {

                $content .= '
                    <tr>
                        <td>' . $no . '.</td>
                        <td>' . $row_item["no_acc"] . '</td>
                        <td>' . $row_item["no_jual"] . '</td>
                        <td>' . $row_item["keterangan"] . '</td>
                        <td>' . number_format($row_item["nominal"], 0, ',', '.') . '</td>
                        <td><a href="form_km_detail?km=' . $kode_data . '&id=' . $row_item["id_km_detail"] . '"><span class="label label-info">Edit</span></a>
                        
                        </td>
                    </tr>';
                $no++;
                $total = $total + $row_item["nominal"];
            }
        } else {
            $total_price = 0;
            $content .= '<tr><td colspan="7">&nbsp;</td></tr>';
        }

        $content .= '
                                                                    <tr>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td colspan="2" align="right">TOTAL &nbsp;:</td>
                                                                        <td  align="right">' . number_format($total, 0, ',', '.') . '</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" value="Posting" name="posting" class="btn btn-primary">Save & Posting</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </section>
                            <section class="col-lg-9"> 
                                <div class="box box-solid box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">FORM KAS MASUK ITEM</h3>
                                    </div><!-- /.box-header -->
                                    
                                    <!-- form start -->
                                    <form action="" role="form" name="form_km_item" id="form_km_item" method="post" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>No Jual</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" name="no_jual" value="' . (isset($_GET['km']) ? $row_detail["no_jual"] : "") . '" >
                                                        <input type="hidden" name="id" value="' . (isset($_GET['id']) ? $row_detail["id_km_detail"] : '') . '" readonly="">
                                                        <input type="hidden" name="kode_km" value="' . (isset($_GET['km']) ? $row_data["id_kasmasuk"] : '') . '" readonly="">
                                                        <input type="hidden" name="return_url" value="' . $return_url . '" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>ACC</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" required name="no_acc" value="' . (isset($_GET['id']) ? $row_detail["no_acc"] : "") . '" >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Keterangan</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" name="keterangan"  value="' . (isset($_GET['id']) ? $row_detail["keterangan"] : "") . '">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Nominal</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" required="" name="nominal" id="harga" value="' . (isset($_GET['id']) ? $row_detail["nominal"] : "") . '">
                                                    </div>
                                                 </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Created By</label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        ' . (isset($_GET['id']) ? $row_detail["user_add"] : $loggedin["username"]) . '
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <label>Lates Update By </label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        ' . (isset($_GET['id']) ? $row_detail["user_upd"] . " on " . $row_detail["date_upd"] : "") . '
                                                    </div>      
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" value="Submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            </section>
                        </div>
                    </section><!-- /.content -->';

        $plugins = '<script src="' . URL . 'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0
	    });
        </script>
';

        $title = 'Form Kas Masuk Detail';
        $submenu = "master_bankmasuk";
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