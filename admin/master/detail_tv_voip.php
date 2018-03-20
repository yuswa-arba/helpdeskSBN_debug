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
include("../../config/configuration_tv.php");

redirectToHTTPS(); // for security process in newfunctions2.php

if ($loggedin = logged_inAdmin()) { // Check if they are logged in

    if ($loggedin["group"] == 'admin') {

        global $conn;
        $conn_ott = DB_TV();

        /**=================================================================================
         * query untuk menampilkan detail customer_tv_voip.php jika id pada url tidak kosong
         * =============================================================================== */
        if (isset($_GET["id"])) {
            $cKode = isset($_GET['id']) ? strip_tags(trim($_GET['id'])) : '';
            $query_customer = "SELECT * FROM `tbCustomer` WHERE `cKode` LIKE '%" . $cKode . "%' AND `level` = '0' LIMIT 0,1;";
            $sql_customer = mysql_query($query_customer, $conn);
            $row_customer = mysql_fetch_array($sql_customer);

            $sql_user_tv = mysql_query("SELECT * FROM `v_user_tv` WHERE `custnumber_user_tv` = '" . $cKode . "';", $conn);
            $sql_user_voip = mysql_query("SELECT * FROM `v_user_voip` WHERE `custnumber_user_voip` = '" . $cKode . "';", $conn);

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form customer id=$cKode"); // untuk membuat log
        } else {
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form customer"); // untuk membuat log
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
                                    <h3 class="box-title">Form Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                <div class="box-body">
									<div class="row">
										<div class="col-xs-3">
											<label>Customer Number</label>
										</div>
										<div class="col-xs-6">
											' . (isset($_GET['id']) ? $row_customer["cKode"] : "") . '
										</div>
									</div>
									<div class="row">
										<div class="col-xs-3">
											<label>UserID</label>
										</div>
										<div class="col-xs-6">
											' . (isset($_GET['id']) ? $row_customer["cUserID"] : "") . '
										</div>
									</div>
									<div class="row">
										<div class="col-xs-3">
											<label>Nama</label>
										</div>
										<div class="col-xs-6">
											' . (isset($_GET['id']) ? $row_customer["cNama"] : "") . '
										</div>
									</div>
									<div class="row">
										<div class="col-xs-3">
											<label>Alamat</label>
										</div>
										<div class="col-xs-6">
											' . (isset($_GET['id']) ? $row_customer["cAlamat1"] : "") . '
										</div>
									</div>
									<div class="row">
										<div class="col-xs-3">
											<label>Telepon</label>
										</div>
										<div class="col-xs-6">
											' . (isset($_GET['id']) ? $row_customer["cNoHp1"] : "") . '
										</div>
									</div>
										
										
										<h5>Data TV</h5>
										
										<a href="" class="btn bg-olive btn-flat margin pull-right"
										onclick="return valideopenerform(\'form_usertv.php?r=customer&f=usertv&custnumber=' . $row_customer["cKode"] . '\',\'usertv\');">Create New</a>
										
								
									<table id="customer" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th style="width: 70px">USER TV</th>
												<th style="width: 120px">Status</th>
												<th>User Subscription</th>
												<th>Balance</th>
												<th style="width: 120px">Action</th>
											</tr>
										</thead>
										<tbody>';

        $no_usertv = 1;

        while ($row_user_tv = mysql_fetch_array($sql_user_tv)) {

            $query_ott = "SELECT * FROM `boss`.`t_account_cms` WHERE `boss`.`t_account_cms`.`CLIENTNAME`='" . $row_user_tv["clientname_user_tv"] . "' LIMIT 0,1;";
            $sql_ott = mysqli_query($conn_ott, $query_ott);
            $row_ott = mysqli_fetch_array($sql_ott);

            $sql_paket = mysqli_query($conn_ott, "SELECT `ott`.`ott_product`.`proName` FROM `boss`.`t_consumerecord`, `ott`.`ott_product`
												WHERE `boss`.`t_consumerecord`.`PROID` = `ott`.`ott_product`.`proID`
												AND `boss`.`t_consumerecord`.`CLIENTID` = '" . $row_ott["CLIENTID"] . "'
												AND `boss`.`t_consumerecord`.`VALIDDATE` >= NOW()
												ORDER BY `boss`.`t_consumerecord`.`EXPENSEDT` DESC;");

            $paket = "";

            while ($row_paket = mysqli_fetch_array($sql_paket)) {

                $paket .= $row_paket["proName"] . ",";

            }

            if ($row_data["STATUS"] == "1") {
                $user_subscription = "Pay Per";
            } elseif ($row_data["STATUS"] == "2") {
                $user_subscription = "Monthly charge";
            }

            $content .= '<tr>
						<td>' . $no_usertv . '.</td>
						<td>' . $row_ott["CLIENTNAME"] . '</td>
						<td>' . $row_user_tv["status_user_tv"] . '</td>
						<td>' . $user_subscription . ', ' . $paket . '</td>
						<td>' . number_format($row_ott["BALANCE"], 0, '', '.') . '</td>
						<td><a href="" onclick="return valideopenerform(\'form_usertv.php?r=customer&f=usertv&custnumber=' . $row_customer["cKode"] . '&id=' . $row_ott["CLIENTID"] . '\',\'usertv\');">Edit</a></td>
					</tr>';
            $no_usertv++;
        }

        $content .= '								
								        </tbody>
									</table>
										
									<h5>Data VOIP</h5>
									<a href="" class="btn bg-olive btn-flat margin pull-right"
									onclick="return valideopenerform(\'form_uservoip.php?r=customer&f=usertv&custnumber=' . $row_customer["cKode"] . '\',\'usertv\');">Create New</a>
									
									<table id="customer" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th style="width: 70px">Nomer VOIP</th>
												<th style="width: 120px">Status</th>
												<th>Paket</th>
												<th>Saldo Pulsa</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>';

        $no_usertv = 1;

        while ($row_user_voip = mysql_fetch_array($sql_user_voip)) {

            $content .= '<tr>
						<td>' . $no_usertv . '.</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>';

            $no_usertv++;

        }

        $content .= '					
					                    </tbody>
									</table>
                                </div><!-- /.box-body -->
				    
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->';

        $plugins = '';

        $title = 'Form Customer';
        $submenu = "master_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group);

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>