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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Rencana Anggaran Belanja");
 
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET['c']) ? $_GET['c'] : '';
    $query_data		= "SELECT * FROM `gx_rab` WHERE `kode_rab`='$kode_data' LIMIT 0,1;";
	//echo $query_data;
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
	
	$return_url = 'form_rab_detail.php?c='.$row_data["kode_rab"];
	
}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-11">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Rencana Anggaran Belanja</h3>
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
												<label>Tanggal</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="tanggal" name="tanggal" required="" value="'.(isset($_GET['c']) ? $row_data["tanggal"] : date("Y-m-d")).'">
											</div>
											<div class="col-xs-2">
												<label>Total Biaya</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="total_biaya" name="total_biaya" value="'.(isset($_GET['c']) ? $row_data["total_biaya"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>No RAB</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="no_rab" name="no_rab" required="" value="'.(isset($_GET['c']) ? $row_data["kode_rab"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Periode</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="periode" name="periode" required="" value="'.(isset($_GET['c']) ? $row_data["periode"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Biaya Operasional</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="biaya_operasional" name="biaya_operasional" value="'.(isset($_GET['c']) ? $row_data["biaya_operasional"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>keterangan</label>
											</div>
											<div class="col-xs-6">
												<textarea name="keterangan" readonly="" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['c']) ? $row_data['keterangan'] :"").'</textarea>
											</div>
											<div class="col-xs-2">
												<label>Pembelian</label>
											</div>
											<div class="col-xs-2">
												<input type="text" class="form-control" id="pembelian" name="pembelian" value="'.(isset($_GET['c']) ? $row_data["pembelian"] : "").'">
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												<label>Probability Index</label>
											</div>
											<div class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="probability_index" name="probability_index" required="" value="'.(isset($_GET['c']) ? $row_data["probability_index"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Target User Baru</label>
											</div>
											<div  class="col-xs-2">
												<input type="text" readonly="" class="form-control" id="target_user_baru" name="target_user_baru" required="" value="'.(isset($_GET['c']) ? $row_data["target_user_baru"] : "").'">
											</div>
											<div class="col-xs-2">
												<label>Total Pendapatan</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="total_pendapatan" name="total_pendapatan" value="'.(isset($_GET['c']) ? $row_data["total_pendapatan"] : "").'">
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-2">
												
											</div>
											<div class="col-xs-2">
												
											</div>
											<div class="col-xs-2">
												 
											</div>
											<div class="col-xs-2">
												
											</div>
											<div class="col-xs-2">
												<label>Laba Rugi</label>
											</div>
											<div  class="col-xs-2" >
												<input type="text" class="form-control" id="laba_rugi" name="laba_rugi" value="'.(isset($_GET['c']) ? $row_data["laba_rugi"] : "").'">
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
								  No. Perkiraan
							      </th>
							      <th width="20%">
								  Nama Account
							      </th>
							      <th width="20%">
								  Pendapatan
							      </th>
							      <th  width="20%">
								  Biaya
							      </th>
							      <th width="35%">
								  Remarks
							      </th>
								  <th width="10%">
							      #
							      </th>
							     
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_rab					 = isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_rab_item	 = "SELECT * FROM `gx_rab_detail` WHERE `kode_rab` ='".$kode_rab."' AND `level` = '0';";
    $sql_rab_item	 = mysql_query($query_rab_item, $conn);
    $id_detail_rab 	 = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_rab_detail = "SELECT * FROM `gx_rab_detail` WHERE `kode_rab` ='".$kode_rab."' AND `level` = '0' AND `id_rab_detail` = '".$id_detail_rab."' LIMIT 0,1;";
    //echo $query_rab_item;
	$sql_rab_detail   = mysql_query($query_rab_detail, $conn);
    $row_rab_detail 	 = mysql_fetch_array($sql_rab_detail);
    $no = 1;
    $total_biaya = 0;
    
    while($row_rab_item = mysql_fetch_array($sql_rab_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_rab_item["no_perkiraan"].'</td>
	<td>'.$row_rab_item["nama_account"].'</td>
	<td>'.$row_rab_item["pendapatan"].'</td>
	<td>'.$row_rab_item["biaya"].'</td>
	<td>'.$row_rab_item["remarks"].'</td>
	<td><a href="form_rab_detail?c='.$row_rab_item["kode_rab"].'&id='.$row_rab_item["id_rab_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>
	<tr><td></td></tr>';
	$no++;
	$total_biaya = $total_biaya + $row_rab_item["biaya"];
	
    }
}else{
	
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}

