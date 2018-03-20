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
    $kode_pengeluaran			= isset($_POST['kode_pengeluaran_barang']) ? mysql_real_escape_string(trim($_POST['kode_pengeluaran_barang'])) : '';
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
        
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    $quantity				= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    
    $kode_lemari			= isset($_POST['kode_lemari']) ? mysql_real_escape_string(trim($_POST['kode_lemari'])) : '';
    $nama_lemari			= isset($_POST['nama_lemari']) ? mysql_real_escape_string(trim($_POST['nama_lemari'])) : '';
    $check_list				= isset($_POST['check_list']) ? mysql_real_escape_string(trim($_POST['check_list'])) : '';
    
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
/*INSERT INTO `gx_pengeluaran_barang_detail`(`id_pengeluaran_barang_detail`, `kode_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11])*/    
    
    if($kode_barang != "" && $kode_pengeluaran !=""){
    //insert into cc_subscription_service
    
    //`kode_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `kode_lemari`, `nama_lemari`
    $sql_insert = "INSERT INTO `gx_pengeluaran_barang_detail`(`id_pengeluaran_barang_detail`, `kode_pengeluaran`,
    `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `kode_lemari`, `nama_lemari`, `user_add`, `user_upd`,
    `date_add`, `date_upd`, `level`) VALUES (NULL,'$kode_pengeluaran','$kode_barang', '$nama_barang',
    '$serial_number', '$quantity', '$kode_lemari', '$nama_lemari', '".$loggedin['username']."',
    '".$loggedin['username']."',NOW(),NOW(),'0')";
    
    /*$sql_insert = "INSERT INTO `gx_pengeluaran_barang_detail`(`id_pengeluaran_barang_detail`, `kode_pengeluaran`,
    `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `user_add`, `user_upd`, `date_add`, `date_upd`,
    `level`) VALUES (NULL,'$kode_pengeluaran_barang','$kode_barang','$nama_barang','$serial_number','$quantity','".$loggedin["username"]."','".$loggedin["username"]."',
    NOW(),NOW(),'0')";*/
    
    /*$sql_insert = "INSERT INTO `gx_pengeluaran_barang_detail` (`id_acc_pengeluaran_barang_detail`, `kode_acc_pengeluaran`, `kode_barang`,
						    `nama_barang`, `serial_number`, `quantity`,
						    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
					    VALUES ('', '".$kode_acc_pengeluaran_barang."', '".$kode_barang."',
						    '".$nama_barang."', '".$serial_number."', '".$quantity."',
						    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";*/
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
    $kode_acc_pengeluaran_barang	= isset($_POST['kode_acc_pengeluaran_barang']) ? mysql_real_escape_string(trim($_POST['kode_acc_pengeluaran_barang'])) : '';
    $kode_barang			= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang			= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $serial_number			= isset($_POST['serial_number']) ? mysql_real_escape_string(trim($_POST['serial_number'])) : '';
    $quantity				= isset($_POST['quantity']) ? mysql_real_escape_string(trim($_POST['quantity'])) : '';
    $return_url				= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != "" AND $kode_acc_pengeluaran_barang != "" AND $kode_barang != ""){
    
    //Update into cc_subscription_service
    $sql_update = "UPDATE `gx_acc_pengeluaran_barang_detail` SET 
    `kode_barang`='".$kode_barang."', `nama_barang`='".$nama_barang."', `serial_number`='".$serial_number."', `quantity`='".$quantity."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE `id_acc_pengeluaran_barang_detail`='".$id."';";
    

    
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
}


/*
 *`id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaan`, `nama_pemohon`, `nama_cabang`, `kode_divisi`, `nama_divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`
 */
