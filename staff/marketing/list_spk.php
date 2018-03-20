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
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
	
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["id_employee"], "Open list SPK marketing");
    global $conn;
    global $conn_voip;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
     
    $content ='<section class="content-header">
                    <h1>
                        Master SPK Survey
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="spk_survey">Master SPK Survey</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
				
                                <div class="box-body table-responsive">
				
				<div class="box-header">
                                    <h3 class="box-title">List SPK Survey</h3>
                                </div><!-- /.box-header -->
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>No. Survey</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. telp</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_mastersurvey = mysql_query("SELECT * FROM `gx_survey` WHERE `level` = '0' AND `marketing` = '$loggedin[id_employee]' ORDER BY `id_survey` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_mastersurvey = mysql_num_rows(mysql_query("SELECT * FROM `gx_survey` WHERE `level` = '0' AND `marketing` = '$loggedin[id_employee]' ORDER BY `id_survey` DESC;",$conn));
$hal			= "?";
$no = 1;
while ($row_mastersurvey = mysql_fetch_array($sql_mastersurvey))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_mastersurvey['no_spk_survey'].'</td>
		    <td>'.$row_mastersurvey['nama_cust'].'</td>
		    <td>'.$row_mastersurvey['alamat'].'</td>
		    <td>'.$row_mastersurvey['no_telp'].'</td>
		    <td align="center">
		    <a href="detail_survey?id_survey='.$row_mastersurvey['id_survey'].'" onclick="return valideopenerform(\'detail_survey?id_survey='.$row_mastersurvey['id_survey'].'\',\'view\');"><span class="label label-info">View</span></a> ||
		    <a href="form_jawab_survey?id_survey='.$row_mastersurvey['id_survey'].'"><span class="label label-info">Jawab SPK</span></a>
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
				    '.(halaman($sql_total_mastersurvey, $perhalaman, 1, $hal)).'
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

    $title	= 'Master SPK Survey';
    $submenu	= "spk";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
    $template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
}
    } else{
	header('location: '.URL_STAFF.'logout.php');
    }

?>