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
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Bank Masuk");
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
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Bank Keluar</h3>
				    <div class="box-tools pull-right">
					
					     <a href="form_bankkeluar.php" class="btn bg-olive btn-flat margin">Create New</a>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="bankkeluar" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No.</th>
                                                <th style="width: 120px">No. Transaction</th>
                                                <th style="width: 220px">Date</th>
                                                <th>Customer Number</th>
                                                <th>Nama</th>
						<th>Bank Code</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_data = mysql_query("SELECT * FROM `gx_bank_keluar`
			      WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` = '0' ORDER BY `id_bankkeluar` DESC LIMIT $start, $perhalaman;", $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_bank_keluar`
			      WHERE `id_cabang` = '".$loggedin['cabang']."' AND `level` = '0' ORDER BY `id_bankkeluar` DESC;", $conn));
$hal	="?";
$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["transaction_id"].'</td>
		    <td>'.$row_data["tgl_transaction"].'</td>
		    <td>'.$row_data["id_customer"].'</td>
		    <td>'.$row_data["nama"].'</td>
		    <td>'.$row_data["bank_code"].'</td>
		    <td align="center">
		    <a href="form_bankkeluar.php?id='.$row_data['id_bankkeluar'].'"><span class="label label-info">Edit</span></a> |
		    <span class="label label-info">Detail</span></td>
		    
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
                            </form>
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
                $(\'#bankkeluar\').dataTable({
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

    $title	= 'Master Bank Keluar';
    $sukeluarenu	= "bankkeluar";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$sukeluarenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>