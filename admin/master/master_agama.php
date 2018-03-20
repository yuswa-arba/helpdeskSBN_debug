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
    
$sql_agama = "SELECT * FROM `gx_tbagama` WHERE `level` = '0';";
//echo $sql_staff;
$query_agama = mysql_query($sql_agama, $conn);

    $content ='
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Agama</h3>
                                    <div class="box-tools pull-right">
										<a href="'.URL_ADMIN.'master/form_agama.php" class="btn bg-olive btn-flat margin pull-right">Add New</a>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped" id="agama" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Agama</th>
                                            <th>Nama Agama</th>
                                            <th>Last Update</th>
                                            <th>Actions</th>
                                        </tr>';

$no = 1;
while($row_agama = mysql_fetch_array($query_agama))
{
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_agama["kode_agama"].'</a></td>
                    <td>'.$row_agama["nama_agama"].'</td>
                    <td>'.$row_agama["date_upd"].'</td>
                    <td><a href="form_agama.php?id='.$row_agama["id_agama"].'">Edit</a>
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

    $title	= 'Master agama';
    $submenu	= "master_agama";
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