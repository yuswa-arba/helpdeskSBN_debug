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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master Lemari");
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
				<div class="box-body">
				    <a href="form_lemari.php" class="btn bg-maroon btn-flat margin">Add Lemari</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Lemari</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Kode Lemari</th>
			<th>Nama</th>
			<th>Ruang</th>
			<th width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_lemari` WHERE `level` =  '0' LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_lemari` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_lemari"].'</td>
			<td>'.$row_data["nama_lemari"].'</td>
			<td>'.$row_data["nama_ruang"].'</td>
			<td><a href="detail_lemari.php?id='.$row_data["id_lemari"].'" onclick="return valideopenerform(\'detail_lemari.php?id='.$row_data["id_lemari"].'\',\'satuan\');">Details</a>  ||
			<a href="form_lemari.php?id='.$row_data["id_lemari"].'">edit</a></td>
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
       </div>
	   </section>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master Lemari';
    $submenu	= "master_lemari";
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