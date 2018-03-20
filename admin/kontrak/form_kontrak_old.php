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
     
//SQL 
$table_main = "gx_kontrak";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1


//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
    $url_redirect_insert = "master_kontrak";
    
//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    $redirect_update_data = "master_kontrak";
    
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Kontrak";
    $header_form = "Data Kontrak";
    $index_field_sql = "id";
    $unix_field_sql = "kode_kontrak";
    $url_form_detail = "detail_kontrak";
    $url_form_edit = "form_kontrak";
    
    $form_name = "form_kontrak";
    $form_id = "";
    
    //id web
    $title_header = 'Master Kontrak';
    $submenu_header = 'master_kontrak';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    $kode_kontrak			= isset($_POST['kode_kontrak']) ? mysql_real_escape_string(trim($_POST['kode_kontrak'])) : '';
    $tanggal				= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_cabang			= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang			= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $kode_customer			= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer			= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $lama_kontrak			= isset($_POST['lama_kontrak']) ? mysql_real_escape_string(trim($_POST['lama_kontrak'])) : '';
    $periode_kontrak_mulai		= isset($_POST['periode_kontrak_mulai']) ? mysql_real_escape_string(trim($_POST['periode_kontrak_mulai'])) : '';
    $periode_kontrak_akhir		= isset($_POST['periode_kontrak_akhir']) ? mysql_real_escape_string(trim($_POST['periode_kontrak_akhir'])) : '';
    
    
    if($kode_kontrak != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
    $sql_insert = "INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'$kode_kontrak','$kode_cabang','$nama_cabang','$kode_customer','$nama_customer','$lama_kontrak','$periode_kontrak_mulai','$periode_kontrak_akhir','$tanggal','".$loggedin["username"]."','".$loggedin["username"]."', '0', NOW(), NOW())";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".$url_redirect_insert."';
	</script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
    
}elseif(isset($_POST["update"]))
{
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    
    $id 				= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $kode_kontrak			= isset($_POST['kode_kontrak']) ? mysql_real_escape_string(trim($_POST['kode_kontrak'])) : '';
    $tanggal				= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $kode_cabang			= isset($_POST['kode_cabang']) ? mysql_real_escape_string(trim($_POST['kode_cabang'])) : '';
    $nama_cabang			= isset($_POST['nama_cabang']) ? mysql_real_escape_string(trim($_POST['nama_cabang'])) : '';
    $kode_customer			= isset($_POST['kode_customer']) ? mysql_real_escape_string(trim($_POST['kode_customer'])) : '';
    $nama_customer			= isset($_POST['nama_customer']) ? mysql_real_escape_string(trim($_POST['nama_customer'])) : '';
    $lama_kontrak			= isset($_POST['lama_kontrak']) ? mysql_real_escape_string(trim($_POST['lama_kontrak'])) : '';
    $periode_kontrak_mulai		= isset($_POST['periode_kontrak_mulai']) ? mysql_real_escape_string(trim($_POST['periode_kontrak_mulai'])) : '';
    $periode_kontrak_akhir		= isset($_POST['periode_kontrak_akhir']) ? mysql_real_escape_string(trim($_POST['periode_kontrak_akhir'])) : '';
    
    
    if($id != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$sql_update = "UPDATE `gx_kontrak` SET `kode_cabang`='$kode_cabang',`nama_cabang`='$nama_cabang',`kode_customer`='$kode_customer',`nama_customer`='$nama_customer',`lama_kontrak`='$lama_kontrak',`periode_kontrak_mulai`='$periode_kontrak_mulai',`periode_kontrak_akhir`='$periode_kontrak_akhir',`user_upd`='".$loggedin['username']."',`date_upd`=NOW() WHERE `id`='$id'";
	
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='".$redirect_update_data."';
	    </script>";
	
    }else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
    }
}

if(isset($_GET["id"]))
{
    $id		= isset($_GET['id']) ? $_GET['id'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query 	= "SELECT * FROM `".$table_main."` WHERE  `".$index_field_sql."` ='".$id."' LIMIT 0,1"; 
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);

}

    $content = '<section class="content-header">
                    <h1>
                        '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-12"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">'.$header_form.'</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
				    
				    
                                        <div class="form-group">
					<div class="row">';
				    $content.=' <div class="col-xs-2">
						<label>No. Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_kontrak" value="'.(isset($_GET['id']) ? $row["kode_kontrak"] : "K-".rand(0000000, 9999999) ).'">
					    </div>';
					    
					$content .= '
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="tanggal" value="'.(isset($_GET['id']) ? $row["tanggal"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="nama_cabang" id="nama_cabang" value="'.(isset($_GET['id']) ? $row["nama_cabang"] : '').'" onclick="return valideopenerform(\'data_cabang.php?r=form_kontrak&f=data_cabang\',\'cabang\');">
						<input type="hidden" name="kode_cabang" value="'.(isset($_GET['id']) ? $row["kode_cabang"] : '').'">
					    </div>

                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					
					    <div class="col-xs-2">
						<label>Kode Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" readonly="" required="" name="kode_customer" id="kode_customer" value="'.(isset($_GET['id']) ? $row["kode_customer"] : '').'" onclick="return valideopenerform(\'data_customer.php?r=form_kontrak&f=customer\',\'customer\');">
					    </div>
					
					    <div class="col-xs-2">
						<label>Nama Customer</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="nama_customer" id="nama_customer" value="'.(isset($_GET['id']) ? $row["nama_customer"] : '').'">
					    </div>
					    
					   
					</div>
					</div>

					<div class="form-group">
					<div class="row"> 
					    <div class="col-xs-2">
						<label>Lama Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="lama_kontrak" id="lama_kontrak" value="'.(isset($_GET['id']) ? $row["lama_kontrak"] : '').'"  >
					    </div>
					    <div class="col-xs-1">
						<label>bulan</label>
					    </div>
					</div>
					</div>

					<div class="form-group">
					<div class="row">
					
					    <div class="col-xs-2">
						<label>Periode Kontrak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="periode_kontrak_mulai" value="'.(isset($_GET['id']) ? $row["periode_kontrak_mulai"] : '').'">
					    </div>
					
					    <div class="col-xs-2">
						<label>Sampai dengan</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="periode_kontrak_akhir" value="'.(isset($_GET['id']) ? $row["periode_kontrak_akhir"] : '').'">
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

    $title	= $title_header;
    $submenu	= $submenu_header;
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