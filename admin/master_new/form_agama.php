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
    $kode_agama       	= isset($_POST['kode_agama']) ? mysql_real_escape_string(trim($_POST['kode_agama'])) : '';
    $nama_agama       	= isset($_POST['nama_agama']) ? mysql_real_escape_string(trim($_POST['nama_agama'])) : '';
    
    //insert into gx_bagian
    $sql_insert_agama = "INSERT INTO `gx_tbagama` (`id_agama`, `kode_agama`, `nama_agama`,
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES ('', '$kode_agama', '$nama_agama',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_agama, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_agama);
    
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."master_anyar/master_agama.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id_agama	 	= isset($_POST['id_agama']) ? mysql_real_escape_string(trim($_POST['id_agama'])) : '';
    $kode_agama       	= isset($_POST['kode_agama']) ? mysql_real_escape_string(trim($_POST['kode_agama'])) : '';
    $nama_agama       	= isset($_POST['nama_agama']) ? mysql_real_escape_string(trim($_POST['nama_agama'])) : '';
    
    //insert into gx_bagian
    $sql_update_agama = "UPDATE `gx_tbagama` SET `kode_agama` = '$kode_agama', `nama_agama` = '$nama_agama',
		    `user_upd` = '$loggedin[username]', `date_upd` = NOW()
		    WHERE `id_agama` = '$id_agama';";
    //echo $sql_update_staff;
    mysql_query($sql_update_agama, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_agama);
    
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."master_anyar/master_agama.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_agama		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_agama 	= "SELECT * FROM `gx_tbagama` WHERE `id_agama`='$id_agama' LIMIT 0,1;";
    $sql_agama		= mysql_query($query_agama, $conn);
    $row_agama		= mysql_fetch_array($sql_agama);
    
}

$jum_staff	= mysql_num_rows(mysql_query("SELECT * FROM `tbPegawai`", $conn));
    
    $content ='<section class="content-header">
                    <h1>
                        Master Agama
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Agama</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Agama</label>
					    </div>
					    <div class="col-xs-4">
						<input type="text" class="form-control" name="kode_agama" value="'.(isset($_GET['id']) ? $row_agama["kode_agama"] : "").'">
						<input type="hidden" name="id_agama" value="'.(isset($_GET['id']) ? $row_agama["id_agama"] : "").'">
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Name Agama</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_agama" value="'.(isset($_GET['id']) ? $row_agama["nama_agama"] : "").'">
						
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

    $title	= 'Form Agama';
    $submenu	= "master_agama";
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