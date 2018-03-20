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
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List OLT server");
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Server OLT</h3>
                                    
                                </div>
                                <div class="box-body table-responsive">

                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Server</th>
                                                <th>IP Address</th>
												<th>Group</th>
                                                <th>Deskripsi</th>
												<th>Version</th>
                                                <th>Last Update</th>
						<th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_search		= ($search != "") ? "AND `grouptime_nama` LIKE '%$search%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listolt`, `gx_inet_listgroup`
				  WHERE `gx_inet_listolt`.`group_server` = `gx_inet_listgroup`.`id_inet_listgroup`
				  AND `level` = '0'
                                  $sql_search
				  ORDER BY `nama_server` ASC LIMIT 0,10;", $conn);
}else{
    $sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listolt`, `gx_inet_listgroup`
				 WHERE `gx_inet_listolt`.`group_server` = `gx_inet_listgroup`.`id_inet_listgroup`
				  AND `level` = '0' ORDER BY `group_server` ASC, `nama_server` ASC;", $conn);
}

$no = 1;
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["nama_server"].'</td>
		    <td>'.($row_server_ras["ip_address"]).'</td>
			<td>'.($row_server_ras["nama_inet_listgroup"]).'</td>
		    <td>'.$row_server_ras["desc_server"].'</td>
			<td>'.$row_server_ras["version_server"].'</td>
		    <td>'.$row_server_ras["date_upd"].' <br>by '.$row_server_ras["user_upd"].'</td>
		    <td align="center"><a href="detail_olt?id='.$row_server_ras["id_server"].'">Detail Customer</a></td>
                   
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List IP Address Default VM';
    $submenu	= "inet_ipvm";
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