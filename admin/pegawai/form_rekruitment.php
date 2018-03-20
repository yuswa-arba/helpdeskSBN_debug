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
    $query_data		= "SELECT * FROM `gx_rekruitment` WHERE `id_rekruitment`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content = '<section class="content-header">
                                       
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>REKRUITMENT</h2></label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>No Rekruitment</label>
											</div>
											<div class="col-xs-8">
												<input type="hidden" class="form-control" id="" name="id_rekruitment" placeholder="" value="'.(isset($_GET['id']) ? $row_data["id_rekruitment"] : "").'">
												<input type="text" class="form-control" id="" name="no_rekruitment" placeholder="" value="'.(isset($_GET['id']) ? $row_data["no_rekruitment"] : "").'">
											</div>
										</div>
										</div>
										
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Nama Calon Pegawai</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="nama_calon_pegawai" placeholder="" value="'.(isset($_GET['id']) ? $row_data["nama_calon_pegawai"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Alamat</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="alamat" placeholder="" value="'.(isset($_GET['id']) ? $row_data["alamat"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>No Telp</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="no_telp" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["no_telp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Bagian yang diinginkan</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="bagian_yang_diinginkan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["bagian_yang_diinginkan"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Informasi Lamaran</label>
											</div>
											<div class="col-xs-8">
												<input type="radio" class="form-control" id="" name="informasi_lamaran" placeholder="" value="koran" '.(isset($_GET['id']) ? ($row_data["informasi_lamaran"] == 'koran' ? 'checked' : '') : "").'>Koran <input type="radio" class="form-control" id="" name="informasi_lamaran" placeholder="" value="teman" '.(isset($_GET['id']) ? ($row_data["informasi_lamaran"] == 'teman' ? 'checked' : '') : "").'>Teman <input type="radio" class="form-control" id="" name="informasi_lamaran" placeholder="" value="internet" '.(isset($_GET['id']) ? ($row_data["informasi_lamaran"] == 'internet' ? 'checked' : '') : "").'>Internet <input type="radio" class="form-control" id="" name="informasi_lamaran" placeholder="" value="lain-lain" '.(isset($_GET['id']) ? ($row_data["informasi_lamaran"] == 'lain-lain' ? 'checked' : '') : "").'>Lain - lain
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Pendidikan Terakhir</label>
											</div>
											<div class="col-xs-8">
												<input type="radio" class="form-control" id="" name="pendidikan_terakhir" placeholder="" value="smp" '.(isset($_GET['id']) ? ($row_data["pendidikan_terakhir"] == 'smp' ? 'checked' : '') : "").'>SMP <input type="radio" class="form-control" id="" name="pendidikan_terakhir" placeholder="" value="sma" '.(isset($_GET['id']) ? ($row_data["pendidikan_terakhir"] == 'sma' ? 'checked' : '') : "").'>SMA <input type="radio" class="form-control" id="" name="pendidikan_terakhir" placeholder="" value="s1" '.(isset($_GET['id']) ? ($row_data["pendidikan_terakhir"] == 's1' ? 'checked' : '') : "").'>S1 <input type="radio" class="form-control" id="" name="pendidikan_terakhir" placeholder="" value="s2" '.(isset($_GET['id']) ? ($row_data["pendidikan_terakhir"] == 's2' ? 'checked' : '') : "").'>S2
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Nama Sekolah Terakhir</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="nama_sekolah_terakhir" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["nama_sekolah_terakhir"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Jurusan</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="jurusan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["jurusan"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Tahun Lulus</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="tahun_lulus" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tahun_lulus"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Nilai / IPK</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="nilai_ipk" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["nilai_ipk"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label><b>Pengalaman Kerja</b></label>
											</div>
											<div class="col-xs-8">
												<!--<input type="text" class="form-control" id="" name="pengalaman_kerja" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["pengalaman_kerja"] : "").'">-->
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1"></div>
											<div class="col-xs-3">
												<label>Nama Perusahaan</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="nama_perusahaan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["nama_perusahaan"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1"></div>
											<div class="col-xs-3">
												<label>Jabatan</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="jabatan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["jabatan"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-1"></div>
											<div class="col-xs-3">
												<label>Lama</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="lama" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["lama"] : "").'">
											</div>
										</div>
										</div>
										
										<!--
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<table class="table table-bordered table-striped">
												    <tr><td>Nama Perusahaan</td><td>Jabatan</td><td>Lama</td></tr>
												    <tr><td></td><td></td><td></td></tr>
												</table>
											</div>
										</div>
										</div>
										-->
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Gaji yang diinginkan</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="" name="gaji_yang_diinginkan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["gaji_yang_diinginkan"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<label>Motivasi Kerja</label>
											</div>
											<div class="col-xs-12">
												<textarea class="form-control" id="" name="motivasi_kerja" placeholder="" required="">'.(isset($_GET['id']) ? $row_data["motivasi_kerja"] : "").'</textarea>
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

                </section><!-- /.content -->';
			

