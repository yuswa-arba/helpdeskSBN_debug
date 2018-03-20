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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master ONU");
    global $conn;
    
	if(isset($_POST["hapus"]))
    {
        $id_server = array();
        $id_server = isset($_POST["id_onu"]) ? $_POST["id_onu"] : $id_server;
        
        foreach($id_server as $key => $value)
        {
            $query = "UPDATE `gx_master_onu` SET `userid_onu` = '', `sn_onu`='',
			`mac_onu`='',
			`userupd_onu` = '".$loggedin["username"]."', `dateupd_onu` = NOW()
            WHERE `id_onu` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
			
        }
        header('location: '.URL_ADMIN.'network/master_onu.php');
    }
	
	
	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}
	
if(isset($_GET["u"]) OR isset($_GET["status"]))
{
	
    $userid_onu	= isset($_GET["u"]) ? trim(strip_tags($_GET["u"])) : "";
    $status_onu	= isset($_GET["status"]) ? trim(strip_tags($_GET["status"])) : "";
    
    $sql_data		= mysql_query("SELECT * FROM `gx_master_onu`
								  WHERE `userid_onu` LIKE '%".$userid_onu."%'
								  AND `status_onu` = '".$status_onu."'
								  AND `level_onu` =  '0'
								  ORDER BY `userid_onu` ASC LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu`
												 WHERE `userid_onu` LIKE '%".$userid_onu."%'
												 AND `level_onu` =  '0';", $conn));
	$hal		= "?u=$userid_onu";

}

if(isset($_POST["search"]))
{
	
    $userid_onu	= isset($_POST["userid_onu"]) ? trim(strip_tags($_POST["userid_onu"])) : "";
    
    $sql_data		= mysql_query("SELECT * FROM `gx_master_onu`
								  WHERE `userid_onu` LIKE '%".$userid_onu."%' AND `level_onu` =  '0'
								  ORDER BY `userid_onu` ASC LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu`
												 WHERE `userid_onu` LIKE '%".$userid_onu."%'
												 AND `level_onu` =  '0';", $conn));
	$hal		= "?u=$userid_onu";

}
else
{
		
	$sql_data		= mysql_query("SELECT * FROM `gx_master_onu` WHERE `level_onu` =  '0' ORDER BY `userid_onu` ASC LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu` WHERE `level_onu` =  '0';", $conn));
	$hal		= "?";
}

$sql_total_data_semua	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu` WHERE `level_onu` =  '0';", $conn));
$sql_total_data_terpasang	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu` WHERE `status_onu` = '1' AND `level_onu` =  '0';", $conn));
$sql_total_data_bongkar1	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu` WHERE `status_onu` = '2' AND `level_onu` =  '0';", $conn));
$sql_total_data_bongkar2	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu` WHERE `status_onu` = '3' AND `level_onu` =  '0';", $conn));
$sql_total_data_tes			= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_onu` WHERE `status_onu` = '4' AND `level_onu` =  '0';", $conn));

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
							<form method ="POST" action="">
                            
                            <div class="box">
								<div class="box-header">
                                    <h2 class="box-title">Search</h2>
                                </div>
				
                                <div class="box-body">
				<form action="master_onu.php" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>UserID :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="userid_onu" type="text" placeholder="Userid">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>
                                
				<a href="master_onu.php">Total Onu = '.$sql_total_data_semua.'</a><br>
				<a href="master_onu.php">Total Onu Terpasang = '.$sql_total_data_terpasang.'</a><br>
				<a href="master_onu.php">Total Onu Belum Bongkar = '.$sql_total_data_bongkar1.'</a><br>
				<a href="master_onu.php">Total Onu Sudah Bongkar = '.$sql_total_data_bongkar2.'</a><br>
				<a href="master_onu.php">Total Onu Sudah Tes = '.$sql_total_data_tes.'</a><br>
				<div class="box-header">
                                    <h3 class="box-title">List Data</h3>
				    <a href="'.URL_ADMIN.'network/form_onu.php" class="btn bg-olive btn-flat margin pull-right">Add Data</a>
                                </div><!-- /.box-header -->
								<div class="box-body table-responsive">
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th>Userid</th>
                                                <th>SN ONU</th>
												<th>MAC ADDRESS ONU</th>
                                                <th>STATUS</th>
												<th>Action</th>
												<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';


$no = $start + 1;
while ($row_data= mysql_fetch_array($sql_data))
{
	switch ($row_data['status_onu']) {
		case "1":
			$status_onu = "Terpasang";
			break;
		case "2":
			$status_onu = "belum bongkar";
			break;
		case "3":
			$status_onu = "Sudah bongkar";
			break;
		case "4":
			$status_onu = "Sudah tes";
			break;
		default:
			$status_onu = "-";
	}

    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data['userid_onu'].'</td>
		    
		    <td>'.$row_data['sn_onu'].'</td>
		    <td>'.$row_data['mac_onu'].'</td>
			<td>'.$status_onu.'</td>
		    <td align="center">
				<a href="detail_onu.php?id='.$row_data['id_onu'].'" onclick="return valideopenerform(\'detail_onu.php?id='.$row_data["id_onu"].'\',\'detail_onu\');"><span class="label label-info">View</span></a> | 
				<a href="form_onu.php?id='.$row_data['id_onu'].'"><span class="label label-info">Edit</span></a>
		    </td>
			<td><input class="minimal" type="checkbox" name="id_onu[]" value="'.$row_data["id_onu"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                            
					</tbody>
				</table> 

			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
				
				<div class="box-tools pull-right">
				
				'.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
				</div>
				<br style="clear:both;">
			</div>
			</div><!-- /.box -->
		</div>
	</div>

</section><!-- /.content -->
            ';

$plugins = '
	<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
    ';

    $title	= 'Master ONU';
    $submenu	= "master_ip";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>