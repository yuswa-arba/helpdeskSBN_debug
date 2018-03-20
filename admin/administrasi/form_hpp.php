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
    $sql_data	= "SELECT * FROM `gx_hpp` WHERE `id_hpp` = '".$id_data."';";
    $query_data	= mysql_query($sql_data, $conn);
    $row_data	= mysql_fetch_array($query_data);
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Update form hpp id=$id_data");
}else{
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "create new form hpp");
}
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Hitung Harga Pokok</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="form_hpp"  method="POST" action="">
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly="" name="kode_barang" value="'.(isset($_GET["id"]) ? $row_data['kode_barang'] :"").'" placeholder="Search Barang"
						onclick="return valideopenerform(\'data_barang.php?r=form_hpp&f=hpp\',\'barang\');">
						<input type="hidden"  class="form-control" readonly ="" name="id_hpp" value="'.(isset($_GET["id"]) ? $row_data['id_hpp'] :"").'">
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Barang</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" readonly ="" name="nama_barang" value="'.(isset($_GET["id"]) ? $row_data['nama_barang'] :"").'">
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga Pokok Pembelian (Rp)<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="hpp_rp" value="'.(isset($_GET["id"]) ? $row_data['hpp_rp'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-4">
						<label>Kurs</label>
					    </div>
					    <div class="col-xs-4">
					    <select name="kurs" class="form-control">';
						$query_matauang	= mysql_query("SELECT * FROM `gx_matauang` WHERE `level` = '0' ORDER BY `id_matauang` DESC ;", $conn);
						while ($row_matauang = mysql_fetch_array($query_matauang)) {
						    $content .='<option value="'.$row_matauang["kode_matauang"].'">'.$row_matauang["nama_matauang"].'</option>';
						}
					    $content .='</select>
						
						
					    </div>
                    </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga Beli (Rp)<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="harga_beli" value="'.(isset($_GET["id"]) ? $row_data['harga_beli'] :"").'">
						
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Shipping Cost<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="shipping_cost" value="'.(isset($_GET["id"]) ? $row_data['shipping_cost'] :"").'">
						
					    </div>
					</div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Harga Pokok Pembelian<label>
					    </div>
					    <div class="col-xs-8">
						<input type="text"  class="form-control" required="" name="hpp" value="'.(isset($_GET["id"]) ? $row_data['hpp'] :"").'">
						
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
    
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
    $hpp_rp			= isset($_POST['hpp_rp']) ? mysql_real_escape_string(strip_tags(trim($_POST['hpp_rp']))) : "";
    $kurs			= isset($_POST['kurs']) ? mysql_real_escape_string(strip_tags(trim($_POST['kurs']))) : "";
    $harga_beli		= isset($_POST['harga_beli']) ? mysql_real_escape_string(strip_tags(trim($_POST['harga_beli']))) : "";
	$shipping_cost	= isset($_POST['shipping_cost']) ? mysql_real_escape_string(strip_tags(trim($_POST['shipping_cost']))) : "";
	$hpp			= isset($_POST['hpp']) ? mysql_real_escape_string(strip_tags(trim($_POST['hpp']))) : "";
		
    if(($kode_barang != "") AND ($hpp != ""))
    {
	$insert_data    	= "INSERT INTO `gx_hpp` (`id_hpp`, `kode_barang`,
	`nama_barang`, `hpp_rp`, `kurs`, `harga_beli`, `shipping_cost`, `hpp`,
	`date_add`, `date_upd`, `user_add`, `user_upd`, `level`)
	VALUES (NULL, '".$kode_barang."', '".$nama_barang."',
	'".$hpp_rp."', '".$kurs."', '".$harga_beli."', '".$shipping_cost."', '".$hpp."',
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
	    location.href = 'master_hpp';
    </script>";
}elseif(isset($_POST["update"]))
{
    
    $id_hpp		= isset($_POST['id_hpp']) ? mysql_real_escape_string(strip_tags(trim($_POST['id_hpp']))) : "";
    $kode_barang	= isset($_POST['kode_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_barang']))) : "";
    $nama_barang	= isset($_POST['nama_barang']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama_barang']))) : "";
    $hpp_rp			= isset($_POST['hpp_rp']) ? mysql_real_escape_string(strip_tags(trim($_POST['hpp_rp']))) : "";
    $kurs			= isset($_POST['kurs']) ? mysql_real_escape_string(strip_tags(trim($_POST['kurs']))) : "";
    $harga_beli		= isset($_POST['harga_beli']) ? mysql_real_escape_string(strip_tags(trim($_POST['harga_beli']))) : "";
	$shipping_cost	= isset($_POST['shipping_cost']) ? mysql_real_escape_string(strip_tags(trim($_POST['shipping_cost']))) : "";
	$hpp			= isset($_POST['hpp']) ? mysql_real_escape_string(strip_tags(trim($_POST['hpp']))) : "";
	
    if(($id_hpp != "") AND ($kode_barang != ""))
    {
	$update_data   	= "UPDATE `gx_hpp` SET `kode_barang`='".$kode_barang."',
	`nama_barang`='".$nama_barang."', `hpp_rp`='".$hpp_rp."', `kurs`='".$kurs."',
	`harga_beli`='".$harga_beli."', `shipping_cost`='".$shipping_cost."', `hpp`='".$hpp."',
	`date_upd`=NOW(), `user_upd`='".$loggedin["username"]."' WHERE (`id_hpp`='".$id_hpp."');";
	
	//echo $insert_bank;
	mysql_query($update_data, $conn) or die ("<script language='JavaScript'>
						   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
						   window.history.go(-1);
					       </script>");
	enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit data = ".mysql_real_escape_string($update_data).".");
    }
    echo "<script language='JavaScript'>
	    alert('Data telah disimpan!');
	    location.href = 'master_hpp.php';
    </script>";
}

$plugins = '';

    $title	= 'Hitung Harga Pokok';
    $submenu	= "hpp";
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