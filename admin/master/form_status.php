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
    $sql_data	= "SELECT `gx_status_collect`.*
			 FROM `gx_status_collect`
			 WHERE `gx_status_collect`.`level` =  '0'
			 AND `gx_status_collect`.`id_status` = '".$id_data."' LIMIT 0,1;";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form status id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form status");
}
    
    $content ='<section class="content-header">
                    <h1>
                        Form Status Kolektibilitas
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Status Kolektibilitas</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_status"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Nama Status</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text"  class="form-control" required="" name="nama_status" value="'.(isset($_GET["id"]) ? $row_data['nama_status'] :"").'">
						<input type="hidden" name="id_status" value="'.(isset($_GET["id"]) ? $row_data['id_status'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Range Hari</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" maxlength="5" name="tgl1" value="'.(isset($_GET["id"]) ? $row_data['tgl1'] :"").'">
					    </div>
					    <div class="col-xs-3">
						<label>Sampai</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" required="" maxlength="5" name="tgl2" value="'.(isset($_GET["id"]) ? $row_data['tgl2'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="keterangan" value="'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'">
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
    $nama_status	= isset($_POST['nama_status']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_status']))) : "";
    $tgl1		= isset($_POST['tgl1']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl1']))) : "";
    $tgl2		= isset($_POST['tgl2']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl2']))) : "";
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    
    if(($nama_status != "") AND ($tgl1 != ""))
    {
		$insert_data    	= "INSERT INTO `software`.`gx_status_collect` (`id_status`, `nama_status`,
		`tgl1`, `tgl2`, `keterangan`, 
		`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
		VALUES (NULL, '".$nama_status."', '".$tgl1."', '".$tgl2."', '".$keterangan."',	
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
	    location.href = 'master_status';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_status		= isset($_POST['id_status']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_status']))) : "";
    $nama_status	= isset($_POST['nama_status']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_status']))) : "";
    $tgl1		= isset($_POST['tgl1']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl1']))) : "";
    $tgl2		= isset($_POST['tgl2']) ? mysql_real_escape_string(strip_tags(trim($_POST['tgl2']))) : "";
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    
    if(($id_status != ""))
    {
		$update_data   	= "UPDATE `software`.`gx_status_collect` SET `level`='1',
		`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_status`='".$id_status."'";
		
		//echo $insert_bank;
		mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
							   </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
		
		$insert_data    	= "INSERT INTO `software`.`gx_status_collect` (`id_status`, `nama_status`,
		`tgl1`, `tgl2`, `keterangan`, 
		`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
		VALUES (NULL, '".$nama_status."', '".$tgl1."', '".$tgl2."', '".$keterangan."',	
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
	    location.href = 'master_status.php';
    </script>";
}

$plugins = '';

    $title	= 'Form Status';
    $submenu	= "master_status";
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