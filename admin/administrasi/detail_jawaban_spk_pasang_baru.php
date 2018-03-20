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

        enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Prospek"); // for create log in newfunction2.php

        global $conn;

        if (isset($_GET['id_jawaban_spk_pasang_baru'])) {

            // untuk mengambil nilai pada url
            $id_jawaban_spk_pasang_baru = isset($_GET['id_jawaban_spk_pasang_baru']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_jawaban_spk_pasang_baru']))) : "";

            $sql_detail = mysql_query("SELECT * FROM `gx_jawab_spkpasang` WHERE `id_jawab_spkpasang` = '$id_jawaban_spk_pasang_baru' LIMIT 0,1;", $conn);
            $row_detail = mysql_fetch_array($sql_detail);

            $data_array_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$row_detail[id_teknisi]'", $conn));
            $data_array_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `kode_pegawai`='$row_detail[id_marketing]'", $conn));

            $sql_data = "SELECT * FROM `gx_link_budget` WHERE `no_linkbudget` = '" . $row_detail["id_linkbudget"] . "';";
            $query_data = mysql_query($sql_data, $conn);
            $row_data = mysql_fetch_array($query_data);

            $kode_spk_aktivasi = "";
            $kode_spk_pasang = $row_detail["kode_jawab_spk"];


        }

        $content = '
		    <!-- Main content -->
		    <section class="content">
		        <div class="row">
			        <div class="col-xs-12">
			            <div class="box">
				            <div class="box-header">
					            <h2 class="box-title">Detail Jawaban SPK Pasang Baru</h2>
				            </div>
				            
				            <div class="box-body">
                                <table style="margin-bottom: 0;width:60%">
                                        <tbody>
                                            <tr>
                                                <td>No. Jawaban SPK Pasang Baru</td>
                                                <td>' . $row_detail["kode_jawab_spk"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>No. SPK Pasang Baru</td>
                                                <td>' . $row_detail["kode_spk"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>' . $row_detail["tanggal"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Kode Customer</td>
                                                <td>' . $row_detail["id_customer"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Customer</td>
                                                <td>' . $row_detail["nama_customer"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>ID Cabang</td>
                                                <td>' . $row_detail["id_cabang"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Cabang</td>
                                                <td>' . $row_detail["nama_cabang"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>No. Link Budget</td>
                                                <td>' . $row_detail["id_linkbudget"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Paket Koneksi</td>
                                                <td>' . $row_detail["paket_koneksi"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Koneksi</td>
                                                <td>' . $row_detail["nama_koneksi"] . '</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>User ID</td>
                                                <td>' . $row_detail["user_id"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Telp</td>
                                                <td>' . $row_detail["telpon"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>' . $row_detail["alamat"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Teknisi</td>
                                                <td>' . $data_array_teknisi["nama"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Marketing</td>
                                                <td>' . $data_array_marketing["nama"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Pekerjaan</td>
                                                <td>' . $row_detail["pekerjaan"] . '</td>
                                            </tr>
                                            <tr>
                                                <td>Solusi</td>
                                                <td>' . $row_detail["solusi"] . '</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" width="100%" align="center" >
                                                <!--<br><a href="javascript:history.go(-1)"> go back</a><br>-->
                                                </td>
                                            </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
			      
			            <div class="box box-solid box-info">
                            <div class="box-header">
                                <h3 class="box-title">Data Update Alat</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>No. Link Budget</label>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="text" class="form-control" id="no_linkbudget" name="no_linkbudget" required="" readonly="" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['no_linkbudget'] : "") . '">
                                        </div>
                                    </div>
                                </div>';

        if (isset($_GET['spk'])) {
            $content .= '
                <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						    <label>No. Jawab SPK</label>
					    </div>
					    <div class="col-xs-6">
						    <input type="text" class="form-control" id="kode_spk_pasang" name="kode_spk_pasang" required="" readonly="" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $kode_spk_pasang : "") . '">
					    </div>
					</div>
				</div>';
        } elseif (isset($_GET['aktivasi'])) {
            $content .= '
                <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						    <label>No. Jawab SPK</label>
					    </div>
					    <div class="col-xs-6">
						    <input type="text" class="form-control" id="kode_spk_aktivasi" name="kode_spk_aktivasi" required="" readonly="" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $kode_spk_aktivasi : "") . '">
					    </div>
					</div>
				</div>';
        }


        $content .= '
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label>Kode Customer</label>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" readonly="" required="" name="kode_customer" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['kode_cust'] : "") . '">
                                        </div>
                                        <div class="col-xs-2">
                                            <label>Nama Customer</label>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" id="nama" name="nama" readonly="" required="" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['nama_cust'] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label>Longitude</label>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" readonly name="longitude" id="longitude" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['longitude'] : "") . '">
                                        </div>
                                        <div class="col-xs-2">
                                            <label>Latitude</label>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" readonly id="latitude" name="latitude" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['latitude'] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label>No. Tiang Terdekat</label>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" readonly name="no_tiang" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['tiang_terdekat'] : "") . '">
                                        </div>
                                        <div class="col-xs-2">
                                            <label>Name Created</label>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control" readonly="" name="name_created" value="' . (isset($_GET["id_jawaban_spk_pasang_baru"]) ? $row_data['user_created'] : "") . '">
                                        </div>
                                    </div>
                                </div>
                                
                                <table style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table width="100%" cellspacing="10" class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th width="10%">No.</th>
                                                            <th width="17%">Kode</th>
                                                            <th width="35%">Nama</th>
                                                            <th align="right" width="17%">QTY</th>
                                                            <th align="right" width="17%">SN</th>
                                                        </tr>';
        if (isset($_GET["id_jawaban_spk_pasang_baru"])) {
            if ($kode_spk_pasang != "") {
                $sql_spk = "AND `kode_spk_pasang` = '" . $kode_spk_pasang . "'";
            } elseif ($kode_spk_aktivasi != "") {
                $sql_spk = "AND `kode_spk_aktivasi` = '" . $kode_spk_aktivasi . "'";
            }

            $sql_data_alat = "SELECT * FROM `gx_alat_pasang` WHERE `no_linkbudget` = '" . $row_data["no_linkbudget"] . "' $sql_spk;";
            $query_data_alat = mysql_query($sql_data_alat, $conn);
            $no = 1;
            while ($row_alat = mysql_fetch_array($query_data_alat)) {

                $content .= '
                    <tr>
                        <td>' . $no . '.</td>
                        <td>' . $row_alat["kode_barang"] . '</td>
                        <td>' . $row_alat["nama_barang"] . '</td>
                        <td>' . $row_alat["qty"] . '</td>
                        <td>' . $row_alat["serial_number"] . '</td>
	                </tr>';

                $no++;
            }
        } else {

            $content .= '<tr><td colspan="7">&nbsp;</td></tr>';
        }

        $content .= '		
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                   $(\'#Prospek_history\').dataTable({
                       "bPaginate": true,
                       "bLengthChange": false,
                       "bFilter": false,
                       "bSort": false,
                       "bInfo": true,
                       "bAutoWidth": false
                   });
                   $(\'#email_history\').dataTable({
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
                $(function () {
                    $(\'#myTab a:first\').tab(\'show\')
                })
            </script>';

        $title = 'Mailbox';
        $submenu = "mailbox";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>