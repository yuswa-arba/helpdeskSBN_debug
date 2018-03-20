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

$id_group	= isset($_GET["id_group"]) ? (int)($_GET["id_group"]) : "";
    
$sql_menu = mysql_query("SELECT * FROM `gx_menu` WHERE `level` = '0' ORDER BY `id_menu` ASC;",$conn);
$sql_menu2 = mysql_query("SELECT * FROM `gx_menu` WHERE `id_parent` = '0' AND `level` = '0' ORDER BY `order_number` ASC;",$conn);

    $content ='<section class="content-header">
                    <h1>
                        User Group
                        
                    </h1>
                </section>
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
				<ul id="treeul">
<li>
	<label>
	<input type="checkbox" />
	Level 1 - 1</label>
</li>
<li>
	<label>
	<input type="checkbox" />
	Level 1 - 2</label>
<ul>
<li>
	<label>
	<input type="checkbox" />
	Level 2 - 1</label>
<ul>
<li>
	<label>
	<input type="checkbox" />
	Level 3 - 1</label>
</li>
<li>
	<label>
	<input type="checkbox" />
	Level 3 - 2</label>
<ul>
<li>
	<label>
	<input type="checkbox" />
	Level 4 - 1</label>
</li>
</ul>
</li>
</ul>
</li>
</ul>
<li>
	<label>
	<input type="checkbox" />
	Level 1 - 3</label>
</li>
<li>
	<label>
	<input type="checkbox" />
	Level 1 - 4</label>
</li>
</li>
</ul>


<div id="containertree">
  <ul>';
  
while ($row_menu2 = mysql_fetch_array($sql_menu2))
{
	$sql_submenu2 = mysql_query("SELECT * FROM `gx_menu` WHERE `id_parent` = '".$row_menu2["id_menu"]."' AND `level` = '0' ORDER BY `order_number` ASC;",$conn);
	$count_submenu2 = mysql_num_rows(mysql_query("SELECT * FROM `gx_menu` WHERE `id_parent` = '".$row_menu2["id_menu"]."' AND `level` = '0' ORDER BY `order_number` ASC;",$conn));
    $content .='<li id="'.$row_menu2["id_menu"].'">'.$row_menu2["alias"];
	
	if($count_submenu2 > 0)
	{
		$content .='<ul>';
		while ($row_submenu2 = mysql_fetch_array($sql_submenu2))
		{
			$content .='<li id="'.$row_submenu2["id_menu"].'">'.$row_submenu2["alias"].'</li>';
		}
		$content .='</ul>';
	}
	
	$content .='</li>';
	
}
$content .='  </ul>
</div>
<input type="text" name="jsfields" id="jsfields" value="" />
				
				    
				    
				
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <input type="text" name="id_group" value="'.$id_group.'"/>
				    <button type="button" id="btnSubmit" name="save_role" class="btn btn-primary">Save</button>
				</div>
                            </div><!-- /.box -->
			    </form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '<script src="'.URL.'js/checktree/jquery-checktree.js"></script>
<script>
$(\'#treeul\').checktree();
</script>

<style>
ul.checktree-root, ul#tree ul {
list-style: none;
}
ul.checktree-root label {
font-weight: normal;
position: relative;
}
ul.checktree-root label input {
position: relative;
top: 2px;
left: -5px;
}

</style>

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