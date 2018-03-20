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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open List Formulir");
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
                                    <h3 class="box-title">List Formulir Cetak</h3>
				    
                                </div><!-- /.box-header -->
                                    <table id="formulir" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Kode Cetak Formulir</th>
                                                <th>Nama Formulir</th>
                                                <th>Tanggal Cetak</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_cetakformulir = mysql_query("SELECT * FROM `gx_cetak_formulir` WHERE `level` = '0' AND `id_marketing` = '".$loggedin['id_employee']."' ORDER BY `id_cetak_formulir` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_cetakformulir = mysql_num_rows(mysql_query("SELECT * FROM `gx_cetak_formulir` WHERE `level` = '0' AND `id_marketing` = '".$loggedin['id_employee']."' ORDER BY `id_cetak_formulir` DESC;",$conn));
$hal		    = "?";
$no = 1;
while ($row_cetakformulir = mysql_fetch_array($sql_cetakformulir))
{
	$sql_cetakformulir_detail = mysql_query("SELECT * FROM `gx_formulir` WHERE `level` = '0' AND `id_formulir` = '$row_cetakformulir[id_formulir]' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
    $row_cetakformulir_detail = mysql_fetch_array($sql_cetakformulir_detail);
    $sql_cetakformulir_file = mysql_query("SELECT * FROM `gx_formulir_detail` WHERE `level` = '0' AND `id_formulir` = '$row_cetakformulir_detail[id_formulir]' ORDER BY `date_add` DESC LIMIT 0,1;",$conn);
    $row_cetakformulir_file = mysql_fetch_array($sql_cetakformulir_file);
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_cetakformulir['kode_cetak_formulir'].'</td>
		    <td>'.$row_cetakformulir_detail['nama_formulir'].'</td>
		    <td>'.$row_cetakformulir['tanggal'].'</td>
		    <td align="center"><a href="print_form.php?id='.$row_cetakformulir['id_cetak_formulir'].'" target="_blank"><span class="label label-info">View</span></a> 
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
				    '.(halaman($sql_total_cetakformulir, $perhalaman, 1, $hal)).'
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

    $title	= 'List Formulir Cetak';
    $submenu	= "list_formulir_cetak";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
	$id_bagian = $loggedin['id_bagian'];
	$template	= staff_theme($title,$content,$plugins,$user,$submenu,$group,$id_bagian);
    
    echo $template;
	
}
	}else{
	header("location: ".URL_STAFF."logout.php");
    }

?>