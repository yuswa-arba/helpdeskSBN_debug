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
    
    $kode_shipping	= isset($_POST['kode_shipping']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_shipping']))) : "";
    $nama_shipping	= isset($_POST['nama_shipping']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_shipping']))) : "";
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat']))) : "";
    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(strip_tags(trim($_POST['kota']))) : "";
    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pos']))) : "";
    $negara		= isset($_POST['negara']) ? mysql_real_escape_string(strip_tags(trim($_POST['negara']))) : "";
    $no_telpon		= isset($_POST['no_telpon']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_telpon']))) : "";
    $no_fax		= isset($_POST['no_fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_fax']))) : "";
    $contact_person	= isset($_POST['contact_person']) ? mysql_real_escape_string(strip_tags(trim($_POST['contact_person']))) : "";
    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_shipping']))) : "";
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    
    
    if(($kode_shipping != NULL))
    {
	$insert_data    	= "INSERT INTO `gx_shipping` (`id_shipping`, `kode_shipping`, `nama_shipping`,
	`alamat`, `kota`, `kode_pos`, `negara`, `no_telpon`, `no_fax`, `contact_person`, `email`, `keterangan`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_shipping."', '".$nama_shipping."',
	'".$alamat."', '".$kota."', '".$kode_pos."', '".$negara."',
	'".$no_telpon."', '".$no_fax."', '".$contact_person."', '".$email."',
	'".$keterangan."',
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
	    location.href = 'master_shipping';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_shipping	= isset($_POST['id_shipping']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_shipping']))) : "";
    $kode_shipping	= isset($_POST['kode_shipping']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_shipping']))) : "";
    $nama_shipping	= isset($_POST['nama_shipping']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_shipping']))) : "";
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat']))) : "";
    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(strip_tags(trim($_POST['kota']))) : "";
    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pos']))) : "";
    $negara		= isset($_POST['negara']) ? mysql_real_escape_string(strip_tags(trim($_POST['negara']))) : "";
    $no_telpon		= isset($_POST['no_telpon']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_telpon']))) : "";
    $no_fax		= isset($_POST['no_fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_fax']))) : "";
    $contact_person	= isset($_POST['contact_person']) ? mysql_real_escape_string(strip_tags(trim($_POST['contact_person']))) : "";
    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_shipping']))) : "";
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    
    if(($id_shipping != NULL) AND ($kode_shipping != NULL))
    {
	$update_data   	= "UPDATE `gx_shipping` SET `kode_shipping`='".$kode_shipping."', `nama_shipping`='".$nama_shipping."',
	`alamat`='".$alamat."', `kota`='".$kota."',
	`kode_pos`='".$kode_pos."', `negara`='".$negara."',
	`no_telpon`='".$no_telpon."', `no_fax`='".$no_fax."',
	`contact_person`='".$contact_person."', `email`='".$email."',
	`keterangan`='".$keterangan."', 
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_shipping`='".$id_shipping."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_shipping.php';
    </script>";
}

if(isset($_GET['id'])){
    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_shipping` WHERE `id_shipping` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form supplier id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form supplier");
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Shipping</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_shipping"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Shipping</label>
					    </div>
					    <div class="col-xs-6">
						<input type="text"  class="form-control" required="" name="kode_shipping" value="'.(isset($_GET["id"]) ? $row_data['kode_shipping'] :"").'">
						<input type="hidden" name="id_shipping" value="'.(isset($_GET["id"]) ? $row_data['id_shipping'] :"").'">
						
					    </div>
					    
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="nama_shipping" value="'.(isset($_GET["id"]) ? $row_data['nama_shipping'] :"").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="alamat" value="'.(isset($_GET["id"]) ? $row_data['alamat'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="kota" value="'.(isset($_GET["id"]) ? $row_data['kota'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Kode Pos</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="kode_pos" value="'.(isset($_GET["id"]) ? $row_data['kode_pos'] :"").'">
					    </div>
					    
					    <div class="col-xs-3">
						<label>Negara</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="negara" value="'.(isset($_GET["id"]) ? $row_data['negara'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>No Telepon</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_telpon" value="'.(isset($_GET["id"]) ? $row_data['no_telpon'] :"").'">
					    </div>
					    
					    <div class="col-xs-3">
						<label>No Fax</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="no_fax" value="'.(isset($_GET["id"]) ? $row_data['no_fax'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Contact Person</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="contact_person" value="'.(isset($_GET["id"]) ? $row_data['contact_person'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Email</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="email" value="'.(isset($_GET["id"]) ? $row_data['email'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Keterangan</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" name="keterangan" value="'.(isset($_GET["id"]) ? $row_data['keterangan'] :"").'">
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

$plugins = '';

    $title	= 'Form Shipping';
    $submenu	= "master_shipping";
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