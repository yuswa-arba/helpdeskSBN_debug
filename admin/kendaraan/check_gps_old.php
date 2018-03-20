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
 
//SQL 
$table_main = "";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_kendaraan_position` WHERE `level` =  '0'";

//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])

//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    //$sql_update_lock 
    $table_update_lock = "gx_kendaraan_position";
    $redirect_action_lock = "";
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Check GPS";
    $link_form_add_data = '';
    $judul_table = "";
    //$data_field = array("Kode Asuransi", "Nama Asuransi", "Alamat", "Kota", "Email");
    //$data_sql_field = array("kode_asuransi", "nama_asuransi", "alamat", "kota", "email");
    //$index_field_sql = "id";
    //$unix_field_sql = "kode_asuransi";
    //$url_form_detail = "detail_asuransi";
    //$url_form_edit = "form_asuransi";
    
    
    //id web
    $title_header = 'Check GPS';
    $submenu_header = 'check_gps';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Check GPS");
    global $conn;
    
if(isset($_GET["id"]) & isset($_GET["action"]))
{
    $id					= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $action				= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($id_pengeluaranbarang != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `$table_main` SET `level`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'   WHERE `id`='".$id."';";
	
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
                    
                </section>';

/*		
$content .= '   <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
				'.$link_form_add_data.' 
				</div>
			    </div>
			</div>
		    </div>';
*/

		    
$content .= '
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">'.$judul_table.'</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">';

/*				
$content .= '
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
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {	
	$content .= '<tr>
			<td>'.$no.'.</td>';
			foreach($data_sql_field as $field_sql){
			    $content .= '<td>'.$row_data[$field_sql].'</td>';
			}
			
			$content .= '
			<td>'.(($row_data["level"] == "1") ? '
					<a href="'.$url_form_detail.'?c='.$row_data[$unix_field_sql].'"><span class="label label-info">Detail</span></a>'
			       :
				   '<a href="'.$url_form_detail.'?c='.$row_data[$unix_field_sql].'"><span class="label label-info">Detail</span></a>
					<a href="'.$url_form_edit.'?c='.$row_data[$unix_field_sql].'"><span class="label label-info">Edit</span></a>
					<a href="?c='.$row_data[$unix_field_sql].'&action=lock"><span class="label label-info">Lock</span></a>'
				).'
			</td>
		    </tr>';
	$no++;
    }

$content .='</tbody>
</table>';*/

$content .= '<!--<center>Tampilan Map</center>-->
<div id="googleMap" style="width:100%;height:380px;"></div>
</div>
<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">';
		
		//(halaman($sql_total_data, $perhalaman, 1, $hal))
		
		$content .= '</div>
		<br style="clear:both;">
	     </div>
       </div>';
       
$sql_position = "SELECT * FROM `gx_kendaraan_position` WHERE `level`='0' ORDER BY `id` DESC LIMIT 1";       
$query_position = mysql_query($sql_position, $conn);
$data_array_position = mysql_fetch_array($query_position);
$latitude = $data_array_position['latitude'];
$longitude = $data_array_position['longitude'];
       
$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize(){
  var mapProp = {
    center:new google.maps.LatLng('.$latitude.','.$longitude.'),
    zoom:20,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, \'load\', initialize);
</script>';

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