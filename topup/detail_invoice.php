<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../config/configuration.php");

redirectToHTTPS();
if($loggedin = logged_in()){ // Check if they are logged in
    if($loggedin["group"] == 'customer')
    {
        global $conn;
    

$return_url = "";
if(isset($_GET["c"]))
{
    $kode_invoice	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_invoice 	= "SELECT * FROM `gx_invoice`
			    WHERE `kode_invoice` = '".$kode_invoice."'
				AND `customer_number` = '".$loggedin["customer_number"]."'
			    LIMIT 0,1;";
    $sql_invoice	= mysql_query($query_invoice, $conn);
    $row_invoice	= mysql_fetch_array($sql_invoice);
   
    
    //$return_url = 'form_invoice_detail.php?c='.$kode_invoice;
    
}


    $content = '<section class="content-header">
                    <h1>
                        Detail Invoice
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-9"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Invoice</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Pelanggan</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["nama_customer"] : '').'
					    </div>

					    <div class="col-xs-2">
						<label>Periode Tagihan</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["periode_tagihan"] : '').'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["customer_number"] : '').'
					    </div>

					    <div class="col-xs-2">
						<label>Tanggal Tagihan</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["tanggal_tagihan"] : '').'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Invoice</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["kode_invoice"] : '').'
					    </div>

					    <div class="col-xs-2">
						<label>Tanggal Jatuh Tempo</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["tanggal_jatuh_tempo"] : '').'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>NPWP</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["npwp"] : '').'
					    </div>

					    <div class="col-xs-2">
						<label>No Virtual Account BCA</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["no_virtual_account_bca"] : '').'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Faktur Pajak</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["no_faktur_pajak"] : '').'
					    </div>

					    <div class="col-xs-2">
						<label>Nama Virtual Account</label>
					    </div>
					    <div class="col-xs-3">
						'.(isset($_GET['c']) ? $row_invoice["nama_virtual"] : '').'
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Nota</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['c']) ? $row_invoice["reference"] : '').'
					    </div>

                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tanggal Generate</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['c']) ? date("d-m-Y H:i:s", strtotime($row_invoice["date_add"])) : '').'
					    </div>

                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Note</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET['c']) ? $row_invoice["note"] : '').'
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
								  Tanggal
							      </th>
							      <th width="35%">
								    Description
							      </th>
							      <th align="right" width="17%">
								    Harga
							      </th>
							      
							     
							    </tr>';
if(isset($_GET["c"]))
{
    $kode_invoice	= isset($_GET['c']) ? mysql_real_escape_string(strip_tags(trim($_GET['c']))) : '';
    $query_invoice_item	= "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$kode_invoice."';";
    $sql_invoice_item	= mysql_query($query_invoice_item, $conn);
    $id_detail_invoice  = isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_invoice_detail = "SELECT * FROM `gx_invoice_detail` WHERE `kode_invoice` ='".$kode_invoice."' AND `id_invoice_detail` = '".$id_detail_invoice."' LIMIT 0,1;";
    $sql_invoice_detail   = mysql_query($query_invoice_detail, $conn);
    $row_invoice_detail = mysql_fetch_array($sql_invoice_detail);
    $no = 1;
    $total_price = 0;
    
    while($row_invoice_item = mysql_fetch_array($sql_invoice_item))
    {
    
	$content .='<tr>
	<td>'.$no.'.</td>
	<td>'.date("d-m-Y", strtotime($row_invoice_item["date"])).'</td>
	<td>'.$row_invoice_item["desc"].'</td>
	<td>'.number_format($row_invoice_item["harga"], 2, ',', '.').'</td>
	</tr>';
	$no++;
	$total_price = $total_price + $row_invoice_item["harga"];
	
    }
}else{
    
    $total_price = 0;
    $content .='<tr><td colspan="6">&nbsp;</td></tr>';
}

$content .='						<tr>
							    <td>&nbsp;</td>
							    <td colspan="2" align="right">SUBTOTAL &nbsp;:</td>
							    <td  align="right">'.number_format($total_price, 2, ',', '.').' IDR</td>
							    
						    </tr>
						    <tr>
							    <td>&nbsp;</td>
							    <td colspan="2" align="right">PPN &nbsp;:</td>
							    <td  align="right">0 IDR</td>
							    
						    </tr>
						    <tr>
							    <td>&nbsp;</td>
							    <td colspan="2" align="right">UANG MUKA &nbsp;:</td>
							    <td  align="right">0 IDR</td>
							    
						    </tr>
						    
					     
					    </tbody></table>
					    
					     
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
';

    $title	= 'Detail Invoice';
    $submenu	= "invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL."logout.php");
    }

?>