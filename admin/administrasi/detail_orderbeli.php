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
    
if(isset($_GET["c"]))
{
    $kode_beli		= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_data 	= "SELECT * FROM `gx_order_beli`
			    WHERE `kode_order_beli` = '".$kode_beli."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);

}


    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Order Pembelian</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                       
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["c"]) ? $row_data["nama_cabang"] : "").'">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET["c"]) ? $row_data["id_cabang"] : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal"  value="'.(isset($_GET["c"]) ? $row_data["tanggal"] : date("Y-m-d")).'" >
					    </div>
					    
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Order Beli</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_order_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_order_beli"] : "").'" >
					    </div>
					    
					    <div class="col-xs-2">
						<label>No Persetujuan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_setuju_beli" id="kode_setuju_beli" value="'.(isset($_GET["c"]) ? $row_data["kode_setuju_pembelian"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Supplier</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" class="form-control" readonly="" required="" name="kode_supplier" id="kode_supplier" value="'.(isset($_GET["c"]) ? $row_data["kode_supplier"] : "").'">
						
						<input type="text" class="form-control" readonly="" required="" name="nama_supplier" id="nama_supplier" value="'.(isset($_GET["c"]) ? $row_data["nama_supplier"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-2">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						<select name="mu" disabled="" class="form-control">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'" '.((isset($_GET["c"]) AND $row_data['mu'] == $row_matauang['kode_matauang']) ? "select" : '').'>'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
					    </div>
					    <div class="col-xs-2">
						<label>Term Payment</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" maxlength="3" required="" name="term_payment" id="term_payment" value="'.(isset($_GET["c"]) ? $row_data["term_payment"] : "").'" Placeholder="dalam hari">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" readonly="" name="keterangan" style="resize:none;">'.(isset($_GET['c']) ? $row_data["keterangan"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Estimasi Kedatangan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" maxlength="3" name="estimasi" value="'.(isset($_GET["c"]) ? $row_data["estimasi"] : "").'" >
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal Datang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control hasDatepicker" id="datepicker" readonly="" required="" name="tgl_datang"  value="'.(isset($_GET["c"]) ? $row_data["tgl_datang"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping By</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_shipping" value="'.(isset($_GET["c"]) ? $row_data["kode_shipping"] : "").'">
						<input type="text" readonly="" class="form-control" required="" name="nama_shipping" value="'.(isset($_GET["c"]) ? $row_data["nama_shipping"] : "").'">
					    </div>
					    
					    
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping Mark</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" readonly="" name="shipping_remark" style="resize:none;">'.(isset($_GET['c']) ? $row_data["shipping_remark"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>PPN 10%</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" name="ppn" value="'.(isset($_GET["c"]) ? $row_data["ppn"] : "").'" >
					    </div>
                                        </div>
					</div>
                                        
					<table width="100%" cellspacing="10" class="table table-bordered table-striped">
					    <tbody>
					    <tr>
					      <th>No.</th>
					      <th>Kode Barang</th>
					      <th>Nama Barang</th>
					      <th>QTY</th>
					      <th>Satuan</th>
					      <th>Harga</th>
					      <th>Subtotal</th>
					    </tr>';
if(isset($_GET["c"]))
{
    
    $query_periksabeli_item	= "SELECT * FROM `gx_setuju_pembelian_detail` WHERE `kode_setuju_pembelian` ='".$row_data["kode_setuju_pembelian"]."';";
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
	<td>pcs</td>
	<td>'.number_format($row_periksabeli_item["harga"], 2, ',', '.').'</td>
	<td>'.number_format($total, 2, ',', '.').'</td>

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
							    <td colspan="5" align="center">
								    TOTAL
							    </td>
							    <td  align="left">
								    '.number_format($total_price, 2, ',', '.').'
							    </td>
							    
							    
						    </tr>
						    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="5" align="center">
								    PPN 10%
							    </td>
							    <td  align="left">
								    0
							    </td>
							    
							    
						    </tr>
						    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="5" align="center">
								    GRAND TOTAL
							    </td>
							    <td  align="left">
								    '.number_format($total_price, 2, ',', '.').'
							    </td>
							    
							    
						    </tr>
						    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="5" align="center">
								    UANG MUKA
							    </td>
							    <td  align="left">
								    0
							    </td>
							    
							    
						    </tr>
						    <tr>
							    <td>
								    &nbsp;
							    </td>
							    <td colspan="5" align="center">
								    SISA PEMBAYARAN
							    </td>
							    <td  align="left">
								    '.number_format($total_price, 2, ',', '.').'
							    </td>
							    
							    
						    </tr>
					     
					    </tbody></table>
					    
                                    </div><!-- /.box-body -->
				    
				   
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