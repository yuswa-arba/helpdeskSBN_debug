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
    
$return_url = "";
if(isset($_GET["c"]))
{
    $kode_beli		= isset($_GET["c"]) ? mysql_real_escape_string(strip_tags(trim($_GET["c"]))) : '';
    $query_data 	= "SELECT * FROM `gx_beli`
			    WHERE `kode_beli` = '".$kode_beli."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
    $return_url		= 'form_belidetail.php?c='.$kode_beli;
	//echo $query_data;
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
						<label>No Persetujuan Pembelian</label>
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
	   
    </tr>

					    </tbody></table>
					    
					     
					    </td>
					    </tr>
					</tbody></table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
			</section>
			</section>
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

    $title	= 'Detail Pembelian';
    $submenu	= "master_beli";
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