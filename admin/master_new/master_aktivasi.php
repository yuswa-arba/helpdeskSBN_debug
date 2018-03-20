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
if($loggedin["group"] == 'admin'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Aktivasi");
    global $conn;
    global $conn_voip;
    
    $content ='<section class="content-header">
                    <h1>
                        Master Aktivasi Baru
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="Master_aktivasi">Master Aktivasi Baru</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">List Aktivasi Baru</h3>
				    <a href="'.URL_ADMIN.'master_anyar/form_aktivasi" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                    <table id="persetujuan" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. Aktivasi</th>
                                                <th>Cabang</th>
                                                <th>Nama Cust</th>
                                                <th>Alamat</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_aktivasi = mysql_query("SELECT * FROM `gx_aktivasi` WHERE `level` = '0' ORDER BY `id_aktivasi` ASC LIMIT 0,100;",$conn);
$no = 1;
while ($row_aktivasi= mysql_fetch_array($sql_aktivasi))
{
$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `level` = '0' AND `id_cabang` = '$row_aktivasi[id_cabang]';",$conn);
$row_cabang = mysql_fetch_array($sql_cabang);

    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_aktivasi['kode_aktivasi'].'</td>
		    <td>'.$row_cabang['nama_cabang'].'</td>
		    <td>'.$row_aktivasi['nama_customer'].'</td>
		    <td>'.$row_aktivasi['alamat'].'</td>
		    <td align="center">
		    <a href="form_aktivasi?id='.$row_aktivasi['id_aktivasi'].'"><span class="label label-info">Edit</span></a>
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
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
                $(\'#customer\').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Master aktivasi';
    $submenu	= "master_aktivasi";
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