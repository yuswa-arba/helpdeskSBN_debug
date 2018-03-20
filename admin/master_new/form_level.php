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
    $kode_level      	= isset($_POST['kode_level']) ? mysql_real_escape_string(trim($_POST['kode_level'])) : '';
    $nama_level       	= isset($_POST['nama_level']) ? mysql_real_escape_string(trim($_POST['nama_level'])) : '';
    
    //insert into gx_bagian
    $sql_insert_level = "INSERT INTO `gx_tblevel` (`id_level`, `kode_level`, `nama_level`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES ('', '$kode_level', '$nama_level',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_level, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_level);
    
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/master_level.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_level	 	= isset($_POST['id_level']) ? mysql_real_escape_string(trim($_POST['id_level'])) : '';
    $kode_level      	= isset($_POST['kode_level']) ? mysql_real_escape_string(trim($_POST['kode_level'])) : '';
    $nama_level       	= isset($_POST['nama_level']) ? mysql_real_escape_string(trim($_POST['nama_level'])) : '';
    
    //insert into gx_bagian
    $sql_update_level = "UPDATE `gx_tblevel` SET `kode_level` = '$kode_level', `nama_level` = '$nama_level',
		    `user_upd` = '$loggedin[username]', `date_upd` = NOW()
		    WHERE `id_level` = '$id_level';";
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
    $id_level		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_level 	= "SELECT * FROM `gx_tblevel` WHERE `id_level`='$id_level' LIMIT 0,1;";
    $sql_level		= mysql_query($query_level, $conn);
    $row_level		= mysql_fetch_array($sql_level);
    
}

$jum_staff	= mysql_num_rows(mysql_query("SELECT * FROM `tbPegawai`", $conn));
    
    $content ='<section class="content-header">
                    <h1>
                        Master Level
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Level</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Level</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kode_level" value="'.(isset($_GET['id']) ? $row_level["kode_level"] : "").'">
						<input type="hidden" name="id_level" value="'.(isset($_GET['id']) ? $row_level["id_level"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name Level</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_level" value="'.(isset($_GET['id']) ? $row_level["nama_level"] : "").'">
						
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

    $title	= 'Form Level';
    $submenu	= "master_level";
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