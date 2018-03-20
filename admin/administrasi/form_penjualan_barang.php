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
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $kode_cabang	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_penjualan	= isset($_POST['kode_penjualan']) ? mysql_real_escape_string(trim($_POST['kode_penjualan'])) : '';
    $kode_pengeluaran_stock	= isset($_POST['kode_pengeluaran_stock']) ? mysql_real_escape_string(trim($_POST['kode_pengeluaran_stock'])) : '';
    $kode_customer	= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $kode_ruang		= isset($_POST['kode_ruang']) ? mysql_real_escape_string(trim($_POST['kode_ruang'])) : '';
    $nama_customer	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $nama_ruang	 	= isset($_POST['nama_ruang']) ? mysql_real_escape_string(trim($_POST['nama_ruang'])) : '';
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    
    
    if($kode_penjualan != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_penjualan_barang`(`id_penjualan_barang`, `kode_cabang`, `nama_cabang`, `kode_penjualan`, `kode_pengeluaran_stock`, `tanggal`, `kode_ruang`,
     					    `nama_ruang`, `kode_customer`, `nama_customer`, `alamat`,`date_add`, `date_upd`,
					    `user_add`, `user_upd`, `level`)
				    VALUES ('', '".$kode_cabang."', '".$nama_cabang."', '".$kode_penjualan."', '".$kode_pengeluaran_stock."', '".$tanggal."', '".$kode_ruang."',
					    '".$nama_ruang."', '".$kode_customer."', '".$nama_customer."', '".$alamat."', NOW(), NOW(),
					    '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='form_penjualan_detail.php?c=$kode_penjualan';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $kode_cabang	= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang	= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal		= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_penjualan	= isset($_POST['kode_penjualan']) ? mysql_real_escape_string(trim($_POST['kode_penjualan'])) : '';
    $kode_pengeluaran_stock	= isset($_POST['kode_pengeluaran_stock']) ? mysql_real_escape_string(trim($_POST['kode_pengeluaran_stock'])) : '';
    $kode_customer	= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $kode_ruang		= isset($_POST['kode_ruang']) ? mysql_real_escape_string(trim($_POST['kode_ruang'])) : '';
    $nama_customer	= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $nama_ruang	 	= isset($_POST['nama_ruang']) ? mysql_real_escape_string(trim($_POST['nama_ruang'])) : '';
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    
    
    
    if($kode_permintaan_pembelian != ""){
	    
	//Update into cc_subscription_service
	$sql_update = "UPDATE `gx_permintaan_pembelian` SET `kode_divisi`='".$kode_divisi."',
	`nama_divisi`='".$nama_divisi."', `mu`='".$mu."', `keterangan`='".$keterangan."', `remarks_permintaan_pembelian`='".$remarks_permintaan_pembelian."',
	`date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_permintaan_pembelian`='".$kode_permintaan_pembelian."';";
	
	
	//echo $sql_update;
	echo mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
       
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='master_permintaan_pembelian';
	    </script>";
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["id"]))
{
    $id_penjualan_barang	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_penjualan_barang 	= "SELECT * FROM `gx_penjualan` WHERE `id_penjualan_barang` ='".$id_penjualan_barang."' LIMIT 0,1;";
    $sql_penjualan_barang	= mysql_query($query_penjualan_barang, $conn);
    $row_penjualan_barang	= mysql_fetch_array($sql_penjualan_barang);

}

    $content = '

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Data Penjualan Barang</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="form_penjualan_barang" id="form_penjualan_barang" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">';
				    if(isset($_GET["id"])){
					$content.='';
				    }else{
					$content.='
					    
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_penjualan_barang["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=form_penjualan_barang&f=penjualan_barang\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_penjualan_barang["kode_cabang"] : "").'">
						
					    </div>
					    ';
				    }
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row_penjualan_barang["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Penjualan Barang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_penjualan" id="kode_penjualan" value="'.(isset($_GET['id']) ? $row_penjualan_barang["kode_penjualan"] : '').'">
						
					    </div>

					    <div class="col-xs-2">
						<label>No Pengeluaran Stock</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" readonly="" required="" name="kode_pengeluaran_stock" id="kode_pengeluaran_stock" value="'.(isset($_GET['id']) ? $row_penjualan_barang["kode_pengeluaran_stock"] : "").'" onclick="return valideopenerform(\'data_cust.php?r=form_penjualan_barang&f=penjualan_barang\',\'customer\');">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="kode_ruang" id="kode_ruang" value="'.(isset($_GET['id']) ? $row_penjualan_barang["kode_ruang"] : '').'"  onclick="return valideopenerform(\'data_ruang.php?r=form_penjualan_barang&f=penjualan_barang\',\'ruang\');">
						
					    </div>

					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" readonly="" required="" name="kode_customer" id="kode_customer" value="'.(isset($_GET['id']) ? $row_penjualan_barang["kode_customer"] : "").'" onclick="return valideopenerform(\'data_cust.php?r=form_penjualan_barang&f=penjualan_barang\',\'customer\');">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Nama Ruang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  readonly="" required="" name="nama_ruang" id="nama_ruang" value="'.(isset($_GET['id']) ? $row_penjualan_barang["nama_ruang"] : '').'" >
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly=""  required="" name="nama_customer" id="nama_customer" value="'.(isset($_GET['id']) ? $row_penjualan_barang["nama_customer"] : '').'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-5">
						<textarea class="form-control" readonly="" name="alamat" style="resize:none;">'.(isset($_GET['id']) ? $row_periksa_pembelian["alamat"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<!--
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Grand Total</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="grand_total" id="grand_total" value="'.(isset($_GET['id']) ? $row_penjualan_barang["grand_total"] : '').'" >
						
					    </div>

					    <div class="col-xs-2">
						<label>PPN 10%</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="ppn" id="ppn" value="'.(isset($_GET['id']) ? $row_penjualan_barang["ppn"] : '').'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Total</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="total" id="total" value="'.(isset($_GET['id']) ? $row_penjualan_barang["total"] : '').'" >
						
					    </div>

					    <div class="col-xs-2">
						<label>Uang Muka</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="uang_muka" id="uang_muka" value="'.(isset($_GET['id']) ? $row_penjualan_barang["uang_muka"] : '').'" >
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Sisa</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="sisa" id="sisa" value="'.(isset($_GET['id']) ? $row_penjualan_barang["sisa"] : '').'" >
						
					    </div>

                                        </div>
					</div>
					
					
					-->
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_penjualan_barang["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_penjualan_barang["user_upd"]." (".$row_penjualan_barang["date_upd"].")" : "").'
					    </div>
                                        
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>';

    $title	= 'Form Penjualan Barang';
    $submenu	= "Penjualan";
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