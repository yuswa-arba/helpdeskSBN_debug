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

redirectToHTTPS();

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn;
        global $conn_voip;

        //log open menu
        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open menu list log admin");

        $content = '
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">List Log</h3>
                            </div><!-- /.box-header -->
                            
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover table-border" id="sess_history">
                                    <thead>
                                    <tr>
                                        <th><b>No.</b></th>
                                        <th><b>User</b></th>
                                        <th><b>Activity</b></th>
                                        <th><b>Time</b></th>
                                        <th><b>IP Address</b></th>
                                        <th><b>Detail</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>';

        $sql_log = mysql_query("SELECT * FROM `gx_log_detail` ORDER BY `time` DESC LIMIT 0,100;", $conn);
        $no = 1;

        while ($row_log = mysql_fetch_array($sql_log)) {
            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td>' . $row_log["nama_customer"] . '</td>
                    <td>' . $row_log["activity"] . '</td>
                    <td>' . $row_log["time"] . '</td>
                    <td>' . $row_log["ip"] . '</td>
                    <td>' . $row_log["browser_detail"] . '</td>
                    <td></td>
                </tr>';
            $no++;
        }

        $content .= '                            
                                    </tbody>
                                </table> 
				                
				                <div class="box-footer clearfix"></div>
				                
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '
            <!-- daterangepicker -->
            <script src="' . URL . 'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
            <!-- datepicker -->
            <script src="' . URL . 'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
            <!-- Bootstrap WYSIHTML5 -->
            <script src="' . URL . 'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
            <!-- iCheck -->
            <script src="' . URL . 'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
    
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="' . URL . 'js/AdminLTE/dashboard.js" type="text/javascript"></script>
            
            <!-- DATA TABES SCRIPT -->
            <script src="' . URL . 'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(function() {
                    $(\'#sess_history\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>
    
            <script>
                $(function() {
                    $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                    $("#todatepicker").datepicker({format: "yyyy-mm-dd"});
                });
            </script>';

        $title = 'List Logs';
        $submenu = "logs";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>