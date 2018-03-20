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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Surat Detail");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_surat` WHERE `kode_surat`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_surat_detail.php?c='.$row_data["kode_surat"];
	
}



    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Surat Detail</h3>
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
												<label>Tgl Update terakhir</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['c']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
											<div class="col-xs-1">
												<label>Exp Date</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="datepicker" name="exp_date" required="" value="'.(isset($_GET['c']) ? $row_data["exp_date"] : date("Y-m-d",mktime(0, 0, 0, date("m")+1, date("d"), date("Y")))).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Kode Surat</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_surat" name="kode_surat" required="" value="'.(isset($_GET['c']) ? $row_data["kode_surat"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Nama Surat</label>
											</div>
											<div class="col-xs-4">
												<input type="text" readonly="" class="form-control" id="nama_surat" name="nama_surat" required="" value="'.(isset($_GET['c']) ? $row_data["nama_surat"] : "").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Penerbit Surat</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="penerbit_surat" name="penerbit_surat" required="" value="'.(isset($_GET['c']) ? $row_data["penerbit_surat"] : $loggedin["username"]).'">
											</div>
											<div class="col-xs-2">
												<label>No HP</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp" name="no_hp" required="" value="'.(isset($_GET['c']) ? $row_data["no_hp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>No Hp 2</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly=""  class="form-control" id="no_hp2" name="no_hp2" required="" value="'.(isset($_GET['c']) ? $row_data["no_hp2"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>No HP 3</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp3" name="no_hp3" required="" value="'.(isset($_GET['c']) ? $row_data["no_hp3"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											
											<div class="col-xs-2">
												<label>No HP 4</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="no_hp4" name="no_hp4" required="" value="'.(isset($_GET['c']) ? $row_data["no_hp4"] : "").'">
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
							      <th width="1%">
								  No.
							      </th>
								   <th width="15%">
								  Kode Formulir
							      </th>
							      <th width="15%">
								  Nama Formulir
							      </th>
							      <th width="20%">
								  Lokasi File
							      </th>
							      <th  width="20%">
								  Tanggal Update Terakhir
							      </th>
								  <th width="15%">
								  Exp Date
							      </th>
								  <th style="vertical-align: middle;" width="20%">
							      #
							      </th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_data			= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_data_item	= "SELECT * FROM `gx_surat_detail` WHERE `kode_surat` ='".$kode_data."' AND `level` = '0';";
    $sql_data_item	 	= mysql_query($query_data_item, $conn);
    $id_detail_data 	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data_detail 	= "SELECT * FROM `gx_surat_detail` WHERE `kode_surat` ='".$kode_data."' AND `level` = '0' AND `id_surat_detail` = '".$id_detail_data."' LIMIT 0,1;";
    //echo $query_data_item;
	$sql_data_detail   	= mysql_query($query_data_detail, $conn);
    $row_data_detail 	= mysql_fetch_array($sql_data_detail);
    $no = 1;
	
    while($row_data_item = mysql_fetch_array($sql_data_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_data_item["kode_formulir"].'</td>
	<td>'.$row_data_item["nama_formulir"].'</td>
	<td>'.$row_data_item["lokasi_file"].'</td>
	<td>'.$row_data_item["tanggal_update_terakhir"].'</td>
	<td>'.$row_data_item["exp_date"].'</td>
	<td><a href="download.php?c='.$row_data_item["kode_surat"].'"><span class="label label-info">Download</span></a> Or <a href="form_surat_detail?c='.$row_data_item["kode_surat"].'&id='.$row_data_item["id_surat_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>
	';
	$no++;
    }
}else{
	
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}


$content .='							    
					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM Detail Surat</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_data_detail["id_surat_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_rab" value="'.(isset($_GET['c']) ? $kode_data : "").'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Kode Formulir</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly="" class="form-control" name="kode_formulir" id="kode_formulir" value="'.(isset($_GET['id']) ? $row_data_detail["kode_formulir"] : "").'" onclick="return valideopenerform(\'data_formulir.php?r=myForm&f=surat\',\'formulir\');">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Nama Formulir</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly=""  class="form-control" name="nama_formulir" id="nama_formulir" value="'.(isset($_GET['id']) ? $row_data_detail["nama_formulir"] : "").'">
							<input type="hidden" readonly=""  class="form-control" name="nama_file" id="nama_file" value="'.(isset($_GET['id']) ? $row_data_detail["nama_file"] : "").'">
							<input type="hidden" readonly=""  class="form-control" name="jumlah_halaman" id="jumlah_halaman" value="'.(isset($_GET['id']) ? $row_data_detail["jumlah_halaman"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Lokasi_file</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly="" class="form-control" name="lokasi_file" id="lokasi_file" value="'.(isset($_GET['id']) ? $row_data_detail["lokasi_file"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>tanggal Update Terakhir</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" readonly="" class="form-control" name="tanggal_update_terakhir" id="tanggal_update_terakhir" value="'.(isset($_GET['id']) ? $row_data_detail["tanggal_update_terakhir"] : "").'" >
					    </div>
                    </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Tanggal Exp</label>
					    </div>
					    <div class="col-xs-8">
							<input readonly=""  type="text" class="form-control" name="exp_date" id="date_exp" value="'.(isset($_GET['id']) ? $row_data_detail["exp_date"] : "").'">
					    </div>
                    </div>
					</div>
					
                     
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_data_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_data_detail["user_upd"]." ".$row_data_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" value="Submitlock" name="savelock" class="btn btn-primary">Save & Lock</button>  <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Tambah</button>
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
	
	$kode_formulir			= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $nama_formulir			= isset($_POST['nama_formulir']) ? mysql_real_escape_string(trim($_POST['nama_formulir'])) : '';
	$lokasi_file   			= isset($_POST['lokasi_file']) ? mysql_real_escape_string(trim($_POST['lokasi_file'])) : '';
	$nama_file   			= isset($_POST['nama_file']) ? mysql_real_escape_string(trim($_POST['nama_file'])) : '';
	$tanggal_update_terakhir= isset($_POST['tanggal_update_terakhir']) ? mysql_real_escape_string(trim($_POST['tanggal_update_terakhir'])) : '';
    $exp_date		 		= isset($_POST['exp_date']) ? mysql_real_escape_string(trim($_POST['exp_date'])) : '';
	$jumlah_halaman	 		= isset($_POST['jumlah_halaman']) ? mysql_real_escape_string(trim($_POST['jumlah_halaman'])) : '';
	
	$sql_insert = "INSERT INTO `gx_surat_detail` (`id_surat_detail`, `kode_surat`, `kode_formulir`,
						  `nama_formulir`, `lokasi_file`, `nama_file`, `tanggal_update_terakhir`, `exp_date`, `jumlah_halaman`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$_GET["c"]."', '".$kode_formulir."',
						  '".$nama_formulir."', '".$lokasi_file."', '".$nama_file."', '".$tanggal_update_terakhir."', '".$exp_date."', '".$jumlah_halaman."',
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
			window.location.href='".URL_ADMIN."surat/form_surat_detail.php?c=$kode_data';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
   
	$kode_formulir			= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $nama_formulir			= isset($_POST['nama_formulir']) ? mysql_real_escape_string(trim($_POST['nama_formulir'])) : '';
	$lokasi_file   			= isset($_POST['lokasi_file']) ? mysql_real_escape_string(trim($_POST['lokasi_file'])) : '';
	$nama_file   			= isset($_POST['nama_file']) ? mysql_real_escape_string(trim($_POST['nama_file'])) : '';
	$tanggal_update_terakhir= isset($_POST['tanggal_update_terakhir']) ? mysql_real_escape_string(trim($_POST['tanggal_update_terakhir'])) : '';
    $exp_date		 		= isset($_POST['exp_date']) ? mysql_real_escape_string(trim($_POST['exp_date'])) : '';
	$jumlah_halaman	 		= isset($_POST['jumlah_halaman']) ? mysql_real_escape_string(trim($_POST['jumlah_halaman'])) : '';
	
    $sql_update = "UPDATE `gx_surat_detail` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_surat_detail` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	=  "INSERT INTO `gx_surat_detail` (`id_surat_detail`, `kode_surat`, `kode_formulir`,
						  `nama_formulir`, `lokasi_file`, `nama_file`, `tanggal_update_terakhir`, `exp_date`, `jumlah_halaman`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$_GET["c"]."', '".$kode_formulir."',
						  '".$nama_formulir."', '".$lokasi_file."', '".$nama_file."', '".$tanggal_update_terakhir."', '".$exp_date."', '".$jumlah_halaman."',
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
			window.location.href='".URL_ADMIN."surat/form_surat_detail.php?c=$kode_data';
			</script>";
			
}elseif(isset($_POST["savelock"]))
{
    
    
	$sql_update_lock = "UPDATE `gx_surat` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
						WHERE `kode_surat`='".$_GET["c"]."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_surat';
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

    $title	= 'Form Surat Detail';
    $submenu	= "surat";
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