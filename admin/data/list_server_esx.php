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
    
    if(isset($_POST["hapus"]))
    {
        $id_server = array();
        $id_server = isset($_POST["id_server"]) ? $_POST["id_server"] : $id_server;
        
        foreach($id_server as $key => $value)
        {
            $query = "UPDATE `software`.`gx_inet_esx` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_server` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'data/list_server_olt.php');
    }
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Server ESX</h3>
                                    <div class="box-tools pull-right">

                                             <a href="'.URL_ADMIN.'data/list_server_ras.php" class="btn bg-olive btn-flat margin">List RAS Server</a>
                                             <a href="'.URL_ADMIN.'data/list_server_olt.php" class="btn bg-olive btn-flat margin">List OLT Server</a>
                                             <a href="'.URL_ADMIN.'data/list_server_switch.php" class="btn bg-olive btn-flat margin">List Switch Server</a>
											 <a href="'.URL_ADMIN.'data/list_server_esx.php" class="btn bg-olive btn-flat margin">List ESX Server</a>
                                       
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <div>
                                        <a href="'.URL_ADMIN.'data/form_server_esx">New ESX Server</a>
                                    </div><br>
                                
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Server</th>
                                                <th>IP Address</th>
												<th>Group</th>
												<th>Total VLAN</th>
                                                
                                                <th>Last Update</th>
						<th>Action</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_search		= ($search != "") ? "AND `grouptime_nama` LIKE '%$search%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `software`.`gx_inet_esx`, `software`.`gx_inet_listgroup`
				  WHERE `software`.`gx_inet_esx`.`group_server` = `software`.`gx_inet_listgroup`.`id_inet_listgroup`
				  AND `level` = '0'
				  AND `software`.`gx_inet_esx`.`nama_server` LIKE '%SBN%'
                                  $sql_search
				  ORDER BY `nama_server` ASC LIMIT 0,10;", $conn);
}else{
    $sql_server_ras = mysql_query("SELECT * FROM `software`.`gx_inet_esx`, `software`.`gx_inet_listgroup`
				 WHERE `software`.`gx_inet_esx`.`group_server` = `software`.`gx_inet_listgroup`.`id_inet_listgroup`
				 AND `software`.`gx_inet_esx`.`nama_server` LIKE '%SBN%'
				  AND `level` = '0' ORDER BY `group_server` ASC, `nama_server` ASC;", $conn);
}

$no = 1;
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
	//echo "SELECT COUNT(`id_vlan`) AS `total` FROM `gx_data_vlan` WHERE `id_esx` = '".$row_server_ras["id_server"]."' AND `flag_vlan` = 'aktif';<br>";
	$total_vlan = mysql_fetch_array(mysql_query("SELECT COUNT(`id_vlan`) AS `total` FROM `gx_data_vlan` WHERE `id_esx` = '".$row_server_ras["id_server"]."' AND `flag_vlan` = 'aktif';", $conn));
	
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_server_ras["nama_server"].'</td>
		    <td>'.($row_server_ras["ip_address"]).'</td>
			<td>'.($row_server_ras["nama_inet_listgroup"]).'</td>
		    <td>'.$total_vlan['total'].'</td>
		    <td>'.$row_server_ras["date_upd"].' <br>by '.$row_server_ras["user_upd"].'</td>
		    <td align="center"><a href="form_server_esx?id='.$row_server_ras["id_server"].'">Update</a></td>
                    <td><input type="checkbox" name="id_server[]" value="'.$row_server_ras["id_server"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

$plugins = '';

    $title	= 'List Server ESX';
    $submenu	= "inet_server_ras";
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