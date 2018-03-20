<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include("../../config/configuration_admin.php");
include("../../config/configuration_tv.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master channel"); // for create log in newfunction2.php

        global $conn;
        $conn_ott = DB_TV();

        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        $content = '
            <!-- Main content -->
			<form action="" role="form" name="form_channel" id="form_channel" method="post" enctype="multipart/form-data">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body">
                                    <a href="form_channel.php" class="btn bg-maroon btn-flat margin">Add New</a>
                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
		            <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="3%">No.</th>
                                                <th>Channel Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $sql_data = mysqli_query($conn_ott, "SELECT * FROM `ott_livechannel` LIMIT $start, $perhalaman;");
        $sql_total_data = mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `ott_livechannel`;"));

        $hal = "?";
        $no = $start + 1;

        while ($row_data = mysqli_fetch_array($sql_data)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $row_data["channelName"] . '</td>
                </tr>';
            $no++;
        }

        $content .= '
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="box-footer">
                                    <div class="box-tools pull-right">
                                        ' . (halaman($sql_total_data, $perhalaman, 1, $hal)) . '
                                    </div>
                                    <br style="clear:both;">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>';

        if (isset($_POST["hapus"])) {
            $id_channel = array();
            $id_channel = isset($_POST["channelId"]) ? $_POST["channelId"] : $id_channel;

            foreach ($id_channel as $key => $value) {
                $sql_delete = "DELETE FROM `ott_livechannel` WHERE `channelId`= '" . $value . "';";
                mysqli_query($conn_ott, $sql_delete) or die (mysqli_error());

                enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_delete); // for create log in newfunction2.php
            }
            header('location: ' . URL_ADMIN . 'live/channel.php');
        }

        $plugins = '<link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = 'Live Channel';
        $submenu = "live_channel";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;

    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>