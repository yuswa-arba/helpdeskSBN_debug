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
    $title_header = 'Master Formulir';
    $submenu_header = 'master_formulir';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode 				= isset($_POST[$check_input_id]) ? mysql_real_escape_string(trim($_POST[$check_input_id])) : '';
    
    $kode_recycle					= isset($_POST['kode_recycle']) ? mysql_real_escape_string(trim($_POST['kode_recycle'])) : '';
    $nama_recycle					= isset($_POST['nama_recycle']) ? mysql_real_escape_string(trim($_POST['nama_recycle'])) : '';
    $kode_formulir					= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $printer_rusak					= isset($_POST['printer_rusak']) ? mysql_real_escape_string(trim($_POST['printer_rusak'])) : '';
    $form_tidak_kembali					= isset($_POST['form_tidak_kembali']) ? mysql_real_escape_string(trim($_POST['form_tidak_kembali'])) : '';
    $alasan						= ($printer_rusak == '' || $printer_rusak == '-') && $form_tidak_kembali != '' ? 'Form Tidak Kembali' : 'Printer Rusak';
    
    
    
    
    if($kode != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
    $sql_insert = "INSERT INTO `gx_recycle_blank_form`(`id`, `kode_recycle`, `nama_recycle`, `kode_formulir`, `alasan`, `printer_rusak`, `form_tidak_kembali`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'$kode_recycle','$nama_recycle','$kode_formulir','$alasan','$printer_rusak','$form_tidak_kembali',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
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
    $kode 		= isset($_POST['kode']) ? mysql_real_escape_string(trim($_POST['kode'])) : '';
    
    $kode_recycle					= isset($_POST['kode_recycle']) ? mysql_real_escape_string(trim($_POST['kode_recycle'])) : '';
    $nama_recycle					= isset($_POST['nama_recycle']) ? mysql_real_escape_string(trim($_POST['nama_recycle'])) : '';
    $kode_formulir					= isset($_POST['kode_formulir']) ? mysql_real_escape_string(trim($_POST['kode_formulir'])) : '';
    $alasan						= isset($_POST['alasan']) ? mysql_real_escape_string(trim($_POST['alasan'])) : '';
    $printer_rusak					= isset($_POST['printer_rusak']) ? mysql_real_escape_string(trim($_POST['printer_rusak'])) : '';
    $form_tidak_kembali					= isset($_POST['form_tidak_kembali']) ? mysql_real_escape_string(trim($_POST['form_tidak_kembali'])) : '';
    
    
    if($kode != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$sql_update = "UPDATE `gx_recycle_blank_form` SET `nama_recycle`='$nama_recycle',`kode_formulir`='$kode_formulir',
	`alasan`='$alasan',`printer_rusak`='$printer_rusak',`form_tidak_kembali`='$form_tidak_kembali',`date_add`=NOW(),`date_upd`=NOW(),`level`='0',
	`user_add`='".$loggedin['username']."',`user_upd`='".$loggedin['username']."' WHERE `id`='$kode'";
	
	
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
				    $content.=' <div class="col-xs-3">
						<label>No. Recycle Form</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control" required="" name="kode_recycle" value="'.(isset($_GET['id']) ? $row["kode_recycle"] : "RF-".rand(000000,999999)).'">
						<input type="hidden" readonly="" class="form-control" required="" name="kode" value="'.(isset($_GET['id']) ? $_GET['id'] : '').'">
					    </div>';
					$content .='
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Nama Recycle</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="nama_recycle" value="'.(isset($_GET['id']) ? $row["nama_recycle"] : "").'">
					    </div>
					    
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>No Formulir</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" readonly="" class="form-control"  required="" name="kode_formulir" id="kode_formulir" value="'.(isset($_GET['id']) ? $row["kode_formulir"] : '').'"  onclick="return valideopenerform(\'data_formulir.php?r=form_formulir&f=data_formulir\',\'formulir\');">
					    </div>
					</div>
					</div>

					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Alasan</label>
					    </div>
					    <div class="col-xs-9">
						&nbsp;
					    </div>
					    
					    
					</div>
					</div>

					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Printer Rusak</label>
					    </div>
					    <div class="col-xs-1">
						<!--<input type="text" class="form-control"  required="" name="printer_rusak" id="printer_rusak" value="'.(isset($_GET['id']) ? $row["printer_rusak"] : '').'"  >-->
						<input type="radio" class="form-control" required="" name="printer_rusak" value="yes" '.(isset($_GET['id']) ? ($row["printer_rusak"]=='yes' ? 'checked' : '') : '').'> Yes
					    </div>
					    
					    <div class="col-xs-1">
						<input type="radio" class="form-control" required="" name="printer_rusak" value="no" '.(isset($_GET['id']) ? ($row["printer_rusak"]=='no' ? 'checked' : '') : '').'> No
					    </div>
					    
					    <div class="col-xs-7">
					    </div>
					</div>
					</div>
					
					
					
					<div class="form-group">
					<div class="row">
					    
					    <div class="col-xs-3">
						<label>Form tidak kembali</label>
					    </div>
					    <div class="col-xs-1">
						<!--<input type="text" class="form-control"  required="" name="form_tidak_kembali" id="form_tidak_kembali" value="'.(isset($_GET['id']) ? $row["form_tidak_kembali"] : '').'"  >-->
						<input type="radio" class="form-control" required="" name="form_tidak_kembali" value="yes" '.(isset($_GET['id']) ? ($row["form_tidak_kembali"]=='yes' ? 'checked' : '') : '').'> Yes
					    </div>
					    
					    <div class="col-xs-1">
						<input type="radio" class="form-control" required="" name="form_tidak_kembali" value="no" '.(isset($_GET['id']) ? ($row["form_tidak_kembali"]=='no' ? 'checked' : '') : '').'> No
					    </div>
					    
					    <div class="col-xs-7">
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