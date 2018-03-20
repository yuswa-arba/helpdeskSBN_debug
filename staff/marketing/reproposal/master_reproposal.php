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
    enableLog("", $loggedin["username"], $loggedin["username"], "Open Master reproposal");
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
                                    <h3 class="box-title">List Re Proposal</h3>
				    <a href="form_reproposal.php" class="btn bg-olive btn-flat margin pull-right">Add</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
				    <table id="brosur" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th>Cabang</th>
                                                <th>Kode Re Proposal</th>
                                                <th>Kode Proposal</th>
                                                <th>Nama Customer</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

if($loggedin["id_level"] == "Kabag"){
	$sql_masterreproposal = mysql_query("SELECT * FROM `gx_reproposal` WHERE `level` = '0' AND `id_cabang` = '$loggedin[cabang]' ORDER BY `id_reproposal` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_masterreproposal = mysql_num_rows(mysql_query("SELECT * FROM `gx_reproposal` WHERE `level` = '0' AND `id_cabang` = '$loggedin[cabang]' ORDER BY `id_reproposal` DESC;",$conn));
}else{
	$sql_masterreproposal = mysql_query("SELECT * FROM `gx_reproposal` WHERE `level` = '0' AND `user_add` = '$loggedin[username]' ORDER BY `id_reproposal` DESC LIMIT $start,$perhalaman;",$conn);
	$sql_total_masterreproposal = mysql_num_rows(mysql_query("SELECT * FROM `gx_reproposal` WHERE `level` = '0' AND `user_add` = '$loggedin[username]' ORDER BY `id_reproposal` DESC;",$conn));
}

$hal		    = "?";
$no = 1;
while ($row_masterreproposal = mysql_fetch_array($sql_masterreproposal))
{
	$sql_cabang = mysql_query("SELECT * FROM `gx_cabang` WHERE `id_cabang` = '$row_masterreproposal[id_cabang]' AND `level` = '0';",$conn);
	$row_cabang = mysql_fetch_array($sql_cabang);
	$sql_proposal = mysql_query("SELECT * FROM `gx_proposal` WHERE `id_proposal` = '$row_masterreproposal[id_proposal]' AND `level` = '0';",$conn);
	$row_proposal = mysql_fetch_array($sql_proposal);
	 $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_cabang['nama_cabang'].'</td>
		    <td>'.$row_masterreproposal['kode_reproposal'].'</td>
		    <td>'.$row_proposal['kode_proposal'].'</td>
		    <td>'.$row_masterreproposal['nama_customer'].'</td>
            <td>'.$row_masterreproposal['nama_perusahaan'].'</td>
		    <td align="center">
				<a href="reproposal?id='.$row_masterreproposal['id_reproposal'].'" target="_BLANK"><span class="label label-info">View PDF</span></a> <a href="detail_reproposal?id='.$row_masterreproposal['id_reproposal'].'"><span class="label label-info">Detail</span></a> <a href="form_reproposal?id='.$row_masterreproposal['id_reproposal'].'"><span class="label label-info">Edit</span></a>
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
				    '.(halaman($sql_total_masterreproposal, $perhalaman, 1, $hal)).'
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

    $title	= 'Master Re Proposal';
    $submenu	= "reproposal";
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