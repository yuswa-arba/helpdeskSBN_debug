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
    $id_upgrade_downgrade		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_upgrade_downgrade	= "SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection` WHERE `id_upgrade_downgrade_connection`='$id_upgrade_downgrade' LIMIT 0,1;";
    $sql_upgrade_downgrade		= mysql_query($query_upgrade_downgrade, $conn);
    $row_upgrade_downgrade		= mysql_fetch_array($sql_upgrade_downgrade);
   
    $sql_cabang    = mysql_query("SELECT * FROM `gx_cabang`
                                      WHERE `gx_cabang`.`id_cabang` = '$row_upgrade_downgrade[kode_cabang]';", $conn);
    $row_cabang    = mysql_fetch_array($sql_cabang);
	
	$hari	=$row_upgrade_downgrade["tanggal"];
	$e1 = explode("-", $hari);
	$tgl = $e1[2];
	$bln = $e1[1];
	$thn = $e1[0];
	
	$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
    $hari_ini	= $tgl;
	$sum_aktivasi_sd_akhirbulan 	= $jumlah_hari - $hari_ini; //baru
	$total_hari_pengurangan 		= $jumlah_hari - $sum_aktivasi_sd_akhirbulan; //lama
	//Invoice Lama
    $sql_paket_lama    = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`kode_paket` = '$row_upgrade_downgrade[kode_paket_lama]';", $conn);
    $row_paket_lama    = mysql_fetch_array($sql_paket_lama);

	$tagihanperhari_lama  	= $row_paket_lama["monthly_fee"] / $jumlah_hari;
	$total_tagihan_lama		= $total_hari_pengurangan * $tagihanperhari_lama;
	$ppn_lama				= 10/100 * $total_tagihan_lama;
	$totalppn_lama			= $total_tagihan_lama + $ppn_lama;
	//---------------//
	
	//Invoice Baru
    $sql_paket_baru    = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`kode_paket` = '$row_upgrade_downgrade[kode_paket_baru]';", $conn);
    $row_paket_baru	   = mysql_fetch_array($sql_paket_baru);

	$tagihanperhari_baru  	= $row_paket_baru["monthly_fee"] / $jumlah_hari;
	$total_tagihan_baru		= $sum_aktivasi_sd_akhirbulan * $tagihanperhari_baru;
	$ppn_baru				= 10/100 * $total_tagihan_baru;
	$totalppn_baru			= $total_tagihan_baru + $ppn_baru;
	//---------------//
	
}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Upgrade Downgrade Connection</h3>
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
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=updown_connection\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Upgrade Downgrade</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_upgrade_downgrade" name="kode_upgrade_downgrade" required="" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_upgrade_downgrade"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_customer"] : "").'" onclick="return valideopenerform(\'data_customer.php?r=myForm&f=updown_connection\',\'customer\');" >
											</div>
										</div>
										</div> 
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["nama_customer"] : "").'">
											</div>
															
											<div class="col-xs-3">
												<label>UID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["uid"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Lama</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket_lama" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_paket_lama"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_lama" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["nama_paket_lama"] : "").'">
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
															<input type="text" class="form-control" readonly="" name="kode_paket_baru" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_paket_baru"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly="" name="kode_paket_baru" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_paket_baru"] : "").'" onclick="return valideopenerform(\'data_paket.php?r=myForm&f=updown_connection\',\'paket\');">
														</div>';
										}
										$content .='
											
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket_baru" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["nama_paket_baru"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Group RBS</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" name="group_rbs" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["group_rbs"] : "").'">
											</div>
															
											<div class="col-xs-3">
											<label>No Formulir</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control"  name="kode_formulir" value="'.(isset($_GET['id']) ? $row_upgrade_downgrade["kode_formulir"] : "").'" onclick="return valideopenerform(\'data_formulir.php?r=myForm&f=updown_connection\',\'formulir\');">
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
														$sql_data		= mysql_query("SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection_upload` WHERE `level` =  '0' AND `id_upgrade_downgrade_connection` = '".$row_upgrade_downgrade["id_upgrade_downgrade_connection"]."'  ORDER BY `id_upload` DESC;", $conn);
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
											<div class="col-xs-3" align="center">
												<label> </label>
											</div>
											<div class="col-xs-7" align="center">
												<label>PERHITUNGAN INVOICE</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3" align="center">
												<label> </label>
											</div>
											<div class="col-xs-4" align="center">
												<label>INVOICE LAMA</label>
											</div>
											<div class="col-xs-4" align="center">
												<label>INVOICE BARU</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="monthly_lama" value="'.(isset($_GET['id']) ? number_format($row_paket_lama["monthly_fee"], 2) : "0").'">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="monthly_baru" value="'.(isset($_GET['id']) ? number_format($row_paket_baru["monthly_fee"], 2) : "0").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tagihan Perhari</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="daily_lama" value="'.(isset($_GET['id']) ? number_format($tagihanperhari_lama,2) : "0").'">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="daily_baru" value="'.(isset($_GET['id']) ? number_format($tagihanperhari_baru,2) : "0").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>jumlah Hari Aktivasi</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="hari_aktivasi_lama" value="'.(isset($_GET['id']) ? $total_hari_pengurangan : "0").'">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="hari_aktivasi_baru" value="'.(isset($_GET['id']) ? $sum_aktivasi_sd_akhirbulan : "0").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Total Tagihan Prorate</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="total_lama" value="'.(isset($_GET['id']) ? number_format($total_tagihan_lama,2) : "0").'">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="total_baru" value="'.(isset($_GET['id']) ? number_format($total_tagihan_baru,2)  : "0").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>PPN</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="ppn_lama" value="'.(isset($_GET['id']) ? number_format($ppn_lama,2) : "0").'">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="ppn_baru" value="'.(isset($_GET['id']) ? number_format($ppn_baru,2) : "0").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Total Tagihan + PPN</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" name="totalppn_lama" value="'.(isset($_GET['id']) ? number_format($totalppn_lama, 2) : "0").'">
											</div>
											<div class="col-xs-4">
												<input type="text" readonly=""  class="form-control" name="totalppn_baru" value="'.(isset($_GET['id']) ? number_format($totalppn_baru, 2) : "0").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_upgrade_downgrade["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Lates Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_upgrade_downgrade["user_upd"]." ".$row_upgrade_downgrade["date_upd"] : "").'
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
	$sql_upgrade_downgrade_connection  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection` ORDER BY `id_upgrade_downgrade_connection` DESC", $conn));
	$last_data  	= $sql_upgrade_downgrade_connection["id_upgrade_downgrade_connection"] + 1;
	
    //echo "save";
    $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_upgrade_downgrade = isset($_POST['kode_upgrade_downgrade']) ? mysql_real_escape_string(trim($_POST['kode_upgrade_downgrade'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    
    $kode_paket_lama		= isset($_POST['kode_paket_lama']) ? mysql_real_escape_string(trim($_POST['kode_paket_lama'])) : '';
    $nama_paket_lama		= isset($_POST['nama_paket_lama']) ? mysql_real_escape_string(trim($_POST['nama_paket_lama'])) : '';
    $kode_paket_baru		= isset($_POST['kode_paket_baru']) ? mysql_real_escape_string(trim($_POST['kode_paket_baru'])) : '';
    $nama_paket_baru		= isset($_POST['nama_paket_baru']) ? mysql_real_escape_string(trim($_POST['nama_paket_baru'])) : '';
    
	$totalppn_lama2	    	= isset($_POST['totalppn_lama']) ?	str_replace(",", "", $_POST['totalppn_lama']) : '';
	$totalppn_baru2	    	= isset($_POST['totalppn_baru']) ?  str_replace(",", "", $_POST['totalppn_baru']) : '';
	
    $group_rbs	    		= isset($_POST['group_rbs']) ? mysql_real_escape_string(trim($_POST['group_rbs'])) : '';
    $kode_formulir			= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/upgrade_downgrade/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/upgrade_downgrade/';
	
    
    $sql_insert = "INSERT INTO `gx_helpdesk_upgrade_downgrade_connection` (`id_upgrade_downgrade_connection`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_upgrade_downgrade`, `kode_customer`, `nama_customer`, `kode_paket_lama`,
						  `nama_paket_lama`, `kode_paket_baru`, `nama_paket_baru`, `group_rbs`, `kode_formulir`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_upgrade_downgrade."', '".$kode_customer."', '".$nama_customer."', '".$kode_paket_lama."',
						  '".$nama_paket_lama."', '".$kode_paket_baru."', '".$nama_paket_baru."', '".$group_rbs."', '".$kode_formulir."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	//|INSERT INVOICE|//
	$row_tbcustomer  = mysql_fetch_array(mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$sql_upgrade_downgrade_connection["kode_customer"]."'  ORDER BY `idCustomer` DESC", $conn));
	
	$row_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
	$last_data_invoice  	= $row_invoice["id_invoice"] + 1;
	
    $row_cabang  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$kode_cabang."'  ORDER BY `id_cabang` DESC", $conn));
	$tanggal_invoice    = date("d");
	
	$kode_invoice = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_grace_customer"].''.$tanggal_invoice.''.sprintf("%04d", $last_data_invoice);
	
	$sql_insert_invoice = "INSERT INTO `gx_invoice` (`id_invoice`, `id_cabang`,
						  `kode_upgrade_downgrade`, `kode_invoice`, `title`, `customer_number`, `nama_customer`,
						  `npwp`, `note`, `tanggal_tagihan`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."',
						  '".$kode_upgrade_downgrade."', '".$kode_invoice."', 'Invoice Upgrade Downgrade Connection', '".$kode_customer."', '".$nama_customer."',
						  '".$row_tbcustomer["no_npwp"]."', '', NOW(),
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	//|INSERT INVOICE DETAIL LAMA|//
	$sql_insert_invoice_detail_lama = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`,
						  `date`, `harga`, `jumlah`, `id_paket`, `periode`,
						  `desc`, `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_invoice."',
						  NOW(), '".$totalppn_lama2."', '', '".$kode_paket_lama."', '',
						  'Invoice Lama', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert_invoice_detail_lama, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	//|INSERT INVOICE DETAIL Baru|//
	$sql_insert_invoice_detail_baru = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`,
						  `date`, `harga`, `jumlah`, `id_paket`, `periode`,
						  `desc`, `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_invoice."',
						  NOW(), '".$totalppn_baru2."', '', '".$kode_paket_baru."', '',
						  'Invoice Baru', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert_invoice_detail_baru, $conn) or die ("<script language='JavaScript'>
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
				$sql_insert_file = "INSERT INTO `gx_helpdesk_upgrade_downgrade_connection_upload` (`id_upload`, `id_upgrade_downgrade_connection`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$last_data."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				
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
			window.location.href='".URL_ADMIN."help_desk/master_updown_connection.php';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $sql_upgrade_downgrade_connection  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_helpdesk_upgrade_downgrade_connection` ORDER BY `id_upgrade_downgrade_connection` DESC", $conn));
	$last_data  	= $sql_upgrade_downgrade_connection["id_upgrade_downgrade_connection"] + 1;
	
    //echo "save";
    $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_upgrade_downgrade = isset($_POST['kode_upgrade_downgrade']) ? mysql_real_escape_string(trim($_POST['kode_upgrade_downgrade'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    
    $kode_paket_lama		= isset($_POST['kode_paket_lama']) ? mysql_real_escape_string(trim($_POST['kode_paket_lama'])) : '';
    $nama_paket_lama		= isset($_POST['nama_paket_lama']) ? mysql_real_escape_string(trim($_POST['nama_paket_lama'])) : '';
    $kode_paket_baru		= isset($_POST['kode_paket_baru']) ? mysql_real_escape_string(trim($_POST['kode_paket_baru'])) : '';
    $nama_paket_baru		= isset($_POST['nama_paket_baru']) ? mysql_real_escape_string(trim($_POST['nama_paket_baru'])) : '';
    
    $group_rbs	    		= isset($_POST['group_rbs']) ? mysql_real_escape_string(trim($_POST['group_rbs'])) : '';
    $kode_formulir			= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/upgrade_downgrade/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/upgrade_downgrade/';
    
    $sql_update = "UPDATE `gx_helpdesk_upgrade_downgrade_connection` SET `kode_customer` = '".$kode_customer."', `nama_customer`='".$nama_customer."',
		    `uid`='".$uid."', `nama_customer`='".$nama_customer."', `kode_formulir`='".$kode_formulir."',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_upgrade_downgrade_connection` = '$_GET[id]';";
    
    echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
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
				$sql_insert_file = "INSERT INTO `gx_helpdesk_upgrade_downgrade_connection_upload` (`id_upload`, `id_upgrade_downgrade_connection`, `nama_file`, `lokasi_file` ,`user_add`, `date_add`, `level`)
						VALUES ('', '".$_GET["id"]."', '".$img_name."', '".$lokasi."', '".$loggedin["username"]."', NOW(), '0');";
				
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
			window.location.href='".URL_ADMIN."help_desk/master_updown_connection.php';
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

    $title	= 'Form Upgrade Downgrade Connection';
    $submenu	= "upgrade_downgrade";
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