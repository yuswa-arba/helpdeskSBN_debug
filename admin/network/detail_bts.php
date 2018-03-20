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
    

if(isset($_GET["id"]))
{
    $id_data	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_bts 	= "SELECT * FROM `gx_bts` WHERE `id_bts`='".$id_data."' LIMIT 0,1;";
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
                                    <h3 class="box-title">Form BTS</h3>
                                </div><!-- /.box-header -->
                                
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode BTS</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="kode_bts" value="'.(isset($_GET['id']) ? $row_data["kode_bts"] : "").'">
						<input type="hidden" name="id_bts" value="'.(isset($_GET['id']) ? $row_data["id_bts"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama BTS</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="nama_bts" value="'.(isset($_GET['id']) ? $row_data["nama_bts"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="action" value="'.(isset($_GET['id']) ? $row_data["alamat"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Contact person</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="contact_person" value="'.(isset($_GET['id']) ? $row_data["contact_person"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Telpon</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="telpon" value="'.(isset($_GET['id']) ? $row_data["telpon"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="latitude" value="'.(isset($_GET['id']) ? $row_data["latitude"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" class="form-control" name="longitude" value="'.(isset($_GET['id']) ? $row_data["longitude"] : "").'">
						
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
									
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Form Area';
    $submenu	= "master_area";
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