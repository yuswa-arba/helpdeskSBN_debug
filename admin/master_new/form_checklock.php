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
    $id_employee = isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $nama  	 = isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $tanggal     = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $masuk	 = isset($_POST['masuk']) ? mysql_real_escape_string(trim($_POST['masuk'])) : '';
    $pulang	 = isset($_POST['pulang']) ? mysql_real_escape_string(trim($_POST['pulang'])) : '';
    
    //insert into gx_bagian
    $sql_insert_check = "INSERT INTO `gx_check_lock` (`id`, `id_employee`, `nama`, `tanggal`, `masuk`, `pulang`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES ('', '$id_employee', '$nama', '$tanggal', '$masuk', '$pulang',
                    '$loggedin[username]', '$loggedin[username]', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_check, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_check);
    
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/checklock.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id		 = isset($_POST['id']) ? mysql_real_escape_string(trim($_POST['id'])) : '';
    $id_employee = isset($_POST['id_employee']) ? mysql_real_escape_string(trim($_POST['id_employee'])) : '';
    $nama  	 = isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $tanggal     = isset($_POST['tanggal']) ? mysql_real_escape_string(trim($_POST['tanggal'])) : '';
    $masuk	 = isset($_POST['masuk']) ? mysql_real_escape_string(trim($_POST['masuk'])) : '';
    $pulang	 = isset($_POST['pulang']) ? mysql_real_escape_string(trim($_POST['pulang'])) : '';
    
    //insert into gx_bagian
    $sql_update_level = "UPDATE `gx_checklock` SET `id_employee` = '$id_employee', `nama` = '$nama', `tanggal` = '$tanggal', `masuk` = '$masuk', `pulang` = '$pulang'
		    `user_upd` = '$loggedin[username]', `date_upd` = NOW()
		    WHERE `id` = '$id';";
    //echo $sql_update_staff;
    mysql_query($sql_update_level, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_level);
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_anyar/master_level.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id			= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_checklock 	= "SELECT * FROM `gx_check_lock` WHERE `id`='$id' LIMIT 0,1;";
    $sql_checklock	= mysql_query($query_checklock, $conn);
    $row_checklock	= mysql_fetch_array($sql_checklock);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Check Lock
                        
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
						<label>Id Employee</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="id_employee" value="'.(isset($_GET['id']) ? $row_checklock["id_employee"] : "").'">
						<input type="hidden" name="id" value="'.(isset($_GET['id']) ? $row_checklock["id"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name </label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama" value="'.(isset($_GET['id']) ? $row_checklock["nama"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>tanggal</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="tanggal" placeholder="yyyy-mm-dd" value="'.(isset($_GET['id']) ? $row_checklock["tanggal"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Masuk</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="masuk" value="'.(isset($_GET['id']) ? $row_checklock["masuk"] : "").'">
						
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Pulang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="pulang" value="'.(isset($_GET['id']) ? $row_checklock["pulang"] : "").'">
						
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

    $title	= 'Form Check Lock';
    $submenu	= "master_checklock";
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