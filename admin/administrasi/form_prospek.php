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
		$get_id = isset($_GET['id_prospek']) ? mysql_real_escape_string(trim(strip_tags($_GET['id_prospek']))) : "";
		$data_prospek = mysql_fetch_array(mysql_query("SELECT `id_prospek`, `no_prospek`, `tanggal`, `cabang`, `kode_cust`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_prospek` WHERE `gx_prospek`.`id_prospek` = '$get_id';", $conn));
	    }
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Prospek</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm"  method="POST" action="">
                                    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" id="cabang" name="cabang" required=""
						value="'.(isset($_GET["id_prospek"]) ? $data_prospek['cabang'] :"").'"> <a href="data_cabang.php?r=myForm"  onclick="return valideopenerform(\'data_cabang.php?r=myForm\',\'cabang\');">Search Cabang</a>
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control hasDatepicker" id="datepicker" name="tanggal" required="" value="'.date("Y-m-d").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Prospek</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="no_prospek" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_prospek'] :"").'">
						
					    </div>
					    <!--<div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="kode_customer" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_cust'] :"").'"><a href="data_cust.php?r=myForm" onclick="return valideopenerform(\'data_cust.php?r=myForm\',\'cust\');">Search Customer</a>
					    </div>-->
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control"  name="nama_customer" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_cust'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Perusahaan</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" name="nama_perusahaan" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['nama_perusahaan'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-10">
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
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kota" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kota'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>Kode Pos</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kode_pos" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['kode_pos'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Telp</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="notelp" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_telp'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="hp1" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_1'] :"") .'">
					    </div>
					    <div class="col-xs-2">
						<label>No. HP 2 </label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="hp2" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['no_hp_2'] :"") .'">
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
						<label>Email</label>
                                            </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" name="email" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['email'] :"").'" required="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" required="" class="form-control" name="nama_marketing" value="'.(isset($_GET["id_prospek"]) ? $data_prospek['marketing'] :"") .'" >
						<a href="data_marketing.php?r=myForm" onclick="return valideopenerform(\'data_marketing.php?r=myForm\',\'cust\');">Search Employee</a>
						<input type="hidden" class="form-control" name="id_employee" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_prospek']) ? $data_prospek["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id_prospek']) ? $data_prospek["user_upd"]." ".$data_prospek["date_upd"] : "").'
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
	    
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim(strip_tags($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(trim(strip_tags($_POST['cabang']))) : "";
	    
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
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(trim(strip_tags($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_marketing']))) : "";
	    
	    
		    
		$insert_prospek    	= "INSERT INTO `gx_prospek`(`id_prospek`, `no_prospek`, `tanggal`, `cabang`, `nama_cust`, `nama_perusahaan`, `alamat`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp_1`, `no_hp_2`, `contact_person`, `email`, `marketing`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES (NULL,'".$no_prospek."',NOW(),'".$cabang."','".$nama_cust."','".$nama_perusahaan."','".$alamat."','".$kelurahan."','".$kecamatan."','".$kota."','".$kode_pos."','".$no_telp."','".$no_hp_1."','".$no_hp_2."','".$contact_person."','".$email."','".$marketing."',NOW(),NOW(),'".$loggedin["username"]."','".$loggedin["username"]."','0');";
		//echo $insert_prospek;
		mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert prospek = $insert_prospek");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_prospek';
		</script>";
	}elseif($update == "Save"){
	    
	    $no_prospek		= isset($_POST['no_prospek']) ? mysql_real_escape_string(trim(strip_tags($_POST['no_prospek']))) : "";
	    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim(strip_tags($_POST['tanggal']))) : "";
	    $cabang		= isset($_POST['cabang']) ? mysql_real_escape_string(trim(strip_tags($_POST['cabang']))) : "";
	    
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
	    $email		= isset($_POST['email']) ? mysql_real_escape_string(trim(strip_tags($_POST['email']))) : "";
	    $marketing		= isset($_POST['nama_marketing']) ? mysql_real_escape_string(trim(strip_tags($_POST['nama_marketing']))) : "";
	    
		    
		$insert_prospek    	= "UPDATE `gx_prospek` SET `no_prospek`='".$no_prospek."',
		`cabang`='".$cabang."',`nama_cust`='".$nama_cust."',
		`nama_perusahaan`='".$nama_perusahaan."',`alamat`='".$alamat."',`kelurahan`='".$kelurahan."',
		`kecamatan`='".$kecamatan."',`kota`='".$kota."',`kode_pos`='".$kode_pos."',
		`no_telp`='".$no_telp."',`no_hp_1`='".$no_hp_1."',`no_hp_2`='".$no_hp_2."',
		`contact_person`='".$contact_person."',`email`='".$email."',
		`marketing`='".$marketing."',
		`date_upd`=NOW(),`user_upd`='".$loggedin["username"]."' WHERE `id_prospek`='".$_GET["id_prospek"]."'";
		
		
		//echo $insert_prospek;
		mysql_query($insert_prospek, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit prospek = $insert_prospek");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_prospek';
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

    $title	= 'Form Prospek';
    $submenu	= "prospek";
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