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

        if (isset($_GET["id"])) {

            $id_upgrade_downgrade = isset($_GET['id']) ? (int)$_GET['id'] : ''; // for create log in newfunction2.php

            $query_upgrade_downgrade = "SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection` WHERE `id_upgrade_downgrade_connection`='$id_upgrade_downgrade' LIMIT 0,1;";
            $sql_upgrade_downgrade = mysql_query($query_upgrade_downgrade, $conn);
            $row_upgrade_downgrade = mysql_fetch_array($sql_upgrade_downgrade);

            $sql_cabang = mysql_query("SELECT * FROM `gx_cabang`
                WHERE `gx_cabang`.`id_cabang` = '$row_upgrade_downgrade[kode_cabang]';", $conn);
            $row_cabang = mysql_fetch_array($sql_cabang);

            $hari = $row_upgrade_downgrade["tanggal"];
            $e1 = explode("-", $hari);
            $tgl = $e1[2];
            $bln = $e1[1];
            $thn = $e1[0];

            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
            $hari_ini = $tgl;
            $sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini; //baru
            $total_hari_pengurangan = $jumlah_hari - $sum_aktivasi_sd_akhirbulan; //lama
            //Invoice Lama
            $sql_paket_lama = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`kode_paket` = '$row_upgrade_downgrade[kode_paket_lama]';", $conn);
            $row_paket_lama = mysql_fetch_array($sql_paket_lama);

            $tagihanperhari_lama = $row_paket_lama["monthly_fee"] / $jumlah_hari;
            $total_tagihan_lama = $total_hari_pengurangan * $tagihanperhari_lama;
            $ppn_lama = 10 / 100 * $total_tagihan_lama;
            $totalppn_lama = $total_tagihan_lama + $ppn_lama;
            //---------------//

            //Invoice Baru
            $sql_paket_baru = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`kode_paket` = '$row_upgrade_downgrade[kode_paket_baru]';", $conn);
            $row_paket_baru = mysql_fetch_array($sql_paket_baru);

            $tagihanperhari_baru = $row_paket_baru["monthly_fee"] / $jumlah_hari;
            $total_tagihan_baru = $sum_aktivasi_sd_akhirbulan * $tagihanperhari_baru;
            $ppn_baru = 10 / 100 * $total_tagihan_baru;
            $totalppn_baru = $total_tagihan_baru + $ppn_baru;
            //---------------//
        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form Upgrade Downgrade Connection</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                <div class="box-body">
									<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Cabang</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly=""  name="nama_cabang" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["nama_cabang"] : "") . '" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=updown_connection\',\'cabang\');">
                                                <input type="hidden" class="form-control" name="kode_cabang" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["kode_cabang"] : "") . '">
                                            </div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker"  readonly="" id="tanggal" name="tanggal" required="" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["tanggal"] : date("Y-m-d")) . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Upgrade Downgrade</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_upgrade_downgrade" name="kode_upgrade_downgrade" required="" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["kode_upgrade_downgrade"] : "") . '" onclick="return valideopenerform(\'data_customer.php?r=myForm&f=updown_connection\',\'customer\');">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["kode_customer"] : "") . '" onclick="return valideopenerform(\'data_customer.php?r=myForm&f=updown_connection\',\'customer\');" >
											</div>
										</div>
									</div> 
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["nama_customer"] : "") . '">
											</div>
															
											<div class="col-xs-3">
												<label>UID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["uid"] : "") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Lama</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket_lama" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["kode_paket_lama"] : "") . '">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_lama" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["nama_paket_lama"] : "") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Baru</label>
											</div>
                                            <div class="col-xs-3">
				                            	<input type="text" class="form-control" readonly="" name="kode_paket_baru" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["kode_paket_baru"] : "") . '" onclick="return valideopenerform(\'data_paket.php?r=myForm&f=updown_connection\',\'paket\');">
				                            </div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_baru" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["nama_paket_baru"] : "") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Group RBS</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" name="group_rbs" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["group_rbs"] : "") . '">
											</div>
															
											<div class="col-xs-3">
											<label>No Formulir</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="kode_formulir" value="' . (isset($_GET['id']) ? $row_upgrade_downgrade["kode_formulir"] : "") . '" onclick="return valideopenerform(\'data_formulir.php?r=myForm&f=updown_connection\',\'formulir\');">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Foto Formulir</label>
											</div>
											<div class="col-xs-9">
												<input name="file" type="file" id="file"/>';

        if (isset($_GET["id"])) {
            $sql_data = mysql_query("SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection_upload` WHERE `level` =  '0' AND `kode_upgrade_downgrade_connection` = '" . $row_upgrade_downgrade["kode_upgrade_downgrade"] . "'  ORDER BY `id_upload` DESC;", $conn);

            while ($row_data = mysql_fetch_array($sql_data)) {
                $content .= '
                    <div class="abcd" style="float: left;">
                        <input type="hidden" name="id_foto" value="'. $row_data["id_upload"] .'">
                        <img src="' . $row_data["lokasi_file"] . $row_data["nama_file"] . '">
                    </div>';
            }
        }

        $content .= '
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3" align="center">
												<label> </label>
											</div>
											<div class="col-xs-7" align="center">
												<label>PERHITUNGAN INVOICE</label>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3" align="center">
												<label> </label>
											</div>
											<div class="col-xs-4" align="center">
												<label>INVOICE LAMA</label>
											</div>
											<div class="col-xs-4" align="center">
												<label>INVOICE BARU</label>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="monthly_lama" value="' . (isset($_GET['id']) ? number_format($row_paket_lama["monthly_fee"], 2) : "0") . '">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="monthly_baru" value="' . (isset($_GET['id']) ? number_format($row_paket_baru["monthly_fee"], 2) : "0") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tagihan Perhari</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="daily_lama" value="' . (isset($_GET['id']) ? number_format($tagihanperhari_lama, 2) : "0") . '">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="daily_baru" value="' . (isset($_GET['id']) ? number_format($tagihanperhari_baru, 2) : "0") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>jumlah Hari Aktivasi</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="hari_aktivasi_lama" value="' . (isset($_GET['id']) ? $total_hari_pengurangan : "0") . '">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="hari_aktivasi_baru" value="' . (isset($_GET['id']) ? $sum_aktivasi_sd_akhirbulan : "0") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Total Tagihan Prorate</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="total_lama" value="' . (isset($_GET['id']) ? number_format($total_tagihan_lama, 2) : "0") . '">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="total_baru" value="' . (isset($_GET['id']) ? number_format($total_tagihan_baru, 2) : "0") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>PPN</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="ppn_lama" value="' . (isset($_GET['id']) ? number_format($ppn_lama, 2) : "0") . '">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="ppn_baru" value="' . (isset($_GET['id']) ? number_format($ppn_baru, 2) : "0") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Total Tagihan + PPN</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="totalppn_lama" value="' . (isset($_GET['id']) ? number_format($totalppn_lama, 2) : "0") . '">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly=""  class="form-control" name="totalppn_baru" value="' . (isset($_GET['id']) ? number_format($totalppn_baru, 2) : "0") . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												' . (isset($_GET['id']) ? $row_upgrade_downgrade["user_add"] : $loggedin["username"]) . '
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Lates Update By </label>
											</div>
											<div class="col-xs-6">
												' . (isset($_GET['id']) ? $row_upgrade_downgrade["user_upd"] . " " . $row_upgrade_downgrade["date_upd"] : "") . '
											</div>
										</div>
									</div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <a href="' . URL_ADMIN . 'help_desk/master_updown_connection.php" class="btn btn-default">Back</a> &nbsp;
                                    <button type="submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        if (isset($_POST["save"])) {
            $sql_upgrade_downgrade_connection = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection` ORDER BY `id_upgrade_downgrade_connection` DESC", $conn));
            $last_data = $sql_upgrade_downgrade_connection["id_upgrade_downgrade_connection"] + 1;

            //echo "save";
            $kode_cabang = isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
            $nama_cabang = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';

            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
            $kode_upgrade_downgrade = isset($_POST['kode_upgrade_downgrade']) ? mysql_real_escape_string(trim($_POST['kode_upgrade_downgrade'])) : '';
            $kode_customer = isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $uid = isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';

            $kode_paket_lama = isset($_POST['kode_paket_lama']) ? mysql_real_escape_string(trim($_POST['kode_paket_lama'])) : '';
            $nama_paket_lama = isset($_POST['nama_paket_lama']) ? mysql_real_escape_string(trim($_POST['nama_paket_lama'])) : '';
            $kode_paket_baru = isset($_POST['kode_paket_baru']) ? mysql_real_escape_string(trim($_POST['kode_paket_baru'])) : '';
            $nama_paket_baru = isset($_POST['nama_paket_baru']) ? mysql_real_escape_string(trim($_POST['nama_paket_baru'])) : '';

            $totalppn_lama2 = isset($_POST['totalppn_lama']) ? str_replace(",", "", $_POST['totalppn_lama']) : '';
            $totalppn_baru2 = isset($_POST['totalppn_baru']) ? str_replace(",", "", $_POST['totalppn_baru']) : '';

            $group_rbs = isset($_POST['group_rbs']) ? mysql_real_escape_string(trim($_POST['group_rbs'])) : '';
            $kode_formulir = isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';

            $j = 0;     // Variable for indexing uploaded image.
            $target_path = "../upload/upgrade_downgrade/";     // Declaring Path for uploaded images.
            $lokasi = 'upload/upgrade_downgrade/';

            if ($kode_upgrade_downgrade != "" AND $kode_customer != "" AND $kode_paket_baru != "") {
                $sql_insert = "INSERT INTO `gx_helpdesk_upgrade_downgrade_connection` (`id_upgrade_downgrade_connection`, `kode_cabang`, `nama_cabang`,
					`tanggal`, `kode_upgrade_downgrade`, `kode_customer`, `nama_customer`, `uid`, `kode_paket_lama`,
					`nama_paket_lama`, `kode_paket_baru`, `nama_paket_baru`, `group_rbs`, `kode_formulir`,
					`user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					VALUES ('', '" . $kode_cabang . "', '" . $nama_cabang . "',
					'" . $tanggal . "', '" . $kode_upgrade_downgrade . "', '" . $kode_customer . "', '" . $nama_customer . "', '" . $uid . "', '" . $kode_paket_lama . "',
					'" . $nama_paket_lama . "', '" . $kode_paket_baru . "', '" . $nama_paket_baru . "', '" . $group_rbs . "', '" . $kode_formulir . "',
					'" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(), '0');";
                mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                           window.history.go(-1);
                                                         </script>");

                $sql_update_customer = "UPDATE `tbCustomer` SET `cKdPaket` = '" . $kode_paket_baru . "', `cPaket` = '" . $nama_paket_baru . "'
		            WHERE `cKode` = '" . $kode_customer . "';";
                mysql_query($sql_update_customer, $conn);

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert); // for create log in newfunction2.php

                $validextensions = array("jpeg", "jpg", "png"); // Extensions which are allowed
                $RandomNumber = rand(0, 9999999999); // for create name file upload
                $img_name = $RandomNumber . "-" . ($_FILES['file']['name']);

                $ext = explode('.', basename($_FILES['file']['name'])); // Explode file name from dot(.)
                $file_extensions = end($ext); // Store extensions in the variable.

                if (($_FILES["file"]["size"] < 5000000) // Approx. 5Mb files can be uploaded.
                    && in_array($file_extensions, $validextensions)
                ) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path . $img_name)) {
                        $sql_insert_file = "INSERT INTO `gx_helpdesk_upgrade_downgrade_connection_upload`
                            (`id_upload`,`kode_upgrade_downgrade_connection`,`nama_file`,`lokasi_file`,`user_add`,`user_upd`,`date_add`,`date_upd`,`level`)
                            VALUES (NULL,'$kode_upgrade_downgrade','$img_name','$target_path','$loggedin[username]','$loggedin[username]',NOW(),NOW(),'0')";
                        mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
                                                                         alert('Maaf Data tidak bisa diupload ke dalam Database, Ada kesalahan!');
                                                                         window.history.go(-1);
                                                                      </script>");
                    } else { // If File Was Not Moved.
                        echo "<script language='JavaScript'>
								alert('File Was Not Moved.');
								window.history.go(-1);
							  </script>";
                    }
                } else {  // If File Was Not Moved.
                    echo "";
                }

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='" . URL_ADMIN . "help_desk/master_updown_connection.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        } elseif (isset($_POST["update"])) {
            $id_foto = isset($_POST['id_foto']) ? mysql_real_escape_string(trim($_POST['id_foto'])) : '';

            $kode_cabang = isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
            $nama_cabang = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';

            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
            $kode_upgrade_downgrade = isset($_POST['kode_upgrade_downgrade']) ? mysql_real_escape_string(trim($_POST['kode_upgrade_downgrade'])) : '';
            $kode_customer = isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $uid = isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';

            $kode_paket_lama = isset($_POST['kode_paket_lama']) ? mysql_real_escape_string(trim($_POST['kode_paket_lama'])) : '';
            $nama_paket_lama = isset($_POST['nama_paket_lama']) ? mysql_real_escape_string(trim($_POST['nama_paket_lama'])) : '';
            $kode_paket_baru = isset($_POST['kode_paket_baru']) ? mysql_real_escape_string(trim($_POST['kode_paket_baru'])) : '';
            $nama_paket_baru = isset($_POST['nama_paket_baru']) ? mysql_real_escape_string(trim($_POST['nama_paket_baru'])) : '';

            $totalppn_lama2 = isset($_POST['totalppn_lama']) ? str_replace(",", "", $_POST['totalppn_lama']) : '';
            $totalppn_baru2 = isset($_POST['totalppn_baru']) ? str_replace(",", "", $_POST['totalppn_baru']) : '';

            $group_rbs = isset($_POST['group_rbs']) ? mysql_real_escape_string(trim($_POST['group_rbs'])) : '';
            $kode_formulir = isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';

            $j = 0;     // Variable for indexing uploaded image.
            $target_path = "../upload/upgrade_downgrade/";     // Declaring Path for uploaded images.
            $lokasi = 'upload/upgrade_downgrade/';

            if ($kode_upgrade_downgrade != "" AND $kode_customer != "" AND $kode_paket_baru != "") {
                $sql_insert = "UPDATE `gx_helpdesk_upgrade_downgrade_connection` SET `kode_cabang` = '" . $kode_cabang . "',
                    `nama_cabang` = '" . $nama_cabang . "', `tanggal` = '" . $tanggal . "', `kode_customer` = '" . $kode_customer . "', 
                    `nama_customer` = '" . $nama_customer . "', `uid` = '" . $uid . "', `kode_paket_lama` = '" . $kode_paket_lama . "',
					`nama_paket_lama` = '" . $nama_paket_lama . "', `kode_paket_baru` = '" . $kode_paket_baru . "', `nama_paket_baru` = '" . $nama_paket_baru . "', 
					`group_rbs` = '" . $group_rbs . "', `kode_formulir` = '" . $kode_formulir . "', `user_add` = '" . $loggedin["username"] . "', `user_upd` = '" . $loggedin["username"] . "', 
					`date_add` = '" . $row_upgrade_downgrade["tanggal"] . "', `date_upd` = NOW(),  `level` = '0'
					WHERE (`kode_upgrade_downgrade` = '" . $kode_upgrade_downgrade . "');";

                mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                           alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                           window.history.go(-1);
                                                         </script>");

                $sql_update_customer = "UPDATE `tbCustomer` SET `cKdPaket` = '" . $kode_paket_baru . "', `cPaket` = '" . $nama_paket_baru . "'
		            WHERE `cKode` = '" . $kode_customer . "';";
                mysql_query($sql_update_customer, $conn);

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert); // for create log in newfunction2.php


                $validextensions = array("jpeg", "jpg", "png"); // Extensions which are allowed
                $RandomNumber = rand(0, 9999999999); // for create name file upload
                $img_name = $RandomNumber . "-" . ($_FILES['file']['name']);

                $ext = explode('.', basename($_FILES['file']['name'])); // Explode file name from dot(.)
                $file_extensions = end($ext); // Store extensions in the variable.

                if (($_FILES["file"]["size"] < 5000000) // Approx. 5Mb files can be uploaded.
                    && in_array($file_extensions, $validextensions)
                ) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path . $img_name)) {
                        $sql_insert_file = "UPDATE `gx_helpdesk_upgrade_downgrade_connection_upload` SET 
                            `kode_upgrade_downgrade_connection` = '$kode_upgrade_downgrade', `nama_file` = '$img_name', 
                            `lokasi_file` = '$target_path', `user_add` = '$loggedin[username]', `user_upd` = '$loggedin[username]', 
                            `date_add` = NOW(),`date_upd` = NOW(),`level` = '0'
                            WHERE `id_upload` = '$id_foto';";
                        mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
                                                                            alert('Maaf Data tidak bisa diupload ke dalam Database, Ada kesalahan!');
                                                                            window.history.go(-1);
                                                                          </script>");
                    } else { // If File Was Not Moved.
                        echo "<script language='JavaScript'>
									alert('File tidak dapat dipindahkan');
									window.history.go(-1);
							      </script>";
                    }
                    echo $nama_customer;
                } else {  // If File Was Not Moved.
                    echo "";
                }
                echo "<script language='JavaScript'>
                        alert('Data telah diubah');
                        window.location.href='" . URL_ADMIN . "help_desk/master_updown_connection.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diubah, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        $plugins = '
            <!-- datepicker -->
            <script src="' . URL . 'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
            
            <script>
                $(function() {
                    $("#tanggal").datepicker({
                        format: "yyyy-mm-dd",
                        autoclose: true
                    });
                });
            </script>
            
            <script src="' . URL . 'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
            
            <script>
                $(\'[id=harga]\').priceFormat({
                    prefix: \'\',
                    thousandsSeparator: \',\',
                    centsLimit: 0
                });
            </script>
            
            <script language="javascript">
                var abc = 0;      // Declaring and defining global increment variable.
                $(document).ready(function() {
                    
                    // Following function will executes on change event of file input to select different file.
                    $(\'body\').on(\'change\', \'#file\', function() {
                        if (this.files[0]) {
                            abc += 1; // Incrementing global variable by 1.
                            var x = $(this).parent().find(\'#previewimg\').remove();
                            $(this).before("<div id=\'abcd" + abc + "\' class=\'abcd\'><img id=\'previewimg" + abc + "\' src=\'\'/></div>");
                            var reader = new FileReader();
                            reader.onload = imageIsLoaded;
                            reader.readAsDataURL(this.files[0]);
                            $("#abcd" + abc).append($("<img/>", {
                                id: \'img\',
                                src: \'' . URL_ADMIN . 'img/x.png\'
                            }).click(function() {
                                $(this).parent().remove();
                            }));
                        }
                    });
                    
                    // To Preview Image
                    function imageIsLoaded(e) {
                        $(\'#previewimg\' + abc).attr(\'src\', e.target.result);
                    };
                    $(\'#upload\').click(function(e) {
                        var name = $(":file").val();
                        if (!name) {
                            alert("First Image Must Be Selected");
                            e.preventDefault();
                        }
                    });
                });
            </script>
            
            <style type="text/css">
                #img{
                    width:25px;
                    border:none;
                    height:25px;
                    margin-left:-20px;
                    margin-bottom:91px
                }
                .abcd{
                    width: 120px;
                    float:left;
                }
                .abcd img{
                    height:100px;
                    width:100px;
                    padding:5px;
                    border:1px solid #e8debd
                }
            </style>';

        $title = 'Form Upgrade Downgrade Connection';
        $submenu = "upgrade_downgrade";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>