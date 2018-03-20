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
include ("../../config/configuration_tv.php");
//include ("config/configuration_ott.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Log");
    global $conn;
		$conn_ott   = DB_TV();
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }

$content = '<!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th width="3%">No.</th>
					<th>Date</th>
					<th>Activity</th>
					<th>Menu</th>
					<th>User</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysqli_query($conn_ott, "SELECT * FROM `ott_log` ORDER BY `createDate` DESC LIMIT $start, $perhalaman;");
    $sql_total_data	= mysqli_num_rows(mysqli_query($conn_ott, "SELECT * FROM `ott_log`;"));
    $hal			= "?";
    $no = $start + 1;

    while($row_data = mysqli_fetch_array($sql_data))
    {
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["createDate"].'</td>
			<td>'.$row_data["logContext"].'</td>
			<td>'.$row_data["menuName"].'</td>
			<td>'.$row_data["userName"].'</td>
			
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
</div>

	    <div class="box-footer">
		<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'log';
    $submenu	= "log";
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