<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("config/configuration.php");
include ("config/upload.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
if($loggedin["group"] == 'customer'){
enableLog($loggedin["id_user"], $loggedin["username"], "", "Open Menu Profile");  
    global $conn;
    
if(isset($_POST["update"]))
{
    $nama		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$email		= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
    $no_telp	= isset($_POST['no_telp']) ? mysql_real_escape_string(trim($_POST['no_telp'])) : '';
	$kota		= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$agama	= isset($_POST['agama']) ? mysql_real_escape_string(trim($_POST['agama'])) : '';
    
	//upload foto
    $target_dir = "img/profile/customer/";
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
		
		//update data lama
		$sql_update_lama = "UPDATE `gxFoto_Profile` SET `level`='1', `user_upd`='".$loggedin["username"]."', `date_upd`=NOW()
		WHERE (`cKode`='".$loggedin["customer_number"]."');";
		mysql_query($sql_update_lama, $conn) or die (mysql_error());

		
		//insert into gx_bagian
		$sql_insert_baru = "INSERT INTO `gxFoto_Profile` (`idFoto`, `cKode`, `file_foto`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
		VALUES (NULL, '".$loggedin["customer_number"]."', '".$NewImageName."', 
			`user_add` = '".$loggedin["username"]."', `date_add` = NOW(),
			`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW(), '0');";
		//echo $sql_update_staff;
		mysql_query($sql_insert_baru, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["customer_number"],$sql_insert_baru);
		
	    
	} else {
	    $error_msg = "Sorry, there was an error uploading your file.";
	}
    }
	
    
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='profile.php';
	</script>";
	
}

	$sql_profile = mysql_query("SELECT * FROM `gxFoto_Profile` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_provider = mysql_fetch_array($sql_profile);	


    
    $content ='<section class="content-header">
                    <h1>
                       Update Profile
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
							<div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Profile</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									
										
										
                                        <div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<label>Photo</label>
												</div>
												<div class="col-xs-8">
													<img id="preview" src="'.URL.'img/customer/'.$row_provider["file_foto"].'" alt="Preview Image" /><br>		
													<input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" />
												</div>
											</div>
										</div>
                                    </div><!-- /.box-body -->
									
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="update" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
				</div>
			</section>
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


    $title	= 'Profile';
    $submenu	= "profile";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= software_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>