if(isset($_POST["save"]))
{
   //isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
	$no_rekruitment 		= isset($_POST['no_rekruitment']) ? mysql_real_escape_string(trim($_POST['no_rekruitment'])) : '';
	$nama_calon_pegawai		= isset($_POST['nama_calon_pegawai']) ? mysql_real_escape_string(trim($_POST['nama_calon_pegawai'])) : '';
	$alamat 			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$no_telp			= isset($_POST['no_telp']) ? mysql_real_escape_string(trim($_POST['no_telp'])) : '';
	$bagian_yang_diinginkan 	= isset($_POST['bagian_yang_diinginkan']) ? mysql_real_escape_string(trim($_POST['bagian_yang_diinginkan'])) : '';
	$informasi_lamaran		= isset($_POST['informasi_lamaran']) ? mysql_real_escape_string(trim($_POST['informasi_lamaran'])) : '';
	$pendidikan_terakhir		= isset($_POST['pendidikan_terakhir']) ? mysql_real_escape_string(trim($_POST['pendidikan_terakhir'])) : '';
	$nama_sekolah_terakhir		= isset($_POST['nama_sekolah_terakhir']) ? mysql_real_escape_string(trim($_POST['nama_sekolah_terakhir'])) : '';
	$jurusan			= isset($_POST['jurusan']) ? mysql_real_escape_string(trim($_POST['jurusan'])) : '';
	$lama				= isset($_POST['lama']) ? mysql_real_escape_string(trim($_POST['lama'])) : '';
	$gaji_yang_diinginkan 		= isset($_POST['gaji_yang_diinginkan']) ? mysql_real_escape_string(trim($_POST['gaji_yang_diinginkan'])) : '';
	$motivasi_kerja			= isset($_POST['motivasi_kerja']) ? mysql_real_escape_string(trim($_POST['motivasi_kerja'])) : '';
	$tahun_lulus			= isset($_POST['tahun_lulus']) ? mysql_real_escape_string(trim($_POST['tahun_lulus'])) : '';
	$nilai_ipk			= isset($_POST['nilai_ipk']) ? mysql_real_escape_string(trim($_POST['nilai_ipk'])) : '';
	$pengalaman_kerja 		= isset($_POST['pengalaman_kerja']) ? mysql_real_escape_string(trim($_POST['pengalaman_kerja'])) : '';
	$nama_perusahaan		= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
	$jabatan			= isset($_POST['jabatan']) ? mysql_real_escape_string(trim($_POST['jabatan'])) : '';

	
	
	$sql_insert = "INSERT INTO `gx_rekruitment`(`id_rekruitment`, `no_rekruitment`, `nama_calon_pegawai`, `alamat`, `no_telp`, `bagian_yang_diinginkan`, `informasi_lamaran`, `pendidikan_terakhir`, `nama_sekolah_terakhir`, `jurusan`, `tahun_lulus`, `nilai_ipk`, `pengalaman_kerja`, `nama_perusahaan`, `jabatan`, `lama`, `gaji_yang_diinginkan`, `motivasi_kerja`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$no_rekruitment."','".$nama_calon_pegawai."','".$alamat."','".$no_telp."','".$bagian_yang_diinginkan."','".$informasi_lamaran."','".$pendidikan_terakhir."','".$nama_sekolah_terakhir."','".$jurusan."','".$tahun_lulus."','".$nilai_ipk."','".$pengalaman_kerja."','".$nama_perusahaan."','".$jabatan."','".$lama."','".$gaji_yang_diinginkan."','".$motivasi_kerja."',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/rekruitment.php';
			</script>";
			
   
}elseif(isset($_POST["update"]))
{
    //echo "update";
	$id_rekruitment 		= isset($_POST['id_rekruitment']) ? mysql_real_escape_string(trim($_POST['id_rekruitment'])) : '';
	$no_rekruitment 		= isset($_POST['no_rekruitment']) ? mysql_real_escape_string(trim($_POST['no_rekruitment'])) : '';
	$nama_calon_pegawai		= isset($_POST['nama_calon_pegawai']) ? mysql_real_escape_string(trim($_POST['nama_calon_pegawai'])) : '';
	$alamat 			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$no_telp			= isset($_POST['no_telp']) ? mysql_real_escape_string(trim($_POST['no_telp'])) : '';
	$bagian_yang_diinginkan 	= isset($_POST['bagian_yang_diinginkan']) ? mysql_real_escape_string(trim($_POST['bagian_yang_diinginkan'])) : '';
	$informasi_lamaran		= isset($_POST['informasi_lamaran']) ? mysql_real_escape_string(trim($_POST['informasi_lamaran'])) : '';
	$pendidikan_terakhir		= isset($_POST['pendidikan_terakhir']) ? mysql_real_escape_string(trim($_POST['pendidikan_terakhir'])) : '';
	$nama_sekolah_terakhir		= isset($_POST['nama_sekolah_terakhir']) ? mysql_real_escape_string(trim($_POST['nama_sekolah_terakhir'])) : '';
	$jurusan			= isset($_POST['jurusan']) ? mysql_real_escape_string(trim($_POST['jurusan'])) : '';
	$lama				= isset($_POST['lama']) ? mysql_real_escape_string(trim($_POST['lama'])) : '';
	$gaji_yang_diinginkan 		= isset($_POST['gaji_yang_diinginkan']) ? mysql_real_escape_string(trim($_POST['gaji_yang_diinginkan'])) : '';
	$motivasi_kerja			= isset($_POST['motivasi_kerja']) ? mysql_real_escape_string(trim($_POST['motivasi_kerja'])) : '';
	$tahun_lulus			= isset($_POST['tahun_lulus']) ? mysql_real_escape_string(trim($_POST['tahun_lulus'])) : '';
	$nilai_ipk			= isset($_POST['nilai_ipk']) ? mysql_real_escape_string(trim($_POST['nilai_ipk'])) : '';
	$pengalaman_kerja 		= isset($_POST['pengalaman_kerja']) ? mysql_real_escape_string(trim($_POST['pengalaman_kerja'])) : '';
	$nama_perusahaan		= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
	$jabatan			= isset($_POST['jabatan']) ? mysql_real_escape_string(trim($_POST['jabatan'])) : '';

	
    $sql_update = "UPDATE `gx_rekruitment` SET `date_upd`=NOW(),`user_upd`='".$loggedin['username']."',`level`='1' WHERE `id_rekruitment`='".$id_rekruitment."'";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_rekruitment`(`id_rekruitment`, `no_rekruitment`, `nama_calon_pegawai`, `alamat`, `no_telp`, `bagian_yang_diinginkan`, `informasi_lamaran`, `pendidikan_terakhir`, `nama_sekolah_terakhir`, `jurusan`, `tahun_lulus`, `nilai_ipk`, `pengalaman_kerja`, `nama_perusahaan`, `jabatan`, `lama`, `gaji_yang_diinginkan`, `motivasi_kerja`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$no_rekruitment."','".$nama_calon_pegawai."','".$alamat."','".$no_telp."','".$bagian_yang_diinginkan."','".$informasi_lamaran."','".$pendidikan_terakhir."','".$nama_sekolah_terakhir."','".$jurusan."','".$tahun_lulus."','".$nilai_ipk."','".$pengalaman_kerja."','".$nama_perusahaan."','".$jabatan."','".$lama."','".$gaji_yang_diinginkan."','".$motivasi_kerja."',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/rekruitment.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
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

    $title	= 'Rekruitment';
    $submenu	= "rekruitment";
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