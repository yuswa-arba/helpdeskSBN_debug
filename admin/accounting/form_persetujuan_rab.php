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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Persetujuan Rencana Anggaran Belanja");
 
if(isset($_GET["id"]))
{
    $id_data		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data		= "SELECT * FROM `gx_rab_persetujuan` WHERE `id_rab_persetujuan`='$id_data' LIMIT 0,1;";
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
                                    <h3 class="box-title">Form Persetujuan Rencana Anggaran Belanja</h3>
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
                                                <input type="text" readonly="" class="form-control" id="nama_cabang" name="nama_cabang" required="" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'"  onclick="return valideopenerform(\'data_cabang.php?r=myForm&f=persetujuanrab\',\'cabang\');">
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
												<label>No Persetujuan RAB</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_rab_persetujuan" name="kode_rab_persetujuan" required="" value="'.(isset($_GET['id']) ? $row_data["kode_rab_persetujuan"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>No Control RAB</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="kode_rab_control" name="kode_rab_control" required="" value="'.(isset($_GET['id']) ? $row_data["kode_rab_control"] : "").'" onclick="return valideopenerform(\'data_control_rab.php?r=myForm&f=persetujuanrab\',\'cabang\');">
											</div>
										</div>
										</div>
	
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>keterangan</label>
											</div>
											<div class="col-xs-3">
												<textarea name="keterangan" readonly="" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['id']) ? $row_data['keterangan'] :"").'</textarea>
											</div>
											<div class="col-xs-3">
												<label>Periode</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="periode" name="periode" required="" value="'.(isset($_GET['id']) ? $row_data["periode"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Probability Index</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="probability_index" name="probability_index" required="" value="'.(isset($_GET['id']) ? $row_data["probability_index"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Target User Baru</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" readonly="" class="form-control" id="target_user_baru" name="target_user_baru" required="" value="'.(isset($_GET['id']) ? $row_data["target_user_baru"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Pembuat RAB</label>
											</div>
											<div class="col-xs-3">
												<input type="text" readonly="" class="form-control" id="pembuat_rab" name="pembuat_rab" required="" value="'.(isset($_GET['id']) ? $row_data["pembuat_rab"] :  "").'">
											</div>
											<div class="col-xs-3">
												<label>Pemeriksa RAB</label>
											</div>
											<div  class="col-xs-3" >
												<input type="text" readonly="" class="form-control" id="pemeriksa_rab" name="pemeriksa_rab" required="" value="'.(isset($_GET['id']) ? $row_data["pemeriksa_rab"] : $loggedin["username"]).'">
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
    $kode_rab_persetujuan	= isset($_POST['kode_rab_persetujuan']) ? mysql_real_escape_string(trim($_POST['kode_rab_persetujuan'])) : '';
    $kode_rab_control	= isset($_POST['kode_rab_control']) ? mysql_real_escape_string(trim($_POST['kode_rab_control'])) : '';
    $periode		 	= isset($_POST['periode']) ? mysql_real_escape_string(trim($_POST['periode'])) : '';
	$keterangan		 	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $probability_index	= isset($_POST['probability_index']) ? mysql_real_escape_string(trim($_POST['probability_index'])) : '';
    $target_user_baru	= isset($_POST['target_user_baru']) ? mysql_real_escape_string(trim($_POST['target_user_baru'])) : '';
	$pembuat_rab		= isset($_POST['pembuat_rab']) ? mysql_real_escape_string(trim($_POST['pembuat_rab'])) : '';
	$pemeriksa_rab		= isset($_POST['pemeriksa_rab']) ? mysql_real_escape_string(trim($_POST['pemeriksa_rab'])) : '';
	if($nama_cabang != "" && $kode_rab_persetujuan != "" && $kode_rab_control != ""){
	$sql_insert = "INSERT INTO `gx_rab_persetujuan` (`id_rab_persetujuan`, `kode_cabang`, `nama_cabang`,
						  `tanggal`, `kode_rab_persetujuan`, `kode_rab_control`, `periode`, `keterangan`, `probability_index`,
						  `target_user_baru`, `pembuat_rab`, `pemeriksa_rab`, `status`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_cabang."', '".$nama_cabang."',
						  '".$tanggal."', '".$kode_rab_persetujuan."', '".$kode_rab_control."', '".$periode."', '".$keterangan."', '".$probability_index."',
						  '".$target_user_baru."', '".$pembuat_rab."', '".$pemeriksa_rab."', '0',
						  '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";                    
    
    //echo $sql_insert;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
	$query_data_detail = "SELECT * FROM `gx_rab_control_detail` WHERE `kode_rab_control` ='".$kode_rab_control."' ;";
    $sql_data_detail	= mysql_query($query_data_detail, $conn);
    
    
    while($row_data_detail	= mysql_fetch_array($sql_data_detail)){
   
    $sql_insert_detail = "INSERT INTO `gx_rab_persetujuan_detail` (`id_rab_persetujuan_detail`, `kode_rab_persetujuan`, `no_perkiraan`,
						    `nama_account`, `pendapatan_sebelumnya`, `biaya_sebelumnya`, `pendapatan_sekarang`, `biaya_sekarang`, `remarks`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_rab_persetujuan."', '".$row_data_detail["no_perkiraan"]."',
						    '".$row_data_detail["nama_account"]."', '".$row_data_detail["pendapatan_sebelumnya"]."', '".$row_data_detail["biaya_sebelumnya"]."', '".$row_data_detail["pendapatan_sekarang"]."', '".$row_data_detail["biaya_sekarang"]."', '".$row_data_detail["remarks"]."',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '".$row_data_detail["level"]."');";
    
    //echo $sql_insert_detail."<br>".$deviasi."<br>";
      echo mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    }
	
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."accounting/form_persetujuan_rab_detail.php?c=$kode_rab_persetujuan';
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
    $kode_rab_persetujuan	= isset($_POST['kode_rab_persetujuan']) ? mysql_real_escape_string(trim($_POST['kode_rab_persetujuan'])) : '';
    $kode_rab_control	= isset($_POST['kode_rab_control']) ? mysql_real_escape_string(trim($_POST['kode_rab_control'])) : '';
    $periode		 	= isset($_POST['periode']) ? mysql_real_escape_string(trim($_POST['periode'])) : '';
	$keterangan		 	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $probability_index	= isset($_POST['probability_index']) ? mysql_real_escape_string(trim($_POST['probability_index'])) : '';
    $target_user_baru	= isset($_POST['target_user_baru']) ? mysql_real_escape_string(trim($_POST['target_user_baru'])) : '';
	$pembuat_rab		= isset($_POST['pembuat_rab']) ? mysql_real_escape_string(trim($_POST['pembuat_rab'])) : '';
	$pemeriksa_rab		= isset($_POST['pemeriksa_rab']) ? mysql_real_escape_string(trim($_POST['pemeriksa_rab'])) : '';
	
    $sql_update = "UPDATE `gx_rab_persetujuan` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_rab_persetujuan` = '$_GET[id]';";
    

	
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	=  "INSERT INTO `gx_rab_persetujuan_detail` (`id_rab_persetujuan_detail`, `kode_rab_persetujuan`, `no_perkiraan`,
						    `nama_account`, `pendapatan_sebelumnya`, `biaya_sebelumnya`, `pendapatan_sekarang`, `biaya_sekarang`, `remarks`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_rab_persetujuan."', '".$row_data_detail["no_perkiraan"]."',
						    '".$row_data_detail["nama_account"]."', '".$row_data_detail["pendapatan"]."', '".$row_data_detail["biaya"]."', '', '', '".$row_data_detail["remarks"]."',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '".$row_data_detail["level"]."');";
    
    
    //echo $sql_insert;
    mysql_query($sql_insert_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
	
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
			alert('Data telah disimpan');
			window.location.href='".URL_ADMIN."accounting/master_persetujuan_rab.php';
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

    $title	= 'Form Persetujuan RAB';
    $submenu	= "persetujuan_rab";
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