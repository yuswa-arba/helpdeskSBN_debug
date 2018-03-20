<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../config/configuration_admin.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in
    if ($loggedin["group"] == 'admin') {
        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Profile"); // insert log open profile in newfunctions2.php
        global $conn;

        $sql_profile = mysql_query("SELECT * FROM `gx_pegawai` WHERE `id_employee` = '" . $loggedin["id_employee"] . "' AND `level` = '0' LIMIT 0,1;", $conn);
        $row_profile = mysql_fetch_array($sql_profile);

        $content = '<!-- Main content -->
        <section class="content">
		    <div class="row">
                <section class="col-lg-7"> 
                    <div class="box box-solid box-info">
                        <div class="box-header">
                            <h3 class="box-title">Profile </h3>
                        </div>
                        <div class="box-body">
                            <div class="box-body no-padding">
                                <table class="table no-border" width="70%">
                                    <tr>
                                        <td rowspan="8"></td>
                                        <td>Nama </td>
                                        <td>' . $row_profile["nama"] . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Alamat</td>
                                        <td>' . $row_profile["alamat"] . '<br>
                                        <br></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                    </tr>
                                    
                                    <tr>
                                        <td>No. Telpon</td>
                                        <td></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Fax</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Perusahaan</td>
                                        <td></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>User Id</td>
                                        <td></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Email</td>
                                        <td>' . $row_profile["email"] . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div>
                </section>
		    </div>
		</section><!-- /.content -->';

        $title = 'Profile';
        $submenu = "profile";
        $plugins = '';
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];
        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>