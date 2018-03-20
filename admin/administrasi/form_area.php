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
    
if(isset($_GET['id'])){
    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_area` WHERE `id_area` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form satuan id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form satuan");
}
    
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Area</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_area"  method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Area</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="kode_area" value="'.(isset($_GET["id"]) ? $row_data['kode_area'] :"").'">
						<input type="hidden" name="id_area" value="'.(isset($_GET["id"]) ? $row_data['id_area'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama_area" value="'.(isset($_GET["id"]) ? $row_data['nama_area'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Created By:</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_add'] : $loggedin["username"]).'
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>last Updated By:</label>
					    </div>
					    <div class="col-xs-8">
						'.(isset($_GET["id"]) ? $row_data['user_upd'].' ( '.$row_data['date_upd'].' )' : "").'
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
if(isset($_POST["save"]))
{
    
    $kode_area	= isset($_POST['kode_area']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_area']))) : "";
    $nama_area	= isset($_POST['nama_area']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_area']))) : "";
    
    if(($kode_area != NULL) AND ($nama_area != NULL))
    {
	$insert_data    	= "INSERT INTO `gx_area` (`id_area`, `kode_area`, `nama_area`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_area."', '".$nama_area."',
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."','0')";
	//echo $insert_bank;
	mysql_query($insert_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data = ".mysql_real_escape_string($insert_data).".");
    }
    
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_area';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_area		= isset($_POST['id_area']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_area']))) : "";
    $kode_area	= isset($_POST['kode_area']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_area']))) : "";
    $nama_area	= isset($_POST['nama_area']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_area']))) : "";
    
    if(($id_area != NULL))
    {
	$update_data   	= "UPDATE `gx_area` SET `kode_area`='".$kode_area."', `nama_area`='".$nama_area."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_area`='".$id_area."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_area.php';
    </script>";
}

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