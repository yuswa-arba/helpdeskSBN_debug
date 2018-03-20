<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */


include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){
// Check if they are logged in
 
 //bulan, kode, nama, tanggal, che
//SQL 
$table_main = "gx_rekap_absensi";
$table_detail = "";

//SELECT
    //SELECT `id_rekap`, `periode_awal`, `periode_akhir`, `bulan`, `kode`, `nama`, `tanggal`, `check_in`, `check_out`, `ket`, `hari`, `menit_terlambat`, `menit_pulang_awal`, `jam_lembur`, `keterangan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_rekap_absensi` WHERE 1
    $urutan = "ORDER BY `id_rekap` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_rekap_absensi` WHERE `level`='0'";
    $bulan_filter 	= isset($_POST['bulan_filter']) ? $_POST['bulan_filter'] : '';
    $kode_filter 	= isset($_POST['kode_filter']) ? $_POST['kode_filter'] : '';
    $nama_filter 	= isset($_POST['nama_filter']) ? $_POST['nama_filter'] : '';
    if($bulan_filter != '' || $kode_filter != '' || $nama_filter != ''){
	$select_all_data_valid = "SELECT * FROM `gx_rekap_absensi` WHERE `bulan` LIKE '%".$bulan_filter."%' AND `kode` LIKE '%".$kode_filter."%' AND `nama` LIKE '%".$nama_filter."%' AND `level`='0'";
    }
	
	$periode_mulai = isset($_POST['periode_mulai']) ? $_POST['periode_mulai'] : '';
	$periode_akhir = isset($_POST['periode_akhir']) ? $_POST['periode_akhir'] : '';
	//SELECT `id_rekap`, `periode_awal`, `periode_akhir`, `bulan`, `kode`, `nama`, `tanggal`, `check_in`, `check_out`, `ket`, `hari`, `menit_terlambat`, `menit_pulang_awal`, `jam_lembur`, `keterangan`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_rekap_absensi` WHERE 1
	//SELECT * FROM `objects`WHERE (date_field BETWEEN '2010-01-30 14:15:55' AND '2010-09-29 10:15:55')
	$select_all_data_valid_in_periode = "SELECT * FROM `gx_rekap_absensi` WHERE (`tanggal` BETWEEN '".$periode_mulai."' AND '".$periode_akhir."')";
    
    
//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])

//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    //$sql_update_lock 
    $table_update_lock = "gx_rekap_absensi";
    $redirect_action_lock = "rekap_absensi";
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Rekap Absensi";
    $link_form_add_data = '<a href="form_rekap_absensi.php" class="btn bg-maroon btn-flat margin">Create New</a>';
    $form_search_data = '<form action="" name="" method="POST">
    Bulan : <input type="text" name="bulan_filter" value="">
    Kode : <input type="text" name="kode_filter" value="">
    Nama : <input type="text" name="nama_filter" value="">
    <input type="submit" name="submit" value="Filter">
    </form>';
    $form_hitung_absensi = '<form action="" name="" method="POST">
    Periode : <input type="text" name="periode_mulai" value="" id="datepicker">
    sd : <input type="text" name="periode_akhir" value="" id="datepicker2">
    <input type="submit" name="periode" value="Proses"> <button onclick="javascript:history.go(-1)">Cancel</button>
    </form>';
    
    $judul_table = "Rekap Absensi";
    $data_field = array("Tanggal", "Check In", "Check Out", "KET", "Hari", "Menit Terlambat", "Menit Pulang Awal", "Jam Lembur", "Keterangan");
    $data_sql_field = array("tanggal", "check_in", "check_out", "ket", "date_add", "menit_terlambat", "menit_pulang_awal", "jam_lembur", "keterangan");
    $index_field_sql = "id_rekap";
    $unix_field_sql = "id_rekap";
    $url_form_detail = "detail_rekap_absensi";
    $url_form_edit = "form_rekap_absensi";
    
    
    //id web
    $title_header = 'Rekap Absensi';
    $submenu_header = 'rekap_absensi';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Rekap Absensi");
    global $conn;
    
if(isset($_GET["c"]) & isset($_GET["action"]))
{
    $id					= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $c					= isset($_GET['c']) ? $_GET['c'] : '';
    
    $action				= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($c != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `$table_main` SET `level`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'   WHERE `".$unix_field_sql."`='".$c."';";
	
	//echo $sql_update_lock;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: ".$redirect_action_lock);

}

    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> '.$judul_form.'
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				'.$link_form_add_data.'
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				'.$form_search_data.'
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$judul_table.'</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			';
			foreach($data_field as $field){
			    $content .= "<th>".$field."</th>";
			}
			
			$content .= '
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("".$select_all_data_valid." ".$urutan." LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query($select_all_data_valid, $conn));
    $hal		= "?";
    $no 		= $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {	
	$content .= '<tr>
			<td>'.$no.'.</td>';
			foreach($data_sql_field as $field_sql){
			    $content .= '<td>'.$row_data[$field_sql].'</td>';
			}
			
			$content .= '
			<td><a href="'.$url_form_detail.'?id='.$row_data[$unix_field_sql].'"><span class="label label-info">Detail</span></a>
					<a href="'.$url_form_edit.'?id='.$row_data[$unix_field_sql].'"><span class="label label-info">Edit</span></a>
			</td>
		    </tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>


<br />
            </div>
	    
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				'.$form_hitung_absensi.'
				</div>
			    </div>
			    
			    
<div class="box">
   <div class="box-header">
                                    <h3 class="box-title">'.$judul_table.'</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			';
			foreach($data_field as $field){
			    $content .= "<th>".$field."</th>";
			}
			
			$content .= '
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("".$select_all_data_valid_in_periode." ".$urutan." LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query($select_all_data_valid_in_periode, $conn));
    $hal		= "?";
    $no 		= $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {	
	$content .= '<tr>
			<td>'.$no.'.</td>';
			foreach($data_sql_field as $field_sql){
			    $content .= '<td>'.$row_data[$field_sql].'</td>';
			}
			
			$content .= '
			<td><a href="'.$url_form_detail.'?id='.$row_data[$unix_field_sql].'"><span class="label label-info">Detail</span></a>
					<a href="'.$url_form_edit.'?id='.$row_data[$unix_field_sql].'"><span class="label label-info">Edit</span></a>
			</td>
		    </tr>';
	$no++;
    }
    
/*
$sql_rekap_periode = "SELECT SUM(  `menit_terlambat` ) AS  `menit_terlambat` , SUM(  `menit_pulang_awal` ) AS  `menit_pulang_awal` , SUM(  `jam_lembur` ) AS  `jam_lembur` , SUM(  `hari_lembur` ) AS  `hari_lembur` , SUM( IF(  `status` =  'cuti', 1, 0 ) ) AS `total_cuti` , SUM( IF(  `status` =  'absen', 1, 0 ) ) AS  `total_absen` , SUM( IF(  `status` =  'lembur', 1, 0 ) ) AS `total_lembur` 
FROM  `gx_rekap_absensi` WHERE  `level` = '0' ORDER BY  `id_rekap` ASC";
*/

$sql_rekap_periode = "SELECT SUM(  `menit_terlambat` ) AS  `menit_terlambat` , SUM(  `menit_pulang_awal` ) AS  `menit_pulang_awal` , SUM(  `jam_lembur` ) AS  `jam_lembur`, SUM( IF(  `status` =  'cuti', 1, 0 ) ) AS `total_cuti` , SUM( IF(  `status` =  'absen', 1, 0 ) ) AS  `total_absen` , SUM( IF(  `status` =  'lembur', 1, 0 ) ) AS `total_lembur` 
FROM  `gx_rekap_absensi` WHERE  `level` = '0' ORDER BY `id_rekap` ASC";

$data_rekap_periode = mysql_fetch_array(mysql_query($sql_rekap_periode, $conn));
$content .='</tbody>
</table>
Menit Terlambat : '.$data_rekap_periode['menit_terlambat'].'<br/>
Menit Pulang Awal : '.$data_rekap_periode['menit_pulang_awal'].'<br/>
Jam Lembur : '.$data_rekap_periode['jam_lembur'].'<br/>
Hari Lembur : '.$data_rekap_periode['total_lembur'].'<br/>
Cuti : '.$data_rekap_periode['total_cuti'].'<br/>
Absen : '.$data_rekap_periode['total_absen'].'<br/>


</div>
</div>



			</div>
		    </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
	<script src="'.URL.'js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script>
            $(function() {
                $("#datepicker").datepicker({format: "yyyy-mm-dd"});
                 $("#datepicker2").datepicker({format: "yyyy-mm-dd"});
            });
        </script>
';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>