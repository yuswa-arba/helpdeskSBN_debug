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
$sql_data = mysql_query("SELECT * FROM `gx_setting_perusahaan` WHERE `id_setting_perusahaan` = '1';",$conn);
$row_data = mysql_fetch_array($sql_data);

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Seting Perusahaan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action=""  enctype="multipart/form-data">
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Perusahaan</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="perusahaan" value="'.$row_data["perusahaan"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Counter 1</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="counter_1" value="'.$row_data["counter_1"].'">
								</div>
								<div class="col-xs-3">
									<label>PPN (%)</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="ppn" value="'.$row_data["ppn"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Alamat</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="alamat" value="'.$row_data["alamat"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Counter 2</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="counter_2" value="'.$row_data["counter_2"].'">
								</div>
								<div class="col-xs-3">
									<label>PPH Pasal 23 (%)</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="pph" value="'.$row_data["pph"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Kota</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="kota" value="'.$row_data["kota"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Waktu Refresh Pesan</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="refresh_time" value="'.$row_data["refresh_time"].'">
								</div>
								<div class="col-xs-6">
									<label>Term (Hari)</label>
									<hr>
								</div>
							</div>
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Tanggal Awal</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" class="form-control hasDatepicker" id="datepicker" readonly="" name="tgl_awal" value="'.$row_data["tgl_awal"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Persentase Hrg Jual POS</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="persen_harga_pos" value="'.$row_data["persen_harga_pos"].'">
								</div>
								<div class="col-xs-3">
									<label>Inv Br FO</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="invoice_fo" value="'.$row_data["invoice_fo"].'">
								</div>
							</div>
						</div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Tanggal Akhir</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" class="form-control hasDatepicker" id="datepicker" readonly="" name="tgl_akhir" value="'.$row_data["tgl_akhir"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Persentase Hrg Jual Min</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="persen_harga_min" value="'.$row_data["persen_harga_min"].'">
								</div>
								<div class="col-xs-3">
									<label>Inv Br WL</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="invoice_wl" value="'.$row_data["invoice_wl"].'">
								</div>
							</div>
						</div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Report Dir</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="report_dir" value="'.$row_data["report_dir"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Kode Disc Jual</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="kode_disc_jual" value="'.$row_data["kode_disc_jual"].'">
								</div>
								<div class="col-xs-3">
									<label>LTS</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="lts" value="'.$row_data["lts"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>ODBC Name</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="odbc_name" value="'.$row_data["odbc_name"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Kode Inv Balik Nama</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="kode_inv_baliknama" value="'.$row_data["kode_inv_baliknama"].'">
								</div>
								<div class="col-xs-3">
									<label>FO</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="fo" value="'.$row_data["fo"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Dept Teknisi</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="dept_teknisi" value="'.$row_data["dept_teknisi"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Bulan Aktiv</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="bulan_aktiv" value="'.$row_data["bulan_aktiv"].'">
								</div>
								<div class="col-xs-3">
									<label>Wireless</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="wireless" value="'.$row_data["wireless"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>SMTP Server</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="smtp_server" value="'.$row_data["smtp_server"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Tahun Aktiv</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="tahun_aktiv" value="'.$row_data["tahun_aktiv"].'">
								</div>
								<div class="col-xs-3">
									<label>Up/Dn FO</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="up_fo" value="'.$row_data["up_fo"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>POP 3 Server</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="pop3_server" value="'.$row_data["pop3_server"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Limit Blank Form</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="limit_blank_form" value="'.$row_data["limit_blank_form"].'">
								</div>
								<div class="col-xs-3">
									<label>Up/Dn WL</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="up_wl" value="'.$row_data["up_wl"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Lokasi PLink</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="lokasi_plink" value="'.$row_data["lokasi_plink"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Kirim reminder 1 stlh</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="reminder_1" value="'.$row_data["reminder_1"].'">
								</div>
								<div class="col-xs-3">
									<label>Relokasi</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="relokasi" value="'.$row_data["relokasi"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Pasang Baru (WL)</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="pasang_baru_wifi1" value="'.$row_data["pasang_baru_wifi1"].'">
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="pasang_baru_wifi2" value="'.$row_data["pasang_baru_wifi2"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Kirim reminder 2 stlh</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="reminder_2" value="'.$row_data["reminder_2"].'">
								</div>
								<div class="col-xs-3">
									<label>Balik Nama</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="balik_nama" value="'.$row_data["balik_nama"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Kode Perusahaan</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="kode_perusahaan" value="'.$row_data["kode_perusahaan"].'">
								</div>
								<div class="col-xs-3">
									<label>Kode Cabang</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="kode_cabang" value="'.$row_data["kode_cabang"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Blokir Stlh</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="blokir" value="'.$row_data["blokir"].'">
								</div>
								<div class="col-xs-3">
									<label>ReAktivasi</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="reaktivasi" value="'.$row_data["reaktivasi"].'">
								</div>
							</div>
					    </div>
						
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>CC untuk Otomatis</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="cc_otomatis" value="'.$row_data["cc_otomatis"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									
								</div>
								<div class="col-xs-3">
									
								</div>
								<div class="col-xs-3">
									<label>Gen Next > </label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="next_gen" value="'.$row_data["next_gen"].'">
								</div>
							</div>
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									
								</div>
								<div class="col-xs-6">
									
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-6">
									<label>Lokasi Attachment </label>
								</div>
								<div class="col-xs-3">
									
								</div>
								<div class="col-xs-3">
									
								</div>
								<div class="col-xs-3">
									
								</div>
							</div>
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Subject Send Email</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="subject_email" value="'.$row_data["subject_email"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" name="subject_email" value="'.$row_data["subject_email"].'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
							<div class="row">
								 <div class="col-xs-3">
									<label>Pasang Baru (FO)</label>
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="pasang_baru_fo1" value="'.$row_data["pasang_baru_fo1"].'">
								</div>
								<div class="col-xs-3">
									<input type="text" class="form-control" name="pasang_baru_fo2" value="'.$row_data["pasang_baru_fo2"].'">
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Cek Limit Piutang</label>
								</div>
								<div class="col-xs-4">
									<input type="text" class="form-control" name="cek_limit_piutang" value="'.$row_data["cek_limit_piutang"].'">
								</div>
								<div class="col-xs-2">
									
								</div>
								<div class="col-xs-2">
									
								</div>
							</div>
					    </div>
						
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
						<div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Pesan Invoice</label>
								</div>
								<div class="col-xs-3">
									<textarea name="pesan_invoice" style="width:350%; height: 90px;">'.$row_data["pesan_invoice"].'</textarea>
								</div>
							</div>
					    </div>
					    <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Cek Masa Kontrak</label>
								</div>
								<div class="col-xs-4">
									<input type="text" class="form-control" name="cek_masa_kontrak" value="'.$row_data["cek_masa_kontrak"].'"> 
								</div>
								<div class="col-xs-3">
									<label> hr sblm normal</label>
								</div>
							</div>
					    </div><br />
						 <div class="col-xs-6">
							<div class="row">
								<div class="col-xs-3">
									<label>Margin Kontrak Habis</label>
								</div>
								<div class="col-xs-4">
									<input type="text" class="form-control" name="margin_kontak_habis" value="'.$row_data["margin_kontak_habis"].'" > 
								</div>
								<div class="col-xs-3">
									<label> % harga normal</label>
								</div>
							</div>
					    </div>
						

					</div>
					</div>
					
					<fieldset class="scheduler-border">
							<legend class="scheduler-border">CC Otomatis</legend>
							<div class="form-group">
							<div class="row">
								<div class="col-xs-4">
									<label>Cek Data Customer</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="cek_data_customer" value="'.$row_data["cek_data_customer"].'" > 
								</div>
							</div>
							</div>
							<div class="form-group">
							<div class="row">
								<div class="col-xs-4">
									<label>Blok Otomatis</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="blok_otomatis" value="'.$row_data["blok_otomatis"].'" > 
								</div>
							</div>
							</div>
							<div class="form-group">
							<div class="row">
								<div class="col-xs-4">
									<label>Convert Email Piutang</label>
								</div>
								<div class="col-xs-6">
									<input type="text" class="form-control" name="convert_email_piutang" value="'.$row_data["convert_email_piutang"].'" > 
								</div>
							</div>
							</div>
					</fieldset>
					
						<div class="form-group">
							<div class="row">
								<div class="col-xs-2">
									<label>Logo</label>
								</div>
								<div class="col-xs-6">
									<img id="preview" class="preview" src="'.URL_ADMIN.'upload/logo/'.$row_data["logo_perusahaan"].'" alt="Preview Image" width="200" /><br>		
									<input type="file" name="uploads" id="uploads" />
								</div>
							</div>
							</div>
					
					
									</div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input class="btn bg-olive btn-flat" value="Submit" name="update" type="submit">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

