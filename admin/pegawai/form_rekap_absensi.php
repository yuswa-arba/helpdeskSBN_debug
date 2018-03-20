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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Master Gaji");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_rekap_absensi` WHERE `id_rekap`='$id_data' AND `level`='0' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
}

    $content = '<section class="content-header">
                    <h1>
                        Form Rekap Abasensi
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Master Gaji</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="form_rekap_absensi" action="" enctype="multipart/form-data" >
                                    <input type="hidden" name="id_rekap" value="'.(isset($_GET['id']) ? $row_data["id_rekap"] : "").'">
				    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Form Rekap Absensi</h2></label>
											</div>
										</div>
										</div>
				
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Bulan</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="bulan" placeholder="" value="'.(isset($_GET['id']) ? $row_data["bulan"] : "").'">-->
												<select name="bulan" class="form-control" required="">
												    <option value="">Pilih Bulan</option>
												    <option value="January">January</option>
												    <option value="February">February</option>
												    <option value="March">March</option>
												    <option value="April">April</option>
												    <option value="May">May</option>
												    <option value="June">June</option>
												    <option value="July">July</option>
												    <option value="Agustus">Agustus</option>
												    <option value="September">September</option>
												    <option value="October">October</option>
												    <option value="November">November</option>
												    <option value="December">December</option>
												</select>
											</div>
											<div class="col-xs-1">
												<label>Kode Staff</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="kode" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["kode"] : "").'" required="" readonly="">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Nama</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="nama" placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama"] : "").'" readonly="" required=""  onclick="return valideopenerform(\'data_staff.php?r=form_rekap_absensi&f=data_staff\',\'staff\');">
											</div>
											<div class="col-xs-1">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : "").'" required="" >
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Check In</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="datepicker2" name="check_in" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["check_in"] : "").'" required="" >
											</div>
											<div class="col-xs-1">
												<label>Check Out</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="datepicker3" name="check_out" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["check_out"] : "").'" required="" >
											</div>
										</div>
										</div>
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>KET</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="ket" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["ket"] : "").'" required="" >
											</div>
											
										</div>
										</div>
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Menit Terlambat</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="menit_terlambat" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["menit_terlambat"] : "").'" required="" >
											</div>
											<div class="col-xs-1">
												<label>Menit Pulang Awal</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="menit_pulang_awal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["menit_pulang_awal"] : "").'" required="" >
											</div>
										</div>
										</div>
										
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Jam Lembur</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="jam_lembur" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["jam_lembur"] : "").'" required="" >
											</div>
											<div class="col-xs-1">
												<label>Keterangan</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="" name="keterangan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["keterangan"] : "").'" required="" >
											</div>
										</div>
										</div>
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Status</label>
											</div>
											<div class="col-xs-4">
												<select name="status" class="form-control" required="" >
												    <option value="">Pilih Status</option>
												    <option value="normal">Normal</option>
												    <option value="absen">Absen</option>
												    <option value="cuti">Cuti</option>
												    <option value="lembur">Lembur</option>
												</select>
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
			

