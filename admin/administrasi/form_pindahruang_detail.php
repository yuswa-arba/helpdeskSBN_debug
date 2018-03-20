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
    
if(isset($_POST["save"]))
{
    /*$kode_periksa_pembelian	= isset($_POST['kode_periksabeli']) ? mysql_real_escape_string(trim($_POST['kode_periksabeli'])) : '';
    $kode_barang		= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang		= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $harga			= isset($_POST['harga']) ? str_replace(",", "", $_POST['harga']) : '';
    $remarks_barang		= isset($_POST['remarks_barang']) ? mysql_real_escape_string(trim($_POST['remarks_barang'])) : '';
    $return_url			= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    $stock			= isset($_POST['stock']) ? mysql_real_escape_string(trim($_POST['stock'])) : '';
    $reorder			= isset($_POST['reorder']) ? mysql_real_escape_string(trim($_POST['reorder'])) : '';
    $minim_stock		= isset($_POST['minim_stock']) ? mysql_real_escape_string(trim($_POST['minim_stock'])) : '';
    $deviasi			= isset($_POST['deviasi']) ? mysql_real_escape_string(trim($_POST['deviasi'])) : '';
    $harga_beli_terakhir	= isset($_POST['harga_beli_terakhir']) ? str_replace(",", "", $_POST['harga_beli_terakhir']) : '';
    
    if($kode_barang != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_periksa_pembelian_detail` (`id_periksa_pembelian_detail`, `kode_periksa_pembelian`, `kode_barang`,
						    `nama_barang`, `qty`, `harga`, `remarks_barang`, `stock`, `reorder`, `minim_stock`, `deviasi`, `harga_beli_terakhir`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_periksa_pembelian."', '".$kode_barang."',
						    '".$nama_barang."', '".$qty."', '".$harga."', '".$remarks_barang."','".$stock."', '".$reorder."', '".$minim_stock."', '".$deviasi."', '".$harga_beli_terakhir."',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."administrasi/".$return_url."';
	</script>";
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    */
}elseif(isset($_POST["update"]))
{
    /*$id       			= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_periksa_pembelian	= isset($_POST['kode_periksabeli']) ? mysql_real_escape_string(trim($_POST['kode_periksabeli'])) : '';
    $kode_barang		= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang		= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $harga			= isset($_POST['harga']) ? str_replace(",", "", $_POST['harga']) : '';
    $remarks_barang		= isset($_POST['remarks_barang']) ? mysql_real_escape_string(trim($_POST['remarks_barang'])) : '';
    $return_url			= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    $stock			= isset($_POST['stock']) ? mysql_real_escape_string(trim($_POST['stock'])) : '';
    $reorder			= isset($_POST['reorder']) ? mysql_real_escape_string(trim($_POST['reorder'])) : '';
    $minim_stock		= isset($_POST['minim_stock']) ? mysql_real_escape_string(trim($_POST['minim_stock'])) : '';
    $deviasi			= isset($_POST['deviasi']) ? mysql_real_escape_string(trim($_POST['deviasi'])) : '';
    $harga_beli_terakhir	= isset($_POST['harga_beli_terakhir']) ? str_replace(",", "", $_POST['harga_beli_terakhir']) : '';
    
    if($id != ""  AND $kode_barang != ""){
    
    
    $sql_update = "UPDATE `gx_periksa_pembelian_detail` SET `kode_periksa_pembelian`='".$kode_periksa_pembelian."',
    `kode_barang`='".$kode_barang."', `nama_barang`='".$nama_barang."', `qty`='".$qty."', `harga`='".$harga."', `remarks_barang`='".$remarks_barang."',
    `stock` = '".$stock."', `reorder` = '".$reorder."', `minim_stock` = '".$minim_stock."', `deviasi` = '".$deviasi."', `harga_beli_terakhir` = '".$harga_beli_terakhir."', 
    `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `id_periksa_pembelian_detail`='".$id."';";
    

    
    echo $sql_update;
    echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".$return_url."';
	</script>";
	
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    */
}

