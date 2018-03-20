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
redirectToHTTPS();
if($loggedin = logged_inStaff()){ 

if($loggedin["group"] == 'staff'){
        global $conn;



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Penawaran");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_penawaran` WHERE `id_penawaran`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	$sql_brosur		= "SELECT * FROM `gx_brosur` WHERE `kode_brosur` = '".$row_data["kode_brosur"]."';";
	$query_brosur	= mysql_query($sql_brosur, $conn);
    $row_brosur		= mysql_fetch_array($query_brosur);
	$sql_brosur_d	= "SELECT * FROM `gx_brosur_detail`	WHERE `id_brosur` = '".$row_brosur["id_brosur"]."' AND `level` = '0';";
    $query_brosur_d	= mysql_query($sql_brosur_d, $conn);
    $row_brosur_d	= mysql_fetch_array($query_brosur_d);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Form Penawaran
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Penawaran</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">';
											$sql_cabang	= "SELECT * FROM `gx_cabang` WHERE `level` = '0' AND `id_cabang` = '".$loggedin["cabang"]."' ORDER BY `id_cabang` ASC LIMIT 0,1;";
												$query_cabang	= mysql_query($sql_cabang, $conn);
												$row_cabang = mysql_fetch_array($query_cabang);
											if(isset($_GET["id"])){
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">';
											}else{
												
												$content .='<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : $row_cabang["kode_cabang"]).'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : $row_cabang["nama_cabang"]).'" >';
											}
											
												$sql_penawaran = mysql_fetch_array(mysql_query("SELECT * FROM `gx_penawaran` ORDER BY `id_penawaran` DESC", $conn));
												$last_data  = $sql_penawaran["id_penawaran"] + 1;
												$tanggal    = date("d");
												$kode_penawaran = $row_cabang["kode_cabang"].'-'.$tanggal.''.sprintf("%04d", $last_data);
											$content .='</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? date("Y-m-d H:i", strtotime($row_data["tanggal"])) : date("Y-m-d H:i")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Penawaran</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_penawaran" name="kode_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["kode_penawaran"] : $kode_penawaran).'" >
											</div>
											<div class="col-xs-3">
												<label>No Prospek</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_prospek" name="kode_prospek" required="" value="'.(isset($_GET['id']) ? $row_data["kode_prospek"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_data["kode_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="marketing" name="marketing" required="" value="'.(isset($_GET['id']) ? $row_data["marketing"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_customer" name="nama_customer" required="" value="'.(isset($_GET['id']) ? $row_data["nama_customer"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="alamat" name="alamat" required="" value="'.(isset($_GET['id']) ? $row_data["alamat"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Perusahaan</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required="" value="'.(isset($_GET['id']) ? $row_data["nama_perusahaan"] : "").'">
											</div>
										</div>
										</div>
										
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kelurahan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kelurahan" name="kelurahan" required="" value="'.(isset($_GET['id']) ? $row_data["kelurahan"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kecamatan</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kecamatan" name="kecamatan" required="" value="'.(isset($_GET['id']) ? $row_data["kecamatan"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Kota</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kota" name="kota" required="" value="'.(isset($_GET['id']) ? $row_data["kota"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Pos</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_pos" name="kode_pos" required="" value="'.(isset($_GET['id']) ? $row_data["kode_pos"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Telp</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="telp" name="telp" required="" value="'.(isset($_GET['id']) ? $row_data["no_telp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No HP 1</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp1" name="no_hp1" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp1"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No HP 2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp2" name="no_hp2" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Contact Person</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="contact_person" name="contact_person" required="" value="'.(isset($_GET['id']) ? $row_data["contact_person"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Email</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="email" name="email" required="" value="'.(isset($_GET['id']) ? $row_data["email"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jangka Waktu Penawaran</label>
											</div>
											<div class="col-xs-1">
												<input type="text" readonly="" class="form-control" id="jangka_waktu_penawaran" name="jangka_waktu_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["jangka_waktu_penawaran"] : "").'">
											</div>
											<div class="col-xs-1">
												<label>Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jasa</label>
											</div>
											<div class="col-xs-4">
												Internet <input type="checkbox" readonly="" class="form-control" name="internet" '.((isset($_GET['id']) && ($row_data["internet"]) == "1" ) ? "checked" : "").' value="1">
												VOIP <input type="checkbox" readonly="" class="form-control" name="voip" '.((isset($_GET['id']) && ($row_data["voip"]) == "1" ) ? "checked" : "").' value="1">
												VOD <input type="checkbox" readonly="" class="form-control" name="vod" '.((isset($_GET['id']) && ($row_data["vod"]) == "1" ) ? "checked" : "").' value="1"> 
												
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Paket</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" readonly="" class="form-control" id="kode_paket" name="kode_paket" required="" value="'.(isset($_GET['id']) ? $row_data["kode_paket"] : "").'">
												<input type="text" readonly="" class="form-control" id="nama_paket" name="nama_paket" required="" value="'.(isset($_GET['id']) ? $row_data["nama_paket"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Setup Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="setup_fee" required="" value="'.(isset($_GET['id']) ? $row_data["setup_fee"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Abonemen</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="abonemen" required="" value="'.(isset($_GET['id']) ? $row_data["abonemen"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Monthly Fee</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="harga" name="monthly_fee" required="" value="'.(isset($_GET['id']) ? $row_data["monthly_fee"] : "").'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nominal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" maxlength="20" class="form-control" id="harga" name="nominal" required="" value="'.(isset($_GET['id']) ? $row_data["nominal"] : "").'">
											</div>
											
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>keterangan</label>
											</div>
											<div class="col-xs-9">
												<textarea name="keterangan" readonly="" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['id']) ? $row_data['keterangan'] :"").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Brosur</label>
											</div>
											<div class="col-xs-2">
												<a class="ajax" href="'.URL_ADMIN.''.$row_brosur_d["lokasi_file"].''.$row_brosur_d["nama_file"].'" title=""><input type="text" readonly="" class="form-control" id="kode_brosur" name="kode_brosur" required="" value="'.(isset($_GET['id']) ? $row_data["kode_brosur"] : "").'"></a>
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
		<link rel="stylesheet" href="../../js/colorbox/example1/colorbox.css" />
		<script src="../../js/colorbox/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:\'group1\'});
				$(".group2").colorbox({rel:\'group2\', transition:"fade"});
				$(".group3").colorbox({rel:\'group3\', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:\'group4\', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert(\'onOpen: colorbox is about to open\'); },
					onLoad:function(){ alert(\'onLoad: colorbox has started to load the targeted content\'); },
					onComplete:function(){ alert(\'onComplete: colorbox has displayed the loaded content\'); },
					onCleanup:function(){ alert(\'onCleanup: colorbox has begun the close process\'); },
					onClosed:function(){ alert(\'onClosed: colorbox has completely closed\'); }
				});

				$(\'.non-retina\').colorbox({rel:\'group5\', transition:\'none\'})
				$(\'.retina\').colorbox({rel:\'group5\', transition:\'none\', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$(\'#click\').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
		';

    $title	= 'Form Penawaran';
    $submenu	= "penawaran";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header("location: ".URL_STAFF."logout.php");
    }

?>