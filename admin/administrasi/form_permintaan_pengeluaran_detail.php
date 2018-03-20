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
    $kode_permintaan_pengeluaran_barang	= isset($_POST['kode_permintaan_pengeluaran_barang']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pengeluaran_barang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
	$qty					= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_barang != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_permintaan_pengeluaran_barang_detail` (`id_permintaan_pengeluaran_barang_detail`, `kode_permintaan_pengeluaran`, `kode_barang`,
						    `nama_barang`, `serial_number`, `qty`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_permintaan_pengeluaran_barang."', '".$kode_barang."',
						    '".$nama_barang."', '".$serial_number."', '".$qty."',
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
    
}elseif(isset($_POST["update"])){
    $id       				= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
	$kode_permintaan_pengeluaran_barang	= isset($_POST['kode_permintaan_pengeluaran_barang']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pengeluaran_barang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
	$qty					= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_permintaan_pengeluaran_barang != "" AND $kode_barang != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_permintaan_pengeluaran_barang_detail` SET 
    `kode_barang`='".$kode_barang."', `nama_barang`='".$nama_barang."', `serial_number`='".$serial_number."', `qty`='".$qty."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `id_permintaan_pengeluaran_barang_detail`='".$id."';";
    

    
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
}elseif(isset($_POST["savelock"])){
    
   $kode_permintaan_pengeluaran_barang	= isset($_POST['kode_permintaan_pengeluaran_barang']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pengeluaran_barang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
	$qty					= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    $kode_divisi			= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi			= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    
    $sql_update_permintaanpengeluaran = "UPDATE `gx_permintaan_pengeluaran_barang` SET `kode_divisi`='".$kode_divisi."',
    `nama_divisi`='".$nama_divisi."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_permintaan_pengeluaran`='".$kode_permintaan_pengeluaran_barang."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_permintaanpengeluaran, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_permintaanpengeluaran);
    
    if($kode_barang != "" && $nama_barang != ""){
    
   $sql_insert = "INSERT INTO `gx_permintaan_pengeluaran_barang_detail` (`id_permintaan_pengeluaran_barang_detail`, `kode_permintaan_pengeluaran`, `kode_barang`,
						    `nama_barang`, `serial_number`, `qty`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_permintaan_pengeluaran_barang."', '".$kode_barang."',
						    '".$nama_barang."', '".$serial_number."', '".$qty."',
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
		alert('Data Telah Tersimpan!');
		window.history.go(-1);
	    </script>";
    }
    $sql_update_lock = "UPDATE `gx_permintaan_pengeluaran_barang` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_permintaan_pengeluaran`='".$kode_permintaan_pengeluaran_barang."';";
    
    //echo $sql_update_lock;
    echo mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_permintaan_pengeluaran_barang.php';
	</script>";
}
$return_url = "";
if(isset($_GET["c"]))
{
    $kode_permintaan_pengeluaran_barang		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_permintaan_pengeluaran_barang 	= "SELECT * FROM `gx_permintaan_pengeluaran_barang`
			    WHERE `kode_permintaan_pengeluaran` = '".$kode_permintaan_pengeluaran_barang."'
			    LIMIT 0,1;";
    $sql_permintaan_pengeluaran_barang	= mysql_query($query_permintaan_pengeluaran_barang, $conn);
    $row_permintaan_pengeluaran_barang	= mysql_fetch_array($sql_permintaan_pengeluaran_barang);
   
    
    $return_url = 'form_permintaan_pengeluaran_detail.php?c='.$kode_permintaan_pengeluaran_barang;
    
}


    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Permintaan Pengeluaran Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					<form action="" role="form" name="form_permintaanpengeluaran_item" id="form_permintaanpengeluaran_item" method="post" enctype="multipart/form-data">
					    
					    <div class="col-xs-2">
							<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.$row_permintaan_pengeluaran_barang["nama_cabang"].'">
							<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.$row_permintaan_pengeluaran_barang["kode_cabang"].'">
						
					    </div>
					    
					    <div class="col-xs-2">
							<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.$row_permintaan_pengeluaran_barang["tanggal"].'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>No permintaan Pengeluaran Barang</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" required="" name="kode_permintaan_pengeluaran" id="kode_permintaan_pengeluaran" value="'.$row_permintaan_pengeluaran_barang["kode_permintaan_pengeluaran"].'">
						
					    </div>

					    <div class="col-xs-2">
							<label>Nama Pemohon</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" readonly="" required="" name="nama_pemohon" id="nama_pemohon" value="'.$row_permintaan_pengeluaran_barang["nama_pemohon"].'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
							<input type="hidden" readonly="" class="form-control"  required="" name="kode_divisi" id="kode_divisi" value="'.$row_permintaan_pengeluaran_barang["kode_divisi"].'" >
							<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.$row_permintaan_pengeluaran_barang["nama_divisi"].'" >
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
								  Serial Number
							      </th>
							      <th width="35%">
								  Quantity
							      </th>
							      <th width="10%">
							      #
							      </th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_permintaanpengeluaran	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_permitnaanpengeluaran_item	= "SELECT * FROM `gx_permintaan_pengeluaran_barang_detail` WHERE `kode_permintaan_pengeluaran` ='".$kode_permintaanpengeluaran."';";
    $sql_permintaanpengeluaran_item	= mysql_query($query_permitnaanpengeluaran_item, $conn);
    $id_detail_permintaanpengeluaran  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_permintaanpengeluaran_detail = "SELECT * FROM `gx_permintaan_pengeluaran_barang_detail` WHERE `kode_permintaan_pengeluaran` ='".$kode_permintaanpengeluaran."' AND `id_permintaan_pengeluaran_barang_detail` = '".$id_detail_permintaanpengeluaran."' LIMIT 0,1;";
    //echo $query_permitnaanpengeluaran_item;
	$sql_permintaanpengeluaran_detail   = mysql_query($query_permintaanpengeluaran_detail, $conn);
    $row_permintaanpengeluaran_detail = mysql_fetch_array($sql_permintaanpengeluaran_detail);
    $no = 1;
    $total_qty = 0;
    
    while($row_permintaanpengeluaran_item = mysql_fetch_array($sql_permintaanpengeluaran_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_permintaanpengeluaran_item["kode_barang"].'</td>
	<td>'.$row_permintaanpengeluaran_item["nama_barang"].'</td>
	<td>'.$row_permintaanpengeluaran_item["serial_number"].'</td>
	<td>'.$row_permintaanpengeluaran_item["qty"].'</td>
	<td><a href="form_permintaan_pengeluaran_detail?c='.$row_permintaanpengeluaran_item["kode_permintaan_pengeluaran"].'&id='.$row_permintaanpengeluaran_item["id_permintaan_pengeluaran_barang_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>';
	$no++;
	$total_qty = $total_qty + $row_permintaanpengeluaran_item["qty"];
	
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
								    '.$total_qty.'
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
                                    <h3 class="box-title">FORM PERMINTAAN PENGELUARAN ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["id_permintaan_pengeluaran_barang_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_permintaan_pengeluaran_barang" value="'.(isset($_GET['c']) ? $kode_permintaanpengeluaran : "").'" readonly="">
						
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
							<input type="text" class="form-control" readonly=""  name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["kode_barang"] : "").'"  onclick="return valideopenerform(\'data_barang.php?r=form_permintaanpengeluaran_item\',\'barang\');">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text"  class="form-control" readonly="" name="nama_barang" id="nama_barang" value="'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["nama_barang"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Serial Number</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="serial_number" id="serial_number" value="'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["serial_number"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Quantity</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="qty" id="qty" value="'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["qty"] : "").'">
					    </div>
                    </div>
					</div>
                     
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_permintaanpengeluaran_detail["user_upd"]." ".$row_permintaanpengeluaran_detail["date_upd"] : "").'
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

    $title	= 'Form Permintaan Pengeluaran Item';
    $submenu	= "Permintaan_pengeluaran_barang";
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