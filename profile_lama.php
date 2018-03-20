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
    
    $sql_profile = mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$loggedin["customer_number"]."' AND `level` = '0' LIMIT 0,1;", $conn);
    $row_profile = mysql_fetch_array($sql_profile);
    $sql_foto_profile = mysql_query("SELECT * FROM `gxFoto_Profile` WHERE `idCustomer` = '".$row_profile["idCustomer"]."' LIMIT 0,1;", $conn);
    $row_foto_profile = mysql_fetch_array($sql_foto_profile);
    
    //input foto profile
    if(isset($_FILES["file_foto"])){
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file_foto"]["name"]);
    $extension = end($temp);
    
    $BigImageMaxSize 		= 215; //Image Maximum height or width
    $ThumbPrefix		= "thumb_"; //Normal thumb Prefix
    $DestinationDirectory	= 'upload/'; //Upload Directory ends with / (slash)
    $Quality 			= 90;

    // Random number for both file, will be added after image name
    $RandomNumber 	= rand(0, 9999999999);
    
    if ((($_FILES["file_foto"]["type"] == "image/gif")
    || ($_FILES["file_foto"]["type"] == "image/jpeg")
    || ($_FILES["file_foto"]["type"] == "image/jpg")
    || ($_FILES["file_foto"]["type"] == "image/pjpeg")
    || ($_FILES["file_foto"]["type"] == "image/x-png")
    || ($_FILES["file_foto"]["type"] == "image/png"))
    && ($_FILES["file_foto"]["size"] < 1000000)
    && in_array($extension, $allowedExts)) {
      if ($_FILES["file_foto"]["error"] > 0) {
	echo "Return Code: " . $_FILES["file_foto"]["error"] . "<br>";
      } else {
	//echo "Upload: " . $_FILES["file_foto"]["name"] . "<br>";
	//echo "Type: " . $_FILES["file_foto"]["type"] . "<br>";
	//echo "Size: " . ($_FILES["file_foto"]["size"] / 1024) . " kB<br>";
	//echo "Temp file: " . $_FILES["file_foto"]["tmp_name"] . "<br>";
	if (file_exists("upload/" . $_FILES["file_foto"]["name"])) {
	  echo $_FILES["file_foto"]["name"] . " already exists. ";
	} else {
	    
	    $nama_file	= isset($_FILES["file_foto"]) ? $_FILES['file_foto']['tmp_name'] : "";
	//echo $nama_file;
	if( $nama_file != ""){
	// check $_FILES['ImageFile'] array is not empty
	// "is_uploaded_file" Tells whether the file was uploaded via HTTP POST
	if(!isset($_FILES['file_foto']) || !is_uploaded_file($_FILES['file_foto']['tmp_name']))
	{
			die('Something went wrong with Upload!'); // output error when above checks fail.
	}
	// Elements (values) of $_FILES['ImageFile'] array
	//let's access these values by using their index position
	$ImageName 		= str_replace(' ','-',strtolower($_FILES['file_foto']['name'])); 
	$ImageSize 		= $_FILES['file_foto']['size']; // Obtain original image size
	$TempSrc	 	= $_FILES['file_foto']['tmp_name']; // Tmp name of image file stored in PHP tmp folder
	$ImageType	 	= $_FILES['file_foto']['type']; //Obtain file type, returns "image/png", image/jpeg, text/plain etc.

	//Let's use $ImageType variable to check wheather uploaded file is supported.
	//We use PHP SWITCH statement to check valid image format, PHP SWITCH is similar to IF/ELSE statements 
	//suitable if we want to compare the a variable with many different values
	switch(strtolower($ImageType))
	{
		case 'image/png':
			$CreatedImage =  imagecreatefrompng($_FILES['file_foto']['tmp_name']);
			break;
		case 'image/gif':
			$CreatedImage =  imagecreatefromgif($_FILES['file_foto']['tmp_name']);
			break;			
		case 'image/jpeg':
		case 'image/pjpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['file_foto']['tmp_name']);
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
	  $thumb = "upload/$NewImageName";
	}else{
	  $thumb = isset($_POST['file_foto']) ? mysql_real_escape_string(strip_tags(trim($_POST['file_foto']))) : "";
	}
	    
	 /* move_uploaded_file($_FILES["file_foto"]["tmp_name"],
	  "upload/" . $_FILES["file_foto"]["name"]);
	  echo "Stored in: " . "upload/" . $_FILES["file_foto"]["name"];
	  $data_name = $_FILES["file_foto"]["name"];*/
	  $upd_data = mysql_query("UPDATE `gxFoto_Profile` SET `file_foto`='$thumb', `date_upd`=NOW() WHERE `idFoto`='$row_foto_profile[idFoto]'", $conn);
	  
	
	  
	  
	  
	  
	  if($upd_data){echo "data diupdate"; } else {echo "data gagal diupdate";}
	    header("location:profile.php");
	}
      }
    } else {
      echo "Invalid file";
    }
    }
    
    
    
    
    // DATA INTERNET
$conn_soft = Config::getInstanceSoft();
$sql_paket_data = $conn_soft->prepare("SELECT TOP 1 [Users].*, [AccountTypes].[AccountName], [AccountTypes].[AccountDescription]
  FROM [DRBSISP].[dbo].[Users], [DRBSISP].[dbo].[AccountTypes]
  WHERE [Users].[AccountIndex] = [AccountTypes].[AccountIndex]
  AND [Users].[UserIndex] = '".$loggedin["user_index"]."';");

$sql_paket_data->execute();
$row_paket_data = $sql_paket_data->fetch();


//DATA VOIP
$sql_paket_voip = mysql_query("SELECT `gx_paket`.* FROM `gx_paket`, `tbCustomer`
			     WHERE `tbCustomer`.`paket_voip` = `gx_paket`.`id_paket`
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_voip = mysql_fetch_array($sql_paket_voip);
$sql_saldo = mysql_query("SELECT `credit`, `useralias` FROM `cc_card` WHERE `useralias` = '".$loggedin["id_voip"]."' LIMIT 0,1;", $conn_voip);
$row_saldo = mysql_fetch_array($sql_saldo);


$sql_cust_voip = mysql_query("SELECT `id` FROM  `cc_card` WHERE `useralias` = '".$loggedin["id_voip"]."'", $conn_voip);
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
			     AND `tbCustomer`.`cKode` = '".$loggedin["customer_number"]."';", $conn);
$row_paket_video = mysql_fetch_array($sql_paket_video);


    $content ='<!-- Main content -->
                <section class="content">
		    <div class="row">
			<section class="col-lg-7"> 
			    <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Profile </h3>
                                    
                                </div>
                                <div class="box-body">
                                    <div class="box-body no-padding">
					<table class="table no-border" width="70%">
					    <tr>
						<td rowspan="8"><img src="'.$row_foto_profile['file_foto'].'" class="img-square" alt="User Image" /></td>
						<td>Nama </td>
						<td>'.$row_profile["cNama"].'</td>
					    </tr>
					    <tr>
						<td>Alamat</td>
						<td>'.$row_profile["cAlamat1"].'<br>
						Kota: '.$row_profile["cKota"].'<br>
						Lihat peta '. (($row_profile["cLati"] !="") ? '<a href="maps.php?id='.$row_profile["cKode"].'"
						onclick="return valideopenerform(\'maps.php?id='.$row_profile["cKode"].'\',\'maps'.$row_profile["idCustomer"].'\');">Klik</a>' : "-").'
						</td>
					    </tr>
					    <tr>
						<td>
					    </tr>
					    <tr>
						<td>No. Telpon</td>
						<td>'.$row_profile["ctelp"].'</td>
					    </tr>
					    <tr>
						<td>Fax</td>
						<td>'.$row_profile["cfax"].'</td>
					    </tr>
					    <tr>
						<td>Nama Perusahaan</td>
						<td>'.$row_profile["cNamaPers"].'</td>
					    </tr>
					    <tr>
						<td>User Id</td>
						<td>'.$row_profile["cUserID"].'</td>
					    </tr>
					    <tr>
						<td>Email</td>
						<td>'.$row_profile["cEmail"].'</td>
					    </tr>
					    <tr>
						<td colspan="3"><form action="" method="POST" enctype="multipart/form-data"><input type="file" name="file_foto" onchange="this.form.submit()"></form></td>
					    </tr>
					    
					</table>
				    </div>
				</div><!-- /.box-body -->
			    </div>
			</section>
			<section class="col-lg-5"> 
			    
			    <div class="box box-solid box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-bar-chart-o"></i>  Status Data/Internet</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    Nama Paket : <b>'.(($row_paket_data["AccountDescription"] == "") ? "-" : $row_paket_data["AccountDescription"]).'</b><br>
				    Time Remaining: <b>'.(($row_paket_data["UserTimeBank"] == "") ? "-" : $row_paket_data["UserTimeBank"]).'</b><br>
				    Volume Based Remaining: <b>'.(($row_paket_data["UserKBBank"] == "") ? "-" :  number_format( ($row_paket_data["UserKBBank"]/1024/1024) , 2 , ',' , '.' ).' MB').'</b><br><br>
				    
				    Status : '.(($row_paket_data["UserActive"] == "1") ? "Aktif" : "Nonaktif").'<br><br><br><br>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			    <div class="box box-solid box-danger">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-phone-square"></i>  VOIP</h3>
				    
				</div>
				<div class="box-body">
				    <div class="box-body no-padding">
					Nomer Telpon : <b>'.$row_saldo["useralias"].'</b><br>
					Saldo : <b>'.Rupiah((int)$row_saldo["credit"]).'</b><br>
					Nama Paket : '.(($row_paket_voip["nama_paket"] == "") ? "-" : $row_paket_voip["nama_paket"]).'<br>
					Expired Paket: '.(($row_paket_voip["periode_paket"] == "") ? "-" : ($row_paket_voip["periode_paket"]/24)).' Hari<br>
					Monthly fee: '.(($row_paket_voip["harga_paket"] == "" OR $row_paket_voip["harga_paket"] == "0") ? "-" : Rupiah($row_paket_voip["harga_paket"])).'<br><br>
					
					Status : '.(($row_paket_voip["level"] == "0") ? "Aktif" : "Nonaktif").'
				    </div>
				</div><!-- /.box-body -->
			    </div>
			    <div class="box box-solid box-warning">
				<div class="box-header">
				    <h3 class="box-title"><i class="fa fa-laptop"></i>  VOD</h3>
				    
				</div>
				<div class="box-body">
				    <div class="box-body no-padding">
				    -
				    </div>
				</div><!-- /.box-body -->
			    </div>
			</section>
		    </div>
		</section><!-- /.content -->
            ';

/*
 *
 *<div class="box box-solid box-info">
				<div class="box-header">
				    <h3 class="box-title">Saldo anda Rp. 100.000,00 </h3>
				    
				</div>
				
			    </div>
 *<!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                            
*/
$plugins = '
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="'.URL.'js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="'.URL.'js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="'.URL.'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="'.URL.'js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="'.URL.'js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="'.URL.'js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="'.URL.'js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>
    ';

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