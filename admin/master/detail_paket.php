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

        global $conn;


        if (isset($_GET["id"])) {

            $id_paket = isset($_GET['id']) ? (int)$_GET['id'] : '';
            $query_paket = "SELECT * FROM `gx_paket2` WHERE `id_paket`='" . $id_paket . "' LIMIT 0,1;";

            $sql_paket = mysql_query($query_paket, $conn);
            $row_paket = mysql_fetch_array($sql_paket);

        }

        $selected_internet_type = isset($_GET["id"]) ? $row_paket["internet_type"] : "";
        $selected_jenis_paket = isset($_GET["id"]) ? $row_paket["jenis_paket"] : "";
        $selected_internet_paket = isset($_GET["id"]) ? $row_paket["internet_paket"] : "";
        $selected_voip = isset($_GET["id"]) ? $row_paket["voip"] : "";
        $selected_video = isset($_GET["id"]) ? $row_paket["video"] : "";

        $selected_backbone1 = isset($_GET["id"]) ? $row_paket["backbone_1"] : "";
        $selected_backbone2 = isset($_GET["id"]) ? $row_paket["backbone_2"] : "";
        $selected_backbone3 = isset($_GET["id"]) ? $row_paket["backbone_3"] : "";
        $selected_restitusi = isset($_GET["id"]) ? $row_paket["restitusi"] : "";
        $selected_link = isset($_GET["id"]) ? $row_paket["link"] : "";
        $selected_pajak = isset($_GET["id"]) ? $row_paket["faktur_pajak"] : "";

        $content = '
                <section class="content-header">
                    <h1>
                        Master Paket
                    </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Paket</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Cabang</label>
                                            </div>
                                            <div class="col-xs-6">';

        $sql_gxCabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '" . $row_paket["id_cabang"] . "' AND `level` = '0' ORDER BY `nama_cabang` ASC", $conn);
        $row_gxcabang = mysql_fetch_array($sql_gxCabang);
        $content .= $row_gxcabang["nama_cabang"];


        $content .= '
					                        </div>
                                        </div>
					                </div>
					
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Kode Paket</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" readonly="" name="kode_paket" value="' . (isset($_GET['id']) ? $row_paket["kode_paket"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Nama Paket</label>
                                            </div>
                                            <div class="col-xs-6">
                                            <input type="text" class="form-control" readonly="" name="nama_paket" value="' . (isset($_GET['id']) ? $row_paket["nama_paket"] : "") . '">
                                                ' . (isset($_GET['id']) ? '<input type="hidden" name="id_paket" value="' . $id_paket . '">' : "") . '
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Jenis Paket</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="jenis_paket" type="radio" readonly="" name="jenis_paket" value="regular" ' . (($selected_jenis_paket == "regular") ? ' checked=""' : "") . ' /> Regular
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="jenis_paket" type="radio" readonly="" name="jenis_paket" value="promo" ' . (($selected_jenis_paket == "promo") ? ' checked=""' : "") . ' /> Promo
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Periode Paket</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control"  readonly="" id="datepicker" class="hasDatepicker" name="periode_start" value="' . (isset($_GET['id']) ? $row_paket["periode_start"] : date("Y-m-d")) . '">
                                            </div>
                                            <div class="col-xs-3">
                                                sampai
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" id="datepicker2" class="hasDatepicker" name="periode_end" value="' . (isset($_GET['id']) ? $row_paket["periode_end"] : date("2099-m-d")) . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Internet</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="internet_type" type="radio" disabled="" name="internet_type" value="fo" ' . (($selected_internet_type == "fo") ? ' checked=""' : "") . ' /> Fiber Optic
                                            
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="internet_type" type="radio" disabled="" name="internet_type" value="wireless" ' . (($selected_internet_type == "wireless") ? ' checked=""' : "") . ' /> Wireless
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="internet_type" type="radio" disabled="" name="internet_type" value="lain" ' . (($selected_internet_type == "lain") ? ' checked=""' : "") . ' /> lain
                                                <input type="text" id="internet_type_ket" readonly="" name="internet_type_ket" value="' . (($selected_internet_type == "lain") ? $row_paket["internet_type_ket"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3"></div>
                                            <div class="col-xs-3">
                                                <input id="internet_paket" type="radio" disabled="" name="internet_paket" value="residential" ' . (($selected_internet_paket == "residential") ? ' checked=""' : "") . ' /> Residential
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="internet_paket" type="radio" disabled="" name="internet_paket" value="soho" ' . (($selected_internet_paket == "soho") ? ' checked=""' : "") . ' /> SOHO
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="internet_paket" type="radio" disabled="" name="internet_paket" value="dl" ' . (($selected_internet_paket == "dl") ? ' checked=""' : "") . ' /> Dedicated Link
                                            </div>
                                    
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3"></div>
                                            <div class="col-xs-6">
                                                <input type="radio" name="internet_paket" disabled="" id="internet_paket" value="lain" ' . (($selected_internet_paket == "lain") ? ' checked=""' : "") . ' />Lain-lain
                                                <input type="text" id="internet_paket_ket" readonly="" name="internet_paket_ket" value="' . (($selected_internet_paket == "lain") ? $row_paket["internet_paket_ket"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                                        
                                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>VOIP</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="checkbox"  readonly="" name="voip" value="voip" ' . (($selected_voip == "voip") ? ' checked=""' : "") . ' />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Video</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="checkbox"  readonly="" name="video" value="video" ' . (($selected_video == "video") ? ' checked=""' : "") . ' />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Restitusi</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="restitusi" disabled="" type="radio" name="restitusi" value="double_bw" ' . (($selected_restitusi == "double_bw") ? ' checked=""' : "") . ' /> Double BW
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="restitusi" disabled="" type="radio" name="restitusi" value="rupiah" ' . (($selected_restitusi == "rupiah") ? ' checked=""' : "") . ' /> Rupiah
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Setup Fee</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="setup_fee" value="' . (isset($_GET['id']) ? $row_paket["setup_fee"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Abonemen VOIP</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" maxlength="20" id="harga" name="abonemen_voip" value="' . (isset($_GET['id']) ? $row_paket["abonemen_voip"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>ACC Piutang VOIP</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" maxlength="20"  name="acc_piutang_voip" value="' . (isset($_GET['id']) ? $row_paket["acc_piutang_voip"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Abonemen Video</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" maxlength="20" id="harga" name="abonemen_video" value="' . (isset($_GET['id']) ? $row_paket["abonemen_video"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>ACC Piutang VOD</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly="" maxlength="20" name="acc_piutang_vod" value="' . (isset($_GET['id']) ? $row_paket["acc_piutang_vod"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Monthly Fee</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" readonly="" maxlength="20" id="harga" name="monthly_fee" value="' . (isset($_GET['id']) ? $row_paket["monthly_fee"] : "") . '">
                                            </div>
                                            <div class="col-xs-2">
                                                <label>PerBulan</label>
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="text" class="form-control" readonly="" maxlength="4"  name="monthly_for" value="' . (isset($_GET['id']) ? $row_paket["monthly_for"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>ACC Piutang Internet</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" class="form-control" readonly=""  maxlength="20"  name="acc_piutang_inet" value="' . (isset($_GET['id']) ? $row_paket["acc_piutang_inet"] : "") . '">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Harga Non-Kontrak</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="harga_nonkontrak" value="' . (isset($_GET['id']) ? $row_paket["harga_nonkontrak"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Lama Kontrak</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="lama_kontrak" value="' . (isset($_GET['id']) ? $row_paket["lama_kontrak"] : "") . '"> Bulan
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Maintenance Free</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" maxlength="2" name="maintenance_free" value="' . (isset($_GET['id']) ? $row_paket["maintenance_free"] : "") . '">
                                                SPK Maintenance
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Maintenance Fee</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="maintenance_fee" value="' . (isset($_GET['id']) ? $row_paket["maintenance_fee"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Service Perangkat/Bulan</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="service_perangkat" value="' . (isset($_GET['id']) ? $row_paket["service_perangkat"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>ACC Piutang</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="acc_piutang" value="' . (isset($_GET['id']) ? $row_paket["acc_piutang"] : "") . '">
                                            </div>
                                            <div class="col-xs-3">
                                                <label>ACC Uang Muka</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" class="form-control" name="acc_um" value="' . (isset($_GET['id']) ? $row_paket["acc_um"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Faktur Pajak</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="faktur_pajak" disabled="" type="radio" name="faktur_pajak" value="yes" ' . (($selected_pajak == "yes") ? ' checked=""' : "") . ' /> Yes
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="faktur_pajak" disabled="" type="radio" name="faktur_pajak" value="no" ' . (($selected_pajak == "no") ? ' checked=""' : "") . ' /> No
                                            </div>
                                        
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Group RBS</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="group_rbs" value="' . (isset($_GET['id']) ? $row_paket["group_rbs"] : "") . '">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Account Index RBS</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="account_index" value="' . (isset($_GET['id']) ? $row_paket["account_index"] : "") . '">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>SLA</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly=""name="sla_paket" value="' . (isset($_GET['id']) ? $row_paket["sla_paket"] : "") . '"> % 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Bandwidth Usage</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" name="bandwith_usage" value="' . (isset($_GET['id']) ? $row_paket["bandwith_usage"] : "") . '"> MB
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Bandwidth Upload</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" name="bw_upload" value="' . (isset($_GET['id']) ? $row_paket["bw_upload"] : "") . '"> Mbps
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Bandwidth Download</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="text" readonly="" name="bw_download" value="' . (isset($_GET['id']) ? $row_paket["bw_download"] : "") . '"> Mbps
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Burst</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" readonly="" class="form-control" name="burst" value="' . (isset($_GET['id']) ? $row_paket["burst"] : "") . '">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Link yg Dipakai</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="link" disabled="" type="radio" name="link" value="1" ' . (($selected_link == "1") ? ' checked=""' : "") . ' /> Single Link
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="link"  disabled="" type="radio" name="link" value="2" ' . (($selected_link == "2") ? ' checked=""' : "") . ' /> Double Link
                                            </div>
                                            <div class="col-xs-3">
                                                <input id="link" disabled="" type="radio" name="link" value="3" ' . (($selected_link == "3") ? ' checked=""' : "") . ' /> Triple Link
                                            </div>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label>Backup Backbone</label>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="checkbox" disabled="" name="backbone_1" value="telkom" ' . (($selected_backbone1 == "telkom") ? ' checked=""' : "") . '> TELKOM<br>
                                                <input type="checkbox" disabled="" name="backbone_2" value="indosat" ' . (($selected_backbone2 == "indosat") ? ' checked=""' : "") . '> INDOSAT<br>
                                                <input type="checkbox" disabled="" name="backbone_3" value="lintasarta" ' . (($selected_backbone3 == "lintasarta") ? ' checked=""' : "") . '> LintasArta<br>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                &nbsp;
                                            </div>
                                            <div class="col-xs-6">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

        $plugins = '';


        $title = 'Detail Paket';
        $submenu = "paket";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header('location: ' . URL_ADMIN . 'logout.php');
}

?>