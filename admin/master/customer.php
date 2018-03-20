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

        enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Customer"); // insert log open List Master Customer in newfunctions2.php

        global $conn;
        global $conn_voip;

        //paging
        $perhalaman = 20;
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            $start = ($page - 1) * $perhalaman;
        } else {
            $start = 0;
        }

        $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				                <div class="box-header">
                                    <h2 class="box-title">Search</h2>
                                </div>
				
                                <div class="box-body table-responsive">
                                    <form action="" method="post" name="form_search">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>User ID :</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input class="form-control" type="text" name="user_id" placeholder="User ID">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Customer Number :</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input class="form-control" type="text" name="cust_number" placeholder="Customer Number">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Nama Customer :</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input class="form-control" name="name" type="text" placeholder="Nama Customer">
                                                </div>
                                                <div class="col-xs-2">
                                                    <label>Alamat :</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input class="form-control" type="text" name="address" placeholder="Alamat">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <label>Email :</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input class="form-control" name="email" type="text" placeholder="Email">
                                                </div>
                                                <div class="col-xs-2">
                                                    
                                                </div>
                                                <div class="col-xs-4">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-2"></div>
                                                <div class="col-xs-4">
                                                    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
                                                </div>
                                                <div class="col-xs-2"></div>
                                                <div class="col-xs-4"></div>
                                            </div>
                                        </div>
                                    </form>
                                    
	                                <hr>
	                                
                                    <div class="box-header">
                                        <h3 class="box-title">List Customer</h3>
                                        <a href="' . URL_ADMIN . 'master/form_customer.php" class="btn bg-olive btn-flat margin pull-right">Create Account</a>
                                                    </div><!-- /.box-header -->
                                                        <table id="customer" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th style="width: 70px">User ID</th>
                                                                    <th style="width: 120px">Cust. Number</th>
                                                                    <th>Name</th>
                                                                    <th style="width: 220px">Address</th>
                                                                    <th>Email</th>
                                                                    <th style="width: 120px">#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';

        if (isset($_POST["search"])) {
            $user_id = isset($_POST["user_id"]) ? trim(strip_tags($_POST["user_id"])) : "";
            $cust_number = isset($_POST["cust_number"]) ? trim(strip_tags($_POST["cust_number"])) : "";
            $name = isset($_POST["name"]) ? trim(strip_tags($_POST["name"])) : "";
            $address = isset($_POST["address"]) ? trim(strip_tags($_POST["address"])) : "";
            $email = isset($_POST["email"]) ? trim(strip_tags($_POST["email"])) : "";

            $sql_userid = ($user_id != "") ? "AND `cUserID` LIKE '%$user_id%'" : "";
            $sql_cust_number = ($cust_number != "") ? "AND `cKode` LIKE '%$cust_number%'" : "";
            $sql_name = ($name != "") ? "AND `cNama` LIKE '%$name%'" : "";
            $sql_address = ($address != "") ? "AND `cAlamat1` LIKE '%$address%'" : "";
            $sql_email = ($email != "") ? "AND `cEmail` LIKE '%$email%'" : "";


            $sql_masterCustomer = mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "' AND
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);

            $sql_total_customer = mysql_num_rows(mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "' AND
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `date_add` DESC;", $conn));

            $hal = "?u=$user_id&c=$cust_number&n=$name&a=$address&e=$email&";

            enableLog("", $loggedin["username"], $loggedin["username"], "Search Master Customer = SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE 
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `cNama` ASC;");
        } else {
            $sql_masterCustomer = mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "' AND
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0' ORDER BY `cNama` ASC LIMIT $start, $perhalaman;", $conn);

            $sql_total_customer = mysql_num_rows(mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "' AND
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0' ORDER BY `cNama` ASC;", $conn));

            $hal = "?";
        }

        if (isset($_GET["u"])) {
            $user_id = isset($_GET["u"]) ? trim(strip_tags($_POST["u"])) : "";
            $cust_number = isset($_GET["c"]) ? trim(strip_tags($_POST["c"])) : "";
            $name = isset($_GET["n"]) ? trim(strip_tags($_POST["n"])) : "";
            $address = isset($_GET["a"]) ? trim(strip_tags($_POST["a"])) : "";
            $email = isset($_GET["e"]) ? trim(strip_tags($_POST["e"])) : "";

            $sql_userid = ($user_id != "") ? "AND `cUserID` LIKE '%$user_id%'" : "";
            $sql_cust_number = ($cust_number != "") ? "AND `cKode` LIKE '%$cust_number%'" : "";
            $sql_name = ($name != "") ? "AND `cNama` LIKE '%$name%'" : "";
            $sql_address = ($address != "") ? "AND `cAlamat1` LIKE '%$address%'" : "";
            $sql_email = ($email != "") ? "AND `cEmail` LIKE '%$email%'" : "";


            $sql_masterCustomer = mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "' AND
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `date_add` DESC LIMIT $start, $perhalaman;", $conn);

            $sql_total_customer = mysql_num_rows(mysql_query("SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "' AND
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `date_add` DESC;", $conn));

            $hal = "?u=$user_id&c=$cust_number&n=$name&a=$address&e=$email&";

            enableLog("", $loggedin["username"], $loggedin["username"], "Search Master Customer = SELECT `cUserID`, `cKode`, `cNama`, `cAlamat1`, `cEmail`, `idCustomer`
				  FROM `tbCustomer`
				  WHERE
				  `id_cabang` = '" . $loggedin['cabang'] . "'
				  `cUserID` != '' AND
				  `cNama` != '' AND
				  `level` = '0'
				  $sql_userid
				  $sql_cust_number
				  $sql_name
				  $sql_address
				  $sql_email	
				  ORDER BY `date_add` DESC LIMIT 0,100;");
        }

        $no = $start + 1;
        while ($row_masterCustomer = mysql_fetch_array($sql_masterCustomer)) {
            $content .= '
            <tr>
                <td>' . $no . '.</td>
                <td>' . $row_masterCustomer["cUserID"] . '</td>
                <td>' . $row_masterCustomer["cKode"] . '</td>
                <td>' . $row_masterCustomer["cNama"] . '</td>
                <td>' . $row_masterCustomer["cAlamat1"] . '</td>
                <td>' . str_replace(";", "<br>", $row_masterCustomer["cEmail"]) . '</td>
                <td align="center">
                    <a href="detail_customer.php?id=' . $row_masterCustomer["cKode"] . '"><span class="label label-info">Detail</span></a> |
                    <a href="resume_customer.php?id=' . $row_masterCustomer["cKode"] . '" onclick="return valideopenerform(\'resume_customer.php?id=' . $row_masterCustomer["cKode"] . '\',\'resume_customer\');"><span class="label label-info">Resume</span></a> | 
                    <a href="form_customer.php?id=' . $row_masterCustomer["cKode"] . '"><span class="label label-info">Edit</span></a>
                </td>
            </tr>';
            $no++;
        }

        $content .= '
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
				                <div class="box-footer">
                                   <div class="box-tools pull-right">
                                   ' . (halaman($sql_total_customer, $perhalaman, 1, $hal)) . '
				                   </div>
				                <br style="clear:both;">
				                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

        $plugins = '<link type="text/css" rel="stylesheet" href="' . URL . 'css/gx_pagination.css" />';

        $title = 'Master Customer';
        $submenu = "customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];
        $cabang = get_nama_cabang($loggedin['cabang']);

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group, $cabang); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>