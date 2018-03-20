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
    $sql_data	= "SELECT `gx_ruang`.*, `gx_cabang`.`id_cabang`, `gx_cabang`.`nama_cabang`
			 FROM `gx_ruang`, `gx_cabang`
			 WHERE `gx_ruang`.`id_cabang` = `gx_cabang`.`id_cabang`
			 AND `gx_ruang`.`level` =  '0' AND `gx_ruang`.`id_ruang` = '".$id_data."' LIMIT 0,1;";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form Mata Uang id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form Mata Uang");
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Ruang</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_ruang"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Cabang</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text" class="form-control" readonly=""  name="nama_cabang" value="'.(isset($_GET['id']) ? $row_data["nama_cabang"] : "").'" placeholder="Search Cabang"
						onclick="return valideopenerform(\'data_cabang.php?r=form_ruang&f=ruang\',\'ruang\');">
						<input type="hidden" class="form-control" name="id_cabang" value="'.(isset($_GET['id']) ? $row_data["id_cabang"] : "").'">
					    
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Ruang</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" required="" name="kode_ruang" value="'.(isset($_GET["id"]) ? $row_data['kode_ruang'] :"").'">
						<input type="hidden" name="id_ruang" value="'.(isset($_GET["id"]) ? $row_data['id_ruang'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="nama_ruang" value="'.(isset($_GET["id"]) ? $row_data['nama_ruang'] :"").'">
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
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
    $kode_ruang	= isset($_POST['kode_ruang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_ruang']))) : "";
    $nama_ruang	= isset($_POST['nama_ruang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ruang']))) : "";
    
    if(($kode_ruang != "") AND ($nama_ruang != ""))
    {
	$insert_data    	= "INSERT INTO `gx_ruang` (`id_ruang`, `kode_ruang`, `nama_ruang`,
	`id_cabang`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_ruang."', '".$nama_ruang."',
	'".$id_cabang."',
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
	    location.href = 'master_ruang';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_ruang	= isset($_POST['id_ruang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_ruang']))) : "";
    $id_cabang		= isset($_POST['id_cabang']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_cabang']))) : "";
    $kode_ruang	= isset($_POST['kode_ruang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_ruang']))) : "";
    $nama_ruang	= isset($_POST['nama_ruang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_ruang']))) : "";
    
    if(($id_ruang != ""))
    {
	$update_data   	= "UPDATE `gx_ruang` SET `kode_ruang`='".$kode_ruang."', `nama_ruang`='".$nama_ruang."',
	`id_cabang`='".$id_cabang."', 
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_ruang`='".$id_ruang."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_ruang.php';
    </script>";
}

$plugins = '';

    $title	= 'Form Ruang';
    $submenu	= "master_ruang";
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