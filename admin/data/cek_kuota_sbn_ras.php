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
include 'kuota/routeros_api.class.php';

//use PEAR2\Net\RouterOS;
//require_once '../../config/telnet/PEAR2_Net_RouterOS-1.0.0b4.phar';

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') { // jika yang login adalah admin

        global $conn;

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "open menu data usage"); // for create log in newfunction2.php

        $content = '
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h4 class="box-title">Search</h4>
                            </div><!-- /.box-header -->
                            
                            <div class="box-body table-responsive">
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
                                        <h5>Filter By UserID</h5>
                                        <div class="row">
                                            <div class="col-xs-9">
                                                <p>Userid: <input type="text" value="" name="userid"></p>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                    
                                    <div class="box-footer">
                                        <button type="submit" name="search" class="btn btn-primary">Search</button>
										<button type="submit" name="cekbw" class="btn btn-primary">Check Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- interactive chart -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">Data Usage</h3>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <div class="box-body table-responsive">
                                <div id="cek_bw">
                                    <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
                                                <th><b>No</b></th>
                                                <th><b>UserID</b></th>
                                                <th><b>AccountName</b></th>
                                                <th><b>Sisa Kuota</b></th>
                                                <th><b>Total Kuota RBS</b></th>
                                                <th><b>Total Kuota RAS (Realtime)</b></th>
                                                <th><b>Grand Total Kuota</b></th>
                                                <th><b>GroupName</b></th>
                                                <th><b>Action</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $no = 1;
        $conn_soft = Config::getInstanceSoft();


        $sql_all_user = $conn_soft->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
            FROM [dbo].[Users], [dbo].[AccountTypes]
            WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
            AND [Users].[userActive] = '1';");
        $sql_all_user->execute();

        $kondisi1 = 'h.10';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
        $kondisi2 = 'h.05';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
        $kondisi3 = 'h.02';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
        $kondisi4 = 'h.01';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )

        $row_all_user = $sql_all_user->fetchAll(PDO::FETCH_ASSOC);

        //koneksi ke RAS
        $ip_address = "172.16.255.2";
        $username = "nyuwuntulung911";
        $password = "h3lpd3skSBN";

        $api_vm = new RouterosAPI();
        $api_vm->debug = false;

        //step2
        if ($api_vm->connect($ip_address, $username, $password)) {

            $api_vm->write('/ppp/active/print');
            //$api_vm->write('=active=');
            $READ2 = $api_vm->read(false);
            $ARRAY2 = $api_vm->parseResponse($READ2);

            foreach ($ARRAY2 as $value) {
                $id = substr($value[".id"], -5);
                $data_nama[$id] = $value["name"];
                $data_remove[$value[".id"]] = $value["name"];
            }

            $api_vm->write('/interface/print', false);
            $api_vm->write('=stats=');
            $READ = $api_vm->read(false);
            $ARRAY = $api_vm->parseResponse($READ);

            foreach ($ARRAY as $value) {
                $id = substr($value[".id"], -5);
                $data_kuota[$id] = ($value["rx-byte"] + $value["tx-byte"]);
            }
        } else {
            echo 'tidak konek sam';
        }

        foreach ($row_all_user as $rows) {

            $id_kuota = array_search($rows["UserID"], $data_nama);
            //$id_remove_ppp = array_search($rows["UserID"], $data_remove);

            if (!empty ($id_kuota)) {
                $kuota_ras = $data_kuota[$id_kuota];
            } else {
                $kuota_ras = '0';
            }

            //total pemakaian
            $conn_soft2 = Config::getInstanceSoft();
            $sql_total_data = $conn_soft2->prepare("SELECT  ISNULL([AcctOutputOctets], 0) AS totalin,
                ISNULL([AcctInputOctets], 0) AS totalout,
                ISNULL([AcctSessionTime], 0) AS totaltime
                FROM [dbo].[Accountinglog]
                WHERE  [Accountinglog].[UserId] = '" . $rows["UserID"] . "'
                AND MONTH(AcctDate) = " . date("m") . " AND YEAR(AcctDate) = " . date("Y") . ";");

            $sql_total_data->execute();

            $total_kuota = 0;
            $totalin = 0;
            $totalout = 0;
            $totaltime = 0;
            $bw = '-';

            $row_total_data = $sql_total_data->fetchAll(PDO::FETCH_ASSOC);

            foreach ($row_total_data as $kuota) {
                $totalin = $totalin + ($kuota["totalin"]);
                $totalout = $totalout + ($kuota["totalout"]);
                $totaltime = $totaltime + ($kuota["totaltime"]);
                $total_kuota = $total_kuota + ($kuota["totalin"] + $kuota["totalout"]);
            }

            if (((strpos($rows["GroupName"], "h.10")) !== FALSE)) {
                $bw = "10Mbps";
            } elseif (((strpos($rows["GroupName"], "h.05")) !== FALSE)) {
                $bw = "5Mbps";
            } elseif (((strpos($rows["GroupName"], "h.02")) !== FALSE)) {
                $bw = "2Mbps";
            } elseif (((strpos($rows["GroupName"], "h.01")) !== FALSE)) {
                $bw = "1Mbps";
            }

            $max_kuota = kuotaKB($rows["UserKBBank"]);
            $total_kuota_rbs_ras = $total_kuota + $kuota_ras;

            $content .= '
                <tr>
                    <td>' . $no . '.</td>
                    <td><a href="' . URL_ADMIN . 'data/detail_user.php?uid=' . $rows["UserID"] . '">' . $rows["UserID"] . '</a></td>
                    <td>' . $rows["AccountName"] . '</td>
                    <td>' . kuotaMB($rows["UserKBBank"]) . '</td>
                    <td>' . kuotaMB($total_kuota) . '</td>
                    <td>' . kuotaMB($kuota_ras) . '</td>
                    <td>' . kuotaMB($total_kuota_rbs_ras) . '</td>
                    <td>' . $rows["GroupName"] . ' (' . $bw . ')</td>
                    <td><a href="' . URL_ADMIN . 'data/form_user.php?uid=' . $rows["UserID"] . '">edit</a></td>
                </tr>';

            $current_time = DateTime::createFromFormat('H:i', date("H:i"));
            $start = DateTime::createFromFormat('H:i', "08:00");
            $end = DateTime::createFromFormat('H:i', "20:00");

            $no++;
        }

        $content .= '
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.box-body-->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->';

        $plugin = '
            <script type="text/javascript">
                $(function () {
                    $.ajaxSetup({ cache: false }); 
                    setInterval(function() {
                        $(\'#cek_bw\').load(\'' . URL . 'config/admin/ajax/cek_bw_group.php\');
                    }, 300000); 
                });
                
            </script>';

        $title = 'Cek Bandwidth';
        $submenu = "inet_datausage";
        $plugins = '';
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>