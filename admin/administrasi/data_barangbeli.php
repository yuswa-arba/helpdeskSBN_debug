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
		
		$return_form	= isset($_GET['r']) ? mysql_real_escape_string(strip_tags(trim($_GET['r']))) : "";
		$f				= isset($_GET['f']) ? mysql_real_escape_string(strip_tags(trim($_GET['f']))) : "";
  

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
					      <th>Action</th>
					      
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
		
		$query_barang	= "SELECT `barcode` FROM `gx_barang` WHERE `kode_barang` ='".$row_periksabeli_item["kode_barang"]."';";
		$sql_barang		= mysql_query($query_barang, $conn);
		$row_barang		= mysql_fetch_array($sql_barang);
    
		
		$total	= ($row_periksabeli_item["qty"] * $row_periksabeli_item["harga"]);
		$content .='<tr>
		<td>'.$no.'.</td>
		<td>'.$row_periksabeli_item["kode_barang"].'</td>
		<td>'.$row_periksabeli_item["nama_barang"].'</td>
		<td>'.$row_periksabeli_item["qty"].'</td>
		<td>
			<a href="" onclick="validepopupform2(\''.mysql_real_escape_string($row_periksabeli_item["kode_barang"]).'\',';
			$content.='\''.mysql_real_escape_string($row_periksabeli_item["nama_barang"]).'\',';
			$content.='\''.mysql_real_escape_string($row_barang["barcode"]).'\',';
			$content.='\''.mysql_real_escape_string($row_periksabeli_item["harga"]).'\')">Select</a>
		</td>
		
		</tr>';
		$no++;
		$total_price = $total_price + $total;
		//<td><a href="form_periksabeli_detail?c='.$row_periksabeli_item["kode_periksa_pembelian"].'&id='.$row_periksabeli_item["id_periksa_pembelian_detail"].'"><span class="label label-info">Edit</span></a></td>
    }
}else{
    
    $total_price = 0;
    $content .='<tr><td colspan="7">&nbsp;</td></tr>';
}

$content .='							    
					    </tbody></table>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script type="text/javascript">
  
	function validepopupform2(kb, nb, br, hb){
                window.opener.document.'.$return_form.'.kode_barang.value=kb;
		window.opener.document.'.$return_form.'.nama_barang.value=nb;
		window.opener.document.'.$return_form.'.barcode.value=br;
		window.opener.document.'.$return_form.'.harga.value=hb;
                self.close();
        }
</script>';

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