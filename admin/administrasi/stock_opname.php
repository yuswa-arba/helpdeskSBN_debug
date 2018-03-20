<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Satuan");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '
                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
			    <form role="form" name="stock_opname"  method="POST" action="" enctype="multipart/form-data">
				<div class="box-body">
				    <div class="form-group">
				    <div class="row">
					
					<div class="col-xs-3">
					    <label>Cabang</label>
					</div>
					<div class="col-xs-6">
					    <select name="cabang" class="form-control">';
					    $query_cabang	= mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' ORDER BY `id_cabang` DESC ;", $conn);
					    while ($row_cabang = mysql_fetch_array($query_cabang)) {
						$content .='<option value="'.$row_cabang["id_cabang"].'">'.$row_cabang["nama_cabang"].'</option>';
					    }
					$content .='</select>
					</div>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					
					<div class="col-xs-3">
					    <label>Gudang</label>
					</div>
					<div class="col-xs-6">
					    <select name="gudang" class="form-control">';
					    $query_gudang	= mysql_query("SELECT * FROM `gx_gudang` WHERE `level` = '0' ORDER BY `id_gudang` DESC ;", $conn);
					    while ($row_gudang = mysql_fetch_array($query_gudang)) {
						$content .='<option value="'.$row_cabang["id_gudang"].'">'.$row_cabang["nama_gudang"].'</option>';
					    }
					$content .='</select>
					</div>
				    </div>
				    </div>
				    
				</div>
				<div class="box-footer">
				    <button type="submit" value="search" name="search" class="btn btn-primary">Search</button>
				</div>
				</form>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Barang</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Kode Barang</th>
			<th>Nama</th>
			<th>Stock</th>
			<th>Re order Stock</th>
			<th>Minimum Stock</th>
			<th>Harus Order</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_barang` WHERE `level` =  '0' LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_barang` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_barang"].'</td>
			<td>'.$row_data["nama_barang"].'</td>
			<td></td>
			<td>'.$row_data["reorder_stok"].'</td>
			<td>'.$row_data["minimum_stok"].'</td>
			<td></td>
			<td></td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
            
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>
</section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Stock';
    $submenu	= "stock";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>