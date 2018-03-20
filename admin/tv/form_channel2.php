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
    $id_channel		= isset($_POST['id_channel']) ? mysql_real_escape_string(trim($_POST['id_channel'])) : '';
    if($id_channel !=""){
    //insert into gx_bagian
    $sql_insert_channel = "INSERT INTO `gx_tv_channel_provider` (`id_channel_provider`, `id_provider`, `id_channel`, 
                    `user_add`, `user_upd`, `date_add`, `date_upd`, `level`)
                    VALUES ('', '".$_GET["id"]."', '".$id_channel."',
                    '".$loggedin["username"]."', '".$loggedin["username"]."', NOW(), NOW(), '0');";
    //echo $sql_insert_staff;
    mysql_query($sql_insert_channel, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_insert_channel);
	
    echo "<script language='JavaScript'>
	alert('Data telah disimpan');
	window.location.href='detail_provider.php?id=".$_GET["id"]."';
	</script>";
	 }else{
		echo "<script language='JavaScript'>
		alert('Maaf Data tidak boleh kosong!');
		window.history.go(-1);
	    </script>";
	 }
    
}elseif(isset($_POST["update"]))
{
    $id_channel		= isset($_POST['id_channel']) ? mysql_real_escape_string(trim($_POST['id_channel'])) : '';
    
    //insert into gx_bagian
    $sql_update_channel = "UPDATE `gx_tv_channel_provider` SET `id_channel` = '".$id_channel."',
		    `user_upd` = '$loggedin[username]', `date_upd` = NOW()
		    WHERE `id_channel_provider` = '".$_GET["id_channel"]."';";
    //echo $sql_update_staff;
    mysql_query($sql_update_channel, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_channel);
   
    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='detail_provider.php?id=".$_GET["id"]."';
	</script>";
	
}
$id_channel_provider		= isset($_GET['id']) ? (int)$_GET['id'] : '';
if(isset($_GET["id"]))
{
    
    $query_channel 	= "SELECT * FROM `gx_tv_channel_provider` WHERE `id_channel_provider`='$id_channel_provider' LIMIT 0,1;";
    $sql_channel		= mysql_query($query_channel, $conn);
    $row_channel		= mysql_fetch_array($sql_channel);
    
}


    
    $content ='<section class="content-header">
                    <h1>
                        Master Provider
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Add Channel</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form name="form_channel" action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Channel</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" required="" class="form-control" name="nama" value=""  onclick="return valideopenerform(\'data_channel.php?r=form_channel&id='.$id_channel_provider.'\',\'channel\');">
												<input type="hidden" class="form-control" name="id_channel" value="'.(isset($_GET['id_channel']) ? $row_channel["id_channel"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Channel</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" required="" class="form-control" name="nama2" value=""  onclick="return valideopenerform(\'data_channel.php?r=form_channel&id='.$id_channel_provider.'&a=2\',\'channel\');">
												<input type="hidden" class="form-control" name="id_channel2" value="'.(isset($_GET['id_channel']) ? $row_channel["id_channel"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Channel</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" required="" class="form-control" name="nama3" value=""  onclick="return valideopenerform(\'data_channel.php?r=form_channel&id='.$id_channel_provider.'&a=3\',\'channel\');">
												<input type="hidden" class="form-control" name="id_channel3" value="'.(isset($_GET['id_channel']) ? $row_channel["id_channel"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Channel</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" required="" class="form-control" name="nama4" value=""  onclick="return valideopenerform(\'data_channel.php?r=form_channel&id='.$id_channel_provider.'&a=4\',\'channel\');">
												<input type="hidden" class="form-control" name="id_channel4" value="'.(isset($_GET['id_channel']) ? $row_channel["id_channel"] : "").'">
											</div>
										</div>
										</div>
										
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Channel</label>
											</div>
											<div class="col-xs-8">
												<input type="text" readonly="" required="" class="form-control" name="nama5" value=""  onclick="return valideopenerform(\'data_channel.php?r=form_channel&id='.$id_channel_provider.'&a=5\',\'channel\');">
												<input type="hidden" class="form-control" name="id_channel5" value="'.(isset($_GET['id_channel']) ? $row_channel["id_channel"] : "").'">
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