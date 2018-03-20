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



enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Cuti");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_master_cuti` WHERE `id_cuti`='".$id_data."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
}

    $content ='<section class="content-header">
                    <h1>
                        Form Cuti
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!--<h3 class="box-title">Form Cuti</h3>-->
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-12" align="center">
												<label>Form CUTI</label>
											</div>
										</div>
										</div>

										<input type="hidden" class="form-control" id="" name="id_cuti" placeholder="Tahun" value="'.(isset($_GET['id']) ? $row_data["id_cuti"] : "").'">
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tahun</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun" value="'.(isset($_GET['id']) ? $row_data["tahun"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Bulan</label>
											</div>
											<div class="col-xs-3">
												<select name="bulan" class="form-control" required="">
												    <option value="">Pilih Bulan</option>
												    <option value="January">January</option>
												    <option value="February">February</option>
												    <option value="March">March</option>
												    <option value="April">April</option>
												    <option value="May">May</option>
												    <option value="June">June</option>
												    <option value="July">July</option>
												    <option value="Agustus">Agustus</option>
												    <option value="September">September</option>
												    <option value="October">October</option>
												    <option value="November">November</option>
												    <option value="December">December</option>
												</select>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Masa Kerja</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="masa_kerja" placeholder="Masa Kerja" value="'.(isset($_GET['id']) ? $row_data["masa_kerja"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Tahun</label>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Limit Karyawan Cuti</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="limit_karyawan_cuti" placeholder="Limit Karyawan Cuti" value="'.(isset($_GET['id']) ? $row_data["limit_karyawan_cuti"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Orang/Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jumlah Limit per Divisi</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="" name="jumlah_limit_per_divisi" placeholder="Jumlah Limit Per Divisi" value="'.(isset($_GET['id']) ? $row_data["jumlah_limit_per_divisi"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Orang/Hari</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Remarks :</label>
											</div>
											<div class="col-xs-9">
												<textarea class="form-control" id="" name="remarks" placeholder="remarks">'.(isset($_GET['id']) ? $row_data["remarks"] : "").'</textarea>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Cuti : Kuning</label>
											</div>
											<div class="col-xs-3">
												<label>Ijin : Merah</label>
											</div>
											<div class="col-xs-3">
												<label>Merah : Libur Hari Besar</label>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Tampilan Tanggalan</label>
											</div>
											<div class="col-xs-9">
												<!--<textarea class="form-control" id="" name="" placeholder=""></textarea>-->
												<input type="text" class="form-control" id="datepicker" name="tanggal" placeholder="" value="'.(isset($_GET['id']) ? $row_data["tanggal"] : "").'">
											</div>
										</div>
										</div>
										
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' value="Submit" class="btn btn-primary">Submit</button>
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
    //$	   		= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
	$tahun	   			= isset($_POST['tahun']) ? mysql_real_escape_string(trim($_POST['tahun'])) : '';
	$bulan	   			= isset($_POST['bulan']) ? mysql_real_escape_string(trim($_POST['bulan'])) : '';
	$masa_kerja	   		= isset($_POST['masa_kerja']) ? mysql_real_escape_string(trim($_POST['masa_kerja'])) : '';
	$limit_karyawan_cuti	   	= isset($_POST['limit_karyawan_cuti']) ? mysql_real_escape_string(trim($_POST['limit_karyawan_cuti'])) : '';
	$jumlah_limit_per_divisi	= isset($_POST['jumlah_limit_per_divisi']) ? mysql_real_escape_string(trim($_POST['jumlah_limit_per_divisi'])) : '';
	$remarks	   		= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	$tanggal	   		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
	$user_add	   		= $loggedin['username'];
	$user_upd	   		= $loggedin['username'];
	
if($_POST['save'] == 'Submit'){
    $sql_insert = "INSERT INTO `software`.`gx_master_cuti` (`id_cuti`, `tahun`, `bulan`, `masa_kerja`, `limit_karyawan_cuti`, `jumlah_limit_per_divisi`, `remarks`, `tanggal`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL, '".$tahun."', '".$bulan."', '".$masa_kerja."', '".$limit_karyawan_cuti."', '".$jumlah_limit_per_divisi."', '".$remarks."', '".$tanggal."', NOW(), NOW(), '".$user_add."', '".$user_upd."', '0')";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_cuti.php';
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
	$id_cuti	   		= isset($_POST['id_cuti']) ? mysql_real_escape_string(trim($_POST['id_cuti'])) : '';
	$tahun	   			= isset($_POST['tahun']) ? mysql_real_escape_string(trim($_POST['tahun'])) : '';
	$bulan	   			= isset($_POST['bulan']) ? mysql_real_escape_string(trim($_POST['bulan'])) : '';
	$masa_kerja	   		= isset($_POST['masa_kerja']) ? mysql_real_escape_string(trim($_POST['masa_kerja'])) : '';
	$limit_karyawan_cuti	   	= isset($_POST['limit_karyawan_cuti']) ? mysql_real_escape_string(trim($_POST['limit_karyawan_cuti'])) : '';
	$jumlah_limit_per_divisi	= isset($_POST['jumlah_limit_per_divisi']) ? mysql_real_escape_string(trim($_POST['jumlah_limit_per_divisi'])) : '';
	$remarks	   		= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	$tanggal	   		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
	$user_add	   		= $loggedin['username'];
	$user_upd	   		= $loggedin['username'];
	
	
    $sql_update = "UPDATE `gx_master_cuti` SET `user_upd`=NOW(),`level`='1' WHERE `id_cuti`='".$id_cuti."'";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `software`.`gx_master_cuti` (`id_cuti`, `tahun`, `bulan`, `masa_kerja`, `limit_karyawan_cuti`, `jumlah_limit_per_divisi`, `remarks`, `tanggal`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$tahun."', '".$bulan."', '".$masa_kerja."', '".$limit_karyawan_cuti."', '".$jumlah_limit_per_divisi."', '".$remarks."', '".$tanggal."', NOW(), NOW(), '".$user_add."', '".$user_upd."', '0')";                                   
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."pegawai/master_cuti.php';
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

    $title	= 'Master Cuti';
    $submenu	= "master_cuti";
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