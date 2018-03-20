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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Master Gaji");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_rekap_absensi` WHERE `id_rekap`='$id_data' AND `level`='0' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content = '<section class="content-header">
                    <h1>
                        <!--Hitung Gaji-->
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                   <!-- <h3 class="box-title">Form Master Gaji</h3> -->
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label><h2>Hitung Bonus</h2></label>
											</div>
										</div>
										</div>
				
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Untuk Bulan</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="untuk_bulan" placeholder="" value="'.(isset($_GET['id']) ? $row_data["untuk_bulan"] : "").'">-->
												<select name="untuk_bulan" class="form-control" required="required">';
												$nama_bulan = array("Pilih Bulan", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
												    $content .= '<option value="">'.$nama_bulan[0].'</option>';
												    for($no=1; $no<=12; $no++){
													$content .= '<option value="'.$no.'">'.$nama_bulan[$no].'</option>';
												    }
												    
												$content .='    
												</select>
											</div>
											<div class="col-xs-2">
												<label>Tahun</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="tahun" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["tahun"] : "").'" required="" >-->
												<select name="tahun" class="form-control" required="required">';
												
												    
												    $content .= '<option value="">Pilih Tahun</option>';
												    for($thn=1970; $thn<=date("Y")+20; $thn++){
													$content .= '<option value="'.$thn.'">'.$thn.'</option>';
												    }
												$content .= '    
												</select>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Absensi</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Mulai Tanggal</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="mulai_tanggal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["mulai_tanggal"] : "").'" required="" >-->
												<select name="mulai_tanggal" class="form-control" required="required">';
												
												    $content .= '<option value="">Pilih Tanggal</option>';
												    for($tgl=1; $tgl<=31; $tgl++){
													$content .= '<option value="'.$tgl.'">'.$tgl.'</option>';
												    }
												$content .= '    
												</select>
											</div>
											<div class="col-xs-1">
												<label>sd</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="finnish_tanggal" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["finnish_tanggal"] : "").'" required="" >-->
												<select name="finnish_tanggal" class="form-control" required="required">';
												    $content .= '<option value="">Pilih Tanggal</option>';
												    for($tgl=1; $tgl<=31; $tgl++){
													$content .= '<option value="'.$tgl.'">'.$tgl.'</option>';
												    }
												$content .= '    
												</select>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Periode Penjualan</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Mulai Tanggal</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="mulai_tanggal_penjualan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["mulai_tanggal_penjualan"] : "").'" required="" >-->
												<select name="mulai_tanggal_penjualan" class="form-control" required="required">';
												    $content .= '<option value="">Pilih Tanggal</option>';
												    for($tgl=1; $tgl<=31; $tgl++){
													$content .= '<option value="'.$tgl.'">'.$tgl.'</option>';
												    }
												$content .= '    
												</select>
											</div>
											<div class="col-xs-1">
												<label>sd</label>
											</div>
											<div class="col-xs-4">
												<!--<input type="text" class="form-control" id="" name="finnish_tanggal_penjualan" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["finnish_tanggal_penjualan"] : "").'" required="" >-->
												<select name="finnish_tanggal_penjualan" class="form-control" required="required">';
												$content .= '<option value="">Pilih Tanggal</option>';
												    for($tgl=1; $tgl<=31; $tgl++){
													$content .= '<option value="'.$tgl.'">'.$tgl.'</option>';
												    }
												$content .= '    
												</select>
											</div>
											
										</div>
										</div>
												
																
 <table id="example1" class="table table-bordered table-striped">
               <!-- <thead>
                  <tr>
			<th width="3%">No.</th>
			';
			
			$content .= '
			<th width="15%">Action</th>
                  </tr>
                </thead>-->
                <tbody>';

		
