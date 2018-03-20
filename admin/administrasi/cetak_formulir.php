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

        enableLog("", $loggedin["username"], $loggedin["username"], "Cetak Formulir"); // for create log in database

        global $conn;

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="box">
                            <div class="box-body table-responsive">
								<div class="box-header">
									<h3 class="box-title">List Formulir</h3>
								</div><!-- /.box-header -->

								<form role="form" name="myForm" method="POST" action="" target="_blank">
									<div class="form-group">
									    <div class="row">
									    	<div class="col-xs-3">
									    	    <label>Cabang</label>
									    	</div>
									    	<div class="col-xs-6">
									    	    <input class="form-control" readonly="" type="text" id="nama_cabang" name="nama_cabang"
									    	    onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=cetakformulir\',\'cabang\');"  placeholder="cabang">
									    	    <input class="form-control" readonly="" type="hidden" id="cabang" name="cabang"  placeholder="cabang">
									    	</div>
									    </div>
									</div>
									
									<div class="form-group">
									    <div class="row">
									    	<div class="col-xs-3">
									    	    <label>Tanggal</label>
									    	</div>
									    	<div class="col-xs-6">
									    	    <input class="form-control" type="text" readonly="" name="tanggal" value="' . date("Y-m-d") . '" placeholder="tanggal">
									    	</div>
									    </div>
									</div>
									
									<div class="form-group">
									    <div class="row">
									    	<div class="col-xs-3">
									    	    <label>Kode Cetak Formulir</label>
									    	</div>
									    	<div class="col-xs-6">
									    	    <input type="text" class="form-control" readonly="" id="kode_cetak_formulir" name="kode_cetak_formulir" value="' . (isset($_GET['id']) ? $row_masterformulir["kode_cetak_formulir"] : "") . '">
									    	</div>
									    </div>
									</div>
									
									<table id="formulir" class="table table-bordered table-striped">
										<thead>
											<tr>
                                                <th>No</th>
                                                <th>Kode Formulir</th>
                                                <th>Nama Formulir</th>
                                                <th> # </th>
											</tr>
										</thead>
										<tbody>';

        $sql_masterformulir = mysql_query("SELECT * FROM `gx_formulir` WHERE `level` = '0';", $conn);
        $no = 1;
        while ($row_masterformulir = mysql_fetch_array($sql_masterformulir)) {
            $content .= '
                <tr>
					<td>' . $no . '</td>
					<td>' . $row_masterformulir['kode_formulir'] . '</td>
					<td>' . $row_masterformulir['nama_formulir'] . '</td>
					<td><input type="radio" name="id_formulir" value="' . $row_masterformulir["id_formulir"] . '"></td>
				</tr>';

            $no++;

        }

        $sql_masterformulir_detail = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '$row_masterformulir[id_formulir]' ORDER BY `date_add` DESC LIMIT 0,1;", $conn);
        $row_masterformulir_detail = mysql_fetch_array($sql_masterformulir_detail);
        $content .= '
												
										</tbody>
									</table>
									
									<input class="form_input_text" type="hidden" name="id" value="' . $row_masterformulir_detail["id"] . '">
									<input class="form_input_text" type="hidden" name="link" value="' . URL_ADMIN . '' . $row_masterformulir_detail["lokasi_file"] . '' . $row_masterformulir_detail["nama_file"] . '">
												
									<div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3"></div>
                                            <div class="col-xs-6">
                                                <button type="submit" value="Print" name="save" class="btn btn-primary btn-flat margin">Print</button>
                                                <a href="' . URL_ADMIN . 'administrasi/master_formulir" class="btn bg-olive btn-flat margin ">Cancel</a>
                                            </div>
                                        </div>
									</div>
								</form>
							</div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
               </div>
            </section><!-- /.content -->';

        if (isset($_POST["save"])) {

            $id_cabang = isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
            $kode_cetak = isset($_POST['kode_cetak_formulir']) ? mysql_real_escape_string(trim($_POST['kode_cetak_formulir'])) : '';
            $tanggal = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
            $id_formulir = isset($_POST['id_formulir']) ? mysql_real_escape_string(trim($_POST['id_formulir'])) : '';

            $sql_last_cetak = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cetak_formulir` ORDER BY `id_cetak_formulir` DESC", $conn));
            $last_data = $sql_last_cetak["id_cetak_formulir"] + 1;

            if ($id_formulir == "") {
                echo "
                    <script language='JavaScript'>
						alert('Maaf tidak ada data Formulir!');
						window.history.go(-1);
					</script>";
            } else {
                $sql_insert = "INSERT INTO `gx_cetak_formulir`(`id_cetak_formulir`, `id_cabang`, `kode_cetak_formulir`, `tanggal`,
					`id_formulir`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
					VALUES ('', '" . $id_cabang . "', '" . $kode_cetak . "', '" . $tanggal . "',
					'" . $id_formulir . "', '" . $loggedin["username"] . "', '" . $loggedin["username"] . "', NOW(), NOW(), '0');";
                mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
                                                               alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
                                                               window.history.go(-1);
                                                           </script>");

                echo header('location: print_form.php?id=' . $last_data . '');
            }


        }

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

        $title = 'Cetak Formulir';
        $submenu = "formulir";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>