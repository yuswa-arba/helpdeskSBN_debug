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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Persetujuan Rencana Anggaran Belanja");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_rab_persetujuan` WHERE `kode_rab_persetujuan`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_persetujuan_rab_detail.php?c='.$row_data["kode_rab_persetujuan"];
	
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-11">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Persetujuan Rencana Anggaran Belanja</h3>
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
												<label>No Persetujuan RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_rab_persetujuan" name="no_rab_persetujuan" required="" value="'.(isset($_GET['c']) ? $row_data["kode_rab_persetujuan"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>No Control RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_rab_control" name="no_rab_control" required="" value="'.(isset($_GET['c']) ? $row_data["kode_rab_control"] : "").'">
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
								  Realisasi Bulan Sebelumnya
							      </th>
							      <th colspan="2" width="20%">
								  RAB Sekarang
							      </th>
							      <th rowspan="2" style="vertical-align: middle;" width="15%">
								  Remarks
							      </th>
								 
								  <tr>
	
									<th>Pendapatan</th>
									<th>Biaya</th>
									<th>Pendapatan</th>
									<th>Biaya</th>
									</tr>
									
	
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_rab					 = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_rab_item	 = "SELECT * FROM `gx_rab_persetujuan_detail` WHERE `kode_rab_persetujuan` ='".$kode_rab."' AND `level` = '0';";
    $sql_rab_item	 = mysql_query($query_rab_item, $conn);
    $id_detail_rab 	 = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_rab_detail = "SELECT * FROM `gx_rab_persetujuan_detail` WHERE `kode_rab_persetujuan` ='".$kode_rab."' AND `level` = '0' AND `id_rab_persetujuan_detail` = '".$id_detail_rab."' LIMIT 0,1;";
   // echo $query_rab_detail;
	$sql_rab_detail   = mysql_query($query_rab_detail, $conn);
    $row_rab_detail 	 = mysql_fetch_array($sql_rab_detail);
    $no = 1;
    $total_pendapatan_sebelumnya = 0;
    $total_biaya_sebelumnya = 0;
	$total_pendapatan_sekarang = 0;
	$total_biaya_sekarang = 0;
    while($row_rab_item = mysql_fetch_array($sql_rab_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_rab_item["no_perkiraan"].'</td>
	<td>'.$row_rab_item["nama_account"].'</td>
	<td>'.$row_rab_item["pendapatan_sebelumnya"].'</td>
	<td>'.$row_rab_item["biaya_sebelumnya"].'</td>
	<td>'.$row_rab_item["pendapatan_sekarang"].'</td>
	<td>'.$row_rab_item["biaya_sekarang"].'</td>
	<td>'.$row_rab_item["remarks"].'</td>
	</tr>
	';
	$no++;
	$total_pendapatan_sebelumnya = $total_pendapatan_sebelumnya + $row_rab_item["pendapatan_sebelumnya"];
	$total_biaya_sebelumnya = $total_biaya_sebelumnya + $row_rab_item["biaya_sebelumnya"];
	$total_pendapatan_sekarang = $total_pendapatan_sekarang + $row_rab_item["pendapatan_sekarang"];
	$total_biaya_sekarang = $total_biaya_sekarang + $row_rab_item["biaya_sekarang"];
    }
}else{
	
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}

$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="2" align="right">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
								    '.$total_pendapatan_sebelumnya.'
							    </td>
								<td  align="right">
								    '.$total_biaya_sebelumnya.'
							    </td>
								<td  align="right">
								    '.$total_pendapatan_sekarang.'
							    </td>
								<td  align="right">
								    '.$total_biaya_sekarang.'
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

    $title	= 'Detail Persetujuan RAB';
    $submenu	= "persetujuan_rab";
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