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

        if (isset($_POST["save"])) {

            $id_cabang = isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
            $transaction_id = isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
            $tgl_transaction = isset($_POST['tgl_transaction']) ? mysql_real_escape_string(trim($_POST['tgl_transaction'])) : '';
            $bank_code = isset($_POST['kode_bank']) ? mysql_real_escape_string(trim($_POST['kode_bank'])) : '';
            $id_customer = isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
            $nama_acc = isset($_POST['nama_acc']) ? mysql_real_escape_string(trim($_POST['nama_acc'])) : '';
            $acc_credit = isset($_POST['acc_bank']) ? mysql_real_escape_string(trim($_POST['acc_bank'])) : '';
            $mu = isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
            $rate = isset($_POST['rate']) ? mysql_real_escape_string(trim($_POST['rate'])) : '';
            $total = isset($_POST['total']) ? mysql_real_escape_string(trim($_POST['total'])) : '';
            $remarks = isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';

            if ($transaction_id != "") {

                //insert into gxCabang
                $sql_insert = "INSERT INTO `gx_bank_masuk` (`id_bankmasuk`, `id_cabang`, `transaction_id`, `tgl_transaction`,
                    `bank_code`, `id_customer`, `nama_acc`, `acc_credit`, `mu`, `rate`, `total`, `remarks`,
                    `date_add`, `date_upd`, `user_upd`, `user_add`, `level`)
                    VALUES (NULL, '" . $id_cabang . "', '" . $transaction_id . "', '" . $tgl_transaction . "', '" . $bank_code . "',
                    '" . $id_customer . "',  '" . $nama_acc . "',  '" . $acc_credit . "',  '" . $mu . "',  '" . $rate . "',  '" . $total . "',  '" . $remarks . "',    
                    NOW(), NOW(), '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', '0');";
                mysql_query($sql_insert, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert);

                header("location: form_bm_detail.php?bm=" . $transaction_id);

            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        } elseif (isset($_POST["update"])) {

            $id_cabang = isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
            $id_bankmasuk = isset($_POST['id_bankmasuk']) ? mysql_real_escape_string(trim($_POST['id_bankmasuk'])) : '';
            $transaction_id = isset($_POST['transaction_id']) ? mysql_real_escape_string(trim($_POST['transaction_id'])) : '';
            $tgl_transaction = isset($_POST['tgl_transaction']) ? mysql_real_escape_string(trim($_POST['tgl_transaction'])) : '';
            $bank_code = isset($_POST['kode_bank']) ? mysql_real_escape_string(trim($_POST['kode_bank'])) : '';
            $id_customer = isset($_POST['id_customer']) ? mysql_real_escape_string(trim($_POST['id_customer'])) : '';
            $nama_acc = isset($_POST['nama_acc']) ? mysql_real_escape_string(trim($_POST['nama_acc'])) : '';
            $acc_credit = isset($_POST['acc_bank']) ? mysql_real_escape_string(trim($_POST['acc_bank'])) : '';
            $mu = isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
            $rate = isset($_POST['rate']) ? mysql_real_escape_string(trim($_POST['rate'])) : '';
            $total = isset($_POST['total']) ? mysql_real_escape_string(trim($_POST['total'])) : '';
            $remarks = isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';

            if ($transaction_id != "" AND $id_bankmasuk != "") {

                $sql_update = "UPDATE `gx_bank_masuk` SET `transaction_id`='" . $transaction_id . "',  `id_cabang`='" . $id_cabang . "',
                    `tgl_transaction`='" . $tgl_transaction . "', `bank_code`='" . $bank_code . "', `id_customer`='" . $id_customer . "',
                    `nama_acc`='" . $nama_acc . "', `acc_credit`='" . $acc_credit . "', `mu`='" . $mu . "', `rate`='" . $rate . "',
                    `total`='" . $total . "', `remarks`='" . $remarks . "', 
                    `date_upd` = NOW(), `user_upd`= '" . $loggedin["username"] . "'
                    WHERE (`id_bankmasuk`='" . $id_bankmasuk . "');";
                mysql_query($sql_update, $conn) or die (mysql_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update);

                echo "<script language='JavaScript'>
                        alert('Data telah diupdate.');
                        window.location.href='master_bankmasuk.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }

        }

        if (isset($_GET["id"])) {
            $id_bankmasuk = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_bankmasuk = "SELECT * FROM `gx_bank_masuk` WHERE `id_cabang` = '" . $loggedin['cabang'] . "' AND `id_bankmasuk`='" . $id_bankmasuk . "' LIMIT 0,1;";
            $sql_bankmasuk = mysql_query($query_bankmasuk, $conn);
            $row_bankmasuk = mysql_fetch_array($sql_bankmasuk);

        }

        $sql_cabang = mysql_query("SELECT `gx_cabang`.`kode_cabang`, `gx_cabang`.`kode_bm` FROM `gx_cabang`, `gx_pegawai`
			WHERE `gx_cabang`.`id_cabang` = `gx_pegawai`.`id_cabang`
			AND `gx_pegawai`.`id_employee` = '" . $loggedin["id_employee"] . "' LIMIT 0,1;", $conn);
        $row_cabang = mysql_fetch_array($sql_cabang);

        $sql_last_data = mysql_fetch_array(mysql_query("SELECT COUNT(`id_bankmasuk`) as `total` FROM `gx_bank_masuk` WHERE `transaction_id` LIKE '%" . date("ymd") . "%';", $conn));
        $last_data = $sql_last_data["total"] + 1;
        $tanggal = date("ymd");
        $kode_data = $row_cabang["kode_bm"] . '' . $tanggal . '' . sprintf("%03d", $last_data);

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Bank Masuk</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form action="" role="form" name="form_bm" id="form_bm" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Nomer Transaksi</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" id="transaction_id" name="transaction_id" required="" value="' . (isset($_GET['id']) ? $row_bankmasuk["transaction_id"] : $kode_data) . '">
                                                <input type="hidden" name="id_bankmasuk" value="' . (isset($_GET['id']) ? $row_bankmasuk["id_bankmasuk"] : "") . '">
                                                <input type="hidden" class="form-control" required="" id="id_cabang" name="id_cabang" value="' . (isset($_GET['id']) ? $row_bankmasuk["id_cabang"] : $loggedin["cabang"]) . '" >
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Tanggal</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" id="tgl_transaction" name="tgl_transaction" required="" value="' . (isset($_GET['id']) ? $row_bankmasuk["tgl_transaction"] : date("Y-m-d")) . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Kode Bank</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" name="kode_bank" value="' . (isset($_GET['id']) ? $row_bankmasuk["bank_code"] : "") . '"
                                                placeholder="Search Bank" onclick="return valideopenerform(\'data_bank.php?r=form_bm&f=bm\',\'bm\');">
                                            
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Kode Customer</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" name="id_customer" placeholder="Kode Customer" onclick="return valideopenerform(\'data_cust.php?r=form_bm&f=bm\',\'bm\');"
                                                value="' . (isset($_GET['id']) ? $row_bankmasuk["id_customer"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3"></div>
                                            <div class="col-xs-3"></div>
                                            <div class="col-xs-3">
                                                <label>Nama Customer</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" name="nama" placeholder="Nama Customer" onclick="return valideopenerform(\'data_cust.php?r=form_bm&f=bm\',\'bm\');"
                                                value="' . (isset($_GET['id']) ? $row_bankmasuk["nama"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>ACC Kredit</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control"  name="acc_bank" value="' . (isset($_GET['id']) ? $row_bankmasuk["acc_credit"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" required="" name="nama_acc" value="' . (isset($_GET['id']) ? $row_bankmasuk["nama_acc"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>MU</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select name="mu" class="form-control">';

        $sql_mu = mysql_query("SELECT * FROM `gx_matauang`;", $conn);
        while ($row_mu = mysql_fetch_array($sql_mu)) {
            $content .= '<option value="' . $row_mu["kode_matauang"] . '" ' . ((isset($_GET['id']) AND ($row_bankmasuk["mu"] == $row_mu["kode_matauang"])) ? 'selected=""' : "") . '>' . $row_mu["kode_matauang"] . '</option>';
        }

        $content .= '
						                        </select>
					                        </div>        
					                        <div class="col-xs-3">
                                                <label>Rate</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control"  name="rate" value="' . (isset($_GET['id']) ? $row_bankmasuk["rate"] : "") . '">
                                            </div>
                                        </div>
					                </div>
					                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Remarks</label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control"  name="remarks" value="' . (isset($_GET['id']) ? $row_bankmasuk["remarks"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Created By</label>
                                            </div>
                                            <div class="col-xs-6">
                                                ' . (isset($_GET['id']) ? $row_bankmasuk["user_add"] : $loggedin["username"]) . '
                                            </div>       
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Latest Updated By </label>
                                            </div>
                                            <div class="col-xs-6">
                                                ' . (isset($_GET['id']) ? $row_bankmasuk["user_upd"] . " " . $row_bankmasuk["date_upd"] : "") . '
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

        $plugins = '';

        $title = 'Form Bank Masuk';
        $submenu = "bank_masuk";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>