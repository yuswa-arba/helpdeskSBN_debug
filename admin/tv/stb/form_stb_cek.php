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
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Check STB id=$id_data");
}if(isset($_GET['id_cek'])){
	$id_data_cek 	= isset($_GET['id_cek']) ? (int)$_GET['id_cek'] : "";
    $sql_data_cek	= "SELECT * FROM `gx_tv_stb_check` WHERE `id_stb` = '".$id_data_cek."';";
    $query_data_cek	= mysql_query($sql_data_cek, $conn);
    $row_data_cek	= mysql_fetch_array($query_data_cek);
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Check STB</h3>
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
						<input type="text" readonly="" class="form-control" name="kode_stb" value="'.(isset($_GET["id"]) ? $row_data['kode_stb'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>SN</label>
					    </div>
					    <div class="col-xs-8">
						<input type="hidden" readonly="" class="form-control" required="" name="id_stb" value="'.(isset($_GET["id"]) ? $row_data['id_stb'] :"").'">
						<input type="text" readonly=""class="form-control" name="sn" value="'.(isset($_GET["id"]) ? $row_data['sn'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>MAC</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="mac" value="'.(isset($_GET["id"]) ? $row_data['mac'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Version</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" required="" name="version" value="'.(isset($_GET["id"]) ? $row_data['version'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kelengkapan</label>
					    </div>
					    <div class="col-xs-8">
						
							<input type="checkbox"  name="stb" value="0" '.(isset($_GET["id_cek"]) && $row_data_cek['stb'] == "0" ? "checked" :"").'> STB 
							<input type="checkbox"  name="remote" value="0" '.(isset($_GET["id_cek"]) && $row_data_cek['remote'] == "0" ? "checked" :"").'> Remote
							<input type="checkbox"  name="kabel_hdmi" value="0" '.(isset($_GET["id_cek"]) && $row_data_cek['kabel_hdmi'] == "0" ? "checked" :"").'> HDMI
							<input type="checkbox"  name="adaptor" value="0" '.(isset($_GET["id_cek"]) && $row_data_cek['adaptor'] == "0" ? "checked" :"").'> STB 
							
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-8">
						<textarea name="keterangan" readonly="" id="keterangan" rows="6" cols="55" style="resize: none;">'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'</textarea>
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Status</label>
					    </div>
					    <div class="col-xs-8">
						
							
								<label class="btn btn-default">
									<input type="radio" name="status" value="0" '.(isset($_GET["id_cek"]) && $row_data_cek['check'] == "0" ? "checked" :"").' /> OK
								</label> 
								<label class="btn btn-default">
									<input type="radio" name="status" value="1" '.(isset($_GET["id_cek"]) && $row_data_cek['check'] == "1" ? "checked" :"").' /> Not Ok
								</label> 
								
							
					    </div>
                                        </div>
					</div>
					
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id_cek"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
if(isset($_POST["save"]))
{
    $id_stb		= isset($_POST['id_stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_stb']))) : "";
	$status		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
    $stb		= isset($_POST['stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['stb']))) : "";
    $remote		= isset($_POST['remote']) ? mysql_real_escape_string(strip_tags(trim($_POST['remote']))) : "";
    $kabel_hdmi	= isset($_POST['kabel_hdmi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kabel_hdmi']))) : "";
    $adaptor	= isset($_POST['adaptor']) ? mysql_real_escape_string(strip_tags(trim($_POST['adaptor']))) : "";
    
	$stb_check = isset($_POST['stb']) ? $stb : "1";
	$remote_check = isset($_POST['remote']) ? $remote : "1";
	$hdmi_check = isset($_POST['kabel_hdmi']) ? $kabel_hdmi : "1";
	$adaptor_check = isset($_POST['adaptor']) ? $adaptor : "1";
	
    
	$insert_data    	= "INSERT INTO `software`.`gx_tv_stb_check` (`id_check`, `id_stb`, `check`, `stb`, `remote`, `kabel_hdmi`, `adaptor`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$id_stb."', '".$status."', '".$stb_check."', '".$remote_check."', '".$hdmi_check."', '".$adaptor_check."',
	NOW(), NOW(), '".$loggedin["username"]."', '".$loggedin["username"]."','0')";
	//echo $insert_data;
	
	mysql_query($insert_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert data = ".$insert_data.".");
	
    
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'list_stb.php';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_stb		= isset($_POST['id_stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_stb']))) : "";
	$status		= isset($_POST['status']) ? mysql_real_escape_string(strip_tags(trim($_POST['status']))) : "";
    $stb		= isset($_POST['stb']) ? mysql_real_escape_string(strip_tags(trim($_POST['stb']))) : "";
    $remote		= isset($_POST['remote']) ? mysql_real_escape_string(strip_tags(trim($_POST['remote']))) : "";
    $kabel_hdmi	= isset($_POST['kabel_hdmi']) ? mysql_real_escape_string(strip_tags(trim($_POST['kabel_hdmi']))) : "";
    $adaptor	= isset($_POST['adaptor']) ? mysql_real_escape_string(strip_tags(trim($_POST['adaptor']))) : "";
    
	$stb_check = isset($_POST['stb']) ? $stb : "1";
	$remote_check = isset($_POST['remote']) ? $remote : "1";
	$hdmi_check = isset($_POST['kabel_hdmi']) ? $kabel_hdmi : "1";
	$adaptor_check = isset($_POST['adaptor']) ? $adaptor : "1";
	
	
	$update_data   	= "UPDATE `software`.`gx_tv_stb_check` SET `check`='".$status."', `stb`='".$stb_check."',
	`remote`='".$remote_check."', `kabel_hdmi`='".$hdmi_check."', `adaptor`='".$adaptor_check."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_stb`='".$id_stb."'";
	
	//echo $update_data;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'list_stb.php';
    </script>";
}

$plugins = '';

    $title	= 'Form stb Check';
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