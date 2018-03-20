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
    //$id_employee 	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    
    $kode_pegawai 	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $id_bagian	 	= isset($_POST['id_bagian']) ? mysql_real_escape_string(trim($_POST['id_bagian'])) : '';
    $nama 		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat 		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $email 		= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
    $hp 		= isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : '';
    $no_ktp 		= isset($_POST['no_ktp']) ? mysql_real_escape_string(trim($_POST['no_ktp'])) : '';
    $tgl_masuk 		= isset($_POST['tgl_masuk']) ? mysql_real_escape_string(trim($_POST['tgl_masuk'])) : '';
    $tgl_lahir 		= isset($_POST['tgl_lahir']) ? mysql_real_escape_string(trim($_POST['tgl_lahir'])) : '';
    $contact_person 	= isset($_POST['contact_person']) ? mysql_real_escape_string(trim($_POST['contact_person'])) : '';
    $nama_cp 		= isset($_POST['nama_cp']) ? mysql_real_escape_string(trim($_POST['nama_cp'])) : '';
    $alamat_cp 		= isset($_POST['alamat_cp']) ? mysql_real_escape_string(trim($_POST['alamat_cp'])) : '';
    $hubungan_cp 	= isset($_POST['hubungan_cp']) ? mysql_real_escape_string(trim($_POST['hubungan_cp'])) : '';
    $id_level 		= isset($_POST['id_level']) ? mysql_real_escape_string(trim($_POST['id_level'])) : '';
    $ptkp 		= isset($_POST['ptkp']) ? mysql_real_escape_string(trim($_POST['ptkp'])) : '';
    $sex 		= isset($_POST['sex']) ? mysql_real_escape_string(trim($_POST['sex'])) : '';
    $no_koperasi 	= isset($_POST['no_koperasi']) ? mysql_real_escape_string(trim($_POST['no_koperasi'])) : '';
    $no_hp 		= isset($_POST['no_hp']) ? mysql_real_escape_string(trim($_POST['no_hp'])) : '';
    $agama 		= isset($_POST['agama']) ? mysql_real_escape_string(trim($_POST['agama'])) : '';
    $status 		= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $account_bank 	= isset($_POST['account_bank']) ? mysql_real_escape_string(trim($_POST['account_bank'])) : '';
    $nama_bank 		= isset($_POST['nama_bank']) ? mysql_real_escape_string(trim($_POST['nama_bank'])) : '';
    $no_acc 		= isset($_POST['no_acc']) ? mysql_real_escape_string(trim($_POST['no_acc'])) : '';
    $nama_pemilik 	= isset($_POST['nama_pemilik']) ? mysql_real_escape_string(trim($_POST['nama_pemilik'])) : '';
    $kota 		= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
    $ext_voip 		= isset($_POST['ext_voip']) ? mysql_real_escape_string(trim($_POST['ext_voip'])) : '';
    $id_cabang 		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    
    $username		= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
    $password		= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $id_group		= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
    
    
    $sql_group = mysql_query("SELECT * FROM `gx_user_group` WHERE `id_group` = '".$id_group."' AND `level` = '0';", $conn);
    $row_group = mysql_fetch_array($sql_group);
    $group_nama = $row_group["group_nama"];
    
    
    //insert into tbPegawai
    $sql_insert_staff = "
    INSERT INTO `gx_pegawai` (`id_employee`, `id_cabang`, `id_bagian`, `kode_pegawai`, `nama`, `alamat`, `email`, `hp`,
    `no_ktp`, `tgl_masuk`, `tgl_lahir`, `contact_person`, `nama_cp`, `alamat_cp`, `hubungan_cp`,
    `id_level`, `ptkp`, `sex`, `no_koperasi`, `no_hp`, `agama`, `status`, `account_bank`,
    `nama_bank`, `no_acc`, `nama_pemilik`, `kota`, `ext_voip`,
    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES (NULL, '".$id_cabang."', '".$id_bagian."', '".$kode_pegawai."', '".$nama."', '".$alamat."', '".$email."', '".$hp."',
    '".$no_ktp."', '".$tgl_masuk."', '".$tgl_lahir."', '".$contact_person."', '".$nama_cp."', '".$alamat_cp."', '".$hubungan_cp."',
    '".$id_level."', '".$ptkp."', '".$sex."', '".$no_koperasi."', '".$no_hp."', '".$agama."', '".$status."', '".$account_bank."',
    '".$nama_bank."', '".$no_acc."', '".$nama_pemilik."', '".$kota."', '".$ext_voip."',
    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_staff, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_staff);
    
    $sql_insert_login = "INSERT INTO `gxLogin_admin` (`id_user`, `id_employee`, `username`, `password`,
			`password_date`, `group`, `id_group`,
			`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$kode_pegawai."', '".$username."', '".md5($password)."',
			NOW(), '".$group_nama."', '".$id_group."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_login;
    mysql_query($sql_insert_login, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_login);
    
    
    
    //upload foto
    $target_dir = "../img/staff/";
    // Random number for both file, will be added after image name
    $RandomNumber 	= rand(0, 9999999999);
    
    $uploadOk = 1;
    $nama_file     = str_replace(' ','-',strtolower($_FILES['ImageFile']['name']));
    $ImageName	   = pathinfo($nama_file, PATHINFO_FILENAME);
    $imageFileType = strtolower(pathinfo($_FILES['ImageFile']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$imageFileType;
    $target_file = $target_dir . $NewImageName;
    
    // Check if image file is a actual image or fake image
    if($_FILES["ImageFile"]["tmp_name"] !="") {
	$check = getimagesize($_FILES["ImageFile"]["tmp_name"]);
	if($check !== false) {
	    $error_msg = "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	    $error_msg = "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
	$error_msg = "Sorry, file already exists.";
	$uploadOk = 0;
    }
    // Check file size
    if ($_FILES["ImageFile"]["size"] > 500000) {
	$error_msg = "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
	$error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	$error_msg = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["ImageFile"]["tmp_name"], $target_file)) {
	    $error_msg = "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    
	    $sql_insert_foto = "INSERT INTO `gxFoto_Profile` (`idFoto`, `id_employee`, `file_foto`,
			`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$kode_pegawai."',  '".$NewImageName."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	    //echo $sql_insert_foto;
	    mysql_query($sql_insert_foto, $conn) or die (mysql_error());
	    
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_foto);
	} else {
	    $error_msg = "Sorry, there was an error uploading your file.";
	}
    }

 
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master/staff.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_employee 	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $id_bagian	 	= isset($_POST['id_bagian']) ? mysql_real_escape_string(trim($_POST['id_bagian'])) : '';
    $id_cabang	 	= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    
    $kode_pegawai 	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $nama 		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat 		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $email 		= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
    $hp 		= isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : '';
    $no_ktp 		= isset($_POST['no_ktp']) ? mysql_real_escape_string(trim($_POST['no_ktp'])) : '';
    $tgl_masuk 		= isset($_POST['tgl_masuk']) ? mysql_real_escape_string(trim($_POST['tgl_masuk'])) : '';
    $tgl_lahir 		= isset($_POST['tgl_lahir']) ? mysql_real_escape_string(trim($_POST['tgl_lahir'])) : '';
    $contact_person 	= isset($_POST['contact_person']) ? mysql_real_escape_string(trim($_POST['contact_person'])) : '';
    $nama_cp 		= isset($_POST['nama_cp']) ? mysql_real_escape_string(trim($_POST['nama_cp'])) : '';
    $alamat_cp 		= isset($_POST['alamat_cp']) ? mysql_real_escape_string(trim($_POST['alamat_cp'])) : '';
    $hubungan_cp 	= isset($_POST['hubungan_cp']) ? mysql_real_escape_string(trim($_POST['hubungan_cp'])) : '';
    $id_level 		= isset($_POST['id_level']) ? mysql_real_escape_string(trim($_POST['id_level'])) : '';
    $ptkp 		= isset($_POST['ptkp']) ? mysql_real_escape_string(trim($_POST['ptkp'])) : '';
    $sex 		= isset($_POST['sex']) ? mysql_real_escape_string(trim($_POST['sex'])) : '';
    $no_koperasi 	= isset($_POST['no_koperasi']) ? mysql_real_escape_string(trim($_POST['no_koperasi'])) : '';
    $no_hp 		= isset($_POST['no_hp']) ? mysql_real_escape_string(trim($_POST['no_hp'])) : '';
    $agama 		= isset($_POST['agama']) ? mysql_real_escape_string(trim($_POST['agama'])) : '';
    $status 		= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $account_bank 	= isset($_POST['account_bank']) ? mysql_real_escape_string(trim($_POST['account_bank'])) : '';
    $nama_bank 		= isset($_POST['nama_bank']) ? mysql_real_escape_string(trim($_POST['nama_bank'])) : '';
    $no_acc 		= isset($_POST['no_acc']) ? mysql_real_escape_string(trim($_POST['no_acc'])) : '';
    $nama_pemilik 	= isset($_POST['nama_pemilik']) ? mysql_real_escape_string(trim($_POST['nama_pemilik'])) : '';
    $kota 		= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
    $ext_voip 		= isset($_POST['ext_voip']) ? mysql_real_escape_string(trim($_POST['ext_voip'])) : '';
    $id_cabang 		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    
    $idFoto		= isset($_POST['idFoto']) ? mysql_real_escape_string(trim($_POST['idFoto'])) : '';
    $id_user		= isset($_POST['id_user']) ? mysql_real_escape_string(trim($_POST['id_user'])) : '';
    $username		= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
    $password		= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $group		= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
    
    
    //insert into tbPegawai
    $sql_update_staff = "UPDATE `software`.`gx_pegawai` SET `kode_pegawai`= '".$kode_pegawai."', `nama`='".$nama."', `alamat`='".$alamat."',
    `email`='".$email."', `hp`='".$hp."', `no_ktp`='".$no_ktp."', `tgl_masuk`='".$tgl_masuk."', `tgl_lahir`='".$tgl_lahir."',
    `contact_person`='".$contact_person."', `nama_cp`='".$nama_cp."', `alamat_cp`='".$alamat_cp."', `hubungan_cp`='".$hubungan_cp."',
    `id_level`='".$id_level."', `ptkp`='".$ptkp."', `sex`='".$sex."', `no_koperasi`='".$no_koperasi."', `no_hp`='".$no_hp."',
    `agama`='".$agama."', `status`='".$status."', `account_bank`='".$account_bank."', `nama_bank`='".$nama_bank."', `id_bagian`='".$id_bagian."',
    `no_acc`='".$no_acc."', `nama_pemilik`='".$nama_pemilik."', `kota`='".$kota."', `ext_voip`='".$ext_voip."', `id_cabang`='".$id_cabang."',
    `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
    WHERE '".$id_employee."'";
    
    //echo $sql_update_staff;
    mysql_query($sql_update_staff, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_staff);
    
    //upload foto
    $target_dir = "../img/staff/";
    // Random number for both file, will be added after image name
    $RandomNumber 	= rand(0, 9999999999);
    
    $uploadOk = 1;
    $nama_file     = str_replace(' ','-',strtolower($_FILES['ImageFile']['name']));
    $ImageName	   = pathinfo($nama_file, PATHINFO_FILENAME);
    $imageFileType = strtolower(pathinfo($_FILES['ImageFile']['name'],PATHINFO_EXTENSION));
    //$target_file = $target_dir . basename($_FILES["ImageFile"]["name"]);
    $NewImageName = $ImageName.'-'.$RandomNumber.'.'.$imageFileType;
    $target_file = $target_dir . $NewImageName;
    
    // Check if image file is a actual image or fake image
    if($_FILES["ImageFile"]["tmp_name"] !="") {
	$check = getimagesize($_FILES["ImageFile"]["tmp_name"]);
	if($check !== false) {
	    $error_msg = "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	    $error_msg = "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
	$error_msg = "Sorry, file already exists.";
	$uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["ImageFile"]["size"] > 500000) {
	$error_msg = "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
	$error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	$error_msg = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["ImageFile"]["tmp_name"], $target_file)) {
	    $error_msg = "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    
	    $sql_insert_foto = "INSERT INTO `gxFoto_Profile` (`idFoto`, `id_employee`, `file_foto`,
			`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$kode_pegawai."',  '".$NewImageName."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	    //echo $sql_insert_foto;
	    mysql_query($sql_insert_foto, $conn) or die (mysql_error());
	    
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_foto);
	    
	    /*$sql_update_foto = "UPDATE `gxFoto_Profile` SET `id_employee` = '".$cKode."', `file_foto` = '".$NewImageName."',
			    `user_upd` =  '".$loggedin["username"]."', `date_upd` = NOW()
			    WHERE `idFoto` = '".$idFoto."'";
	    //echo $sql_update_foto;
	    mysql_query($sql_update_foto, $conn) or die (mysql_error());
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_foto);*/
	} else {
	    $error_msg = "Sorry, there was an error uploading your file.";
	}
    }

    
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master/staff.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_staff		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_staff 	= "SELECT * FROM `gx_pegawai` WHERE `id_employee`='$id_staff' LIMIT 0,1;";
    $sql_staff	= mysql_query($query_staff, $conn);
    $row_staff	= mysql_fetch_array($sql_staff);
    
    $query_user	= "SELECT * FROM `gxLogin_admin` WHERE `id_employee`='".$row_staff["kode_pegawai"]."' LIMIT 0,1;";
    $sql_user	= mysql_query($query_user, $conn);
    $row_user	= mysql_fetch_array($sql_user);
    
    $query_foto	= "SELECT * FROM `gxFoto_Profile` WHERE `id_employee`='".$id_staff."' LIMIT 0,1;";
    $sql_foto	= mysql_query($query_foto, $conn);
    $row_foto	= mysql_fetch_array($sql_foto);
    
}