$return_url = "";
if(isset($_GET["c"]))
{
    $kode	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query	= "SELECT * FROM `gx_pindahruang` WHERE `kode_pindah` = '".$kode."' LIMIT 0,1;";
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);
   
    
    $return_url = 'form_pindahruang_detail.php?c='.$kode;
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Pindah Ruang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  name="nama_cabang" id="nama_cabang" value="'.(isset($_GET["c"]) ? $row['nama_cabang'] :"").'"
						 onclick="return valideopenerform(\'data_cabang.php?r=form_pindahruang_item&f=pindah_ruang\',\'pindah\');" placeholder="Search Cabang">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" id="id_cabang" value="'.(isset($_GET["c"]) ? $row['kode_cabang'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" name="tanggal" value="'.(isset($_GET["c"]) ? $row['tanggal'] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Pindah Ruang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly class="form-control" id="kode_pindah" name="kode_pindah" value="'.(isset($_GET["c"]) ? $row['kode_pindah'] :"").'">
						<input type="hidden" name="id_pindah" value="'.(isset($_GET["c"]) ? $row['id_pindah'] :"").'">
						
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    <div class="col-xs-3">
						<label>Ruang Awal</label>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="kode_ruang_awal" name="kode_ruang_awal"
						onclick="return valideopenerform(\'data_ruang.php?r=form_pindah&f=ruangawal\',\'ruang\');" placeholder="Search Ruang"
						value="'.(isset($_GET["c"]) ? $row['kode_ruang_awal'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<label>Nama Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="nama_ruang_awal" name="nama_ruang_awal"
						value="'.(isset($_GET["c"]) ? $row['nama_ruang_awal'] :"").'" placeholder="Nama Ruang">
					    </div>
					    
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">    
					    <div class="col-xs-3">
						<label>Pindah Ke Ruang</label>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="kode_ruang_baru" name="kode_ruang_akhir"
						onclick="return valideopenerform(\'data_ruang.php?r=form_pindah&f=ruangakhir\',\'ruang\');"
						value="'.(isset($_GET["c"]) ? $row['kode_ruang_baru'] :"").'" placeholder="Search Ruang">
					    </div>
					    <div class="col-xs-3">
						<label>Nama Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  readonly="" class="form-control" id="nama_ruang_baru" placeholder="Nama Ruang"
						name="nama_ruang_akhir" value="'.(isset($_GET["c"]) ? $row['nama_ruang_baru'] :"").'">
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
							      <th width="10%">No.</th>
							      <th width="17%">Kode Barang</th>
							      <th width="35%">Nama Barang</th>
							      <th  width="17%">Serial Number</th>
							      <th width="35%">Lemari</th>
							      <th width="10%">#</th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_item	= "SELECT * FROM `gx_pindahruang_detail` WHERE `kode_pindah` ='".$kode."';";
    $sql_item	= mysql_query($query_item, $conn);
    $id_item  	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail 	= "SELECT * FROM `gx_pindahruang_detail` WHERE `kode_pindah` ='".$kode."' AND `id_pindah_detail` = '".$id_item."' LIMIT 0,1;";
    $sql_detail   	= mysql_query($query_detail, $conn);
    $row_detail 	= mysql_fetch_array($sql_detail);
    $no = 1;
    
    while($row_item = mysql_fetch_array($sql_item))
    {
		$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_item["kode_barang"].'</td>
		<td>'.$row_item["nama_barang"].'</td>
		<td>'.$row_item["sn"].'</td>
		<td>'.$row_item["lemari"].'</td>
		<td><a href="form_pindahruang_detail?c='.$row_item["kode_pindah"].'&id='.$row_item["id_pindah_detail"].'"><span class="label label-info">Edit</span></a></td>
		</tr>';
		$no++;	
    }
}else{
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
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
                                    <h3 class="box-title">FORM BARANG</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_item" id="form_item" method="post" enctype="multipart/form-data">
	                                <div class="box-body">
                                        
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_detail["id_pindah_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_pindah" value="'.(isset($_GET['c']) ? $kode : "").'" readonly="">
						
						<input type="hidden" name="return_url" value="'.$return_url.'" readonly="">
						
					    </div>
					   
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" onclick="return valideopenerform(\'data_barang.php?r=form_item\',\'barang\');"
						class="form-control" required="" name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_detail["kode_barang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="nama_barang" id="nama_barang" value="'.(isset($_GET['id']) ? $row_detail["nama_barang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Serial Number</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="sn" id="sn" value="'.(isset($_GET['id']) ? $row_detail["sn"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lemari</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="kode_lemari" id="kode_lemari" value=""
						onclick="return valideopenerform(\'data_lemari.php?r=form_item\',\'lemari\');">
						<input type="hidden" class="form-control" required="" name="lemari" value="'.(isset($_GET['id']) ? $row_detail["lemari"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_detail["user_upd"]." ".$row_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submitlock" name="savelock" class="btn btn-primary">Save & Lock</button> <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: "",
		thousandsSeparator: ",",
		centsLimit: 0
	    });
        </script>
';

    $title	= 'Form periksa pembelian Item';
    $submenu	= "master_periksabeli";
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