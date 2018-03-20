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
    
if(isset($_POST["update"]) OR isset($_POST["updatelock"]))
{
    $id       		= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $kode_beli		= isset($_POST['kode_beli']) ? mysql_real_escape_string(trim($_POST['kode_beli'])) : '';
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(trim($_POST['kode_barang'])) : '';
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(trim($_POST['nama_barang'])) : '';
    $qty			= isset($_POST['qty']) ? mysql_real_escape_string(trim($_POST['qty'])) : '';
    $harga			= isset($_POST['harga']) ? str_replace(",", "", $_POST['harga']) : '';
    $kode_gudang	= isset($_POST['kode_gudang']) ? mysql_real_escape_string(trim($_POST['kode_gudang'])) : '';
    $nama_gudang	= isset($_POST['nama_gudang']) ? mysql_real_escape_string(trim($_POST['nama_gudang'])) : '';
    $kode_lemari	= isset($_POST['kode_lemari']) ? mysql_real_escape_string(trim($_POST['kode_lemari'])) : '';
    $lemari			= isset($_POST['lemari']) ? mysql_real_escape_string(trim($_POST['lemari'])) : '';
    $hpp			= isset($_POST['hpp']) ? mysql_real_escape_string(trim($_POST['hpp'])) : '';
    $check_in		= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
    $sn				= isset($_POST['sn']) ? mysql_real_escape_string(trim($_POST['sn'])) : '';
	$macaddress		= isset($_POST['macaddress']) ? mysql_real_escape_string(trim($_POST['macaddress'])) : '';
    $shipping_cost	= isset($_POST['shipping_cost']) ? mysql_real_escape_string(trim($_POST['shipping_cost'])) : '';
    
    $return_url		= isset($_POST['return_url']) ? mysql_real_escape_string(trim($_POST['return_url'])) : '';
    
    if($id != ""  AND $kode_beli != ""){
	$query_gudang	= mysql_query("SELECT * FROM `gx_gudang` WHERE `kode_gudang` = '".$kode_gudang."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_gudang	= mysql_fetch_array($query_gudang);
	
	$query_lemari	= mysql_query("SELECT * FROM `gx_lemari` WHERE `kode_lemari` = '".$kode_lemari."' AND `level` = '0' LIMIT 0,1;", $conn);
	$row_lemari 	= mysql_fetch_array($query_lemari);
	
    $sql_update = "UPDATE `gx_beli_detail` SET `kode_beli`='".$kode_beli."', `macaddress`='".$macaddress."',
    `sn`='".$sn."', `kode_gudang`='".$kode_gudang."', `nama_gudang`='".$row_gudang["nama_gudang"]."', `shipping_cost`='".$shipping_cost."',
    `hpp`='".$hpp."', `kode_lemari`='".$kode_lemari."', `lemari`='".$row_lemari["nama_lemari"]."', `check_in`='".$check_in."',
    `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
    WHERE (`id_beli_detail`='".$id."');";
    

    
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
	$sql_update_lock = "UPDATE `gx_beli` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_beli`='".$kode_beli."';";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
	echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_beli';
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
    $kode_beli		= isset($_GET["c"]) ? mysql_real_escape_string(strip_tags(trim($_GET["c"]))) : '';
    $query_data 	= "SELECT * FROM `gx_beli`
			    WHERE `kode_beli` = '".$kode_beli."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    $return_url = 'form_belidetail.php?c='.$kode_beli;
}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Pembelian</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["c"]) ? $row_data["nama_cabang"] : "").'"
						onclick="return valideopenerform(\'data_cabang.php?r=form_beli&f=beli\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET["c"]) ? $row_data["id_cabang"] : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" name="tanggal"  value="'.(isset($_GET["c"]) ? $row_data["tanggal"] : date("Y-m-d")).'" >
					    </div>
					    <div class="col-xs-2">
						<label>Subtotal</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" id="harga" required="" name="subtotal"  value="'.(isset($_GET["c"]) ? $row_data["subtotal"] : "").'" >
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Pembelian</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" name="kode_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_beli"] : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>No Order Beli</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" required="" name="kode_setuju_beli" id="kode_setuju_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_setuju_pembelian"] : "").'"
						onclick="return valideopenerform(\'data_orderbeli.php?r=form_beli&f=beli\',\'setuju_beli\');">
						<input type="hidden" class="form-control" readonly="" name="kode_order_beli" id="kode_order_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_order_beli"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Disc</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" id="harga" required="" name="disc"  value="'.(isset($_GET["c"]) ? $row_data["disc"] : "").'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Supplier</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" required="" name="kode_supplier" id="kode_supplier" value="'.(isset($_GET["c"]) ? $row_data["kode_supplier"] : "").'"
						onclick="return valideopenerform(\'data_supplier.php?r=form_beli&f=beli\',\'supplier\');">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Supplier</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" required="" name="nama_supplier" id="nama_supplier" value="'.(isset($_GET["c"]) ? $row_data["nama_supplier"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>PPN</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" id="harga" name="ppn"  value="'.(isset($_GET["c"]) ? $row_data["ppn"] : "").'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping By</label>
					    </div>
					    <div class="col-xs-2">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_shipping" value="'.(isset($_GET["c"]) ? $row_data["kode_shipping"] : "").'">
						<input type="text" readonly="" class="form-control" required="" name="nama_shipping" value="'.(isset($_GET["c"]) ? $row_data["nama_shipping"] : "").'"
						onclick="return valideopenerform(\'data_shipping.php?r=form_beli&f=beli\',\'shipping\');">
					    </div>
					    <div class="col-xs-2">
						<label>Shipping Cost per unit</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" id="shipping_unit" name="shipping_unit" value="'.(isset($_GET["c"]) ? $row_data["shipping_unit"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Grand Total</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" id="harga" name="grand_total"  value="'.(isset($_GET["c"]) ? $row_data["grand_total"] : "").'" >
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping Cost</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" required="" maxlength="30" class="form-control" id="shipping_cost" name="shipping_cost" value="'.(isset($_GET["c"]) ? $row_data["shipping_cost"] : "").'">
						<input type="hidden" class="form-control" id="qty_total" name="qty_total" value="">
					    </div>
					
					    <div class="col-xs-2">
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
						  <th>QTY</th>
						  <th>SN</th>
						  <th>Gudang</th>
						  <th>Price</th>
						  <th>Shipping Cost</th>
						  <th>HPP</th>
						  <th>Lemari</th>
						  <th>Check in</th>
						  <th>#</th>
						</tr>';
