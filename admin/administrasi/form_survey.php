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
    
	    if(isset($_GET['id_survey'])){
		$get_id = isset($_GET['id_survey']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_survey']))) : "";
		$data_survey = mysql_fetch_array(mysql_query("SELECT * FROM `gx_survey` WHERE `gx_survey`.`id_survey` = '$get_id';", $conn));
		$data_cabang = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `gx_cabang`.`id_cabang` = '$data_survey[cabang]';", $conn));
		//$data_marketing = mysql_fetch_array(mysql_query("SELECT * FROM `tbPegawai` WHERE `tbPegawai`.`id_employee` = '$data_survey[marketing]';", $conn));
	    }
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form SPK Survey</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["id_survey"]) ? $data_cabang['nama_cabang'] : "").'">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="'.(isset($_GET["id_survey"]) ? $data_survey['cabang'] : "").'">
						<a href="data_cabang.php?r=myForm&f=survey"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=survey\',\'cabang\');">Search cabang</a>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. SPK Survey</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="no_survey" name="no_survey" required="" readonly="" value="'.(isset($_GET["id_survey"]) ? $data_survey['no_spk_survey'] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control hasDatepicker" id="datepicker" name="tanggal" readonly="" required="" value="'.(isset($_GET["id_survey"]) ? $data_survey['tanggal'] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Prospek</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" required="" name="no_prospek" value="'.(isset($_GET["id_survey"]) ? $data_survey['no_prospek'] : "").'">
						<input type="hidden" class="form-control"  required="" readonly="" name="kode_customer" value="'.(isset($_GET["id_survey"]) ? $data_survey['kode_cust'] : "").'">
						<a href="data_prospek.php?r=myForm"  onclick="return valideopenerform(\'data_prospek.php?r=myForm\',\'prospek\');">Search Survey</a>
					    </div>
					    <!--<div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" readonly="" name="kode_customer" value="'.(isset($_GET["id_survey"]) ? $data_survey['kode_cust'] : "").'">
					    </div>-->
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="nama_customer" value="'.(isset($_GET["id_survey"]) ? $data_survey['nama_cust'] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="nama_perusahaan" value="'.(isset($_GET["id_survey"]) ? $data_survey['nama_perusahaan'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
					        <input type="text" class="form-control"  name="alamat" value="'.(isset($_GET["id_survey"]) ? $data_survey['alamat'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kelurahan</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="kelurahan" value="'.(isset($_GET["id_survey"]) ? $data_survey['kelurahan'] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Kecamatan</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="kecamatan" value="'.(isset($_GET["id_survey"]) ? $data_survey['kecamatan'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="kota" value="'.(isset($_GET["id_survey"]) ? $data_survey['kota'] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Kode Pos</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="kode_pos" value="'.(isset($_GET["id_survey"]) ? $data_survey['kode_pos'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telp</label>
                                            </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" name="notelp" value="'.(isset($_GET["id_survey"]) ? $data_survey['no_telp'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="hp1" value="'.(isset($_GET["id_survey"]) ? $data_survey['no_hp_1'] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>No. HP 2 </label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="hp2" value="'.(isset($_GET["id_survey"]) ? $data_survey['no_hp_2'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Contact Person</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="contact" value="'.(isset($_GET["id_survey"]) ? $data_survey['contact_person'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="email" value="'.(isset($_GET["id_survey"]) ? $data_survey['email'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="longitude" value="'.(isset($_GET["id_survey"]) ? $data_survey['longitude'] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Latitude</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="latitude" value="'.(isset($_GET["id_survey"]) ? $data_survey['latitude'] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="nama_marketing" value="'.(isset($_GET["id_survey"]) ? $data_survey['marketing'] :"") .'" >
						
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_survey']) ? $data_survey["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_survey']) ? $data_survey["user_upd"]." ".$data_survey["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="'.(isset($_GET["id_survey"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">Submit</button>
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
	    
	    $no_survey		= isset($_POST['no_survey']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_survey']))) : "";
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim(strip_tags($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(trim(strip_tags($_POST['cabang']))) : "";
	    $kode_cust		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim(strip_tags($_POST['kode_customer']))) : "";
	    $nama_cust		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_customer']))) : "";
	    $nama_perusahaan	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_perusahaan']))) : "";
	    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim(strip_tags($_POST['alamat']))) : "";
	    $kelurahan		= isset($_POST['kelurahan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kelurahan']))) : "";
	    $kecamatan		= isset($_POST['kecamatan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kecamatan']))) : "";
	    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(trim(strip_tags($_POST['kota']))) : "";
	    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(trim(strip_tags($_POST['kode_pos']))) : "";
	    $no_telp		= isset($_POST['notelp']) ? mysql_real_escape_string(trim(strip_tags($_POST['notelp']))) : "";
	    $no_hp_1		= isset($_POST['hp1']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp1']))) : "";
	    $no_hp_2		= isset($_POST['hp2']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp2']))) : "";
	    $contact_person	= isset($_POST['contact']) ? mysql_real_escape_string(trim(strip_tags($_POST['contact']))) : "";
	    $longitude		= isset($_POST['longitude']) ? mysql_real_escape_string(trim(strip_tags($_POST['longitude']))) : "";
	    $latitude		= isset($_POST['latitude']) ? mysql_real_escape_string(trim(strip_tags($_POST['latitude']))) : "";
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(trim(strip_tags($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_marketing']))) : "";
	    
	    if(($no_survey != "") && ($no_prospek != "") && ($cabang != "")){
		$insert_survey   	= "INSERT INTO `gx_survey`(`id_survey`, `no_spk_survey`, `no_prospek`, `tanggal`, `cabang`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `longitude`, `latitude`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES (NULL, '".$no_survey."', '".$no_prospek."',NOW(),'".$cabang."','".$nama_cust."','".$nama_perusahaan."','".$alamat."','".$kelurahan."','".$kecamatan."','".$kota."','".$kode_pos."','".$no_telp."','".$no_hp_1."','".$no_hp_2."','".$contact_person."','".$email."','".$longitude."','".$latitude."','".$marketing."',NOW(),NOW(),'".$loggedin["username"]."','".$loggedin["username"]."','0');";
		//echo $insert_prospek;
		mysql_query($insert_survey, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert survey = $insert_survey");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'spk_survey.php';
		</script>";
	    }else{
		echo "<script language='JavaScript'>
			alert('Data Tidak Boleh Kosong!');
			window.history.go(-1);
		      </script>";
	    }
	}elseif($update == "Save"){
	    
	    $no_survey		= isset($_POST['no_survey']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_survey']))) : "";
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim(strip_tags($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(trim(strip_tags($_POST['cabang']))) : "";
	    $kode_cust		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim(strip_tags($_POST['kode_customer']))) : "";
	    $nama_cust		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_customer']))) : "";
	    $nama_perusahaan	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_perusahaan']))) : "";
	    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim(strip_tags($_POST['alamat']))) : "";
	    $kelurahan		= isset($_POST['kelurahan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kelurahan']))) : "";
	    $kecamatan		= isset($_POST['kecamatan']) ? mysql_real_escape_string(trim(strip_tags($_POST['kecamatan']))) : "";
	    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(trim(strip_tags($_POST['kota']))) : "";
	    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(trim(strip_tags($_POST['kode_pos']))) : "";
	    $no_telp		= isset($_POST['notelp']) ? mysql_real_escape_string(trim(strip_tags($_POST['notelp']))) : "";
	    $no_hp_1		= isset($_POST['hp1']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp1']))) : "";
	    $no_hp_2		= isset($_POST['hp2']) ? mysql_real_escape_string(trim(strip_tags($_POST['hp2']))) : "";
	    $contact_person	= isset($_POST['contact']) ? mysql_real_escape_string(trim(strip_tags($_POST['contact']))) : "";
	    $longitude		= isset($_POST['longitude']) ? mysql_real_escape_string(trim(strip_tags($_POST['longitude']))) : "";
	    $latitude		= isset($_POST['latitude']) ? mysql_real_escape_string(trim(strip_tags($_POST['latitude']))) : "";
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(trim(strip_tags($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_marketing']))) : "";
	    
		    
		$insert_survey    	= "UPDATE `gx_survey` SET `no_prospek`='".$no_prospek."',
		`cabang`='".$cabang."',`nama_cust`='".$nama_cust."',
		`nama_perusahaan`='".$nama_perusahaan."',`alamat`='".$alamat."',`kelurahan`='".$kelurahan."',
		`kecamatan`='".$kecamatan."',`kota`='".$kota."',`kode_pos`='".$kode_pos."',
		`no_telp`='".$no_telp."',`no_hp_1`='".$no_hp_1."',`no_hp_2`='".$no_hp_2."',
		`contact_person`='".$contact_person."',`email`='".$email."',`longitude` = '".$longitude."', `latitude` = '".$latitude."',
		`marketing`='".$marketing."',
		`date_upd`= NOW(),`user_upd`= '".$loggedin["username"]."' WHERE `id_survey`='".$_GET["id_survey"]."'";
		
		
		//echo $insert_prospek;
		mysql_query($insert_survey, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit survey = $insert_survey");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'spk_survey.php';
		</script>";
	}
$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
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
	header("location: ".URL_ADMIN."logout.php");
    }

?>