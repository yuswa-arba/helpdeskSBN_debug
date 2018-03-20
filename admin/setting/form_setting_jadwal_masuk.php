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
$table_main = "gx_setting_jadwal_pegawai";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "form_setting_jadwal_masuk";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "form_setting_jadwal_masuk";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Setting Jadwal Pegawai";
    $header_form = "Data Setting Jadwal Masuk";
    $index_field_sql = "id";
    $unix_field_sql = "kode_shift";
    $url_form_detail = "detail_setting_jadwal_masuk";
    $url_form_edit = "form_setting_jadwal_masuk";
    
    $form_name = "form_setting_jadwal_masuk";
    $form_id = "";
    
    //id web
    $title_header = 'Setting Jadwal Masuk';
    $submenu_header = 'setting_jadwal_masuk';
    
    
    
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$					= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_shift				= isset($_POST['kode_shift']) ? mysql_real_escape_string(trim($_POST['kode_shift'])) : '';
    $nama_shift				= isset($_POST['nama_shift']) ? mysql_real_escape_string(trim($_POST['nama_shift'])) : '';
    $check_in				= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
    $break				= isset($_POST['break']) ? mysql_real_escape_string(trim($_POST['break'])) : '';
    $check_out				= isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
    
    if($kode_shift != ""){
    //insert into cc_subscription_service
    //'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0'
  
  //  $sql_insert = "INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_batal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
  //  VALUES (NULL,'$kode_batal_posting','$nama_batal','$kode_batal','$alasan_batal','$data_asli','$data_baru',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
    $sql_insert = "INSERT INTO `gx_setting_jadwal_pegawai`(`id`, `kode_shift`, `nama_shift`, `check_in`, `break`, `check_out`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
    VALUES (NULL,'$kode_shift','$nama_shift','$check_in','$break','$check_out','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
    
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
    
    $id 						= isset($_GET['id']) ? mysql_real_escape_string(trim($_GET['id'])) : '';
    $c 							= isset($_GET['c']) ? mysql_real_escape_string(trim($_GET['c'])) : '';							
    $kode_shift						= isset($_POST['kode_shift']) ? mysql_real_escape_string(trim($_POST['kode_shift'])) : '';
    $nama_shift						= isset($_POST['nama_shift']) ? mysql_real_escape_string(trim($_POST['nama_shift'])) : '';
    $check_in						= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
    $break						= isset($_POST['break']) ? mysql_real_escape_string(trim($_POST['break'])) : '';
    $check_out						= isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
    
    
    if($c != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_setting_jadwal_pegawai` WHERE `kode_shift`='".$kode_shift."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	$sql_update = "UPDATE `gx_setting_jadwal_pegawai` SET `date_upd`=NOW(),`level`='1',`user_upd`='$loggedin[username]' WHERE `id`='$id'";
	$sql_insert = "INSERT INTO `gx_setting_jadwal_pegawai`(`id`, `kode_shift`, `nama_shift`, `check_in`, `break`, `check_out`, `status`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`)
	VALUES (NULL,'$kode_shift','$nama_shift','$check_in','$break','$check_out','0',NOW(),NOW(),'0','".$loggedin['username']."','".$loggedin['username']."')";
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	//echo $sql_update;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
       
       
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
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
    $query 	= "SELECT * FROM `".$table_main."` WHERE  `".$unix_field_sql."` ='".$c."' ORDER BY `".$index_field_sql."` DESC LIMIT 0,1"; 
    $sql	= mysql_query($query, $conn);
    $row	= mysql_fetch_array($sql);

}

    $content = '

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
						<label>Kode Shift</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="kode_shift" value="'.(isset($_GET['c']) ? $row["kode_shift"] : "SJP-".rand(0000000, 9999999) ).'">
					    </div>';
					    
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					  <div class="col-xs-2">
						<label>Nama Shift</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama_shift" value="'.(isset($_GET['c']) ? $row["nama_shift"] : '').'">
					    </div>
					  
                                        </div>
					</div>
					   
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Check In</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" id="checkInPicker"  class="form-control" name="check_in" value="'.(isset($_GET['c']) ? $row["check_in"] : '').'">
					    </div>

                                        </div>
					</div>
					
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Break</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  id="breakPicker" class="form-control" name="break" value="'.(isset($_GET['c']) ? $row["break"] : '').'">
					    </div>

                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Check Out</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" id="checkOutPicker" class="form-control" name="check_out" value="'.(isset($_GET['c']) ? $row["check_out"] : '').'">
					    </div>
5
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
        
	<script src="timepicker.js" type="text/javascript"></script>
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
		 
		 /*
                $("#checkInPicker").datepicker({format: "yyyy-mm-dd"});
                 $("#breakPicker").timepicker({
		    hourGrid: 4,
		    minuteGrid: 10,
		    timeFormat: \'hh:mm tt\'});
                 $("#checkOutPicker").timepicker({format: "H:i:s"});
		    */
	    });
        </script>
	';

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