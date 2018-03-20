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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form pasang Add On");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_spk_pasang_add_on` WHERE `id_spk_pasang_add_on`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	$data_data_teknisi = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_data[id_teknisi]'", $conn));
	$data_data_marketing = mysql_fetch_array(mysql_query("SELECT `cNama` FROM `tbPegawai` WHERE `id_employee`='$row_data[id_marketing]'", $conn));
   
}

    $content ='<section class="content-header">
                    <h1>
                        Form SPK Pasang Add On
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form SPK Pasang Add On</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cabang</label>
											</div>
											';
										if(isset($_GET["id"])){
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
														</div>';
										}else{
											$content .='<div class="col-xs-3">
															<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=spk_pasang_add_on\',\'cabang\');">
															<input type="hidden" class="form-control" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
														</div>';
										}
										$content .='
											
											<div class="col-xs-3">
												<label>Tanggal</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No SPK Pasang Add On</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" readonly=""  class="form-control" id="kode_spk_pasang_add_on" name="kode_spk_pasang_add_on" required="" value="'.(isset($_GET['id']) ? $row_data["kode_spk_pasang_add_on"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kode Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" id="kode_customer" name="kode_customer" required="" value="'.(isset($_GET['id']) ? $row_data["kode_customer"] : "").'" onclick="return valideopenerform(\'data_add_on.php?r=myForm&f=spk_pasang_add_on\',\'customer\');" >
											</div>
										</div>
										</div> 
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama Customer</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="nama_customer" value="'.(isset($_GET['id']) ? $row_data["nama_customer"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No Link Budget</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" name="no_linkbudget" value="'.(isset($_GET['id']) ? $row_data["no_linkbudget"] : "").'" onclick="return valideopenerform(\'data_link_budget.php?r=myForm&f=spk_pasang_add_on\',\'linkbudget\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>User ID</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="uid" value="'.(isset($_GET['id']) ? $row_data["uid"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Telp</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control"  name="telp" value="'.(isset($_GET['id']) ? $row_data["telp"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Paket Koneksi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" readonly="" name="kode_paket" value="'.(isset($_GET['id']) ? $row_data["kode_paket"] : "").'">
											</div>
											<div class="col-xs-5">
												<input type="text" class="form-control" readonly="" name="nama_paket" value="'.(isset($_GET['id']) ? $row_data["nama_paket"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Alamat</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="alamat" class="form-control" placeholder="Alamat" style="resize: none;"> '.(isset($_GET["id"]) ? $row_data['alamat'] :"").' </textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Teknisi</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="id_teknisi" type="hidden" value="'.(isset($_GET["id"]) ? $row_data['id_teknisi'] :"") .'">
												<input class="form-control" readonly="" name="nama_teknisi" placeholder="Nama Teknisi" type="text" value="'.(isset($_GET["id"]) ? $data_data_teknisi['cNama'] :"") .'" onclick="return valideopenerform(\'data_teknisi.php?r=myForm\',\'teknisi\');">
												
											</div>
											<div class="col-xs-3">
											  <label>Marketing</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="id_employee" type="hidden" value="'.(isset($_GET["id"]) ? $row_data['id_marketing'] :"") .'">
												<input class="form-control" readonly="" name="nama_marketing" placeholder="Nama Marketing" type="text" value="'.(isset($_GET["id"]) ? $data_data_marketing['cNama'] :"") .'" onclick="return valideopenerform(\'data_marketing.php?r=myForm\',\'marketing\');">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Perkerjaan</label>
											</div>
											<div  class="col-xs-9">
												<textarea name="pekerjaan" class="form-control" placeholder="Pekerjaan" style="resize: none;"> '.(isset($_GET["id"]) ? $row_data['pekerjaan'] :"").' </textarea>
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
    $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_spk_pasang_add_on	= isset($_POST['kode_spk_pasang_add_on']) ? mysql_real_escape_string(trim($_POST['kode_spk_pasang_add_on'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $no_linkbudget    		= isset($_POST['no_linkbudget']) ? mysql_real_escape_string(trim($_POST['no_linkbudget'])) : '';
	
	$uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
	$telp	    			= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    
    $kode_paket				= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket				= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $alamat					= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $id_teknisi				= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
    $id_marketing			= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
	
    $pekerjaan				= isset($_POST['pekerjaan']) ? mysql_real_escape_string(trim($_POST['pekerjaan'])) : '';
	if($nama_cabang != "" && $kode_spk_pasang_add_on != "" && $nama_customer != "" && $no_linkbudget != ""){
    $sql_insert = "INSERT INTO `gx_spk_pasang_add_on` (`id_spk_pasang_add_on`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_spk_pasang_add_on`, `kode_customer`, `nama_customer`, `no_linkbudget`, `kode_paket`,
						  `nama_paket`, `uid`, `telp`, `alamat`, `id_teknisi`, `id_marketing`, `pekerjaan`, 
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_spk_pasang_add_on."', '".$kode_customer."', '".$nama_customer."', '".$no_linkbudget."', '".$kode_paket."',
						  '".$nama_paket."', '".$uid."', '".$telp."', '".$alamat."', '".$id_teknisi."', '".$id_marketing."', '".$pekerjaan."',
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
			window.location.href='".URL_ADMIN."add_on/master_spk_pasang_add_on.php';
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
    
    //echo "save";
    $kode_cabang	   		= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang    		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	
	$tanggal	    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_spk_pasang_add_on	= isset($_POST['kode_spk_pasang_add_on']) ? mysql_real_escape_string(trim($_POST['kode_spk_pasang_add_on'])) : '';
	$kode_customer  		= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer    		= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $no_linkbudget    		= isset($_POST['no_linkbudget']) ? mysql_real_escape_string(trim($_POST['no_linkbudget'])) : '';
	
	$uid	    			= isset($_POST['uid']) ? mysql_real_escape_string(trim($_POST['uid'])) : '';
	$telp	    			= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    
    $kode_paket				= isset($_POST['kode_paket']) ? mysql_real_escape_string(trim($_POST['kode_paket'])) : '';
    $nama_paket				= isset($_POST['nama_paket']) ? mysql_real_escape_string(trim($_POST['nama_paket'])) : '';
    $alamat					= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $id_teknisi				= isset($_POST['id_teknisi']) ? mysql_real_escape_string(trim($_POST['id_teknisi'])) : '';
    $id_marketing			= isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
	
    $pekerjaan				= isset($_POST['pekerjaan']) ? mysql_real_escape_string(trim($_POST['pekerjaan'])) : '';
 
    $sql_update = "UPDATE `gx_spk_pasang_add_on` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_spk_pasang_add_on` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	
	$sql_insert_update = "INSERT INTO `gx_spk_pasang_add_on` (`id_spk_pasang_add_on`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_spk_pasang_add_on`, `kode_customer`, `nama_customer`, `no_linkbudget`, `kode_paket`,
						  `nama_paket`, `uid`, `telp`, `alamat`, `id_teknisi`, `id_marketing`, `pekerjaan`, 
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_spk_pasang_add_on."', '".$kode_customer."', '".$nama_customer."', '".$no_linkbudget."', '".$kode_paket."',
						  '".$nama_paket."', '".$uid."', '".$telp."', '".$alamat."', '".$id_teknisi."', '".$id_marketing."', '".$pekerjaan."',
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
			window.location.href='".URL_ADMIN."add_on/master_spk_pasang_add_on.php';
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

    $title	= 'Form SPK Pasang Add On';
    $submenu	= "spk_pasang_add_on";
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