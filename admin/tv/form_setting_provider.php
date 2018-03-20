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

if(isset($_POST["update"]))
{
    $persen_margin		= isset($_POST['persen_margin']) ? mysql_real_escape_string(trim($_POST['persen_margin'])) : '';
    
	//insert into gx_bagian
    $sql_update_provider = "UPDATE `software`.`gx_tv_provider_setting` SET `persen_margin`='".$persen_margin."',
	`user_upd` = '".$loggedin["username"]."', `date_upd` = NOW()
	WHERE (`id_setting`='1');";
    //echo $sql_update_staff;
    mysql_query($sql_update_provider, $conn) or die (mysql_error());
    //log
    enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_provider);

    echo "<script language='JavaScript'>
	alert('Data telah diupdate.');
	window.location.href='master_provider.php';
	</script>";
	
	
}
    
    $query_provider 	= "SELECT * FROM `gx_tv_provider_setting` WHERE `id_setting`='1' LIMIT 0,1;";
    $sql_provider		= mysql_query($query_provider, $conn);
    $row_provider		= mysql_fetch_array($sql_provider);
    
	


    
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
									
										<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<label>Persentase Margin Provider</label>
											</div>
											<div class="col-xs-4">
												<input type="text" class="form-control" name="persen_margin" value="'.$row_provider["persen_margin"].'">
											</div>
										</div>
										</div>
										
									
                                    </div><!-- /.box-body -->
									
				    
				   
                                    <div class="box-footer">
                                        <button type="submit" value="Submit" name="update" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Setting Provider';
    $submenu	= "channel_provider_setting";
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