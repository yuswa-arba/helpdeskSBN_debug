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
    global $conn_voip;
    
if(isset($_POST["save_role"]))
{
    $role_menu 	= array();
    $role_menu	= isset($_POST["role_menu"]) ? $_POST["role_menu"] : $role_menu;
    $id_group	= isset($_POST["id_group"]) ? trim(strip_tags($_POST["id_group"])) : "";
    
    //print_r ($role_menu);
    
    //$sql_menu = mysql_query("SELECT * FROM `gx_role_menu`", $conn);
    //delete all data first
    
    
    foreach($role_menu as $key => $value){
	//echo "Insert$key<br>";
	$sql_insert = mysql_query("INSERT INTO `gx_user_group_role` (`id_role`, `id_group`, `id_menu`)
				  VALUES (NULL, '".$id_group."', '".$key."');");

    }
    
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."system/group_role.php?id_group=".$id_group."';
	</script>";
}


$sql_menu = mysql_query("SELECT * FROM `gx_menu`
			WHERE `level` = '0'
			ORDER BY `id_menu` ASC;",$conn);

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <div class="box">
				<div class="box-body">
                                    <a href="'.URL_ADMIN.'system/user.php" class="btn btn-success">User</a>
				    <a href="'.URL_ADMIN.'system/group.php" class="btn btn-warning">Group</a>
				    
                                </div>
			    </div>
			    <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Group</h2>
                                </div>
				<form role="form"  method="POST" action="">
				<div class="box-body">
				    <table id="usergroup" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Selected</th>
						<th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

$id_group	= isset($_GET["id_group"]) ? trim(strip_tags($_GET["id_group"])) : "";

$no = 1;
while ($row_menu = mysql_fetch_array($sql_menu))
{
    
    $sql_role = mysql_query("SELECT * FROM `gx_user_group_role` WHERE `id_group` = '".$id_group."'
			    AND `id_menu` = '".$row_menu["id_menu"]."' LIMIT 0,1;", $conn);
    $total_role = mysql_numrows($sql_role);
	
	if($total_role == 1){
	    $row_role = mysql_fetch_array($sql_role);
	    $selected_role = '<input type="checkbox" name="role_menu['.$row_menu["id_menu"].']" '.(($row_menu["id_menu"] == $row_role["id_menu"]) ? 'checked=""' : '').' >';
	}else{
	    $selected_role = '<input type="checkbox" name="role_menu['.$row_menu["id_menu"].']">';
	}
    
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$selected_role.'</td>
		    <td>'.$row_menu["alias"].'</td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
				    
				
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <input type="hidden" name="id_group" value="'.$id_group.'"/>
				    <button type="submit" name="save_role" class="btn btn-primary">Save</button>
				</div>
                            </div><!-- /.box -->
			    </form>
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