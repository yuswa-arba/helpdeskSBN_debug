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
    if($loggedin["group"] == 'admin')
    {
        global $conn;

if(isset($_POST["submit"]))
	{
		$id_group    	= isset($_POST['id_group']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_group']))) : '';
		
		$query_delete = "DELETE FROM `gx_group_permission` WHERE (`id_group`='".$id_group."');";
		$sql_delete = mysql_query($query_delete, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$query_delete);
		
		$all = array();
		$all = isset($_POST["all"]) ? $_POST["all"] : $all;
		
		$add = array();
		$add = isset($_POST["add"]) ? $_POST["add"] : $add;
		
		$view = array();
		$view = isset($_POST["view"]) ? $_POST["view"] : $view;
		
		$edit = array();
		$edit = isset($_POST["edit"]) ? $_POST["edit"] : $edit;
		
		$delete = array();
		$delete = isset($_POST["delete"]) ? $_POST["delete"] : $delete;
		
		foreach($all as $key => $value)
		{
			$query = "INSERT INTO `software`.`gx_group_permission` (`pid`, `permission_name`, `permission_type`, `id_group`)
			VALUES (NULL, '".$value."', '1', '".$id_group."');";
			$sql_update = mysql_query($query, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		}
		foreach($edit as $key => $value)
		{
			$query = "INSERT INTO `software`.`gx_group_permission` (`pid`, `permission_name`, `permission_type`, `id_group`)
			VALUES (NULL, '".$value."', '1', '".$id_group."');";
			$sql_update = mysql_query($query, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		}
		foreach($view as $key => $value)
		{
			$query = "INSERT INTO `software`.`gx_group_permission` (`pid`, `permission_name`, `permission_type`, `id_group`)
			VALUES (NULL, '".$value."', '1', '".$id_group."');";
			$sql_update = mysql_query($query, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		}
		foreach($add as $key => $value)
		{
			$query = "INSERT INTO `software`.`gx_group_permission` (`pid`, `permission_name`, `permission_type`, `id_group`)
			VALUES (NULL, '".$value."', '1', '".$id_group."');";
			$sql_update = mysql_query($query, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		}
		foreach($delete as $key => $value)
		{
			$query = "INSERT INTO `software`.`gx_group_permission` (`pid`, `permission_name`, `permission_type`, `id_group`)
			VALUES (NULL, '".$value."', '1', '".$id_group."');";
			$sql_update = mysql_query($query, $conn) or die (mysql_error());
			//log
			enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
		}
		
		header('location: role_management.php');
	}

if(isset($_GET["id_group"]))
{
    $id_data		= isset($_GET['id_group']) ? (int)$_GET['id_group'] : '';
    $query_data 	= "SELECT * FROM `gx_group` WHERE `id_group`='".$id_data."' LIMIT 0,1;";
    $sql_data		= mysql_query($query_data, $conn);
    $row_data		= mysql_fetch_array($sql_data);
    
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Permission</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Group</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" class="form-control" readonly="" name="nama_group" value="'.(isset($_GET['id_group']) ? $row_data["nama_group"] : "").'">
							'.(isset($_GET['id_group']) ? '<input type="hidden" name="id_group" value="'.$id_data.'">' : "").'
						</div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Description</label>
					    </div>
					    <div class="col-xs-6">
							<input type="text" readonly="" class="form-control" name="desc" value="'.(isset($_GET['id_group']) ? $row_data["desc"] : "").'">
						
					    </div>
                                        </div>
					</div>

                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Nama Menu</th>
                                                <th>All</th>
												<th>View</th>
												<th>Add</th>
												<th>Edit</th>
												<th>Delete</th>
                                                
						<th>Action</th>
						
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_menu 	= mysql_query("SELECT * FROM `gx_menu`
				  WHERE `level` = '0' ORDER BY `id_menu` ASC;", $conn);

$no = 1;
while ($row_menu = mysql_fetch_array($sql_menu))
{
	$sql_perm 	= mysql_query("SELECT `pid` FROM `gx_group_permission`
				  WHERE `id_group` = '".$id_data."' AND `permission_name` = 'all_".$row_data["nama_group"]."_".$row_menu["menu"]."';", $conn);
	$row_perm	= mysql_num_rows($sql_perm);
	
	$sql_perm_view 	= mysql_query("SELECT `pid` FROM `gx_group_permission`
				  WHERE `id_group` = '".$id_data."' AND `permission_name` = 'view_".$row_data["nama_group"]."_".$row_menu["menu"]."';", $conn);
	$row_perm_view	= mysql_num_rows($sql_perm_view);a
	
	$sql_perm_add 	= mysql_query("SELECT `pid` FROM `gx_group_permission`
						WHERE `id_group` = '".$id_data."' AND `permission_name` = 'add_".$row_data["nama_group"]."_".$row_menu["menu"]."';", $conn);
	$row_perm_add	= mysql_num_rows($sql_perm_add);
	
	$sql_perm_edit 	= mysql_query("SELECT `pid` FROM `gx_group_permission`
							WHERE `id_group` = '".$id_data."' AND `permission_name` = 'edit_".$row_data["nama_group"]."_".$row_menu["menu"]."';", $conn);
	$row_perm_edit	= mysql_num_rows($sql_perm_edit);
	
	$sql_perm_delete 	= mysql_query("SELECT `pid` FROM `gx_group_permission`
							WHERE `id_group` = '".$id_data."' AND `permission_name` = 'delete_".$row_data["nama_group"]."_".$row_menu["menu"]."';", $conn);
	$row_perm_delete	= mysql_num_rows($sql_perm_delete);
	
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_menu["alias"].'</td>
		    <td><input type="checkbox" name="all[]" value="all_'.$row_data["nama_group"].'_'.$row_menu["menu"].'" '.(($row_perm == "1") ? 'checked=""' : "").'></td>
		    <td><input type="checkbox" name="view[]" value="view_'.$row_data["nama_group"].'_'.$row_menu["menu"].'" '.(($row_perm_view == "1") ? 'checked=""' : "").'></td>
			<td><input type="checkbox" name="add[]" value="add_'.$row_data["nama_group"].'_'.$row_menu["menu"].'" '.(($row_perm_add == "1") ? 'checked=""' : "").'></td>
			<td><input type="checkbox" name="edit[]" value="edit_'.$row_data["nama_group"].'_'.$row_menu["menu"].'" '.(($row_perm_edit == "1") ? 'checked=""' : "").'></td>
			<td><input type="checkbox" name="delete[]" value="delete_'.$row_data["nama_group"].'_'.$row_menu["menu"].'" '.(($row_perm_delete == "1") ? 'checked=""' : "").'></td>
			<td align="center">
		    </td>
		    
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
									</div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
					
					<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">List User</h3>
                                </div><!-- /.box-header -->
                                
                                    <div class="box-body">
									
									<table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Kode Pegawai</th>
                                                <th>Nama</th>
												<th>Email</th>
												<th>Username</th>
												<th>Group</th>
                                                
						<th>Action</th>
						
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_user 	= mysql_query("SELECT `gx_pegawai`.`kode_pegawai`, `gx_pegawai`.`nama`, `gx_pegawai`.`email`, `gxLogin_admin`.`username`, `gx_group`.`nama_group`
						  FROM `gx_pegawai`, `gx_group`, `gxLogin_admin`
							WHERE `gx_pegawai`.`kode_pegawai` = `gxLogin_admin`.`id_employee`
							AND `gxLogin_admin`.`id_group` = `gx_group`.`id_group`
							AND `gxLogin_admin`.`id_group` = '".$id_data."'
							AND `gx_pegawai`.`level` = '0' ORDER BY `gx_pegawai`.`nama` ASC;", $conn);

$nou = 1;
while ($row_user = mysql_fetch_array($sql_user))
{
    $content .= '<tr>
		    <td>'.$nou.'.</td>
		    <td>'.$row_user["kode_pegawai"].'</td>
			<td>'.$row_user["nama"].'</td>
			<td>'.$row_user["email"].'</td>
			<td>'.$row_user["username"].'</td>
			<td>'.$row_user["nama_group"].'</td>
		    
		    
		</tr>';
		$nou++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
                                    </div><!-- /.box-body -->

                                    
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Cabang';
    $submenu	= "cabang";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>