if(isset($_POST["hitung"]))
{
// $	   				= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
$untuk_bulan	   			= isset($_POST['untuk_bulan']) ? mysql_real_escape_string(trim($_POST['untuk_bulan'])) : '';
$tahun	   				= isset($_POST['tahun']) ? mysql_real_escape_string(trim($_POST['tahun'])) : '';
$mulai_tanggal	   			= isset($_POST['mulai_tanggal']) ? mysql_real_escape_string(trim($_POST['mulai_tanggal'])) : '';
$finnish_tanggal	   		= isset($_POST['finnish_tanggal']) ? mysql_real_escape_string(trim($_POST['finnish_tanggal'])) : '';

$proses_tanggal_mulai 			= implode("-", array($tahun, $untuk_bulan, $mulai_tanggal));
$proses_tanggal_akhir 			= implode("-", array($tahun, $untuk_bulan, $finnish_tanggal));

//SELECT `id_master_gaji`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `A7`, `A8`, `A9`, `A10`, `A11`, `A12`, `A13`, `A14`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `C11`, `C12`, `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `D1`, `D2`, `D3`, `D4`, `D5`, `D6`, `D7`, `D8`, `D9`, `D10`, `D11`, `D12`, `D13`, `D14`, `D15`, `D16`, `D17`, `D18`, `D19`, `D20`, `D21`, `D22`, `D23`, `D24`, `D25`, `D26`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_master_gaji` WHERE 1
//SELECT `id_rekap`, `bulan`, `kode`, `nama`, `tanggal`, `check_in`, `check_out`, `ket`, `menit_terlambat`, `menit_pulang_awal`, `jam_lembur`, `keterangan`, `status`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_rekap_absensi` WHERE 1
$sql = "SELECT * FROM `gx_rekap_absensi` WHERE (`tanggal` BETWEEN '".$proses_tanggal_mulai."' AND '".$proses_tanggal_akhir."') AND `gx_rekap_absensi`.`level`='0'";
$data_hitung_gaji 			= mysql_fetch_array(mysql_query($sql, $conn));

$data_gaji = mysql_fetch_array(mysql_query("SELECT * FROM `gx_master_gaji` WHERE `level`='0' ORDER BY `id_master_gaji`", $conn));
$a1 = $data_gaji['A1']; // gaji pokok
$a2 = $data_gaji['A2']; // Tunjangan Jabatan
$a3 = $data_gaji['A3']; // dana pensiun
$a4 = $data_gaji['A4']; // Jamsostek
$a5 = $data_gaji['A5']; // Insentif Hadir
$a6 = $data_gaji['A6']; // Bonus Bulanan
$a7 = $data_gaji['A7']; // Potongan Absen Per Hari





//
//$d=cal_days_in_month(CAL_GREGORIAN,10,2005);
$sum_day=cal_days_in_month(CAL_GREGORIAN,$untuk_bulan,$tahun);
$sum_day_between = $finnish_tanggal - $mulai_tanggal + 1;
//sql count data + filter if status cuti/absen/normal/lembur
//SELECT DISTINCT petid, userid, (SELECT MAX(comDate) FROM comments WHERE petid=pet.id) AS lastComDate, (SELECT userid FROM comments WHERE petid=pet.id ORDER BY id DESC LIMIT 1) AS lastPosterID
//FROM pet LEFT JOIN comments ON pet.id = comments.petid
//WHERE userid='ABC' AND deviceID!='ABC' AND comDate>=DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 2 MONTH);

//SELECT (SELECT SUM(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND (`status`='normal' OR `status`='lembur')) AS `jumlah_absensi_masuk`, (SELECT SUM(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND `status`='absen') AS `jumlah_absensi_alpha`  FROM `gx_rekap_absensi`WHERE (`tanggal` BETWEEN '2015-12-1' AND '2015-12-29') AND `gx_rekap_absensi`.`level`='0'
//SELECT (SELECT COUNT(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND (`status`='normal' OR `status`='lembur')) AS `jumlah_absensi_masuk`, (SELECT COUNT(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND `status`='absen') AS `jumlah_absensi_alpha`  FROM `gx_rekap_absensi`WHERE (`tanggal` BETWEEN '2015-12-1' AND '2015-12-29') AND `gx_rekap_absensi`.`level`='0' LIMIT 1
$query = mysql_query($sql, $conn);
$data_gaji = array();
while($row = mysql_fetch_array($query)){
    $data_gaji[] = $row['bulan'];
}
//print_r($data_gaji);

//$sql_count_data = "SELECT (SELECT SUM(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND (`status`='normal' OR `status`='lembur')) AS `jumlah_absensi_masuk` FROM `gx_rekap_absensi`, (SELECT SUM(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND `status`='absen') AS `jumlah_absensi_alpha` WHERE (`tanggal` BETWEEN '".$proses_tanggal_mulai."' AND '".$proses_tanggal_akhir."') AND `gx_rekap_absensi`.`level`='0'";
$sql_count_data = "SELECT (SELECT COUNT(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND (`status`='normal' OR `status`='lembur')) AS `jumlah_absensi_masuk`, (SELECT COUNT(`id_rekap`) FROM `gx_rekap_absensi` WHERE `level`='0' AND `status`='absen') AS `jumlah_absensi_alpha`  FROM `gx_rekap_absensi`WHERE (`tanggal` BETWEEN '".$proses_tanggal_mulai."' AND '".$proses_tanggal_akhir."') AND `gx_rekap_absensi`.`level`='0' LIMIT 1";
$data_array = mysql_fetch_array(mysql_query($sql_count_data, $conn));

$content  .= '<!--';
$content  .= 'Jumlah Hari pada bulan : '.$sum_day.'<br>';
$content  .= 'Jumlah Hari dari sistem rekap absensi : '.$sum_day_between.'<br>';
$content  .= 'Jumlah Hari Kerja : '.$data_array['jumlah_absensi_masuk'].'<br>';
$content  .= 'Jumlah Hari Tidak Masuk : '.$data_array['jumlah_absensi_alpha'].'<br>';
$content  .= 'Gaji Pokok : '.$a1.'<br>';
$content  .= 'Tunjangan Jabatan : '.$a2.'<br>';
$content  .= 'Dana Pensiun : '.$a3.'<br>';
$content  .= 'Jamsostek : '.$a4.'<br>';
$content  .= 'Insentif Hadir : '.$a5.'<br>';
$content  .= 'Bonus Bulanan : '.$a6.'<br>';
$content  .= 'Potongan Absen Per Hari : '.$a7.'<br>';
$content  .= '-->';

$content .= '<tr><td colspan="2">Hitungan Gaji</td></tr>';
$content .= '<tr><td>Gaji Pokok : </td><td>'.(round(($data_array['jumlah_absensi_masuk']/$sum_day*$a1),2)).'</td></tr>';
$content .= '<tr><td>Tunjangan Jabatan : </td><td>'.$a2.'</td></tr>';
$content .= '<tr><td>Dana Pensiun : </td><td>'.$a3.'</td></tr>';
$content  .= '<tr><td>Jamsostek : </td><td>'.$a4.'</td></tr>';
$jumlah_absen = $data_array['jumlah_absensi_alpha'];
if($jumlah_absen=='0'){$insentif_hadir = $a5; }elseif($jumlah_absen=='1'){$insentif_hadir = $a5/2;}else{$insentif_hadir = 0;}
$content  .= '<tr><td>Insentif Hadir : </td><td>'.$insentif_hadir.'</td></tr>';
$content  .= '<tr><td>Bonus Bulanan : </td><td>'.$a6.'</td></tr>';
$content  .= '<tr><td>Potongan Absen Per Hari : </td><td>'.$a7.'</td></tr>';


}
		
$content .='</tbody>
</table>			
					
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="hitung" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
			

 			
}

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                $("#datepicker2").datepicker({format: "yyyy-mm-dd"});  
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

    $title	= 'Hitung Bonus';
    $submenu	= "hitung_bonus";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
} else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>
