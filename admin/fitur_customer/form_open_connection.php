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
$table_main = "gx_open_connection";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "master_open_connection";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "master_open_connection";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Open Connection";
    $header_form = "Data Open Connection";
    $index_field_sql = "id";
    $unix_field_sql = "kode_open_connection";
    $url_form_detail = "detail_open_connection";
    $url_form_edit = "form_open_connection";
    
    $form_name = "form_open_connection";
    $form_id = "";
    
    //id web
    $title_header = 'Master Open Connection';
    $submenu_header = 'master open connection';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    /*
      SELECT `id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_off_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_open_connection` WHERE 1
     */
    
    
    
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_open_connection				= isset($_POST['kode_open_connection']) ? mysql_real_escape_string(trim($_POST['kode_open_connection'])) : '';
    $kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $user_id						= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $no_inactive					= isset($_POST['no_inactive']) ? mysql_real_escape_string(trim($_POST['no_inactive'])) : '';
    $no_off_connection					= isset($_POST['no_off_connection']) ? mysql_real_escape_string(trim($_POST['no_off_connection'])) : '';
    
    $remarks						= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    $kode_cso						= isset($_POST['kode_cso']) ? mysql_real_escape_string(trim($_POST['kode_cso'])) : '';
    $request						= isset($_POST['request']) ? mysql_real_escape_string(trim($_POST['request'])) : '';
    $foto_email						= isset($_POST['foto_email']) ? mysql_real_escape_string(trim($_POST['foto_email'])) : '';
    $no_formulir					= isset($_POST['no_formulir']) ? mysql_real_escape_string(trim($_POST['no_formulir'])) : '';
    
    
	
    if($kode_open_connection != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
  
  // 
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/email/';
	
    
    /*
     $sql_insert = "INSERT INTO `gx` (`id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_open_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$kode_cabang."', '".$nama_cabang."', NOW(), '".$kode_open_connection."', '".$kode_customer."', '".$nama_customer."', '".$user_id."', '".$no_inactive."', '".$status_inactive."', '".$remarks."', '".$kode_cso."', '".$request."', '".$foto_email."', '".$no_formulir."', '0', NOW(), NOW(), '0', '".$loggedin['username']."', '".$loggedin['username']."')";
    
     */
    
    $sql_insert = "INSERT INTO `gx_open_connection`(`id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_open_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `no_off_connection`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'".$kode_cabang."','".$nama_cabang."','".$tanggal."','".$kode_open_connection."','".$kode_customer."','".$nama_customer."','".$user_id."','".$no_inactive."','0','".$no_off_connection."','".$remarks."','".$kode_cso."','".$request."','-','".$no_formulir."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
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
				/*$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				*/
				
				$sql_insert_file = "INSERT INTO `gx_open_connection_image_email`(`id`, `tanggal`, `kode_open_connection`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,NOW(),'".$kode_open_connection."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
				
				mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data gambar tidak bisa diinsert ke dalam Database, Ada kesalahan!');
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
	window.location.href='".$url_redirect_insert."';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    $id 						= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 							= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_open_connection				= isset($_POST['kode_open_connecion']) ? mysql_real_escape_string(trim($_POST['kode_open_connection'])) : '';
    $no_off_connection					= isset($_POST['no_off_connecion']) ? mysql_real_escape_string(trim($_POST['no_off_connection'])) : '';$kode_customer					= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer					= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $user_id						= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $no_inactive					= isset($_POST['no_inactive']) ? mysql_real_escape_string(trim($_POST['no_inactive'])) : '';
    $status_inactive					= isset($_POST['status_inactive']) ? mysql_real_escape_string(trim($_POST['status_inactive'])) : '';
    $remarks						= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
    $kode_cso						= isset($_POST['kode_cso']) ? mysql_real_escape_string(trim($_POST['kode_cso'])) : '';
    $request						= isset($_POST['request']) ? mysql_real_escape_string(trim($_POST['request'])) : '';
    $foto_email						= isset($_POST['foto_email']) ? mysql_real_escape_string(trim($_POST['foto_email'])) : '';
    $no_formulir					= isset($_POST['no_formulir']) ? mysql_real_escape_string(trim($_POST['no_formulir'])) : '';
    
    
    if($c != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_open_connection` WHERE `kode_open_connection`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/email/';
	
	/*
	$sql_update = "UPDATE `gx_reaktivasi_customer_image_email` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_reaktivasi`='".$c."'";
	$sql_insert = "INSERT INTO `gx_reaktivasi_customer_image_email`(`id`, `tanggal`, `kode_reaktivasi`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,NOW(),'".$c."','-','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	*/
	
	$sql_update = "UPDATE `gx_open_connection` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_open_connection`='".$c."'";
	$sql_update_file = "UPDATE `gx_open_connection_image_email` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE `kode_open_connection`='".$c."'";
				
	
	
	$sql_insert = "INSERT INTO `gx_open_connection` (`id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_open_connection`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `no_off_connection`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL, '".$kode_cabang."', '".$nama_cabang."', NOW(), '".$c."', '".$kode_customer."', '".$nama_customer."', '".$user_id."', '".$no_inactive."', '".$status_inactive."', '".$no_off_connection."', '".$remarks."', '".$kode_cso."', '".$request."', '".$foto_email."', '".$no_formulir."', '0', NOW(), NOW(), '0', '".$loggedin['username']."', '".$loggedin['username']."')";
	//echo $sql_insert."<br>";

	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	mysql_query($sql_update_file, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	//echo $sql_update;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
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
				/*$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				*/
				
				
				$sql_insert_file = "INSERT INTO `gx_open_connection_image_email`(`id`, `tanggal`, `kode_open_connection`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
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
    $query 	= "SELECT * FROM `".$table_main."` WHERE  `".$unix_field_sql."` ='".$c."' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
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
				    $content.=' <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET['c']) ? $row["nama_cabang"] : '').'" onclick="return valideopenerform(\'data_cabang.php?r=form_open_connection&f=data_cabang\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['c']) ? $row["kode_cabang"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['c']) ? $row["tanggal"] : date("Y-m-d")).'">
					    </div>
					  
					    ';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Open Connection</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_open_connection" value="'.(isset($_GET['c']) ? $row["kode_open_connection"] : "OCN-".rand(0000000, 9999999)).'">
					    </div>
					  
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'" onclick="return valideopenerform(\'data_customer.php?r=form_open_connection&f=data_open_connection\',\'customer\');">
						
					    </div>
                                        </div>
					</div>
					   
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text"  class="form-control" name="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_customer"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="user_id" value="'.(isset($_GET['c']) ? $row["user_id"] : '').'">
					    </div>
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Inactive</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text"  class="form-control" name="no_inactive" value="'.(isset($_GET['c']) ? $row["no_inactive"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Status Inactive</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="status_inactive" value="'.(isset($_GET['c']) ? $row["status_inactive"] : '').'">
					    </div>
                                        </div>
					</div>
					
					 
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Off Connection</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text"  class="form-control" name="no_off_connection" value="'.(isset($_GET['c']) ? $row["no_off_connection"] : '').'" onclick="return valideopenerform(\'data_off_connection.php?r=form_open_connection&f=data_off_connection\',\'customer\');">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Remarks</label>
					    </div>
					    <div class="col-xs-12">
						<textarea  class="form-control" name="remarks" >'.(isset($_GET['c']) ? $row["remarks"] : '').'</textarea>
					    </div>

                                        </div>
					</div>
					

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Request</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text"  class="form-control" name="request" value="'.(isset($_GET['c']) ? $row["request"] : '').'" onclick="return valideopenerform(\'data_cso.php?r=form_open_connection&f=data_cso\',\'CSO\');" readonly="">
						<input type="hidden"  class="form-control" name="kode_cso" value="'.(isset($_GET['c']) ? $row["kode_cso"] : '').'">
					    </div>
					    
						<div class="col-xs-2">
							<label>Foto email</label>
						</div>
						<div class="col-xs-4">
							<div id="filediv" style="display:none;">
								<input name="file[]" type="file" id="file"/>
							</div>
							';
								if(isset($_GET["id"])){
									$sql_data		= mysql_query("SELECT * FROM `gx_open_connection_image_email` WHERE `level` =  '0' AND `kode` = '".$row_data["kode"]."'  ORDER BY `id` DESC;", $conn);
									while($row_data = mysql_fetch_array($sql_data)){
										$content .='<div class="abcd" style="float: left;"><img src="'.URL_ADMIN.''.$row_data["lokasi_file"].''.$row_data["nama_file"].'"></div>';
									}
								}
					   $content .='
							<!--<br style="clear:both;">-->
							
							<input type="button" id="add_more" class="upload" value="Add More Files"/>
						</div>
						
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Formulir</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="no_formulir" value="'.(isset($_GET['c']) ? $row["no_formulir"] : '').'" onclick="return valideopenerform(\'data_formulir.php?r=form_open_connection&f=data_formulir\',\'formulir\');">
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
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>
	<!-- datepicker -->
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
	    </style>
	';

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