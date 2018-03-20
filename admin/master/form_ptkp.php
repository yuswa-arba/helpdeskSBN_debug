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
    $kode_ptkp      	= isset($_POST['kode_ptkp']) ? mysql_real_escape_string(trim($_POST['kode_ptkp'])) : '';
    $nama_ptkp       	= isset($_POST['nama_ptkp']) ? mysql_real_escape_string(trim($_POST['nama_ptkp'])) : '';
    
	if($kode_ptkp !=""){
		//insert into gx_bagian
		$sql_insert_ptkp = "INSERT INTO `gx_ptkp` (`id_ptkp`, `kode_ptkp`, `nama_ptkp`,
						`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
						VALUES ('', '$kode_ptkp', '$nama_ptkp',
						'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert_staff;
		mysql_query($sql_insert_ptkp, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_ptkp);
		
		echo "<script language='JavaScript'>
		alert('Data telah disimpan');
		window.location.href='master_ptkp.php';
		</script>";
	}else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_ptkp	 	= isset($_POST['id_ptkp']) ? mysql_real_escape_string(trim($_POST['id_ptkp'])) : '';
    $kode_ptkp      	= isset($_POST['kode_ptkp']) ? mysql_real_escape_string(trim($_POST['kode_ptkp'])) : '';
    $nama_ptkp       	= isset($_POST['nama_ptkp']) ? mysql_real_escape_string(trim($_POST['nama_ptkp'])) : '';
    
	if($id_ptkp != ""){
		//insert into gx_bagian
		$sql_update_ptkp = "UPDATE `gx_ptkp` SET `level` = '1',
				`user_upd` = '$loggedin[username]', `date_upd` = NOW()
				WHERE `id_ptkp` = '$id_ptkp';";
		//echo $sql_update_staff;
		mysql_query($sql_update_ptkp, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_ptkp);
		
	   
		//insert into gx_bagian
		$sql_insert_ptkp = "INSERT INTO `gx_ptkp` (`id_ptkp`, `kode_ptkp`, `nama_ptkp`,
						`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
						VALUES ('', '$kode_ptkp', '$nama_ptkp',
						'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert_staff;
		mysql_query($sql_insert_ptkp, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_ptkp);
		
		echo "<script language='JavaScript'>
		alert('Data telah diupdate.');
		window.location.href='master_ptkp.php';
		</script>";
	}else{
		echo "<script language='JavaScript'>
			alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
			window.history.go(-1);
		</script>";
    }
}

if(isset($_GET["id"]))
{
    $id_ptkp		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_ptkp 	= "SELECT * FROM `gx_ptkp` WHERE `id_ptkp`='".$id_ptkp."' AND `level` = '0' LIMIT 0,1;";
    $sql_ptkp		= mysql_query($query_ptkp, $conn);
    $row_ptkp		= mysql_fetch_array($sql_ptkp);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Master PTKP
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form PTKP</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode PTKP</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kode_ptkp" value="'.(isset($_GET['id']) ? $row_ptkp["kode_ptkp"] : "").'">
						<input type="hidden" name="id_ptkp" value="'.(isset($_GET['id']) ? $row_ptkp["id_ptkp"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name PTKP</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_ptkp" value="'.(isset($_GET['id']) ? $row_ptkp["nama_ptkp"] : "").'">
						
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Created By</label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_ptkp["user_add"] : $loggedin["username"]).'
					    </div>
                                        
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Lates Update By </label>
					    </div>
					    <div class="col-xs-6">
						'.(isset($_GET['id']) ? $row_ptkp["user_upd"]." ".$row_ptkp["date_upd"] : "").'
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

    $title	= 'Form PTKP';
    $submenu	= "master_ptkp";
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