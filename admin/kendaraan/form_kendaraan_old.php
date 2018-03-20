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
     
//SQL 
$table_main = "gx_kendaraan_master";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1


//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
    $url_redirect_insert = "master_kendaraan";
    
//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    $redirect_update_data = "master_kendaraan";
    
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Form Kendaraan";
    $header_form = isset($_GET['c']) ? 'Form Edit' : 'Form Add';
    $index_field_sql = "id";
    $unix_field_sql = "kode_kendaraan";
    $url_form_detail = "detail_kendaraan";
    $url_form_edit = "form_kendaraan";
    
    $form_name = "form_kendaraan";
    $form_id = "";
    
    //id web
    $title_header = 'Master Kendaraan';
    $submenu_header = 'master_kendaraan';
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_kendaraan				= isset($_POST['kode_kendaraan']) ? mysql_real_escape_string(trim($_POST['kode_kendaraan'])) : '';
    
    
    if($kode_kendaraan != ""){
	
    $kode_kendaraan				= isset($_POST['kode_kendaraan']) ? mysql_real_escape_string(trim($_POST['kode_kendaraan'])) : '';
    $kode_cabang				= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $cabang					= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
    $tanggal					= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $no_kendaraan				= isset($_POST['no_kendaraan']) ? mysql_real_escape_string(trim($_POST['no_kendaraan'])) : '';
    $nopol_kendaraan				= isset($_POST['nopol_kendaraan']) ? mysql_real_escape_string(trim($_POST['nopol_kendaraan'])) : '';
    $nama_kendaraan				= isset($_POST['nama_kendaraan']) ? mysql_real_escape_string(trim($_POST['nama_kendaraan'])) : '';
    $warna					= isset($_POST['warna']) ? mysql_real_escape_string(trim($_POST['warna'])) : '';
    $merk					= isset($_POST['merk']) ? mysql_real_escape_string(trim($_POST['merk'])) : '';
    $jenis_kendaraan				= isset($_POST['jenis_kendaraan']) ? mysql_real_escape_string(trim($_POST['jenis_kendaraan'])) : '';
    $tahun_kendaraan				= isset($_POST['tahun_kendaraan']) ? mysql_real_escape_string(trim($_POST['tahun_kendaraan'])) : '';
    $kode_gps					= isset($_POST['kode_gps']) ? mysql_real_escape_string(trim($_POST['kode_gps'])) : '';
    $no_bpkb					= isset($_POST['no_bpkb']) ? mysql_real_escape_string(trim($_POST['no_bpkb'])) : '';
    $upload_bpkb				= isset($_POST['upload_bpkb']) ? mysql_real_escape_string(trim($_POST['upload_bpkb'])) : '';
    $stnk					= isset($_POST['stnk']) ? mysql_real_escape_string(trim($_POST['stnk'])) : '';
    $upload_stnk				= isset($_POST['upload_stnk']) ? mysql_real_escape_string(trim($_POST['upload_stnk'])) : '';
    $tanggal_jt_stnk				= isset($_POST['tanggal_jt_stnk']) ? mysql_real_escape_string(trim($_POST['tanggal_jt_stnk'])) : '';
    $pajak_kendaraan				= isset($_POST['pajak_kendaraan']) ? mysql_real_escape_string(trim($_POST['pajak_kendaraan'])) : '';
    $tanggal_perpanjangan_stnk			= isset($_POST['tanggal_perpanjangan_stnk']) ? mysql_real_escape_string(trim($_POST['tanggal_perpanjangan_stnk'])) : '';
    $kir					= isset($_POST['kir']) ? mysql_real_escape_string(trim($_POST['kir'])) : '';
    $upload_kir					= isset($_POST['upload_kir']) ? mysql_real_escape_string(trim($_POST['upload_kir'])) : '';
    $tanggal_kir				= isset($_POST['tanggal_kir']) ? mysql_real_escape_string(trim($_POST['tanggal_kir'])) : '';
    $kode_asuransi				= isset($_POST['kode_asuransi']) ? mysql_real_escape_string(trim($_POST['kode_asuransi'])) : '';
    $nama_asuransi				= isset($_POST['nama_asuransi']) ? mysql_real_escape_string(trim($_POST['nama_asuransi'])) : '';
    $nominal_asuransi				= isset($_POST['nominal_asuransi']) ? mysql_real_escape_string(trim($_POST['nominal_asuransi'])) : '';
    $upload_asuransi				= isset($_POST['upload_asuransi']) ? mysql_real_escape_string(trim($_POST['upload_asuransi'])) : '';
    $tanggal_jt_asuransi			= isset($_POST['tanggal_jt_asuransi']) ? mysql_real_escape_string(trim($_POST['tanggal_jt_asuransi'])) : '';
    $penanggung_jawab				= isset($_POST['penanggung_jawab']) ? mysql_real_escape_string(trim($_POST['penanggung_jawab'])) : '';
    $setting_reminder				= isset($_POST['setting_reminder']) ? mysql_real_escape_string(trim($_POST['setting_reminder'])) : '';
    
    
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
    /*
    $sql_insert = "INSERT INTO `gx_kendaraan_asuransi`(`id`, `kode_asuransi`, `nama_asuransi`, `alamat`, `kota`, `no_telp`, `contact_person`, `Email`, `no_hp`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'".$kode_asuransi."','".$nama_asuransi."','".$alamat."','".$kota."','".$no_telp."','".$contact_person."','".$email."','".$no_hp."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    */
    
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/kendaraan/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/kendaraan/';
	
    
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
				/*$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				*/
				
				$sql_insert_file = "INSERT INTO `gx_inactive_customer_image_email`(`id`, `tanggal`, `kode_inactive`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,NOW(),'".$kode_inactive."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
				
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
    
    
    
    $sql_insert = "INSERT INTO `gx_kendaraan_master`(`id`, `kode_kendaraan`, `kode_cabang`, `cabang`, `tanggal`, `no_kendaraan`, `nopol_kendaraan`, `nama_kendaraan`, `warna`, `merk`, `jenis_kendaraan`, `tahun_kendaraan`, `kode_gps`, `no_bpkb`, `upload_bpkb`, `stnk`, `upload_stnk`, `tanggal_jt_stnk`, `pajak_kendaraan`, `tanggal_perpanjangan_stnk`, `kir`, `upload_kir`, `tanggal_kir`, `kode_asuransi`, `nama_asuransi`, `nominal_asuransi`, `upload_asuransi`, `tanggal_jt_asuransi`, `penanggung_jawab`, `setting_rerminder`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'".$kode_kendaraan."','".$kode_cabang."','".$cabang."','".$tanggal."','".$no_kendaraan."','".$nopol_kendaraan."','".$nama_kendaraan."','".$warna."','".$merk."','".$jenis_kendaraan."','".$tahun_kendaraan."','".$kode_gps."','".$no_bpkb."','".$upload_bpkb."','".$stnk."','".$upload_stnk."','".$tanggal_jt_stnk."','".$pajak_kendaraan."','".$tanggal_perpanjangan_stnk."','".$kir."','".$upload_kir."','".$tanggal_kir."','".$kode_asuransi."','".$nama_asuransi."','".$nominal_asuransi."','".$upload_asuransi."','".$tanggal_jt_asuransi."','".$penanggung_jawab."','".$setting_reminder."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='".$url_redirect_insert."';
	    </script>";
	    
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"])){
    
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $id 				= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 					= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
    $kode_kendaraan				= isset($_POST['kode_kendaraan']) ? mysql_real_escape_string(trim($_POST['kode_kendaraan'])) : '';
    $kode_cabang				= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $cabang					= isset($_POST['cabang']) ? mysql_real_escape_string(trim($_POST['cabang'])) : '';
    $tanggal					= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $no_kendaraan				= isset($_POST['no_kendaraan']) ? mysql_real_escape_string(trim($_POST['no_kendaraan'])) : '';
    $nopol_kendaraan				= isset($_POST['nopol_kendaraan']) ? mysql_real_escape_string(trim($_POST['nopol_kendaraan'])) : '';
    $nama_kendaraan				= isset($_POST['nama_kendaraan']) ? mysql_real_escape_string(trim($_POST['nama_kendaraan'])) : '';
    $warna					= isset($_POST['warna']) ? mysql_real_escape_string(trim($_POST['warna'])) : '';
    $merk					= isset($_POST['merk']) ? mysql_real_escape_string(trim($_POST['merk'])) : '';
    $jenis_kendaraan				= isset($_POST['jenis_kendaraan']) ? mysql_real_escape_string(trim($_POST['jenis_kendaraan'])) : '';
    $tahun_kendaraan				= isset($_POST['tahun_kendaraan']) ? mysql_real_escape_string(trim($_POST['tahun_kendaraan'])) : '';
    $kode_gps					= isset($_POST['kode_gps']) ? mysql_real_escape_string(trim($_POST['kode_gps'])) : '';
    $no_bpkb					= isset($_POST['no_bpkb']) ? mysql_real_escape_string(trim($_POST['no_bpkb'])) : '';
    $upload_bpkb				= isset($_POST['upload_bpkb']) ? mysql_real_escape_string(trim($_POST['upload_bpkb'])) : '';
    $stnk					= isset($_POST['stnk']) ? mysql_real_escape_string(trim($_POST['stnk'])) : '';
    $upload_stnk				= isset($_POST['upload_stnk']) ? mysql_real_escape_string(trim($_POST['upload_stnk'])) : '';
    $tanggal_jt_stnk				= isset($_POST['tanggal_jt_stnk']) ? mysql_real_escape_string(trim($_POST['tanggal_jt_stnk'])) : '';
    $pajak_kendaraan				= isset($_POST['pajak_kendaraan']) ? mysql_real_escape_string(trim($_POST['pajak_kendaraan'])) : '';
    $tanggal_perpanjangan_stnk			= isset($_POST['tanggal_perpanjangan_stnk']) ? mysql_real_escape_string(trim($_POST['tanggal_perpanjangan_stnk'])) : '';
    $kir					= isset($_POST['kir']) ? mysql_real_escape_string(trim($_POST['kir'])) : '';
    $upload_kir					= isset($_POST['upload_kir']) ? mysql_real_escape_string(trim($_POST['upload_kir'])) : '';
    $tanggal_kir				= isset($_POST['tanggal_kir']) ? mysql_real_escape_string(trim($_POST['tanggal_kir'])) : '';
    $kode_asuransi				= isset($_POST['kode_asuransi']) ? mysql_real_escape_string(trim($_POST['kode_asuransi'])) : '';
    $nama_asuransi				= isset($_POST['nama_asuransi']) ? mysql_real_escape_string(trim($_POST['nama_asuransi'])) : '';
    $nominal_asuransi				= isset($_POST['nominal_asuransi']) ? mysql_real_escape_string(trim($_POST['nominal_asuransi'])) : '';
    $upload_asuransi				= isset($_POST['upload_asuransi']) ? mysql_real_escape_string(trim($_POST['upload_asuransi'])) : '';
    $tanggal_jt_asuransi			= isset($_POST['tanggal_jt_asuransi']) ? mysql_real_escape_string(trim($_POST['tanggal_jt_asuransi'])) : '';
    $penanggung_jawab				= isset($_POST['penanggung_jawab']) ? mysql_real_escape_string(trim($_POST['penanggung_jawab'])) : '';
    $setting_reminder				= isset($_POST['setting_reminder']) ? mysql_real_escape_string(trim($_POST['setting_reminder'])) : '';
    
    if($c != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	
	$sql_update = "UPDATE `gx_kendaraan_master` SET `user_upd`='".$loggedin['username']."',`date_upd`=NOW(), `level`='1' WHERE `kode_kendaraan`='".$c."'";
	
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
		    
	//insert into cc_subscription_service
	//'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
	/*$sql_insert = "INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'$kode_kontrak','$kode_cabang','$nama_cabang','$kode_customer','$nama_customer','$lama_kontrak','$periode_kontrak_mulai','$periode_kontrak_akhir','$tanggal','0','".$loggedin["username"]."','".$loggedin["username"]."', '0', NOW(), NOW())";
	*/
    
	$sql_insert = "INSERT INTO `gx_kendaraan_master`(`id`, `kode_kendaraan`, `kode_cabang`, `cabang`, `tanggal`, `no_kendaraan`, `nopol_kendaraan`, `nama_kendaraan`, `warna`, `merk`, `jenis_kendaraan`, `tahun_kendaraan`, `kode_gps`, `no_bpkb`, `upload_bpkb`, `stnk`, `upload_stnk`, `tanggal_jt_stnk`, `pajak_kendaraan`, `tanggal_perpanjangan_stnk`, `kir`, `upload_kir`, `tanggal_kir`, `kode_asuransi`, `nama_asuransi`, `nominal_asuransi`, `upload_asuransi`, `tanggal_jt_asuransi`, `penanggung_jawab`, `setting_rerminder`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'".$kode_kendaraan."','".$kode_cabang."','".$cabang."','".$tanggal."','".$no_kendaraan."','".$nopol_kendaraan."','".$nama_kendaraan."','".$warna."','".$merk."','".$jenis_kendaraan."','".$tahun_kendaraan."','".$kode_gps."','".$no_bpkb."','".$upload_bpkb."','".$stnk."','".$upload_stnk."','".$tanggal_jt_stnk."','".$pajak_kendaraan."','".$tanggal_perpanjangan_stnk."','".$kir."','".$upload_kir."','".$tanggal_kir."','".$kode_asuransi."','".$nama_asuransi."','".$nominal_asuransi."','".$upload_asuransi."','".$tanggal_jt_asuransi."','".$penanggung_jawab."','".$setting_reminder."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
	
	//echo $sql_insert."<br>";
    
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							       alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							       window.history.go(-1);
							   </script>");
	
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/kendaraan/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/kendaraan/';
	
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
				/*$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				*/
				
				
				$sql_insert_file = "INSERT INTO `gx_inactive_customer_image_email`(`id`, `tanggal`, `kode_inactive`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,NOW(),'".$c."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
				
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
	
    
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
 
    
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='".$redirect_update_data."';
	    </script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["c"]))
{
    $id		= isset($_GET['id']) ? $_GET['id'] : '';
    $c		= isset($_GET['c']) ? $_GET['c'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query 	= "SELECT * FROM `".$table_main."` WHERE `".$unix_field_sql."`='".$c."' AND `level`='0' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);

}

    $content = '<section class="content-header">
                    <h1>
                        '.$judul_form.'
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">'.$header_form.'</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data">
				        <div class="box-body">
				    
				    
                                        <div class="form-group">
					<div class="row">';
				    $content .=' <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="cabang" value="'.(isset($_GET['c']) ? $row["cabang"] : '' ).'" onclick="return valideopenerform(\'data_cabang.php?r=form_kendaraan&f=data_cabang\',\'cabang\');">
						<input type="hidden" name="kode_cabang">
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" id="datepicker" readonly  class="form-control" required="" name="tanggal" value="'.(isset($_GET['c']) ? $row["tanggal"] : date("Y-m-d")).'">
					    </div>
					   
					     </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>No Kendaraan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="no_kendaraan" value="'.(isset($_GET['c']) ? $row["no_kendaraan"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Nopol Kendaraan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="nopol_kendaraan" value="'.(isset($_GET['c']) ? $row["nopol_kendaraan"] : '').'">
					    </div>
					    
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    

					    <div class="col-xs-2">
						<label>Nama Kendaraaan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="nama_kendaraan" id="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_kendaraan"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Warna</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="warna" value="'.(isset($_GET['c']) ? $row["warna"] : '').'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					
					    <div class="col-xs-2">
						<label>Merk</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="merk" value="'.(isset($_GET['c']) ? $row["merk"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<label>Jenis Kendaraan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="jenis_kendaraan" value="'.(isset($_GET['c']) ? $row["jenis_kendaraan"] : '').'"  >
					    </div>
					
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Tahun Kendaraan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="tahun_kendaraan" value="'.(isset($_GET['c']) ? $row["tahun_kendaraan"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<label>Kode GPS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="kode_gps" value="'.(isset($_GET['c']) ? $row["kode_gps"] : '').'"  >
					    </div>
					
					</div>
					</div>

					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>No BPKB</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="no_bpkb" value="'.(isset($_GET['c']) ? $row["no_bpkb"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<input type="file" class="form-control"  required="" name="upload_bpkb" value="">
					    </div>
					
					</div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>STNK</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="stnk" value="'.(isset($_GET['c']) ? $row["stnk"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<input type="file" class="form-control"  required="" name="upload_stnk" value="">
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal JT STNK</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" id="datepicker_jt_stnk" readonly="" class="form-control" required="" name="tanggal_jt_stnk" value="'.(isset($_GET['c']) ? $row["tanggal_jt_stnk"] : '').'">
					    </div>
					   
					</div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Pajak Kendaraan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="stnk" value="'.(isset($_GET['c']) ? $row["stnk"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal Perpanjangan STNK</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" id="datepicker_perpanjangan_stnk" readonly="" class="form-control" required="" name="tanggal_perpanjangan_stnk" value="'.(isset($_GET['c']) ? $row["tanggal_perpanjangan_stnk"] : '').'">
					    </div>
					   
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>KIR</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="kir" value="'.(isset($_GET['c']) ? $row["kir"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<input type="file" class="form-control"  required="" name="upload_kir" value="">
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal KIR</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" id="datepicker_kir" class="form-control" required="" name="tanggal_kir" value="'.(isset($_GET['c']) ? $row["tanggal_perpanjangan_stnk"] : '').'">
					    </div>
					   
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Kode Asuransi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="kode_asuransi" value="'.(isset($_GET['c']) ? $row["kode_asuransi"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<label>Nama Asuransi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="nama_asuransi" value="'.(isset($_GET['c']) ? $row["nama_asuransi"] : '').'"  >
					    </div>
					
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Nominal Asuransi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="nominal_asuransi" value="'.(isset($_GET['c']) ? $row["nominal_asuransi"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<input type="file" class="form-control"  required="" name="upload_asuransi" value=""  >
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal JT Asuransi</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="datepicker_jt_asuransi"  required="" name="tanggal_jt_asuransi" value="'.(isset($_GET['c']) ? $row["tanggal_jt_asuransi"] : '').'"  >
					    </div>    
					
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>Penanggung Jawab</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="penanggung_jawab" value="'.(isset($_GET['c']) ? $row["penanggung_jawab"] : '').'">
					    </div>
					   
					    <div class="col-xs-2">
						<label>Setting Reminder</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control"  required="" name="" value="'.(isset($_GET['c']) ? $row["setting_reminder"] : '').'"  >
					    </div>
					    <div class="col-xs-2">
						<label>Bulan</label>
					    </div>
					
					</div>
					</div>
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['c']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
		 
                $("#datepicker_jt_stnk").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker_perpanjangan_stnk").datepicker({format: "yyyy-mm-dd"});
		$("#datepicker_kir").datepicker({format: "yyyy-mm-dd"});
		$("#datepicker_jt_asuransi").datepicker({format: "yyyy-mm-dd"});
		            
	    });
        </script>';

    $title	= $title_header;
    $submenu	= $submenu_header;
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