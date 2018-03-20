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

    $title	= 'Detail Permintaan Pengeluaran Item';
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