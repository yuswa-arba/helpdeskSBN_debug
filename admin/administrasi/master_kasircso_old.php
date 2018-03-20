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
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master kasir");
    global $conn;
    
    $perhalaman = 20;
     if (isset($_GET['page'])){
	     $page = (int)$_GET['page'];
	     $start=($page - 1) * $perhalaman;
     }else{
	     $start=0;
     }
     
    if(isset($_POST["hapus"]))
    {
        $id_kasir = array();
        $id_kasir = isset($_POST["id_kasir"]) ? $_POST["id_kasir"] : $id_kasir;
        
        foreach($id_kasir as $key => $value)
        {
	    $query = "UPDATE `gx_kasir_cso` SET date_upd`=NOW(),`user_upd`='".$loggedin["username"]."',
	    `level`='1' WHERE `id_kasir_cso`='".$value."'";   
            
            $sql_update = mysql_query($query, $conn) or die (mysql_error());
            //log
            enableLog("",$loggedin["username"], $loggedin["id_employee"],$query);
        }
        header('location: '.URL_ADMIN.'master_kasir.php');
    }
    
    
    $content ='

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
			    <form method ="POST" action="">
                            <div class="box">
				<div class="box-header">
                                    <h3 class="box-title">List kasir</h3>
				   <div class="box-tools pull-right">
					<!--<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'administrasi/master_kasir_dafi.php">Semua Kasir</a>
					</div>-->
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'administrasi/form_kasir_dafi.php">Tambah Kasir</a>
					</div>
					<!--<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'master_paket.php?q=bundling">Paket Bundling</a>
					</div>
					<div class="btn bg-olive btn-flat margin">
					     <a href="'.URL_ADMIN.'form_paket_bundling.php">Tambah Paket Bundling</a>
					</div>-->
				   </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="customer" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
						<th>#</th>
                                                <th style="width: 120px">ID Invoice</th>
                                                <th style="width: 220px">Tanggal Transaction</th>
                                                <th>ACC Kasir</th>
                                                <th>Rate</th>
						<th>Action</th>
						<th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_kasir = mysql_query("SELECT `id_kasir_cso`, `transaction_id`, `tgl_transaction`, `acc_kasir`, `mu`, `rate`, `remarks`, `tunai`, `bg_check`, `no_creditcard`, `no_debitcard`, `bank`, `no_edc`, `bukti_bayar`, `total`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_kasir_cso` WHERE `level` = '0' ORDER BY `id_kasir_cso` DESC LIMIT $start, $perhalaman", $conn);
$sql_total_kasir = mysql_num_rows(mysql_query("SELECT `id_kasir_cso`, `transaction_id`, `tgl_transaction`, `acc_kasir`, `mu`, `rate`, `remarks`, `tunai`, `bg_check`, `no_creditcard`, `no_debitcard`, `bank`, `no_edc`, `bukti_bayar`, `total`, `date_add`, `date_upd`, `user_add`, `user_upd`, `level` FROM `gx_kasir_cso` WHERE `level` = '0' ORDER BY `id_kasir_cso` DESC", $conn));
$hal	= "?";
$no = 1;
while ($row_kasir = mysql_fetch_array($sql_kasir))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_kasir["transaction_id"].'</td>
		    <td>'.$row_kasir["tgl_transaction"].'</td>
		    <td>'.$row_kasir["acc_kasir"].'</td>
		    <td>'.$row_kasir["rate"].'</td>
		    
		    <td align="center">
		    <span class="label label-info"><a href="form_kasir_dafi.php?id='.$row_kasir['id_kasir_cso'].'">Edit</a></span> |
		    <span class="label label-info"><a href="detail_kasir_dafi.php?id='.$row_kasir["id_kasir_cso"].'" onclick="return valideopenerform(\'detail_kasir_dafi.php?id='.$row_kasir["id_kasir_cso"].'\',\'kasir\');">Detail</a></span></td>
		    <td><input type="checkbox" name="id_kasir[]" value="'.$row_kasir["id_kasir_cso"].'"></td>
		</tr>';
		$no++;
}
$content .= '
                                            
                                        </tbody>
                                    </table>
				    
                                </div><!-- /.box-body -->
				<div class="box-footer">
				    <div class="box-tools pull-right">
				    '.(halaman($sql_total_kasir, $perhalaman, 1, $hal)).'
				    </div>
				    <br style="clear:both;">
				</div>
				<div class="box-footer">
                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
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
                $(\'#customer\').dataTable({
                    "bPaginate": false,
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

    $title	= 'Master kasir';
    $submenu	= "kasir";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: logout.php");
    }

?>