</style>

<!-- datepicker -->
<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
    $(function() {
	$("[id=datepicker]").datepicker({format: "dd/mm/yyyy"});
	
    });
</script>
';

if(isset($_POST["update"]))
{
	
    $perusahaan			= isset($_POST['perusahaan']) ? mysql_real_escape_string(trim($_POST['perusahaan'])) : '';
	$counter_1			= isset($_POST['counter_1']) ? mysql_real_escape_string(trim($_POST['counter_1'])) : '';
	$ppn				= isset($_POST['ppn']) ? mysql_real_escape_string(trim($_POST['ppn'])) : '';
	$alamat				= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$counter_2			= isset($_POST['counter_2']) ? mysql_real_escape_string(trim($_POST['counter_2'])) : '';
	$pph				= isset($_POST['pph']) ? mysql_real_escape_string(trim($_POST['pph'])) : '';
	$kota				= isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
	$refresh_time		= isset($_POST['refresh_time']) ? mysql_real_escape_string(trim($_POST['refresh_time'])) : '';
	$tgl_awal			= isset($_POST['tgl_awal']) ? mysql_real_escape_string(trim($_POST['tgl_awal'])) : '';
	$persen_harga_pos	= isset($_POST['persen_harga_pos']) ? mysql_real_escape_string(trim($_POST['persen_harga_pos'])) : '';
	$invoice_fo			= isset($_POST['invoice_fo']) ? mysql_real_escape_string(trim($_POST['invoice_fo'])) : '';
	$tgl_akhir			= isset($_POST['tgl_akhir']) ? mysql_real_escape_string(trim($_POST['tgl_akhir'])) : '';
	$persen_harga_min	= isset($_POST['persen_harga_min']) ? mysql_real_escape_string(trim($_POST['persen_harga_min'])) : '';
	$invoice_wl			= isset($_POST['invoice_wl']) ? mysql_real_escape_string(trim($_POST['invoice_wl'])) : '';
	$report_dir			= isset($_POST['report_dir']) ? mysql_real_escape_string(trim($_POST['report_dir'])) : '';
	$kode_disc_jual		= isset($_POST['kode_disc_jual']) ? mysql_real_escape_string(trim($_POST['kode_disc_jual'])) : '';
	$lts				= isset($_POST['lts']) ? mysql_real_escape_string(trim($_POST['lts'])) : '';
	$odbc_name			= isset($_POST['odbc_name']) ? mysql_real_escape_string(trim($_POST['odbc_name'])) : '';
	$kode_inv_baliknama	= isset($_POST['kode_inv_baliknama']) ? mysql_real_escape_string(trim($_POST['kode_inv_baliknama'])) : '';
	$fo					= isset($_POST['fo']) ? mysql_real_escape_string(trim($_POST['fo'])) : '';
	$dept_teknisi		= isset($_POST['dept_teknisi']) ? mysql_real_escape_string(trim($_POST['dept_teknisi'])) : '';
	$bulan_aktiv		= isset($_POST['bulan_aktiv']) ? mysql_real_escape_string(trim($_POST['bulan_aktiv'])) : '';
	$wireless			= isset($_POST['wireless']) ? mysql_real_escape_string(trim($_POST['wireless'])) : '';
	$smtp_server		= isset($_POST['smtp_server']) ? mysql_real_escape_string(trim($_POST['smtp_server'])) : '';
	$tahun_aktiv		= isset($_POST['tahun_aktiv']) ? mysql_real_escape_string(trim($_POST['tahun_aktiv'])) : '';
	$up_fo				= isset($_POST['up_fo']) ? mysql_real_escape_string(trim($_POST['up_fo'])) : '';
	$pop3_server		= isset($_POST['pop3_server']) ? mysql_real_escape_string(trim($_POST['pop3_server'])) : '';
	$limit_blank_form	= isset($_POST['limit_blank_form']) ? mysql_real_escape_string(trim($_POST['limit_blank_form'])) : '';
	$up_wl				= isset($_POST['up_wl']) ? mysql_real_escape_string(trim($_POST['up_wl'])) : '';
	$lokasi_plink		= isset($_POST['lokasi_plink']) ? mysql_real_escape_string(trim($_POST['lokasi_plink'])) : '';
	$reminder_1			= isset($_POST['reminder_1']) ? mysql_real_escape_string(trim($_POST['reminder_1'])) : '';
	$relokasi			= isset($_POST['relokasi']) ? mysql_real_escape_string(trim($_POST['relokasi'])) : '';
	$pasang_baru_wifi1	= isset($_POST['pasang_baru_wifi1']) ? mysql_real_escape_string(trim($_POST['pasang_baru_wifi1'])) : '';
	$pasang_baru_wifi2	= isset($_POST['pasang_baru_wifi2']) ? mysql_real_escape_string(trim($_POST['pasang_baru_wifi2'])) : '';
	$reminder_2			= isset($_POST['reminder_2']) ? mysql_real_escape_string(trim($_POST['reminder_2'])) : '';
	$balik_nama			= isset($_POST['balik_nama']) ? mysql_real_escape_string(trim($_POST['balik_nama'])) : '';
	$kode_perusahaan	= isset($_POST['kode_perusahaan']) ? mysql_real_escape_string(trim($_POST['kode_perusahaan'])) : '';
	$kode_cabang		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$blokir				= isset($_POST['blokir']) ? mysql_real_escape_string(trim($_POST['blokir'])) : '';
	$reaktivasi			= isset($_POST['reaktivasi']) ? mysql_real_escape_string(trim($_POST['reaktivasi'])) : '';
	$cc_otomatis		= isset($_POST['cc_otomatis']) ? mysql_real_escape_string(trim($_POST['cc_otomatis'])) : '';
	$next_gen			= isset($_POST['next_gen']) ? mysql_real_escape_string(trim($_POST['next_gen'])) : '';
	$subject_email		= isset($_POST['subject_email']) ? mysql_real_escape_string(trim($_POST['subject_email'])) : '';
	$subject_email		= isset($_POST['subject_email']) ? mysql_real_escape_string(trim($_POST['subject_email'])) : '';
	$pasang_baru_fo1	= isset($_POST['pasang_baru_fo1']) ? mysql_real_escape_string(trim($_POST['pasang_baru_fo1'])) : '';
	$pasang_baru_fo2	= isset($_POST['pasang_baru_fo2']) ? mysql_real_escape_string(trim($_POST['pasang_baru_fo2'])) : '';
	$cek_limit_piutang	= isset($_POST['cek_limit_piutang']) ? mysql_real_escape_string(trim($_POST['cek_limit_piutang'])) : '';
	$pesan_invoice		= isset($_POST['pesan_invoice']) ? mysql_real_escape_string(trim($_POST['pesan_invoice'])) : '';
	$cek_masa_kontrak	= isset($_POST['cek_masa_kontrak']) ? mysql_real_escape_string(trim($_POST['cek_masa_kontrak'])) : '';
	$margin_kontak_habis= isset($_POST['margin_kontak_habis']) ? mysql_real_escape_string(trim($_POST['margin_kontak_habis'])) : '';
	$cek_data_customer	= isset($_POST['cek_data_customer']) ? mysql_real_escape_string(trim($_POST['cek_data_customer'])) : '';
	$blok_otomatis		= isset($_POST['blok_otomatis']) ? mysql_real_escape_string(trim($_POST['blok_otomatis'])) : '';
	$convert_email_piutang		= isset($_POST['convert_email_piutang']) ? mysql_real_escape_string(trim($_POST['convert_email_piutang'])) : '';
	$upload				= isset($_POST['uploads']) ? mysql_real_escape_string(trim($_POST['uploads'])) : '';
	    
	    $eror       = false;
	    $folder     = '../upload/logo/';
	    $lokasi	= 'upload/logo/';
	    //type file yang bisa diupload
	    $file_type  = array('jpg','png','jpeg');
	    //tukuran maximum file yang dapat diupload
	    $max_size   = 10000000; // 10MB
	    //Mulai memorises data
	    $file_name  = str_replace(' ', '', $_FILES['uploads']['name']);
	    $file_size  = $_FILES['uploads']['size'];
	    //cari extensi file dengan menggunakan fungsi explode
	    $explode    = explode('.',$file_name);
	    $extensi    = $explode[count($explode)-1];
	 
	    //check apakah type file sudah sesuai
	    $pesan ='';
	    if(!in_array($extensi,$file_type)){
		$eror   = true;
		$pesan .= '- Type file yang anda upload tidak sesuai.';
	    }
	    if($file_size > $max_size){
		$eror   = true;
		$pesan .= '- Ukuran file melebihi batas maximum.';
	    }
	    //check ukuran file apakah sudah sesuai
	
	    if($_FILES['uploads']['size'] != 0){
	     
		if($eror == true){
		    echo "<script language='JavaScript'>
				    alert('".$pesan."');
				    window.history.go(-1);
			  </script>";
		}else{
		     if($_FILES['uploads']['name'] != ""){
				//mulai memproses upload file
				if(move_uploaded_file($_FILES['uploads']['tmp_name'], $folder.$file_name)){
					//catat nama file ke database
					
					
				//insert into gx_bagian
				$sql_update = "UPDATE `software`.`gx_setting_perusahaan` SET `perusahaan` = '".$perusahaan."', `counter_1` = '".$counter_1."', `ppn` = '".$ppn."', `alamat` = '".$alamat."', `counter_2` = '".$counter_2."', `pph` = '".$pph."', `kota` = '".$kota."', `refresh_time` = '".$refresh_time."', `tgl_awal` = '".$tgl_awal."', `persen_harga_pos` = '".$persen_harga_pos."', `invoice_fo` = '".$invoice_fo."', `tgl_akhir` = '".$tgl_akhir."', `persen_harga_min` = '".$persen_harga_min."', `invoice_wl` = '".$invoice_wl."',
				`report_dir` = '".$report_dir."', `kode_disc_jual` = '".$kode_disc_jual."', `lts` = '".$lts."', `odbc_name` = '".$odbc_name."', `kode_inv_baliknama` = '".$kode_inv_baliknama."', `fo` = '".$fo."', `dept_teknisi` = '".$dept_teknisi."', `bulan_aktiv` = '".$bulan_aktiv."', `wireless` = '".$wireless."', `smtp_server` = '".$smtp_server."', `tahun_aktiv` = '".$tahun_aktiv."', `up_fo` = '".$up_fo."',
				`pop3_server` = '".$pop3_server."', `limit_blank_form` = '".$limit_blank_form."', `up_wl` = '".$up_wl."', `lokasi_plink` = '".$lokasi_plink."', `reminder_1` = '".$reminder_1."', `relokasi` = '".$relokasi."', `pasang_baru_wifi1` = '".$pasang_baru_wifi1."', `pasang_baru_wifi2` = '".$pasang_baru_wifi2."', `reminder_2` = '".$reminder_2."', `balik_nama` = '".$balik_nama."',
				`kode_perusahaan` = '".$kode_perusahaan."', `kode_cabang` = '".$kode_cabang."', `blokir` = '".$blokir."', `reaktivasi` = '".$reaktivasi."', `cc_otomatis` = '".$cc_otomatis."', `next_gen` = '".$next_gen."', `subject_email` = '".$subject_email."', `subject_email` = '".$subject_email."', `pasang_baru_fo1` = '".$pasang_baru_fo1."', `pasang_baru_fo2` = '".$pasang_baru_fo2."',
				`cek_limit_piutang` = '".$cek_limit_piutang."', `pesan_invoice` = '".$pesan_invoice."', `cek_masa_kontrak` = '".$cek_masa_kontrak."', `margin_kontak_habis` = '".$margin_kontak_habis."', `cek_data_customer` = '".$cek_data_customer."', `blok_otomatis` = '".$blok_otomatis."', `convert_email_piutang` = '".$convert_email_piutang."',
				`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."', `logo_perusahaan`='".$file_name."'
				WHERE (`id_setting_perusahaan`='1');";
				//echo $sql_update;
				//echo $sql_update_staff;
				mysql_query($sql_update, $conn) or die (mysql_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
				
				echo "<script language='JavaScript'>
				alert('Data telah diupdate.');
				window.location.href='setting_perusahaan.php';
				</script>";
				
				}else{
					echo "<script language='JavaScript'>
						alert('Proses upload eror');
						window.history.go(-1);
				  </script>";
				}
			}else{
				
				//insert into gx_bagian
				$sql_update = "UPDATE `software`.`gx_setting_perusahaan` SET `perusahaan` = '".$perusahaan."', `counter_1` = '".$counter_1."', `ppn` = '".$ppn."', `alamat` = '".$alamat."', `counter_2` = '".$counter_2."', `pph` = '".$pph."', `kota` = '".$kota."', `refresh_time` = '".$refresh_time."', `tgl_awal` = '".$tgl_awal."', `persen_harga_pos` = '".$persen_harga_pos."', `invoice_fo` = '".$invoice_fo."', `tgl_akhir` = '".$tgl_akhir."', `persen_harga_min` = '".$persen_harga_min."', `invoice_wl` = '".$invoice_wl."',
				`report_dir` = '".$report_dir."', `kode_disc_jual` = '".$kode_disc_jual."', `lts` = '".$lts."', `odbc_name` = '".$odbc_name."', `kode_inv_baliknama` = '".$kode_inv_baliknama."', `fo` = '".$fo."', `dept_teknisi` = '".$dept_teknisi."', `bulan_aktiv` = '".$bulan_aktiv."', `wireless` = '".$wireless."', `smtp_server` = '".$smtp_server."', `tahun_aktiv` = '".$tahun_aktiv."', `up_fo` = '".$up_fo."',
				`pop3_server` = '".$pop3_server."', `limit_blank_form` = '".$limit_blank_form."', `up_wl` = '".$up_wl."', `lokasi_plink` = '".$lokasi_plink."', `reminder_1` = '".$reminder_1."', `relokasi` = '".$relokasi."', `pasang_baru_wifi1` = '".$pasang_baru_wifi1."', `pasang_baru_wifi2` = '".$pasang_baru_wifi2."', `reminder_2` = '".$reminder_2."', `balik_nama` = '".$balik_nama."',
				`kode_perusahaan` = '".$kode_perusahaan."', `kode_cabang` = '".$kode_cabang."', `blokir` = '".$blokir."', `reaktivasi` = '".$reaktivasi."', `cc_otomatis` = '".$cc_otomatis."', `next_gen` = '".$next_gen."', `subject_email` = '".$subject_email."', `subject_email` = '".$subject_email."', `pasang_baru_fo1` = '".$pasang_baru_fo1."', `pasang_baru_fo2` = '".$pasang_baru_fo2."',
				`cek_limit_piutang` = '".$cek_limit_piutang."', `pesan_invoice` = '".$pesan_invoice."', `cek_masa_kontrak` = '".$cek_masa_kontrak."', `margin_kontak_habis` = '".$margin_kontak_habis."', `cek_data_customer` = '".$cek_data_customer."', `blok_otomatis` = '".$blok_otomatis."', `convert_email_piutang` = '".$convert_email_piutang."',
				`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
				WHERE (`id_setting_perusahaan`='1');";
				//echo $sql_update;
				//echo $sql_update_staff;
				mysql_query($sql_update, $conn) or die (mysql_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
				
				echo "<script language='JavaScript'>
				alert('Data telah diupdate.');
				window.location.href='setting_perusahaan.php';
				</script>";
			}
		    
		    
		}
	    }else{
		//insert into gx_bagian
				$sql_update = "UPDATE `software`.`gx_setting_perusahaan` SET `perusahaan` = '".$perusahaan."', `counter_1` = '".$counter_1."', `ppn` = '".$ppn."', `alamat` = '".$alamat."', `counter_2` = '".$counter_2."', `pph` = '".$pph."', `kota` = '".$kota."', `refresh_time` = '".$refresh_time."', `tgl_awal` = '".$tgl_awal."', `persen_harga_pos` = '".$persen_harga_pos."', `invoice_fo` = '".$invoice_fo."', `tgl_akhir` = '".$tgl_akhir."', `persen_harga_min` = '".$persen_harga_min."', `invoice_wl` = '".$invoice_wl."',
				`report_dir` = '".$report_dir."', `kode_disc_jual` = '".$kode_disc_jual."', `lts` = '".$lts."', `odbc_name` = '".$odbc_name."', `kode_inv_baliknama` = '".$kode_inv_baliknama."', `fo` = '".$fo."', `dept_teknisi` = '".$dept_teknisi."', `bulan_aktiv` = '".$bulan_aktiv."', `wireless` = '".$wireless."', `smtp_server` = '".$smtp_server."', `tahun_aktiv` = '".$tahun_aktiv."', `up_fo` = '".$up_fo."',
				`pop3_server` = '".$pop3_server."', `limit_blank_form` = '".$limit_blank_form."', `up_wl` = '".$up_wl."', `lokasi_plink` = '".$lokasi_plink."', `reminder_1` = '".$reminder_1."', `relokasi` = '".$relokasi."', `pasang_baru_wifi1` = '".$pasang_baru_wifi1."', `pasang_baru_wifi2` = '".$pasang_baru_wifi2."', `reminder_2` = '".$reminder_2."', `balik_nama` = '".$balik_nama."',
				`kode_perusahaan` = '".$kode_perusahaan."', `kode_cabang` = '".$kode_cabang."', `blokir` = '".$blokir."', `reaktivasi` = '".$reaktivasi."', `cc_otomatis` = '".$cc_otomatis."', `next_gen` = '".$next_gen."', `subject_email` = '".$subject_email."', `subject_email` = '".$subject_email."', `pasang_baru_fo1` = '".$pasang_baru_fo1."', `pasang_baru_fo2` = '".$pasang_baru_fo2."',
				`cek_limit_piutang` = '".$cek_limit_piutang."', `pesan_invoice` = '".$pesan_invoice."', `cek_masa_kontrak` = '".$cek_masa_kontrak."', `margin_kontak_habis` = '".$margin_kontak_habis."', `cek_data_customer` = '".$cek_data_customer."', `blok_otomatis` = '".$blok_otomatis."', `convert_email_piutang` = '".$convert_email_piutang."',
				`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."'
				WHERE (`id_setting_perusahaan`='1');";
				//echo $sql_update;
				//echo $sql_update_staff;
				mysql_query($sql_update, $conn) or die (mysql_error());
				//log
				enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
				
				echo "<script language='JavaScript'>
				alert('Data telah diupdate.');
				window.location.href='setting_perusahaan.php';
				</script>";
	    }
}
    

    $title	= 'Setting Perusahaan';
    $submenu	= "setting_perusahaan";
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