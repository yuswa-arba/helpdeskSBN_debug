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

//resize image
function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//Construct a proportional size of new image
	$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 
	$NewWidth  			= ceil($ImageScale*$CurWidth);
	$NewHeight 			= ceil($ImageScale*$CurHeight);
	$NewCanves 			= imagecreatetruecolor($NewWidth, $NewHeight);
	
	imagealphablending($NewCanves, false);
        imagesavealpha($NewCanves,true);
        $transparent = imagecolorallocatealpha($NewCanves, 255, 255, 255, 127);
        imagefilledrectangle($NewCanves, 0, 0, $NewWidth, $NewHeight, $transparent);
        
	
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	//Destroy image, frees memory	
	if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
	return true;
	}

}



redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    $id_port    = "1";
    global $conn;
    global $conn_voip;

/*  $sql_tv = mysql_query("SELECT *
				  FROM `gx_vod_stream`
				  WHERE `level` = '0'
				  ORDER BY `id` ASC;",$conn);   
if(isset($_POST["save_role"]))
{
    $role_menu 	= array();
    $role_menu	= isset($_POST["role_menu"]) ? $_POST["role_menu"] : $role_menu;
    $id_group	= isset($_POST["id_group"]) ? trim(strip_tags($_POST["id_group"])) : "";
    
    print_r ($role_menu);
    
    //$sql_menu = mysql_query("SELECT * FROM `gx_role_menu`", $conn);
    //delete all data first
    
    
    foreach($role_menu as $key => $value){
	$sql_menu = mysql_query("SELECT count(*) as `total` FROM `gx_vod_tvod_packages_det` WHERE `id_package` = '".$id_group."'
			    AND `id_tv` = '".$key."' LIMIT 0,1;", $conn);
	$row_menu = mysql_fetch_array($sql_menu);
	******************************************************
	  *  if($value != "on" AND $row_menu["total"] == 1){
		$sql_qroup_role = "DELETE FROM `gx_user_group_role`
		WHERE `id_group`= '".$id_group."' AND `id_menu` = '".$key."';";
		//echo "delete$key<br>";
	    }elseif($value == "on" AND $row_menu["total"] == 0){
		
		echo "Insert$key<br>";
	    }
	******************************************************
    }
    
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."system/group_role.php?id_group=".$id_group."';
	</script>";
    
//    $id_complaint = array();
//    $id_complaint = isset($_POST["id_complaint"]) ? $_POST["id_complaint"] : $id_complaint;
//    foreach($id_complaint as $key => $value){
//	    $update    = mysql_query("UPDATE `gx_complaint` SET level='1' WHERE `id_complaint`='$value'") or die(mysql_error());
//    }
//    header("location: incoming.php?type=complaint");
}
*/


/* save update memmber */

$save = isset($_POST["insert"]) ? $_POST["insert"] : "";
$edit = isset($_POST["update"]) ? $_POST["update"] : "";

//Some Settings
$BigImageMaxSize 	= 150; //Image Maximum height or width
$ThumbPrefix		= "thumb_"; //Normal thumb Prefix
$DestinationDirectory	= '../../upload/thumb/'; //Upload Directory ends with / (slash)
$Quality 		= 90;

// Random number for both file, will be added after image name
$RandomNumber 	= rand(0, 9999999999);


