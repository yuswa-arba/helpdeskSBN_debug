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
    $sql_data	= "SELECT * FROM `gx_satuan` WHERE `id_satuan` = '".$id_data."';";
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
                                    <h3 class="box-title">Form Satuan</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_satuan"  method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Satuan</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="kode_satuan" value="'.(isset($_GET["id"]) ? $row_data['kode_satuan'] :"").'">
						<input type="hidden" name="id_satuan" value="'.(isset($_GET["id"]) ? $row_data['id_satuan'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama_satuan" value="'.(isset($_GET["id"]) ? $row_data['nama_satuan'] :"").'">
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
    
    $kode_satuan	= isset($_POST['kode_satuan']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_satuan']))) : "";
    $nama_satuan	= isset($_POST['nama_satuan']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_satuan']))) : "";
    
    if(($kode_satuan != NULL) AND ($nama_satuan != NULL))
    {
	$insert_data    	= "INSERT INTO `gx_satuan` (`id_satuan`, `kode_satuan`, `nama_satuan`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_satuan."', '".$nama_satuan."',
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
	    location.href = 'master_satuan';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_satuan		= isset($_POST['id_satuan']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_satuan']))) : "";
    $kode_satuan	= isset($_POST['kode_satuan']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_satuan']))) : "";
    $nama_satuan	= isset($_POST['nama_satuan']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_satuan']))) : "";
    
    if(($id_satuan != NULL))
    {
	$update_data   	= "UPDATE `gx_satuan` SET `kode_satuan`='".$kode_satuan."', `nama_satuan`='".$nama_satuan."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_satuan`='".$id_satuan."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_satuan.php';
    </script>";
}

$plugins = '';

    $title	= 'Form Satuan';
    $submenu	= "master_satuan";
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