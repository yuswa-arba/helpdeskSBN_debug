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
    
$sql_cl = "SELECT * FROM `gx_check_lock` WHERE `level` = '0';";
//echo $sql_staff;
$query_cl = mysql_query($sql_cl, $conn);

    $content ='

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Check Lock</h3>
                                    <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'administrasi/form_checklock.php">Add New</a>
					</div>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped" id="cl" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Id Employee</th>
                                            <th>Nama</th>
                                            <th>tanggal</th>
                                            <th>jam Masuk</th>
                                            <th>jam Pulang</th>
                                            <th>Last Update</th>
                                            <th>Actions</th>
                                        </tr>';

$no = 1;
while($row_cl = mysql_fetch_array($query_cl))
{
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_cl["id_employee"].'</a></td>
                    <td>'.$row_cl["nama"].'</td>
                    <td>'.$row_cl["tanggal"].'</td>
                    <td>'.$row_cl["masuk"].'</a></td>
                    <td>'.$row_cl["pulang"].'</td>
                    <td>'.$row_cl["date_upd"].'</td>
                    <td><a href="'.URL_ADMIN.'administrasi/form_checklock.php?id='.$row_cl["id"].'">Edit</a>
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

    $title	= 'master_checklock';
    $submenu	= "check_lock";
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