if($save == "Save"){
	$user_index_add = isset($_POST['user_index_add']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_index_add']))) : "";
	$first_name	= isset($_POST['firstname']) ? mysql_real_escape_string(strip_tags(trim($_POST['firstname']))) : "";
	$last_name	= isset($_POST['lastname']) ? mysql_real_escape_string(strip_tags(trim($_POST['lastname']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email   	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$id_package 	= isset($_POST['package']) ? mysql_real_escape_string(strip_tags(trim($_POST['package']))) : "";
	$ip_address 	= isset($_POST['ip_address']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_address']))) : "";
	$mac_address 	= isset($_POST['mac_address']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac_address']))) : "";
	$port 		= isset($_POST['port']) ? mysql_real_escape_string(strip_tags(trim($_POST['port']))) : "";
        
        $username 	= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : "";
	$password 	= isset($_POST['password']) ? mysql_real_escape_string(strip_tags(trim($_POST['password']))) : "";
	
	
        $nama_file	= isset($_FILES["ImageFile"]) ? $_FILES['ImageFile']['tmp_name'] : "";
	
	if( $nama_file != ""){
	// check $_FILES['ImageFile'] array is not empty
	// "is_uploaded_file" Tells whether the file was uploaded via HTTP POST
	if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name']))
	{
			die('Something went wrong with Upload!'); // output error when above checks fail.
	}
	// Elements (values) of $_FILES['ImageFile'] array
	//let's access these values by using their index position
	$ImageName 		= str_replace(' ','-',strtolower($_FILES['ImageFile']['name'])); 
	$ImageSize 		= $_FILES['ImageFile']['size']; // Obtain original image size
	$TempSrc	 	= $_FILES['ImageFile']['tmp_name']; // Tmp name of image file stored in PHP tmp folder
	$ImageType	 	= $_FILES['ImageFile']['type']; //Obtain file type, returns "image/png", image/jpeg, text/plain etc.

	//Let's use $ImageType variable to check wheather uploaded file is supported.
	//We use PHP SWITCH statement to check valid image format, PHP SWITCH is similar to IF/ELSE statements 
	//suitable if we want to compare the a variable with many different values
	switch(strtolower($ImageType))
	{
		case 'image/png':
			$CreatedImage =  imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
			break;
		case 'image/gif':
			$CreatedImage =  imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
			break;			
		case 'image/jpeg':
		case 'image/pjpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
			break;
		default:
			die('Unsupported File!'); //output error and exit
	}
	
	//PHP getimagesize() function returns height-width from image file stored in PHP tmp folder.
	//Let's get first two values from image, width and height. list assign values to $CurWidth,$CurHeight
	list($CurWidth,$CurHeight)=getimagesize($TempSrc);
	//Get file extension from Image name, this will be re-added after random name
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
  	$ImageExt = str_replace('.','',$ImageExt);
	
	//remove extension from filename
	$ImageName 		= preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName); 
	
	//Construct a new image name (with random number added) for our new image.
	$NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;
	//set the Destination Image
	$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name
	$DestRandImageName 		= $DestinationDirectory.$NewImageName; //Name for Big Image
	
	//Resize image to our Specified Size by calling resizeImage function.
	if(resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
	{
            
        }else{
		die('Resize Error'); //output error
	}
	}else{
	  $NewImageName = '';
	}
	
	$query = "INSERT INTO `gx_vod_member` (`id_member`, `first_name`, `last_name`, `address`, `phone`, `email`, `photo`, `id_port`,
					`ip_address`, `mac_address`, `last_visit`, `date_register`, `date_upd`, `level`, `user_index_add`)
		  VALUES ('', '$first_name', '$last_name', '$address', '$phone', '$email', '$NewImageName', '$id_port',
			  '$ip_address', '$mac_address', '', now(), now(), '0', '$user_index_add')";
        
        mysql_query($query, $conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
            </script>");
        $query_id_member = mysql_query("SELECT `id_member` FROM `gx_vod_member` WHERE `first_name` = '$first_name' AND `last_name` = '$last_name' AND `address` = '$address' AND `phone` = '$phone' AND
		`phone` = '$phone' AND `email` = '$email' AND `ip_address` = '$ip_address' AND `user_index_add` = '$user_index_add' AND `id_port` = '$port' AND
		`mac_address` = '$mac_address' LIMIT 0,1;", $conn);
        $row_id_member   = mysql_fetch_array($query_id_member);
        $id_member = $row_id_member["id_member"];
        
        $query_login = "INSERT INTO `gx_vod_users` (`id_member`, `username`, `password`, `group`, `lastvisit`, `user_active`,
                                             `user_ip_lastvisit`, `lockout_time`, `online`, `blokir`)
                        VALUES ('$id_member', '$username', MD5('$password'), 'member', '', 'no', '', '', '', 'tidak');";
        
        //echo $username.' '.$password;
	//echo $query;
	
        mysql_query($query_login, $conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan Info Login!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'member.php';
            </script>";
}elseif($edit == "Save"){
    	$id_member	= isset($_POST['id_member']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_member']))) : "";
	$user_index_add = isset($_POST['user_index_add']) ? mysql_real_escape_string(strip_tags(trim($_POST['user_index_add']))) : "";
	$first_name	= isset($_POST['firstname']) ? mysql_real_escape_string(strip_tags(trim($_POST['firstname']))) : "";
	$last_name	= isset($_POST['lastname']) ? mysql_real_escape_string(strip_tags(trim($_POST['lastname']))) : "";
	$address 	= isset($_POST['address']) ? mysql_real_escape_string(strip_tags(trim($_POST['address']))) : "";
	$phone	 	= isset($_POST['phone']) ? mysql_real_escape_string(strip_tags(trim($_POST['phone']))) : "";
	$email   	= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['email']))) : "";
	$id_package 	= isset($_POST['package']) ? mysql_real_escape_string(strip_tags(trim($_POST['package']))) : "";
	$ip_address 	= isset($_POST['ip_address']) ? mysql_real_escape_string(strip_tags(trim($_POST['ip_address']))) : "";
	$mac_address 	= isset($_POST['mac_address']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac_address']))) : "";
	$port 		= isset($_POST['port']) ? mysql_real_escape_string(strip_tags(trim($_POST['port']))) : "";
	
        $username 	= isset($_POST['username']) ? mysql_real_escape_string(strip_tags(trim($_POST['username']))) : "";
	$password 	= isset($_POST['password']) ? mysql_real_escape_string(strip_tags(trim($_POST['password']))) : "";
	
	$nama_file	= isset($_FILES["ImageFile"]) ? $_FILES['ImageFile']['tmp_name'] : "";
	//echo $nama_file;
	if( $nama_file != ""){
	// check $_FILES['ImageFile'] array is not empty
	// "is_uploaded_file" Tells whether the file was uploaded via HTTP POST
	if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name']))
	{
			die('Something went wrong with Upload!'); // output error when above checks fail.
	}
	// Elements (values) of $_FILES['ImageFile'] array
	//let's access these values by using their index position
	$ImageName 		= str_replace(' ','-',strtolower($_FILES['ImageFile']['name'])); 
	$ImageSize 		= $_FILES['ImageFile']['size']; // Obtain original image size
	$TempSrc	 	= $_FILES['ImageFile']['tmp_name']; // Tmp name of image file stored in PHP tmp folder
	$ImageType	 	= $_FILES['ImageFile']['type']; //Obtain file type, returns "image/png", image/jpeg, text/plain etc.

	//Let's use $ImageType variable to check wheather uploaded file is supported.
	//We use PHP SWITCH statement to check valid image format, PHP SWITCH is similar to IF/ELSE statements 
	//suitable if we want to compare the a variable with many different values
	switch(strtolower($ImageType))
	{
		case 'image/png':
			$CreatedImage =  imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
			break;
		case 'image/gif':
			$CreatedImage =  imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
			break;			
		case 'image/jpeg':
		case 'image/pjpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
			break;
		default:
			die('Unsupported File!'); //output error and exit
	}
	
	//PHP getimagesize() function returns height-width from image file stored in PHP tmp folder.
	//Let's get first two values from image, width and height. list assign values to $CurWidth,$CurHeight
	list($CurWidth,$CurHeight)=getimagesize($TempSrc);
	//Get file extension from Image name, this will be re-added after random name
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
  	$ImageExt = str_replace('.','',$ImageExt);
	
	//remove extension from filename
	$ImageName 		= preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName); 
	
	//Construct a new image name (with random number added) for our new image.
	$NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;
	//set the Destination Image
	$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumb name
	$DestRandImageName 		= $DestinationDirectory.$NewImageName; //Name for Big Image
	
	//Resize image to our Specified Size by calling resizeImage function.
	if(resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
	{
            
        }else{
		die('Resize Error'); //output error
	}
	}else{
	  $NewImageName = isset($_POST['photo']) ? mysql_real_escape_string(strip_tags(trim($_POST['photo']))) : "";
	}
	
        $query = "UPDATE `gx_vod_member` SET `first_name` = '$first_name', `last_name` = '$last_name', `address` = '$address',
		`phone` = '$phone', `email` = '$email', `ip_address` = '$ip_address', `photo` = '$NewImageName',
		`mac_address` = '$mac_address', `date_upd` = now(), `user_index_add` = '$user_index_add', `id_port` = '$port'
		WHERE `id_member` = '$id_member'";
	//echo $query;
        if($password !=""){
          $query_login = "UPDATE `gx_vod_member` SET `username` = '$username', `password` = MD5('$password')
		WHERE `id_member` = '$id_member'";
          //echo $query_login;
          mysql_query($query_login) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database1, Ada kesalahan Login!');
			window.history.go(-1);
            </script>");
        }
        //echo $query;
        
	mysql_query($query, $conn) or die("<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database2, Ada kesalahan!');
			window.history.go(-1);
            </script>");
	
	echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'member.php';
            </script>";
}


/* end save edit member */




if(isset($_GET["id"])){
  $id_member	= isset($_GET['id']) ? (int)$_GET['id'] : "";
  $query        = "SELECT * FROM `gx_vod_member`, `gx_vod_users` WHERE
                    `gx_vod_member`.`id_member` = `gx_vod_users`.`id_member` AND
		    `gx_vod_member`.`id_member` = '$id_member' AND
                    `gx_vod_users`.`group` = 'member' AND
		    `gx_vod_member`.`level` = '0' LIMIT 0,1";
  $hasil        = mysql_query($query, $conn);
  $data         = mysql_fetch_array($hasil);
  
  //SQL LAST TRANSAKSI
  $sql_last_transaksi = mysql_query("SELECT `gx_vod_transaksi`.*, `gx_vod_movies`.`title` FROM `gx_vod_transaksi`, `gx_vod_movies`
			WHERE `gx_vod_transaksi`.`id_movie` =  `gx_vod_movies`.`id_movies`
                        AND `gx_vod_transaksi`.`tgl_beli` LIKE '".date("Y-m-")."%'
			AND `gx_vod_transaksi`.`id_member` = '$id_member'
			AND `gx_vod_transaksi`.`level` = '0'
			ORDER BY `gx_vod_transaksi`.`id_transaksi` DESC LIMIT 0,5;", $conn);

  //SUMMARY SQL LAST TRANSAKSI
  $sum_thismonth_transaksi = mysql_num_rows(mysql_query("SELECT `gx_vod_transaksi`.*, `gx_vod_movies`.`title` FROM `gx_vod_transaksi`, `gx_vod_movies`
			WHERE `gx_vod_transaksi`.`id_movie` =  `gx_vod_movies`.`id_movies`
                        AND `gx_vod_transaksi`.`tgl_beli` LIKE '".date("Y-m-")."%'
			AND `gx_vod_transaksi`.`id_member` = '$id_member'
			AND `gx_vod_transaksi`.`level` = '0'", $conn));
  
  $sum_last_transaksi = mysql_num_rows($sql_last_transaksi);
  
  //SQL LOG VIEW
  $sql_log_view = mysql_query("SELECT `gx_vod_log_view_movie`.*, `gx_vod_movies`.`title` FROM `gx_vod_log_view_movie`, `gx_vod_movies`
			WHERE `gx_vod_log_view_movie`.`id_movie` =  `gx_vod_movies`.`id_movies`
                        AND `gx_vod_log_view_movie`.`date_view` LIKE '".date("Y-m-")."%'
			AND `gx_vod_log_view_movie`.`id_member` = '$id_member'
			AND `gx_vod_log_view_movie`.`level` = '0'
			ORDER BY `id_log_view_movie` DESC LIMIT 0,5;", $conn);
  $sum_log_view = mysql_num_rows($sql_log_view);
  
  //SQL TOPUP
  $sql_topup	= mysql_query("SELECT * FROM `gx_vod_topup` WHERE `id_member` = '$id_member'
		  AND `level` = '0' AND `date_added` LIKE '".date("Y-m-")."%'
		  LIMIT 0,5;", $conn);
  $sum_topup	= mysql_num_rows($sql_topup);
  $sum_thismonth_topup	= mysql_num_rows(mysql_query("SELECT * FROM `gx_vod_topup` WHERE `id_member` = '$id_member'
		  AND `level` = '0' AND `date_added` LIKE '".date("Y-m-")."%'", $conn));
  
  //SQL PACKAGE
  $sql_package	= mysql_query("SELECT  `gx_vod_transaksi` . * ,  `gx_vod_packages` . * 
			FROM  `gx_vod_packages` ,  `gx_vod_member` ,  `gx_vod_transaksi` 
			WHERE  `gx_vod_transaksi`.`id_packages` =  `gx_vod_packages`.`id_packages` 
			AND `gx_vod_transaksi`.`id_member` =  `gx_vod_member`.`id_member`
			AND `gx_vod_transaksi`.`id_member` = '".$id_member."'
			AND  `gx_vod_transaksi`.`tgl_expired` >  '".date("Y-m-d H:i:s")."'
			LIMIT 0 , 1;", $conn);
  $row_package	= mysql_fetch_array($sql_package);
  
  //SQL LAST ACTIVITY
  $last_activity = mysql_fetch_array(mysql_query("SELECT * FROM `gx_vod_sessions` WHERE `uid` = '$id_member'
						 ORDER BY `id` DESC LIMIT 1,1", $conn));

  //SQL VIRTUAL ACCOUNT
  $sql_account = mysql_query("SELECT * FROM `gx_vod_virtual_account`, `gx_vod_member` WHERE `gx_vod_member`.`id_member` = `gx_vod_virtual_account`.`id_member`
                             AND `gx_vod_virtual_account`.`level`='0' AND `gx_vod_virtual_account`.`id_member` = '$id_member' LIMIT 0,1;", $conn);
  $row_account	= mysql_fetch_array($sql_account);

$query_package  = mysql_query("SELECT * FROM `gx_vod_packages` WHERE `gx_vod_packages`.`level` = '0' ORDER BY `id_packages` ASC", $conn);



    $content ='<section class="content-header">
                    <h1>
                        Detail Member 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="system_user"> User Group</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    
			    ';

    $sql_member = mysql_query("SELECT * FROM `gx_vod_member`,`gx_vod_users`, `gx_vod_port`
                            WHERE `gx_vod_users`.`id_member` = `gx_vod_member`.`id_member` AND
                            `gx_vod_member`.`id_port` = `gx_vod_port`.`id_port` AND
                            `gx_vod_users`.`group` = 'member'",$conn);
    
$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Member</h2>
                                </div>';

                                $content .= '<form action="" method="post" name="form_member" id="form_member"  method="post" enctype="multipart/form-data">
        <table style="width:100%;">
        <tbody style="vertical-align:top;">
        <tr valig="top">
          <td style="width:50%;">
          
          <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Member Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <tbody><tr>
                <td><span class="required">*</span> First Name:</td>
                <td><input type="text" name="firstname" value="'.(isset($_GET['id']) ? strip_tags(trim($data["first_name"])) : "").'"></td>
              </tr>
              <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lastname" value="'.(isset($_GET['id']) ? strip_tags(trim($data["last_name"])) : "").'"></td>
              </tr>
              <tr>
                <td><span class="required">*</span> Address:</td>
                <td><textarea name="address" cols="50" rows="6">'.(isset($_GET['id']) ? strip_tags(trim($data["address"])) : "").'</textarea>
                  </td>
              </tr>
              <tr>
                <td><span class="required">*</span> E-Mail:</td>
                <td><input type="text" name="email" value="'.(isset($_GET['id']) ? strip_tags(trim($data["email"])) : "").'">
                  </td>
              </tr>
              <tr>
                <td><span class="required">*</span> Telephone:</td>
                <td><input type="text" name="phone" value="'.(isset($_GET['id']) ? strip_tags(trim($data["phone"])) : "").'">
                  </td>
              </tr>
	      <tr>
                <td>Member of:</td>
                <td>';
		if($loggedin["group"] == "sadmin"){
                $query_port = mysql_query("SELECT * FROM `gx_vod_port` WHERE `level` = '0';", $conn);
		
		$content .='<select name="port">
                <option value=""> -- Choose City -- </option>';
		while ($row_port = mysql_fetch_array($query_port)){
                  if(isset($_GET['id'])){
                    $selected_port = ($row_port["id_port"] == $data["id_port"]) ? 'selected=""' : "";
                  }else{
                    $selected_port = '';
                  }
                  
                  $content .= '<option value="'.$row_port["id_port"].'" '.$selected_port.'>'.$row_port["name_port"].'</option>';
                }
		$content .='</select>';
		}elseif($loggedin["group"] == "admin"){
		  $query_port2 = mysql_query("SELECT * FROM `gx_vod_port` WHERE `id_port` = '$id_port' AND `level` = '0';", $conn);
		  $row_port2 = mysql_fetch_array($query_port2);
		  
		  $content .='<input type="text" name="port_name" value="'.$row_port2["name_port"].'" readonly="">
		  <input type="hidden" name="port" value="'.$row_port2["id_port"].'" readonly="">';
		}
$content .='

</td>
              </tr>
              <tr>
                <td>IP Adrress:</td>
                <td><input type="text" name="ip_address" value="'.(isset($_GET['id']) ? strip_tags(trim($data["ip_address"])) : "").'"></td>
              </tr>
              <tr>
                <td>MAC Adrress:</td>
                <td><input type="text" name="mac_address" value="'.(isset($_GET['id']) ? strip_tags(trim($data["mac_address"])) : "").'"></td>
              </tr>
	      <tr>
                <td>Image:</td>
                <td><input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" /></td>
              </tr>
	      <tr>
                <td colspan="2"><img id="preview" src="'.(isset($_GET['id']) ? '../../upload/thumb/thumb_'.$data["photo"] : "").'" alt="Preview Image" />
		<input type="hidden" name="photo" value="'.(isset($_GET['id']) ? $data["photo"] : "").'" readonly="">
		</td>
              </tr>
        
              <!--<tr>
                <td>Package:</td>
                <td><select name="package">
                <option value=""> -- Choose Package -- </option>';
                /*while ($row_package = mysql_fetch_array($query_package)){
                  if(isset($_GET['id'])){
                    $selected_package = ($row_package["id_packages"] == $data["package"]) ? 'selected=""' : "";
                  }else{
                    $selected_package = '';
                  }
                  
                  $content .= '<option value="'.$row_package["id_packages"].'" '.$selected_package.'>'.$row_package["name_package"].'</option>';
                }
		*/
$content .='</select></td>
              </tr>-->
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td></td>
                <td><input type="submit" name="'.(isset($_GET['id']) ? "update" : "insert").'" value="Save"></td>
                <td colspan="2"></td>
              </tr>
            </tbody></table>
	    </div></div>	
          </td>
          <td style="width:50%;">
            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Login Information</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <tbody>
              <tr>
                <td><span class="required">*</span> Username:</td>
                <td><input type="text" name="username" value="'.(isset($_GET['id']) ? strip_tags(trim($data["username"])) : "").'"></td>
              </tr>
              <tr>
                <td><span class="required">*</span> Password:</td>
                <td><input type="password" name="password" value=""></td>
              </tr>
            </tbody></table></div></div>';
	  if(isset($_GET['id'])){
	    $content .='
	    <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Saldo Information</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <tbody>
              <tr>
                <td>Saldo</td>
                <td>: '.Rupiah(isset($_GET['id']) ? strip_tags(trim($data["saldo"])) : "").' '.(isset($_GET['id']) ? '( <a href="form_topup.php?id_member='.(int)$_GET['id'].'">topup saldo</a> )' : "" ).'</td>
              </tr>
              <tr>
                <td>Package</td>
                <td>: '.($jum_package=mysql_num_rows($query_package) ? strip_tags(trim($row_package["name_package"])).' ( <a href="detail_package.php?id='.$data["id_member"].'" class="package" id="package">Rincian</a> )' : "Non Package").'</td>
              </tr>
            </tbody></table></div></div>';
	  }
          
	
	
        if(isset($_GET['id'])){
          $content .='<input type="hidden" name="id_member" value="'.(int)$_GET['id'].'">';
        }
$content .='<input type="hidden" name="user_index_add" value="'.$loggedin["id_employee"].'"></td>
        </tr></tbody>
        </table></form>';
                               
$content .= '                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#paket\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>


    ';

    $title	= 'User Group';
    $submenu	= "system_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
else{
 
    $content ='<section class="content-header">
                    <h1>
                        Detail Member 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="system_user"> User Group</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    
			    ';

$content .='		<div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Member</h2>
                                </div>';

                                $content .= '<form action="" method="post" name="form_member" id="form_member"  method="post" enctype="multipart/form-data">
        <table style="width:100%;">
        <tbody style="vertical-align:top;">
        <tr valig="top">
          <td style="width:50%;">
          
          <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Member Details</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <tbody><tr>
                <td><span class="required">*</span> First Name:</td>
                <td><input type="text" name="firstname" value=""></td>
              </tr>
              <tr>
                <td>Last Name:</td>
                <td><input type="text" name="lastname" value=""></td>
              </tr>
              <tr>
                <td><span class="required">*</span> Address:</td>
                <td><textarea name="address" cols="50" rows="6"></textarea>
                  </td>
              </tr>
              <tr>
                <td><span class="required">*</span> E-Mail:</td>
                <td><input type="text" name="email" value="">
                  </td>
              </tr>
              <tr>
                <td><span class="required">*</span> Telephone:</td>
                <td><input type="text" name="phone" value="">
                  </td>
              </tr>
	      <tr>
                <td>Member of:</td>
                <td>';
		if($loggedin["group"] == "sadmin"){
                $query_port = mysql_query("SELECT * FROM `gx_vod_port` WHERE `level` = '0';", $conn);
		
		$content .='<select name="port">
                <option value=""> -- Choose City -- </option>';
		while ($row_port = mysql_fetch_array($query_port)){
                  
                  $content .= '<option value="'.$row_port["id_port"].'" '.$selected_port.'>'.$row_port["name_port"].'</option>';
                }
		$content .='</select>';
		}elseif($loggedin["group"] == "admin"){
		  $query_port2 = mysql_query("SELECT * FROM `gx_vod_port` WHERE `id_port` = '$id_port' AND `level` = '0';", $conn);
		  $row_port2 = mysql_fetch_array($query_port2);
		  $content .='<select name="port">
                <option value=""> -- Choose City -- </option>';
		while ($row_port2 = mysql_fetch_array($query_port2)){
                  
                  $content .= '<option value="'.$row_port2["id_port"].'" '.$selected_port.'>'.$row_port2["name_port"].'</option>';
                }
		$content .='</select>';
		}
$content .='

</td>
              </tr>
              <tr>
                <td>IP Adrress:</td>
                <td><input type="text" name="ip_address" value="'.(isset($_GET['id']) ? strip_tags(trim($data["ip_address"])) : "").'"></td>
              </tr>
              <tr>
                <td>MAC Adrress:</td>
                <td><input type="text" name="mac_address" value="'.(isset($_GET['id']) ? strip_tags(trim($data["mac_address"])) : "").'"></td>
              </tr>
	      <tr>
                <td>Image:</td>
                <td><input type="file" name="ImageFile" id="ImageFile" onchange="readURL(this);" /></td>
              </tr>
	      <tr>
                <td colspan="2"><img id="preview" src="'.(isset($_GET['id']) ? '../../upload/thumb/thumb_'.$data["photo"] : "").'" alt="Preview Image" />
		<input type="hidden" name="photo" value="'.(isset($_GET['id']) ? $data["photo"] : "").'" readonly="">
		</td>
              </tr>
        
              <!--<tr>
                <td>Package:</td>
                <td><select name="package">
                <option value=""> -- Choose Package -- </option>';
                /*while ($row_package = mysql_fetch_array($query_package)){
                  if(isset($_GET['id'])){
                    $selected_package = ($row_package["id_packages"] == $data["package"]) ? 'selected=""' : "";
                  }else{
                    $selected_package = '';
                  }
                  
                  $content .= '<option value="'.$row_package["id_packages"].'" '.$selected_package.'>'.$row_package["name_package"].'</option>';
                }
		*/
$content .='</select></td>
              </tr>-->
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td></td>
                <td><input type="submit" name="'.(isset($_GET['id']) ? "update" : "insert").'" value="Save"></td>
                <td colspan="2"></td>
              </tr>
            </tbody></table>
	    </div></div>	
          </td>
          <td style="width:50%;">
            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Login Information</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
              <tbody>
              <tr>
                <td><span class="required">*</span> Username:</td>
                <td><input type="text" name="username" value="'.(isset($_GET['id']) ? strip_tags(trim($data["username"])) : "").'"></td>
              </tr>
              <tr>
                <td><span class="required">*</span> Password:</td>
                <td><input type="password" name="password" value=""></td>
              </tr>
            </tbody></table></div></div>';
	 
	
	
     
$content .='<input type="hidden" name="user_index_add" value=""></td>
        </tr></tbody>
        </table></form>';
                               
$content .= '                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#paket\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>


    ';

    $title	= 'User Group';
    $submenu	= "system_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}


}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>