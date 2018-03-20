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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open detail Customer");
        global $conn;


if(isset($_GET["id"]))
{
    $id_spk_aktivasi		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_spk_aktivasi		= "SELECT * FROM `gx_spk_aktivasi` WHERE `id_spkaktivasi`='$id_spk_aktivasi' LIMIT 0,1;";
    $sql_spk_aktivasi		= mysql_query($query_spk_aktivasi, $conn);
    $row_spk_aktivasi		= mysql_fetch_array($sql_spk_aktivasi);
   
    $sql_data	= "SELECT * FROM `gx_link_budget` WHERE `no_linkbudget` = '".$row_spk_aktivasi["id_linkbudget"]."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
	
	$sql_data_cabang	= "SELECT * FROM `gx_cabang` WHERE `id_cabang` = '".$row_spk_aktivasi["id_cabang"]."';";
    $query_data_cabang	= mysql_query($sql_data_cabang, $conn);
    $row_data_cabang	= mysql_fetch_array($query_data_cabang);
    
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Detail SPK Aktivasi Baru
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form SPK Aktivasi Baru</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="namecabang" value="'.(isset($_GET['id']) ? $row_data_cabang["nama_cabang"] : "").'">
						<input type="hidden" readonly="" class="form-control" required="" name="cabang" value="">
						
						<input type="hidden" readonly="" class="form-control" id="id_spkaktivasi" name="id_spkaktivasi" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["id_spkaktivasi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer SPK Aktivasi Baru</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="kode_spkaktivasi" name="kode_spkaktivasi" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["kode_spkaktivasi"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nomer SPK Pasang Baru</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="kode_spkpasang" name="kode_spkpasang" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["kode_spkpasang"] : "").'">
						
					    </div>
					    <div class="col-xs-3">
						<label>Nomer Jawaban SPK Pasang Baru</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" id="kode_jawabspk" name="kode_jawabspk" required="" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["kode_jawabspk"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="id_customer" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["id_customer"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="nama_customer" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["nama_customer"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
                                        
					    <div class="col-xs-3">
						<label>No. link Budget</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="id_linkbudget" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["id_linkbudget"] : "").'">
						
					    </div>
					    <div class="col-xs-3">
						
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["id_cabang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Paket Koneksi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="paket_koneksi" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["paket_koneksi"] : "").'">
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Nama Paket</label>
					    </div>
					    <div class="col-xs-3">
					        <input type="text" readonly="" class="form-control"  name="nama_koneksi" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["nama_koneksi"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="user_id" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["user_id"] : "").'">
					    </div>
					    <div class="col-xs-3">
						<label>Telp</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="telpon" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["telpon"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["alamat"] : "").'">
					    </div>
                                        
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Teknisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" readonly="" id="nama_teknisi" name="nama_teknisi" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["nama_teknisi"] : "").'">
						<input type="hidden" readonly="" class="form-control" name="id_teknisi" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["id_teknisi"] : "").'">
						
					    </div>
                                        
					    <div class="col-xs-3">
						<label>Marketing</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" id="nama_marketing" name="nama_marketing" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["nama_marketing"] : "").'">
					        <input type="hidden" class="form-control" readonly="" name="id_employee" value="'.(isset($_GET['id']) ? $row_spk_aktivasi["id_marketing"] : "").'">
						
					    </div>
                                        </div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-9">
						<textarea name="pekerjaan" readonly="" class="form-control" placeholder="Pekerjaan" style="resize: none;">'.(isset($_GET['id']) ? $row_spk_aktivasi['pekerjaan'] : "AKTIVASI BARU").'</textarea>
					    </div>
                                        
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_spk_aktivasi["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Latest Updated By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_spk_aktivasi["user_upd"]." ".$row_spk_aktivasi["date_upd"] : "").'
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

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>';

    $title	= 'Detail SPK Aktivasi Baru';
    $submenu	= "SPK_aktivasi";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_CSO."logout.php");
    }

?>