<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include("../../config/configuration_2016.php");

redirectToHTTPS();

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn;

        $content = '
            <section class="content-header">
                <h1>
                    User Management
                    
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="system_user"> User Management</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <a href="' . URL_ADMIN . 'system/group.php" class="btn btn-success">User</a>
				                <a href="' . URL_ADMIN . 'system/group.php" class="btn btn-warning">Group</a>
				            </div>
			            </div>
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Search</h2>
                            </div>
				            <div class="box-body">
                                <form action="" method="post" name="form_search">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="fontstyle_searchoptions" width="40%"> &nbsp;	Username :
                                                <input class="form_input_text" type="text" name="username" placeholder="Username">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <input class="btn btn-primary" name="search" value=" Search " type="submit">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>';


        if (isset($_POST["search"])) {
            $username = isset($_POST["username"]) ? trim(strip_tags($_POST["username"])) : "";

            $sql_user = mysql_query("SELECT `gxLogin_admin`.`id_user`, `gxLogin_admin`.`username`, `tbPegawai`.`cNama`, `tbPegawai`.`cAlamatEmail`, `gx_user_group`.`group_nama`, `gx_user_group`.`id_group`
				FROM `gxLogin_admin`, `tbPegawai`, `gx_user_group`
				WHERE `gxLogin_admin`.`id_employee` = `tbPegawai`.`cKode`
				AND `gxLogin_admin`.`id_group` = `gx_user_group`.`id_group`
				AND `gxLogin_admin`.`username` LIKE '" . $username . "%'
				AND `gxLogin_admin`.`level` = '0'
				ORDER BY `gxLogin_admin`.`id_user` ASC LIMIT 0,10;", $conn);

            $content .= '		
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">List User</h2>
                            </div>
                            <div class="box-body">
                                <table id="usermanagement" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Group</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

            $no = 1;
            while ($row_user = mysql_fetch_array($sql_user)) {
                $content .= '
                    <tr>
                        <td>' . $no . '.</td>
                        <td>' . $row_user["username"] . '</td>
                        <td>' . $row_user["cNama"] . '</td>
                        <td>' . $row_user["group_nama"] . '</td>
                        <td>' . $row_user["cAlamatEmail"] . '</td>
                        <td><a href="' . URL_ADMIN . 'system/form_user.php?id=' . $row_user["id_user"] . '">Edit</a></td>
                    </tr>';

                $no++;
            }
            $content .= '
                                    </tbody>
                                </table>';
        }

        $content .= '
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>

            </section><!-- /.content -->';

        $plugins = '
            <!-- DataTable -->
            <link href="' . URL . 'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
            <!-- DATA TABES SCRIPT -->
            <script src="' . URL . 'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $(\'#usermanagement\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>';

        $title = 'User Management';
        $submenu = "system_user";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>