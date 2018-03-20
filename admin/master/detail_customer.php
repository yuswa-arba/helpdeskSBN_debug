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
		$conn_soft = Config::getInstanceSoft(); // koneksi ada di configuration_admin.php

        /** ====================================================================
         * Mengambil data yang akan ditampilkan sesuai dengan id yang ada di url
         * =================================================================== */
        if (isset($_GET["id"])) {
            $cKode = isset($_GET['id']) ? strip_tags(trim($_GET['id'])) : '';
            $query_customer = "SELECT * FROM `tbCustomer` WHERE `cKode`='" . $cKode . "' AND `id_cabang` = '" . $loggedin['cabang'] . "' AND `level` = '0' LIMIT 0,1;";
            $sql_customer = mysql_query($query_customer, $conn);
            $row_customer = mysql_fetch_array($sql_customer);

            $sql_rbs = "SELECT TOP 1 [GracePeriodExpiration] FROM [Users] WHERE [UserIndex] = '" . $row_customer["iuserIndex"] . "';";
            $query_rbs = $conn_soft->prepare($sql_rbs);
            $query_rbs->execute();
            $row_rbs = $query_rbs->fetch();
            $grace = date("d-m-Y", strtotime($row_rbs["GracePeriodExpiration"]));

            $query_promosi = "SELECT * FROM `gx_duta_promosi` WHERE `kode_customer`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_promosi = mysql_query($query_promosi, $conn);
            $row_promosi = mysql_fetch_array($sql_promosi);

            $query_login = "SELECT `username` FROM `gxLogin` WHERE `customer_number`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_login = mysql_query($query_login, $conn);
            $row_login = mysql_fetch_array($sql_login);

            $query_foto = "SELECT * FROM `gxFoto_Profile` WHERE `cKode`='" . $cKode . "' AND `level` = '0' LIMIT 0,1;";
            $sql_foto = mysql_query($query_foto, $conn);
            $row_foto = mysql_fetch_array($sql_foto);

            $query_foto2 = "SELECT * FROM `gx_file_customer` WHERE `id_customer`='" . $cKode . "' AND `level` = '0' ORDER BY `date_add` DESC LIMIT 0,1;";
            $sql_foto2 = mysql_query($query_foto2, $conn);
            $row_foto2 = mysql_fetch_array($sql_foto2);

            enableLog("", $loggedin["username"], $loggedin["id_employee"], "view detail customer id=$cKode");
        } else {
            enableLog("", $loggedin["username"], $loggedin["id_employee"], "detail customer");
        }


        $content = '
                <!-- Main content -->
    <section class="content">
        <div class="row">
            <section class="col-lg-12"> 
                <div class="box box-solid box-info">
                    <div class="box-header">
                        <h3 class="box-title">Detail Customer</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="" name="customer" id="customer" role="form" method="post" enctype="multipart/form-data">
	    
                        <div class="box-body">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Customer</a></li>
	                                <li><a href="#tab_2" data-toggle="tab">File</a></li>
                                    <li><a href="#tab_login" data-toggle="tab">Data Login</a></li>
	                                <li><a href="#tab_linkbudget" data-toggle="tab">Link Budget</a></li>
	                                <li><a href="#tab_inet" data-toggle="tab">Network</a></li>
	                                <li><a href="#tab_voip" data-toggle="tab">VOIP</a></li>
	                                <li><a href="#tab_vod" data-toggle="tab">VOD</a></li>
	                                <li><a href="#tab_history" data-toggle="tab">History</a></li>
	                                <li><a href="#tab_gift" data-toggle="tab">Gift</a></li>
	                                <li><a href="#tab_mrtg" data-toggle="tab">MRTG</a></li>
	                                <li><a href="#tab_investasi" data-toggle="tab">Investasi</a></li>
	                                <li><a href="#tab_promosi" data-toggle="tab">Duta Promosi</a></li>
	                                <li><a href="#tab_resume" data-toggle="tab">Resume Customer</a></li>
                                </ul>
                    
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
	                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Customer Balance</label>
                                                </div>
                                                <div class="col-xs-9">
                                                    ' . (isset($_GET['id']) ? Rupiah($row_customer["gx_saldo"]) : "") . '
                                                </div>
                                            </div>
                                        </div>
		                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Cabang</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    ' . get_nama_cabang($row_customer["id_cabang"]) . '	
                                                </div>
                                                <div class="col-xs-3">
                                                    <label>Kode Customer</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    ' . (isset($_GET['id']) ? $row_customer["cKode"] : '') . '
                                                </div>
                                            </div>
                                        </div>
					                    
					                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Nama Customer</label>
                                                </div>
                                                <div class="col-xs-9">
                                                    ' . (isset($_GET['id']) ? $row_customer["cNama"] : "") . '
                                                </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Nama Perusahaan</label>
                                                </div>
                                                <div class="col-xs-9">
                                                    ' . (isset($_GET['id']) ? $row_customer["cNamaPers"] : "") . '
                                                </div>
                                            </div>
					                    </div>
                                                            
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Alamat</label>
                                                </div>
                                                <div class="col-xs-9">
                                                    ' . (isset($_GET['id']) ? $row_customer["cAlamat1"] : "") . '
                                                </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Kelurahan</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    ' . (isset($_GET['id']) ? $row_customer["cArea"] : "") . '
                                                </div>
                                                <div class="col-xs-3">
                                                    <label>Kecamatan</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    ' . (isset($_GET['id']) ? $row_customer["cDaerah"] : "") . '
                                                </div>
                                            </div>
					                    </div>
					                    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Kota</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cKota"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>No. Telpon</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["ctelp"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>No HP 1</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cNoHp1"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                    	        <label>No HP 2</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cNoHp2"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Contact Person</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cContact"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Tanggal Lahir</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? date("Y-m-d", strtotime($row_customer["dTglLahir"])) : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                     <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Email Address</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cEmail"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Email Address Intern</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cMailIntern"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>User ID</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cUserID"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Password</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cPassword"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Kode Paket</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cKdPaket"] : "") . '
					                    	    
					                            </div>
					                            <div class="col-xs-3">
					                    	        <label>Grace</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? $row_customer["nterm"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Nama Paket</label>
					                            </div>
					                            <div class="col-xs-6">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cPaket"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Kontrak</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? date("Y-m-d", strtotime($row_customer["dTglMulai"])) : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                    	        <label>s/d</label>
					                            </div>
					                            <div class="col-xs-3">
					                    	        ' . (isset($_GET['id']) ? date("Y-m-d", strtotime($row_customer["dTglBerhenti"])) : date("Y-m-d", strtotime("+ 10 Years"))) . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>PPN</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . ((isset($_GET["id"]) && $row_customer["cIncludePPN"] == "1") ? 'Include PPN' : "") . '
					                    	        ' . ((isset($_GET["id"]) && $row_customer["cExcludePPN"] == "1") ? 'Exclude PPN' : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-12">
					                    	        <h3>NPWP</h3>
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>No NPWP</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["nama_npwp"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Nama NPWP</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["nama_npwp"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Alamat NPWP</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["alamat_npwp"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Nama Ibu Kandung</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cNamaIbu"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">    
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>No Virtual Account</label>
					                            </div>
					                            <div class="col-xs-9">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cNoRekVirtual"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>Marketing</label>
					                            </div>
					                            <div class="col-xs-6">
					                    	        ' . (isset($_GET['id']) ? $row_customer["cSales"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                    	        <label>No ACC Justifikasi</label>
					                            </div>
					                            <div class="col-xs-6">
					                    	        ' . (isset($_GET['id']) ? $row_customer["id_acc_justifikasi"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        		<label>Status</label>
					                            </div>
					                            <div class="col-xs-9">
					                        		' . (isset($_GET['id']) ? $row_customer["gx_status"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        		<label>Blokir per tanggal :</label>
					                            </div>
					                            <div class="col-xs-9">
					                        		' . (isset($_GET['id']) ? date("d M Y", strtotime($grace . "+1 days")) : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        		<label>Grace per tanggal :</label>
					                            </div>
					                            <div class="col-xs-9">
					                        		' . (isset($_GET['id']) ? date("d M Y", strtotime($row_rbs["GracePeriodExpiration"])) : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    ' . ((isset($_GET["id"]) && $row_customer["tipe_koneksi"] == "wireless") ? '
    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        		<label>Nonaktif per tanggal :</label>
					                            </div>
					                            <div class="col-xs-9"></div>
                                            </div>
					                    </div>
					                    
					                    ' : "") . '
					                    
					                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label>Bongkar per tanggal :</label>
                                                </div>
                                                <div class="col-xs-9"></div>
                                            </div>
					                    </div>
					                    
					                </div><!-- /.tab-pane -->
					                    
				                    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>ID Card</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    ' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/customer/' . $row_foto2["id_card"] . '" class="lightbox">view</a>' : "") . '
                                                </div>
                                            </div>
                                        </div>
					                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Akta Terakhir</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    ' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/customer/' . $row_foto2["akta"] . '" class="lightbox">view</a>' : "") . '
                                                </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                    	        <label>TDP</label>
					                            </div>
					                            <div class="col-xs-4">
					                    	        ' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/customer/' . $row_foto2["tdp"] . '" class="lightbox">view</a>' : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                    	        <label>NPWP</label>
					                            </div>
					                            <div class="col-xs-4">
					                    	        ' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/customer/' . $row_foto2["npwp"] . '" class="lightbox">view</a>' : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                    	        <label>Lain lain</label>
					                            </div>
					                            <div class="col-xs-4">
					                    	        ' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/customer/' . $row_foto2["lain_lain"] . '" class="lightbox">view</a>' : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
                                                <div class="col-xs-4">
                                                    <label>Galeri</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    ' . (isset($_GET['id']) ? '<a href="" onclick="return valideopenerform(\'galeri.php?id=' . $row_customer["cKode"] . '\',\'galeri\');">view</a>' : "") . '
                                                </div>
                                            </div>
					                    </div>
					                    
					                    <!--<div class="form-group">
					                    <div class="row">
					                        <div class="col-xs-4">
					                    	<label>Photo</label>
					                        </div>
					                        <div class="col-xs-8">
					                    	<input type="hidden" name="idFoto" value="' . (isset($_GET['id']) ? $row_foto["idFoto"] : "") . '">
					                    	<img id="preview" src="' . (isset($_GET['id']) ? URL_ADMIN . 'img/customer/' . $row_foto["file_foto"] : "") . '" alt="Preview Image" /><br>		
					                    	<input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" />
					                        </div>
                                                            </div>
					                    </div>-->
					                    
                                    </div><!-- /.tab-pane -->
                                    
                                    <div class="tab-pane" id="tab_login">
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                    	        <label>Username</label>
					                            </div>
					                            <div class="col-xs-8">
					                    	        ' . (isset($_GET['id']) ? $row_login["username"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                    	        <label>Password</label>
					                            </div>
					                            <div class="col-xs-8">
					                    	        ***
					                            </div>
                                            </div>
					                    </div>
                                    </div><!-- /.tab-pane -->
				                        
				                    <div class="tab-pane" id="tab_inet">
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        		<label>Longitude</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	' . (isset($_GET['id']) ? $row_customer["cLongi"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                        		<label>Latitude</label>
					                            </div>
					                            <div class="col-xs-3">
					                        		' . (isset($_GET['id']) ? $row_customer["cLati"] : "") . '
					                            </div>
                                            </div>
					                    </div>
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>IP AP</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["ip_ap"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                        	    <label>IP WL</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["ip_wl"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>IP BTS</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["ip_bts"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                        	    <label>Mac Address</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["cMacAdd"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>BTS</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["bts"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                        	    <label>Acc Type RBS</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["acc_type_rbs"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>User IP</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["user_ip"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                        	    <label>User Index RBS</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["iuserIndex"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>Group RBS</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["cGroupRBS"] : "") . '
					                            </div>
					                            <div class="col-xs-3">
					                        	    <label>Kode NAS Attribute</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["cKdNAS"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>NAS Attribute</label>
					                            </div>
					                            <div class="col-xs-9">
					                        	    ' . (isset($_GET['id']) ? $row_customer["NASAttribute"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>DDNS</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["ddns"] : "") . '
					                            </div>
                                              </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>IP Internet</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["ip_inet"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>IP Blokir</label>
					                            </div>
					                            <div class="col-xs-3">
					                        	    ' . (isset($_GET['id']) ? $row_customer["ip_blokir"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>Profile Grace</label>
					                            </div>
					                            <div class="col-xs-6">
					                        	    ' . (isset($_GET['id']) ? $row_customer["profile_grace"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-3">
					                        	    <label>Profile Aktif</label>
					                            </div>
					                            <div class="col-xs-6">
					                        	    ' . (isset($_GET['id']) ? $row_customer["profile_aktif"] : "") . '
					                            </div>
                                            </div>
					                    </div>
					
                                    </div><!-- /.tab-pane -->
				    
				                    <div class="tab-pane" id="tab_promosi">
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                        	    <label>Nama</label>
					                            </div>
					                            <div class="col-xs-8">
					                        	    <input type="hidden" readonly="" name="id_dutapromosi" value="' . (isset($_GET['id']) ? $row_promosi["id_dutapromosi"] : "") . '">
					                        	    <input type="text" class="form-control" readonly="" name="promosi_nama" value="' . (isset($_GET['id']) ? $row_promosi["nama"] : "") . '">
					                            </div>
                                            </div>
					                    </div>
					                    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                        	    <label>Alamat</label>
					                            </div>
					                            <div class="col-xs-8">
					                        	    <textarea class="form-control" readonly="" name="promosi_alamat" cols="10" rows="6" style="resize:none;">' . (isset($_GET['id']) ? $row_promosi["alamat"] : "") . '</textarea>
					                            </div>
                                            </div>
					                    </div>
					                    
                                        <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                        	    <label>No Rekening</label>
					                            </div>
					                            <div class="col-xs-8">
					                        	    <input type="text" class="form-control" readonly="" name="promosi_norek" value="' . (isset($_GET['id']) ? $row_promosi["no_rek"] : "") . '">
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                        	    <label>Formulir 1</label>
					                            </div>
					                            <div class="col-xs-8">
					                        	    ' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/promosi/' . $row_promosi["formulir1"] . '" class="lightbox">view</a>' : "") . '
					                        	
					                            </div>
                                            </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <div class="row">
					                            <div class="col-xs-4">
					                        	<label>Formulir 2</label>
					                            </div>
					                            <div class="col-xs-8">
					                        	' . (isset($_GET['id']) ? '<a href="' . URL_ADMIN . 'upload/promosi/' . $row_promosi["formulir2"] . '" class="lightbox">view</a>' : "") . '
					                            </div>
                                            </div>
					                    </div>
					
                                    </div><!-- /.tab-pane -->
				    
				                    <div class="tab-pane" id="tab_linkbudget">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" style="width: 100%;">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Link Budget</th>
                                                    <th>Tanggal</th>
                                                    <th>Last Updated by</th>
                                                    <th>Actions</th>
                                                </tr>';

        $query_linkbudget = mysql_query("SELECT * FROM `gx_link_budget` WHERE `kode_cust` = '" . $cKode . "' LIMIT 0,10;", $conn);
        $nolb = 1;
        while ($row_linkbudget = mysql_fetch_array($query_linkbudget)) {

            $content .= '
            <tr>
                <td>' . $nolb . '.</td>
                <td>' . $row_linkbudget["no_linkbudget"] . '</a></td>
                <td>' . $row_linkbudget["tanggal"] . '</td>
                <td>' . $row_linkbudget["user_upd"] . '</td>
                <td><a href="' . URL_ADMIN . 'administrasi/detail_link_budget.php?id=' . $row_linkbudget["id_link_budget"] . '"
                onclick="return valideopenerform(\'' . URL_ADMIN . 'administrasi/detail_link_budget.php?id=' . $row_linkbudget["id_link_budget"] . '\',\'link_budget\');">Detail</a>
            </tr>';
            $nolb++;
        }

        $content .= '
					                            </table>
					                        </div>
					
                                        </div><!-- /.tab-pane -->
				    
				                        <div class="tab-pane" id="tab_resume">
                                            <div class="table-responsive">
                                                <h4>SPK Survey</h4>
                                                <table class="table table-bordered table-striped" style="width: 100%;">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Last Updated by</th>
                                                        <th>Actions</th>
                                                    </tr>';

        $query_survey = mysql_query("SELECT * FROM `gx_survey` WHERE `kode_cust` = '" . $cKode . "' LIMIT 0,10;", $conn);
        $nos = 1;
        while ($row_survey = mysql_fetch_array($query_survey)) {

            $content .= '<tr>
		    <td>' . $nos . '.</td>
		    <td>' . $row_survey["no_spk_survey"] . '</a></td>
		    <td>' . $row_survey["tanggal"] . '</td>
		    <td></td>
		    <td>' . $row_survey["user_upd"] . '</td>
		    <td><a href="' . URL_ADMIN . 'administrasi/detail_survey.php?id_survey=' . $row_survey["id_survey"] . '"
		    onclick="return valideopenerform(\'' . URL_ADMIN . 'administrasi/detail_survey.php?id_survey=' . $row_survey["id_survey"] . '\',\'detail survey\');">Detail</a>
		</tr>';
            $nolb++;
        }

        $content .= '
					                            </table>
					                            
					                            <h4>SPK Pasang Baru</h4>
					                            
					                            <table class="table table-bordered table-striped" style="width: 100%;">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Last Updated by</th>
                                                        <th>Actions</th>
                                                    </tr>';

        $query_pasang = mysql_query("SELECT * FROM `gx_spk_pasang` WHERE `id_customer` = '" . $cKode . "' LIMIT 0,10;", $conn);
        $nos = 1;
        while ($row_pasang = mysql_fetch_array($query_pasang)) {
            $sql_jawab_pasang = mysql_query("SELECT * FROM `gx_jawab_spkpasang` WHERE `kode_spk` = '" . $row_pasang["kode_spk"] . "' LIMIT 0,1;", $conn);
            $row_jawabpasang = mysql_fetch_array($sql_jawab_pasang);
            $content .= '<tr>
		    <td>' . $nos . '.</td>
		    <td>' . $row_pasang["kode_spk"] . '</a></td>
		    <td>' . $row_pasang["tanggal"] . '</td>
		    <td>' . $row_jawabpasang["status"] . '</td>
		    <td>' . $row_pasang["user_upd"] . '</td>
		    <td><a href="' . URL_ADMIN . 'administrasi/detail_spk_pasang_baru.php?id_spk_pasang_baru=' . $row_pasang["id_spkpasang"] . '"
		    onclick="return valideopenerform(\'' . URL_ADMIN . 'administrasi/detail_spk_pasang_baru.php?id_spk_pasang_baru=' . $row_pasang["id_spkpasang"] . '\',\'detail survey\');">Detail</a>
		</tr>';
            $nos++;
        }

        $content .= '
					                            </table>
					                            
					                            <h4>SPK Aktivasi</h4>
					                            
					                            <table class="table table-bordered table-striped" style="width: 100%;">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Last Updated by</th>
                                                        <th>Actions</th>
                                                    </tr>';

        $query_aktivasi = mysql_query("SELECT * FROM `gx_spk_aktivasi` WHERE `id_customer` = '" . $cKode . "' LIMIT 0,10;", $conn);
        $noa = 1;
        while ($row_aktivasi = mysql_fetch_array($query_aktivasi)) {
            $sql_jawab_aktivasi = mysql_query("SELECT * FROM `gx_jawab_spkaktivasi` WHERE `kode_spkaktivasi` = '" . $row_aktivasi["kode_spkaktivasi"] . "' LIMIT 0,1;", $conn);
            $row_jawabaktivasi = mysql_fetch_array($sql_jawab_aktivasi);
            $content .= '<tr>
		    <td>' . $noa . '.</td>
		    <td>' . $row_aktivasi["kode_spkaktivasi"] . '</a></td>
		    <td>' . $row_aktivasi["tanggal"] . '</td>
		    <td>' . $row_jawabaktivasi["status"] . '</td>
		    <td>' . $row_aktivasi["user_upd"] . '</td>
		    <td><a href="' . URL_ADMIN . 'administrasi/detail_spk_aktivasi_baru.php?id=' . $row_aktivasi["id_spkaktivasi"] . '"
		    onclick="return valideopenerform(\'' . URL_ADMIN . 'administrasi/detail_spk_aktivasi_baru.php?id_survey=' . $row_aktivasi["id_spkaktivasi"] . '\',\'detail survey\');">Detail</a>
		</tr>';
            $noa++;
        }

        $content .= '
					                            </table>
					                        </div>
					
                                        </div><!-- /.tab-pane -->
									
					                    <div class="tab-pane" id="tab_voip">
						                    <div class="table-responsive">
							                    VOIP
						                    </div>
					
                                        </div><!-- /.tab-pane -->
					
                                        <div class="tab-pane" id="tab_vod">
                                            <div class="table-responsive">
                                                VOD
                                            </div>
                                        
                                        </div><!-- /.tab-pane -->
				    
                                    </div><!-- /.tab-content -->
                                </div><!-- nav-tabs-custom -->
                            </div><!-- /.box-body -->
				       
                        </form>
                    </div><!-- /.box -->
                </section>
			
            </div>

        </section><!-- /.content -->';

        $plugins = '
        <!-- Colorbox -->
        <link media="screen" rel="stylesheet" type="text/css" href="' . URL . 'js/colorbox/example1/colorbox.css" />
        <script src="' . URL . 'js/colorbox/jquery.colorbox.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //Examples of how to assign the ColorBox event to elements
                $(".lightbox").colorbox({width:"75%", height:"75%"});
            });
        </script>';

        $title = 'Master Customer';
        $submenu = "master_customer";
        $user = ucfirst($loggedin["username"]);
        $group = $loggedin['group'];
        $cabang = get_nama_cabang($loggedin['cabang']);

        $template = admin_theme($title, $content, $plugins, $user, $submenu, $group, $cabang); // mengembalikan tampilan ke config/admin/template_2016.php

        echo $template;
    }
} else {
    header("location: " . URL_ADMIN . "logout.php");
}

?>