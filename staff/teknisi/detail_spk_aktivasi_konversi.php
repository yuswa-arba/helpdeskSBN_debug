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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail SPK Aktivasi Konversi");
        global $conn;
		$perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }


 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Aktivasi Konversi");
 
if(isset($_GET["id"]))
{
    $id_spk_aktivasi_konversi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_spk_aktivasikonversi		= "SELECT * FROM `gx_spk_aktivasi_konversi` WHERE `id_spk_aktivasi_konversi`='$id_spk_aktivasi_konversi' LIMIT 0,1;";
    $sql_spk_aktivasikonversi		= mysql_query($query_spk_aktivasikonversi, $conn);
    $row_spk_aktivasi_konversi		= mysql_fetch_array($sql_spk_aktivasikonversi);
	$data_spk_aktivasi_konversi_teknisi = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_spk_aktivasi_konversi[id_teknisi]'", $conn));
	$data_spk_aktivasi_konversi_marketing = mysql_fetch_array(mysql_query("SELECT `nama` FROM `gx_pegawai` WHERE `id_employee`='$row_spk_aktivasi_konversi[id_marketing]'", $conn));
   
}

    $content ='<section class="content-header">
                    <h1>
                        Detail SPK Aktivasi Konversi
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
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
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=spk_aktivasi_konversi\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No SPK Aktivasi Konversi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_spk_aktivasi_konversi" name="kode_spk_aktivasi_konversi" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_spk_aktivasi_konversi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No SPK Pasang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_spk_pasang" name="kode_spk_pasang" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_spk_pasang"] : "").'" onclick="return valideopenerform(\'data_spk_jawab_pasang_konversi.php?r=myForm&f=jawab_spk_pasang_konversi\',\'customer\');" >
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Jawab SPK Pasang</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_jawab_spk_pasang" name="kode_jawab_spk_pasang" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_jawab_spk_pasang"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No Link Budget</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="no_linkbudget" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["no_linkbudget"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>User ID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["uid"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Telp</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="telp" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["telp"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Koneksi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["kode_paket"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket" value="'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["nama_paket"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alamat" readonly="" class="form-control" placeholder="Alamat" style="resize: none;"> '.(isset($_GET["id"]) ? $row_spk_aktivasi_konversi['alamat'] :"").' </textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Teknisi</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="id_teknisi" type="hidden" value="'.(isset($_GET["id"]) ? $row_spk_aktivasi_konversi['id_teknisi'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET["id"]) ? $data_spk_aktivasi_konversi_teknisi['nama'] :"") .'">
												
											</div>
											<div class="col-xs-3">
											  <label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="id_employee" type="hidden" value="'.(isset($_GET["id"]) ? $row_spk_aktivasi_konversi['id_marketing'] :"") .'">
												<input class="form-control" readonly="" name="nama_marketing" placeholder="Nama Marketing" type="text" value="'.(isset($_GET["id"]) ? $data_spk_aktivasi_konversi_marketing['nama'] :"") .'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Perkerjaan</label>
											</div>
											<div  class="col-xs-9">
												<strong>AKTIVASI KONVERSI</strong>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_spk_aktivasi_konversi["user_upd"]." ".$row_spk_aktivasi_konversi["date_upd"] : "").'
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                </form>
                            </div><!-- /.box -->
							<div class="box">
                                <div class="box-body table-responsive">
							<legend>Data Jawab SPK Aktivasi Konversi</legend>
								  <table id="example1" class="table table-bordered table-striped">
												  <thead>
													<tr>	<th width="3%">no</th>
											  <th width="12%">Tanggal</th>
											  <th width="20%">No Jawab SPK </th>
											  <th>Solusi</th>
											  <th width="15%">Action</th>
													</tr>
												  </thead>
												  <tbody>';
								  
								  
									  $sql_jawab_spk_pasang_baru	= mysql_query("SELECT * FROM `gx_jawab_spk_aktivasi_konversi`
												  WHERE `level` =  '0' AND `id_teknisi` = '$loggedin[id_employee]' AND
												  `kode_spk_aktivasi` = '$row_spk_aktivasi_konversi[kode_spk_aktivasi_konversi]'
												  ORDER BY  `date_add` DESC LIMIT $start, $perhalaman;", $conn);
									  $sql_total_jawab_spk_pasang_baru	= mysql_num_rows(mysql_query("SELECT * FROM `gx_jawab_spk_aktivasi_konversi`
												  WHERE `level` =  '0' AND `id_teknisi` = '$loggedin[id_employee]'  AND
												  `kode_spk_aktivasi` = '$row_spk_aktivasi_konversi[kode_spk_aktivasi_konversi]'
												  ORDER BY  `date_add` DESC;", $conn));
									  $hal	="?";
									  $no = 1;
								  
									  while($r_spk_pasang_baru = mysql_fetch_array($sql_jawab_spk_pasang_baru))
									  {
									  $content .='<tr>
											  <td>'.$no.'.</td>
											  <td>'.$r_spk_pasang_baru['tanggal'].'</td>
											  <td>'.$r_spk_pasang_baru['kode_jawab_spk_aktivasi'].'</td>
											  <td>'.$r_spk_pasang_baru['solusi'].'</td>
											  <td><a href="detail_jawab_spk_aktivasi_konversi.php?id='.$r_spk_pasang_baru["id_jawab_spk_aktivasi_konversi"].'">Details</a>
										  </tr>';
									  $no++;
									  }
								  
								  $content .='</tbody>
								  </table>
                                </div><!-- /.box-body -->
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

    $title	= 'Form SPK Aktivasi Konversi';
    $submenu	= "spk_aktivasi_konversi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>