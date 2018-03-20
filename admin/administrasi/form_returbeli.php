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
    
if(isset($_POST["save"]))
{
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(trim($_POST['id_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_setuju_pembelian	= isset($_POST['kode_setuju_beli']) ? mysql_real_escape_string(trim($_POST['kode_setuju_beli'])) : '';
    $kode_beli		= isset($_POST['kode_beli']) ? mysql_real_escape_string(trim($_POST['kode_beli'])) : '';
    $kode_returbeli	= isset($_POST['kode_returbeli']) ? mysql_real_escape_string(trim($_POST['kode_returbeli'])) : '';
    $kode_supplier	= isset($_POST['kode_supplier']) ? mysql_real_escape_string(trim($_POST['kode_supplier'])) : '';
    $kode_shipping	= isset($_POST['kode_shipping']) ? mysql_real_escape_string(trim($_POST['kode_shipping'])) : '';
    $nama_shipping	= isset($_POST['nama_shipping']) ? mysql_real_escape_string(trim($_POST['nama_shipping'])) : '';
    $nama_supplier	= isset($_POST['nama_supplier']) ? mysql_real_escape_string(trim($_POST['nama_supplier'])) : '';
    $shipping_cost 	= isset($_POST['shipping_cost']) ? mysql_real_escape_string(trim($_POST['shipping_cost'])) : '';
    $acc_hutang 	= isset($_POST['acc_hutang']) ? mysql_real_escape_string(trim($_POST['acc_hutang'])) : '';
    $ppn	 	= isset($_POST['ppn']) ? str_replace(',', '', $_POST['ppn']) : '';
    $disc	 	= isset($_POST['disc']) ? str_replace(',', '', $_POST['disc']) : '';
    $subtotal	 	= isset($_POST['subtotal']) ? str_replace(',', '', $_POST['subtotal']) : '';
    $grand_total 	= isset($_POST['grand_total']) ? str_replace(',', '', $_POST['grand_total']) : '';
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    
    
    if($kode_beli != "" && $kode_returbeli !=""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_returbeli` (`id_returbeli`, `id_cabang`, `nama_cabang`,
    `tanggal`, `kode_returbeli`, `kode_beli`, `kode_supplier`, `nama_supplier`,
    `kode_shipping`, `nama_shipping`, `shipping_cost`, `keterangan`, `acc_hutang`,
    `subtotal`, `ppn`, `disc`, `grand_total`, `status`,
    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
    VALUES ('', '".$id_cabang."', '".$nama_cabang."', '".$tanggal."',
    '".$kode_returbeli."', '".$kode_beli."', '".$kode_supplier."', '".$nama_supplier."',
    '".$kode_shipping."', '".$nama_shipping."', '".$shipping_cost."', '".$keterangan."',  '".$acc_hutang."',
    '".$subtotal."', '".$ppn."',  '".$disc."', '".$grand_total."', '0',
    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";

    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
					    alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
					    window.history.go(-1);
					</script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    $query_barang = "SELECT * FROM `gx_beli_detail` WHERE `kode_beli` ='".$kode_beli."' ;";
    $sql_barang   = mysql_query($query_barang, $conn);
    
    while($row_barang	= mysql_fetch_array($sql_barang)){
    $sql_insert_detail = "INSERT INTO `gx_returbeli_detail` (`id_returbeli_detail`, `kode_returbeli`,
    `kode_barang`, `nama_barang`, `qty`, `sn`, `harga`,
    `kode_gudang`, `nama_gudang`, `shipping_cost`, `hpp`,
    `kode_lemari`, `lemari`, `check_in`,
    `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES ('', '".$kode_returbeli."', '".$row_barang["kode_barang"]."',
    '".$row_barang["nama_barang"]."', '".$row_barang["qty"]."', '".$row_barang["sn"]."', '".$row_barang["harga"]."',
    '".$row_barang["kode_gudang"]."', '".$row_barang["nama_gudang"]."', '".$row_barang["shipping_cost"]."', '".$row_barang["hpp"]."',
    '".$row_barang["kode_lemari"]."', '".$row_barang["lemari"]."', '".$row_barang["check_in"]."',
    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert_detail."<br>";
    echo mysql_query($sql_insert_detail, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    }
    
    header("location: form_returbelidetail.php?c=$kode_returbeli");
    /*echo "<script language='JavaScript'>
    alert('Data telah dikirim ke email ".$to."');
    window.location.href='form_belidetail.php?c=".$kode_beli."';
    </script>";*/
    //echo 'Message has been sent.';
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
    
    
}


if(isset($_GET["id"]))
{
    $kode_beli		= isset($_GET['id']) ? mysql_real_escape_string(strip_tags(trim($_GET['id']))) : '';
    $query_data 	= "SELECT * FROM `gx_returbeli`
			    WHERE `kode_returbeli` = '".$kode_beli."' LIMIT 0,1;";
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
                                    <h3 class="box-title">Data Retur Pembelian</h3>
                                </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="" role="form" name="form_returbeli" id="form_returbeli" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET["id"]) ? $row_data["nama_cabang"] : "").'"
						onclick="return valideopenerform(\'data_cabang.php?r=form_returbeli&f=returbeli\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" name="id_cabang" value="'.(isset($_GET["id"]) ? $row_data["id_cabang"] : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" name="tanggal"  value="'.(isset($_GET["id"]) ? $row_data["tanggal"] : date("Y-m-d")).'" >
					    </div>
					    <div class="col-xs-2">
						<label>Subtotal</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" id="harga" required="" name="subtotal"  value="'.(isset($_GET["id"]) ? $row_data["subtotal"] : "").'" >
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Retur Pembelian</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" name="kode_returbeli" value="'.(isset($_GET["id"]) ? $row_data["kode_returbeli"] : "").'" >
					    </div>
					    <div class="col-xs-2">
						<label>No Pembelian</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" required="" name="kode_beli" id="kode_beli" value="'.(isset($_GET["id"]) ? $row_data["kode_beli"] : "").'"
						onclick="return valideopenerform(\'data_beli.php?r=form_returbeli&f=returbeli\',\'setuju_beli\');">
						
					    </div>
					    <div class="col-xs-2">
						<label>Disc</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" id="harga" required="" name="disc"  value="'.(isset($_GET["id"]) ? $row_data["disc"] : "").'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Supplier</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" required="" name="kode_supplier" id="kode_supplier" value="'.(isset($_GET["id"]) ? $row_data["kode_supplier"] : "").'"
						onclick="return valideopenerform(\'data_supplier.php?r=form_returbeli&f=returbeli\',\'supplier\');">
					    </div>
					    <div class="col-xs-2">
						<label>Nama Supplier</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" readonly="" required="" name="nama_supplier" id="nama_supplier" value="'.(isset($_GET["id"]) ? $row_data["nama_supplier"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>PPN</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" id="harga" name="ppn"  value="'.(isset($_GET["id"]) ? $row_data["ppn"] : "").'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping By</label>
					    </div>
					    <div class="col-xs-2">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_shipping" value="'.(isset($_GET["id"]) ? $row_data["kode_shipping"] : "").'">
						<input type="text" readonly="" class="form-control" required="" name="nama_shipping" value="'.(isset($_GET["id"]) ? $row_data["nama_shipping"] : "").'"
						onclick="return valideopenerform(\'data_shipping.php?r=form_returbeli&f=returbeli\',\'shipping\');">
					    </div>
					    <div class="col-xs-2">
						<label>ACC Hutang</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" class="form-control" id="acc_hutang" name="acc_hutang" value="'.(isset($_GET["id"]) ? $row_data["acc_hutang"] : "").'">
					    </div>
					    <div class="col-xs-2">
						<label>Grand Total</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" readonly="" class="form-control" required="" id="harga" name="grand_total"  value="'.(isset($_GET["id"]) ? $row_data["grand_total"] : "").'" >
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Shipping Cost</label>
					    </div>
					    <div class="col-xs-2">
						<input type="text" required="" maxlength="30" class="form-control" id="shipping_cost" name="shipping_cost" value="'.(isset($_GET["id"]) ? $row_data["shipping_cost"] : "").'">
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
					
                                    </div><!-- /.box-body -->
				    
				   <div class="box-footer">
					<button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
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
	    
        </script>
';

    $title	= 'Form Retur Pembelian';
    $submenu	= "master_returbeli";
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