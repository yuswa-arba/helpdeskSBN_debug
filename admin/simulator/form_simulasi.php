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
if($loggedin = logged_inAdmin())
{
    if($loggedin["group"] == 'admin')
    {
        global $conn;
		$conn_soft = Config::getInstanceSoft();


		$content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Simulasi</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pilih Paket</label>
					    </div>
					    <div class="col-xs-3">
							<select name="id_paket" class="form-control">';
							
					$sql_paket = mysql_query("SELECT * FROM `gx_paket2` WHERE `level`='0';", $conn);
					while($row_paket = mysql_fetch_array($sql_paket))
					{
						$content .='<option value="'.$row_paket["id_paket"].'">'.$row_paket["nama_paket"].'</option>';
					}
								
					$content .='
							</select>
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal Aktivasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="datepicker" name="tanggal_aktivasi" required="" value="'.date("d-m-Y").'">
					    </div>
                                        </div>
					</div> 
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" maxlength="20" name="uangmuka" id="harga" value="">
						</div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Invoice AP</label>
					    </div>
					    <div class="col-xs-3">
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" name="invoice_ap" value="1" checked="">
										Yes
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="invoice_ap" value="0">No
									</label>
								</div>
							</div>
						</div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Jumlah AP</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" maxlength="4" name="jumlah_ap" value="1">
						</div>
                    </div>
					</div>
					
					
					
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Hitung simulasi</button>
                                    </div>
                                </form>
							</div><!-- /.box -->';
								
if(isset($_POST["submit"]))
{
	$id_paket	= isset($_POST['id_paket']) ? mysql_real_escape_string(trim($_POST['id_paket'])) : '';
    $uangmuka	= isset($_POST['uangmuka']) ? mysql_real_escape_string(trim($_POST['uangmuka'])) : '';
	$invoice_ap	= isset($_POST['invoice_ap']) ? mysql_real_escape_string(trim($_POST['invoice_ap'])) : '';
    $jumlah_ap	= isset($_POST['jumlah_ap']) ? mysql_real_escape_string(trim($_POST['jumlah_ap'])) : '';
    $tanggal_aktivasi	= isset($_POST['tanggal_aktivasi']) ? mysql_real_escape_string(trim($_POST['tanggal_aktivasi'])) : '';
	
	$uangmuka = str_replace( ',', '', $uangmuka );
	
	if($invoice_ap == 1)
	{
		$invoice_ap = ($jumlah_ap * 220000);
	}
	
	$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, date("m", strtotime($tanggal_aktivasi)), date("Y", strtotime($tanggal_aktivasi)));
	$hari_ini	= (int)date("d", strtotime($tanggal_aktivasi));
	
	
	$sum_aktivasi_sd_akhirbulan = $jumlah_hari - $hari_ini + 1;
	$total_hari_pengurangan = $jumlah_hari - $sum_aktivasi_sd_akhirbulan;

	$row_paket		= mysql_fetch_array(mysql_query("SELECT * FROM `gx_paket2` WHERE `id_paket` = '".$id_paket."' LIMIT 1;", $conn));
	$tagihanperhari = ($row_paket["monthly_fee"] + $row_paket["abonemen_video"]) / $jumlah_hari;
	$total_tagihan	= $sum_aktivasi_sd_akhirbulan * $tagihanperhari;
	$ppn			= 10/100 * $total_tagihan;
	$invoice_aktivasi		= $total_tagihan + $ppn;
	
	$invoice_setup		= (10/100 * $row_paket["setup_fee"]) + $row_paket["setup_fee"];
	if($hari_ini < 26)
	{
		$bulanan			= $row_paket["monthly_fee"] + $row_paket["abonemen_video"] + $row_paket["abonemen_voip"];
		$invoice_bulanan	= (10/100 * $bulanan) + $bulanan;
	}
	else
	{
		$invoice_bulanan = 0;
	}
	$sisa_saldo		= $uangmuka - ($invoice_bulanan + $invoice_setup + $invoice_aktivasi + $invoice_ap);
	//$content .= 'JUMLAH HARI : '.(int)$tagihanperhari.'<br>';
	//
	//$content .= 'ID PAKET : '.$id_paket.'<br>';
	//$content .= 'UANG MUKA : '.(int)$uangmuka.'<br>';
	//$content .= 'INVOICE AP : '.$invoice_ap.'<br>';
	//$content .= 'TANGGAL AKTIVASI : '.date("Y-m-d", strtotime($tanggal_aktivasi)).'<br>';
	
	$content .='<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Hasil Simulasi</h3>
					</div>
                                
                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3" align="center">
						<label> </label>
					    </div>
					    <div class="col-xs-4" align="center">
						<label>PERHITUNGAN INVOICE</label>
					    </div>
					    <div class="col-xs-4" align="center">
						<label></label>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tanggal Blokir</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="tanggal_blokir" value="4">
					    </div>
					    
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>UANGMUKA</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="uangmuka" id="harga" value="'.(int)$uangmuka.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>INVOICE SETUP FEE</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="monthly" id="harga" value="'.(int)$invoice_setup.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>INVOICE AKTIVASI</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="monthly" id="harga" value="'.(int)$invoice_aktivasi.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>INVOICE BULANAN</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="monthly" id="harga" value="'.(int)$invoice_bulanan.'">
					    </div>
					    
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>INVOICE AP BDCOM</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="monthly" id="harga" value="'.(int)$invoice_ap.'">
					    </div>
					    
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>SISA SALDO (UANGMUKA - TOTAL SEMUA INVOICE)</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="monthly" id="harga" value="'.(int)$sisa_saldo.'">
					    </div>
					    
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3" align="center">
						<label> </label>
					    </div>
					    <div class="col-xs-4" align="center">
						<label>PERHITUNGAN AKTIVASI BARU</label>
					    </div>
					    <div class="col-xs-4" align="center">
						<label></label>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>Tagihan Perhari</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="daily" id="harga" value="'.(int)$tagihanperhari.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
							<label>jumlah Hari Aktivasi</label>
					    </div>
					    <div class="col-xs-4">
							<input type="text" readonly="" class="form-control" name="hari_aktivasi" value="'.$sum_aktivasi_sd_akhirbulan.'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Tagihan Prorate</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="total" id="harga" value="'.(int)$total_tagihan.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>PPN</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="ppn" id="harga" value="'.(int)$ppn.'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Tagihan + PPN</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" readonly="" class="form-control" name="totalppn" id="harga" value="'.(int)$invoice_aktivasi.'">
					    </div>
                    </div>
					</div>
				</div>
			</div>';
					
}

$content .='
                           
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
		
		$plugins = '
		<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0,
		allowNegative: true
	    });
        </script>
		';
		
		$title	= 'Form Simulasi';
		$submenu= "simulator";
		$user	= ucfirst($loggedin["username"]);
		$group	= $loggedin['group'];
		$template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
		
		echo $template;
	}
}
else
{
	header("location: ".URL_ADMIN."logout.php");
}

?>