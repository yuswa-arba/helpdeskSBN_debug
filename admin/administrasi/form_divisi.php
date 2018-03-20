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
    $sql_data	= "SELECT * FROM `gx_divisi` WHERE `id_divisi` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form Divisi id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form Divisi");
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Divisi</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_divisi"  method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Divisi</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="kode_divisi" value="'.(isset($_GET["id"]) ? $row_data['kode_divisi'] :"").'">
						<input type="hidden" name="id_divisi" value="'.(isset($_GET["id"]) ? $row_data['id_divisi'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama_divisi" value="'.(isset($_GET["id"]) ? $row_data['nama_divisi'] :"").'">
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
    
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_divisi']))) : "";
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_divisi']))) : "";
    
    if(($kode_divisi != NULL) AND ($nama_divisi != NULL))
    {
	$insert_data    	= "INSERT INTO `gx_divisi` (`id_divisi`, `kode_divisi`, `nama_divisi`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_divisi."', '".$nama_divisi."',
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
	    location.href = 'master_divisi';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_divisi	= isset($_POST['id_divisi']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_divisi']))) : "";
    $kode_divisi	= isset($_POST['kode_divisi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_divisi']))) : "";
    $nama_divisi	= isset($_POST['nama_divisi']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_divisi']))) : "";
    
    if(($id_divisi != NULL))
    {
	$update_data   	= "UPDATE `gx_divisi` SET `kode_divisi`='".$kode_divisi."', `nama_divisi`='".$nama_divisi."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_divisi`='".$id_divisi."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_divisi.php';
    </script>";
}

$plugins = '';

    $title	= 'Form Satuan';
    $submenu	= "master_divisi";
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