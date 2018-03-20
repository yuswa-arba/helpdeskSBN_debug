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
    $id_kaskeluar	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_kaskeluar 	= "SELECT * FROM `gx_kas_keluar` WHERE `id_bankmasuk`='$id_kaskeluar' LIMIT 0,1;";
    $sql_kaskeluar	= mysql_query($query_kaskeluar, $conn);
    $row_kaskeluar	= mysql_fetch_array($sql_kaskeluar);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Form Bank Masuk
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Bank Masuk</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Transaksi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="transaction_id" name="transaction_id" required="" value="'.(isset($_GET['id']) ? $row_kaskeluar["transaction_id"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" id="tgl_transaction" name="tgl_transaction" required="" value="'.(isset($_GET['id']) ? $row_kaskeluar["tgl_transaction"] : "").'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>ACC Cash</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  name="acc_cash" value="'.(isset($_GET['id']) ? $row_kaskeluar["acc_cash"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="mu" value="'.(isset($_GET['id']) ? $row_kaskeluar["mu"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Rate</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" class="form-control"  name="rate" value="'.(isset($_GET['id']) ? $row_kaskeluar["rate"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks</label>
                                            </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control"  name="remarks" value="'.(isset($_GET['id']) ? $row_kaskeluar["remarks"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No</th>
                                                <th>No ACC</th>
                                                <th>No Jual</th>
                                                <th>Keterangan</th>
						<th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
					
					for($inv=1; $inv <=10; $inv++){
					
					    $content .='<tr>
						<td>'.$inv.'.</td>
						<td><input type="text" class="form-control" name="no_acc'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="no_jual'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="ket'.$inv.'" value=""></td>
						<td><input type="text" class="form-control" name="nominal'.$inv.'" value=""></td>
					    </tr>';
					}
					
$content .='
					    <tr>
						<td colspan="4">Total</td>
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

$plugins = '';

    $title	= 'Form Kas Keluar';
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