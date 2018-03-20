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
    $id_area	= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $query_area = "SELECT * FROM `gx_area` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `id_area`='".$id_area."' LIMIT 0,1;";
    $sql_area	= mysql_query($query_area, $conn);
    $row_area	= mysql_fetch_array($sql_area);
    
}
    
    $content ='<section class="content-header">
                    <h1>
                        Master Area
                        
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Form Area</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form action="" role="form" method="post" enctype="multipart/form-data">
				    
                                    <div class="box-body">
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kode Area</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="kode_area" value="'.(isset($_GET['id']) ? $row_area["kode_area"] : "").'">
						<input type="hidden" name="id_area" value="'.(isset($_GET['id']) ? $row_area["id_area"] : "").'">
						
					    </div>
                                        </div>
					</div>
					
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Nama Area</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="nama_area" value="'.(isset($_GET['id']) ? $row_area["nama_area"] : "").'">
					    </div>
                                        </div>
					</div>
                                        
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Provinsi</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="provinsi" value="'.(isset($_GET['id']) ? $row_area["provinsi"] : "").'">
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="kota" value="'.(isset($_GET['id']) ? $row_area["kota"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Kota/Kabupaten</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="kota_kab" value="'.(isset($_GET['id']) ? $row_area["kota_kab"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Wilayah</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="wilayah" value="'.(isset($_GET['id']) ? $row_area["wilayah"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Alamat</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="alamat" value="'.(isset($_GET['id']) ? $row_area["alamat"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Latitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="latitude" value="'.(isset($_GET['id']) ? $row_area["latitude"] : "").'">
						
					    </div>
                                        </div>
					</div>
					<div class="form-group">
					<div class="row">
					    <div class="col-xs-4">
						<label>Longitude</label>
					    </div>
					    <div class="col-xs-8">
						<input type="text" readonly="" class="form-control" name="longitude" value="'.(isset($_GET['id']) ? $row_area["longitude"] : "").'">
						
					    </div>
                                        </div>
					</div>
                                    </div><!-- /.box-body -->
				    
				   
                                    <div class="box-footer">
				    
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
			
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '';

    $title	= 'Detail Area';
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