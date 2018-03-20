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

        global $conn;
        global $conn_voip;

        if (isset($_POST["save"])) {

            $kode_invoice = isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
            $title = isset($_POST['title']) ? mysql_real_escape_string(trim($_POST['title'])) : '';
            $id_cabang = $loggedin["cabang"];
            $customer_number = isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $npwp = isset($_POST['npwp']) ? mysql_real_escape_string(trim($_POST['npwp'])) : '';
            $periode_tagihan = isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
            $no_faktur_pajak = isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
            $tanggal_tagihan = isset($_POST['description']) ? mysql_real_escape_string(trim($_POST['description'])) : '';
            $no_virtual_account_bca = isset($_POST['no_virtual_account_bca']) ? mysql_real_escape_string(trim($_POST['no_virtual_account_bca'])) : '';
            $tanggal_tagihan = isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';
            $tanggal_jatuh_tempo = isset($_POST['tanggal_jatuh_tempo']) ? mysql_real_escape_string(trim($_POST['tanggal_jatuh_tempo'])) : '';
            $nama_virtual = isset($_POST['nama_virtual']) ? mysql_real_escape_string(trim($_POST['nama_virtual'])) : '';
            $note = isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
            $prepared_by = isset($_POST['prepared_by']) ? mysql_real_escape_string(trim($_POST['prepared_by'])) : '';

            if ($kode_invoice != "") {

                //insert into cc_subscription_service
                $sql_insert = "INSERT INTO `gx_invoice`(`id_invoice`, `id_cabang`, `kode_invoice`, `title`, `customer_number`,`nama_customer`,
     				`npwp`, `no_faktur_pajak`, `note`, `periode_tagihan`,`tanggal_tagihan`, `tanggal_jatuh_tempo`,
					`no_virtual_account_bca`, `nama_virtual`, `prepared_by`, `date_add`, `date_upd`,
					`user_add`, `user_upd`, `level`)
				    VALUES ('', '" . $id_cabang . "', '" . $kode_invoice . "', '" . $title . "', '" . $customer_number . "', '" . $nama_customer . "',
					'" . $npwp . "', '" . $no_faktur_pajak . "', '" . $note . "', '" . $periode_tagihan . "', '" . $tanggal_tagihan . "', '" . $tanggal_jatuh_tempo . "',
					'" . $no_virtual_account_bca . "', '" . $nama_virtual . "', '" . $prepared_by . "', NOW(), NOW(),
					'" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                           window.history.go(-1);
                                                         </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='form_invoice_detail.php?c=$kode_invoice';
                      </script>";

            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        } elseif (isset($_POST["update"])) {

            $id_invoice = isset($_POST['id_invoice']) ? mysql_real_escape_string(trim($_POST['id_invoice'])) : '';
            $kode_invoice = isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
            $title = isset($_POST['title']) ? mysql_real_escape_string(trim($_POST['title'])) : '';
            $id_cabang = $loggedin["cabang"];
            $customer_number = isset($_POST['customer_number']) ? mysql_real_escape_string(trim($_POST['customer_number'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $npwp = isset($_POST['npwp']) ? mysql_real_escape_string(trim($_POST['npwp'])) : '';
            $periode_tagihan = isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
            $no_faktur_pajak = isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
            $tanggal_tagihan = isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';
            $no_virtual_account_bca = isset($_POST['no_virtual_account_bca']) ? mysql_real_escape_string(trim($_POST['no_virtual_account_bca'])) : '';
            $tanggal_jatuh_tempo = isset($_POST['tanggal_jatuh_tempo']) ? mysql_real_escape_string(trim($_POST['tanggal_jatuh_tempo'])) : '';
            $nama_virtual = isset($_POST['nama_virtual']) ? mysql_real_escape_string(trim($_POST['nama_virtual'])) : '';
            $note = isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
            $prepared_by = isset($_POST['prepared_by']) ? mysql_real_escape_string(trim($_POST['prepared_by'])) : '';


            if ($id_invoice != "") {

                //Update into cc_subscription_service
                $sql_update = "UPDATE `gx_invoice` SET `title`='" . $title . "', `id_cabang`='" . $id_cabang . "',
                    `npwp`='" . $npwp . "', `no_faktur_pajak`='" . $no_faktur_pajak . "', `note`='" . $note . "', `periode_tagihan`='" . $periode_tagihan . "',
                    `no_virtual_account_bca` = '" . $no_virtual_account_bca . "', `nama_virtual` = '" . $nama_virtual . "',
                    `date_upd` = NOW(), `user_upd` = '" . $loggedin["username"] . "'
                    WHERE `id_invoice`='" . $id_invoice . "';";\
                mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
                                                            alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                            window.history.go(-1);
                                                         </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update);


                echo "<script language='JavaScript'>
                        alert('Data telah diupdate.');
                        window.location.href='form_invoice_detail.php?c=$kode_invoice';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        if (isset($_GET["id"])) {

            $id_invoice = isset($_GET['id']) ? $_GET['id'] : '';
            $query_invoice = "SELECT * FROM `gx_invoice` WHERE `id_invoice` ='" . $id_invoice . "' LIMIT 0,1;";
            $sql_invoice = mysql_query($query_invoice, $conn);
            $row_invoice = mysql_fetch_array($sql_invoice);

        }

        $query_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' ORDER BY `id_cabang` ASC LIMIT 1;", $conn);
        $row_cabang = mysql_fetch_array($query_cabang);

        $sql_invoice = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
        $last_data = $sql_invoice["id_invoice"] + 1;
        $tanggal = date("d");
        $kode_cabang = $row_cabang["kode_cabang"] . '-' . $row_cabang["invoice_code"] . '' . $tanggal . '' . sprintf("%04d", $last_data);

        $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_invoice" id="form_invoice" method="post" enctype="multipart/form-data">
				                    <div class="box-body">
                                        <div class="form-group">
					                        <div class="row">
					                            <input type="hidden" readonly="" class="form-control" required="" name="id_invoice" value="' . (isset($_GET["id"]) ? $row_invoice["id_invoice"] : '') . '">
                                                <div class="col-xs-2">
                                                    <label>Cabang</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="' . (isset($_GET['id']) ? $row_customer["id_cabang"] : $loggedin["cabang"]) . '" >
                                                    <input type="text" readonly class="form-control" id="nama_cabang" name="nama_cabang" value="' . get_nama_cabang($loggedin['cabang']) . '">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Kode Invoice</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" readonly="" class="form-control" required="" name="kode_invoice" value="' . (isset($_GET["id"]) ? $row_invoice["kode_invoice"] : $kode_cabang) . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Title</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <input type="text" class="form-control" name="title" id="title" value="' . (isset($_GET['id']) ? $row_invoice["title"] : '') . '">
                                                </div>
                                            </div>
                                        </div>
                                                            
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Customer Number</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" readonly="" required="" name="customer_number" id="customer_number" value="' . (isset($_GET['id']) ? $row_invoice["customer_number"] : '') . '" onclick="return valideopenerform(\'data_cust.php?r=form_invoice&f=invoice\',\'customer\');">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Nama Customer</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" readonly="" required="" name="nama_customer" id="nama_customer" value="' . (isset($_GET['id']) ? $row_invoice["nama_customer"] : '') . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>NPWP</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control"  name="npwp" id="npwp" value="' . (isset($_GET['id']) ? $row_invoice["npwp"] : '') . '">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Periode Tagihan</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" required="" name="periode_tagihan" id="periode_tagihan" value="' . (isset($_GET['id']) ? $row_invoice["periode_tagihan"] : '') . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>No Faktur Pajak</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" name="no_faktur_pajak" id="no_faktur_pajak" value="' . (isset($_GET['id']) ? $row_invoice["no_faktur_pajak"] : '') . '">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Tanggal Tagihan</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control hasDatepicker" id="datepicker3" readonly="" required="" name="tanggal_tagihan" value="' . (isset($_GET['id']) ? $row_invoice["tanggal_tagihan"] : date("Y-m-d")) . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>No Virtual Account </label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" name="no_virtual_account_bca" id="no_virtual_account_bca" value="' . (isset($_GET['id']) ? $row_invoice["no_virtual_account_bca"] : '') . '">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Tanggal jatuh Tempo </label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control hasDatepicker" id="datepicker2" readonly="" required="" name="tanggal_jatuh_tempo" value="' . (isset($_GET['id']) ? $row_invoice["tanggal_jatuh_tempo"] : (date("Y-m-d", mktime(date("m"), date("Y"), (date("d") + 3))))) . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Nama Virtual Account </label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" name="nama_virtual" id="nama_virtual" value="' . (isset($_GET['id']) ? $row_invoice["nama_virtual"] : '') . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Note</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <textarea class="form-control" name="note" style="resize:none;">' . (isset($_GET['id']) ? $row_invoice["note"] : "") . '</textarea>
                                                </div>
                                            </div>
                                        </div>
                                                            
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Prepared By </label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="text" class="form-control" readonly="" required="" name="prepared_by" id="prepared_by" value="' . (isset($_GET['id']) ? $row_invoice["prepared_by"] : $loggedin["username"]) . '">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Created By</label>
                                                </div>
                                                <div class="col-xs-6">
                                                    ' . (isset($_GET['id']) ? $row_invoice["user_add"] : $loggedin["username"]) . '
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Lates Update By </label>
                                                </div>
                                                <div class="col-xs-6">
                                                    ' . (isset($_GET['id']) ? $row_invoice["user_upd"] . " (" . $row_invoice["date_upd"] . ")" : "") . '
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

        $plugins = '
            <!-- datepicker -->
            <script src="' . URL . 'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
            <script>
                $(function() {
                    $("#datepicker3").datepicker({format: "yyyy-mm-dd"});
                });
                
                $(function() {
                     $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
                });
            </script>';

        $title = 'Form Invoice';
        $submenu = "invoice";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>