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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master Penawaran");
    global $conn;
    
     $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
     
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-header">
                                    <h3 class="box-title">List Penawaran</h3>
				    <a href="form_penawaran.php" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="brosur" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Cabang</th>
                                                <th>Kode Penawaran</th>
                                                <th>Kode Prospek</th>
                                                <th>Nama Customer</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_masterpenawaran = mysql_query("SELECT * FROM `gx_penawaran` WHERE `level` = '0' ORDER BY `id_penawaran` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_masterpenawaran = mysql_num_rows(mysql_query("SELECT * FROM `gx_penawaran` WHERE `level` = '0' ORDER BY `id_penawaran` DESC;",$conn));
$hal		    = "?";
$no = 1;
while ($row_masterpenawaran = mysql_fetch_array($sql_masterpenawaran))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterpenawaran['nama_cabang'].'</td>
		    <td>'.$row_masterpenawaran['kode_penawaran'].'</td>
		    <td>'.$row_masterpenawaran['kode_prospek'].'</td>
		    <td>'.$row_masterpenawaran['nama_customer'].'</td>
            <td>'.$row_masterpenawaran['keterangan'].'</td>
		    <td align="center"><a href="penawaran_pdf?id='.$row_masterpenawaran['id_penawaran'].'" target="_blank"><span class="label label-info">View PDF</span></a> || 
		    <a href="form_penawaran?id='.$row_masterpenawaran['id_penawaran'].'"><span class="label label-info">Edit</span></a>
		    </td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <div class="box-tools pull-right">
				    '.(halaman($sql_total_masterpenawaran, $perhalaman, 1, $hal)).'
				    </div>
				    <br style="clear:both;">
				 </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            ';

$plugins = '
	<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />
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

    ';

    $title	= 'Master Penawaran';
    $submenu	= "penawaran";
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