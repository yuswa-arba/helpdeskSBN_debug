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
    $query_data		= "SELECT * FROM `gx_master_gaji` WHERE `id_master_gaji`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Form Master Gaji
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Master Gaji</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>SETTING FORMULA GAJI</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a1" name="a1" placeholder="Gaji Pokok" value="'.(isset($_GET['id']) ? $row_data["a1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A8</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a8" name="a8" placeholder="Potongan Terlambat Per menit" required="" value="'.(isset($_GET['id']) ? $row_data["a8"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a2" name="a2" placeholder="Tunjangan Jabatan" value="'.(isset($_GET['id']) ? $row_data["a2"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A9</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a9" name="a9" placeholder="Potongan Pulang awal Per menit" required="" value="'.(isset($_GET['id']) ? $row_data["a9"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A3</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a3" name="a3" placeholder="Dana Pensiun" value="'.(isset($_GET['id']) ? $row_data["a3"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A10</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a10" name="a10" placeholder="Potongan Pinjaman Koperasi" required="" value="'.(isset($_GET['id']) ? $row_data["a10"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A4</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a4" name="a4" placeholder="Jamsostek" value="'.(isset($_GET['id']) ? $row_data["a4"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A11</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a11" name="a11" placeholder="Lembur Perjam" required="" value="'.(isset($_GET['id']) ? $row_data["a11"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A5</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a5" name="a5" placeholder="Insentif Hadir" value="'.(isset($_GET['id']) ? $row_data["a5"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A12</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a12" name="a12" placeholder="Lembur perhari" required="" value="'.(isset($_GET['id']) ? $row_data["a12"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A6</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a6" name="a6" placeholder="Bonus Bulanan" value="'.(isset($_GET['id']) ? $row_data["a6"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A13</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a13" name="a13" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["a13"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>A7</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a7" name="a7" placeholder="Potongan Absen Per Hari" value="'.(isset($_GET['id']) ? $row_data["a7"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>A14</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="a14" name="a14" placeholder="" required="" value="'.(isset($_GET['id']) ? $row_data["a14"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>SETTING JUMLAH ABSENSI</label>
											</div>
										</div>
										</div>
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>B1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="b1" name="b1" placeholder="Jumlah Menit Terlambat" value="'.(isset($_GET['id']) ? $row_data["b1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>B4</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="b4" name="b4" placeholder="JumlaH Cuti" required="" value="'.(isset($_GET['id']) ? $row_data["b4"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>B2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="b2" name="b2" placeholder="Jumlah Menit Pulang Awal" value="'.(isset($_GET['id']) ? $row_data["b2"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>B5</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="b5" name="b5" placeholder="Jumlah Jam Lembur" required="" value="'.(isset($_GET['id']) ? $row_data["b5"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>B3</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="b3" name="b3" placeholder="Jumlah Absen" value="'.(isset($_GET['id']) ? $row_data["b3"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>B6</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="b6" name="b6" placeholder="Jumlah Hari Lembur" required="" value="'.(isset($_GET['id']) ? $row_data["b6"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>SETTING NAMA SLIP</label>
											</div>
										</div>
										</div>
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c1" name="c1" placeholder="Gaji Pokok" value="'.(isset($_GET['id']) ? $row_data["c1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C14</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c14" name="c14" placeholder="Potongan Pulang Awal Permenit" required="" value="'.(isset($_GET['id']) ? $row_data["c14"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c2" name="c2" placeholder="Tunjangan Jabatan" value="'.(isset($_GET['id']) ? $row_data["c2"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C15</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c15" name="c15" placeholder="Jumlah Jam Lembur" required="" value="'.(isset($_GET['id']) ? $row_data["c15"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C3</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c3" name="c3" placeholder="Dana Pensiun" value="'.(isset($_GET['id']) ? $row_data["c3"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C16</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c16" name="c16" placeholder="Lembur Perjam" required="" value="'.(isset($_GET['id']) ? $row_data["c16"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C4</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c4" name="c4" placeholder="Jamsostek" value="'.(isset($_GET['id']) ? $row_data["c4"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C17</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c17" name="c17" placeholder="Jumlah Hari Lembur" required="" value="'.(isset($_GET['id']) ? $row_data["c17"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C5</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c5" name="c5" placeholder="Insentif hadir" value="'.(isset($_GET['id']) ? $row_data["c5"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C18</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c18" name="c18" placeholder="Lembur Per Hari" required="" value="'.(isset($_GET['id']) ? $row_data["c18"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C6</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c6" name="c6" placeholder="Bonus Bulanan" value="'.(isset($_GET['id']) ? $row_data["c6"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C19</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c19" name="c19" placeholder="Total Lembur" required="" value="'.(isset($_GET['id']) ? $row_data["c19"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C7</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c7" name="c7" placeholder="Total Gaji" value="'.(isset($_GET['id']) ? $row_data["c7"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C20</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c20" name="c20" placeholder="Potongan Pinjaman" required="" value="'.(isset($_GET['id']) ? $row_data["c20"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C8</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c8" name="c8" placeholder="Jumlah Absen" value="'.(isset($_GET['id']) ? $row_data["c8"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C21</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c21" name="c21" placeholder="Total Pendapatan" required="" value="'.(isset($_GET['id']) ? $row_data["c21"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C9</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c9" name="c9" placeholder="Potongan Absen" value="'.(isset($_GET['id']) ? $row_data["c9"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C22</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c22" name="c22" placeholder="Total Potongan" required="" value="'.(isset($_GET['id']) ? $row_data["c22"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C10</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c10" name="c10" placeholder="Total Potongan Absen" value="'.(isset($_GET['id']) ? $row_data["c10"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C23</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c23" name="c23" placeholder="Total Gaji Diterima" required="" value="'.(isset($_GET['id']) ? $row_data["c23"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C11</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c11" name="c11" placeholder="Jumlah Menit Terlambat" value="'.(isset($_GET['id']) ? $row_data["c11"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C24</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c24" name="c24" placeholder="Saldo Dana Pensiun" required="" value="'.(isset($_GET['id']) ? $row_data["c24"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C12</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c12" name="c12" placeholder="Jumlah Menit Pulang Awal" value="'.(isset($_GET['id']) ? $row_data["c12"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C25</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c25" name="c25" placeholder="Cicilan Ke" required="" value="'.(isset($_GET['id']) ? $row_data["c25"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C13</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c13" name="c13" placeholder="Potongan Terlambat permenit" value="'.(isset($_GET['id']) ? $row_data["c13"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C26</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="c26" name="c26" placeholder="jumlah Cicilan" required="" value="'.(isset($_GET['id']) ? $row_data["c26"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>SETTING FORMULA HITUNG GAJI</label>
											</div>
											
										</div>
										</div>
															
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d1" name="d1" placeholder="A1" value="'.(isset($_GET['id']) ? $row_data["d1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D14</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d14" name="d14" placeholder="D7/25/8/60" required="" value="'.(isset($_GET['id']) ? $row_data["d14"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d2" name="d2" placeholder="A2" value="'.(isset($_GET['id']) ? $row_data["d2"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D15</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d15" name="d15" placeholder="B5" required="" value="'.(isset($_GET['id']) ? $row_data["d15"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D3</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d3" name="d3" placeholder="A3" value="'.(isset($_GET['id']) ? $row_data["d3"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D16</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d16" name="d16" placeholder="(D7/25/8)*1.5" required="" value="'.(isset($_GET['id']) ? $row_data["d16"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D4</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d4" name="d4" placeholder="A4" value="'.(isset($_GET['id']) ? $row_data["d4"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D17</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d17" name="d17" placeholder="B6" required="" value="'.(isset($_GET['id']) ? $row_data["d17"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D5</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d5" name="d5" placeholder="A5" value="'.(isset($_GET['id']) ? $row_data["d5"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D18</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d18" name="d18" placeholder="(D7/25)*1.5" required="" value="'.(isset($_GET['id']) ? $row_data["d18"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D6</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d6" name="d6" placeholder="A6" value="'.(isset($_GET['id']) ? $row_data["d6"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D19</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d19" name="d19" placeholder="(D15*D16)+(D17*18)" required="" value="'.(isset($_GET['id']) ? $row_data["d19"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D7</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d7" name="d7" placeholder="A1+A2+A3+A4+A5+A6" value="'.(isset($_GET['id']) ? $row_data["d7"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D20</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d20" name="d20" placeholder="Potongan Pinjaman" required="" value="'.(isset($_GET['id']) ? $row_data["d20"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D8</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d8" name="d8" placeholder="B3" value="'.(isset($_GET['id']) ? $row_data["d8"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D21</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d21" name="d21" placeholder="D7+D19" required="" value="'.(isset($_GET['id']) ? $row_data["d21"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D9</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d9" name="d9" placeholder="D7/25" value="'.(isset($_GET['id']) ? $row_data["d9"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D22</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d22" name="d22" placeholder="D3+D4+D10+(D11*D13)+(D12*D14)+D20" required="" value="'.(isset($_GET['id']) ? $row_data["d22"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D10</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d10" name="d10" placeholder="D8 * D9" value="'.(isset($_GET['id']) ? $row_data["d10"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D23</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d23" name="d23" placeholder="D21-D22" required="" value="'.(isset($_GET['id']) ? $row_data["d23"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D11</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d11" name="d11" placeholder="B1" value="'.(isset($_GET['id']) ? $row_data["d11"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D24</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d24" name="d24" placeholder="Saldo Dana Pensiun" required="" value="'.(isset($_GET['id']) ? $row_data["d24"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>D12</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d12" name="d12" placeholder="B2" value="'.(isset($_GET['id']) ? $row_data["d12"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>D25</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d25" name="d25" placeholder="Cicilan Ke" required="" value="'.(isset($_GET['id']) ? $row_data["d25"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>C13</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d13" name="d13" placeholder="D7/25/8/60" value="'.(isset($_GET['id']) ? $row_data["d13"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>C26</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="d26" name="d26" placeholder="jumlah Cicilan" required="" value="'.(isset($_GET['id']) ? $row_data["d26"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_data["user_upd"]." ".$row_data["date_upd"] : "").'
											</div>
										</div>
										</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
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
    $a1	   		= isset($_POST['a1']) ? mysql_real_escape_string(trim($_POST['a1'])) : '';
	$a2	   		= isset($_POST['a2']) ? mysql_real_escape_string(trim($_POST['a2'])) : '';
	$a3	   		= isset($_POST['a3']) ? mysql_real_escape_string(trim($_POST['a3'])) : '';
	$a4	   		= isset($_POST['a4']) ? mysql_real_escape_string(trim($_POST['a4'])) : '';
	$a5	   		= isset($_POST['a5']) ? mysql_real_escape_string(trim($_POST['a5'])) : '';
	$a6	   		= isset($_POST['a6']) ? mysql_real_escape_string(trim($_POST['a6'])) : '';
	$a7	   		= isset($_POST['a7']) ? mysql_real_escape_string(trim($_POST['a7'])) : '';
	$a8	   		= isset($_POST['a8']) ? mysql_real_escape_string(trim($_POST['a8'])) : '';
	$a9	   		= isset($_POST['a9']) ? mysql_real_escape_string(trim($_POST['a9'])) : '';
	$a10   		= isset($_POST['a10']) ? mysql_real_escape_string(trim($_POST['a10'])) : '';
	$a11   		= isset($_POST['a11']) ? mysql_real_escape_string(trim($_POST['a11'])) : '';
	$a12   		= isset($_POST['a12']) ? mysql_real_escape_string(trim($_POST['a12'])) : '';
	$a13   		= isset($_POST['a13']) ? mysql_real_escape_string(trim($_POST['a13'])) : '';
	$a14   		= isset($_POST['a14']) ? mysql_real_escape_string(trim($_POST['a14'])) : '';
	
	$b1	   		= isset($_POST['b1']) ? mysql_real_escape_string(trim($_POST['b1'])) : '';
	$b2	   		= isset($_POST['b2']) ? mysql_real_escape_string(trim($_POST['b2'])) : '';
	$b3	   		= isset($_POST['b3']) ? mysql_real_escape_string(trim($_POST['b3'])) : '';
	$b4	   		= isset($_POST['b4']) ? mysql_real_escape_string(trim($_POST['b4'])) : '';
	$b5	   		= isset($_POST['b5']) ? mysql_real_escape_string(trim($_POST['b5'])) : '';
	$b6	   		= isset($_POST['b6']) ? mysql_real_escape_string(trim($_POST['b6'])) : '';
	
	$c1	   		= isset($_POST['c1']) ? mysql_real_escape_string(trim($_POST['c1'])) : '';
	$c2	   		= isset($_POST['c2']) ? mysql_real_escape_string(trim($_POST['c2'])) : '';
	$c3	   		= isset($_POST['c3']) ? mysql_real_escape_string(trim($_POST['c3'])) : '';
	$c4	   		= isset($_POST['c4']) ? mysql_real_escape_string(trim($_POST['c4'])) : '';
	$c5	   		= isset($_POST['c5']) ? mysql_real_escape_string(trim($_POST['c5'])) : '';
	$c6	   		= isset($_POST['c6']) ? mysql_real_escape_string(trim($_POST['c6'])) : '';
	$c7	   		= isset($_POST['c7']) ? mysql_real_escape_string(trim($_POST['c7'])) : '';
	$c8	   		= isset($_POST['c8']) ? mysql_real_escape_string(trim($_POST['c8'])) : '';
	$c9	   		= isset($_POST['c9']) ? mysql_real_escape_string(trim($_POST['c9'])) : '';
	$c10   		= isset($_POST['c10']) ? mysql_real_escape_string(trim($_POST['c10'])) : '';
	$c11   		= isset($_POST['c11']) ? mysql_real_escape_string(trim($_POST['c11'])) : '';
	$c12   		= isset($_POST['c12']) ? mysql_real_escape_string(trim($_POST['c12'])) : '';
	$c13   		= isset($_POST['c13']) ? mysql_real_escape_string(trim($_POST['c13'])) : '';
	$c14   		= isset($_POST['c14']) ? mysql_real_escape_string(trim($_POST['c14'])) : '';
	$c15   		= isset($_POST['c15']) ? mysql_real_escape_string(trim($_POST['c15'])) : '';
	$c16   		= isset($_POST['c16']) ? mysql_real_escape_string(trim($_POST['c16'])) : '';
	$c17   		= isset($_POST['c17']) ? mysql_real_escape_string(trim($_POST['c17'])) : '';
	$c18   		= isset($_POST['c18']) ? mysql_real_escape_string(trim($_POST['c18'])) : '';
	$c19   		= isset($_POST['c19']) ? mysql_real_escape_string(trim($_POST['c19'])) : '';
	$c20   		= isset($_POST['c20']) ? mysql_real_escape_string(trim($_POST['c20'])) : '';
	$c21   		= isset($_POST['c21']) ? mysql_real_escape_string(trim($_POST['c21'])) : '';
	$c22   		= isset($_POST['c22']) ? mysql_real_escape_string(trim($_POST['c22'])) : '';
	$c23   		= isset($_POST['c23']) ? mysql_real_escape_string(trim($_POST['c23'])) : '';
	$c24   		= isset($_POST['c24']) ? mysql_real_escape_string(trim($_POST['c24'])) : '';
	$c25   		= isset($_POST['c25']) ? mysql_real_escape_string(trim($_POST['c25'])) : '';
	$c26   		= isset($_POST['c26']) ? mysql_real_escape_string(trim($_POST['c26'])) : '';
	
	$d1	   		= isset($_POST['d1']) ? mysql_real_escape_string(trim($_POST['d1'])) : '';
	$d2	   		= isset($_POST['d2']) ? mysql_real_escape_string(trim($_POST['d2'])) : '';
	$d3	   		= isset($_POST['d3']) ? mysql_real_escape_string(trim($_POST['d3'])) : '';
	$d4	   		= isset($_POST['d4']) ? mysql_real_escape_string(trim($_POST['d4'])) : '';
	$d5	   		= isset($_POST['d5']) ? mysql_real_escape_string(trim($_POST['d5'])) : '';
	$d6	   		= isset($_POST['d6']) ? mysql_real_escape_string(trim($_POST['d6'])) : '';
	$d7	   		= isset($_POST['d7']) ? mysql_real_escape_string(trim($_POST['d7'])) : '';
	$d8	   		= isset($_POST['d8']) ? mysql_real_escape_string(trim($_POST['d8'])) : '';
	$d9	   		= isset($_POST['d9']) ? mysql_real_escape_string(trim($_POST['d9'])) : '';
	$d10   		= isset($_POST['d10']) ? mysql_real_escape_string(trim($_POST['d10'])) : '';
	$d11   		= isset($_POST['d11']) ? mysql_real_escape_string(trim($_POST['d11'])) : '';
	$d12   		= isset($_POST['d12']) ? mysql_real_escape_string(trim($_POST['d12'])) : '';
	$d13   		= isset($_POST['d13']) ? mysql_real_escape_string(trim($_POST['d13'])) : '';
	$d14   		= isset($_POST['d14']) ? mysql_real_escape_string(trim($_POST['d14'])) : '';
	$d15   		= isset($_POST['d15']) ? mysql_real_escape_string(trim($_POST['d15'])) : '';
	$d16   		= isset($_POST['d16']) ? mysql_real_escape_string(trim($_POST['d16'])) : '';
	$d17   		= isset($_POST['d17']) ? mysql_real_escape_string(trim($_POST['d17'])) : '';
	$d18   		= isset($_POST['d18']) ? mysql_real_escape_string(trim($_POST['d18'])) : '';
	$d19   		= isset($_POST['d19']) ? mysql_real_escape_string(trim($_POST['d19'])) : '';
	$d20   		= isset($_POST['d20']) ? mysql_real_escape_string(trim($_POST['d20'])) : '';
	$d21   		= isset($_POST['d21']) ? mysql_real_escape_string(trim($_POST['d21'])) : '';
	$d22   		= isset($_POST['d22']) ? mysql_real_escape_string(trim($_POST['d22'])) : '';
	$d23   		= isset($_POST['d23']) ? mysql_real_escape_string(trim($_POST['d23'])) : '';
	$d24   		= isset($_POST['d24']) ? mysql_real_escape_string(trim($_POST['d24'])) : '';
	$d25   		= isset($_POST['d25']) ? mysql_real_escape_string(trim($_POST['d25'])) : '';
	$d26   		= isset($_POST['d26']) ? mysql_real_escape_string(trim($_POST['d26'])) : '';
	
	if($a1 != "" && $a2 != "" && $a14 != ""){
	$sql_insert = "INSERT INTO `gx_master_gaji` (`id_master_gaji`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `A7`, `A8`, `A9`, `A10`, `A11`, `A12`,
						  `A13`, `A14`, `A15`, `A16`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `C11`, `C12`,
						  `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `D1`, `D2`, `D3`, `D4`, `D5`, `D6`, `D7`, `D8`, `D9`, `D10`, `D11`, `D12`,
						  `D13`, `D14`, `D15`, `D16`, `D17`, `D18`, `D19`, `D20`, `D21`, `D22`, `D23`, `D24`, `D25`, `D26`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$a1."', '".$a2."', '".$a3."', '".$a4."', '".$a5."', '".$a6."', '".$a7."', '".$a8."', '".$a9."', '".$a10."', '".$a11."', '".$a12."',
						  '".$a13."', '".$a14."', '".$a15."', '".$a16."', '".$b1."', '".$b2."', '".$b3."', '".$b4."', '".$b5."', '".$b6."', '".$c1."', '".$c2."', '".$c3."', '".$c4."', '".$c5."', '".$c6."', '".$c7."', '".$c8."', '".$c9."', '".$c10."', '".$c11."', '".$c12."',
						  '".$c13."', '".$c14."', '".$c15."', '".$c16."', '".$c17."', '".$c18."', '".$c19."', '".$c20."', '".$c21."', '".$c22."', '".$c23."', '".$c24."', '".$c25."', '".$c26."', '".$d1."', '".$d2."', '".$d3."', '".$d4."', '".$d5."', '".$d6."', '".$d7."', '".$d8."', '".$d9."', '".$d10."', '".$d11."', '".$d12."',
						  '".$d13."', '".$d14."', '".$d15."', '".$d16."', '".$d17."', '".$d18."', '".$d19."', '".$d20."', '".$d21."', '".$d22."', '".$d23."', '".$d24."', '".$d25."', '".$d26."',
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
			window.location.href='".URL_ADMIN."pegawai/master_gaji.php';
			</script>";
			
    }else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	}
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $a1	   		= isset($_POST['a1']) ? mysql_real_escape_string(trim($_POST['a1'])) : '';
	$a2	   		= isset($_POST['a2']) ? mysql_real_escape_string(trim($_POST['a2'])) : '';
	$a3	   		= isset($_POST['a3']) ? mysql_real_escape_string(trim($_POST['a3'])) : '';
	$a4	   		= isset($_POST['a4']) ? mysql_real_escape_string(trim($_POST['a4'])) : '';
	$a5	   		= isset($_POST['a5']) ? mysql_real_escape_string(trim($_POST['a5'])) : '';
	$a6	   		= isset($_POST['a6']) ? mysql_real_escape_string(trim($_POST['a6'])) : '';
	$a7	   		= isset($_POST['a7']) ? mysql_real_escape_string(trim($_POST['a7'])) : '';
	$a8	   		= isset($_POST['a8']) ? mysql_real_escape_string(trim($_POST['a8'])) : '';
	$a9	   		= isset($_POST['a9']) ? mysql_real_escape_string(trim($_POST['a9'])) : '';
	$a10   		= isset($_POST['a10']) ? mysql_real_escape_string(trim($_POST['a10'])) : '';
	$a11   		= isset($_POST['a11']) ? mysql_real_escape_string(trim($_POST['a11'])) : '';
	$a12   		= isset($_POST['a12']) ? mysql_real_escape_string(trim($_POST['a12'])) : '';
	$a13   		= isset($_POST['a13']) ? mysql_real_escape_string(trim($_POST['a13'])) : '';
	$a14   		= isset($_POST['a14']) ? mysql_real_escape_string(trim($_POST['a14'])) : '';
	
	$b1	   		= isset($_POST['b1']) ? mysql_real_escape_string(trim($_POST['b1'])) : '';
	$b2	   		= isset($_POST['b2']) ? mysql_real_escape_string(trim($_POST['b2'])) : '';
	$b3	   		= isset($_POST['b3']) ? mysql_real_escape_string(trim($_POST['b3'])) : '';
	$b4	   		= isset($_POST['b4']) ? mysql_real_escape_string(trim($_POST['b4'])) : '';
	$b5	   		= isset($_POST['b5']) ? mysql_real_escape_string(trim($_POST['b5'])) : '';
	$b6	   		= isset($_POST['b6']) ? mysql_real_escape_string(trim($_POST['b6'])) : '';
	
	$c1	   		= isset($_POST['c1']) ? mysql_real_escape_string(trim($_POST['c1'])) : '';
	$c2	   		= isset($_POST['c2']) ? mysql_real_escape_string(trim($_POST['c2'])) : '';
	$c3	   		= isset($_POST['c3']) ? mysql_real_escape_string(trim($_POST['c3'])) : '';
	$c4	   		= isset($_POST['c4']) ? mysql_real_escape_string(trim($_POST['c4'])) : '';
	$c5	   		= isset($_POST['c5']) ? mysql_real_escape_string(trim($_POST['c5'])) : '';
	$c6	   		= isset($_POST['c6']) ? mysql_real_escape_string(trim($_POST['c6'])) : '';
	$c7	   		= isset($_POST['c7']) ? mysql_real_escape_string(trim($_POST['c7'])) : '';
	$c8	   		= isset($_POST['c8']) ? mysql_real_escape_string(trim($_POST['c8'])) : '';
	$c9	   		= isset($_POST['c9']) ? mysql_real_escape_string(trim($_POST['c9'])) : '';
	$c10   		= isset($_POST['c10']) ? mysql_real_escape_string(trim($_POST['c10'])) : '';
	$c11   		= isset($_POST['c11']) ? mysql_real_escape_string(trim($_POST['c11'])) : '';
	$c12   		= isset($_POST['c12']) ? mysql_real_escape_string(trim($_POST['c12'])) : '';
	$c13   		= isset($_POST['c13']) ? mysql_real_escape_string(trim($_POST['c13'])) : '';
	$c14   		= isset($_POST['c14']) ? mysql_real_escape_string(trim($_POST['c14'])) : '';
	$c15   		= isset($_POST['c15']) ? mysql_real_escape_string(trim($_POST['c15'])) : '';
	$c16   		= isset($_POST['c16']) ? mysql_real_escape_string(trim($_POST['c16'])) : '';
	$c17   		= isset($_POST['c17']) ? mysql_real_escape_string(trim($_POST['c17'])) : '';
	$c18   		= isset($_POST['c18']) ? mysql_real_escape_string(trim($_POST['c18'])) : '';
	$c19   		= isset($_POST['c19']) ? mysql_real_escape_string(trim($_POST['c19'])) : '';
	$c20   		= isset($_POST['c20']) ? mysql_real_escape_string(trim($_POST['c20'])) : '';
	$c21   		= isset($_POST['c21']) ? mysql_real_escape_string(trim($_POST['c21'])) : '';
	$c22   		= isset($_POST['c22']) ? mysql_real_escape_string(trim($_POST['c22'])) : '';
	$c23   		= isset($_POST['c23']) ? mysql_real_escape_string(trim($_POST['c23'])) : '';
	$c24   		= isset($_POST['c24']) ? mysql_real_escape_string(trim($_POST['c24'])) : '';
	$c25   		= isset($_POST['c25']) ? mysql_real_escape_string(trim($_POST['c25'])) : '';
	$c26   		= isset($_POST['c26']) ? mysql_real_escape_string(trim($_POST['c26'])) : '';
	
	$d1	   		= isset($_POST['d1']) ? mysql_real_escape_string(trim($_POST['d1'])) : '';
	$d2	   		= isset($_POST['d2']) ? mysql_real_escape_string(trim($_POST['d2'])) : '';
	$d3	   		= isset($_POST['d3']) ? mysql_real_escape_string(trim($_POST['d3'])) : '';
	$d4	   		= isset($_POST['d4']) ? mysql_real_escape_string(trim($_POST['d4'])) : '';
	$d5	   		= isset($_POST['d5']) ? mysql_real_escape_string(trim($_POST['d5'])) : '';
	$d6	   		= isset($_POST['d6']) ? mysql_real_escape_string(trim($_POST['d6'])) : '';
	$d7	   		= isset($_POST['d7']) ? mysql_real_escape_string(trim($_POST['d7'])) : '';
	$d8	   		= isset($_POST['d8']) ? mysql_real_escape_string(trim($_POST['d8'])) : '';
	$d9	   		= isset($_POST['d9']) ? mysql_real_escape_string(trim($_POST['d9'])) : '';
	$d10   		= isset($_POST['d10']) ? mysql_real_escape_string(trim($_POST['d10'])) : '';
	$d11   		= isset($_POST['d11']) ? mysql_real_escape_string(trim($_POST['d11'])) : '';
	$d12   		= isset($_POST['d12']) ? mysql_real_escape_string(trim($_POST['d12'])) : '';
	$d13   		= isset($_POST['d13']) ? mysql_real_escape_string(trim($_POST['d13'])) : '';
	$d14   		= isset($_POST['d14']) ? mysql_real_escape_string(trim($_POST['d14'])) : '';
	$d15   		= isset($_POST['d15']) ? mysql_real_escape_string(trim($_POST['d15'])) : '';
	$d16   		= isset($_POST['d16']) ? mysql_real_escape_string(trim($_POST['d16'])) : '';
	$d17   		= isset($_POST['d17']) ? mysql_real_escape_string(trim($_POST['d17'])) : '';
	$d18   		= isset($_POST['d18']) ? mysql_real_escape_string(trim($_POST['d18'])) : '';
	$d19   		= isset($_POST['d19']) ? mysql_real_escape_string(trim($_POST['d19'])) : '';
	$d20   		= isset($_POST['d20']) ? mysql_real_escape_string(trim($_POST['d20'])) : '';
	$d21   		= isset($_POST['d21']) ? mysql_real_escape_string(trim($_POST['d21'])) : '';
	$d22   		= isset($_POST['d22']) ? mysql_real_escape_string(trim($_POST['d22'])) : '';
	$d23   		= isset($_POST['d23']) ? mysql_real_escape_string(trim($_POST['d23'])) : '';
	$d24   		= isset($_POST['d24']) ? mysql_real_escape_string(trim($_POST['d24'])) : '';
	$d25   		= isset($_POST['d25']) ? mysql_real_escape_string(trim($_POST['d25'])) : '';
	$d26   		= isset($_POST['d26']) ? mysql_real_escape_string(trim($_POST['d26'])) : '';
	
    $sql_update = "UPDATE `gx_master_gaji` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_master_gaji` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_master_gaji` (`id_master_gaji`, `A1`, `A2`, `A3`, `A4`, `A5`, `A6`, `A7`, `A8`, `A9`, `A10`, `A11`, `A12`,
						  `A13`, `A14`, `A15`, `A16`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `C11`, `C12`,
						  `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `D1`, `D2`, `D3`, `D4`, `D5`, `D6`, `D7`, `D8`, `D9`, `D10`, `D11`, `D12`,
						  `D13`, `D14`, `D15`, `D16`, `D17`, `D18`, `D19`, `D20`, `D21`, `D22`, `D23`, `D24`, `D25`, `D26`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$a1."', '".$a2."', '".$a3."', '".$a4."', '".$a5."', '".$a6."', '".$a7."', '".$a8."', '".$a9."', '".$a10."', '".$a11."', '".$a12."',
						  '".$a13."', '".$a14."', '".$a15."', '".$a16."', '".$b1."', '".$b2."', '".$b3."', '".$b4."', '".$b5."', '".$b6."', '".$c1."', '".$c2."', '".$c3."', '".$c4."', '".$c5."', '".$c6."', '".$c7."', '".$c8."', '".$c9."', '".$c10."', '".$c11."', '".$c12."',
						  '".$c13."', '".$c14."', '".$c15."', '".$c16."', '".$c17."', '".$c18."', '".$c19."', '".$c20."', '".$c21."', '".$c22."', '".$c23."', '".$c24."', '".$c25."', '".$c26."', '".$d1."', '".$d2."', '".$d3."', '".$d4."', '".$d5."', '".$d6."', '".$d7."', '".$d8."', '".$d9."', '".$d10."', '".$d11."', '".$d12."',
						  '".$d13."', '".$d14."', '".$d15."', '".$d16."', '".$d17."', '".$d18."', '".$d19."', '".$d20."', '".$d21."', '".$d22."', '".$d23."', '".$d24."', '".$d25."', '".$d26."',
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
			window.location.href='".URL_ADMIN."pegawai/master_gaji.php';
			</script>";
			
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

    $title	= 'Form Master Gaji';
    $submenu	= "master_gaji";
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