if(isset($_GET["c"]))
{
    
    $query_setujubeli_item	= "SELECT * FROM `gx_beli_detail` WHERE `kode_beli` ='".$row_data["kode_beli"]."';";
    $sql_setujunbeli_item	= mysql_query($query_setujubeli_item, $conn);
    $id_detail_setujubeli  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_setujubeli_detail = "SELECT * FROM `gx_beli_detail` WHERE `kode_beli` ='".$row_data["kode_beli"]."' AND `id_beli_detail` = '".$id_detail_setujubeli."' LIMIT 0,1;";
    $sql_setujubelii_detail   = mysql_query($query_setujubeli_detail, $conn);
    $row_setujubeli_detail = mysql_fetch_array($sql_setujubelii_detail);
    $no = 1;
    $total_price = 0;
    
    while($row_setujubeli_item = mysql_fetch_array($sql_setujunbeli_item))
    {
    $total	= ($row_setujubeli_item["qty"] * $row_setujubeli_item["harga"]);
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.$row_setujubeli_item["kode_barang"].'</td>
	<td>'.$row_setujubeli_item["nama_barang"].'</td>
	<td>'.$row_setujubeli_item["qty"].'</td>
	<td>'.$row_setujubeli_item["sn"].'</td>
	<td>'.$row_setujubeli_item["nama_gudang"].'</td>
	<td>'.number_format($row_setujubeli_item["harga"], 2, ',', '.').'</td>
	<td>'.$row_setujubeli_item["shipping_cost"].'</td>
	<td>'.$row_setujubeli_item["hpp"].'</td>
	<td>'.$row_setujubeli_item["lemari"].'</td>
	<td>'.$row_setujubeli_item["check_in"].'</td>
	<td><a href="form_belidetail?c='.$row_setujubeli_item["kode_beli"].'&id='.$row_setujubeli_item["id_beli_detail"].'"><span class="label label-info">Edit</span></a></td>
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
	    <td colspan="5" align="right">
		    TOTAL &nbsp;:
	    </td>
	    <td  align="right">
		    '.number_format($total_price, 2, ',', '.').'
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
                            </div><!-- /.box -->
			</section>
                        <section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">FORM PEMBELIAN ITEM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
				    <form action="" role="form" name="form_setujubeli_item" id="form_setujubeli_item" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						
					    </div>
					    <div class="col-xs-8">
						
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["id_beli_detail"] : '').'" readonly="">
						<input type="hidden" name="kode_beli" value="'.(isset($_GET['c']) ? $row_data["kode_beli"] : "").'" readonly="">
						
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
						<input type="text" readonly="" onclick="return valideopenerform(\'data_barang.php?r=form_setujubeli_item\',\'barang\');" class="form-control" required="" name="kode_barang" id="kode_barang" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["kode_barang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="nama_barang" id="nama_barang" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["nama_barang"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>QTY</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="qty" id="qty" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["qty"] : "").'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" readonly="" name="harga" id="harga" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["harga"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Serial Number</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="sn" id="sn" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["sn"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>MAC Address</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="macaddress" id="macaddress" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["macaddress"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Shipping Cost</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="shipping_cost" id="shipping_cost" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["shipping_cost"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>HPP</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="hpp" id="hpp" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["hpp"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Check in</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="check_in" id="check_in" value="'.(isset($_GET['id']) ? $row_setujubeli_detail["check_in"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Gudang</label>
					    </div>
					    <div class="col-xs-5">
						<select name="kode_gudang" class="form-control">';
						$query_gudang	= mysql_query("SELECT * FROM `gx_gudang` WHERE `level` = '0' ORDER BY `id_gudang` DESC ;", $conn);
						while ($row_gudang = mysql_fetch_array($query_gudang)) {
						    $content .='<option value="'.$row_gudang["kode_gudang"].'">'.$row_gudang["nama_gudang"].'</option>';
						}
					    $content .='</select>
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
						<label>Created By</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_setujubeli_detail["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['id']) ? $row_setujubeli_detail["user_upd"]." ".$row_setujubeli_detail["date_upd"] : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submitlock" name="updatelock" class="btn btn-primary">Update & Lock</button>
					<button type="submit" value="Submit" name="update" class="btn btn-primary">Update</button>
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

    $title	= 'Form Order Beli';
    $submenu	= "master_order_beli";
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