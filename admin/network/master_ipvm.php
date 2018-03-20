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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master IP VM");
    global $conn;
    
	if(isset($_POST["hapus"]))
    {
        $id_server = array();
        $id_server = isset($_POST["id_ip"]) ? $_POST["id_ip"] : $id_server;
        
        foreach($id_server as $key => $value)
        {
            $query = "UPDATE `gx_master_ipvm` SET `userid_ip` = '', `keterangan_ip`='',
			`flag_ip`='',
			`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
            WHERE `id_ip` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
			
        }
        header('location: '.URL_ADMIN.'network/master_ipvm.php');
    }
	
	
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
							<form method ="POST" action="">
                            
                            <div class="box">
				
                                
				
				<div class="box-header">
                                    <h3 class="box-title">List Data</h3>
				    <a href="'.URL_ADMIN.'network/form_uploadipvm.php" class="btn bg-olive btn-flat margin pull-right">Import Data</a>
                                </div><!-- /.box-header -->
								<div class="box-body table-responsive">
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>IP Address</th>
                                                <th>USERID</th>
												<th>Type</th>
                                                <th>Keterangan</th>
                                                <th>Flag</th>
						<th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
										
$sql_data		= mysql_query("SELECT * FROM `gx_master_ipvm` WHERE `level` =  '0' ORDER BY `ip_address` ASC LIMIT $start, $perhalaman;", $conn);
$sql_total_data	= mysql_num_rows(mysql_query("SELECT * FROM `gx_master_ipvm` WHERE `level` =  '0';", $conn));
$hal		= "?";

$no = 1;
while ($row_data= mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.long2ip($row_data['ip_address']).'</td>
		    
		    <td>'.$row_data['userid_ip'].'</td>
		    <td>'.$row_data['type_ip'].'</td>
			<td>'.$row_data['keterangan_ip'].'</td>
			<td>'.$row_data['flag_ip'].'</td>
		    <td align="center">
				<a href="detail_ipvm.php?id='.$row_data['id_ip'].'"><span class="label label-info">View</span></a> | 
				<a href="form_ipvm.php?id='.$row_data['id_ip'].'"><span class="label label-info">Edit</span></a>
		    </td>
			<td><input class="minimal" type="checkbox" name="id_ip[]" value="'.$row_data["id_ip"].'"></td>
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

    $title	= 'Master IP Address Akses VM';
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