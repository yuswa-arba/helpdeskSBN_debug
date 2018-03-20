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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Penawaran");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_penawaran` WHERE `id_penawaran`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Form Penawaran
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Penawaran</h3>
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
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=penawaran\',\'cabang\');">';
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
												<label>No Penawaran</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_penawaran" name="kode_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["kode_penawaran"] : "").'" >
											</div>
											<div class="col-xs-3">
												<label>No Prospek</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_prospek" name="kode_prospek" required="" value="'.(isset($_GET['id']) ? $row_data["kode_prospek"] : "").'" onclick="return valideopenerform(\'data_prospek.php?r=myForm&f=penawaran\',\'prospek\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_data["kode_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="marketing" name="marketing" required="" value="'.(isset($_GET['id']) ? $row_data["marketing"] : "").'">
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
												<label>Alamat Perusahaan</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" required="" value="'.(isset($_GET['id']) ? $row_data["alamat_perusahaan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kelurahan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kelurahan" name="kelurahan" required="" value="'.(isset($_GET['id']) ? $row_data["kelurahan"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kecamatan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kecamatan" name="kecamatan" required="" value="'.(isset($_GET['id']) ? $row_data["kecamatan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kota</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kota" name="kota" required="" value="'.(isset($_GET['id']) ? $row_data["kota"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Pos</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_pos" name="kode_pos" required="" value="'.(isset($_GET['id']) ? $row_data["kode_pos"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Telp</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="telp" name="telp" required="" value="'.(isset($_GET['id']) ? $row_data["no_telp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No HP 1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp1" name="no_hp1" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No HP 2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp2" name="no_hp2" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Contact Person</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="contact_person" name="contact_person" required="" value="'.(isset($_GET['id']) ? $row_data["contact_person"] : "").'">
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
												<label>Jangka Waktu Penawaran</label>
											</div>
											<div class="col-xs-1">
												<input type="text" class="form-control" id="jangka_waktu_penawaran" name="jangka_waktu_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["jangka_waktu_penawaran"] : "").'">
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
    $kode_penawaran		= isset($_POST['kode_penawaran']) ? mysql_real_escape_string(trim($_POST['kode_penawaran'])) : '';
	$kode_prospek		= isset($_POST['kode_prospek']) ? mysql_real_escape_string(trim($_POST['kode_prospek'])) : '';
	$kode_customer	 	= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $marketing			= isset($_POST['marketing']) ? mysql_real_escape_string(trim($_POST['marketing'])) : '';
    $nama_customer		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$alamat		  	 	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$alamat_perusahaan  = isset($_POST['alamat_perusahaan']) ? mysql_real_escape_string(trim($_POST['alamat_perusahaan'])) : '';
	$kelurahan    		= isset($_POST['kelurahan']) ? mysql_real_escape_string(trim($_POST['kelurahan'])) : '';
    $kecamatan			= isset($_POST['kecamatan']) ? mysql_real_escape_string(trim($_POST['kecamatan'])) : '';
	$kota				= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$kode_pos		 	= isset($_POST['kode_pos']) ? mysql_real_escape_string(trim($_POST['kode_pos'])) : '';
    $telp				= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $no_hp1				= isset($_POST['no_hp1']) ? mysql_real_escape_string(trim($_POST['no_hp1'])) : '';
	$no_hp2    			= isset($_POST['no_hp2']) ? mysql_real_escape_string(trim($_POST['no_hp2'])) : '';
    $contact_person		= isset($_POST['contact_person']) ? mysql_real_escape_string(trim($_POST['contact_person'])) : '';
	$email				= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
	$jangka_waktu_penawaran	 	= isset($_POST['jangka_waktu_penawaran']) ? mysql_real_escape_string(trim($_POST['jangka_waktu_penawaran'])) : '';
    $jasa				= isset($_POST['jasa']) ? mysql_real_escape_string(trim($_POST['jasa'])) : '';
    $kode_paket			= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket			= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
	$setup_fee			= isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
	$abonemen		 	= isset($_POST['abonemen']) ? mysql_real_escape_string(trim($_POST['abonemen'])) : '';
    $monthly_fee		= isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$kode_brosur		= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	
	$sql_insert = "INSERT INTO `gx_penawaran` (`id_penawaran`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_penawaran`, `kode_prospek`, `kode_customer`, `marketing`, `nama_customer`, `alamat`,
						  `alamat_perusahaan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp1`,
						  `no_hp2`, `contact_person`, `email`, `jangka_waktu_penawaran`, `jasa`, `kode_paket`, `nama_paket`,
						  `setup_fee`, `abonemen`, `monthly_fee`, `keterangan`, `kode_brosur`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_penawaran."', '".$kode_prospek."', '".$kode_customer."', '".$marketing."', '".$nama_customer."', '".$alamat."',
						  '".$alamat_perusahaan."', '".$kelurahan."', '".$kecamatan."', '".$kota."', '".$kode_pos."', '".$telp."', '".$no_hp1."',
						  '".$no_hp2."', '".$contact_person."', '".$email."', '".$jangka_waktu_penawaran."', '".$jasa."', '".$kode_paket."', '".$nama_paket."',
						  '".$setup_fee."', '".$abonemen."', '".$monthly_fee."', '".$keterangan."', '".$kode_brosur."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."penawaran/form_penawaran_detail.php?c=$kode_penawaran';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang   		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_penawaran		= isset($_POST['kode_penawaran']) ? mysql_real_escape_string(trim($_POST['kode_penawaran'])) : '';
	$kode_prospek		= isset($_POST['kode_prospek']) ? mysql_real_escape_string(trim($_POST['kode_prospek'])) : '';
	$kode_customer	 	= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $marketing			= isset($_POST['marketing']) ? mysql_real_escape_string(trim($_POST['marketing'])) : '';
    $nama_customer		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
	$alamat		  	 	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$alamat_perusahaan  = isset($_POST['alamat_perusahaan']) ? mysql_real_escape_string(trim($_POST['alamat_perusahaan'])) : '';
	$kelurahan    		= isset($_POST['kelurahan']) ? mysql_real_escape_string(trim($_POST['kelurahan'])) : '';
    $kecamatan			= isset($_POST['kecamatan']) ? mysql_real_escape_string(trim($_POST['kecamatan'])) : '';
	$kota				= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$kode_pos		 	= isset($_POST['kode_pos']) ? mysql_real_escape_string(trim($_POST['kode_pos'])) : '';
    $telp				= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $no_hp1				= isset($_POST['no_hp1']) ? mysql_real_escape_string(trim($_POST['no_hp1'])) : '';
	$no_hp2    			= isset($_POST['no_hp2']) ? mysql_real_escape_string(trim($_POST['no_hp2'])) : '';
    $contact_person		= isset($_POST['contact_person']) ? mysql_real_escape_string(trim($_POST['contact_person'])) : '';
	$email				= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
	$jangka_waktu_penawaran	 	= isset($_POST['jangka_waktu_penawaran']) ? mysql_real_escape_string(trim($_POST['jangka_waktu_penawaran'])) : '';
    $jasa				= isset($_POST['jasa']) ? mysql_real_escape_string(trim($_POST['jasa'])) : '';
    $kode_paket			= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket			= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
	$setup_fee			= isset($_POST['setup_fee']) ? mysql_real_escape_string(trim($_POST['setup_fee'])) : '';
	$abonemen		 	= isset($_POST['abonemen']) ? mysql_real_escape_string(trim($_POST['abonemen'])) : '';
    $monthly_fee		= isset($_POST['monthly_fee']) ? mysql_real_escape_string(trim($_POST['monthly_fee'])) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$kode_brosur		= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	
    $sql_update = "UPDATE `gx_penawaran` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_penawaran` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_penawaran` (`id_penawaran`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_penawaran`, `kode_prospek`, `kode_customer`, `marketing`, `nama_customer`, `alamat`,
						  `alamat_perusahaan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp1`,
						  `no_hp2`, `contact_person`, `email`, `jangka_waktu_penawaran`, `jasa`, `kode_paket`, `nama_paket`,
						  `setup_fee`, `abonemen`, `monthly_fee`, `keterangan`, `kode_brosur`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_penawaran."', '".$kode_prospek."', '".$kode_customer."', '".$marketing."', '".$nama_customer."', '".$alamat."',
						  '".$alamat_perusahaan."', '".$kelurahan."', '".$kecamatan."', '".$kota."', '".$kode_pos."', '".$telp."', '".$no_hp1."',
						  '".$no_hp2."', '".$contact_person."', '".$email."', '".$jangka_waktu_penawaran."', '".$jasa."', '".$kode_paket."', '".$nama_paket."',
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
			window.location.href='".URL_ADMIN."penawaran/form_penawaran_detail.php?c=$kode_penawaran';
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

    $title	= 'Form Penawaran';
    $submenu	= "penawaran";
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