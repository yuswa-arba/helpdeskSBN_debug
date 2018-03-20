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
$table_main = "gx_invoice_reaktivasi_customer";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "master_invoice_reaktivasi";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "master_invoice_reaktivasi";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Invoice Reaktivasi";
    $header_form = "Data Invoice Reaktivasi";
    $index_field_sql = "id";
    $unix_field_sql = "kode_invoice";
    $url_form_detail = "detail_invoice_reaktivasi";
    $url_form_edit = "form_invoice_reaktivasi";
    
    $form_name = "form_invoice_reaktivasi";
    $form_id = "";
    
    //id web
    $title_header = 'Master Invoice Reaktivasi';
    $submenu_header = 'master_invoice_reaktivasi';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    /*
    $nama_pelanggan							= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $periode_tagihan							= isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
    $kode_customer							= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $tanggal_tagihan							= isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';
    $kode_invoice							= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $tanggal_jatuh_tempo						= isset($_POST['tanggal_jatuh_tempo']) ? mysql_real_escape_string(trim($_POST['tanggal_jatuh_tempo'])) : '';
    $npwp								= isset($_POST['npwp']) ? mysql_real_escape_string(trim($_POST['npwp'])) : '';
    $no_virtual_account_bca						= isset($_POST['no_virtual_account_bca']) ? mysql_real_escape_string(trim($_POST['no_virtual_account_bca'])) : '';
    $nama_virtual_account						= isset($_POST['nama_virtual_account']) ? mysql_real_escape_string(trim($_POST['nama_virtual_account'])) : '';
    $note								= isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
    $reaktivasi_invoice							= isset($_POST['reaktivasi_invoice']) ? mysql_real_escape_string(trim($_POST['reaktivasi_invoice'])) : '';
    $total_invoice							= isset($_POST['total_invoice']) ? mysql_real_escape_string(trim($_POST['total_invoice'])) : '';
    $no_faktur_pajak							= isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
    $ppn_invoice							= isset($_POST['ppn_invoice']) ? mysql_real_escape_string(trim($_POST['ppn_invoice'])) : '';
    $grand_total_invoice						= isset($_POST['grand_total_invoice']) ? mysql_real_escape_string(trim($_POST['grand_total_invoice'])) : '';
    $uang_muka_invoice							= isset($_POST['uang_muka_invoice']) ? mysql_real_escape_string(trim($_POST['uang_muka_invoice'])) : '';
    $sisa_invoice							= isset($_POST['sisa_invoice']) ? mysql_real_escape_string(trim($_POST['sisa_invoice'])) : '';
    $prepared_by							= isset($_POST['prepared_by']) ? mysql_real_escape_string(trim($_POST['prepared_by'])) : '';
    $printed_by								= isset($_POST['printed_by']) ? mysql_real_escape_string(trim($_POST['printed_by'])) : '';
    */
    
    $nama_pelanggan							= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $periode_tagihan							= isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
    $kode_customer							= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $tanggal_tagihan							= isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';
    $kode_invoice							= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $kode_reaktivasi							= isset($_POST['kode_reaktivasi']) ? mysql_real_escape_string(trim($_POST['kode_reaktivasi'])) : '';
    $tanggal_aktivasi							= isset($_POST['tanggal_r']) ? mysql_real_escape_string(trim($_POST['tanggal_r'])) : '';
    
    $tanggal_jatuh_tempo						= isset($_POST['tanggal_jatuh_tempo']) ? mysql_real_escape_string(trim($_POST['tanggal_jatuh_tempo'])) : '';
    $npwp								= isset($_POST['npwp']) ? mysql_real_escape_string(trim($_POST['npwp'])) : '';
    $no_virtual_account_bca						= isset($_POST['no_virtual_account_bca']) ? mysql_real_escape_string(trim($_POST['no_virtual_account_bca'])) : '';
    $nama_virtual_account						= isset($_POST['nama_virtual_account']) ? mysql_real_escape_string(trim($_POST['nama_virtual_account'])) : '';
    $note								= isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
    $monthly_fee							= isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $no_faktur_pajak							= isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
    
    $exp_tanggal_aktivasi   						= explode("-", $tanggal_aktivasi);
    $day_aktivasi							= $exp_tanggal_aktivasi[2];
    $month_aktivasi							= $exp_tanggal_aktivasi[1];
    $year_aktivasi							= $exp_tanggal_aktivasi[0];
    $jumlah_hari 							= cal_days_in_month(CAL_GREGORIAN, $month_aktivasi, $year_aktivasi); 
    $tagihan_per_hari 							= $monthly_fee / $jumlah_hari;
    $jumlah_hari_aktivasi						= (mktime("0", "0", "0", $month_aktivasi, $jumlah_hari, $year_aktivasi) - mktime("0", "0", "0", $month_aktivasi, $day_aktivasi, $year_aktivasi)) / (60*60*24);
    $total_tagihan_prorate						= $jumlah_hari_aktivasi * ( $monthly_fee / $jumlah_hari);
    $ppn								= (0.1 * $total_tagihan_prorate);
    $total_tagihan_plus_ppn						= $total_tagihan_prorate + $ppn;
    
    $reaktivasi_invoice							= $total_tagihan_prorate;
    $total_invoice							= $reaktivasi_invoice;
    $ppn_invoice							= $ppn;
    $grand_total_invoice						= $total_tagihan_plus_ppn;
    $uang_muka_invoice							= 0;
    $sisa_invoice							= $grand_total_invoice - $uang_muka_invoice;
    
    $prepared_by							= isset($_POST['prepared_by']) ? mysql_real_escape_string(trim($_POST['prepared_by'])) : '';
    $printed_by								= isset($_POST['printed_by']) ? mysql_real_escape_string(trim($_POST['printed_by'])) : '';
    
    //$kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    
    
	
    if($kode_invoice != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
  
    //$sql_insert = "INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_batal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    //VALUES (NULL,'$kode_batal_posting','$nama_batal','$kode_batal','$alasan_batal','$data_asli','$data_baru',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	
	$j = 0;     // Variable for indexing uploaded image.
	$target_path 	= "../upload/email/";     // Declaring Path for uploaded images.
	$lokasi	    	= 'upload/email/';
	
    
    /*
    $sql_insert = "INSERT INTO `software`.`gx_reaktivasi_customer` (`id`, `kode_cabang`, `nama_cabang`, `tanggal`, `kode_reaktivasi`, `kode_customer`, `nama_customer`, `user_id`, `no_inactive`, `status_inactive`, `remarks`, `kode_cso`, `request`, `foto_email`, `no_formulir`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$kode_cabang."', '".$nama_cabang."', NOW(), '".$kode_reaktivasi."', '".$kode_customer."', '".$nama_customer."', '".$user_id."', '".$no_inactive."', '".$status_inactive."', '".$remarks."', '".$kode_cso."', '".$request."', '".$foto_email."', '".$no_formulir."', '0', NOW(), NOW(), '0', '".$loggedin['username']."', '".$loggedin['username']."')";
    //echo $sql_insert."<br>";
    */
    
    $sql_insert = "INSERT INTO `gx_invoice_reaktivasi_customer`(`id`, `nama_pelanggan`, `kode_customer`, `periode_tagihan`, `tanggal_tagihan`, `kode_invoice`, `kode_reaktivasi`, `tanggal_aktivasi`, `tanggal_jatuh_tempo`, `npwp`, `no_virtual_account_bca`, `nama_virtual_account`, `no_faktur_pajak`, `note`, `monthly_fee`, `reaktivasi_invoice`, `total_invoice`, `ppn_invoice`, `grand_total_invoice`, `uang_muka_invoice`, `sisa_invoice`, `prepared_by`, `printed_by`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'".$nama_pelanggan."','".$kode_customer."','".$periode_tagihan."','".$tanggal_tagihan."','".$kode_invoice."','".$kode_reaktivasi."','".$tanggal_aktivasi."','".$tanggal_jatuh_tempo."','".$npwp."','".$no_virtual_account_bca."','".$nama_virtual_account."','".$no_faktur_pajak."','".$note."','".$monthly_fee."','".$reaktivasi_invoice."','".$total_invoice."','".$ppn_invoice."','".$grand_total_invoice."','".$uang_muka_invoice."','".$sisa_invoice."','".$prepared_by."','".$printed_by."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
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
    
}elseif(isset($_POST["update"]))
{
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    $id 						= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 							= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    
    $nama_pelanggan							= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $periode_tagihan							= isset($_POST['periode_tagihan']) ? mysql_real_escape_string(trim($_POST['periode_tagihan'])) : '';
    $kode_customer							= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $tanggal_tagihan							= isset($_POST['tanggal_tagihan']) ? mysql_real_escape_string(trim($_POST['tanggal_tagihan'])) : '';
    $kode_invoice							= isset($_POST['kode_invoice']) ? mysql_real_escape_string(trim($_POST['kode_invoice'])) : '';
    $kode_reaktivasi							= isset($_POST['kode_reaktivasi']) ? mysql_real_escape_string(trim($_POST['kode_reaktivasi'])) : '';
    $tanggal_aktivasi							= isset($_POST['tanggal_r']) ? mysql_real_escape_string(trim($_POST['tanggal_r'])) : '';
    
    $tanggal_jatuh_tempo						= isset($_POST['tanggal_jatuh_tempo']) ? mysql_real_escape_string(trim($_POST['tanggal_jatuh_tempo'])) : '';
    $npwp								= isset($_POST['npwp']) ? mysql_real_escape_string(trim($_POST['npwp'])) : '';
    $no_virtual_account_bca						= isset($_POST['no_virtual_account_bca']) ? mysql_real_escape_string(trim($_POST['no_virtual_account_bca'])) : '';
    $nama_virtual_account						= isset($_POST['nama_virtual_account']) ? mysql_real_escape_string(trim($_POST['nama_virtual_account'])) : '';
    $note								= isset($_POST['note']) ? mysql_real_escape_string(trim($_POST['note'])) : '';
    $monthly_fee							= isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $no_faktur_pajak							= isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
    
    $exp_tanggal_aktivasi   						= explode("-", $tanggal_aktivasi);
    $day_aktivasi							= $exp_tanggal_aktivasi[2];
    $month_aktivasi							= $exp_tanggal_aktivasi[1];
    $year_aktivasi							= $exp_tanggal_aktivasi[0];
    $jumlah_hari 							= cal_days_in_month(CAL_GREGORIAN, $month_aktivasi, $year_aktivasi); 
    $tagihan_per_hari 							= $monthly_fee / $jumlah_hari;
    $jumlah_hari_aktivasi						= (mktime("0", "0", "0", $month_aktivasi, $jumlah_hari, $year_aktivasi) - mktime("0", "0", "0", $month_aktivasi, $day_aktivasi, $year_aktivasi)) / (60*60*24);
    $total_tagihan_prorate						= $jumlah_hari_aktivasi * ( $monthly_fee / $jumlah_hari);
    $ppn								= 0.1 * $total_tagihan_prorate;
    $total_tagihan_plus_ppn						= $total_tagihan_prorate + $ppn;
    
    $reaktivasi_invoice							= $total_tagihan_prorate;
    $total_invoice							= $reaktivasi_invoice;
    $ppn_invoice							= $ppn;
    $grand_total_invoice						= $total_tagihan_plus_ppn;
    $uang_muka_invoice							= 0;
    $sisa_invoice							= $grand_total_invoice - $uang_muka_invoice;
    
   /*
    $reaktivasi_invoice							= isset($_POST['reaktivasi_invoice']) ? mysql_real_escape_string(trim($_POST['reaktivasi_invoice'])) : '';
    $total_invoice							= isset($_POST['total_invoice']) ? mysql_real_escape_string(trim($_POST['total_invoice'])) : '';
    $no_faktur_pajak							= isset($_POST['no_faktur_pajak']) ? mysql_real_escape_string(trim($_POST['no_faktur_pajak'])) : '';
    $ppn_invoice							= isset($_POST['ppn_invoice']) ? mysql_real_escape_string(trim($_POST['ppn_invoice'])) : '';
    $grand_total_invoice						= isset($_POST['grand_total_invoice']) ? mysql_real_escape_string(trim($_POST['grand_total_invoice'])) : '';
    $uang_muka_invoice							= isset($_POST['uang_muka_invoice']) ? mysql_real_escape_string(trim($_POST['uang_muka_invoice'])) : '';
    $sisa_invoice							= isset($_POST['sisa_invoice']) ? mysql_real_escape_string(trim($_POST['sisa_invoice'])) : '';
    */
    $prepared_by							= isset($_POST['prepared_by']) ? mysql_real_escape_string(trim($_POST['prepared_by'])) : '';
    $printed_by								= isset($_POST['printed_by']) ? mysql_real_escape_string(trim($_POST['printed_by'])) : '';
    
    
    if($c != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_reaktivasi_customer` WHERE `kode_reaktivasi`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	
	
	/*	
	$sql_update = "UPDATE `gx_reaktivasi_customer` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_reaktivasi`='".$c."'";
	$sql_update_file = "UPDATE `gx_reaktivasi_customer_image_email` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE `kode_reaktivasi`='".$c."'";
	*/
	
	$sql_update = "UPDATE `gx_invoice_reaktivasi_customer` SET `date_upd`=NOW(),`level`='1',`user_upd`='".$loggedin['username']."' WHERE  `kode_invoice`='".$c."'";
	
	$sql_insert = "INSERT INTO `gx_invoice_reaktivasi_customer`(`id`, `nama_pelanggan`, `kode_customer`, `periode_tagihan`, `tanggal_tagihan`, `kode_invoice`, `kode_reaktivasi`, `tanggal_aktivasi`, `tanggal_jatuh_tempo`, `npwp`, `no_virtual_account_bca`, `nama_virtual_account`, `no_faktur_pajak`, `note`, `monthly_fee`, `reaktivasi_invoice`, `total_invoice`, `ppn_invoice`, `grand_total_invoice`, `uang_muka_invoice`, `sisa_invoice`, `prepared_by`, `printed_by`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'".$nama_pelanggan."','".$kode_customer."','".$periode_tagihan."','".$tanggal_tagihan."','".$kode_invoice."','".$kode_reaktivasi."','".$tanggal_aktivasi."','".$tanggal_jatuh_tempo."','".$npwp."','".$no_virtual_account_bca."','".$nama_virtual_account."','".$no_faktur_pajak."','".$note."','".$monthly_fee."','".$reaktivasi_invoice."','".$total_invoice."','".$ppn_invoice."','".$grand_total_invoice."','".$uang_muka_invoice."','".$sisa_invoice."','".$prepared_by."','".$printed_by."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	//echo $sql_insert."<br>";

	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
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
				    
				    
                                       <!--
					kode_cabang
					nama_cabang
					tanggal_r
					kode_reaktivasi
					kode_customer
					nama_customer
					user_id
					no_inactive
					status_inactive
					remarks
					kode_cso
					request
					no_formulir
					-->
					<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="nama_cabang" value="'.(isset($_GET['c']) ? '' : '').'">
					<!--<input type="hidden" class="form-control" name="tanggal_r" value="'.(isset($_GET['c']) ? '' : '').'">-->
					<input type="hidden" class="form-control" name="user_id" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="no_inactive" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="status_inactive" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="remarks" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="kode_cso" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="request" value="'.(isset($_GET['c']) ? '' : '').'">
					<input type="hidden" class="form-control" name="no_formulir" value="'.(isset($_GET['c']) ? '' : '').'">
					    
							       
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Reaktivasi</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_reaktivasi" onclick="return valideopenerform(\'data_reaktivasi.php?r=form_invoice_reaktivasi&f=data_reaktivasi\',\'reaktivasi\');" value="'.(isset($_GET['c']) ? $row["kode_reaktivasi"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>No Invoice</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text" class="form-control" required="" name="kode_invoice" value="'.(isset($_GET['c']) ? $row["kode_invoice"] : "INR-".rand(0000000, 9999999)).'">
					    </div>
                                        </div>
					</div>
					   
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Pelanggan</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text"  class="form-control" name="nama_customer" value="'.(isset($_GET['c']) ? $row["nama_pelanggan"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Periode Tagihan</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="periode_tagihan" value="'.(isset($_GET['c']) ? $row["periode_tagihan"] : '').'">
					    </div>
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-4">
						<input readonly="" type="text"  class="form-control" name="kode_customer" value="'.(isset($_GET['c']) ? $row["kode_customer"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal Tagihan</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="tanggal_tagihan" value="'.(isset($_GET['c']) ? $row["tanggal_tagihan"] : '').'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tanggal Jatuh Tempo</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="tanggal_jatuh_tempo" value="'.(isset($_GET['c']) ? $row["tanggal_jatuh_tempo"] :  date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+3, date("Y")))).'">
					    </div>

					    <div class="col-xs-2">
						<label>NPWP</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text"  class="form-control" name="npwp" value="'.(isset($_GET['c']) ? $row["npwp"] : '').'" >
					    </div>
                                        </div>
					</div>
					

					<div class="form-group">
					
					<div class="row">
					    <div class="col-xs-2">
						    <label>No Virtual Account BCA</label>
					    </div>
					    <div class="col-xs-4">
						    <input type="text" class="form-control" name="no_virtual_account_bca" value="'.(isset($_GET['c']) ? $row["no_virtual_account_bca"] : '').'">
					    </div>
					    
					    <div class="col-xs-2">
						    <label>No Faktur Pajak</label>
					    </div>
					    <div class="col-xs-4">
						    <input type="text" class="form-control" name="no_faktur_pajak" value="'.(isset($_GET['c']) ? $row["no_faktur_pajak"] : '').'">
					    </div>
					</div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Virtual Account</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="nama_virtual_account" value="'.(isset($_GET['c']) ? $row["nama_virtual_account"] : '').'">
					    </div>

					    <div class="col-xs-2">
						<label>Note</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="note" value="'.(isset($_GET['c']) ? $row["note"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="monthly_fee" value="'.(isset($_GET['c']) ? $row["monthly_fee"] : '').'">
					    </div>

					    <div class="col-xs-2">
						<label>Tanggal Aktivasi</label>
					    </div>
					    <div class="col-xs-4">
						<!--<input type="text" readonly="" class="form-control" name="tanggal_aktivasi" value="'.(isset($_GET['c']) ? "row[tanggal_aktivasi]" : '').'">-->
						<input type="text" readonly="" class="form-control" name="tanggal_r" value="'.(isset($_GET['c']) ? $row["tanggal_aktivasi"] : '').'">
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