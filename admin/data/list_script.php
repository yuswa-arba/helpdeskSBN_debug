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
            $query = "UPDATE `gx_inet_esx` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
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
                                    
                                </div>
                                <div class="box-body table-responsive">
                                    <div>
                                        <a href="'.URL_ADMIN.'data/form_server_esx">New ESX Server</a>
                                    </div><br>
                                
                                <table class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama</th>
                                                <th>Script</th>
						<th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_search		= ($search != "") ? "AND `grouptime_nama` LIKE '%$search%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `gx_inet_esx`, `gx_inet_listgroup`
				  WHERE `gx_inet_esx`.`group_server` = `gx_inet_listgroup`.`id_inet_listgroup`
				  AND `level` = '0'
                                  $sql_search
				  ORDER BY `nama_server` ASC LIMIT 0,10;", $conn);
}else{
    $sql_data = mysql_query("SELECT * FROM `gx_inet_olt_script`;", $conn);
}

$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
	
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["nama_script"].'</td>
		    <td>'.nl2br(substr($row_data["script"],0,100)).' ...</td>
		    <td align="center"><a href="form_script?id='.$row_data["id_script"].'">Update</a></td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
                                    
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    
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