$return_url = "";
if(isset($_GET["c"]))
{
    $kode_pengeluaran	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $id_pengeluaran_barang	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : '';
    
    $query_pengeluaran_barang 	= "SELECT * FROM `gx_pengeluaran_barang`
			    WHERE `id_pengeluaran_barang` = '".$id_pengeluaran_barang."'
			    LIMIT 0,1;";
    $sql_pengeluaran_barang	= mysql_query($query_pengeluaran_barang, $conn);
    $row_pengeluaran_barang	= mysql_fetch_array($sql_pengeluaran_barang);
   
    
    $return_url = 'form_pengeluaran_detail.php?c='.$kode_pengeluaran.'&id='.$id_pengeluaran_barang;
    

if(isset($_GET["s"]) && isset($_GET["b"])){
// s = insert/delete, b = barang, c= pengeluaran id, id = table id
//select table acc
// SELECT `id_acc_pengeluaran_barang_detail`, `kode_acc_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `qty`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_acc_pengeluaran_barang_detail` WHERE 1
$data_source = mysql_fetch_array(mysql_query("SELECT * FROM `gx_acc_pengeluaran_barang_detail` WHERE `kode_acc_pengeluaran`='$_GET[c]' AND `kode_barang`='$_GET[b]'", $conn));
if($_GET["s"] == 'insert'){
    
    $kode_lemari = $row_pengeluaran_barang['kode_lemari'];
    $nama_lemari = $row_pengeluaran_barang['nama_lemari'];
    
    $sql_=  "INSERT INTO `gx_pengeluaran_barang_detail`(`id_pengeluaran_barang_detail`,
    `kode_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `kode_lemari`,
    `nama_lemari`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`) VALUES (NULL,
    '$data_source[kode_acc_pengeluaran]','$data_source[kode_barang]','$data_source[nama_barang]','$data_source[serial_number]','$data_source[qty]','$kode_lemari','$nama_lemari',
    '".$loggedin["username"]."','".$loggedin["username"]."', NOW(), NOW(), '0')";       

    
}elseif($_GET["s"] == 'delete'){
    //'$data_source[kode_acc_pengeluaran]','$data_source[kode_barang]','$data_source[nama_barang]','$data_source[serial_number]','$data_source[qty]','$kode_lemari','$nama_lemari',
    $sql_= "DELETE FROM `gx_pengeluaran_barang_detail` WHERE `kode_pengeluaran`='$_GET[c]' AND `kode_barang`='$_GET[b]'";
}
//echo $sql_;

$execution_query_sql = mysql_query($sql_, $conn);
if($execution_query_sql){
        echo "<script language='JavaScript'>
	alert('Data telah di checklist.');
	window.location.href='".$return_url."';
	</script>";
}else{
        echo "<script language='JavaScript'>
	alert('Data gagal di checklist.');
	window.location.href='".$return_url."';
	</script>";
}

}
}

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Pengeluaran Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					<form action="" role="form" name="form_pengeluaran_item" id="form_pengeluaran_item" method="post" enctype="multipart/form-data">
					    
					<div class="box-body">
                                        <div class="form-group">
					<div class="row">';
				    $content.=' <div class="col-xs-2">
						<label>No. Pengeluaran Stock</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_pengeluaran_barang" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["kode_pengeluaran"] : "").'" onclick="return valideopenerform(\'data_pengeluaran.php?r=form_pengeluaran_barang&f=pengeluaran_barang\',\'pengeluaran\');">
						<input type="hidden" readonly="" class="form-control" required="" name="id_pengeluaran_barang" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["id_pengeluaran_barang"] : "").'">
						
					    </div>';
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No ACC Permintaan Barang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_acc_permintaan" id="kode_acc_permintaan" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["kode_acc_permintaan"] : '').'" onclick="return valideopenerform(\'data_acc_permintaan_barang.php?r=form_pengeluaran_barang&f=acc_pengeluaran\',\'acc_pengeluaran\');">
						<input type="hidden" name="kode_cabang">
						<input type="hidden" name="nama_cabang">
					    </div>

					    <div class="col-xs-2">
						<label>Nama Pemohon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" readonly="" required="" name="nama_pemohon" id="nama_pemohon" value="'.(isset($_GET['id']) ? $row_pengeluaran_barang["nama_pemohon"] : $loggedin["username"]).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control"  required="" name="kode_divisi" id="kode_divisi" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["kode_divisi"] : '').'">
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["nama_divisi"] : '').'">
					    </div>
					    
					    
					    <div class="col-xs-2">
						<label>Nama ACC</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="nama_acc" id="nama_acc" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["nama_acc"] : '').'"  >
					    </div>

                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Lemari</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="nama_lemari" id="nama_lemari" value="'.(isset($_GET['c']) ? $row_pengeluaran_barang["nama_lemari"] : '').'">
					    </div>
					    
					    

					</div>
					</div>

					<div class="box-footer">
                                        <button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                    </div><!-- /.box-body -->
				    
				    </form>
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
							      <th width="10%">
								  Kode Barang
							      </th>
							      <th width="10%">
								  Nama Barang
							      </th>
							      <th  width="10%">
								  Serial Number
							      </th>
							      <th width="10%">
								  Quantity
							      </th>
							      <th width="10%">
								  Lemari
							      </th>
							      <th width="10%">
								  Check List
							      </th>
								 
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_pengeluaran	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    //sql acc pengeluaran
    //SELECT `id_acc_pengeluaran_barang_detail`, `kode_acc_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `qty`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_acc_pengeluaran_barang_detail` WHERE `kode_acc_pengeluaran`
    
    $sql_pengeluaran_ = "SELECT * FROM `gx_pengeluaran_barang` WHERE `kode_pengeluaran` ='".$kode_pengeluaran."' LIMIT 0,1;";
    $query_pengeluaran = mysql_query($sql_pengeluaran_, $conn);
    $data_pengeluaran = mysql_fetch_array($query_pengeluaran);
    
    $query_pengeluaran_item	= "SELECT * FROM `gx_acc_pengeluaran_barang_detail` WHERE `kode_acc_pengeluaran`='".$kode_pengeluaran."';";
    $sql_pengeluaran_item	= mysql_query($query_pengeluaran_item, $conn);
    $id_detail_pengeluaran  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_pengeluaran_detail = "SELECT * FROM `gx_pengeluaran_barang_detail` WHERE `kode_pengeluaran` ='".$kode_pengeluaran."' AND `id_pengeluaran_barang_detail` = '".$id_detail_pengeluaran."' LIMIT 0,1;";
    //echo $query_accpengeluaran_item;
	$sql_pengeluaran_detail = mysql_query($query_pengeluaran_detail, $conn);
	$row_pengeluaran_detail = mysql_fetch_array($sql_pengeluaran_detail);
    $no = 1;
    $total_quantity = 0;
    
    
    
    while($row_pengeluaran_item = mysql_fetch_array($sql_pengeluaran_item))
    {	//gx_acc_pengeluaran_barang_detail = SELECT `id_acc_pengeluaran_barang_detail`, `kode_acc_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `qty`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_acc_pengeluaran_barang_detail` WHERE 1
	//gx_pengeluaran_barang_detail = SELECT `id_pengeluaran_barang_detail`, `kode_pengeluaran`, `kode_barang`, `nama_barang`, `serial_number`, `quantity`, `kode_lemari`, `nama_lemari`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang_detail` WHERE 1
	$query_check_list = mysql_query("SELECT * FROM `gx_pengeluaran_barang_detail` WHERE `kode_barang`='$row_pengeluaran_item[kode_barang]' AND `kode_pengeluaran`='$row_pengeluaran_item[kode_acc_pengeluaran]'", $conn);
	$num_rows_check_list = mysql_num_rows($query_check_list);
	
	
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_pengeluaran_item["kode_barang"].'</td>
	<td>'.$row_pengeluaran_item["nama_barang"].'</td>
	<td>'.$row_pengeluaran_item["serial_number"].'</td>
	<td>'.$row_pengeluaran_item["qty"].'</td>
	<td>'.(isset($_GET['c']) ? $row_pengeluaran_barang["nama_lemari"] : '').'</td>
	<td><a href="?s='.($num_rows_check_list > 0 ? 'delete' : 'insert').'&b='.$row_pengeluaran_item["kode_barang"].'&c='.$row_pengeluaran_item["kode_acc_pengeluaran"].'&id='.(isset($_GET['id']) ? $_GET['id'] : $data_pengeluaran["id_pengeluaran_barang"]).'"><span class="label label-info">'.($num_rows_check_list > 0 ? 'Batal Check List' : 'Check List').'</span></a></td>
	</tr>';
	$no++;
	$total_quantity = $total_quantity + $row_pengeluaran_item["qty"];
	
    }
}else{
    
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}
/*
$content .='							    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="3" align="right">
								    TOTAL &nbsp;:
							    </td>
							    <td  align="right">
								    '.$total_quantity.'
							    </td>
							    <td colspan="2" align="right">
								    &nbsp;
							    </td>
							   
							   
						    </tr>';
						    */