$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="3" align="right">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
								    '.$total_biaya.'
							    </td>
							   
							   
						    </tr>
					     
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
                                    <h3 class="box-title">FORM Detail RAB</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_rab_detail["id_rab_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_rab" value="'.(isset($_GET['c']) ? $kode_rab : "").'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>No Perkiraan</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="no_perkiraan" id="no_perkiraan" value="'.(isset($_GET['id']) ? $row_rab_detail["no_perkiraan"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Nama Account</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text"  class="form-control" name="nama_account" id="nama_account" value="'.(isset($_GET['id']) ? $row_rab_detail["nama_account"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Pendapatan</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="pendapatan" id="pendapatan" value="'.(isset($_GET['id']) ? $row_rab_detail["pendapatan"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Biaya</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="biaya" id="biaya" value="'.(isset($_GET['id']) ? $row_rab_detail["biaya"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Remarks</label>
					    </div>
					    <div class="col-xs-8">
							<textarea name="remarks"" class="form-control" placeholder="Keterangan" style="resize: none;">'.(isset($_GET['id']) ? $row_rab_detail['remarks'] :"").'</textarea>
					    </div>
                    </div>
					</div>
                     
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_rab_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_rab_detail["user_upd"]." ".$row_rab_detail["date_upd"] : "").'
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
	
	$kode_rab		= isset($_POST['kode_rab']) ? mysql_real_escape_string(trim($_POST['kode_rab'])) : '';
    $no_perkiraan	= isset($_POST['no_perkiraan']) ? mysql_real_escape_string(trim($_POST['no_perkiraan'])) : '';
	$nama_account   = isset($_POST['nama_account']) ? mysql_real_escape_string(trim($_POST['nama_account'])) : '';
	$pendapatan	    = isset($_POST['pendapatan']) ? mysql_real_escape_string(trim($_POST['pendapatan'])) : '';
    $biaya 			= isset($_POST['biaya']) ? mysql_real_escape_string(trim($_POST['biaya'])) : '';
	$remarks 		= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	if($kode_rab != "" && $no_perkiraan != "" && $nama_account != ""){
	$sql_insert = "INSERT INTO `gx_rab_detail` (`id_rab_detail`, `kode_rab`, `no_perkiraan`,
						  `nama_account`, `pendapatan`, `biaya`, `remarks`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_rab."', '".$no_perkiraan."',
						  '".$nama_account."', '".$pendapatan."', '".$biaya."', '".$remarks."',
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
			window.location.href='".URL_ADMIN."accounting/form_rab_detail.php?c=$kode_rab';
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
    $kode_rab		= isset($_POST['kode_rab']) ? mysql_real_escape_string(trim($_POST['kode_rab'])) : '';
    $no_perkiraan	= isset($_POST['no_perkiraan']) ? mysql_real_escape_string(trim($_POST['no_perkiraan'])) : '';
	$nama_account   = isset($_POST['nama_account']) ? mysql_real_escape_string(trim($_POST['nama_account'])) : '';
	$pendapatan	    = isset($_POST['pendapatan']) ? mysql_real_escape_string(trim($_POST['pendapatan'])) : '';
    $biaya 			= isset($_POST['biaya']) ? mysql_real_escape_string(trim($_POST['biaya'])) : '';
	$remarks 		= isset($_POST['remarks']) ? mysql_real_escape_string(trim($_POST['remarks'])) : '';
	
    $sql_update = "UPDATE `gx_rab_detail` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_rab_detail` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_rab_detail` (`id_rab_detail`, `kode_rab`, `no_perkiraan`,
						  `nama_account`, `pendapatan`, `biaya`, `remarks`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$kode_rab."', '".$no_perkiraan."',
						  '".$nama_account."', '".$pendapatan."', '".$biaya."', '".$remarks."',
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
			window.location.href='".URL_ADMIN."accounting/form_rab_detail.php?c=$kode_rab';
			</script>";
			
}elseif(isset($_POST["savelock"]))
{
    
    $total_biaya		= isset($_POST['total_biaya']) ? mysql_real_escape_string(trim($_POST['total_biaya'])) : '';
    $biaya_operasional	= isset($_POST['biaya_operasional']) ? str_replace(",", "", $_POST['biaya_operasional']) : '';
	$pembelian			= isset($_POST['pembelian']) ? mysql_real_escape_string(trim($_POST['pembelian'])) : '';
    $total_pendapatan	= isset($_POST['total_pendapatan']) ? mysql_real_escape_string(trim($_POST['total_pendapatan'])) : '';
    $laba_rugi			= isset($_POST['laba_rugi']) ? mysql_real_escape_string(trim($_POST['laba_rugi'])) : '';
   
    
    $sql_update_lock = "UPDATE `gx_rab` SET `status`='1', `total_biaya`='".$total_biaya."', `biaya_operasional`='".$biaya_operasional."', `pembelian`='".$pembelian."', `total_pendapatan`='".$total_pendapatan."', `laba_rugi`='".$laba_rugi."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_rab`='".$_GET["c"]."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_rab';
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

    $title	= 'Form RAB Detail';
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