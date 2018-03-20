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
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaanbeli']) ? mysql_real_escape_string(trim($_POST['kode_permintaanbeli'])) : '';
    $kode_barang		= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang		= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $harga			= isset($_POST['harga']) ? str_replace(",", "", $_POST['harga']) : '';
    $remarks_barang		= isset($_POST['remarks_barang']) ? mysql_real_escape_string(trim($_POST['remarks_barang'])) : '';
    $return_url			= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_barang != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_permintaan_pembelian_detail` (`id_permintaan_pembelian_detail`, `kode_permintaan_pembelian`, `kode_barang`,
						    `nama_barang`, `qty`, `harga`, `remarks_barang`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_permintaan_pembelian."', '".$kode_barang."',
						    '".$nama_barang."', '".$qty."', '".$harga."', '".$remarks_barang."',
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
    
}elseif(isset($_POST["update"]))
{
    $id       			= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaanbeli']) ? mysql_real_escape_string(trim($_POST['kode_permintaanbeli'])) : '';
    $kode_barang		= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang		= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $harga			= isset($_POST['harga']) ? str_replace(",", "", $_POST['harga']) : '';
    $remarks_barang		= isset($_POST['remarks_barang']) ? mysql_real_escape_string(trim($_POST['remarks_barang'])) : '';
    $return_url			= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_permintaan_pembelian != "" AND $kode_barang != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_permintaan_pembelian_detail` SET `kode_permintaan_pembelian`='".$kode_permintaan_pembelian."',
    `kode_barang`='".$kode_barang."', `nama_barang`='".$nama_barang."', `qty`='".$qty."', `harga`='".$harga."', `remarks_barang`='".$remarks_barang."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `id_permintaan_pembelian_detail`='".$id."';";
    

    
    //echo $sql_update;
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
}elseif(isset($_POST["savelock"]))
{
    
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaanbeli']) ? mysql_real_escape_string(trim($_POST['kode_permintaanbeli'])) : '';
    $kode_barang		= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang		= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $harga			= isset($_POST['harga']) ? str_replace(",", "", $_POST['harga']) : '';
    $remarks_barang		= isset($_POST['remarks_barang']) ? mysql_real_escape_string(trim($_POST['remarks_barang'])) : '';
    $return_url			= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    $kode_divisi		= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi		= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $mu				= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $remarks_permintaan_pembelian = isset($_POST['remarks_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['remarks_permintaan_pembelian'])) : '';
    
    $sql_update_permintaan = "UPDATE `gx_permintaan_pembelian` SET `kode_divisi`='".$kode_divisi."',
    `nama_divisi`='".$nama_divisi."', `mu`='".$mu."', `keterangan`='".$keterangan."', `remarks_permintaan_pembelian`='".$remarks_permintaan_pembelian."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_permintaan_pembelian`='".$kode_permintaan_pembelian."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_permintaan, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_permintaan);
    
    if($kode_barang != "" && $nama_barang != ""){
    
   $sql_insert = "INSERT INTO `gx_permintaan_pembelian_detail` (`id_permintaan_pembelian_detail`, `kode_permintaan_pembelian`, `kode_barang`,
						    `nama_barang`, `qty`, `harga`, `remarks_barang`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_permintaan_pembelian."', '".$kode_barang."',
						    '".$nama_barang."', '".$qty."', '".$harga."', '".$remarks_barang."',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    //echo $sql_insert;
    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    $sql_update_lock = "UPDATE `gx_permintaan_pembelian` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_permintaan_pembelian`='".$kode_permintaan_pembelian."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_permintaan_pembelian';
	</script>";
}
$return_url = "";
if(isset($_GET["c"]))
{
    $kode_permintaan_pembelian		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_permintaan_pembelian 	= "SELECT * FROM `gx_permintaan_pembelian`
			    WHERE `kode_permintaan_pembelian` = '".$kode_permintaan_pembelian."'
			    LIMIT 0,1;";
    $sql_permintaan_pembelian	= mysql_query($query_permintaan_pembelian, $conn);
    $row_permintaan_pembelian	= mysql_fetch_array($sql_permintaan_pembelian);
   
    
    $return_url = 'form_permintaanbeli_detail.php?c='.$kode_permintaan_pembelian;
    
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Permintaan Pembelian</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					<form action="" role="form" name="form_permintaanbeli_item" id="form_permintaanbeli_item" method="post" enctype="multipart/form-data">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.$row_permintaan_pembelian["nama_cabang"].'" >
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.$row_permintaan_pembelian["tanggal"].'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_permintaan_pembelian" id="kode_permintaan_pembelian" value="'.$row_permintaan_pembelian["kode_permintaan_pembelian"].'">
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Login</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="nama_pegawai" id="nama_pegawai" value="'.$row_permintaan_pembelian["user_add"].'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control"  required="" name="kode_divisi" id="id_divisi" value="'.(isset($_GET['c']) ? $row_permintaan_pembelian["kode_divisi"] : '').'" >
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['c']) ? $row_permintaan_pembelian["nama_divisi"] : '').'" onclick="return valideopenerform(\'data_divisi.php?r=form_permintaanbeli_item\',\'divisi\');">
					    </div>

					    <div class="col-xs-2">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<select name="mu" class="form-control">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'" '.(($row_permintaan_pembelian['mu'] == $row_matauang['kode_matauang']) ? "select" : '').'>'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="keterangan" style="resize:none;">'.(isset($_GET['c']) ? $row_permintaan_pembelian["keterangan"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Remarks Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="remarks_permintaan_pembelian" style="resize:none;">'.(isset($_GET['c']) ? $row_permintaan_pembelian["remarks_permintaan_pembelian"] : "").'</textarea>
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
							      <th width="10%">
								  No.
							      </th>
							      <th width="17%">
								  Kode Barang
							      </th>
							      <th width="35%">
								  Nama Barang
							      </th>
							      <th  width="17%">
								    QTY
							      </th>
							      <th width="35%">
								  Harga
							      </th>
							      <th width="17%">
								  Total
							      </th>
							      <th width="17%">
								  Remarks
							      </th>
							      <th width="10%">
							      #
							      </th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_permintaanbeli	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_permintaanbeli_item	= "SELECT * FROM `gx_permintaan_pembelian_detail` WHERE `kode_permintaan_pembelian` ='".$kode_permintaanbeli."';";
    $sql_permintaanbeli_item	= mysql_query($query_permintaanbeli_item, $conn);
    $id_detail_permintaanbeli  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_permintaanbeli_detail = "SELECT * FROM `gx_permintaan_pembelian_detail` WHERE `kode_permintaan_pembelian` ='".$kode_permintaanbeli."' AND `id_permintaan_pembelian_detail` = '".$id_detail_permintaanbeli."' LIMIT 0,1;";
    $sql_permintaanbeli_detail   = mysql_query($query_permintaanbeli_detail, $conn);
    $row_permintaanbeli_detail = mysql_fetch_array($sql_permintaanbeli_detail);
    $no = 1;
    $total_price = 0;
    
    while($row_permintaanbeli_item = mysql_fetch_array($sql_permintaanbeli_item))
    {
    $total	= ($row_permintaanbeli_item["qty"] * $row_permintaanbeli_item["harga"]);
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_permintaanbeli_item["kode_barang"].'</td>
	<td>'.$row_permintaanbeli_item["nama_barang"].'</td>
	<td>'.$row_permintaanbeli_item["qty"].'</td>
	<td>'.number_format($row_permintaanbeli_item["harga"], 2, ',', '.').'</td>
	<td>'.number_format($total, 2, ',', '.').'</td>
	<td>'.$row_permintaanbeli_item["remarks_barang"].'</td>
	<td><a href="form_permintaanbeli_detail?c='.$row_permintaanbeli_item["kode_permintaan_pembelian"].'&id='.$row_permintaanbeli_item["id_permintaan_pembelian_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>';
	$no++;
	$total_price = $total_price + $total;
	
    }
}else{
    
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="4" align="right">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
								    '.number_format($total_price, 2, ',', '.').' IDR
							    </td>
							    <td>
								    &nbsp;
							    </td>
							    <td>
								    &nbsp;
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
                                    <h3 class="box-title">FORM PERMINTAAN PEMBELIAN ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_permintaanbeli_detail["id_permintaan_pembelian_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_permintaanbeli" value="'.(isset($_GET['c']) ? $kode_permintaanbeli : "").'" readonly="">
						
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
						<input type="text" readonly="" onclick="return valideopenerform(\'data_barang.php?r=form_permintaanbeli_item\',\'barang\');" class="form-control" required="" name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_permintaanbeli_detail["kode_barang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="nama_barang" id="nama_barang" value="'.(isset($_GET['id']) ? $row_permintaanbeli_detail["nama_barang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>QTY</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="qty" id="qty" value="'.(isset($_GET['id']) ? $row_permintaanbeli_detail["qty"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="harga" id="harga" value="'.(isset($_GET['id']) ? $row_permintaanbeli_detail["harga"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Remarks Barang</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="remarks_barang" style="resize:none;">'.(isset($_GET['id']) ? $row_permintaanbeli_detail["remarks_barang"] : "").'</textarea>
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_permintaanbeli_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_permintaanbeli_detail["user_upd"]." ".$row_permintaanbeli_detail["date_upd"] : "").'
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

    $title	= 'Form permintaan pembelian Item';
    $submenu	= "master_permintaanbeli";
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