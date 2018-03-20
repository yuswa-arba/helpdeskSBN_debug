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

    $title_header = 'Master Pegawai fingerspot';
    $submenu_header = 'master_pegawai';
    
    
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master pegawai");
    global $conn;
 

    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '    <!-- Main content -->
                <section class="content">
		   
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">LIST DATA</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>PIN</th>
			<th>NIP</th>
			<th>NAMA</th>
			<th>TELP</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `fingerspot`.`pegawai` LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `fingerspot`.`pegawai`;", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
		$sql_staff		= mysql_query("SELECT * FROM `gx_pegawai` WHERE `gx_pegawai`.`pin_ftm` = '".$row_data['pegawai_pin']."' LIMIT 0,1;", $conn);
		$row_staff		= mysql_fetch_array($sql_staff);
    
	
		$content .= '<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data['pegawai_pin'].'</td>
			<td>'.$row_data['pegawai_nip'].'</td>
			<td><a href="'.URL_ADMIN.'master/detail_staff.php?id='.$row_staff["id_employee"].'" target="_target">'.$row_data['pegawai_nama'].'</a></td>
			<td>'.$row_data['pegawai_telp'].'</td>
			
			<td><a href="att_log_ftm.php?id='.$row_data['pegawai_pin'].'"><span class="label label-info">Detail Log</span></a>
			</td>
		    </tr>';
		$no++;
    }

$content .='</tbody>
</table>
</div>
<br />
	    <div class="box-footer">
		<div class="box-tools pull-right">
			'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>
	</section>';

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