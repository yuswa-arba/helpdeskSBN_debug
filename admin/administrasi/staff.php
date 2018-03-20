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
    
$sql_staff = "SELECT *
		FROM `gx_pegawai`
		WHERE `level` = '0'
                ORDER BY `gx_pegawai`.`nama` ASC, `gx_pegawai`.`level` ASC;";
//echo $sql_staff;
$query_staff = mysql_query($sql_staff, $conn);

    $content ='

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">List Staff </h3>
                                    <div class="box-tools pull-right">
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'master/form_staff.php">Add New</a>
					</div>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table class="table table-bordered table-striped" id="staff" style="width: 100%;">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Bagian</th>
                                            <th>Cabang</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>';

$no = 1;
while($row_staff = mysql_fetch_array($query_staff))
{
    if($row_staff["level"] == "1")
    {
        $status = '<span class="label label-danger">Nonaktif</span>';
    }elseif($row_staff["level"] == "0")
    {
        $status = '<span class="label label-success">Aktif</span>';
    }
    
    $sql_cabang = "SELECT *
		FROM `gx_cabang` 
                WHERE `id_cabang` = '".$row_staff["id_cabang"]."'
		AND `level` = '0'
		LIMIT 0,1;";
    $query_cabang = mysql_query($sql_cabang, $conn);
    $row_cabang = mysql_fetch_array($query_cabang);
    
    $content .='<tr>
                    <td>'.$no.'.</td>
                    <td>'.$row_staff["nama"].'</a></td>
                    <td>'.$row_staff["id_bagian"].'</td>
                    <td>'.$row_cabang["nama_cabang"].'</td>
		    <td>'.$row_staff["email"].'</td>
		    <td>'.$row_staff["hp"].'</td>
                    <td><a href="'.URL_ADMIN.'master/detail_staff.php?id='.$row_staff["id_employee"].'">View</a> | 
		    <a href="'.URL_ADMIN.'master/form_staff.php?id='.$row_staff["id_employee"].'">Edit</a>
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

    $title	= 'List Staff';
    $submenu	= "master_staff";
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