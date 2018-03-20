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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Surat");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_surat` WHERE `id_surat`='$id_data' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-11">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Surat</h3>
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
												<input type="hidden" class="form-control" id="kode_cabang" name="kode_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["kode_cabang"] : "").'">
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=surat\',\'cabang\');">
											</div>
											<div class="col-xs-2">
												<label>Tgl Update terakhir</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
											<div class="col-xs-1">
												<label>Exp Date</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="datepicker" name="exp_date" required="" value="'.(isset($_GET['id']) ? $row_data["exp_date"] : date("Y-m-d",mktime(0, 0, 0, date("m")+1, date("d"), date("Y")))).'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Kode Surat</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_surat" name="kode_surat" required="" value="'.(isset($_GET['id']) ? $row_data["kode_surat"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Nama Surat</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" id="nama_surat" name="nama_surat" required="" value="'.(isset($_GET['id']) ? $row_data["nama_surat"] : "").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Penerbit Surat</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="penerbit_surat" name="penerbit_surat" required="" value="'.(isset($_GET['id']) ? $row_data["penerbit_surat"] : $loggedin["username"]).'">
											</div>
											<div class="col-xs-2">
												<label>No HP</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="no_hp" name="no_hp" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>No Hp 2</label>
											</div>
											<div class="col-xs-3">
												<input type="text"  class="form-control" id="no_hp2" name="no_hp2" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp2"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>No HP 3</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="no_hp3" name="no_hp3" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp3"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Created By</label>
											</div>
											<div class="col-xs-3">
												'.(isset($_GET['id']) ? $row_data["user_add"] : $loggedin["username"]).'
											</div>
											<div class="col-xs-2">
												<label>No HP 4</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="no_hp4" name="no_hp4" required="" value="'.(isset($_GET['id']) ? $row_data["no_hp4"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
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
    $exp_date			= isset($_POST['exp_date']) ? mysql_real_escape_string(trim($_POST['exp_date'])) : '';
    $kode_surat			= isset($_POST['kode_surat']) ? mysql_real_escape_string(trim($_POST['kode_surat'])) : '';
    $nama_surat		 	= isset($_POST['nama_surat']) ? mysql_real_escape_string(trim($_POST['nama_surat'])) : '';
	$penerbit_surat	 	= isset($_POST['penerbit_surat']) ? mysql_real_escape_string(trim($_POST['penerbit_surat'])) : '';
	$no_hp		 		= isset($_POST['no_hp']) ? mysql_real_escape_string(trim($_POST['no_hp'])) : '';
	$no_hp2		 		= isset($_POST['no_hp2']) ? mysql_real_escape_string(trim($_POST['no_hp2'])) : '';
	$no_hp3		 		= isset($_POST['no_hp3']) ? mysql_real_escape_string(trim($_POST['no_hp3'])) : '';
	$no_hp4		 		= isset($_POST['no_hp4']) ? mysql_real_escape_string(trim($_POST['no_hp4'])) : '';
	
	$sql_insert = "INSERT INTO `gx_surat` (`id_surat`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `exp_date`, `kode_surat`, `nama_surat`, `penerbit_surat`, `no_hp`, `no_hp2`, `no_hp3`, `no_hp4`, `status`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$exp_date."', '".$kode_surat."', '".$nama_surat."', '".$penerbit_surat."', '".$no_hp."', '".$no_hp2."', '".$no_hp3."', '".$no_hp4."', '0',
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
			window.location.href='".URL_ADMIN."surat/form_surat_detail.php?c=$kode_surat';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $kode_cabang	   	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
	$nama_cabang   		= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
	$tanggal    		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $exp_date			= isset($_POST['exp_date']) ? mysql_real_escape_string(trim($_POST['exp_date'])) : '';
    $kode_surat			= isset($_POST['kode_surat']) ? mysql_real_escape_string(trim($_POST['kode_surat'])) : '';
    $nama_surat		 	= isset($_POST['nama_surat']) ? mysql_real_escape_string(trim($_POST['nama_surat'])) : '';
	$penerbit_surat	 	= isset($_POST['penerbit_surat']) ? mysql_real_escape_string(trim($_POST['penerbit_surat'])) : '';
	$no_hp		 		= isset($_POST['no_hp']) ? mysql_real_escape_string(trim($_POST['n0_hp'])) : '';
	$no_hp2		 		= isset($_POST['no_hp2']) ? mysql_real_escape_string(trim($_POST['no_hp2'])) : '';
	$no_hp3		 		= isset($_POST['no_hp3']) ? mysql_real_escape_string(trim($_POST['no_hp3'])) : '';
	$no_hp4		 		= isset($_POST['no_hp4']) ? mysql_real_escape_string(trim($_POST['no_hp4'])) : '';
	
    $sql_update = "UPDATE `gx_surat` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_surat` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_surat` (`id_surat`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `exp_date`, `kode_surat`, `nama_surat`, `penerbit_surat`, `no_hp`, `no_hp2`, `no_hp3`, `no_hp4`, `status`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$exp_date."', '".$kode_surat."', '".$nama_surat."', '".$penerbit_surat."', '".$no_hp."', '".$no_hp2."', '".$no_hp3."', '".$no_hp4."', '0',
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
			window.location.href='".URL_ADMIN."surat/master_surat.php';
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

    $title	= 'Form Surat';
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