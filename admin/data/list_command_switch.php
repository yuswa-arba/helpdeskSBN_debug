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
    
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],"Open Menu List Profile Command Switch");
    
    if(isset($_POST["hapus"]))
    {
        $id_cmd = array();
        $id_cmd = isset($_POST["id_cmd"]) ? $_POST["id_cmd"] : $id_cmd;
        
        foreach($id_cmd as $key => $value)
        {
            $query = "UPDATE `gx_inet_command_switch` SET `level` = '1', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_cmd` = '".$value."';";
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'data/list_command_switch.php');
    }
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Profile Command Switch</h3>
                                    <div class="box-tools pull-right">
                                        <div class="btn bg-olive btn-flat margin">
                                             <a href="'.URL_ADMIN.'data/list_command.php">Profile CMD RAS Server</a>
                                        </div>
                                        <div class="btn bg-olive btn-flat margin">
                                             <a href="'.URL_ADMIN.'data/list_command_olt.php">Profile CMD OLT Server</a>
                                        </div>
                                        <div class="btn bg-olive btn-flat margin">
                                             <a href="'.URL_ADMIN.'data/list_command_switch.php">Profile CMD Switch Server</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <div>
                                        <a href="'.URL_ADMIN.'data/form_command_switch.php">New command</a>
                                    </div><br>
                                
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Last Update</th>
						<th>Action</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_search		= ($search != "") ? "AND `grouptime_nama` LIKE '%$search%'" : "";
    
    
    $sql_server_ras = mysql_query("SELECT * FROM `gx_inet_listServer`
				  WHERE `level` = '0'
                                  $sql_search
				  ORDER BY `nama_server` ASC LIMIT 0,10;", $conn);
}else{
    $sql_command = mysql_query("SELECT * FROM `gx_inet_command_switch`
				  WHERE `level` = '0' ORDER BY `id_cmd` ASC;", $conn);
}

$no = 1;
while ($row_command = mysql_fetch_array($sql_command))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_command["nama_cmd"].'</td>
		    <td>'.($row_command["desc_cmd"]).'</td>
		    <td>'.$row_command["date_upd"].' by '.$row_command["user_upd"].'</td>
		    <td align="center"><a href="form_command_switch?id='.$row_command["id_cmd"].'">Update</a></td>
                    <td><input type="checkbox" name="id_cmd[]" value="'.$row_command["id_cmd"].'"></td>
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

    $title	= 'List Command Switch';
    $submenu	= "inet_command";
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