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
    
$sql_cl = "SELECT * FROM `gx_tbsift` WHERE `level` = '0';";
//echo $sql_staff;
$query_cl = mysql_query($sql_cl, $conn);

    $content ='<section class="content-header">
                    <h1>
                        Sift
                        
                    </h1>
                    
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Sift</h3>
                                    <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'master_anyar/form_sift.php">Add New</a>
					</div>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped" id="cl" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Sift</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Actions</th>
                                        </tr>';

$no = 1;
while($row_cl = mysql_fetch_array($query_cl))
{
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_cl["sift"].'</a></td>
                    <td>'.$row_cl["check_in"].'</td>
                    <td>'.$row_cl["check_out"].'</td>
                    <td><a href="'.URL_ADMIN.'master_anyar/form_sift.php?id='.$row_cl["id"].'">Edit</a>
                </tr>';
    $no++;
}

$content .='
                                    </table>
				
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    
                </section><!-- /.content -->
            ';

$plugins = '
	<!-- DataTable -->
	<link href="'.URL.'css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
	<!-- DATA TABES SCRIPT -->
        <script src="'.URL.'js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="'.URL.'js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(\'#staff\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
	
    ';

    $title	= 'master_sift';
    $submenu	= "sift";
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