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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Invoice"); // for create log in newfunction2.php

        global $conn;

        // menambil nilai/string yang ada pada url
        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
        $f = isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";

        $content = '
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Data Nomer Accounting</h2>
                            </div>
                            <div class="box-body table-responsive">
                                <form action="" method="post" name="form_search" id="form_search">
                                    <table class="form" width="80%">
                                        <tr>
                                            <td>
                                              <label>Nomer Accounting</label>
                                            </td>
                                            <td>
                                              <input class="form-control" name="no_acc" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              <label>Nama</label>
                                            </td>
                                            <td>
                                              <input class="form-control" name="nama" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                              <input type="submit" class="button button-primary" name="search" value="Search">
                                            </td>
                                        </tr>
                                    </table>
                                </form>';

        if (isset($_POST["search"])) {
            $no_acc = isset($_POST['no_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_acc']))) : "";
            $nama = isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";

            $sql_no_acc = ($no_acc != "") ? "AND `no_accounting` = '" . $no_acc . "'" : "";
            $sql_nama = ($nama != "") ? "AND `nama` LIKE '%" . $nama . "%'" : "";

            $sql_data = "SELECT * FROM `gx_no_accounting` WHERE `level` = '0' $sql_no_acc $sql_nama
		        ORDER BY `no_accounting` DESC LIMIT 0,10;";
        } else {
            $sql_data = "SELECT * FROM `gx_no_accounting` WHERE `level` = '0'
		        ORDER BY `no_accounting` DESC LIMIT 0,10;";
        }

        $content .= '
                                <table class="table table-bordered table-striped" id="customer">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No ACC</th>
                                            <th>Nama</th>
                                            <th>Level</th>
                                            <th>Jenis</th>
                                            <th>Group</th>
                                            <th>Divisi</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

        $query_data = mysql_query($sql_data, $conn);
        $no = 1;

        while ($row_data = mysql_fetch_array($query_data)) {

            $content .= '
                <tr>
	        	    <td>' . $no . '</td>
	        	    <td>' . $row_data["no_accounting"] . '</td>
	        	    <td>' . $row_data["nama"] . '</td>
	        	    <td>' . $row_data["level_accounting"] . '</td>
	        	    <td>' . $row_data["jenis"] . '</td>
	        	    <td>' . $row_data["group"] . '</td>
	        	    <td>' . $row_data["divisi"] . '</td>
	        	    <td>
	        	      <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_data["no_accounting"]) . '\',\'' . mysql_real_escape_string($row_data["nama"]) . '\')">Select</a>
	        	    </td>
	            </tr>';
            $no++;
        }
        $content .= '
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
            </section><!-- /.content -->';

        $plugins = '';
        if ($f == "biaya") {
            $plugins .= '
                <script type="text/javascript">
                    function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_biaya.value=noacc;
                        self.close();
                    }
                </script>';
        } elseif ($f == "free") {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_free.value=noacc;
                		self.close();
                    }
                </script>';

        } elseif ($f == "kk") {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_cash.value=noacc;
                		self.close();
                    }
                </script>';

        } elseif ($f == "km") {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_cash.value=noacc;
                		self.close();
                    }
                </script>';

        } elseif ($f == "inventaris") {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_inventaris.value=noacc;
                		self.close();
                    }
                </script>';
        } elseif ($f == "cash") {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_bank.value=noacc;
                		self.close();
                    }
                </script>';
        } elseif ($f == "no_acc") {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.' . $f . '.value=noacc;
                		window.opener.document.' . $return_form . '.nama_acc.value=nama;
                		self.close();
                    }
                </script>';
        } else {
            $plugins .= '
                <script type="text/javascript">
                	function validepopupform2(noacc, nama){
                        window.opener.document.' . $return_form . '.acc_bm.value=noacc;
                		self.close();
                    }
                </script>';
        }

        $title = 'Data Invoice';
        $submenu = "master_invoice";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>