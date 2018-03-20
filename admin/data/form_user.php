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
use PEAR2\Net\RouterOS;

require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Menu Form Perubahan Bandwidth"); // for create log in newfunction2.php

        global $conn;
        $conn_soft = Config::getInstanceSoft();

        $messages = '';

        if (isset($_POST["update"])) {
            $UserID = isset($_POST['UserID']) ? mysql_real_escape_string(trim($_POST['UserID'])) : '';
            $GroupName = isset($_POST['GroupName']) ? mysql_real_escape_string(trim($_POST['GroupName'])) : '';
            $AccountIndex = isset($_POST['AccountName']) ? mysql_real_escape_string(trim($_POST['AccountName'])) : '';
            $tipe_koneksi = isset($_POST['tipe_koneksi']) ? mysql_real_escape_string(trim($_POST['tipe_koneksi'])) : '';

            //bandwidth dl
            $bw_dl_down = isset($_POST['bw_dl_down']) ? mysql_real_escape_string(trim($_POST['bw_dl_down'])) : '';
            $bw_dl_up = isset($_POST['bw_dl_up']) ? mysql_real_escape_string(trim($_POST['bw_dl_up'])) : '';

            //bandwidth upto
            //limit atas
            $bw_up1_down = isset($_POST['bw_up1_down']) ? mysql_real_escape_string(trim($_POST['bw_up1_down'])) : '';
            $bw_up1_up = isset($_POST['bw_up1_up']) ? mysql_real_escape_string(trim($_POST['bw_up1_up'])) : '';
            //limit tengah
            $bw_up2_down = isset($_POST['bw_up2_down']) ? mysql_real_escape_string(trim($_POST['bw_up2_down'])) : '';
            $bw_up2_up = isset($_POST['bw_up2_up']) ? mysql_real_escape_string(trim($_POST['bw_up2_up'])) : '';
            //limit atas
            $bw_up3_down = isset($_POST['bw_up3_down']) ? mysql_real_escape_string(trim($_POST['bw_up3_down'])) : '';
            $bw_up3_up = isset($_POST['bw_up3_up']) ? mysql_real_escape_string(trim($_POST['bw_up3_up'])) : '';

            //limit time
            $bw_up4_down = isset($_POST['bw_up4_down']) ? mysql_real_escape_string(trim($_POST['bw_up4_down'])) : '';
            $bw_up4_up = isset($_POST['bw_up4_up']) ? mysql_real_escape_string(trim($_POST['bw_up4_up'])) : '';

            if ($tipe_koneksi == "dl") {
                $NASAttributes = '$bwrate=' . $bw_dl_down . '/' . $bw_dl_up . '    ';
            } elseif ($tipe_koneksi == "upto") {
                $NASAttributes = '$bwrate=' . $bw_up1_down . '/' . $bw_up1_up . ' ' . $bw_up2_down . '/' . $bw_up2_up . ' ' . $bw_up3_down . '/' . $bw_up3_up . ' ' . $bw_up4_down . '/' . $bw_up4_up . '    ';
            }

            $sql_select_user = $conn_soft->prepare("SELECT TOP 1 * FROM [dbo].[Users] WHERE [Users].[UserID] = '" . $UserID . "';");
            $sql_select_user->execute();
            $row_select_user = $sql_select_user->fetch(PDO::FETCH_ASSOC);
            //history_bw
            $query_user_history = "INSERT INTO `gx_inet_users_history` (`id_user_history`, `UserIndex`, `UserID`, `Password`,
                `PasswordDate`, `PasswordSource`, `GroupName`, `UserService`, `UserIP`, `FilterName`,
                `StartDate`, `UserExpiryDate`, `ManualExpirationDate`, `SuspendDate`, `UserActive`,
                `AccountIndex`, `UserTimeBank`, `UserKBBank`, `UserDollarBank`, `UserBalance`,
                `UserPaymentBalance`, `TimeOnline`, `CallBackNumber`, `CallerID`, `Lockout`, `LockoutTime`,
                `LockoutCount`, `GracePeriodExpiration`, `NASAttributes`, `date_upd`, `user_upd`)
                VALUES (NULL, '" . $row_select_user["UserIndex"] . "', '" . $row_select_user["UserID"] . "',
                '" . $row_select_user["Password"] . "', '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["PasswordDate"]))) . "',
                '" . $row_select_user["PasswordSource"] . "', '" . $row_select_user["GroupName"] . "',
                '" . $row_select_user["UserService"] . "', '" . $row_select_user["UserIP"] . "', '" . $row_select_user["FilterName"] . "',
                '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["StartDate"]))) . "',
                '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["UserExpiryDate"]))) . "',
                '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["ManualExpirationDate"]))) . "',
                '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["SuspendDate"]))) . "', '" . $row_select_user["UserActive"] . "',
                '" . $row_select_user["AccountIndex"] . "', '" . $row_select_user["UserTimeBank"] . "', '" . $row_select_user["UserKBBank"] . "',
                '" . $row_select_user["UserDollarBank"] . "', '" . $row_select_user["UserBalance"] . "', '" . $row_select_user["UserPaymentBalance"] . "',
                '" . $row_select_user["TimeOnline"] . "', '" . $row_select_user["CallBackNumber"] . "', '" . $row_select_user["CallerID"] . "',
                '" . $row_select_user["Lockout"] . "', '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["LockoutTime"]))) . "',
                '" . $row_select_user["LockoutCount"] . "',
                '" . (date("Y-m-d H:i:s ", strtotime($row_select_user["GracePeriodExpiration"]))) . "', '" . $row_select_user["NASAttributes"] . "',                        
                NOW(), 'dwi');";
            $sql_history_bw = mysql_query($query_user_history, $conn);

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "$query_user_history"); // for create log in newfunction2.php

            //Update to SQLServer
            $query_bw = "UPDATE [dbo].[Users] SET [NASAttributes] = '" . $NASAttributes . "', [AccountIndex] = '" . $AccountIndex . "',
                [GroupName] = '" . $GroupName . "'    
                WHERE [Users].[UserID] = '" . $UserID . "';";
            $update_bw = $conn_soft->prepare($query_bw);
            $update_bw->execute();

            enableLog("", $loggedin["username"], $loggedin["id_employee"], $query_bw); // for create log in newfunction2.php

            //reconnect to RAS Server
            //koneksi ke RAS
            $ip_address = "192.168.1.90";
            $username = "dwi";
            $password = "dwi";

            //cut koneksi
            try {
                $client = new RouterOS\Client($ip_address, $username, $password);
            } catch (Exception $e) {
                enableLog("", "dwi", "dwi", "Unable to connect to RouterOS."); // for create log in newfunction2.php
            }

            if (isset($client)) {

                $util = new RouterOS\Util($client);
                $util->exec("
                    /interface pppoe-server remove [find user=" . $UserID . "]
                    ");

                enableLog("", "dwi", "dwi", "/interface pppoe-server remove [find user=" . $UserID . "]"); // for create log in newfunction2.php
            } else {
                enableLog("", $loggedin["username"], $loggedin["id_employee"], "Unable to connect to RouterOS."); // for create log in newfunction2.php

            }

            $content = '
                <section class="content-header">
                    <h1>
                        Form Perubahan Bandwidth
                    </h1>
                </section>
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Users</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="alert alert-info  alert-dismissable">
                                                <i class="fa fa-info"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Info!</b> Data telah diupdate. <br><br><br>
                                                
                                                <div class="btn bg-olive btn-flat margin"><a href="detail_user.php?uid=' . $UserID . '">Detail Users</a></div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

        } else {

            if (isset($_GET["uid"])) {
                $uid = isset($_GET['uid']) ? mysql_real_escape_string(strip_tags(trim($_GET['uid']))) : '';

                $sql_user = $conn_soft->prepare("SELECT [Users].*, [AccountTypes].[AccountName], [Groups].[GroupName]
                    FROM [dbo].[Users], [dbo].[AccountTypes], [dbo].[Groups]
                    WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
                    AND [Users].[GroupName] = [Groups].[GroupName]
                    AND [Users].[userActive] = '1'
                    AND [Users].[UserID] = '" . $uid . "';");
                $sql_user->execute();
                $row_user = $sql_user->fetch(PDO::FETCH_ASSOC);
            }

            $content = '
                <section class="content-header">
                    <h1>
                        Form Perubahan Bandwidth
                    </h1>
                </section>
                
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Users</h3>
                                </div><!-- /.box-header -->
                                
                                <div class="box-body table-responsive">
                                    ' . $messages . '
                                    <form role="form" method="POST" action="">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <h5>UserID</h5>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <input type="text" class="form-control" name="UserID" value="' . (isset($_GET["uid"]) ? $row_user["UserID"] : "") . '" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <h5>Account Name</h5>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        
                                                        <select name="AccountName" id="AccountName" class="form-control">';

            $sql_groups = $conn_soft->prepare("SELECT [AccountName],[AccountIndex] FROM [dbo].[AccountTypes];");
            $sql_groups->execute();

            while ($row_groups = $sql_groups->fetch(PDO::FETCH_ASSOC)) {
                $selected = isset($_GET["uid"]) ? $row_user["AccountName"] : "";
                $selected = ($selected == $row_groups["AccountName"]) ? ' selected=""' : "";
                $content .= '<option value="' . $row_groups["AccountIndex"] . '"' . $selected . '>' . $row_groups["AccountName"] . '</option>';
            }

            $content .= '                                    
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
					                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <h5>Group Name</h5>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <select name="GroupName" id="GroupName" class="form-control">';

            $sql_groups = $conn_soft->prepare("SELECT [GroupName] FROM [dbo].[Groups];");
            $sql_groups->execute();

            while ($row_groups = $sql_groups->fetch(PDO::FETCH_ASSOC)) {
                $selected = isset($_GET["uid"]) ? $row_user["GroupName"] : "";
                $selected = ($selected == $row_groups["GroupName"]) ? ' selected=""' : "";
                $content .= '<option value="' . $row_groups["GroupName"] . '"' . $selected . '>' . $row_groups["GroupName"] . '</option>';
            }

            $content .= '                                    
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <h5>Tipe Koneksi</h5>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input id="upto" type="radio" name="tipe_koneksi" value="upto" />Upto
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input id="dl" type="radio" name="tipe_koneksi" value="dl" /> Dedicated Link
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="form_dl" style="display:none;">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <label for="bw_info">Bandwidth Info</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <h5>Limiter</h5>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_dl_down" value="" placeholder="DOWN (MB/KB)">
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_dl_up" value="" placeholder="UP (MB/KB)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="form_upto" style="display:none;">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <label for="bw_info">Bandwidth Info</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <h5>Limiter Atas</h5>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up1_down" value="" placeholder="DOWN (MB/KB)">
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up1_up" value="" placeholder="UP (MB/KB)">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <h5>Limiter Tengah</h5>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up2_down" value="" placeholder="DOWN (MB/KB)">
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up2_up" value="" placeholder="UP (MB/KB)">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <h5>Limiter Bawah</h5>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up3_down" value="" placeholder="DOWN (MB/KB)">
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up3_up" value="" placeholder="UP (MB/KB)">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <h5>Limiter Time</h5>
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up4_down" value="" placeholder="Waktu (Detik)">
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <input type="text" class="form-control" name="bw_up4_up" value="" placeholder="Waktu (Detik)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button type="submit" ' . (isset($_GET["uid"]) ? 'name="update"' : 'name="save"') . ' class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->';

        }

        $plugins = '
            <!-- InputMask -->
            <script src="' . URL . 'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
            <script src="' . URL . 'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
            
            <script type="text/javascript">
            $(function() {
                    $("[data-mask]").inputmask();
                });
    
            </script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $(\'#dl\').on(\'ifChecked\', function(event){
                        $(\'#form_upto\').hide(\'fast\');
                        $(\'#form_dl\').show(\'fast\');
                    });
                    $(\'#upto\').on(\'ifChecked\', function(event){
                        $(\'#form_dl\').hide(\'fast\');
                        $(\'#form_upto\').show(\'fast\');
                    });
                });
            </script>';

        $title = 'Form Perubahan Bandwidth';
        $submenu = "inet_grouptime";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>