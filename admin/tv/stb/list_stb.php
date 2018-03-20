<?php
/*
 * Theme Name: Helpdesk Bali
 * Website: http://globalxtreme.net/
 * Author: GlobalXtreme.net
 * Version: 1.0  | 1 Januari 2013
 * Email: adit@globalxtreme.net
 * Theme for http://202.58.203.29/~helpdesk
 */

include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Master STB");
    global $conn;
    
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
				<div class="box-body">
				    <a href="form_stb.php" class="btn bg-maroon btn-flat margin">Add STB</a>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
                        <div class="col-xs-12">
                                                    
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data STB</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

 <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
			<th width="3%">No.</th>
			<th>Kode STB</th>
			<th>SN</th>
			<th>MAC</th>
			<th>status</th>
			<th width="25%">Action</th>
                  </tr>
                </thead>
                <tbody>';
//select data

    $sql_data		= mysql_query("SELECT * FROM `gx_tv_stb` WHERE `level` = '0' ORDER BY `kode_stb` LIMIT $start, $perhalaman;", $conn);
    $sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_tv_stb` WHERE `level` =  '0';", $conn));
    $hal		= "?";
    $no = $start + 1;

    while($row_data = mysql_fetch_array($sql_data))
    {
	$sql_data_cek	= "SELECT * FROM `gx_tv_stb_check` WHERE `id_stb` = '".$row_data["id_stb"]."';";
    $query_data_cek	= mysql_query($sql_data_cek, $conn);
    $row_data_cek	= mysql_fetch_array($query_data_cek);
	
	if($row_data_cek["check"] == "0"){
		$status		= "Ok";
		$link		= "&id_cek=".$row_data_cek["id_check"]."";
	}elseif($row_data_cek["check"] == "1"){
		$status		= "Not Ok";
		$link		= "&id_cek=".$row_data_cek["id_check"]."";
	}else{
		$status		= "";
		$link		="";
	}
	$content .='<tr>
			<td>'.$no.'.</td>
			<td>'.$row_data["kode_stb"].'</td>
			<td>'.$row_data["sn"].'</td>
			<td>'.$row_data["mac"].'</td>
			<td>'.$status.'</td>
			<td><a href="detail_stb.php?id='.$row_data["id_stb"].'" onclick="return valideopenerform(\'detail_stb.php?id='.$row_data["id_stb"].'\',\'stb\');">Details</a>  ||
			<a href="form_stb.php?id='.$row_data["id_stb"].'">edit</a> || <a href="form_stb_cek.php?id='.$row_data["id_stb"].''.$link.'">Check Status</a></td>
		</tr>';
	$no++;
    }

$content .='</tbody>
</table>
<br />
<div class="box-tools pull-right">
		'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
		</div>
		<br />
</div>
<br />
            </div>
			
	    <div class="box-footer">
		
		<br style="clear:both;">
	     </div>
       </div>';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master STB';
    $submenu	= "stb";
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