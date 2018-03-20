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

        /** ====================================================================
         * Mengambil data yang akan ditampilkan sesuai dengan id yang ada di url
         * =================================================================== */
        if (isset($_GET["id"])) {
            $cKode = isset($_GET['id']) ? strip_tags(trim($_GET['id'])) : '';
            $query_customer = "SELECT * FROM `tbCustomer` WHERE `cKode`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_customer = mysql_query($query_customer, $conn);
            $row_customer = mysql_fetch_array($sql_customer);

            $query_paket = "SELECT * FROM `gx_paket2` WHERE `kode_paket`='" . $row_customer["cKdPaket"] . "' AND `level` = '0' LIMIT 0,1;";
            $sql_paket = mysql_query($query_paket, $conn);
            $row_paket = mysql_fetch_array($sql_paket);

            $query_promosi = "SELECT * FROM `gx_duta_promosi` WHERE `kode_customer`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_promosi = mysql_query($query_promosi, $conn);
            $row_promosi = mysql_fetch_array($sql_promosi);

            $query_login = "SELECT `username` FROM `gxLogin` WHERE `customer_number`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_login = mysql_query($query_login, $conn);
            $row_login = mysql_fetch_array($sql_login);

            $query_foto = "SELECT * FROM `gxFoto_Profile` WHERE `cKode`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_foto = mysql_query($query_foto, $conn);
            $row_foto = mysql_fetch_array($sql_foto);

            $query_foto2 = "SELECT * FROM `gx_file_customer` WHERE `id_customer`='" . $cKode . "' AND `level` = '0' ORDER BY `date_add` DESC LIMIT 0,1;";
            $sql_foto2 = mysql_query($query_foto2, $conn);
            $row_foto2 = mysql_fetch_array($sql_foto2);

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "view detail customer id=$cKode");
        } else {
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "detail customer");
        }


        $content = '
            <section class="content-header">
                <h1>
                    Master Customer
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <section class="col-lg-12"> 
                        <div class="box box-solid box-info">
                            <div class="box-header">
                                <h3 class="box-title">Resume Customer</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>Detail Paket</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="" onclick="return valideopenerform(\'' . URL_ADMIN . 'master/detail_paket.php?id=' . $row_paket["id_paket"] . '\',\'detail paket\');">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>Link Budget</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>History SPK Pasang</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                                    
                                <div class="form-group">
                                   <div class="row">
                                       <div class="col-xs-4">
                                        <label>History SPK Aktivasi</label>
                                       </div>
                                       <div class="col-xs-8">
                                        <a href="">Lihat</a>
                                       </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>History Aktivasi</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>History Invoice</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>History Payment</label>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </section>
                </div>
            </section><!-- /.content -->';

        $plugins = '
            <!-- Colorbox -->
            <link media="screen" rel="stylesheet" type="text/css" href="' . URL . 'js/colorbox/example1/colorbox.css" />
            <script src="' . URL . 'js/colorbox/jquery.colorbox.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    //Examples of how to assign the ColorBox event to elements
                    $(".lightbox").colorbox({width:"75%", height:"75%"});
                });
            </script>';

        $title = 'Detail Customer';
        $submenu = "master_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>