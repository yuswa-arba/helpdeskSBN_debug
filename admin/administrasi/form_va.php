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
    $nama_va      	= isset($_POST['nama_va']) ? mysql_real_escape_string(trim($_POST['nama_va'])) : '';
    $nama_rekening 	= isset($_POST['nama_rekening']) ? mysql_real_escape_string(trim($_POST['nama_rekening'])) : '';
    $kode_bank		= isset($_POST['kode_bank']) ? mysql_real_escape_string(trim($_POST['kode_bank'])) : '';
    
    if($nama_va != ""){
	//insert into gx_area
	$sql_insert = "INSERT INTO `gx_va` (`id_va`, `nama_va`, `nama_rekening`, `kode_bank`, 
			`user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
			VALUES (NULL, '".$nama_va."', '".$nama_rekening."', '".$kode_bank."',
			'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
	//echo $sql_insert_staff;
	mysql_query($sql_insert, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
	
	echo "<script language='JavaScript'>
	    alert('Data telah disimpan');
	    window.location.href='master_va.php';
	    </script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
    
}elseif(isset($_POST["update"]))
{
    $id_va		 	= isset($_POST['id_va']) ? mysql_real_escape_string(trim($_POST['id_va'])) : '';
    $nama_va      	= isset($_POST['nama_va']) ? mysql_real_escape_string(trim($_POST['nama_va'])) : '';
    $nama_rekening 	= isset($_POST['nama_rekening']) ? mysql_real_escape_string(trim($_POST['nama_rekening'])) : '';
    $kode_bank		= isset($_POST['kode_bank']) ? mysql_real_escape_string(trim($_POST['kode_bank'])) : '';
    
    if($id_va != "" AND $nama_va != ""){
	//insert into gx_area
	$sql_update = "UPDATE `gx_va` SET `nama_va`='".$nama_va."', `nama_rekening`='".$nama_rekening."', `kode_bank`='".$kode_bank."', 
			`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
			WHERE `id_va` = '".$id_va."';";
	//echo $sql_update_staff;
	mysql_query($sql_update, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);
	
	
	echo "<script language='JavaScript'>
	    alert('Data telah diupdate.');
	    window.location.href='master_va.php';
	    </script>";
    }else{
	echo "<script language='JavaScript'>
	    alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
	    window.history.go(-1);
	</script>";
    }
}

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_data = "SELECT * FROM `gx_va` WHERE `id_va`='".$id_data."' LIMIT 0,1;";
    $sql_data	= mysql_query($query_data, $conn);
    $row_data	= mysql_fetch_array($sql_data);
    
}

    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Virtual Account</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Virtual Account</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_va" value="'.(isset($_GET['id']) ? $row_data["nama_va"] : "").'">
						<input type="hidden" name="id_va" value="'.(isset($_GET['id']) ? $row_data["id_va"] : "").'">
						
					    </div>
                    </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Rekening</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_rekening" value="'.(isset($_GET['id']) ? $row_data["nama_rekening"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Bank</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_bank" value="'.(isset($_GET['id']) ? $row_data["kode_bank"] : "").'">
					    </div>
                                        </div>
					</div>
					
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

    $title	= 'Form Virtual Account';
    $submenu	= "master_va";
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