<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;


if(isset($_POST["save"]))
{
    
    //echo "save";
    $no_persetujuan_justifikasi	= isset($_POST['no_persetujuan_justifikasi']) ? mysql_real_escape_string(trim($_POST['no_persetujuan_justifikasi'])) : '';
    $no_control_justifikasi	= isset($_POST['no_control_justifikasi']) ? mysql_real_escape_string(trim($_POST['no_control_justifikasi'])) : '';
    $nama_control_justifikasi	= isset($_POST['nama_control_justifikasi']) ? mysql_real_escape_string(trim($_POST['nama_control_justifikasi'])) : '';
    $no_justifikasi		= isset($_POST['no_justifikasi']) ? mysql_real_escape_string(trim($_POST['no_justifikasi'])) : '';
    $nama_justifikasi		= isset($_POST['nama_justifikasi']) ? mysql_real_escape_string(trim($_POST['nama_justifikasi'])) : '';
    $kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $latitude    		= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
    $longitude   		= isset($_POST['email_cabang']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
    $tiang_terdekat		= isset($_POST['tiang_terdekat']) ? mysql_real_escape_string(trim($_POST['tiang_terdekat'])) : '';
    $kode_paket	    = isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket	    = isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $kontrak	    = isset($_POST['kontrak']) ? mysql_real_escape_string(trim($_POST['kontrak'])) : '';
    $tanggal	    = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $setup_fee_normal		= isset($_POST['setup_fee_normal']) ? mysql_real_escape_string(trim($_POST['setup_fee_normal'])) : '';
    $setup_fee_justifikasi	= isset($_POST['setup_fee_justifikasi']) ? mysql_real_escape_string(trim($_POST['setup_fee_justifikasi'])) : '';
    $monthly_fee_normal	    	= isset($_POST['monthly_fee_normal']) ? mysql_real_escape_string(trim($_POST['monthly_fee_normal'])) : '';
    $monthly_fee_justifikasi    = isset($_POST['monthly_fee_justifikasi']) ? mysql_real_escape_string(trim($_POST['monthly_fee_justifikasi'])) : '';
    $abonemen_normal	    	= isset($_POST['abonemen_normal']) ? mysql_real_escape_string(trim($_POST['abonemen_normal'])) : '';
    $abonemen_justifikasi	= isset($_POST['abonemen_justifikasi']) ? mysql_real_escape_string(trim($_POST['abonemen_justifikasi'])) : '';
    $bandwith_normal	    	= isset($_POST['bandwith_normal']) ? mysql_real_escape_string(trim($_POST['bandwith_normal'])) : '';
    $bandwith_justifikasi	= isset($_POST['bandwith_justifikasi']) ? mysql_real_escape_string(trim($_POST['bandwith_justifikasi'])) : '';
    
    $remarks_justifikasi	= isset($_POST['remarks_justifikasi']) ? mysql_real_escape_string(trim($_POST['remarks_justifikasi'])) : '';
    $remarks_control	    	= isset($_POST['remarks_control']) ? mysql_real_escape_string(trim($_POST['remarks_control'])) : '';
    $detail_link	    	= isset($_POST['detail_link']) ? mysql_real_escape_string(trim($_POST['detail_link'])) : '';
    $remarks_acc	    	= isset($_POST['remarks_marketing']) ? mysql_real_escape_string(trim($_POST['remarks_marketing'])) : '';
    $total_linkbudget	    	= isset($_POST['total_linkbudget']) ? mysql_real_escape_string(trim($_POST['total_linkbudget'])) : '';
    
    $laba_rugi_bulanan	    = isset($_POST['laba_rugi_bulanan']) ? mysql_real_escape_string(trim($_POST['laba_rugi_bulanan'])) : '';
    $laba_rugi_tahunan	    = isset($_POST['laba_rugi_tahunan']) ? mysql_real_escape_string(trim($_POST['laba_rugi_tahunan'])) : '';
    $detail_linkbudget	    = isset($_POST['detail_linkbudget']) ? trim($_POST['detail_linkbudget']) : '';
    
    //insert into gx_control_justifikasi
    $sql_insert = "INSERT INTO `gx_persetujuan_justifikasi` (`id_persetujuan_justifikasi`, `no_persetujuan`,
									`no_justifikasi`, `nama_justifikasi`, `no_control_justifikasi`, `nama_control`, `tanggal`, `kode_customer`, `nama_customer`, `longitude`,
									`latitude`, `tiang_terdekat`, `kode_paket`, `nama_paket`, `kontrak`, `setup_fee_justifikasi`, `abonemen_justifikasi`, `monthly_fee_justifikasi`,
									`bandwith_justifikasi`, `remarks_justifikasi`, `total_link_budget`, `laba_rugi_bulan1`, `laba_rugi_pertahun`, `remarks_control`, `remarks_acc`,
									`detail_link_budget`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) 
								VALUES ('', '$no_persetujuan_justifikasi',
									'$no_justifikasi', '$nama_justifikasi', '$no_control_justifikasi', '$nama_control_justifikasi', '$tanggal', '$kode_customer', '$nama_customer', '$longitude',
									'$latitude', '$tiang_terdekat', '$kode_paket', '$nama_paket', '$kontrak', '$setup_fee_justifikasi', '$abonemen_justifikasi', '$monthly_fee_justifikasi',
									'$bandwith_justifikasi', '$remarks_justifikasi', '$total_linkbudget', '$laba_rugi_bulanan', '$laba_rugi_tahunan', '$remarks_control', '$remarks_acc',
									'$detail_link', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/persetujuan_justifikasi.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    
    
    $no_persetujuan_justifikasi	= isset($_POST['no_persetujuan_justifikasi']) ? mysql_real_escape_string(trim($_POST['no_persetujuan_justifikasi'])) : '';
    $no_control_justifikasi	= isset($_POST['no_control_justifikasi']) ? mysql_real_escape_string(trim($_POST['no_control_justifikasi'])) : '';
    $nama_control_justifikasi	= isset($_POST['nama_control_justifikasi']) ? mysql_real_escape_string(trim($_POST['nama_control_justifikasi'])) : '';
    $no_justifikasi		= isset($_POST['no_justifikasi']) ? mysql_real_escape_string(trim($_POST['no_justifikasi'])) : '';
    $nama_justifikasi		= isset($_POST['nama_justifikasi']) ? mysql_real_escape_string(trim($_POST['nama_justifikasi'])) : '';
    $kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $latitude    		= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
    $longitude   		= isset($_POST['email_cabang']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
    $tiang_terdekat		= isset($_POST['tiang_terdekat']) ? mysql_real_escape_string(trim($_POST['tiang_terdekat'])) : '';
    $kode_paket	    = isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket	    = isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $kontrak	    = isset($_POST['kontrak']) ? mysql_real_escape_string(trim($_POST['kontrak'])) : '';
    $tanggal	    = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $setup_fee_normal		= isset($_POST['setup_fee_normal']) ? mysql_real_escape_string(trim($_POST['setup_fee_normal'])) : '';
    $setup_fee_justifikasi	= isset($_POST['setup_fee_justifikasi']) ? mysql_real_escape_string(trim($_POST['setup_fee_justifikasi'])) : '';
    $monthly_fee_normal	    	= isset($_POST['monthly_fee_normal']) ? mysql_real_escape_string(trim($_POST['monthly_fee_normal'])) : '';
    $monthly_fee_justifikasi    = isset($_POST['monthly_fee_justifikasi']) ? mysql_real_escape_string(trim($_POST['monthly_fee_justifikasi'])) : '';
    $abonemen_normal	    	= isset($_POST['abonemen_normal']) ? mysql_real_escape_string(trim($_POST['abonemen_normal'])) : '';
    $abonemen_justifikasi	= isset($_POST['abonemen_justifikasi']) ? mysql_real_escape_string(trim($_POST['abonemen_justifikasi'])) : '';
    $bandwith_normal	    	= isset($_POST['bandwith_normal']) ? mysql_real_escape_string(trim($_POST['bandwith_normal'])) : '';
    $bandwith_justifikasi	= isset($_POST['bandwith_justifikasi']) ? mysql_real_escape_string(trim($_POST['bandwith_justifikasi'])) : '';
    
    $remarks_justifikasi	= isset($_POST['remarks_justifikasi']) ? mysql_real_escape_string(trim($_POST['remarks_justifikasi'])) : '';
    $remarks_control	    	= isset($_POST['remarks_control']) ? mysql_real_escape_string(trim($_POST['remarks_control'])) : '';
    $detail_link	    	= isset($_POST['detail_link']) ? mysql_real_escape_string(trim($_POST['detail_link'])) : '';
    $remarks_acc	    	= isset($_POST['remarks_marketing']) ? mysql_real_escape_string(trim($_POST['remarks_marketing'])) : '';
    $total_linkbudget	    	= isset($_POST['total_linkbudget']) ? mysql_real_escape_string(trim($_POST['total_linkbudget'])) : '';
    
    $laba_rugi_bulanan	    = isset($_POST['laba_rugi_bulanan']) ? mysql_real_escape_string(trim($_POST['laba_rugi_bulanan'])) : '';
    $laba_rugi_tahunan	    = isset($_POST['laba_rugi_tahunan']) ? mysql_real_escape_string(trim($_POST['laba_rugi_tahunan'])) : '';
    $detail_linkbudget	    = isset($_POST['detail_linkbudget']) ? trim($_POST['detail_linkbudget']) : '';
    
    
    $sql_update = "UPDATE `gx_persetujuan_justifikasi` SET `no_persetujuan` = '".$no_persetujuan_justifikasi."', `no_justifikasi` = '".$no_justifikasi."', `nama_justifikasi` = '".$nama_justifikasi."',
                    `no_control_justifikasi` = '".$no_control_justifikasi."', `nama_control` = '".$nama_control_justifikasi."',
		    `tanggal`='".$tanggal."', `kode_customer`='".$kode_customer."', `nama_customer`='".$nama_customer."',
		    `longitude`='".$longitude."', `latitude`='".$latitude."', `tiang_terdekat`='".$tiang_terdekat."',
		    `kode_paket`='".$kode_paket."', `nama_paket`='".$nama_paket."', `kontrak`='".$kontrak."', `setup_fee_justifikasi`='".$setup_fee_justifikasi."',
		    `abonemen_justifikasi`='".$abonemen_justifikasi."', `monthly_fee_justifikasi`='".$monthly_fee_justifikasi."', `bandwith_justifikasi`='".$bandwith_justifikasi."',
		    `remarks_justifikasi`='".$remarks_justifikasi."', `total_link_budget`='".$total_linkbudget."', `laba_rugi_bulan1`='".$laba_rugi_bulanan."',
		    `laba_rugi_pertahun`='".$laba_rugi_tahunan."', `remarks_control`='".$remarks_control."', `remarks_acc`='".$remarks_acc."',
		    `detail_link_budget`='".$detail_link."', 
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_persetujuan_justifikasi`='$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_anyar/persetujuan_justifikasi.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_persetujuan_justifikasi	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_persetujuan_justifikasi 	= "SELECT * FROM `gx_persetujuan_justifikasi` WHERE `id_persetujuan_justifikasi`='$id_persetujuan_justifikasi' LIMIT 0,1;";
    $sql_persetujuan_justifikasi	= mysql_query($query_persetujuan_justifikasi, $conn);
    $row_persetujuan_justifikasi	= mysql_fetch_array($sql_persetujuan_justifikasi);
    $no_controlll	= $row_persetujuan_justifikasi["no_control_justifikasi"];
    $query_control_justifikasi 	= "SELECT * FROM `gx_control_justifikasi` WHERE `no_control_justifikasi`='$no_controlll' LIMIT 0,1;";
    $sql_control_justifikasi	= mysql_query($query_control_justifikasi, $conn);
    $row_control_justifikasi	= mysql_fetch_array($sql_control_justifikasi);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Form Persetujuan Justifikasi
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Persetujuan Justifikasi</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="">
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="">
						<a href="'.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=persetujuanjustifikasi"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=persetujuanjustifikasi\',\'cabang\');">Search cabang</a>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Persetujuan Justifikasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="no_persetujuan_justifikasi" name="no_persetujuan_justifikasi" required="" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["no_persetujuan"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Control Justifikasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="no_control_justifikasi" name="no_control_justifikasi" required="" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["no_control_justifikasi"] : "").'">
						<a href="'.URL_ADMIN.'master_anyar/data_control_justifikasi.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_control_justifikasi.php?r=myForm\',\'cust\');">Search Control justifikasi</a>
					    </div>
					    <div class="col-xs-3">
						<label>Nomer Justifikasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="no_justifikasi" name="no_justifikasi" required="" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["no_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="kode_customer" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["kode_customer"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="nama_customer" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["nama_customer"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="longitude" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["longitude"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="latitude" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["latitude"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tiang Terdekat</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="tiang_terdekat" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["tiang_terdekat"] : "").'">
					    </div>
                                        
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="kode_paket" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["kode_paket"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="nama_paket" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["nama_paket"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="kontrak" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["kontrak"] : "").'">
					    </div>
                                        
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
						<label>Harga Normal</label>
					    </div>
					    <div class="col-xs-6">
						<label>Harga Justifikasi</label>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="setup_fee_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["setup_fee_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="setup_fee_justifikasi" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["setup_fee_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="abonemen_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["abonemen_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Abonemen</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="abonemen_justifikasi" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["abonemen_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="monthly_fee_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["monthly_fee_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="monthly_fee_justifikasi" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["monthly_fee_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="bandwith_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["bandwith_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Bandwidth</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="bandwith_justifikasi" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["bandwith_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks justifikasi</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea class="form-control"  name="remarks_justifikasi">'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["remarks_justifikasi"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Link Budget</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="total_linkbudget" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["total_link_budget"] : "").'">
					    </div>
                                       
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Laba/Rugi 1 bulan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="laba_rugi_bulanan" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["laba_rugi_bulan1"] : "").'">
					    </div>
                                         
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Laba/Rugi 1 Tahun</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="laba_rugi_tahunan" value="'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["laba_rugi_pertahun"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks Control</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea class="form-control"  name="remarks_control">'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["remarks_control"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks acc</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea class="form-control"  name="remarks_acc">'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["remarks_acc"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Detail link Budget</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea  id="detail_link" name="detail_link">'.(isset($_GET['id']) ? $row_persetujuan_justifikasi["detail_link_budget"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<script src="'.URL.'js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace(\'detail_link\');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>';

    $title	= 'Form Persetujuan Justifikasi';
    $submenu	= "persetujuan justifikasi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>