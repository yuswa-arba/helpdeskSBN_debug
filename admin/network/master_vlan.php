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
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">List Link Budget</h3>
				    <a href="'.URL_ADMIN.'network/form_uploadvlan" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th>IP VLAN</th>
                                                <th>USERID</th>
                                                <th>Keterangan</th>
                                                <th>Flag</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
										
$sql_data		= mysql_query("SELECT * FROM `gx_master_vlan` WHERE `level` =  '0' LIMIT $start, $perhalaman;", $conn);
$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_vlan` WHERE `level` =  '0';", $conn));
$hal		= "?";

$no = 1;
while ($row_data= mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.long2ip($row_data['ip_vlan']).'</td>
		    <td>'.$row_data['keterangan_vlan'].'</td>
		    <td>'.$row_data['userid_vlan'].'</td>
		    <td>'.$row_data['flag_vlan'].'</td>
		    <td align="center">
				<a href="form_vlan?id='.$row_data['id_vlan'].'"><span class="label label-info">Edit</span></a>
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
			</div>
			</div><!-- /.box -->
		</div>
	</div>

</section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Master IP VLAN';
    $submenu	= "master_vlan";
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