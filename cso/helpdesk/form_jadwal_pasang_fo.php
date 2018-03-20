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
if($loggedin = logged_inCSO()){ // Check if they are logged in
     
//SQL 
$table_main = "gx_cso_jadwal_pasang_fo";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_batal_posting` WHERE 1

//INSERT 
    //INSERT INTO `gx_batal_posting`(`id`, `kode_batal_posting`, `nama_balal`, `kode_batal`, `alasan_batal`, `data_asli`, `data_baru`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
    $url_redirect_insert = "master_jadwal_pasang_fo";
    
//UPDATE
    //UPDATE `gx_batal_posting` SET `id`=[value-1],`kode_batal_posting`=[value-2],`nama_balal`=[value-3],`kode_batal`=[value-4],`alasan_batal`=[value-5],`data_asli`=[value-6],`data_baru`=[value-7],`date_add`=[value-8],`date_upd`=[value-9],`level`=[value-10],`user_add`=[value-11],`user_upd`=[value-12] WHERE 1
    $redirect_update_data = "master_jadwal_pasang_fo";
    
    
//DELETE
    //DELETE FROM `gx_batal_posting` WHERE 1


//String Data View
    //Judul Form
    $judul_form = "Form Jadwal Pasang FO";
    $header_form = "Data Jadwal Pasang FO";
    $index_field_sql = "id";
    $unix_field_sql = "kode_jadwal_pasang_fo";
    $url_form_detail = "detail_jadwal_pasang_fo";
    $url_form_edit = "form_jadwal_pasang_fo";
    
    $form_name = "form_jadwal_pasang_fo";
    $form_id = "";
    
    //id web
    $title_header = 'Master Jadwal Pasang FO';
    $submenu_header = 'master_jadwal_pasang_fo';
    
    
    
    if($loggedin["group"] == 'cso')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    //$							= isset($_POST['']) ? mysql_real_escape_string(trim($_POST[''])) : '';
    $kode_jadwal_pasang_fo				= isset($_POST['kode_jadwal_pasang_fo']) ? mysql_real_escape_string(trim($_POST['kode_jadwal_pasang_fo'])) : '';
    $user_id						= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $nama						= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat						= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    
    $time_slot_h					= isset($_POST['time_slot_h']) ? mysql_real_escape_string(trim($_POST['time_slot_h'])) : '';
    $time_slot_i					= isset($_POST['time_slot_i']) ? mysql_real_escape_string(trim($_POST['time_slot_i'])) : '';
    $time_slot_p					= isset($_POST['time_slot_p']) ? mysql_real_escape_string(trim($_POST['time_slot_p'])) : '';
    $time_slot_digit_time				= implode(":", array($time_slot_h, $time_slot_i));
    $time_slot						= implode(" ", array($time_slot_digit_time, $time_slot_p));
    
    $teknisi						= isset($_POST['teknisi']) ? mysql_real_escape_string(trim($_POST['teknisi'])) : '';
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $pekerjaan						= isset($_POST['pekerjaan']) ? mysql_real_escape_string(trim($_POST['pekerjaan'])) : '';
    $keterangan						= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
     
     
    /*  
    $check_in_h						= isset($_POST['check_in_h']) ? mysql_real_escape_string(trim($_POST['check_in_h'])) : '';
    $check_in_i						= isset($_POST['check_in_i']) ? mysql_real_escape_string(trim($_POST['check_in_i'])) : '';
    $check_in_p						= isset($_POST['check_in_p']) ? mysql_real_escape_string(trim($_POST['check_in_p'])) : '';
    $check_in_digit_time				= implode(":", array($check_in_h, $check_in_i));
    $check_in						= implode(" ", array($check_in_digit_time, $check_in_p));
    
    $check_out_h					= isset($_POST['check_out_h']) ? mysql_real_escape_string(trim($_POST['check_out_h'])) : '';
    $check_out_i					= isset($_POST['check_out_i']) ? mysql_real_escape_string(trim($_POST['check_out_i'])) : '';
    $check_out_p					= isset($_POST['check_out_p']) ? mysql_real_escape_string(trim($_POST['check_out_p'])) : '';
    $check_out_digit_time				= implode(":", array($check_out_h, $check_out_i));
    $check_out						= implode(" ", array($check_out_digit_time, $check_out_p));
        
    $jenis_pekerjaan					= isset($_POST['jenis_pekerjaan']) ? mysql_real_escape_string(trim($_POST['jenis_pekerjaan'])) : '';
    
    $last_update_h					= isset($_POST['last_update_h']) ? mysql_real_escape_string(trim($_POST['last_update_h'])) : '';
    $last_update_i					= isset($_POST['last_update_i']) ? mysql_real_escape_string(trim($_POST['last_update_i'])) : '';
    $last_update_p					= isset($_POST['last_update_p']) ? mysql_real_escape_string(trim($_POST['last_update_p'])) : '';
    $last_update_digit_time				= implode(":", array($last_update_h, $last_update_i));
    $last_update					= implode(" ", array($last_update_digit_time, $last_update_p));
            
    $teknisi						= isset($_POST['teknisi']) ? mysql_real_escape_string(trim($_POST['teknisi'])) : '';
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $problem						= isset($_POST['problem']) ? mysql_real_escape_string(trim($_POST['problem'])) : '';
    $solusi						= isset($_POST['solusi']) ? mysql_real_escape_string(trim($_POST['solusi'])) : '';
    */
    
	
    if($kode_jadwal_pasang_fo != ""){
    
    /*
    $sql_insert = "INSERT INTO `gx_cso_jadwal_pasang_fo`(`id`, `kode_cso_maintenance`, `nama_cso`, `user_id`, `nama`, `alamat`, `tanggal`, `spk_start`, `spk_finnish`, `check_in`, `check_out`, `jenis_pekerjaan`, `last_update`, `teknisi`, `status`, `problem`, `solusi`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'".$kode_cso_maintenance."','".$nama_cso."','".$user_id."','".$nama."','".$alamat."','".$tanggal."','".$spk_start."','".$spk_finnish."','".$check_in."','".$check_out."','".$jenis_pekerjaan."','".$last_update."','".$teknisi."','".$status."','".$problem."','".$solusi."',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    //echo $sql_insert."<br>";
    */
    
    $sql_insert = "INSERT INTO `gx_cso_jadwal_pasang_fo`(`id`, `kode_jadwal_pasang_fo`, `user_id`, `nama`, `alamat`, `tanggal`, `time_slot`, `teknisi`, `status`, `pekerjaan`, `keterangan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
    VALUES (NULL,'".$kode_jadwal_pasang_fo."','".$user_id."','".$nama."','".$alamat."','".$tanggal."','".$time_slot."','".$teknisi."','".$status."','".$pekerjaan."','".$keterangan."',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
    
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
    $kode_jadwal_pasang_fo				= isset($_POST['kode_jadwal_pasang_fo']) ? mysql_real_escape_string(trim($_POST['kode_jadwal_pasang_fo'])) : '';
    $user_id						= isset($_POST['user_id']) ? mysql_real_escape_string(trim($_POST['user_id'])) : '';
    $nama						= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat						= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $tanggal						= isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    
    $time_slot_h					= isset($_POST['time_slot_h']) ? mysql_real_escape_string(trim($_POST['time_slot_h'])) : '';
    $time_slot_i					= isset($_POST['time_slot_i']) ? mysql_real_escape_string(trim($_POST['time_slot_i'])) : '';
    $time_slot_p					= isset($_POST['time_slot_p']) ? mysql_real_escape_string(trim($_POST['time_slot_p'])) : '';
    $time_slot_digit_time				= implode(":", array($time_slot_h, $time_slot_i));
    $time_slot						= implode(" ", array($time_slot_digit_time, $time_slot_p));
    
    $teknisi						= isset($_POST['teknisi']) ? mysql_real_escape_string(trim($_POST['teknisi'])) : '';
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $pekerjaan						= isset($_POST['pekerjaan']) ? mysql_real_escape_string(trim($_POST['pekerjaan'])) : '';
    $keterangan						= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    
    /*  
    $check_in_h						= isset($_POST['check_in_h']) ? mysql_real_escape_string(trim($_POST['check_in_h'])) : '';
    $check_in_i						= isset($_POST['check_in_i']) ? mysql_real_escape_string(trim($_POST['check_in_i'])) : '';
    $check_in_p						= isset($_POST['check_in_p']) ? mysql_real_escape_string(trim($_POST['check_in_p'])) : '';
    $check_in_digit_time				= implode(":", array($check_in_h, $check_in_i));
    $check_in						= implode(" ", array($check_in_digit_time, $check_in_p));
    
    $check_out_h					= isset($_POST['check_out_h']) ? mysql_real_escape_string(trim($_POST['check_out_h'])) : '';
    $check_out_i					= isset($_POST['check_out_i']) ? mysql_real_escape_string(trim($_POST['check_out_i'])) : '';
    $check_out_p					= isset($_POST['check_out_p']) ? mysql_real_escape_string(trim($_POST['check_out_p'])) : '';
    $check_out_digit_time				= implode(":", array($check_out_h, $check_out_i));
    $check_out						= implode(" ", array($check_out_digit_time, $check_out_p));
        
    $jenis_pekerjaan					= isset($_POST['jenis_pekerjaan']) ? mysql_real_escape_string(trim($_POST['jenis_pekerjaan'])) : '';
    
    $last_update_h					= isset($_POST['last_update_h']) ? mysql_real_escape_string(trim($_POST['last_update_h'])) : '';
    $last_update_i					= isset($_POST['last_update_i']) ? mysql_real_escape_string(trim($_POST['last_update_i'])) : '';
    $last_update_p					= isset($_POST['last_update_p']) ? mysql_real_escape_string(trim($_POST['last_update_p'])) : '';
    $last_update_digit_time				= implode(":", array($last_update_h, $last_update_i));
    $last_update					= implode(" ", array($last_update_digit_time, $last_update_p));
        
    $teknisi						= isset($_POST['teknisi']) ? mysql_real_escape_string(trim($_POST['teknisi'])) : '';
    $status						= isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '';
    $problem						= isset($_POST['problem']) ? mysql_real_escape_string(trim($_POST['problem'])) : '';
    $solusi						= isset($_POST['solusi']) ? mysql_real_escape_string(trim($_POST['solusi'])) : '';
    */
    
    if($kode_jadwal_pasang_fo != ""){
	
	//UPDATE INTO GX PENGELUARAN
	//`user_upd`='".$loggedin['username']."',`date_upd`=NOW()
	/*
	$data_array_select 	= mysql_fetch_array(mysql_query("SELECT `id` FROM `gx_reaktivasi_customer` WHERE `kode_reaktivasi`='".$c."' ORDER BY `id` DESC LIMIT 0,1", $conn));
	$id			= $data_array_select['id'];
	*/
	
	
	$sql_update = "UPDATE `gx_cso_jadwal_pasang_fo` SET `date_upd`=NOW(),`user_upd`='".$loggedin['username']."',`level`='1' WHERE `kode_jadwal_pasang_fo`='".$c."'";
	/*
	$sql_insert = "INSERT INTO `gx_cso_jadwal_pasang_fo`(`id`, `kode_cso_maintenance`, `nama_cso`, `user_id`, `nama`, `alamat`, `tanggal`, `spk_start`, `spk_finnish`, `check_in`, `check_out`, `jenis_pekerjaan`, `last_update`, `teknisi`, `status`, `problem`, `solusi`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$kode_cso_maintenance."','".$nama_cso."','".$user_id."','".$nama."','".$alamat."','".$tanggal."','".$spk_start."','".$spk_finnish."','".$check_in."','".$check_out."','".$jenis_pekerjaan."','".$last_update."','".$teknisi."','".$status."','".$problem."','".$solusi."',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
	//echo $sql_insert."<br>";
*/
	
	$sql_insert = "INSERT INTO `gx_cso_jadwal_pasang_fo`(`id`, `kode_jadwal_pasang_fo`, `user_id`, `nama`, `alamat`, `tanggal`, `time_slot`, `teknisi`, `status`, `pekerjaan`, `keterangan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL,'".$kode_jadwal_pasang_fo."','".$user_id."','".$nama."','".$alamat."','".$tanggal."','".$time_slot."','".$teknisi."','".$status."','".$pekerjaan."','".$keterangan."',NOW(),NOW(),'".$loggedin['username']."','".$loggedin['username']."','0')";
	
	//echo $sql_update;
	mysql_query($sql_update, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database (update sql), Ada kesalahan!');
							window.history.go(-1);
						    </script>");
	
	//echo $sql_update;
	mysql_query($sql_insert, $conn) or die ("<script language='JavaScript'>
							alert('Maaf Data tidak bisa diupdate ke dalam Database (insert file), Ada kesalahan!');
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
		alert('Maaf Data tidak bisa diupdate ke dalam Database (kode ID not found), Ada kesalahan!');
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
				<input type="hidden" name="kode_cso_maintenance" value="KCM-'.rand(000000,999999).'">    
                                    <div class="box-body">
				    
				    
                                        <div class="form-group">
					<div class="row">';
				    $content.=' <div class="col-xs-2">
						<label>User ID</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="user_id" value="'.(isset($_GET['c']) ? $row["user_id"] : '').'">
						<input type="hidden" readonly="" class="form-control" required="" name="kode_jadwal_pasang_fo" value="JPF-'.rand(000000, 999999).'">
					    </div>
					    <div class="col-xs-2">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" required="" name="nama" value="'.(isset($_GET['c']) ? $row["nama"] : '').'">
					    </div>';
					    //'.(isset($_GET['c']) ? $row["kode_cabang"] : "CAB-".rand(0000000, 9999999) ).'
					$content .= '
					  
                                        </div>
					</div>
					
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-12">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-12">
						<textarea  class="form-control" name="alamat" >'.(isset($_GET['c']) ? $row["alamat"] : '').'</textarea>
						</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Tanggal</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" id="datepicker" class="form-control" name="tanggal" value="'.(isset($_GET['c']) ? $row["tanggal"] : '').'">
					    </div>
					    <div class="col-xs-2">
						<label>Time Slot</label>
					    </div>
						<div class="col-xs-1">
						<select class="form-control" name="time_slot_h">';
						    $array_h = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
						    foreach($array_h as $out_h){
							$content .= '<option value="'.$out_h.'">'.$out_h.'</option>';
						    }
						$content .= '
						</select>
						</div>
					    <div class="col-xs-1">
						<select  class="form-control" name="time_slot_i">';
						    $array_i = array("00", "05", "10", "15", "20", "25", "30", "35", "40", "45", "50", "55");
						    foreach($array_i as $out_i){
							$content .= '<option value="'.$out_i.'">'.$out_i.'</option>';
						    }
						$content .= '
						</select>
						</div>
					    <div class="col-xs-1">
						<select  class="form-control" name="time_slot_p">';
						    $array_p = array("AM", "PM");
						    foreach($array_p as $out_p){
							$content .= '<option value="'.$out_p.'">'.$out_p.'</option>';
						    }
						$content .= '
						</select>
						
					    </div>
					    <div class="col-xs-1"></div>
					</div>
					</div>
										
					    
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Teknisi</label>
					    </div>
					    <div class="col-xs-4">
						<select name="teknisi" class="form-control">
						<option value="">Pilih Teknisi</option>';
						$array_tim = array("Tim 1", "Tim 2", "Tim 3");
						foreach($array_tim as $data_tim){
						    $content .= '<option value="'.$data_tim.'">'.$data_tim.'</option>';
						}    
						$content .= '
						</select>
						<!--<input type="text"  class="form-control" name="teknisi" value="'.(isset($_GET['c']) ? $row["teknisi"] : '').'">-->
					    
					    </div>
					    <div class="col-xs-2">
						<label>Status</label>
					    </div>
					    <div class="col-xs-4">
						<select name="status" class="form-control">
						<option value="">Pilih Status</option>';
						$array_status = array("Check-in", "Check-out", "Delay", "Cleared", "Uncleared", "OTW", "Pending", "N/A");
						foreach($array_status as $data_status){
						    $content .= '<option value="'.$data_status.'">'.$data_status.'</option>';
						}    
						$content .= '
						</select>
						<!--<input type="text"  class="form-control" name="status" value="'.(isset($_GET['c']) ? $row["status"] : '').'">-->
					    
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Pekerjaan</label>
					    </div>
					    <div class="col-xs-4">
						<select name="pekerjaan" class="form-control">
						<option value="">Pilih Pekerjaan</option>';
						$array_pekerjaan = array("Penarikan Kabel", "Penyambungan", "Aktivasi");
						foreach($array_pekerjaan as $data_pekerjaan){
						    $content .= '<option value="'.$data_pekerjaan.'">'.$data_pekerjaan.'</option>';
						}    
						$content .= '
						</select>
						<!--<input type="text" class="form-control" name="pekerjaan" value="'.(isset($_GET['c']) ? $row["pekerjaan"] : '').'">-->
					    </div>	
					</div>
					</div>
					

					<div class="form-group">
					<div class="row">
						
					    <div class="col-xs-12">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-12">
						<textarea  class="form-control" name="keterangan" >'.(isset($_GET['c']) ? $row["keterangan"] : '').'</textarea>
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

                </section><!-- /.content -->';

$plugins = '<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
            });
        </script>
	<!-- datepicker -->
        <script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        
        <script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                
            });
        </script>
	<script src="'.URL.'js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
        
        <script>
            $(\'[id=harga]\').priceFormat({
		prefix: \'\',
		thousandsSeparator: \',\',
		centsLimit: 0
	    });
        </script>
		
		<script language="javascript">
			var abc = 0;      // Declaring and defining global increment variable.
			$(document).ready(function() {
			//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
				$(\'#add_more\').click(function() {
					$(this).before($("<div/>", {
						id: \'filediv\'
					}).fadeIn(\'slow\').append($("<input/>", {
						name: \'file[]\',
						type: \'file\',
						id: \'file\'
					}), $("")));
				});
			// Following function will executes on change event of file input to select different file.
				$(\'body\').on(\'change\', \'#file\', function() {
					if (this.files && this.files[0]) {
						abc += 1; // Incrementing global variable by 1.
						var z = abc - 1;
						var x = $(this).parent().find(\'#previewimg\' + z).remove();
						$(this).before("<div id=\'abcd" + abc + "\' class=\'abcd\'><img id=\'previewimg" + abc + "\' src=\'\'/></div>");
						var reader = new FileReader();
						reader.onload = imageIsLoaded;
						reader.readAsDataURL(this.files[0]);
						$(this).hide();
						$("#abcd" + abc).append($("<img/>", {
							id: \'img\',
							src: \''.URL_ADMIN.'img/x.png\',
							alt: \'delete\'
						}).click(function() {
							$(this).parent().parent().remove();
						}));
					}
				});
			// To Preview Image
				function imageIsLoaded(e) {
					$(\'#previewimg\' + abc).attr(\'src\', e.target.result);
				};
				$(\'#upload\').click(function(e) {
					var name = $(":file").val();
					if (!name) {
						alert("First Image Must Be Selected");
						e.preventDefault();
					}
			});
		});
	    </script>
	    <style type="text/css">

		#img{
		width:25px;
		border:none;
		height:25px;
		margin-left:-20px;
		margin-bottom:91px
		}
		.abcd{
		width: 120px;
		float:left;
		}
		.abcd img{
		height:100px;
		width:100px;
		padding:5px;
		border:1px solid #e8debd
		}
	    </style>
	';

    $title	= $title_header;
    $submenu	= $submenu_header;
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>