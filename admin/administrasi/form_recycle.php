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
$table_main = "gx_recycle_blank_form";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1


//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
    $url_redirect_insert = "master_formulir";
    
//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    $redirect_update_data = "master_formulir";
    
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Formulir";
    $header_form = "Recycle Blank Form";
    $unix_field_sql = "kode_recycle";
    $url_form_detail = "detail_formulir";
    $url_form_edit = "form_formulir";
    $form_name = "form_formulir";
    $form_id = "formulir";
    $check_input_id = "kode_recycle";
    
    //id web
    $title_header = 'Recycle Blank Form';
    $submenu_header = 'master_formulir';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
    
if(isset($_POST["save"]))
{
    
    $kode_recycle		= isset($_POST['kode_recycle']) ? mysql_real_escape_string(trim($_POST['kode_recycle'])) : '';
    $tgl_recycle		= isset($_POST['tgl_recycle']) ? mysql_real_escape_string(trim($_POST['tgl_recycle'])) : '';
    $kode_formulir		= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $id_marketing		= isset($_POST['id_marketing']) ? mysql_real_escape_string(trim($_POST['id_marketing'])) : '';
    $nama_formulir		= isset($_POST['nama_formulir']) ? mysql_real_escape_string(trim($_POST['nama_formulir'])) : '';
    $tgl_cetak			= isset($_POST['tgl_cetak']) ? mysql_real_escape_string(trim($_POST['tgl_cetak'])) : '';
	$user_print			= isset($_POST['user_print']) ? mysql_real_escape_string(trim($_POST['user_print'])) : '';
	$keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$keterangan_lain	= isset($_POST['keterangan_lain']) ? mysql_real_escape_string(trim($_POST['keterangan_lain'])) : '';
	$notes				= isset($_POST['notes']) ? mysql_real_escape_string(trim($_POST['notes'])) : '';
    
    
    
    
    if($kode_recycle != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
    $sql_insert = "INSERT INTO `gx_recycle_blank_form` (`id`, `kode_recycle`, `tgl_recycle`, `id_marketing`,
	`nama_formulir`, `kode_formulir`, `tgl_cetak`, `user_print`, `keterangan`, `keterangan_lain`, `notes`,
	`date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'".$kode_recycle."','".$tgl_recycle."','".$id_marketing."','".$nama_formulir."','".$kode_formulir."','".$tgl_cetak."',
	'".$user_print."','".$keterangan."','".$keterangan_lain."','".$notes."',   
	NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
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
	window.location.href='list_recycleformulir.php';
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
    $id 		= isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    
    $kode_recycle		= isset($_POST['kode_recycle']) ? mysql_real_escape_string(trim($_POST['kode_recycle'])) : '';
    $tgl_recycle		= isset($_POST['tgl_recycle']) ? mysql_real_escape_string(trim($_POST['tgl_recycle'])) : '';
    $kode_formulir		= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $id_marketing		= isset($_POST['id_marketing']) ? mysql_real_escape_string(trim($_POST['id_marketing'])) : '';
    $nama_formulir		= isset($_POST['nama_formulir']) ? mysql_real_escape_string(trim($_POST['nama_formulir'])) : '';
    $tgl_cetak			= isset($_POST['tgl_cetak']) ? mysql_real_escape_string(trim($_POST['tgl_cetak'])) : '';
	$user_print			= isset($_POST['user_print']) ? mysql_real_escape_string(trim($_POST['user_print'])) : '';
	$keterangan			= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$keterangan_lain	= isset($_POST['keterangan_lain']) ? mysql_real_escape_string(trim($_POST['keterangan_lain'])) : '';
	$notes				= isset($_POST['notes']) ? mysql_real_escape_string(trim($_POST['notes'])) : '';
    
    
    if($id != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$sql_update = "UPDATE `gx_recycle_blank_form` SET `kode_recycle`='".$kode_recycle."', `tgl_recycle`='".$tgl_recycle."', `id_marketing`='".$id_marketing."',
	`nama_formulir`='".$nama_formulir."', `kode_formulir`='".$kode_formulir."', `tgl_cetak`='".$tgl_cetak."',
	`user_print`='".$user_print."', `keterangan`='".$keterangan."', `keterangan_lain`='".$keterangan_lain."', `notes`='".$notes."',
	`date_upd`=NOW(), `user_upd`='".$loggedin['username']."' WHERE `id`='".$id."';";
	
	
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
    $query 	= "SELECT * FROM `gx_recycle_blank_form` WHERE  `id` ='".$id."' LIMIT 0,1"; 
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);

}
$sql_kode 	= mysql_query("SELECT COUNT(`id`) AS `total` FROM `gx_recycle_blank_form`;", $conn);; 
$row_kode	= mysql_fetch_array($sql_kode);

$kode_recycle = 'SRF-'.date("dmY").sprintf('%04d', ($row_kode["total"]+1));

    $content = '
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-10"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">'.$header_form.'</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" name="'.$form_name.'" id="'.$form_id.'" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
				    
				    
                                        <div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<label>No. Recycle Form</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="kode_recycle" value="'.(isset($_GET['id']) ? $row["kode_recycle"] : $kode_recycle).'">
							<input type="hidden" readonly="" class="form-control" required="" name="kode" value="'.(isset($_GET['id']) ? $_GET['id'] : '').'">
					    </div>
						<div class="col-xs-3">
							<label>Tanggal</label>
					    </div>
					    <div class="col-xs-3">
							<input type="text" readonly="" class="form-control" required="" name="tgl_recycle" value="'.(isset($_GET['id']) ? $row["tgl_recycle"] : date("Y-m-d")).'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>No Formulir</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="kode_formulir" id="kode_formulir" placeholder="Kode Formulir" value="'.(isset($_GET['id']) ? $row["kode_formulir"] : '').'"
						onclick="return valideopenerform(\'data_formulir.php?r=form_formulir&f=data_formulir\',\'formulir\');">
					    </div>
						
						<div class="col-xs-3">
						<label>Tgl Cetak</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control"  required="" name="tgl_cetak" id="tgl_cetak" placeholder="dd-mm-yyyy" value="'.(isset($_GET['id']) ? $row["tgl_cetak"] : '').'">
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Formulir</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" readonly="" class="form-control"  required="" name="nama_formulir" id="nama_formulir" value="'.(isset($_GET['id']) ? $row["nama_formulir"] : '').'">
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>User Print</label>
					    </div>
					    <div class="col-xs-6">
						<input type="hidden" readonly="" class="form-control"  name="id_marketing" id="id_marketing" value="'.(isset($_GET['id']) ? $row["id_marketing"] : '').'">
						<input type="text" readonly="" class="form-control"  required="" name="user_print" id="user_print" value="'.(isset($_GET['id']) ? $row["user_print"] : '').'">
					    </div>
					</div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-9">
							<div class="row">
								<div class="col-xs-4">
									<input type="radio" name="keterangan" value="rusak" '.(isset($_GET['id']) ? ($row["keterangan"]=='rusak' ? 'checked' : '') : '').'>
									<label>Rusak</label>
								</div>
								<div class="col-xs-4">
									<input type="radio" name="keterangan" value="hilang" '.(isset($_GET['id']) ? ($row["keterangan"]=='hilang' ? 'checked' : '') : '').'>
									<label>Hilang</label>
								</div>
								<div class="col-xs-4">
									<input type="radio" name="keterangan" value="kembali" '.(isset($_GET['id']) ? ($row["keterangan"]=='kembali' ? 'checked' : '') : '').'>
									<label>Kembali</label>
								</div>
								<div class="col-xs-4">
									<input type="radio" name="keterangan" value="lain" '.(isset($_GET['id']) ? ($row["keterangan"]=='lain' ? 'checked' : '') : '').'>
									<label>Lain-lain</label> &nbsp;
								
									<input type="text"  name="keterangan_lain" id="keterangan_lain" value="'.(isset($_GET['id']) ? $row["keterangan_lain"] : '').'">
									
								</div>
								
					    </div>
					    
					    
					</div>
					</div>

					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Notes</label>
					    </div>
					    <div class="col-xs-6">
							<textarea name="notes" class="form-control" style="resize:none;">'.(isset($_GET['id']) ? $row["notes"] : '').'</textarea>
							
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