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
require_once '../helpdesk/mailer/class.phpmailer.php';
require_once '../helpdesk/mailer/class.smtp.php';
require_once 'po_pdf.php';

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]) OR isset($_POST["savelock"]))
{
    //$id       		= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_pinjam	= isset($_POST['kode_pinjam']) ? mysql_real_escape_string(trim($_POST['kode_pinjam'])) : '';
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $kode_lemari	= isset($_POST['kode_lemari']) ? mysql_real_escape_string(trim($_POST['kode_lemari'])) : '';
    $lemari			= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
    $check_out		= isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
    $sn				= isset($_POST['sn']) ? mysql_real_escape_string(trim($_POST['sn'])) : '';
    
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($kode_pinjam != ""){
	
	$query_lemari	= mysql_query("SELECT * FROM `gx_lemari` WHERE `kode_lemari` = '".$kode_lemari."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_lemari 	= mysql_fetch_array($query_lemari);
	
    $sql_insert = "INSERT INTO `gx_pinjam_detail` (`id_pinjam_detail`, `kode_pinjam`, `kode_barang`,
	`nama_barang`, `qty`, `sn`, `lemari`, `check_out`,
	`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$kode_pinjam."', '".$kode_barang."', '".$nama_barang."',
	'".$qty."', '".$sn."', '".$row_lemari["nama_lemari"]."', '".$check_out."',
	'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    

    
    //echo $sql_update;
    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan1!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);

   
    if(isset($_POST["save"])){
	echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".$return_url."';
	</script>";
    }elseif(isset($_POST["savelock"])){
	$sql_update_lock = "UPDATE `gx_pinjam_barang` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_pinjam`='".$kode_pinjam."';";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan2!');
							   window.history.go(-1);
						       </script>");
    
	echo "<script language='JavaScript'>
	alert('Data telah disave.');
	window.location.href='master_pinjam';
	</script>";
    }
	
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan3!');
		window.history.go(-1);
	    </script>";
    }
}elseif(isset($_POST["update"]) OR isset($_POST["updatelock"]))
{
    $id       		= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_pinjam	= isset($_POST['kode_pinjam']) ? mysql_real_escape_string(trim($_POST['kode_pinjam'])) : '';
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $kode_lemari	= isset($_POST['kode_lemari']) ? mysql_real_escape_string(trim($_POST['kode_lemari'])) : '';
    $lemari			= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
    $check_out		= isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
    $sn				= isset($_POST['sn']) ? mysql_real_escape_string(trim($_POST['sn'])) : '';
    
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != ""  AND $kode_pinjam != ""){
	
	$query_lemari	= mysql_query("SELECT * FROM `gx_lemari` WHERE `kode_lemari` = '".$kode_lemari."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_lemari 	= mysql_fetch_array($query_lemari);
	
    $sql_update = "UPDATE `gx_pinjam_detail` SET `kode_pinjam`='".$kode_pinjam."', `kode_barang`='".$kode_barang."',
	`nama_barang`='".$nama_barang."', `qty`='".$qty."', `sn`='".$sn."', `lemari`='".$row_lemari["nama_lemari"]."', `check_out`='".$check_out."',
    `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE (`id_pinjam_detail`='".$id."');";
    

    
    //echo $sql_update;
    mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    if(isset($_POST["update"])){
	echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".$return_url."';
	</script>";
    }elseif(isset($_POST["updatelock"])){
	$sql_update_lock = "UPDATE `gx_pinjam_barang` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_pinjam`='".$kode_pinjam."';";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
	echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_pinjam';
	</script>";
    }
	
    }else{
	
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

$return_url = "";
if(isset($_GET["c"]))
{
    $kode_data		= isset($_GET["c"]) ? mysql_real_escape_string(strip_tags(trim($_GET["c"]))) : '';
    $query_data 	= "SELECT * FROM `gx_pinjam_barang`
			    WHERE `kode_pinjam` = '".$kode_data."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    $return_url = 'form_pinjam_detail.php?c='.$kode_data;
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Peminjaman Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>No Peminjaman barang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_pinjam" value="'.(isset($_GET["c"]) ? $row_data["kode_pinjam"] : $kode_pinjam).'">
						<input type="hidden" readonly="" class="form-control" name="id_pinjam" value="'.(isset($_GET["c"]) ? $row_data["id_pinjam"] : "").'" >
					    </div>
					    <div class="col-xs-3">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal"  value="'.(isset($_GET["c"]) ? $row_data["tanggal"] : date("Y-m-d")).'" >
					    </div>
					    
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["c"]) ? $row_data["nama_cabang"] : "").'"
						onclick="return valideopenerform(\'data_cabang.php?r=form_pinjam&f=pinjam\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET["c"]) ? $row_data["id_cabang"] : "").'" >
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Peminjam</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_pinjam" value="'.(isset($_GET["c"]) ? $row_data["nama_pinjam"] : "").'" >
					    </div>
					    <div class="col-xs-3">
						<label>Gudang Peminjam</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="gudang_pinjam" id="gudang_pinjam" value="'.(isset($_GET["c"]) ? $row_data["gudang_pinjam"] : "").'"
						onclick="return valideopenerform(\'data_gudang.php?r=form_pinjam&f=gudang\',\'gudang\');">
						<input type="hidden" class="form-control" readonly="" name="nama_gudang" id="nama_gudang" value="'.(isset($_GET["c"]) ? $row_data["nama_gudang"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					
					
                    <div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-6">
						<textarea class="form-control" name="keterangan" style="resize:none;">'.(isset($_GET['c']) ? $row_data["keterangan"] : "").'</textarea>
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
						  <th>No.</th>
						  <th>Kode Barang</th>
						  <th>Nama Barang</th>
						  <th>SN</th>
						  <th>QTY</th>
						  <th>Lemari</th>
						  <th>Check Out</th>
						  <th>#</th>
						</tr>';
