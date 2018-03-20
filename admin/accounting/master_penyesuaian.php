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
     enableLog("", $loggedin["username"], $loggedin["username"], "Open List Master Kas Keluar");
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
                                    <h3 class="box-title">List Kas Keluar</h3>
				    <div class="box-tools pull-right">
					
					     <a class="btn bg-olive btn-flat margin" href="form_penyesuaian.php">Form Penyesuaian</a>
					
				   </div>
                                </div><!-- /.box-header -->
                                <div class="box-body ">
                                    <table id="kaskeluar" class="table table-bordered table-striped table-responsive">
                                        <thead>
                                            <tr>
												  <th>No.</th>
												  <th style="width: 120px">NOMOR</th>
												  <th style="width: 220px">Tanggal</th>
												  <th>Keterangan</th>
												  <th>Croscek</th>
											 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
$sql_data = mysql_query("SELECT * FROM `gx_acc_penyesuaian` LIMIT $start, $perhalaman;", $conn);
$sql_total_data = mysql_num_rows(mysql_query("SELECT * FROM `gx_acc_penyesuaian`;", $conn));
$hal 	= "?";
$no = 1;
while ($row_data = mysql_fetch_array($sql_data))
{
    $content .= '<tr>
		    <td>'.$no.'.</td>
		    <td>'.$row_data["nomor"].'</td>
		    <td>'.$row_data["tanggal"].'</td>
		    <td>'.$row_data["keterangan"].'</td>
		    <td>'.$row_data["cross_cek"].'</td>
		    <td><a href="form_penyesuaian?token='.$row_data["kode"].'"><span class="label label-info">Detail</span></a></td>
		    
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

$plugins = '<link type="text/css" rel="stylesheet" href="'.URL.'css/gx_pagination.css" />';

    $title	= 'Penyesuaian';
    $submenu	= "penyesuaian";
    //$plugins	= '';
    $user	= ucfirst($loggedin["username"]);
    $group	= $loggedin['group'];
    $template	= admin_theme($title,$content,$plugins,$user,$submenu,$group);
    
    echo $template;
}
    } else{
	header("location: ".URL_ADMIN."logout.php");
    }

?>