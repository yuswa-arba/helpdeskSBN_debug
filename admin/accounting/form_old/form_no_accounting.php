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



 enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form No Accounting");
 
if(isset($_GET["id"]))
{
    $id_no_accounting		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_no_accounting		= "SELECT * FROM `gx_no_accounting` WHERE `id_no_accounting`='$id_no_accounting' LIMIT 0,1;";
    $sql_no_accounting		= mysql_query($query_no_accounting, $conn);
    $row_no_accounting		= mysql_fetch_array($sql_no_accounting);
	
}

    $content ='<section class="content-header">
                    <h1>
                        Form No Accounting
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form No Accounting</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" name="myForm" action="" enctype="multipart/form-data" >
                                    <div class="box-body">
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>No Accounting</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="no_accounting" name="no_accounting" required="" value="'.(isset($_GET['id']) ? $row_no_accounting["no_accounting"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Kategori</label>
											</div>
											<div class="col-xs-3">
												<select name="kategori" class="form-control">
													<option value="summary" '.(isset($_GET['id']) ? ($row_no_accounting['kategori'] == 'detail' ? "selected" : "" ) :"") .'>Summary</option>
													<option value="detail" '.(isset($_GET['id']) ? ($row_no_accounting['kategori'] == 'detail' ? "selected" : "" ) :"") .'>Detail</option>
												</select>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Nama</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="nama" name="nama" required="" value="'.(isset($_GET['id']) ? $row_no_accounting["nama"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Group</label>
											</div>
											<div class="col-xs-3">
												<select name="group" class="form-control">
													<option value="neraca" '.(isset($_GET['id']) ? ($row_no_accounting['group'] == 'neraca' ? "selected" : "" ) :"") .'>Neraca</option>
													<option value="laba rugi" '.(isset($_GET['id']) ? ($row_no_accounting['group'] == 'laba rugi' ? "selected" : "" ) :"") .'>Laba Rugi</option>
													<option value="perubahan modal"  '.(isset($_GET['id']) ? ($row_no_accounting['group'] == 'perubahan modal' ? "selected" : "" ) :"") .'>Perubahan Modal</option>
												</select>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Level</label>
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control"  name="level_accounting" value="'.(isset($_GET['id']) ? $row_no_accounting["level_accounting"] : "").'">
											</div>
											<div class="col-xs-3">
												<label>Jenis Transaksi</label>
											</div>
											<div class="col-xs-3">
												<select name="jenis_transaksi" class="form-control">
													<option value="kas" '.(isset($_GET['id']) ? ($row_no_accounting['jenis_transaksi'] == 'kas' ? "selected" : "" ) :"") .'>Kas</option>
													<option value="ayat silang" '.(isset($_GET['id']) ? ($row_no_accounting['jenis_transaksi'] == 'ayat silang' ? "selected" : "" ) :"") .'>Ayat Silang</option>
													<option value="uang muka"  '.(isset($_GET['id']) ? ($row_no_accounting['jenis_transaksi'] == 'uang muka' ? "selected" : "" ) :"") .'>Uang Muka</option>
												</select>
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Jenis</label>
											</div>
											<div class="col-xs-3">
												<select name="jenis" class="form-control">
													<option value="aktiva lancar" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'aktiva lancar' ? "selected" : "" ) :"") .'>Aktiva Lancar</option>
													<option value="aktiva tetap" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'aktiva tetap' ? "selected" : "" ) :"") .'>Aktiva Tetap</option>
													<option value="hutang janka pendek" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'hutang jangka pendek' ? "selected" : "" ) :"") .'>Hutang Jangka Pendek</option>
													<option value="hutang jangka panjang" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'hutang jangka panjang' ? "selected" : "" ) :"") .'>Hutang Jangka Panjang</option>
													<option value="modal" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'modal' ? "selected" : "" ) :"") .'>Modal</option>
													<option value="pendapatan" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'pendapatan' ? "selected" : "" ) :"") .'>Pendapatan</option>
													<option value="biaya" '.(isset($_GET['id']) ? ($row_no_accounting['jenis'] == 'biaya' ? "selected" : "" ) :"") .'>Biaya</option>
												</select>
											</div>
											<div class="col-xs-3">
												<label>Divisi</label>
											</div>
											<div  class="col-xs-3" >
												<select name="divisi" class="form-control">
													<option value="konsolidasi" '.(isset($_GET['id']) ? ($row_no_accounting['divisi'] == 'konsolidasi' ? "selected" : "" ) :"") .'>Konsolidasi</option>
													<option value="port" '.(isset($_GET['id']) ? ($row_no_accounting['divisi'] == 'port' ? "selected" : "" ) :"") .'>Port</option>
													<option value="holding" '.(isset($_GET['id']) ? ($row_no_accounting['divisi'] == 'holding' ? "selected" : "" ) :"") .'>Holding</option>
												</select>
											</div>
										</div>
										</div>
						
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Parent</label>
											</div>
											<div class="col-xs-3">
												<input class="form-control" name="parent" placeholder="" type="text" value="'.(isset($_GET['id']) ? $row_no_accounting['parent'] :"") .'">
											</div>
											<div class="col-xs-3">
												  <label>Update RAB</label>
											</div>
											<div class="col-xs-3">
												<table>
													<tr>
														<td>
															Yes
														</td>
														<td>
															<input class="form-control" name="update_rab" type="radio" value="yes" '.(isset($_GET['id']) ? ($row_no_accounting['update_rab'] == 'yes' ? "checked" : "" ) :"") .'>
														</td>
													</tr>
													<tr>
														<td>
															No
														</td>
														<td>
															<input class="form-control" name="update_rab" type="radio" value="no" '.(isset($_GET['id']) ? ($row_no_accounting['update_rab'] == 'no' ? "checked" : "" ) :"") .'>
														</td>
													</tr>
												</table>
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Created By</label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_no_accounting["user_add"] : $loggedin["username"]).'
											</div>
										</div>
										</div>
					
										<div class="form-group">
										<div class="row">
											<div class="col-xs-3">
												<label>Latest Update By </label>
											</div>
											<div class="col-xs-6">
												'.(isset($_GET['id']) ? $row_no_accounting["user_upd"]." ".$row_no_accounting["date_upd"] : "").'
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
    $no_accounting	   	= isset($_POST['no_accounting']) ? mysql_real_escape_string(trim($_POST['no_accounting'])) : '';
	$kategori    		= isset($_POST['kategori']) ? mysql_real_escape_string(trim($_POST['kategori'])) : '';
	$nama	    		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $group 				= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$level_accounting 	= isset($_POST['level_accounting']) ? mysql_real_escape_string(trim($_POST['level_accounting'])) : '';
	$jenis_transaksi 	= isset($_POST['jenis_transaksi']) ? mysql_real_escape_string(trim($_POST['jenis_transaksi'])) : '';
    $jenis    			= isset($_POST['jenis']) ? mysql_real_escape_string(trim($_POST['jenis'])) : '';
    $divisi	    		= isset($_POST['divisi']) ? mysql_real_escape_string(trim($_POST['divisi'])) : '';
	$parent	    		= isset($_POST['parent']) ? mysql_real_escape_string(trim($_POST['parent'])) : '';
    $update_rab			= isset($_POST['update_rab']) ? mysql_real_escape_string(trim($_POST['update_rab'])) : '';
	
	$sql_insert = "INSERT INTO `gx_no_accounting` (`id_no_accounting`, `no_accounting`, `kategori`,
						  `nama`, `group`, `level_accounting`, `jenis_transaksi`, `jenis`, `divisi`, `parent`, `update_rab`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$no_accounting."', '".$kategori."',
						  '".$nama."', '".$group."', '".$level_accounting."', '".$jenis_transaksi."', '".$jenis."', '".$divisi."', '".$parent."', '".$update_rab."',
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
			window.location.href='".URL_ADMIN."accounting/master_no_accounting.php';
			</script>";
			
    
}elseif(isset($_POST["update"]))
{
    //echo "update";
    $no_accounting	   	= isset($_POST['no_accounting']) ? mysql_real_escape_string(trim($_POST['no_accounting'])) : '';
	$kategori    		= isset($_POST['kategori']) ? mysql_real_escape_string(trim($_POST['kategori'])) : '';
	$nama	    		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $group 				= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
	$level_accounting 	= isset($_POST['level_accounting']) ? mysql_real_escape_string(trim($_POST['level_accounting'])) : '';
	$jenis_transaksi 	= isset($_POST['jenis_transaksi']) ? mysql_real_escape_string(trim($_POST['jenis_transaksi'])) : '';
    $jenis    			= isset($_POST['jenis']) ? mysql_real_escape_string(trim($_POST['jenis'])) : '';
    $divisi	    		= isset($_POST['divisi']) ? mysql_real_escape_string(trim($_POST['divisi'])) : '';
	$parent	    		= isset($_POST['parent']) ? mysql_real_escape_string(trim($_POST['parent'])) : '';
    $update_rab			= isset($_POST['update_rab']) ? mysql_real_escape_string(trim($_POST['update_rab'])) : '';
	
    $sql_update = "UPDATE `gx_no_accounting` SET `level` = '1',
		    `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
		    WHERE `id_no_accounting` = '$_GET[id]';";
    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!.');
							   window.history.go(-1);
						       </script>");
    
	$sql_insert_update	= "INSERT INTO `gx_no_accounting` (`id_no_accounting`, `no_accounting`, `kategori`,
						  `nama`, `group`, `level_accounting`, `jenis_transaksi`, `jenis`, `divisi`, `parent`, `update_rab`,
						  `user_add`, `user_upd`, `date_add`, `date_upd`,  `level`) 
					  VALUES ('', '".$no_accounting."', '".$kategori."',
						  '".$nama."', '".$group."', '".$level_accounting."', '".$jenis_transaksi."', '".$jenis."', '".$divisi."', '".$parent."', '".$update_rab."',
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
			window.location.href='".URL_ADMIN."accounting/master_no_accounting.php';
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

    $title	= 'Form No Accounting';
    $submenu	= "no_accounting";
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