if(isset($_POST["save"]))
{
// $	   			= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';       
$bulan	   			= isset($_POST['bulan']) ? mysql_real_escape_string(trim($_POST['bulan'])) : ''; 
$kode	   			= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
$nama	   			= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
$tanggal	   		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
$check_in	   		= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
$check_out	   		= isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
$ket	   			= isset($_POST['ket']) ? mysql_real_escape_string(trim($_POST['ket'])) : '';
$menit_terlambat	   	= isset($_POST['menit_terlambat']) ? mysql_real_escape_string(trim($_POST['menit_terlambat'])) : '';
$menit_pulang_awal	   	= isset($_POST['menit_pulang_awal']) ? mysql_real_escape_string(trim($_POST['menit_pulang_awal'])) : '';
$jam_lembur	   		= isset($_POST['jam_lembur']) ? mysql_real_escape_string(trim($_POST['jam_lembur'])) : '';
$hari_lembur	   		= isset($_POST['hari_lembur']) ? mysql_real_escape_string(trim($_POST['hari_lembur'])) : '';
$keterangan	   		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
$status	   			= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
$user_add	   		= isset($_POST['user_add']) ? mysql_real_escape_string(trim($_POST['user_add'])) : '';
$user_upd	   		= isset($_POST['user_upd']) ? mysql_real_escape_string(trim($_POST['user_upd'])) : '';
$level	   			= isset($_POST['level']) ? mysql_real_escape_string(trim($_POST['level'])) : '';

if($bulan!='' && $kode!='' && $nama!='' && $tanggal!='' && $check_in!='' && $check_out!='' && $ket!='' && $menit_terlambat!='' && $jam_lembur!='' && $keterangan!='' && $status!=''){
	$sql_insert = "INSERT INTO `gx_rekap_absensi`(`id_rekap`, `bulan`, `kode`, `nama`, `tanggal`, `check_in`, `check_out`, `ket`, `menit_terlambat`, `menit_pulang_awal`, `jam_lembur`, `keterangan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) VALUES (NULL, '".$bulan."', '".$kode."', '".$nama."', '".$tanggal."', '".$check_in."', '".$check_out."', '".$ket."', '".$menit_terlambat."', '".$menit_pulang_awal."', '".$jam_lembur."', '".$keterangan."', '".$status."', NOW(), NOW(), '".$user_add."', '".$user_upd."', '0')";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/rekap_absensi.php';
			</script>";
			
    }else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	}

}elseif(isset($_POST["update"]))
{

$id_rekap			= isset($_POST['id_rekap']) ? mysql_real_escape_string(trim($_POST['id_rekap'])) : ''; 
$bulan	   			= isset($_POST['bulan']) ? mysql_real_escape_string(trim($_POST['bulan'])) : ''; 
$kode	   			= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
$nama	   			= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
$tanggal	   		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
$check_in	   		= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
$check_out	   		= isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
$ket	   			= isset($_POST['ket']) ? mysql_real_escape_string(trim($_POST['ket'])) : '';
$menit_terlambat	   	= isset($_POST['menit_terlambat']) ? mysql_real_escape_string(trim($_POST['menit_terlambat'])) : '';
$menit_pulang_awal	   	= isset($_POST['menit_pulang_awal']) ? mysql_real_escape_string(trim($_POST['menit_pulang_awal'])) : '';
$jam_lembur	   		= isset($_POST['jam_lembur']) ? mysql_real_escape_string(trim($_POST['jam_lembur'])) : '';
$hari_lembur	   		= isset($_POST['hari_lembur']) ? mysql_real_escape_string(trim($_POST['hari_lembur'])) : '';
$keterangan	   		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
$status	   			= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
$user_add	   		= isset($_POST['user_add']) ? mysql_real_escape_string(trim($_POST['user_add'])) : '';
$user_upd	   		= isset($_POST['user_upd']) ? mysql_real_escape_string(trim($_POST['user_upd'])) : '';
$level	   			= isset($_POST['level']) ? mysql_real_escape_string(trim($_POST['level'])) : '';

    $sql_update = "UPDATE `gx_rekap_absensi` SET `level`='1' WHERE `id_rekap`='".$id_rekap."'";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
    $sql_insert_update	=  "INSERT INTO `gx_rekap_absensi`(`id_rekap`, `bulan`, `kode`, `nama`, `tanggal`, `check_in`, `check_out`, `ket`, `menit_terlambat`, `menit_pulang_awal`, `jam_lembur`, `keterangan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) VALUES (NULL, '".$bulan."', '".$kode."', '".$nama."', '".$tanggal."', '".$check_in."', '".$check_out."', '".$ket."', '".$menit_terlambat."', '".$menit_pulang_awal."', '".$jam_lembur."', '".$keterangan."', '".$status."', NOW(), NOW(), '".$user_add."', '".$user_upd."', '0')";                    

	                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/rekap_absensi.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
                $("#datepicker3").datepicker({format: "yyyy-mm-dd"});
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		';

    $title	= 'Form Rekap Absensi';
    $submenu	= "rekap_absensi";
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