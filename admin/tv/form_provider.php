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
	$id_parent	= isset($_POST['id_parent']) ? mysql_real_escape_string(trim($_POST['id_parent'])) : '';
    $nama		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$email		= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
    $no_telp	= isset($_POST['no_telp']) ? mysql_real_escape_string(trim($_POST['no_telp'])) : '';
    $keterangan	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
	$persentase_margin	= isset($_POST['persentase_margin']) ? mysql_real_escape_string(trim($_POST['persentase_margin'])) : '';
    
	//login provider
	$username		= isset($_POST['username']) ? mysql_real_escape_string(trim($_POST['username'])) : '';
    $password		= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
	$group			= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
    //insert into gx_bagian
    if($username !=""  AND $password !=""){
    $sql_insert_provider = "INSERT INTO `gx_tv_provider` (`id_provider`, `nama`, `alamat`, `email`, `no_telp`,
					`keterangan`, `id_parent`, `persentase_margin`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES ('', '$nama', '$alamat', '$email', '$no_telp', '$keterangan', '$id_parent', '$persentase_margin',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_provider, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_provider);
    
	$query_provider 	= "SELECT * FROM `gx_tv_provider` ORDER BY `id_provider` DESC ;";
    $sql_provider		= mysql_query($query_provider, $conn);
    $row_provider		= mysql_fetch_array($sql_provider);
    
    
		$sql_insert_login = "INSERT INTO `gx_login_provider` (`id_user`, `id_provider`, `username`, `password`, `group`,
				`password_date`,
				`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				VALUES (NULL, '".$row_provider["id_provider"]."', '".strtolower($username)."', '".md5($password)."',
				'".$group."', NOW(),
				'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
		//echo $sql_insert_login;
		mysql_query($sql_insert_login, $conn) or die (mysql_error());
		//log
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_login);
    
	}else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	    </script>";
	}
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='master_provider.php';
	</script>";
    
}
elseif(isset($_POST["update"]))
{
    $id_parent	= isset($_POST['id_parent']) ? mysql_real_escape_string(trim($_POST['id_parent'])) : '';
	$nama		= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(trim($_POST['alamat'])) : '';
	$email		= isset($_POST['email']) ? mysql_real_escape_string(trim($_POST['email'])) : '';
    $no_telp	= isset($_POST['no_telp']) ? mysql_real_escape_string(trim($_POST['no_telp'])) : '';
    $keterangan	= isset($_POST['keterangan']) ? mysql_real_escape_string(trim($_POST['keterangan'])) : '';
    $persentase_margin	= isset($_POST['persentase_margin']) ? mysql_real_escape_string(trim($_POST['persentase_margin'])) : '';
	
	//login
	$password		= isset($_POST['password']) ? mysql_real_escape_string(trim($_POST['password'])) : '';
    $group			= isset($_POST['group']) ? mysql_real_escape_string(trim($_POST['group'])) : '';
    //insert into gx_provider/distributor
    $sql_update_provider = "UPDATE `gx_tv_provider` SET `nama` = '".$nama."', `alamat` = '".$alamat."', `email` = '".$email."',
			`no_telp` = '".$no_telp."', `keterangan` = '".$keterangan."', `id_parent` = '".$id_parent."', `persentase_margin` = '".$persentase_margin."',
		    `user_upd` = '$loggedin[username]', `date_upd` = NOW()
		    WHERE `id_provider` = '".$_GET["id"]."';";
    //echo $sql_update_staff;
    mysql_query($sql_update_provider, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_provider);
   if($password !=""){
    $sql_update_provider_login = "UPDATE `software`.`gx_login_provider` SET `password` = MD5('".$password."'), `password_date` = NOW(),
	`group` = '".$group."', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
	WHERE (`id_provider`='".$_GET["id"]."');";
	
	mysql_query($sql_update_provider_login, $conn) or die (mysql_error());
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_provider_login);
   }
   else
   {
		$sql_update_provider_login = "UPDATE `software`.`gx_login_provider` SET 
		`group` = '".$group."', `user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
		WHERE (`id_provider`='".$_GET["id"]."');";
		
		mysql_query($sql_update_provider_login, $conn) or die (mysql_error());
		enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_provider_login);
   }
    echo "<script language='JavaScript'>
		alert('Data telah diupdate.');
		window.location.href='master_provider.php';
	</script>";
	
	
}

