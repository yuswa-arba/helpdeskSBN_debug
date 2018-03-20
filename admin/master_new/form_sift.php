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
    
if(isset($_POST["save"]))
{
    $sift 	= isset($_POST['sift']) ? mysql_real_escape_string(trim($_POST['sift'])) : '';
    $check_in  	= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
    $check_out  = isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
    
    
    //insert into gx_bagian
    $sql_insert_sift = "INSERT INTO `gx_tbsift` (`id`, `sift`, `check_in`, `check_out`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES ('', '$sift', '$check_in', '$check_out',
                    '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_sift, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_sift);
    
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/sift.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id		 = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $sift 	= isset($_POST['sift']) ? mysql_real_escape_string(trim($_POST['sift'])) : '';
    $check_in  	= isset($_POST['check_in']) ? mysql_real_escape_string(trim($_POST['check_in'])) : '';
    $check_out  = isset($_POST['check_out']) ? mysql_real_escape_string(trim($_POST['check_out'])) : '';
    
    //insert into gx_bagian
    $sql_update_sift = "UPDATE `gx_tbsift` SET `sift` = '$sift', `check_in` = '$check_in', `check_out` = '$check_out',
		    `user_upd` = '$loggedin[username]', `date_upd` = NOW()
		    WHERE `id` = '$id';";
    //echo $sql_update_staff;
    //echo $sql_update_sift;
    mysql_query($sql_update_sift, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_sift);
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_anyar/sift.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id			= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_sift		= "SELECT * FROM `gx_tbsift` WHERE `id`='$id' LIMIT 0,1;";
    $sql_sift		= mysql_query($query_sift, $conn);
    $row_sift		= mysql_fetch_array($sql_sift);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Sift
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Check Lock</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Sift </label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="sift" value="'.(isset($_GET['id']) ? $row_sift["sift"] : "").'">
						<input type="hidden" class="form-control" name="id" value="'.(isset($_GET['id']) ? $row_sift["id"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Check In</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="check_in" value="'.(isset($_GET['id']) ? $row_sift["check_in"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Check Out</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="check_out" value="'.(isset($_GET['id']) ? $row_sift["check_out"] : "").'">
						
					    </div>
                                        </div>
					</div>
                                        
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Sift';
    $submenu	= "master_sift";
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