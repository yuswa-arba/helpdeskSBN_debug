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
    
if(isset($_GET['id_bank'])){
		$get_id = isset($_GET['id_bank']) ? mysql_real_escape_string(strip_tags(trim($_GET['id_bank']))) : "";
		$data_bank = mysql_fetch_array(mysql_query("SELECT `id_bank`, `kode_bank`, `nama`, `no_rek`, `no_acc`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_bank` WHERE `id_bank` = '$get_id';", $conn));
	    }
    
    $content ='<section class="content-header">
                    <h1>
                        Form bank
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form bank</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="myForm"  method="POST" action="">
                                    <div class="box-body">
					<div class="col-xs-12">
					<div class="form-group">
					
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>Kode bank</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text"  class="form-control" required="" name="kode_bank" value="'.(isset($_GET["id_bank"]) ? $data_bank['kode_bank'] :"").'">
						
					    </div>
					</div>
					</div>
					
					<div class="form-group">
					<div class="row">    
					    
					    <div class="col-xs-2">
						<label>Nama</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" class="form-control" required="" name="nama" value="'.(isset($_GET["id_bank"]) ? $data_bank['nama'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. Rekening</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" required="" class="form-control"  name="no_rek" value="'.(isset($_GET["id_bank"]) ? $data_bank['no_rek'] :"").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-2">
						<label>No. ACC</label>
					    </div>
					    <div class="col-xs-10">
						<input type="text" required="" class="form-control" name="no_acc" value="'.(isset($_GET["id_bank"]) ? $data_bank['no_acc'] :"") .'">
					    </div>
                                        </div>
					</div>
					
					</div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="submit" name="'.(isset($_GET["id_bank"]) ? "update" : "save") .'" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';
$save = isset($_POST["save"]) ? $_POST["save"] : "";
$update = isset($_POST["update"]) ? $_POST["update"] : "";

	if($save == "Save"){
	    
	    $kode_bank		= isset($_POST['kode_bank']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_bank']))) : "";
	    $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
	    $no_rek		= isset($_POST['no_rek']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_rek']))) : "";
	    $no_acc		= isset($_POST['no_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_acc']))) : "";
	    
	    
		    
		$insert_bank    	= "INSERT INTO `gx_bank`(`id_bank`, `kode_bank`, `nama`, `no_rek`, `no_acc`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level`) VALUES (NULL,'$kode_bank','$nama','$no_rek','$no_acc',NOW(),NOW(),'$loggedin[username]','$loggedin[username]','0')";
		//echo $insert_bank;
		mysql_query($insert_bank, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diinsert ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Insert bank = $insert_bank");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_bank';
		</script>";
	}elseif($update == "Save"){
	    
	    $kode_bank		= isset($_POST['kode_bank']) ? mysql_real_escape_string(strip_tags(trim($_POST['kode_bank']))) : "";
	    $nama		= isset($_POST['nama']) ? mysql_real_escape_string(strip_tags(trim($_POST['nama']))) : "";
	    $no_rek		= isset($_POST['no_rek']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_rek']))) : "";
	    $no_acc		= isset($_POST['no_acc']) ? mysql_real_escape_string(strip_tags(trim($_POST['no_acc']))) : "";
	    
		    
		$insert_bank    	= "UPDATE `gx_bank` SET `kode_bank`='$kode_bank',
		`nama`='$nama',`no_rek`='$no_rek',`no_acc`='$no_acc',
		`date_upd`=NOW(),`user_upd`='$loggedin[username]' WHERE `id_bank`='$_GET[id_bank]'";
		
		
		//echo $insert_bank;
		mysql_query($insert_bank, $conn) or die ("<script language='JavaScript'>
							   alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
							   window.history.go(-1);
						       </script>");
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "edit bank = $insert_bank");
		
		echo "<script language='JavaScript'>
			alert('Data telah disimpan!');
			location.href = 'master_bank.php';
		</script>";
	}

$plugins = '
    ';

    $title	= 'Form Survey';
    $submenu	= "survey";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>