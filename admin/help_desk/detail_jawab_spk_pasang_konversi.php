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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Jawab SPK pasang Konversi");
 
if(isset($_GET["id"]))
{
    $id_jawab_spk_pasang_konversi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_jawab_spk_pasangkonversi		= "SELECT * FROM `gx_jawab_spk_pasang_konversi` WHERE `id_jawab_spk_pasang_konversi`='$id_jawab_spk_pasang_konversi' LIMIT 0,1;";
    $sql_jawab_spk_pasangkonversi		= mysql_query($query_jawab_spk_pasangkonversi, $conn);
    $row_jawab_spk_pasang_konversi		= mysql_fetch_array($sql_jawab_spk_pasangkonversi);
	$data_jawab_spk_pasang_konversi_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_jawab_spk_pasang_konversi[id_teknisi]'", $conn));
	$data_jawab_spk_pasang_konversi_teknisi2 = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_jawab_spk_pasang_konversi[id_teknisi_2]'", $conn));
	$data_jawab_spk_pasang_konversi_teknisi3 = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_jawab_spk_pasang_konversi[id_teknisi_3]'", $conn));
	$data_jawab_spk_pasang_konversi_teknisi4 = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_jawab_spk_pasang_konversi[id_teknisi_4]'", $conn));
	$data_jawab_spk_pasang_konversi_teknisi5 = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_jawab_spk_pasang_konversi[id_teknisi_5]'", $conn));
	$data_jawab_spk_pasang_konversi_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_jawab_spk_pasang_konversi[id_marketing]'", $conn));
   
}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Jawab SPK Pasang Konversi</h3>
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
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=jawab_spk_pasang_konversi\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Jawab SPK Pasang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_jawab_spk_pasang" name="kode_jawab_spk_pasang" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_jawab_spk_pasang"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No SPK Pasang Konversi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_spk_pasang" name="kode_spk_pasang" required="" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_spk_pasang"] : "").'">
											</div>
										</div>
										</div> 
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="kode_customer" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="kode_paket" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_paket"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="nama_paket" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["nama_paket"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>User ID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["uid"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Telp</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="telp" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["telp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Link Budget</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_linkbudget" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["kode_linkbudget"] : "").'">
											</div>
											
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alamat" class="form-control" placeholder="Alamat" style="resize: none;"> '.(isset($_GET["id"]) ? $row_jawab_spk_pasang_konversi['alamat'] :"").' </textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Teknisi 1</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="id_teknisi" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['id_teknisi'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_pasang_konversi_teknisi['cNama'] :"") .'">
											</div>
											<div class="col-xs-2">
												  <label>Marketing</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="id_marketing" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['id_marketing'] :"") .'">
												<input class="form-control" readonly="" name="nama_marketing" placeholder="Marketing" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_pasang_konversi_marketing['cNama'] :"").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Teknisi 2</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="id_teknisi_2" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['id_teknisi_2'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi_2" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_pasang_konversi_teknisi2['cNama'] :"") .'">
											</div>
											<div class="col-xs-2">
												<label>Teknisi 4</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="id_teknisi_4" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['id_teknisi_4'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi_4" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_pasang_konversi_teknisi4['cNama'] :"") .'">
											</div>
										</div>
										</div>
								
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Teknisi 3</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="id_teknisi_3" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['id_teknisi_3'] :"") .'">
													<input class="form-control" readonly="" name="nama_teknisi_3" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_pasang_konversi_teknisi3['cNama'] :"") .'">
											</div>
											<div class="col-xs-2">
												<label>Teknisi 5</label>
											</div>
											<div class="col-xs-4">
												<input class="form-control" readonly="" name="id_teknisi_5" type="hidden" value="'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['id_teknisi_5'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi_5" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET['id']) ? $data_jawab_spk_pasang_konversi_teknisi5['cNama'] :"") .'">
											</div>
										</div>
										</div>
								   
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Status</label>
											</div>
											<div class="col-xs-10">
												<table>
													<tr>
														<td>
															'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi['status'] :"") .'
														</td>
													</tr>
												</table>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Perkerjaan</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="pekerjaan" readonly="" class="form-control" placeholder="Pekerjaan" style="resize: none;">'.(isset($_GET["id"]) ? $row_jawab_spk_pasang_konversi['pekerjaan'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Solusi</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="solusi" readonly="" class="form-control" placeholder="Solusi" style="resize: none;">'.(isset($_GET["id"]) ? $row_jawab_spk_pasang_konversi['solusi'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alat Yang Terpasang</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alat_terpasang" readonly="" class="form-control" placeholder="Alat Yang Terpasang" style="resize: none;">'.(isset($_GET["id"]) ? $row_jawab_spk_pasang_konversi['alat_terpasang'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_jawab_spk_pasang_konversi["user_upd"]." ".$row_jawab_spk_pasang_konversi["date_upd"] : "").'
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

    $title	= 'Detail Jawab SPK Pasang Konversi';
    $submenu	= "jawab_spk_pasang_konversi";
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