$jum_staff	= mysql_num_rows(mysql_query("SELECT * FROM `gx_pegawai`", $conn));
    
    $content ='<section class="content-header">
                    <h1>
                        Master Pegawai
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Staff</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Staff</a></li>
                                    '.(isset($_GET['id']) ? "" : '<li><a href="#tab_2" data-toggle="tab">Data Login</a></li>').'
				    <li><a href="#tab_3" data-toggle="tab">Foto</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Pegawai</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="kode_pegawai" value="'.(isset($_GET['id']) ? $row_staff["kode_pegawai"] : 'GX-'.sprintf('%06d', $jum_staff)).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No KTP</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="no_ktp" value="'.(isset($_GET['id']) ? $row_staff["no_ktp"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama" value="'.(isset($_GET['id']) ? $row_staff["nama"] : "").'">
						<input type="hidden" name="id_employee" value="'.(isset($_GET['id']) ? $row_staff["id_employee"] : "").'">
						
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Address</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="alamat" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_staff["alamat"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="kota" value="'.(isset($_GET['id']) ? $row_staff["kota"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="email" value="'.(isset($_GET['id']) ? $row_staff["email"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Phone Number</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="hp" value="'.(isset($_GET['id']) ? $row_staff["hp"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Tanggal Lahir</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="tgl_lahir" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_staff["tgl_lahir"])) : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Ext. VOIP</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="ext_voip" value="'.(isset($_GET['id']) ? $row_staff["ext_voip"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Agama</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required"  name="agama" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_agama = mysql_query("SELECT * FROM `gx_tbagama` WHERE `level` = '0';", $conn);
						    
						    while($row_agama = mysql_fetch_array($sql_agama))
						    {
							$content .='<option value="'.$row_agama["nama_agama"].'" '.((isset($_GET["id"]) && $row_staff["agama"] == $row_agama["nama_agama"] ) ? 'selected="selected"' :"") .'>'.$row_agama["nama_agama"].'</option>';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kantor Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required"  name="id_cabang" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0';", $conn);
						    
						    while($row_cabang = mysql_fetch_array($sql_cabang))
						    {
							$content .='<option value="'.$row_cabang["id_cabang"].'" '.((isset($_GET["id"]) && $row_staff["id_cabang"] == $row_cabang["id_cabang"] ) ? 'selected="selected"' :"") .'>'.$row_cabang["nama_cabang"].'</option>';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Bagian</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required" name="id_bagian" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_bagian = mysql_query("SELECT * FROM `gx_bagian` WHERE `level` = '0';", $conn);
						    
						    while($row_bagian = mysql_fetch_array($sql_bagian))
						    {
							$content .='<option value="'.$row_bagian["nama_bagian"].'" '.((isset($_GET["id"]) && $row_staff["id_bagian"] == $row_bagian["nama_bagian"] ) ? 'selected="selected"' :"") .'>'.$row_bagian["nama_bagian"].'</option>';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Level</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required"  name="id_level" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_level = mysql_query("SELECT * FROM `gx_tblevel` WHERE `level` = '0';", $conn);
						    
						    while($row_level = mysql_fetch_array($sql_level))
						    {
							$content .='<option value="'.$row_level["nama_level"].'" '.((isset($_GET["id"]) && $row_staff["id_level"] == $row_level["nama_level"] ) ? 'selected="selected"' :"") .'>'.$row_level["nama_level"].'</option>';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Sex</label>
					    </div>
					    <div class="col-xs-8">
						<input class="required" type="radio" name="sex" value="L" style="float:left;" '.((isset($_GET["id"]) && $row_staff["sex"]== "L" ) ? "checked" :"") .'>Laki-laki
						<input class="required" type="radio" name="sex" value="P" style="float:left;" '.((isset($_GET["id"]) && $row_staff["sex"]== "P" ) ? "checked" :"") .'>Perempuan
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Tanggal Masuk</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="tgl_masuk" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_staff["tgl_masuk"])) : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						<input class="required" type="radio" name="status" value="0" style="float:left;" '.((isset($_GET["id"]) && $row_staff["status"]== "0" ) ? "checked" :"") .'>Belum Menikah
						<input class="required" type="radio" name="status" value="1" style="float:left;" '.((isset($_GET["id"]) && $row_staff["status"]== "1" ) ? "checked" :"") .'>Menikah
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Contact Person</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="contact_person" value="'.(isset($_GET['id']) ? $row_staff["contact_person"] : "").'">
					    </div>
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama CP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="nama_cp" value="'.(isset($_GET['id']) ? $row_staff["nama_cp"] : "").'">
					    </div>
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat CP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="alamat_cp" value="'.(isset($_GET['id']) ? $row_staff["alamat_cp"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>PTKP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="ptkp" value="'.(isset($_GET['id']) ? $row_staff["ptkp"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Hubungan CP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="hubungan_cp" value="'.(isset($_GET['id']) ? $row_staff["hubungan_cp"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>No. Koperasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_koperasi" value="'.(isset($_GET['id']) ? $row_staff["no_koperasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telpon CP</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_hp" value="'.(isset($_GET['id']) ? $row_staff["no_hp"] : "").'">
					    </div>
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Account Bank</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="account_bank" value="'.(isset($_GET['id']) ? $row_staff["account_bank"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>No. ACC</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_acc" value="'.(isset($_GET['id']) ? $row_staff["no_acc"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Bank</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="nama_bank" value="'.(isset($_GET['id']) ? $row_staff["nama_bank"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Nama Pemilik</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="nama_pemilik" value="'.(isset($_GET['id']) ? $row_staff["nama_pemilik"] : "").'">
					    </div>
                                        </div>
					</div>
					
					</div><!-- /.tab-pane -->';
					
if(!isset($_GET["id"]))
{
    $content .='                    
                                    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Username</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="username" value="'.(isset($_GET['id']) ? $row_user["username"] : "").'">
						<input type="hidden" name="id_user" value="'.(isset($_GET['id']) ? $row_user["id_user"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Password</label>
					    </div>
					    <div class="col-xs-8">
						<input type="password" class="form-control" name="password" value="">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Group</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required" name="group" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_group = mysql_query("SELECT * FROM `gx_user_group` WHERE `level` = '0';", $conn);
						    
						    while($row_group = mysql_fetch_array($sql_group))
						    {
							$content .='<option value="'.$row_group["id_group"].'" '.((isset($_GET["id"]) && $row_user["group"] == $row_group["group_nama"] ) ? 'selected="selected"' :"") .'>'.$row_group["group_nama"].'</option>';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.tab-pane -->';
				    
}
$content .='
				    <div class="tab-pane" id="tab_3">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Photo</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden" name="idFoto" value="'.(isset($_GET['id']) ? $row_foto["idFoto"] : "").'">
						<img id="preview" src="'.(isset($_GET['id']) ? URL_ADMIN.'img/staff/'.$row_foto["file_foto"] : "").'" alt="Preview Image" /><br>		
						<input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" />
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function (e) {
	    $(\'#preview\')
		.attr(\'src\', e.target.result)
		.width(250);
	};

	reader.readAsDataURL(input.files[0]);
    }
}
</script>';

    $title	= 'Form Staff';
    $submenu	= "master_staff";
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