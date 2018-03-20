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
	$sql_last_formulir  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_formulir` ORDER BY `id_formulir` DESC", $conn));
	$last_data  = $sql_last_formulir["id_formulir"] + 1;
	
	$kode_formulir     	= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
	$id_formulir       	= isset($_POST['id_formulir']) ? mysql_real_escape_string(trim($_POST['id_formulir'])) : '';
	$nama_formulir	= isset($_POST['nama_formulir']) ? mysql_real_escape_string(trim($_POST['nama_formulir'])) : '';
	$upload		= isset($_POST['upload']) ? mysql_real_escape_string(trim($_POST['upload'])) : '';
	
	$eror       = false;
	$folder     = '../upload/formulir/';
	$lokasi	    = 'upload/formulir/';
	//type file yang bisa diupload
	$file_type  = array('doc','docx','xls','xlsx','pdf');
	//tukuran maximum file yang dapat diupload
	$max_size   = 10000000; // 10MB
	//Mulai memorises data
	$file_name  = $_FILES['upload']['name'];
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
		
		$sql_insert_form = "INSERT INTO `gx_formulir` (`id_formulir`, `kode_formulir`, `nama_formulir`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
						       VALUES ('', '$kode_formulir', '$nama_formulir', NOW(), NOW(), '$loggedin[username]', '$loggedin[username]', '0');";
		
		mysql_query($sql_insert_form, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		
		
		
		$sql_insert_file = "INSERT INTO `gx_formulir_detail` (`id`, `id_formulir`, `nama_file`, `lokasi_file` , `printed`,`user_add`, `date_add`, `level`)
				    VALUES ('', '$last_data', '$file_name', '$lokasi', '', '$loggedin[username]', NOW(), '0');";
		
		mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		
		echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'm_formulir.php';
		    </script>";
	
	    }else{
		 echo "<script language='JavaScript'>
				    alert('Proses upload eror');
				    window.close();
			  </script>";
	    }
	}
    
    }elseif(isset($_POST["update"])){
	
	$kode_formulir  = isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
	$id_formulir    = isset($_POST['id_formulir']) ? mysql_real_escape_string(trim($_POST['id_formulir'])) : '';
	$nama_formulir	= isset($_POST['nama_formulir']) ? mysql_real_escape_string(trim($_POST['nama_formulir'])) : '';
	$upload		= isset($_POST['upload']) ? mysql_real_escape_string(trim($_POST['upload'])) : '';
	    
	    $eror       = false;
	    $folder     = '../upload/formulir/';
	    $lokasi	= 'upload/formulir/';
	    //type file yang bisa diupload
	    $file_type  = array('doc','docx','xls','xlsx','pdf');
	    //tukuran maximum file yang dapat diupload
	    $max_size   = 10000000; // 10MB
	    //Mulai memorises data
	    $file_name  = $_FILES['upload']['name'];
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
				    window.close();
			  </script>";
		}else{
		    
		    //mulai memproses upload file
			if(move_uploaded_file($_FILES['upload']['tmp_name'], $folder.$file_name)){
			    //catat nama file ke database
			    
			    $sql_edit_form = "UPDATE `gx_formulir` SET `kode_formulir` = '$kode_formulir', `nama_formulir` = '$nama_formulir', `date_upd` = NOW(), `user_upd` = '$loggedin[username]' WHERE `id_formulir`='$id_formulir'";
			    
			    mysql_query($sql_edit_form, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
									       </script>");
			    
			    
			    
			    $sql_insert_file = "INSERT INTO `gx_formulir_detail` (`id`, `id_formulir`, `nama_file`, `lokasi_file` , `printed`,`user_add`, `date_add`, `level`)
					    VALUES ('', '$id_formulir', '$file_name', '$lokasi', '', '$loggedin[username]', NOW(), '0');";
			
			    mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
									       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
									       window.history.go(-1);
									   </script>");
			//echo $sql_edit_form.'<br /><br />'.$sql_insert_file;
			    echo "<script language='JavaScript'>
					alert('Data telah disimpan!');
					location.href = 'm_formulir.php';
				</script>";
		    
			}else{
			    echo "<script language='JavaScript'>
				    alert('Proses upload eror');
				    window.close();
			  </script>";
			}
		    
		}
	    }else{
		$sql_edit_form = "UPDATE `gx_formulir` SET `kode_formulir` = '$kode_formulir', `nama_formulir` = '$nama_formulir', `date_upd` = NOW(), `user_upd` = '$loggedin[username]' WHERE `id_formulir`='$id_formulir'";
		    
		mysql_query($sql_edit_form, $conn) or die ("<script language='JavaScript'>
								       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
								       window.history.go(-1);
								   </script>");
		echo "<script language='JavaScript'>
			    alert('Data telah disimpan!');
			    location.href = 'm_formulir.php';
		    </script>";
	    }
	
    }
    
    if(isset($_GET['id'])){
	$sql_masterformulir = mysql_query("SELECT * FROM `gx_formulir` WHERE `level` = '0' AND id_formulir = '$_GET[id]';",$conn);
	$row_masterformulir = mysql_fetch_array($sql_masterformulir);
    
    }
    $content ='<section class="content-header">
                    <h1>
                        Master Formulir
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Formulir</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="nav-tabs-custom">
					    <div class="tab-pane">
						<div class="form-group">
						<div class="row">
						    <div class="col-xs-4">
							<label>Kode Formulir*</label>
						    </div>
						    <div class="col-xs-8">
							<input type="text" class="form-control" required name="kode_formulir" value="'.(isset($_GET['id']) ? $row_masterformulir["kode_formulir"] : "").'">
							<input type="hidden" name="id_formulir" value="'.(isset($_GET['id']) ? $row_masterformulir["id_formulir"] : "").'">
						    </div>
						</div>
						</div>
						<div class="form-group">
						<div class="row">
						    <div class="col-xs-4">
							<label>Nama Formulir</label>
						    </div>
						    <div class="col-xs-8">
							<input type="text" class="form-control" required name="nama_formulir" value="'.(isset($_GET['id']) ? $row_masterformulir["nama_formulir"] : "").'">
						    </div>
						</div>
						</div>
						<div class="form-group">
						<div class="row">
						    <div class="col-xs-4">
							<label>Upload File</label>
						    </div>
						    <div class="col-xs-8">
							<input type="file" required name="upload" id="upload" />
						    </div>
						</div>
						</div>
						
						
					    </div><!-- /.tab-pane -->
                                
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

$plugins = '';

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