if(isset($_GET["c"]))
{
    
    $query_item	= "SELECT * FROM `gx_pinjam_detail` WHERE `kode_pinjam` ='".$row_data["kode_pinjam"]."';";
    $sql_item	= mysql_query($query_item, $conn);
    $id_detail  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_detail = "SELECT * FROM `gx_pinjam_detail` WHERE `kode_pinjam` ='".$row_data["kode_pinjam"]."' AND `id_pinjam_detail` = '".$id_detail."' LIMIT 0,1;";
    $sqli_detail   = mysql_query($query_detail, $conn);
    $row_detail = mysql_fetch_array($sqli_detail);
    $no = 1;
   
    while($row_item = mysql_fetch_array($sql_item))
    {
    $content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_item["kode_barang"].'</td>
	<td>'.$row_item["nama_barang"].'</td>
	<td>'.$row_item["sn"].'</td>
	<td>'.$row_item["qty"].'</td>
	<td>'.$row_item["lemari"].'</td>
	<td>'.$row_item["check_out"].'</td>
	<td><a href="form_pinjam_detail?c='.$row_item["kode_pinjam"].'&id='.$row_item["id_pinjam_detail"].'"><span class="label label-info">Edit</span></a></td>
	</tr>';
	$no++;
	
    }
}else{
    
    
    $content .='<tr><td colspan="8">&nbsp;</td></tr>';
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
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_detail["id_pinjam_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_pinjam" value="'.(isset($_GET['c']) ? $row_data["kode_pinjam"] : "").'" readonly="">
						
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
						<input type="text" readonly="" onclick="return valideopenerform(\'data_barang.php?r=form_item\',\'barang\');" class="form-control" required="" name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_detail["kode_barang"] : "").'">
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
						<label>QTY</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="qty" id="qty" value="'.(isset($_GET['id']) ? $row_detail["qty"] : "").'">
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
					    <div class="col-xs-5">
						<select name="kode_lemari" class="form-control">';
						$query_lemari	= mysql_query("SELECT * FROM `gx_lemari` WHERE `level` = '0' ORDER BY `id_lemari` DESC ;", $conn);
						while ($row_lemari = mysql_fetch_array($query_lemari)) {
						    $content .='<option value="'.$row_lemari["kode_lemari"].'">'.$row_lemari["nama_lemari"].'</option>';
						}
					    $content .='</select>
					    </div>
                                        </div>
					</div>
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Check out</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="check_out" id="check_out" value="'.(isset($_GET['id']) ? $row_detail["check_out"] : "").'">
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
                                        <button type="submit" value="Submitlock" name="'.(isset($_GET['id']) ? 'updatelock' : 'savelock').'" class="btn btn-primary">Submit & Lock</button>
										<button type="submit" value="Submit" name="'.(isset($_GET['id']) ? 'update' : 'save').'" class="btn btn-primary">Submit</button>
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
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
	    
	    $(document).ready(function(){
		$("#shipping_cost").keyup(function(){
		    var data=parseInt($("#shipping_cost").val());
		    var qty=parseInt($("#qty_total").val());
		    var unit = data /qty;
		    $("#shipping_unit").val(unit);
		});
	    });
        </script>
';

    $title	= 'Form Peminjaman Barang';
    $submenu	= "pinjam_barang";
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