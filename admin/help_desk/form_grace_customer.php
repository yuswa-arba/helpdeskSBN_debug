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
		$conn_soft = Config::getInstanceSoft();

        if (isset($_POST["save"])) {
            $kode_cabang = isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
            $nama_cabang = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
            $kode_grace = isset($_POST['kode_grace']) ? mysql_real_escape_string(trim($_POST['kode_grace'])) : '';
            $kode_customer = isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $uid = isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
            $jumlah_hari = isset($_POST['jumlah_hari']) ? mysql_real_escape_string(trim($_POST['jumlah_hari'])) : '';
            $blokir_tanggal = isset($_POST['blokir_tanggal']) ? mysql_real_escape_string(trim($_POST['blokir_tanggal'])) : '';

            if ($kode_grace != "" && $jumlah_hari != "" && $blokir_tanggal != "") {
                //insert into cc_subscription_service
                $sql_insert = "INSERT INTO `gx_helpdesk_grace`(`id_grace_customer`, `kode_grace`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_customer`, `nama_customer`, `uid`, `jumlah_hari`, `blokir_tanggal`,
     				`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				    VALUES ('', '" . $kode_grace . "', '" . $kode_cabang . "', '" . $nama_cabang . "', '" . $tanggal . "', '" . $kode_customer . "', '" . $nama_customer . "', '" . $uid . "', '" . $jumlah_hari . "', '" . $blokir_tanggal . "',
					'" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(), '0');";
                echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                                alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                                                                window.history.go(-1);
                                                              </script>");

                $sql_customer = mysql_query("SELECT `iuserIndex` FROM `tbCustomer`, `gx_paket2`
					WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
					AND `tbCustomer`.`cUserID` = '" . $uid . "'
					AND `gx_paket2`.`level` =  '0';", $conn);
                $row_customer = mysql_fetch_array($sql_customer);

                $sql_data = $conn_soft->prepare("UPDATE TOP(1) [dbo].[Users] SET [GracePeriodExpiration] = '" . date("Y-m-d 00:00:00.000", strtotime($blokir_tanggal)) . "'
	                WHERE ([UserIndex]='" . trim($row_customer["iuserIndex"]) . "');");
                $sql_data->execute();

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_insert); // for create log in newfunction2.php

                echo "<script language='JavaScript'>
                        alert('Data telah disimpan');
                        window.location.href='master_grace_customer.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        } elseif (isset($_POST["update"])) {
            $kode_cabang = isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
            $nama_cabang = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
            $kode_grace = isset($_POST['kode_grace']) ? mysql_real_escape_string(trim($_POST['kode_grace'])) : '';
            $kode_customer = isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
            $nama_customer = isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
            $uid = isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
            $jumlah_hari = isset($_POST['jumlah_hari']) ? mysql_real_escape_string(trim($_POST['jumlah_hari'])) : '';
            $blokir_tanggal = isset($_POST['blokir_tanggal']) ? mysql_real_escape_string(trim($_POST['blokir_tanggal'])) : '';


            if ($kode_grace != "") {

                //Update into cc_subscription_service
                $sql_update = "UPDATE `gx_helpdesk_grace` SET `kode_customer`='" . $kode_customer . "',
                    `nama_customer`='" . $nama_customer . "', `uid`='" . $uid . "', `jumlah_hari`='" . $jumlah_hari . "', `blokir_tanggal`='" . $blokir_tanggal . "', `date_upd` = NOW(), `user_upd` = '" . $loggedin["username"] . "'
                    WHERE `kode_grace`='" . $kode_grace . "';";
                echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update); // for create log in newfunction2.php

                $sql_customer = mysql_query("SELECT `iuserIndex` FROM `tbCustomer`, `gx_paket2`
					WHERE `tbCustomer`.`cKdPaket` = `gx_paket2`.`kode_paket`
					AND `tbCustomer`.`cUserID` = '" . $uid . "'
					AND `gx_paket2`.`level` =  '0';", $conn);
                $row_customer = mysql_fetch_array($sql_customer);


                $sql_data = $conn_soft->prepare("UPDATE TOP(1) [dbo].[Users] SET [GracePeriodExpiration] = '" . date("Y-m-d 00:00:00.000", strtotime($blokir_tanggal)) . "'
	                WHERE ([UserIndex]='" . trim($row_customer["iuserIndex"]) . "');");
                $sql_data->execute();

                echo "<script language='JavaScript'>
                        alert('Data telah diupdate.');
                        window.location.href='master_grace_customer.php';
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
                        window.history.go(-1);
                      </script>";
            }
        }

        if (isset($_GET["id"])) {
            $id_grace_customer = isset($_GET['id']) ? $_GET['id'] : '';
            $query_grace_customer = "SELECT * FROM `gx_helpdesk_grace` WHERE `id_grace_customer` ='" . $id_grace_customer . "' LIMIT 0,1;";
            $sql_grace_customer = mysql_query($query_grace_customer, $conn);
            $row_grace_customer = mysql_fetch_array($sql_grace_customer);

        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <section class="col-lg-10"> 
                        <div class="box box-solid box-info">
                            <div class="box-header">
                                <h3 class="box-title">Grace Customer</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <form action="" role="form" name="form_grace_customer" id="form_grace_customer" method="post" enctype="multipart/form-data">
			    
                                <div class="box-body">
                                    <div class="form-group">
									    <div class="row">';

        if (isset($_GET["id"])) {
            $content .= ' 
                                            <div class="col-xs-2">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="' . (isset($_GET['id']) ? $row_grace_customer["nama_cabang"] : "") . '" >
												<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="' . (isset($_GET['id']) ? $row_grace_customer["kode_cabang"] : "") . '">
											</div>';
        } else {
            $content .= '
											<div class="col-xs-2">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="' . (isset($_GET['id']) ? $row_grace_customer["nama_cabang"] : "") . '" onclick="return valideopenerform(\'data_cabang.php?r=form_grace_customer&f=grace_customer\',\'cabang\');">
												<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="' . (isset($_GET['id']) ? $row_grace_customer["kode_cabang"] : "") . '">
											</div>';
        }
        $content .= '
											<div class="col-xs-2">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" required="" name="tanggal" value="' . (isset($_GET['id']) ? $row_grace_customer["tanggal"] : date("Y-m-d")) . '">
											</div>
										</div>
									</div>
									
                                    <div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>No Grace Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" required="" name="kode_grace" id="kode_grace" value="' . (isset($_GET['id']) ? $row_grace_customer["kode_grace"] : '') . '">
											</div>
					
											<div class="col-xs-2">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" required="" name="kode_customer" id="kode_customer" value="' . (isset($_GET['id']) ? $row_grace_customer["kode_customer"] : '') . '"   onclick="return valideopenerform(\'data_customer.php?r=form_grace_customer&f=grace_customer\',\'customer\');">
											</div>
										</div>
									</div>
					
									<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  required="" name="nama_customer" id="nama_customer" value="' . (isset($_GET['id']) ? $row_grace_customer["nama_customer"] : '') . '">
											</div>
											<div class="col-xs-2">
												<label>UID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  required="" name="uid" id="uid" value="' . (isset($_GET['id']) ? $row_grace_customer["uid"] : '') . '">
											</div>
					
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Jumlah Hari</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control"  required="" name="jumlah_hari" id="jumlah_hari" value="' . (isset($_GET['id']) ? $row_grace_customer["jumlah_hari"] : '') . '">
											</div>
											<div class="col-xs-2">
												<label>Blokir Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control"  readonly="" name="blokir_tanggal" id="datepicker" value="' . (isset($_GET['id']) ? $row_grace_customer["blokir_tanggal"] : '') . '">
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												' . (isset($_GET['id']) ? $row_grace_customer["user_add"] : $loggedin["username"]) . '
											</div>		
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Lates Update By </label>
											</div>
											<div class="col-xs-6">
												' . (isset($_GET['id']) ? $row_grace_customer["user_upd"] . " (" . $row_grace_customer["date_upd"] . ")" : "") . '
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
                    $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                });
            </script>';

        $title = 'Form Grace Customer';
        $submenu = "grace_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>