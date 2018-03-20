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
$table_main = "gx_realisasi_link_budget_maintance";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert 		= "form_realisasi_link_budget_maintance_detail";
    $url_redirect_insert_detail	 	= "";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "form_realisasi_link_budget_maintance_detail";
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1
    


//String Data View
    //Judul Form
    $judul_form = "Form Realisasi Link Budget Maintance";
    $header_form = "Data Realisasi Link Budget Maintance";
    $index_field_sql = "id";
    $unix_field_sql = "kode_realisasi_link_budget_maintance";
    $url_form_detail = "detail_realisasi_link_budget_maintance";
    $url_form_edit = "form_realisasi_link_budget_maintance";
    
    $form_name = "form_realisasi_link_budget_maintance";
    $form_id = "form_realisasi_link_budget_maintance";
    
    $form_name_2 = "";
    $form_id_2 = "";
    
    //id web
    $title_header = 'Master Realisasi Link Budget Maintance';
    $submenu_header = 'master_realisasi_link_budget_maintance';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$											= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_realisasi_link_budget_maintance_alat						= isset($_POST['kode_realisasi_link_budget_maintance_alat']) ? mysql_real_escape_string(trim($_POST['kode_realisasi_link_budget_maintance_alat'])) : '';
    $kode_realisasi_link_budget_maintance						= isset($_POST['kode_realisasi_link_budget_maintance']) ? mysql_real_escape_string(trim($_POST['kode_realisasi_link_budget_maintance'])) : '';
    $tanggal										= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_barang									= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang									= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $quantity										= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $serial_number									= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/realisasi_link_budget_maintance/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/realisasi_link_budget_maintance/';
	
	
    if($kode_realisasi_link_budget_maintance_alat == "" && $kode_realisasi_link_budget_maintance != ''){  //upload foto
    for ($i = 0; $i < count($_FILES['file']['name']); $i++){
	    // Loop to get individual element from the array
	    $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
	    $img_name = ($_FILES['file']['name'][$i]);
	    
	    $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
	    $file_extension = end($ext); // Store extensions in the variable.
	    //$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
	    
	    $j = 0;
	    $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
	    /*if (($_FILES["file"]["size"][$i] < 2000000)     // Approx. 2Mb files can be uploaded.
	    && in_array($file_extension, $validextensions)) {*/
	    if(($_FILES["file"]["size"][$i] < 5000000)     // Approx. 5Mb files can be uploaded.
	    && in_array($file_extension, $validextensions)){
			
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path.$img_name)){
			// If file moved to uploads folder.
				/*$sql_insert_file = "INSERT INTO `gx_upload` (`id`, `kode_konversi`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$kode_konversi."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				*/
				
				
				/*$sql_insert_file = "INSERT INTO `gx_open_connection_image_email`(`id`, `tanggal`, `kode_open_connection`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,NOW(),'".$c."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";*/
				
				$sql_insert_file = "INSERT INTO `gx_realisasi_link_budget_maintance_image`(`id`, `tanggal`, `kode_realisasi_link_budget_maintance`, `foto_alat`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,NOW(),'".$kode_realisasi_link_budget_maintance."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	
				mysql_query($sql_insert_file, $conn) or die ("<script language='JavaScript'>
										   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
										   window.history.go(-1);
										   </script>");
				
			}else{     //  If File Was Not Moved.
			echo "<script language='JavaScript'>
										   alert('File Was Not Moved.');
										   window.history.go(-1);
										   </script>";
			}	
	    } else {     //If File Size And File Type Was Incorrect.
		echo "";
	    }
	}
    }
    
    
    
    	
	
    elseif($kode_realisasi_link_budget_maintance_alat!= ""){
    
    $sql_insert = "INSERT INTO `gx_realisasi_link_budget_maintance_alat`(`id`, `kode_realisasi_link_budget_maintance_alat`, `kode_realisasi_link_budget_maintance`, `tanggal`, `kode_barang`, `nama_barang`, `quantity`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'".$kode_realisasi_link_budget_maintance_alat."','".$kode_realisasi_link_budget_maintance."','".$tanggal."','".$kode_barang."','".$nama_barang."','".$quantity."','".$serial_number."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    
    
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert (error insert) ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    $c_id = isset($_GET['c']) ? $_GET['c'] : $kode_realisasi_link_budget_maintance;
    
    
    
   echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".$url_redirect_insert_detail."?c=".$c_id."';
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
    
    $id 										= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 											= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    $a 											= isset($_GET['a']) ? mysql_real_escape_string(trim($_GET['a'])) : '';							
    $kode_realisasi_link_budget_maintance_alat						= isset($_POST['kode_realisasi_link_budget_maintance_alat']) ? mysql_real_escape_string(trim($_POST['kode_realisasi_link_budget_maintance_alat'])) : '';
    $kode_realisasi_link_budget_maintance						= isset($_POST['kode_realisasi_link_budget_maintance']) ? mysql_real_escape_string(trim($_POST['kode_realisasi_link_budget_maintance'])) : '';
    $tanggal										= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_barang									= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang									= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $quantity										= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $serial_number									= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    
   
    if($a != ""){
	
	//UPDATE 
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_link_budget_maintance` WHERE `kode_link_budget_maintance`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/realisasi_link_budget_maintance/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/realisasi_link_budget_maintance/';
	
	
	/*$sql_update = "UPDATE `gx_realisasi_link_budget_maintance` SET `date_upd`=NOW(),`user_upd`='".$loggedin['username']."',`level`='1' WHERE `kode_realisasi_link_budget_maintance`='".$c."'";*/
	$sql_update = "UPDATE `gx_realisasi_link_budget_maintance_image` SET `date_upd`=NOW(),`level`='0',`user_upd`='".$loggedin['username']."' WHERE `kode_realisasi_link_budget_maintance`='".$c."'";			
	
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql update) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	$sql_update_2 = "UPDATE `gx_realisasi_link_budget_maintance_image` SET `date_upd`=NOW(),`level`='0',`user_upd`='".$loggedin['username']."' WHERE `kode_realisasi_link_budget_maintance`='".$c."'";			
	
	mysql_query($sql_update_2, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql update) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	
	    $sql_insert = "INSERT INTO `gx_realisasi_link_budget_maintance_alat`(`id`, `kode_realisasi_link_budget_maintance_alat`, `kode_realisasi_link_budget_maintance`, `tanggal`, `kode_barang`, `nama_barang`, `quantity`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	    VALUES (NULL,'".$kode_realisasi_link_budget_maintance_alat."','".$kode_realisasi_link_budget_maintance."','".$tanggal."','".$kode_barang."','".$nama_barang."','".$quantity."','".$serial_number."','0',NOW(),NOW(),'".$loggedin['username']."','".$loggedin."','0')";
	
	
	//echo $sql_insert;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate (error sql insert) ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    //upload foto
    for ($i = 0; $i < count($_FILES['file']['name']); $i++){
	    // Loop to get individual element from the array
	    $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
	    $img_name = ($_FILES['file']['name'][$i]);
	    
	    $ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
	    $file_extension = end($ext); // Store extensions in the variable.
	    //$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
	    $j = 0;
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
				
				
				/*$sql_insert_file = "INSERT INTO `gx_open_connection_image_email`(`id`, `tanggal`, `kode_open_connection`, `foto_email`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,NOW(),'".$c."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";*/
				
				/*
				$sql_insert_file = "INSERT INTO `gx_realisasi_link_budget_maintance_image`(`id`, `tanggal`, `kode_realisasi_link_budget_maintance`, `foto_alat`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,'".$tanggal."','".$kode_realisasi_link_budget_maintance."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
				*/
				
				$sql_insert_file = "INSERT INTO `gx_realisasi_link_budget_maintance_image`(`id`, `tanggal`, `kode_realisasi_link_budget_maintance`, `foto_alat`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
				VALUES (NULL,'".$tanggal."','".$kode_realisasi_link_budget_maintance."','".$img_name."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
				
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
	    window.location.href='".$redirect_update_data."?c=".$c."';
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
    $query 	= "SELECT * FROM `".$table_main."` WHERE  `".$unix_field_sql."`='".$c."' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);

}
if(isset($_GET['f']) && $_GET['act'] == 'delete'){
    $c		= isset($_GET['c']) ? $_GET['c'] : '';
    $sql_del_image = "UPDATE `gx_realisasi_link_budget_maintance_image` SET `date_upd`=NOW(),`level`='2',`user_upd`=NOW() WHERE `id`='".$_GET['f']."'";
    $query_del_image = mysql_query($sql_del_image, $conn);
    echo "<script language='JavaScript'>
	    alert('Data telah dihapus.');
	    window.location.href='".$redirect_update_data."?c=".$c."';
	    </script>";
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
                                <!--<form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data">-->
				    <div class="box-body">
				    				    
                                        <div class="form-group">
					<div class="row">';
					$content .=' <div class="col-xs-2">
						<!--<label>Kode Realisasi Link Budget Maintance</label>-->
						<label>No Link Realisasi Budget Maintance</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["kode_realisasi_link_budget_maintance"] : 'RBM-'.rand(0000000,9999999) ).'
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4"> 
						'.(isset($_GET['c']) ? $row["tanggal"] : date("Y-m-d")).'
					    </div>';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '					  
                                        </div>
					</div>
					
					       
				<!--
				kode_link_budget_maintance_, kode_customer_, nama_customer_, kode_cabang_, cabang_, latitude_, longtidute_, tiang_terdekat_, type_connection_, power_budget_
				-->
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["cabang"] : '').'
						
					    </div>
					    <div class="col-xs-2">
						<label>No Link Budget Maintance</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["no_link_budget_maintance"] : '').'
					    </div>
                                        </div>
					</div>
					 
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["kode_customer"] : '').'
					    </div>
					    <div class="col-xs-2">
						<label>SPK Maintance</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["spk_maintance"] : '').'
					    </div>
                                        </div>
					</div>
					    
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["latitude"] : '').'
					    </div>
					  
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["nama_customer"] : '').'
					    </div>
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					  
					    <div class="col-xs-2">
						<label>Tiang Terdekat</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["tiang_terdekat"] : '').'
					    </div>
					    <div class="col-xs-2">
						<label>Longtidute</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["longtidute"] : '').'
					    </div>
					  
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-6"></div>
					    <div class="col-xs-2">
						<label>Nama Created</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? $row["nama_created"] : $loggedin['username']).'
					    </div>
                                        </div>
					</div>
					  
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Type Connection</label>
					    </div>
					    <div class="col-xs-4">
						'.(isset($_GET['c']) ? ($row["type_connection"]=='fiber_optic' ? 'Fiber Optic' : 'Wireless') : '').'
					    </div>
                                        </div>
					</div>
					    
					    
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Power Budget</label>
					    </div>
					    <div class="col-xs-12">
						'.(isset($_GET['c']) ? $row["power_budget"] : '').'
					    </div>										  
                                        </div>
					</div>   
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alat yang terpasang</label>
					    </div>
					    <form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data"> 
						   <div class="col-xs-2"><input readonly="" type="hidden" class="form-control" required="" name="kode_realisasi_link_budget_maintance" value="'.(isset($_GET['a']) ? $row_brg['kode_realisasi_link_budget_maintance']: $_GET['c']).'"><input readonly="" type="hidden" class="form-control" required="" name="kode_realisasi_link_budget_maintance_alat" value="'.(isset($_GET['a']) ? $row_brg["kode_realisasi_link_budget_maintance_alat"] : 'BRG-'.rand(000000,999999)).'"><input placeholder="Kode Barang" type="text" class="form-control" required="" name="kode_barang" value="'.(isset($_GET['a']) ? $row_brg["kode_barang"] : '').'"></div><div class="col-xs-2"><input type="text" class="form-control" required="" name="nama_barang" value="'.(isset($_GET['b']) ? $row_brg["nama_barang"] : '').'" placeholder="Nama Barang"></div><div class="col-xs-2"> <input type="text" class="form-control" required="" name="quantity" value="'.(isset($_GET['a']) ? $row_brg["quantity"] : '').'" placeholder="Quantity"></div><div class="col-xs-2"><input type="text" class="form-control" required="" name="serial_number" value="'.(isset($_GET['b']) ? $row_b["serial_number"] : '').'" placeholder="Serial Number"></div><div class="col-xs-2"><button type="submit" value="Submit" '.(isset($_GET['a']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button></div>
					    
					    <div class="col-xs-12">
						
						<table class="table table-hover">
						    <thead>
							<tr><th>No</th><th>Nama Barang</th><th>Quantity</th><th>Serial Number</th><th>Action</th></tr>
						    </thead>
						    <tbody>';
						    //SELECT `id`, `kode_link_budget_maintance_alat`, `kode_link_budget_maintance`, `tanggal`, `kode_barang`, `nama_barang`, `quantity`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_link_budget_maintance_alat` WHERE 1
							$sql_1 = "SELECT * FROM `gx_realisasi_link_budget_maintance_alat` WHERE `kode_realisasi_link_budget_maintance`='".$c."'";
							$query_1 = mysql_query($sql_1, $conn);
							while($row_1=mysql_fetch_array($query_1)){
									    $content .= '<tr><td>'.$row_1['kode_barang'].'</td><td>'.$row_1['nama_barang'].'</td><td>'.$row_1['quantity'].'</td><td>'.$row_1['serial_number'].'</td><td><a href="?c='.(isset($_GET['c']) ? $_GET['c'] : '').'&act=edit&a='.$row_1['kode_realisasi_link_budget_maintance_alat'].'">Edit</a></td></tr>';
							}    
						$content .= '</tbody>';
						    
						   /* 
						    while(){
							$content .= '<tr><td>Kode Barang</td><td>Nama Barang</td><td>Qty</td><td>No Seri Number</td></tr>';
						    }
						    */
						
						$content .= '</table> 
					    </div>
					    <!--<div class="col-xs-2"><button type="submit" value="Submit" '.(isset($_GET['c']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button></div>-->
					    </form>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					
					<form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data">   
					    <div class="col-xs-12">
						<label>Foto Alat yang terpasang</label>
					    </div>
					    
					    <div class="col-xs-2">
							<label>Upload Foto</label>
						</div>
						<div class="col-xs-8">
						';
						$c = isset($_GET['c']) ? $_GET['c'] : '';
						$content .= '
						<input type="hidden" name="kode_realisasi_link_budget_maintance" value="'.$c.'">
							<div id="filediv" style="display:none;">
								<input name="file[]" type="file" id="file"/>
							</div>';
								if(isset($_GET["id"])){
									$sql_data		= mysql_query("SELECT * FROM `gx_open_connection_image_email` WHERE `level` =  '0' AND `kode` = '".$row_data["kode"]."'  ORDER BY `id` DESC;", $conn);
									while($row_data = mysql_fetch_array($sql_data)){
										$content .='<div class="abcd" style="float: left;"><img src="'.URL_ADMIN.''.$row_data["lokasi_file"].''.$row_data["nama_file"].'"></div>';
									}
								}
					    $content .= '
							<!--<br style="clear:both;">-->
							
							<input type="button" id="add_more" class="upload" value="Add More Files"/>
						</div>
						<div class="col-xs-2">
						    <button type="submit" value="Submit" '.(isset($_GET['f']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
						</div>
					
					    <div class="col-xs-12"><table><tr>';
						//SELECT `id`, `kode_link_budget_maintance_alat`, `kode_link_budget_maintance`, `tanggal`, `kode_barang`, `nama_barang`, `quantity`, `serial_number`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_link_budget_maintance_alat` WHERE 1
							$sql_foto = "SELECT * FROM `gx_realisasi_link_budget_maintance_image` WHERE `kode_realisasi_link_budget_maintance`='".$c."' AND `level`='0'";
							$query_foto = mysql_query($sql_foto, $conn);
							$no_img = 1;
							while($row_foto=mysql_fetch_array($query_foto)){
									    $content .= '<td><img src="../upload/realisasi_link_budget_maintance/'.$row_foto['foto_alat'].'" width="100px"><br><a href="?c='.(isset($_GET['c']) ? $_GET['c'] : '').'&act=delete&f='.$row_foto['id'].'">Hapus</a></td> ';
									    if($no_img % 5){
										$content .= '';
									    }
									    else{
										$content .= '</tr><tr>';
									    }
									    $no_img++;
							}    
					    $content .= '</tr></table>
					    </div>			  
                                        </div>
					</div>
					
					</div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <!--<button type="submit" value="Submit" '.(isset($_GET['a']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>-->
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