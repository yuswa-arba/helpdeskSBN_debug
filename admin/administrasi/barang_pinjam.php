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
						<textarea class="form-control" name="keterangan" readonly="" style="resize:none;">'.(isset($_GET['c']) ? $row_data["keterangan"] : "").'</textarea>
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

    $title	= 'Detail Peminjaman Barang';
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