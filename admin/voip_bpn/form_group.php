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
include ("../../config/configuration_voip_bpn.php");

redirectToHTTPS();
if($loggedin = logged_inAdmin()){ // Check if they are logged in
    if($loggedin["group"] == 'admin')
    {
        global $conn;
	global $conn_voip;
    
if(isset($_POST["save"]))
{
    $nama       	= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $desc       	= isset($_POST['desc']) ? mysql_real_escape_string(trim($_POST['desc'])) : '';
    
    
    //insert into tbPegawai
    $sql_insert = "INSERT INTO `mya2billing`.`cc_card_group` (`id`, `name`, `description`, `users_perms`, `id_agent`, `provisioning`)
    VALUES (NULL, '".$nama."', '".$desc."', '262142', NULL, NULL);";
    //echo $insert."<br>";
	
    //echo $sql_insert_customer;
    echo mysql_query($sql_insert, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert);
    
    
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='".URL_ADMIN."voip_bpn/group.php';
	</script>";
    
}elseif(isset($_POST["update"]))
{
    $id       	= isset($_POST['id_group']) ? mysql_real_escape_string(trim($_POST['id_group'])) : '';
    $nama      	= isset($_POST['nama']) ? mysql_real_escape_string(trim($_POST['nama'])) : '';
    $desc      	= isset($_POST['desc']) ? mysql_real_escape_string(trim($_POST['desc'])) : '';
   
    //Update into tbPegawai
    $sql_update = "UPDATE `mya2billing`.`cc_card_group` SET `name`='".$nama."', `description`='".$desc."'
		WHERE (`id`='".$id."');";
    
    //echo $sql_update_customer;
    echo mysql_query($sql_update, $conn_voip) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update);

   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='".URL_ADMIN."voip_bpn/group.php';
	</script>";
	
}

if(isset($_GET["id"]))
{
    $id_group		= isset($_GET['id']) ? $_GET['id'] : '';
    $query_group 	= "SELECT * FROM `cc_card_group` WHERE `id` ='".$id_group."' LIMIT 0,1;";
    $sql_group		= mysql_query($query_group, $conn_voip);
    $row_group		= mysql_fetch_array($sql_group);
    
}


    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <section class="col-lg-7"> 
                            <div class="box box-solid box-info">
                                <div class="box-header">
                                    <h3 class="box-title">Form Group</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
                                        
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Group</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" required="" name="nama" value="'.(isset($_GET['id']) ? $row_group["name"] : '').'">
						<input type="hidden" name="id_group" value="'.(isset($_GET['id']) ? $row_group["id"] : '').'" readonly="">
					    </div>
                                        </div>
					</div>
					
                                        <div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Deskripsi</label>
					    </div>
					    <div class="col-xs-8">
						<textarea class="form-control" name="desc" cols="10" rows="6" style="resize:none;">'.(isset($_GET['id']) ? $row_group["description"] : "").'</textarea>
					    </div>
                                        </div>
					</div>
                                        
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" '.(isset($_GET['id']) ? 'name="update"' : 'name="save"').' class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </section>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Group';
    $submenu	= "voip_group";
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