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
    
if(isset($_GET['id_prospek'])){
		$get_id = isset($_GET['id_prospek']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_prospek']))) : "";
		$data_prospek = mysql_fetch_array(mysql_query("SELECT `id_prospek`, `no_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek` WHERE `gx_prospek`.`id_prospek` = '$get_id';", $conn));
	    }
    
    $content ='<section class="content-header">
                    <h1>
                        Form Realisasi Link Budget
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Realisasi Link Budget</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm"  method="POST" action="">
                                    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Realisasi Link Budget</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text"  class="form-control" id="cabang" name="cabang" required=""
						value="'.(isset($_GET["id_prospek"]) ? $data_prospek['cabang'] :"").'"> <a href="'.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm\',\'cabang\');">Search Cabang</a>
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.date("d-m-Y").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Link Budget</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="no_prospek" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_prospek'] :"").'">
						
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="nama_perusahaan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_perusahaan'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="nama_perusahaan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_perusahaan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-4">
					        <input type="text" class="form-control"  name="alamat" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['alamat'] :"").'">
					    </div>
					    <div class="col-xs-2">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-4">
					        <input type="text" class="form-control"  name="alamat" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['alamat'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kelurahan</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control"  name="kelurahan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kelurahan'] :"").'">
					    </div>
					    <div class="col-xs-2">
						<label>Kecamatan</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control"  name="kecamatan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kecamatan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tiang Terdekat</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kota" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kota'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Created</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kode_pos" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_pos'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Contact Person</label>
                                            </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" name="contact" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['contact_person'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Power Budget</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;"> '.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['pekerjaan'] :"").' </textarea>
			</div>
                                        </div>
					</div>
			
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Alat yang terpasang</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;"> '.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['pekerjaan'] :"").' </textarea>
			</div>
                                        </div>
					</div>
			
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
			  <label>Foto Pemasangan</label>
			</div>
			<div  class="col-xs-10">
			 <textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;"> '.(isset($_GET["id_spk_pasang_baru"]) ? $data_spk_pasang_baru['pekerjaan'] :"").' </textarea>
			</div>
                                        </div>
					</div>
			
					
					</div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id_prospek"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
$save = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";

	if($save == "Save"){
	    
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['cabang']))) : "";
	    $kode_cust		= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	    $nama_cust		= isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";
	    $nama_perusahaan	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_perusahaan']))) : "";
	    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat']))) : "";
	    $kelurahan		= isset($_POST['kelurahan']) ? mysql_real_escape_string(strip_tags(trim($_POST['kelurahan']))) : "";
	    $kecamatan		= isset($_POST['kecamatan']) ? mysql_real_escape_string(strip_tags(trim($_POST['kecamatan']))) : "";
	    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(strip_tags(trim($_POST['kota']))) : "";
	    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pos']))) : "";
	    $no_telp		= isset($_POST['notelp']) ? mysql_real_escape_string(strip_tags(trim($_POST['notelp']))) : "";
	    $no_hp_1		= isset($_POST['hp1']) ? mysql_real_escape_string(strip_tags(trim($_POST['hp1']))) : "";
	    $no_hp_2		= isset($_POST['hp2']) ? mysql_real_escape_string(strip_tags(trim($_POST['hp2']))) : "";
	    $contact_person	= isset($_POST['contact']) ? mysql_real_escape_string(strip_tags(trim($_POST['contact']))) : "";
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_marketing']))) : "";
	    
	    
		    
		$insert_prospek    	= "INSERT INTO `gx_prospek`(`id_prospek`, `no_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES (NULL,'$no_prospek',NOW(),'$cabang','$kode_cust','$nama_cust','$nama_perusahaan','$alamat','$kelurahan','$kecamatan','$kota','$kode_pos','$no_telp','$no_hp_1','$no_hp_2','$contact_person','$email','$marketing',NOW(),NOW(),'$loggedin[username]','$loggedin[username]','0');";
		//echo $insert_prospek;
		mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert Realisasi Link Budget = $insert_prospek");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'm_prospek';
		</script>";
	}elseif($update == "Save"){
	    
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(strip_tags(trim($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['cabang']))) : "";
	    $kode_cust		= isset($_POST['kode_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_customer']))) : "";
	    $nama_cust		= isset($_POST['nama_customer']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_customer']))) : "";
	    $nama_perusahaan	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_perusahaan']))) : "";
	    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat']))) : "";
	    $kelurahan		= isset($_POST['kelurahan']) ? mysql_real_escape_string(strip_tags(trim($_POST['kelurahan']))) : "";
	    $kecamatan		= isset($_POST['kecamatan']) ? mysql_real_escape_string(strip_tags(trim($_POST['kecamatan']))) : "";
	    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(strip_tags(trim($_POST['kota']))) : "";
	    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pos']))) : "";
	    $no_telp		= isset($_POST['notelp']) ? mysql_real_escape_string(strip_tags(trim($_POST['notelp']))) : "";
	    $no_hp_1		= isset($_POST['hp1']) ? mysql_real_escape_string(strip_tags(trim($_POST['hp1']))) : "";
	    $no_hp_2		= isset($_POST['hp2']) ? mysql_real_escape_string(strip_tags(trim($_POST['hp2']))) : "";
	    $contact_person	= isset($_POST['contact']) ? mysql_real_escape_string(strip_tags(trim($_POST['contact']))) : "";
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_marketing']))) : "";
	    
		    
		$insert_prospek    	= "UPDATE `gx_prospek` SET `no_prospek`='$no_prospek',
		`cabang`='$cabang',`kode_cust`='$kode_cust',`nama_cust`='$nama_cust',
		`nama_perusahaan`='$nama_perusahaan',`alamat`='$alamat',`kelurahan`='$kelurahan',
		`kecamatan`='$kecamatan',`kota`='$kota',`kode_pos`='$kode_pos',
		`no_telp`='$no_telp',`no_hp_1`='$no_hp_1',`no_hp_2`='$no_hp_2',
		`contact_person`='$contact_person',`email`='$email',
		`marketing`='$marketing',
		`date_upd`=NOW(),`user_upd`='$loggedin[username]' WHERE `id_prospek`='$_GET[id_prospek]'";
		
		
		//echo $insert_prospek;
		mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit Realisasi Link Budget = $insert_prospek");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'm_prospek.php';
		</script>";
	}

$plugins = '
    ';

    $title	= 'Form Survey';
    $submenu	= "survey";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>