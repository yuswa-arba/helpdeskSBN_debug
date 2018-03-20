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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Jawab SPK Aktivasi Konversi");
 
if(isset($_GET["id"]))
{
    $id_jawab_spk_aktivasi_konversi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_jawab_spk_aktivasikonversi		= "SELECT * FROM `gx_jawab_spk_aktivasi_konversi` WHERE `id_jawab_spk_aktivasi_konversi`='$id_jawab_spk_aktivasi_konversi' LIMIT 0,1;";
    $sql_jawab_spk_aktivasikonversi		= mysql_query($query_jawab_spk_aktivasikonversi, $conn);
    $row_jawab_spk_aktivasi_konversi		= mysql_fetch_array($sql_jawab_spk_aktivasikonversi);
	$data_jawab_spk_aktivasi_konversi_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_jawab_spk_aktivasi_konversi[id_teknisi]'", $conn));
	$data_jawab_spk_aktivasi_konversi_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_jawab_spk_aktivasi_konversi[id_marketing]'", $conn));
   $data_jawab_spk_aktivasi_konversi_teknisi_2 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_jawab_spk_aktivasi_konversi[id_teknisi_2]'", $conn));
   $data_jawab_spk_aktivasi_konversi_teknisi_3 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_jawab_spk_aktivasi_konversi[id_teknisi_3]'", $conn));
   $data_jawab_spk_aktivasi_konversi_teknisi_4 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_jawab_spk_aktivasi_konversi[id_teknisi_4]'", $conn));
   $data_jawab_spk_aktivasi_konversi_teknisi_5 = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_jawab_spk_aktivasi_konversi[id_teknisi_5]'", $conn));
}

    $content ='<section class="content-header">
                    <h1>
                        Detail SPK Aktivasi Konversi
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail SPK Aktivasi Konversi</h3>
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
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=jawab_spk_aktivasi_konversi\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Jawab SPK Aktivasi Konversi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_jawab_spk_aktivasi" name="kode_jawab_spk_aktivasi" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["kode_jawab_spk_aktivasi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No SPK Aktivasi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_spk_aktivasi" name="kode_spk_aktivasi" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["kode_spk_aktivasi"] : "").'" >
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["kode_customer"] : "").'" >
											</div>
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>User ID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["uid"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Telp</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="telp" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["telp"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Koneksi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["kode_paket"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["nama_paket"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alamat" readonly="" class="form-control" placeholder="Alamat" style="resize: none;"> '.(isset($_GET["id"]) ? $row_jawab_spk_aktivasi_konversi['alamat'] :"").' </textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Teknisi 1</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" readonly="" name="id_teknisi" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['id_teknisi'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_aktivasi_konversi_teknisi['nama'] :"") .'">
											</div>
											<div class="col-xs-3">
												  <label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" readonly="" name="id_marketing" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['id_marketing'] :"") .'">
												<input class="form-control" readonly="" name="nama_marketing" placeholder="Marketing" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_aktivasi_konversi_marketing['nama'] :"").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Teknisi 2</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" readonly="" name="id_teknisi_2" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['id_teknisi_2'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi_2" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_aktivasi_konversi_teknisi_2['nama'] :"") .'">
											</div>
											<div class="col-xs-3">
												<label>Teknisi 4</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" readonly="" name="id_teknisi_4" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['id_teknisi_4'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi_4" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_aktivasi_konversi_teknisi_4['nama'] :"") .'">
											</div>
										</div>
										</div>
								
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Teknisi 3</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" readonly="" name="id_teknisi_3" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['id_teknisi_3'] :"") .'">
													<input class="form-control" readonly="" name="nama_teknisi_3" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_aktivasi_konversi_teknisi_3['nama'] :"") .'">
											</div>
											<div class="col-xs-3">
												<label>Teknisi 5</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" readonly="" name="id_teknisi_5" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['id_teknisi_5'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi_5" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_aktivasi_konversi_teknisi_5['nama'] :"") .'">
											</div>
										</div>
										</div>
								   
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Status</label>
											</div>
											<div class="col-xs-3">
												'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi['status'] :"") .'
											</div>
											<div class="col-xs-3">
												<label>No Link Budget</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="no_linkbudget" value="'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["no_linkbudget"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Perkerjaan</label>
											</div>
											<div  class="col-xs-3">
												<strong>AKTIVASI KONVERSI</strong>
											</div>
											
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Solusi</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="solusi" readonly="" class="form-control" placeholder="Solusi" style="resize: none;">'.(isset($_GET["id"]) ? $row_jawab_spk_aktivasi_konversi['solusi'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alat Yang Terpasang</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alat_terpasang" readonly="" class="form-control" placeholder="Alat Yang Terpasang" style="resize: none;">'.(isset($_GET["id"]) ? $row_jawab_spk_aktivasi_konversi['alat_terpasang'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_jawab_spk_aktivasi_konversi["user_upd"]." ".$row_jawab_spk_aktivasi_konversi["date_upd"] : "").'
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

    $title	= 'detail Jawab SPK Aktivasi Konversi';
    $submenu	= "spk_aktivasi_konversi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;

    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>