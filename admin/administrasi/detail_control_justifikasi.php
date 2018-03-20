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


if(isset($_GET["id"]))
{
    $id_control_justifikasi	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_control_justifikasi 	= "SELECT * FROM `gx_control_justifikasi` WHERE `id_control_justifikasi`='$id_control_justifikasi' LIMIT 0,1;";
    $sql_control_justifikasi	= mysql_query($query_control_justifikasi, $conn);
    $row_control_justifikasi	= mysql_fetch_array($sql_control_justifikasi);
    
}
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Control Justifikasi</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Control Justifikasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="no_control_justifikasi" name="no_control_justifikasi" required="" value="'.(isset($_GET['id']) ? $row_control_justifikasi["no_control_justifikasi"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_control_justifikasi["tanggal"] : "").'">
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer Justifikasi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  name="no_justifikasi" value="'.(isset($_GET['id']) ? $row_control_justifikasi["no_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly=""  class="form-control" name="kode_customer" value="'.(isset($_GET['id']) ? $row_control_justifikasi["kode_customer"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="nama_customer" value="'.(isset($_GET['id']) ? $row_control_justifikasi["nama_customer"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="longitude" value="'.(isset($_GET['id']) ? $row_control_justifikasi["longitude"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="latitude" value="'.(isset($_GET['id']) ? $row_control_justifikasi["latitude"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Tiang Terdekat</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="tiang_terdekat" value="'.(isset($_GET['id']) ? $row_control_justifikasi["tiang_terdekat"] : "").'">
					    </div>
                                        
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Paket</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="kode_paket" value="'.(isset($_GET['id']) ? $row_control_justifikasi["kode_paket"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="nama_paket" value="'.(isset($_GET['id']) ? $row_control_justifikasi["nama_paket"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="kontrak" value="'.(isset($_GET['id']) ? $row_control_justifikasi["kontrak"] : "").'">
					    </div>
                                        
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-6">
						<label>Harga Normal</label>
					    </div>
					    <div class="col-xs-6">
						<label>Harga Justifikasi</label>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="setup_fee_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["setup_fee_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Setup Fee</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="setup_fee_justifikasi" value="'.(isset($_GET['id']) ? $row_control_justifikasi["setup_fee_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Abonemen</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="abonemen_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["abonemen_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Abonemen</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="abonemen_justifikasi" value="'.(isset($_GET['id']) ? $row_control_justifikasi["abonemen_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="monthly_fee_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["monthly_fee_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Monthly Fee</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="monthly_fee_justifikasi" value="'.(isset($_GET['id']) ? $row_control_justifikasi["monthly_fee_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Bandwidth</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="bandwith_normal" value="'.(isset($_GET['id']) ? $row_control_justifikasi["bandwith_normal"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Bandwidth</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="bandwith_justifikasi" value="'.(isset($_GET['id']) ? $row_control_justifikasi["bandwith_justifikasi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks Permohonan</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea readonly="" class="form-control"  name="remarks_permohonan">'.(isset($_GET['id']) ? $row_control_justifikasi["remarks_permohonan"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Total Link Budget</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="total_linkbudget" value="'.(isset($_GET['id']) ? $row_control_justifikasi["total_linkbudget"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Laba/Rugi 1 bulan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="laba_rugi_bulanan" value="'.(isset($_GET['id']) ? $row_control_justifikasi["laba_rugi_bulanan"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Laba/Rugi 1 Tahun</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="laba_rugi_tahunan" value="'.(isset($_GET['id']) ? $row_control_justifikasi["laba_rugi_tahunan"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks Marketing</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea readonly="" class="form-control"  name="remarks_marketing">'.(isset($_GET['id']) ? $row_control_justifikasi["remarks_marketing"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Remarks Control</label>
                                            </div>
					    <div class="col-xs-9">
						<textarea readonly="" class="form-control"  name="remarks_control">'.(isset($_GET['id']) ? $row_control_justifikasi["remarks_control"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					
                                    </div><!-- /.box-body -->

                                    
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Control Justifikasi';
    $submenu	= "master_cjustifikasi";
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