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
    
if(isset($_POST["save"]))
{
    //echo "save";
    /*
    $kode_cabang    = isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang    = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $alamat_cabang  = isset($_POST['alamat_cabang']) ? mysql_real_escape_string(trim($_POST['alamat_cabang'])) : '';
    $kota_cabang    = isset($_POST['kota_cabang']) ? mysql_real_escape_string(trim($_POST['kota_cabang'])) : '';
    $telp_cabang    = isset($_POST['telp_cabang']) ? mysql_real_escape_string(trim($_POST['telp_cabang'])) : '';
    $email_cabang   = isset($_POST['email_cabang']) ? mysql_real_escape_string(trim($_POST['email_cabang'])) : '';
    $invoice_code   = isset($_POST['invoice_code']) ? mysql_real_escape_string(trim($_POST['invoice_code'])) : '';
    
    $kode_pos	    = isset($_POST['kode_pos']) ? mysql_real_escape_string(trim($_POST['kode_pos'])) : '';
    $fax_cabang	    = isset($_POST['fax_cabang']) ? mysql_real_escape_string(trim($_POST['fax_cabang'])) : '';
    $web_cabang	    = isset($_POST['web_cabang']) ? mysql_real_escape_string(trim($_POST['web_cabang'])) : '';
    $email_cso	    = isset($_POST['email_cso']) ? mysql_real_escape_string(trim($_POST['email_cso'])) : '';
    $email_info	    = isset($_POST['email_info']) ? mysql_real_escape_string(trim($_POST['email_info'])) : '';
    $kode_bm	    = isset($_POST['kode_bm']) ? mysql_real_escape_string(trim($_POST['kode_bm'])) : '';
    $kode_bk	    = isset($_POST['kode_bk']) ? mysql_real_escape_string(trim($_POST['kode_bk'])) : '';
    $kode_km	    = isset($_POST['kode_km']) ? mysql_real_escape_string(trim($_POST['kode_km'])) : '';
    $kode_kk	    = isset($_POST['kode_kk']) ? mysql_real_escape_string(trim($_POST['kode_kk'])) : '';
    $kode_cm	    = isset($_POST['kode_cm']) ? mysql_real_escape_string(trim($_POST['kode_cm'])) : '';
    $kode_billing_data	    = isset($_POST['kode_billing_data']) ? mysql_real_escape_string(trim($_POST['kode_billing_data'])) : '';
    $kode_billing_voice	    = isset($_POST['kode_billing_voice']) ? mysql_real_escape_string(trim($_POST['kode_billing_voice'])) : '';
    $kode_billing_video	    = isset($_POST['kode_billing_video']) ? mysql_real_escape_string(trim($_POST['kode_billing_video'])) : '';
    $kode_spk_survey	    = isset($_POST['kode_spk_survey']) ? mysql_real_escape_string(trim($_POST['kode_spk_survey'])) : '';
    
    $kode_prospek	    = isset($_POST['kode_prospek']) ? mysql_real_escape_string(trim($_POST['kode_prospek'])) : '';
    $kode_jawab_survey	    = isset($_POST['kode_jawab_survey']) ? mysql_real_escape_string(trim($_POST['kode_jawab_survey'])) : '';
    $kode_formulir	    = isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $kode_link_budget	    = isset($_POST['kode_link_budget']) ? mysql_real_escape_string(trim($_POST['kode_link_budget'])) : '';
    $kode_justifikasi	    = isset($_POST['kode_justifikasi']) ? mysql_real_escape_string(trim($_POST['kode_spk_survey'])) : '';
    $kode_acc_justifikasi   = isset($_POST['kode_acc_justifikasi']) ? mysql_real_escape_string(trim($_POST['kode_acc_justifikasi'])) : '';
    $kode_spk_pasang	    = isset($_POST['kode_spk_pasang']) ? mysql_real_escape_string(trim($_POST['kode_spk_pasang'])) : '';
    $kode_jawab_pasang	    = isset($_POST['kode_jawab_pasang']) ? mysql_real_escape_string(trim($_POST['kode_jawab_pasang'])) : '';
    $kode_spk_aktivasi	    = isset($_POST['kode_spk_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_spk_aktivasi'])) : '';
    $kode_jawab_aktivasi    = isset($_POST['kode_jawab_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_jawab_aktivasi'])) : '';
    $kode_realisasi_link_budget	    = isset($_POST['kode_realisasi_link_budget']) ? mysql_real_escape_string(trim($_POST['kode_realisasi_link_budget'])) : '';


    //insert into gxCabang
    $sql_insert = "INSERT INTO `gx_cabang` (`id_cabang`, `kode_cabang`, `nama_cabang`, `alamat_cabang`, `kota_cabang`, `kode_pos`,
    `telp_cabang`, `fax_cabang`, `web_cabang`, `email_cso`, `email_info`, `kode_bm`, `kode_bk`,
    `kode_km`, `kode_kk`, `kode_cm`, `kode_billing_data`, `kode_billing_voice`, `kode_billing_video`, `kode_prospek`,
    `kode_spk_survey`, `kode_jawab_survey`, `kode_formulir`, `kode_link_budget`, `kode_justifikasi`, `kode_acc_justifikasi`,
    `kode_spk_pasang`, `kode_jawab_pasang`, `kode_spk_aktivasi`, `kode_jawab_aktivasi`, `kode_realisasi_link_budget`,
    `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL, '".$kode_cabang."', '".$nama_cabang."', '".$alamat_cabang."', '".$kota_cabang."', '".$kode_pos."', '".$telp_cabang."', '".$fax_cabang."',
    '".$web_cabang."', '".$email_cso."', '".$email_info."', '".$kode_bm."', '".$kode_bk."',
    '".$kode_km."', '".$kode_kk."', '".$kode_cm."', '".$kode_billing_data."', '".$kode_billing_voice."', '".$kode_billing_video."',
    '".$kode_prospek."', '".$kode_spk_survey."', '".$kode_jawab_survey."', '".$kode_formulir."', '".$kode_link_budget."',
    '".$kode_justifikasi."', '".$kode_acc_justifikasi."', '".$kode_spk_pasang."', '".$kode_jawab_pasang."', '".$kode_spk_aktivasi."',
    '".$kode_jawab_aktivasi."', '".$kode_realisasi_link_budget."',
    NOW(), NOW(), '0', '".$loggedin["username"]."', '".$loggedin["username"]."');";                    
    */
    
    
    $id_kasir_cso		= isset($_POST['id_kasir_cso']) ? $_POST['id_kasir_cso'] : '';
    $transaction_id		= isset($_POST['transaction_id']) ? $_POST['transaction_id'] : '';
    $tgl_transaction		= isset($_POST['tgl_transaction']) ? $_POST['tgl_transaction'] : '';
    $acc_kasir			= isset($_POST['acc_kasir']) ? $_POST['acc_kasir'] : '';
    $mu				= isset($_POST['mu']) ? $_POST['mu'] : '';
    $rate			= isset($_POST['rate']) ? $_POST['rate'] : '';
    $remarks			= isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $tunai			= isset($_POST['tunai']) ? $_POST['tunai'] : '';
    $bg_check			= isset($_POST['bg_check']) ? $_POST['bg_check'] : '';
    $no_creditcard		= isset($_POST['no_creditcard']) ? $_POST['no_creditcard']: '';
    $no_debitcard		= isset($_POST['no_debitcard']) ? $_POST['no_debitcard'] : '';
    $bank			= isset($_POST['bank']) ? $_POST['bank'] : '';
    $no_edc			= isset($_POST['no_edc']) ? $_POST['no_edc'] : '';
    $bukti_bayar		= isset($_POST['bukti_bayar']) ? $_POST['bukti_bayar'] : '';
    $total			= isset($_POST['total']) ? $_POST['total'] : '';
    $user_add			= $loggedin["username"];
    $user_upd			= $loggedin["username"];
    $level			= '0';
    
    //insert into gx kasir
    $sql_insert = "INSERT INTO `gx_kasir_cso`(`id_kasir_cso`, `transaction_id`, `tgl_transaction`, `acc_kasir`, `mu`, `rate`, `remarks`, `tunai`, `bg_check`, `no_creditcard`, `no_debitcard`, `bank`, `no_edc`, `bukti_bayar`, `total`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
		    VALUES (NULL, '$transaction_id', '$tgl_transaction', '$acc_kasir', '$mu', '$rate', '$remarks', '$tunai', '$bg_check', '$no_creditcard', '$no_debitcard', '$bank', '$no_edc', '$bukti_bayar', '$total', NOW(), NOW(), '$user_add', '$user_upd', '$level')";
    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."administrasi/master_kasir_dafi.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    /*
    $id_cabang 	    = isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $kode_cabang    = isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    
    $nama_cabang    = isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $alamat_cabang  = isset($_POST['alamat_cabang']) ? mysql_real_escape_string(trim($_POST['alamat_cabang'])) : '';
    $kota_cabang    = isset($_POST['kota_cabang']) ? mysql_real_escape_string(trim($_POST['kota_cabang'])) : '';
    $telp_cabang    = isset($_POST['telp_cabang']) ? mysql_real_escape_string(trim($_POST['telp_cabang'])) : '';
    $email_cabang   = isset($_POST['email_cabang']) ? mysql_real_escape_string(trim($_POST['email_cabang'])) : '';
    $invoice_code   = isset($_POST['invoice_code']) ? mysql_real_escape_string(trim($_POST['invoice_code'])) : '';
    
    $kode_pos	    = isset($_POST['kode_pos']) ? mysql_real_escape_string(trim($_POST['kode_pos'])) : '';
    $fax_cabang	    = isset($_POST['fax_cabang']) ? mysql_real_escape_string(trim($_POST['fax_cabang'])) : '';
    $web_cabang	    = isset($_POST['web_cabang']) ? mysql_real_escape_string(trim($_POST['web_cabang'])) : '';
    $email_cso	    = isset($_POST['email_cso']) ? mysql_real_escape_string(trim($_POST['email_cso'])) : '';
    $email_info	    = isset($_POST['email_info']) ? mysql_real_escape_string(trim($_POST['email_info'])) : '';
    $kode_bm	    = isset($_POST['kode_bm']) ? mysql_real_escape_string(trim($_POST['kode_bm'])) : '';
    $kode_bk	    = isset($_POST['kode_bk']) ? mysql_real_escape_string(trim($_POST['kode_bk'])) : '';
    $kode_km	    = isset($_POST['kode_km']) ? mysql_real_escape_string(trim($_POST['kode_km'])) : '';
    $kode_kk	    = isset($_POST['kode_kk']) ? mysql_real_escape_string(trim($_POST['kode_kk'])) : '';
    $kode_cm	    = isset($_POST['kode_cm']) ? mysql_real_escape_string(trim($_POST['kode_cm'])) : '';
    $kode_billing_data	    = isset($_POST['kode_billing_data']) ? mysql_real_escape_string(trim($_POST['kode_billing_data'])) : '';
    $kode_billing_voice	    = isset($_POST['kode_billing_voice']) ? mysql_real_escape_string(trim($_POST['kode_billing_voice'])) : '';
    $kode_billing_video	    = isset($_POST['kode_billing_video']) ? mysql_real_escape_string(trim($_POST['kode_billing_video'])) : '';
    $kode_spk_survey	    = isset($_POST['kode_spk_survey']) ? mysql_real_escape_string(trim($_POST['kode_spk_survey'])) : '';
    
    $kode_prospek	    = isset($_POST['kode_prospek']) ? mysql_real_escape_string(trim($_POST['kode_prospek'])) : '';
    $kode_jawab_survey	    = isset($_POST['kode_jawab_survey']) ? mysql_real_escape_string(trim($_POST['kode_jawab_survey'])) : '';
    $kode_formulir	    = isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $kode_link_budget	    = isset($_POST['kode_link_budget']) ? mysql_real_escape_string(trim($_POST['kode_link_budget'])) : '';
    $kode_justifikasi	    = isset($_POST['kode_justifikasi']) ? mysql_real_escape_string(trim($_POST['kode_spk_survey'])) : '';
    $kode_acc_justifikasi   = isset($_POST['kode_acc_justifikasi']) ? mysql_real_escape_string(trim($_POST['kode_acc_justifikasi'])) : '';
    $kode_spk_pasang	    = isset($_POST['kode_spk_pasang']) ? mysql_real_escape_string(trim($_POST['kode_spk_pasang'])) : '';
    $kode_jawab_pasang	    = isset($_POST['kode_jawab_pasang']) ? mysql_real_escape_string(trim($_POST['kode_jawab_pasang'])) : '';
    $kode_spk_aktivasi	    = isset($_POST['kode_spk_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_spk_aktivasi'])) : '';
    $kode_jawab_aktivasi    = isset($_POST['kode_jawab_aktivasi']) ? mysql_real_escape_string(trim($_POST['kode_jawab_aktivasi'])) : '';
    $kode_realisasi_link_budget	    = isset($_POST['kode_realisasi_link_budget']) ? mysql_real_escape_string(trim($_POST['kode_realisasi_link_budget'])) : '';
    */
    
    /*$sql_update = "UPDATE `gx_cabang` SET `kode_cabang` = '".$kode_cabang."', `nama_cabang` = '".$nama_cabang."', `alamat_cabang` = '".$alamat_cabang."',
                    `kota_cabang` = '".$kota_cabang."', `telp_cabang` = '".$telp_cabang."',
		    `kode_pos`='".$kode_pos."', `fax_cabang`='".$fax_cabang."', `web_cabang`='".$web_cabang."',
		    `email_cso`='".$email_cso."', `email_info`='".$email_info."', `email_cabang`='".$email_cabang."',
		    `kode_bm`='".$kode_bm."', `kode_bk`='".$kode_bk."', `kode_km`='".$kode_km."', `kode_kk`='".$kode_kk."',
		    `kode_cm`='".$kode_cm."', `kode_billing_data`='".$kode_billing_data."', `kode_billing_voice`='".$kode_billing_voice."',
		    `kode_billing_video`='".$kode_billing_video."', `kode_prospek`='".$kode_prospek."', `kode_spk_survey`='".$kode_spk_survey."',
		    `kode_jawab_survey`='".$kode_jawab_survey."', `kode_formulir`='".$kode_formulir."', `kode_link_budget`='".$kode_link_budget."',
		    `kode_justifikasi`='".$kode_justifikasi."', `kode_acc_justifikasi`='".$kode_acc_justifikasi."', `kode_spk_pasang`='".$kode_spk_pasang."',
		    `kode_jawab_pasang`='".$kode_jawab_pasang."', `kode_spk_aktivasi`='".$kode_spk_aktivasi."',
		    `kode_jawab_aktivasi`='".$kode_jawab_aktivasi."', `kode_realisasi_link_budget`='".$kode_realisasi_link_budget."',
		    
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE (`id_cabang`='".$id_cabang."');";
    */
    
    $id_kasir_cso		= isset($_POST['id_kasir_cso']) ? $_POST['id_kasir_cso'] : '';
    $transaction_id		= isset($_POST['transaction_id']) ? $_POST['transaction_id'] : '';
    $tgl_transaction		= isset($_POST['tgl_transaction']) ? $_POST['tgl_transaction'] : '';
    $acc_kasir			= isset($_POST['acc_kasir']) ? $_POST['acc_kasir'] : '';
    $mu				= isset($_POST['mu']) ? $_POST['mu'] : '';
    $rate			= isset($_POST['rate']) ? $_POST['rate'] : '';
    $remarks			= isset($_POST['remarks']) ? $_POST['remarks'] : '';
    $tunai			= isset($_POST['tunai']) ? $_POST['tunai'] : '';
    $bg_check			= isset($_POST['bg_check']) ? $_POST['bg_check'] : '';
    $no_creditcard		= isset($_POST['no_creditcard']) ? $_POST['no_creditcard']: '';
    $no_debitcard		= isset($_POST['no_debitcard']) ? $_POST['no_debitcard'] : '';
    $bank			= isset($_POST['bank']) ? $_POST['bank'] : '';
    $no_edc			= isset($_POST['no_edc']) ? $_POST['no_edc'] : '';
    $bukti_bayar		= isset($_POST['bukti_bayar']) ? $_POST['bukti_bayar'] : '';
    $total			= isset($_POST['total']) ? $_POST['total'] : '';
    $user_add			= isset($_POST['user_add']) ? $_POST['user_add'] : '';
    $user_upd			= isset($_POST['user_upd']) ? $_POST['user_upd'] : '';
    $level			= isset($_POST['level']) ? $_POST['level'] : '';
    
    $sql_update = "UPDATE `gx_kasir_cso` SET `transaction_id`='$transaction_id',
    `tgl_transaction`='$tgl_transaction',`acc_kasir`='$acc_kasir',`mu`='$mu',`rate`='$rate',`remarks`='$remarks',
    `tunai`='$tunai',`bg_check`='$bg_check',`no_creditcard`='$no_creditcard',`no_debitcard`='$no_debitcard',`bank`='$bank',
    `no_edc`='$no_edc',`bukti_bayar`='$bukti_bayar',`total`='$total',`date_upd`=NOW(),
    `user_upd`=NOW(),`level`='0' WHERE `id_kasir_cso`='$id_kasir_cso'";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."administrasi/master_kasir_dafi.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_kasir	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_kasir = "SELECT * FROM `gx_kasir_cso` WHERE `id_kasir_cso`='$id_kasir' LIMIT 0,1;";
    $sql_kasir	= mysql_query($query_kasir, $conn);
    $row_kasir	= mysql_fetch_array($sql_kasir);
    $query_pegawai = "SELECT `id_employee`, `id_cabang`, `id_bagian`, `kode_pegawai`, `nama`, `alamat`, `email`, `hp`, `no_ktp`, `tgl_masuk`, `tgl_lahir`, `contact_person`, `nama_cp`, `alamat_cp`, `hubungan_cp`, `id_level`, `ptkp`, `sex`, `no_koperasi`, `no_hp`, `agama`, `status`, `account_bank`, `nama_bank`, `no_acc`, `nama_pemilik`, `kota`, `ext_voip`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pegawai` WHERE `no_acc`='$row_kasir[acc_kasir]'";
    $row_pegawai = mysql_fetch_array(mysql_query($query_pegawai, $conn));
}
    
    $content ='<section class="content-header">
                    <h1>
                        Form Kasir	
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Kasir</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <input type="hidden" name="id_kasir_cso" value="'.(isset($_GET['id']) ? $row_kasir["id_kasir_cso"] : "").'">
				    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="transaction_id" name="transaction_id" required="" value="'.(isset($_GET['id']) ? $row_kasir["transaction_id"] : "").'">
					    <p><a href="data_transaksi.php?r=myForm" onclick="return valideopenerform(\'data_transaksi.php?r=myForm\',\'Transaksi\');">Search Transaksi</a></p>
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="tgl_transaction" name="tgl_transaction" required="" value="'.(isset($_GET['id']) ? $row_kasir["tgl_transaction"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Kasir</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="acc_kasir" value="'.(isset($_GET['id']) ? $row_kasir["acc_kasir"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Nama Kasir</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_kasir" value="'.(isset($_GET['id']) ? $row_pegawai["nama"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="mu" value="'.(isset($_GET['id']) ? $row_kasir["mu"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="rate" value="'.(isset($_GET['id']) ? $row_kasir["rate"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="remarks" value="'.(isset($_GET['id']) ? $row_kasir["remarks"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tunai</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="tunai" value="'.(isset($_GET['id']) ? $row_kasir["tunai"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>BG/Check</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="bg_check" value="'.(isset($_GET['id']) ? $row_kasir["bg_check"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Credit card</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_creditcard" value="'.(isset($_GET['id']) ? $row_kasir["no_creditcard"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>No Debit Card</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="no_debitcard" value="'.(isset($_GET['id']) ? $row_kasir["no_debitcard"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bank</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="bank" value="'.(isset($_GET['id']) ? $row_kasir["bank"] : "").'">
						<p><a href="data_bank.php?r=myForm" onclick="return valideopenerform(\'data_bank.php?r=myForm\',\'bank\');">Search Bank</a></p>
					    </div>
                                        
					    <div class="col-xs-3">
						<label>No EDC</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="no_edc" value="'.(isset($_GET['id']) ? $row_kasir["no_edc"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No</th>
                                                <th>Invoice Number</th>
                                                <th>Invoice Name</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
					for($inv=1; $inv <=10; $inv++){
					
					    $content .='<tr>
						<td>'.$inv.'.</td>
						<td><input type="text" class="form-control" name="invoice_number'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="invoice_name'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="nominal'.$inv.'" value=""></td>
					    </tr>';
					}
					
$content .='
					    <tr>
						<td colspan="3">Total</td>
						<td><input type="text" class="form-control" name="total" value=""></td>
						
					    </tr>
					</tbody>
                                    </table>
				    
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						&nbsp;
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						Piutang
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-8">
						<table id="customer" class="table table-bordered table-striped">
						    <thead>
							<tr>
							    
							    <th>Invoice Number</th>
							    <th>Invoice Name</th>
							    <th>Nominal</th>
							</tr>
						    </thead>
						    <tbody>';
						    
						    for($piutang=1; $piutang <=5; $piutang++){
						    
							$content .='<tr>
							    <td><input type="text" class="form-control" name="pinvoice_number'.$piutang.'" value=""></td>
							    <td><input type="text" class="form-control" name="pinvoice_name'.$piutang.'" value=""></td>
							    <td><input type="text" class="form-control" name="pnominal'.$piutang.'" value=""></td>
							</tr>';
						    }
						    
	    $content .='
							<tr>
							    <td colspan="2">Total</td>
							    <td><input type="text" class="form-control" name="ptotal" value=""></td>
							    
							</tr>
						    </tbody>
						</table>
					    </div>
					    <div class="col-xs-4">
						<label>Bukti Transaksi</label><br>
					        <input type="file" class="form-control"  name="bukti_transaksi" value="">
					    
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

$plugins = '
	
	<script type="text/javascript">
	    function generateKode() {
		var kodecab = document.getElementById("kode_cabang").value;
		
		document.getElementById("kode_bk1").value = kodecab;
		document.getElementById("kode_bm1").value = kodecab;
		document.getElementById("kode_km1").value = kodecab;
		document.getElementById("kode_kk1").value = kodecab;
		document.getElementById("kode_cm1").value = kodecab;
		document.getElementById("kode_billing_data1").value = kodecab;
		document.getElementById("kode_billing_video1").value = kodecab;
		document.getElementById("kode_billing_voice1").value = kodecab;
		document.getElementById("kode_prospek1").value = kodecab;
		document.getElementById("kode_spk_survey1").value = kodecab;
		document.getElementById("kode_jawab_survey1").value = kodecab;
		document.getElementById("kode_spk_aktivasi1").value = kodecab;
		document.getElementById("kode_jawab_aktivasi1").value = kodecab;
		document.getElementById("kode_spk_pasang1").value = kodecab;
		document.getElementById("kode_jawab_pasang1").value = kodecab;
		document.getElementById("kode_formulir1").value = kodecab;
		document.getElementById("kode_link_budget1").value = kodecab;
		document.getElementById("kode_justifikasi1").value = kodecab;
		document.getElementById("kode_acc_justifikasi1").value = kodecab;
		document.getElementById("kode_realisasi_link_budget1").value = kodecab;
		
	    }
        </script>

        
    ';

    $title	= 'Form Bank Masuk';
    $submenu	= "cabang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>