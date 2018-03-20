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
    
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
	$id_esx = isset($_GET['id_esx']) ? (int)$_GET['id_esx'] : "";
	
	
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List VLAN");
	
	$total_server_ras_all 		= mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));
	$total_server_ras_aktif 	= mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' AND `userid_vlan` != ''  AND `flag_vlan` = 'aktif' ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));
	$total_server_ras_nonaktif	= mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan` WHERE `level` = '0' AND (`userid_vlan` = '' OR `userid_vlan` IS NULL) ORDER BY `vlan` ASC, `id_esx` ASC;", $conn));

    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List VLAN</h3>
                                    
                                </div>
                                <div class="box-body">
                                    ';
	
if(isset($_GET["q"])){
    $vlan		= isset($_GET["q"]) ? trim(strip_tags($_GET["q"])) : "";
    
    if($vlan == "aktif")
	{
		$sql_server_ras = mysql_query("SELECT * FROM `v_esx_vlan`
									WHERE `level` = '0'
									AND `userid_vlan` != ''  AND `flag_vlan` = 'aktif'
									
									ORDER BY `vlan` ASC LIMIT $start, $perhalaman;", $conn);
		$total_server_ras = mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan`
													   WHERE `level` = '0'
													   AND `userid_vlan` != ''  AND `flag_vlan` = 'aktif' 
														ORDER BY `vlan` ASC;", $conn));
		
	}
	elseif($vlan == "nonaktif")
	{
		$sql_server_ras = mysql_query("SELECT * FROM `v_esx_vlan`
								WHERE `level` = '0'
								AND (`userid_vlan` = '' OR `userid_vlan` IS NULL) 
								
								ORDER BY `vlan` ASC LIMIT $start, $perhalaman;", $conn);
		$total_server_ras = mysql_num_rows(mysql_query("SELECT * FROM `v_esx_vlan`
												   WHERE `level` = '0'
												   AND (`userid_vlan` = '' OR `userid_vlan` IS NULL) 
													ORDER BY `vlan` ASC;", $conn));
		
									
	}
	$hal = '?q='.$vlan.'&';
}

$content .='<table class="table table-hover table-border  table-responsive">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>UserID</th>
												<th>VLAN ID</th>
												<th>Mac Address</th>
                                                <th>Server ESX</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = $start + 1;
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["userid_vlan"].'</td>
			<td>'.$row_server_ras["vlan"].'</td>
			<td>'.$row_server_ras["mac_address"].'</td>
			<td>'.$row_server_ras["nama_server"].'</td>
			<td>'.$row_server_ras["flag_vlan"].'</td>
			<td><a href="form_vlan.php?id='.$row_server_ras['id_vlan'].'"><span class="label label-info">Edit</span></a></td>
		</tr>';
		$no++;
}


$content .= '
                                        </tbody>
                                    </table>

                                    
                                </div><!-- /.box-body-->
								<div class="box-footer">
									<div class="box-tools pull-right">
									'.(halaman($total_server_ras, $perhalaman, 1, $hal)).'
									</div>
									<br style="clear:both;">
								</div>
                                
                            </div><!-- /.box -->
                            
							</form>
							 </div><!-- /.col -->
                    </div><!-- /.row -->
							
	
                    
                </section><!-- /.content -->
            ';
	
$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List Data VLAN';
    $submenu	= "";
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