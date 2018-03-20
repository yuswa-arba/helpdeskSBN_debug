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
    if($loggedin["group"] == 'admin'){
        global $conn;
	
	
    if(isset($_POST["save"])){
	$sql_last_brosur  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_brosur` ORDER BY `id_brosur` DESC", $conn));
	$last_data  = $sql_last_brosur["id_brosur"] + 1;
	
	$kode_brosur     	= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	$id_brosur       	= isset($_POST['id_brosur']) ? mysql_real_escape_string(trim($_POST['id_brosur'])) : '';
	$nama_brosur		= isset($_POST['nama_brosur']) ? mysql_real_escape_string(trim($_POST['nama_brosur'])) : '';
	$upload				= isset($_POST['upload']) ? mysql_real_escape_string(trim($_POST['upload'])) : '';
	$jumlah_halaman 	= isset($_POST['jumlah_halaman']) ? mysql_real_escape_string(trim($_POST['jumlah_halaman'])) : '';
	$kode_cabang		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang		= isset($_POST['name_cabang']) ? mysql_real_escape_string(trim($_POST['name_cabang'])) : '';
	
	$eror       = false;
	$folder     = '../upload/brosur/';
	$lokasi	    = 'upload/brosur/';
	//type file yang bisa diupload
	$file_type  = array('jpg', 'png', 'jpeg');
	//tukuran maximum file yang dapat diupload
	$max_size   = 10000000; // 10MB
	//Mulai memorises data
	$file_name  = str_replace(' ', '', $_FILES['upload']['name']);
	$file_size  = $_FILES['upload']['size'];
	//cari extensi file dengan menggunakan fungsi explode
	$explode    = explode('.',$file_name);
	$extensi    = $explode[count($explode)-1];
     
	//check apakah type file sudah sesuai
	$pesan ='';
	if(!in_array($extensi,$file_type)){
	    $eror   = true;
	    $pesan .= '- Type file yang anda upload tidak sesuai.';
	}
	if($file_size > $max_size){
	    $eror   = true;
	    $pesan .= '- Ukuran file melebihi batas maximum.';
	}
	//check ukuran file apakah sudah sesuai

	if($eror == true){
	    echo "<script language='JavaScript'>
			    alert('".$pesan."');
			    window.close();
		  </script>";
	}else{
	    //mulai memproses upload file
	    if(move_uploaded_file($_FILES['upload']['tmp_name'], $folder.$file_name)){
		//catat nama file ke database
		
		$sql_insert_form = "INSERT INTO `gx_brosur` (`id_brosur`, `kode_brosur`, `nama_brosur`, `kode_cabang`, `nama_cabang`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
						       VALUES ('', '$kode_brosur', '$nama_brosur', '$kode_cabang', '$nama_cabang', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";
		//echo $sql_insert_form;
		mysql_query($sql_insert_form, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		
		
		
		$sql_insert_file = "INSERT INTO `gx_brosur_detail` (`id`, `id_brosur`, `nama_file`, `lokasi_file`, `user_add`, `date_add`, `level`)
				    VALUES ('', '$last_data', '$file_name', '$lokasi', '$loggedin[username]', NOW(), '0');";
		
		mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		
		echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'master_brosur.php';
		    </script>";
	
	    }else{
		 echo "<script language='JavaScript'>
				    alert('Proses upload eror');
				    window.close();
			  </script>";
	    }
	}
    
    }elseif(isset($_POST["update"])){
	
	$kode_brosur  = isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	$id_brosur    = isset($_POST['id_brosur']) ? mysql_real_escape_string(trim($_POST['id_brosur'])) : '';
	$nama_brosur	= isset($_POST['nama_brosur']) ? mysql_real_escape_string(trim($_POST['nama_brosur'])) : '';
	$jumlah_halaman = isset($_POST['jumlah_halaman']) ? mysql_real_escape_string(trim($_POST['jumlah_halaman'])) : '';
	$upload		= isset($_POST['upload']) ? mysql_real_escape_string(trim($_POST['upload'])) : '';
	    
	    $eror       = false;
	    $folder     = '../upload/brosur/';
	    $lokasi	= 'upload/brosur/';
	    //type file yang bisa diupload
	    $file_type  = array('jpg','png','jpeg');
	    //tukuran maximum file yang dapat diupload
	    $max_size   = 10000000; // 10MB
	    //Mulai memorises data
	    $file_name  = str_replace(' ', '', $_FILES['upload']['name']);
	    $file_size  = $_FILES['upload']['size'];
	    //cari extensi file dengan menggunakan fungsi explode
	    $explode    = explode('.',$file_name);
	    $extensi    = $explode[count($explode)-1];
	 
	    //check apakah type file sudah sesuai
	    $pesan ='';
	    if(!in_array($extensi,$file_type)){
		$eror   = true;
		$pesan .= '- Type file yang anda upload tidak sesuai.';
	    }
	    if($file_size > $max_size){
		$eror   = true;
		$pesan .= '- Ukuran file melebihi batas maximum.';
	    }
	    //check ukuran file apakah sudah sesuai
	
	    if($_FILES['upload']['size'] != 0){
	     
		if($eror == true){
		    echo "<script language='JavaScript'>
				    alert('".$pesan."');
				    window.history.go(-1);
			  </script>";
		}else{
		     if($_FILES['upload']['name'] != ""){
				//mulai memproses upload file
				if(move_uploaded_file($_FILES['upload']['tmp_name'], $folder.$file_name)){
					//catat nama file ke database
					
					$sql_edit_form = "UPDATE `gx_brosur` SET `kode_brosur` = '$kode_brosur', `nama_brosur` = '$nama_brosur', `date_upd` = NOW(), `user_upd` = '$loggedin[username]' WHERE `id_brosur`='$id_brosur'";
					
					mysql_query($sql_edit_form, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
											   </script>");
					
				 
					
					$sql_insert_file = "UPDATE `gx_brosur_detail` SET `nama_file` = '$file_name', `date_add` = NOW(), `user_add` = '$loggedin[username]' WHERE `id_brosur`='$id_brosur'";
				
					mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
										   </script>");
				
				//echo $sql_edit_form.'<br /><br />'.$sql_insert_file;
					echo "<script language='JavaScript'>
						alert('Data telah disimpan!');
						location.href = 'master_brosur.php';
					</script>";
				
				}else{
					echo "<script language='JavaScript'>
						alert('Proses upload eror');
						window.history.go(-1);
				  </script>";
				}
			}else{
				$sql_edit_form = "UPDATE `gx_brosur` SET `kode_brosur` = '$kode_brosur', `nama_brosur` = '$nama_brosur', `date_upd` = NOW(), `user_upd` = '$loggedin[username]' WHERE `id_brosur`='$id_brosur'";
					
				mysql_query($sql_edit_form, $conn) or die ("<script language='JavaScript'>
											   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
											   window.history.go(-1);
											   </script>");
				echo "<script language='JavaScript'>
						alert('Data telah disimpan!');
						location.href = 'master_brosur.php';
					</script>";
			}
		    
		    
		}
	    }else{
		$sql_edit_form = "UPDATE `gx_brosur` SET `kode_brosur` = '$kode_brosur', `nama_brosur` = '$nama_brosur', `date_upd` = NOW(), `user_upd` = '$loggedin[username]' WHERE `id_brosur`='$id_brosur'";
		    
		mysql_query($sql_edit_form, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'master_brosur.php';
		    </script>";
	    }
	
    }
    
    if(isset($_GET['id'])){
	$sql_masterbrosur = mysql_query("SELECT * FROM `gx_brosur` WHERE `level` = '0' AND id_brosur = '$_GET[id]';",$conn);
	$row_masterbrosur = mysql_fetch_array($sql_masterbrosur);
	$sql_masterbrosur_detail = mysql_query("SELECT * FROM `gx_brosur_detail` WHERE `level` = '0' AND `id_brosur` = '".$row_masterbrosur["id_brosur"]."' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
	$row_masterbrosur_detail = mysql_fetch_array($sql_masterbrosur_detail);
	$query_image	= "SELECT * FROM `gx_brosur_detail` WHERE `id_brosur`='".$row_masterbrosur["id_brosur"]."' ORDER BY `id` DESC LIMIT 0,1;";
    $sql_image	= mysql_query($query_image, $conn);
    $row_image	= mysql_fetch_array($sql_image);
    }
    $content ='<section class="content-header">
                    <h1>
                        Master Brosur
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Brosur</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="myForm" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					    <div class="form-group">
					    <div class="row">
						<div class="col-xs-3">
						    <label>Cabang</label>
						</div>
						<div class="col-xs-4">
						    <input type="text" readonly="" class="form-control" required="" name="name_cabang" value="'.(isset($_GET['id']) ? $row_masterbrosur['nama_cabang'] :"") .'"   onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=brosur\',\'cabang\');">
						    <input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_masterbrosur['kode_cabang'] :"") .'">
						</div>
						
					    </div>
					    </div>
						<div class="form-group">
						<div class="row">
						    <div class="col-xs-3">
							<label>Kode Brosur*</label>
						    </div>
						    <div class="col-xs-7">
							<input type="text" readonly="" class="form-control" required name="kode_brosur" value="'.(isset($_GET['id']) ? $row_masterbrosur["kode_brosur"] : "").'">
							<input type="hidden" name="id_brosur" value="'.(isset($_GET['id']) ? $row_masterbrosur["id_brosur"] : "").'">
						    </div>
						</div>
						</div>
						<div class="form-group">
						<div class="row">
						    <div class="col-xs-3">
							<label>Nama Brosur</label>
						    </div>
						    <div class="col-xs-7">
							<input type="text" class="form-control" required name="nama_brosur" value="'.(isset($_GET['id']) ? $row_masterbrosur["nama_brosur"] : "").'">
						    </div>
						</div>
						</div>
						<div class="form-group">
						<div class="row">
						    <div class="col-xs-3">
							<label>Upload File</label>
						    </div>
						    <div class="col-xs-7">
							<input type="hidden" name="brosur" value="'.(isset($_GET['id']) ? $row_image["id"] : "").'">
							'.(isset($_GET['id']) ? '<img id="preview" class="preview" src="'.URL_ADMIN.''.$row_image["lokasi_file"].''.$row_image["nama_file"].'" alt="Preview Image" width="200" /><br>' : "").'		
							<input type="file" name="upload" id="upload" />
						    </div>
						</div>
						</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_masterbrosur["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_masterbrosur["user_upd"]." ".$row_masterbrosur["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
						
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

    $title	= 'Form Brosur';
    $submenu	= "brosur";
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