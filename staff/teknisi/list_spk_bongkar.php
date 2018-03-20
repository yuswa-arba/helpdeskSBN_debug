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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
//if( checkRole($loggedin["id_group"], 'helpdesk') == "0")  { die( 'Access Denied!' );}
// Check if they are logged in
 
//SQL 
$table_main = "gx_spk_bongkar";
$table_detail = "";

//SELECT
    //SELECT `id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd` FROM `gx_kontrak` WHERE 1
    $urutan = "ORDER BY `id` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_spk_bongkar` WHERE `level`='0' AND `teknisi` = '$loggedin[username]'";

//INSERT 
    //INSERT INTO `gx_kontrak`(`id`, `kode_kontrak`, `kode_cabang`, `nama_cabang`, `kode_customer`, `nama_customer`, `lama_kontrak`, `periode_kontrak_mulai`, `periode_kontrak_akhir`, `tanggal`, `date_add`, `date_upd`, `level`, `user_add`, `user_upd`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])

//UPDATE
    //UPDATE `gx_kontrak` SET `id`=[value-1],`kode_kontrak`=[value-2],`kode_cabang`=[value-3],`nama_cabang`=[value-4],`kode_customer`=[value-5],`nama_customer`=[value-6],`lama_kontrak`=[value-7],`periode_kontrak_mulai`=[value-8],`periode_kontrak_akhir`=[value-9],`tanggal`=[value-10],`date_add`=[value-11],`date_upd`=[value-12],`level`=[value-13],`user_add`=[value-14],`user_upd`=[value-15] WHERE 1
    //$sql_update_lock 
    $table_update_lock = "gx_spk_bongkar";
    $redirect_action_lock = "master_spk_bongkar";
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Master SPK Bongkar";
    $link_form_add_data = '<a href="form_spk_bongkar.php" class="btn bg-maroon btn-flat margin">Create New</a>';
    $judul_table = "List Data SPK Bongkar";
    $data_field = array("No SPK Bongkar", "Nama Customer", "Kode Customer", "Telp", "Alamat", "Teknisi");
    $data_sql_field = array("kode_spk_bongkar", "nama_customer", "kode_customer", "telp", "alamat", "teknisi");
    $index_field_sql = "id";
    $unix_field_sql = "kode_spk_bongkar";
    
    $url_form_detail = "detail_spk_bongkar";
    $url_form_edit = "form_spk_bongkar";
    
    
    //id web
    $title_header = 'Master SPK Bongkar';
    $submenu_header = 'spk_bongkar';
    
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master SPK Bongkar");
    global $conn;
    
if(isset($_GET["c"]) & isset($_GET["action"]))
{
    $id					= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $c					= isset($_GET['c']) ? $_GET['c'] : '';
    
    $action				= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($c != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `$table_main` SET `status`='1', `date_upd` = NOW(), `user_upd` = '".$loggedin["username"]."'   WHERE `".$unix_field_sql."`='".$c."';";
	
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
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {	
	$content .= '<tr>
			<td>'.$no.'.</td>';
			foreach($data_sql_field as $field_sql){
			    $content .= '<td>'.$row_data[$field_sql].'</td>';
			}
			
			$content .= '
			<td>'.(($row_data["status"] == "1") ? '
					<a href="'.$url_form_detail.'?c='.$row_data[$unix_field_sql].'"><span class="label label-info">Detail</span></a>'
			       :
				   '<a href="'.$url_form_detail.'?c='.$row_data[$unix_field_sql].'"><span class="label label-info">Detail</span></a>
					<a href="form_jawaban_spk_bongkar?c='.$row_data[$unix_field_sql].'"><span class="label label-info">Jawab SPK</span></a>
					<a href="pdf_spk_bongkar_1.php?c='.$row_data[$unix_field_sql].'" target="_blank"><span class="label label-info">PDF 1</span></a>
					<a href="pdf_spk_bongkar_2.php?c='.$row_data[$unix_field_sql].'" target="_blank"><span class="label label-info">PDF 2</span></a>
					<!--<a href="?c='.$row_data[$unix_field_sql].'&action=lock"><span class="label label-info">Lock</span></a>-->'
				).'
			</td>
		    </tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
            </div>
	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= $title_header;
    $submenu	= $submenu_header;
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
    

    }else{
	header("location: ".URL_STAFF."logout.php");
    }

?>