<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
session_start();
include ("../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
	$sql_data = "SELECT * FROM `gx_service_plan` WHERE `level` = '0' LIMIT $start, $perhalaman;";
	//echo $sql_staff;
	$query_data = mysql_query($sql_data, $conn);
	$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_service_plan` WHERE  `level` = '0';", $conn));
	$hal = "?";

    $content ='<section class="content-header">
                    <h1>
                        Service Plan
                        
                    </h1>
                    
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Data</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
								<a href="form_serviceplan" class="btn bg-olive btn-flat margin pull-right">Create New</a>

								<!--<form action="" method="post" name="form_search">
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Nama</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" type="text" name="nama">
					</div>
					
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    <label>Email :</label>
					</div>
					<div class="col-xs-4">
					    <input class="form-control" name="email" type="text">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
				    <div class="form-group">
				    <div class="row">
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    <input class="btn bg-olive btn-flat" name="search" value="Search" type="submit">
					</div>
					<div class="col-xs-2">
					    
					</div>
					<div class="col-xs-4">
					    
					</div>
				    </div>
				    </div>
	</form>
	<hr>-->
							
								
                                    <table class="table table-bordered table-striped" id="ptkp" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
											<th>Tipe</th>
											<th>Kategori</th>
											<th>Status</th>
                                            <th>Created by</th>
                                            <th>Last Updated</th>
                                            <th>Actions</th>
                                        </tr>';

$no = $start + 1;
while($row_data = mysql_fetch_array($query_data))
{
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_data["nama"].'</td>
					<td>'.$row_data["tipe"].'</td>
					<td>'.$row_data["kategori"].'</td>
					<td>'.(($row_data["status"] == "1") ? "Aktif" : "Nonaktif" ).'</td>
                    <td>'.$row_data["user_add"].' on '.$row_data["date_add"].'</td>
                    <td>'.$row_data["user_upd"].' on '.$row_data["date_upd"].'</td>
                    <td><a href="view_serviceplan.php?id='.$row_data["id_service_plan"].'">View</a> | 
					<a href="form_serviceplan.php?id='.$row_data["id_service_plan"].'">Update</a></td>
                </tr>';
    $no++;
}

$content .='
                                    </table>
				
                                </div><!-- /.box-body -->
								<div class="box-footer">
				   <div class="box-tools pull-right">
				   '.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
				   </div>
				   <br style="clear:both;">
				</div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'List CSO';
    $submenu	= "cso";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;

}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>