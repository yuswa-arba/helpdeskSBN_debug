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
    $id_employee 	= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(trim($_POST['cKode'])) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(trim($_POST['cNama'])) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(trim($_POST['cAlamat1'])) : '';
    $cAlamatEmail	= isset($_POST['cAlamatEmail']) ? mysql_real_escape_string(trim($_POST['cAlamatEmail'])) : '';
    $cHandPhone1 	= isset($_POST['cHandPhone1']) ? mysql_real_escape_string(trim($_POST['cHandPhone1'])) : '';
    $cSex	 	= isset($_POST['cSex']) ? mysql_real_escape_string(trim($_POST['cSex'])) : '';
    $cBagian	 	= isset($_POST['cBagian']) ? mysql_real_escape_string(trim($_POST['cBagian'])) : '';
    $dTglMasuk	 	= isset($_POST['dTglMasuk']) ? mysql_real_escape_string(trim($_POST['dTglMasuk'])) : '';
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $ext_voip		= isset($_POST['ext_voip']) ? mysql_real_escape_string(trim($_POST['ext_voip'])) : '';
    $cNonAktif		= isset($_POST['cNonAktif']) ? mysql_real_escape_string(trim($_POST['cNonAktif'])) : '';
    
    $username		= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
    $password		= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $id_group		= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
    
    
    $sql_group = mysql_query("SELECT * FROM `gx_user_group` WHERE `id_group` = '".$id_group."' AND `level` = '0';", $conn);
    $row_group = mysql_fetch_array($sql_group);
    $group_nama = $row_group["group_nama"];
    
    
    //insert into tbPegawai
    $sql_insert_staff = "INSERT INTO `tbPegawai` (`id_employee`, `cKode`, `cNama`, `cAlamatEmail`,
                    `cAlamat1`, `cHandPhone1`, `ext_voip`, `id_cabang`, `cBagian`, `cSex`,
		    `dTglMasuk`, `cNonAktif`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES (NULL, '".$cKode."', '".$cNama."', '".$cAlamatEmail."',
                    '".$cAlamat1."', '".$cHandPhone1."', '".$ext_voip."',
                    '".$id_cabang."', '".$cBagian."', '".$cSex."', '".$dTglMasuk."', '".$cNonAktif."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_staff, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_staff);
    
    $sql_insert_login = "INSERT INTO `gxLogin_admin` (`id_user`, `id_employee`, `username`, `password`,
			`password_date`, `group`, `id_group`,
			`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$cKode."', '".$username."', '".md5($password)."',
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
			VALUES (NULL, '".$cKode."',  '".$NewImageName."',
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
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(trim($_POST['cKode'])) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(trim($_POST['cNama'])) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(trim($_POST['cAlamat1'])) : '';
    $cAlamatEmail	= isset($_POST['cAlamatEmail']) ? mysql_real_escape_string(trim($_POST['cAlamatEmail'])) : '';
    $cHandPhone1 	= isset($_POST['cHandPhone1']) ? mysql_real_escape_string(trim($_POST['cHandPhone1'])) : '';
    $cSex	 	= isset($_POST['cSex']) ? mysql_real_escape_string(trim($_POST['cSex'])) : '';
    $cBagian	 	= isset($_POST['cBagian']) ? mysql_real_escape_string(trim($_POST['cBagian'])) : '';
    $dTglMasuk	 	= isset($_POST['dTglMasuk']) ? mysql_real_escape_string(trim($_POST['dTglMasuk'])) : '';
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $ext_voip		= isset($_POST['ext_voip']) ? mysql_real_escape_string(trim($_POST['ext_voip'])) : '';
    $cNonAktif		= isset($_POST['cNonAktif']) ? mysql_real_escape_string(trim($_POST['cNonAktif'])) : '';
    
    $idFoto		= isset($_POST['idFoto']) ? mysql_real_escape_string(trim($_POST['idFoto'])) : '';
    $id_user		= isset($_POST['id_user']) ? mysql_real_escape_string(trim($_POST['id_user'])) : '';
    $username		= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
    $password		= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $group		= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
    
    
    //insert into tbPegawai
    $sql_update_staff = "UPDATE `tbPegawai` SET `cKode` = '".$cKode."', `cNama` = '".$cNama."',
		    `cAlamatEmail` = '".$cAlamatEmail."', `cAlamat1` = '".$cAlamat1."',
		    `cHandPhone1` = '".$cHandPhone1."', `ext_voip` = '".$ext_voip."',
		    `id_cabang` = '".$id_cabang."', `cBagian` = '".$cBagian."', `cSex` = '".$cSex."',
		    `dTglMasuk` = '".$dTglMasuk."', `cNonAktif` = '".$cNonAktif."',
		    `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		    WHERE `id_employee` = '".$id_employee."';";
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
			VALUES (NULL, '".$cKode."',  '".$NewImageName."',
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
    $query_staff 	= "SELECT * FROM `tbPegawai` WHERE `id_employee`='$id_staff' LIMIT 0,1;";
    $sql_staff	= mysql_query($query_staff, $conn);
    $row_staff	= mysql_fetch_array($sql_staff);
    
    $query_user	= "SELECT * FROM `gxLogin_admin` WHERE `id_employee`='".$row_staff["cKode"]."' LIMIT 0,1;";
    $sql_user	= mysql_query($query_user, $conn);
    $row_user	= mysql_fetch_array($sql_user);
    
    $query_foto	= "SELECT * FROM `gxFoto_Profile` WHERE `id_employee`='".$id_staff."' LIMIT 0,1;";
    $sql_foto	= mysql_query($query_foto, $conn);
    $row_foto	= mysql_fetch_array($sql_foto);
    
}

$jum_staff	= mysql_num_rows(mysql_query("SELECT * FROM `tbPegawai`", $conn));
    
    $content ='<section class="content-header">
                    <h1>
                        Master Staff
                        
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
						<label>Kode Staff</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cKode" value="'.(isset($_GET['id']) ? $row_staff["cKode"] : 'GX-'.sprintf('%06d', $jum_staff)).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cNama" value="'.(isset($_GET['id']) ? $row_staff["cNama"] : "").'">
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
						<textarea class="form-control" name="cAlamat1" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_staff["cAlamat1"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cAlamatEmail" value="'.(isset($_GET['id']) ? $row_staff["cAlamatEmail"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Phone Number</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cHandPhone1" value="'.(isset($_GET['id']) ? $row_staff["cHandPhone1"] : "").'">
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
						<label>Port Office</label>
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
						<label>Department</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required" name="cBagian" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_bagian = mysql_query("SELECT * FROM `gx_bagian` WHERE `level` = '0';", $conn);
						    
						    while($row_bagian = mysql_fetch_array($sql_bagian))
						    {
							$content .='<option value="'.$row_bagian["nama_bagian"].'" '.((isset($_GET["id"]) && $row_staff["cBagian"] == $row_bagian["nama_bagian"] ) ? 'selected="selected"' :"") .'>'.$row_bagian["nama_bagian"].'</option>';
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
						<input class="required" type="radio" name="cSex" value="L" style="float:left;" '.((isset($_GET["id"]) && $row_staff["cSex"]== "L" ) ? "checked" :"") .'>Man
						<input class="required" type="radio" name="cSex" value="P" style="float:left;" '.((isset($_GET["id"]) && $row_staff["cSex"]== "P" ) ? "checked" :"") .'>Woman
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Tanggal Masuk</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="dTglMasuk" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_staff["dTglMasuk"])) : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						<input class="required" type="radio" name="cNonAktif" value="0" style="float:left;" '.((isset($_GET["id"]) && $row_staff["cNonAktif"]== "0" ) ? "checked" :"") .'>Aktif
						<input class="required" type="radio" name="cNonAktif" value="1" style="float:left;" '.((isset($_GET["id"]) && $row_staff["cNonAktif"]== "1" ) ? "checked" :"") .'>NonAktif
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