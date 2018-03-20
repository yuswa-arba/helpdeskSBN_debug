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
    
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List Switch server");
    
    if(isset($_POST["hapus"]))
    {
        $id_server = array();
        $id_server = isset($_POST["id_server"]) ? $_POST["id_server"] : $id_server;
        
        foreach($id_server as $key => $value)
        {
            $query = "UPDATE `software`.`gx_switch_port` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_port` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'data/list_server_switch.php');
    }
    
if(isset($_GET["id"])){
    $id_switch		= isset($_GET["id"]) ? (int)$_GET["id"] : "";
    
    $sql_server_ras = mysql_query("SELECT * FROM `software`.`v_switch_port` WHERE `id_switch`='".$id_switch."' AND `level` = '0' ORDER BY `id_port` ASC;", $conn);
}

    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Port Switch</h3>
                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <div>
                                        <a href="'.URL_ADMIN.'data/form_switch_port">New Data</a>
                                    </div><br>
                                
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Server Switch</th>
												<th>Type Server</th>
												<th>Nama Server</th>
                                                <th>Port Interface</th>
												<th>Action</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';


$no = 1;
while ($row_server_ras = mysql_fetch_array($sql_server_ras))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.($row_server_ras["nama_switch"]).'</td>
			<td>'.(($row_server_ras["id_olt"] == NULL) ? "Server ESX" : "Server OLT").'</td>
			<td>'.(($row_server_ras["nama_olt"] == NULL) ? $row_server_ras["nama_esx"] : $row_server_ras["nama_olt"]).'</td>
			<td>'.($row_server_ras["interface_port"]).'</td>
		    <td align="center">
			
			<a href="form_switch_port?id='.$row_server_ras["id_port"].'">Update</a></td>
                    <td><input type="checkbox" name="id_server[]" value="'.$row_server_ras["id_port"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <button type="submit"  name="hapus" class="btn btn-primary">Hapus</button>
                                </div>
                            </div><!-- /.box -->
                            </form>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    
                </section><!-- /.content -->

            ';

	$plugins = '';

    $title	= 'List Server Switch';
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