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
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_permintaan_pengeluaran	= isset($_POST['kode_permintaan_pengeluaran']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pengeluaran'])) : '';
    $nama_pemohon					= isset($_POST['nama_pemohon']) ? mysql_real_escape_string(trim($_POST['nama_pemohon'])) : '';
    $kode_divisi					= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi					= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    
    
    if($kode_permintaan_pengeluaran != ""){
    //insert into cc_subscription_service
    $sql_insert = "INSERT INTO `gx_permintaan_pengeluaran_barang`(`id_permintaan_pengeluaran_barang`, `kode_permintaan_pengeluaran`, `kode_cabang`, `nama_cabang`, `kode_divisi`, `nama_divisi`, `tanggal`, `nama_pemohon`,
     					    `date_add`, `date_upd`,`user_add`, `user_upd`, `level`)
				    VALUES ('', '".$kode_permintaan_pengeluaran."', '".$kode_cabang."', '".$nama_cabang."', '".$kode_divisi."', '".$nama_divisi."', '".$tanggal."', '".$nama_pemohon."',
					    NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."', '0');";
    
    //echo $sql_insert."<br>";

    echo mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    /*echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='form_permintaan_pengeluaran_detail.php?c=$kode_permintaan_pengeluaran';
	</script>";
	*/
	header("location: form_permintaan_pengeluaran_detail.php?c=$kode_permintaan_pengeluaran");
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $kode_cabang					= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang					= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_permintaan_pengeluaran	= isset($_POST['kode_permintaan_pengeluaran']) ? mysql_real_escape_string(trim($_POST['kode_permintaan_pengeluaran'])) : '';
    $nama_pemohon					= isset($_POST['nama_pemohon']) ? mysql_real_escape_string(trim($_POST['nama_pemohon'])) : '';
    $kode_divisi					= isset($_POST['kode_divisi']) ? mysql_real_escape_string(trim($_POST['kode_divisi'])) : '';
    $nama_divisi					= isset($_POST['nama_divisi']) ? mysql_real_escape_string(trim($_POST['nama_divisi'])) : '';
    
    
    
    if($kode_permintaan_pembelian != ""){
	    
	//Update into cc_subscription_service
	$sql_update = "UPDATE `gx_permintaan_pengeluaran_barang` SET `kode_divisi`='".$kode_divisi."',
	`nama_divisi`='".$nama_divisi."', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'
	WHERE `kode_pemintaan_pengeluaran`='".$kode_permintaan_pengeluaran."';";
	
	
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
    $id_permintaan_pengeluaran_barang	= isset($_GET['id']) ? $_GET['id'] : '';
    $query_permintaan_pengeluaran_barang 	= "SELECT * FROM `gx_permintaan_pengeluaran_barang` WHERE `id_permintaan_pengeluaran_barang` ='".$id_permintaan_pengeluaran_barang."' LIMIT 0,1;";
    $sql_permintaan_pengeluaran_barang	= mysql_query($query_permintaan_pengeluaran_barang, $conn);
    $row_permintaan_pengeluaran_barang	= mysql_fetch_array($sql_permintaan_pengeluaran_barang);

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
                                <!-- form start -->
                                <form action="" role="form" name="form_permintaan_pengeluaran_barang" id="form_permintaan_pengeluaran_barang" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        <div class="form-group">
					<div class="row">';
				    if(isset($_GET["id"])){
					$content.=' <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["nama_cabang"] : "").'" >
						<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_cabang"] : "").'">
						
					    </div>';
				    }else{
					$content.='
					    
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="nama_cabang" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["nama_cabang"] : "").'" onclick="return valideopenerform(\'data_cabang.php?r=form_permintaan_pengeluaran_barang&f=permintaan_pengeluaran\',\'cabang\');">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_cabang" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_cabang"] : "").'">
						
					    </div>
					    ';
				    }
					$content .='
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No Permintaan Pengeluaran Barang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_permintaan_pengeluaran" id="kode_permintaan_pengeluaran" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_permintaan_pengeluaran"] : '').'">
						
					    </div>

					    <div class="col-xs-2">
						<label>Nama Pemohon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" readonly="" required="" name="nama_pemohon" id="nama_pemohon" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["nama_pemohon"] : $loggedin["username"]).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Divisi</label>
					    </div>
					    <div class="col-xs-3">
						<input type="hidden" readonly="" class="form-control"  required="" name="kode_divisi" id="kode_divisi" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["kode_divisi"] : '').'"  onclick="return valideopenerform(\'data_divisi.php?r=form_permintaan_pengeluaran_barang&f=permintaan_pengeluaran\',\'divisi\');">
						<input type="text" readonly="" class="form-control"  required="" name="nama_divisi" id="nama_divisi" value="'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["nama_divisi"] : '').'"  onclick="return valideopenerform(\'data_divisi.php?r=form_permintaan_pengeluaran_barang&f=permintaan_pengeluaran\',\'divisi\');">
					    </div>

                    </div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_permintaan_pengeluaran_barang["user_upd"]." (".$row_permintaan_pengeluaran_barang["date_upd"].")" : "").'
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

    $title	= 'Form Permintaan Pengeluaran Barang';
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