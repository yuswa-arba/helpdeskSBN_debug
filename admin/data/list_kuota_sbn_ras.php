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

redirectToHTTPS();

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn;

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "open menu data usage");

        $conn_soft2 = Config::getInstanceSoft();

        $sql_user_all = $conn_soft2->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
            FROM [dbo].[Users], [dbo].[AccountTypes]
            WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] 
            AND [Users].[userActive] = '1';");
        $sql_user_all->execute();
        $row_user_all = $sql_user_all->fetchAll(PDO::FETCH_ASSOC);

        $total_user_all = count($row_user_all);

        $sql_user_h10 = $conn_soft2->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
            FROM [dbo].[Users], [dbo].[AccountTypes]
            WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
            [Users].[GroupName] = 'h.10'
            AND [Users].[userActive] = '1';");
        $sql_user_h10->execute();
        $row_user_h10 = $sql_user_h10->fetchAll(PDO::FETCH_ASSOC);

        $total_user_h10 = count($row_user_h10);

        $sql_user_h8 = $conn_soft2->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
            FROM [dbo].[Users], [dbo].[AccountTypes]
            WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
            [Users].[GroupName] = 'h.08'
            AND [Users].[userActive] = '1';");
        $sql_user_h8->execute();
        $row_user_h8 = $sql_user_h8->fetchAll(PDO::FETCH_ASSOC);

        $total_user_h8 = count($row_user_h8);

        $sql_user_h5 = $conn_soft2->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
           FROM [dbo].[Users], [dbo].[AccountTypes]
           WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
           [Users].[GroupName] = 'h.05'
           AND [Users].[userActive] = '1';");
        $sql_user_h5->execute();
        $row_user_h5 = $sql_user_h5->fetchAll(PDO::FETCH_ASSOC);

        $total_user_h5 = count($row_user_h5);

        $sql_user_h2 = $conn_soft2->prepare("SELECT [Users].*, [AccountTypes].[AccountName]
            FROM [dbo].[Users], [dbo].[AccountTypes]
            WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex] AND
            [Users].[GroupName] = 'h.02'
            AND [Users].[userActive] = '1';");
        $sql_user_h2->execute();
        $row_user_h2 = $sql_user_h2->fetchAll(PDO::FETCH_ASSOC);

        $total_user_h2 = count($row_user_h2);

        $content = '
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
							<div class="box-header">
                                <h4 class="box-title">Detail</h4>
                            </div><!-- /.box-header -->
                            
                            <div class="box-body">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-xs-12">
										<a class="btn btn-primary btn-flat" href="grafik_kuota.php">Lihat Grafik</a>
									</div>
								</div>
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-lg-3 col-md-6 col-xs-12">
                                        <div class="info-box bg-aqua">
                                            <span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
                                            
                                            <div class="info-box-content">
                                                <span class="info-box-text">Bandwidth 10 Mbps</span>
                                                <span class="info-box-number">' . $total_user_h10 . ' User</span>
                                                
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: ' . round(($total_user_h10 / $total_user_all) * 100) . '%"></div>
                                                </div>
                                                <span class="progress-description"></span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-6 col-xs-12">
										<div class="info-box bg-green">
											<span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
											
											<div class="info-box-content">
												<span class="info-box-text">Bandwidth 8 Mbps</span>
												<span class="info-box-number">' . $total_user_h8 . ' User</span>
												
												<div class="progress">
													<div class="progress-bar" style="width: ' . round(($total_user_h8 / $total_user_all) * 100) . '%"></div>
												</div>
												<span class="progress-description"></span>
											</div>
											<!-- /.info-box-content -->
										</div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-6 col-xs-12">
										<div class="info-box bg-yellow">
											<span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
											
											<div class="info-box-content">
												<span class="info-box-text">Bandwidth 5 Mbps</span>
												<span class="info-box-number">' . $total_user_h5 . ' User</span>
												
												<div class="progress">
													<div class="progress-bar" style="width: ' . round(($total_user_h5 / $total_user_all) * 100) . '%"></div>
												</div>
												<span class="progress-description"></span>
											</div>
											<!-- /.info-box-content -->
										</div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-6 col-xs-12">
										<div class="info-box bg-red">
											<span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
											
											<div class="info-box-content">
												<span class="info-box-text">Bandwidth 2 Mbps</span>
												<span class="info-box-number">' . $total_user_h2 . ' User</span>
												
												<div class="progress">
													<div class="progress-bar" style="width: ' . round(($total_user_h2 / $total_user_all) * 100) . '%"></div>
												</div>
												<span class="progress-description"></span>
											</div>
											<!-- /.info-box-content -->
										</div>
                                    </div>
                                </div>
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
        $kondisi2 = 'h.08';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
        $kondisi3 = 'h.05';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )
        $kondisi4 = 'h.02';//<-- ( di belakang 5M/5M dan seterusnya harus ada 2 - 3 spasi nya )

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
                $class_bw = 'class="info"';
            } elseif (((strpos($rows["GroupName"], "h.08")) !== FALSE)) {
                $bw = "8Mbps";
                $class_bw = 'class="success"';
            } elseif (((strpos($rows["GroupName"], "h.05")) !== FALSE)) {
                $bw = "5Mbps";
                $class_bw = 'class="warning"';
            } elseif (((strpos($rows["GroupName"], "h.02")) !== FALSE)) {
                $bw = "2Mbps";
                $class_bw = 'class="danger"';
            }

            $max_kuota = kuotaKB($rows["UserKBBank"]);
            $total_kuota_rbs_ras = $total_kuota + $kuota_ras;

            $content .= '
                <tr ' . $class_bw . '>
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

        $plugin = '';

        $title = 'Cek Bandwidth';
        $submenu = "inet_datausage";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>