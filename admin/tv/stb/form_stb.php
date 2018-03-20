<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
	
        global $conn;
    
if(isset($_GET['id'])){
    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_tv_stb` WHERE `id_stb` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form STB id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form STB");
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form STB</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_stb"  method="POST" action="">
                                    <div class="box-body">
					<div class="form-group">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode STB</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_stb" value="'.(isset($_GET["id"]) ? $row_data['kode_stb'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>SN</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden"  class="form-control" required="" name="id_stb" value="'.(isset($_GET["id"]) ? $row_data['id_stb'] :"").'">
						<input type="text" class="form-control" name="sn" value="'.(isset($_GET["id"]) ? $row_data['sn'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>MAC</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="mac" value="'.(isset($_GET["id"]) ? $row_data['mac'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Version</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="version" value="'.(isset($_GET["id"]) ? $row_data['version'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kelengkapan</label>
					    </div>
					    <div class="col-xs-8">
						
							<input type="checkbox" name="stb" value="0" '.(isset($_GET["id"]) && $row_data['stb'] == "0" ? "checked" :"").'> STB 
							<input type="checkbox" name="remote" value="0" '.(isset($_GET["id"]) && $row_data['remote'] == "0" ? "checked" :"").'> Remote
							<input type="checkbox" name="kabel_hdmi" value="0" '.(isset($_GET["id"]) && $row_data['kabel_hdmi'] == "0" ? "checked" :"").'> HDMI
							<input type="checkbox" name="adaptor" value="0" '.(isset($_GET["id"]) && $row_data['adaptor'] == "0" ? "checked" :"").'> STB 
							
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea name="keterangan" id="keterangan" rows="6" cols="55" style="resize: none;">'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'</textarea>
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
    
	$kode_stb	= isset($_POST['kode_stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_stb']))) : "";
    $sn			= isset($_POST['sn']) ? mysql_real_escape_string(strip_tags(trim($_POST['sn']))) : "";
    $mac		= isset($_POST['mac']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac']))) : "";
    $version	= isset($_POST['version']) ? mysql_real_escape_string(strip_tags(trim($_POST['version']))) : "";
	$stb		= isset($_POST['stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['stb']))) : "";
    $remote		= isset($_POST['remote']) ? mysql_real_escape_string(strip_tags(trim($_POST['remote']))) : "";
    $kabel_hdmi	= isset($_POST['kabel_hdmi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kabel_hdmi']))) : "";
    $adaptor	= isset($_POST['adaptor']) ? mysql_real_escape_string(strip_tags(trim($_POST['adaptor']))) : "";
    $keterangan	= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    
	$stb_check = isset($_POST['stb']) ? $stb : "1";
	$remote_check = isset($_POST['remote']) ? $remote : "1";
	$hdmi_check = isset($_POST['kabel_hdmi']) ? $kabel_hdmi : "1";
	$adaptor_check = isset($_POST['adaptor']) ? $adaptor : "1";
	
    if(($sn != "") AND ($mac != "")){
	$insert_data    	= "INSERT INTO `software`.`gx_tv_stb` (`id_stb`, `kode_stb`, `sn`, `mac`, `version`, `stb`, `remote`, `kabel_hdmi`, `adaptor`, `keterangan`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_stb."', '".$sn."', '".$mac."', '".$version."', '".$stb_check."', '".$remote_check."', '".$hdmi_check."', '".$adaptor_check."', '".$keterangan."', 
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."','0')";
	//echo $insert_data;
	
	mysql_query($insert_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data = ".$insert_data.".");
	}
    
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'list_stb.php';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_stb		= isset($_POST['id_stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_stb']))) : "";
	$kode_stb	= isset($_POST['kode_stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_stb']))) : "";
    $sn			= isset($_POST['sn']) ? mysql_real_escape_string(strip_tags(trim($_POST['sn']))) : "";
    $mac		= isset($_POST['mac']) ? mysql_real_escape_string(strip_tags(trim($_POST['mac']))) : "";
    $version	= isset($_POST['version']) ? mysql_real_escape_string(strip_tags(trim($_POST['version']))) : "";
	$stb		= isset($_POST['stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['stb']))) : "";
    $remote		= isset($_POST['remote']) ? mysql_real_escape_string(strip_tags(trim($_POST['remote']))) : "";
    $kabel_hdmi	= isset($_POST['kabel_hdmi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kabel_hdmi']))) : "";
    $adaptor	= isset($_POST['adaptor']) ? mysql_real_escape_string(strip_tags(trim($_POST['adaptor']))) : "";
    $keterangan	= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
	
    $stb_check = isset($_POST['stb']) ? $stb : "1";
	$remote_check = isset($_POST['remote']) ? $remote : "1";
	$hdmi_check = isset($_POST['kabel_hdmi']) ? $kabel_hdmi : "1";
	$adaptor_check = isset($_POST['adaptor']) ? $adaptor : "1";
	
	if(($id_stb != NULL))
    {
	$update_data   	= "UPDATE `software`.`gx_tv_stb` SET `kode_stb`='".$kode_stb."', `sn`='".$sn."', `mac`='".$mac."', `version`='".$version."', `stb`='".$stb_check."',
	`remote`='".$remote_check."', `kabel_hdmi`='".$hdmi_check."', `adaptor`='".$adaptor_check."', `keterangan`='".$keterangan."', 
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_stb`='".$id_stb."'";
	
	//echo $update_data;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'list_stb.php';
    </script>";
}

$plugins = '';

    $title	= 'Form stb';
    $submenu	= "stb";
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