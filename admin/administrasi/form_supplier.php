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
    
    $kode_supplier	= isset($_POST['kode_supplier']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_supplier']))) : "";
    $nama_supplier	= isset($_POST['nama_supplier']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_supplier']))) : "";
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat']))) : "";
    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(strip_tags(trim($_POST['kota']))) : "";
    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pos']))) : "";
    $negara		= isset($_POST['negara']) ? mysql_real_escape_string(strip_tags(trim($_POST['negara']))) : "";
    $no_telpon		= isset($_POST['no_telpon']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_telpon']))) : "";
    $no_fax		= isset($_POST['no_fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_fax']))) : "";
    $contact_person	= isset($_POST['contact_person']) ? mysql_real_escape_string(strip_tags(trim($_POST['contact_person']))) : "";
    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_supplier']))) : "";
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    $acc_hutang		= isset($_POST['acc_hutang']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_hutang']))) : "";
    $beli_intern	= isset($_POST['beli_intern']) ? mysql_real_escape_string(strip_tags(trim($_POST['beli_intern']))) : "";
    
    if(($kode_supplier != NULL))
    {
	$insert_data    	= "INSERT INTO `gx_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`,
	`alamat`, `kota`, `kode_pos`, `negara`, `no_telpon`, `no_fax`, `contact_person`, `email`, `keterangan`,
	`acc_hutang`, `beli_intern`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_supplier."', '".$nama_supplier."',
	'".$alamat."', '".$kota."', '".$kode_pos."', '".$negara."',
	'".$no_telpon."', '".$no_fax."', '".$contact_person."', '".$email."',
	'".$keterangan."', '".$acc_hutang."', '".$beli_intern."', 
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
	    location.href = 'master_supplier';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_supplier	= isset($_POST['id_supplier']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_supplier']))) : "";
    $kode_supplier	= isset($_POST['kode_supplier']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_supplier']))) : "";
    $nama_supplier	= isset($_POST['nama_supplier']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_supplier']))) : "";
    $alamat		= isset($_POST['alamat']) ? mysql_real_escape_string(strip_tags(trim($_POST['alamat']))) : "";
    $kota		= isset($_POST['kota']) ? mysql_real_escape_string(strip_tags(trim($_POST['kota']))) : "";
    $kode_pos		= isset($_POST['kode_pos']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_pos']))) : "";
    $negara		= isset($_POST['negara']) ? mysql_real_escape_string(strip_tags(trim($_POST['negara']))) : "";
    $no_telpon		= isset($_POST['no_telpon']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_telpon']))) : "";
    $no_fax		= isset($_POST['no_fax']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_fax']))) : "";
    $contact_person	= isset($_POST['contact_person']) ? mysql_real_escape_string(strip_tags(trim($_POST['contact_person']))) : "";
    $email		= isset($_POST['email']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_supplier']))) : "";
    $keterangan		= isset($_POST['keterangan']) ? mysql_real_escape_string(strip_tags(trim($_POST['keterangan']))) : "";
    $acc_hutang		= isset($_POST['acc_hutang']) ? mysql_real_escape_string(strip_tags(trim($_POST['acc_hutang']))) : "";
    $beli_intern	= isset($_POST['beli_intern']) ? mysql_real_escape_string(strip_tags(trim($_POST['beli_intern']))) : "";
    
    if(($id_supplier != NULL) AND ($kode_supplier != NULL))
    {
	$update_data   	= "UPDATE `gx_supplier` SET `kode_supplier`='".$kode_supplier."', `nama_supplier`='".$nama_supplier."',
	`alamat`='".$alamat."', `kota`='".$kota."',
	`kode_pos`='".$kode_pos."', `negara`='".$negara."',
	`no_telpon`='".$no_telpon."', `no_fax`='".$no_fax."',
	`contact_person`='".$contact_person."', `email`='".$email."',
	`keterangan`='".$keterangan."', `acc_hutang`='".$acc_hutang."',
	`beli_intern`='".$beli_intern."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE `id_supplier`='".$id_supplier."'";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_supplier.php';
    </script>";
}

if(isset($_GET['id'])){
    $id_data 	= isset($_GET['id']) ? (int)$_GET['id'] : "";
    $sql_data	= "SELECT * FROM `gx_supplier` WHERE `id_supplier` = '".$id_data."';";
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
                                    <h3 class="box-title">Form Supplier</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_supplier"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-3">
						<label>Kode Supplier</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" required="" name="kode_supplier" value="'.(isset($_GET["id"]) ? $row_data['kode_supplier'] :"").'">
						<input type="hidden" name="id_supplier" value="'.(isset($_GET["id"]) ? $row_data['id_supplier'] :"").'">
						
					    </div>
					    <div class="col-xs-3">
						<label>Pembelian Intern</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text"  class="form-control" name="beli_intern" value="'.(isset($_GET["id"]) ? $row_data['beli_intern'] :"").'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-3">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-9">
						<input type="text" class="form-control" required="" name="nama_supplier" value="'.(isset($_GET["id"]) ? $row_data['nama_supplier'] :"").'">
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
					    
					    <div class="col-xs-3">
						<label>ACC Hutang</label>
					    </div>
					    <div class="col-xs-3">
						<input type="text" class="form-control" name="acc_hutang" value="'.(isset($_GET["id"]) ? $row_data['acc_hutang'] :"").'">
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

    $title	= 'Form Supplier';
    $submenu	= "master_supplier";
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