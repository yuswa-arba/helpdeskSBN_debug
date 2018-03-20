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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Proforma Invoice");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_proforma_invoice` WHERE `id_proforma`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Form Peroforma Invoice
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Peroforma Invoice</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">';
											if(isset($_GET["id"])){
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">';
											}else{
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=proforma\',\'cabang\');">';
											}
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Proforma Invoice</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_proforma" name="kode_proforma" required="" value="'.(isset($_GET['id']) ? $row_data["kode_proforma"] : "").'" >
											</div>
											<div class="col-xs-3">
												<label>No Penawaran</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_penawaran" name="kode_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["kode_penawaran"] : "").'" onclick="return valideopenerform(\'data_penawaran.php?r=myForm&f=proforma\',\'penawaran\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_customer" name="nama_customer" required="" value="'.(isset($_GET['id']) ? $row_data["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="alamat" name="alamat" required="" value="'.(isset($_GET['id']) ? $row_data["alamat"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kota</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="kota" name="kota" required="" value="'.(isset($_GET['id']) ? $row_data["kota"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Telp</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="telp" name="telp" required="" value="'.(isset($_GET['id']) ? $row_data["telp"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>HP</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="hp" name="hp" required="" value="'.(isset($_GET['id']) ? $row_data["hp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Email</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="email" name="email" required="" value="'.(isset($_GET['id']) ? $row_data["email"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Bank</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="nama_bank" name="nama_bank" required="" value="'.(isset($_GET['id']) ? $row_data["nama_bank"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat Bank</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="alamat_bank" name="alamat_bank" required="" value="'.(isset($_GET['id']) ? $row_data["alamat_bank"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kota</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="kota_bank" name="kota_bank" required="" value="'.(isset($_GET['id']) ? $row_data["kota_bank"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Account Name</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="account_name" name="account_name" required="" value="'.(isset($_GET['id']) ? $row_data["account_name"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Account Number</label>
											</div>
											<div class="col-xs-9">
												<input type="text class="form-control" id="account_number" name="account_number" required="" value="'.(isset($_GET['id']) ? $row_data["account_number"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jangka Waktu Pembayaran</label>
											</div>
											<div class="col-xs-1">
												<input type="text" class="form-control" id="jangka_waktu_pembayaran" name="jangka_waktu_pembayaran" required="" value="'.(isset($_GET['id']) ? $row_data["jangka_waktu_pembayaran"] : "").'">
											</div>
											<div class="col-xs-1">
												<label>Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jasa</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" name="jasa" type="radio" value="Internet" '.((isset($_GET['id']) && ($row_data["jasa"]) == "Internet" ) ? "checked" : "").' style="position: absolute; opacity: 0;"> Internet
												<input class="form-control" name="jasa" type="radio" value="VOIP" '.((isset($_GET['id']) && ($row_data["jasa"]) == "VOIP" ) ? "checked" : "").' style="position: absolute; opacity: 0;"> VOIP
												<input class="form-control" name="jasa" type="radio" value="VOD" '.((isset($_GET['id']) && ($row_data["jasa"]) == "VOD" ) ? "checked" : "").' style="position: absolute; opacity: 0;"> VOD
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket" name="kode_paket" required="" value="'.(isset($_GET['id']) ? $row_data["kode_paket"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket" name="nama_paket" required="" value="'.(isset($_GET['id']) ? $row_data["nama_paket"] : "").'" onclick="return valideopenerform(\'data_paket.php?r=myForm&f=penawaran\',\'paket\');">
											</div>
											<div class="col-xs-3">
												<label>Setup Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="setup_fee" name="setup_fee" required="" value="'.(isset($_GET['id']) ? $row_data["setup_fee"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Abonemen</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="abonemen" name="abonemen" required="" value="'.(isset($_GET['id']) ? $row_data["abonemen"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="monthly_fee" name="monthly_fee" required="" value="'.(isset($_GET['id']) ? $row_data["monthly_fee"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>keterangan</label>
											</div>
											<div class="col-xs-9">
												<textarea name="keterangan" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['id']) ? $row_data['keterangan'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Brosur</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="kode_brosur" name="kode_brosur" required="" value="'.(isset($_GET['id']) ? $row_data["kode_brosur"] : "").'"  onclick="return valideopenerform(\'data_brosur.php?r=myForm&f=penawaran\',\'brosur\');">
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
												<label>Latest Update By </label>
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
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang   		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_proforma		= isset($_POST['kode_proforma']) ? mysql_real_escape_string(trim($_POST['kode_proforma'])) : '';
	$kode_penawaran		= isset($_POST['kode_penawaran']) ? mysql_real_escape_string(trim($_POST['kode_penawaran'])) : '';
	$nama_customer		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$alamat		  	 	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$kota				= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$telp				= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $hp					= isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : '';
	$email				= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
	$nama_bank	  	 	= isset($_POST['nama_bank']) ? mysql_real_escape_string(trim($_POST['nama_bank'])) : '';
	$alamat_bank		= isset($_POST['alamat_bank']) ? mysql_real_escape_string(trim($_POST['alamat_bank'])) : '';
	$kota_bank			= isset($_POST['kota_bank']) ? mysql_real_escape_string(trim($_POST['kota_bank'])) : '';
    $account_name		= isset($_POST['account_name']) ? mysql_real_escape_string(trim($_POST['account_name'])) : '';
	$account_number		= isset($_POST['account_number']) ? mysql_real_escape_string(trim($_POST['account_number'])) : '';
	$jangka_waktu_pembayaran	 	= isset($_POST['jangka_waktu_pembayaran']) ? mysql_real_escape_string(trim($_POST['jangka_waktu_pembayaran'])) : '';
    $jasa				= isset($_POST['jasa']) ? mysql_real_escape_string(trim($_POST['jasa'])) : '';
    $kode_paket			= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket			= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
	$setup_fee			= isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
	$abonemen		 	= isset($_POST['abonemen']) ? mysql_real_escape_string(trim($_POST['abonemen'])) : '';
    $monthly_fee		= isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$kode_brosur		= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	
	$sql_insert = "INSERT INTO `gx_proforma_invoice` (`id_proforma`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_proforma`, `kode_penawaran`, `nama_customer`, `alamat`,
						  `kota`, `telp`, `hp`, `email`, `nama_bank`, `alamat_bank`, `kota_bank`,
						  `account_name`, `account_number`, `jangka_waktu_pembayaran`, `jasa`, `kode_paket`, `nama_paket`,
						  `setup_fee`, `abonemen`, `monthly_fee`, `keterangan`, `kode_brosur`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_proforma."', '".$kode_penawaran."', '".$nama_customer."', '".$alamat."',
						  '".$kota."', '".$telp."', '".$hp."', '".$email."','".$nama_bank."', '".$alamat_bank."', '".$kota_bank."',
						  '".$account_name."', '".$account_number."', '".$jangka_waktu_pembayaran."', '".$jasa."', '".$kode_paket."', '".$nama_paket."',
						  '".$setup_fee."', '".$abonemen."', '".$monthly_fee."', '".$keterangan."', '".$kode_brosur."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    //echo $sql_insert;
	$query_data		= "SELECT * FROM `gx_proforma_invoice_detail` WHERE `kode_proforma`='$kode_proforma' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
	 while($row_data	= mysql_fetch_array($sql_data)){
   
    $sql_insert_detail = "INSERT INTO `gx_proforma_invoice_detail` (`id_proforma_detail`, `kode_proforma`, `kode`,
						    `keterangan`, `quantity`, `price`, `amount`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_proforma."', '".$row_data["kode"]."',
						    '".$row_data_detail["keterangan"]."', '".$row_data_detail["quantity"]."', '".$row_data_detail["price"]."', '".$row_data_detail["amount"]."',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '".$row_data_detail["level"]."');";
    
    //echo $sql_insert_detail."<br>".$deviasi."<br>";
      echo mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    }
	
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."penawaran/form_proforma_invoice_detail.php?c=$kode_proforma';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang   		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_proforma		= isset($_POST['kode_proforma']) ? mysql_real_escape_string(trim($_POST['kode_proforma'])) : '';
	$kode_penawaran		= isset($_POST['kode_penawaran']) ? mysql_real_escape_string(trim($_POST['kode_penawaran'])) : '';
	$nama_customer		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$alamat		  	 	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$kota				= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$telp				= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $hp					= isset($_POST['hp']) ? mysql_real_escape_string(trim($_POST['hp'])) : '';
	$email				= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
	$nama_bank	  	 	= isset($_POST['nama_bank']) ? mysql_real_escape_string(trim($_POST['nama_bank'])) : '';
	$alamat_bank		= isset($_POST['alamat_bank']) ? mysql_real_escape_string(trim($_POST['alamat_bank'])) : '';
	$kota_bank			= isset($_POST['kota_bank']) ? mysql_real_escape_string(trim($_POST['kota_bank'])) : '';
    $account_name		= isset($_POST['account_name']) ? mysql_real_escape_string(trim($_POST['account_name'])) : '';
	$account_number		= isset($_POST['account_number']) ? mysql_real_escape_string(trim($_POST['account_number'])) : '';
	$jangka_waktu_pembayaran	 	= isset($_POST['jangka_waktu_pembayaran']) ? mysql_real_escape_string(trim($_POST['jangka_waktu_pembayaran'])) : '';
    $jasa				= isset($_POST['jasa']) ? mysql_real_escape_string(trim($_POST['jasa'])) : '';
    $kode_paket			= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket			= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
	$setup_fee			= isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
	$abonemen		 	= isset($_POST['abonemen']) ? mysql_real_escape_string(trim($_POST['abonemen'])) : '';
    $monthly_fee		= isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$kode_brosur		= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	
    $sql_update = "UPDATE `gx_proforma_invoice` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_proforma` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_proforma_invoice` (`id_proforma`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_proforma`, `kode_penawaran`, `nama_customer`, `alamat`,
						  `kota`, `telp`, `hp`, `email`, `nama_bank`, `alamat_bank`, `kota_bank`,
						  `account_name`, `account_number`, `jangka_waktu_pembayaran`, `jasa`, `kode_paket`, `nama_paket`,
						  `setup_fee`, `abonemen`, `monthly_fee`, `keterangan`, `kode_brosur`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_proforma."', '".$kode_penawaran."', '".$nama_customer."', '".$alamat."',
						  '".$kota."', '".$telp."', '".$hp."', '".$email."','".$nama_bank."', '".$alamat_bank."', '".$kota_bank."',
						  '".$account_name."', '".$account_number."', '".$jangka_waktu_pembayaran."', '".$jasa."', '".$kode_paket."', '".$nama_paket."',
						  '".$setup_fee."', '".$abonemen."', '".$monthly_fee."', '".$keterangan."', '".$kode_brosur."',
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
			window.location.href='".URL_ADMIN."penawaran/form_proforma_invoice_detail.php?c=$kode_proforma';
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

    $title	= 'Form Peroforma Invoice';
    $submenu	= "proforma_invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>