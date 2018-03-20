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
        $id_group = array();
        $id_group = isset($_POST["id_group"]) ? $_POST["id_group"] : $id_group;
        
        foreach($id_group as $key => $value)
        {
            $query = "UPDATE `gx_user_group` SET `level` = '1', `user_update` = '".$loggedin["username"]."', `date_upd` = NOW()
                    WHERE `id_group` = '".$value."';";
            //echo $query;
	    $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'system/group.php');
    }
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
							<!--<div class="box">
								<div class="box-body">
                                    <a href="'.URL_ADMIN.'system/user.php" class="btn btn-success">User</a>
									<a href="'.URL_ADMIN.'system/group.php" class="btn btn-warning">Group</a>
				    
                                </div>
							</div>-->
			    ';
					


    $username		= isset($_POST["username"]) ? trim(strip_tags($_POST["username"])) : "";
    
    $sql_group = mysql_query("SELECT `group_nama`, `id_group`, `group_desc`
				  FROM `gx_user_group`
				  WHERE `level` = '0'
				  ORDER BY `id_group` ASC;",$conn);
    
$content .='		<div class="box">
			<form method ="POST" action="">
				<div class="box-header">
                                    <h2 class="box-title">List Group</h2>
                                </div>
				
				<div class="box-body">
				    <a href="'.URL_ADMIN.'system/form_group_role.php" class="btn btn-success">Create Group</a><br><br>
				    <table id="usergroup" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No.</th>
                                                <th>Nama Group</th>
						<th>Deskripsi</th>
                                                <th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$no = 1;
while ($row_group = mysql_fetch_array($sql_group))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_group["group_nama"].'</td>
		    <td>'.$row_group["group_desc"].'</td>
		    <td><a href="'.URL_ADMIN.'system/group_role.php?id_group='.$row_group["id_group"].'">View Role</a> | <a href="'.URL_ADMIN.'system/form_group_role.php?id='.$row_group["id_group"].'">Edit</a></td>
		    <td><input type="checkbox" name="id_group[]" value="'.$row_group["id_group"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
				<div class="box-footer">
                                    <!--<button type="submit" name="hapus" class="btn btn-primary">Hapus</button>-->
                                </div>
				</form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#usermanagement\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
	
    ';

    $title	= 'User Group';
    $submenu	= "system_user";
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