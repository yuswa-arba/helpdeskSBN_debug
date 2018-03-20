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
		enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open Form Template Email");
    
    

if(isset($_GET["id"])){

	$id_data	= isset( $_GET['id']) ? (int)$_GET['id'] : "";
	$query		= "SELECT * FROM `gx_template_notif` WHERE `level` = '0' AND `id` = '".$id_data."' AND `tipe` = '2' LIMIT 0,1";
	$sql_data	= mysql_query($query);
	$row_data	= mysql_fetch_array($sql_data);
	
	
}
    $content ='
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
						<form action="" method="post" name="form_email" autocomplete="off" enctype="multipart/form-data">
                            <div class="box">
								<div class="box-header">
                                    <h3 class="box-title">Form Template Email</h3>
                                </div><!-- /.box-header -->
												
                                <div class="box-body table-responsive">
				
		
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Judul</label>
				</div>
				<div class="col-xs-8">
					<input type="text" readonly="" class="form-control" required="" name="judul" value="'.(isset($_GET["id"]) ? $row_data["judul"] : '').'">
					<input type="hidden" name="id" readonly="" value="'.(isset($_GET["id"]) ? $row_data["id"] : '').'" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-2">
					<label>Template</label>
				</div>
				<div class="col-xs-10">
					<textarea name="isi" cols="40" rows="6" style="resize:none" readonly="">'.(isset($_GET["id"]) ? $row_data["isi"] : '').'</textarea>
				</div>
			</div>
		</div>
		
		</div><!-- /.box-body -->
			
                            </div><!-- /.box -->
							</form>
                        </div>
                    </div>

                </section><!-- /.content -->
            ';


$plugins = '';

    $title	= 'View Template SMS';
    $submenu	= "template_email";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
	}
	else
	{
		
		header("location: ".URL_ADMIN."logout.php");
	}
    }
	else
	{
		header("location: ".URL_ADMIN."logout.php");
    }

?>