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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master Formulir");
    global $conn;
    global $conn_voip;
    
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
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">List Data</h3>
				    
                                </div><!-- /.box-header -->
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Kode Pegawai</th>
												<th>Nama Pegawai</th>
                                                <th>Kode Cetak Formulir</th>
                                                <th>Lokasi Formulir</th>
                                                <th>Tanggal Update Terakhir</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_data = mysql_query("SELECT * FROM `v_cetakformulir` WHERE `level` = '0' ORDER BY `id_formulir` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `v_cetakformulir` WHERE `level` = '0' ORDER BY `id_formulir` DESC;",$conn));
$hal		    = "?";
$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data['kode_pegawai'].'</td>
			<td>'.$row_data['nama'].'</td>
			<td>'.$row_data['kode_cetak_formulir'].'</td>
		    <td>'.$row_data['nama_formulir'].'</td>
		    <td>'.$row_data['date_upd'].'</td>
		    <td align="center"><!--<a href="view_formulir?id='.$row_data['id_formulir'].'" target="_blank"><span class="label label-info">View</span></a> || 
		    <a href="formulir?id='.$row_data['id_formulir'].'"><span class="label label-info">Edit</span></a>-->
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
				    '.(halaman($sql_total_data, $perhalaman, 1, $hal)).'
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

    $title	= 'List Cetak Formulir';
    $submenu	= "formulir";
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