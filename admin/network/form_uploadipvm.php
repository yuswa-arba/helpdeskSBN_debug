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
   $type_ip			= isset($_POST['type_ip']) ? mysql_real_escape_string(trim($_POST['type_ip'])) : '';
    
    if($type_ip != ""){
		if (is_uploaded_file($_FILES['filename']['tmp_name'])) {

			//Import uploaded file to Database
		    $handle = fopen($_FILES['filename']['tmp_name'], "r");
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
		        $import = "INSERT INTO `gx_master_ipvm` (`id_ip`, `ip_address`, `keterangan_ip`, `userid_ip`, `flag_ip`, `type_ip`, `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
				VALUES (NULL, '".ip2long($data[0])."', '', '', '', '".$type_ip."',
				'".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
				mysql_query($import) or die(mysql_error());
				//echo $import;
			}
 
			fclose($handle);
		
			echo "<script language='JavaScript'>
				alert('Data telah disimpan');
				window.location.href='master_ipvm.php';
				</script>";
		}
	}else{
	echo "<script language='JavaScript'>
		alert('Maaf Data tidak bisa diupdate ke dalam Database, Ada kesalahan!');
		window.history.go(-1);
	</script>";
	}
    
}


    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form IP Address</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Tipe</label>
					    </div>
					    <div class="col-xs-4">
						
						<select class="form-control"name="type_ip">
							<option value="public">IP Public</option>
							<option value="private">IP Private</option>
						</select>
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>File CSV</label>
					    </div>
					    <div class="col-xs-4">
						<input class="form-control" type="file" name="filename">
					    </div>
                                        </div>
					</div>
                                        
					
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form VLAN';
    $submenu	= "master_ip";
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