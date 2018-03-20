<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */


include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
//SQL 
$table_main = "gx_master_gaji";
$table_detail = "";

//SELECT 
    $urutan = "ORDER BY `id_master_gaji` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_master_gaji` WHERE `level` =  '0'";

//INSERT 

//UPDATE
    //$sql_update_lock 
    $table_update_lock = "gx_master_gaji";
    $redirect_action_lock = "master_gaji.php";
    
//DELETE



//String Data View
    //Judul Form
    $judul_form = "Detail Gaji";
    $judul_table = "detail Gaji";
    
    //id web
    $title_header = 'Detail Gaji';
    $submenu_header = 'detail_gaji';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Detail Gaji");
    global $conn;
    $id_d = isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c_d = isset($_GET['C']) ? mysql_real_escape_string(trim($_GET['C'])) : '';
    $sql_d = "SELECT * FROM `gx_master_gaji` WHERE `id_master_gaji`='$id_d' ORDER BY `id_master_gaji` DESC LIMIT 0,1";
    $query_d = mysql_query($sql_d, $conn);
    $data_d = mysql_fetch_array($query_d);    
    
    
	//$				= $data_d[''];
	//SELECT `id`, `id_kenaikan_gaji`, `no_kenaikan_gaji`, `kode`, `tanggal`, `nama`, `kenaikan_ke`, `level_gaji`, `selisih`, `gaji_pokok_lama`, `gaji_pokok_naik`, `tunjangan_jabatan_lama`, `tunjangan_jabatan_naik`, `dana_pensiun_lama`, `dana_pensiun_naik`, `jamsostek_lama`, `jamsostek_naik`, `insentif_hadir_lama`, `insentif_hadir_naik`, `total_gaji_lama`, `total_gaji_naik`, `remarks`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_master_kenaikan_gaji` WHERE 1
	
	$a1				= $data_d['A1'];
	$a2				= $data_d['A2'];
	$a3				= $data_d['A3'];
	$a4				= $data_d['A4'];
	$a5				= $data_d['A5'];
	$a6				= $data_d['A6'];
	$a7				= $data_d['A7'];
	$a8				= $data_d['A8'];
	$a9				= $data_d['A9'];
	$a10				= $data_d['A10'];
	$a11				= $data_d['A11'];
	$a12				= $data_d['A12'];
	$a13				= $data_d['A13'];
	$a14				= $data_d['A14'];
	
	$b1				= $data_d['B1'];
	$b2				= $data_d['B2'];
	$b3				= $data_d['B3'];
	$b4				= $data_d['B4'];
	$b5				= $data_d['B5'];
	$b6				= $data_d['B6'];
	
	$c1				= $data_d['C1'];
	$c2				= $data_d['C2'];
	$c3				= $data_d['C3'];
	$c4				= $data_d['C4'];
	$c5				= $data_d['C5'];
	$c6				= $data_d['C6'];
	$c7				= $data_d['C7'];
	$c8				= $data_d['C8'];
	$c9				= $data_d['C9'];
	$c10				= $data_d['C10'];
	$c11				= $data_d['C11'];
	$c12				= $data_d['C12'];
	$c13				= $data_d['C13'];
	$c14				= $data_d['C14'];
	$c15				= $data_d['C15'];
	$c16				= $data_d['C16'];
	$c17				= $data_d['C17'];
	$c18				= $data_d['C18'];
	$c19				= $data_d['C19'];
	$c20				= $data_d['C20'];
	$c21				= $data_d['C21'];
	$c22				= $data_d['C22'];
	$c23				= $data_d['C23'];
	$c24				= $data_d['C24'];
	$c25				= $data_d['C25'];
	$c26				= $data_d['C26'];
	
	$d1				= round($data_d['D1'], 2);
	$d2				= round($data_d['D2'], 2);
	$d3				= round($data_d['D3'], 2);
	$d4				= round($data_d['D4'], 2);
	$d5				= round($data_d['D5'], 2);
	$d6				= round($data_d['D6'], 2);
	$d7				= round($data_d['D7'], 2);
	$d8				= round($data_d['D8'], 2);
	$d9				= round($data_d['D9'], 2);
	$d10				= round($data_d['D10'], 2);
	$d11				= round($data_d['D11'], 2);
	$d12				= round($data_d['D12'], 2);
	$d13				= round($data_d['D13'], 2);
	$d14				= round($data_d['D14'], 2);
	$d15				= round($data_d['D15'], 2);
	$d16				= round($data_d['D16'], 2);
	$d17				= round($data_d['D17'], 2);
	$d18				= round($data_d['D18'], 2);
	$d19				= round($data_d['D19'], 2);
	$d20				= round($data_d['D20'], 2);
	$d21				= round($data_d['D21'], 2);
	$d22				= round($data_d['D22'], 2);
	$d23				= round($data_d['D23'], 2);
	$d24				= round($data_d['D24'], 2);
	$d25				= round($data_d['D25'], 2);
	$d26				= round($data_d['D26'], 2);
	
	$date_add			= $data_d['date_add'];
	$date_update			= $data_d['date_upd'];
	$level				= $data_d['level'];
	$user_add			= $data_d['user_add'];
	$user_update			= $data_d['user_upd'];


  

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		     

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$judul_table.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label><h4><b>Setting Formula Gaji</b></h4></label>
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A1 (Gaji Pokok)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a1.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A2 (Tunjangan Jabatan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a2.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A3 (Dana Pensiun)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a3.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A4 (Dana Jamsostek)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a4.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A5 (Insentif Hadir)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a5.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A6 (Bonus Bulanan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a6.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A7 (Potongan Absen Per Hari)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a7.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A8 (Potongan Terlambat Per Menit)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a8.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A9 (Potongan Pulang Awal Per Menit)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a9.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A10 (Potongan Pinjaman Koperasi)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a10.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A11 (Lembur Per Jam)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a11.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A12 (Lembur Per Hari)</label>
					    </div>
					    <div class="col-xs-9">
						'.$a12.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A13</label>
					    </div>
					    <div class="col-xs-9">
						'.$a13.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>A14</label>
					    </div>
					    <div class="col-xs-9">
						'.$a14.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label><h4><b>Setting Jumlah Absensi</b></h4></label>
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>B1 (Jumlah Menit Terlambat)</label>
					    </div>
					    <div class="col-xs-9">
						'.$b1.'
					    </div>
					    
                                        </div>
				    </div>


				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>B2 (Jumlah Menit Pulang Awal)</label>
					    </div>
					    <div class="col-xs-9">
						'.$b2.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>B3 (Jumlah Absen)</label>
					    </div>
					    <div class="col-xs-9">
						'.$b3.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>B4 (Jumlah Cuti)</label>
					    </div>
					    <div class="col-xs-9">
						'.$b4.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>B5 (Jumlah Jam Lembur)</label>
					    </div>
					    <div class="col-xs-9">
						'.$b5.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>B6 (Jumlah Hari Lembur)</label>
					    </div>
					    <div class="col-xs-9">
						'.$b6.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label><h4><b>Setting Nama Slip</b></h4></label>
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>C1 (Gaji Pokok)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c1.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>C2 (Tunjangan Jabatan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c2.'
					    </div>
					    
                                        </div>
				    </div>
				    

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c3 (Dana Pensiun)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c3.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c4 (Jamsostek)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c4.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c5 (Insentif Hadir)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c5.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c6 (Bonus Bulanan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c6.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c7 (Total Gaji)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c7.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c8 (Jumlah Absen)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c8.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c9 (Potongan Absen)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c9.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c10 (Total Potongan Absen)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c10.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c11 (Jumlah Menit Terlambat)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c11.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c12 (Jumlah Menit Pulang Awal)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c12.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c13 (Potongan Terlambat Per Menit)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c13.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c14 (Potongan Pulang Awal Per Menit)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c14.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c15 (Jumlah Jam Lembur)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c15.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c16 (Lembur Per Jam)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c16.'
					    </div>
					    
                                        </div>
				    </div>
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c17 (Jumlah Hari Lembur)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c17.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c18 (Lembur Per Hari)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c18.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c19 (Total Lembur)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c19.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c20 (Potongan Pinjaman)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c20.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c21 (Total Pendapatan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c21.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c22 (Total Potongan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c22.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c23 (Total Gaji Diterima)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c23.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c24 (Saldo Dana Pensiun)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c24.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c25 (Cicilan Ke)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c25.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>c26 (Jumlah Cicilan)</label>
					    </div>
					    <div class="col-xs-9">
						'.$c26.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label><h4><b>Setting Formula Hitung Gaji</b></h4></label>
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D1 (A1)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d1.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D2 (A2)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d2.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D3 (A3)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d3.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D4 (A4)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d4.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>d5 (A5)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d5.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D6 (A6)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d6.'
					    </div>
					    
                                        </div>
				    </div>

				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D7 (A1+A2+A3+A4+A5+A6)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d7.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D8 (B3)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d8.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D9 (D7/25)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d9.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D10 (D8*D9)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d10.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D11 (B1)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d11.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D12 (B2)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d12.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D13 (D7/25/8/60)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d13.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D14 (D7/25/8/60)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d14.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D15 (B5)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d15.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D16 ((D7/25/8)*1.5)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d16.'
					    </div>
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D17 ((D15*D16)+(D17*18))</label>
					    </div>
					    <div class="col-xs-9">
						'.$d17.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D18 ((D7/25)*1.5)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d18.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D19 ((D15*D16)+(D17*18))</label>
					    </div>
					    <div class="col-xs-9">
						'.$d19.'
					    </div>
					    
                                        </div>
				    </div>
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D20 (C20)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d20.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D21 (D7+D19)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d21.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D22 (D3+D4+D10+(D11*D13)+(D12*D14)+D20)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d22.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D23 (D21-D22)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d23.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D24 (C24)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d24.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D25 (C25)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d25.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>D26 (C26)</label>
					    </div>
					    <div class="col-xs-9">
						'.$d26.'
					    </div>
					    
                                        </div>
				    </div>
				    
				    
            </div>
	   
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>