if(isset($_GET["id"]))
{
    $id_provider		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_provider 	= "SELECT * FROM `gx_tv_provider` WHERE `id_provider`='$id_provider' LIMIT 0,1;";
    $sql_provider		= mysql_query($query_provider, $conn);
    $row_provider		= mysql_fetch_array($sql_provider);
    
	$query_user	= "SELECT * FROM `gx_login_provider` WHERE `id_provider`='".$id_provider."' AND `level` = '0' LIMIT 0,1;";
    $sql_user	= mysql_query($query_user, $conn);
    $row_user	= mysql_fetch_array($sql_user);
    
}


    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Provider</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab_1" data-toggle="tab">Data Provider</a></li>
											<li><a href="#tab_2" data-toggle="tab">Data Login</a></li>
										</ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
										
										<div class="form-group">
											<div class="row">
												<div class="col-xs-4">
													<label>Group</label>
												</div>
												<div class="col-xs-8">
													<select name="id_parent" class="form-control">
														<option value="0" '.((isset($_GET['id']) AND $row_provider["id_parent"] == "distributor") ? 'selected=""' : "").'>No Group</option>';
														
$sql_parent = mysql_query("SELECT * FROM `gx_tv_provider` WHERE `id_parent` = '0' AND `level` = '0'");
while($row_parent = mysql_fetch_array($sql_parent))
{
	$content .='<option value="'.$row_parent["id_provider"].'" '.((isset($_GET['id']) AND $row_provider["id_parent"] == $row_parent["id_provider"]) ? 'selected=""' : "").'>'.$row_parent["nama"].'</option>';
}

									$content .='					
														
													</select>
												</div>
											</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Nama Provider</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" name="nama" value="'.(isset($_GET['id']) ? $row_provider["nama"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Alamat</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_provider["alamat"] : "").'">
											</div>
										</div>
										</div>
                                        
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Email</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" name="email" value="'.(isset($_GET['id']) ? $row_provider["email"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>No. Telpon</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" name="no_telp" value="'.(isset($_GET['id']) ? $row_provider["no_telp"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Keterangan</label>
											</div>
											<div class="col-xs-8">
												<input type="text" class="form-control" name="keterangan" value="'.(isset($_GET['id']) ? $row_provider["keterangan"] : "").'">
											</div>
										</div>
										</div>
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Persentase Margin Provider</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" required="" name="persentase_margin" value="'.(isset($_GET['id']) ? $row_provider["persentase_margin"] : "").'">
											</div>
										</div>
										</div>
										</div><!-- /.tab-pane -->
										
                                    <div class="tab-pane" id="tab_2">
                                        <div class="form-group">
									<div class="row">
										<div class="col-xs-4">
										<label>Username</label>
										</div>
										<div class="col-xs-8">
										<input type="text" required="" '.(isset($_GET['id']) ? 'readonly=""' : "").' class="form-control" name="username" value="'.(isset($_GET['id']) ? $row_user["username"] : "").'">
										<input type="hidden" name="id_user" value="'.(isset($_GET['id']) ? $row_user["id_user"] : "").'">
										</div>
														</div>
									</div>
														
									<div class="form-group">
									<div class="row">
										<div class="col-xs-4">
										<label>Password</label>
										</div>
										<div class="col-xs-8">
										<input type="text" '.(isset($_GET['id']) ? "" : 'required=""').' class="form-control" name="password" value="">
										</div>
														</div>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Group</label>
											</div>
											<div class="col-xs-8">
												<select name="group" class="form-control">
													<option value="distributor" '.((isset($_GET['id']) AND $row_user["group"] == "distributor") ? 'selected=""' : "").'>Distributor</option>
													<option value="provider" '.((isset($_GET['id']) AND $row_user["group"] == "provider") ? 'selected=""' : "").'>Provider</option>
												</select>
											</div>
										</div>
									</div>
					
                                    </div><!-- /.tab-pane -->
									
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

    $title	= 'Form Provider';
    $submenu	= "channel_provider";
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