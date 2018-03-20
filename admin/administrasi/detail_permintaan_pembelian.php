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
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						'.$row_permintaan_pembelian["nama_cabang"].'
					    </div>
					    
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						'.$row_permintaan_pembelian["tanggal"].'
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-3">
						'.$row_permintaan_pembelian["kode_permintaan_pembelian"].'
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Login</label>
					    </div>
					    <div class="col-xs-3">
						'.$row_permintaan_pembelian["user_add"].'
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						'.$row_permintaan_pembelian["nama_divisi"].'
					    </div>

					    <div class="col-xs-2">
						<label>MU</label>
					    </div>
					    <div class="col-xs-3">
						'.$row_permintaan_pembelian["mu"].'
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						'.$row_permintaan_pembelian["keterangan"].'
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Remarks Permintaan Pembelian</label>
					    </div>
					    <div class="col-xs-8">
						'.$row_permintaan_pembelian["remarks_permintaan_pembelian"].'
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