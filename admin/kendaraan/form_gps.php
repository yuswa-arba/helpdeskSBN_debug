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
$table_main = "gx_kendaraan_gps";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1


//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
    $url_redirect_insert = "master_gps";
    
//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    $redirect_update_data = "master_gps";
    
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Form GPS";
    $header_form = isset($_GET['c']) ? 'Form Edit' : 'Form Add';
    $index_field_sql = "id";
    $unix_field_sql = "kode_gps";
    $url_form_detail = "detail_gps";
    $url_form_edit = "form_gps";
    
    $form_name = "form_gps";
    $form_id = "";
    
    //id web
    $title_header = 'Master GPS';
    $submenu_header = 'master_gps';
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_gps				= isset($_POST['kode_gps']) ? mysql_real_escape_string(trim($_POST['kode_gps'])) : '';
    
    
    if($kode_gps != ""){
	
    $kode_gps				= isset($_POST['kode_gps']) ? mysql_real_escape_string(trim($_POST['kode_gps'])) : '';
    $nama_gps				= isset($_POST['nama_gps']) ? mysql_real_escape_string(trim($_POST['nama_gps'])) : '';
    $imei_gps				= isset($_POST['imei_gps']) ? mysql_real_escape_string(trim($_POST['imei_gps'])) : '';
    $nomer_sim_gps			= isset($_POST['nomer_sim_gps']) ? mysql_real_escape_string(trim($_POST['nomer_sim_gps'])) : '';
    $operator_seluler			= isset($_POST['operator_seluler']) ? mysql_real_escape_string(trim($_POST['operator_seluler'])) : '';
    $sms_center				= isset($_POST['sms_center']) ? mysql_real_escape_string(trim($_POST['sms_center'])) : '';
    $nomer_sos_1			= isset($_POST['nomer_sos_1']) ? mysql_real_escape_string(trim($_POST['nomer_sos_1'])) : '';
    $nomer_sos_2			= isset($_POST['nomer_sos_2']) ? mysql_real_escape_string(trim($_POST['nomer_sos_2'])) : '';
    $nomer_sos_3			= isset($_POST['nomer_sos_3']) ? mysql_real_escape_string(trim($_POST['nomer_sos_3'])) : '';
   
   
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
    /*$sql_insert = "INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'$kode_kontrak','$kode_cabang','$nama_cabang','$kode_customer','$nama_customer','$lama_kontrak','$periode_kontrak_mulai','$periode_kontrak_akhir','$tanggal','0','".$loggedin["username"]."','".$loggedin["username"]."', '0', NOW(), NOW())";*/
    $sql_insert = "INSERT INTO `gx_kendaraan_gps`(`id`, `kode_gps`, `nama_gps`, `imei_gps`, `nomer_sim_gps`, `operator_seluler`, `sms_center`, `nomer_sos_1`, `nomer_sos_2`, `nomer_sos_3`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'".$kode_gps."','".$nama_gps."','".$imei_gps."','".$nomer_sim_gps."','".$operator_seluler."','".$sms_center."','".$nomer_sos_1."','".$nomer_sos_2."','".$nomer_sos_3."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
    //echo $sql_insert."<br>";

    mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    $id_insert = mysql_insert_id($conn);
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    /*$sql_update_tbcustomer = "UPDATE `tbCustomer` SET `cBulanan`='".$lama_kontrak."',`kontrak_awal`='".$periode_kontrak_mulai."',`kontrak_akhir`='".$periode_kontrak_akhir."',`user_upd`='".$loggedin['username']."',`date_upd`=NOW() WHERE `cKode`='".$kode_customer."'";
    $query_update_tbcustomer = mysql_query($sql_update_tbcustomer, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data customer tidak bisa diupdate, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    */
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
    
}elseif(isset($_POST["update"])){
    
    //$ = isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $id 				= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 					= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';
     
    if($c != ""){
    
    $kode_gps				= isset($_POST['kode_gps']) ? mysql_real_escape_string(trim($_POST['kode_gps'])) : '';
    $nama_gps 				= isset($_POST['nama_gps']) ? mysql_real_escape_string(trim($_POST['nama_gps'])) : '';
    $imei_gps 				= isset($_POST['imei_gps']) ? mysql_real_escape_string(trim($_POST['imei_gps'])) : '';
    $nomer_sim_gps			= isset($_POST['nomer_sim_gps']) ? mysql_real_escape_string(trim($_POST['nomer_sim_gps'])) : '';
    $operator_seluler 			= isset($_POST['operator_seluler']) ? mysql_real_escape_string(trim($_POST['operator_seluler'])) : '';
    $sms_center 			= isset($_POST['sms_center']) ? mysql_real_escape_string(trim($_POST['sms_center'])) : '';
    $nomer_sos_1 			= isset($_POST['nomer_sos_1']) ? mysql_real_escape_string(trim($_POST['nomer_sos_1'])) : '';
    $nomer_sos_2 			= isset($_POST['nomer_sos_2']) ? mysql_real_escape_string(trim($_POST['nomer_sos_2'])) : '';
    $nomer_sos_3 			= isset($_POST['nomer_sos_3']) ? mysql_real_escape_string(trim($_POST['nomer_sos_3'])) : '';
   
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$sql_update = "UPDATE `gx_kendaraan_gps` SET `user_upd`='".$loggedin['username']."',`date_upd`=NOW(), `level`='1' WHERE `kode_gps`='".$c."'";
	
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
    
		    
	//insert into cc_subscription_service
	//'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
	/*$sql_insert = "INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'$kode_kontrak','$kode_cabang','$nama_cabang','$kode_customer','$nama_customer','$lama_kontrak','$periode_kontrak_mulai','$periode_kontrak_akhir','$tanggal','0','".$loggedin["username"]."','".$loggedin["username"]."', '0', NOW(), NOW())";
	*/
	
	$sql_insert = "INSERT INTO `gx_kendaraan_gps`(`id`, `kode_gps`, `nama_gps`, `imei_gps`, `nomer_sim_gps`, `operator_seluler`, `sms_center`, `nomer_sos_1`, `nomer_sos_2`, `nomer_sos_3`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'".$kode_gps."','".$nama_gps."','".$imei_gps."','".$nomer_sim_gps."','".$operator_seluler."','".$sms_center."','".$nomer_sos_1."','".$nomer_sos_2."','".$nomer_sos_3."','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	
	
	//echo $sql_insert."<br>";
    
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							       alert('Maaf Data tidak bisa diupdate ke dalam Database (error insert), Ada kesalahan!');
							       window.history.go(-1);
							   </script>");
	
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
       
    
    /*$sql_update_tbcustomer = "UPDATE `tbCustomer` SET `cBulanan`='".$lama_kontrak."',`kontrak_awal`='".$periode_kontrak_mulai."',`kontrak_akhir`='".$periode_kontrak_akhir."',`user_upd`='".$loggedin['username']."',`date_upd`=NOW() WHERE `cKode`='".$kode_customer."'";
    $query_update_tbcustomer = mysql_query($sql_update_tbcustomer, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data customer tidak bisa diupdate, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
    */
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
 
    
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

if(isset($_GET["c"]))
{
    $id		= isset($_GET['id']) ? $_GET['id'] : '';
    $c		= isset($_GET['c']) ? $_GET['c'] : '';
    /*$query_pengeluaran_barang = "SELECT `id_pengeluaran_barang`, `kode_pengeluaran`, `kode_acc_permintaaan`, `nama_pemohon`, `nama_cabang`, `divisi`, `nama_acc`, `kode_barang`, `nama_barang`, `serial_number`, `quantitiy`, `lemari`, `check_list`, `no_link_budget`, `nama_teknisi`, `kode_customer`, `nama_customer`, `tanggal`, `status`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level` FROM `gx_pengeluaran_barang` WHERE `id_pengeluaran_barang` ='".$id_pengeluaran_barang."' LIMIT 0,1;";*/
    $query 	= "SELECT * FROM `".$table_main."` WHERE `".$unix_field_sql."`='".$c."' AND `level`='0' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
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
				    $content .=' <div class="col-xs-2">
						<label>Master GPS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" readonly="" class="form-control" required="" name="kode_gps" value="'.(isset($_GET['c']) ? $row["kode_gps"] : "GPS-".rand(0000000, 9999999) ).'">
					    </div>';
					    
					$content .= '
					    <div class="col-xs-2">
						<label>Nama GPS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="nama_gps" value="'.(isset($_GET['c']) ? $row["nama_gps"] : '').'">
					    </div>
                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>IMEI GPS</label>
					    </div>
					    <div class="col-xs-5">
						<input type="text" class="form-control" required="" name="imei_gps" value="'.(isset($_GET['c']) ? $row["imei_gps"] : '').'">
						
					    </div>

                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					
					    <div class="col-xs-2">
						<label>Nomer SIM GPS</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="nomer_sim_gps" id="nomer_gps" value="'.(isset($_GET['c']) ? $row["nomer_sim_gps"] : '').'">
					    </div>
					
					    <div class="col-xs-2">
						<label>Operator Seluler</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="operator_seluler" id="nama_customer" value="'.(isset($_GET['c']) ? $row["operator_seluler"] : '').'">
					    </div>
					</div>
					</div>

					<div class="form-group">
					<div class="row"> 
					    <div class="col-xs-2">
						<label>SMS Center</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="sms_center" value="'.(isset($_GET['c']) ? $row["sms_center"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Nomer SOS 1</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" name="nomer_sos_1" value="'.(isset($_GET['c']) ? $row["nomer_sos_1"] : '').'">
					    </div>
					</div>
					</div>

					<div class="form-group">
					<div class="row">
					
					    <div class="col-xs-2">
						<label>Nomer SOS 2</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="nomer_sos_2" value="'.(isset($_GET['c']) ? $row["nomer_sos_2"] : '').'"  >
					    </div>
					    					
					    
					    <div class="col-xs-2">
						<label>Nomer SOS 3</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control"  required="" name="nomer_sos_3" value="'.(isset($_GET['c']) ? $row["nomer_sos_3"] : '').'"  >
					    </div>					   
					</div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['c']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
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