$content .= '					     
					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
					
                                    </div><!-- /.box-body -->
				    
				   
                            </div><!-- /.box -->
                        </section>';
			/*
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM PENGELUARAN ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_pengeluaran_detail["id_pengeluaran_barang_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_pengeluaran" value="'.(isset($_GET['c']) ? $kode_pengeluaran : "").'" readonly="">
						
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
							<input type="text" class="form-control" readonly=""  name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_pengeluaran_detail["kode_barang"] : "").'"  onclick="return valideopenerform(\'data_barang.php?r=form_accpengeluaran_item\',\'barang\');">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text"  class="form-control" readonly="" name="nama_barang" id="nama_barang" value="'.(isset($_GET['id']) ? $row_pengeluaran_detail["nama_barang"] : "").'">
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Serial Number</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="serial_number" id="serial_number" value="'.(isset($_GET['id']) ? $row_pengeluaran_detail["serial_number"] : "").'">
					    </div>
                    </div>
					</div>
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
							<label>Quantity</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="quantity" id="quantity" value="'.(isset($_GET['id']) ? $row_pengeluaran_detail["quantity"] : "").'">
					    </div>
                    </div>
					</div>
                     
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_pengeluaran_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_pengeluaran_detail["user_upd"]." ".$row_pengeluaran_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                       <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>*/
$content .= '			
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