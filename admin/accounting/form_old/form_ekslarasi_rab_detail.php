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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Ekslarasi Rencana Anggaran Belanja");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_rab_ekslarasi` WHERE `kode_rab_ekslarasi`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_ekslarasi_rab_detail.php?c='.$row_data["kode_rab_ekslarasi"];
	
}



    $content ='<section class="content-header">
                    <h1>
                        Form Ekslarasi Rencana Anggaran Belanja
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Ekslarasi Rencana Anggaran Belanja</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Cabang</label>
											</div>
											<div class="col-xs-2">
												<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['c']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['c']) ? $row_data["nama_cabang"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['c']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
											<div class="col-xs-2">
												<label>Total Biaya</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="total_biaya" name="total_biaya"value="'.(isset($_GET['c']) ? $row_data["total_biaya"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>No Ekslarasi RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_rab_ekslarasi" name="no_rab_ekslarasi" required="" value="'.(isset($_GET['c']) ? $row_data["kode_rab_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>No Persetujuan RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_persetujaun_rab" name="no_persetujuan_rab" required="" value="'.(isset($_GET['c']) ? $row_data["kode_rab_persetujuan"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Biaya Operasional</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="biaya_operasional" name="biaya_operasional"  value="'.(isset($_GET['c']) ? $row_data["biaya_operasional"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>keterangan</label>
											</div>
											<div class="col-xs-2">
												<textarea name="keterangan" readonly="" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['c']) ? $row_data['keterangan'] :"").'</textarea>
											</div>
											<div class="col-xs-2">
												<label>Periode</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="periode" name="periode" required="" value="'.(isset($_GET['c']) ? $row_data["periode"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Pembelian</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="pembelian" name="pembelian" value="'.(isset($_GET['c']) ? $row_data["pembelian"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Probability Index</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="probability_index" name="probability_index" required="" value="'.(isset($_GET['c']) ? $row_data["probability_index"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Target User Baru</label>
											</div>
											<div  class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="target_user_baru" name="target_user_baru" required="" value="'.(isset($_GET['c']) ? $row_data["target_user_baru"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Total Pendapatan</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="total_pendapatan" name="total_pendapatan" value="'.(isset($_GET['c']) ? $row_data["total_pendapatan"] : "").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Pembuat RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="pembuat_rab" name="pembuat_rab"  value="'.(isset($_GET['c']) ? $row_data["pembuat_rab"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Pemeriksa RAB</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="pemeriksa_rab" name="pemeriksa_rab" value="'.(isset($_GET['c']) ?  $row_data["pemeriksa_rab"] : $loggedin["username"]).'">
											</div>
											<div class="col-xs-2">
												<label>Laba Rugi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="laba_rugi" name="laba_rugi"  value="'.(isset($_GET['c']) ? $row_data["laba_rugi"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Total Biaya Setelah Ekslarasi</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="total_biaya_setelah_ekslarasi" name="total_biaya_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_biaya_setelah_ekslarasi"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Biaya Oprasional setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="biaya_operasional_setelah_ekslarasi" name="biaya_operasional_setelah_ekslarasi" value="'.(isset($_GET['c']) ?  $row_data["biaya_operasional_setelah_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Pembelian Setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="pembelian_setelah_ekslarasi" name="pembelian_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["pembelian_setelah_ekslarasi"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Total Pendapatan Setelah Ekslarasi</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="total_pendapatan_setelah_ekslarasi" name="total_pendapatan_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_pendapatan_setelah_ekslarasi"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Laba Rugi setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="laba_rugi_setelah_ekslarasi" name="laba_rugi_setelah_ekslarasi" value="'.(isset($_GET['c']) ?  $row_data["laba_rugi_setelah_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Probability Index Setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="probability_index_setelah_ekslarasi" name="probability_index_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["probability_index_setelah_ekslarasi"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Total Biaya Ekslarasi</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="total_Biaya_ekslarasi" name="total_Biaya_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_biaya_ekslarasi"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Total Pendapatan Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="total_pendapatan_ekslarasi" name="total_pendapatan_ekslarasi" value="'.(isset($_GET['c']) ?  $row_data["total_pendapatan_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Total Laba Rugi Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="total_laba_rugi_ekslarasi" name="total_laba_rugi_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_laba_rugi_ekslarasi"] : "").'">
											</div>
										</div>
										</div>
										
										<table style="width:100%;">
					<tbody>
					    
					    <tr>
						<td colspan="2">&nbsp;</td>
					    </tr>
					    <tr>
						<td colspan="2">
					    <table width="100%" cellspacing="10" class="table table-bordered table-striped">
							    <tbody><tr>
							      <th rowspan="2" style="vertical-align: middle;" width="1%">
								  No.
							      </th>
								   <th rowspan="2" style="vertical-align: middle;" width="15%">
								  No. Perkiraan
							      </th>
							      <th rowspan="2" style="vertical-align: middle;" width="15%">
								  Nama Account
							      </th>
							      <th colspan="2" width="25%">
								  Realisasi Bulan Sekarang
							      </th>
							      <th colspan="2" width="20%">
								  ACC RAB
							      </th>
								  <th colspan="2" width="20%">
								  Ekslarasi RAB
							      </th>
							      <th rowspan="2" style="vertical-align: middle;" width="15%">
								  Remarks
							      </th>
								  <th rowspan="2" style="vertical-align: middle;" width="10%">
							      #
							      </th>
								  <tr>
	
									<th>Pendapatan</th>
									<th>Biaya</th>
									<th>Pendapatan</th>
									<th>Biaya</th>
									<th>Pendapatan</th>
									<th>Biaya</th>
									</tr>
									
	
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_rab					 = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_rab_item	 = "SELECT * FROM `gx_rab_ekslarasi_detail` WHERE `kode_rab_ekslarasi` ='".$kode_rab."' AND `level` = '0';";
    $sql_rab_item	 = mysql_query($query_rab_item, $conn);
    $id_detail_rab 	 = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_rab_detail = "SELECT * FROM `gx_rab_ekslarasi_detail` WHERE `kode_rab_ekslarasi` ='".$kode_rab."' AND `level` = '0' AND `id_rab_ekslarasi_detail` = '".$id_detail_rab."' LIMIT 0,1;";
    //echo $query_rab_item;
	$sql_rab_detail   = mysql_query($query_rab_detail, $conn);
    $row_rab_detail 	 = mysql_fetch_array($sql_rab_detail);
    $no = 1;
    $total_pendapatan_sekarang = 0;
    $total_biaya_sekarang = 0;
	$total_pendapatan_persetujuan = 0;
	$total_biaya_persetujuan = 0;
	$total_pendapatan_ekslarasi = 0;
	$total_biaya_ekslarasi = 0;
    while($row_rab_item = mysql_fetch_array($sql_rab_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_rab_item["no_perkiraan"].'</td>
	<td>'.$row_rab_item["nama_account"].'</td>
	<td>'.$row_rab_item["pendapatan_sekarang"].'</td>
	<td>'.$row_rab_item["biaya_sekarang"].'</td>
	<td>'.$row_rab_item["pendapatan_persetujuan"].'</td>
	<td>'.$row_rab_item["biaya_persetujuan"].'</td>
	<td>'.$row_rab_item["pendapatan_ekslarasi"].'</td>
	<td>'.$row_rab_item["biaya_ekslarasi"].'</td>
	<td>'.$row_rab_item["remarks"].'</td>
	<td><a href="form_ekslarasi_rab_detail?c='.$row_rab_item["kode_rab_ekslarasi"].'&id='.$row_rab_item["id_rab_ekslarasi_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>
	';
	$no++;
	$total_pendapatan_sekarang = $total_pendapatan_sekarang + $row_rab_item["pendapatan_sekarang"];
	$total_biaya_sekarang = $total_biaya_sekarang + $row_rab_item["biaya_sekarang"];
	$total_pendapatan_persetujuan = $total_pendapatan_persetujuan + $row_rab_item["pendapatan_persetujuan"];
	$total_biaya_persetujuan = $total_biaya_persetujuan + $row_rab_item["biaya_persetujuan"];
	$total_pendapatan_ekslarasi = $total_pendapatan_ekslarasi + $row_rab_item["pendapatan_ekslarasi"];
	$total_biaya_ekslarasi = $total_biaya_ekslarasi + $row_rab_item["biaya_ekslarasi"];
    }
}else{
	
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}

	$bulan_sebelumnya = date("Y-m");
    $bulansebelum = $bulan_sebelumnya;
	//echo $bulansebelum;
	
	$sql_kas_masuk = "SELECT SUM(total) AS total_kasmasuk FROM `gx_kas_masuk` WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_kasmasuk = mysql_query($sql_kas_masuk, $conn);
    $total_kas_masuk = mysql_fetch_array($result_kasmasuk);
    //echo $sql_kas_masuk;
	
	$sql_kas_kecil_masuk = "SELECT SUM(total) AS total_kaskecilmasuk FROM `gx_kas_kecil_masuk`  WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_kaskecilmasuk = mysql_query($sql_kas_kecil_masuk, $conn);
    $total_kas_kecil_masuk = mysql_fetch_array($result_kaskecilmasuk);
    
	$sql_bank_masuk = "SELECT SUM(total) AS total_bankmasuk FROM `gx_bank_masuk`  WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_bankmasuk = mysql_query($sql_bank_masuk, $conn);
    $total_bank_masuk = mysql_fetch_array($result_bankmasuk);
	
	$sql_kasir_cso = "SELECT SUM(total) AS total_kasir FROM `gx_kasir_cso`  WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_kasir = mysql_query($sql_kasir_cso, $conn);
    $total_kasir_cso = mysql_fetch_array($result_kasir);
	
	$sql_kas_keluar = "SELECT SUM(total) AS total_kaskeluar FROM `gx_kas_keluar` WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_kaskeluar = mysql_query($sql_kas_keluar, $conn);
    $total_kas_keluar = mysql_fetch_array($result_kaskeluar);
    
	$sql_kas_kecil_keluar = "SELECT SUM(total) AS total_kaskecilkeluar FROM `gx_kas_kecil_keluar`  WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_kaskecilkeluar = mysql_query($sql_kas_kecil_keluar, $conn);
    $total_kas_kecil_keluar = mysql_fetch_array($result_kaskecilkeluar);
    
	$sql_bank_keluar = "SELECT SUM(total) AS total_bankkeluar FROM `gx_bank_keluar`  WHERE `tgl_transaction` LIKE '".$bulansebelum."%' ";
    $result_bankkeluar = mysql_query($sql_bank_keluar, $conn);
    $total_bank_keluar = mysql_fetch_array($result_bankkeluar);
	
	
	$pendapatan_sekarang 	= $total_kas_masuk["total_kasmasuk"] + $total_kas_kecil_masuk["total_kaskecilmasuk"] + $total_bank_masuk["total_bankmasuk"] + $total_kasir_cso["total_kasir"] + 0;
	$biaya_sekarang		= $total_kas_keluar["total_kaskeluar"] + $total_kas_kecil_keluar["total_kaskecilkeluar"] + $total_bank_keluar["total_bankkeluar"] + 0;
    

$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="2" align="right">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
								    '.$total_pendapatan_sekarang.'
							    </td>
								<td  align="right">
								    '.$total_biaya_sekarang.'
							    </td>
								<td  align="right">
								    '.$total_pendapatan_persetujuan.'
							    </td>
								<td  align="right">
								    '.$total_biaya_persetujuan.'
							    </td>
								<td  align="right">
								    '.$total_pendapatan_ekslarasi.'
							    </td>
								<td  align="right">
								    '.$total_biaya_ekslarasi.'
							    </td>
							   
						    </tr>
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM Detail RAB</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_rab_detail["id_rab_ekslarasi_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_rab" value="'.(isset($_GET['c']) ? $kode_rab : "").'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>No Perkiraan</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="no_perkiraan" id="no_perkiraan" value="'.(isset($_GET['id']) ? $row_rab_detail["no_perkiraan"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Nama Account</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text"  class="form-control" name="nama_account" id="nama_account" value="'.(isset($_GET['id']) ? $row_rab_detail["nama_account"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Pendapatan Sekarang</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly="" class="form-control" name="pendapatan_sekarang" id="pendapatan_sekarang" value="'.(isset($_GET['id']) ? $row_rab_detail["pendapatan_sekarang"] : $pendapatan_sekarang).'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Biaya Sekarang</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly="" class="form-control" name="biaya_sekarang" id="biaya_sekarang" value="'.(isset($_GET['id']) ? $row_rab_detail["biaya_sekarang"] : $biaya_sekarang).'" >
					    </div>
                    </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Pendapatan Persetujuan</label>
					    </div>
					    <div class="col-xs-8">
							<input readonly=""  type="text" class="form-control" name="pendapatan_persetujuan" id="pendapatan_persetujuan" value="'.(isset($_GET['id']) ? $row_rab_detail["pendapatan_persetujuan"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Biaya persetujuan</label>
					    </div>
					    <div class="col-xs-8">
							<input readonly="" type="text" class="form-control" name="biaya_persetujuan" id="biaya_persetujuan" value="'.(isset($_GET['id']) ? $row_rab_detail["biaya_persetujuan"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Pendapatan Ekslarasi</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="pendapatan_ekslarasi" id="pendapatan_ekslarasi" value="'.(isset($_GET['id']) ? $row_rab_detail["pendapatan_ekslarasi"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Biaya Ekslarasi</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="biaya_ekslarasi" id="biaya_ekslarasi" value="'.(isset($_GET['id']) ? $row_rab_detail["biaya_ekslarasi"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Remarks</label>
					    </div>
					    <div class="col-xs-8">
							<textarea name="remarks"" class="form-control" placeholder="Remarks" style="resize: none;">'.(isset($_GET['id']) ? $row_rab_detail['remarks'] :"").'</textarea>
					    </div>
                    </div>
					</div>
                     
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_rab_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_rab_detail["user_upd"]." ".$row_rab_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" value="Submitlock" name="savelock" class="btn btn-primary">Save & Lock</button>  <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Tambah</button>
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
	
	$kode_rab				= isset($_POST['kode_rab']) ? mysql_real_escape_string(trim($_POST['kode_rab'])) : '';
    $no_perkiraan			= isset($_POST['no_perkiraan']) ? mysql_real_escape_string(trim($_POST['no_perkiraan'])) : '';
	$nama_account   		= isset($_POST['nama_account']) ? mysql_real_escape_string(trim($_POST['nama_account'])) : '';
	$pendapatan_sekarang	= isset($_POST['pendapatan_sekarang']) ? mysql_real_escape_string(trim($_POST['pendapatan_sekarang'])) : '';
    $biaya_sekarang 		= isset($_POST['biaya_sekarang']) ? mysql_real_escape_string(trim($_POST['biaya_sekarang'])) : '';
	$pendapatan_persetujuan	= isset($_POST['pendapatan_persetujuan']) ? mysql_real_escape_string(trim($_POST['pendapatan_persetujuan'])) : '';
    $biaya_persetujuan 		= isset($_POST['biaya_persetujuan']) ? mysql_real_escape_string(trim($_POST['biaya_persetujuan'])) : '';
	$pendapatan_ekslarasi	= isset($_POST['pendapatan_ekslarasi']) ? mysql_real_escape_string(trim($_POST['pendapatan_ekslarasi'])) : '';
    $biaya_ekslarasi 		= isset($_POST['biaya_ekslarasi']) ? mysql_real_escape_string(trim($_POST['biaya_ekslarasi'])) : '';
	$remarks 				= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	
	$sql_insert = "INSERT INTO `gx_rab_ekslarasi_detail` (`id_rab_ekslarasi_detail`, `kode_rab_ekslarasi`, `no_perkiraan`,
						  `nama_account`, `pendapatan_sekarang`, `biaya_sekarang`, `pendapatan_persetujuan`, `biaya_persetujuan`, `pendapatan_ekslarasi`, `biaya_ekslarasi`, `remarks`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_rab."', '".$no_perkiraan."',
						  '".$nama_account."', '".$pendapatan_sekarang."', '".$biaya_sekarang."', '".$pendapatan_persetujuan."', '".$biaya_persetujuan."', '".$pendapatan_ekslarasi."', '".$biaya_ekslarasi."', '".$remarks."',
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
			window.location.href='".URL_ADMIN."accounting/form_ekslarasi_rab_detail.php?c=$kode_rab';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode_rab				= isset($_POST['kode_rab']) ? mysql_real_escape_string(trim($_POST['kode_rab'])) : '';
    $no_perkiraan			= isset($_POST['no_perkiraan']) ? mysql_real_escape_string(trim($_POST['no_perkiraan'])) : '';
	$nama_account   		= isset($_POST['nama_account']) ? mysql_real_escape_string(trim($_POST['nama_account'])) : '';
	$pendapatan_sekarang	= isset($_POST['pendapatan_sekarang']) ? mysql_real_escape_string(trim($_POST['pendapatan_sekarang'])) : '';
    $biaya_sekarang 		= isset($_POST['biaya_sekarang']) ? mysql_real_escape_string(trim($_POST['biaya_sekarang'])) : '';
	$pendapatan_persetujuan	= isset($_POST['pendapatan_persetujuan']) ? mysql_real_escape_string(trim($_POST['pendapatan_persetujuan'])) : '';
    $biaya_persetujuan 		= isset($_POST['biaya_persetujuan']) ? mysql_real_escape_string(trim($_POST['biaya_persetujuan'])) : '';
	$pendapatan_ekslarasi	= isset($_POST['pendapatan_ekslarasi']) ? mysql_real_escape_string(trim($_POST['pendapatan_ekslarasi'])) : '';
    $biaya_ekslarasi 		= isset($_POST['biaya_ekslarasi']) ? mysql_real_escape_string(trim($_POST['biaya_ekslarasi'])) : '';
	$remarks 				= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	
    $sql_update = "UPDATE `gx_rab_ekslarasi_detail` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_rab_ekslarasi_detail` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	=  "INSERT INTO `gx_rab_ekslarasi_detail` (`id_rab_ekslarasi_detail`, `kode_rab_ekslarasi`, `no_perkiraan`,
						  `nama_account`, `pendapatan_sekarang`, `biaya_sekarang`, `pendapatan_persetujuan`, `biaya_persetujuan`, `pendapatan_ekslarasi`, `biaya_ekslarasi`, `remarks`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_rab."', '".$no_perkiraan."',
						  '".$nama_account."', '".$pendapatan_sekarang."', '".$biaya_sekarang."', '".$pendapatan_persetujuan."', '".$biaya_persetujuan."', '".$pendapatan_ekslarasi."', '".$biaya_ekslarasi."', '".$remarks."',
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
			window.location.href='".URL_ADMIN."accounting/form_ekslarasi_rab_detail.php?c=$kode_rab';
			</script>";
			
}elseif(isset($_POST["savelock"]))
{
    
    $total_biaya		= isset($_POST['total_biaya']) ? mysql_real_escape_string(trim($_POST['total_biaya'])) : '';
    $biaya_operasional	= isset($_POST['biaya_operasional']) ? str_replace(",", "", $_POST['biaya_operasional']) : '';
	$pembelian			= isset($_POST['pembelian']) ? mysql_real_escape_string(trim($_POST['pembelian'])) : '';
    $total_pendapatan	= isset($_POST['total_pendapatan']) ? mysql_real_escape_string(trim($_POST['total_pendapatan'])) : '';
    $laba_rugi			= isset($_POST['laba_rugi']) ? mysql_real_escape_string(trim($_POST['laba_rugi'])) : '';
   
    $total_biaya_setelah_ekslarasi		= isset($_POST['total_biaya_setelah_ekslarasi']) ? mysql_real_escape_string(trim($_POST['total_biaya_setelah_ekslarasi'])) : '';
    $biaya_operasional_setelah_ekslarasi= isset($_POST['biaya_operasional_setelah_ekslarasi']) ? str_replace(",", "", $_POST['biaya_operasional_setelah_ekslarasi']) : '';
	$pembelian_setelah_ekslarasi		= isset($_POST['pembelian_setelah_ekslarasi']) ? mysql_real_escape_string(trim($_POST['pembelian_setelah_ekslarasi'])) : '';
    $total_pendapatan_setelah_ekslarasi	= isset($_POST['total_pendapatan_setelah_ekslarasi']) ? mysql_real_escape_string(trim($_POST['total_pendapatan_setelah_ekslarasi'])) : '';
    $laba_rugi_setetelah_ekslarasi		= isset($_POST['laba_rugi_seetelah_ekslarasi']) ? mysql_real_escape_string(trim($_POST['laba_rugi_seetelah_ekslarasi'])) : '';
   
	$total_biaya_ekslarasi		= isset($_POST['total_biaya_ekslarasi']) ? mysql_real_escape_string(trim($_POST['total_biaya_ekslarasi'])) : '';
    $total_pendapatan_ekslarasi	= isset($_POST['total_pendapatan_ekslarasi']) ? mysql_real_escape_string(trim($_POST['total_pendapatan_ekslarasi'])) : '';
    $total_laba_rugi_ekslarasi	= isset($_POST['total_laba_rugi_ekslarasi']) ? mysql_real_escape_string(trim($_POST['total_laba_rugi_ekslarasi'])) : '';
    
	$sql_update_lock = "UPDATE `gx_rab_ekslarasi` SET `status`='1', `total_biaya`='".$total_biaya."', `biaya_operasional`='".$biaya_operasional."', `pembelian`='".$pembelian."', `total_pendapatan`='".$total_pendapatan."', `laba_rugi`='".$laba_rugi."',
						`total_biaya_setelah_ekslarasi`='".$total_biaya_setelah_ekslarasi."', `biaya_operasional_setelah_ekslarasi`='".$biaya_operasional_setelah_ekslarasi."', `pembelian_setelah_ekslarasi`='".$pembelian_setelah_ekslarasi."', `total_pendapatan_setelah_ekslarasi`='".$total_pendapatan_setelah_ekslarasi."', `laba_rugi_setelah_ekslarasi`='".$laba_rugi_setelah_ekslarasi."',
						`total_biaya_ekslarasi`='".$total_biaya_ekslarasi."', `total_pendapatan_ekslarasi`='".$total_pendapatan_ekslarasi."', `total_laba_rugi_ekslarasi`='".$total_laba_rugi_ekslarasi."',   
						`date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
						WHERE `kode_rab_ekslarasi`='".$_GET["c"]."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_ekslarasi_rab';
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

    $title	= 'Form Ekslarasi RAB Detail';
    $submenu	= "ekslarasi_rab";
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