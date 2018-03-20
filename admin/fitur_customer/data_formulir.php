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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open data Formulir"); // for create log in newfunction2.php

        global $conn;

        $return_form = isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : ""; // menambil nilai/string yang ada pada url

        $content = '
            <section class="content-header">
                <h1>
                    Data Formulir 
                </h1>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
				            <div class="box-header">
                                <h2 class="box-title">Search Data Formulir</h2>
                            </div>
                            
                            <div class="box-body table-responsive">
                                <div class="box-header"></div><!-- /.box-header -->
                                    <form action="" method="post" name="form_search" id="form_search">
                                        <table class="form" width="80%">';

        $f_data = isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : ''; // menambil nilai/string yang ada pada url

        if ($f_data == 'data_inactive') {
            $sql_formulir_select = "SELECT * FROM `gx_formulir` ORDER BY `id_formulir` DESC";
            $query_formulir_select = mysql_query($sql_formulir_select, $conn);

            $content .= '
		        <tr>
                    <td><label>No Formulir</label></td>
                    <td>
                        <select name="kode_formulir" class="form-control" >
                            <option value="">Pilih No Formulir</option>';

            while ($row_formulir_select = mysql_fetch_array($query_formulir_select)) {
                $content .= '<option value="' . $row_formulir_select['kode_formulir'] . '">' . $row_formulir_select['kode_formulir'] . '</option>';
            }

            $content .= '
			            </select>
			        </td>
		        </tr>
		        <tr>
                    <td><label>Nama yang print</label></td>
                    <td>
                        <input class="form-control" name="nama_formulir" placeholder="Nama yang print" type="text" value="">
                    </td>
		        </tr>';
        } else {
            $content .= '
		        <tr>
                    <td>
                        <label>Kode Formulir</label>
                    </td>
                    <td>
                        <input class="form-control" name="kode_formulir" placeholder="Kode Formulir" type="text" value="">
                    </td>
		        </tr>
		        <tr>
                    <td>
                        <label>Nama Formulir</label>
                    </td>
                    <td>
                        <input class="form-control" name="nama_formulir" placeholder="Nama Formulir" type="text" value="">
                    </td>
		        </tr>';
        }

        $content .= '		
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" class="button button-primary" name="save_search" data-icon="v" value="Search">
                    </td>
                </tr>
            </table>';

        if (isset($_POST["save_search"])) {

            $kode_formulir = isset($_POST['kode_formulir']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_formulir']))) : "";
            $nama_formulir = isset($_POST['nama_formulir']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_formulir']))) : "";


            $sql_nama_formulir = ($nama_formulir != "") ? "AND `nama_formulir` LIKE '" . $nama_formulir . "%'" : "";

            $sql_formulir = "SELECT * FROM `gx_formulir`
                WHERE `kode_formulir` LIKE '" . $kode_formulir . "%'
                $sql_nama_formulir
                ORDER BY `id_formulir` DESC LIMIT 0,10;";

            $content .= '
                <table class="table table-bordered table-striped" id="formulir">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Formulir</th>
                            <th>Nama Formulir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            $query_formulir = mysql_query($sql_formulir, $conn);

            $no = 1;

            if (isset($_GET["f"])) {
                if ($_GET["f"] == "data_formulir") {
                    while ($row_formulir = mysql_fetch_array($query_formulir)) {
                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_formulir["kode_formulir"] . '</td>
                                <td>' . $row_formulir["nama_formulir"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_formulir["kode_formulir"]) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_inactive") {
                    while ($row_formulir = mysql_fetch_array($query_formulir)) {

                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_formulir["kode_formulir"] . '</td>
                                <td>' . $row_formulir["nama_formulir"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_formulir["kode_formulir"]) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                }
                if ($_GET["f"] == "data_formulir") {
                    while ($row_formulir = mysql_fetch_array($query_formulir)) {

                        $content .= '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row_formulir["kode_formulir"] . '</td>
                                <td>' . $row_formulir["nama_formulir"] . '</td>
                                <td>
                                  <a href="" onclick="validepopupform2(\'' . mysql_real_escape_string($row_formulir["kode_formulir"]) . '\')">Select</a>
                                </td>
                            </tr>';
                        $no++;
                    }
                }
            } else {

            }
            $content .= '
                                        </tbody>
                                    </table>';
        }
        $content .= '
                                </form>
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
                    $(\'#paket\').dataTable({
                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": false,
                        "bInfo": true,
                        "bAutoWidth": false
                    });
                });
            </script>';
        if (isset($_GET["f"])) {
            if ($_GET["f"] == "data_formulir") {
                $plugins .= '
                    <script type="text/javascript">
                    	function validepopupform2(ckode_formulir){
                    		window.opener.document.' . $return_form . '.no_formulir.value=ckode_formulir;
                            self.close();
                        }
                    </script>';
            }
            if ($_GET["f"] == "data_inactive") {
                $plugins .= '
                    <script type="text/javascript">
                    	function validepopupform2(ckode_formulir){
                    		window.opener.document.' . $return_form . '.no_formulir.value=ckode_formulir;
                            self.close();
                        }
                    </script>';
            }
        } else {

        }

        $title = 'Data Formulir';
        $submenu = "fitur_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>