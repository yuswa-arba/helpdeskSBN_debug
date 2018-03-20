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
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data	= "SELECT * FROM `gx_aktivasi_add_on` WHERE `id_aktivasi_add_on`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
   
    $sql_cabang    = mysql_query("SELECT * FROM `gx_cabang` WHERE `gx_cabang`.`id_cabang` = '$row_data[kode_cabang]';", $conn);
    $row_cabang    = mysql_fetch_array($sql_cabang);
	
	$hari	=$row_data["tanggal"];
	$e1 = explode("-", $hari);
	$tgl = $e1[2];
	$bln = $e1[1];
	$thn = $e1[0];
	
	$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
    $hari_ini	= $tgl;
	$sum_aktivasi_sd_akhirbulan 	= $jumlah_hari - $hari_ini; //baru
	$total_hari_pengurangan 		= $jumlah_hari - $sum_aktivasi_sd_akhirbulan; //lama

	
	//Invoice Baru
    $sql_paket_baru    = mysql_query("SELECT * FROM `gx_paket2` WHERE `gx_paket2`.`kode_paket` = '$row_data[kode_paket]';", $conn);
    $row_paket_baru	   = mysql_fetch_array($sql_paket_baru);

	$tagihanperhari_baru  	= $row_paket_baru["monthly_fee"] / $jumlah_hari;
	$total_tagihan_baru		= $sum_aktivasi_sd_akhirbulan * $tagihanperhari_baru;
	$ppn_baru				= 10/100 * $total_tagihan_baru;
	$totalppn_baru			= $total_tagihan_baru + $ppn_baru;
	//---------------//
	$data_aktivasi_add_on_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_data[id_teknisi]'", $conn));
	$data_aktivasi_add_on_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_data[id_marketing]'", $conn));
	
}

    $content ='<section class="content-header">
                    <h1>
                        Form Aktivasi Add On
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Aktivasi Add On</h3>
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
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=aktivasi_add_on\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Aktivasi Konversi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_aktivasi_add_on" name="kode_aktivasi_add_on" required="" value="'.(isset($_GET['id']) ? $row_data["kode_aktivasi_add_on"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_data["kode_customer"] : "").'" onclick="return valideopenerform(\'data_spk_jawab_aktivasi_add_on.php?r=myForm&f=aktivasi_add_on\',\'customer\');" >
											</div>
										</div>
										</div> 
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_data["nama_customer"] : "").'">
											</div>
															
											<div class="col-xs-3">
												<label>No Link Budget</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="no_linkbudget" value="'.(isset($_GET['id']) ? $row_data["uid"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Koneksi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket" value="'.(isset($_GET['id']) ? $row_data["kode_paket"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket" value="'.(isset($_GET['id']) ? $row_data["nama_paket"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>UID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_data["uid"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Telp</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="telp" value="'.(isset($_GET['id']) ? $row_data["telp"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alamat" readonly="" class="form-control" placeholder="Alamat" style="resize: none;"> '.(isset($_GET["id"]) ? $row_data['alamat'] :"").' </textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Teknisi Aktivasi</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="id_teknisi" type="hidden" value="'.(isset($_GET["id"]) ? $row_data['id_teknisi'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET["id"]) ? $data_aktivasi_add_on_teknisi['cNama'] :"") .'">
												
											</div>
											<div class="col-xs-3">
											  <label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="id_marketing" type="hidden" value="'.(isset($_GET["id"]) ? $row_data['id_marketing'] :"") .'">
												<input class="form-control" readonly="" name="nama_marketing" placeholder="Nama Marketing" type="text" value="'.(isset($_GET["id"]) ? $data_aktivasi_add_on_marketing['cNama'] :"") .'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>IP Customer</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="ip_customer" placeholder="IP Customer" type="text" value="'.(isset($_GET["id"]) ? $row_data['ip_customer'] :"") .'">
												
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
											<div class="col-xs-3">
												<label>Monthly Fee</label>
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
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Lates Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
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
    $kode_aktivasi_add_on 	= isset($_POST['kode_aktivasi_add_on']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi_add_on'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $no_linkbudget 			= isset($_POST['no_linkbudget']) ? mysql_real_escape_string(trim($_POST['no_linkbudget'])) : '';
	$kode_paket				= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket				= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    $telp	    			= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
	$alamat	    			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$id_teknisi	   			= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
	$id_marketing  			= isset($_POST['id_marketing']) ? mysql_real_escape_string(trim($_POST['id_marketing'])) : '';

	$ip_customer  			= isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';
	
	$totalppn_baru2	    	= isset($_POST['totalppn_baru']) ?  str_replace(",", "", $_POST['totalppn_baru']) : '';
	if($nama_cabang != "" && $kode_aktivasi_add_on != "" && $nama_customer != "" && $no_linkbudget != ""){
    $sql_insert = "INSERT INTO `gx_aktivasi_add_on` (`id_aktivasi_add_on`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_aktivasi_add_on`, `kode_customer`, `nama_customer`, `no_linkbudget`, `kode_paket`,
						  `nama_paket`, `uid`, `telp`, `alamat`, `id_teknisi`, `id_marketing`, `ip_customer`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_aktivasi_add_on."', '".$kode_customer."', '".$nama_customer."', '".$no_linkbudget."', '".$kode_paket."',
						  '".$nama_paket."', '".$uid."', '".$telp."', '".$alamat."', '".$id_teknisi."', '".$id_marketing."', '".$ip_customer."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	//|INSERT INVOICE|//
	$row_tbcustomer  = mysql_fetch_array(mysql_query("SELECT * FROM `tbCustomer` WHERE `cKode` = '".$kode_customer."'  ORDER BY `idCustomer` DESC", $conn));
	
	$row_invoice  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_invoice` ORDER BY `id_invoice` DESC", $conn));
	$last_data_invoice  	= $row_invoice["id_invoice"] + 1;
	
    $row_cabang  = mysql_fetch_array(mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$kode_cabang."'  ORDER BY `id_cabang` DESC", $conn));
	$tanggal_invoice    = date("d");
	
	$kode_invoice = $row_cabang["kode_cabang"].'-'.$row_cabang["invoice_code"].''.$tanggal_invoice.''.sprintf("%04d", $last_data_invoice);
	
	$sql_insert_invoice = "INSERT INTO `gx_invoice` (`id_invoice`, `id_cabang`,
						  `kode_aktivasi_add_on`, `kode_invoice`, `title`, `customer_number`, `nama_customer`,
						  `npwp`, `note`, `tanggal_tagihan`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."',
						  '".$kode_aktivasi_add_on."', '".$kode_invoice."', 'Invoice Aktivasi Add On', '".$kode_customer."', '".$nama_customer."',
						  '".$row_tbcustomer["no_npwp"]."', '', NOW(),
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo '<br/>'.$sql_insert_invoice;
    mysql_query($sql_insert_invoice, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	
	$sql_insert_invoice_detail_baru = "INSERT INTO `gx_invoice_detail` (`id_invoice_detail`, `kode_invoice`,
						  `date`, `harga`, `jumlah`, `id_paket`, `periode`,
						  `desc`, `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_invoice."',
						  NOW(), '".$totalppn_baru2."', '', '".$kode_paket."', '',
						  'Invoice Add On', '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo '<br/>'.$sql_insert_invoice_detail_baru;
    mysql_query($sql_insert_invoice_detail_baru, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."add_on/master_aktivasi_add_on.php';
			</script>";
			
    }else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    //echo "update";
   $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_aktivasi_add_on 	= isset($_POST['kode_aktivasi_add_on']) ? mysql_real_escape_string(trim($_POST['kode_aktivasi_add_on'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $no_linkbudget 			= isset($_POST['no_linkbudget']) ? mysql_real_escape_string(trim($_POST['no_linkbudget'])) : '';
	$kode_paket				= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket				= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
    $telp	    			= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
	$alamat	    			= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$id_teknisi	   			= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
	$id_marketing  			= isset($_POST['id_marketing']) ? mysql_real_escape_string(trim($_POST['id_marketing'])) : '';

	$ip_customer  			= isset($_POST['ip_customer']) ? mysql_real_escape_string(trim($_POST['ip_customer'])) : '';
	
	$totalppn_baru2	    	= isset($_POST['totalppn_baru']) ?  str_replace(",", "", $_POST['totalppn_baru']) : '';
	
    $sql_update = "UPDATE `gx_aktivasi_add_on` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_aktivasi_add_on` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	
	$sql_insert_update = "INSERT INTO `gx_aktivasi_add_on` (`id_aktivasi_add_on`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_aktivasi_add_on`, `kode_customer`, `nama_customer`, `no_linkbudget`, `kode_paket`,
						  `nama_paket`, `uid`, `telp`, `alamat`, `id_teknisi`, `id_marketing`, `ip_customer`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_aktivasi_add_on."', '".$kode_customer."', '".$nama_customer."', '".$no_linkbudget."', '".$kode_paket."',
						  '".$nama_paket."', '".$uid."', '".$telp."', '".$alamat."', '".$id_teknisi."', '".$id_marketing."', '".$ip_customer."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
						  
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."add_on/master_aktivasi_add_on.php';
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
		
		';

    $title	= 'Form Aktivasi Add On';
    $submenu	= "aktivasi_add_on";
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