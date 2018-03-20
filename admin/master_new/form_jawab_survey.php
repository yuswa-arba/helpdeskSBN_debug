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
    

    $sql_last_jawab  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` ORDER BY `id_jawab_spksurvey` DESC", $conn));
    $last_data  = $sql_last_jawab["id_jawab_spksurvey"] + 1;
    $tanggal    = date("d");
    $no_jawab  = 'GXJ-'.$tanggal.''.sprintf("%04d", $last_data);
    $content ='<section class="content-header">
                    <h1>
                        Form Jawab SPK Survey
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Jawab SPK Survey</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm" method="POST" enctype="multipart/form-data" action="">
                                    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="">
						<a href="'.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=jawabsurvey"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_cabang.php?r=myForm&f=jawabsurvey\',\'cabang\');">Search cabang</a>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Jawaban SPK Survey</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="no_jawab" name="no_jawab" required="" value="">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. SPK</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="no_survey" value="">
						<a href="'.URL_ADMIN.'master_anyar/data_survey.php?r=myForm"  onclick="return valideopenerform(\''.URL_ADMIN.'master_anyar/data_survey.php?r=myForm\',\'survey\');">Search Survey</a>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="nama" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control"  name="perusahaan" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
					        <input type="text" readonly="" class="form-control"  name="alamat" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="kota" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telp</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="notelp" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="hp1" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="email" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="longitude" value="">
					    </div>
					    <div class="col-xs-1">
						<label>Latitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="latitude" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Tiang Terdekat</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="no_tiang" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="nama_marketing" value="">
						<input type="hidden" class="form-control" name="marketing" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Prospek</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="checkbox" class="form-control" name="prospek" value="1">
					    </div>
					    <div class="col-xs-1">
						<label>pending</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="checkbox" class="form-control" name="pending" value="1">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Normal</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="checkbox" class="form-control" name="normal" value="1">
					    </div>
					    <div class="col-xs-1">
						<label>Justifikasi</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="checkbox" class="form-control" name="justifikasi" value="1">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea cols="20" rows="3" class="form-control" name="remarks"></textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Upload Foto Lokasi</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="file" class="form-control" name="upload" value="">
					    </div>
                                        </div>
					</div>
					
					</div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
    if(isset($_POST["save"])){
	$sql_last_jawab  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` ORDER BY `id_jawab_spksurvey` DESC", $conn));
	$last_data  	= $sql_last_jawab["id_jawab_spksurvey"] + 1;
	
	$no_jawab  	= isset($_POST['no_jawab']) ? mysql_real_escape_string(trim($_POST['no_jawab'])) : '';
	$no_survey   	= isset($_POST['no_survey']) ? mysql_real_escape_string(trim($_POST['no_survey'])) : '';
	$nama		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
	$perusahaan	= isset($_POST['perusahaan']) ? mysql_real_escape_string(trim($_POST['perusahaan'])) : '';
	$alamat  	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$kota   	= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$notelp		= isset($_POST['notelp']) ? mysql_real_escape_string(trim($_POST['notelp'])) : '';
	$hp1		= isset($_POST['hp1']) ? mysql_real_escape_string(trim($_POST['hp1'])) : '';
	$email	 	= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
	$longitude   	= isset($_POST['longitude']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
	$latitude	= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
	$no_tiang	= isset($_POST['no_tiang']) ? mysql_real_escape_string(trim($_POST['no_tiang'])) : '';
	$marketing  	= isset($_POST['marketing']) ? mysql_real_escape_string(trim($_POST['marketing'])) : '';
	$prospek   	= isset($_POST['prospek']) ? mysql_real_escape_string(trim($_POST['prospek'])) : '';
	$pending	= isset($_POST['pending']) ? mysql_real_escape_string(trim($_POST['pending'])) : '';
	$normal		= isset($_POST['normal']) ? mysql_real_escape_string(trim($_POST['normal'])) : '';
	$justifikasi	= isset($_POST['justifikasi']) ? mysql_real_escape_string(trim($_POST['justifikasi'])) : '';
	$remarks	= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	$upload		= isset($_POST['upload']) ? mysql_real_escape_string(trim($_POST['upload'])) : '';
	
	$eror       = false;
	$folder     = '../upload/jawab_spk_survey/';
	$lokasi	    = 'upload/jawab_spk_survey/';
	//type file yang bisa diupload
	$file_type  = array('doc','docx','xls','xlsx','pdf','jpeg','jpg','png');
	//tukuran maximum file yang dapat diupload
	$max_size   = 10000000; // 10MB
	//Mulai memorises data
	$file_name  = $_FILES['upload']['name'];
	$file_size  = $_FILES['upload']['size'];
	//cari extensi file dengan menggunakan fungsi explode
	$explode    = explode('.',$file_name);
	$extensi    = $explode[count($explode)-1];
     
	//check apakah type file sudah sesuai
	$pesan ='';
	if(!in_array($extensi,$file_type)){
	    $eror   = true;
	    $pesan .= '- Type file yang anda upload tidak sesuai.';
	}
	if($file_size > $max_size){
	    $eror   = true;
	    $pesan .= '- Ukuran file melebihi batas maximum.';
	}
	//check ukuran file apakah sudah sesuai

	if($eror == true){
	    echo "<script language='JavaScript'>
			    alert('".$pesan."');
			    window.history.go(-1);
		  </script>";
	}else{
	    //mulai memproses upload file
	    if(move_uploaded_file($_FILES['upload']['tmp_name'], $folder.$file_name)){
		//catat nama file ke database
		
		$sql_insert_jawabsurvey = "INSERT INTO `gx_jawab_spksurvey` (`id_jawab_spksurvey`, `no_jawab`, `no_spksurvey`,`nama`, `perusahaan`, `alamat`,
									     `kota`, `no_telp`, `no_hp_1`,`email`, `longitude`, `latitude`,
									     `no_tiang`, `marketing`, `check_prospek`, `check_normal`,
									     `check_pending`, `check_justifikasi`, `remarks`,`foto_lokasi`,
									     `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
								    VALUES  ('', '$no_jawab', '$no_survey', '$nama', '$perusahaan', '$alamat',
									     '$kota', '$notelp', '$hp1', '$email', '$longitude', '$latitude',
									     '$no_tiang', '$marketing', '$prospek', '$normal',
									     '$pending', '$justifikasi', '$remarks', '$file_name',
									     NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";
		//echo $sql_insert_jawabsurvey;
		mysql_query($sql_insert_jawabsurvey, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		
		
		
		$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `id_jawab_spksurvey`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
				    VALUES ('', '$last_data', '$file_name', '$lokasi', '$loggedin[username]', NOW(), '0');";
		
		mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		
		echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'jawab_survey.php';
		    </script>";
	
	    }else{
		echo "<script language='JavaScript'>
			alert('Proses upload error!');
			window.history.go(-1);
		      </script>";
	    }
	}
    
    }
$plugins = '
    ';

    $title	= 'Form Jawab Survey';
    $submenu	= "jawab_survey";
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