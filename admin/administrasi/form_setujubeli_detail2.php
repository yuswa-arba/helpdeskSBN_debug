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
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_setuju_pembelian	= isset($_POST['kode_setuju_beli']) ? mysql_real_escape_string(trim($_POST['kode_setuju_beli'])) : '';
    
    $kode_permintaan_pembelian	= isset($_POST['kode_permintaan_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pembelian'])) : '';
    $kode_periksa_pembelian	= isset($_POST['kode_periksa_pembelian']) ? mysql_real_escape_string(trim($_POST['kode_periksa_pembelian'])) : '';
    $kode_pegawai	= isset($_POST['kode_pegawai']) ? mysql_real_escape_string(trim($_POST['kode_pegawai'])) : '';
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    $mu		 	= isset($_POST['mu']) ? mysql_real_escape_string(trim($_POST['mu'])) : '';
    $remarks_permintaan_pembelian 	= isset($_POST['remarks_permintaanbeli']) ? mysql_real_escape_string(trim($_POST['remarks_permintaanbeli'])) : '';
    $remarks_periksa_pembelian		= isset($_POST['remarks_periksabeli']) ? mysql_real_escape_string(trim($_POST['remarks_periksabeli'])) : '';
    $remarks_setuju_pembelian		= isset($_POST['remarks_setujubeli']) ? mysql_real_escape_string(trim($_POST['remarks_setujubeli'])) : '';
    
    
    if($kode_setuju_pembelian != "" && $kode_permintaan_pembelian !="" && $kode_periksa_pembelian !=""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_setuju_pembelian`(`id_setuju_pembelian`, `id_cabang`, `nama_cabang`, `tanggal`, `kode_setuju_pembelian`, `kode_permintaan_pembelian`, `kode_pegawai`, `kode_divisi`,
     					    `nama_divisi`, `mu`, `remarks_permintaanbeli`, `remarks_periksabeli`, `remarks_setujubeli`, `status`,
					    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
				    VALUES ('', '".$id_cabang."', '".$nama_cabang."', '".$tanggal."', '".$kode_setuju_pembelian."', '".$kode_permintaan_pembelian."', '".$kode_pegawai."', '".$kode_divisi."',
					    '".$nama_divisi."', '".$mu."', '".$remarks_permintaan_pembelian."', '".$remarks_periksa_pembelian."', '".$remarks_setuju_pembelian."', '1',
					    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='master_setuju_pembelian.php';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}


if(isset($_GET["c"]))
{
    $kode_periksa_pembelian		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_periksa_pembelian 	= "SELECT * FROM `gx_periksa_pembelian`
			    WHERE `kode_periksa_pembelian` = '".$kode_periksa_pembelian."'
			    LIMIT 0,1;";
    $sql_periksa_pembelian	= mysql_query($query_periksa_pembelian, $conn);
    $row_periksa_pembelian	= mysql_fetch_array($sql_periksa_pembelian);
    
    $query_cabang 	= "SELECT * FROM `gx_cabang`
			    WHERE `id_cabang` = '".$row_periksa_pembelian["id_cabang"]."'
			    LIMIT 0,1;";
    $sql_cabang	= mysql_query($query_cabang, $conn);
    $row_cabang	= mysql_fetch_array($sql_cabang);
    
    $sql_setuju_beli = mysql_fetch_array(mysql_query("SELECT * FROM `gx_setuju_pembelian` ORDER BY `id_setuju_pembelian` DESC", $conn));
    $last_data  = $sql_setuju_beli["id_setuju_pembelian"] + 1;
    $tanggal    = date("d");
    $kode = $row_cabang["kode_cabang"].'-'.$row_cabang["kode_sbeli"].''.$tanggal.''.sprintf("%04d", $last_data);
	
    $return_url = 'form_periksabeli_detail.php?c='.$kode_periksa_pembelian;
    
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Periksa Pembelian</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="" role="form" name="form_periksabeli_item" id="form_periksabeli_item" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.$row_periksa_pembelian["nama_cabang"].'" >
						<input type="hidden" readonly="" class="form-control" name="nama_cabang" value="'.$row_periksa_pembelian["id_cabang"].'" >
					    </div>
					    
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Persetujuan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_setuju_beli" value="'.(isset($_GET["c"]) ? $kode : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.$row_periksa_pembelian["tanggal"].'">
					    </div>
					    
                                        </div>
					</div>
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Periksa Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_periksa_pembelian" id="kode_periksa_pembelian" value="'.$row_periksa_pembelian["kode_periksa_pembelian"].'">
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Login</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="nama_pegawai" id="nama_pegawai" value="'.$row_periksa_pembelian["user_add"].'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_permintaan_pembelian" id="kode_permintaan_pembelian" value="'.$row_periksa_pembelian["kode_permintaan_pembelian"].'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control"  required="" name="kode_divisi" id="id_divisi" value="'.(isset($_GET['c']) ? $row_periksa_pembelian["kode_divisi"] : '').'" >
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['c']) ? $row_periksa_pembelian["nama_divisi"] : '').'" onclick="return valideopenerform(\'data_divisi.php?r=form_permintaanbeli_item\',\'divisi\');">
					    </div>

					    <div class="col-xs-2">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<select name="mu" class="form-control">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'" '.(($row_periksa_pembelian['mu'] == $row_matauang['kode_matauang']) ? "select" : '').'>'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Remarks Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" readonly="" name="remarks_permintaanbeli" style="resize:none;">'.(isset($_GET['c']) ? $row_periksa_pembelian["remarks_permintaanbeli"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Remarks Periksa Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" readonly="" name="remarks_periksabeli" style="resize:none;">'.(isset($_GET['c']) ? $row_periksa_pembelian["remarks_periksabeli"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Remarks Pesetujuan Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="remarks_setujubeli" style="resize:none;"></textarea>
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
							    <tbody>
							    <tr>
							      <th>No.</th>
							      <th>Kode Barang</th>
							      <th>Nama Barang</th>
							      <th>QTY</th>
							      <th>Harga</th>
							      <th>Total</th>
							      <th>Remarks</th>
							      <th>stock</th>
							      <th>Re Order</th>
							      <th>Minimum Stock</th>
							      <th>Deviasi</th>
							      <th>Harga Beli Terakhir</th>
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_periksabeli	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_periksabeli_item	= "SELECT * FROM `gx_periksa_pembelian_detail` WHERE `kode_periksa_pembelian` ='".$kode_periksabeli."';";
    $sql_periksanbeli_item	= mysql_query($query_periksabeli_item, $conn);
    
    $no = 1;
    $total_price = 0;
    
    while($row_periksabeli_item = mysql_fetch_array($sql_periksanbeli_item))
    {
	$total	= ($row_periksabeli_item["qty"] * $row_periksabeli_item["harga"]);
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_periksabeli_item["kode_barang"].'</td>
	<td>'.$row_periksabeli_item["nama_barang"].'</td>
	<td>'.$row_periksabeli_item["qty"].'</td>
	<td>'.number_format($row_periksabeli_item["harga"], 2, ',', '.').'</td>
	<td>'.number_format($total, 2, ',', '.').'</td>
	<td>'.$row_periksabeli_item["remarks_barang"].'</td>
	<td>'.$row_periksabeli_item["stock"].'</td>
	<td>'.$row_periksabeli_item["reorder"].'</td>
	<td>'.$row_periksabeli_item["minim_stock"].'</td>
	<td>'.$row_periksabeli_item["deviasi"].'</td>
	<td>'.number_format($row_periksabeli_item["harga_beli_terakhir"], 2, ',', '.').'</td>
	
	</tr>';
	$no++;
	$total_price = $total_price + $total;
	//<td><a href="form_periksabeli_detail?c='.$row_periksabeli_item["kode_periksa_pembelian"].'&id='.$row_periksabeli_item["id_periksa_pembelian_detail"].'"><span class="label label-info">Edit</span></a></td>
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
				    
				   <div class="box-footer">
					<button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
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

    $title	= 'Form Persetujuan pembelian';
    $submenu	= "master_setujubeli";
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