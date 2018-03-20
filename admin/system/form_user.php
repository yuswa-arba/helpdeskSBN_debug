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

        if (isset($_POST["update"])) {
            $id_user = isset($_POST['id_user']) ? mysql_real_escape_string(trim($_POST['id_user'])) : '';
            $username = isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
            $new_pass = isset($_POST['new_pass']) ? mysql_real_escape_string(trim($_POST['new_pass'])) : '';
            $renew_pass = isset($_POST['renew_pass']) ? mysql_real_escape_string(trim($_POST['renew_pass'])) : '';

            $id_group = isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';


            //insert into gx_bagian
            $sql_update_user = "UPDATE `gxLogin_admin` SET `username` = '" . $username . "', 
                `password` = '" . md5($new_pass) . "', `password_date` = NOW(), `group` = '" . $id_group . "',
                `user_upd` = '" . $loggedin["username"] . "', `date_upd` = NOW()
                WHERE `id_user` = '" . $id_user . "';";
            mysql_query($sql_update_user, $conn) or die (mysql_error());

            enableLog("", $loggedin["username"], $loggedin["id_employee"], $sql_update_user);


            echo "<script language='JavaScript'>
                    alert('Data telah diupdate.');
                    window.location.href='" . URL_ADMIN . "system/user.php';
                  </script>";
        }

        if (isset($_GET["id"])) {
            $id_user = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_user = "SELECT * FROM `gxLogin_admin` WHERE `id_user`='$id_user' LIMIT 0,1;";
            $sql_user = mysql_query($query_user, $conn);
            $row_user = mysql_fetch_array($sql_user);


        }

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-9">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Form User</h3>
                            </div><!-- /.box-header -->
                            
                            <!-- form start -->
                            <form action="" role="form" method="post" enctype="multipart/form-data">
			                    <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" name="username" value="' . (isset($_GET['id']) ? $row_user["username"] : "") . '">
                                                <input type="hidden" name="id_user" value="' . (isset($_GET['id']) ? $row_user["id_user"] : "") . '">
                                           </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>New Password</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="password" class="form-control" name="new_pass" value="">
                                            
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Retype New Password</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="password" class="form-control" name="renew_pass" value="">
                                            </div>
                                        </div>
                                    </div>
                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Group</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <select class="form-control required" name="group" style="width:200px;">
                                                    <option value="">Choose one</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="cso">CSO</option>
                                                    <option value="staff">Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                
                                <div class="box-footer">
                                    <button type="submit" value="Submit" ' . (isset($_GET['id']) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form User';
        $submenu = "system_user";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>