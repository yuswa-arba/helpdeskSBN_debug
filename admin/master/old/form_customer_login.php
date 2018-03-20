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
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(trim($_POST['cKode'])) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(trim($_POST['cNama'])) : '';
    $cNamaPers		= isset($_POST['cNamaPers']) ? mysql_real_escape_string(trim($_POST['cNamaPers'])) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(trim($_POST['cAlamat1'])) : '';
    $cKota		= isset($_POST['cKota']) ? mysql_real_escape_string(trim($_POST['cKota'])) : '';
    $cDaerah		= isset($_POST['cDaerah']) ? mysql_real_escape_string(trim($_POST['cDaerah'])) : '';
    $ctelp		= isset($_POST['ctelp']) ? mysql_real_escape_string(trim($_POST['ctelp'])) : '';
    $cfax		= isset($_POST['cfax']) ? mysql_real_escape_string(trim($_POST['cfax'])) : '';
    $cContact		= isset($_POST['cContact']) ? mysql_real_escape_string(trim($_POST['cContact'])) : '';
    $nterm		= isset($_POST['nterm']) ? mysql_real_escape_string(trim($_POST['nterm'])) : '';
    $cKet		= isset($_POST['cKet']) ? mysql_real_escape_string(trim($_POST['cKet'])) : '';
    $cEmail		= isset($_POST['cEmail']) ? mysql_real_escape_string(trim($_POST['cEmail'])) : '';
    $cMailIntern 	= isset($_POST['cMailIntern']) ? mysql_real_escape_string(trim($_POST['cMailIntern'])) : '';
    $cUserID	 	= isset($_POST['cUserID']) ? mysql_real_escape_string(trim($_POST['cUserID'])) : '';
    $cNamaIbu	 	= isset($_POST['cNamaIbu']) ? mysql_real_escape_string(trim($_POST['cNamaIbu'])) : '';

    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $dTglMulai		= isset($_POST['dTglMulai']) ? mysql_real_escape_string(trim($_POST['dTglMulai'])) : '';
    $cNonAktiv		= isset($_POST['cNonAktiv']) ? mysql_real_escape_string(trim($_POST['cNonAktiv'])) : '';
    
    //data_login
    $username		= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
    $password		= isset($_POST['pass']) ? mysql_real_escape_string(trim($_POST['pass'])) : '';
    $repassword		= isset($_POST['repass']) ? mysql_real_escape_string(trim($_POST['repass'])) : '';

    
    //insert into tbPegawai
    $sql_insert_customer = "INSERT INTO `tbCustomer` (`idCustomer`, `cKode`, `cNama`, `cNamaPers`, `cAlamat1`, 
	`cKota`, `cDaerah`, `ctelp`, `cfax`, `cContact`,
	`nterm`, `cKet`, `cEmail`, `cMailIntern`,
	`cUserID`, `cNamaIbu`, `dTglMulai`, `cNonAktiv`,
	`id_cabang`, `paket_voip`, `paket_data`, `paket_video`, `gx_saldo`, `gx_tipe`,
	`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$cKode."', '".$cNama."', '".$cNamaPers."', '".$cAlamat1."',
	'".$cKota."', '".$cDaerah."', '".$ctelp."', '".$cfax."', '".$cContact."',
	'".$nterm."', '".$cKet."', '".$cEmail."', '".$cMailIntern."', 
	'".$cUserID."', '".$cNamaIbu."', '".$dTglMulai."', '".$cNonAktiv."',
	'".$id_cabang."', '', '', '', '0', 'webgx',
	'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
        //echo $insert."<br>";
	
    //echo $sql_insert_customer;
    echo mysql_query($sql_insert_customer, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_customer);
    
    
    //sql insert data login
    $sql_insert_login = "INSERT INTO `gxLogin` (`id_user`, `customer_number`, `id_voip`,
        `id_vod`, `id_cabang`, `username`, `password`, `password_date`, `ip`, `mac`,
        `user_service`, `user_ip`, `filter_name`, `start_date`, `user_expiry_date`,
        `manual_expiration_date`, `suspend_date`, `user_active`, `account_index`,
        `user_time_bank`, `user_kb_bank`, `user_dollar_bank`, `user_balance`,
        `user_payment_balance`, `time_online`, `callback_number`, `group`, `id_group`,
        `caller_id`, `lockout`, `lockout_time`, `lockout_count`, `grace_period_expiration`,
        `nas_attributes`, `user_ip_lastvisit`, `lastvisit`, `level`)
        VALUES (NULL, '".$cKode."', '', '', '".$id_cabang."', '".$username."', MD5('".$password."'), NOW(),
        '".$_SERVER['REMOTE_ADDR']."', '', '0', '', '', NOW(), '0000-00-00 00:00:00', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 'yes', '0', '0', '0', '0', '0', '0', '0', '', 'customer', '0', '0', '0',
        NOW(), '0', '0', '0', '".$_SERVER['REMOTE_ADDR']."', NOW(), '0');";
        //echo $insert."<br>";
	
    //echo $sql_insert_customer;
    echo mysql_query($sql_insert_login, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_login);
    
    
    //upload foto
    $target_dir = "../img/customer/";
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
	    echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	    echo "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
    }
    // Check file size
    if ($_FILES["ImageFile"]["size"] > 1000000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["ImageFile"]["tmp_name"], $target_file)) {
	    //echo "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    
	    $sql_insert_foto = "INSERT INTO `gxFoto_Profile` (`idFoto`, `cKode`, `file_foto`,
			`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$cKode."',  '".$NewImageName."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	    //echo $sql_insert_foto;
	    mysql_query($sql_insert_foto, $conn) or die (mysql_error());
	    
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_foto);
	} else {
	    echo "Sorry, there was an error uploading your file.";
	}
    }

 
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master/customer.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $idCustomer       	= isset($_POST['idCustomer']) ? mysql_real_escape_string(trim($_POST['idCustomer'])) : '';
    $cKode       	= isset($_POST['cKode']) ? mysql_real_escape_string(trim($_POST['cKode'])) : '';
    $cNama       	= isset($_POST['cNama']) ? mysql_real_escape_string(trim($_POST['cNama'])) : '';
    $cNamaPers		= isset($_POST['cNamaPers']) ? mysql_real_escape_string(trim($_POST['cNamaPers'])) : '';
    $cAlamat1   	= isset($_POST['cAlamat1']) ? mysql_real_escape_string(trim($_POST['cAlamat1'])) : '';
    $cKota		= isset($_POST['cKota']) ? mysql_real_escape_string(trim($_POST['cKota'])) : '';
    $cDaerah		= isset($_POST['cDaerah']) ? mysql_real_escape_string(trim($_POST['cDaerah'])) : '';
    $ctelp		= isset($_POST['ctelp']) ? mysql_real_escape_string(trim($_POST['ctelp'])) : '';
    $cfax		= isset($_POST['cfax']) ? mysql_real_escape_string(trim($_POST['cfax'])) : '';
    $cContact		= isset($_POST['cContact']) ? mysql_real_escape_string(trim($_POST['cContact'])) : '';
    $nterm		= isset($_POST['nterm']) ? mysql_real_escape_string(trim($_POST['nterm'])) : '';
    $cKet		= isset($_POST['cKet']) ? mysql_real_escape_string(trim($_POST['cKet'])) : '';
    $cEmail		= isset($_POST['cEmail']) ? mysql_real_escape_string(trim($_POST['cEmail'])) : '';
    $cMailIntern 	= isset($_POST['cMailIntern']) ? mysql_real_escape_string(trim($_POST['cMailIntern'])) : '';
    $cUserID	 	= isset($_POST['cUserID']) ? mysql_real_escape_string(trim($_POST['cUserID'])) : '';
    $cNamaIbu	 	= isset($_POST['cNamaIbu']) ? mysql_real_escape_string(trim($_POST['cNamaIbu'])) : '';

    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $dTglMulai		= isset($_POST['dTglMulai']) ? mysql_real_escape_string(trim($_POST['dTglMulai'])) : '';
    $cNonAktiv		= isset($_POST['cNonAktiv']) ? mysql_real_escape_string(trim($_POST['cNonAktiv'])) : '';
    
    $idFoto		= isset($_POST['idFoto']) ? mysql_real_escape_string(trim($_POST['idFoto'])) : '';
    //Update into tbPegawai
    $sql_update_customer = "UPDATE `tbCustomer` SET `cKode` = '".$cKode."', `cNama` = '".$cNama."',
		    `cNamaPers` = '".$cNamaPers."', `cAlamat1` = '".$cAlamat1."',
		    `cKota` = '".$cKota."', `cDaerah` = '".$cDaerah."',
		    `ctelp` = '".$ctelp."', `cfax` = '".$cfax."', `cContact` = '".$cContact."',
		    `nterm` = '".$nterm."', `cKota` = '".$cKet."',
		    `cEmail` = '".$cEmail."', `cMailIntern` = '".$cMailIntern."',
		    `cUserID` = '".$cUserID."', `cNamaIbu` = '".$cNamaIbu."',
		    `dTglMulai` = '".$dTglMulai."', `cNonAktiv` = '".$cNonAktiv."',
		    `id_cabang` = '".$id_cabang."',
		    `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		    WHERE `idCustomer` = '".$idCustomer."';";
    //echo $sql_update_customer;
    echo mysql_query($sql_update_customer, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_customer);
    
    //upload foto
    $target_dir = "../img/customer/";
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
	    echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	} else {
	    echo "File is not an image.";
	    $uploadOk = 0;
	}
    }else{
	$uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["ImageFile"]["size"] > 500000) {
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
	if (move_uploaded_file($_FILES["ImageFile"]["tmp_name"], $target_file)) {
	    //echo "The file ". basename( $_FILES["ImageFile"]["name"]). " has been uploaded.";
	    
	    $sql_insert_foto = "INSERT INTO `gxFoto_Profile` (`idFoto`, `cKode`, `file_foto`,
		    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		    VALUES (NULL, '".$cKode."',  '".$NewImageName."',
		    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	    //echo $sql_insert_foto;
	    mysql_query($sql_insert_foto, $conn) or die (mysql_error());
	    
	    //log
	    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_foto);
	    
	} else {
	    echo "Sorry, there was an error uploading your file.";
	}
    }

    
   
    /*echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master/customer.php';
	</script>";*/
	
}

if(isset($_GET["id"]))
{
    $cKode		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_customer 	= "SELECT * FROM `tbCustomer` WHERE `cKode`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_customer	= mysql_query($query_customer, $conn);
    $row_customer	= mysql_fetch_array($sql_customer);
    
    $query_foto	= "SELECT * FROM `gxFoto_Profile` WHERE `cKode`='".$cKode."' AND `level` = '0' LIMIT 0,1;";
    $sql_foto	= mysql_query($query_foto, $conn);
    $row_foto	= mysql_fetch_array($sql_foto);
    
    // DATA INTERNET
/*$sql_paket_data = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_data` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_data = mysql_fetch_array($sql_paket_data);*/
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [dbo].[Users], [dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$row_customer["iuserIndex"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();


//DATA VOIP
$sql_paket_voip = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$row_customer["cKode"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);
$sql_saldo = mysql_query("SELECT `credit`, `useralias` FROM `cc_card` WHERE `useralias` = '' LIMIT 0,1;", $conn_voip);
$row_saldo = mysql_fetch_array($sql_saldo);


$sql_cust_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` = ''", $conn_voip);
$row_cust_voip = mysql_fetch_array($sql_cust_voip);

$view_id = $row_cust_voip["id"];

$query_callhistory = "SELECT t1.starttime, t1.src, t1.calledstation, t1.destination, t1.sessiontime, t1.terminatecauseid, t1.sipiax, t1.sessionbill
                    FROM `cc_call` t1
                    WHERE `src` != 0 AND `card_id` = '$view_id'
                    AND `starttime`
		    ORDER BY `starttime` DESC
		    LIMIT 0,4";

$sql_callhistory = mysql_query($query_callhistory, $conn_voip);


//DATA VIDEO
$sql_paket_video = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_video` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$row_customer["cKode"]."';", $conn);
$row_paket_video = mysql_fetch_array($sql_paket_video);
   
    
}


    
    $content ='<section class="content-header">
                    <h1>
                        Master Customer
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Customer</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Data Customer</a></li>
                                    
				    <li><a href="#tab_2" data-toggle="tab">Foto</a></li>
                                    <li><a href="#tab_login" data-toggle="tab">Data Login</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Port Office</label>
					    </div>
					    <div class="col-xs-8">
						<select class="form-control required"  name="id_cabang" id="id_cabang" style="width:200px;">
						    <option value="">Choose one</option>';
						    
						    $sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0';", $conn);
						    $kode_cust = "";
						    while($row_cabang = mysql_fetch_array($sql_cabang))
						    {
							$content .='<option value="'.$row_cabang["id_cabang"].'" '.((isset($_GET["id"]) && $row_customer["id_cabang"] == $row_cabang["id_cabang"] ) ? 'selected="selected"' :"") .'>'.$row_cabang["nama_cabang"].'</option>';
							$kode_cust .= '"'.$row_cabang["kode_customer"].'",';
						    }
						    
