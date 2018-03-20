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
if($loggedin = logged_inAdmin()){ // Check if they are logged in
if($loggedin["group"] == 'admin'){
    
    global $conn;
    
	//paging
    $perhalaman = 20;
    if (isset($_GET['page'])){
	    $page = (int)$_GET['page'];
	    $start=($page - 1) * $perhalaman;
    }else{
	    $start=0;
    }
	
$sql_data = "SELECT * FROM `gx_tipe_notif` LIMIT $start, $perhalaman;";
//echo $sql_staff;
$query_data = mysql_query($sql_data, $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_tipe_notif`;", $conn));
$hal = "?";

    $content ='

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Template</h3>
                                    <div class="box-tools pull-right">
					
					     <a href="form_kategori.php" class="btn bg-olive btn-flat margin">Add New</a>
					
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped" id="ptkp" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Tipe</th>
                                            <th>Keterangan</th>
                                            <th>Actions</th>
                                        </tr>';

$no = $start + 1;
while($row_data = mysql_fetch_array($query_data))
{
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_data["nama_tipe"].'</a></td>
                    <td>'.$row_data["keterangan"].'</td>
                    <td><a href="form_kategori.php?id='.$row_data["id_tipe"].'">Update</a></td>
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

    $title	= 'List Template Email';
    $submenu	= "template_email";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_ADMIN.'logout.php');
    }

?>