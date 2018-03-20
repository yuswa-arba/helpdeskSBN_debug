<?php
/*
 * Theme Name: Intranet Globalxtreme ver. 3.0
 * Website: http://202.58.203.27/~helpdesk/beta/
 * Author: Team Research GlobalXtreme.net
 * Version: 3.0  | 21 Mei 2014
 * Email:
 * Theme for http://202.58.203.27/~helpdesk/beta/
 */
include ("../../../config/configuration_admin.php");

redirectToHTTPS();
if($loggedin = logged_inStaff()){ // Check if they are logged in
//    echo checkRole($loggedin["id_group"], "dashboard");
if($loggedin["group"] == 'staff'){
if(($loggedin["id_bagian"]) != "Marketing")  { die( 'Access Denied!' );}
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master proposal");
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
                                    <h3 class="box-title">List Proposal</h3>
				    <a href="form_proposal.php" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="brosur" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Cabang</th>
                                                <th>Kode Proposal</th>
                                                <th>Kode Prospek</th>
                                                <th>Nama Customer</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

if($loggedin["id_level"] == "Kabag"){
	$sql_masterproposal = mysql_query("SELECT * FROM `gx_proposal` WHERE `level` = '0' AND `kode_cabang` = '$loggedin[cabang]' ORDER BY `id_proposal` DESC LIMIT $start,$perhalaman;",$conn);
}else{
	$sql_masterproposal = mysql_query("SELECT * FROM `gx_proposal` WHERE `level` = '0' AND `kode_cabang` = '$loggedin[cabang]' AND `user_add` = '$loggedin[username]' ORDER BY `id_proposal` DESC LIMIT $start,$perhalaman;",$conn);
}

$sql_total_masterproposal = mysql_num_rows(mysql_query("SELECT * FROM `gx_proposal` WHERE `level` = '0' ORDER BY `id_proposal` DESC;",$conn));
$hal		    = "?";
$no = 1;
while ($row_masterproposal = mysql_fetch_array($sql_masterproposal))
{
	 $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_masterproposal['nama_cabang'].'</td>
		    <td>'.$row_masterproposal['kode_proposal'].'</td>
		    <td>'.$row_masterproposal['no_prospek'].'</td>
		    <td>'.$row_masterproposal['nama_customer'].'</td>
            <td>'.$row_masterproposal['keterangan'].'</td>
		    <td align="center">
				<a href="proposal4?id='.$row_masterproposal['id_proposal'].'" target="_BLANK"><span class="label label-info">View PDF</span> </a>
				<a href="form_pdf_proposal?id='.$row_masterproposal['id_proposal'].'" target="_BLANK"><span class="label label-info">Form Content PDF</span> </a>
				<a href="detail_proposal?c='.$row_masterproposal['kode_proposal'].'"><span class="label label-info">Detail</span> </a>
				<a href="form_proposal?id='.$row_masterproposal['id_proposal'].'"><span class="label label-info">Edit</span></a>
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
				    '.(halaman($sql_total_masterproposal, $perhalaman, 1, $hal)).'
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

    $title	= 'Master Proposal';
    $submenu	= "proposal";
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