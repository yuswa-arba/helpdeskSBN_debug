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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open link_budget");
    global $conn;
    
	
	$perhalaman = 20;
	if (isset($_GET['page'])){
		$page = (int)$_GET['page'];
		$start=($page - 1) * $perhalaman;
	}else{
		$start=0;
	}
	
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                
				
				<div class="box-header">
                                    <h3 class="box-title">List Data</h3>
				    <a href="'.URL_ADMIN.'network/form_uploadip.php" class="btn bg-olive btn-flat margin pull-right">Import Data</a>
                                </div><!-- /.box-header -->
								<div class="box-body table-responsive">
								
								<form action="" method="post" name="form_search">
				    
					<div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>IP Address:</label>
					</div>
					<div class="col-xs-4">
					    
						<input type="text" class="form-control" data-inputmask="\'alias\': \'ip\'" data-mask="" name="ip_address" value="">
					</div>
					
				    </div>
				    </div>
					
					<div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>USERID :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="userid" placeholder="USERID">
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
	
	<a href="form_vlan" class="btn bg-olive btn-flat margin pull-right">Create New</a><br><br>';
	
if(isset($_POST["search"])){
    $ip_address		= isset($_POST["ip_address"]) ? trim(strip_tags($_POST["ip_address"])) : "";
	$userid		= isset($_POST["userid"]) ? trim(strip_tags($_POST["userid"])) : "";
	
    $sql_vlanid		= ($ip_address != "") ? "AND `ip_address` = '".ip2long($ip_address)."'" : "";
	$sql_userid		= ($userid != "") ? "AND `userid_ip` LIKE '%$userid%'" : "";
    
    
    $id_ippool		= isset($_GET['id']) ? (int)$_GET['id'] : '';
	$sql_ippool		= ($id_ippool != "") ? "`id_ippool` ='$id_ippool' AND" : "";
	$sql_data		= mysql_query("SELECT * FROM `gx_master_ip`
								  WHERE $sql_ippool `level` =  '0'
								  $sql_vlanid
								  $sql_userid
								  LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_ip`
												 WHERE $sql_ippool `level` =  '0'
												  $sql_vlanid
												$sql_userid;", $conn));
	$hal		= isset($_GET['id']) ? "?id=$id_ippool&" : "?";
						
}else{
	$id_ippool		= isset($_GET['id']) ? (int)$_GET['id'] : '';
	$sql_ippool		= ($id_ippool != "") ? "`id_ippool` ='$id_ippool' AND" : "";
	$sql_data		= mysql_query("SELECT * FROM `gx_master_ip` WHERE $sql_ippool `level` =  '0' LIMIT $start, $perhalaman;", $conn);
	$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_ip` WHERE $sql_ippool `level` =  '0';", $conn));
	$hal		= isset($_GET['id']) ? "?id=$id_ippool&" : "?";

}

$content .='
								
								
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>IP Address</th>
                                                <th>Service Name</th>
												<th>USERID</th>
												<th>Type</th>
                                                <th>Keterangan</th>
                                                <th>Flag</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';



$no = 1;
while ($row_data= mysql_fetch_array($sql_data))
{
	$sql_data_pool	= mysql_query("SELECT * FROM `gx_master_ip_pool` WHERE `id_ip` ='".$row_data["id_ippool"]."' AND `level` =  '0' LIMIT 0,1;", $conn);
	$row_data_pool	= mysql_fetch_array($sql_data_pool);


    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.long2ip($row_data['ip_address']).'</td>
			<td>'.$row_data_pool['service_name'].'</td>
		    
		    <td>'.$row_data['userid_ip'].'</td>
		    <td>'.$row_data['type_ip'].'</td>
			<td>'.$row_data['keterangan_ip'].'</td>
			<td>'.$row_data['flag_ip'].'</td>
		    <td align="center">
				<a href="form_ip.php?id='.$row_data['id_ip'].'"><span class="label label-info">Edit</span></a>
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
					</tbody>
				</table> 

			</div><!-- /.box-body -->
			<div class="box-footer">
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

    $title	= 'Master IP Address';
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