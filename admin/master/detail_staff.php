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

    if ($loggedin["group"] == 'admin') {

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Profile"); // for create log

        global $conn;

        $id_staff = isset($_GET['id']) ? (int)$_GET['id'] : '';
        $sql_staff = mysql_query("SELECT * FROM `gx_pegawai` WHERE `id_employee` = '" . $id_staff . "' AND `level` = '0' LIMIT 0,1;", $conn);
        $row_staff = mysql_fetch_array($sql_staff);

        $sql_foto = mysql_query("SELECT * FROM `gxFoto_Profile` WHERE `id_employee` = '" . $row_staff["kode_pegawai"] . "' AND `level` = '0' LIMIT 0,1;", $conn);
        $row_foto = mysql_fetch_array($sql_foto);

        $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $row_staff["id_cabang"] . "' AND `level` = '0';", $conn);
        $row_cabang = mysql_fetch_array($sql_cabang);


        $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Profile </h3>
                                </div>
                                
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Kode Staff</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["kode_pegawai"] . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["nama"] . '						
                                            </div>
                                        </div>
                                    </div>
                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["alamat"] . '
                                            </div>
                                        </div>
                                    </div>
                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Email Address</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["email"] . '
                                            </div>
                                        </div>
                                    </div>
                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Phone Number</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["hp"] . '
                                            </div>
                                        </div>
                                    </div>
                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Ext. VOIP</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["ext_voip"] . '
                                            </div>
                                        </div>
                                    </div>
                                           
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Port Office</label>
                                            </div>
                                            <div class="col-xs-8">
                                               ' . $row_cabang["nama_cabang"] . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Department</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["id_bagian"] . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Tanggal Masuk</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . date("d-m-Y", strtotime($row_staff["tgl_masuk"])) . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-xs-8">
                                                ' . $row_staff["status"] . '
                                            </div>
                                        </div>
                                    </div>
				   
				                </div><!-- /.box-body -->
			                </div>
			            </section>
                        <section class="col-lg-3"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Photo</h3>
                                </div>
                            <div class="box-body">
                                <img src="' . URL_ADMIN . 'img/staff/' . (($row_foto['file_foto'] != "") ? $row_foto['file_foto'] : "nophoto.jpg") . '" style="width:80%;" class="profile-user-img img-responsive img-square" alt="User Image" />
                                <h3 class="profile-username text-center">' . $row_staff["nama"] . '</h3>
                                <p class="text-muted text-center">' . $row_staff["id_bagian"] . '</p>
                            </div>
                        </div>
                    </section>
                </div>
            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Detail Staff';
        $submenu = "master_staff";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);// mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>