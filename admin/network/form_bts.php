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
    $kode_bts       	= isset($_POST['kode_bts']) ? mysql_real_escape_string(trim($_POST['kode_bts'])) : '';
    $nama_bts       	= isset($_POST['nama_bts']) ? mysql_real_escape_string(trim($_POST['nama_bts'])) : '';
    $alamat		       	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $contact_person   	= isset($_POST['contact_person']) ? mysql_real_escape_string(trim($_POST['contact_person'])) : '';
    $telp			   	= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $longitude		   	= isset($_POST['longitude']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
    $latitude   	= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
    
    if($kode_bts != ""){
	//insert into gx_bts
	$sql_insert_bts = "INSERT INTO `gx_bts` (`id_bts`, `kode_bts`, `nama_bts`, `alamat`, `contact_person`, `telp`, `longitude`, `latitude`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
	VALUES (NULL, '".$kode_bts."', '".$nama_bts."', '".$alamat."', '".$contact_person."', '".$telp."', '".$longitude."', '".$latitude."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	//echo $sql_insert_staff;
	mysql_query($sql_insert_bts, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_bts);
	
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='master_bts.php';
	    </script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_bts	 			= isset($_POST['id_bts']) ? mysql_real_escape_string(trim($_POST['id_bts'])) : '';
    $kode_bts       	= isset($_POST['kode_bts']) ? mysql_real_escape_string(trim($_POST['kode_bts'])) : '';
    $nama_bts       	= isset($_POST['nama_bts']) ? mysql_real_escape_string(trim($_POST['nama_bts'])) : '';
    $alamat		       	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
    $contact_person   	= isset($_POST['contact_person']) ? mysql_real_escape_string(trim($_POST['contact_person'])) : '';
    $telp			   	= isset($_POST['telp']) ? mysql_real_escape_string(trim($_POST['telp'])) : '';
    $longitude		   	= isset($_POST['longitude']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
    $latitude   		= isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
    
    if($id_bts != ""){
		//insert into gx_bts
		$sql_update_bts = "UPDATE `gx_bts` SET `level` = '1',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `id_bts` = '".$id_bts."';";
		//echo $sql_update_staff;
		mysql_query($sql_update_bts, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_bts);
		
		//insert into gx_bts
		$sql_insert_bts = "INSERT INTO `gx_bts` (`id_bts`, `kode_bts`, `nama_bts`, `alamat`, `contact_person`, `telp`, `longitude`, `latitude`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$kode_bts."', '".$nama_bts."', '".$alamat."', '".$contact_person."', '".$telp."', '".$longitude."', '".$latitude."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert_staff;
		mysql_query($sql_insert_bts, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_bts);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='master_bts.php';
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
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_bts 	= "SELECT * FROM `gx_bts` WHERE `id_bts`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
}

    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form BTS</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode BTS</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_bts" value="'.(isset($_GET['id']) ? $row_data["kode_bts"] : "").'">
						<input type="hidden" name="id_bts" value="'.(isset($_GET['id']) ? $row_data["id_bts"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama BTS</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_bts" value="'.(isset($_GET['id']) ? $row_data["nama_bts"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_data["alamat"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Contact person</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="contact_person" value="'.(isset($_GET['id']) ? $row_data["contact_person"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Telpon</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="telpon" value="'.(isset($_GET['id']) ? $row_data["telpon"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="latitude" value="'.(isset($_GET['id']) ? $row_data["latitude"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="longitude" value="'.(isset($_GET['id']) ? $row_data["longitude"] : "").'">
						
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

    $title	= 'Form BTS';
    $submenu	= "master_bts";
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