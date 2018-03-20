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
    $id_cabang		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_cabang 	= "SELECT * FROM `gx_cabang` WHERE `id_cabang`='".$id_cabang."' LIMIT 0,1;";
    $sql_cabang		= mysql_query($query_cabang, $conn);
    $row_cabang		= mysql_fetch_array($sql_cabang);
    
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
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
						<input type="text" class="form-control" id="kode_cabang" name="kode_cabang" readonly="" onkeyup = "generateKode();" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_cabang["nama_cabang"] : "").'">
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
						<textarea cols="20" rows="3" class="form-control" readonly="" name="alamat_cabang">'.(isset($_GET['id']) ? $row_cabang["alamat_cabang"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota Cabang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="kota_cabang" value="'.(isset($_GET['id']) ? $row_cabang["kota_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Pos</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="kode_pos" value="'.(isset($_GET['id']) ? $row_cabang["kode_pos"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No Telpon</label>
					    </div>
					    <div class="col-xs-8">
					        <input type="text" class="form-control" readonly="" name="telp_cabang" value="'.(isset($_GET['id']) ? $row_cabang["telp_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>No FAX</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="fax_cabang" value="'.(isset($_GET['id']) ? $row_cabang["fax_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Website</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="web_cabang" value="'.(isset($_GET['id']) ? $row_cabang["web_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email CSO</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="email_cso" value="'.(isset($_GET['id']) ? $row_cabang["email_cso"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Email Info</label>
                                            </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="email_info" value="'.(isset($_GET['id']) ? $row_cabang["email_info"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_bm" name="kode_bm" value="'.(isset($_GET['id']) ? $row_cabang["kode_bm"] : "").'">
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
						<input type="text" class="form-control" readonly=""id="kode_bk" name="kode_bk" value="'.(isset($_GET['id']) ? $row_cabang["kode_bk"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_km" name="kode_km" value="'.(isset($_GET['id']) ? $row_cabang["kode_km"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_kk" name="kode_kk" value="'.(isset($_GET['id']) ? $row_cabang["kode_kk"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_cm" name="kode_cm" value="'.(isset($_GET['id']) ? $row_cabang["kode_cm"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_billing_data" name="kode_billing_data" value="'.(isset($_GET['id']) ? $row_cabang["kode_billing_data"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_billing_voice" name="kode_billing_voice" value="'.(isset($_GET['id']) ? $row_cabang["kode_billing_voice"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_billing_video" name="kode_billing_video" value="'.(isset($_GET['id']) ? $row_cabang["kode_billing_video"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_prospek" name="kode_prospek" value="'.(isset($_GET['id']) ? $row_cabang["kode_prospek"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_spk_survey" name="kode_spk_survey" value="'.(isset($_GET['id']) ? $row_cabang["kode_prospek"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_jawab_survey" name="kode_jawab_survey" value="'.(isset($_GET['id']) ? $row_cabang["kode_jawab_survey"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_formulir" name="kode_formulir" value="'.(isset($_GET['id']) ? $row_cabang["kode_formulir"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_link_budget" name="kode_link_budget" value="'.(isset($_GET['id']) ? $row_cabang["kode_link_budget"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_justifikasi" name="kode_justifikasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_justifikasi"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_acc_justifikasi" name="kode_acc_justifikasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_acc_justifikasi"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_spk_pasang" name="kode_spk_pasang" value="'.(isset($_GET['id']) ? $row_cabang["kode_spk_pasang"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_jawab_pasang" name="kode_jawab_pasang" value="'.(isset($_GET['id']) ? $row_cabang["kode_jawab_pasang"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_spk_aktivasi" name="kode_spk_aktivasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_spk_aktivasi"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_jawab_aktivasi" name="kode_jawab_aktivasi" value="'.(isset($_GET['id']) ? $row_cabang["kode_jawab_aktivasi"] : "").'">
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
						<input type="text" class="form-control" readonly="" id="kode_realisasi_link_budget" name="kode_realisasi_link_budget" value="'.(isset($_GET['id']) ? $row_cabang["kode_realisasi_link_budget"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Permintaan Pembelian</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_mbeli1" name="kode_mbeli1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" id="kode_mbeli" name="kode_mbeli" value="'.(isset($_GET['id']) ? $row_cabang["kode_mbeli"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Periksa Pembelian</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_pbeli1" name="kode_pbeli1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" id="kode_pbeli" name="kode_pbeli" value="'.(isset($_GET['id']) ? $row_cabang["kode_mbeli"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Persetujuan Pembelian</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_sbeli1" name="kode_sbeli1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" id="kode_sbeli" name="kode_sbeli" value="'.(isset($_GET['id']) ? $row_cabang["kode_sbeli"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Pembelian</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_beli1" name="kode_beli1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" id="kode_beli" name="kode_beli" value="'.(isset($_GET['id']) ? $row_cabang["kode_beli"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Purchase Order</label>
                                            </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" id="kode_po1" name="kode_po1" value="'.(isset($_GET['id']) ? $row_cabang["kode_cabang"] : "").'">
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly="" id="kode_po" name="kode_po" value="'.(isset($_GET['id']) ? $row_cabang["kode_po"] : "").'">
					    </div>
                                        </div>
					</div>

                                    </div><!-- /.box-body -->

                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Cabang';
    $submenu	= "cabang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $cabang	= get_nama_cabang($loggedin['cabang']);
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group,$cabang);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>