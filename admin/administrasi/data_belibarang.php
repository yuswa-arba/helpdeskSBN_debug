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

    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
			<section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Barang</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
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
if(isset($_GET["id"]))
{
    $kode_periksabeli	= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : '';
    $query_periksabeli_item	= "SELECT * FROM `gx_setuju_pembelian_detail` WHERE `kode_setuju_pembelian` ='".$kode_periksabeli."';";
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
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Data Barang Persetujuan';
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