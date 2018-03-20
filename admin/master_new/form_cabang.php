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
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/master_cabang.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    
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

    
    $sql_update = "UPDATE `gx_cabang` SET `kode_cabang` = '".$kode_cabang."', `nama_cabang` = '".$nama_cabang."', `alamat_cabang` = '".$alamat_cabang."',
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
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die (mysql_error());
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_cabang.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_cabang		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_cabang 	= "SELECT * FROM `gx_cabang` WHERE `id_cabang`='$id_cabang' LIMIT 0,1;";
    $sql_cabang		= mysql_query($query_cabang, $conn);
    $row_cabang		= mysql_fetch_array($sql_cabang);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Form Cabang
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Cabang</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" id="kode_cabang" name="kode_cabang" required="" onkeyup = "generateKode();" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'">
						'.(isset($_GET['id']) ? '<input type="hidden" name="id_cabang" value="'.$id_cabang.'">' : "").'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Alamat Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<textarea cols="20" rows="3" class="form-control" name="alamat_cabang">'.(isset($_GET['id']) ? $row_cabang["alamat_cabang"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control"  name="kota_cabang" value="'.(isset($_GET['id']) ? $row_cabang["kota_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Pos</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_pos" value="'.(isset($_GET['id']) ? $row_cabang["kode_pos"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No Telpon</label>
					    </div>
					    <div class="col-xs-8">
					        <input type="text" class="form-control"  name="telp_cabang" value="'.(isset($_GET['id']) ? $row_cabang["telp_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No FAX</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control"  name="fax_cabang" value="'.(isset($_GET['id']) ? $row_cabang["fax_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Website</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="web_cabang" value="'.(isset($_GET['id']) ? $row_cabang["web_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email CSO</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="email_cso" value="'.(isset($_GET['id']) ? $row_cabang["email_cso"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Info</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="email_info" value="'.(isset($_GET['id']) ? $row_cabang["email_info"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Bank Masuk</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_bm1" name="kode_bm1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_bm" name="kode_bm" value="'.(isset($_GET['id']) ? $row_cabang["kode_bm"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Bank Keluar</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_bk1" name="kode_bk1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_bk" name="kode_bk" value="'.(isset($_GET['id']) ? $row_cabang["kode_bk"] : "").'">
					    </div>
                                        </div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Kas Masuk</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_km1" name="kode_km1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_km" name="kode_km" value="'.(isset($_GET['id']) ? $row_cabang["kode_km"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Kas Keluar</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_kk1" name="kode_kk1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_kk" name="kode_kk" value="'.(isset($_GET['id']) ? $row_cabang["kode_kk"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode CSO Masuk</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_cm1" name="kode_cm1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_cm" name="kode_cm" value="'.(isset($_GET['id']) ? $row_cabang["kode_cm"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Billing Data</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_billing_data1" name="kode_billing_data1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_billing_data" name="kode_billing_data" value="'.(isset($_GET['id']) ? $row_cabang["kode_billing_data"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Billing Voice</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_billing_voice1" name="kode_billing_voice1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_billing_voice" name="kode_billing_voice" value="'.(isset($_GET['id']) ? $row_cabang["kode_billing_voice"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Billing Video</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_billing_video1" name="kode_billing_video1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_billing_video" name="kode_billing_video" value="'.(isset($_GET['id']) ? $row_cabang["kode_billing_video"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Prospek</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_prospek1" name="kode_prospek1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_prospek" name="kode_prospek" value="'.(isset($_GET['id']) ? $row_cabang["kode_prospek"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode SPK Survey</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_spk_survey1" name="kode_spk_survey1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_spk_survey" name="kode_spk_survey" value="'.(isset($_GET['id']) ? $row_cabang["kode_prospek"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Jawaban Survey</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_jawab_survey1" name="kode_jawab_survey1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_jawab_survey" name="kode_jawab_survey" value="'.(isset($_GET['id']) ? $row_cabang["kode_jawab_survey"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Formulir</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_formulir1" name="kode_formulir1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_formulir" name="kode_formulir" value="'.(isset($_GET['id']) ? $row_cabang["kode_formulir"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Link Budget</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_link_budget1" name="kode_link_budget1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_link_budget" name="kode_link_budget" value="'.(isset($_GET['id']) ? $row_cabang["kode_link_budget"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Justifikasi</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_justifikasi1" name="kode_justifikasi1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_justifikasi" name="kode_justifikasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode ACC Justifikasi</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_acc_justifikasi1" name="kode_acc_justifikasi1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_acc_justifikasi" name="kode_acc_justifikasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_acc_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode SPK Pasang Baru</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_spk_pasang1" name="kode_spk_pasang1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_spk_pasang" name="kode_spk_pasang" value="'.(isset($_GET['id']) ? $row_cabang["kode_spk_pasang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Jawaban SPK Pasang Baru</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_jawab_pasang1" name="kode_jawab_pasang1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_jawab_pasang" name="kode_jawab_pasang" value="'.(isset($_GET['id']) ? $row_cabang["kode_jawab_pasang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode SPK Aktivasi Baru</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_spk_aktivasi1" name="kode_spk_aktivasi1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_spk_aktivasi" name="kode_spk_aktivasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_spk_aktivasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Jawaban SPK Aktivasi Baru</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_jawab_aktivasi1" name="kode_jawab_aktivasi1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_jawab_aktivasi" name="kode_jawab_aktivasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_jawab_aktivasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Realisasi Link Budget</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_realisasi_link_budget1" name="kode_realisasi_link_budget1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" id="kode_realisasi_link_budget" name="kode_realisasi_link_budget" value="'.(isset($_GET['id']) ? $row_cabang["kode_realisasi_link_budget"] : "").'">
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

    $title	= 'Form Cabang';
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