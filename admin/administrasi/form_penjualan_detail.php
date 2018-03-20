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
    $kode_penjualan_barang	= isset($_POST['kode_penjualanbarang']) ? mysql_real_escape_string(trim($_POST['kode_penjualanbarang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
	$lemari					= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
	$qty					= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $price					= isset($_POST['price']) ? str_replace(",", "", $_POST['price']) : '';
    $amount					= isset($_POST['amount']) ? mysql_real_escape_string(trim($_POST['amount'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_barang != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_penjualan_barang_detail` (`id_penjualan_barang_detail`, `kode_penjualan`, `kode_barang`,
						    `nama_barang`, `serial_number`, `qty`, `price`, `amount`, `lemari`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_penjualan_barang."', '".$kode_barang."',
						    '".$nama_barang."', '".$serial_number."', '".$qty."', '".$price."', '".$amount."', '".$lemari."',
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
	$kode_penjualan_barang	= isset($_POST['kode_penjualanbarang']) ? mysql_real_escape_string(trim($_POST['kode_penjualanbarang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
	$lemari					= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
	$qty					= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $price					= isset($_POST['price']) ? str_replace(",", "", $_POST['price']) : '';
    $amount					= isset($_POST['amount']) ? mysql_real_escape_string(trim($_POST['amount'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_penjualan_barang != "" AND $kode_barang != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_penjualan_barang_detail` SET `kode_penjualan`='".$kode_penjualan_barang."',
    `kode_barang`='".$kode_barang."', `nama_barang`='".$nama_barang."', `serial_number`='".$serial_number."', `qty`='".$qty."', `price`='".$price."', `amount`='".$amount."', `lemari`='".$lemari."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `id_penjualan_barang_detail`='".$id."';";
    

    
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
    
    $kode_penjualan_barang	= isset($_POST['kode_penjualanbarang']) ? mysql_real_escape_string(trim($_POST['kode_penjualanbarang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
	$lemari					= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
	$qty					= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $price					= isset($_POST['price']) ? str_replace(",", "", $_POST['price']) : '';
    $amount					= isset($_POST['amount']) ? mysql_real_escape_string(trim($_POST['amount'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
	
    $sisa					= isset($_POST['sisa']) ? mysql_real_escape_string(trim($_POST['sisa'])) : '';
    $uang_muka				= isset($_POST['uang_muka']) ? mysql_real_escape_string(trim($_POST['uang_muka'])) : '';
    $total					= isset($_POST['total']) ? mysql_real_escape_string(trim($_POST['total'])) : '';
    $ppn					= isset($_POST['ppn']) ? mysql_real_escape_string(trim($_POST['ppn'])) : '';
    $grand_total 			= isset($_POST['grand_total']) ? mysql_real_escape_string(trim($_POST['grand_total'])) : '';
    
    $sql_update_penjualan = "UPDATE `gx_penjualan_barang` SET `grand_total`='".$grand_total."',
    `ppn`='".$ppn."', `total`='".$total."', `uang_muka`='".$uang_muka."', `sisa`='".$sisa."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_penjualan`='".$kode_penjualan_barang."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_penjualan, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_penjualan);
    
    if($kode_barang != "" && $nama_barang != ""){
    
   $sql_insert = "INSERT INTO `gx_penjualan_barang_detail` (`id_penjualan_barang_detail`, `kode_penjualan`, `kode_barang`,
						    `nama_barang`, `serial_number`, `qty`, `price`, `amount`, `lemari`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_penjualan_barang."', '".$kode_barang."',
						    '".$nama_barang."', '".$serial_number."', '".$qty."', '".$price."', '".$amount."', '".$lemari."',
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
    $sql_update_lock = "UPDATE `gx_penjualan_barang` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `kode_penjualan`='".$kode_penjualan_barang."';";
    
    //echo $sql_update;
    echo mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_penjualan';
	</script>";
}
$return_url = "";
if(isset($_GET["c"]))
{
    $kode_penjualan_barang		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_penjualan_barang 	= "SELECT * FROM `gx_penjualan_barang`
			    WHERE `kode_penjualan` = '".$kode_penjualan_barang."'
			    LIMIT 0,1;";
    $sql_penjualan_barang	= mysql_query($query_penjualan_barang, $conn);
    $row_penjualan_barang	= mysql_fetch_array($sql_penjualan_barang);
   
    
    $return_url = 'form_penjualan_detail.php?c='.$kode_penjualan_barang;
    
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Penjualan Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					<form action="" role="form" name="form_permintaanbeli_item" id="form_permintaanbeli_item" method="post" enctype="multipart/form-data">
					    
					    <div class="col-xs-2">
							<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.$row_penjualan_barang["nama_cabang"].'">
							<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.$row_penjualan_barang["kode_cabang"].'">
						
					    </div>
					    
					    <div class="col-xs-2">
							<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.$row_penjualan_barang["tanggal"].'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>No Penjualan Barang</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" required="" name="kode_penjualan" id="kode_penjualan" value="'.$row_penjualan_barang["kode_penjualan"].'">
						
					    </div>

					    <div class="col-xs-2">
							<label>No Pengeluaran Stock</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" readonly="" required="" name="kode_pengeluaran_stock" id="kode_pengeluaran_stock" value="'.$row_penjualan_barang["kode_pengeluaran_stock"].'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control"  required="" name="kode_ruang" id="kode_ruang" value="'.$row_penjualan_barang["kode_ruang"].'" >
						</div>

					    <div class="col-xs-2">
							<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly="" readonly="" required="" name="kode_customer" id="kode_customer" value="'.$row_penjualan_barang["kode_customer"].'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Nama Ruang</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control"  readonly="" required="" name="nama_ruang" id="nama_ruang" value="'.$row_penjualan_barang["nama_ruang"].'" >
						</div>

					    <div class="col-xs-2">
							<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" readonly=""  required="" name="nama_customer" id="nama_customer" value="'.$row_penjualan_barang["nama_customer"].'" >
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Alamat</label>
					    </div>
					    <div class="col-xs-5">
							<textarea class="form-control" readonly="" name="alamat" style="resize:none;">'.$row_penjualan_barang["alamat"].'</textarea>
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Grand Total</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control"   name="grand_total" id="grand_total" value="'.$row_penjualan_barang["grand_total"].'" >
						</div>

					    <div class="col-xs-2">
							<label>PPN 10%</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control"   name="ppn" id="ppn" value="'.$row_penjualan_barang["ppn"].'" >
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Total</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control"  name="total" id="total" value="'.$row_penjualan_barang["total"].'" >
						</div>

					    <div class="col-xs-2">
							<label>Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control"   name="uang_muka" id="uang_muka" value="'.$row_penjualan_barang["uang_muka"].'" >
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
							<label>Sisa</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" class="form-control" name="sisa" id="sisa" value="'.$row_penjualan_barang["sisa"].'" >
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
							      <th width="17%">
								  Price
							      </th>
							      <th width="17%">
								  Amount
							      </th>
							      <th width="17%">
								  Lemari
							      </th>
							      <th width="10%">
							      #
							      </th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_penjualanbarang	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_penjualanbarang_item	= "SELECT * FROM `gx_penjualan_barang_detail` WHERE `kode_penjualan` ='".$kode_penjualanbarang."';";
    $sql_penjualanbarang_item	= mysql_query($query_penjualanbarang_item, $conn);
    $id_detail_penjualanbarang  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_penjualanbarang_detail = "SELECT * FROM `gx_penjualan_barang_detail` WHERE `kode_penjualan` ='".$kode_penjualanbarang."' AND `id_penjualan_barang_detail` = '".$id_detail_penjualanbarang."' LIMIT 0,1;";
    //echo $query_penjualanbarang_detail;
	$sql_penjualanbarang_detail   = mysql_query($query_penjualanbarang_detail, $conn);
    $row_penjualanbarang_detail = mysql_fetch_array($sql_penjualanbarang_detail);
    $no = 1;
    $total_price = 0;
    
    while($row_penjualanbarang_item = mysql_fetch_array($sql_penjualanbarang_item))
    {
    $total	= ($row_penjualanbarang_item["qty"] * $row_penjualanbarang_item["price"]);
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_penjualanbarang_item["kode_barang"].'</td>
	<td>'.$row_penjualanbarang_item["nama_barang"].'</td>
	<td>'.$row_penjualanbarang_item["serial_number"].'</td>
	<td>'.$row_penjualanbarang_item["qty"].'</td>
	<td>'.number_format($row_penjualanbarang_item["price"], 2, ',', '.').'</td>
	<td>'.$row_penjualanbarang_item["amount"].'</td>
	<td>'.$row_penjualanbarang_item["lemari"].'</td>
	<td><a href="form_penjualan_detail?c='.$row_penjualanbarang_item["kode_penjualan"].'&id='.$row_penjualanbarang_item["id_penjualan_barang_detail"].'"><span class="label label-info">Edit</span></a></td>
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
                                    <h3 class="box-title">FORM PENJUALAN ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["id_penjualan_barang_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_penjualanbarang" value="'.(isset($_GET['c']) ? $kode_penjualanbarang : "").'" readonly="">
						
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
							<input type="text" class="form-control"  name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["kode_barang"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text"  class="form-control" name="nama_barang" id="nama_barang" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["nama_barang"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Serial Number</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="serial_number" id="serial_number" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["serial_number"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Lemari</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="lemari" id="lemari" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["lemari"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Quantity</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="qty" id="qty" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["qty"] : "").'">
					    </div>
                    </div>
					</div>
                              
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Price</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="price" id="harga" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["price"] : "").'">
					    </div>
                    </div>
					</div>
					          
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Amount</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="amount" id="amount" value="'.(isset($_GET['id']) ? $row_penjualanbarang_detail["amount"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_penjualanbarang_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_penjualanbarang_detail["user_upd"]." ".$row_penjualanbarang_detail["date_upd"] : "").'
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

    $title	= 'Form Penjualan Barang Item';
    $submenu	= "penjualan_barang";
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