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
require_once "../../config/telnet/PHPTelnet.php";

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if( checkRole($loggedin["id_group"], 'usermanagement') == "0")  { die( 'Access Denied!' );}


global $conn;
global $conn_voip;


if(isset($_POST["save"]))
{
    
    $group_nama	= isset($_POST["group_nama"]) ? $_POST["group_nama"] : "";
    $group_desc	= isset($_POST["group_desc"]) ? $_POST["group_desc"] : "";
    $role_menu 	= array();
    $role_menu	= isset($_POST["role_menu"]) ? $_POST["role_menu"] : $role_menu;
    //$id_group	= isset($_POST["id_group"]) ? trim(strip_tags($_POST["id_group"])) : "";
    
    $sql_group = "INSERT INTO `gx_user_group` (`id_group`, `group_nama`, `group_desc`, `user_add`, `user_update`,
                `date_add`, `date_upd`, `level`)
	    VALUES (NULL, '".$group_nama."', '".$group_desc."', '".$loggedin["username"]."', '".$loggedin["username"]."',
                NOW(), NOW(), '0');";
    
    mysql_query($sql_group, $conn) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
    
    $sql_select_lastdata = mysql_query("SELECT * FROM `gx_user_group`
				       WHERE `group_nama` = '".$group_nama."'
				       AND `group_desc` = '".$group_desc."'
				       AND `level` = '0' LIMIT 0,1;", $conn);
    $row_select_lastdata = mysql_fetch_array($sql_select_lastdata);
    
    foreach($role_menu as $key => $value){
	//echo "Insert$key<br>";
	$sql_insert_role = "INSERT INTO `software`.`gx_user_group_role` (`id_role`, `id_group`, `id_menu`)
			    VALUES (NULL, '".$row_select_lastdata["id_group"]."', '".$key."');";
	mysql_query($sql_insert_role, $conn) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	//echo $sql_insert_role;
    }
    
    
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."system/group.php';
	</script>";
    

}elseif(isset($_POST["update"]))
{
    $id_group	= isset($_POST["id_group"]) ? $_POST["id_group"] : "";
    $group_nama	= isset($_POST["group_nama"]) ? $_POST["group_nama"] : "";
    $group_desc	= isset($_POST["group_desc"]) ? $_POST["group_desc"] : "";
    $role_menu 	= array();
    $role_menu	= isset($_POST["role_menu"]) ? $_POST["role_menu"] : $role_menu;
    
    $sql_update_level = "UPDATE `gx_user_group` SET `level` = '1',
			`date_upd` = NOW(), `user_update`= '".$loggedin["username"]."'
			WHERE `id_group` = '".$id_group."';";
    mysql_query($sql_update_level, $conn);
    
    $sql_group = "INSERT INTO `gx_user_group` (`id_group`, `group_nama`, `group_desc`, `user_add`, `user_update`,
                `date_add`, `date_upd`, `level`)
	    VALUES (NULL, '".$group_nama."', '".$group_desc."', '".$loggedin["username"]."', '".$loggedin["username"]."',
                NOW(), NOW(), '0');";
    
    mysql_query($sql_group, $conn) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
    
    $sql_select_lastdata = mysql_query("SELECT * FROM `gx_user_group`
				       WHERE `group_nama` = '".$group_nama."'
				       AND `group_desc` = '".$group_desc."'
				       AND `level` = '0' LIMIT 0,1;", $conn);
    $row_select_lastdata = mysql_fetch_array($sql_select_lastdata);
    
    foreach($role_menu as $key => $value){
	//echo "Insert$key<br>";
	$sql_insert_role = "INSERT INTO `software`.`gx_user_group_role` (`id_role`, `id_group`, `id_menu`)
			    VALUES (NULL, '".$row_select_lastdata["id_group"]."', '".$key."');";
	mysql_query($sql_insert_role, $conn) or die("<script language='JavaScript'>
			    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			    window.history.go(-1);
		</script>");
	//echo $sql_insert_role;
    }
    
    echo "<script language=\"JavaScript\">
	    alert('Data telah disimpan!');
	    location.href = '".URL_ADMIN."system/group.php';
	</script>";
}


if(isset($_GET["id"]))
{
    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    
    $sql_group  = mysql_query("SELECT * FROM `gx_user_group` WHERE `id_group` = '".$id."' LIMIT 0,1;", $conn);
    $row_group  = mysql_fetch_array($sql_group);
}

$sql_menu = mysql_query("SELECT * FROM `gx_role_menu`
			WHERE `level` = '0'
			ORDER BY `id_menu` ASC;",$conn);

    $content ='
                <section class="content">
                    
                    <div class="row">
                        <div class="col-xs-7">
			<form role="form" method="POST" action="">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Form Group</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    
                                    <div class="box-body">
					<div class="form-group">
                                            <h5>Nama Group</h5>
                                            <input type="text" class="form-control" name="group_nama" value="'.((isset($_GET["id"])) ? $row_group["group_nama"] : "").'">
                                        </div>
					<div class="form-group">
                                            <h5>Deskripsi</h5>
                                            <input type="text" class="form-control" name="group_desc" value="'.((isset($_GET["id"])) ? $row_group["group_desc"] : "").'">
                                        </div>
                                    </div><!-- /.box-body -->

                                    
                                </div><!-- /.box-body -->
								<div class="box-footer">
									<input type="hidden" name="id_group" value="'.((isset($_GET["id"])) ? $_GET["id"] : "").'">
									<button type="submit" name="'.((isset($_GET["id"])) ? "update" : "save").'" class="btn btn-primary">Save</button>
								</div>
                                
                            </div><!-- /.box -->
			    
<!--			    <div class="box">
				<div class="box-header">
                                    <h2 class="box-title">List Role Menu</h2>
                                </div>
				
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

$no = 1;
while ($row_menu = mysql_fetch_array($sql_menu))
{
    $id_group = isset($_GET['id']) ? (int)$_GET['id'] : '';
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
		    <td>'.$row_menu["menu_nama"].'</td>
		</tr>';
		$no++;
}
$content .= '
                                        </tbody>
                                    </table>
				    
				
                                </div>
				
                            </div> /.box -->
			</form>
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<!-- InputMask -->
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            $(function() {
                    $("[data-mask]").inputmask();
            });
        </script>
    ';

    $title	= 'Form Group';
    $submenu	= "system_user";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>