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
redirectToHTTPS();
if($loggedin = logged_inStaff()){ 

if($loggedin["group"] == 'staff'){
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
											$sql_cabang	= "SELECT * FROM `gx_cabang` WHERE `level` = '0' AND `id_cabang` = '".$loggedin["cabang"]."' ORDER BY `id_cabang` ASC LIMIT 0,1;";
												$query_cabang	= mysql_query($sql_cabang, $conn);
												$row_cabang = mysql_fetch_array($query_cabang);
											if(isset($_GET["id"])){
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">';
											}else{
												
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : $row_cabang["id_cabang"]).'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : $row_cabang["nama_cabang"]).'" >';
											}
											
												$sql_penawaran = mysql_fetch_array(mysql_query("SELECT * FROM `gx_penawaran` ORDER BY `id_penawaran` DESC", $conn));
												$last_data  = $sql_penawaran["id_penawaran"] + 1;
												$tanggal    = date("d");
												$kode_penawaran = $row_cabang["kode_cabang"].'-'.$tanggal.''.sprintf("%04d", $last_data);
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? date("Y-m-d H:i", strtotime($row_data["tanggal"])) : date("Y-m-d H:i")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Penawaran</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_penawaran" name="kode_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["kode_penawaran"] : $kode_penawaran).'" >
											</div>
											<div class="col-xs-3">
												<label>No Prospek</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_prospek" name="kode_prospek" required="" value="'.(isset($_GET['id']) ? $row_data["kode_prospek"] : "").'"
												onclick="return valideopenerform(\'data_prospek.php?r=myForm&f=penawaran\',\'prospek\');">
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
												<label>Nama Perusahaan</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required="" value="'.(isset($_GET['id']) ? $row_data["nama_perusahaan"] : "").'">
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
												<input type="text" maxlength="2" class="form-control" id="harga" name="jangka_waktu_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["jangka_waktu_penawaran"] : "7").'">
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
												Internet <input type="checkbox" class="form-control" name="internet" '.((isset($_GET['id']) && ($row_data["internet"]) == "1" ) ? "checked" : "").' value="1">
												VOIP <input type="checkbox" class="form-control" name="voip" '.((isset($_GET['id']) && ($row_data["voip"]) == "1" ) ? "checked" : "").' value="1">
												VOD <input type="checkbox" class="form-control" name="vod" '.((isset($_GET['id']) && ($row_data["vod"]) == "1" ) ? "checked" : "").' value="1"> 
												
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
												<input type="text" readonly="" class="form-control" id="harga" name="setup_fee" required="" value="'.(isset($_GET['id']) ? $row_data["setup_fee"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Abonemen</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="abonemen" required="" value="'.(isset($_GET['id']) ? $row_data["abonemen"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee" required="" value="'.(isset($_GET['id']) ? $row_data["monthly_fee"] : "").'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nominal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" maxlength="20" class="form-control" id="harga" name="nominal" required="" value="'.(isset($_GET['id']) ? $row_data["nominal"] : "").'">
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
												<input type="text" readonly="" class="form-control" id="kode_brosur" name="kode_brosur" required="" value="'.(isset($_GET['id']) ? $row_data["kode_brosur"] : "").'"
												onclick="return valideopenerform(\'data_brosur.php?r=myForm&f=penawaran\',\'brosur\');">
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
	$nama_perusahaan  	= isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
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
    $internet				= isset($_POST['internet']) ? mysql_real_escape_string(trim($_POST['internet'])) : '';
    $voip				= isset($_POST['voip']) ? mysql_real_escape_string(trim($_POST['voip'])) : '';
    $vod				= isset($_POST['vod']) ? mysql_real_escape_string(trim($_POST['vod'])) : '';
    $kode_paket			= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket			= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
	$setup_fee			= isset($_POST['setup_fee']) ? str_replace(',', '',$_POST['setup_fee']) : '';
	$abonemen		 	= isset($_POST['abonemen']) ? str_replace(',', '',$_POST['abonemen']) : '';
    $monthly_fee		= isset($_POST['monthly_fee']) ? str_replace(',', '',$_POST['monthly_fee']) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$kode_brosur		= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	$nominal		= isset($_POST['nominal']) ? mysql_real_escape_string(trim($_POST['nominal'])) : '';
	
	$sql_insert = "INSERT INTO `gx_penawaran` (`id_penawaran`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_penawaran`, `kode_prospek`, `kode_customer`, `marketing`, `nama_customer`, `alamat`,
						  `nama_perusahaan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp1`,
						  `no_hp2`, `contact_person`, `email`, `jangka_waktu_penawaran`, `internet`, `voip`, `vod`, `kode_paket`, `nama_paket`,
						  `setup_fee`, `abonemen`, `monthly_fee`, `nominal`, `keterangan`, `kode_brosur`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_penawaran."', '".$kode_prospek."', '".$kode_customer."', '".$marketing."', '".$nama_customer."', '".$alamat."',
						  '".$nama_perusahaan."', '".$kelurahan."', '".$kecamatan."', '".$kota."', '".$kode_pos."', '".$telp."', '".$no_hp1."',
						  '".$no_hp2."', '".$contact_person."', '".$email."', '".$jangka_waktu_penawaran."', '".$internet."', '".$voip."', '".$vod."', '".$kode_paket."', '".$nama_paket."',
						  '".$setup_fee."', '".$abonemen."', '".$monthly_fee."','".$nominal."', '".$keterangan."', '".$kode_brosur."',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    if($jangka_waktu_penawaran <= "7"){
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_STAFF."marketing/form_penawaran_detail.php?c=$kode_penawaran';
			</script>";
	}else{
		echo "<script language='JavaScript'>
			alert('Max jangka waktu penawaran 7 Hari');
			window.history.go(-1);
			  </script>";
		}
    
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
	$nama_perusahaan  = isset($_POST['nama_perusahaan']) ? mysql_real_escape_string(trim($_POST['nama_perusahaan'])) : '';
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
    $internet				= isset($_POST['internet']) ? mysql_real_escape_string(trim($_POST['internet'])) : '';
    $voip				= isset($_POST['voip']) ? mysql_real_escape_string(trim($_POST['voip'])) : '';
    $vod				= isset($_POST['vod']) ? mysql_real_escape_string(trim($_POST['vod'])) : '';
    $kode_paket			= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket			= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
	$setup_fee			= isset($_POST['setup_fee']) ? str_replace(",", "", $_POST['setup_fee']) : '';
	$abonemen		 	= isset($_POST['abonemen']) ? str_replace(",", "", $_POST['abonemen']) : '';
    $monthly_fee		= isset($_POST['monthly_fee']) ?str_replace(",", "", $_POST['monthly_fee']) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$kode_brosur		= isset($_POST['kode_brosur']) ? mysql_real_escape_string(trim($_POST['kode_brosur'])) : '';
	$nominal		= isset($_POST['nominal']) ? str_replace(",", "", $_POST['nominal']) : '';
	if($jangka_waktu_penawaran <= "7"){
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
						  `nama_perusahaan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `no_telp`, `no_hp1`,
						  `no_hp2`, `contact_person`, `email`, `jangka_waktu_penawaran`, `internet`, `voip`, `vod`, `kode_paket`, `nama_paket`,
						  `setup_fee`, `abonemen`, `monthly_fee`, `nominal`, `keterangan`, `kode_brosur`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_penawaran."', '".$kode_prospek."', '".$kode_customer."', '".$marketing."', '".$nama_customer."', '".$alamat."',
						  '".$nama_perusahaan."', '".$kelurahan."', '".$kecamatan."', '".$kota."', '".$kode_pos."', '".$telp."', '".$no_hp1."',
						  '".$no_hp2."', '".$contact_person."', '".$email."', '".$jangka_waktu_penawaran."', '".$internet."', '".$voip."', '".$vod."', '".$kode_paket."', '".$nama_paket."',
						  '".$setup_fee."', '".$abonemen."', '".$monthly_fee."','".$nominal."', '".$keterangan."', '".$kode_brosur."',
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
			window.location.href='".URL_STAFF."marketing/form_penawaran_detail.php?c=$kode_penawaran';
			</script>";
			
	}else{
		echo "<script language='JavaScript'>
			alert('Max jangka waktu penawaran 7 Hari');
			window.history.go(-1);
			  </script>";
		}
    
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
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>