$content .='						</select>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" id="cNama" onkeyup="generatecKode();" required="" name="cNama" value="'.(isset($_GET['id']) ? $row_customer["cNama"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" id="cKode" name="cKode" value="'.(isset($_GET['id']) ? $row_customer["cKode"] : '').'" readonly="">
						<input type="hidden" name="idCustomer" value="'.(isset($_GET['id']) ? $row_customer["idCustomer"] : '').'" readonly="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Company Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cNamaPers" value="'.(isset($_GET['id']) ? $row_customer["cNamaPers"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Address</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="cAlamat1" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_customer["cAlamat1"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>City</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cKota" value="'.(isset($_GET['id']) ? $row_customer["cKota"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>State</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cDaerah" value="'.(isset($_GET['id']) ? $row_customer["cDaerah"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Phone</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="ctelp" value="'.(isset($_GET['id']) ? $row_customer["ctelp"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Fax</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cfax" value="'.(isset($_GET['id']) ? $row_customer["cfax"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Contact</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="cContact" value="'.(isset($_GET['id']) ? $row_customer["cContact"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Term</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" required="" name="nterm" value="'.(isset($_GET['id']) ? $row_customer["nterm"] : "0").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cKet" value="'.(isset($_GET['id']) ? $row_customer["cKet"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Address</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cEmail" value="'.(isset($_GET['id']) ? $row_customer["cEmail"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Intern</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cMailIntern" value="'.(isset($_GET['id']) ? $row_customer["cMailIntern"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cUserID" value="'.(isset($_GET['id']) ? $row_customer["cUserID"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Mother\'s Name</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="cNamaIbu" value="'.(isset($_GET['id']) ? $row_customer["cNamaIbu"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Activation Date</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="dTglMulai" value="'.(isset($_GET['id']) ? date("d-m-Y", strtotime($row_customer["dTglMulai"])) : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						<input class="required" type="radio" name="cNonAktiv" value="0" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "0" ) ? "checked" : "") .'>Aktif
						<input class="required" type="radio" name="cNonAktiv" value="1" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "1" ) ? "checked" : "") .'>NonAktif
						<input class="required" type="radio" name="cNonAktiv" value="2" style="float:left;" '.((isset($_GET["id"]) && $row_customer["cNonAktiv"]== "2" ) ? "checked" : "checked") .'>Proses
					    </div>
                                        </div>
					</div>
					</div><!-- /.tab-pane -->
					
				    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Photo</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden" name="idFoto" value="'.(isset($_GET['id']) ? $row_foto["idFoto"] : "").'">
						<img id="preview" src="'.(isset($_GET['id']) ? URL_ADMIN.'img/customer/'.$row_foto["file_foto"] : "").'" alt="Preview Image" /><br>		
						<input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" />
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_login">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Username</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="username" value="">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Password</label>
					    </div>
					    <div class="col-xs-8">
						<input type="password" class="form-control" required="" name="pass" value="">
					    </div>
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Retype Password</label>
					    </div>
					    <div class="col-xs-8">
						<input type="password" class="form-control" required="" name="repass" value="">
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
                        </section>
			<section class="col-lg-5 connectedSortable"> 
                            <div class="box box-solid box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">Data/Internet</h3>
                                </div><!-- /.box-header -->
				<div class="box-body">';
if(isset($_GET["id"]))
{
$content .='
                                <div style="font-size:20px;">Status  '.(($row_paket_data["UserActive"] == "1") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
				    Periode: <b>-</b><br>
				    <br><br><br>';
//Periode: <b>'.(($row_paket_data["UserActive"] == "1") ? "3-".(date("M-Y", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"))))." - "."3-".(date("M-Y", mktime(date("H"), date("i"), date("s"), (date("m")+1), date("d"), date("Y")))) : "Expire Date").'</b><br>
}

$content .='
                                </div>
                            </div><!-- /.box -->
			    <div class="box  box-solid box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">VOIP</h3>
                                </div><!-- /.box-header -->
				<div class="box-body">';
if(isset($_GET["id"]))
{
$content .='
				    <!--<div style="font-size:20px;">Status  '.(($row_paket_voip["level"] == "0") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				    
				    Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
				    Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
                                    Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
				    Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
				    Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
				    
				    <br><br>-->';
}

$content .='
                                </div>
                            </div><!-- /.box -->
			    <div class="box  box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title">Video</h3>
                                </div><!-- /.box-header -->
				 <div class="box-body">';
if(isset($_GET["id"]))
{
$content .='
				 <!--';
                                    $status_vod = 'OFF';
				    $content .= '<div style="font-size:20px;">Status  '.(($status_vod != "OFF") ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>").'</div><br>
				   <br><br>
				    
				    <button class="btn btn-default"  title="sign up" onclick="window.location.href=\'vod/paket.php\'">Sign up</button>
					<br><br><br><br><br>-->';
}

$content .='
                                </div>
                            </div><!-- /.box -->
			    
                        </section>
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
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}


function generatecKode() {
    var kodecust = ["",'.substr($kode_cust, 0, -1).'];
    var cport = document.getElementById("id_cabang").value;
    var cnama = document.getElementById("cNama").value;
    
    $.ajax({url: "sum_cust.php?k=" + kodecust[cport] + "-" + cnama.charAt(0), success: function(result){
        
	document.getElementById("cKode").value = kodecust[cport] + "-" + cnama.charAt(0) + pad((parseInt(result)+1), 4);
	
    }});
    
    
}

</script>';

//document.getElementById("id_cabang2").value = cport + (parseInt(result)+1);
    $title	= 'Form Customer';
    $submenu	= "master_customer";
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