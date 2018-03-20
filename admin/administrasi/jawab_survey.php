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
                                    <h3 class="box-title">List SPK Survey</h3>
				    <a href="form_jawab_survey" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. Jawab Survey</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. telp</th>
						<th>Tanggal</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_master_jawabsurvey = mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` = '0' ORDER BY `id_jawab_spksurvey` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_master_jawabsurvey = mysql_num_rows(mysql_query("SELECT * FROM `gx_jawab_spksurvey` WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` = '0' ORDER BY `id_jawab_spksurvey` DESC;",$conn));
$hal =	"?";
$no = 1;
while ($row_master_jawabsurvey = mysql_fetch_array($sql_master_jawabsurvey))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_master_jawabsurvey['no_jawab'].'</td>
		    <td>'.$row_master_jawabsurvey['nama'].'</td>
		    <td>'.$row_master_jawabsurvey['alamat'].'</td>
		    <td>'.$row_master_jawabsurvey['no_telp'].'</td>
		    <td>'.$row_master_jawabsurvey['date_add'].'</td>
		    <td align="center">
		    <a href="detail_jawab_survey?id='.$row_master_jawabsurvey['id_jawab_spksurvey'].'"><span class="label label-info">Detail</span></a>
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
				    '.(halaman($sql_total_master_jawabsurvey, $perhalaman, 1, $hal)).'
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

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="'.URL.'js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="'.URL.'js/AdminLTE/demo.js" type="text/javascript"></script>
	
    ';

    $title	= 'Master Jawab SPK Survey';
    $submenu	= "jawab_survey";
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