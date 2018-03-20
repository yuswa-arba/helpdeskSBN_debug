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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Mata Uang");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '

                <!-- Main content -->
                <section class="content">
		    

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Status Kolektibilitas</h3>
									<div class="pull pull-right">
										<a href="form_status.php" class="btn bg-maroon btn-flat margin">Add Status</a>
									</div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Nama</th>
			<th>Hari</th>
			<th>Keterangan</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT `gx_status_collect`.* FROM `gx_status_collect` WHERE `level` =  '0' LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_status_collect` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["nama_status"].'</td>
			<td>'.$row_data["tgl1"].' - '.$row_data["tgl2"].'</td>
			<td>'.$row_data["keterangan"].'</td>
			<td><a href="detail_status.php?id='.$row_data["id_status"].'" onclick="return valideopenerform(\'detail_status.php?id='.$row_data["id_status"].'\',\'status\');">Details</a>  ||
			<a href="form_status.php?id='.$row_data["id_status"].'">edit</a></td>
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

    $title	= 'Status Kolektibilitas';
    $submenu	= "Master";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
    
}
    }else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>