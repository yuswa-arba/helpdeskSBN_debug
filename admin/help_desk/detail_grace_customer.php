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
        global $conn_voip;

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
												<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="' . (isset($_GET['id']) ? $row_grace_customer["nama_cabang"] : "") . '">
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
												<input type="text" class="form-control" readonly="" required="" name="kode_customer" id="kode_customer" value="' . (isset($_GET['id']) ? $row_grace_customer["kode_customer"] : '') . '">
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
												<input type="text" class="form-control" readonly="" required="" name="jumlah_hari" id="jumlah_hari" value="' . (isset($_GET['id']) ? $row_grace_customer["jumlah_hari"] : '') . '">
											</div>
											
											<div class="col-xs-2">
												<label>Blokir Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" required="" name="blokir_tanggal" id="blokir_tanggal" value="' . (isset($_GET['id']) ? $row_grace_customer["blokir_tanggal"] : '') . '">
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
                     $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
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