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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Penawaran");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_penawaran` WHERE `id_penawaran`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Penawaran</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											<div class="col-xs-3">
												<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=penawaran\',\'cabang\');">
											</div>
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Penawaran</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_penawaran" name="kode_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["kode_penawaran"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No Prospek</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="kode_prospek" name="kode_prospek" required="" value="'.(isset($_GET['id']) ? $row_data["kode_prospek"] : "").'">
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
												<input type="text" class="form-control" id="marketing" name="marketing" required="" value="'.(isset($_GET['id']) ? $row_data["marketing"] : "").'">
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
												<label>Alamat Perusahaan</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" required="" value="'.(isset($_GET['id']) ? $row_data["alamat_perusahaan"] : "").'">
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
												<input type="text" class="form-control" id="kecamatan" name="kecamatan" required="" value="'.(isset($_GET['id']) ? $row_data["kecamatan"] : "").'">
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
												<input type="text" class="form-control" id="kode_pos" name="kode_pos" required="" value="'.(isset($_GET['id']) ? $row_data["kode_pos"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Telp</label>
											</div>
											<div class="col-xs-9">
												<input type="text" readonly="" class="form-control" id="telp" name="telp" required="" value="'.(isset($_GET['id']) ? $row_data["telp"] : "").'">
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
												<input type="text" class="form-control" id="no_hp2" name="no_hp2" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp2"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Contact Person</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="contact_person" name="contact_person" required="" value="'.(isset($_GET['id']) ? $row_data["contact_person"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Email</label>
											</div>
											<div class="col-xs-9">
												<input type="text" class="form-control" id="email" name="email" required="" value="'.(isset($_GET['id']) ? $row_data["email"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jangka Waktu Penawaran</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" id="jangka_waktu_penawaran" name="jangka_waktu_penawaran" required="" value="'.(isset($_GET['id']) ? $row_data["jangka_waktu_penawaran"] : "").'">
											</div>
											<div class="col-xs-1">
												<label>Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>keterangan</label>
											</div>
											<div class="col-xs-9">
												<textarea name="keterangan" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['id']) ? $row_data['keterangan'] :"").'</textarea>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Probability Index</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="probability_index" name="probability_index" required="" value="'.(isset($_GET['id']) ? $row_data["probability_index"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Target User Baru</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" class="form-control" id="target_user_baru" name="target_user_baru" required="" value="'.(isset($_GET['id']) ? $row_data["target_user_baru"] : "").'">
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
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang   		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_penawaran			= isset($_POST['kode_penawaran']) ? mysql_real_escape_string(trim($_POST['kode_penawaran'])) : '';
	$periode		 	= isset($_POST['periode']) ? mysql_real_escape_string(trim($_POST['periode'])) : '';
	$keterangan		 	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $probability_index	= isset($_POST['probability_index']) ? mysql_real_escape_string(trim($_POST['probability_index'])) : '';
    $target_user_baru	= isset($_POST['target_user_baru']) ? mysql_real_escape_string(trim($_POST['target_user_baru'])) : '';
	if($nama_cabang != "" && $kode_penawaran != "" && $keterangan != ""){
	$sql_insert = "INSERT INTO `gx_rab` (`id_rab`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_penawaran`, `periode`, `keterangan`, `probability_index`, `target_user_baru`, `status`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_penawaran."', '".$periode."', '".$keterangan."', '".$probability_index."', '".$target_user_baru."', '0',
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
			window.location.href='".URL_ADMIN."accounting/form_rab_detail.php?c=$kode_penawaran';
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
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang   		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_penawaran			= isset($_POST['kode_penawaran']) ? mysql_real_escape_string(trim($_POST['kode_penawaran'])) : '';
	$periode		 	= isset($_POST['periode']) ? mysql_real_escape_string(trim($_POST['periode'])) : '';
	$keterangan		 	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $probability_index	= isset($_POST['probability_index']) ? mysql_real_escape_string(trim($_POST['probability_index'])) : '';
    $target_user_baru	= isset($_POST['target_user_baru']) ? mysql_real_escape_string(trim($_POST['target_user_baru'])) : '';
	
    $sql_update = "UPDATE `gx_rab` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_rab` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_rab` (`id_rab`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_penawaran`, `periode`, `keterangan`, `probability_index`, `target_user_baru`, `status`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_penawaran."', '".$periode."', '".$keterangan."', '".$probability_index."', '".$target_user_baru."', '0',
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
			window.location.href='".URL_ADMIN."accounting/master_rab.php';
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

    $title	= 'Form RAB';
    $submenu	= "rab";
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