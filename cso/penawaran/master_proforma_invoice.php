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
if($loggedin = logged_inCSO()){ // Check if they are logged in
if($loggedin["group"] == 'cso'){
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master Proforma Invoice");
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
                                    <h3 class="box-title">List Proforma Invoice</h3>
				    <a href="form_proforma_invoice.php" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="brosur" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Cabang</th>
                                                <th>Kode Proforma</th>
                                                <th>Kode Penawaran</th>
                                                <th>Nama Customer</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_masterproforma = mysql_query("SELECT * FROM `gx_proforma_invoice` WHERE `level` = '0' ORDER BY `id_proforma` DESC LIMIT $start,$perhalaman;",$conn);
$sql_total_masterproforma = mysql_num_rows(mysql_query("SELECT * FROM `gx_proforma_invoice` WHERE `level` = '0' ORDER BY `id_proforma` DESC;",$conn));
$hal		    = "?";
$no = 1;
while ($row_masterproforma = mysql_fetch_array($sql_masterproforma))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterproforma['nama_cabang'].'</td>
		    <td>'.$row_masterproforma['kode_proforma'].'</td>
		    <td>'.$row_masterproforma['kode_penawaran'].'</td>
		    <td>'.$row_masterproforma['nama_customer'].'</td>
            <td>'.$row_masterproforma['keterangan'].'</td>
		    <td align="center"><a href="proforma_pdf?id='.$row_masterproforma['id_proforma'].'" target="_blank"><span class="label label-info">View PDF</span></a> || 
		    <a href="form_proforma_invoice?id='.$row_masterproforma['id_proforma'].'"><span class="label label-info">Edit</span></a>
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
				    '.(halaman($sql_total_masterproforma, $perhalaman, 1, $hal)).'
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

    $title	= 'Master Proforma Invoice';
    $submenu	= "proforma_invoice";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= cso_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header('location: '.URL_CSO.'logout.php');
    }

?>