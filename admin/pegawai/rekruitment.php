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
$table_main = "gx_rekruitment";
$table_detail = "";

//SELECT
    //
    $urutan = "ORDER BY `id_rekruitment` DESC";
    $select_all_data_valid = "SELECT * FROM `gx_rekruitment` WHERE `level`='0'";

//INSERT 
    //INSERT INTO 

//UPDATE
    //UPDATE 
    //$sql_update_lock 
    $table_update_lock = "gx_rekruitment";
    $redirect_action_lock = "rekruitment";
    
//DELETE
    //DELETE FROM `gx_kontrak` WHERE `id`


//String Data View
    //Judul Form
    $judul_form = "Rekruitment";
    $link_form_add_data = '<a href="form_rekruitment.php" class="btn bg-maroon btn-flat margin">Create New</a>';
    $judul_table = "List Data Rekruitment";
    $data_field = array("No Rekruitment", "Nama Calon Pegawai", "Alamat", "No Telp", "Bagian yang diinginkan", "Informasi Lamaran", "Pendidikan Terakhir");
    $data_sql_field = array("no_rekruitment", "nama_calon_pegawai", "alamat", "no_telp", "bagian_yang_diinginkan", "informasi_lamaran", "pendidikan_terakhir");
    $index_field_sql = "id_rekruitment";
    $unix_field_sql = "id_rekruitment";
    $url_form_detail = "detail_rekruitment";
    $url_form_edit = "form_rekruitment";
    
    
    //id web
    $title_header = 'Rekruitment';
    $submenu_header = 'rekruitment';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Rekruitment");
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
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>