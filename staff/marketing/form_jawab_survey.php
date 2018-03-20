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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open form jawab SPK marketing");
        global $conn;
    
if($_GET["id_survey"]){
    $sql_mastersurvey = mysql_query("SELECT * FROM `gx_survey` WHERE `level` = '0' AND `id_survey` = '$_GET[id_survey]'  ORDER BY `id_survey` DESC;",$conn);
    $row_mastersurvey = mysql_fetch_array($sql_mastersurvey);
}
    $sql_last_jawab  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `date_add` LIKE '%".date("Y-m-d")."%' ORDER BY `id_jawab_spksurvey` DESC", $conn));
    $last_data  = $sql_last_jawab["id_jawab_spksurvey"] + 1;
    $tanggal    = date("Ymd");
    $no_jawab  = 'MJS-'.$tanggal.''.sprintf("%04d", $last_data);

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
                                <form role="form" name="myForm" id="myForm" method="POST" enctype="multipart/form-data" action="">
                                    <div class="box-body">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Jawaban SPK Survey</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="no_jawab" name="no_jawab" required="" value="'.$no_jawab.'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. SPK</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="no_survey" id="no_survey" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['no_spk_survey'] :"") .'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="nama" id="nama" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['nama_cust'] :"") .'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Perusahaan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control"  name="perusahaan" id="perusahaan" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['nama_perusahaan'] :"") .'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
					        <input type="text" readonly="" class="form-control"  name="alamat" id="alamat" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['alamat'] :"") .'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kota</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" name="kota" id="kota" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['kota'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Telp</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" readonly="" name="notelp" id="notelp" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['no_telp'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. HP 1 </label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" readonly="" name="hp1" id="hp1" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['no_hp_1'] :"") .'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Email</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" readonly="" name="email" id="email" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['no_hp_2'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly="" name="longitude" id="longitude" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['longitude'] :"") .'">
					    </div>
					    <div class="col-xs-1">
						<label>Latitude</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" readonly=""  name="latitude" id="latitude" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['latitude'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Marketing</label>
                                            </div>
					    <div class="col-xs-6">
						<input type="hidden" readonly="" class="form-control" name="id_marketing_spk" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['id_marketing'] : "").'" >
						<input type="text" readonly="" class="form-control" name="nama_marketing_spk" value="'.(isset($_GET["id_survey"]) ? $row_mastersurvey['marketing'] : $loggedin["username"]).'">
						
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No. Tiang Terdekat</label>
                                            </div>
					    <div class="col-xs-4">
						<input type="text"  maxlength="10" class="form-control" name="no_tiang" value="">
					    </div>
                                        </div>
					</div>
                    
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>BTS Terdekat</label>
                                            </div>
					    <div class="col-xs-4">
                            <input type="text" readonly="" class="form-control" required="" name="nama_bts" value="" onclick="return valideopenerform(\'data_bts.php?r=myForm&f=jawabsurvey\',\'bts\');">
                            <input type="hidden" readonly="" class="form-control" required="" name="kode_bts" value="">
					    </div>
                                        </div>
					</div>
                    
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label></label>
                                            </div>
					    <div class="col-xs-4">
						 <input type="radio" name="tipe_koneksi" value="fo">Fiber Optic
                         <input type="radio" name="tipe_koneksi" value="wl">Wireless
					    </div>
                                        </div>
					</div>
                    
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket</label>
                                            </div>
					    <div class="col-xs-4">
                            <input type="text" readonly="" class="form-control" required="" name="nama_paket" value="" onclick="return valideopenerform(\'data_paket.php?r=myForm&f=jawabsurvey\',\'paket\');">
                            <input type="hidden" readonly="" class="form-control" required="" name="kode_paket" value="">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Prospek</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="checkbox" class="form-control" name="prospek" value="1">
					    </div>
					    <div class="col-xs-3">
						<label>pending</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="checkbox" class="form-control" name="pending" value="1">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Normal</label>
                                            </div>
					    <div class="col-xs-3">
						<input type="checkbox" class="form-control" name="normal" value="1">
					    </div>
					    <div class="col-xs-3">
						<label>Justifikasi</label>
                                            </div>
					    <div class="col-xs-3">
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
                            <label>Tanggal Pemasangan</label>
                        </div>
					    <div class="col-xs-4">
                            <input type="text" readonly="" class="form-control" required="" id="datepicker" name="tanggal_pemasangan" value="">
					    </div>
                                        </div>
					</div>
                    
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Upload Foto Lokasi</label>
                                            </div>
					    <div class="col-xs-9" id="im_container">
						<div id="filediv"></div>
						<br style="clear:both;">
						<input type="button" id="add_more" class="upload" value="Add More Files"/>
						
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
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../../admin/upload/jawab_spk_survey/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/jawab_spk_survey/';
	
	$sql_insert_jawabsurvey = "INSERT INTO `gx_jawab_spksurvey` (`id_jawab_spksurvey`, `no_jawab`, `no_spksurvey`,`nama`, `perusahaan`, `alamat`,
								     `kota`, `no_telp`, `no_hp_1`,`email`, `longitude`, `latitude`,
								     `no_tiang`, `marketing`, `check_prospek`, `check_normal`,
								     `check_pending`, `check_justifikasi`, `remarks`,
								     `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
							    VALUES  ('', '".$no_jawab."', '".$no_survey."', '".$nama."', '".$perusahaan."', '".$alamat."',
								     '".$kota."', '".$notelp."', '".$hp1."', '".$email."', '".$longitude."', '".$latitude."',
								     '".$no_tiang."', '".$marketing."', '".$prospek."', '".$normal."',
								     '".$pending."', '".$justifikasi."', '".$remarks."', 
								     NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
	//echo $sql_insert_jawabsurvey;
	mysql_query($sql_insert_jawabsurvey, $conn) or die ("<script language='JavaScript'>
							       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							       window.history.go(-1);
							   </script>");
	
	if(isset($_FILES['file'])){
		for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
			// Loop to get individual element from the array
			$validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
			$img_name = ($_FILES['file']['name'][$i]);
			
			$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
			$file_extension = end($ext); // Store extensions in the variable.
			//$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
			$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
			if (($_FILES["file"]["name"][$i] != "")) {
			if (($_FILES["file"]["size"][$i] < 5000000)     // Approx. 5Mb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path.$img_name)) {
			// If file moved to uploads folder.
				$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `id_jawab_spksurvey`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$last_data."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				
				mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				
				
			} else {     //  If File Was Not Moved.
			echo $j. ').<span id="error">please try again!.</span><br/><br/>';
			}
			} else {     //   If File Size And File Type Was Incorrect.
			echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
			}
			}
		}
	}
	
	if($justifikasi == 1)
	{
		echo "<script language='JavaScript'>
		alert('Data telah disimpan!');
		location.href = 'form_permohonan_justifikasi?t=n&id_survey=$no_survey';
	</script>";
	
	}
	else
	{
		echo "<script language='JavaScript'>
		alert('Data telah disimpan!');
		location.href = 'spk_survey.php';
	</script>";
	
	}
    
    }
$plugins = '<script language="javascript">
		var abc = 5;
		var max = 8; // Declaring and defining global increment variable.
		$(document).ready(function() {
			//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
			$(\'#add_more\').click(function() {
				if($(\'#im_container\').children(\'#filediv\').length<7){
					$(this).before($("<div/>", {
						id: \'filediv\'
					}).fadeIn(\'slow\').append($("<input/>", {
						name: \'file[]\',
						type: \'file\',
						id: \'file\'
					}), $("<br/><br/>")));
				}
			});
			// Following function will executes on change event of file input to select different file.
			$(\'body\').on(\'change\', \'#file\', function() {
				if (this.files && this.files[0]) {
					abc += 1; // Incrementing global variable by 1.
					var z = abc - 1;
					var x = $(this).parent().find(\'#previewimg\' + z).remove();
					$(this).before("<div id=\'abcd" + abc + "\' class=\'abcd\'><img id=\'previewimg" + abc + "\' src=\'\'/></div>");
					var reader = new FileReader();
					reader.onload = imageIsLoaded;
					reader.readAsDataURL(this.files[0]);
					$(this).hide();
					
					$("#abcd" + abc).append($("<img/>", {
						id: \'img\',
						src: \''.URL_ADMIN.'img/x.png\',
						alt: \'delete\'
					}).click(function() {
						$(this).parent().parent().remove();
					}));
				}
			});
			// To Preview Image
			function imageIsLoaded(e) {
				$(\'#previewimg\' + abc).attr(\'src\', e.target.result);
			};
			$(\'#upload\').click(function(e) {
				var name = $(":file").val();
				if (!name) {
					alert("First Image Must Be Selected");
					e.preventDefault();
				}
			});
		});
	    </script>
		<style>
#fileContainer, #append { border:1px solid black; width: 150px;}
#fileContainer {margin-top: 2px;}
#append { cursor:pointer;}
</style>
	    <style type="text/css">

		#img{
		width:25px;
		border:none;
		height:25px;
		margin-left:-20px;
		margin-bottom:91px
		}
		.abcd{
		
		
		}
		.abcd img{
		height:100px;
		width:100px;
		padding:5px;
		border:1px solid #e8debd
		}
	    </style>

        <!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>

    ';

    $title	= 'Form Jawab Survey';
    $submenu	= "spk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
	
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>