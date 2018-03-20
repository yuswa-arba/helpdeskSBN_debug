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



if(isset($_GET["id"]))
{
    $id_konversi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_konversi		= "SELECT * FROM `gx_helpdesk_konversi` WHERE `id_konversi`='$id_konversi' LIMIT 0,1;";
    $sql_konversi		= mysql_query($query_konversi, $conn);
    $row_konversi		= mysql_fetch_array($sql_konversi);
   
}

    $content ='<section class="content-header">
                    <h1>
                        Form Konversi
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Konversi</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											';
										if(isset($_GET["id"])){
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_konversi["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_konversi["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_konversi["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=konversi\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_konversi["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_konversi["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Konversi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_konversi" name="kode_konversi" required="" value="'.(isset($_GET['id']) ? $row_konversi["kode_konversi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_konversi["kode_customer"] : "").'" onclick="return valideopenerform(\'data_customer.php?r=myForm&f=konversi\',\'customer\');" >
											</div>
										</div>
										</div> 
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_konversi["nama_customer"] : "").'">
											</div>
															
											<div class="col-xs-3">
												<label>UID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_konversi["uid"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Lama</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket_lama" value="'.(isset($_GET['id']) ? $row_konversi["kode_paket_lama"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_lama" value="'.(isset($_GET['id']) ? $row_konversi["nama_paket_lama"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Baru</label>
											</div>
											';
										if(isset($_GET["id"])){
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly="" name="kode_paket_baru" value="'.(isset($_GET['id']) ? $row_konversi["kode_paket_baru"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly="" name="kode_paket_baru" value="'.(isset($_GET['id']) ? $row_konversi["kode_paket_baru"] : "").'" onclick="return valideopenerform(\'data_paket.php?r=myForm&f=konversi\',\'paket\');">
														</div>';
										}
										$content .='
											
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_baru" value="'.(isset($_GET['id']) ? $row_konversi["nama_paket_baru"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
											<label>No Formulir</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="kode_formulir" value="'.(isset($_GET['id']) ? $row_konversi["kode_formulir"] : "").'" onclick="return valideopenerform(\'data_formulir.php?r=myForm&f=konversi\',\'formulir\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Foto Formulir</label>
											</div>
											<div class="col-xs-9">
												<div id="filediv" style="display:none;">
													<input name="file[]" type="file" id="file"/>
												</div>
												';
													if(isset($_GET["id"])){
														$sql_data		= mysql_query("SELECT * FROM `gx_upload` WHERE `level` =  '0' AND `kode_konversi` = '".$row_konversi["kode_konversi"]."'  ORDER BY `id` DESC;", $conn);
														while($row_data = mysql_fetch_array($sql_data)){
															$content .='<div class="abcd" style="float: left;"><img src="'.URL_ADMIN.''.$row_data["lokasi_file"].''.$row_data["nama_file"].'"></div>';
														}
													}
										   $content .='
												<br style="clear:both;">
												
												<input type="button" id="add_more" class="upload" value="Add More Files"/>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_konversi["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Lates Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_konversi["user_upd"]." ".$row_konversi["date_upd"] : "").'
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

if(isset($_POST["save"]))
{
	
    //echo "save";
    $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_konversi 			= isset($_POST['kode_konversi']) ? mysql_real_escape_string(trim($_POST['kode_konversi'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    
    $kode_paket_lama		= isset($_POST['kode_paket_lama']) ? mysql_real_escape_string(trim($_POST['kode_paket_lama'])) : '';
    $nama_paket_lama		= isset($_POST['nama_paket_lama']) ? mysql_real_escape_string(trim($_POST['nama_paket_lama'])) : '';
    $kode_paket_baru		= isset($_POST['kode_paket_baru']) ? mysql_real_escape_string(trim($_POST['kode_paket_baru'])) : '';
    $nama_paket_baru		= isset($_POST['nama_paket_baru']) ? mysql_real_escape_string(trim($_POST['nama_paket_baru'])) : '';
    
    $kode_formulir			= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/konversi/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/konversi/';
	
    
    $sql_insert = "INSERT INTO `gx_helpdesk_konversi` (`id_konversi`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_konversi`, `kode_customer`, `nama_customer`, `uid`, `kode_paket_lama`,
						  `nama_paket_lama`, `kode_paket_baru`, `nama_paket_baru`, `kode_formulir`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_konversi."', '".$kode_customer."', '".$nama_customer."', '".$uid."', '".$kode_paket_lama."',
						  '".$nama_paket_lama."', '".$kode_paket_baru."', '".$nama_paket_baru."', '".$kode_formulir."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	    // Loop to get individual element from the array
	    $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
	    $img_name = ($_FILES['file']['name'][$i]);
	    
	    $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
	    $file_extension = end($ext); // Store extensions in the variable.
	    //$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
	    $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
		/*if (($_FILES["file"]["size"][$i] < 2000000)     // Approx. 2Mb files can be uploaded.
	    && in_array($file_extension, $validextensions)) {*/
	    if (($_FILES["file"]["size"][$i] < 5000000)     // Approx. 5Mb files can be uploaded.
	    && in_array($file_extension, $validextensions)) {
			
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path.$img_name)) {
			// If file moved to uploads folder.
				$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				
				mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				
				
				
				
			} else {     //  If File Was Not Moved.
			echo "<script language='JavaScript'>
										   alert('File Was Not Moved.');
										   window.history.go(-1);
										   </script>";
			}	
	    } else {     //   If File Size And File Type Was Incorrect.
		echo "";
	    }
	}
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."help_desk/master_konversi.php';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    
    //echo "save";
    $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_konversi 			= isset($_POST['kode_konversi']) ? mysql_real_escape_string(trim($_POST['kode_konversi'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    
    $kode_paket_lama		= isset($_POST['kode_paket_lama']) ? mysql_real_escape_string(trim($_POST['kode_paket_lama'])) : '';
    $nama_paket_lama		= isset($_POST['nama_paket_lama']) ? mysql_real_escape_string(trim($_POST['nama_paket_lama'])) : '';
    $kode_paket_baru		= isset($_POST['kode_paket_baru']) ? mysql_real_escape_string(trim($_POST['kode_paket_baru'])) : '';
    $nama_paket_baru		= isset($_POST['nama_paket_baru']) ? mysql_real_escape_string(trim($_POST['nama_paket_baru'])) : '';
    
    $kode_formulir			= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/upgrade_downgrade/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/upgrade_downgrade/';
    
    $sql_update = "UPDATE `gx_helpdesk_konversi` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_konversi` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	
	$sql_insert_update = "INSERT INTO `gx_helpdesk_konversi` (`id_konversi`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_konversi`, `kode_customer`, `nama_customer`, `uid`, `kode_paket_lama`,
						  `nama_paket_lama`, `kode_paket_baru`, `nama_paket_baru`, `kode_formulir`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_konversi."', '".$kode_customer."', '".$nama_customer."', '".$uid."', '".$kode_paket_lama."',
						  '".$nama_paket_lama."', '".$kode_paket_baru."', '".$nama_paket_baru."', '".$kode_formulir."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                 
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	    // Loop to get individual element from the array
	    $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
	    $img_name = ($_FILES['file']['name'][$i]);
	    
	    $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
	    $file_extension = end($ext); // Store extensions in the variable.
	    //$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
	    $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
		/*if (($_FILES["file"]["size"][$i] < 2000000)     // Approx. 2Mb files can be uploaded.
	    && in_array($file_extension, $validextensions)) {*/
	    if (($_FILES["file"]["size"][$i] < 5000000)     // Approx. 5Mb files can be uploaded.
	    && in_array($file_extension, $validextensions)) {
			
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path.$img_name)) {
			// If file moved to uploads folder.
				$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				
				mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				
				
				
				
			} else {     //  If File Was Not Moved.
			echo "<script language='JavaScript'>
										   alert('File Was Not Moved.');
										   window.history.go(-1);
										   </script>";
			}	
	    } else {     //   If File Size And File Type Was Incorrect.
		echo "";
	    }
	}
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."help_desk/master_konversi.php';
			</script>";
			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		
		<script language="javascript">
			var abc = 0;      // Declaring and defining global increment variable.
			$(document).ready(function() {
			//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
				$(\'#add_more\').click(function() {
					$(this).before($("<div/>", {
						id: \'filediv\'
					}).fadeIn(\'slow\').append($("<input/>", {
						name: \'file[]\',
						type: \'file\',
						id: \'file\'
					}), $("")));
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
	    <style type="text/css">

		#img{
		width:25px;
		border:none;
		height:25px;
		margin-left:-20px;
		margin-bottom:91px
		}
		.abcd{
		width: 120px;
		float:left;
		}
		.abcd img{
		height:100px;
		width:100px;
		padding:5px;
		border:1px solid #e8debd
		}
	    </style>';

    $title	= 'Form Konversi';
    $submenu	= "konversi";
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