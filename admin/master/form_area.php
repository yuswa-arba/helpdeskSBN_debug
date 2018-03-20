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
    $kode_area      = isset($_POST['kode_area']) ? mysql_real_escape_string(trim($_POST['kode_area'])) : '';
    $nama_area      = isset($_POST['nama_area']) ? mysql_real_escape_string(trim($_POST['nama_area'])) : '';
    $provinsi       = isset($_POST['provinsi']) ? mysql_real_escape_string(trim($_POST['provinsi'])) : '';
    $kota	        = isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
    $kota_kab		= isset($_POST['kota_kab']) ? mysql_real_escape_string(trim($_POST['kota_kab'])) : '';
    $wilayah      	= isset($_POST['wilayah']) ? mysql_real_escape_string(trim($_POST['wilayah'])) : '';
    $alamat       	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$perumahan     	= isset($_POST['perumahan']) ? mysql_real_escape_string(trim($_POST['perumahan'])) : '';
    $latitude       = isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
	$longitude      = isset($_POST['longitude']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
    
    if($kode_area != ""){
	//insert into gx_area
	$sql_insert_area = "
	INSERT INTO `software`.`gx_area` (`id_area`, `kode_area`, `nama_area`, `provinsi`, `kota`, `kota_kab`, `wilayah`, `alamat`, `latitude`, `longitude`, `perumahan`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_area."', '".$nama_area."', '".$provinsi."', '".$kota."', '".$kota_kab."', '".$wilayah."', '".$alamat."', '".$latitude."', '".$longitude."', '".$perumahan."',
	'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	//echo $sql_insert_staff;
	mysql_query($sql_insert_area, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_area);
	
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='master_area.php';
	    </script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
    
}
elseif(isset($_POST["update"]))
{
    $id_area	 	= isset($_POST['id_area']) ? mysql_real_escape_string(trim($_POST['id_area'])) : '';
    $kode_area      = isset($_POST['kode_area']) ? mysql_real_escape_string(trim($_POST['kode_area'])) : '';
    $nama_area      = isset($_POST['nama_area']) ? mysql_real_escape_string(trim($_POST['nama_area'])) : '';
    $provinsi       = isset($_POST['provinsi']) ? mysql_real_escape_string(trim($_POST['provinsi'])) : '';
    $kota	        = isset($_POST['kota']) ? mysql_real_escape_string(trim($_POST['kota'])) : '';
    $kota_kab		= isset($_POST['kota_kab']) ? mysql_real_escape_string(trim($_POST['kota_kab'])) : '';
    $wilayah      	= isset($_POST['wilayah']) ? mysql_real_escape_string(trim($_POST['wilayah'])) : '';
    $alamat       	= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$perumahan     	= isset($_POST['perumahan']) ? mysql_real_escape_string(trim($_POST['perumahan'])) : '';
    $latitude       = isset($_POST['latitude']) ? mysql_real_escape_string(trim($_POST['latitude'])) : '';
	$longitude      = isset($_POST['longitude']) ? mysql_real_escape_string(trim($_POST['longitude'])) : '';
    
    if($id_area != ""){
		//insert into gx_area
		$sql_update_area = "UPDATE `gx_area` SET `kode_area`= '".$kode_area."', `nama_area`= '".$nama_area."',
		`provinsi`= '".$provinsi."', `kota`= '".$kota."', `kota_kab`= '".$kota_kab."', `wilayah`= '".$wilayah."',
		`alamat`= '".$alamat."', `latitude`= '".$latitude."', `longitude`= '".$longitude."', `perumahan`= '".$perumahan."',
				`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
				WHERE `id_area` = '".$id_area."';";
		//echo $sql_update_staff;
		mysql_query($sql_update_area, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_area);
		
		
		echo "<script language='JavaScript'>
			alert('Data telah diupdate.');
			window.location.href='master_area.php';
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
    $id_area	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_area = "SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `id_area`='".$id_area."' LIMIT 0,1;";
    $sql_area	= mysql_query($query_area, $conn);
    $row_area	= mysql_fetch_array($sql_area);
    
}

    $content ='<section class="content-header">
                    <h1>
                        Master Area
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Area</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Area</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_area" value="'.(isset($_GET['id']) ? $row_area["kode_area"] : "").'">
						<input type="hidden" name="id_area" value="'.(isset($_GET['id']) ? $row_area["id_area"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Area</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_area" value="'.(isset($_GET['id']) ? $row_area["nama_area"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Provinsi</label>
					    </div>
					    <div class="col-xs-8">
						<select name="provinsi" class="form-control">';
						$sql_provinsi = mysql_query("SELECT * FROM `gx_provinsi`;", $conn);
						while($row_provinsi = mysql_fetch_array($sql_provinsi))
						{
							$content .='<option value="'.$row_provinsi["nama"].'" '.(isset($_GET['id']) AND ($row_area["provinsi"] == $row_provinsi["nama"]) ? 'selected=""' : "").'>'.$row_provinsi["nama"].'</option>';
						}
						
						$content .='</select>
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-8">
							<input type="text" class="form-control" name="kota" value="'.(isset($_GET['id']) ? $row_area["kota"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota/Kabupaten</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kota_kab" value="'.(isset($_GET['id']) ? $row_area["kota_kab"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Perumahan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="perumahan" value="'.(isset($_GET['id']) ? $row_area["perumahan"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Wilayah</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="wilayah" value="'.(isset($_GET['id']) ? $row_area["wilayah"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_area["alamat"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="latitude" value="'.(isset($_GET['id']) ? $row_area["latitude"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="longitude" value="'.(isset($_GET['id']) ? $row_area["longitude"] : "").'">
						
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

    $title	= 'Form Area';
    $submenu	= "master_area";
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