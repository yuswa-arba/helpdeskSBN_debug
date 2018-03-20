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
	
	$sql_update_lock = "UPDATE `gx_transaksi` SET `status`='1', `date_upd` = NOW(), `user_upd`= '".$loggedin["username"]."'
			 WHERE (`id_transaksi`='".$id."');";
	
	//echo $sql_update;
	mysql_query($sql_update_lock, $conn) or die (mysql_error());
	//log
	enableLog("",$loggedin["username"], $loggedin["id_employee"],$sql_update_lock);
    }
    header("location: master_transaksi.php");

}
     
    $content ='<!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List Bank Masuk</h3>
				    
					
					
                                </div><!-- /.box-header -->
                                <div class="box-body">
								   <div class="row">
										<div class="col-xs-12">
											 <div class="pull-right">
											 <a href="form_transaksi_detail.php" class="btn bg-olive btn-flat margin">Create New</a>
											 
											 </div>
										</div>
								   </div>
                                    <table id="transaksi" class="table table-bordered table-striped table-responsive">
                                        <thead>
                                            <tr>
						<th>No.</th>
                                                <th style="width: 120px">No. Transaction</th>
                                                <th>Date</th>
                                                <th>Customer Number</th>
                                                <th>Nama</th>
												<th>Nomer VA</th>
						<th>Bank Code</th>
						<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_transaksi = mysql_query("SELECT * FROM `v_transaksi`
			      WHERE `level` = '0' ORDER BY `id_transaksi` DESC LIMIT $start, $perhalaman;", $conn);
$sql_total_transaksi = mysql_num_rows(mysql_query("SELECT * FROM `v_transaksi`
			      WHERE `level` = '0' ORDER BY `id_transaksi` DESC;", $conn));
$hal	="?";

$no = $start + 1;
while ($row_transaksi = mysql_fetch_array($sql_transaksi))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_transaksi["transaction_id"].'</td>
		    <td>'.$row_transaksi["tgl_transaction"].'</td>
		    <td>'.$row_transaksi["id_customer"].'</td>
		    <td>'.$row_transaksi["nama"].'</td>
			<td>'.$row_transaksi["nomer_va"].'</td>
		    <td>'.$row_transaksi["bank_code"].'</td>
		    <td align="center">'.(($row_transaksi["status"] == "1") ? '<a href="detail_transaksi?bm='.$row_transaksi["transaction_id"].'"><span class="label label-info">View</span></a>' : '<a href="form_bm_detail?bm='.$row_transaksi["transaction_id"].'"><span class="label label-info">Detail</span></a>
			    <a href="form_transaksi?id='.$row_transaksi["id_transaksi"].'"><span class="label label-info">Edit</span></a>
			    <a href="?id='.$row_transaksi["id_transaksi"].'&action=lock"><span class="label label-info">Lock</span></a>
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
				    '.(halaman($sql_total_transaksi, $perhalaman, 1, $hal)).'
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
    ';

    $title	= 'Master Bank Masuk';
    $sumasukenu	= "transaksi";
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