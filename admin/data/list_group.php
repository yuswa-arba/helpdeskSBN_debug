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
    if(isset($_POST["hapus"]))
    {
        $id_grouptime = array();
        $id_grouptime = isset($_POST["id_grouptime"]) ? $_POST["id_grouptime"] : $id_grouptime;
        
        foreach($id_grouptime as $key => $value)
        {
            $sql_update = mysql_query("UPDATE `gx_inet_grouptime` SET `level` = '1', `date_upd` = NOW() WHERE `id_grouptime` = '".$value."';", $conn) or die (mysql_error());
        }
        header("location:list_group.php");
    }
    
    $content ='<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- interactive chart -->
                            <form method ="POST" action="">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">List Group Time</h3>
                                    <div class="box-tools pull-right">
                                        
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <div>
                                        <a href="'.URL_ADMIN.'data/form_group">New Group</a>
                                    </div><br>
                                
                                <table class="table table-hover table-border">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Time Part</th>
                                                <th>Last Update</th>
						<th>Action</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
if(isset($_POST["search"])){
    $search		= isset($_POST["nama"]) ? trim(strip_tags($_POST["nama"])) : "";
    
    $sql_search		= ($search != "") ? "AND `grouptime_nama` LIKE '%$search%'" : "";
    
    
    $sql_grouptime = mysql_query("SELECT * FROM `gx_inet_grouptime`
				  WHERE `level` = '0'
                                  $sql_search
				  ORDER BY `id_grouptime` ASC LIMIT 0,10;", $conn);
}else{
    $sql_grouptime = mysql_query("SELECT * FROM `gx_inet_grouptime`
				  WHERE `level` = '0' ORDER BY `id_grouptime` ASC;", $conn);
}

$no = 1;
while ($row_grouptime = mysql_fetch_array($sql_grouptime))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_grouptime["grouptime_nama"].'</td>
		    <td>'.$row_grouptime["grouptime_desc"].'</td>
		    <td>'.$row_grouptime["grouptime_part"].'</td>
		    <td>'.$row_grouptime["date_upd"].' by '.$row_grouptime["user_upd"].'</td>
		    <td align="center"><a href="detail_group?id='.$row_grouptime["id_grouptime"].'">Detail</a> | 
                    <a href="form_group?id='.$row_grouptime["id_grouptime"].'">Update</a></td>
                    <td><input type="checkbox" name="id_grouptime[]" value="'.$row_grouptime["id_grouptime"].'"></td>
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

    $title	= 'List GroupTime';
    $submenu	= "inet_grouptime";
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