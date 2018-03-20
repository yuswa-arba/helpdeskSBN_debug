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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Ekslarasi Rencana Anggaran Belanja");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_rab_ekslarasi` WHERE `kode_rab_ekslarasi`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_ekslarasi_rab_detail.php?c='.$row_data["kode_rab_ekslarasi"];
	
}



    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Detail Ekslarasi Rencana Anggaran Belanja</h3>
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
												<input type="text" readonly="" class="form-control" id="total_biaya" name="total_biaya"value="'.(isset($_GET['c']) ? $row_data["total_biaya"] : "").'">
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
												<input type="text" readonly="" class="form-control" id="biaya_operasional" name="biaya_operasional"  value="'.(isset($_GET['c']) ? $row_data["biaya_operasional"] : "").'">
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
												<input type="text" readonly="" class="form-control" id="pembelian" name="pembelian" value="'.(isset($_GET['c']) ? $row_data["pembelian"] : "").'">
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
												<input type="text" readonly="" class="form-control" id="total_pendapatan" name="total_pendapatan" value="'.(isset($_GET['c']) ? $row_data["total_pendapatan"] : "").'">
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
												<input type="text" readonly="" class="form-control" id="laba_rugi" name="laba_rugi"  value="'.(isset($_GET['c']) ? $row_data["laba_rugi"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Total Biaya Setelah Ekslarasi</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="total_biaya_setelah_ekslarasi" name="total_biaya_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_biaya_setelah_ekslarasi"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Biaya Oprasional setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="biaya_operasional_setelah_ekslarasi" name="biaya_operasional_setelah_ekslarasi" value="'.(isset($_GET['c']) ?  $row_data["biaya_operasional_setelah_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Pembelian Setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="pembelian_setelah_ekslarasi" name="pembelian_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["pembelian_setelah_ekslarasi"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Total Pendapatan Setelah Ekslarasi</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="total_pendapatan_setelah_ekslarasi" name="total_pendapatan_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_pendapatan_setelah_ekslarasi"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Laba Rugi setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="laba_rugi_setelah_ekslarasi" name="laba_rugi_setelah_ekslarasi" value="'.(isset($_GET['c']) ?  $row_data["laba_rugi_setelah_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Probability Index Setelah Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="probability_index_setelah_ekslarasi" name="probability_index_setelah_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["probability_index_setelah_ekslarasi"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Total Biaya Ekslarasi</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="total_Biaya_ekslarasi" name="total_Biaya_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_biaya_ekslarasi"] :  "").'">
											</div>
											<div class="col-xs-2">
												<label>Total Pendapatan Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="total_pendapatan_ekslarasi" name="total_pendapatan_ekslarasi" value="'.(isset($_GET['c']) ?  $row_data["total_pendapatan_ekslarasi"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Total Laba Rugi Ekslarasi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" readonly="" class="form-control" id="total_laba_rugi_ekslarasi" name="total_laba_rugi_ekslarasi"  value="'.(isset($_GET['c']) ? $row_data["total_laba_rugi_ekslarasi"] : "").'">
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