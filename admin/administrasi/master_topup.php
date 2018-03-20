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
     
if(isset($_GET["id"]) & isset($_GET["action"]))
{
    $id		= isset($_GET['id']) ? (int)$_GET['id'] : '';
    $action	= isset($_GET['action']) ? $_GET['action'] : '';
    
    if(($id != "") AND ($action == "lock")){
	
	$sql_update_lock = "UPDATE `gx_topup_dompet` SET `status`='1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
			 WHERE (`id_bankmasuk`='".$id."');";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: master_topup.php");

}
     
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Topup Dompet</h3>
				    <div class="box-tools pull-right">
					
					<div class="btn bg-olive btn-flat margin">
					     <a href="form_topup.php">Create New</a>
					</div>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="bankmasuk" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>No.</th>
                                                <th style="width: 120px">No. Transaction</th>
                                                <th style="width: 220px">Date</th>
                                                <th>Customer Number</th>
                                                <th>Nama</th>
						<th>Bank Code</th>
						<th>Nominal</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_bankmasuk = mysql_query("SELECT * FROM `gx_topup_dompet`
			      WHERE `level` = '0' ORDER BY `id_bankmasuk` DESC LIMIT $start, $perhalaman;", $conn);
$sql_total_bankmasuk = mysql_num_rows(mysql_query("SELECT * FROM `gx_topup_dompet`
			      WHERE `level` = '0' ORDER BY `id_bankmasuk` DESC;", $conn));
$hal	="?";

$no = 1;
while ($row_bankmasuk = mysql_fetch_array($sql_bankmasuk))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_bankmasuk["transaction_id"].'</td>
		    <td>'.$row_bankmasuk["tgl_transaction"].'</td>
		    <td>'.$row_bankmasuk["id_customer"].'</td>
		    <td>'.$row_bankmasuk["nama"].'</td>
		    <td>'.$row_bankmasuk["bank_code"].'</td>
			<td>'.number_format($row_bankmasuk["nominal"], 0, "", ".").'</td>
		    <td align="center">'.(($row_bankmasuk["status"] == "1") ? '<a href="detail_topup?bm='.$row_bankmasuk["transaction_id"].'"><span class="label label-info">View</span></a>' :
			   '<a href="form_topup?id='.$row_bankmasuk["id_bankmasuk"].'"><span class="label label-info">Edit</span></a>
			    <a href="?id='.$row_bankmasuk["id_bankmasuk"].'&action=lock"><span class="label label-info">Lock</span></a>
			    ').'
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
				    '.(halaman($sql_total_bankmasuk, $perhalaman, 1, $hal)).'
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
                $(\'#bankmasuk\').dataTable({
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

    $title	= 'Master Topup Dompet';
    $sumasukenu	= "topup_dompet";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$sumasukenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>