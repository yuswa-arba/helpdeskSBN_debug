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
            $kode_invoice = isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
            $kode_acc = isset($_POST['kode_acc']) ? mysql_real_escape_string(trim($_POST['kode_acc'])) : '';
            $date = isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
            $price = isset($_POST['price']) ? str_replace(",", "", $_POST['price']) : '';
            $description = isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
            $return_url = isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';

            if ($kode_invoice != "") {
                //insert into cc_subscription_service
                $sql_insert = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`, `kode_acc`, `date`,
					`harga`, `desc`, `date_add`,
					`date_upd`, `user_add`, `user_upd`, `level`)
					VALUES ('', '" . $kode_invoice . "', '" . $kode_acc . "', '" . $date . "',
					'" . $price . "', '" . $description . "', NOW(),
					NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                           window.history.go(-1);
                                                          </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='master_invoice.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        } elseif (isset($_POST["update"])) {
            $id = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
            $kode_invoice = isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
            $kode_acc = isset($_POST['kode_acc']) ? mysql_real_escape_string(trim($_POST['kode_acc'])) : '';
            $date = isset($_POST['date']) ? mysql_real_escape_string(trim($_POST['date'])) : '';
            $price = isset($_POST['price']) ? str_replace(",", "", $_POST['price']) : '';

            $description = isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
            $return_url = isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';

            if ($id != "" AND $kode_invoice != "") {

                //Update into cc_subscription_service
                $sql_update = "UPDATE `gx_invoice_detail` SET `kode_invoice`='" . $kode_invoice . "',
                    `kode_acc`='" . $kode_acc . "', `harga`='" . $price . "', `desc`='" . $description . "', `date_upd` = NOW(), `user_upd` = '" . $loggedin["username"] . "'
                    WHERE `id_invoice_detail`='" . $id . "';";
                mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                           window.history.go(-1);
                                                         </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update);

                echo "<script language='JavaScript'>
                        alert('Data telah diupdate.');
                        window.location.href='master_invoice.php';
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
            $kode_invoice = isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
            $tgl_tagihan = isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';

            if ($id_customer != "" AND $kode_invoice != "") {
                $query_invoice = "SELECT * FROM `gx_invoice` WHERE `kode_invoice` = '" . $kode_invoice . "';";
                $sql_invoice = mysql_query($query_invoice, $conn);
                $row_invoice = mysql_fetch_array($sql_invoice);


                $query_total = "SELECT SUM(`harga`) AS `total` FROM `gx_invoice_detail`
		            WHERE `kode_invoice` ='" . $kode_invoice . "' GROUP BY `kode_invoice`;";
                $sql_total = mysql_query($query_total, $conn);
                $row_total = mysql_fetch_array($sql_total);

                $total = $row_total["total"];
                $ppn = (10 / 100) * $total;
                $grandtotal = $total + $ppn;

                $sql_invoice = mysql_query("SELECT * FROM `gx_invoice`
					WHERE `customer_number` = '" . $id_customer . "'
					AND `kode_invoice` = '" . $kode_invoice . "'
					AND `level` = '0' LIMIT 0,1;", $conn);

                $sql_customer = mysql_query("SELECT * FROM `tbCustomer`, `gx_paket2`
					WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
					AND `tbCustomer`.`cKode` = '" . $id_customer . "'
					AND `gx_paket2`.`level` =  '0';", $conn);
                $row_customer = mysql_fetch_array($sql_customer);


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

                //END RBS

                //Update into cc_subscription_service
                $query_update_invoice = "UPDATE `gx_invoice` SET `total`='" . $total . "',  `status`='1',
		            `ppn`='" . $ppn . "', `grandtotal`='" . $grandtotal . "', `posting`='1', `reference` = '" . $BillIndex . "',
		            `date_upd` = NOW(), `user_upd` = '" . $loggedin["username"] . "'
		            WHERE `id_invoice`='" . $row_invoice["id_invoice"] . "';";
                $sql_update_invoice = mysql_query($query_update_invoice, $conn);

                //START GENERATE INPUT INVOICE RBS
                if ($total != "0") {
                    $UserPaymentBalance_update = $UserPaymentBalance - $grandtotal;
                    $nterm = (int)$row_customer["nterm"];
                    $tambahan_grace = ($nterm == "0") ? "2" : $nterm;

                    $sql_rbs_user_detail = "SET IDENTITY_INSERT [dbo].[Bills] ON;
                        INSERT INTO [dbo].[Bills] ([BillIndex], [BillType], [UserIndex], [BillStartDate], [BillEndDate], [CreateDate], [Emailed], [Charged], [EmailedSessions], [Exported1], [Exported2])
                        VALUES ('" . $BillIndex . "', '1', '" . $row_customer["iuserIndex"] . "', '" . date("Y-m-01 h:i:s.000", strtotime($tgl_tagihan)) . "', '" . date("Y-m-d H:i:s.000", strtotime($tgl_tagihan)) . "', '" . date("Y-m-d H:i:s.000") . "', '0', '0', '0', '0', '0');
                        SET IDENTITY_INSERT [dbo].[Bills] OFF;
                        INSERT INTO [dbo].[BillsSections] ([BillIndex], [BillSectionIndex], [Type], [Charge], [Info1], [Info2], [Info3], [Remark])
                        VALUES ('" . $BillIndex . "', '" . $BillSectionIndex . "', '1', '" . $grandtotal . "', '0', '0', '0', 'For Dates " . date("d/m/Y", strtotime($tgl_tagihan)) . " - " . date("d/m/Y", strtotime($tgl_tagihan)) . " (" . $AccountName . ").');
                        UPDATE TOP(1) [dbo].[Users] SET [UserPaymentBalance]='" . $UserPaymentBalance_update . "'
                        WHERE ([UserIndex]='" . $row_customer["iuserIndex"] . "');";
                    $query_rbs_user_detail = $conn_soft->prepare($sql_rbs_user_detail);
                    $query_rbs_user_detail->execute();

                    $sql = "SET IDENTITY_INSERT [dbo].[BillingTransactions] ON;
                        INSERT INTO [dbo].[BillingTransactions] ([BillingTransactionIndex], [CreateDate], [UserType], [UserIndex], [TransType], [Reference], [Total])
                        VALUES ('" . $BillingTransactionIndex . "', '" . date("Y-m-d H:i:s.000") . "', '1', '" . $row_customer["iuserIndex"] . "', '1', '" . $BillIndex . "', '-" . $grandtotal . "');
                        SET IDENTITY_INSERT [dbo].[BillingTransactions] OFF;";
                    $q = $conn_soft->prepare($sql);
                    $q->execute();

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql);

                    enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_rbs_user_detail);
                }
                //END GENERATE RBS

                echo "<script language='JavaScript'>
                        alert('Posting Sukses..');
                        window.location.href='master_invoice.php';
                      </script>";


            } else {
                echo "<script language='JavaScript'>
                        alert('Posting Gagal..');
                        window.location.href='master_invoice.php';
                      </script>";
            }

        }

        $return_url = "";

        if (isset($_GET["c"])) {
            $kode_invoice = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
            $query_invoice = "SELECT * FROM `gx_invoice`
			    WHERE `kode_invoice` = '" . $kode_invoice . "' LIMIT 0,1;";
            $sql_invoice = mysql_query($query_invoice, $conn);
            $row_invoice = mysql_fetch_array($sql_invoice);

            $return_url = 'form_invoice_detail.php?c=' . $kode_invoice;

        }


        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <section class="col-lg-9">
                        <form action="" role="form" name="form_invoice" id="form_invoice" method="post" enctype="multipart/form-data">
				            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Nama Pelanggan</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["nama_customer"] : '') . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Periode Tagihan</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["periode_tagihan"] : '') . '
                                            </div>
                                        </div>
                                    </div>
					
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Kode Customer</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["customer_number"] : '') . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Tanggal Tagihan</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["tanggal_tagihan"] : '') . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No Invoice</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["kode_invoice"] : '') . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Tanggal Jatuh Tempo</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["tanggal_jatuh_tempo"] : '') . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>NPWP</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["npwp"] : '') . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>No Virtual Account BCA</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["no_virtual_account_bca"] : '') . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No Faktur Pajak</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["no_faktur_pajak"] : '') . '
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Nama Virtual Account</label>
                                            </div>
                                            <div class="col-xs-3">
                                                ' . (isset($_GET['c']) ? $row_invoice["nama_virtual"] : '') . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>No Nota</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET['c']) ? $row_invoice["reference"] : '') . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Tanggal Generate</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET['c']) ? date("d-m-Y H:i:s", strtotime($row_invoice["date_add"])) : '') . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Note</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET['c']) ? $row_invoice["note"] : '') . '
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
                                                                <th>No ACC</th>
                                                                <th>Tanggal</th>
                                                                <th>Description</th>
                                                                <th>Harga</th>
                                                                <th>#</th>
                                                            </tr>';
        if (isset($_GET["c"])) {
            $kode_invoice = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
            $query_invoice_item = "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='" . $kode_invoice . "';";
            $sql_invoice_item = mysql_query($query_invoice_item, $conn);
            $id_detail_invoice = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_invoice_detail = "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='" . $kode_invoice . "' AND `id_invoice_detail` = '" . $id_detail_invoice . "' LIMIT 0,1;";
            $sql_invoice_detail = mysql_query($query_invoice_detail, $conn);
            $row_invoice_detail = mysql_fetch_array($sql_invoice_detail);
            $no = 1;
            $total_price = 0;

            while ($row_invoice_item = mysql_fetch_array($sql_invoice_item)) {

                $content .= '
                    <tr>
                        <td>' . $no . '.</td>
                        <td>' . $row_invoice_item["kode_acc"] . '</td>
                        <td>' . date("d-m-Y", strtotime($row_invoice_item["date"])) . '</td>
                        <td>' . $row_invoice_item["desc"] . '</td>
                        <td>' . number_format($row_invoice_item["harga"], 2, ',', '.') . '</td>
                        <td><a href="form_invoice_detail.php?c=' . $row_invoice_item["kode_invoice"] . '&id=' . $row_invoice_item["id_invoice_detail"] . '"><span class="label label-info">Edit</span></a></td>
                    </tr>';

                $no++;
                $total_price = $total_price + $row_invoice_item["harga"];
            }
        } else {
            $total_price = 0;
            $content .= '<tr><td colspan="7">&nbsp;</td></tr>';
        }

        $sql_cust = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '" . $row_invoice["customer_number"] . "' AND `level` = '0' LIMIT 0,1;", $conn);
        $row_cust = mysql_fetch_array($sql_cust);

        $ppn = (10 / 100) * $total_price;
        $total_price_ppn = $total_price + $ppn;

        if ($total_price_ppn < $row_cust['gx_saldo']) {
            $total = $row_cust['gx_saldo'] - $total_price_ppn;
        } elseif ($total_price_ppn > $row_cust['gx_saldo']) {
            $total = $total_price_ppn - $row_cust['gx_saldo'];
        } elseif ($total_price_ppn = $row_cust['gx_saldo']) {
            $total = '0';
        }


        $content .= '						
						                                    <tr>
                                                                <td>&nbsp;</td>
                                                                <td colspan="3" align="right">SUBTOTAL &nbsp;:</td>
                                                                <td  align="right">' . number_format($total_price, 2, ',', '.') . ' IDR</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td colspan="3" align="right">PPN &nbsp;:</td>
                                                                <td  align="right">' . number_format($ppn, 2, ',', '.') . ' IDR</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td colspan="3" align="right">UANG MUKA &nbsp;:</td>
                                                                <td  align="right">' . (($row_cust['gx_saldo'] >= 0) ? number_format($row_cust['gx_saldo'], 2, ',', '.') : "0") . ' IDR</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td colspan="3" align="right">TOTAL:</td>
                                                                <td  align="right">' . number_format($total_price_ppn, 2, ',', '.') . ' IDR</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td colspan="3" align="right">SISA SALDO:</td>
                                                                <td  align="right">' . number_format($total, 2, ',', '.') . ' IDR</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                         
                                                        </tbody>
                                                   </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <input type="hidden" name="id_customer" readonly value="' . $row_invoice["customer_number"] . '">
                                        <input type="hidden" name="kode_invoice" readonly value="' . $row_invoice["kode_invoice"] . '">
                                        <input type="hidden" name="tanggal_tagihan" readonly value="' . $row_invoice["tanggal_tagihan"] . '">
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" value="Posting" name="posting" class="btn btn-primary">Save &amp; Posting</button>
                                </div>
                            </div><!-- /.box -->
                        </form>
                    </section>
                    <section class="col-lg-9"> 
                        <div class="box box-solid box-info">
                            <div class="box-header">
                                <h3 class="box-title">FORM INVOICE ITEM</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form action="" role="form" name="form_invoice_item" id="form_invoice_item" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Date</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" readonly="" name="date" id="date" value="' . (isset($_GET['id']) ? $row_invoice_detail["date"] : date("Y-m-d H:i:s")) . '">
                                                <input type="hidden" name="id" value="' . (isset($_GET['id']) ? $row_invoice_detail["id_invoice_detail"] : '') . '" readonly="">
                                                <input type="hidden" name="kode_invoice" value="' . (isset($_GET['c']) ? $kode_invoice : "") . '" readonly="">
                                                <input type="hidden" name="return_url" value="' . $return_url . '" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>No ACC</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" required="" name="kode_acc" id="kode_acc" value="' . (isset($_GET['id']) ? $row_invoice_detail["kode_acc"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Harga</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" required="" name="price" id="harga" value="' . (isset($_GET['id']) ? $row_invoice_detail["harga"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <textarea class="form-control" name="description" style="resize:none;">' . (isset($_GET['id']) ? $row_invoice_detail["desc"] : "") . '</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Created By</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET['id']) ? $row_invoice_detail["user_add"] : $loggedin["username"]) . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Lates Update By </label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . (isset($_GET['id']) ? $row_invoice_detail["user_upd"] . " " . $row_invoice_detail["date_upd"] : "") . '
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
            </section><!-- /.content -->
            ';

        $plugins = '
            <script src="' . URL . 'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
            <script>
                $(\'[id=harga]\').priceFormat({
                    prefix: "",
                    thousandsSeparator: ",",
                    centsLimit: 0
                });
            </script>';

        $title = 'Form Invoice Item';
        $submenu = "invoice";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>